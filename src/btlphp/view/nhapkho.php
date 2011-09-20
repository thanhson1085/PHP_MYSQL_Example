<h1>QUẢN LÝ NHẬP KHO</h1>
<p>Xin chào <b><?php echo $_SESSION['front']['user']; ?></b>!<a style="text-decoration:underline;" href="<?php echo $_SERVER['PHP_SELF']; ?>?task=logout"> Đăng xuất</a></p><br />
		<?php echo $this->message(); ?>	<br />

			<form action="<?php echo $_SERVER['PHP_SELF'].'?page='.$this->page; ?>" method="post" name="btl_form">
			<div id="useredit" class="clearfix">
			<h2 class="ico_mug">Tạo phiếu nhập</h2>

	Mã phiếu nhập: <br />
	<input type="text" name="maphieunhap" style="width:250px;" value="<?php echo $this->maphieunhap; ?>" /><br />
	Mã sản phẩm: <br />
	<select name="masanpham" style="width:250px;">
	<?php foreach ( $this->result_rows2 as $rows){ 
		$masanpham = $rows['masanpham'];
		$tensanpham = $rows['tensanpham'];
		if ($rows['masanpham'] == $this->masanpham){ ?>
			<option value='<?php echo $masanpham; ?>' selected="selected"><?php echo $tensanpham; ?></option>
		<?php
		}else {
	?>
		<option value='<?php echo $masanpham; ?>'><?php echo $tensanpham; ?></option>
	<?php }}
	?>
	</select><br />
	Nhà cung cấp: <br />
	<input type="text" name="nhacungcap" style="width:250px;" value="<?php echo $this->nhacungcap; ?>" /> <br />
		Số lượng: <br />
	<input type="text" name="soluong" style="width:250px;" value="<?php echo $this->soluong; ?>" /> <br />
		Ngày nhập: <br />
	<input type="text" name="ngaynhap" style="width:250px;" value="<?php echo $this->ngaynhap; ?>" id="datepicker"/> <br />

	<?php if($this->nhapkho_id){ ?>

		<br />
		<input type="hidden" name="task" value="update" />
		<input type="hidden" name="nhapkho_id" value="<?php echo $this->nhapkho_id; ?>" />
		<input type="submit" name="save" value="Cập nhật" />
		<input type="button" name="new" value="Tạo mới" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF'].'?page='.$this->page;  ?>'" />
	<?php } else { ?>
		<br />
		<input type="hidden" name="task" value="insert" />
		<input type="submit" name="save" value="Ghi lại" />
	<?php } ?>
	<input type="hidden" name="session_token" value="<?php echo $this->create_session_token(); ?>" />
		</div><!-- end #useredit -->
		<br /><br />	
		


		
	<div id="tabledata" class="section">
			<h2 class="ico_mug">Danh sách sản phẩm</h2>
	<?php	
		if( count($this->result_rows) > 0 ){
	?>
		<table id="table">
			<thead>
			<tr>
			
				<th width="5%">ID</th>
				<th width="20%">Mã phiếu nhập</th>
				<th width="30%">Nhà cung cấp</th>
				<th width="15%">Mã sản phẩm</th>
				<th width="15%">Ngày nhập</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
		<?php
			foreach( $this->result_rows as $row ) {
			$nhapkho_id = $row['id'];
			$maphieunhap = $row['maphieunhap'];
			$nhacungcap = $row['nhacungcap'];
			$masanpham = $this->limit_chars( $row['masanpham'] );
			$ngaynhap = date('M d, y g:ia',strtotime($row['ngaynhap']));
		?>
		<tr>
			<td><?php echo $nhapkho_id; ?></td>
			<td><?php echo $maphieunhap; ?></td>	
			<td><?php echo $nhacungcap; ?></td>
			<td><?php echo $masanpham; ?></td>
			<td><?php echo $ngaynhap; ?></td>
			<td></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $this->page; ?>&task=delete&nhapkho_id=<?php echo $nhapkho_id; ?>"><img src="img/cancel.jpg" alt="cancel"/></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $this->page; ?>&task=edit&nhapkho_id=<?php echo $nhapkho_id; ?>"><img src="img/edit.jpg" alt="edit"/></a></td>

		</tr>
		<?php
			}
	    ?>
			</tbody>
			
		</table>

		</div> <!-- end #tabledata -->
		
		
	<?php
	} else {
	?>
	<h3 style="color:orange;">Chưa có bản ghi nào.</h3>
	<?php
	}
	?>
</form>
</br>
<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>