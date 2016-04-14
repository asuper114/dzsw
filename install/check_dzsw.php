<?php
include DIR_dzsw.'includes/config.php';
include DIR_dzsw.'includes/cla.db_mysql.php';
$db = new DB(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT);
$db->select_db(DB_DATABASE);

$query = $db->query("SELECT COUNT(*) FROM ".$table_pre."customers",'ub');

if(!$db->error()) {
	$message_dzswexist = '数据库中已经安装过 dzsw, 继续安装会清空原有数据！';
	$submitreturn = 1;
} else {
	$submitreturn = 0;
	$message_dzswexist = '';
}

?>