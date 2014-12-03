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
                            <div class='label'>5</div>
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
<li>
    <a class='dropdown-collapse' href='#'>
        <i class='icon-user'></i>
        <span>人员管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='<?php echo U('User/user');?>'>
                <i class='icon-caret-right'></i>
                <span>系统用户</span>
            </a>
        </li>
        <li class=''>
            <a href='<?php echo U('User/user_dd');?>'>
                <i class='icon-caret-right'></i>
                <span>督导用户</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-tasks'></i>
        <span>听课任务管理</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='<?php echo U('Task/task');?>'>
                <i class='icon-caret-right'></i>
                <span>分配</span>
            </a>
        </li>
        <li class=''>
            <a href='<?php echo U('Task/showTask');?>'>
                <i class='icon-caret-right'></i>
                <span>查看</span>
            </a>
        </li>
    </ul>
</li>
<li class=''>
    <a class='dropdown-collapse ' href='#'>
        <i class='icon-edit'></i>
        <span>听课记录</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='<?php echo U('Record/record');?>'>
                <i class='icon-caret-right'></i>
                <span>填写</span>
            </a>
        </li>
        <li class=''>
            <a href='<?php echo U('Record/showRecord');?>'>
                <i class='icon-caret-right'></i>
                <span>查看</span>
            </a>
        </li>
    </ul>
</li>
<li>
    <a class='dropdown-collapse' href='#'>
        <i class='icon-table'></i>
        <span>数据报表</span>
        <i class='icon-angle-down angle-down'></i>
    </a>
    <ul class='nav nav-stacked'>
        <li class=''>
            <a href='table_search.html'>
                <i class='icon-caret-right'></i>
                <span>数据检索</span>
            </a>
        </li>
        <li class=''>
            <a href='table_department.html'>
                <i class='icon-caret-right'></i>
                <span>按院系统计</span>
            </a>
        </li>
        <li class=''>
            <a href='table_month.html'>
                <i class='icon-caret-right'></i>
                <span>按院系月份统计</span>
            </a>
        </li>
        <li class=''>
            <a href='table_supervisor.html'>
                <i class='icon-caret-right'></i>
                <span>按督导统计</span>
            </a>
        </li>
        <li class=''>
            <a href='table_teacher.html'>
                <i class='icon-caret-right'></i>
                <span>按教师职称统计</span>
            </a>
        </li>
        <li class=''>
            <a href='table_course.html'>
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
        <div class='span6'>
            <div class='page-header'>
                <h1 class='pull-left'>
                    <i class='icon-table'></i>
                    <span>听课记录表修改</span>
                </h1>
            </div>
        </div>     
        <!--div class='span3 pull-right' style='margin-top:20px;'>  
        <div class='control-group'>
            <label class='control-label' for='inputText2'>           
                <strong>选择课程</strong>
            </label>
            <select class='select2 input-block-level'>
                <option value='SH' />生物化学
                <option value='BX' />保险学
                <option value='SH' />电磁学
                <option value='BX' />宏观经济学
                <option value='SH' />计量经济学
                <option value='BX' />天文学基础
            </select>
        </div>
        </div-->     
    </div>
    </div>
