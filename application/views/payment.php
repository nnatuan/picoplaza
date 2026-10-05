<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>

<style type="text/css">
   .contact-info .td-0 {
   font-weight: bold;
   background: #FCFAFA;
   width: 150px;
   }
   .contact-info td {
   padding: 5px 15px;
   text-align: left;
   padding-left: 30px;
   font-family: Arial, Helvetica, sans-serif;
   font-size: 12px;
   color: #666;
   line-height: 20px;
   }
   .mod_content table {
   width: 100%;
   }
</style>
<style>
   .header-navigation>ul {
   display: none;
   }
   #column-left:hover ul{
   display: block;		
   }
   #column-left {
   position: absolute;
   z-index: 999;
   width: 240px;
   }
   .full {
   margin-top: 30px;
   }
   #column-left .box-category-heading {
   cursor: pointer;
   }
   .container.content-top .row {
	   position: relative;
   }
   .right-slideshow {
	   position: absolute;
	   right: 0;
   }
   .top1, .top2 .logo, .top2-right-top, .top2-right-bot, #column-left {
	   animation: none;
   }
   .sta-checkout .ship-id, .sta-checkout .pay-id {
		color: #ffe51e;
	}
	.sta-checkout .ship-id .ship-id {
		background: url(<?php echo base_url().'images/van-chuyen-icon-done.png'; ?>) no-repeat right center;
	}
	.sta-checkout .pay-id .pay-id {
		background: url(<?php echo base_url().'images/thanh-toan-icon-done.png'; ?>) no-repeat right center;
	}
	.money input[type="radio"]{margin-right:5px;}
	.money span{text-transform: capitalize;
font-weight: normal;
font-size: 14px;}
ul.tabs li{padding:0 10px;}
</style>
<div class="container content-top">
   <div class="row">
      <?php $this->load->view('modules/mod_menu_left'); ?>  
   </div>
</div>
<div class="content full">
   <div id="columns" class="contentin container">
		<div class="step-bar">
			<?php $this->load->view('modules/mod_step_images'); ?>
		</div>
		<div class="checkout-main">
<div class="shipping-area">
   <form id="ppayment" method="post" action="<?php echo base_url().'mua-hang/xac-nhan'; ?>">
      <div class="cart-ckout-title blue">Chọn phương thức thanh toán:</div>
      <div class="shipping-content clearfix" style="padding: 0 20px 20px;">
         <ul class="tabs clearfix">
            <li class="">
               
                  <div class="title money">
                  <span><input type="radio" value="3" name="paymethod" checked="checked" >Thanh Toán Khi Nhận Hàng (COD)</span>
                  </div>
                  
               
            </li>
            <li class="">
               
                  <div class="title money">
                  <span><input type="radio" value="4" name="paymethod">Thanh Toán Chuyển khoản</span>
                  </div>
                  
               
            </li>
         </ul>
         <div class="clearfix"></div>
         <div class="block clearfix">
            <div class="tab-wap" id="tabCOD">
               <div class="paymeni-wap">
					<?php $data = get_module_byid(52);
						if(isset($data['cnote']))
							echo $data['cnote'];
					?>
					<?php /*
                  <div><b>Đây là phương thức thanh toán tại nhà Quý Khách. Quý Khách sẽ phải thanh toán thêm <span id="codprice1">0đ</span> khi chọn phương thức này.</b></div>
                  <div style="padding-top:20px;">
                     <u>Lưu ý:</u> Vui lòng kiểm tra kỹ thông tin đơn hàng bên tay phải về: 
                     <br>
                     - Phí giao hàng<br>
                     - Phí thu tiền tại nhà (COD)
                  </div> */ ?>
               </div>
            </div>
         </div>
      </div>
      <div class="cart-ckout-title">Ghi chú:</div>
      <div class="shipping-content clearfix" style="padding: 0 20px;">
         <div class="fitem">
            <textarea name="cnote" class="text" style="width: 99%;"></textarea>
         </div>
      </div>
      <div style="text-align:center;">
         <div class="clear"></div>
         <button type="submit" name="btn_submit" value="1" class="submit_btn login_btn">
         <span class="submit_btn_text">Đặt Mua</span>
         <span class="submit_btn_icon"></span>
         </button>
      </div>
   </form>
</div>
		<?php $this->load->view('modules/mod_cart_product');?>
						
		</div>
   </div>
</div>
<?php $this->load->view('modules/mod_footer');?>
<?php $this->load->view('footer');?>