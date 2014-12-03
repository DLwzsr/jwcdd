<?php
// User文件的Action类
class UserAction extends Action {
    public function user(){
		$this->display();
    }

    //显示用户信息
    public function user_profile(){
		$this->display();
    }

    //修改用户信息
    public function user_modify(){
		$this->display();
    }
}