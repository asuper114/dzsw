<?php
/*----------------------------------------------------
	[dzsw] index.php 

----------------------------------------------------*/

define('CURRSCRIPT','index');

require('includes/global.php');

require DIR_dzsw.'languages/index.php';
include(cacheexists("index"));

$num_a_row = (is_numeric($settings['index_productnumarow']) && $settings['index_productnumarow']>0) ? $settings['index_productnumarow'] : 3;


$show_specials = false;
if(is_numeric($settings['index_sproductnumofrow']) && $settings['index_sproductnumofrow']>0 && $INDEX_S_CACHE['0']['products_id']){

	$s_products_list = array();
	$key = $key_t = 0;
	foreach($INDEX_S_CACHE as $products){
		$products_list = '<table>';
		$products_list .= '<tr><td><a href="product_detail.php?products_id='.$products['products_id'].'">'.$products['name'].'</ta></td></tr>';
		$products_list .= '<tr><td><a href="product_detail.php?products_id='.$products['products_id'].'"><img src="'.$products['imagesrc'].'" border="0" width="'.$settings['smallimage_width'].'"></ta></td></tr>';
		$price_array = s_price($products);
		$products_list .= '<tr><td align="left">'.$price_array['one']['text'].$price_array['one']['price'].'</ta></td></tr>';
		if($value['price_two'][$i]['type'] != 'one'){
			$products_list .= '<tr><td align="left">'.$price_array['two']['text'].$price_array['two']['price'].'</td></tr>';
		}
		$products_list .= '<tr><td><div style="float: left;"><a href="cart.php?action=add&products_id='.$products['products_id'].'">'.$lang_common[cartinput].'</a></div><div style="float: right;"><a href="product_detail.php?products_id='.$products['products_id'].'">'.$lang_common[detail].'</a></div></td></tr>';
		$products_list .= '</table>';
		
		$s_products_list[$key_t][] = $products_list;
		
		$key_t= !(++$key % $num_a_row) ? ++$key_t : $key_t;
    }
 
    if($s_products_list['0']){
		 $show_specials = true;
    }
}

$show_new = false;
if(is_numeric($settings['index_newproductnumofrow']) && $settings['index_newproductnumofrow']>0 && $INDEX_NEW_CACHE['0']['products_id']){
	$new_products_list = array();
	$key = $key_t = 0;
	foreach($INDEX_NEW_CACHE as $products){
		$products_list = '<table>';
		$products_list .= '<tr><td><a href="product_detail.php?products_id='.$products['products_id'].'">'.$products['name'].'</ta></td></tr>';
		$products_list .= '<tr><td><a href="product_detail.php?products_id='.$products['products_id'].'"><img src="'.$products['imagesrc'].'" border="0" width="'.$settings['smallimage_width'].'"></ta></td></tr>';
		$price_array = s_price($products);
		$products_list .= '<tr><td align="left">'.$price_array['one']['text'].$price_array['one']['price'].'</ta></td></tr>';

		if($price_array['two']['type'] != 'one'){
			$products_list .= '<tr><td align="left">'.$price_array['two']['text'].$price_array['two']['price'].'</td></tr>';
		}
		$products_list .= '<tr><td><div style="float: left;"><a href="cart.php?action=add&products_id='.$products['products_id'].'">'.$lang_common[cartinput].'</a></div><div style="float: right;"><a href="product_detail.php?products_id='.$products['products_id'].'">'.$lang_common[detail].'</a></div></td></tr>';
		$products_list .= '</table>';
		
		$new_products_list[$key_t][] = $products_list;
		
		$key_t= !(++$key % $num_a_row) ? ++$key_t : $key_t;
    }
 
    if($new_products_list['0']){
		 $show_new = true;
    }
}

if(is_array($cache_classes)){
	$classeslist = '';
	$classes_box = $classes_box_sun_ = array();
	foreach($cache_classes as $value) {
		if($value['parent_id'] == '0')  {
			$classeslist .= '<option value="'.$key.'">'.$value['title'].'</option>';
			$classes_box[] = array(
				'classes_id'	=> $value['classes_id'],
				'title'			=> $value['title'],
			);
		}elseif($value['classes'] == '2')  {
			$classes_box_sun_[$value['parent_id']][] = array(
				'classes_id'	=> $value['classes_id'],
				'title'			=> $value['title'],
			);
		}
	}
}



if(is_array($classes_box_sun_)){
	
	$classes_box_sun = array();
	foreach($classes_box_sun_ as $k=>$v) {
		if(is_array($v)){
			$key = $key_t = 0;
			foreach($v as $v2) {
				$classes_box_sun[$k][$key_t][] = $v2;
				$key_t = !(++$key % 2) ? ++$key_t : $key_t;
			}
		}
	}
}

include(cacheexists("news"));
$store_news = '';
if(is_array($NEWS_CACHE)){
	foreach($NEWS_CACHE as $val){
		$store_news .= '<a href="newsdetail.php?id='.$val['id'].'">'.$val['subject'].'</a>&nbsp;'.$val['date_add'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
}

include(cacheexists("links"));
include DIR_dzsw.'includes/user/ini.faq.php';

include template("index");

?>
