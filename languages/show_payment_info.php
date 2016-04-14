<?php
/*----------------------------------------------------
	[dzsw] languages/show_payment_info.php

----------------------------------------------------*/


$lang_show_payment_info = array(
	'navbar'					=> '显示付款信息',

	'payment_showinfo'			=> '顾客您好！我们会很快处理您的订单'.($settings['sendmail_createorder'] == 'true' ? '，为了防止他人冒充订购，我们将向您发送一封电子邮件确认信，请注意查收；此邮件不必留存。' : '。'),

	'payment_method_'			=> '付款方式：',

	'online_payment_showinfo'	=> '您现在就可以点击下面的按钮进行在线支付了。',
	'goodsarrive_title'			=> '请准备好货款，我们的送货人员会在送货时将货款带走。',
	'postremit_title'			=> '请将应付款汇到下面的地址：',
	'postremit_notice'			=> '<font style="color:red">特别注意：</font>请您务必在汇款单上注明您的订单号,以方便我们在收到您的汇款后尽快处理订单。',
	'banktransfer_title'		=> '请将应付款汇到下面的银行账号：',
	
	'orders_what_can_do'		=> '订单状态是“未审核”,“等待付款” 或 “等待发货”时您可以对订单进行修改，取消。',
	'orders_lookoredit'			=> '查看和修改您的订单：',
	'orders_clicktolook'		=> '请点击这里查看您的订单',
	'orders_mustpay'			=> '应付款金额：',
	'orders_id'					=> '订单号：',
	'orders_nofont'				=> '此订单不存在或不是您的订单。',
	
);


?>