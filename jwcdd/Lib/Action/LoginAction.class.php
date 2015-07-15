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
            setSession('userName',$user_data[0]['name']);
            setSession('userId',$user_data[0]['uid']);
            setSession('userRole',$user_data[0]['role']);
            $this->saveOperation($user_data[0]['uid'],'用户['.$user_data[0]['name'].']登录系统');
            //判断学期
            $to_date = date("Y-m-d h:i:s");
            $spring = date("Y")."-02-15 12:00:00";
            $autumn = date("Y")."-08-15 12:00:00";
            if(strtotime($to_date) >= strtotime($spring) && strtotime($to_date) < strtotime($autumn)){
                setSession("year",date("Y"));
                setSession("term",1);
            }else{
                setSession("term",0);
                $month = date("m");
                if($month >= 8){
                    setSession("year",date("Y"));
                }else{
                    setSession("year",date("Y")-1);
                }
            }
            $u_task = M("task_user");
            $con1["uid"] = session("userId");
            //$con1["year"] = session("year");
            $con1["year"] = 2014;
            $con1["term"] = session("term");
            $con1["record"] = 0;
            $con1["_string"] = "to_days(tktime)-to_days(curdate()) <= 14 and to_days(tktime)-to_days(curdate()) > 0";
            $message = $u_task->where($con1)->field("cid,tktime,topic")->order("tktime asc")->limit("0,5")->select();
            $con2["id"] = "BKS1";
            $course = new CourseModel("Course","syn_","DB_CONFIG");
            $length = count($message,0);
            for ($i=0; $i < $length; $i++) { 
                $con2["id"] = $message[$i]["cid"];
                $course_array = $course->where($con2)->field("cname,cplace1")->find();
                $message[$i]["cname"] = $course_array["CNAME"];
                $message[$i]["place"] = $course_array["CPLACE1"];
            }
            setSession("message",$message);
            setSession("msg_count",$length);
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