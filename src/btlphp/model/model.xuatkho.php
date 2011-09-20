<?php
class modelXuatkho extends Methods {
	
	private $task = NULL;
	
	function __construct(){
		$this->task = $this->get_request('task');
	}
	
	public function get_methods( $name ){		
		$this->$name();
	}
	
	private function xuatkho(){		
		$this->result_rows = $this->select_xuatkho();
		$this->result_rows2 = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	

	private function insert(){
		$maphieuxuat = $_POST['maphieuxuat'];
		$masanpham = $_POST['masanpham'];
		$khachhang = $_POST['khachhang'];
		$ngayxuat = $_POST['ngayxuat'];
		$soluong = $_POST['soluong'];

			$maphieuxuat = $this->html_convert($maphieuxuat);
			$masanpham = $this->html_convert($masanpham);
			$khachhang = $this->html_convert($khachhang);
			$ngayxuat = $this->html_convert($ngayxuat);
			$ngayxuat = date("Y-m-d H:i:s",strtotime($ngayxuat));
			$soluong = $this->html_convert($soluong);
		
			$query = "INSERT INTO `xuatkho` ("
			." `maphieuxuat`,"
			." `masanpham`,"
			." `khachhang`,"
			." `soluong`,"
			." `ngayxuat`"
			." ) VALUES ("
			." '$maphieuxuat',"
			." '$masanpham',"
			." '$khachhang',"
			." '$soluong',"
			." '$ngayxuat'"
			." )"
			;
			
			$this->query( $query );
		
			if(	$this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Nhập sản phẩm thành công.</span></div>';
				$this->redirect('index.php?page='.$this->page.'&task=edit&xuatkho_id='.$this->latest_id);
				
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Nhập sản phẩm không thành công.</span></div>';
			
			}
		
		$this->result_rows = $this->select_xuatkho();
		$this->result_rows2 = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	
	private function update(){
		$xuatkho_id = $this->get_request('xuatkho_id');
		$maphieuxuat = $_POST['maphieuxuat'];
		$masanpham = $_POST['masanpham'];
		$khachhang = $_POST['khachhang'];
		$ngayxuat = $_POST['ngayxuat'];
		$soluong = $_POST['soluong'];
		
		$session_token = $this->clean_var($_POST['session_token']);
		
		if( $_SESSION['front']['session_token'] != $session_token ){
			$_SESSION['MESSAGE'] = 'Invalid token.';
			$this->redirect('index.php?page='.$this->page.'&task=edit&xuatkho_id='.$xuatkho_id);
		} elseif( is_numeric($xuatkho_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'Invalid ID';
			$this->redirect('index.php?page='.$this->page.'&task=edit&xuatkho_id='.$xuatkho_id);
		} elseif($maphieuxuat == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel"> Mã phiếu xuât không được bỏ trống.</span></div>';
			$this->edit();
		} elseif($masanpham == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Tên phiếu xuất không được bỏ trống.</span></div>';
			$this->edit();
		} else {
			$maphieuxuat = $this->html_convert($maphieuxuat);
			$masanpham = $this->html_convert($masanpham);
			$khachhang = $this->html_convert($khachhang);
			$ngayxuat = $this->html_convert($ngayxuat);
			$soluong = $this->html_convert($soluong);
			$ngayxuat = date("Y-m-d H:i:s",strtotime($ngayxuat));
			
			$query = "UPDATE `xuatkho` SET "
			." `maphieuxuat`='$maphieuxuat',"
			." `masanpham`='$masanpham',"
			." `khachhang`='$khachhang',"
			." `soluong`='$soluong',"
			." `ngayxuat`='$ngayxuat'"
			." WHERE"
			." `id`='$xuatkho_id'"
			;
			$this->query( $query );
			
			if($this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Cập nhật thành công.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Cập nhật không thành công.</span></div>';
			}
			$this->redirect('index.php?page='.$this->page.'&task=edit&xuatkho_id='.$xuatkho_id);
		}
	}
	
	private function delete(){
		$xuatkho_id = $this->clean_var($_GET['xuatkho_id']);
		
		if( is_numeric($xuatkho_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'ID không chính xác.';
		} else {
			$query = "DELETE FROM `xuatkho`"
			." WHERE"
			." `id`='$xuatkho_id'"
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
		$this->xuatkho_id = $this->get_request('xuatkho_id');
		$result_rows = array();
		
		if( $this->xuatkho_id != '' ){
			if( is_numeric($this->xuatkho_id) ){
				$query = "SELECT"
				." `id`,"
				." `maphieuxuat`,"
				." `masanpham`,"
				." `khachhang`,"
				." `soluong`,"
				." `ngayxuat`"
				." FROM `xuatkho`"
				." WHERE"
				." `id`='$this->xuatkho_id'"
				;
				$result_row = $this->query( $query );
				
				$maphieuxuat = $this->html_convert($_POST['maphieuxuat']);
				$masanpham = $this->html_convert($_POST['masanpham']);
				$khachhang = $this->html_convert($_POST['khachhang']);
				$ngayxuat = $this->html_convert($_POST['ngayxuat']);
				$soluong = $this->html_convert($_POST['soluong']);
				
		
				$this->maphieuxuat = isset($_POST['maphieuxuat'])?$maphieuxuat:$result_row['maphieuxuat'];
				$this->masanpham = isset($_POST['masanpham'])?$masanpham:$result_row['masanpham'];
				$this->khachhang = isset($_POST['khachhang'])?$khachhang:$result_row['khachhang'];
				$this->ngayxuat = isset($_POST['ngayxuat'])?$ngayxuat:$result_row['ngayxuat'];
				$this->soluong = isset($_POST['soluong'])?$soluong:$result_row['soluong'];

				$this->result_rows = $this->select_xuatkho();
				$this->result_rows2 = $this->select_sanpham();
				$this->view_html( 'view' );
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">ID không chính xác.</span></div>';
				$this->redirect('index.php?page='.$this->page);
			}
		} else {
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">ID không được để trống.</span></div>';
			$this->redirect('index.php?page='.$this->page);
		}
		
	}
	
	public function select_xuatkho(){
		$query = "SELECT"
		." `id`,"
		." `maphieuxuat`,"
	    ." `masanpham`,"
		." `khachhang`,"
		." `soluong`,"
		." `ngayxuat`"
		." FROM `xuatkho`"
		." ORDER BY `id` DESC"
		;
		$result_rows = $this->query( $query, TRUE );
		
		return $result_rows;
	}
	public function select_sanpham(){
		$query = "SELECT"
		." `masanpham`,"
		." `tensanpham` FROM `sanpham`"		;
		$result_rows = $this->query( $query, TRUE );
		
		return $result_rows;
	}
}
?>
