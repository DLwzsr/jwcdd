<?php
//项目配置文件
return array(
	//'配置项'=>'配置值'
    //本地数据库配置信息
    'DB_TYPE' => 'mysql',       //数据库类型
    'DB_HOST' => 'localhost',   //服务地址
    'DB_NAME' => 'jwcdd',         //数据库名称
    'DB_USER' => 'root',        //用户名
    'DB_PWD' => '123456',         //密码
    'DB_PORT' => '3306',        //服务器端口
    'DB_PREFIX' => 'dd_',      //数据库表前缀
    'DB_CHARSET' => 'utf8',     //数据库编码
    //对接公资中心课程数据库连接信息
    'DB_CONFIG' => array(
        'DB_TYPE' => 'oracle',       //数据库类型
        'DB_HOST' => '172.16.212.168',   //服务地址
        'DB_NAME' => '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.212.168)(PORT = 1521))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = jworcl)))',         //数据库名称
        'DB_USER' => 'JWGL_OPENRESOURCE',        //用户名
        'DB_PWD' => 'JWGL_OPENRESOURCE',         //密码
        'DB_PORT' => '1521',        //服务器端口
        'DB_PREFIX' => 'v_'     //数据库表前缀
    ),
    //对接东软职工数据库连接信息
    'DB_CONFIG2' => array(
        'DB_TYPE' => 'oracle',       //数据库类型
        'DB_HOST' => '172.16.181.13',   //服务地址
        'DB_NAME' => '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 172.16.181.13)(PORT = 1521))(CONNECT_DATA = (SERVER = DEDICATED)(SERVICE_NAME = gbklicdc)))',         //数据库名称
        'DB_USER' => 'LICDC_2_JW',        //用户名
        'DB_PWD' => 'bnu4jwdd',         //密码
        'DB_PORT' => '1521',        //服务器端口
        'DB_PREFIX' => 'syn_'     //数据库表前缀
    ),

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