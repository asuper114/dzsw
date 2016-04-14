<?php
/*----------------------------------------------------
	[dzsw] admin/database.php 

----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($admingroupsid != '1'){
    admin_msg($lang_a_common['forbid']);
}

if($action == 'update'){
	$querystr = str_replace(' dzsw_', ' '.$table_pre, $querystr);
	$querystr = str_replace(' `dzsw_', ' `'.$table_pre, $querystr);
	$sql_array = splitstr_sql($querystr);
	
	if(is_array($sql_array) && $sql_array['0']){
		foreach($sql_array as $sqlstr) {
			if(trim($sqlstr) != '') {
				$db->query(stripslashes($sqlstr), 'ub');
				if($sqlerror = $db->error()) {
					break;
				}
			}
		}
	}
	
	if($sqlerror){
		$admin_message = $lang_a_database['message_update_fail'].$sqlerror;
		admin_msg($admin_message);
	}else{
		admin_msg($lang_a_database['message_update_success'],'admin.php?act=database&type=update');
	}
}

if($type == 'update'){
	include ADMIN_TPL.'database_update.htm'; 
}

