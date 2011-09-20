<?php
interface intDB {
	public function connect_close();
	public function db_connect();
	public function query( $query, $multiple=FALSE );
	public function select_query( $multiple=FALSE );
}

abstract class DB extends Config implements intDB {
	
	protected $link = '';
	protected $latest_id = '';
	protected $num_rows = 0;
	protected $affected_rows = '';

	public $qry_result = '';
	
	function __destruct(){
		$this->host = NULL;
		$this->user = NULL;
		$this->pass = NULL;
		$this->dbname = NULL;
		
		$this->link = NULL;
		$this->latest_id = NULL;
		$this->num_rows = NULL;
		$this->affected_rows = NULL;
		
		$this->qry_result = NULL;
	
	}
	
	public function connect_close(){
	
		if( isset($_SESSION['mysql_connect']) ){
			@mysql_close($_SESSION['mysql_connect']);
			unset($_SESSION['mysql_connect']);
		}
	}
	
	public function db_connect(){
	
		if( isset($_SESSION['mysql_connect']) == FALSE ){
			$this->link = @mysql_connect( $this->host, $this->user, $this->pass );
			$_SESSION['mysql_connect'] = $this->link;
		} else {
			$this->link = $_SESSION['mysql_connect'];
		}
		
		if( $this->link ){
			$select_db = mysql_select_db($this->dbname, $this->link);
			if($select_db === FALSE){
				echo 'Check your username and database name settings.<br />';
				echo mysql_error();
				exit();
			}
		} else {
			echo 'Check your host, username and password settings.<br />';
			echo mysql_error();
			exit();
		}
	}

	public function query( $query, $multiple=FALSE ){
		$this->db_connect();
		
		$this->qry_result = mysql_query($query, $this->link);
		$this->affected_rows = mysql_affected_rows($this->link);
		$this->latest_id = mysql_insert_id($this->link);
		
		if( is_bool( $this->qry_result ) == FALSE ){
			$this->num_rows = mysql_num_rows($this->qry_result);
			
			$result = $this->select_query( $multiple );
			mysql_free_result($this->qry_result);
		} else {
			$result = $this->qry_result;
		}
		
		return $result;
	}
	
	public function select_query( $multiple=FALSE ){
		
		if( $this->num_rows > 1 || $multiple == TRUE ){
			$n = 0;
			while( $row = mysql_fetch_array( $this->qry_result ) ){
				$array[] = $row;
			}
		} else {
			$array = mysql_fetch_array( $this->qry_result );
		}
		
		return $array;
	}
}
?>