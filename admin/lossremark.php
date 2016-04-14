<?php

/*----------------------------------------------------
	[dzsw] admin/news.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if($action == 'delete'){
	$db->query("DELETE FROM ".$table_pre."lossremark WHERE id='$id' LIMIT 1");
	admin_msg($lang_a_message['update_success'],'admin.php?act=lossremark');  
}

if($type == 'detail'){
	$lossremark_data = $db->get_one("SELECT * from ".$table_pre."lossremark WHERE id='$id'");

	include ADMIN_TPL.'lossremark_detail.htm';    
}

if(!$type && !$action){
    $num_a_page = '10';
	$page = $page ? $page : '1';
	$startlimit = ($page - 1) * $num_a_page ;
    
    $query = $db->query("SELECT COUNT(*) from ".$table_pre."lossremark");
    $multipage = s_multi($db->result($query, 0), $num_a_page, $page, 'admin.php?act=lossremark');
    $query = $db->query("SELECT id, product_name, date_add from ".$table_pre."lossremark order by date_add LIMIT $startlimit,$num_a_page");
	$lossremark_list = array();
	while($query_data = $db->fetch_array($query)) {

		$lossremark_list[] = $query_data;
    }
    include ADMIN_TPL.'lossremark.htm';    
}

?>

