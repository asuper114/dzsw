<?php

/*----------------------------------------------------
	[dzsw] login.php 

------------------------------------------------------*/
define('CURRSCRIPT','lossremark');
require 'includes/global.php';

if($settings['user_lossremark'] == 'false'){
	output();
}

require DIR_dzsw.'languages/lossremark.php';

$continue_do = true;
if($action == 'insert') {

	if(!$product_name){
		$continue_do = false;
		$message_all[] = $lang_lossremark['error'];
	}	

	if ($continue_do == true) {

		$sql_data_array = array(
			'email'				=> $email,
			'product_name'		=> $product_name,
			'description'		=> $description,
			'date_add'			=> $timestamp,
		);
		
		$db->perform($table_pre."lossremark",$sql_data_array);
		s_redirect('showmessage.php?type=lossremark_success&direct_referer='.rawurlencode('lossremark.php'));
		exit;
	}

}   


$page_trail[] = array('title'=>$lang_lossremark['navbar']);
$page_position = page_trail();
include template("lossremark");

?>

