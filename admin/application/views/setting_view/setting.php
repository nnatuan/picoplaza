<style>
ul.bar_tabs {background:none;}
.ajax-loader {
  visibility: hidden;
  background-color: rgba(0,0,0,0.5);
  position: fixed;
  z-index: +100 !important;
  width: 100%;
  height:100%;
  top: 0;
  left: 0;
  text-align: center;
}
.ajax-loader p {
	font-size:20px !important;
	position: absolute;
	top: 45%;
	color: #fff;
	width:100%;
	text-align:center;
    letter-spacing: 3px;	
}
.ajax-loader p .fa {
	font-size:30px !important;
}
</style>
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
									<h2>CÀI ĐẶT THÔNG TIN SHOP VIETTELPOST</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<form name='form_main' method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">
										<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
										  <li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Thông tin cửa hàng</a>
										  </li>
										  <li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Thiết lập token</a>
										  </li>
										</ul>
										<div class="tab-content" id="myTabContent">
										  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Tên nhà bán hàng <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<input type="text" name="ccompany" value="<?php echo $ccompany; ?>" required="required" class="form-control ">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Điện thoại <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<input type="text" name="cphone" value="<?php echo $cphone; ?>" required="required" class="form-control ">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Email </label>
												<div class="col-md-8 col-sm-8 ">
													<input type="text" name="cemail" value="<?php echo $cemail; ?>" class="form-control ">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Thành phố <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<select id="to_province_name" name="nid_province" class="form-control" onchange="load_district(this.value);">
														<option value=""></option>
													</select>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Quận/Huyện <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<select id="to_district_name" name="nid_district" class="form-control" onchange="load_ward(this.value);">
														<option value=""></option>
													</select>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Phường/Xã <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<select id="to_ward_name" name="nid_ward" class="form-control">
														<option value=""></option>
													</select>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Đường/Số nhà <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<input type="text" name="caddress" value="<?php echo $caddress; ?>" required="required" class="form-control ">
												</div>
											</div>
											</div>
											<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align"></label>
												<div class="col-md-8 col-sm-8 text-danger">
													<em>Nếu bạn không tạo được đơn hàng hoặc lỗi token khi tạo đơn VTP hãy nhập thông tin đăng nhập VTP của bạn dưới đây và nhấn Update để hệ thống cập nhật token mới.</em>
												</div>
											</div>	
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">SĐT hoặc Email <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<input type="text" id="cid" value="" required="required" class="form-control ">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Password <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<input type="password" id="cpassword" value="" required="required" class="form-control ">
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align">Token <span class="required">*</span></label>
												<div class="col-md-8 col-sm-8 ">
													<textarea class="form-control" id="ctoken" name="ctoken" style="height:120px;"><?php echo $ctoken; ?></textarea>
												</div>
											</div>
											<div class="item form-group">
												<label class="col-form-label col-md-2 col-sm-2 label-align"></label>
												<div class="col-md-8 col-sm-8 ">
													<button type="button" class="btn btn-danger" name="btn_submit" value="<?php echo $btn_update; ?>" onclick="login_get_token();">Update token</button>
												</div>
											</div>
											</div>
										</div>
											
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-8 col-sm-8 offset-md-2">
												<button type="button" class="btn btn-primary" name="btn_submit" value ="<?php echo $btn_update; ?>" 
													onclick ="js_SetSubmitButtonClick(this.form, this.name);">Cập nhật</button>	
												<?php if($msg!="") { ?>
												<p style="line-height: 37px;margin: 0;margin-left: 10px;font-style: italic;color: #04AA6D;font-weight: bold;float: right; font-size: 16px;"><em><?php echo $msg; ?></em></p>
												<?php } ?>												
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
<div class="ajax-loader">
	<p><i class="fa fa-spinner fa-spin fa-3x"></i><br> <em>loading...</em></p>
</div>			
<script src="https://code.jquery.com/jquery-latest.min.js"></script>			
<script>
    jQuery(window).on('load', function() {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_province",
				type: 'GET',
				datatype: "json",
				//contentType: 'application/json; charset=utf-8',
				//crossDomain: true,
				//processData: false,
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					/*
					alert(result);
					alert(result["nid"]); 
					alert(result.nid);
					cus = JSON.parse(result);
					alert(cus.nid);
					*/
					rs = JSON.parse(result);
					//console.log(result);
					//alert(rs.code);
					var list = rs.data;
					//console.log(list);
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						if(item.PROVINCE_ID == '<?php echo $nid_province; ?>')
							content += '<option value="' + item.PROVINCE_ID + '" selected>' + item.PROVINCE_NAME + '</option>';
						else
							content += '<option value="' + item.PROVINCE_ID + '">' + item.PROVINCE_NAME + '</option>';
					};
					//jQuery("#nid_province_gui").html(content);
					jQuery("#to_province_name").html(content);
					//jQuery("#to_province_name").val("202").change();
					//jQuery("#to_district_name").val("3695").change();
					jQuery("#to_province_name").trigger("change");
					//load_district(202);
					//load_ward(3695);
				}
			});	
	});
	
	function login_get_token() {
		_cid = jQuery("#cid").val();
		_cpassword = jQuery("#cpassword").val();

		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/login_get_token",
				type: 'POST',
				datatype: "json",
				data: { cid: _cid, cpassword: _cpassword },
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){
					//console.log(result);
					//alert(result);
					rs = JSON.parse(result);
					//alert(rs.status + ' - ' + rs.message);
					if(rs.status==200)
						jQuery("#ctoken").val(rs.data.token);
					//jQuery('.ajax-loader').css("visibility", "hidden");
				}
			});
	}
	
	function load_district(value) {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_district",
				type: 'POST',
				datatype: "json",
				data: { nid_province: value },
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						if(item.DISTRICT_ID == '<?php echo $nid_district; ?>')
							content += '<option value="' + item.DISTRICT_ID + '" selected>' + item.DISTRICT_NAME + '</option>';
						else
							content += '<option value="' + item.DISTRICT_ID + '">' + item.DISTRICT_NAME + '</option>';
					};
					jQuery("#to_district_name").html(content);
					jQuery("#to_district_name").trigger("change");
				}
			});
	}
	function load_ward(value) {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_ward",
				type: 'POST',
				datatype: "json",
				data: { nid_district: value },
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						if(item.WARDS_ID == '<?php echo $nid_ward; ?>')
							content += '<option value="' + item.WARDS_ID + '" selected>' + item.WARDS_NAME + '</option>';
						else
							content += '<option value="' + item.WARDS_ID + '">' + item.WARDS_NAME + '</option>';
					};
					jQuery("#to_ward_name").html(content);
				}
			});
	}
</script>			