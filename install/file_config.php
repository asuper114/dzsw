<?php
	$file_contents = '<?php' . "\n" .
		'' . "\n" .
		'/*' . "\n" .                     
		' -----------------------------------------------------------------' . "\n" .
		'  [dzsw] includes/config.php' . "\n" .
		'  copyright:  Studio (www.dzsw.com)' . "\n" .
		'  Last Modified: 2006/3/19 3:00' . "\n" .
		'*/' . "\n" .
		'' . "\n" .
		'' . "\n" .
		'  define(\'COOKIE_DOMAIN\', \'\');' . "\n" .
		'  define(\'COOKIE_PATH\', \'\');' . "\n" .
		'' . "\n" .
		'' . "\n" .
		'' . "\n" .
		'// ==================== 以下变量需根据您的服务器说明档修改 ===================='.
		'' . "\n" .
		'' . "\n" .
		'' . "\n" .
		'  define(\'DB_SERVER\', \'' . $DB_SERVER. '\'); // 数据库服务器 (eg, localhost - should not be empty for productive servers)' . "\n" .
		'  define(\'DB_SERVER_USERNAME\', \'' .$DB_SERVER_USERNAME. '\'); //数据库用户名' . "\n" .
		'  define(\'DB_SERVER_PASSWORD\', \'' .$DB_SERVER_PASSWORD. '\'); // 数据库密码' . "\n" .
		'  define(\'DB_DATABASE\', \'' . $DB_DATABASE. '\'); // 数据库名' . "\n" .
		'' . "\n" .
		'' . "\n" .
		'  $table_pre =  \'' . $DB_DATABASE_PRE. '\'; // 数据库前缀(注意：不可修改)' . "\n" .
		'  define(\'USE_PCONNECT\', \'0\'); 	// 数据库持久连接 0=关闭, 1=打开' . "\n" .
		'' . "\n" .
		'  $charset =  \'utf8\'; // 商城字符集'.
		'' . "\n" .    
		'  define(\'CHARSET_DB\', \'utf8\');		// 数据库存储字符集，默认为空，"latin1","gb2312","gbk", "big5", "utf8"　可选 ' . "\n" .
		'' . "\n" .   
		'' . "\n" .
		'// ============================================================================' . "\n" .
		'?>';
?>