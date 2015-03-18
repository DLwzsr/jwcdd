<?php
// Task文件的Action类
class TaskAction extends Action {
    public function task(){
        checkLogin(); 
        //$userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con0 = array();
            $con = array();
            $course = M("Courses");
            $year = session('year');
            $term = session('term');
            $year = 2014;
            $term = '春季';
            if (!empty($_POST) && $this->isPost()) {
                if ($this->_post('yt') != -1) {
                    $yt = $this->_post('yt');
                    $term = substr($yt, -6);    //截取最后两个字符 最后两个中文的长度为6
                    $len = strlen($yt) - 6;
                    $year = substr($yt, 0, $len);
                    $con0['year'] = $year;
                    $con0['term'] = $term;
                }
                if($this->_post('tname')!=-1){
                    $tname = $this->_post('tname');
                    $con['tname'] = $tname;
                }
                if($this->_post('tcollege')!=-1){
                    $tcollege = $this->_post('tcollege');
                    $con['tcollege'] = $tcollege;
                }
                if($this->_post('scollege')!=-1){
                    $scollege = $this->_post('scollege');
                    $con['scollege'] = $scollege;
                }
                if($this->_post('sclass')!=-1){
                    $sclass = $this->_post('sclass');
                    $con['sclass'] = $sclass;
                }
            }
            else{
                $con0['year'] = $year;
                $con0['term'] = $term;
            }
            $clist=$course->where($con0)->where($con)->select();
            $this->clist=$clist;
            //dump($clist);

            $this->yt = $this->getYearTerm('Courses');
            $this->tname=$tname=$course->Distinct(true)->field('tname')->where($con0)->order('tname asc')->select();
            $this->tcollege=$tcollege=$course->Distinct(true)->field('tcollege')->order('tcollege asc')->where($con0)->select();
            $this->scollege=$scollege=$course->Distinct(true)->field('scollege')->where($con0)->order('scollege asc')->select();
            $this->sclass=$sclass=$course->Distinct(true)->field('sclass')->where($con0)->order('sclass asc')->select();
                       
            $this->year = $year;
            $this->term = $term;

            $topiclist=M("Topic");
            $topiclist=$topiclist->where($con0)->select();
            $this->topiclist=$topiclist;

            $dd=M("Dd");
            $dd=$dd->join('dd_Users on dd_Users.uid=dd_Dd.uid')->field('teaid, did, name, title, college, mobi')->where($con0)->order('CONVERT(name USING gbk) asc')->select();
            $this->dd=$dd;
            //dump($dd);

        }
        else {
            $this->error('亲~ 你不具备这样的能力哦~');
        }
        $this->display();
    }

    //获取学年学期
    private function getYearTerm($tableName){
        $hz = M($tableName);
        $data = $hz->Distinct(true)->field(array('concat(year,term)'=>'yt'))->group('year,term')->order('year desc')->select();
        return $data;
    }

    //分配本学期督导听课任务
    public function assginTask(){
        checkLogin();
        //$userid = session('userid');
        $userid = 1;
        $task = M("Tasks");
        $taskdid = $this->_post('did');
        $taskcid = $this->_post('cid');
        //dump($taskdid);
        //$taskc['tktime'] = $this->_post('tktime');
        //$taskc['topicname'] = $this->_post('topicname');
        $len1 = count($taskdid);
        $len2 = count($taskcid);
        for ($i=0; $i < $len1; $i++) { 
            for ($j=0; $j < $len2; $j++) { 
                $newtask['did'] = $taskdid[$i];
                $newtask['cid'] = $taskcid[$j];
                $newtask['check'] = 1;
                $newtask['record'] = 0;
                $newtask['tktime'] = NULL;
                $newtask['topic'] = NULL;
                $tktime = $this->_post('tktime'.$taskcid[$j]);
                if (!empty($tktime)) {
                    $newtask['tktime'] = $tktime;
                }
                if ($this->_post('topicname'.$taskcid[$j]) != -1) {
                    $newtask['topic'] = $this->_post('topicname'.$taskcid[$j]);
                }
                if ($task->data($newtask)->add()) {
                    $this->saveOperation($userid,'用户分配听课任务 [督导did'.$taskdid[$i].'课程cid'.$taskcid[$j].']');
                }else{
                    $this->error('给督导'.$taskdid[$i].'分配课程'.$taskcid[$j].'失败！');
                }   
            }
        }
        $this->redirect('Task/task');
    }

    //显示本学期督导听课任务
    //检索：课程名称cname 教师名称tname 教师单位tcollege 听课月份tkmonth 学生院系scollege
    public function showTask(){
        checkLogin(); 
        $userRole = session('userRole');    //获取用户权限
        $userid = session('userId');
        $flag = 0;
        $con = array();
        $task = M("Task_course");
        $topiclist=M("Topic");
        $dd=M("Dd");

        $this->year = $con0['year'] = 2014;
        $this->term = $con0['term'] = '春季';

        if ($userRole == 1) {
            if (!empty($_POST) && $this->isPost()) {
                if($this->_post('cname')!=-1){
                    $cname = $this->_post('cname');
                    $con['cname'] = $cname;
                }
                if($this->_post('tname')!=-1){
                    $tname = $this->_post('tname');
                    $con['tname'] = $tname;
                }
                if($this->_post('tcollege')!=-1){
                    $tcollege = $this->_post('tcollege');
                    $con['tcollege'] = $tcollege;
                }
                if($this->_post('tkmonth')!=-1){
                    $tkmonth = $this->_post('tkmonth');
                    $con['tkmonth'] = $tkmonth;
                }
                if($this->_post('scollege')!=-1){
                    $scollege = $this->_post('scollege');
                    $con['scollege'] = $scollege;
                }
                if($this->_post('dname')!=-1){
                    $dname = $this->_post('dname');
                    $con['dname'] = $dname;
                }
            }
        }
        elseif ($userRole == 2) {
            $flag = $this->_post('flag');
            if($flag == 0){ 
                $con['uid'] = $userid;
            }
            else{
                $conu['uid'] = $userid;
                $group = $dd->where($con0)->where($conu)->select();
                $con['group'] = $group[0]['group'];
            }
        }
        else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }

        $tlist=$task->where($con0)->where($con)->order('`tktime` asc, tid asc')->select();
        $this->tlist=$tlist;
                
        $this->cname=$cname=$task->Distinct(true)->field('cname')->where($con0)->order('cname asc')->select();
        $this->tname=$tname=$task->Distinct(true)->field('tname')->where($con0)->order('tname asc')->select();
        $this->tcollege=$tcollege=$task->Distinct(true)->field('tcollege')->order('tcollege asc')->where($con0)->select();
        $this->tkmonth=$tkmonth=$task->Distinct(true)->field('tkmonth')->order('tkmonth asc')->where($con0)->select();
        $this->scollege=$scollege=$task->Distinct(true)->field('scollege')->where($con0)->order('scollege asc')->select();
        $this->dname=$dname=$task->Distinct(true)->field('dname')->where($con0)->order('CONVERT(dname USING gbk) asc')->select();

        $topiclist=$topiclist->field('topicname')->Distinct(true)->select();
        $this->topiclist=$topiclist;
  
        $dd=$dd->join('dd_Users on dd_Users.uid=dd_Dd.uid')->field('teaid, did, name, title, college, mobi')->where($con)->order('CONVERT(name USING gbk) asc')->select();
            $this->dd=$dd;
        
        $this->display();
    }


    //下面三个函数用于修改督导听课任务
    public function editTaskcheck($tid=-1, $check=-1){
        checkLogin();
        $userid = session('userId');
        $userRole = session('userRole');
        if ($userRole == 1) {
            $task = M("Tasks");
            $con['tid'] = $tid;
            $data['check'] = $check;
            if($task->where($con)->data($data)->save()) {
               $this->saveOperation($userid,'用户审核通过听课任务 [tid='.$tid.']');
            }else{
                $this->error('审核听课任务失败！');
            }  
        }
        else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }
        $this->redirect('Task/showTask');  
    }

    public function taskinfo($tid){
        checkLogin();
        $task = M("Tasks");
        $task_course = M("Task_course");
        $con0['year'] = '2014';
        $con0['term'] = '春季';

        $con['tid'] = $tid;
        $task_course = $task_course->where($con)->select();
        $taskinfo = $task_course[0];

        if ($taskinfo['record'] == 1) {
            $this->error('该听课任务已完成，不能修改！');
        }
        $this->taskinfo = $taskinfo;

        $topiclist = M("Topic");
        $topiclist = $topiclist->select();
        $this->topiclist = $topiclist;

        $dd=M("Dd");
        $dd=$dd->join('dd_Users on dd_Users.uid=dd_Dd.uid')->field('teaid, did, name, title, college, mobi')->where($con0)->order('CONVERT(name USING gbk) asc')->select();
        $this->dd=$dd;

        $this->display();
    }

    public function editTask(){
        checkLogin();
        $userRole = session('userRole');
        $userid = session('userId');

        $task = M("Tasks");
        $con['tid'] = $this->_post('tid');
        $data['tktime'] = $this->_post('tktime');
        $data['topic'] = $this->_post('topic');
        $data['did'] = $this->_post('did');
        $data['check'] = $this->_post('check');

        if($userRole == 1){
            $task->data($data)->where($con)->save();
            if ($task->where($con)->data($data)->save()) {
                $this->saveOperation($userid,'用户修改听课任务 [tid='.$tid.']');
            }else{
                $this->error('修改听课任务失败！');
            }
        }
        else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }
        $this->redirect("Task/showTask");
    }
    
    /*  
    public function editTasktopic($tid=-1, $topic=-1){
        //$userid = session('userid');
        $userid = 1;
        $task = M("Tasks");
        $con['tid'] = $tid;
        $data['topic'] = $topic;
        if ($task->where($con)->data($data)->save()) {
            $this->saveOperation($userid,'用户修改任务的听课专题 [tid='.$tid.']');
        }else{
            $this->error('修改听课专题失败！');
        }
        $this->redirect('Task/showTask');
    }

    public function editTaskdd($tid=-1, $did=-1){
        //$userid = session('userid');
        $userid = 1;
        $task = M("Tasks");
        $con['tid'] = $tid;
        $data['did'] = $did;
        if($task->where($con)->data($data)->save()) {
            $this->saveOperation($userid,'用户修改听课督导 [tid='.$tid.']');
        }else{
            $this->error('修改听课督导失败！');
        }
        $this->redirect('Task/showTask');
    }

        public function editTasktime(){
        $task = M("Tasks");
        $tid = $this->_post('tid');
        $tktime = $this->_post('tktime');
        $con['tid'] = $tid;
        $data['tktime'] = $tktime;
        header('Content-Type:application/json; charset=utf-8');
        if($task->where($con)->save($data)){
            $json = array("code"=>1,"message"=>"修改听课时间成功");
        }else{
            $json = array("code"=>0,"message"=>"修改听课时间失败");
        }
        exit(json_encode($json));
    }

    */


    //删除听课任务记录
    public function delTask($tid=-1){
        checkLogin();
        $userid = session('userId');
        $userRole = session('userRole');
        if ($userRole == 1) {
            $deltask = M("Tasks");
            $con['tid'] = $tid;
            $task = $deltask->where($con)->field('did, cid')->select();
            if ($deltask->where($con)->delete()){
                $this->saveOperation($userid,'用户删除听课任务 [督导did'.$task[0]['did'].'课程cid'.$task[0]['cid'].']');
            }else{
                $this->error('删除听课任务记录失败！');
            }
            $this->redirect("Task/showTask");
        }else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }   
    } 

    //填写听课记录
    public function addRecordT($tid){
        checkLogin();
        $userRole = session("userRole");
        $userid = session("userId");
        $task_course= M("task_course");
        $record_add = M("record_add");
 
        if ($userRole == '1'|'2'){
            $con['tid'] = $tid;//查看是否已经有这一听课记录
            $task_course = $task_course->where($con)->select();

            if($task_course[0]['record'] == '0'){//如果记录不存在
                $con0['cid'] = $task_course[0]['cid'];//通过cid找到课程信息
                $data_course = $record_add->where($con0)->select();
                $this->data_course=$data_course[0];
                $this->task_course=$task_course[0];
                $this->display();
            }
        }
    }

    //修改听课记录
    public function editRecordT($tid){
        checkLogin();
        $userRole = session('userRole');    //获取用户权限
        $userid = session('userId');
        if ($userRole <= 2 ){
            $record = M('records');
            $course = M('record_add');

            $con1['tid'] = $tid;
            $data_record = $record->where($con1)->select();//从记录表中找到记录信息
            $this->record=$data_record[0];
            
            $con2['courseid'] = $data_record[0]['courseid'];
            $data_course = $course->where($con2)->select();//从视图中找到课程信息

            $this->course=$data_course[0];
        }
        else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }
        $this->display();
    }

    //保存听课记录
    public function saveRecordT(){
        checkLogin();     
        $userRole = session('userRole');
        $userid = session('userId');
        $record = M("records");//record表
        $task_course = M("task_course");//task视图
        $task = M("tasks");//task表
        $tid = $this->_post('tid');//获取该条记录的tid
        $con['tid'] = $tid;
        $con0['uid'] = $userid;
        $data_course = $task_course->where($con)->select();//找到tid这门课

        $data['tid'] = $tid;
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
        $data['tkjs'] = $this->_post('tkjs'); //听课节数-这里要做两个框-开始节次，结束节次
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

        $uid = $data_course[0]['uid'];
        $r = $record->where($con)->select();//找tid的记录
        if ($userRole == 1) {
            if($r == NULL){//如果没有这个任务的记录
                $newrid = $record->data($data)->add();
                $data0['record'] = 1;
                $task->data($data0)->where($con)->save();
                if($newrid){//记录新增操作
                    $this->saveOperation($userid,'新增一项听课记录 [rid='.$newrid.']');
                }
                else{
                    $this->error('新增听课记录失败!');
                }
            }else{
                $this->error('该记录已填写');//这其实没用
            }
        }
        if ($userRole == 2) {
            if ($uid == $userid) {//当前用户是督导本人
                //保存听课记录
                $newrid = $record->data($data)->add();
                if($newrid){//记录新增操作
                    $this->saveOperation($userid,'新增一项听课记录 [rid='.$newrid.']');
                }else{
                $this->error('新增听课记录失败!');
                }
                $data0['record'] = 1;
                $task->data($data0)->where($con)->save();
            }else{ //如果不是督导本人，增加一个任务
                $dd = M("Dd");
                $dd = $dd->where($con0)->select();
                $did = $dd[0]['did'];
                $task = M("Tasks");
                $newtask['did'] = $did;
                $newtask['cid'] = $data_course[0]['cid'];
                $newtask['tktime'] = $this->_post('tktime');
                $newtask['topic'] = NULL;
                $newtask['check'] = '0';
                $newtask['record'] = '1';
                $newtid = $task->data($newtask)->add();

                $data['tid'] = $newtid;
                $newrid = $record->data($data)->add();
                if($newrid){//记录新增操作
                    $this->saveOperation($userid,'新增一项听课记录 [rid='.$newrid.']');
                }else{
                $this->error('新增听课记录失败!');
                }
            }
        }
        $this->redirect("Task/showTask");//跳转待定
    }

    //保存编辑听课记录
    public function saveEditRecordT(){
        checkLogin();
        $record = M("records");//记录表
        $userid = session('userId');
        //$con['rid'] = $rid;
        $con['rid'] = $this->_post('rid');

        $data['content'] = $this->_post('content');//听课内容
        $data['tktime'] = $this->_post('tktime');//听课时间
        $data['tkjs'] = $this->_post('tkjs'); //听课节数

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
        
        $edit = $record->data($data)->where($con)->save();
        if ($edit){
            $this->saveOperation($userid,'修改听课记录 [rid='.$con['rid'].']');
        }else{
            $this->error('没有修改听课记录！');
        }
        $this->redirect("Task/showTask");//跳转待定
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