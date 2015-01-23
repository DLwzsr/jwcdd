<?php
//项目配置文件
return array(
	//'配置项'=>'配置值'
    'DB_TYPE' => 'mysql',       //数据库类型
    'DB_HOST' => 'localhost',   //服务地址
    'DB_NAME' => 'jwcdd',         //数据库名称
    'DB_USER' => 'root',        //用户名
    'DB_PWD' => '',         //密码
    'DB_PORT' => '3306',        //服务器端口
    'DB_PREFIX' => 'dd_',      //数据库表前缀
    'DB_CHARSET' => 'utf8',     //数据库编码

    //URL模式
    'URL_MODEL' => 2,
    //'URL_PATHINFO_MODEL' => 2,
    'URL_PATHINFO_DEPR' => '/',
    'URL_HTML_SUFFIX' => '.html',   //URL后缀

    //表单口令，防止重复提交
    'TOKEN_ON' => true,
    'TOKEN_NAME' => '__hash__',
    'TOKEN_TYPE' => 'md5',
    'TOKEN_RESET' => true,

    //配置语言
    'LANG_WITCH_ON' => true,
    'LANG_AUTO_DETECT' => true,
    'DEFAULT_LANG' => 'zh-cn',
    'LANG_LIST' => 'zh-cn',
    'VAR_LANGUAGE' => '1',

    //配置防SQL注入
    'REQUEST_VARS_FILTER'=>true,

    //开启日志
    'LOG_RECORD' => true,
    'LOG_LEVEL' => 'EMERG,ALERT,CRIT,ERR',

    //Error message
    //'ERROR_PAGE' => '/Public/error.html',

    //设置时区
    'DEFAULT_TIMEZONE'=>'Asia/Shanghai',

    //全局变量
    'TMPL_PARSE_STRING' => array(
        //'__UPLOADS__' => 'http://219.224.30.99:8081/jwcdd/Uploads',
        //'__PUBLIC__' => 'http://219.224.30.99:8081/jwcdd/Public',
        //'__LOGIN__' => 'http://219.224.30.99:8081/jwcdd/index.php/Login/login'
    )
);
?>