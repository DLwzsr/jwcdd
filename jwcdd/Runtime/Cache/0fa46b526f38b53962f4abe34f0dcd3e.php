<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>本科教学督导工作平台-教务处</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="本科教学督导工作平台 北京师范大学">
    <meta name="author" content="信息科学与技术学院 大数据与物联网实验室 北京师范大学">
    <!--[if lt IE 9]>
    <script src='/jwcdd/Public/assets/javascripts/html5shiv.js' type='text/javascript'></script>
    <![endif]-->
    <link href='/jwcdd/Public/assets/stylesheets/bootstrap/bootstrap.css' media='all' rel='stylesheet' type='text/css' />
    <link href='/jwcdd/Public/assets/stylesheets/bootstrap/bootstrap-responsive.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jquery ui -->
    <link href='/jwcdd/Public/assets/stylesheets/jquery_ui/jquery-ui-1.10.0.custom.css' media='all' rel='stylesheet' type='text/css' />
    <link href='/jwcdd/Public/assets/stylesheets/jquery_ui/jquery.ui.1.10.0.ie.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / switch buttons -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/bootstrap_switch/bootstrap-switch.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / xeditable -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/xeditable/bootstrap-editable.css' media='all' rel='stylesheet' type='text/css' />
    <link href='/jwcdd/Public/assets/stylesheets/plugins/common/bootstrap-wysihtml5.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / wysihtml5 (wysywig) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/common/bootstrap-wysihtml5.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jquery file upload -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/jquery_fileupload/jquery.fileupload-ui.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / full calendar -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/fullcalendar/fullcalendar.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / select2 -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/select2/select2.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / mention -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/mention/mention.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / tabdrop (responsive tabs) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/tabdrop/tabdrop.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jgrowl notifications -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/jgrowl/jquery.jgrowl.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / datatables -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/datatables/bootstrap-datatable.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / dynatrees (file trees) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/dynatree/ui.dynatree.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / color picker -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/bootstrap_colorpicker/bootstrap-colorpicker.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / datetime picker -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.min.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / daterange picker) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / flags (country flags) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/flags/flags.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / slider nav (address book) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/slider_nav/slidernav.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / fuelux (wizard) -->
    <link href='/jwcdd/Public/assets/stylesheets/plugins/fuelux/wizard.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / flatty theme -->
    <link href='/jwcdd/Public/assets/stylesheets/light-theme.css' id='color-settings-body-color' media='all' rel='stylesheet' type='text/css' />
    <!-- / demo -->
    <link href='/jwcdd/Public/assets/stylesheets/demo.css' media='all' rel='stylesheet' type='text/css' />
    <!-- / jquery -->
    <script src='/jwcdd/Public/assets/javascripts/jquery/jquery.min.js' type='text/javascript'></script>
    <script src='/jwcdd/Public/js/myfun.js' type='text/javascript'></script>
