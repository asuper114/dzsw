<?php
/*----------------------------------------------------
	[dzsw] languages/register.php

----------------------------------------------------*/

$lang_register = array(
	'navbar'						=> '注册会员',

	'header_title'					=> '注册新会员',
	'email_'						=> 'Email地址：',
	'email_desc'					=> '将作为您的登陆账号使用，请确保此邮箱可用，我们将通过引邮箱向您发送订单处理等信息。',
	'password_'						=> '密码：',
	'password2_'					=> '确认密码：',
	'checknum_'						=> '验证码：',
	'addition_info'					=> '附加信息',
	'qq_'							=> 'QQ：',
	'msn_'							=> 'MSN：',

	'msg_email_empty'				=> '对不起！请输入您的email地址。',
	'msg_emailformat_error'			=> '对不起！您的电子邮件格式不正确 - 请作必要修改。',
	'msg_email_exists'				=> '对不起！这个电子邮件地址已经被注册 - 请用该地址登录或用别的地址重新注册。',
	'msg_password_small'			=> '对不起！密码不能少于6个字符。',
	'msg_password_same'				=> '对不起！密码与确认密码必须相同。',
	'msg_checknum_error'			=> '对不起！请输入正确的验证码。',

);

$lang_register_email = array(
	'subject'						=> '欢迎您注册成为 '.$settings['store_name'].' 的会员。',

	'header'						=> '欢迎您成为 '.$settings['store_name'].' 的注册用户，您的会员账号: %s 请您保存好。'.$settings['store_name'].'将竭诚为您服务，为您提供一个优良的购物环境。',

	'message'						=> '现在您可以使用我们为会员提供的<b>各种服务设施和项目</b>。 这些服务设施和项目包括：' .
		'<ul>' .
			'<li><b>永久购物车</b> - 我们将一直为你保留购物车内的东西，直到你自己将其去除或结账。</li>' .
			'<li><b>通讯录</b> - 我们现在可以将你购买的商品送往其他地址。例如，你可以把礼物直接送给你要送的人。</li>'. 
			'<li><b>订单记录</b> - 通过订单纪录，你可查询在'.$settings['store_name'].'的购物纪录</li>'. '<li><b>商品评论</b> - 作为会员，你可以把对'.$settings['store_name'].'商品的意见或评论写下来与其它顾客分享。</li>'.
		'</ul>',
	'warning'						=>	'<b>注意：</b>这个电子邮件地址是由我们的客户提供的，如果您并没有注册，请来信：' . $settings['server_email'] . ' 告知。',

);

?>
