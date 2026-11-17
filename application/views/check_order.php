<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   ?>  
<style>
.content {padding-top:30px;}
.form-control,.btn-submit {
	width:300px;
    margin: 0 auto;
    margin-bottom: 15px;	
}
</style>   
<div class="main container">
	<div class="title_box text-center uppercase"><h4 class="title">Tra cứu đơn hàng</h4></div>
    <div class="content text-center">
					<input id="ccode" name="ccode" type="text" class="form-control" placeholder="Nhập mã đơn hàng" autocomplete="off" />
					<input id="cid" name="cid" type="text" class="form-control" placeholder="Nhập số điện thoại đặt hàng" autocomplete="off" />
					<button class="btn-submit" style="background: #ff6600;color: #fff;border: 0;padding: 8px 0;margin-bottom: 20px;border-radius: 4px;" onclick="check_order();">Xác nhận</button>
	 </div>
</div>
<script>
	function check_order(){
		var _cid = jQuery('#cid').val();
		var _ccode = jQuery('#ccode').val();
		if(_cid != "" && _ccode != "") {
                jQuery.ajax({
                    url : "<?php echo base_url(); ?>ajax_actions/check_order",
                    type : "post",
                    dataType:"text",
                    data : {
                        cid: _cid,
						ccode: _ccode
                    },
					beforeSend: function(){
						jQuery('.ajax-loader').css("visibility", "visible");
					},
                    success : function (result){
						if(result=='1')
							location.href = "<?php echo base_url().'chi-tiet-don-hang'; ?>";
						else
							alert("Thông tin không chính xác!");
                    },
					complete: function(){
						jQuery('.ajax-loader').css("visibility", "hidden");
					}
                });
        } else 
			alert("Thông tin không chính xác!");
	}
</script> 	
<?php 
   $this->load->view($view_folder.'/modules/mod_footer');
   $this->load->view($view_folder.'/footer');
   ?>