<?php
// Analysis文件的Action类
class AnalysisAction extends Action {
    public function analysis(){
    	checkLogin();
    	$userRole = session('userRole');	//获取用户权限
    	$userRole = 1;
    	if ($userRole == 1) {
            $con = array();
            $hz = M('hz_tkrecord');
            $year = null;
            $term = null;
            if (!empty($_POST) && $this->isPost()) {
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
                if($this->_post('group') != -1){
                    $con['group'] = $this->_post('group');
                }
                if($this->_post('month') != -1){
                    $con['tkmonth'] = $this->_post('month');
                }
                if($this->_post('ztpj') != -1){
                    $con['ztpj'] = $this->_post('ztpj');
                }
                if($this->_post('dd') != -1){
                    $con['dduid'] = $this->_post('dd');
                }
                if($this->_post('teacher') != -1){
                    $con['teaid'] = $this->_post('teacher');
                }
                if($this->_post('title') != -1){
                    $con['title'] = $this->_post('title');
                }
                if($this->_post('tcollege') != -1){
                    $con['tcollege'] = $this->_post('tcollege');
                }
                if($this->_post('skplace') != -1){
                    $con['skplace'] = $this->_post('skplace');
                }
                if($this->_post('course') != -1){
                    $con['cname'] = $this->_post('course');
                }
                if($this->_post('topic') != -1){
                    $con['topic'] = $this->_post('topic');
                }
                if($this->_post('scollege') != -1){
                    $con['sclass'] = $this->_post('scollege');
                }
                if($this->_post('grade') != -1){
                    $con['sclass'] = $this->_post('grade');
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }
    		
    		$data = $hz->where($con)->order('rid asc')->select();

    		$this->yt = $this->getYearTerm('hz_tkrecord');
    		$this->group = $this->getGroup($year,$term,'hz_tkrecord');
            $this->dd = $this->getDd($year,$term,'hz_tkrecord');
            $this->tea = $this->getTeacher($year,$term,'hz_tkrecord');
            $this->college = $this->getCollege($year,$term,'hz_tkrecord');
            $this->place = $this->getPlace($year,$term,'hz_tkrecord');
            $this->course = $this->getCourse($year,$term,'hz_tkrecord');
            $this->topic = $this->getTopic($year,$term,'hz_tkrecord');
    		$this->data = $data;
            $this->year = $year;
            $this->term = $term;
            $this->term = $term;
    	}else{
    		$this->error('亲~ 你不具备这样的能力哦~');
    	}
		$this->display();
    }

    //导入督导汇总表
    public function importDd(){
        checkLogin();
        set_time_limit(0);
        load('@.excel');
        $excel = new excel();
        $filepath = './Uploads/dd_files/hz/';
        $records = M('records');
        $info = uploadExcelFile($filepath);
        $file = $info[0]['savepath'].$info[0]['savename'];
        $temp = $excel->returnExcelData($file);
        $rows = $temp[0]['rows'];   //行数
        $excelData = $temp[2]['data'];
        $cols = count($excelData[0],0); //列数
        $ztpj = array('好'=>5,
                     '较好'=>4,
                     '一般'=>3,
                     '较差'=>2,
                     '差'=>1,
                     '未评价'=>0);
        $data1 = array();
        for ($i=0; $i < $rows; $i++) { 
            $data2 = array(); 
            $con = array();
            $con['name'] = $excelData[$i][19];
            $d_uid = $this->isExist('users',$con,'uid');
            if(empty($d_uid)){
                //throw_exception('督导用户:'.$con['name'].'不存在或者信息错误！');
                $this->error('督导用户:'.$con['name'].'不存在或者信息错误！');
            }
            $con = array();
            $con['uid'] = $d_uid;
            $did = $this->isExist('dd',$con,'did');
            if(empty($did)){
                $this->error('督导用户:'.$con['name'].'不是本学期督导！');
            }
            $con = array();
            $con['name'] = $excelData[$i][3];
            $teaid = $this->isExist('users',$con,'teaid');
            if(empty($teaid)){
                $this->error('教师:'.$con['name'].'不存在或者信息错误！');
            }
            $con = array();
            $con['cname'] = $excelData[$i][6];
            $con['teaid'] = $teaid;
            $courseid = $this->isExist('courses',$con,'courseid');
            $cid = $this->isExist('courses',$con,'cid');
            if (empty($courseid)) {
                $this->error('课程:《'.$con['cname'].'》不存在或者信息错误！');
            }
            $con = array();
            $topic = $excelData[$i][18];
            if (!empty($topic)) {
                $con['topicname'] = $topic;
                $topicid = $this->isExist('topic',$con,'topicid');
                if (empty($topicid)) {
                    $this->error('课程类别:'.$topic.' 不存在或者信息错误！');
                }
            }
            if (empty($ztpj[$excelData[$i][15]])) {
                $this->error('总体评价内容必须是：好、较好、一般、较差、差、未评价之一');
            }
            $con = array();
            $con['did'] = $did;
            $con['cid'] = $cid;
            $tid = $this->isExist('tasks',$con,'tid');
            if (empty($tid)) {
                $data2['did'] = $did;
                $data2['cid'] = $cid;
                $data2['topic'] = $excelData[$i][18];
                $data2['check'] = '1';
                $data2['record'] = '1';
                $tid = M('tasks')->data($data2)->add();
            }
            $data1[$i]['tid'] = $tid;
            $data1[$i]['courseid'] = $courseid;
            $data1[$i]['cname'] = $excelData[$i][6];
            $data1[$i]['sclass'] = $excelData[$i][8];
            $data1[$i]['teaid'] = $teaid;
            $data1[$i]['teaname'] = $excelData[$i][3];
            $data1[$i]['teacollege'] = $excelData[$i][5];
            $data1[$i]['teatitle'] = $excelData[$i][4];
            $data1[$i]['skplace'] = $excelData[$i][10];
            $data1[$i]['sktime'] = $excelData[$i][9];
            $data1[$i]['tktime'] = $excelData[$i][2];
            $data1[$i]['tkjs'] = $excelData[$i][11];
            $data1[$i]['tbtime'] = $this->getDate(); //导入时间
            $data1[$i]['ztpj'] = $ztpj[$excelData[$i][15]];
            $data1[$i]['pjjy'] = $excelData[$i][14];
            $data1[$i]['xlkpj'] = $excelData[$i][12];
            $data1[$i]['zjgz'] = $excelData[$i][13];
            $data1[$i]['xsjy'] = $excelData[$i][16];
            $data1[$i]['hjjy'] = $excelData[$i][17];
        }
        //dump($data1);
        M('records')->addAll($data1);

        $this->redirect('Analysis/analysis');
    }

    //获取按院系统计
    public function department(){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $year = null;
            $term = null;
            $hz_college = M('hz_college');
            if(!empty($_POST) && $this->isPost()){
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }
            $data = $hz_college->where($con)->order('tcollege asc')->select();

            $this->yt = $this->getYearTerm('hz_college');
            $this->year = $year;
            $this->term = $term;
            $this->data = $data;
            $this->display();
        }
    }

