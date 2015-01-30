<?php
// Record文件的Action类
class RecordAction extends Action {
	
    public function record(){
		checkLogin();
		$userRole = session('userRole');	//获取用户权限
    	$userRole = 1;//暂时设为1
    	if ($userRole == 1 ) {//权限控制|| $userRole == ??
            $con = array();//定义一个数组
            $add = M('record_add');
            $year = null;
            $term = null;
            if (!empty($_POST) && $this->isPost()) {
                if ($this->_post('yt') != -1) {//如果选择了学年学期
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
				else
				{
				$year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
				}
                if($this->_post('teacher') != -1){//教师名称
                    $con['teaid'] = $this->_post('teacher');
                }
                if($this->_post('title') != -1){//教师职称
                    $con['title'] = $this->_post('title');
                }
                if($this->_post('tcollege') != -1){//教师单位
                    $con['tcollege'] = $this->_post('tcollege');
                }
                if($this->_post('skplace') != -1){//上课地点
                    $con['cplace'] = $this->_post('skplace');
                }
                if($this->_post('course') != -1){//课程名称
                    $con['cname'] = $this->_post('course');
                }
                if($this->_post('topic') != -1){//课程类别
                    $con['topic'] = $this->_post('topic');
                }
                if($this->_post('scollege') != -1){//学生院系
                    $con['scollege'] = $this->_post('scollege');
                }
                if($this->_post('sclass') != -1){//年级
                    $con['sclass'] = $this->_post('sclass');
                }
            }
			else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
				
            }
    		//echo $con['term'];
    		$data = $add->where($con)->order('cid asc')->select();
			//var_dump($data);
			//下拉菜单显示
    		$this->yt = $this->getYearTerm('record_add');//学年学期
            $this->tea = $this->getTeacher($year,$term,'record_add');//教师姓名
			$this->ttitle = $this->getTitle($year,$term,'record_add');//教师职称
            $this->tcollege = $this->getTcollege($year,$term,'record_add');//教师单位
            $this->place = $this->getPlace($year,$term,'record_add');//上课地点
            $this->course = $this->getCourse($year,$term,'record_add');//课程名称
            $this->topic = $this->getTopic($year,$term,'record_add');//课程类型
			$this->scollege = $this->getScollege($year,$term,'record_add');//学生院系
			$this->sclass = $this->getSclass($year,$term,'record_add');//年级（班级）
    	
            $this->title = $year.$term;
            $this->term = $term;
			//课程信息显示
			$this->data = $data;


    	}else{
    		$this->error('亲~ 你不具备这样的能力哦~');
    	}
		$this->display();
    }
	
	//填写听课记录
	public function addRecord($cid){
		//这里是听课记录添加界面  参数courseid为课程id
		$course = M("record_add");
$task= M("task_course");
		$dd = M("Dd");//督导dd表
		$con1['cid'] = $cid;
		$data_course = $course->where($con1)->select();
		$con2['uid'] = session('userId');//需要did，首先取出uid
		$con2['year'] = $data_course[0]['year'];
		$con2['term'] = $data_course[0]['term'];
		$data_dd_ = $dd->where($con2)->select();//查出当前督导id
		$did = $data_dd[0]['did'];//取出did

		//$con3['did'] = $did;//查看是否已经有这一听课记录
		$con3['cid'] = $cid;
		$data_task = $task->where($con3)->select();
		if($data_task[0]['record'] == '1'){//如果记录已存在
			echo '记录已存在';
			exit;
		}
		else{
			$con['cid'] = $cid;
			$data_course = $course->where($con)->select();//取出cid这一条课程记录
			$this->cid=$cid;
			$this->data_course=$data_course[0]; 
			$this->display();
		}
    }

