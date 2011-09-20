<h1>QUẢN LÝ NGƯỜI DÙNG</h1>
<p>Xin chào <b><?php echo $_SESSION['front']['user']; ?></b>!<a style="text-decoration:underline;" href="<?php echo $_SERVER['PHP_SELF']; ?>?task=logout"> Đăng xuất</a></p><br />
		<?php echo $this->message(); ?>	<br />

			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="blorg_form">
			<div id="useredit" class="clearfix">
			<h2 class="ico_mug">Tạo mới người dùng</h2>

	Tài khoản: <br />
	<input type="text" name="username" style="width:250px;" value="<?php echo $this->username; ?>" /><br />
	Password: <br />
	<input type="password" name="password" style="width:250px;" value="<?php echo $this->password; ?>" /> Confirm Password:	<input type="password" name="confirmpassword" style="width:250px;" value="<?php echo $this->password; ?>" /> <br />
	Quyền: <br />
	<select name="permission_id" style="width:250px;">
	<?php foreach ( $this->result_rows2 as $rows){ 
		$permission_id = $rows['permission_id'];
		$permission_name = $rows['permission_name'];
		if ($rows['permission_id'] == $this->permission_id){ ?>
			<option value='<?php echo $permission_id; ?>' selected="selected"><?php echo $permission_name; ?></option>
		<?php
		}else {
	?>
		<option value='<?php echo $permission_id; ?>'><?php echo $permission_name; ?></option>
	<?php }}
	?>
	</select><br />
	Tên: <br />
	<input type="text" name="fistname" style="width:250px;" value="<?php echo $this->fistname; ?>" /><br />
	Họ: <br />
	<input type="text" name="lastname" style="width:250px;" value="<?php echo $this->lastname; ?>" /><br />
	Công ty: <br />
	<input type="text" name="companyname" style="width:250px;" value="<?php echo $this->companyname; ?>" /><br />
	Quốc gia: <br />
	<input type="text" name="nationality" style="width:250px;" value="<?php echo $this->nationality ?>" /><br />
	Mô tả: <br />
	<textarea id="markItUp" name="description" rows="7" cols="30" style="height:150px;"><?php echo $this->description; ?></textarea><br />
	<?php if($this->user_id){ ?>
		Ngày tạo: <b><?php echo date('M d, y g:ia',strtotime($this->date_created)); ?></b>
		<br />
		<input type="hidden" name="task" value="update" />
		<input type="hidden" name="user_id" value="<?php echo $this->user_id; ?>" />
		<input type="submit" name="save" value="Cập nhật" />
		<input type="button" name="new" value="Tạo mới" onclick="window.location.href='<?php echo $_SERVER['PHP_SELF']; ?>'" />
	<?php } else { ?>
		<br />
		<input type="hidden" name="task" value="insert" />
		<input type="submit" name="save" value="Ghi lại" />
	<?php } ?>
	<input type="hidden" name="session_token" value="<?php echo $this->create_session_token(); ?>" />
		</div><!-- end #useredit -->
		<br /><br />	
		


		
	<div id="tabledata" class="section">
			<h2 class="ico_mug">Danh sách người dùng</h2>
	<?php	
		if( count($this->result_rows) > 0 ){
	?>
		<table id="table">
			<thead>
			<tr>
			
				<th width="5%">ID</th>
				<th width="20%">Tài khoản</th>
				<th width="30%">Tên</th>
				<th width="15%">Mô tả</th>
				<th width="15%">Ngày tạo</th>
				<th width="15%"></th>
			</tr>
			</thead>
			<tbody>
		<?php
			foreach( $this->result_rows as $row ) {
			$user_id = $row['user_id'];
			$username = $row['username'];
			$fistname = $row['fist_name'];
			$description = $this->limit_chars( $row['description'] );
			$date_created = date('M d, y g:ia',strtotime($row['date_created']));
		?>
		<tr>
			<td><?php echo $user_id; ?></td>
			<td><?php echo $username; ?></td>	
			<td><?php echo $fistname; ?></td>
			<td><?php echo $description; ?></td>
			<td><?php echo $date_created; ?></td>
			<td></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?task=delete&user_id=<?php echo $user_id; ?>"><img src="img/cancel.jpg" alt="cancel"/></a><a href="<?php echo $_SERVER['PHP_SELF']; ?>?task=edit&user_id=<?php echo $user_id; ?>"><img src="img/edit.jpg" alt="edit"/></a></td>

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
