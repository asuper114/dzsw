<?php
/*----------------------------------------------------
	[dzsw] get_password.php 

----------------------------------------------------*/
define('CURRSCRIPT','get_password');
require('includes/global.php');

include DIR_dzsw.'languages/get_password.php';

if ($action == 'process') {
    $query_data = $db->get_one("select email, password, customers_id from $table_customers where email = '$email'");
    if ($query_data['email']) {
        $new_password = s_random(6);
		$crypted_password = md5($new_password);

		$db->query("update $table_customers set password = '$crypted_password' where customers_id = '" . (int)$query_data['customers_id'] . "'","ub");
		sendmail($email,$lang_get_passwrod['email_password_subject'],$lang_get_passwrod['email_password_body'].$new_password);
		s_redirect('showmessage.php?type=get_password_success');
		exit;
    }else {
		s_redirect('showmessage.php?type=get_password_error');
	}
}

$page_trail[] = array('title' => $lang_get_passwrod['navbar_1'],'link' => 'login.php');
$page_trail[] = array('title' => $lang_get_passwrod['navbar_2']);
$page_position = page_trail();

include template("get_password");

?>
