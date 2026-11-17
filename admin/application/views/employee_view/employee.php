<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3><small></small></h3>
						</div>

						<div class="title_right">
							
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Thêm mới / Chỉnh sửa</h2>		
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form name='form_main' method="post" action="<?php echo $link_page; ?>">
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">ID Đăng nhập <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cuserid" class="form-control" value="<?php echo $txt_cuserid; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Mật khẩu <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="password" id="txt_cpassword" name="txt_cpassword" class="form-control" value="<?php echo $txt_cpassword; ?>">
												<?php if($event=="add" || $event=="update_add") { ?>
												<i class="fa fa-eye" aria-hidden="true" onclick="showpass()" style="position:absolute;right: 25px;top: 10px;font-size: 16px;"></i>
												<?php } ?>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_cfirstname ?> <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cfirstname" class="form-control" value="<?php echo $txt_cfirstname; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_cmiddlename ?> <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cmiddlename" class="form-control" value="<?php echo $txt_cmiddlename; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_clastname ?> <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_clastname" class="form-control" value="<?php echo $txt_clastname; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Email</label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cemail" class="form-control" value="<?php echo $txt_cemail; ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Phân quyền <span class="required">*</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<?php echo $gencbo_user_type; ?>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Ghi chú</label>
											<div class="col-md-8 col-sm-8 ">
												<textarea class="form-control" name="txt_cnote" placeholder=" " /><?php echo $txt_cnote; ?></textarea>
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-8 col-sm-8 offset-md-2">
												<button type="button" class="btn btn-primary" name="btn_submit" value ="<?php echo $btn_update; ?>" 
													onclick ="js_SetSubmitButtonClick(this.form, this.name);">Xác nhận</button>
												<button class="btn btn-danger" type="button" name="btn_cancel" value ="<?php echo $btn_cancel; ?>" 
													onclick ="location.href='<?php echo $link_cancel; ?> '">Quay về</button>
											</div>
										</div>
										<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
										<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
										<input type="hidden" name="hidden_button"  value = "" />
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
<script>			
function showpass() {
  var x = document.getElementById("txt_cpassword");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>