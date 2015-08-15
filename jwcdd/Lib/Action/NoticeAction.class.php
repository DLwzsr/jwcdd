<?php
/**
*通知模块
*/
class NoticeAction extends Action {
	
	/**
	*获取通知信息首页相关信息
	*/
	public function notice() {
		$notice = M('notice');
		$jb = M('files');
		$data = $notice->where('1 = 1')->field('id,title,date')->order('date desc, id desc')->limit('0,6')->select();
		$data_jb = $jb->where('1 = 1')->field('fid,ftitle,uptime')->order('uptime desc, fid desc')->limit('0,6')->select();
		$len = count($data_jb,0);
		for ($i=0; $i < $len; $i++) { 
			$data_jb[$i]['uptime'] = substr($data_jb[$i]['uptime'],0,10);
		}
		$this->list = $data;
		$this->jbList = $data_jb;
		$this->display();
	}

	/**
	*展示具体的通知信息
	*/
	public function view($id = -1) {
		$notice = M('notice');
		$con['id'] = $id;
		$data = $notice->where($con)->field('id,title,seq,content,date')->select();
		$data[0]['content'] = htmlspecialchars_decode($data[0]['content']);
		$this->notice_data = $data[0];
		$this->display();
	}

	/**
	*获取所有通知信息
	*/
	public function notice_more() {
		$notice = M('notice');
		import('ORG.Util.Page');
		$count = $notice->count();
	    $Page = new Page($count,15);
	    $Page->setConfig("theme","<ul class='pagination'><li><span>%nowPage%/%totalPage% 页</span></li> %first% %prePage% %linkPage% %nextPage% %end%</ul>");
		$data=$notice->where('1 = 1')->order("date desc, id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
			//发送到页面
	    $this->page = $Page->show();
		$this->list=$data;
		$this->display();
	}
	
	/**
	*获取所有简报信息
	*/
	public function jb_more() {
		$jb = M('files');
		import('ORG.Util.Page');
		$count = $jb->count();
	    $Page = new Page($count,15);
	    $Page->setConfig("theme","<ul class='pagination'><li><span>%nowPage%/%totalPage% 页</span></li> %first% %prePage% %linkPage% %nextPage% %end%</ul>");
		$data=$jb->where('1 = 1')->field('fid,ftitle,uptime')->order("uptime desc, fid desc")->limit($Page->firstRow.','.$Page->listRows)->select();
			//发送到页面
		$len = count($data,0);
		for ($i=0; $i < $len; $i++) {
			$data[$i]['uptime'] = substr($data[$i]['uptime'],0,10);
		}
	    $this->page = $Page->show();
		$this->list=$data;
		$this->display();
	}

	//文件上传函数
	public function uploadFile(){
		checkLogin();
	    //set_time_limit(0);
		$userRole = session('userRole');	//获取用户权限
    	//$userRole = 1;
    	if ($userRole == 1) {
    		$filepath = './Uploads/dd_files/jb/';
		    $files = M('files');
		    $info = uploadDocFile($filepath);
		    $data['ftitle'] = $this->_post('ftitle');
		    $data['fpath'] = $info[0]['savepath'].$info[0]['savename'];
		    $data['fname'] = $con['fname'] = $info[0]['savename'];
		    $data['upuid'] = session('userId');
		    $data['uptime'] = date('Y-m-d H:i:s');
		    $data['upip'] = get_client_ip();
		    $isExist = $files->where($con)->getField('fname');
		    if (!empty($isExist)) {
		    	$data1['ftitle'] = $this->_post('ftitle');
		       	$data1['upuid'] = $data['upuid'];
		       	$data1['uptime'] = $data['uptime'];
		        $data1['upip'] = $data['upip'];
		        if ($files->where($con)->save($data1)) {
		        	$this->saveOperation($data['upuid'],'用户更新文件 ['.$data['fname'].']');
		        	//将文件转换对应生成txt文档，便于后期检索
			        $realPath = realpath(__ROOT__);
			        $path = $realPath.str_replace('/','\\',substr($data['fpath'],1));
					$execPath = $realPath.'\\Public\\xpdf\\pdftotext -layout -enc GBK ';
			        $cmd = $execPath.$path;	//cmd路径
					shell_exec(mb_convert_encoding($cmd,'GBK','UTF-8'));
		        }else{
		        	$this->error('文件上传更新失败！');
		        }

		    }else{
		        if($files->data($data)->add()){
			        $this->saveOperation($data['upuid'],'用户上传文件 ['.$data['fname'].']');
			        	//将文件转换对应生成txt文档，便于后期检索
			        $realPath = realpath(__ROOT__);
			        $path = $realPath.str_replace('/','\\',substr($data['fpath'],1));
					$execPath = $realPath.'\\Public\\xpdf\\pdftotext -layout -enc GBK ';
			        $cmd = $execPath.$path;	//cmd路径
					shell_exec(mb_convert_encoding($cmd,'GBK','UTF-8'));
			    }else{
			        $this->error('文件上传失败！');
			    }
		    }
		    //dump($data);
		        
		    $this->redirect('Notice/show_notice');
    	}      
	}

	/**
	 * 下载文件
	 */
	
	public function download_file($fid = -1){
		checkLogin();
		$jb = M('files');
		$map['fid'] = (int)$fid;
		$data = $jb->where($map)->field('fname,fpath')->find();
		$file = REAL_PATH.str_replace('/','\\',substr($data['fpath'],1));
		$file = iconv('utf-8','gb2312',$file);
		$filename = $data['fname'];
		if (!file_exists($file)) {
			dump($file);
			echo "File is not exist";
			exit(0);
		}
	    header("Content-type: application/octet-stream");
	    //处理中文文件名
	    $ua = $_SERVER["HTTP_USER_AGENT"];
	    $encoded_filename = rawurlencode($filename);
	    if (preg_match("/MSIE/", $ua)) {
	     header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
	    } else if (preg_match("/Firefox/", $ua)) {
	     header("Content-Disposition: attachment; filename*=\"utf8''" . $filename . '"');
	    } else {
	     header('Content-Disposition: attachment; filename="' . $filename . '"');
	    }
	 
	    header("Content-Length: ". filesize($file));
	    readfile($file);
	    exit(0);
	}

	public function intro() {
		$this->display();
	}

	public function member() {
		$dd = M('users');
		$map['role'] = 2;
		$data = $dd->field('uid,name,title,college')->where($map)->order('uid desc')->select();
		$this->data = $data;
		$this->display();
	}

	public function member_info($id = -1){
		$notice_dd = M('notice_dd');
		$map['type_id'] = $id;
		$data = $notice_dd->where($map)->find();
		if (!empty($data)) {
			$data['intro'] = htmlspecialchars_decode($data['intro']);
		}
		$this->data = $data;
		$this->display();
	}

	public function contact() {
		$this->display();
	}
	/**
	*获取通知信息，以列表的形式展示
	*/
	public function show_notice() {
		checkLogin();
		$userRole = session('userRole');
		if(1 == $userRole){
			$notice = M('notice');
			import('ORG.Util.Page');
			$count = $notice->count();
	        $Page = new Page($count,10);
	        $Page->setConfig("theme","<ul class='pagination'><li><span>%nowPage%/%totalPage% 页</span></li> %first% %prePage% %linkPage% %nextPage% %end%</ul>");
			$data=$notice->where('1 = 1')->order("date desc, id desc")->limit($Page->firstRow.','.$Page->listRows)->select();
			//发送到页面
	        $this->page = $Page->show();
			$this->noticeList=$data;
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
		
	}

	/**
	*获取增加通知
	*/
	public function add_notice() {
		checkLogin();
		$userRole = session('userRole');
		if(1 == $userRole){
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
		
	}

	/**
	*获取保存通知信息
	*/
	public function save_notice() {
		checkLogin();
		header('Content-Type:application/json; charset=utf-8');
		$userRole = session('userRole');
		if(1 == $userRole){
			$data_array = array();
			$json = array();
			$notice = M('notice');
			$data_array['title'] = $this->_post('title');
			$data_array['content'] = $this->_post('content');
			$data_array['seq'] = $this->_post('seq');
			$data_array['date'] = date('Y-m-d');
			$data_array['uname'] = session('userName');
			$data_array['uid'] = session('userId');
			$flag = (int)$this->_post('flag');
			if(0 == $flag){
				if($notice->data($data_array)->add()){
					$json = array('code'=>1);
					$this->saveOperation(session('userId'),session('userName')."新增加一条通知信息");
				}else{
					$json = array('code'=>0);
				}
			}else if (1 == $flag){
				$con['id'] = $this->_post('id');
				if($notice->where($con)->save($data_array)){
					$json = array('code'=>1);
					$this->saveOperation(session('userId'),session('userName')."更新一条通知信息");
				}else{
					$json = array('code'=>0);
				}
			}
			
			$this->ajaxReturn($json);
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
		
	}

	/**
	*编辑通知信息
	*/
	public function notice_info($id = -1) {
		checkLogin();
		if(1 == session("userRole")){
			$con['id'] = $id;
			$notice = M('notice');
			$data = $notice->where($con)->field('id,title,content,seq')->select();
			$data[0]['content'] = htmlspecialchars_decode($data[0]['content']);
			$this->notice_data = $data[0];
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
	}

	/**
	*删除通知信息
	*/
	public function notice_delete($id = -1) {
		checkLogin();
		if(1 == session("userRole")){
			$con['id'] = $id;
			$notice = M('notice');
			$notice->where($con)->delete();
			$this->success('操作成功,信息已删除');
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
	}

	/**
	 * 督导模块
	 */
	public function show_dd(){
		checkLogin();
		$userRole = session('userRole');
		if(1 == $userRole){
			$notice = M('notice_dd');
			import('ORG.Util.Page');
			$count = $notice->count();
	        $Page = new Page($count,10);
	        $Page->setConfig("theme","<ul class='pagination'><li><span>%nowPage%/%totalPage% 页</span></li> %first% %prePage% %linkPage% %nextPage% %end%</ul>");
			$data=$notice->field('iid,date,uname,teaid,name,college')->where('1 = 1')->order("date desc, iid desc")->limit($Page->firstRow.','.$Page->listRows)->select();
			//发送到页面
	        $this->page = $Page->show();
			$this->noticeList=$data;
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
		
	}

	/**
	 * 新增督导介绍
	 */

	public function add_dd(){
		checkLogin();
		if(1 == session("userRole")){
			$users = M('users');
			$map['role'] = 2;
			$result = array();
			$i = 0;
			$data = $users->field("uid,name,teaid")->where($map)->order("uid desc")->select();
			foreach ($data as $key => $value) {
				$result[$i]['uid'] = $value['uid'];
				$result[$i]['user_name'] = $value['name'].' | '.$value['teaid'];
				$i++;
			}
			$this->dd_users = $result;
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
	}

	/**
	*获取保存督导信息
	*/
	public function save_dd() {
		checkLogin();
		header('Content-Type:application/json; charset=utf-8');
		$userRole = session('userRole');
		if(1 == $userRole){
			$data_array = array();
			$json = array();
			$notice_intro = M('noticeintro');
			$data_array['type_id'] = (int)$this->_post('title');
			$data_array['intro'] = $this->_post('content');
			$data_array['date'] = date('Y-m-d');
			$data_array['uname'] = session('userName');
			$data_array['uid'] = session('userId');
			$data_array['type'] = 1; //表明是督导简介信息 2：表示是课程大纲简介信息
			$flag = (int)$this->_post('flag');
			if(0 == $flag){
				if($notice_intro->data($data_array)->add()){
					$json = array('code'=>1);
					$this->saveOperation(session('userId'),session('userName')."新增加一条通知信息");
				}else{
					$json = array('code'=>0);
				}
			}else if (1 == $flag){
				$con['iid'] = $this->_post('iid');
				if($notice_intro->where($con)->save($data_array)){
					$json = array('code'=>1);
					$this->saveOperation(session('userId'),session('userName')."更新一条通知信息");
				}else{
					$json = array('code'=>0);
				}
			}
			
			$this->ajaxReturn($json);
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
		
	}

	/**
	*编辑督导介绍信息
	*/
	public function dd_info($id = -1) {
		checkLogin();
		if(1 == session("userRole")){
			$con['iid'] = $id;
			$notice = M('noticeintro');
			$users = M('users');
			$data = $notice->where($con)->field('iid,type_id,intro')->select();
			$data[0]['content'] = htmlspecialchars_decode($data[0]['intro']);
			$map['uid'] = $data[0]['type_id'];
			$result = $users->where($map)->field('name,teaid')->find();
			$data[0]['title'] = $result['name'].'_'.$result['teaid'];
			$this->notice_data = $data[0];
			$this->display();
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
	}

	/**
	*删除督导介绍信息
	*/
	public function dd_delete($id = -1) {
		checkLogin();
		if(1 == session("userRole")){
			$con['iid'] = $id;
			$notice = M('noticeintro');
			$notice->where($con)->delete();
			$this->success('操作成功,信息已删除');
		}else{
			$this->error('亲~ 你不具备这样的能力哦~');
		}
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

?>