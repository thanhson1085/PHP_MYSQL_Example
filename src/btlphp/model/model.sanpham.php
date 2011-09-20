<?php
class modelSanpham extends Methods {
	
	private $task = NULL;
	
	function __construct(){
		$this->task = $this->get_request('task');
	}
	
	public function get_methods( $name ){		
		$this->$name();
	}
	
	private function sanpham(){		
		$this->result_rows = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	

	private function insert(){
		$masanpham = $_POST['masanpham'];
		$tensanpham = $_POST['tensanpham'];
		$mota = $_POST['mota'];
		$ngaysanxuat = $_POST['ngaysanxuat'];


			$masanpham = $this->html_convert($masanpham);
			$tensanpham = $this->html_convert($tensanpham);
			$mota = $this->html_convert($mota);
			$ngaysanxuat = $this->html_convert($ngaysanxuat);
			$ngaysanxuat = date("Y-m-d H:i:s",strtotime($ngaysanxuat));

		
			$query = "INSERT INTO `sanpham` ("
			." `masanpham`,"
			." `tensanpham`,"
			." `mota`,"
			." `ngaysanxuat`"
			." ) VALUES ("
			." '$masanpham',"
			." '$tensanpham',"
			." '$mota',"
			." '$ngaysanxuat'"
			." )"
			;
			
			$this->query( $query );
		
			if(	$this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Nhập sản phẩm thành công.</span></div>';
				$this->redirect('index.php?page='.$this->page.'&task=edit&sanpham_id='.$this->latest_id);
				
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Nhập sản phẩm không thành công.</span></div>';
			
			}
		
		$this->result_rows = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	
	private function update(){
		$sanpham_id = $this->get_request('sanpham_id');
		$masanpham = $_POST['masanpham'];
		$tensanpham = $_POST['tensanpham'];
		$mota = $_POST['mota'];
		$ngaysanxuat = $_POST['ngaysanxuat'];
		
		$session_token = $this->clean_var($_POST['session_token']);
		
		if( $_SESSION['front']['session_token'] != $session_token ){
			$_SESSION['MESSAGE'] = 'Invalid token.';
			$this->redirect('index.php?page='.$this->page.'&task=edit&sanpham_id='.$sanpham_id);
		} elseif( is_numeric($sanpham_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'Invalid ID';
			$this->redirect('index.php?page='.$this->page.'&task=edit&sanpham_id='.$sanpham_id);
		} elseif($masanpham == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel"> Mã sản phẩm không được bỏ trống.</span></div>';
			$this->edit();
		} elseif($tensanpham == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Tên sản phẩm không được bỏ trống.</span></div>';
			$this->edit();
		} else {
			$masanpham = $this->html_convert($masanpham);
			$tensanpham = $this->html_convert($tensanpham);
			$mota = $this->html_convert($mota);
			$ngaysanxuat = $this->html_convert($ngaysanxuat);
			$ngaysanxuat = date("Y-m-d H:i:s",strtotime($ngaysanxuat));
			
			$query = "UPDATE `sanpham` SET "
			." `masanpham`='$masanpham',"
			." `tensanpham`='$tensanpham',"
			." `mota`='$mota',"
			." `ngaysanxuat`='$ngaysanxuat'"
			." WHERE"
			." `id`='$sanpham_id'"
			;
			$this->query( $query );
			
			if($this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Cập nhật thành công.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Cập nhật không thành công.</span></div>';
			}
			$this->redirect('index.php?page='.$this->page.'&task=edit&sanpham_id='.$sanpham_id);
		}
	}
	
	private function delete(){
		$sanpham_id = $this->clean_var($_GET['sanpham_id']);
		
		if( is_numeric($sanpham_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'ID không chính xác.';
		} else {
			$query = "DELETE FROM `sanpham`"
			." WHERE"
			." `id`='$sanpham_id'"
			;
			$this->query( $query );
			
			if(	$this->affected_rows ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Xóa sản phẩm thành công.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Xóa sản phẩm không thành công.</span></div>';
			}
		}
		
		$this->redirect('index.php?page='.$this->page);
	}
	
	public function edit(){
		$this->sanpham_id = $this->get_request('sanpham_id');
		$result_rows = array();
		
		if( $this->sanpham_id != '' ){
			if( is_numeric($this->sanpham_id) ){
				$query = "SELECT"
				." `id`,"
				." `masanpham`,"
				." `tensanpham`,"
				." `mota`,"
				." `ngaysanxuat`"
				." FROM `sanpham`"
				." WHERE"
				." `id`='$this->sanpham_id'"
				;
				$result_row = $this->query( $query );
				
				$masanpham = $this->html_convert($_POST['masanpham']);
				$tensanpham = $this->html_convert($_POST['tensanpham']);
				$mota = $this->html_convert($_POST['mota']);
				$ngaysanxuat = $this->html_convert($_POST['ngaysanxuat']);
				
		
				$this->masanpham = isset($_POST['masanpham'])?$masanpham:$result_row['masanpham'];
				$this->tensanpham = isset($_POST['tensanpham'])?$tensanpham:$result_row['tensanpham'];
				$this->mota = isset($_POST['mota'])?$mota:$result_row['mota'];
				$this->ngaysanxuat = isset($_POST['ngaysanxuat'])?$ngaysanxuat:$result_row['ngaysanxuat'];

				$this->result_rows = $this->select_sanpham();
				//$this->result_rows2 = $this->select_permission();
				$this->view_html( 'view' );
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">ID không chính xác.</span></div>';
				$this->redirect('index.php');
			}
		} else {
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">ID không được để trống.</span></div>';
			$this->redirect('index.php');
		}
		
	}
	
	public function select_sanpham(){
		$query = "SELECT"
		." `id`,"
		." `masanpham`,"
	    ." `tensanpham`,"
		." `mota`,"
		." `ngaysanxuat`"
		." FROM `sanpham`"
		." ORDER BY `id` DESC"
		;
		$result_rows = $this->query( $query, TRUE );
		
		return $result_rows;
	}

}
?>
