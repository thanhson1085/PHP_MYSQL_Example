<?php
abstract class Config {

	protected $host = 'localhost';
	protected $user = 'root';
	protected $pass = '';
	protected $dbname = 'btlphp';
	
}

function printr( $array ){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
	exit();
}
?>