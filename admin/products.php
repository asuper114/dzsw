<?php

/*----------------------------------------------------
	[dzsw] admin/products.php 

------------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

if(!$allow_product_see && $admingroupsid !=1){
    admin_msg($lang_a_message['forbid']);
}

include DIR_dzsw.'includes/admin/cla.products.php';
$C_PRODUCTS = new products();

if($h_action == 'operatestatus'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	if ( ($flag == '0') || ($flag == '1') ) {
		if(isset($products_id)) {
			$db->query("update ".$table_pre."products set status = '".$flag."', last_modified = '".$timestamp."' where products_id = '" . (int)$products_id. "'");
        }
	}
	updatecache("index");
	$url_referer = $_SERVER[HTTP_REFERER];
	s_redirect($url_referer);

}elseif($h_action == 'image_add'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	include DIR_dzsw."includes/cla.upload.php";
	$C_UPLOAD = new upload();
	$C_PRODUCTS->__set('product_id',$products_id);
	for($key = 0;$key < count($_FILES['image']['name']);$key++){
		$u_arrray = array(
			'filename'		=> 'image',	
			'num'			=> $key,	
			'title'			=> $image_title[$key],	
		);
		$C_PRODUCTS->upload_image($u_arrray);
	}
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_image&products_id='.$products_id);

}elseif($h_action == 'image_delete'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	deleteimage($id);
	updatecache("index");
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_image&products_id='.$pid);

}elseif($h_action == 'image_default'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	if($pid && $id){
		$db->query("update $table_products set image = '".$id."', last_modified = '".$timestamp."' where products_id = '" . (int)$pid. "'");
	}
	updatecache("index");
	header("location:admin.php?act=products&type=detail_image&products_id=".$pid."");

}elseif($h_action == 'update_common'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$sql_data_array = array(
		'quantity'			=> $quantity,
		'weight'			=> $weight,
		'status'			=> $status,
		'manufacturer'		=> $manufacturer,
		'last_modified'		=> $timestamp,
		'model'				=> $model,
		'name'				=> $name,
	);
	if($quantity > 0){
		$sql_data_array['available'] = '1';
	}else{
		$sql_data_array['available'] = '0';
	}
	$C_PRODUCTS->__set('product_id',$products_id);
	$C_PRODUCTS->update_common($sql_data_array);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_common&products_id='.$products_id);

}elseif($h_action == 'update_desc'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$sql_data_array = array(
		'base_info'			=> $base_info,
		'description'		=> $description,
	);
	$C_PRODUCTS->__set('product_id',$products_id);
	$C_PRODUCTS->update_common($sql_data_array);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_desc&products_id='.$products_id);

}elseif($h_action == 'update_classes'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$C_PRODUCTS->__set('product_id',$products_id);
	$result = $C_PRODUCTS->update_classes($newcid, $delete);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_classes&products_id='.$products_id);

}elseif($h_action == 'update_price'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$C_PRODUCTS->__set('product_id',$products_id);
	$result = $C_PRODUCTS->update_price($price, $s_price);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_price&products_id='.$products_id);

}elseif($h_action == 'copy'){
	if(!$allow_product_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$products_id_new = $C_PRODUCTS->docopy($products_id, $classes_id);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_common&products_id='.$products_id_new);

}elseif($h_action == 'delete'){
	if(!$allow_product_delete && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	if(is_array($products)){
		foreach($products as $key=>$val){
			remove_product($val);
		}
	}
	updatecache("index");
	admin_msg($lang_a_message['operate_success']);

}elseif($h_action == 'add'){
	if(!$allow_product_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$sql_data_array = array(
		'quantity'			=> $quantity,
		'weight'			=> $weight,
		'status'			=> $status,
		'manufacturer'		=> $manufacturer,
		'date_added'		=> $timestamp,
		'last_modified'		=> $timestamp,
		'model'				=> $model,
		'name'				=> $name,

		'classes_id'		=> $classes_id,
	);
	$C_PRODUCTS->add($sql_data_array);
	admin_msg($lang_a_message['operate_success'],'admin.php?act=products&type=detail_common&products_id='.$C_PRODUCTS->product_id);

}

if($type == 'detail_common'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$C_PRODUCTS->__set('type','detail');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();
	($product_data['status'] == '1') ? ($checked_1 = 'checked') : ($checked_0 = 'checked') ;
	$h_action = 'edit';
	include ADMIN_TPL.'product_detail_common.htm'; 

}elseif($type == 'detail_desc'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$C_PRODUCTS->__set('type','detail');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();
	$image_data = $C_PRODUCTS->get_image();

	include ADMIN_TPL.'product_detail_desc.htm'; 

}elseif($type == 'detail_image'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$C_PRODUCTS->__set('type','detail');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();

	$image_data = $C_PRODUCTS->get_image();

	include ADMIN_TPL.'product_detail_image.htm'; 

}elseif($type == 'detail_classes'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$C_PRODUCTS->__set('type','detail');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();
	$product_classes = $C_PRODUCTS->get_classes();

	$classes_select = classes_select();

	include ADMIN_TPL.'product_detail_classes.htm'; 

}elseif($type == 'detail_price'){
	if(!$allow_product_edit && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	$C_PRODUCTS->__set('type','specials');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();

	include ADMIN_TPL.'product_detail_price.htm'; 

}elseif($type == 'search'){
	include ADMIN_TPL.'products_search.htm';

}elseif($type == 'search_result'){
	$C_PRODUCTS->__set('type','search');
	$sql_where = array(
		'pname'				=> $name,
		'status'			=> $status,
		'base_info'			=> $base_info,
		'description'		=> $description,
		'pto'				=> $pto,
		'classes_id'		=> $classes_id,
	);
	$products_array = $C_PRODUCTS->get_list($sql_where);

	include ADMIN_TPL.'products_search_result.htm';

}elseif($type == 'specials'){
	$C_PRODUCTS->__set('type','specials');
	$sql_where = array(
		'pname'				=> $name,
		'status'			=> $status,
		'base_info'			=> $base_info,
		'description'		=> $description,
		'pto'				=> $pto,
		'classes_id'		=> $classes_id,
	);
	$products_array = $C_PRODUCTS->get_list($sql_where);
	$products = $products_array['detail'];
	$multipage = $products_array['multipage'];

	include ADMIN_TPL.'products_search_result.htm';

}elseif($type == 'class'){
	$classes = $C_PRODUCTS->classes_list();

	include ADMIN_TPL.'products_classes.htm';

}elseif($type == 'copy'){
	if(!$allow_product_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid'],'javascript:history.go(-1);','back');
	}
	
	$C_PRODUCTS->__set('type','detail');
	$C_PRODUCTS->__set('product_id',$products_id);
	$product_data = $C_PRODUCTS->get_detail();

	$class_data = $db->get_one("select cid from ".$table_pre."ptoc where pid = '" . (int)$products_id. "' limit 1");

	$classes_select = classes_select($class_data['cid']);

	include ADMIN_TPL.'products_copy.htm'; 

}elseif($type == 'add'){
	if(!$allow_product_add && $admingroupsid !=1){
		admin_msg($lang_a_common['forbid']);
	}
	
	$classes_select = classes_select();
	include ADMIN_TPL.'product_detail_common.htm'; 

}

?>