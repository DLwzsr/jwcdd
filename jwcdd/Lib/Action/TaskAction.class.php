<?php
// Task文件的Action类
class TaskAction extends Action {
    public function task(){
		$this->display();
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
    	$task = M("Tasks");
    	$con['tid'] = $tid;
    	$data['topic'] = $topic;
    	$task->where($con)->data($data)->save();
    	$this->redirect('Task/showTask');
    }
    public function editTaskcheck($tid=-1, $check=-1){
        $task = M("Tasks");
        $con['tid'] = $tid;
        $data['check'] = $check;
        $task->where($con)->data($data)->save();
        $this->redirect('Task/showTask');
    }
    public function editTaskdd($tid=-1, $did=-1){
        $task = M("Tasks");
        $con['tid'] = $tid;
        $data['did'] = $did;
        $task->where($con)->data($data)->save();
        $this->redirect('Task/showTask');
    }

    //删除听课任务记录
    public function deltask($tid=-1){
        checkLogin();
        $deltask = M("Tasks");
        $con['tid'] = $tid;
        $deltask->where($con)->delete();
        $this->redirect("Task/showTask");
    } 
}