<?php
// Login文件的Action类
class LoginAction extends Action {
    public function login(){
		$this->display();
    }

    //验证登录是否成功
    public function verify(){
        if(!empty($_POST) && $this->isPost()){
            $teaid = $this->_post('username');
            $password = $this->_post('password');
            $login = new SoapClient("http://cas.bnu.edu.cn/cas/services/UnifyAuthen?wsdl");
            $parameters = array("in0"=>$teaid,"in1"=>$password);
            $success = $login->unifyAuthen($parameters);
            $con['teaid'] = $teaid;
            $users = M('users');
            if (!$success->out || empty($success->out)){  //认证不成功，本地认证
                $password = sha1($password);
                $users = M('users');
                $pwd_db = $users->where($con)->getField('password');
                if (!empty($pwd_db)) {
                    if ($password != $pwd_db) {
                        $this->error("密码错误！");
                        exit;
                    }
                }else{
                    $this->error("用户名不存在！");
                    exit;
                }
            }
            $user_data = $users->where($con)->field("uid,name,role")->select();
            if(empty($user_data)){
                // 通过统一身份认证，但是本地没有该用户相关的权限数据，比如学生，统一设置为5
                setSession('userName',$teaid);
                setSession('userId',$teaid);
                setSession('userRole',5);
            }else{
                setSession('userName',$user_data[0]['name']);
                setSession('userId',$user_data[0]['uid']);
                setSession('userRole',$user_data[0]['role']);
                $module = M('users_modules');
                $map['uid'] = $user_data[0]['uid'];
                $mids = $module->where($map)->getField('module');
                if(!empty($mids)) {
                    $modules = array();
                    if (!empty($mids)) {
                        $modules = explode(',',$mids);
                    }
                    
                    setSession('modules',$modules);
                }
            }
            
            $this->saveOperation($user_data[0]['uid'],'用户['.$user_data[0]['name'].']登录系统');
            //判断学期
            $to_date = date("Y-m-d h:i:s");
            $spring1 = date("Y")."-01-01 00:00:00";
            $spring2 = date("Y")."-02-20 00:00:00";
            $autumn = date("Y")."-09-01 00:00:00";
            if(strtotime($to_date) >= strtotime($spring2) && strtotime($to_date) < strtotime($autumn)){
                setSession("year", date("Y")-1);
                setSession("term", "春季");
                setSession("current_yt", (date("Y") - 1).'-'.date("Y").'学年春季学期');
            }else if(strtotime($to_date) < strtotime($spring2) && strtotime($to_date) >= strtotime($spring1)){
                setSession("year", date("Y")-1);
                setSession("term", "秋季");
                setSession("current_yt", (date("Y")-1).'-'.date("Y").'学年秋季学期');
            }else{
                setSession("year", date("Y"));
                setSession("term", "秋季");
                setSession("current_yt", date("Y").'-'.(date("Y") + 1).'学年秋季学期');
            }
            // 如果是督导用户，获取两周内的听课任务
            $userRole = session('userRole');
            if ($userRole == 2) {
                $u_task = M("task_user");
                $con1["uid"] = session("userId");
                //$con1["year"] = session("year");
                // 消息提醒信息
                $con1["year"] = session("year");
                $con1["term"] = session("term");
                $con1["record"] = 0;
                // 两周内的听课任务
                $con1["_string"] = "to_days(tktime)-to_days(curdate()) <= 14 and to_days(tktime)-to_days(curdate()) > 0";
                $message = $u_task->where($con1)->field("cid,tktime,topic,cname,cplace")->order("tktime asc")->select();
                $length = count($message,0);
                setSession("message",$message);
                setSession("msg_http",HTTP_ADDRESS_PORT."/jwcdd/Task/showTask");
                setSession("msg_count",$length);
            }

            $this->redirect('Index/index');
        }else {
            $this->error("非法操作！");
        }
    }

    //退出登录操作
    public function logout(){
        checkLogin();
        $userId = session('userId');
        $this->saveOperation($userId,'用户退出系统');
        session(null);
    	$this->redirect('Login/login');
    }

    //记录用户操作
    private function saveOperation($uid,$operation){
        $logs = M('logs');
        $data['loguid'] = $uid;
        $data['logtime'] = date('Y-m-d H:i:s');
        $data['logip'] =  get_client_ip();
        $data['operation'] = $operation;
        $logs->data($data)->add();
    }
}