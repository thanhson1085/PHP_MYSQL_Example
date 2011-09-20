<h1>QUẢN LÝ SẢN PHẨM</h1>
<p>Xin chào <b><?php echo $_SESSION['front']['user']; ?></b>!<a style="text-decoration:underline;" href="<?php echo $_SERVER['PHP_SELF']; ?>?task=logout"> Đăng xuất</a></p><br />
		<?php echo $this->message(); ?>	<br />

			<form action="<?php echo $_SERVER['PHP_SELF'].'?page='.$this->page; ?>" method="post" name="btl_form">
			<div id="useredit" class="clearfix">
			<h2 class="ico_mug">Thêm mới sản phẩm</h2>

	Mã sản phẩm: <br />
	<input type="text" name="masanpham" style="width:250px;" value="<?php echo $this->masanpham; ?>" /><br />
	Tên sản phẩm: <br />
	<input type="tensanpham" name="tensanpham" style="width:250px;" value="<?php echo $this->tensanpham; ?>" /> <br />
		Ngày sản xuất: <br />
	<input type="ngaysanxuat" name="ngaysanxuat" style="width:250px;" value="<?php echo $this->ngaysanxuat; ?>" id="datepicker"/> <br />
	Mô tả: <br />
	<textarea id="markItUp" name="mota" rows="7" cols="30" style="height:150px;"><?php echo $this->mota; ?></textarea><br />
	<?php if($this->sanpham_id){ ?>

		<br />
		<input type="hidden" name="task" value="update" />
		<input type="hidden" name="sanpham_id" value="<?php echo $this->sanpham_id; ?>" />
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
				<th width="20%">Mã sản phẩm</th>
				<th width="30%">Tên sản phẩm</th>
				<th width="15%">Mô tả</th>
				<th width="15%">Ngày sản xuất</th>
				<th></th>
			</tr>
			</thead>
			<tbody>
		<?php
			foreach( $this->result_rows as $row ) {
			$sanpham_id = $row['id'];
			$masanpham = $row['masanpham'];
			$tensanpham = $row['tensanpham'];
			$mota = $this->limit_chars( $row['mota'] );
			$ngaysanxuat = date('M d, y g:ia',strtotime($row['ngaysanxuat']));
		?>
		<tr>
			<td><?php echo $sanpham_id; ?></td>
			<td><?php echo $masanpham; ?></td>	
			<td><?php echo $tensanpham; ?></td>
			<td><?php echo $mota; ?></td>
			<td><?php echo $ngaysanxuat; ?></td>
			<td></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $this->page; ?>&task=delete&sanpham_id=<?php echo $sanpham_id; ?>"><img src="img/cancel.jpg" alt="cancel"/></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo $this->page; ?>&task=edit&sanpham_id=<?php echo $sanpham_id; ?>"><img src="img/edit.jpg" alt="edit"/></a></td>

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