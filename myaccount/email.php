<?php

/*----------------------------------------------------
	[dzsw] myaccount/email.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'update'){
	
	$continue_do = true;
	if(!$password){
		$continue_do = false;
		$message_all[] = $lang_myaccount_email_msg['password'];
	}			 
	if(!$newemail){
		$continue_do = false;
		$message_all[] = $lang_myaccount_email_msg['emailnewempty'];
	}		   
	if($newemail){
		if (!eregi("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]",$newemail)) { 
			$continue_do = false;
			$message_all[] = $lang_myaccount_email_msg['emailnewerror'];
		}
	}
	if(!$newemail2 && $newemail){
		$continue_do = false;
		$message_all[] = $lang_myaccount_email_msg['emailnew2empty'];
	}
	if($newemail!=$newemail2 && $newemail && $newemail2){
		$continue_do = false;
		$message_all[] = $lang_myaccount_email_msg['emailnotsame'];
	}
	if($continue_do == true){
		$password = md5($password);
		$customer_data = $db->get_one("select count(*) as count from $table_customers where customers_id = '" . (int)$customer_id . "' and password='$password'");
		if($customer_data['count'] <1 ){
			$continue_do = false;
			$message_all[] = $lang_myaccount_email_msg['passworderror'];
		}  
	}
	if($continue_do == true){
		$customer_data = $db->get_one("select count(*) as count from $table_customers where customers_id != '" . (int)$customer_id . "' and email='$newemail'");
		if($customer_data['count']>0){
			$continue_do = false;
			$message_all[] = $lang_myaccount_email_msg['emailexits'];
		}
	}
	if($continue_do == true){
		$db->query("update $table_customers set email='$newemail' where customers_id = '" . (int)$customer_id . "' and password='$password'",'ub');
		s_redirect('showmessage.php?type=myaccount_email');
		exit;
	}else{
		$type = 'email';
	}

}

$customr_data = $db->get_one("select email from $table_customers where customers_id = '" . (int)$customer_id . "'");
$email = $customr_data['email'];

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['changeemail']);
$page_position = page_trail();
include template("myaccount_email");

?>