<?php

/*----------------------------------------------------
	[dzsw] includes/common.php

----------------------------------------------------*/

if(!defined('IN_dzsw')) {
    exit('Access Denied');
}

function get_image_src($image_data, $type = 'small') {
	global $settings, $styles;
	
	if(!$image_data['name']){
		$filename = $styles['imagedir']."/nopicture.gif";
	}elseif($type == 'small' && $settings['smallimage_width'] >0 && is_numeric($settings['smallimage_width']) && $settings['create_smallimage'] == 'true'){
		$filename = DIR_dzsw.'upload/small/'.$image_data['path'].'/'.$image_data['name'].'.jpg';
	}elseif($type == 'small2' && $settings['smallimage_width2'] >0 && is_numeric($settings['smallimage_width2']) && $settings['create_smallimage'] == 'true'){
		$filename = DIR_dzsw.'upload/small2/'.$image_data['path'].'/'.$image_data['name'].'.jpg';
	}else{
		$filename = DIR_dzsw.'upload/common/'.$image_data['path'].'/'.$image_data['name'].$image_data['extension'];
	}

	return $filename;
}

function navgation() {
    global $page_trail;
	krsort($page_trail);
	$trail_string = '';
	if(is_array($page_trail)){
		foreach($page_trail as $val){
			$trail_string .= $val['title'];
			$trail_string .= ' - ';
		}
	}
    return $trail_string;
}

function page_trail() {
    global $page_trail_all, $page_trail;
	$trail_string = '';
    $trail_array = array_merge($page_trail_all, $page_trail);
	for ($i=0, $n=sizeof($trail_array); $i<$n; $i++) {
		$trail_array[$i]['title'] = s_wordscut($trail_array[$i]['title'],15);
		if (isset($trail_array[$i]['link']) && $trail_array[$i]['link']) {
            $trail_string .= '<a href="'.$trail_array[$i]['link'].'" '.$trail_array[$i]['pam'].'>'.$trail_array[$i]['title'].'</a>';
		} else {
            $trail_string .= $trail_array[$i]['title'];
		}
		if (($i+1) < $n) $trail_string .= ' -&gt; ';
    }
    return $trail_string;
}

function output() {
    exit;
}

function template($file, $tpldirname = '') {
	global $styles;
	$tpldirname = $tpldirname ? $tpldirname : $styles['tpldirname'];
	$filename =  file_exists(DIR_dzsw.'templates/'.$tpldirname.'/'.$file.'.htm')? DIR_dzsw.'templates/'.$tpldirname.'/'.$file.'.htm' : DIR_dzsw.'templates/default/'.$file.'.htm' ;
	return $filename;
}

function emailtemplate($file, $emaildir = '') {
	global $styles;
	$nowfile = DIR_dzsw.'data/emailtemplate/'.$styles['tpldirname'].'_'.$file.'.htm';
	$defaultfile = DIR_dzsw.'data/emailtemplate/default_'.$file.'.htm';
	$filename = file_exists($nowfile) ? $nowfile : $defaultfile;
	return $filename;
}

function emailcontents($tplname){
	if(!$emailcontents = @file_get_contents(emailtemplate($tplname))){
		updatecache("email");
		$emailcontents = @file_get_contents(emailtemplate($tplname));
	}
	return $emailcontents;
}

function s_debuginfo() {
	global $settings;
	if($settings['display_pageparseinfo'] == 'true') {
		global $db, $starttime;
		$mtime = explode(' ', microtime());
		$totaltime = number_format(($mtime[1] + $mtime[0] - $starttime), 6);
		echo '<br>Page create in '.$totaltime.' second(s), '.$db->querynum.' db queries'.
			($settings['gzip_compression'] == 'true' ? ', Gzip enabled' : NULL);
	}
}

function s_random($leng) {
	$text = '';
	$var = md5('0123456789');
	$max = strlen($var) - 1;
	mt_srand((double)microtime() * 1000000);
	for($i = 0; $i < $leng; $i++) {
		$text .= $var[mt_rand(0, $max)];
	}
	return $text;
}

