<?php

/*----------------------------------------------------
	[dzsw] includes/db_mysql.php 

----------------------------------------------------*/

$tables = array('admins','admingroups','area','usergroups','settings','styles','specials','shipping','shipping_fee','templates','classes','manufacturers','products','reviews','orders','orders_total','orders_products','orders_history','payment','payment_a','customers','address_book','news','gbook','gbook_class','links','source','ptoc');
foreach($tables as $tablename) {
	${'table_'.$tablename} = $table_pre.$tablename;
}
unset($tablename);

Class DB {
	var $query_num			= 0;
	var $dbhost				= '';
	var $dbname				= '';
	var $multipage			= '';

	function DB($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0 ) {
		$this->dbhost  = $dbhost;
		$this->dbname  = $dbname;
		$this->connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect );
	}

	function __get($name){
		return $this->$name;
	}	

	function __set($name, $value){
		$this->$name = $value;
	}

	function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect) {
		if($pconnect) {
			if(!@mysql_pconnect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Unable to connect the MySQL server.');
			}
		}else {
			if(!@mysql_connect($dbhost, $dbuser, $dbpw)) {
				$this->halt('Unable to connect the MySQL server.');
			}
		}

		$this->charset_db();

		if($this->version() > '5.0') {
			mysql_query("SET sql_mode=''");
		}
		if($dbname){
			mysql_select_db($dbname);
		}
	}

	function charset_db() {
		global $charset;
		mysql_query("SET NAMES {$charset}");
/*
*		if($this->version() <= '4.1') {
*			return true;
*		}
*		if(defined('CHARSET_DB') && CHARSET_DB == '' && in_array(strtolower($charset), array('gb2312', 'gbk', 'big5', 'utf-8'))) {
*			$dbcharset = str_replace('-', '', $charset);
*		}else{
*			$dbcharset = CHARSET_DB;
*		}
*		if($dbcharset) {
*			//mysql_query("SET character_set_results = NULL");
*			
*		}
*/
	}

	function select_db($dbname) {
		return mysql_select_db($dbname);
	}

	function fetch_array($query, $result_type = MYSQL_ASSOC) {
		return mysql_fetch_array($query, $result_type);
	}

	function query($sql, $method = '') {
		
		if($method=='ub' && @function_exists('mysql_unbuffered_query')){
			$query = mysql_unbuffered_query($sql);
		}else{
			if(!($query = mysql_query($sql)) && $method != 'noshow') {
				$this->halt('MySQL Query Error', $sql);
			}
		}
	
		$this->querynum++;
		return $query;
	}

	function get_one($sql)
	{
		$query = $this->query($sql);
		$result =& mysql_fetch_array($query, MYSQL_ASSOC);
		return $result;
	}

    function perform($table, $data, $action = 'insert', $parameters = '') 
	{
		reset($data);
        if ($action == 'insert' || $action == 'replace' ) 
		{
			$space=$query_1=$query_2='';
			foreach($data as $key=>$val)
			{
				$query_1.=$space.$key;
				$query_2.=$space.'\''.$val.'\'';
				$space=', ';
			}
			$query = $action.' into ' . $table . ' ('.$query_1.') values ('.$query_2.')';
			return $this->query($query);
		}
		elseif ($action == 'update') 
		{
			$query = 'update ' . $table . ' set ';
			$space='';
			foreach($data as $key=>$val)
			{
				$query .= $space.$key . '= \'' . $val. '\''; 
				$space=', ';
			}
			$query .=' where ' . $parameters.' ';
			return $this->query($query,'ub');
		}
    }
	
	/*
	$sql_array = array(
		'page'					=> 'page',
		'num'					=> 'num',
		'link'					=> 'link',

		'sql_count'				=> 'COUNT(*) as count',
		'sql_select'			=> '*',
		'sql_from'				=> 'from',
		'sql_where'				=> '',
		'sql_pam'				=> '',
	);	
	*/
	function query_list($sql_array){
		$page = $sql_array['page'] ? $sql_array['page'] : '1';
		$startlimit = ($page - 1) * $sql_array['num'];

		$sql_array['sql_where'] = $sql_array['sql_where'] != '' ? " where ".$sql_array['sql_where'] : '';

		$query = $this->query("SELECT COUNT(*) as count FROM ".$sql_array['sql_from']." ".$sql_array['sql_where']." ".$sql_array['sql_pam']['group_by']);
		$query_count = $this->num_rows($query);

		$this->multipage = s_multi($query_count, $sql_array['num'], $page, $sql_array['link']);

		$sql_array['sql_select'] = $sql_array['sql_select'] ? $sql_array['sql_select'] : '*';
		$sql_strings = "SELECT ".$sql_array['sql_select']." FROM ".$sql_array['sql_from']." ".$sql_array['sql_where']." ".$sql_array['sql_pam']['group_by']." ".$sql_array['sql_pam']['order_by'];
		
		$sql_strings .= " LIMIT $startlimit, ".$sql_array['num'];

		$query = $this->query($sql_strings);
		$query_list = array();
		while($query_data = $this->fetch_array($query)){
			$query_list[] = $query_data;
		}		
		return $query_list;
	}

	function affected_rows() 
	{
		return mysql_affected_rows();
	}

	function error() 
	{
		return mysql_error();
	}

	function errno() 
	{
		return mysql_errno();
	}

	function result($query, $row) 
	{
		$query = @mysql_result($query, $row);
		return $query;
	}

	function num_rows($query) 
	{
		$query = mysql_num_rows($query);
		return $query;
	}

	function num_fields($query) 
	{
		return mysql_num_fields($query);
	}

	function free_result($query) 
	{
		return mysql_free_result($query);
	}

	function insert_id() 
	{
		$id = mysql_insert_id();
		return $id;
	}

	function fetch_row($query) 
	{
		$query = mysql_fetch_row($query);
		return $query;
	}

	function close() 
	{
		return mysql_close();
	}

	function version() 
	{
		return mysql_get_server_info();
	}

	function halt($message = '', $sql = '') 
	{
		include DIR_dzsw.'includes/db_mysql_error.php';
	}
}
