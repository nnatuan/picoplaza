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
   .right-prof .order {
	   padding: 15px 10px;
   }
   .order .left-c {
	   width: 55%;
	   float: left;
   }
   .order .right-c {
	    width: 45%;
		float: right;
		border-left: 1px dotted #ccc;
		padding-left: 55px;
   }
   .order .l-title, .order .r-cont {
	   width:30%;
	   float: left;
   }
   .order .r-cont {
	   width:50%;
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
				<h4 class="h1-title" style="border-bottom:1px solid #ddd;text-transform:uppercase; margin: 0 !important;padding-bottom:10px; font-size: 15px;">Chi tiết đơn hàng</h4>
				<?php 
					$id = str_replace("GS","",$nid);
					$order = get_order_by_id_email($id, $cemail); 
					if ($order != NULL) {
				?>
				<div class="order cb">
					<div class="left-c cb">
						<div class="l-title">
							<p>Mã đơn hàng:</p>
							<p>Ngày đặt hàng:</p>
							<p>Tổng tiền:</p>
							<p>Tình trạng:</p>
						</div>
						<div class="r-cont">
							<p class="fwb">GS<?php echo $order['nid']; ?></p>
							<p><?php echo $order['ddate01'] . ' ' . $order['ctime01']; ?></p>
							<p class="fwb"><?php echo Fview_price($order['ntotal']); ?></span></p>
							<p>
								<?php
									$status = get_status_order($order['nid_order_status']);
									echo $status['corder_status'];
								?>
							</p>
						</div>
					</div>
					<div class="right-c">
						<p style="text-transform:uppercase;">Thông tin người mua</p>
						<div class="l-title">
							<p>Họ tên:</p>
							<p>SĐT:</p>
							<p>Địa chỉ:</p>
							<p>Email:</p>
						</div>
						<div class="r-cont">
							<p><?php echo $order['cfullname']; ?></p>
							<p><?php echo $order['cphone']; ?></p>
							<p><?php echo $order['caddress']; ?></p>
							<p><?php echo $order['cemail']; ?></p>
						</div>
					</div>
				</div>
				<div class="order-detail">
					<div class="cart-content clearfix">
                     <div class="title-pro-cart">
                        <div class="name-col">Tên sản phẩm</div>
                        <div class="price-col">Giá</div>
                        <div class="qty-col">Số lượng</div>
                        <div class="tt-col">Thành tiền</div>
                        <div class="del-col"></div>
                     </div>
                     <div class="clearfix"></div>
					 <?php 
						$obj_data = get_order_detail($order['nid']);
						foreach($obj_data as $data) {
							$unit = get_unit_detail($data['nid_product']);
							$product = get_product_detail($unit['nid_product']);
                        ?>
                       <div class="pro-item clearfix">
							<div class="name-col">
							   <a href="<?php echo base_url().$product['ccode'].'-'.$unit['nid']; ?>"><img src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" width="90" height="90"></a>
							   <p class="proname"><a href="<?php echo base_url().$product['ccode'].'-'.$unit['nid']; ?>"><?php echo $product['cproducts'].' - '. $unit['cname']; ?>
								<?php if($product['cgift'] != "") { ?>
									</br>
									<span style="color:red"><?php echo $product['cgift']; ?></span>
								<?php } ?>
							   </a></p>
							</div>
							<div class="price-col">
							   <span><?php echo Fview_price($unit['cprice']); ?></span>
							</div>
							<div class="qty-col">
							   <span><?php echo $data['nquantity']; ?></span>
							</div>
							<div class="tt-col">
							   <span><?php echo Fview_price($unit['cprice']*$data['nquantity']);?></span> 
							</div>
						</div>
						<?php } ?>
                    </div>
				</div>
				<?php } else { ?>
					<p style="margin-top:15px;">Không tìm thấy đơn hàng có mã <span style="font-weight:bold;"><?php echo $nid; ?></span><?php if($cemail != "") { ?> của TK email <span style="font-weight:bold;"><?php echo $cemail; ?></span> <?php } ?></p>
				<?php } ?>
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