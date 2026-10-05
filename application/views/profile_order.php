<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
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
   .right-prof label {
	   display: inline-block;
	   float: left;
	   margin: 0;
   }
   .right-prof .order-row {
	    padding: 15px 0;
		border-bottom: 1px solid #ddd;
   }
   .right-prof div:last-child {
	   border-bottom: 0;
   }
   .order-row .col {
	   width: 25%;
	   float: left;
	   padding: 0 10px;
   }
   .order-row .date a {
	   background-color: #fe4739;
	   color: #fff;
	   padding: 10px;
   }
   .order-row .date a:hover {
	   background-color: #c70808;
   }
   .fwb {
	   font-weight:bold;
   }
</style>
<div class="container content-top">
   <div class="row">
      <?php $this->load->view('modules/mod_menu_left'); ?>
   </div>
</div>
<div class="content full">
   <div id="columns" class="contentin container">
      <?php //$this->load->view('modules/mod_content_header');?>             
      <div class="product full">
         <div class="content-detail">
			<h2 class="h1-title">Tài khoản</h2>
            <div class="left-prof" style="width:22%;float:left;">
				<?php $this->load->view('modules/mod_menu_profile'); ?>
			</div>
			<div class="right-prof" style="width:76%;float:right;border:1px solid #ccc;padding:20px;">
				<h4 class="h1-title" style="border-bottom:1px solid #ddd;text-transform:uppercase; margin: 0 !important;padding-bottom:10px; font-size: 15px;">Quản lý đơn hàng</h4>
				<?php 
					$obj_order = get_order_bymail($_SESSION['cemail_log']);
					if (count($obj_order) == 0){	
				?>
					<p style="margin-top:15px;">Quý khách chưa đặt mua đơn hàng nào.</p>
				<?php } else { 
					foreach ($obj_order as $order) { ?>
					<div class="order-row cb">
						<div class="col date">
							<a href="<?php echo base_url().'profile-order/'.'GS'.$order['nid']; ?>"><?php echo $order['ddate01'] . ' ' . $order['ctime01']; ?></a>
						</div>
						<div class="col id">
							Mã đơn hàng: <span class="fwb">GS<?php echo $order['nid']; ?></span>
						</div>
						<div class="col state">
							Tình trạng: 
							<span class="fwb">
								<?php
									$status = get_status_order($order['nid_order_status']);
									echo $status['corder_status'];
								?>
							</span>
						</div>
						<div class="col total">
							Tổng tiền: <span class="fwb"><?php echo Fview_price($order['ntotal']); ?></span>
						</div>
					</div>
				<?php } } ?>
			</div>
			<div class="clearboth"></div>
         </div>
      </div>
   </div>
   <!-- begin index content -->
   <div class="clearboth"></div>
</div>
<?php $this->load->view('modules/mod_footer');?>
<?php $this->load->view('footer');?>