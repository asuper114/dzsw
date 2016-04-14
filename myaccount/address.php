<?php

/*----------------------------------------------------
	[dzsw] myaccount/address.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if($action == 'edit'){
	
	$continue_do = true;
	if (strlen($country) < 1 && $settings['show_country'] == 'true') {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_country_empty'];
	}
	if (strlen($province) < 1) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_province_empty'];
	}
	if (strlen($city) < 1) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_city_empty'];
	}
	if (strlen($street_address) < 1 ) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_street_empty'];
	}
	if (strlen($name) < 1) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_name_empty'];
	}
	if (strlen($postcode) < 1) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_post_empty'];
	}	
	if ((strlen($tel_regular) < 1) && (strlen($tel_mobile) < 1)) {
		$continue_do = false;
		$message_all[] = $lang_myaccount_address['msg_tel_empty'];
	}
	if ($continue_do == true) {
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
		$db->perform($table_address_book, $sql_data_array,'update'," abid='".$abid."' and cid='$customer_id'");
		s_redirect('showmessage.php?type=myaccount_address_edit&direct_referer='.rawurlencode("myaccount.php?type=address&act=edit&abid=".$abid));
		exit;
	}else{
		$type = 'edit';
	}

}elseif($action == 'delete'){
	$address_data = $db->get_one("select count(*) as count from $table_address_book where abid='$abid' and cid='$customer_id'");
	$continue_do = true;
	if(!$address_data['count']){
		s_redirect('showmessage.php?type=myaccount_address_delete_notyou&direct_referer='.rawurlencode("myaccount.php?type=address"));
		exit;
	}

	$db->query("delete from $table_address_book where abid='$abid' and cid='$customer_id'");
	s_redirect('showmessage.php?type=myaccount_address_delete&direct_referer='.rawurlencode("myaccount.php?type=address"));
	exit;
}

if($act == 'edit'){
	
	$address_data = $db->get_one("select * from $table_address_book where cid = '" . (int)$customer_id . "' and abid='$abid'");
	$continue_do = true;
	if(!$address_data['abid']){
		s_redirect('showmessage.php?type=myaccount_address_edit_notyou&direct_referer='.rawurlencode("myaccount.php?type=address"));
		exit;
	}


	@extract($address_data);
	if($settings['show_country'] == 'true'){
		$show_country = true;
		if($country){
			$country_default = $country;
		}
	}elseif($settings['country_default'] != ''){
		$country_default = $settings['country_default'];
	}else{
		$country_default = "1";
	}
	
	$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link' => 'myaccount.php');
	$page_trail[] = array('title'=> $lang_myaccount_navbar['addressbook'], 'link' => 'myaccount.php?type=address');
	$page_trail[] = array('title' => $lang_myaccount_navbar['changeaddressbook']);
	$page_position = page_trail();
	include template("myaccount_address_detail");

}

$query = $db->query("select abid,name,street_address,postcode from $table_address_book where cid = '" . (int)$customer_id . "'");
$addresses = array();
while($address = $db->fetch_array($query)){
	$addresses[] = $address;
}

$page_trail[] = array('title' => $lang_myaccount_navbar['controlboard'],'link' => 'myaccount.php');
$page_trail[] = array('title'=> $lang_myaccount_navbar['addressbook']);
$page_position = page_trail();
include template("myaccount_address_list");

?>