</head>
<body class='contrast-red fixed-header fixed-navigation'>
<header>
    <div class='navbar navbar-fixed-top'>
        <div class='navbar-inner'>
            <div class='container-fluid'>
                <a class='brand' href='index.html'>
                    <i class='icon-heart-empty'></i>
                    <span class='hidden-phone'>本科教学督导工作平台</span>
                </a>
                <!--a class='toggle-nav btn pull-left' href='#'>
                    <i class='icon-reorder'></i>
                </a-->
                <ul class='nav pull-right'>
                    <!--li class='dropdown light only-icon'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <i class='icon-adjust'></i>
                        </a>
                        <ul class='dropdown-menu color-settings'>
                            <li class='color-settings-body-color'>
                                <div class='color-title'>Body color</div>
                                <a data-change-to='/jwcdd/Public/assets/stylesheets/light-theme.css' href='#'>
                                    Light
                                    <small>(default)</small>
                                </a>
                                <a data-change-to='/jwcdd/Public/assets/stylesheets/dark-theme.css' href='#'>
                                    Dark
                                </a>
                                <a data-change-to='/jwcdd/Public/assets/stylesheets/dark-blue-theme.css' href='#'>
                                    Dark blue
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li class='color-settings-contrast-color'>
                                <div class='color-title'>Contrast color</div>
                                <a href="#" data-change-to="contrast-red"><i class='icon-adjust text-red'></i>
                                    Red
                                    <small>(default)</small>
                                </a>
                                <a href="#" data-change-to="contrast-blue"><i class='icon-adjust text-blue'></i>
                                    Blue
                                </a>
                                <a href="#" data-change-to="contrast-orange"><i class='icon-adjust text-orange'></i>
                                    Orange
                                </a>
                                <a href="#" data-change-to="contrast-purple"><i class='icon-adjust text-purple'></i>
                                    Purple
                                </a>
                                <a href="#" data-change-to="contrast-green"><i class='icon-adjust text-green'></i>
                                    Green
                                </a>
                                <a href="#" data-change-to="contrast-muted"><i class='icon-adjust text-muted'></i>
                                    Muted
                                </a>
                                <a href="#" data-change-to="contrast-fb"><i class='icon-adjust text-fb'></i>
                                    Facebook
                                </a>
                                <a href="#" data-change-to="contrast-dark"><i class='icon-adjust text-dark'></i>
                                    Dark
                                </a>
                                <a href="#" data-change-to="contrast-pink"><i class='icon-adjust text-pink'></i>
                                    Pink
                                </a>
                                <a href="#" data-change-to="contrast-grass-green"><i class='icon-adjust text-grass-green'></i>
                                    Grass green
                                </a>
                                <a href="#" data-change-to="contrast-sea-blue"><i class='icon-adjust text-sea-blue'></i>
                                    Sea blue
                                </a>
                                <a href="#" data-change-to="contrast-banana"><i class='icon-adjust text-banana'></i>
                                    Banana
                                </a>
                                <a href="#" data-change-to="contrast-dark-orange"><i class='icon-adjust text-dark-orange'></i>
                                    Dark orange
                                </a>
                                <a href="#" data-change-to="contrast-brown"><i class='icon-adjust text-brown'></i>
                                    Brown
                                </a>
                            </li>
                        </ul>
                    </li-->
                    <li class='dropdown medium only-icon widget'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <i class='icon-rss'>提醒</i>
                            <span class='label'>5</span>
                        </a>
                        <ul class='dropdown-menu'>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-info'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            [2014-09-08] 宏观经济学
                                            <small class='muted'>教九401</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-info'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            [2014-09-08] 国际金融
                                            <small class='muted'>教八314</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-info'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            [2014-09-08] 政治经济学
                                            <small class='muted'>教七201</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-info'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            [2014-09-08] 理论力学
                                            <small class='muted'>教十212</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='#'>
                                    <div class='widget-body'>
                                        <div class='pull-left icon'>
                                            <i class='icon-comment text-info'></i>
                                        </div>
                                        <div class='pull-left text'>
                                            [2014-09-08] 有机化学
                                            <small class='muted'>教九101</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!--li class='widget-footer'>
                                <a href='#'>All notifications</a>
                            </li-->
                        </ul>
                    </li>
                    <li class='dropdown dark user-menu'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                            <img alt='Mila Kunis' height='23' src='/jwcdd/Public/assets/images/admin.ico' width='23' />
                            <span class='user-name hidden-phone'>管理员</span>
                            <b class='caret'></b>
                        </a>
                        <ul class='dropdown-menu'>
                            <li>
                                <a href='<?php echo U('User/user_profile');?>'>
                                    <i class='icon-user'></i>
                                    个人信息
                                </a>
                            </li>
                            <li>
                                <a href='<?php echo U('User/user_modify');?>'>
                                    <i class='icon-cog'></i>
                                    修改
                                </a>
                            </li>
                            <li class='divider'></li>
                            <li>
                                <a href='<?php echo U('Login/logout');?>'>
                                    <i class='icon-signout'></i>
                                    退出
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!--form accept-charset="UTF-8" action="search_results.html" class="navbar-search pull-right hidden-phone" method="get" /><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /></div>
                    <button class="btn btn-link icon-search" name="button" type="submit"></button>
                    <input autocomplete="off" class="search-query span2" id="q_header" name="q" placeholder="搜索..." type="text" value="" />
                </form-->
            </div>
        </div>
    </div>
