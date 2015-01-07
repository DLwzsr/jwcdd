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
            $term = '秋季';
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
        //$userRole = session('userRole');    //获取用户权限
        $userRole = 1;
        if ($userRole == 1) {
            $con = array();
            $task = M("Task_course");
            $this->year = $con0['year'] = 2014;
            $this->term = $con0['term'] = '秋季';
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
            }
            $tlist=$task->where($con0)->where($con)->order('`tktime` asc, tid asc')->select();
            $this->tlist=$tlist;
                
            $this->cname=$cname=$task->Distinct(true)->field('cname')->where($con0)->order('cname asc')->select();
            $this->tname=$tname=$task->Distinct(true)->field('tname')->where($con0)->order('tname asc')->select();
            $this->tcollege=$tcollege=$task->Distinct(true)->field('tcollege')->order('tcollege asc')->where($con0)->select();
            $this->tkmonth=$tkmonth=$task->Distinct(true)->field('tkmonth')->order('tkmonth asc')->where($con0)->select();
            $this->scollege=$scollege=$task->Distinct(true)->field('scollege')->where($con0)->order('scollege asc')->select();

            $topiclist=M("Topic");
            $topiclist=$topiclist->field('topicname')->Distinct(true)->select();
            $this->topiclist=$topiclist;

            $dd=M("Dd");
            $dd=$dd->join('dd_Users on dd_Users.uid=dd_Dd.uid')->field('teaid, did, name, title, college, mobi')->where($con)->order('CONVERT(name USING gbk) asc')->select();
            $this->dd=$dd;
        }
        else{
            $this->error('亲~ 你不具备这样的能力哦~');
        }
        $this->display();
    }

    //修改督导听课任务
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
    public function editTaskcheck($tid=-1, $check=-1){
        //$userid = session('userid');
        $userid = 1;
        $task = M("Tasks");
        $con['tid'] = $tid;
        $data['check'] = $check;
        if($task->where($con)->data($data)->save()) {
           $this->saveOperation($userid,'用户审核通过听课任务 [tid='.$tid.']');
        }else{
            $this->error('审核听课任务失败！');
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

    //删除听课任务记录
    public function deltask($tid=-1){
        checkLogin();
        //$userid = session('userid');
        $userid = 1;
        $deltask = M("Tasks");
        $con['tid'] = $tid;
        $task = $deltask->where($con)->field('did, cid')->select();
        if ($deltask->where($con)->delete()){
            $this->saveOperation($userid,'用户删除听课任务 [督导did'.$task[0]['did'].'课程cid'.$task[0]['cid'].']');
        }else{
            $this->error('删除听课任务记录失败！');
        }
        $this->redirect("Task/showTask");
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