    //获取按院系月份统计
    public function month(){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $year = null;
            $term = null;
            $hz_month = M('hz_colmonth');
            if(!empty($_POST) && $this->isPost()){
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }
            $data = $hz_month->where($con)->order('tcollege asc,tkmonth asc')->select();

            $this->yt = $this->getYearTerm('hz_colmonth');
            $this->year = $year;
            $this->term = $term;
            $this->data = $data;
            $this->display();
        }
    }

    //获取督导统计表
    public function supervisor(){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $year = null;
            $term = null;
            //$hz_dd = M('hz_dd');
            if(!empty($_POST) && $this->isPost()){
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }

            $data = $this->getHzDd($year,$term,'hz_dd');
            $this->yt = $this->getYearTerm('hz_dd');
            $this->year = $year;
            $this->term = $term;
            $this->data = $data;
            $this->display();
        }
    }

    //获取教师统计表
    public function teacher(){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $year = null;
            $term = null;
            $hz_title = M('hz_title');
            if(!empty($_POST) && $this->isPost()){
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }
            $data = $hz_title->where($con)->order('tcollege asc')->select();

            $this->yt = $this->getYearTerm('hz_title');
            $this->year = $year;
            $this->term = $term;
            $this->data = $data;
            $this->display();
        }
    }

    //获取课程名统计表
    public function course(){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $year = null;
            $term = null;
            $hz_cname = M('hz_cname');
            if(!empty($_POST) && $this->isPost()){
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con['year'] = $year;
                    $con['term'] = $term;
                }
            }else{
                $year = session('year');
                $term = session('term');
                $year = 2014;
                $term = '春季';
                $con['year'] = $year;
                $con['term'] = $term;
            }
            $data = $hz_cname->where($con)->order('tcollege asc,cname asc,tname asc')->select();

            $this->yt = $this->getYearTerm('hz_cname');
            $this->year = $year;
            $this->term = $term;
            $this->data = $data;
            $this->display();
        }
    }

    //获取学年学期
    private function getYearTerm($tableName){
    	$hz = M($tableName);
    	$data = $hz->Distinct(true)->field(array('concat(year,term)'=>'yt'))->group('year,term')->order('year desc')->select();
    	return $data;
    }

    //获取组别
    private function getGroup($year,$term,$tableName){
    	$hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
    	$data = $hz->Distinct(true)->field(array('group'=>'gId'))->where($con)->order('gId asc')->select();
    	return $data;
    }

    //获取听课专家
    private function getDd($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('dduid,dname')->where($con)->order('dduid asc')->select();
        return $data;
    }
    
    //获取教师姓名
    private function getTeacher($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('teaid,tname')->where($con)->order('teaid asc')->select();
        return $data;
    }

    //获取教师单位
    private function getCollege($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('tcollege')->where($con)->order('tcollege asc')->select();
        return $data;
    }

    //获取上课地点
    private function getPlace($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('skplace')->where($con)->order('skplace asc')->select();
        return $data;
    }

    //获取课程名
    private function getCourse($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('cname')->where($con)->order('cname asc')->select();
        return $data;
    }

    //获取课程类别
    private function getTopic($year,$term,$tableName){
        $hz = M($tableName);
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz->Distinct(true)->field('topic')->where($con)->order('topic asc')->select();
        return $data;
    }

    //处理督导数据
    private function getHzDd($year,$term,$tableName){
        $hz_dd = M('hz_dd');
        $con['year'] = $year;
        $con['term'] = $term;
        $data = $hz_dd->where($con)->order('dname asc,tkmonth asc')->select();
        //return $data;
        $result = array();
        $len = count($data,0);
        $kk = 0;
        for ($i=0; $i < $len;) {
            $result[$kk]['dname'] = $data[$i]['dname'];
            for ($k=0; $k < 12; $k++) { 
                $result[$kk][$k] = 0;
            }
            $jj = 0;
            $sum = 0;
            for ($j=$i; $j < $len; $j++) { 
                if($data[$j]['dname'] == $data[$i]['dname']){
                    $result[$kk][$data[$j]['tkmonth']] = $data[$j]['zj'];
                    $sum += $data[$j]['zj'];
                    $jj++;
                }else{
                    break;
                }
            }
            $result[$kk]['sum'] = $sum;
            $result[$kk]['avg'] = round((float)$sum/$jj,2);
            $i += $jj;
            $kk++;
        }
        return $result;
    }
    //判断值是否存在，存在返回指定结果，不存在返回false
    private function isExist($tableName,$con,$field){
        $table = M($tableName);
        $result = $table->where($con)->getField($field);
        return $result;
    }

    //获取当前的时间
    private function getDate(){
        $date = date('Y-m-d');
        return $date;
    }

}