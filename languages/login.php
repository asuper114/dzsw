<?php
/*----------------------------------------------------
	[dzsw] languages/login.php

----------------------------------------------------*/

$lang_login =array(
	'navbar'						=> '会员登录',

	'register'						=> '会员注册',
	'loginout'						=> '退出',
	'email:'						=> 'Email地址：',
	'password:'						=> '密码：',
	'checknum:'						=> '验证码：',
	'forget_password:'				=> '忘记密码？',
	'putintocart'					=> '<font color="#ff0000"><b>注意：</b></font>你在&quot;访客购物车&quot;里的商品，会在登录后自动并入&quot;会员购物车&quot;内。',

	'login'							=> '会员登录',
	'login_desc'					=> '如果您已经注册成为 '.$settings['store_name'].' 的会员，请在这里登陆，登陆后您可以进行修改个人资料，结账，创建购物订单等。',
	
	'register'						=> '注册新会员',
	'register_desc'					=> '注册成为 '.$settings['store_name'].' 的会员，您可以：<ul>'.
		'<li>修改密码，'.$settings['store_name'].'为您提供了修改密码的功能。</li>'.
		'<li>修改个人资料，注册成功后您可以进入我的账户，填写更详细的个人资料，以便评论商品时与其它的顾客朋友进行交流。</li>'.
		'<li>查询订单，您可以通过[我的订单]查询您在　'.$settings['store_name'].' 定过的所有订单，并且了解订单的处理状况，还可以取消尚未处理的订单。</li>'.
		'<li>开始购物，您可以享受到　'.$settings['store_name'].' 的各种购物优惠，以及得到　'.$settings['store_name'].' 最新的商品信息。</li></ul>',
	'register_href'					=> '请点击这里 <a href="register.php?direct_referer='.rawurlencode($direct_referer).'">注册新会员</a>',
	
	'msg_email_empty'				=> '对不起，您没有输入Email地址，请输入Email地址：）',
	'msg_password_empty'			=> '对不起，您没有输入密码，请输入密码：）',
	'msg_checknum_empty'			=> '对不起，您没有输入验证码，请输入验证码：）',
	'msg_checknum_error'			=> '对不起，验证码输入错误，请重新输入验证码：）',
	'msg_pdoremail_error'			=> '错误：您的电子邮件地址 或 密码不对。',

);


?>
