<?php
class modelUser extends Methods {
	
	private $task = NULL;
	
	function __construct(){
		$this->task = $this->get_request('task');
	}
	
	public function get_methods( $name ){		
		$this->$name();
	}
	
	private function users(){		
		$this->result_rows = $this->select_user();
		$this->result_rows2 = $this->select_permission();
		$this->view_html( 'view' );
	}
	
	private function login(){
		
		$username = $this->clean_var($_POST['username']);
		$password = $this->clean_var($_POST['password']);
		$session_token = $this->clean_var($_POST['session_token']);
		
		if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
			$session_login = $_SESSION['front']['session_login'];
			
			if( isset($session_login) ){
				$_SESSION['front']['session_login'] = $session_login+1;
			} else {
				$_SESSION['front']['session_login'] = 1;
			}
			
			//if( $_SESSION['front']['session_login'] < 5 ){
			
				if( $_SESSION['front']['session_token'] == $session_token ){
					if($username != '' && $password != ''){
						$query = "SELECT"
							." `user_id`"
							." FROM `user`"
							." WHERE"
							." `username`='$username'"
							." AND `password`='$password'"
							;
						$reasult = $this->query( $query );
						
						if( $reasult ){
							$_SESSION['front']['login'] = 1;
							$_SESSION['front']['user'] = $username;
							$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Login successful.</span></div>';
							
							unset($_SESSION['front']['session_login']);
						} else {
							$_SESSION['MESSAGE'] = 'Username or Password incorrect.';
						}
					} else {
						$_SESSION['MESSAGE'] = 'Username or Password must not be empty.';
					}
				} else {
					$_SESSION['MESSAGE'] = 'Invalid token.';
				}

		} else {
			$_SESSION['MESSAGE'] = 'Request method must be POST.';
		}
		
