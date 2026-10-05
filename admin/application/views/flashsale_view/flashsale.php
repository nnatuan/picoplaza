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
											<label class="col-form-label col-md-2 col-sm-2 label-align">Tên <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="txt_cname" value="<?php echo $txt_cname; ?>" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Ngày bắt đầu <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="cdate_start" value="<?php echo $cdate_start; ?>" required="required" class="form-control " placeholder="dd-mm-yyyy" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Thời gian bắt đầu <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="ctime_start" value="<?php echo $ctime_start; ?>" required="required" class="form-control " placeholder="dd-mm-yyyy" onfocus="this.type='time'" onmouseover="this.type='time'" onclick="this.type='time'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Ngày kết thúc <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="cdate_end" value="<?php echo $cdate_end; ?>" required="required" class="form-control " placeholder="dd-mm-yyyy" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-2 col-sm-2 label-align">Thời gian kết thúc <span class="required">*</span></label>
											<div class="col-md-8 col-sm-8 ">
												<input type="text" name="ctime_end" value="<?php echo $ctime_end; ?>" required="required" class="form-control " placeholder="dd-mm-yyyy" onfocus="this.type='time'" onmouseover="this.type='time'" onclick="this.type='time'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
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