<?php
// User文件的Action类
class UserAction extends Action {
    public function user(){
		$this->display();
    }

    //显示个人信息
    public function user_profile(){
		$this->display();
    }

    //修改个人信息
    public function user_modify(){
        $this->display();
    }

    //显示要修改用户信息
    public function user_info($uid=-1){
        $user = M("Users");
        //查询要修改的用户
        $con['uid'] = $uid;
        $euser = $user->field('password', true)->where($con)->select();
        $this->euser = $euser[0];   
        $this->display();
    }

    //修改用户信息
    public function editUser(){
        $user = M("Users");
        $data['role'] = $this->_post('role');
        $data['teaid'] = $this->_post('teaid');
        $data['name'] = $this->_post('name');
        $data['title'] = $this->_post('title');
        $data['college'] = $this->_post('college');
        $data['idcard'] = $this->_post('idcard');
        $data['mobi'] = $this->_post('mobi');
        $data['phone'] = $this->_post('phone');
        $data['email'] = $this->_post('email');      
        $con['uid'] = $this->_post('uid');
        $user->data($data)->where($con)->save();
        $this->redirect("User/user_dd");
    }

    //管理本学期督导
    public function user_dd(){
        checkLogin();
        //查询本学期可用督导信息
        $nowdd = M("Dd");
        //先固定学年学期取值，后面再设成变量传参
        $con1['year'] = 2014;
        $con1['term'] = '秋季';
        $con2['role'] = 2;
        $ddinfo = $nowdd->join('dd_Users on dd_Dd.uid = dd_Users.uid')->field('dd_Users.uid, teaid, name, title, college, idcard, mobi, phone, email, pos, group, did')->where($con1)->where($con2)->order('`group` asc, pos desc')->select();
        $this->ddinfo = $ddinfo;
        //查询本学期还可添加哪些督导
        $users = M("Users");         
        $dduid = i_array_column($ddinfo, 'uid');
        //dump($dduid);
        $con2['uid'] = array('not in', $dduid);
        $dd = $users->field('password,role',true)->where($con2)->order('uid asc')->select();
        $this->dd = $dd;
        //dump($dd);
        //查询已有的组别
        $dgroup = M("Dgroup");
        $dgroup = $dgroup->select();
        $this->dgroup = $dgroup; 
        $this->display();
    }

    //增加督导组别
    public function user_addgroup(){
        checkLogin();
        $addgroup = M("Dgroup");     
        $data['gname'] = $this->_post('gname');
        $nowgroup = $addgroup->field('gname')->select();
        $nowgroup = i_array_column($nowgroup, 'gname');
        //dump($nowgroup);
        if (!empty($data['gname']) && !in_array($data['gname'], $nowgroup)) {
            $addgroup->data($data)->add();         
        }              
        //页面重定向
        $this->redirect("User/user_dd");
    }

    //选择本学期督导
    public function user_seldd(){
        checkLogin();
        $nowdd = M("Dd");
        $data['year'] = 2014;
        $data['term'] = '秋季';
        $uid = $this->_post('uid');
        $length = count($uid);
        for ($i=0; $i<$length; $i++){
            $data['uid'] = $uid[$i];
            //将选择的督导添加到dd表中
            $nowdd->data($data)->add();
        }
        //页面重定向       
        $this->redirect("User/user_dd");
    }

    //修改督导组别
    public function user_mgroup($did=-1, $gname=-1){
        checkLogin();
        $mgroup = M("Dd");
        $con['did'] = $did;
        $data['group'] = $gname;
        $mgroup->data($data)->where($con)->save();    
        $this->redirect("User/user_dd");
    }

    //修改督导职务
    public function user_mpos($did=-1, $pos=-1){
        checkLogin();
        $mpos = M("Dd");
        $con['did'] = $did;
        $data['pos'] = $pos;
        $mpos->data($data)->where($con)->save();    
        $this->redirect("User/user_dd");        
    }

    //删除本学期督导
    public function user_deldd($did=-1){
        checkLogin();
        $deldd = M("Dd");
        $con['did'] = $did;
        $deldd->where($con)->delete();
        $this->redirect("User/user_dd");
    }

    //判断用户角色
    private function user_role($role){
        switch ($role) {
            case '1':
                $rolename = '系统用户';
                break;
            case '2':
                $rolename = '督导';
            case '3':
                $rolename = '学校领导';
                break;
            case '4':
                $rolename = '教学院长';
            default:
                $rolename = '教师';
                break;
        }
        return $rolename;
    }
}