<div class='row-fluid'>
    <div class='span12 box bordered-box green-border' style='margin-bottom:0;'>
        <div class='box-header green-background'>
            <div class='text-center'>北京师范大学本科教学督导团专家听课记录表（2014版）</div>
            <!--div class='actions'>
                <a href="#" class="btn box-remove btn-mini btn-link"><i class='icon-remove'></i>
                </a>
                <a href="#" class="btn box-collapse btn-mini btn-link"><i></i>
                </a>
            </div-->
        </div>
        <div class=''>
            <div class='responsive-table'>
                <div class='scrollable-area'>
                   <table class='table table-bordered table-hover table-striped' style='margin-bottom:0;'>
                        <tr>
                            <th>课程名称</th>
                            <td colspan="2">
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='生物化学' />
                            </td>
                            <th>学生院系/年级</th>
                            <td>
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='2013/生命科学与技术系' />
                            </td>
                            <th colspan="2">上课地点</th>
                            <td colspan="3">
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='生1教室' />
                            </td>  
                        </tr>
                        <tr>
                            <th>教师姓名</th>
                            <td>
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='林明强' />
                            </td>
                            <th rowspan="2">教师单位</th>
                            <td rowspan="2">
                                <textarea class="form-control" rows="5" disabled="disabled">生命科学与技术学院</textarea>
                            </td>
                            <th>上课时间（第x-x节）</th>
                            <td colspan="5">
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='周三第5-7节' />
                            </td>
                        </tr>
                        <tr>
                            <th>职称</th>
                            <td>
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='教授' />
                            </td>


                            <th>听课时间（第x、x节）</th>
                            <td colspan="5">
                                <input class='span12' id='full-name' type='text' disabled="disabled" value='2014-09-08 周三第5-7节' />

                            </td>
                        </tr>   
                        <tr>
                            <th>主要授课内容</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;" disabled="disabled">生物化学原理</textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>评价指标</th>
                            <th colspan="4" style="text-align:center">主要观察点及A级（好）评价标准</th>
                            <th>好</th>
                            <th>较好</th>
                            <th>一般</th>
                            <th>较差</th>
                            <th>差</th>
                        </tr>                        
                        <tr>
                            <th rowspan="2">教学态度</th>
                            <th colspan="4">*教学态度认真，爱岗敬业，精神饱满，仪表端庄</th>
                            <td><input id='' type='radio' value='' name='td1' /></td>
                            <td><input id='' type='radio' value='' name='td1'/></td>
                            <td><input id='' type='radio' value='' name='td1' /></td>
                            <td><input id='' type='radio' value='' name='td1'/></td>                           
                            <td><input id='' type='radio' value='' name='td1'/></td>
                        </tr>
                        <tr>                            

                            <th colspan="4">课前教学准备工作充分，熟悉教学内容</th>
                            <td><input id='' type='radio' value='' name='td2' /></td>
                            <td><input id='' type='radio' value='' name='td2'/></td>
                            <td><input id='' type='radio' value='' name='td2' /></td>
                            <td><input id='' type='radio' value='' name='td2'/></td>                           
                            <td><input id='' type='radio' value='' name='td2'/></td>
                        </tr> 
                        <tr>
                            <th rowspan="4">教学内容</th>
                            <th colspan="4">教学内容符合教学目标和教学大纲要求</th>
                            <td><input id='' type='radio' value='' name='nr1' /></td>
                            <td><input id='' type='radio' value='' name='nr1'/></td>
                            <td><input id='' type='radio' value='' name='nr1' /></td>
                            <td><input id='' type='radio' value='' name='nr1'/></td>                           
                            <td><input id='' type='radio' value='' name='nr1'/></td>
                        </tr> 
                        <tr>

                            <th colspan="4">*教学内容充实，体系完整，针对性强，讲授过程中对知识的运用自如</th>
                            <td><input id='' type='radio' value='' name='nr2' /></td>
                            <td><input id='' type='radio' value='' name='nr2'/></td>
                            <td><input id='' type='radio' value='' name='nr2' /></td>
                            <td><input id='' type='radio' value='' name='nr2'/></td>                           
                            <td><input id='' type='radio' value='' name='nr2'/></td>
                        </tr> 
                        <tr>

                            <th colspan="4">*对问题的阐述简练准确，重点突出，思路清晰；语言生动富有感染力</th>
                            <td><input id='' type='radio' value='' name='nr3' /></td>
                            <td><input id='' type='radio' value='' name='nr3'/></td>
                            <td><input id='' type='radio' value='' name='nr3' /></td>
                            <td><input id='' type='radio' value='' name='nr3'/></td>                           
                            <td><input id='' type='radio' value='' name='nr3'/></td>
                        </tr>  
                        <tr>

                            <th colspan="4" cla>注重教学内容的更新；教学中能够反映或联系学科发展的新思想、新概念、新成果、及学科前沿与热点</th>
                            <td><input id='' type='radio' value='' name='nr4' /></td>
                            <td><input id='' type='radio' value='' name='nr4'/></td>
                            <td><input id='' type='radio' value='' name='nr4' /></td>
                            <td><input id='' type='radio' value='' name='nr4'/></td>                           
                            <td><input id='' type='radio' value='' name='nr4'/></td>
                        </tr>
                        <tr>
                            <th rowspan="2">教学方法与手段</th>
                            <th colspan="4">*能有效调控课堂秩序，并根据课程特点采取灵活多样的教学形式和方法，通过适当互动，调动学生学习情绪</th>
                            <td><input id='' type='radio' value='' name='sd1' /></td>
                            <td><input id='' type='radio' value='' name='sd1' /></td>
                            <td><input id='' type='radio' value='' name='sd1' /></td>
                            <td><input id='' type='radio' value='' name='sd1' /></td>
                            <td><input id='' type='radio' value='' name='sd1' /></td>
                        </tr>
                        <tr>                            

                            <th colspan="4">恰当有效利用多种教学媒体，辅助教学效果好；板书工整、清楚</th>
                            <td><input id='' type='radio' value='' name='sd2' /></td>
                            <td><input id='' type='radio' value='' name='sd2' /></td>
                            <td><input id='' type='radio' value='' name='sd2' /></td>
                            <td><input id='' type='radio' value='' name='sd2' /></td>
                            <td><input id='' type='radio' value='' name='sd2' /></td>
                        </tr>  
                        <tr>
                            <th rowspan="2">教学效果</th>
                            <th colspan="4">*能给予学生思考、联想和创新的启迪</th>
                            <td><input id='' type='radio' value='' name='xg1' /></td>
                            <td><input id='' type='radio' value='' name='xg1' /></td>
                            <td><input id='' type='radio' value='' name='xg1' /></td>
                            <td><input id='' type='radio' value='' name='xg1' /></td>
                            <td><input id='' type='radio' value='' name='xg1' /></td>
                        </tr>
                        <tr>                            

                            <th colspan="4">能够帮助学生较好地掌握基本知识和提高技能</th>
                            <td><input id='' type='radio' value='' name='xg2' /></td>
                            <td><input id='' type='radio' value='' name='xg2' /></td>
                            <td><input id='' type='radio' value='' name='xg2' /></td>
                            <td><input id='' type='radio' value='' name='xg2' /></td>
                            <td><input id='' type='radio' value='' name='xg2' /></td>
                        </tr>
                        <tr>
                            <th>绪论课（引航课）评价</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>助教工作情况</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>对课堂教学的具体评价与建议</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>总体评价</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>对学生学习情况的意见或建议</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr> 
                        <tr>
                            <th>对教学环境、教学服务情况的意见与建议</th>
                            <td colspan="9">
                                <div class="form-group">
                                    <!--label for="name">文本框</label-->
                                    <textarea class="form-control" rows="3" style="margin-left: 0px; margin-right: 0px; width: 950px;"></textarea>
                                </div>
                            </td>
                        </tr>  
                        <tr>
                            <td colspan="10">说明：</br>1.本表只是听课的实况记录，仅作为教师教学情况评价的参考，不作为或决定对一门课程的全面评价。</br>2.对每一个考察点进行评价，请在好、较好、一般、较差、差五个等级中选择，并在相应位置打“√”。</td>
                        </tr>   
                        <tr>
                            <th>听课专家（签字）</th>
                            <td colspan="2">
                                <input class='span12' id='full-name' type='text' />

                            </td>
                            <th>填表日期</th>
                            <td colspan="6">
                            <div>
                                <div class='datepicker input-append' id='datepicker'>
                                    <input class='input-medium' data-format='yyyy-MM-dd' type='text' />
                                <span class='add-on'>
                                <i data-date-icon='icon-calendar' data-time-icon='icon-time'></i>
                                </span>
                                </div>
                            </div>                            
                            </td>
                        </tr>                                              
                    </table>
                    <button class='btn btn-success' type='submit' style='margin-right:20px;'><i class='icon-save'></i>保存</button>
                    <button class='btn' type='submit'>取消</button>     
                </div>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<!-- / jquery -->
<script src='/jwcdd/Public/assets/javascripts/jquery/jquery.min.js' type='text/javascript'></script>
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
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>