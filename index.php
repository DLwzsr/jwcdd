<?php
  /*
  *author: Xiafeng
  *date: 2014-05-20
  *description: entrance file
  */

  //definr the application name of website
  define('APP_NAME', 'jwcdd');
  define('APP_PATH', './jwcdd/');
  define('APP_DEBUG', true);
  define('RUNTIME_PATH',APP_PATH.'Runtime/');
  define('BUILD_DIR_SECURE',true);
  define('DIR_SECURE_FILENAME', 'default.html');
  define('DIR_SECURE_CONTENT', 'Deny Access!');

  require './ThinkPHP/ThinkPHP.php';
?>