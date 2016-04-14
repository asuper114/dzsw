<?php

/*
	[dzsw] get_onlinepay.php 

*/

define('CURRSCRIPT','get_onlinepay');
require('includes/global.php');

require DIR_dzsw.'languages/get_onlinepay.php';

if($_GET['paytype'] && file_exists(DIR_dzsw.'modules/payment/'.$_GET['paytype'].'_process.php')){
	include(cacheexists("payment"));
	include DIR_dzsw.'modules/payment/'.$_GET['paytype'].'_process.php';
}else{
    $message_all[] = $lang_get_onlinepay['paycode_error'];
}


$page_trail[] = array('title'=>$lang_get_onlinepay['navbar']);
$page_position = page_trail(); 
include template("get_onlinepay");

?>
