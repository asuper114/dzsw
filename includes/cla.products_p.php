<?php

/*--------------------------------------------------------------
	[dzsw] includes/user/cla.search.php 

--------------------------------------------------------------*/

class products_p{
	
	var $db						= '';
	
	var $sql_select				= '';
	var $sql_from				= '';
	var $sql_where				= '';
	var $sql_pam				= '';

	var $product_id				= '';


	function sql_select($select_array){
		$sql_select = $spacer = '';
		if(!is_array($select_array)){
			return ' * ';
		}
		foreach($select_array as $k=>$v){
			if($k == 'distinct'){
				$sql_select .= " distinct ";
				continue;
			}elseif($k == 'IF'){
				$sql_select .= "$spacer ".$v." ";
			}else{
				$k_array = explode('__',$k);
				$sql_select .= "$spacer ".$k_array['0'].".".$k_array['1']." ";
				if($v != ''){
					$sql_select .= " AS $v ";
				}
			}
			$spacer = ',';
		}
		$this->sql_select = $sql_select;
	}

	function sql_from($join_table = ''){
		global $table_pre;
		$sql_from = $table_pre."products p ";
		if($join_table['ptoc'] == 'true'){
			$sql_from .= "left join ".$table_pre."ptoc ptoc on p.products_id = ptoc.pid ";
		}
		if($join_table['so'] == 'true'){
			$sql_from .= "left join ".$table_pre."source so on p.image = so.id ";
		}
		if($join_table['sp'] == 'true'){
			$sql_from .= "left join ".$table_pre."specials as sp on p.products_id = sp.pid ";
		}
		$this->sql_from = $sql_from;
	}

	function sql_where($s_array){
		if(!is_array($s_array)){
			return false;
		}		

		$sql_where = $string_and = '';
		if($s_array['products_id'] != ''){
			if(strstr($s_array['products_id'],',')){
				$sql_where .= " $string_and p.products_id in (".$s_array['products_id'].") ";
				$string_and = 'AND';
			}else{
				$sql_where .= " $string_and p.products_id =".$s_array['products_id']." ";
				$string_and = 'AND';
			}
		}
		if($s_array['pname'] != ''){
			$sql_where .= " $string_and (p.name like '%".$s_array['pname']."%' or p.name='".$s_array['pname']."') ";
			$string_and = 'AND';
		}
		if($s_array['base_info'] != ''){
			$sql_where .= " $string_and (p.base_info LIKE '%".$s_array['base_info']."%' OR p.base_info='".$s_array['base_info']."') ";
			$string_and = 'AND';

		}
		if($s_array['description'] != ''){
			$sql_where .= " $string_and (p.description LIKE '%".$s_array['description']."%' OR p.description='".$s_array['description']."') ";
			$string_and = 'AND';
		}
		if($s_array['manufacturer'] != ''){
			$sql_where .= " $string_and (p.manufacturer LIKE '%".$s_array['manufacturer']."%' OR p.manufacturer='".$s_array['manufacturer']."') ";
			$string_and = 'AND';
		}
		if($s_array['classes_id'] != ''){
			if(strstr($s_array['classes_id'],',')){
				$sql_where .= " $string_and ptoc.cid in (".$s_array['classes_id'].") ";
				$string_and = 'AND';
			}else{
				$sql_where .= " $string_and ptoc.cid =".$s_array['classes_id']." ";
				$string_and = 'AND';
			}
		}
		if($s_array['status'] == "0" || $s_array['status'] == "1"){
			$sql_where .= " $string_and p.status='".$s_array['status']."' ";
			$string_and = 'AND';
		}
		if($s_array['available'] != ""){
			$sql_where .= " $string_and p.available='1' ";
			$string_and = 'AND';
		}
		if($s_array['s_p'] != ""){
			$sql_where .= " $string_and p.s_p='1' ";
			$string_and = 'AND';
		}
		if($s_array['pfrom'] != ''){
			$sql_where .= " $string_and p.price > '".$s_array['pfrom']."' ";
			$string_and = 'AND';
		}
		if($s_array['pto'] != ''){
			$sql_where .= " $string_and p.price < '".$s_array['pto']."' ";
			$string_and = 'AND';
		}

		$this->sql_where = $sql_where;

	}
	function sql_pam($pam_array){
		$sql_pam = array();
		if($pam_array['group_by'] != ''){
			$sql_pam['group_by'] = " GROUP BY ".$pam_array['group_by']." ";
		}
		if($pam_array['order_by'] != ''){
			$sql_pam['order_by'] = " ORDER BY ".$pam_array['order_by']." ";
			if($pam_array['esc_desc'] != ''){
				$sql_pam['order_by'] .= " ".$pam_array['esc_desc']." ";
			}
		}

		$this->sql_pam = $sql_pam;

	}

	function products_list($s_array){
		$sql_array = array(
			'page'					=> $s_array['page'],
			'num'					=> $s_array['num'],
			'link'					=> $s_array['link'],

			'sql_select'			=> $this->sql_select,
			'sql_from'				=> $this->sql_from,
			'sql_where'				=> $this->sql_where,
			'sql_pam'				=> $this->sql_pam,
		);

		$products_array = array();
		$products_list = $this->db->query_list($sql_array);
		foreach($products_list as $k=>$v){
			$v['imagesrc'] = get_image_src($v,'small2');
			$v['price'] = s_price($v);
			$v['specials'] = array();
			$v['specials']['value'] = $v['s_price'];
			$v['specials']['text'] = display_price($v['s_price']);
			$v['name'] = $v['pname'];
			$products_array['detail'][] = $v;
		}
		$products_array['multipage'] = $this->db->__get('multipage');
		return $products_array;
	}

	function product_id($pid){
		$this->product_id = $pid;
	}
	
	function product_detail(){

		$query = "SELECT ".$this->sql_select." FROM ".$this->sql_from." WHERE p.products_id='".$this->product_id."' ";
		$product_detail = $this->db->get_one($query);

		return $product_detail;
	}
	  
	function product_classes($target = ''){
		global $table_pre;
		$query = $this->db->query("SELECT * FROM ".$table_pre."ptoc WHERE pid = '".$this->product_id."'");
		$classes_array = array();
		while($query_data = $this->db->fetch_array($query)){
			$page_trail = array();
			//$classes_array[] = $query_data;
			$classes_array[$query_data['id']] = classes_trail_parent($query_data['cid'], $page_trail);
		}

		$product_classes_array = array();
		foreach($classes_array as $key=>$val){
			$product_class = '';
			foreach($val as $val2){
				$product_class .= ' &gt; <a href="'.$val2['link'].'"';
				if($target != ''){
					$product_class .= ' target="_blank" ';
				}
				$product_class .= '>'.$val2['title'].'</a>';
			}
			$product_classes_array[$key] = $product_class;
		}
		return $product_classes_array;

	}

	function product_image(){
		global $table_pre;

		$query = $this->db->query("SELECT * FROM ".$table_pre."source where pid = '".$this->product_id."'");
		$image_list = array();
		while($query_data = $this->db->fetch_array($query)){
			$image_list[] = $query_data;
		}

		return $image_list;

	}

}
