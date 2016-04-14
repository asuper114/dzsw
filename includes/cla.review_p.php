<?php

/*--------------------------------------------------------------
	[dzsw] includes/cla.review_p.php 
--------------------------------------------------------------*/

class review_p{
	
	var $db						= '';
	
	var $sql_select				= '';
	var $sql_count				= '';
	var $sql_from				= '';
	var $sql_where				= '';
	var $sql_pam				= '';

	var $product_id				= '';

	function sql_count(){
		if($this->sql_count == ''){
			$sql_count = '';
		}else{
			$sql_count = $this->sql_count;
		}
		return $sql_count;
	}

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

	function sql_from(){
		global $table_pre;
		$sql_from = $table_pre."reviews r ";
		$this->sql_from = $sql_from;
	}

	function sql_where(){	

		$sql_where = $string_and = '';
		$sql_where .= " $string_and r.products_id =".$this->product_id." ";
		$string_and = 'AND';
	
		$this->sql_where = $sql_where;

	}
	function sql_pam($pam_array){
		$sql_pam = '';
		if($pam_array['order_by'] != ''){
			$sql_pam .= " ORDER BY ".$pam_array['order_by']." ";
			if($pam_array['esc_desc'] != ''){
				$sql_pam .= " ".$pam_array['esc_desc']." ";
			}
		}

		$this->sql_pam = $sql_pam;

	}

	function review_list($s_array){
		$sql_array = array(
			'page'					=> $s_array['page'],
			'num'					=> $s_array['num'],
			'link'					=> $s_array['link'],

			'sql_count'				=> $this->sql_count(),
			'sql_select'			=> $this->sql_select,
			'sql_from'				=> $this->sql_from,
			'sql_where'				=> $this->sql_where,
			'sql_pam'				=> $this->sql_pam,
		);

		$review_array = array();
		$review_list = $this->db->query_list($sql_array);
		foreach($review_list as $k=>$v){
			$review_array['detail'][] = $v;
		}
		$review_array['multipage'] = $this->db->__get('multipage');
		return $review_array;
	}


	function product_review(){
		global $table_pre, $settings, $page;
		$review_data = array();

		$num_a_page = (is_numeric($settings['reviews_shownum']) && $settings['reviews_shownum'] > 0) ? $settings['reviews_shownum'] : '10';
		
		$page = $page ? $page : '1';
		$offset = ($page - 1) * $num_a_page;
		$num_data = $this->db->get_one("SELECT COUNT(*) AS count FROM ".$table_pre."reviews  where products_id='".$this->pid."'");
		$review_data['multipage'] = s_multi($num_data['count'], $num_a_page, $page, "product_detail.php?products_id=".$this->product_id,'#review');

		$query = $this->db->query("SELECT rid, review, rating, email, date_added from ".$table_pre."reviews where products_id='".$this->product_id."' ORDER BY rid DESC LIMIT $offset,".$num_a_page);
		while($review = $this->db->fetch_array($query)){
			$review['date_added'] = gmdate($settings['date_format'], $review['date_added']+ $settings['time_ofset'] * 3600);
			$review_data['detail'][] = $review;
		}
		 
		return $review_data;	
	}


}
