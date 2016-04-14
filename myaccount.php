<?php

/*
	[dzsw] myaccount.php 

*/
define('CURRSCRIPT','myaccount');
require('includes/global.php');

if (!$customer_id || $customer_id=='') {
    s_redirect('login.php?direct_referer='.rawurlencode('myaccount.php'));
}

require(DIR_dzsw.'languages/myaccount.php');


if($type == 'address'){
	$filename = 'address';

}elseif($type == 'email'){
	$filename = 'email';

}elseif($type == 'password'){
	$filename = 'password';

}elseif($type == 'qqmsn'){
	$filename = 'qqmsn';

}elseif($type == 'payback_method'){
	$filename = 'payback_method';

}elseif($type == 'order'){
	$filename = 'order';

}elseif($type == 'leavemoney'){
	if($settings['user_leavepay'] == 'true'){
		$filename = 'leavemoney';
	}else{
		$filename = 'index';
	}

}else{
	$filename = 'index';

}
include DIR_dzsw."myaccount/".$filename.".php";


?>