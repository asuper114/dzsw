<?php

/*----------------------------------------------------
	[dzsw] admin/shipping.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
	exit('Access Denied');
}

if($admingroupsid != '1'){
	admin_msg($lang_a_common['forbid']);
}

if($action == 'editsort'){
	
	if(is_array($sort)){
		foreach($sort as $key=>$val){
			$db->query("update $table_shipping set sortorder='".$val."' where id='".$key."'");
		}
	}
	$ids = get_strings($delete);
	if($ids){
		$db->query("delete from $table_shipping where id in ($ids)");
		$db->query("delete from $table_shipping_fee where shippingid in ($ids)");
	}
	updatecache("shipping");
	admin_msg($lang_a_message['update_success'],'referer');	

}elseif($action == 'showarea'){
	
	if($settings['country_detault'] != ''){
		$country_default = $settings['country_detault'];
	}	

	$show_country = false;
	$show_province = false;
	$show_city = false;
	if($settings['show_country'] == 'true' && $areatype == 'country'){
		
		$show_country = true;
		$show_province = false;
		$show_city = false;
	
	}elseif($areatype == 'province'){
		
		if($settings['show_country'] == 'true'){
			$show_country = true;
		}
		$show_province = true;
		$show_city = false;

	}elseif($areatype == 'city'){

		if($settings['show_country'] == 'true'){
			$show_country = true;
		}
		$show_province = true;
		$show_city = true;

	}

	if($afid){
		$shipping_data = $db->get_one("select shippingid from $table_shipping_fee  where id = '" . (int)$afid. "'");
	}

	include ADMIN_TPL.'shipping_area.htm';

}elseif($action == 'deletearea'){
	
	if($aid && $sfid){
		$shipping_data = $db->get_one("select * from $table_shipping_fee  where id = '" . (int)$sfid. "'");
		$city_array = explode(',',$shipping_data['area']);
		$city_array2 = array();
		if(in_array($aid,$city_array)){
			foreach($city_array as $val){
				if($aid != $val){
					$city_array2[] = $val;
				}
			}
		}
		
		$area_list = join(',',$city_array2);
		$sql_data_array = array(
			'area'	=> $area_list
		);
		$db->perform($table_shipping_fee, $sql_data_array,'update',"id='".(int)$sfid."'");
		updatecache("shipping");
	}
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'addnewfee'){
	
	if($id){
		$sql_data_array = array(
			'fee'			=> '30',
			'shippingid'	=> $id,
		);
		$db->perform($table_shipping_fee, $sql_data_array);
		updatecache("shipping");
	}
	admin_msg($lang_a_message['shipping_addfeearea_success'],'referer');

}elseif($action == 'deletefeearea'){

	$db->query("delete from $table_shipping_fee where id = '".$sfid."' limit 1");

	admin_msg($lang_a_message['shipping_deletefeearea_success'],'referer');

}elseif($action == 'updatefee'){

	if($fee != '' && $sfid != ''){
		$sql_data_array = array(
			'fee'	=> $fee
		);
		$db->perform($table_shipping_fee, $sql_data_array,'update',"id='".(int)$sfid."'");
		updatecache("shipping");
	}
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'shipping_addarea'){
	
	if($city){
		$areaid = $city;
	}elseif($province){
		$areaid = $province;
	}elseif($country){
		$areaid = $country;
	}

	if($areaid && $sfid){
		$shipping_data = $db->get_one("select * from $table_shipping_fee  where id = '" . (int)$sfid. "'");
		if($shipping_data['area']){
			$space = ',';
		}

		$area_array = explode(',',$shipping_data['area']);
		if(in_array($areaid,$area_array)){
			admin_msg($lang_a_message['shipping_error_areaexits'],'referer');
		}else{
			$query = $db->query("select * from $table_shipping_fee  where shippingid = '" . (int)$shipping_data['shippingid']. "' and id !='".(int)$sfid."'");
			while($shipping_data_ = $db->fetch_array($query)){
				$area_array = explode(',',$shipping_data_['area']);
				if(in_array($areaid,$area_array)){
					admin_msg($lang_a_message['shipping_error_areaexits_othor'],'referer');
				}
			}
			$area_list = $shipping_data['area'].$space.$areaid;
		}
		$sql_data_array = array(
			'area'	=> $area_list
		);
		$db->perform($table_shipping_fee, $sql_data_array,'update',"id='".(int)$sfid."'");
		updatecache("shipping");
		admin_msg($lang_a_message['update_success'],'admin.php?act=shipping&action=edit&id='.$shipping_data['shippingid'].'');
	}

}elseif($action == 'edit'){
	
	$message_all = array();

	$query = $db->query("select sf.*, s.title, s.filename, s.areatype from $table_shipping_fee as sf left join $table_shipping as s on sf.shippingid=s.id  where s.id = '" . (int)$id. "'");
	$shipping_data = array();
	while($shipping = $db->fetch_array($query)){
		$area_array = explode(',',$shipping['area']);
		$area_all = '';
		foreach($area_array as $key=>$val){
			$area_data = $db->get_one("select name from $table_area where id = '" . (int)$val. "'");
			$area_all .= '<a href="admin.php?act=shipping&action=deletearea&aid='.$val.'&sfid='.$shipping['id'].'">'.$area_data[name].'</a> ';
		}
		$shipping['area'] = $area_all;
		$shipping_data[] = $shipping;
	}

	$shipping_detail = $db->get_one("select * from $table_shipping where id = '" . (int)$id. "'");
	if($shipping_detail['type'] == 'system'){
		$shipping_detail_define['title'] = shipping_title($shipping_detail,$lang_shipping);
		$shipping_detail['title']  = $lang_shipping[$shipping_detail['filename']];
	}elseif($shipping_detail['type'] == 'define'){
		$shipping_detail['title']  = $shipping_detail['title'];
	}

	if(!file_exists(DIR_dzsw.'modules/shipping/'.$shipping_detail['filename'].'.php')){
		$message_all[] = sprintf($lang_a_shipping['filename_not_exists'],$shipping_detail['filename'].'.php');
	}

	//$shipping_detail['title'] = $lang_shipping[$shipping_detail['filename']];
	include ADMIN_TPL.'shipping_edit.htm';

}elseif($action == 'operatestatus'){
	
	if ( ($flag == '0') || ($flag == '1') ) {
		if(isset($id)) {
			$db->query("update $table_shipping set status = '".$flag."' where id = '" . (int)$id. "'");
        }
	}
	updatecache("shipping");
	$url_referer = $_SERVER[HTTP_REFERER];
	header("location:$url_referer");
	exit;

}elseif($action == 'doedit_shipping'){

	$sql_data_array = array(
		'title'			=> $title,
		'description'	=> $description,
		'desc_faq'		=> $desc_faq,
	);
	$db->perform($table_shipping, $sql_data_array,'update',"id='".(int)$id."'");
	updatecache("shipping");
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'setgoodsselfid'){
	
	if($goodsselfid){
		$db->query("update $table_settings set value = '".$goodsselfid."' where settings_key = '".GOODSSELFID."' limit 1");
	}
	admin_msg($lang_a_message['update_success'],'referer');

}elseif($action == 'add_shipping'){

	$message_all  = array();

	if($title && $filename){
		$shipping_data = $db->get_one("select count(*) as count from $table_shipping where filename = '$filename'");
		if($shipping_data['count']>0){
			$message_all[] = $lang_a_shipping['shipping_filename_exists'];
			$action = '';
		}else{
			$db->query("insert into $table_shipping (title,type,filename) values ('$title','define','$filename')");

			admin_msg($lang_a_message['update_success'],'referer');	
		}
	}

}

if(!$action && !$type){
	
	$query = $db->query("select * from $table_shipping order by sortorder");
	$shipping_data = array();
	while($query_data = $db->fetch_array($query)){
		if($query_data['type'] == 'system'){
			$query_data['title']  = $lang_shipping[$query_data['filename']];
		}elseif($query_data['type'] == 'define'){
			$query_data['title']  = $query_data['title'];
		}

		$shipping_data[] = $query_data;
	}

	include ADMIN_TPL.'shipping.htm';

}

?>

