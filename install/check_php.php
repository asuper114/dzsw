<?php

if(PHP_VERSION < '4.0.6'){ 
	$server_message[] = array('PHP 版本',PHP_VERSION,'您的 PHP 解释器版本低于 4.0.6，无法安装　dzsw。');
	$exit_message[] = '您的 PHP 解释器版本低于 4.0.6，无法安装　dzsw。';
	$continue_do = false;
}else{
	$server_message[] = array('PHP 版本',PHP_VERSION);
}

$short_open_tag = @ini_get('short_open_tag');
if(!$short_open_tag){ 
	$server_message[] = array('php.ini 中 ”short_open_tag“','Off','您的 php.ini 中的设置“short_open_tag”　其值为：Off，无法安装　dzsw。');
	$exit_message[] = '您的 php.ini 中的设置“short_open_tag”　其值为：Off，无法安装　dzsw。';
	$continue_do = false;
}else{
	$server_message[] = array('php.ini 中 “short_open_tag”','On');
}

?>