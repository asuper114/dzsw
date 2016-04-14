<?php

/*----------------------------------------------------
	[dzsw] admin/adminchangepw.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}


if ($action == 'dochange') {

	$continue_do = true;
	if (strlen($password_current) < 1) {
		$continue_do = false;
		$message_all[] = $lang_a_adminchangepw['msg_currentpw_empty'];
	} 
	if (strlen($password_new) < 6) {
		$continue_do = false;
		$message_all[] = $lang_a_adminchangepw['msg_newpw_small'];
	}
	if ($password_new != $password_new2) {
		$continue_do = false;
		$message_all[] = $lang_a_adminchangepw['msg_passwordnotsame'];
	}
	if ($continue_do == true) {
		$customer_data = $db->get_one("select password from $table_admins where adminid = '" .$adminid. "'");
		if (md5($password_current) == $customer_data['password']){
			$db->query("update $table_admins set password = '" . md5($password_new) . "' where adminid = '" . $adminid . "'");
			admin_msg($lang_a_adminchangepw['message_changesuccess']);
		} else {
			$continue_do = false;
			$message_all[] = $lang_a_adminchangepw['message_currentw_error'];
		}
	}
	if($continue_do == false){
		$action = '';
	}

}

if(!$action){
	 include ADMIN_TPL.'adminchangepw.htm';
}

?>
