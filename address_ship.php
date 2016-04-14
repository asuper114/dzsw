<?php

/*----------------------------------------------------
	[dzsw] address_ship.php 

----------------------------------------------------*/
define('CURRSCRIPT','address_ship');
require 'includes/global.php';

if (!$customer_id || $customer_id=='') {
    $referer = s_referer();
    s_redirect('login.php?direct_referer='.rawurlencode('address_ship.php'));
}

if (!cart_get_product()) {
    s_redirect('cart.php');
}

include DIR_dzsw.'languages/address_ship.php';

if($_POST['action']) {
    $continue_do = true;
	$message_all2 = $message_all = array();
	if($type_ == 'new'){
		if (strlen($country) < 1 && $settings['show_country'] == 'true') {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_country_empty'];
		}
		if (strlen($province) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_provice_empty'];
		}
		if (strlen($city) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_city_empty'];
		}
		if (strlen($street_address) < 1 ) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_street_empty'];
		}
		if (strlen($name) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_name_empty'];
		}
		if (strlen($postcode) < 1) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_postcode_empty'];
		}

		if ((strlen($tel_regular_) < 1) && (strlen($tel_mobile) < 1)) {
			$continue_do = false;
			$message_all2[] = $lang_address_ship['msg_tel_empty'];
		}
		if($continue_do == true){
			$sql_data_array = array(        
				'name'				=> $name,
				'country'			=> $country,
				'province'			=> $province,
				'city'				=> $city,
				'street_address'	=> $street_address,
				'postcode'			=> $postcode,
				'tel_regular'		=> $tel_regular_,
				'tel_mobile'		=> $tel_mobile,
			);

			$deli_s_bill = (($deli_s_bill=='0') ? $deli_s_bill : '1');
			$sql_data_array['cid'] = $customer_id;
			$db->perform($table_address_book, $sql_data_array);
			$address_id = $db->insert_id();
			$db->query("update $table_customers set shipto='".$address_id."' , deli_s_bill='".$deli_s_bill."' where customers_id='".$customer_id."'");
		}
	}else{
		if(!$abid){
			$continue_do = false;
			$message_all[] = $lang_address_ship['msg_abid_empty'];
		}
		if($continue_do == true){
			$db->query("update $table_customers set shipto='".$abid."' , deli_s_bill='".$deli_s_bill."' where customers_id='".$customer_id."'");
		}
	}
	if($continue_do == true){
		s_redirect('confirm.php');
		exit;
	}
}

$customer_data = $db->get_one("SELECT shipto,deli_s_bill FROM $table_customers WHERE customers_id='".$customer_id."'"); 
$deli_s_bill = $customer_data['deli_s_bill'];

$query = $db->query("SELECT abid,street_address,postcode,name FROM $table_address_book WHERE cid='".$customer_id."'");
$address_data = array();
while($query_data = $db->fetch_array($query)){
	if($customer_data['shipto'] == $query_data['abid']){
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

$page_trail[] = array('title'=>$lang_address_ship['navbar_1'],'link'=>'confirm.php');
$page_trail[] = array('title'=>$lang_address_ship['navbar_2']);
$page_position = page_trail();
include template("address_ship");

?>


