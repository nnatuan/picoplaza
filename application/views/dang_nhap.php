<?php 
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   ?>
<style>
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
.ajax-loader .fa-spin {
	font-size:40px !important;
	position: absolute;
	top: 50%;
	color: #fff;
}
.form-control {
	border: 1px solid #eee;
    margin-bottom: 10px;
}
</style>
<div class="ajax-loader">
	<i class="fa fa-spinner fa-spin fa-3x"></i>
</div>
<div class="main-wrap full">
<div class="div-dk" style="padding:100px 0;padding-bottom:150px;background:#eee;">	
	<div class="box-dk" style="width:350px;margin:0 auto;position: relative;background:#fff;">
		<h4 class="title-dn-dk">ĐĂNG NHẬP</h4>
		<div id="register_box" style="padding:15px;min-height: 200px;font-size: 14px;">

					<label>ID đăng nhập</label>
					<input id="cid" name="cid" type="text" class="form-control" placeholder="Nhập SĐT của bạn" autocomplete="off" />
					<label>Mật khẩu <a href="<?php echo base_url(); ?>khoi-phuc-mat-khau" style="position: absolute;right: 15px;color:red;">Quên mật khẩu?</a></label>
					<input id="cpassword" name="cpassword" type="password" class="form-control" placeholder="******" autocomplete="off" />

					<button id="login" style="width: 100%;background: #159fde;color: #fff;border: 0;padding: 9px 0;margin-top: 20px;margin-bottom: 20px;border-radius: 4px;" onclick="dang_nhap();">ĐĂNG NHẬP</button>
					<p style="margin-bottom: 10px;text-align: center;">Bạn chưa có tài khoản</p>
					<button style="width: 100%;background: #ff6600;color: #fff;border: 0;padding: 9px 0;margin-bottom: 20px;border-radius: 4px;" onclick="location.href='<?php echo base_url().'dang-ky'; ?>'">ĐĂNG KÝ</button>
			</div>	
		</div>
	</div>

</div>
<script>
	function dang_nhap(){
		var _cid = jQuery('#cid').val();
		var _cpassword = jQuery('#cpassword').val();
		if(_cid != "" && _cpassword != "") {
                jQuery.ajax({
                    url : "<?php echo base_url(); ?>ajax_actions/dang_nhap",
                    type : "post",
                    dataType:"text",
                    data : {
                        cid: _cid,
						cpassword: _cpassword
                    },
					beforeSend: function(){
						jQuery('.ajax-loader').css("visibility", "visible");
					},
                    success : function (result){
						if(result=='0')
							alert("Thông tin đăng nhập không đúng, vui lòng kiểm tra lại.");
						else if(result=='2')
							alert("Tài khoản của bạn chưa được kích hoạt.");
						else 
							location.href = "<?php echo $_SESSION['back_url']; ?>";
							//location.href = "<?php echo base_url(); ?>";
						/*
						else if(result=='1')
							location.href = "<?php echo $_SESSION['url']; ?>";
						else
							location.href = "<?php echo base_url().'khach-si'; ?>";
						*/
                    },
					complete: function(){
						jQuery('.ajax-loader').css("visibility", "hidden");
					}
                });
        } else 
			alert("Vui lòng nhập ID và mật khẩu");
	}
	
	jQuery(function() {
				jQuery("input[name='cid'], input[name='cpassword']").keypress(function (e) {
					if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
						jQuery('#login').click();
						return false;
					} else {
						return true;
					}
				});
			});
</script> 		
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>