</header>
<div id='wrapper'>
<div id='main-nav-bg'></div>
<nav class='main-nav-fixed' id='main-nav'>
<div class='navigation'>
<ul class='nav nav-stacked'>
<!--li class='active'>
    <a href='index.html'>
        <i class='icon-exclamation-sign'></i>
        <span>通知</span>
    </a>
</li-->
<li id="umanager">
    <a class='dropdown-collapse' href='#'>
        <i class='icon-user'></i>
        <span>人员管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li id="user">
            <a href='<?php echo U('User/user');?>'>
                <i class='icon-caret-right'></i>
                <span>系统用户</span>
            </a>
        </li>
        <li id="user_dd">
            <a href='<?php echo U('User/user_dd');?>'>
                <i class='icon-caret-right'></i>
                <span>督导用户</span>
            </a>
        </li>
    </ul>
</li>
<li id="tmanager">
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-tasks'></i>
        <span>听课任务管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li id="task">
            <a href='<?php echo U('Task/task');?>'>
                <i class='icon-caret-right'></i>
                <span>分配</span>
            </a>
        </li>
        <li id="showTask">
            <a href='<?php echo U('Task/showTask');?>'>
                <i class='icon-caret-right'></i>
                <span>查看</span>
            </a>
        </li>
    </ul>
</li>
<li id="rmanager">
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-edit'></i>
        <span>听课记录</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li id="record">
            <a href='<?php echo U('Record/record');?>'>
                <i class='icon-caret-right'></i>
                <span>填写</span>
            </a>
        </li>
        <li id="showRecord">
            <a href='<?php echo U('Record/showRecord');?>'>
                <i class='icon-caret-right'></i>
                <span>查看</span>
            </a>
        </li>
    </ul>
</li>
<li id="smanager">
    <a class='dropdown-collapse' href='#'>
        <i class='icon-table'></i>
        <span>数据报表</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li id="analysis">
            <a href='<?php echo U('Analysis/analysis');?>'>
                <i class='icon-caret-right'></i>
                <span>数据检索</span>
            </a>
        </li>
        <li id="department">
            <a href='<?php echo U('Analysis/department');?>'>
                <i class='icon-caret-right'></i>
                <span>按院系统计</span>
            </a>
        </li>
        <li id="month">
            <a href='<?php echo U('Analysis/month');?>'>
                <i class='icon-caret-right'></i>
                <span>按院系月份统计</span>
            </a>
        </li>
        <li id="supervisor">
            <a href='<?php echo U('Analysis/supervisor');?>'>
                <i class='icon-caret-right'></i>
                <span>按督导统计</span>
            </a>
        </li>
        <li id="teacher">
            <a href='<?php echo U('Analysis/teacher');?>'>
                <i class='icon-caret-right'></i>
                <span>按教师职称统计</span>
            </a>
        </li>
        <li id="course">
            <a href='<?php echo U('Analysis/course');?>'>
                <i class='icon-caret-right'></i>
                <span>按课程名统计</span>
            </a>
        </li>
    </ul>
</li>
</ul>
</div>
</nav>
<section id='content'>
<div class='container-fluid'>
<div class='row-fluid' id='content-wrapper'>
<div class='span12'>
<div class='row-fluid'>
    <div class='span12'>
        <div class='page-header'>
            <h1 class='pull-left'>
                <i class='icon-table'></i><span>数据报表</span></h1>
            <div class='pull-right'>
                <button class="btn btn-primary" id="cos" name="button" style="margin-bottom:5px">关闭检索</button>
            </div>
            <div class='pull-right'>
                <ul class='breadcrumb'>
                    <li>
                        <a href="index.html"><i class='icon-bar-chart'></i>
                        </a>
                    </li>
                    <li class='separator'>
                        <i class='icon-angle-right'></i>
                    </li>
                    <li class='active'>数据检索</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!--课程名称、学生院系、年级、课程类别 -->
