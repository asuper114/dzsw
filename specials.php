<?php
/*----------------------------------------------------
	[dzsw] specials.php 

----------------------------------------------------*/
define('CURRSCRIPT','specials');
require('includes/global.php');

include DIR_dzsw.'languages/specials.php';


include DIR_dzsw.'includes/user/cla.products.php';
$C_SPECIALS = new products();

$C_SPECIALS->__set('type','specials');
$products_array = $C_SPECIALS->get_list();

$hassee_products = get_hassee();
$search_history = getsearchhistory();
$image_width = $settings['smallimage_width2']+2;

$page_trail[] = array('title' => $lang_specials['navbar']);
$page_position =  page_trail();
include template("specials");

?>
