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
                $password = md5($password);
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
            setSession('userName',$user_data[0]['name']);
            setSession('userId',$user_data[0]['uid']);
            setSession('userRole',$user_data[0]['role']);
            $this->saveOperation($user_data[0]['uid'],'用户['.$user_data[0]['name'].']登录系统');
            //记录当前用户的提醒
            
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