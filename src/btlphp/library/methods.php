<?php
interface intMethods {
	public function get_request( $name );
	public function close_connection();
	public function redirect( $href );
	public function message();
	public function clean_var( $value );
	public function html_convert( $value );
	public function create_session_token();
	public function view_html( $file_name );
	public function limit_chars( $string, $lenght=50, $dots='...');
}

class Methods extends DB implements intMethods {

	public function get_request( $name ){
		$task = $this->clean_var($_POST[$name]?$_POST[$name]:$_GET[$name]);
		
		return $task;
	}
	
	public function close_connection(){
		$this->connect_close();
	}

	public function redirect( $href ){
		?>
		<script type="text/javascript">
			window.location.href='<?php echo $href; ?>';
		</script>
		<?php
		exit();
	}

	public function message(){
	
		if( isset($_SESSION['MESSAGE']) ){
			$message = $_SESSION['MESSAGE'];
			unset($_SESSION['MESSAGE']);
			
			return $message;
		}
	}
	

	public function clean_var( $value ){
		$value = strip_tags($value);
		
		if( get_magic_quotes_gpc() == FALSE ){
			$this->db_connect();
			$value = mysql_real_escape_string($value, $this->link);
		}
		
		return $value;
	}

	public function html_convert( $value ){
		
		if( get_magic_quotes_gpc() ){
			$value = stripslashes($value);
		}
		$value = htmlentities($value, ENT_QUOTES, 'UTF-8');
		
		return $value;
	}
	
	public function create_session_token(){
		$session_token = $_SESSION['front']['session_token'] = md5(rand(5,10));
		
		return $session_token;
	}
	
	public function view_html( $file_name ){
		
		include_once('view/'.$file_name.'.php');
	}

	public function limit_chars( $string, $lenght=50, $dots='...'){
						
		$string = strip_tags($string);
		$string = html_entity_decode($string,ENT_QUOTES,'UTF-8');
	
		$strlength = strlen($string);
		
		if ( $strlength > $lenght ){       
			$limited = substr($string, 0, $lenght);
			$limited .= $dots;                  
		} else {
			$limited = $string;
		}
		
		$limited = htmlentities($limited,ENT_QUOTES,$char_set);
		
		return $limited;
	}
}
?>