<div id="search">
<form method="post" action="<?php echo U('Analysis/analysis');?>">
<div class='row-fluid'>
<div class='span3'>
    <div class='row-fluid'>
        <strong>学年学期</strong>
        <select class='select2 input-block-level' name="yt" id="yterm">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($yt)): $i = 0; $__LIST__ = $yt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["yt"]); ?>"><?php echo ($vo["yt"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>组别</strong>
        <select class='select2 input-block-level' name="group">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["gId"]); ?>"><?php echo ($vo["gId"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>月份</strong>
        <div id="mon1">
            <select class='select2 input-block-level' name="month">
                <option value='-1' selected="selected"/>------请选择------
                <option value='2' />2
                <option value='3' />3
                <option value='4' />4
                <option value='5' />5
                <option value='6' />6
                <option value='7' />7
            </select>
        </div>
        <div id="mon2">
            <select class="select2 input-block-level" name="month">
                <option value='-1' selected="selected"/>------请选择------
                <option value='8' />8
                <option value='9' />9
                <option value='10' />10
                <option value='11' />11
                <option value='12' />12
                <option value='1' />1
            </select>
        </div>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>总体评价</strong>
        <select class='select2 input-block-level' name="ztpj">
            <option value='-1' selected="selected"/>------请选择------
            <option value='5' />好
            <option value='4' />较好
            <option value='3' />一般
            <option value='2' />较差
            <option value='1' />差
            <option value='0' />未评价
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>听课专家</strong>
        <select class='select2 input-block-level' name="dd">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($dd)): $i = 0; $__LIST__ = $dd;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["dduid"]); ?>"><?php echo ($vo["dname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
</div>

<div class='row-fluid' style="margin-top:10px; margin-bottom:2px;">
<div class='span2'>
    <div class='row-fluid'>
        <strong>教师名称</strong>
        <select class='select2 input-block-level' name="teacher">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($tea)): $i = 0; $__LIST__ = $tea;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["teaid"]); ?>"><?php echo ($vo["tname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>教师职称</strong>
        <select class='select2 input-block-level' name="title">
            <option value='-1' selected="selected"/>------请选择------
            <option value='教授' />教授
            <option value='副教授' />副教授
            <option value='讲师' />讲师
            <option value='高级工程师' />高级工程师
            <option value='工程师' />工程师
        </select>
    </div>
</div>
<div class='span4'>
    <div class='row-fluid'>
        <strong>教师单位</strong>
        <select class='select2 input-block-level' name="tcollege">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($college)): $i = 0; $__LIST__ = $college;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["tcollege"]); ?>"><?php echo ($vo["tcollege"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>上课地点</strong>
        <select class='select2 input-block-level' name="skplace">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($place)): $i = 0; $__LIST__ = $place;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["skplace"]); ?>"><?php echo ($vo["skplace"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
</div>

<div class='row-fluid' style="margin-top:10px; margin-bottom:2px;">
<div class='span2'>
    <div class='row-fluid'>
        <strong>课程名称</strong>
        <select class='select2 input-block-level' name="course">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($course)): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["cname"]); ?>"><?php echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>课程类别</strong>
        <select class='select2 input-block-level' name="topic">
            <option value='-1' selected="selected"/>------请选择------
        <?php if(is_array($topic)): $i = 0; $__LIST__ = $topic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["topic"]); ?>"><?php echo ($vo["topic"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
</div>
<div class='span4'>
    <div class='row-fluid'>
        <strong>学生院系</strong>
        <select class='select2 input-block-level' name="scollege">
            <option value='-1' selected="selected"/>------请选择------
            <option value='AK' />经济与工商管理学院
            <option value='HI' />信息科学与技术学院
            <option value='CA' />物理学系
            <option value='NV' />数学系
            <option value='OR' />化学学院
            <option value='WA' />天文系
        </select>
    </div>
</div>
<div class='span2'>
    <div class='row-fluid'>
        <strong>年级</strong>
        <select class='select2 input-block-level' name="grade">
            <option value='-1' selected="selected"/>------请选择------
            <option value='AK' />2014级
            <option value='HI' />2013级
            <option value='CA' />2012级
            <option value='NV' />2011级
        </select>
    </div>
