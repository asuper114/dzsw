<?php

if(!$DB_SERVER){
	$continue_do = false;
	$message_all[] = '请输入数据库的主机名称或IP地址！';
}  
if(!$DB_SERVER_USERNAME){
	$continue_do = false;
	$message_all[] = '请输入数据库使用者名称！';
} 	
if(!$DB_DATABASE){
	$continue_do = false;
	$message_all[] = '请输入数据库名称！';
}	
if(!$DB_DATABASE_PRE){
	$continue_do = false;
	$message_all[] = '请输入数据库表名前缀！';
}	

if($continue_do == false){

	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'info_db.htm';
	include DIR_TEMPLATE.'footer.htm';	
	exit;

}else{	    					  
	
	include DIR_dzsw.'install/file_config.php';

	if(($fp = @fopen(DIR_dzsw.'includes/config.php', 'w')) && is_writeable(DIR_dzsw.'includes/config.php')) {
		fputs($fp, $file_contents);
		fclose($fp);
	}else{
		$exit_message[] = '您的 “includes/config.php” 文件无法写入，数据库信息无法保存，安装过程不能继续。';
		$continue_do = false;
	}

	include DIR_dzsw.'includes/config.php';
	include DIR_dzsw.'includes/cla.db_mysql.php';
	$db = new DB(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT);
	$db->select_db(DB_DATABASE);
	
	$query = $db->query("SELECT VERSION()");
	$curr_mysql_version = $db->result($query, 0);
	if($curr_mysql_version < '3.23'){ 
		$server_message[] = array('MYSQL 版本',$curr_mysql_version,'您的 MYSQL 数据库版本低于 3.23，无法安装　dzsw。');
		$exit_message[] = '您的 MYSQL 数据库版本低于3.23，无法安装　dzsw。';
		$continue_do = false;
	}else{
		$server_message[] = array('MYSQL 版本',$curr_mysql_version);
	}

	if($continue_do == true){	
		$db->select_db(DB_DATABASE);
		if($db->error()) {
			if(mysql_get_server_info() > '4.1') {
				$db->query("CREATE DATABASE $DB_DATABASE DEFAULT CHARACTER SET $charset_db");
			} else {
				$db->query("CREATE DATABASE $DB_DATABASE",'ub');
			}
			if($db->error()){
				$server_message[] = array('选择数据库','失败','此用户无权连接或指定的数据库不存在, 系统也无法创建（权限不足）, 无法安装 dzsw。');
				$exit_message[] = '此用户无权连接或指定的数据库不存在, 系统也无法创建（权限不足）, 无法安装 dzsw。';
				$continue_do = false;
			}else{
				$server_message[] = array('选择数据库','成功');
			}
		}else{
			$server_message[] = array('选择数据库','成功');
		}
	}

}

?>