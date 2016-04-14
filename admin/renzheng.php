<?php
/*----------------------------------------------------
	[dzsw] admin/rzset.php 

----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($admingroupsid != '1'){
    admin_msg($lang_a_common['forbid']);
}

if($action == 'update'){

	$sql_data_array = array(
		'value'			=> $renzheng_code,
		'settings_key'	=> 'renzheng_code',
	);
	$db->perform($table_settings, $sql_data_array,'replace');
	updatecache("settings");

	admin_msg($lang_a_renzheng['message_update_success'],'admin.php?act=renzheng');
}

$query_data = $db->get_one("SELECT value FROM $table_settings WHERE settings_key = 'renzheng_code' LIMIT 1");

include ADMIN_TPL.'renzheng.htm';

?>
