<?php

/*--------------------------------------------------------------

	[dzsw] includes/admin/cla.gbook.php 

--------------------------------------------------------------*/

include DIR_dzsw.'includes/cla.review_p.php';
class review extends review_p{
	
	var $product_id				= '';
	var $type					= '';

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}

	function review($product_id){
		global $db;
		$this->db = $db;
		$this->product_id = $product_id;

	}

	function set_sql_count(){
		$this->sql_count = 'COUNT(*) AS count';
		
	}

	function set_sql_select(){
		$sql_select = array(
			'distinct'				=> '',	
			'r__rid'				=> '',	
			'r__review'				=> '',	
			'r__rating'				=> '',	
			'r__email'				=> '',
			'r__date_added'			=> '',
		);
		$this->sql_select($sql_select);
	}

	function set_sql_where($s_array = ''){
		$this->sql_where();
	}

	function set_sql_pam(){
		$sql_pam = array(
			'esc_desc'			=> 'DESC',
			'order_by'			=> 'r.rid',
		);
		$this->sql_pam($sql_pam);
	}

	function set_sql_from(){
		$this->sql_from();
	}

	function set_link(){
		$link = 'product_detail.php?products_id='.$this->product_id;
		return $link;
	}

	function get_list($s_array = ''){
		global $settings, $page;
		$num_of_row = (is_numeric($settings['reviews_shownum']) && $settings['reviews_shownum']>0) ? $settings['reviews_shownum'] : 10;

		$s_array = array(
			'page'					=> $page,
			'num'					=> $num_of_row,
			'link'					=> $this->set_link(),
		);

		$this->set_sql_count();
		$this->set_sql_select();
		$this->set_sql_from();
		$this->set_sql_where();
		$this->set_sql_pam();

		$review_array = $this->review_list($s_array);

		return $review_array;
	}

	function get_detail(){
		$this->set_sql_select();
		$this->set_sql_from();
		
		$product_detail = $this->product_detail();

		return $product_detail;		
	}

	function get_classes(){
		$product_classes = $this->product_classes();

		$product_classes_array = array();
		foreach($product_classes as $key=>$val){
			$product_classes_array[] = array(
				'id'			=> $key,
				'string'		=> $val,
			);
		}

		return $product_classes_array;		
	}
}

?>
