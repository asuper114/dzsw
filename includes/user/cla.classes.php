<?php

/*--------------------------------------------------------------
	[dzsw] includes/user/cla.classes.php 

--------------------------------------------------------------*/
include DIR_dzsw.'includes/cla.products_p.php';
class classes extends products_p{
	
	var $db						= '';
	var $classes_id				= '';
	var $childids				= '';
	var $query_and				= '';

	function classes($classes_id){
		global $db;
		$this->db = $db;
		$this->classes_id = $classes_id;
	}

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}

	function check(){
		global $cache_classes;
		if(!is_array($cache_classes)){
			include_once(cacheexists('classes'));
		}
		if(!$cache_classes[$this->classes_id]['classes_id']){
			s_redirect("showmessage.php?type=class_notfont");
			exit;
		}
	}

	function class_name(){
		global $cache_classes;
		if(!is_array($cache_classes)){
			include_once(cacheexists('classes'));
		}
		if($this->class_name != ''){
			return true;
		}
		$class_name = $cache_classes[$this->classes_id]['title'];
		return $class_name;
	}

	function class_name_left(){
		global $cache_classes;
		if(!is_array($cache_classes)){
			include_once(cacheexists('classes'));
		}
		if($this->class_name_left != ''){
			return true;
		}
		$class_name = $cache_classes[$this->classes_id]['title'];
		return  s_wordscut($class_name,18);
	}

	function childs(){
		global $cache_classes, $settings;
		if(!is_array($cache_classes)){
			include_once(cacheexists('classes'));
		}
		$childs	= array();
		$key = $key_t = 0;
		$num_a_row = (is_numeric($settings['classes_num_a_row']) && $settings['classes_num_a_row']>0) ? $settings['classes_num_a_row'] : 4;

		foreach($cache_classes as $val){
			if($val['parent_id'] == $this->classes_id){
				$childs[$key_t][] = array('classes_id'=>$val['classes_id'],'title'=>$val['title']);
				$key_t = !(++$key % $num_a_row) ? ++$key_t : $key_t;
			}
		}
		if($childs['0']){
			$nums = ($key_t+1)*$num_a_row-$key;
			if($nums>0){
				for($i=0;$i<$nums;$i++){
					$childs[$key_t][] = array();
				}
			}
		}
		return $childs;
	}

	function childids(){
		if($this->childids != ''){
			return true;
		}
		
		$childids = "'".$this->classes_id."'";
		$childids = classes_childids($this->classes_id,$childids);
		$this->childids = $childids;
	}

	function set_sql_select(){
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
		$this->sql_select($sql_select);
	}

	function set_sql_where(){
		global $settings;
		if($this->sql_where != ''){
			return true;
		}

		$sql_where = array();
		$this->childids();
		$childids = $this->childids;
		$sql_where['classes_id'] = $childids ? $childids : "";
		
		$sql_where['available'] = stock_limitshow() ? '' : '1';
		$sql_where['status'] = '1';

		$this->sql_where($sql_where);
	}

	function set_sql_pam(){
		$sql_pam = array(
			'esc_desc'			=> 'DESC',
			'order_by'			=> 'p.products_id',
			'group_by'			=> 'p.products_id',
		);
		$this->sql_pam($sql_pam);
	}

	function set_sql_from(){
		$sql_from = array(
			'ptoc'				=> 'true',
			'so'				=> 'true',
			'sp'				=> 'true',
		);
		$this->sql_from($sql_from);
	}

	function get_list(){
		global $settings, $page;
		$num_of_row = (is_numeric($settings['productlist_numofrow']) && $settings['productlist_numofrow']>0) ? $settings['productlist_numofrow'] : 10;
		$s_array = array(
			'page'					=> $page,
			'num'					=> $num_of_row,
			'link'					=> 'classes.php?classes_id='.$this->classes_id,
		);

		$this->set_sql_select();
		$this->set_sql_from();
		$this->set_sql_where();
		$this->set_sql_pam();

		$products_array = $this->products_list($s_array);
		
		return $products_array;
	}

}

?>
