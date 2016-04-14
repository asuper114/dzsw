<?php

$sqlstring = file_get_contents(DIR_dzsw.'install/'.$sql_filename);

$sql_array = array();
$num = 0;
$sqlstring = str_replace(' `dzsw_', ' `'.$table_pre, $sqlstring);
$sqlstring = str_replace("\r", "\n", $sqlstring);
foreach(explode(";\n", trim($sqlstring)) as $query) {
	$query_array = explode("\n", trim($query));
	foreach($query_array as $query) {
	   $sql_array[$num] .= $query[0] == '#' || $query[0].$query[1] == '--' ? NULL : $query;
	}
	$num++;
}

unset($sqlstring);
$db = new DB(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT);
$db->select_db(DB_DATABASE);

$create_db_message = '';
foreach($sql_array as $query) {
	$query = trim($query);
	if($query) {
		if(strpos($query,'CREATE TABLE') !==false) {
			$name = preg_replace("/CREATE TABLE `([a-z0-9_]+)` .*/is", "\\1", $query);
			echo '<div id="createinfo">创建数据表：'.$name.' ..... <font color="#0000EE">完成</font></div>';
		}
		$db->query($query);
	}
}  

?>