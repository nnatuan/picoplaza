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
									<form name='form_main' method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Tên <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_ccat_products" value="<?php echo $txt_ccat_products; ?>" required="required" class="form-control" onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Code <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" id="txt_ccode" name="txt_ccode" value="<?php echo $txt_ccode; ?>" placeholder="" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Chỉ mục </label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cindex" value="<?php echo $txt_cindex; ?>" placeholder="" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Image <br><span style="color:red;">(300x300)</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input name="txt_cthumb_img" type="file" id="txt_cthumb_img" value ="" size="25" style="width:400px;"/>
												 <br>
												 <?php if($txt_cthumb_img != ''): ?>
												 <img style="margin-top:10px" width="200" src="<?php echo $fr_img.'upload/images_product/brand/'.$txt_cthumb_img; ?>"/>
												 <?php endif; ?>
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
										  <input name="hidden_image_old" type="hidden" value = "<?php echo $txt_cthumb_img; ?>"  />
									</form>
								</div>
							</div>
						</div>
					</div>

					
				</div>
			</div>
			<!-- /page content -->