function s_wordscut($string, $length) {
	if(strlen($string) > $length) {
		for($i = 0; $i < $length - 3; $i++) {
			if(ord($string[$i]) > 127) {
				$wordscut .= $string[$i].$string[$i + 1];
				$i++;
			} else {
				$wordscut .= $string[$i];
			}
		}
		return $wordscut.' ...';
	}
	return $string;
}

function s_redirect($url) {
    header('Location: ' . $url);
    exit;
}

function s_price($product) {
	global $groupdiscount, $customer_id, $db, $table_specials, $lang_price, $settings;
	$price = array();

	$price['one']['value'] = $product['price'];
	$price['one']['text'] = $lang_price['common_'];
	$price['one']['price'] = display_price($product['price']);
	
	if($product['s_p']){
		if(!$product['s_price']){
			$get_one = $db->get_one("SELECT s_price, endtime FROM $table_specials where pid  = '".$product['products_id']."' limit 1");
			$product['s_price'] = $get_one['s_price'];
		}	
		$price['two']['value'] = $product['s_price'];
		$price['two']['text'] = $lang_price['specials_'];
		$price['two']['price'] = display_price($price['two']['value']);	
    }elseif($customer_id && $groupdiscount >= 1 && $groupdiscount < 10 && $settings['customer_mark'] == 'true'){
		
		$price['two']['value'] = $product['price'] * $groupdiscount / 10;
		$price['two']['text'] = $lang_price['customers_'];
		$price['two']['price'] = display_price($price['two']['value']);	
		
    }elseif($settings['default_discount'] > 0 && $settings['default_discount'] < 10 && $settings['customer_mark'] == 'true'){
		$discount = is_numeric($settings['default_discount']) ? $settings['default_discount'] : '10'; 

		$price['two']['value'] = $product['price'] * $discount / 10;
		$price['two']['text'] = $lang_price['customers_'];
		$price['two']['price'] = display_price($price['two']['value']);

    }elseif($settings['customer_mark'] != 'true'){

		$price['two']['type'] = 'one';
		$price['two']['value'] = $product['price'];
		$price['two']['text'] = $lang_price['common_'];
		$price['two']['price'] = display_price($product['price']);

    }else{
		$price['two']['value'] = '';
		$price['two']['text'] = '';
		$price['two']['price'] = '';
	}
		
	return $price;
}

function display_price($products_price, $quantity = 1) {
    global $lang_common;
	$format_string = $lang_common['symbol_left']. number_format(s_round($products_price * $quantity,2), 2, '.', ',') .' '.$lang_common['symbol_right'];
    return $format_string;
}

function format_price($price) {
    $format_string = number_format(s_round($price,2), 2, '.', ',');
    return $format_string;
}

function shtmlspecialchars($varchar) {
	if(is_array($varchar)) {
		foreach($varchar as $key => $value) {
			$varchar[$key] = shtmlspecialchars($value);
		}
	} else {
		$varchar = str_replace('&amp;','&',$varchar);
		$varchar = str_replace('&nbsp;',' ',$varchar);
		$varchar = str_replace('"','&quot;',$varchar);
		$varchar = str_replace("'",'&#39;',$varchar);
		$varchar = str_replace("<","&lt;",$varchar);
		$varchar = str_replace(">","&gt;",$varchar);
		$varchar = str_replace("\t","   &nbsp;  &nbsp;",$varchar);
		$varchar = str_replace("\r","",$varchar);
		$varchar = str_replace("   "," &nbsp; ",$varchar);
		$varchar = preg_replace('/&amp;(#\d{3,5};)/', '&\\1', $varchar);
	}
	return $varchar;
}

