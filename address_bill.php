<?php

/*----------------------------------------------------
	[dzsw] address_ship.php 

----------------------------------------------------*/
define('CURRSCRIPT','address_bill');
require 'includes/global.php';

if (!$customer_id || $customer_id=='') {
    $referer = s_referer();
    s_redirect('login.php?direct_referer='.rawurlencode('address_bill.php'));
}

if (!cart_get_product()) {
    s_redirect('cart.php');
}

include DIR_dzsw.'languages/address_bill.php';

if($_POST['action']) {
    $message_all2 = array();
	$continue_do = true;
	if($type_ == 'new'){
		if (strlen($country) < 1 && $settings['show_country'] == 'true') {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_country_empty'];
		}
		if (strlen($province) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_provice_empty'];
		}
		if (strlen($city) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_city_empty'];
		}
		if (strlen($street_address) < 1 ) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_street_empty'];
		}
		if (strlen($name) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_name_empty'];
		}
		if (strlen($postcode) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_postcode_empty'];
		}

		if ((strlen($tel_regular) < 1) && (strlen($tel_mobile) < 1)) {
			$continue_do = false;
			$message_all2[] = $lang_address_bill['msg_tel_empty'];
		}
		if($continue_do == true){
			$sql_data_array = array(        
				'name'				=> $name,
				'country'			=> $country,
				'province'			=> $province,
				'city'				=> $city,
				'street_address'	=> $street_address,
				'postcode'			=> $postcode,
				'tel_regular'		=> $tel_regular,
				'tel_mobile'		=> $tel_mobile,
			);

			$sql_data_array['cid'] = $customer_id;
			$db->perform($table_address_book, $sql_data_array);
			$address_id = $db->insert_id();
			$db->query("update $table_customers set billto='".$address_id."' where customers_id='".$customer_id."'");
		}
	}else{
		if(!$abid){
			$continue_do = false;
			$message_all[] = $lang_address_bill['msg_abid_empty'];
		}
		if($continue_do == true){
			$db->query("update $table_customers set billto='".$abid."'  where customers_id='".$customer_id."'");
		}
	}
	if($continue_do == true){
		s_redirect('confirm.php');
		exit;
	}
}
$customer_data = $db->get_one("SELECT billto FROM $table_customers WHERE customers_id='".$customer_id."'");

$query = $db->query("SELECT abid,street_address,postcode,name FROM $table_address_book WHERE cid='".$customer_id."'");
$address_data = array();
while($query_data = $db->fetch_array($query)){
	if($customer_data['billto'] == $query_data['abid']){
		$query_data['checked'] = 'checked';
	}else{
		$query_data['checked'] = '';
	}	
	$address_data[] = $query_data;
}

if($settings['show_country'] == 'true'){
	$show_country = true;
}

if($settings['country_default'] != ''){
	$country_default = $settings['country_default'];
}else{
	$country_default = "1";
}

$confirm_step = confirm_step($currscript);

$page_trail[] = array('title'=>$lang_address_bill['navbar_1'],'link'=>'confirm.php');
$page_trail[] = array('title'=>$lang_address_bill['navbar_2']);
$page_position = page_trail();
include template("address_bill");

?>


