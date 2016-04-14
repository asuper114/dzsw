<?php

/*
	[dzsw] myaccount/payback_method.php 

*/
if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'update'){
	$sql_data_array = array(
		'cid'			=> $customer_id,
		'payreturn'		=> $payreturn,
		'payback'		=> $payback,
		'name'			=> $name,
		'cartnum'		=> $cartnum,
		'bankname'		=> $bankname,
	);
	$db->perform($table_pre."payback",$sql_data_array,'replace');
}

$payback_data = $db->get_one("SELECT * FROM ".$table_pre."payback WHERE cid = '" . (int)$customer_id . "'");

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['payback_method']);
$page_position = page_trail();

include template("myaccount_payback_method");

?>