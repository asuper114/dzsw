<?php

if(dirwriteable(DIR_dzsw.'upload/common')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/common',1);
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/common',0,'dzsw 商品图片目录(“'.DIR_dzsw.'upload/common ”)属性非 777 或无法写入,您将不能上传商品图片。'); 
}

if(dirwriteable(DIR_dzsw.'upload/small')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/small',1);
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/small',0,'dzsw 商品图片目录(“'.DIR_dzsw.'upload/small/”)属性非 777 或无法写入,您将不能使用上传商品图片生缩略图功能。');
}

if(dirwriteable(DIR_dzsw.'upload/small2')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/small2',1);
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'upload/small2',0,'dzsw 商品图片目录(“'.DIR_dzsw.'upload/small2/”)属性非 777 或无法写入,您将不能使用上传商品图片生缩略图功能。'); 
}

if(dirwriteable(DIR_dzsw.'data/cache')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'data/cache',1); 
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'data/cache',0,'dzsw 数据缓存目录(“'.DIR_dzsw.'data/cache”)属性非 777 或无法写入,<font style="color:red;">安装无法进行</font>。'); 
	$exit_message[] = 'dzsw 数据缓存目录(“'.DIR_dzsw.'data/cache”)属性非 777 或无法写入,<font style="color:red;">安装无法进行</font>。';
	$continue_do = false;
}

if(dirwriteable(DIR_dzsw.'data/emailtemplate')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'data/emailtemplate',1); 
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'data/emailtemplate',0,'dzsw 邮件模板缓存目录(“'.DIR_dzsw.'data/emailtemplate)属性非 777 或无法写入,您将不能使用发送邮件功能。');
}

if(dirwriteable(DIR_dzsw.'js')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'js',1); 
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'js',0,'dzsw 地区 javascript 缓存目录(”'.DIR_dzsw.'js/“)属性非 777 或无法写入,顾客将无法选择地区。'); 
}

if(dirwriteable(DIR_dzsw.'styles')) {
	$dir_canwritemessage[] = array(DIR_dzsw.'styles',1); 
}else{
	$dir_canwritemessage[] = array(DIR_dzsw.'styles',0,'dzsw 风格目录(“'.DIR_dzsw.'styles/”)属性非 777 或无法写入,您将无法在线编辑或添加商城风格。');
}

?>