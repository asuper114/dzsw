<?php

/*
	[dzsw] admin/misc.php 

*/

if(!defined("IN_dzsw")) {
	exit("Access Denied");
}

if($act == 'updatecache') {

	updatecache();
	admin_msg($lang_a_misc['updatecache_success']);

}elseif($act == 'logout') {

	$_SESSION['s_adminid'] = '';
	$_SESSION['s_admingroupsid'] = '';
	unset($_SESSION['s_adminid'], $_SESSION['s_admingroupsid']);
	admin_msg($lang_a_misc['logoff_success'],'admin.php');

}


?>
