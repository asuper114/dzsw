<?php
/*----------------------------------------------------
	[dzsw] admin/main.php 


----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

$serverinfo = PHP_OS.' / PHP v'.PHP_VERSION;
$serverinfo .= @ini_get('safe_mode') ? $lang_a_main['safemode'] : NULL;
$dbversion = $db->result($db->query("SELECT VERSION()"), 0);
$sysos = $_SERVER['SERVER_SOFTWARE'];
$protocol = @getenv("server_protocol");
$register_globals = @ini_get('register_globals') ? $lang_a_main['open'] : $lang_a_main['close'];

$allowgdlibrary = function_exists(imageline) ? $lang_a_main['allow'] : $lang_a_main['noallow'];
if(@ini_get("file_uploads")) {
	$fileupload = $lang_a_main['file_'] .ini_get("upload_max_filesize")." - ".$lang_a_main['post_'].ini_get("post_max_size");
} else {
	$fileupload = "<font color=\"red\">".$lang_a_main['uploadfile_forbid_']."</font>";
}

$system_mail   = @ini_get('sendmail_path') ? 'Unix Sendmail ( Path: '.@ini_get('sendmail_path').')' :( @ini_get('SMTP') ? 'SMTP ( Server: '.@ini_get('SMTP').')': 'Disabled' );

$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_classes");
$classesnum=$get_one['count'];

$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_products");
$productsnum=$get_one['count'];

$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_customers");
$customersnum=$get_one['count'];

$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_orders");
$ordersnum=$get_one['count'];

$get_one = $db->get_one("SELECT COUNT(*) as count FROM $table_orders where orders_status='noauditing'");
$ordersaddnew = $get_one['count'];

include ADMIN_TPL.'main.htm';

?>

