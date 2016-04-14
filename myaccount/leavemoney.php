<?php

/*----------------------------------------------------
	[dzsw] myaccount/leavemoney.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}



$customer_data = $db->get_one("SELECT email,money FROM ".$table_pre."customers WHERE customers_id = '" . (int)$customer_id . "'");
$leavemoney = display_price($customer_data['money']);

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['leavemoney']);
$page_position = page_trail();
include template("myaccount_leavemoney");

?>