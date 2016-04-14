<?php

/*------------------------------------------------
	[dzsw] product_detail.php 


------------------------------------------------*/
define('CURRSCRIPT','product_detail');
require('includes/global.php');

include DIR_dzsw.'languages/product_detail.php';

include DIR_dzsw.'includes/user/cla.products.php';
$C_PRODUCT = new products($products_id);
$C_PRODUCT->__set('type','detail');
$C_PRODUCT->__set('product_id',$products_id);
$product_detail = $C_PRODUCT->get_detail();
$product_classes = $C_PRODUCT->get_classes();

if(!is_array($product_detail)){
	s_redirect("showmessage.php?type=product_notfont");
	exit;
}

include DIR_dzsw.'includes/user/cla.review.php';
$C_REVIEW = new review($products_id);
$C_REVIEW->__set('product_id',$products_id);
$review_array = $C_REVIEW->get_list();

make_hassee($product_detail);

$page_trail[] = array('title' => s_wordscut($product_detail['pname'],25));
$page_position = page_trail();
include template("product_detail");

?>

