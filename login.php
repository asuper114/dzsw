<?php

/*----------------------------------------------------
	[dzsw] login.php 


------------------------------------------------------*/
define('CURRSCRIPT','login');
require 'includes/global.php';
require DIR_dzsw.'languages/login.php';

$continue_do = true;
if($action == 'login') {
	if(!$email){
		$continue_do = false;
		$message_all[] = $lang_login['msg_email_empty'];
	}
	if(!$password){
		$continue_do = false;
		$message_all[] = $lang_login['msg_password_empty'];
	}	
	
	if($settings['user_checknum_inheader'] == 'true'){
		if(!$checknum){
			$continue_do = false;
			$message_all[] = $lang_login['msg_checknum_empty'];
		}elseif($checknum != $_SESSION['imgnum']){
			$continue_do = false;
			$message_all[] = $lang_login['msg_checknum_error'];
		}
	}

	if ($continue_do == true) {

		$password = md5($password);
		$customer_data = $db->get_one("select c.customers_id, c.groupid, c.credit, u.classes , u.creditshigher, u.creditslower FROM $table_customers c left join $table_usergroups u using (groupid) WHERE c.email='$email' AND c.password='$password'");

		if(!$customer_data['customers_id']) {
			$continue_do = false;
			$message_all[] = $lang_login['msg_pdoremail_error'];
		}else{        
			$customers_id = $customer_data['customers_id'];
			$groupid = $customer_data['groupid'];
			$credit = $customer_data['credit'];
			$groupidupdate = '';
			if($customer_data['customers_id'] && $customer_data['classes'] != 'specials' && $customer_data['classes'] != 'Guest' && ($credit < $customer_data['creditshigher'] || $credit > $customer_data['creditslower'])) {
				$group_data = $db->get_one("SELECT groupid FROM $table_usergroups WHERE $credit>=creditshigher AND $credit<creditslower AND classes != 'specials'");
				if($group_data['groupid']) {
					if($customer_data['groupid'] != $group_data['groupid']) {
						$groupid = $group_data['groupid'];
						$groupidupdate =", groupid='".$group_data['groupid']."'";
					}
				}else{
					$group_data = $db->get_one("select groupid FROM $table_usergroups WHERE classes = 'Specials'");
					if($group_data['groupid'] && ($customer_data['groupid'] != $group_data['groupid'])) {
						$groupid = $group_data['groupid'];
						$groupidupdate = ", groupid='".$group_data['groupid']."'";
					}
				}
			}
					 
			$_SESSION['customer_id'] = $customers_id;
			$_SESSION['groupid'] = $groupid;
				  
			$db->query("update $table_customers set lastvisit ='".$timestamp."' $groupidupdate where customers_id = '" . (int)$customers_id . "'");
			
			if($settings['user_checknum_inheader'] == 'true'){
				$_SESSION['imgnum'] == '';
				unset($_SESSION['imgnum']);
			}
			
			s_redirect('showmessage.php?type=login_success&direct_referer='.rawurlencode($direct_referer));
			exit;
		}
	}
}   

$direct_referer = s_referer();
$cart_contents = cart_get_product() ? true : '';

$page_trail[] = array('title'=>$lang_login['navbar']);
$page_position = page_trail();
include template("login");

?>

