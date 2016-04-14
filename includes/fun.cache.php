<?php

/*----------------------------------------------------
	[dzsw] admin/cache.php 

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

function updatecache($cachefile_name = '') {
	switch($cachefile_name){
		case 'styles':
			cache_styles();       
		break;
		case 'index':
			cache_index();       
		break;
		case 'usergroup':
			cache_usergroup();
		break;
		case 'admingroup':
			cache_admingroup();
		break;
		case 'settings':
			cache_settings();
		break;
		case 'categories':
			cache_categories();
		break;
		case 'classes':
			cache_classes();
		break;
		case 'news':
			cache_news();
		break;
		case 'links':
			cache_links();
		break;
		case 'email':
			cache_email();
		break;
		case 'area':
			cache_area();
		break;
		case 'shipping':
			cache_shipping();
		break;
		case 'shipping_define':
			cache_shipping_define();
		break;
		case 'payment':
			cache_payment();
		break;	
		case 'area':
			cache_area();
		break;
		default:
			cache_styles();     
			cache_usergroup(); 
			cache_admingroup();
			cache_settings();
			cache_classes();
			cache_news();
			cache_links();
			cache_index();
			cache_email();
			cache_area();
			cache_shipping();
			cache_shipping_define();
			cache_payment();
		break;
	}
}

function cache_index() {
    global $db, $table_products, $table_specials, $table_source, $table_news, $settings;

    $num_a_row = (is_numeric($settings['index_productnumarow']) && $settings['index_productnumarow']>0) ? $settings['index_productnumarow'] : 3;
	$query_and = $settings['stock_limitshow'] != true ? "and p.available = '1'" : '';

	$total = $num_a_row * ((is_numeric($settings['index_newproductnumofrow']) && $settings['index_newproductnumofrow']>0) ? $settings['index_newproductnumofrow'] : '0');

	$index_new_product_array = explode(',',$settings['index_new_productid']);
	$index_new_productids = get_strings($index_new_product_array);
	if($index_new_productids){
		$product_data = $db->get_one("select count(*) as count from $table_products p where p.products_id in ($index_new_productids) and p.status = '1' ".$query_and);
		if($product_data['count'] == '0'){
			$define_total = "0";
			$leave_num = $total;
		}elseif($product_data['count'] < $total){
			$define_total = $product_data['count'];
			$leave_num = $total - $product_data['count'];
		}elseif($product_data['count'] >= $total){
			$define_total = $product_data['count'];
			$leave_num = "0";			
		}
	}

	$nproducts = array();
	if($define_total){
		$query = $db->query("select p.products_id, p.price, p.name, p.s_p, p.image, if(p.s_p>0, sp.s_price, NULL) from $table_products as p left join $table_specials sp on p.products_id = sp.pid where p.products_id in ($index_new_productids) and p.status = '1' ".$query_and." order by p.date_added desc limit $define_total");
		while ($new_products = $db->fetch_array($query)) {
			$image_data = $db->get_one("select path,name,extension from $table_source where id='".$new_products['image']."' order by id limit 1");
			$new_products['imagesrc'] =	get_image_src($image_data);
			$nproducts[$new_products['products_id']] = $new_products;
		}	
		$index_new_products = array();
		if(is_array($index_new_product_array)){
			foreach($index_new_product_array as $v){
				if(is_array($nproducts[$v])){
					$index_new_products[] = $nproducts[$v];
				}
			}
		}
		$query_and_new .= " and p.products_id not in ($index_new_productids) ";
	}
	if($leave_num){
		$query = $db->query("select p.products_id, p.price, p.name, p.s_p, p.image, IF(p.s_p>0 , sp.s_price, NULL) from $table_products p left join $table_specials sp on p.products_id = sp.pid where p.status = '1' ".$query_and_new." order by p.date_added desc limit $leave_num");
		while ($new_products = $db->fetch_array($query)) {
			$image_data = $db->get_one("select path,name,extension from $table_source where id='".$new_products['image']."' order by id limit 1");
			$new_products['imagesrc'] =	get_image_src($image_data);
			$index_new_products[] = $new_products;
		}
	}
	$date_value = "\$INDEX_NEW_CACHE = ".arraydate_more($index_new_products).";\n\n"; 


	$total = $num_a_row * ((is_numeric($settings['index_sproductnumofrow']) && $settings['index_sproductnumofrow']>0) ? $settings['index_sproductnumofrow'] : '0');
	$index_s_product_array = explode(',',$settings['index_s_productid']);
	$index_s_productids = get_strings($index_s_product_array);
	if($index_s_productids){

		$product_data = $db->get_one("select count(*) as count from $table_products p where p.products_id in ($index_new_productids) and p.status = '1' and p.s_p = '1' $query_and");
		if($product_data['count'] == '0'){
			$define_total = "0";
			$leave_num = $total;
		}elseif($product_data['count'] < $total){
			$define_total = $product_data['count'];
			$leave_num = $total - $product_data['count'];
		}elseif($product_data['count'] >= $total){
			$define_total = $product_data['count'];
			$leave_num = "0";			
		}
	}
	
	$sproducts = array();
	if($define_total){
		$query = $db->query("select p.products_id, p.price, p.name, p.s_p, p.image, sp.s_price from $table_products p left join $table_specials sp  on p.products_id = sp.pid where p.products_id in ($index_new_productids) and p.status = '1' and p.s_p = '1' $query_and order by p.date_added desc limit $define_total");
		while ($s_products = $db->fetch_array($query)) {
			$image_data = $db->get_one("select path,name,extension from $table_source where id='".$s_products['image']."' order by id limit 1");
			$s_products['imagesrc'] =	get_image_src($image_data);
			$sproducts[$s_products['products_id']] = $s_products;
		}	
		$index_s_products = array();
		if(is_array($index_s_product_array)){
			foreach($index_s_product_array as $v){
				if(is_array($sproducts[$v])){
					$index_s_products[] = $sproducts[$v];
				}
			}
		}
		$query_and_s .= " and products_id not in ($index_new_productids) ";
	}
	if($leave_num){
		$query = $db->query("select p.products_id, p.price, p.name, p.s_p, p.image, sp.s_price from $table_products p left join $table_specials sp on p.products_id = sp.pid where p.status = '1' and p.s_p = '1' $query_and_s order by p.date_added desc limit $leave_num");
		while ($s_products = $db->fetch_array($query)) {
			$image_data = $db->get_one("select path,name,extension from $table_source where id='".$s_products['image']."' order by id limit 1");
			$s_products['imagesrc'] =	get_image_src($image_data);
			$index_s_products[] = $s_products;
		}
	}
	$date_value .= "\$INDEX_S_CACHE = ".arraydate_more($index_s_products).";\n\n"; 

	create_cache('index', $date_value, 'cache_','VAR');	
}

function cache_styles() {
    global $db, $table_styles, $table_templates;

	$query = $db->query("SELECT s.*, t.directory AS tpldirname FROM $table_styles s LEFT JOIN $table_templates t ON s.tid=t.tid");
	while($query_data = $db->fetch_array($query)) {
		create_cache($query_data['styleid'], arraydate_one('styles', $query_data), 'cache_style_');
	}
}

function cache_usergroup() {
    global $db,$GLOBALS, $table_usergroups;
    $query = $db->query("SELECT * FROM $table_usergroups");
	$groups = array();
	while($query_data = $db->fetch_array($query)) {
		$groups[] = $query_data;
		create_cache($query_data['groupid'],arraydate_var($query_data,'VAR'), 'cache_usergroup_','VAR');
	}
	$date_value="\$USERGROUPFAQ_CACHE = ".arraydate_more($groups).";\n\n"; 
	create_cache('faq', $date_value, 'cache_usergroup_');
}

function cache_admingroup() {
    global $db,$GLOBALS, $table_admingroups;
    $query = $db->query("SELECT * FROM $table_admingroups");
	while($data = $db->fetch_array($query)) {
		create_cache($data['admingroupsid'],arraydate_var($data,'VAR'), 'cache_admingroup_');
	}
}

function cache_settings() {
    global $db, $table_settings;
	$query = $db->query("SELECT settings_key, value FROM $table_settings");
	$data_array=array();
	while($data = $db->fetch_array($query)) {
		$data_array[$data[settings_key]] = $data[value];
	}
	create_cache('settings', arraydate_one('settings',$data_array), 'cache_');    
}

function cache_classes() {
	global $db, $table_classes;
	$query = $db->query("SELECT classes_id, classes, title, parent_id, sort_order, showinheader  FROM $table_classes ORDER BY sort_order");
	$data_array = array();
	while($data = $db->fetch_array($query)) {
		$data_array[$data['classes_id']]= $data;
		if($data['showinheader']){
			$data_showinheader[$data['classes_id']]= $data;
		}
	}
	$date_value = "\$cache_classes = ".arraydate_more($data_array).";\n\n"; 
	create_cache('classes', $date_value, 'cache_');  

	$query = $db->query("SELECT classes_id, title FROM $table_classes where showinheader>0 ORDER BY showinheader,sort_order");	
	$data_array = array();
	while($data = $db->fetch_array($query)) {
		$data_array[$data['classes_id']]= $data;
	}
	$date_value = "\$cache_classes_showinheader = ".arraydate_more($data_array).";\n\n"; 
	create_cache('classes_showinheader', $date_value, 'cache_'); 
}


function cache_shipping() {
	global $db, $table_shipping, $table_shipping_fee;
	$query = $db->query("SELECT * FROM $table_shipping ORDER BY sortorder");
	$data_array = array();
	while($query_data = $db->fetch_array($query)) {
		$data_array[$query_data['id']]= $query_data;
	}
	$date_value = "\$cache_shipping = ".arraydate_more($data_array).";\n\n";   

	$query = $db->query("SELECT * FROM $table_shipping_fee ORDER BY id");	
	$data_array = array();
	while($query_data = $db->fetch_array($query)) {
		$data_array[$query_data['id']]= $query_data;
	}
	$date_value .= "\$cache_shipping_fee = ".arraydate_more($data_array).";\n\n"; 
	create_cache('shipping', $date_value, 'cache_'); 
}

function cache_shipping_define() {
	global $db, $table_shipping;
	$query = $db->query("SELECT * FROM $table_shipping WHERE type='define' ORDER BY sortorder");
	$data_array_define = array();
	while($query_data = $db->fetch_array($query)) {
		$data_array_define[$query_data['id']] = $query_data;
	}
	$date_value_define = "\$cache_shipping_define = ".arraydate_more($data_array_define).";\n\n"; 
	create_cache('shipping_define', $date_value_define, 'cache_'); 
}

function cache_payment(){
	global $db, $table_payment, $table_payment_a;
	$query = $db->query("SELECT id, parentid, pay_key, description, status, type, title  FROM $table_payment ORDER BY sort_order");
	$data_array = $data_key_array = array();
	while($data = $db->fetch_array($query)) {
		$query2 = $db->query("SELECT pakey, pvalue, title FROM $table_payment_a where pid='".$data['id']."' ORDER BY sort_order");
		while($data2 = $db->fetch_array($query2)) {
			$data['pa'][$data2['pakey']] = array('title'=>$data2['title'],'value'=>$data2['pvalue']);
		}
		$data_array[$data['id']]= $data;
		$data_key_array[$data['pay_key']]= $data;
	}

	$date_value = "\$cache_payment = ".arraydate_more($data_array).";\n\n";
	create_cache('payment', $date_value, 'cache_'); 

	$date_value = "\$cache_payment_key = ".arraydate_more($data_key_array).";\n\n";
	create_cache('payment_key', $date_value, 'cache_');
}

function cache_news() {
	global $db,$table_news,$settings;

	$query_num = (is_numeric($settings['index_newsshownum']) && $settings['index_newsshownum']>0) ? $settings['index_newsshownum'] : 6;

	$query = $db->query("select id, subject,date_add from $table_news order by date_add DESC LIMIT $query_num");
	$data_array = array();
	while ($query_data = $db->fetch_array($query)) {
		$query_data['date_add'] = gmdate($settings['date_format'], $query_data['date_add']+ $settings['time_ofset'] * 3600);
		$data_array[$query_data['id']] = $query_data;
	} 
	$date_value .= "\$NEWS_CACHE = ".arraydate_more($data_array).";\n\n"; 

	create_cache('news', $date_value, 'cache_');  
}

function cache_links() {
	global $db,$table_links;
	$query = $db->query("select * from $table_links order by ordernum");
	$link_logo = $link_text = '';
	while ($link = $db->fetch_array($query)) {
		if($link['logo']) {
			$link_logo .= " &nbsp; <a href=\"$link[url]\" target=\"_blank\"><img src=\"$link[logo]\" border=\"0\" alt=\"$link[name]\"></a>";
		} else {
			$link_text .= "<a href=\"$link[url]\" target=\"_blank\">[$link[name]]</a> ";
		}
	} 
	$date_value = array('a'=>$link_logo,'b'=>$link_text); 
	$date_value = "\$cache_links = ".arraydate_more($date_value).";\n\n"; 
	create_cache('links', $date_value, 'cache_');  
}

function cache_email() {
	global $settings, $styles;
	require DIR_dzsw.'languages/email.php';

	ob_start();
	ob_clean();
	include template("email_order_cancel");
	$emailmessage = ob_get_clean();
	create_emailhtml("order_cancel",$emailmessage);

	ob_start();
	ob_clean();
	include template("email_order_create");
	$emailmessage = ob_get_clean();
	create_emailhtml("order_create",$emailmessage);

	ob_start();
	ob_clean();
	include template("email_createaccount");
	$emailmessage = ob_get_clean();
	create_emailhtml("createaccount",$emailmessage);

	ob_start();
	ob_clean();
	include template("email_adminorder");
	$emailmessage = ob_get_clean();
	create_emailhtml("adminorder",$emailmessage);
}

function cache_area() {
	global $db,$table_area;
	$query = $db->query("select * from $table_area order by id");
	$arraydate_country = $arraydate_province = $arraydate_city = $data_array = '';
	$country_num = $province_num = $city_num = 0;
	while ($area = $db->fetch_array($query)) {
		if($area['type'] == '0')
		{
			$arraydate_country .= "countryid[".$country_num."] = \"".$area['id']."\";\n";
			$arraydate_country .= "countryname[".$country_num."] = \"".$area['name']."\";\n";
			$country_num ++;
		}
		elseif($area['type'] == '1')
		{
			$arraydate_province .= "provinceid[".$province_num."] = \"".$area['parentid'].'|'.$area['id']."\";\n";
			$arraydate_province .= "provincename[".$province_num."] = \"".$area['name']."\";\n";
			$province_num ++;			
		}
		elseif($area['type'] == '2')
		{
			$arraydate_city .= "cityid[".$city_num."] = \"".$area['parentid'].'|'.$area['id']."\";\n";
			$arraydate_city .= "cityname[".$city_num."] = \"".$area['name']."\";\n";
			$city_num ++;			
		}
		$data_array[$area['id']]= $area;
	}
	$date_value .= "\$cache_area = ".arraydate_more($data_array).";\n\n"; 
	create_cache('area', $date_value, 'cache_'); 

	$date_value = "var countryid = new Array;\n";
	$date_value .= "var countryname = new Array;\n";
	$date_value .= "var provinceid = new Array;\n";
	$date_value .= "var provincename = new Array;\n";
	$date_value .= "var cityid = new Array;\n";
	$date_value .= "var cityname = new Array;\n\n";
	$date_value .= $arraydate_country."\n\n"; 
	$date_value .= $arraydate_province."\n\n";
	$date_value .= $arraydate_city."\n\n";

	create_js('province', $date_value);  
}

function arraydate_more($array, $level = 0) {
	for($i = 0; $i <= $level; $i++) {
		$space .= "\t";
	}
	$cachedata = "array\n$space(\n";
	$global = "$space";
	if(is_array($array)){
		foreach($array as $key => $val) {
			$key = is_string($key) ? "'".addcslashes($key, '\'\\')."'" : $key;
			$val = is_string($val) ? "'".addcslashes($val, '\'\\')."'" : $val;
			if(is_array($val)) {
				$cachedata .= "$global$key => ".arraydate_more($val, $level + 1);
			} else {
				if($val=='') {
					$cachedata .= "$global$key => ''";
				}else{
					$cachedata .= "$global$key => $val";
				}
			}
			$global = ",\n$space";
		}
	}
	$cachedata .= "\n$space)";
	return $cachedata;
}

function arraydate_one($name,$data_array){
	$cachedata="\$$name = array(\n\n"; 
	if(is_array($data_array)){
		foreach($data_array as $key=>$val){
			$cachedata.="\t'$key'=>'$val',\n";
		}
	}
	$cachedata.=");\n";
	return $cachedata;
}

function arraydate_var($data_array,$type='VAR'){
	$cachedata='';
	if(is_array($data_array)){
		foreach($data_array as $key => $val) {
			$val = str_replace("'", "\\'", $val);
			$cachedata .= $type == 'VAR' ? "\$$key = '$val';\n" : "define('".strtoupper($key)."', '$val');\n";
		}
	}
	return $cachedata;
}

function create_emailhtml($script_name,$data = '') {
	global $styles, $lang_a_error;
	$dir = DIR_dzsw.'data/emailtemplate/';
	$script_name = $styles['tpldirname'].'_'.$script_name;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}		
	if($fp = @fopen("$dir$script_name.htm", 'w')) {
	    fwrite($fp, $data);
		fclose($fp);
	} else {
		echo $lang_a_error['create_emailhtml'];
		output();
	}
}

function create_js($script_name,$cachedata = '') {
	global $lang_a_error;
	$dir = DIR_dzsw."js/";
	if(!is_dir($dir)) {
	    @mkdir($dir, 0777);
	}		
	if($fp = @fopen("$dir$script_name.js", 'w')) {
	    fwrite($fp, $cachedata);
		fclose($fp);
	} else {
		echo $lang_a_error['create_js'];
		output();
	}
}

function create_cache($script_name,$cachedata = '', $prefix = 'cache_') {
	global $settings, $timestamp, $lang_a_error;
	$dir = DIR_dzsw."data/cache/";
	if(!is_dir($dir)) {
	    @mkdir($dir, 0777);
	}		
	if($fp = @fopen("$dir$prefix$script_name.php", 'w')) {
	    fwrite($fp, "<?php\n//dzsw cache file\n".
		      "//Filename $dir$prefix$script_name.php\n".
		    	"//Created on ".gmdate($settings['date_format'], $timestamp + $settings['time_ofset'] * 3600)."\n\n$cachedata?>");
		fclose($fp);
	} else {
		echo $lang_a_error['create_cache'];
		output();
	}
}