	//保存新建听课记录
    public function record_add_save(){
		
		$record = M("records");//record表
		$course = M("record_add");//course视图
		$task = M("task_course");//task视图
		$dd = M("Dd");//督导dd表
		$con1['cid'] = $this->_post('cid');
		$data_course = $course->where($con1)->select();//查出cid的那条课程信息
		$data['courseid'] = $data_course[0]['courseid'];
		$data['cname'] = $data_course[0]['cname'];
		$data['sclass'] = $data_course[0]['sclass'];
		$data['teaid'] = $data_course[0]['teaid'];
		$data['teaname'] = $data_course[0]['tname'];
		$data['teacollege'] = $data_course[0]['tcollege'];
		$data['teatitle'] = $data_course[0]['title'];
		$data['content'] = $this->_post('content');//听课内容
		$data['skplace'] = $data_course[0]['cplace'];
		$data['sktime'] = $data_course[0]['ctime'];
		$data['tktime'] = $this->_post('tktime');//听课时间
		$data['tkjs'] =	$this->_post('tktime');	//听课节数-这里要做两个框-开始节次，结束节次

		//$data['tbtime'] = $this->_post('tbtime');//填表时间
		$data['tbtime'] = date('Y-m-d');//获取填表日期
		$data['jxtd_rz'] = $this->_post('jxtd_rz');//教学态度-认真
		$data['jxtd_kqzb'] = $this->_post('jxtd_kqzb');//教学态度-课前准备
		$data['jxnr_nrfh'] = $this->_post('jxnr_nrfh');//教学内容-内容符合
		$data['jxnr_nrcs'] = $this->_post('jxnr_nrcs');//教学内容-内容充实
		$data['jxnr_wtcs'] = $this->_post('jxnr_wtcs');//教学内容-问题充实
		$data['jxnr_nrgx'] = $this->_post('jxnr_nrgx');//教学内容-内容更新
		$data['jxff_ktzx'] = $this->_post('jxff_ktzx');//教学辅助-课堂秩序
		$data['jxff_fzjx'] = $this->_post('jxff_fzjx');//教学辅助-辅助教学
		$data['jxxg_qdxs'] = $this->_post('jxxg_qdxs');//教学效果-启迪学生
		$data['jxxg_bzzw'] = $this->_post('jxxg_bzzw');//教学效果-帮助掌握
		$data['xlkpj'] = $this->_post('xlkpj');//绪论课评价
		$data['zjgz'] = $this->_post('zjgz');//助教工作
		$data['pjjy'] = $this->_post('pjjy');//评价建议
		$data['ztpj'] = $this->_post('ztpj');//总体评价
		$data['xsjy'] = $this->_post('xsjy');//学生建议
		$data['hjjy'] = $this->_post('hjjy');//环境建议
		

		$con2['uid'] = session('userId');//需要did，首先取出uid
		$con2['year'] = $data_course[0]['year'];
		$con2['term'] = $data_course[0]['term'];
		$data_dd_ = $dd->where($con2)->select();//查出当前督导id
		$did = $data_dd[0]['did'];//取出did

		//$con3['did'] = $did;//查看是否已经有这一听课任务
		$con3['cid'] = $this->_post('cid');
		$data_task = $task->where($con3)->select();

		if($data_task == NULL){//如果没有这个任务，则添加
			$data2['did'] = $did;
			$data2['cid'] = $this->_post('cid');
			$data2['tktime'] = $this->_post('tktime');//听课时间
			$data2['topic'] = null;//听课专题???
			$data2['check'] = '0';//默认审批状态暂设为“0”
			$data2['record'] = '1';//有无记录设为“1”
			$newtid=$task->data($data2)->add();//记录tid
		}
		else{//若已存在这条任务但没有记录，注释为已有记录
			$data2['record'] = '1';
			$task->where($con3)->data($data2)->save();
			$newtid=$data_task[0]['tid'];//记录tid
		}
		$data['tid'] = $newtid;//add task id to record

		$record->data($data)->add();//在record表中记录tid
		$this->redirect("Record/record");//跳转待定
    }
	
	//显示听课记录列表
    public function showRecord(){

		checkLogin();
		$userRole = session('userRole');	//获取用户权限
    	$userRole = 1;//暂时设为1
    	if ($userRole == 1 ) {//权限控制|| $userRole == ??
            $con = array();//定义一个数组
            $record = M('task_course');
            $year = null;
            $term = null;
            if (!empty($_POST) && $this->isPost()) {
                if ($this->_post('yt') != -1) {//如果选择了学年学期
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
				else
				{
				$year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
				}
                if($this->_post('teacher') != -1){//教师名称
                    $con['teaid'] = $this->_post('teacher');
                }
                if($this->_post('title') != -1){//教师职称
                    $con['title'] = $this->_post('title');
                }
                if($this->_post('tcollege') != -1){//教师单位
                    $con['tcollege'] = $this->_post('tcollege');
                }
                if($this->_post('skplace') != -1){//上课地点
                    $con['cplace'] = $this->_post('skplace');
                }
                if($this->_post('course') != -1){//课程名称
                    $con['cname'] = $this->_post('course');
                }
                if($this->_post('topic') != -1){//课程类别
                    $con['topic'] = $this->_post('topic');
                }
                if($this->_post('scollege') != -1){//学生院系
                    $con['scollege'] = $this->_post('scollege');
                }
                if($this->_post('sclass') != -1){//年级
                    $con['sclass'] = $this->_post('sclass');
                }
            }
			else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
				
            }
    		//echo $con['term'];
			$con['record'] = '1';
    		$data = $record->where($con)->order('cid asc')->select();
			//var_dump($data);
			//下拉菜单显示
    		$this->yt = $this->getYearTerm('task_course');//学年学期
            $this->tea = $this->getTeacher($year,$term,'task_course');//教师姓名
			$this->ttitle = $this->getTitle($year,$term,'task_course');//教师职称
            $this->tcollege = $this->getTcollege($year,$term,'task_course');//教师单位
            $this->place = $this->getPlace($year,$term,'task_course');//上课地点
            $this->course = $this->getCourse($year,$term,'task_course');//课程名称
            $this->topic = $this->getTopic($year,$term,'task_course');//课程类型
			$this->scollege = $this->getScollege($year,$term,'task_course');//学生院系
			$this->sclass = $this->getSclass($year,$term,'task_course');//年级（班级）
			//$this->dd = $this->getDd($year,$term,'task_course');//督导姓名
    	
            $this->title = $year.$term;
            $this->term = $term;
			//课程信息显示
			$this->data = $data;

    	}else{
    		$this->error('亲~ 你不具备这样的能力哦~');
    	}
		$this->display();
    }

