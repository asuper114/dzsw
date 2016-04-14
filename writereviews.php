<?php
/*----------------------------------------------------
	[dzsw] writeviews.php 

----------------------------------------------------*/
define('CURRSCRIPT','writereviews');
require('includes/global.php');
include DIR_dzsw.'languages/writereviews.php';

$query_and = STOCK_LIMITSHOW != true ? "and available = '1'" : '';
$product_data = $db->get_one("select name from $table_products where products_id = '" . (int)$products_id. "' and status = '1' $query_and");

if (!$product_data['name']) {
    s_redirect("showmessage.php?type=product_review_notfont");
	exit;
}

if ($_POST['action'] && $_POST['action'] == 'process') {
    $continue_do = true;
    $message = '';
	
	if($email){
		if (!eregi("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]",$email)) { 
			$continue_do = false;
			$message_all[] = $lang_review['post_email_error'];
		}
	}

    if (strlen($review) < 1) {
         $continue_do = false;
         $message_all[] = $lang_review['post_review_empty'];
    }

    if (($rating < 1) || ($rating > 5)) {
		$continue_do = false;
        $message_all[] = $lang_review['post_rating_empty'];
    }

    if ($continue_do == true) {
        $db->query("insert into $table_reviews (products_id, email, review,rating, date_added,last_modified) values ('" . (int)$_POST['products_id']. "', '" .$email. "', '" . shtmlspecialchars($review). "','" . $rating. "', '".$timestamp."', '".$timestamp."')");
        s_redirect('showmessage.php?type=product_review_success&direct_referer='.rawurlencode("product_detail.php?products_id=".$products_id."#review"));
		exit;
    }
}

if($customer_id){
   $customer_data = $db->get_one("select email from $table_customers where customers_id = '" . (int)$customer_id. "'");
   $email = $customer_data['email'];
}

$page_trail[] = array('title' => $product_data['name'],'link'=>'product_detail.php?products_id='.$products_id);
$page_trail[] = array('title' => $lang_review['navbar']);
$page_position=  page_trail();
include template("writereviews");


?>
