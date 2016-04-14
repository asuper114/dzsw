<?php

/*--------------------------------------------------------------

	[dzsw] includes/admin/cla.gbook.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.products_p.php';
class products extends products_p{
	
	var $pid				= '';
	var $type				= '';

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}

	function products(){
		global $db;
		$this->db = $db;

	}

	function set_sql_select(){
		if($this->type == 'newproducts'){
			$sql_select = array(
				'distinct'				=> '',	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__base_info'			=> '',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__model'				=> '',

				'so__name'				=> '',
				'so__path'				=> '',
				'so__extension'			=> '',
				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}elseif($this->type == 'specials'){
			$sql_select = array(
				'distinct'				=> '',	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__base_info'			=> '',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__model'				=> '',

				'so__name'				=> '',
				'so__path'				=> '',
				'so__extension'			=> '',
				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}elseif($this->type == 'search'){
			$sql_select = array(
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__base_info'			=> '',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__model'				=> '',

				'so__name'				=> '',
				'so__path'				=> '',
				'so__extension'			=> '',
				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}elseif($this->type == 'detail'){
			$sql_select = array(
				'distinct'				=> '',	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__image'				=> '',
				'p__base_info'			=> '',	
				'p__description'		=> '',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__model'				=> '',
				'p__manufacturer'		=> '',

				'so__name'				=> '',
				'so__path'				=> '',
				'so__extension'			=> '',
				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}
		$this->sql_select($sql_select);
	}

	function set_sql_where($s_array = ''){
		global $settings;
		if($this->sql_where != ''){
			return true;
		}

		$sql_where = array();
		$sql_where['available'] = stock_limitshow() ? '' : '1';
		$sql_where['status'] = '1';
		if($this->type == 'newproducts'){
		
		}elseif($this->type == 'specials'){
			
			$sql_where['s_p'] = '1';	
			
		}elseif($this->type == 'search'){
			$sql_where['pname'] = $s_array['keywords'] != '' ? $s_array['keywords'] : null;
			$sql_where['description'] = ($s_array['cludedesc'] == '1' && $s_array['keywords'] != '') ? $s_array['keywords'] : null;
			$sql_where['manufacturer'] = $s_array['manufacturer'] != '' ? $s_array['manufacturer'] : null;
			$sql_where['pfrom'] = $s_array['pfrom'] != '' ? $s_array['pfrom'] : null;
			$sql_where['pto'] = $s_array['pto'] != '' ? $s_array['pto'] : null;

			if($s_array['classes_id']){
				$classes_id = intval($s_array['classes_id']);
				if($s_array['cludesub'] == '1'){
					$childids = classes_childids($classes_id, $childids);
					$sql_where['classes_id'] = $childids ? "'$classes_id',".$childids : "'$classes_id'";
				}else{
					$sql_where['classes_id'] = $s_array['classes_id'];
				} 
			}	
			
		}elseif($this->type == 'detail'){
			$sql_where['products_id'] = $s_array['products_id'];
			
		}
		$this->sql_where($sql_where);
	}

	function set_sql_pam(){
		if($this->type == 'newproducts'){	
			$sql_pam = array(
				'order_by'			=> 'p.products_id',
				'esc_desc'			=> 'DESC',
				'group_by'			=> 'p.products_id',
			);
		}elseif($this->type == 'search'){
			$sql_pam = array(
				'esc_desc'			=> 'DESC',
				'order_by'			=> 'p.products_id',
				'group_by'			=> 'p.products_id',
			);
		}else{
			$sql_pam = array(
				'esc_desc'			=> 'DESC',
				'order_by'			=> 'p.products_id',
				'group_by'			=> 'p.products_id',
			);
		}
		$this->sql_pam($sql_pam);
	}

	function set_sql_from(){
		if($this->type == 'newproducts'){
			$sql_from = array(
				'ptoc'				=> 'false',
				'so'				=> 'true',
				'sp'				=> 'true',
			);
		}elseif($this->type == 'specials'){
			$sql_from = array(
				'ptoc'				=> 'false',
				'so'				=> 'true',
				'sp'				=> 'true',
			);
		}elseif($this->type == 'search'){
			$sql_from = array(
				'ptoc'				=> 'true',
				'so'				=> 'true',
				'sp'				=> 'true',
			);
		}elseif($this->type == 'detail'){
			$sql_from = array(
				'ptoc'				=> 'false',
				'so'				=> 'true',
				'sp'				=> 'true',
			);
		}
		$this->sql_from($sql_from);
	}

	function set_link(){
		if($this->type == 'newproducts'){
			$link = 'newproducts.php?dzsw=dzsw';
		}elseif($this->type == 'specials'){
			$link = 'specials.php?dzsw=dzsw';
		}elseif($this->type == 'search'){
			parse_str($_SERVER['QUERY_STRING'], $getlinks);
			$stringlink = 'search.php';
			$pam = '?';
			foreach($getlinks as $key => $value) {
				if($key == 'page') {
					continue;
				}
				$stringlink .= $pam.$key.'='.rawurlencode($value);
				$pam = '&';
			}
			$link = $stringlink;
		}
		return $link;
	}

	function get_list($sql_array = ''){
		global $settings, $page;
		$num_of_row = (is_numeric($settings['productlist_numofrow']) && $settings['productlist_numofrow']>0) ? $settings['productlist_numofrow'] : 10;

		$s_array = array(
			'page'					=> $page,
			'num'					=> $num_of_row,
			'link'					=> $this->set_link(),
		);

		$this->set_sql_select();
		$this->set_sql_from();
		$this->set_sql_where($sql_array);
		$this->set_sql_pam();

		$products_array = $this->products_list($s_array);

		return $products_array;
	}

	function get_detail(){
		$this->set_sql_select();
		$this->set_sql_from();
		
		$product_detail = $this->product_detail();
		$product_detail['price'] = s_price($product_detail);
		$product_detail['imagesrc'] = get_image_src($product_detail,'small2');

		return $product_detail;		
	}

	function get_classes(){
		$classes_array = $this->product_classes();
		$product_class = '';
		if(!is_array($classes_array)){
			return false;
		}
		foreach($classes_array as $val){
			$product_class .= '<br />'.$val;
		}
		return $product_class;
		
	}


}

?>
