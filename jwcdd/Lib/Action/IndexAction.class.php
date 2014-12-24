<?php
	
	class IndexAction extends Action{
		
		//初始函数
		public function index(){
			checkLogin();

			//successful
			$role = session('userRole');
			$role = 1;
			$this->role = $role;
			$this->display();
		}

		//文件上传函数
		public function uploadFile(){
			checkLogin();
	        //set_time_limit(0);
			$userRole = session('userRole');	//获取用户权限
    		$userRole = 1;
    		if ($userRole == 1) {
    			$filepath = './Uploads/dd_files/jb/';
		        $files = M('files');
		        $info = uploadDocFile($filepath);
		        $data['fpath'] = $info[0]['savepath'].$info[0]['savename'];
		        $data['fname'] = $info[0]['savename'];
		        $data['upuid'] = 2;//session('userId');
		        $data['uptime'] = date('Y-m-d H:i:s');
		        $data['upip'] = $this->getIP();
		        //dump($data);
		        if($files->data($data)->add()){
		        	$this->saveOperation($data['upuid'],'用户上传文件 ['.$data['fname'].']');
		        }
		        $this->redirect('Index/index');
    		}
	        
		}

		//搜索函数
		public function search(){
			
			checkLogin();
			//记录开始时间
			$starttime = $this->microtime_float();
			$keyword =$this->_post('keyword');
			$file = M('files');
			$data = $file->where('1=1')->order('uptime desc')->select();
			$result = array();
			$kk = 0;
			$stopflag = 0;
			$stop = 0;
			$found = 0;
			$len = count($data,0);
			$realPath = realpath(__ROOT__);
			$execPath = $realPath.'\\Public\\xpdf\\pdftotext -layout -enc GBK ';
			for ($i= 0; $i < $len; $i++) {
				$stopflag = 0;
				$stop = 0;
				$path = $realPath.str_replace('/','\\',substr($data[$i]['fpath'],1));
				//$tPath = str_replace('.pdf', '.txt', $path);
				$http_path = '/jwcdd/'.substr($data[$i]['fpath'],1);
				$name = $data[$i]['fname'];
				$numofspaces = substr_count($keyword," ");
				$cont_array = array();
				if($numofspaces >= 1){
					//多个关键词
					$cont_array = explode(" ",$keyword);	//带有空格的字符串切割 分别检测	
					//从文件名字中查找
					for ($j = 0 ; $j < $numofspaces + 1; $j++){
						if(stripos($name, $cont_array[$j]) >= 0){
						 	continue;
						}
						else {
							$stopflag = 1;
							break;
						}
					}	
					if ($stopflag == 0){
						$result[$kk]['path'] = $http_path;
						$result[$kk]['name']=$name;
						$kk++;
						$found = 1;
						continue;
					}elseif ($stopflag == 1){	//读取文件，从内容中查找
						$content = shell_exec ($execPath.$path);
						//$content = file_get_contents($tPath);
						$content = mb_convert_encoding($content, "UTF-8", "GBK");		
						for ($j = 0 ; $j < $numofspaces + 1; $j++){
						 	if(stripos($content, $cont_array[$j]) >= 0) {
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
					if(stripos($name, $keyword) >= 0){
						$result[$kk]['path'] = $http_path;
						$result[$kk]['name'] = $name;
						$kk++;
						$found = 1;
						continue;
					}else{
						$content = shell_exec ($execPath.$path);
						//$content = file_get_contents($tPath);
						$content = mb_convert_encoding($content, "UTF-8", "GBK");
						//dump($content);
						if(stripos($content, $keyword) >= 0){
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
			//获取文件路径

			//读取文件

			//在文件内容中查找对应的检索信息

			//如果存在，记录这个文件

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
			$data['logip'] =  $this->getIP();
			$data['operation'] = $operation;
			$logs->data($data)->add();
		}

		// 定义一个函数getIP()
		private function getIP(){
			$ip = '';
			if (getenv("HTTP_CLIENT_IP"))
				$ip = getenv("HTTP_CLIENT_IP");
			else if(getenv("HTTP_X_FORWARDED_FOR"))
				$ip = getenv("HTTP_X_FORWARDED_FOR");
			else if(getenv("REMOTE_ADDR"))
				$ip = getenv("REMOTE_ADDR");
			else $ip = "Unknow";
			return $ip;
		}
	}
?>