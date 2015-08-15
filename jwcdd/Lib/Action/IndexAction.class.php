<?php
	
	class IndexAction extends Action{
		/**
		*对接公共资源服务中心的数据接口，将课程数据下载到本地存储
		*/
		public function download_course(){
			set_time_limit(0);
			$length = count($data,0);
			$course_data = array();
			$i = 0;
			$count = 0;
			$users = M('users');
			$loc_course = M('courses');
			$course = M('brw_kbinfo_graduate', 'v_', 'DB_CONFIG');
			/*$condition['PYCC_M'] = 1;
			$condition['XN'] = array('in','2014,2015');*/
			$data = $course->where('PYCC_M = 1 and XN in (2014,2015)')->order('XN desc, XQ_M desc')->select();
			foreach ($data as $key => $value) {
				$course_data[$i]['year'] = $value['XN'];
				if ('0' == $value['XQ_M']){
					$course_data[$i]['term'] = '秋季';
				}elseif ('1' == $value['XQ_M']) {
					$course_data[$i]['term'] = '春季';
				}else {
					$course_data[$i]['term'] = '夏季';
				}
				$course_data[$i]['week'] = $value['周次'];
				$course_data[$i]['courseid'] = $value['课程代码'];
				$course_data[$i]['cname'] = $value['课程名称'];
				$course_data[$i]['category1'] = $value['课程类别'];
				$course_data[$i]['category2'] = $value['课程性质'];
				$course_data[$i]['ctime'] = $value['节次'];
				$course_data[$i]['cplace'] = $value['上课地点'];
				$course_data[$i]['teaid'] = $value['第一任课教师工号'];
				$course_data[$i]['tname'] = $value['第一任课教师姓名'];
				$course_data[$i]['scollege'] = '';
				//获取教师所在的院系
				$con['teaid'] = $value['第一任课教师工号'];
				$tea_info = $users->field('college, title')->where($con)->find();
				$course_data[$i]['tcollege'] = $tea_info['college'];
				//$course_data[$i]['title'] = $tea_info['title'];
				$course_data[$i]['sclass'] = $value['课程代码'].$value['上课班号'];	//上课班级号
				$course_data[$i]['content'] = '';
				//$i++;
				$loc_course->add($course_data[$i],array(),true);
				$count++;
			}
			//dump($course_data);
			dump("Inserting data sum: ".$count);
			//$loc_course->addAll($course_data);
			$this->saveOperation(session('userId'),'管理员用户下载了公资中心接口课程数据');
			//$this->success('操作成功','Index/index');
		}
		public function update_course(){

		}
		//初始函数
		public function index(){
			checkLogin();
			$this->display();
		}

		/*//文件上传函数
		public function uploadFile(){
			checkLogin();
	        //set_time_limit(0);
			$userRole = session('userRole');	//获取用户权限
    		//$userRole = 1;
    		if ($userRole == 1) {
    			$filepath = './Uploads/dd_files/jb/';
		        $files = M('files');
		        $info = uploadDocFile($filepath);
		        $data['fpath'] = $info[0]['savepath'].$info[0]['savename'];
		        $data['fname'] = $con['fname'] = $info[0]['savename'];
		        $data['upuid'] = 2;//session('userId');
		        $data['uptime'] = date('Y-m-d H:i:s');
		        $data['upip'] = get_client_ip();
		        $isExist = $files->where($con)->getField('fname');
		        if (!empty($isExist)) {
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
		        
		        $this->redirect('Index/index');
    		}
	        
		}*/

		//搜索函数
		public function search(){
			
			checkLogin();
			//记录开始时间
			$starttime = $this->microtime_float();
			$keyword =$this->_post('keyword');
			$found = 0;
			if (!empty($keyword)) {
				$file = M('files');
				$data = $file->field('fname,fpath')->where('1=1')->order('uptime desc')->select();
				$result = array();
				$kk = 0;
				$stopflag = 0;
				$stop = 0;
				$len = count($data,0);
				$realPath = realpath(__ROOT__);
				for ($i= 0; $i < $len; $i++) {
					$stopflag = 0;
					$stop = 0;
					$path = $realPath.str_replace('/','\\',substr($data[$i]['fpath'],1));
					$tPath = str_replace('.pdf', '.txt', $path);
					$http_path = '/jwcdd'.substr($data[$i]['fpath'],1);
					$name = $data[$i]['fname'];
					$numofspaces = substr_count($keyword," ");
					$cont_array = array();
					if($numofspaces >= 1){
						//多个关键词
						$cont_array = explode(" ",$keyword);	//带有空格的字符串切割 分别检测	
						//从文件名字中查找
						for ($j = 0 ; $j <= $numofspaces; $j++){
							if(stripos($name, $cont_array[$j]) !== false){
							 	continue;
							}
							else {
								$stopflag = 1;
								break;
							}
						}	
						if ($stopflag == 0){
							$result[$kk]['path'] = $http_path;
							$result[$kk]['name'] = $name;
							$kk++;
							$found = 1;
							continue;
						}elseif ($stopflag == 1){	//读取文件，从内容中查找
							$content = file_get_contents(mb_convert_encoding($tPath,'GBK','UTF-8'));
							$content = mb_convert_encoding($content, "UTF-8", "GBK");		
							for ($j = 0 ; $j <= $numofspaces; $j++){
							 	if(stripos($content, $cont_array[$j]) !== false) {
							 		continue;
							 	}else {
							 		$stop = 1;
							 		break;
							 	}
							 }
							 if ($stop == 1){
							 	continue;
							 }else{
							 	$result[$kk]['path'] = $http_path;
							 	$result[$kk]['name'] = $name;
							 	$kk++;
							 	$found = 1;
							 	continue;
							 }
						}		

					}	
					elseif ($numofspaces == 0) {
						//单个关键词
						if(stripos($name, $keyword) !== false){
							$result[$kk]['path'] = $http_path;
							$result[$kk]['name'] = $name;
							$kk++;
							$found = 1;
							continue;
						}else{
							$content = file_get_contents(mb_convert_encoding($tPath,'GBK','UTF-8'));
							$content = mb_convert_encoding($content, "UTF-8", "GBK");
							if(stripos($content, $keyword) !== false){
								$result[$kk]['path'] = $http_path;
								$result[$kk]['name'] = $name;
								$kk++;
								$found = 1;
								continue;
							}else{
								continue;
							}
						}
					}
				}
			}
			$runtime = $this->microtime_float() - $starttime;
			$this->assign('runtime',round($runtime,3));
			$this->assign('found',$found);
			$this->result = $result;

			$this->display();
		}

		//记录程序执行时间
		private function microtime_float(){
			list($usec, $sec) = explode(" ", microtime());
			return ((float)$usec + (float)$sec);
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

		// 定义一个函数getIP()
		/*private function getIP(){
			$ip = '';
			if (getenv("HTTP_CLIENT_IP"))
				$ip = getenv("HTTP_CLIENT_IP");
			else if(getenv("HTTP_X_FORWARDED_FOR"))
				$ip = getenv("HTTP_X_FORWARDED_FOR");
			else if(getenv("REMOTE_ADDR"))
				$ip = getenv("REMOTE_ADDR");
			else $ip = "Unknow";
			return $ip;
		}*/
	}
?>