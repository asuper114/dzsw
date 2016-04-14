<?php
/*----------------------------------------------------
	[dzsw] admin/mail.php 

----------------------------------------------------*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if(!$allow_sendmail){
    admin_msg($lang_a_common['forbid']);
}
if($action == 'send'){

	if($groupid != ''){
		if($groupid != 'all'){
			$query_pam = " where groupid='$groupid'";
		}
		$query = $db->query("select email from $table_customers $query_pam");
		$users = $space = '';
		while($query_data = $db->fetch_array($query)){
			$users .= $space.$query_data['email'];
			$space = ',';
		}
	}else{
		$users = $c_email;
	}
	if($users){
		$subject = $subject ? $subject : $settings['store_name'];
		sendmail($users,$subject,$message);
	}

	admin_msg($lang_a_message['mail_send_success'],'admin.php?act=mail');
}

if(!$type && !$action){
	
	if($customers_id != ''){
		$customer_data = $db->get_one("SELECT email FROM $table_customers WHERE customers_id='$customers_id'");
		$c_email = $customer_data['email'];
	}else{
		$query = $db->query("select groupid,grouptitle from $table_usergroups where classes!='Guest'");
		$usergroups = array();
		while($query_data = $db->fetch_array($query)){
		   $usergroups[] = $query_data; 
		}
	}
	include ADMIN_TPL.'mail_write.htm';

}
?>
