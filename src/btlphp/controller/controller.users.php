<?php
include_once('model/model.users.php');
class controllerUser extends modelUser {
	
	private $task = '';
	public $page = 'users';
	function __construct(){
		$this->task = $this->get_request('task');
		
		if( $_SESSION['front']['login'] === 1 ){
			if( $this->task == 'insert' ){
				$this->get_methods('insert');
			} elseif( $this->task == 'edit' ){
				$this->get_methods('edit');
			} elseif( $this->task == 'update' ){
				$this->get_methods('update');
			} elseif( $this->task == 'delete' ){
				$this->get_methods('delete');
			} elseif( $this->task == 'logout' ){
				$this->get_methods('logout');
			} else {
				$this->get_methods('users');
			}
		} else {
			if($this->task == 'login'){
				$this->get_methods('login');
			} else {
				$this->view_html( 'login' );
			}
		}
	}
}
?>
