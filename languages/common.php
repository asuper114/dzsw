<?php
/*----------------------------------------------------
	[dzsw] languages/common.php


----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'

@setlocale(LC_TIME, 'en_US');

$lang_orderstatus = array(
	'noauditing'				=>'未审核',
	'auditing'					=>'已审核',
	'waitforpay'				=>'等待付款',
	'partpay'					=>'部分付款',
	'allpay'					=>'全部到款',
	'makesurepay'				=>'确认到款',
	'cancel'					=>'取消',
	'cancel_1'					=>'超送货范围取消',
	'cancel_2'					=>'地址不详取消',
	'cancel_3'					=>'库存不足取消',
	'shipping'					=>'正在配货',
	'waitforsend'				=>'等待发货',
	'partsend'					=>'部分发货',
	'allsend'					=>'全部发货',
	'sendsuccess'				=>'发货成功',
	'sendfail'					=>'发货失败',
	'over'						=>'交易结束',
	'getexchange'				=>'收到退换货',
	'payback'					=>'货款已退',

	'email_auditing'			=>'已经审核确认，我们会马上给您配送，请您准备好货款，我们的送货人员会在送货时收取货款。',
	'email_waitforpay'			=>'已经审核确认，但您还没有支付货款，请支付货款。',
	'email_partpay'				=>'已经审核确认，但您只支付了部分货款，请支付其余货款。',
	'email_allpay'				=>'已经审核确认，我们会马上给您配送。',
	'email_cancel_1'			=>'由于您要求的送货地址超出了我们的送货范围，我们没有办法为您配送，所以将此订单取消，请原谅。',
	'email_cancel_2'			=>'您的订单地址不详细，我们没有办法为您送货，因此将此订单取消。',
	'email_cancel_3'			=>'您订购的商品，全部缺货，所以将此订单取消，由此给您造成的不便，请您原谅。',
	'email_shipping'			=>'正在配货',
	'email_waitforsend'			=>'等待发货',
	'email_partsend'			=>'您所订购的商品，因部分缺货，只发出了一部分，给您造成的不便，请原谅。',
	'email_allsend'				=>'您所订购的商品全部发出。',
	'email_sendsuccess'			=>'您所订购的商品发送成功。',
	'email_sendfail'			=>'您所订购的商品发送失败，原因：您所填写的收货人地址不正确，请修改您的收货人地址。',
	'email_getexchange'			=>'您寄回退换的商品已经收到，正在为您处理。',
	'email_payback'				=>'您的缺货货款、退货货款已经办理退款手续。',


);

$lang_common = array(
	'submit'					=>'提交',
	'makesure'					=>'确定',
	'update'					=>'更新',
	'back'						=>'返回',
	'cancel'					=>'取消',
	'edit'						=>'编辑',
	'copy'						=>'复制',
	'detail'					=>'详细',
	'add:'						=>'新增：',
	'sort_'						=>'排序：',
	'sort'						=>'排序',
	'title'						=>'标题',
	'title_'					=>'标题：',
	'value'						=>'数值',
	'value_'					=>'数值：',
	'delete'					=>'删除',
	'delete_small'				=>'删！',
	'description_'				=>'说明：',
	'example_'					=>'例如：',
	'status'					=>'状态',
	'status_'					=>'状态：',
	'country'					=>'国家',
	'country:'					=>'国家：',
	'province'					=>'省份',
	'province:'					=>'省份：',
	'city'						=>'城市',
	'city:'						=>'城市：',
	
	'yes'						=>'是',
	'no'						=>'否',

	'system_notice:'			=>'系统提示：',
	'system_notice_'			=>'系统提示：',
	'you_position_now:'			=>'您现在的位置：',
	'you_position_now_'			=>'您现在的位置：',

	'cartinput'					=> '放入购物车',

	'allclass'					=> '所有分类',
	'search'					=> '搜索',

	'click_to_edit'				=> '点击编辑',
	'click_to_open'				=> '点击打开',
	'click_to_close'			=> '点击关闭',
	'click_to_look'				=> '点击查看',

	'symbol_left'				=> '￥',
	'symbol_right'				=> '元',
	
	'no_fit'					=> '不适用',
	'startsearch'				=> '开始搜索',
	'adminoption_'				=> '管理选项：',

	'muli_total_'				=> '总数：',
	'muli_page_'				=> '总页数：',
	'curr_page_'				=> '当前页：',

	'postremit_desc'			=> '请将应付款汇到下面的地址：',
	'banktransfer_desc'			=> '请将应付款汇到下面的银行账号：',
	'online_payment_desc'		=> '您现在就可以点击下面的按钮进行在线支付了。',
	'goodsarrive_desc'			=> '请准备好货款，我们的送货人员会在送货时将货款带走。',
);

$lang_box = array(
	'search_header'				=> '商品搜索',
	'product_name_'				=> '商品名称：',

	'login'						=> '请在这里登陆',
	'login_email'				=> 'E_mail：',
	'login_password'			=> '密&nbsp;&nbsp;&nbsp;码：',
	'login_checknum'			=> '验证码：',
	'login_getpassword'			=> '忘记密码？',
	'login_myaccount'			=> '我的账户',
	'login_cart'				=> '购物车',
	'login_logoff'				=> '退出',
	'login_login'				=> '登陆',
	'login_register'			=> '注册',

	'cart'						=> '您的购物车清单',
	'cart_empty'				=> '您还没有选购过商品',
	'intocart'					=> '进入购物车',
	'confirm'					=> '点击结账',
	

	'classes'					=> '商品分类',

	'product_browse'			=> '您最近浏览过的商品',
	'product_browse_empty'		=> '您还没有浏览过商品',
	'product_browse_clear'		=> '清除浏览记录',

	'search_history'			=> '您最近的搜索记录',
	'search_history_empty'		=> '您还没有搜索过商品',
	'search_history_clear'		=> '清除搜索记录',
);

$lang_confirm_step = array(
	'confirm_step_'				=> '购物步骤：',
	'register'					=> '注册会员',
	'listincart'				=> '购物清单（购物车）',
	'address'					=> '收货/送货人地址',
	'shipping'					=> '选择送货方式',
	'payment'					=> '选择付款方式',
	'confirm'					=> '确认并提交订单',
);

$lang_header = array(
	'index'						=> '首页',
	'renzheng'					=> '顾客评价',
	'lossremark'				=> '缺货登记',
	'gbook'						=> '留言板',
	'myaccount'					=> '我的账户',
	'cart'						=> '购物车',
	
	'search_advanced'			=> '高级搜索',
	'newproduct'				=> '新到商品',
	'specials'					=> '特价商品',
	'classes'					=> '商品分类',
	
	'welcome'					=> $settings['store_name'].'欢迎您的到来！',
);

$lang_order_total = array(
	'product'					=>'商品金额：',
	'shipping'					=>'运货费用：',
	'total'						=>'总计：',
	'leaverpay'					=>'使用账户余额支付：',
	'mustpay'					=>'还应支付：',
	'paid'						=>'已付款：'
);

$lang_footer = array(
	'member'					=>'星级会员制',
	'shopping'					=>'购物流程',
	'shipping'					=>'配送方式',
	'payment'					=>'支付方式',
	'server'					=>'售后服务',

	'platform_desc'				=>'平台说明',
	'buyarticle'				=>'交易条款',
	'cantactus'					=>'联系我们',
	'renzheng'					=>'查看认证',
);


$lang_shipping = array(
	'goodsself'					=> '送货上门',
	'commonpost'				=> '普通邮递',
	'quick'						=> '国内快递',
	'chinapostems'				=> '中国邮政ems',
);

$lang_payment = array(
	
	'goodsarrivepay'			=> '货到付款',

	'postpay'					=> '邮局汇款',

	'banktransfer'				=> '银行转账',
	'construction'				=> '建设银行',
	'merchants'					=> '招商银行',
	'icbc'						=> '工商银行',

	'online'					=> '在线支付',
	'westpay'					=> '西部支付',
	'yeepay'					=> '易宝支付',
	'chinabank'					=> '网银在线',

	'alipay'					=> '支付宝',
);

$lang_payment_a = array(
	'postpay'		=> array(
		'address'		=>'汇款地址：',
		'postcode'		=>'邮政编码：',
		'manname'		=>'收款人姓名：',
	),
	'banktransfer'	=> array(
		'cartnum'		=>'卡号：',
		'manname'		=>'持卡人姓名：',
	),
	'westpay'		=> array(
		'account'		=>'会员账号：',
	),
	'yeepay'		=> array(
		'p1_MerId'		=>'商家编号：',
		'keyValue'		=>'秘钥：',
		'p4_Cur'		=>'币种：',

	),
	'chinabank'	=> array(
		'v_mid'			=>'会员账号：',
		'v_moneytype'	=>'币种：',
		'style'			=>'网关模式：',
		'md5key'		=>'数字签名：',
	),
	'alipay'	=> array(
		'account'		=>'支付宝账号：',
		'safenum'		=>'安全校验码：',
	),
);

$lang_defineinfo = array(
	'buyarticle'		=> '交易条款',
	'platform_desc'		=> '平台说明',
	'cantactus'			=> '联系我们',
);

?>
