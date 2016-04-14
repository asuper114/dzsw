<?php

/*
 -----------------------------------------------------------------
  [dzsw] includes/config.php
  copyright:  Studio (www.dzsw.com)
  Last Modified: 2006/3/19 3:00
*/


  define('COOKIE_DOMAIN', '');
  define('COOKIE_PATH', '');



// ==================== 以下变量需根据您的服务器说明档修改 ====================


  define('DB_SERVER', 'localhost'); // 数据库服务器 (eg, localhost - should not be empty for productive servers)
  define('DB_SERVER_USERNAME', 'root'); //数据库用户名
  define('DB_SERVER_PASSWORD', '123456'); // 数据库密码
  define('DB_DATABASE', 'dzsw'); // 数据库名


  $table_pre =  'dzsw_'; // 数据库前缀(注意：不可修改)
  define('USE_PCONNECT', '0'); 	// 数据库持久连接 0=关闭, 1=打开

  $charset =  'utf8'; // 商城字符集

  define('CHARSET_DB', 'utf8');		// 数据库存储字符集，默认为空，"latin1","gb2312","gbk", "big5", "utf8"　可选 
