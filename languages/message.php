<?php

/*----------------------------------------------------
	[dzsw] languages/message.php

----------------------------------------------------*/

$lang_message = array(
	'gbook_write_success'					=> '恭喜您！您填写的留言成功发表。现将转向刚才的页面......',	
	
	'get_password_success'					=> '新的密码已经寄到您的电子邮件地址，请查收。现将转向刚才的页面......',
	'get_password_error'					=> '错误：这个电子邮件地址没有在我们这里注册，请再试一次。现将转向刚才的页面......',	
	
	'register_success'						=> '恭喜您，您已经成功注册为 '.$settings['store_name'].' 会员！',
	
	'myaccount_order_isnotyou'				=> '对不起！此订单不是您的订单，您不能对其进行查看或操作。',
	'myaccount_order_iscancel'				=> '对不起！此订单已经取消了。',
	'myaccount_order_idempty'				=> '对不起！订单不存在，请确定您来自一个有交效的链接。',
	'myaccount_order_noallow_caddress'		=> '对不起！此订单已经开始处理，您不能修改送货地地址或收货地址。',
	'myaccount_order_cannotcancel'			=> '对不起！此订单已经开始处理，无法取消。现将转向刚才的页面......',
	'myaccount_order_cpaymentsuccess'		=> '恭喜您！您订单的付款方式更改成功。现将转向刚才的页面......',
	'myaccount_order_detail_1'				=> '对不起！此订单不存在。现将转向刚才的页面......',
	'myaccount_order_update_success'		=> '恭喜您！您的订单成功更新。现将转向刚才的页面......',
	
	'myaccount_qqmsn_update_success'		=> '恭喜您！您的个人即时通讯更新成功。',

	'myaccount_address_edit_isnotyou'		=> '对不起！您要编辑的地址不存在，请确定您来自一个有效的链接。',
	'myaccount_address_delete_isnotyou'		=> '对不起！您要删除的地址不存在，请确定您来自一个有效的链接。',
	'myaccount_address_delete_success'		=> '恭喜您！您的地址删除成功。现将转向刚才的页面......',
	'myaccount_address_edit'				=> '恭喜您！您的地址修改成功。现将转向刚才的页面......',

	'myaccount_email'						=> '恭喜您！您的 Email 成功更新。<br />请确定此email有效，否则您可能无法收到商城给您寄送的电子邮件。',
	
	'myaccount_password'					=> '恭喜您！您的密码修改成功，请记住此密码。现将转向刚才的页面......',
	
	'login_success'							=> '您已经成功登陆　'.$settings['store_name'].'　！现将转向刚才的页面......',
	'logoff_success'						=> '您已经成功退出　'.$settings['store_name'].'　！现将转向刚才的页面......',

	'product_review_notfont'				=> '对不起！您要评论的商品不存在，请确定您来自一个有交效的链接。',
	'product_review_success'				=> '恭喜您！评论发表成功。',
	'product_notfont'						=> '对不起！此商品不存在，请确定您来自一个有交效的链接。',

	'class_notfont'							=> '对不起！此商品分类不存在，请确定您来自一个有交效的链接。',

	'dzsw_clearcookie_browse'				=> '恭喜您！您的浏览记录成功删除。',
	'dzsw_clearcookie_search'				=> '恭喜您！您的搜索记录成功删除。',

	'lossremark_success'					=> '恭喜您！您的缺货登记信息提交成功。现将转向刚才的页面......',

	'unfinend'								=> '未定义操作！',
	'redirect'								=> '2秒后自动跳转，如果您的浏览器没有自动跳转，请点击这里。',
	'goback'								=> '点击这里返回刚才页面。',
	'gobacktoindex'							=> '如果您要进入商城首页，请点击这里。',
);


define('LANG_MESSAGE_ORDERISNOTYOUR', '此订单不存在或不是您的订单，您不能查看。');
define('LANG_MESSAGE_MYACCOUNT_EMAIL', '恭喜您！您的email 成功更新。<br>请确定此email有效，否则您可能无法收到商城给您寄送的电子邮件。');
define('LANG_MESSAGE_MYACCOUNT_PASSWORD', '恭喜您！您的密码修改成功，请记住此密码。');
define('LANG_MESSAGE_MYACCOUNT_ADDRESS_EDIT', '恭喜您！您的地址修改成功。');
define('LANG_MESSAGE_MYACCOUNT_ADDRESS_DELETE', '恭喜您！您的地址删除成功。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_DETAIL_1', '对不起！此订单不存在。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_UPDATE_SUCCESS', '恭喜您！您的订单成功更新。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_ID_EMPTY', '对不起！您要取消的订单不存在。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_ISNOTYOU', '对不起！您要取消的订单不存在,请确定这是您的订单。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_CANNOTCANCEL', '对不起！此订单已经开始处理，不能取消。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_ISCANCEL', '对不起！此订单已经取消了。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_CANCELSUCCESS', '恭喜您！您的订单取消成功。');
define('LANG_MESSAGE_MYACCOUNT_ORDER_CPAYMENTSUCCESS', '恭喜您！您订单的付款方式更改成功。');
define('LANG_MESSAGE_OPRATESUCCESS', '恭喜您,  操作成功！');

define('LANG_MESSAGE_ORDERCANCELSUCCESS', '您已经成功取消此订单，现在将转入刚才页面。');
define('LANG_MESSAGE_ORDEREDITSUCCESS', '您已经成功编辑此订单，现在将转入编辑后的订单。');

define('LANG_ERROR_ORDERSCANNOTCANCEL', '此订单已经被取消，请不要重复操作。');

define('LANG_MESSAGE_UNDEFINED', '未定义操作！');
define('LANG_MESSAGE_REDIRECT', '2秒后自动跳转，如果您的浏览器没有自动跳转，请点击这里。');
define('LANG_MESSAGE_GOBACK', '点击这里返回刚才页面。');
define('LANG_MESSAGE_GOBACKINDEX', '如果您要进入商城首页，请点击这里。');

?>
