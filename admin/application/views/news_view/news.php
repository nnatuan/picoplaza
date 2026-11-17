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
											<label class="col-form-label col-md-2 col-sm-2 label-align">Nhóm</label>
											<div class="col-md-8 col-sm-8 ">
												<?php echo $gencbo_cat_news_list; ?>
											</div>	
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Tiêu đề <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>" required="required" class="form-control " onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">
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
											<label class="col-form-label col-md-2 col-sm-2 label-align">Mô tả </label>
											<div class="col-md-8 col-sm-8 ">
												<textarea class="form-control" id="editor1" name="txt_cshort_content"><?php echo $txt_cshort_content; ?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Nội dung </label>
											<div class="col-md-8 col-sm-8 ">
												<textarea class="form-control" id="editor2" name="txt_ccontent"><?php echo $txt_ccontent; ?></textarea>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Image 
												<br><span style="color:red;">(600x315)</span>
											</label>
											<div class="col-md-8 col-sm-8 ">
												<input name="txt_cthumb_img" type="file" id="txt_cimage" value ="" size="25" style="width:400px;"/>
												 <br>
												 <?php if($txt_cthumb_img != ''): ?>
												 <img style="margin-top:10px" width="200" src="<?php echo $fr_img.'upload/image_article/'.$txt_cthumb_img; ?>"/>
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