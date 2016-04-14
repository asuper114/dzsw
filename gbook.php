<?php

/*----------------------------------------------------
	[dzsw] gbook.php 

----------------------------------------------------*/

define('CURRSCRIPT','gbook');
require('includes/global.php');

include DIR_dzsw.'languages/gbook.php';
include DIR_dzsw.'includes/user/cla.gbook.php';

if($action == 'dowrite'){
	$continue_do = true;
	if(!$text){
		$continue_do = false;
		$message_all[] = $lang_gbook['msg_gbookmain_empty'];
	}
	if($continue_do == true){
		$sql_data_array = array(
			'text'				=> shtmlspecialchars($text),
			'cid'				=> $customer_id,
			'date_added'		=> $timestamp,
			'last_modified'		=> $timestamp,
		);


		$db->perform($table_pre."gbook", $sql_data_array);
		s_redirect("showmessage.php?type=gbook_write_success");
	} 
}

$C_GOOBK = new gbook();
$array_s = array(
	'page'			=> $page,
	'numapage'		=> $settings['gbook_numofrow'],
	'link'			=> 'gbook.php?dzsw=dzsw',
);
$gbooks_data = $C_GOOBK->show_gbook_list($array_s);
$gbooks = $gbooks_data['list'];
$multipage = $gbooks_data['multipage'];

$page_trail[] = array('title'=>$lang_gbook['navbar']);
$page_position = page_trail();
include template("gbook");



?>
