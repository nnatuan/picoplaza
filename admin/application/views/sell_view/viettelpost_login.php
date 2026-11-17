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
			<div class="right_col" role="main">
				<div class="">
					<div class="row">
						<div class="col-md-12 col-sm-12 pd0">
							<div class="x_panel">
								<div class="container">
									<p class="text-danger"><em>Để sử dụng chức năng này vui lòng kết nối tài khoản VTP của bạn với trình quản lý ứng dụng.</em></p>
									<div style="width:300px;margin:0 auto;margin-top:100px;height:calc(100vh - 130px);">
										<img src="<?php echo base_url(); ?>images/vtp_login.png" style="width:150px;object-fit: contain;margin-bottom: 10px;display:block;" />
											<label class="col-form-label label-align">Nhập SĐT hoặc Email</label>
											<input type="text" id="cid" class="form-control" placeholder="ID tài khoản" required="" />
											<label class="col-form-label label-align">Mật khẩu</label>
											<input type="password" id="cpassword" class="form-control" placeholder="Mật khẩu" required="" />
											<button type="button" class="btn btn-danger" name="btn_submit" onclick="login_vtp();" style="width:150px;margin:0 auto;margin-top:15px;">Kết nối <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
								  </div>
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
	function login_vtp() {
		_cid = jQuery("#cid").val();
		_cpassword = jQuery("#cpassword").val();

		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/login_vtp",
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
						location.reload();
					else
						alert("Phản hồi từ VTP: \n" + rs.status + ' - ' + rs.message);
					//jQuery('.ajax-loader').css("visibility", "hidden");
				}
			});
	}

</script>				
