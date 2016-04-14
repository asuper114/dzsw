<?php
/*----------------------------------------------------
	[dzsw] includes/global.php 

----------------------------------------------------*/
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
$mtime = explode(' ', microtime());
$starttime = $mtime[1] + $mtime[0];

define('IN_dzsw', TRUE);
define('DIR_dzsw', './');
$timestamp = time();
require DIR_dzsw.'includes/fun.common.php';

require DIR_dzsw.'includes/fun.classes.php';
require DIR_dzsw.'includes/fun.cache.php';
require DIR_dzsw.'includes/fun.sendmail.php';

if(defined('DB_SERVER') && DB_SERVER == '') {
	s_redirect("install.php");
}

$register_globals = @ini_get('register_globals');
if ( PHP_VERSION < '4.1.0'){
    $_SERVER =& $HTTP_SERVER_VARS;
    $_SESSION =& $HTTP_SESSION_VARS;
    $_FILES =& $HTTP_POST_FILES;
    $_GET =& $HTTP_GET_VARS;
    $_POST =& $HTTP_POST_VARS;
}
if(!get_magic_quotes_gpc()){
    saddslashes($_POST); 
    saddslashes($_GET); 
    saddslashes($_SESSION);
}

if(!$register_globals) {
    @extract($_POST); 
    @extract($_GET); 
}

$charset = 'utf8';

require DIR_dzsw.'includes/config.php';

require DIR_dzsw.'includes/cla.db_mysql.php'; 

$db = new DB(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT);
$db->select_db(DB_DATABASE);

include(cacheexists("settings")); 

include(cacheexists('style_'.$settings['store_style'],'styles'));

if($settings['gzip_compression'] == 'true' && function_exists('ob_gzhandler')) {
	ob_start('ob_gzhandler');
} else {
	ob_start();
}

if (function_exists('session_set_cookie_params')) {
    @session_set_cookie_params(0, COOKIE_PATH, COOKIE_DOMAIN);
} elseif (function_exists('ini_set')) {
    @ini_set('session.cookie_lifetime', '0');
    @ini_set('session.cookie_path', COOKIE_PATH);
    @ini_set('session.cookie_domain', COOKIE_DOMAIN);    
}

@ini_set('session.gc_divisor','100');
(!@ini_get('session.auto_start')) ? session_start() : '';

if(defined('CURRSCRIPT') && in_array(CURRSCRIPT, array('admin','gbook'))) {
	
	$adminid = $_SESSION['s_adminid'];
    $s_admingroupsid = $_SESSION['s_admingroupsid'];

    if ($s_admingroupsid) {
		
        include(cacheexists('admingroup_'.$s_admingroupsid,'admingroup'));
		
    }else{
        $adminid = '';
        $s_admingroupsid = '';
    }
    
    if(CURRSCRIPT == 'admin'){
		require DIR_dzsw.'languages/admin.php';
		define('ADMIN_TPL',DIR_dzsw.'templates/admin/');
	}
}

if(defined('CURRSCRIPT') && !in_array(CURRSCRIPT, array('admin'))) {
	$customer_id = $_SESSION['customer_id'];
	if(!isset($customer_id) || !$customer_id) {
		$customer_id ='';
		$groupid = '';
    } else {
		$customer_id = addslashes($customer_id);
		$groupid = (int)$_SESSION['groupid'];
		include(cacheexists('usergroup_'.$groupid,'usergroup'));
    }

	require DIR_dzsw.'includes/user/fun.common.php';
    require DIR_dzsw.'includes/user/fun.cart.php';
}

if(defined('CURRSCRIPT') && in_array(CURRSCRIPT, array('index','showclasses'))) {
	include(cacheexists('classes_showinheader','classes'));
	$showinheaderlist = $cache_classes_showinheader;
}
if(defined('CURRSCRIPT') && in_array(CURRSCRIPT, array('classes','showclasses'))) {
	include(cacheexists('classes'));
}

require DIR_dzsw.'languages/common.php';

if(defined('CURRSCRIPT') && in_array(CURRSCRIPT, array('product_detail','classes','search','newproducts','specials'))) {
	$hassee_products = get_hassee();
	$search_history = getsearchhistory();
	if ($products_list = cart_get_product()) {
		$cart_contents = array();
		if(is_array($products_list)){
			foreach($products_list as $key=>$val){
				$products = $db->get_one("select name from $table_products where products_id = '" . (int)$key . "'");
				$products['products_id'] = $key;
				$products['quantity'] = $val['quantity'];
				$cart_contents[] = $products;
			}
		}
	} 
	$image_width = $settings['smallimage_width2']+2;
}

if(defined('CURRSCRIPT') && in_array(CURRSCRIPT, array('shipping_method','confirm','process'))) {
	require DIR_dzsw.'includes/user/fun.shipping.php';
}

if(defined('CURRSCRIPT') && !in_array(CURRSCRIPT, array('admin'))) {
	require DIR_dzsw.'includes/user/cla.order.php';

	if($settings['user_leavepay'] == 'true'){
		$query_and = " or orders_status='partpay'";
	}else{
		$query_and = '';
	}
	$orders_save_time = is_numeric($settings['orders_savetime']) ? $settings['orders_savetime'] : '168';
	$query = $db->query("select orders_id from $table_orders where date_purchased<'".($timestamp-$orders_save_time*60*60)."' and (orders_status='auditing' or orders_status='noauditing' or orders_status='waitforpay' $query_and) order by orders_id");
	while($order_data = $db->fetch_array($query)){
		$C_ORDER = new order($order_data['orders_id']);
		if($settings['sendmail_cancelorder'] == 'true'){
			$C_ORDER->__set('sendmail',1);
		}
		$C_ORDER->order_total();
		$_array_ = array(
			'operator'				=> 'a_'.$adminid,
		);
		$C_ORDER->order_cancel($_array_);
		if($settings['sendmail_cancelorder'] == 'true'){
			$C_ORDER->order_product();
			$_array_ = array(
				'order_title_header'		=> $cancelwhyvalue,
				'subject'					=> $lang_a_order['email_subject_order'],
				'tplname'					=> 'order_cancel',
			);
			$C_ORDER->email_process($_array_);
		}	
	}
}

$page_trail_all = $page_trail = $message_all = array();
if(defined('CURRSCRIPT')) {
	$currscript = CURRSCRIPT;
}else{
	$currscript = '';
}