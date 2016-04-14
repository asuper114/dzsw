<?php

/*----------------------------------------------------
	[dzsw] myaccount/index.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'update'){
	$continue_do = true;
	if(!$oldpassword){
		$continue_do = false;
		$message_all[] = $lang_myaccount_password['msg_oldpassword_empty'];
	}     
	if(!$newpassword){
		$continue_do = false;
		$message_all[] = $lang_myaccount_password['msg_newpassword_empty'];
	}  
	if(!$newpassword2){
		$continue_do = false;
		$message_all[] = $lang_myaccount_password['msg_newpassword2_empty'];
	} 		   
	if($newpassword != $newpassword2){
		$continue_do = false;
		$message_all[] = $lang_myaccount_password['msg_password_notsame'];
	}		   
	if($continue_do == true){
		$oldpassword = md5($oldpassword);
		$cust = $db->get_one("select count(*) as count from $table_customers where customers_id = '" . (int)$customer_id . "' and password='$oldpassword'");
		if($cust['count'] < 1){
			$continue_do = false;
			$message_all[] = $lang_myaccount_password['msg_oldpassword_error'];
		}  
	}
	if($continue_do == true){
		$newpassword = md5($newpassword);
		$cust = $db->get_one("update $table_customers set password='$newpassword' where customers_id = '" . (int)$customer_id . "' and password='$oldpassword'",'ub');
		s_redirect('showmessage.php?type=myaccount_password');
	}else{
		$type = 'password';
	}	  
}

$customr_data = $db->get_one("select email from $table_customers where customers_id = '" . (int)$customer_id . "'");
$email = $customr_data['email'];

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['changepassword']);
$page_position = page_trail();
include template("myaccount_password");

?>