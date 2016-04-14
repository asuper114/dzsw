<?php

/*----------------------------------------------------
	[dzsw] languages/myaccount.php

----------------------------------------------------*/

$lang_myaccount_navbar = array(
	'controlboard'					=> '我的账户',
	'changeemail'					=> '修改Email地址',
	'changepassword'				=> '修改登陆密码',
	'changeqqmsn'					=> '修改我的即时通讯',
	'addressbook'					=> '地址簿',
	'changeaddressbook'				=> '修改地址',
	'orders'						=> '我的订单',
	'orders_detail'					=> '订单详细',
	'orders_spayment'				=> '修改付款方式',
	'orders_nummberorder'			=> '号订单',
	'orders_caddress'				=> '修改收货/订货人地址',
	'payback_method'				=> '选择退款方式',
	'leavemoney'					=> '账户余额',
	'success'						=> '操作成功',
);

$lang_myaccount_index = array(
	'welcome'						=> '您好！欢迎您来到　'.$settings['store_name'].'。',
	'customer_classes:'				=> '您现在的会员等级：',
	'customer_credit:'				=> '您现在的积分：',
	'customer_discount_1:'			=> '您享受的会员折扣为：',
	'customer_discount_2:'			=> '折',
);

$lang_myaccount_left = array(
	'myaccount'						=> '我的账户',
	'myaccount_c_email'				=> '修改我的Email地址',
	'myaccount_c_password'			=> '修改我的登录密码',
	'myaccount_c_qqmsn'				=> '我的即时通讯',
	'myaccount_c_addressbook'		=> '我的地址簿',

	'myaccount_orders'				=> '我的订单',
	'myaccount_orders_all'			=> '我的订单',
	'myaccount_orders_cancel'		=> '未成交订单',
	'payback_method'				=> '退款方式',

	'myaccount_leavemoney'			=> '我的账户余额',
	'myaccount_logout'				=> '点击退出',
);

$lang_myaccount_password = array(
	'header'						=> '如果您修改了密码，请记住您的新密码，以便您下次顺利的登陆 '.$settings['store_name'].' 。',

	'changepassword:'				=> '修改密码：',
	'oldpassword:'					=> '原密码：',
	'newpassword:'					=> '新密码：',
	'newpassword2:'					=> '确认新密码：',

	'msg_oldpassword_empty'			=> '请输入原密码！',
	'msg_newpassword_empty'			=> '请输入新密码！',
	'msg_newpassword2_empty'		=> '请输入确认新密码！',
	'msg_password_notsame'			=> '确认新密码必须和新密码相同！',
	'msg_oldpassword_error'			=> '原密码不正确！',
);

$lang_myaccount_address = array(
	'list_description'				=> '您在订购商品时填写的订单我们都为您保存了下来，您可以点击“详细”查看或修改其地址，点击”删除“删除此地址。',
	'detail_description'			=> '您可以对此地址进行修改，修改完成后请点击下面的”提交“按钮。',
	
	'name:'							=> '姓名：',
	'name'							=> '姓名',
	'street:'						=> '详细地址：',
	'street'						=> '详细地址',
	'postcode:'						=> '邮编：',
	'postcode'						=> '邮编',
	'telphone:'						=> '联系电话：',
	'regular:'						=> '固定电话：',
	'mobile:'						=> '移动电话：',
	'telnotice'						=> '固定电话和移动电话必须填写一项！',

	'msg_country_empty'				=> '错误！请选择一个国家。',
	'msg_provice_empty'				=> '错误！请选择一个省份。',
	'msg_city_empty'				=> '错误！请选择一个城市。',
	'msg_street_empty'				=> '错误！请选择一个城市。',
	'msg_name_empty'				=> '错误！姓名不能为空，请填写姓名。',
	'msg_postcode_empty'			=> '错误！邮编不能为空，请填写邮编。',
	'msg_tel_empty'					=> '错误！固定电话和移动电话必须填写一项。',
	'msg_tel_empty'					=> '错误！固定电话和移动电话必须填写一项。',
);

