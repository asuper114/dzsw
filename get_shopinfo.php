<?php

/*----------------------------------------------------
	[dzsw] get_shopinfo.php 

----------------------------------------------------*/

define('CURRSCRIPT','get_shopinfo');
require("includes/global.php");

if($action == 'get_renzheng_code'){

	echo $settings['renzheng_code'];
	exit;
}

?>

