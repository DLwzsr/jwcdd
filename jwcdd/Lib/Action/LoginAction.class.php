<?php
// Login文件的Action类
class LoginAction extends Action {
    public function login(){
		$this->display();
    }

    //验证登录是否成功
    public function verify(){
    	$this->redirect("Index/index");
    }

    //退出登录操作
    public function logout(){
    	$this->redirect('Login/login');
    }
}