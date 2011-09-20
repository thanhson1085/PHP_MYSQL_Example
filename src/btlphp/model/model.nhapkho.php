<?php
class modelNhapkho extends Methods {
	
	private $task = NULL;
	
	function __construct(){
		$this->task = $this->get_request('task');
	}
	
	public function get_methods( $name ){		
		$this->$name();
	}
	
	private function nhapkho(){		
		$this->result_rows = $this->select_nhapkho();
		$this->result_rows2 = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	

	private function insert(){
		$maphieunhap = $_POST['maphieunhap'];
		$masanpham = $_POST['masanpham'];
		$nhacungcap = $_POST['nhacungcap'];
		$ngaynhap = $_POST['ngaynhap'];
		$soluong = $_POST['soluong'];

			$maphieunhap = $this->html_convert($maphieunhap);
			$masanpham = $this->html_convert($masanpham);
			$nhacungcap = $this->html_convert($nhacungcap);
			$ngaynhap = $this->html_convert($ngaynhap);
			$ngaynhap = date("Y-m-d H:i:s",strtotime($ngaynhap));
			$soluong = $this->html_convert($soluong);
		
			$query = "INSERT INTO `nhapkho` ("
			." `maphieunhap`,"
			." `masanpham`,"
			." `nhacungcap`,"
			." `soluong`,"
			." `ngaynhap`"
			." ) VALUES ("
			." '$maphieunhap',"
			." '$masanpham',"
			." '$nhacungcap',"
			." '$soluong',"
			." '$ngaynhap'"
			." )"
			;
			
			$this->query( $query );
		
			if(	$this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Nhập sản phẩm thành công.</span></div>';
				$this->redirect('index.php?page='.$this->page.'&task=edit&nhapkho_id='.$this->latest_id);
				
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Nhập sản phẩm không thành công.</span></div>';
			
			}
		
		$this->result_rows = $this->select_nhapkho();
	    $this->result_rows2 = $this->select_sanpham();
		$this->view_html( 'view' );
	}
	
	private function update(){
		$nhapkho_id = $this->get_request('nhapkho_id');
		$maphieunhap = $_POST['maphieunhap'];
		$masanpham = $_POST['masanpham'];
		$nhacungcap = $_POST['nhacungcap'];
		$ngaynhap = $_POST['ngaynhap'];
		$soluong = $_POST['soluong'];
		
		$session_token = $this->clean_var($_POST['session_token']);
		
		if( $_SESSION['front']['session_token'] != $session_token ){
			$_SESSION['MESSAGE'] = 'Invalid token.';
			$this->redirect('index.php?page='.$this->page.'&task=edit&nhapkho_id='.$nhapkho_id);
		} elseif( is_numeric($nhapkho_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'Invalid ID';
			$this->redirect('index.php?page='.$this->page.'&task=edit&nhapkho_id='.$nhapkho_id);
		} elseif($maphieunhap == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel"> Mã phiếu xuât không được bỏ trống.</span></div>';
			$this->edit();
		} elseif($masanpham == ''){
			$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Tên phiếu xuất không được bỏ trống.</span></div>';
			$this->edit();
		} else {
			$maphieunhap = $this->html_convert($maphieunhap);
			$masanpham = $this->html_convert($masanpham);
			$nhacungcap = $this->html_convert($nhacungcap);
			$ngaynhap = $this->html_convert($ngaynhap);
			$soluong = $this->html_convert($soluong);
			$ngaynhap = date("Y-m-d H:i:s",strtotime($ngaynhap));
			
			$query = "UPDATE `nhapkho` SET "
			." `maphieunhap`='$maphieunhap',"
			." `masanpham`='$masanpham',"
			." `nhacungcap`='$nhacungcap',"
			." `soluong`='$soluong',"
			." `ngaynhap`='$ngaynhap'"
			." WHERE"
			." `id`='$nhapkho_id'"
			;
			$this->query( $query );
			
			if($this->qry_result ){
				$_SESSION['MESSAGE'] = '<div id="success" class="info_div"><span class="ico_success">Cập nhật thành công.</span></div>';
			} else {
				$_SESSION['MESSAGE'] = '<div id="fail" class="info_div"><span class="ico_cancel">Cập nhật không thành công.</span></div>';
			}
			$this->redirect('index.php?page='.$this->page.'&task=edit&nhapkho_id='.$nhapkho_id);
		}
	}
	
	private function delete(){
		$nhapkho_id = $this->clean_var($_GET['nhapkho_id']);
		
		if( is_numeric($nhapkho_id) == FALSE ){
			$_SESSION['MESSAGE'] = 'ID không chính xác.';
		} else {
			$query = "DELETE FROM `nhapkho`"
			." WHERE"
			." `id`='$nhapkho_id'"
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
		$this->nhapkho_id = $this->get_request('nhapkho_id');
		$result_rows = array();
		
		if( $this->nhapkho_id != '' ){
			if( is_numeric($this->nhapkho_id) ){
				$query = "SELECT"
				." `id`,"
				." `maphieunhap`,"
				." `masanpham`,"
				." `nhacungcap`,"
				." `soluong`,"
				." `ngaynhap`"
				." FROM `nhapkho`"
				." WHERE"
				." `id`='$this->nhapkho_id'"
				;
				$result_row = $this->query( $query );
				
				$maphieunhap = $this->html_convert($_POST['maphieunhap']);
				$masanpham = $this->html_convert($_POST['masanpham']);
				$nhacungcap = $this->html_convert($_POST['nhacungcap']);
				$ngaynhap = $this->html_convert($_POST['ngaynhap']);
				$soluong = $this->html_convert($_POST['soluong']);
				
		
				$this->maphieunhap = isset($_POST['maphieunhap'])?$maphieunhap:$result_row['maphieunhap'];
				$this->masanpham = isset($_POST['masanpham'])?$masanpham:$result_row['masanpham'];
				$this->nhacungcap = isset($_POST['nhacungcap'])?$nhacungcap:$result_row['nhacungcap'];
				$this->ngaynhap = isset($_POST['ngaynhap'])?$ngaynhap:$result_row['ngaynhap'];
				$this->soluong = isset($_POST['soluong'])?$soluong:$result_row['soluong'];

				$this->result_rows = $this->select_nhapkho();
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
	
	public function select_nhapkho(){
		$query = "SELECT"
		." `id`,"
		." `maphieunhap`,"
	    ." `masanpham`,"
		." `nhacungcap`,"
		." `soluong`,"
		." `ngaynhap`"
		." FROM `nhapkho`"
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
