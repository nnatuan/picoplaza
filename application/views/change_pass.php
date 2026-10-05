<?php 
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   $member = get_member_by_id($_SESSION['nid_member']);
   ?>
<style>
.main {
	min-height:650px;
}
.menu-item {
	display: block;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 10px;
	color: #000;
}
.menu-item.active {
	border-bottom: 1px solid #000;
	font-weight: bold;
}
.right-info p {
	position:relative;
	margin-bottom: 10px;
    padding-bottom: 10px;
}

.right-info p .fa {
    width: 20px;
    color: #ef8121;
}

</style> 
<div class="main container">
	<div class="title_box"><h4 class="title">HỒ SƠ CÁ NHÂN</h4></div>
	<div class="row">
	<div class="col-sm-3">
									  <a class="menu-item" href="<?php echo base_url(); ?>profile"><i class="fa fa-caret-right" aria-hidden="true"></i> Thông tin cơ bản</a>
									  <a class="menu-item" href="<?php echo base_url(); ?>lich-su-mua-hang"><i class="fa fa-caret-right" aria-hidden="true"></i> Lịch sử mua sắm</a>
									  <a class="menu-item active" href="<?php echo base_url(); ?>doi-mat-khau"><i class="fa fa-caret-right" aria-hidden="true"></i> Đổi mật khẩu</a>
									  <a class="menu-item" href="<?php echo base_url(); ?>thao-tac/dang-xuat"><i class="fa fa-caret-right" aria-hidden="true"></i> Đăng xuất &nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
								  </div>
								<div class="col-sm-9 right-info">
									<form class="" method="post" action="">
										<div class="form-inputs clearfix">
										  <p>
											<label for="newpassword" class="required">Mật khẩu cũ <span class="text-danger">*</span>
											</label>
											<input class="form-control" name="cpassword_old" id="cpassword_old" type="password"  placeholder="**********" required>
										  </p>
										  <p>
											<label for="newpassword" class="required">Mật khẩu mới <span class="text-danger">*</span>
											</label>
											<input class="form-control"  name="cpassword" id="newpassword" type="password" value="" placeholder="**********" required>
										  </p>
										  <p>
											<label for="newpassword2" class="required">Mật khẩu xác nhận <span class="text-danger">*</span>
											</label>
											<input class="form-control" name="confirm_password" id="newpassword2" type="password" value="" placeholder="**********" required>
										  </p>
										</div>
										
										<?php if($msg != '') echo '<p style="color:red;margin:0;">'.$msg.'</p>'; ?>
										<p class="form-submit">

													<input type="submit" name="btn_submit" value="Cập nhật" class="btn-submit btn btn-danger" style="margin-bottom: 10px;">

										</p>
										
									  </form>
										</div>	
					</div>				  
								</div>
</div>
		
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>