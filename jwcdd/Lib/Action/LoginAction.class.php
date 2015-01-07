<?php
// Login文件的Action类
class LoginAction extends Action {
    public function login(){
		$this->display();
    }

    //验证登录是否成功
    public function verify(){
        if(!empty($_POST) && $this->isPost()){ 
            $username = $this->_post('username');
            $password = $this->_post('password');
            $con['name'] = $username;
            $users = M('users');
            $pwd_db = $users->where($con)->getField('password');
            if (!empty($pwd_db)) {
                if ($password == $pwd_db) {
                    $userId = $users->where($con)->getField('uid');
                    $userRole = $users->where($con)->getField('role');
                    setSession('userName',$username);
                    setSession('userId',$userId);
                    setSession('userRole',$userRole);
                    $this->saveOperation($userId,'用户['.$username.']登录系统');
                    $this->redirect('Index/index');
                }else{
                    $this->error("用户名或者密码错误！");
                }
            }else{
                $this->error("用户名或者密码错误！");
            }
        }else {
            $this->error("不合理的操作！");
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