	//修改听课记录
    public function editRecord($tid){
		//echo $id.'<br/>';
		$record = M('records');
		$course = M('record_add');

		$con1['tid'] = $tid;
		$data_record = $record->where($con1)->select();//从记录表中找到记录信息
		$this->record=$data_record[0];
		
		$con2['courseid'] = $data_record[0]['courseid'];
		$data_course = $course->where($con2)->select();//从视图中找到课程信息
		$this->course=$data_course[0];

		$this->display();
    }

	//保存编辑听课记录
    public function record_edit_save(){
		//print_r($_POST);
		$record = M("records");//记录表
		//$con['rid'] = $rid;
		$con['rid'] = $this->_post('rid');

		$data['content'] = $this->_post('content');//听课内容
		$data['tktime'] = $this->_post('tktime');//听课时间
		$data['tkjs'] =	$this->_post('tktime');	//听课节数

		$data['tbtime'] = date('Y-m-d');//获取填表日期
		$data['jxtd_rz'] = $this->_post('jxtd_rz');//教学态度-认真
		$data['jxtd_kqzb'] = $this->_post('jxtd_kqzb');//教学态度-课前准备
		$data['jxnr_nrfh'] = $this->_post('jxnr_nrfh');//教学内容-内容符合
		$data['jxnr_nrcs'] = $this->_post('jxnr_nrcs');//教学内容-内容充实
		$data['jxnr_wtcs'] = $this->_post('jxnr_wtcs');//教学内容-问题充实
		$data['jxnr_nrgx'] = $this->_post('jxnr_nrgx');//教学内容-内容更新
		$data['jxff_ktzx'] = $this->_post('jxff_ktzx');//教学辅助-课堂秩序
		$data['jxff_fzjx'] = $this->_post('jxff_fzjx');//教学辅助-辅助教学
		$data['jxxg_qdxs'] = $this->_post('jxxg_qdxs');//教学效果-启迪学生
		$data['jxxg_bzzw'] = $this->_post('jxxg_bzzw');//教学效果-帮助掌握
		$data['xlkpj'] = $this->_post('xlkpj');//绪论课评价
		$data['zjgz'] = $this->_post('zjgz');//助教工作
		$data['pjjy'] = $this->_post('pjjy');//评价建议
		$data['ztpj'] = $this->_post('ztpj');//总体评价
		$data['xsjy'] = $this->_post('xsjy');//学生建议
		$data['hjjy'] = $this->_post('hjjy');//环境建议
		
		$record->data($data)->where($con)->save();
		$this->redirect("Record/showRecord");//跳转待定
    }

	//删除听课记录
    public function record_deldd($tid=-1){
        checkLogin();
        $record = M("Records");
		$task = M("Tasks");
        $con['tid'] = $tid;
        $record->where($con)->delete();

		$data['record'] = '0';
		$task->where($con)->data($data)->save();//将记录标记为1

        $this->redirect("Record/showRecord");
    }  


	//获取学年学期
    private function getYearTerm($tableName){
    	$add = M($tableName);
    	$data = $add->Distinct(true)->field(array('concat(year,term)'=>'yt'))->group('year,term')->order('year desc')->select();
    	return $data;
    }
    
    //获取教师姓名
    private function getTeacher($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('teaid,tname')->where($con)->order('teaid asc')->select();
        return $data;
    }

	/*//获取督导姓名
    private function getDd($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('did,dname')->where($con)->order('did asc')->select();
        return $data;
    }*/

	//获取教师职称
    private function getTitle($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('title')->where($con)->order('teaid asc')->select();
        return $data;
    }

    //获取教师单位
    private function getTcollege($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('tcollege')->where($con)->order('tcollege asc')->select();
        return $data;
    }

    //获取上课地点
    private function getPlace($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('cplace')->where($con)->order('cplace asc')->select();
        return $data;
    }

    //获取课程名称
    private function getCourse($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('cname')->where($con)->order('cname asc')->select();
        return $data;
    }

    //获取课程类型
    private function getTopic($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('topic')->where($con)->order('topic asc')->select();
        return $data;
    }

	//获取学生院系
    private function getScollege($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('scollege')->where($con)->order('scollege asc')->select();
        return $data;
    }

	//获取学生年级（班级）
    private function getSclass($year,$term,$tableName){
        $add = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $add->Distinct(true)->field('sclass')->where($con)->order('sclass asc')->select();
        return $data;
    }
}