</div>
<button class="btn btn-defalut pull-right" style="margin:17px 0px 0px 0px;" type="submit">检索 | Search</button>
</div>
</form>
</div>
<div class='row-fluid'>
<div class='span12 box bordered-box green-border' style='margin-bottom:0;'>
<div class='box-header green-background'>
    <div class='text-center'><?php echo ($title); ?>&nbsp;&nbsp;督导听课汇总表</div>
    <a class='btn btn-success btn-large' style='position:absolute; left:0px;top:2px;' data-toggle='modal' href='#addGroup' role='button'>
        <i class='icon-share'>&nbsp;&nbsp;<strong>导入</strong></i>
    </a>
    <!--button class='btn btn-success ' name='button' style='position:absolute; left:0px;top:2px;'><i class='icon-share'>&nbsp;&nbsp;导入</i></button-->
</div>
<div class='box-content box-no-padding'>
<div class='responsive-table'>
<div class='scrollable-area'>
<table class='data-table table table-bordered table-striped' style='margin-bottom:0;'>
<thead>
<tr>
          <td><b>序号</b></td>
          <td><b>组别</b></td>
          <td><b>听课月份</b></td>
          <td><b>教师姓名</b></td>
          <td><b>教师职称</b></td>
          <td><b>教师单位</b></td>
          <td><b>课程名称</b></td>
          <td><b>学生院系</b></td>
          <td><b>年级</b></td>
          <td><b>上课时间</b></td>
          <td><b>上课地点</b></td>
          <td><b>听课节数</b></td>
          <td><b>绪论课（导航课）评价</b></td>
          <td><b>助教工作情况</b></td>
          <td><b>对课堂教学的具体评价</b></td>
          <td><b>总体评价</b></td>
          <td><b>对学生学习的建议</b></td>
          <td><b>对教学环境的评价</b></td>
          <td><b>课程类别</b></td>
          <td><b>听课专家</b></td>
</tr>
</thead>
<tbody>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
        <td><?php echo ($vo["rid"]); ?></td>
        <td><?php echo ($vo["group"]); ?></td>
        <td><?php echo ($vo["term"]); ?></td>
        <td><?php echo ($vo["tname"]); ?></td>
        <td><?php echo ($vo["title"]); ?></td>
        <td><?php echo ($vo["tcollege"]); ?></td>
        <td><?php echo ($vo["cname"]); ?></td>
        <td><?php echo ($vo["sclass"]); ?></td>
        <td><?php echo ($vo["sclass"]); ?></td>
        <td><?php echo ($vo["sktime"]); ?></td>
        <td><?php echo ($vo["skplace"]); ?></td>
        <td><?php echo ($vo["tkjs"]); ?></td>
        <td><?php echo ($vo["xlkpj"]); ?></td>
        <td><?php echo ($vo["zjgz"]); ?></td>
        <td><?php echo ($vo["pjjy"]); ?></td>
        <td>
        <?php if($vo["ztpj"] == 5): ?>好
        <?php elseif($vo["ztpj"] == 4): ?>较好
        <?php elseif($vo["ztpj"] == 3): ?>一般
        <?php elseif($vo["ztpj"] == 2): ?>较差
        <?php elseif($vo["ztpj"] == 1): ?>差
        <?php else: ?>未评价<?php endif; ?>
            </td>
        <td><?php echo ($vo["xsjy"]); ?></td>
        <td><?php echo ($vo["hjjy"]); ?></td>
        <td><?php echo ($vo["topic"]); ?></td>
        <td><?php echo ($vo["dname"]); ?></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<hr class='hr-double' />
<div class='modal hide fade' id='addGroup' role='dialog' tabindex='-1'>
    <div class='modal-header'>
        <button class='close' data-dismiss='modal' type='button'>&times;</button>
        <h3>文件导入——听课汇总表</h3>
    </div> 
    <form class='form form-horizontal' style='margin-bottom: 0;' enctype="multipart/form-data" method="post" action="<?php echo U('Analysis/importDd');?>">
        <div class='modal-body'>
                <div class='control-group'>
                    <label class='control-label'>请选择督导听课汇总表</label>
                    <div class='controls'>
                        <input class='input-large' type='file' name="file1" />
                    </div>
                </div>
            
        </div>
        <div class='modal-footer'>
            <button class='btn btn-primary' type="submit">导入</button>
            <button class='btn' data-dismiss='modal'>关闭</button>
        </div>
    </form>
