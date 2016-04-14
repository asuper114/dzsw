<?php
/*----------------------------------------------------
	[dzsw] newproducts.php 

----------------------------------------------------*/
define('CURRSCRIPT','newproducts');
require('includes/global.php');

include DIR_dzsw.'languages/newproducts.php';

include DIR_dzsw.'includes/user/cla.products.php';
$C_NEWPRODUCTS = new products();

$C_NEWPRODUCTS->__set('type','newproducts');
$products_array = $C_NEWPRODUCTS->get_list();

$hassee_products = get_hassee();
$search_history = getsearchhistory();
$image_width = $settings['smallimage_width2']+2;

$page_trail[] = array('title' => $lang_newproducts['navbar']);
$page_position =  page_trail();

include template("newproducts");

?>
