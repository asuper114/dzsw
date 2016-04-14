<?php

/*
  [dzsw] address_list.php 
*/
define('CURRSCRIPT','address_list');
require('includes/global.php');

if (!$customer_id || $customer_id=='') {
    $referer = soobic_referer();
    soobic_redirect(soobic_link('login.php', 'direct_referer='.rawurlencode('address_ship.php'), 'SSL'));
}

if (!soobic_isset(cart_get_product())) {
    soobic_redirect(soobic_link('cart.php'));
}

require(DIR_SOOBIC.'./languages/customer_detail.php');

if ( isset($_POST['action'])) {
   if($_POST['type']=='ship'){
	    if ($address_num) {
			   $db->query("update $table_customers set shipto='".$address_num."' where customers_id='".$customer_id."'");
      }   
		  soobic_redirect(soobic_link('address_ship.php','type=edit','SSL'));
	 }else{
      if ($address_num) {   
				 $db->query("update $table_customers set billto='".$address_num."' where customers_id='".$customer_id."'");
      }   
			soobic_redirect(soobic_link('address_bill.php','type=edit','SSL'));
	 } 
}

require(DIR_SOOBIC.'./languages/address_ship.php');

$query = $db->query("SELECT * FROM $table_address_book WHERE cid='".$customer_id."'");
while($address=$db->fetch_array($query)){
   $addresses[]=$address;
}  

$page_trail[]=array('title'=>NAVBAR_TITLE_1,'link'=>soobic_link('confirm.php', '', 'SSL'));
$page_trail[]=array('title'=>NAVBAR_TITLE_2,'link'=>soobic_link('address_ship.php', '', 'SSL'));

include template("address_list");

?>