</div>
</section>
<script type="text/javascript">
    
    $(document).ready(function(){
        var term = '<?php echo ($term); ?>';
        var vSearch = false;
        if (term == '春季'){
            $('#mon2').css('display','none');
        }else{
            $('#mon1').css('display','none'); 
        };
        $('#smanager').nav_slide('smanager','analysis');
        $('#cos').click(function(){
            vSearch = !vSearch;
            if (vSearch) {
                $('#search').css('display','none');
                $(this).html('打开搜索');
            }else{
                $('#search').css('display','block');
                $(this).html('关闭搜索');
            }
        });
        $('#yterm').change(function(){
            var option = $(this).val();
            var a = '春季';
            var b = '秋季';
            if(option.indexOf(a) >= 0){ //寻找春季
                $('#mon2').css('display','none');
                $('#mon1').css('display','block');
            }else if(option.indexOf(b) >= 0){   //寻找秋季
                $('#mon1').css('display','none');
                $('#mon2').css('display','block');
            }else{};
        });
        
    });
</script>
</div>
<!-- / jquery mobile events (for touch and slide) -->
<script src='/jwcdd/Public/assets/javascripts/plugins/mobile_events/jquery.mobile-events.min.js' type='text/javascript'></script>
<!-- / jquery migrate (for compatibility with new jquery) -->
<script src='/jwcdd/Public/assets/javascripts/jquery/jquery-migrate.min.js' type='text/javascript'></script>
<!-- / jquery ui -->
<script src='/jwcdd/Public/assets/javascripts/jquery_ui/jquery-ui.min.js' type='text/javascript'></script>
<!-- / bootstrap -->
<script src='/jwcdd/Public/assets/javascripts/bootstrap/bootstrap.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/flot/excanvas.js' type='text/javascript'></script>
<!-- / sparklines -->
<script src='/jwcdd/Public/assets/javascripts/plugins/sparklines/jquery.sparkline.min.js' type='text/javascript'></script>
<!-- / flot charts -->
<script src='/jwcdd/Public/assets/javascripts/plugins/flot/flot.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/flot/flot.resize.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/flot/flot.pie.js' type='text/javascript'></script>
<!-- / bootstrap switch -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_switch/bootstrapSwitch.min.js' type='text/javascript'></script>
<!-- / fullcalendar -->
<script src='/jwcdd/Public/assets/javascripts/plugins/fullcalendar/fullcalendar.min.js' type='text/javascript'></script>
<!-- / datatables -->
<script src='/jwcdd/Public/assets/javascripts/plugins/datatables/jquery.dataTables.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/datatables/jquery.dataTables.columnFilter.js' type='text/javascript'></script>
<!-- / wysihtml5 -->
<script src='/jwcdd/Public/assets/javascripts/plugins/common/wysihtml5.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/common/bootstrap-wysihtml5.js' type='text/javascript'></script>
<!-- / select2 -->
<script src='/jwcdd/Public/assets/javascripts/plugins/select2/select2.js' type='text/javascript'></script>
<!-- / color picker -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_colorpicker/bootstrap-colorpicker.min.js' type='text/javascript'></script>
<!-- / mention -->
<script src='/jwcdd/Public/assets/javascripts/plugins/mention/mention.min.js' type='text/javascript'></script>
<!-- / input mask -->
<script src='/jwcdd/Public/assets/javascripts/plugins/input_mask/bootstrap-inputmask.min.js' type='text/javascript'></script>
<!-- / fileinput -->
<script src='/jwcdd/Public/assets/javascripts/plugins/fileinput/bootstrap-fileinput.js' type='text/javascript'></script>
<!-- / modernizr -->
<script src='/jwcdd/Public/assets/javascripts/plugins/modernizr/modernizr.min.js' type='text/javascript'></script>
<!-- / retina -->
<script src='/jwcdd/Public/assets/javascripts/plugins/retina/retina.js' type='text/javascript'></script>
<!-- / fileupload -->
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/tmpl.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/load-image.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/canvas-to-blob.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/jquery.iframe-transport.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/jquery.fileupload.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/jquery.fileupload-fp.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/jquery.fileupload-ui.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/fileupload/jquery.fileupload-init.js' type='text/javascript'></script>
<!-- / timeago -->
<script src='/jwcdd/Public/assets/javascripts/plugins/timeago/jquery.timeago.js' type='text/javascript'></script>
<!-- / slimscroll -->
<script src='/jwcdd/Public/assets/javascripts/plugins/slimscroll/jquery.slimscroll.min.js' type='text/javascript'></script>
<!-- / autosize (for textareas) -->
<script src='/jwcdd/Public/assets/javascripts/plugins/autosize/jquery.autosize-min.js' type='text/javascript'></script>
<!-- / charCount -->
<script src='/jwcdd/Public/assets/javascripts/plugins/charCount/charCount.js' type='text/javascript'></script>
<!-- / validate -->
<script src='/jwcdd/Public/assets/javascripts/plugins/validate/jquery.validate.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/validate/additional-methods.js' type='text/javascript'></script>
<!-- / naked password -->
<script src='/jwcdd/Public/assets/javascripts/plugins/naked_password/naked_password-0.2.4.min.js' type='text/javascript'></script>
<!-- / nestable -->
<script src='/jwcdd/Public/assets/javascripts/plugins/nestable/jquery.nestable.js' type='text/javascript'></script>
<!-- / tabdrop -->
<script src='/jwcdd/Public/assets/javascripts/plugins/tabdrop/bootstrap-tabdrop.js' type='text/javascript'></script>
<!-- / jgrowl -->
<script src='/jwcdd/Public/assets/javascripts/plugins/jgrowl/jquery.jgrowl.min.js' type='text/javascript'></script>
<!-- / bootbox -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootbox/bootbox.min.js' type='text/javascript'></script>
<!-- / inplace editing -->
<script src='/jwcdd/Public/assets/javascripts/plugins/xeditable/bootstrap-editable.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/xeditable/wysihtml5.js' type='text/javascript'></script>
<!-- / ckeditor -->
<script src='/jwcdd/Public/assets/javascripts/plugins/ckeditor/ckeditor.js' type='text/javascript'></script>
<!-- / filetrees -->
<script src='/jwcdd/Public/assets/javascripts/plugins/dynatree/jquery.dynatree.min.js' type='text/javascript'></script>
<!-- / datetime picker -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_datetimepicker/bootstrap-datetimepicker.js' type='text/javascript'></script>
<!-- / daterange picker -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_daterangepicker/moment.min.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_daterangepicker/bootstrap-daterangepicker.js' type='text/javascript'></script>
<!-- / max length -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_maxlength/bootstrap-maxlength.min.js' type='text/javascript'></script>
<!-- / dropdown hover -->
<script src='/jwcdd/Public/assets/javascripts/plugins/bootstrap_hover_dropdown/twitter-bootstrap-hover-dropdown.min.js' type='text/javascript'></script>
<!-- / slider nav (address book) -->
<script src='/jwcdd/Public/assets/javascripts/plugins/slider_nav/slidernav-min.js' type='text/javascript'></script>
<!-- / fuelux -->
<script src='/jwcdd/Public/assets/javascripts/plugins/fuelux/wizard.js' type='text/javascript'></script>
<!-- / flatty theme -->
<script src='/jwcdd/Public/assets/javascripts/nav.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/tables.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/theme.js' type='text/javascript'></script>
<!-- / demo -->
<script src='/jwcdd/Public/assets/javascripts/demo/jquery.mockjax.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/demo/inplace_editing.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/demo/charts.js' type='text/javascript'></script>
<script src='/jwcdd/Public/assets/javascripts/demo/demo.js' type='text/javascript'></script>
<!--div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div-->
</body>
</html>