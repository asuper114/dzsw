<?php

/*----------------------------------------------------
	[dzsw] install.php 

----------------------------------------------------*/
error_reporting(E_ERROR | E_WARNING | E_PARSE);

define('DIR_dzsw', './');
define('DIR_TEMPLATE', DIR_dzsw.'install/templates/');

if(!function_exists("file_get_contents"))
{
	function file_get_contents($filename)
	{
		if(($contents = file($filename)))
		{
			$contents = implode('', $contents);
			return $contents;
		}
		else {
			return false;
		}
	}
}

$timestamp = time();
$version = 'V1.6.0';
$sql_filename = 'dzsw_1_6.sql';

$register_globals = @ini_get('register_globals');
if ( PHP_VERSION < '4.1.0'){
    $_GET =& $HTTP_GET_VARS;
    $_POST =& $HTTP_POST_VARS;
}
if(!$register_globals) {
    @extract($_POST); 
    @extract($_GET); 
}

$charset_db = $charset = 'utf8';

$server_message = $exit_message = $message_all = $dir_canwritemessage = array();
$continue_do = true;


if($type == 'info_db'){
	if(file_exists(DIR_dzsw.'includes/config.php')){
		$configfile_exists = true;
	}else{
		$configfile_exists = false;
	}
	if(is_writeable(DIR_dzsw.'includes/config.php')) {
		$configfile_writeable = true;
	}else{
		$configfile_writeable = false;
		$exit_message[] = '您的 “includes/config.php” 文件无法写入，安装过程不能继续。';
		$continue_do = false;
	}
	
	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'info_db.htm';
	include DIR_TEMPLATE.'footer.htm';	
	exit;

}elseif($type == 'check'){ 
	$continue_do = true;
	$server_message = $exit_message = $dir_canwritemessage = array();

	include DIR_dzsw.'install/check_db.php';
	include DIR_dzsw.'install/check_php.php';
	include DIR_dzsw.'install/check_dir.php';

	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'check_environment.htm';
	include DIR_TEMPLATE.'footer.htm';	
	exit;

}elseif($type == 'info_adminer'){
	include DIR_dzsw.'install/check_dzsw.php';

	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'info_adminer.htm';
	include DIR_TEMPLATE.'footer.htm';	
	exit;

}elseif($type == 'create_db'){ 	
	include DIR_dzsw.'install/check_adminer.php';

	include DIR_dzsw.'includes/config.php';
	include DIR_dzsw.'includes/cla.db_mysql.php';

	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'create_header.htm';

	include DIR_TEMPLATE.'create_adminer.htm';
	include DIR_TEMPLATE.'create_dbtable.htm';
	include DIR_TEMPLATE.'create_dir.htm';
	
	include DIR_dzsw.'install/create_adminer.php';

	include DIR_TEMPLATE.'create_over.htm';
	include DIR_TEMPLATE.'footer.htm';	
	  
}else{
	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'read.htm';
	include DIR_TEMPLATE.'footer.htm';

} 

function s_unhtmlspecialchars($varchar) {
	return strtr($varchar, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
}

function mkdir_recursive($dirName, $mode = '0777'){	
	$newDir = '';
	foreach(split('/',$dirName) as $dirPart){
		$newDir = "$newDir$dirPart/";
		if(!file_exists($newDir)){
			@mkdir($newDir, $mode);
		}
	}
}

function dirwriteable($dir) {
	if(!is_dir($dir)) {
		@mkdir_recursive($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/writeabletext.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/writeabletext.txt");
			$canwrite = true;
		} else {
			$canwrite = false;
		}
	}
	return $canwrite;
}

function dir_clear($dir) {
	global $lang;

	echo '<div id="createinfo">清空目录'.' '.$dir;
	$obj_dir = dir($dir);
	while($entry = $obj_dir->read()) {
		$filename = $dir.'/'.$entry;
		if(is_file($filename)) {
			@unlink($filename);
		}
	}
	$obj_dir->close();
	echo '......<font color="#0000EE">完成</font></div>';
}

?>
