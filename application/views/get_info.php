<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   ?>  
<script type="text/javascript">
   function update_cart(_id){
   	_qty = jQuery("#cquantity_"+_id).val();   
   		jQuery.post( "<?php echo base_url().'thao-tac/cap-nhat-san-pham'?>", { id: _id, qty: _qty })
   	  .done(function( data ) {  		
   		location.reload();
   	  });
   }   
   function del_cart(_id){
   	cfm= confirm("Bạn muốn xóa sản phẩm này khỏi giỏ hàng của mình ?");
   	if(cfm == true){
   		jQuery.post( "<?php echo base_url().'thao-tac/xoa-san-pham'?>", { id: _id })
   	  .done(function( data ) {	
   		location.reload();
   	  });
   	}
   }
</script>
<div class="container" id="container_category">
         <div class="row">
            <nav class="box-breadcrumb-pc" aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Trang chủ</a></li>                                                              
                  <li class="breadcrumb-item active" aria-current="page">
                     <a href="#">Thông tin liên hệ</a>
                  </li>
               </ol>
            </nav>
			<section class="wrapper-slide-category clearfix">
                  <?php 
				$data = get_module_byid(66);
				if(isset($data['cnote']))
					echo $data['cnote'];
			?>
            </section>
			<div class="content-body">
			<h3 class="title-content">Thông tin liên hệ</h3>
			<div id="box_dathang2">
            <form id="mua_hang_2" method="post" action="<?php echo base_url().'gio-hang'?>" >
               <p style="font-size: 13px;">Để tiếp tục mua hàng bạn vui lòng nhập đầy đủ thông tin (*), xin cảm ơn.</p>
               <label class="box_label">Tên *</label>
               <input class="input_dathang_2" name="cname" value="" required/><br />
               <label class="box_label">Email *</label>
               <input class="input_dathang_2" type="email" name="cemail" value="" required/><br />
               <label class="box_label">Điện Thoại *</label>
               <input class="input_dathang_2" name="cphone" value="" required/><br />
               <label class="box_label">Địa chỉ *</label>
               <input class="input_dathang_2" name="caddress" value="" required/><br />
			   <label class="box_label">Hình thức thanh toán *</label>
			   <select name="cpayment_method">
				<option value="0">Chuyển khoản</option>
				<option value="1">Tiền mặt</option>
				<option value="2">COD</option>
			   </select>
               <label class="box_label">Ghi Chú </label>
               <textarea class="input_dathang_2 " name="cnote" ></textarea>
               <br />
               <input type="hidden" name="id_hidden_pr" value="" />
               <div class="clear-25"></div>
               <input type="button" name="btn_return" value="Trở lại" onclick="location.href='<?php echo base_url() ?>'"/>
               <input type="submit" name="bnt_submit01" id="bnt_submit01" value="Tiếp tục"/>
            </form>
         </div>	
         </div>
      </div>
	  </div>
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>