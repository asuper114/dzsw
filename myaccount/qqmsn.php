<?php

/*----------------------------------------------------
	[dzsw] myaccount/qqmsn.php 


----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'update'){
	$db->query("update $table_customers set qq='$qq',msn='$msn' where customers_id = '" . (int)$customer_id . "' limit 1",'ub');
	s_redirect('showmessage.php?type=myaccount_qqmsn_update_success');
	exit;
}

$customer_data = $db->get_one("select qq,msn from $table_customers where customers_id = '" . (int)$customer_id . "'");

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link'=>'myaccount.php');
$page_trail[] = array('title'=>$lang_myaccount_navbar['changeqqmsn']);
$page_position = page_trail();
include template("myaccount_qqmsn");

?>