function s_unhtmlspecialchars($varchar) {
	return strtr($varchar, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
}

function s_referer(){
	global $direct_referer;
	if(!strpos($direct_referer, '.php') || strpos($direct_referer, 'login.php') || strpos($direct_referer, 'register.php')) {
		$direct_referer = 'index.php';
	}
	return $direct_referer;		
}

function saddslashes($array){
	if(is_array($array)){
		foreach($array as $key=>$value){
			if(!is_array($value)){
				$value = preg_replace("/ +/", ' ', trim(stripslashes($value)));
				$value = preg_replace("/[<>]/", '_', $value);
				$array[$key]=addslashes($value);
		    }else{
				saddslashes($value);
		    }
		}
	}
	return $array;
}

function s_multi($total, $num_a_page = 15, $page, $url = '',$name='') { 
	global $lang_common;
	if($total > $num_a_page) {
		if($page<=3){
			$start     = '1'; 
			$ended     = $page+3; 
		}else{
			$start     = $page-3; 
			$ended     = $page+3; 
		}
		$totalpage = ceil($total/$num_a_page);
		if($ended>$totalpage){
			$ended = $totalpage;
		}
		$multipage = $lang_common['muli_total_'].''.$total.'&nbsp;&nbsp;&nbsp;'.$lang_common['muli_page_'].''.$totalpage.'&nbsp;&nbsp;&nbsp;'.$lang_common['curr_page_'].''.$page.'&nbsp;';
		$multipage .= '&nbsp;&nbsp;&nbsp;';
		$multipage .= ($page>2) ? '<a href="'.$url.'&page=1'.$name.'">&lt;&lt;&lt;</a> &nbsp;' : '';
		$multipage .= ($page>1) ? '<a href="'.$url.'&page='.(($page-1)=="0" ? "1" : ($page-1)).$name.'">&lt;</a> &nbsp;' : '';
		for($i=$start;$i<=$ended;$i++) { 
			if($i != $page) {
				$multipage .= '<span><a href="'.$url.'&page='.$i.$name.'">'.$i.'</a>&nbsp;</span>';
			} else {
				$multipage .= '<span style="font-weight: bold;">'.$i.'&nbsp;</span>';
			}
		} 
		$multipage .= ($page<$totalpage) ? ' <a href="'.$url.'&page='.($page+1).$name.'">&gt;</a>' : '';
		$multipage .= ($page<($totalpage-1)) ? ' <a href="'.$url.'&page='.$totalpage.$name.'">&gt;&gt;&gt;</a> &nbsp;' : '';
		return $multipage; 
	}
} 

function s_round($number, $precision) {
	if (strpos($number, '.') && (strlen(substr($number, strpos($number, '.')+1)) > $precision)) {
		$number = substr($number, 0, strpos($number, '.') + 1 + $precision + 1);
		if (substr($number, -1) >= 5) {
			if ($precision > 1) {
				$number = substr($number, 0, -1) + ('0.' . str_repeat(0, $precision-1) . '1');
			} elseif ($precision == 1) {
				$number = substr($number, 0, -1) + 0.1;
			} else {
				$number = substr($number, 0, -1) + 1;
			}
		} else {
			$number = substr($number, 0, -1);
		}
    }
    return $number;
}

function cacheexists ($filename,$pam = ''){
	if($pam == ''){
		$pam = $filename;
	}
	if(!file_exists(DIR_dzsw."data/cache/cache_".$filename.".php")){
		updatecache($pam);	
	}
	return DIR_dzsw."data/cache/cache_".$filename.".php";
}

function mkdir_recursive($dirName, $mode = '0777'){	
	$newDir = '';
	foreach(split('/',$dirName) as $dirPart){
		$newDir = "$newDir$dirPart/";
		if(!file_exists($newDir)){
			@mkdir($newDir, $mode);
		}
	}
}

function writefile($path,$filename,$data){
	mkdir_recursive($path);
	$handle = @fopen($path.$filename,'a');
	@fputs($handle,$data);
	@fclose($handle);
}

function get_strings($string_array, $type = 'forin') {
	$spacer = $string_in = '';
	if(is_array($string_array)){
		foreach($string_array as $val){
			if($type == 'forin'){
				$string_in .= "$spacer'".$val."'";
				$spacer=',';					
			}else{
				$string_in .= "$spacer".$val;
				$spacer=',';
			}
		}
	}
	return $string_in;
}

function array_value_same($priceedit){
	if(is_array($priceedit)){
		$priceedit_ = array_count_values($priceedit);
	}else{
		$priceedit_ = array();
	}

	$model_same = array();
	if(is_array($priceedit_)){
		foreach($priceedit_ as $key => $val){
			if($val > 1){
				$model_same[] = array('model' => $key, 'count' => $val);
			}
		}
	}
	return $model_same;
}

function order_total($total_array){
	global $lang_order_total, $settings;
	$total['product']		= $total_array['product'];
	$total['shipping']		= $total_array['shipping'];

	$order_total = 0;
	if(is_array($total)){
		foreach($total as $key=>$val){
			$order_total += $val;
		}
	}
	if($settings['user_leavepay'] == 'true'){
		if($order_total >= $total_array['leavermoney']){
			$total_array['leaverpay']	= $total_array['leavermoney'];
			$total_array['mustpay']		= $order_total - $total_array['leavermoney'];
		}else{
			$total_array['leaverpay']	= $order_total;
			$total_array['mustpay']	= 0;
		}
	}

   	$order_total_array['product']	= array(
		'title'				=> $lang_order_total['product'], 
		'money_value'		=> $total_array['product'],		
		'money_text'		=> display_price($total_array['product']),
	);
   	$order_total_array['shipping']	= array(
		'title'				=> $lang_order_total['shipping'],
		'money_value'		=> $total_array['shipping'],	
		'money_text'		=> display_price($total_array['shipping']),
	);
   	$order_total_array['total']		= array(
		'title'				=> $lang_order_total['total'],
		'money_value'		=> $order_total,	
		'money_text'		=> display_price($order_total),
	);
	if($settings['user_leavepay'] == 'true'){
		$order_total_array['leaverpay']	= array(
			'title'				=> $lang_order_total['leaverpay'],
			'money_value'		=> $total_array['leaverpay'],			'money_text'		=> display_price($total_array['leaverpay']),
		);
		$order_total_array['mustpay']	= array(
			'title'				=> $lang_order_total['mustpay'],
			'money_value'		=> $total_array['mustpay'],				'money_text'		=> display_price($total_array['mustpay'])
		);
	}
	return $order_total_array;
}

function sendmail($toaddress,$subject = '', $message, $fromaddress = '') {
	new shop_mail($toaddress,$subject, $message);
}

function shipping_title($shipping_data,$lang_shipping){
	if($shipping_data['title']){
		$shipping_title = $shipping_data['title'];
	}elseif($lang_shipping[$shipping_data['filename']]){
		$shipping_title = $lang_shipping[$shipping_data['filename']];
	}else{
		$shipping_title = $shipping_data['title'];
	}
	return $shipping_title;
}

function payment_title($payment_data, $lang_payment){
	if($payment_data['title']){
		$payment_title = $payment_data['title'];
	}else{
		$payment_title = $lang_payment[$payment_data['pay_key']];
	}
	return $payment_title;
}

function payment_a_title($val,$lang_payment_a){
	if(is_array($val['pa'])){
		foreach($val['pa'] as $k=>$v){
			if($v['title']){
				$v['title'] = $v['title'];
			}elseif($k == 'manname' || $k == 'cartnum'){
				$v['title'] = $lang_payment_a['banktransfer'][$k];
			}else{
				$v['title'] = $lang_payment_a[$val['pay_key']][$k];
			}
			$val['pa'][$k] = $v;
		}
	}
	return $val['pa'];
}

if(!function_exists("file_get_contents"))
{
	function file_get_contents($filename)
	{
		if(($contents = file($filename)))
		{
			$contents = implode('', $contents);
			return $contents;
		}
		else {
			return false;
		}
	}
}

if(!function_exists("ob_clean"))
{
	function ob_clean()
	{
		ob_end_clean();
	}
}

if(!function_exists("ob_get_clean")) 
{
	function ob_get_clean() {
       $ob_contents = ob_get_contents();
       ob_end_clean();
       return $ob_contents;
	}
}

if(!function_exists("floatval")) 
{
	function ob_get_clean($val) {
		$val = doubleval($val);
		return $val;
	}
}