		/*header('location: index.php');*/
		$this->redirect('index.php');
	}
	
	private function logout(){
		
		unset($_SESSION['front']);
		$_SESSION['MESSAGE'] = 'Logout successful.';
		
		$this->redirect('index.php');
	}
	
	private function insert(){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];
		$permission_id = $_POST['permission_id'];
		$fistname = $_POST['fistname'];
		$lastname = $_POST['lastname'];
		$companyname = $_POST['companyname'];
		$nationality = $_POST['nationality'];
		$description = $_POST['description'];
		$session_token = $this->clean_var($_POST['session_token']);

		if( $_SESSION['front']['session_token'] != $session_token ){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Invalid token.';
		} elseif($username == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Username field must not be empty.</span></div>';
		} elseif($password == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Password field must not be empty.</span></div>';
		} elseif($password != $confirmpassword){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Password and Confirm Password must be same.</span></div>';
		} else {
			$username = $this->html_convert($username);
			$passowrd = $this->html_convert($password);
			$permission_id = $this->html_convert($permission_id);
			$lastname = $this->html_convert($lastname);
			$fistname = $this->html_convert($fistname);
			$companyname = $this->html_convert($companyname);
			$nationality = $this->html_convert($nationality);
			$description = $this->html_convert($description);
		
			$query = "INSERT INTO `user` ("
			." `username`,"
			." `password`,"
			." `permission_id`,"
			." `fist_name`,"
			." `last_name`,"
			." `company_name`,"
			." `nationality`,"
			." `description`"
			." ) VALUES ("
			." '$username',"
			." '$password',"
			." '$permission_id',"
			." '$fistname',"
			." '$lastname',"
			." '$companyname',"
			." '$nationality',"
			." '$description'"
			." )"
			;
			$this->query( $query );
		
			if(	$this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Insert data successul.</span></div>';
				$this->redirect('index.php?task=edit&user_id='.$this->latest_id);
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Insert data unsuccessul.</span></div>';
			}
		}
		$this->result_rows = $this->select_user();
		$this->result_rows2 = $this->select_permission();
		$this->view_html( 'view' );
	}
	
	private function update(){
		$user_id = $this->get_request('user_id');
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmpassword = $_POST['confirmpassword'];
		$lastname = $_POST['lastname'];
		$fistname = $_POST['fistname'];
		$companyname = $_POST['companyname'];
		$nationality = $_POST['nationality'];
		$permission_id = $_POST['permission_id'];
		$description = $_POST['description'];
		
		$session_token = $this->clean_var($_POST['session_token']);
		
		if( $_SESSION['front']['session_token'] != $session_token ){
			$_SESSION['MESSAGE'] = 'Invalid token.';
			$this->redirect('index.php?task=edit&user_id='.$user_id);
		} elseif( is_numeric($user_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'Invalid ID';
			$this->redirect('index.php?task=edit&user_id='.$user_id);
		} elseif($username == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Username field must not be empty.</span></div>';
			$this->edit();
		} elseif($password == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Password field must not be empty.</span></div>';
			$this->edit();
		} elseif($password != $confirmpassword){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Password and Confirm Password must be same.</span></div>';
			$this->edit();
		} else {
			$permission_id = $this->html_convert($permission_id);
			$username = $this->html_convert($username);
			$password = $this->html_convert($password);
			$fistname = $this->html_convert($fistname);
			$lastname = $this->html_convert($lastname);
			$companyname = $this->html_convert($companyname);
			$nationality = $this->html_convert($nationality);
			$description = $this->html_convert($description);
			
			$query = "UPDATE `user` SET "
			." `username`='$username',"
			." `password`='$password',"
			." `company_name`='$companyname',"
			." `nationality`='$nationality',"
			." `fist_name`='$fistname',"
			." `last_name`='$lastname',"
			." `permission_id`=$permission_id,"
			." `description`='$description'"
			." WHERE"
			." `user_id`='$user_id'"
			;
			$this->query( $query );
			
			if($this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Update data successul.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Update data unsuccessul.</span></div>';
			}
			$this->redirect('index.php?task=edit&user_id='.$user_id);
		}
	}
	
	private function delete(){
		$user_id = $this->clean_var($_GET['user_id']);
		
		if( is_numeric($user_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'Invalid ID';
		} else {
			$query = "DELETE FROM `user`"
			." WHERE"
			." `user_id`='$user_id'"
			;
			$this->query( $query );
			
			if(	$this->affected_rows ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Delete data successul.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Delete data unsuccessul.</span></div>';
			}
		}
		
		$this->redirect('index.php');
	}
	
	public function edit(){
		$this->user_id = $this->get_request('user_id');
		$result_rows = array();
		
		if( $this->user_id != '' ){
			if( is_numeric($this->user_id) ){
				$query = "SELECT"
				." `user_id`,"
				." `username`,"
				." `password`,"
				." `permission_id`,"
				." `fist_name`,"
				." `last_name`,"
				." `company_name`,"
				." `nationality`,"
				." `description`,"
				." `date_created`"
				." FROM `user`"
				." WHERE"
				." `user_id`='$this->user_id'"
				;
				$result_row = $this->query( $query );
				
				$username = $this->html_convert($_POST['username']);
				$password = $this->html_convert($_POST['password']);
				$permission_id = $this->html_convert($_POST['permission_id']);
				$fistname = $this->html_convert($_POST['fistname']);
				$lastname = $this->html_convert($_POST['lastname']);
				$companyname = $this->html_convert($_POST['companyname']);
				$nationality = $this->html_convert($_POST['nationality']);
				$description = $this->html_convert($_POST['description']);
		
				$this->username = isset($_POST['username'])?$username:$result_row['username'];
				$this->password = isset($_POST['password'])?$password:$result_row['password'];
				$this->permission_id = isset($_POST['permission_id'])?$permission_id:$result_row['permission_id'];
				$this->fistname = isset($_POST['fistname'])?$fistname:$result_row['fist_name'];
				$this->lastname = isset($_POST['lastname'])?$lastname:$result_row['last_name'];
				$this->companyname = isset($_POST['companyname'])?$companyname:$result_row['company_name'];
				$this->nationality = isset($_POST['nationality'])?$nationality:$result_row['nationality'];
				$this->description = isset($_POST['description'])?$description:$result_row['description'];
				
				$this->result_rows = $this->select_user();
				$this->result_rows2 = $this->select_permission();
				$this->view_html( 'view' );
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Invalid ID.</span></div>';
				$this->redirect('index.php');
			}
		} else {
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">ID must not be blank.</span></div>';
			$this->redirect('index.php');
		}
		
	}
	
	public function select_user(){
		$query = "SELECT"
		." `user_id`,"
		." `username`,"
		." `permission_id`,"
		." `fist_name`,"
		." `last_name`,"
		." `company_name`,"
		." `nationality`,"
		." `description`,"
		." `date_created`"
		." FROM `user`"
		." ORDER BY `user_id` DESC"
		;
		$result_rows = $this->query( $query, TRUE );
		
		return $result_rows;
	}
	public function select_permission(){
		$query = "SELECT"
		." `permission_id`,"
		." `permission_name` FROM `permission`"		;
		$result_rows = $this->query( $query, TRUE );
		
		return $result_rows;
	}
}
?>
