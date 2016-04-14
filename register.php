<?php
/*----------------------------------------------------
	[dzsw] register.php 

----------------------------------------------------*/
define('CURRSCRIPT','register');
require('includes/global.php');

require DIR_dzsw.'languages/register.php';

$continue_do = true;
if ($_POST['action'] == 'process') {

	if($email){
		if (!eregi("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]",$email)) { 
			$continue_do = false;
			$message_all[] = $lang_register['msg_emailformat_error'];
		}
	}else{
		$continue_do = false;
		$message_all[] = $lang_register['msg_email_empty'];
	}
	if($continue_do == true){
		$get_one = $db->get_one("SELECT count(*) AS total FROM ".$table_pre."customers WHERE email = '".$email."'");
		if ($get_one['total'] > 0) {
			$continue_do = false;
			$message_all[] = $lang_register['msg_email_exists'];
		}
	}
	if (strlen($password) < 6) {
		$continue_do = false;
		$message_all[] = $lang_register['msg_password_small'];
	} elseif ($password != $password2) {
        $continue_do = false;
		$message_all[] = $lang_register['msg_password_same'];
	}

	if($settings['user_checknum_inheader'] == 'true'){
		if($imgnum != $_SESSION['imgnum']){
			$continue_do = false;
			$message_all[] = $lang_register['msg_checknum_error'];
		}
	}
	
	if ($continue_do == true) {
		$group_data = $db->get_one("SELECT groupid FROM ".$table_pre."usergroups WHERE creditshigher >= 0 AND 0<creditslower LIMIT 1");
		
		$password = md5($password);
		$sql_data_array = array(
			'email'			=> $email,
			'regdate'		=> $timestamp,
			'lastvisit'		=> $timestamp,
			'password'		=> $password,
			'groupid'		=> $group_data['groupid'],
			'qq'			=> $qq,
			'msn'			=> $msn,
		);

		$db->perform($table_pre."customers", $sql_data_array);
		$customer_id = $db->insert_id();
		$_SESSION['customer_id'] = $customer_id;
  		$_SESSION['groupid'] = $group_data['groupid'];
  		
		$sql_data_array = array(
			'cid'			=> $customer_id,
			'payreturn'		=> 'myaccount',
			'payback'		=> 'post',
		);
		$db->perform($table_pre."payback",$sql_data_array,'replace');

		if($settings['sendmail_createaccount'] == 'true'){
			$lang_register_email['header'] = sprintf($lang_register_email['header'],$email);
			if(!$email_process = @file_get_contents(emailtemplate("createaccount"))){
				updatecache("email");
				$email_process = @file_get_contents(emailtemplate("createaccount"));
			}
			eval("\$email_process = \"" .addslashes($email_process). "\";");
			sendmail($email,$lang_register_email['subject'],$email_process);
		}

		if($direct_referer){
			s_redirect('showmessage.php?type=register_success&direct_referer='.rawurlencode($direct_referer));
		}else{
			s_redirect('showmessage.php?type=register_success');
		}
	}
}

$page_trail[] = array('title'=>$lang_register['navbar']);
$page_position = page_trail();

include template("register");

?>