$lang_myaccount_leavemoney = array(
	'hello'							=> '您好！',
	'leavemoney'					=> '您现在的账户余额为：',
);

$lang_myaccount_order = array(
	'order_history_'				=> '订单历史：',
	'order_status_'					=> '订单状态：',
	'date_status_'					=> '状态日期：',
	'pay_platform_'					=> '支付平台：',

	'order_num:'					=> '订单号：',
	'product_name:'					=> '产品名称：',
	'order_status:'					=> '订单状态：',

	'delling_address'				=> '收货人地址',
	'delling_address_'				=> '收货人地址：',
	'billing_address'				=> '订货人地址',
	'billing_address_'				=> '订货人地址：',
	'billing_same_delling'			=> '收货人地址和订货人地址相同。',
	'change_address'				=> '修改收货/订货人地址',

	'name_'							=> '姓名：',
	'street_'						=> '详细地址：',
	'postcode_'						=> '邮编：',
	'telphone_'						=> '联系电话：',
	'regular_'						=> '固定电话：',
	'mobile_'						=> '移动电话：',

	'shipping_method_'				=> '送货方式：',
	'payment_method_'				=> '付款方式：',
	'payment_info_'					=> '查看汇款地址，汇款账号',
	'change_payment'				=> '修改付款方式',
);

$lang_myaccount_order_msg = array(
	'country'						=> '您必须从下拉菜单中选择一个国家。',
	'province'						=> '请从下拉菜单中选择一个省份。',
	'city'							=> '请从下拉菜单中选择一个城市。',
	'street_address'				=> '请填写详细地址。',
	'name'							=> '请填写姓名。',
	'postcode'						=> '请填写邮编。',
	'telphone'						=> '固定电话和移动电话必需填写一项。',
	'shipping'						=> '无法向指定的国家或地区送货，请确定您选择的地区是否有效。',
);

$lang_myaccount_email_msg = array(
	'password'						=> '对不起！您输入的密码无效。',
	'emailnewempty'					=> '请输入新的Email地址。',
	'emailnew2empty'				=> '请输入确认Email地址。',
	'emailnewerror'					=> '错误！您输入的Email地址无效。',
	'emailnotsame'					=> '错误！确认Email和新Email地址必须相同。',
	'passworderror'					=> '对不起！您输入的密码有错误。',
	'emailexits'					=> '对不起！此Email地址已经有人注册，请换用其它的Email地址。',
);

$lang_myaccount_email = array(
	'description'					=> '请确定您的新的 E_mail 地址可用，我们将能过您的 E_mail 向您发送订单处理等信息。',
	'oldemail:'						=> '原 E_mail 地址：',
	'youpassword:'					=> '您的登陆密码：',
	'newemail:'						=> '新 E_mail 地址：',
	'newemail2:'					=> '确认 E_mail 地址：',
);

$lang_myaccount_qqmsn = array(
	'description'					=> '如果需要我们将会通过此 QQ/MSN 与您交流。',

	'changeqqmsn'					=> '修改我的即时通讯',
	'qq_'							=> 'QQ：',
	'msn_'							=> 'MSN：',
);

$lang_myaccount_payback = array(
	'header_1'						=> '如果因缺货/退货产生剩余的款项，您希望：',
	'header_2'						=> '如果您选择了“选择性退回本人”或“全部退回本人”，请在下面选择退款方式。',
	
	'payreturn_1'					=> '暂存于您的 '.$settings['store_name'].' 的帐户中，今后购物可随时使用 。',
	'payreturn_2'					=> '选择性退回本人（退款金额小于5元时，暂存于您的帐户中；建议您选择此项，以减少退款手续费）。',
	'payreturn_3'					=> '全部退回本人。',

	'payback_1'						=> '通过邮局汇款形式退回&nbsp;（采用网上支付的订单，余存退回支付卡中)',
	'payback_2'						=> '全部退回您的银行卡中：',
	'payback_2_name'				=> '您的姓名：',
	'payback_2_cartnum'				=> '卡号：',
	'payback_2_bankname'			=> '开户银行：',
	'payback_2_desc'				=> '只退款时使用，不会公开您的任何资料。',
);

?>