<?php

/*--------------------------------------------------------------

	[dzsw] includes/admin/cla.gbook.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.products_p.php';
class products extends products_p{
	
	var $type				= '';
	var $multilink			= '';

	var $image_savepath		= '';

	function products(){
		global $db;
		$this->db = $db;
		
	}

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}

	function set_type($type){
		$this->type = $type;
	}

	function set_sql_select(){
		if($this->type == 'specials'){
			$sql_select = array(
				'distinct'				=> '',	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__quantity'			=> '',
				'p__status'				=> '',

				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}elseif($this->type == 'search'){
			$sql_select = array(
				'distinct'				=> '',	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__quantity'			=> '',
				'p__status'				=> '',

				'IF'					=> 'IF(p.s_p>0, sp.s_price, NULL) as s_price',
			);
		}elseif($this->type == 'detail'){
			$sql_select = array(	
				'p__products_id'		=> '',	
				'p__name'				=> 'pname',	
				'p__price'				=> '',
				'p__s_p'				=> '',
				'p__quantity'			=> '',
				'p__image'				=> '',
				'p__status'				=> '',
				'p__description'		=> '',
				'p__base_info'			=> '',
				'p__manufacturer'		=> '',
				'p__model'				=> '',
				'p__weight'				=> '',

			);
		}
		$this->sql_select($sql_select);
	}

	function set_sql_where($s_where = ''){
		global $settings;
		if($this->sql_where != ''){
			return true;
		}

		$sql_where = $s_where ? $s_where : array();
		if($this->type == 'specials'){
			$sql_where['s_p'] = '1';
		}

		$this->sql_where($sql_where);
	}

	function set_sql_pam(){
		$sql_pam = array(
			'group_by'			=> 'p.products_id',
			'order_by'			=> 'p.date_added, p.products_id',
			'esc_desc'			=> 'DESC',
		);
		$this->sql_pam($sql_pam);
	}

	function set_sql_from(){
		if($this->type == 'specials'){
			$sql_from = array(
				'ptoc'				=> 'false',
				'so'				=> 'false',
				'sp'				=> 'true',
			);
		}elseif($this->type == 'search'){
			$sql_from = array(
				'ptoc'				=> 'true',
				'so'				=> 'true',
				'sp'				=> 'true',
			);
		}else{
			$sql_from = array(
				'ptoc'				=> 'false',
				'so'				=> 'false',
				'sp'				=> 'false',
			);
		}
		$this->sql_from($sql_from);
	}

	function set_multilink(){
		if($this->type == 'specials'){
			$this->multilink = 'admin.php?act=products&type=specials';
		
		}elseif($this->type == 'search'){
			parse_str($_SERVER['QUERY_STRING'], $getlinks);
			$stringlink = 'admin.php';
			$pam = '?';
			foreach($getlinks as $key => $value) {
				if($key == 'page') {
					continue;
				}
				$stringlink .= $pam.$key.'='.rawurlencode($value);
				$pam = '&';
			}
			$this->multilink = $stringlink;
		}else{
			$this->multilink = 'admin.php?act=products';
		}
	}

	function get_list($sql_where = ''){
		global $settings, $page;
		$num_of_row = (is_numeric($settings['productlist_numofrow']) && $settings['productlist_numofrow']>0) ? $settings['productlist_numofrow'] : 10;
		
		$this->set_multilink();
		$s_array = array(
			'page'					=> $page,
			'num'					=> $num_of_row,
			'link'					=> $this->multilink,
		);

		$this->set_sql_select();
		$this->set_sql_from();
		$this->set_sql_where($sql_where);
		$this->set_sql_pam();
		
		$products_array = $this->products_list($s_array);

		return $products_array;
	}

	function get_detail(){
		$this->set_sql_select();
		$this->set_sql_from();
		
		$product_detail = $this->product_detail();

		return $product_detail;		
	}

	function get_image(){
		$product_image = $this->product_image();
		$product_image_array = array();
		$key = $key_t = 0;
		$img_num_a_row = 4;
		foreach($product_image as $v){
			$product_image_array[$key_t][imageid][] = $v['id'];
			$product_image_array[$key_t][imagesrc][] = get_image_src($v,'small');
			$product_image_array[$key_t][type][] = $v['type'];
			$product_image_array[$key_t][name][] = $v['title'] ? $v['title'] : date('Y-m-d',$v['dateadd']);
			$key_t= !(++$key % $img_num_a_row) ? ++$key_t : $key_t;
		}
		return $product_image_array;		
	}

	function get_classes(){
		$product_classes = $this->product_classes('_blank');

		$product_classes_array = array();
		foreach($product_classes as $key=>$val){
			$product_classes_array[] = array(
				'id'			=> $key,
				'string'		=> $val,
			);
		}

		return $product_classes_array;		
	}

	function classes_list(){
		global $table_pre, $lang_a_product;
		$classes = '';
		$query_1 = $this->db->query("select classes_id, title, parent_id, sort_order from ".$table_pre."classes where parent_id = '0' and classes='1' order by sort_order, title");
		while ($category_1= $this->db->fetch_array($query_1)) {
			$classes.='<ul><li><b>'.$category_1['title'].'</b> -  <a href="admin.php?act=products&type=add&classes_id='.$category_1['classes_id'].'">['.$lang_a_product['add_product'].']</a>&nbsp;<a href="admin.php?act=products&type=search_result&classes_id='.$category_1['classes_id'].'">['.$lang_a_product['look_product'].']</a>'; 
			$query_2 = $this->db->query("select classes_id, title, parent_id, sort_order from ".$table_pre."classes where parent_id = '".$category_1['classes_id']."' and classes='2' order by sort_order, title");
			while ($category_2= $this->db->fetch_array($query_2)) {
				$classes.='<ul><li><b>'.$category_2['title'].'</b> - <a href="admin.php?act=products&type=add&classes_id='.$category_2['classes_id'].'">['.$lang_a_product['add_product'].']</a>&nbsp;<a href="admin.php?act=products&type=search_result&classes_id='.$category_2['classes_id'].'">['.$lang_a_product['look_product'].']</a>'; 
				$query_3 = $this->db->query("select classes_id, title, parent_id, sort_order from ".$table_pre."classes where parent_id = '".$category_2['classes_id']."' and classes='3' order by sort_order, title");
				while ($category_3= $this->db->fetch_array($query_3)) {   
					$classes.='<ul><li><b>'.$category_3['title'].'</b> -  <a href="admin.php?act=products&type=add&classes_id='.$category_3['classes_id'].'">['.$lang_a_product['add_product'].']</a>&nbsp;<a href="admin.php?act=products&type=search_result&classes_id='.$category_3['classes_id'].'">['.$lang_a_product['look_product'].']</a>'; 
					$query_4 = $this->db->query("select classes_id, title, parent_id, sort_order from ".$table_pre."classes where parent_id = '".$category_3['classes_id']."' and classes='4' order by sort_order, title");
					while ($category_4= $this->db->fetch_array($query_4)) {    
						$classes.='<ul><li><b>'.$category_4['title'].'</b> - <a href="admin.php?act=products&type=add&classes_id='.$category_4['classes_id'].'">['.$lang_a_product['add_product'].']</a>&nbsp;<a href="admin.php?act=products&type=search_result&classes_id='.$category_4['classes_id'].'">['.$lang_a_product['look_product'].']</a>'; 
						$classes.='</ul>';
					} 
					$classes.='</ul>';
				}
				$classes.='</ul>';
			}
			$classes.='</ul>';
		}	
		return $classes;
	}

	function add($sql_data_array){
		global $table_pre, $timestamp;

		$this->db->perform($table_pre."products", $sql_data_array);
		$this->product_id = $this->db->insert_id();
		$sql_data_array = array(
				   'pid' => $this->product_id,
				   'cid' => (int)$sql_data_array['classes_id'],
			   'dateadd' => $timestamp,
		);			
		$this->db->perform($table_pre."ptoc", $sql_data_array);
	}

	function update_common($sql_data_array){
		global $table_pre, $timestamp;
		$this->db->perform($table_pre."products", $sql_data_array,'update',"products_id='".(int)$this->product_id . "'");

	}

	function update_classes($newcid = '', $delete = ''){
		global $table_pre, $timestamp;
		
		if($newcid != ''){
			$get_one = $this->db->get_one("select count(*) as count from ".$table_pre."ptoc where pid='".$this->product_id."' and cid='".$newcid."'");

			if($get_one['count'] < 1){
				$sql_data_array = array(
							   'pid' => $this->product_id,
							   'cid' => (int)$newcid,
						   'dateadd' => $timestamp,
				);	
				$this->db->perform($table_pre."ptoc", $sql_data_array);	
			}
		}

		$ids = get_strings($delete);
		if($ids){
			$this->db->query("delete from ".$table_pre."ptoc where id in ($ids)");
		}

	}

	function update_price($price, $s_price){
		global $table_pre;
		
		$update_s_specials = 0;
		$sql_data_array = array(
			'pid'		=> $this->product_id,
			's_price'	=> $s_price,
		);
		$this->db->perform($table_pre."specials", $sql_data_array,'replace');	
		if($s_price > 0){
			$update_s_specials = 1;
		}
		$this->db->query("update ".$table_pre."products set price='$price',s_p='$update_s_specials' where products_id ='".$this->product_id."'");
		
	}

	function image_savepath(){
		global $settings;
		if($this->image_savepath != ''){
			return true;
		}
		if($settings['picture_savepath'] == 'default'){
			$savepath = '';
		}elseif($settings['picture_savepath'] == 'byday'){
			$savepath = date('Y').'/'.date('m').'/'.date('d');
		}
		$this->image_savepath = $image_savepath;
	}

	function upload_image($u_arrray){
		global $table_pre, $timestamp, $C_UPLOAD, $message_all;

		$image_savepath = $this->image_savepath();
		if($C_UPLOAD->parse($u_arrray['filename'], $image_savepath, $u_arrray['num'])) {
			
			$new_name = $u_arrray['num'] != '' ? $timestamp.'_'.$this->product_id.'_'.$u_arrray['num'].'_'.s_random('4') : $timestamp.'_'.$this->product_id.'_'.s_random('4');
			$C_UPLOAD->save(1, $new_name);
			$sql_data_array = array(
				  'name' => $C_UPLOAD->_filename,
				  'path' => $image_savepath,
			 'extension' => $C_UPLOAD->extension,
				 'title' => $u_arrray['title'],
				   'pid' => $this->product_id,
			   'dateadd' => $timestamp,
			);
			$this->db->perform($table_pre."source", $sql_data_array);
		}
		@array_push($message_all, $C_UPLOAD->message);
	}

	function docopy($products_id, $classes_id){
		global $table_pre, $timestamp;
		$this->type = 'detail';
		$this->product_id = $products_id;
		$product_data = $this->get_detail();
		$sql_data_array = array(
			'quantity'			=> $product_data['quantity'],
			'price'				=> $product_data['price'],
			'weight'			=> $product_data['weight'],
			'available'			=> $product_data['available'],
			'status'			=> '0',
			'manufacturer'		=> $product_data['manufacturer'],
			'last_modified'		=> $product_data['timestamp'],
			'model'				=> $product_data['model'],
			'name'				=> $product_data['pname'],
			'base_info'			=> $product_data['base_info'],
			'description'		=> $product_data['description'],
			'date_added'		=> $timestamp,
		);
		$this->db->perform($table_pre."products", $sql_data_array);
		$products_id_new = $this->db->insert_id();
		
		$sql_data_array = array(
						   'pid' => $products_id_new,
						   'cid' => (int)$classes_id,
					   'dateadd' => $timestamp,
		);			
		$this->db->perform($table_pre."ptoc", $sql_data_array);

		$query = $this->db->query("select * from ".$table_pre."source where pid = '" . (int)$this->products_id. "'");
		while($image_data = $this->db->fetch_array($query)){
			$sql_data_array = array(
						  'name' => $image_data['name'],
					 'extension' => $image_data['extension'],
						  'path' => $image_data['path'],
						 'title' => $image_data['title'],
						   'pid' => $products_id_new,
					   'dateadd' => $timestamp,
			);
			$this->db->perform($table_pre."source", $sql_data_array);	
			if($product_data['image'] == $image_data['id']){
				$source_id = $this->db->insert_id();
			}
		}

		$this->db->query("update ".$table_pre."products set image = '".$source_id."', last_modified = '".$timestamp."' where products_id = '" . (int)$products_id_new. "'");
		return $products_id_new;
	}
}

?>
