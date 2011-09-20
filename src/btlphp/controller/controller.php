<?php
include_once('controller/controller.sanpham.php');
include_once('controller/controller.users.php');
include_once('controller/controller.xuatkho.php');
include_once('controller/controller.nhapkho.php');
class controller Extends Methods{
	
	private $page = '';
	
	function __construct(){
		$this->page = $this->get_request('page');
		
		if( $_SESSION['front']['login'] === 1 ){
			if( $this->page == 'users' ){
				new controllerUser();
			} elseif( $this->page == 'sanpham' ){
				new controllerSanpham();
			} elseif( $this->page == 'xuatkho' ){
				new controllerXuatkho();
			} elseif( $this->page == 'nhapkho' ){
				new controllerNhapkho();
			} else {
				new controllerUser();
			}
		} else {
			if($this->page == 'login'){
				new controllerUser();
			} else {
				new controllerUser();
			}
		}
	}
}
?>
