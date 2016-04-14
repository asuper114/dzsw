<?php

/*
	[dzsw] myaccount/index.php 


*/
if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

$cust = $db->get_one("select email,credit from $table_customers where customers_id = '" . (int)$customer_id . "'");

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard']);
$page_position = page_trail();

include template("myaccount_index");

?>