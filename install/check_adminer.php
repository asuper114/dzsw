<?php

$message_all = array();
if(!$email) {
	$message_all[] = '请输入管理员账号。';
}
if(!$password){
	$message_all[] = '请输入管理员密码。';
}
if($password != $password2){
	$message_all[] = '两次输入密码不一致，无法继续安装。';
}

if($message_all['0']){
	include DIR_dzsw.'install/check_dzsw.php';

	include DIR_TEMPLATE.'header.htm';
	include DIR_TEMPLATE.'info_adminer.htm';
	include DIR_TEMPLATE.'footer.htm';
	exit;   
}

?>