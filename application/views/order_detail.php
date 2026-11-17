<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   $order = get_order_by_id($_SESSION['nid_order_check']);
   $status = get_order_status_by_id($order['nid_order_status']);
   if($order['ctime_giao_hang']!="") {
		$time_giao_hang = strtotime(str_replace('/', '-', $order['ctime_giao_hang']));
   } else
		$time_giao_hang = $order['ctime'] + 172800; //tg đặt hàng cộng 2 ngày

	$time_remain = $time_giao_hang-time();
	$time_total = $time_giao_hang-$order['ctime'];

	$time_remain_1 = $time_total;
	$time_remain_2 = $time_total*0.75;
	$time_remain_3 = $time_total*0.5;
	$time_remain_4 = $time_total*0.25;
	
	//exit($time_total-$time_remain.'');
	//exit($time1.'-'.$time2.'-'.$time3.'-'.$time4.'-'.$time_remain);
	//exit($tien_trinh.'-'.$time_giao_hang.'-'.time());
	//$active_step = "active_step_1";
	if($time_remain>=$time_remain_2 && $time_remain<$time_remain_1)
		$active_step = "active_step_1";
	elseif($time_remain>=$time_remain_3 && $time_remain<$time_remain_2)
		$active_step = "active_step_2";
	elseif($time_remain>=$time_remain_4 && $time_remain<$time_remain_3)
		$active_step = "active_step_3";	
	else
		$active_step = "active_step_4";
		
	/*
	$tien_trinh = $time_giao_hang/time();
	if($tien_trinh>=1.75 && $tien_trinh<2)
		$active_step = "active_step_1";
	elseif($tien_trinh>=1.5 && $tien_trinh<1.75)
		$active_step = "active_step_2";
	elseif($tien_trinh>1 && $tien_trinh<1.5)
		$active_step = "active_step_3";	
	elseif($tien_trinh<=1) 
		$active_step = "active_step_4";
	*/
   ?>  
<style>
.main {
    min-height: auto;
}
#checking_oder_page {
    background: #fff;
	box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
}
#checking_oder_page {
    position: relative;
    width: 100%;
    float: left;
    z-index: 2;
    margin-bottom: 15px;
}
#checking_oder_page:before {
    content: "";
    width: 25%;
    position: absolute;
    height: 100%;
    background: #fbfff3;
    border-right: 1px solid #eee;
    left: 0;
    top: 0;
    z-index: 1;
}
.info_customer_order {
    width: 25%;
    float: left;
    position: relative;
    z-index: 2;
    padding: 20px;
}
.space_bottom_20 {
    margin-bottom: 20px;
}
.space_bottom_10 {
    margin-bottom: 10px;
}
.space_bottom_5 {
    margin-bottom: 5px;
}
.payment-action {
    padding-top: 10px;
}
.main_info_checking_order {
    width: 75%;
    float: right;
    padding: 20px 0 0 0;
}
.block_status_order {
    margin-bottom: 60px;
}
.width_common {
    width: 100%;
    float: left;
}
.shipping_status {
    margin: 0 50px;
}
.shipping_status {
    margin: 0 50px;
}
.main_section, .relative {
    position: relative;
}
#box_chitietdonhang .order_tree, #checking_oder_page .order_tree {
    height: 10px;
    width: 100%;
    border-radius: 12px;
    background: #f2f2f2;
    margin-top: 20px;
    position: relative;
}
#box_chitietdonhang .active_step_4 .order_tree:before, #checking_oder_page .active_step_4 .order_tree:before {
    width: 100%;
}
#box_chitietdonhang .order_tree:before, #checking_oder_page .order_tree:before {
    content: "";
    position: absolute;
    height: 10px;
    border-radius: 12px;
    background: #ef8121;
    left: 0;
    top: 0;
    z-index: 2;
}
#box_chitietdonhang .active_step_4 .order_point_tree, #checking_oder_page .active_step_4 .order_point_tree {
    left: auto;
    right: 0px;
}
#box_chitietdonhang .active_step_3 .order_tree:before, #checking_oder_page .active_step_3 .order_tree:before {
    width: 63.6%;
}
#box_chitietdonhang .active_step_2 .order_tree:before, #checking_oder_page .active_step_2 .order_tree:before {
    width: 33.3%;
}
#box_chitietdonhang .order_tree .order_point_tree, #checking_oder_page .order_tree .order_point_tree {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    background: #ef8121;
    position: absolute;
    left: 0;
    top: 0;
    z-index: 3;
}
.order_point_tree_2 {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    background: #fff;
    position: absolute;
    border: 2px solid #ef8121;
    left: 32%;
    top: 0;
    z-index: 2;
}
.order_point_tree_3 {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    background: #fff;
    position: absolute;
    border: 2px solid #ef8121;
    left: 62%;
    top: 0;
    z-index: 2;
}
.order_point_tree_4 {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    display: inline-block;
    background: #fff;
    position: absolute;
    border: 2px solid #ef8121;
    right: 0;
    top: 0;
    z-index: 2;
}
#box_chitietdonhang .item_tree, #checking_oder_page .item_tree {
    position: absolute;
    left: 0px;
    top: -24px;
    width: 25%;
}
#box_chitietdonhang .item_tree span, #checking_oder_page .item_tree span {
    display: block;
}
#box_chitietdonhang .time_tree, #checking_oder_page .time_tree {
    height: 50px;
}
#box_chitietdonhang .active_step_1 .status_1 .des_tree, #checking_oder_page .active_step_1 .status_1 .des_tree {
    color: #ef8121;
    font-weight: 700;
}
#box_chitietdonhang .active_step_2 .status_2 .des_tree, #checking_oder_page .active_step_2 .status_2 .des_tree {
    color: #ef8121;
    font-weight: 700;
}
#box_chitietdonhang .active_step_3 .status_3 .des_tree, #checking_oder_page .active_step_3 .status_3 .des_tree {
    color: #ef8121;
    font-weight: 700;
}
#box_chitietdonhang .active_step_4 .status_4 .des_tree, #checking_oder_page .active_step_4 .status_4 .des_tree {
    color: #ef8121;
    font-weight: 700;
}
#box_chitietdonhang .status_2, #checking_oder_page .status_2 {
    left: 20.3%;
    text-align: center;
}
#box_chitietdonhang .status_3, #checking_oder_page .status_3 {
    left: 50.66%;
    text-align: center;
}
#box_chitietdonhang .status_4, #checking_oder_page .status_4 {
    right: 5px;
    left: auto;
    text-align: right;
}
.info_detail_order {
    padding: 20px;
    border-top: 1px solid #eee;
}
.width_common {
    width: 100%;
    float: left;
}
#checking_oder_page .item_info_order {
    display: block;
    width: 100%;
}
#checking_oder_page .item_info_order .thumb_sp {
    width: 50px;
    float: left;
    margin-right: 10px;
    border: 1px solid #cecece;
}
.brand_name {
    font-weight: 700;
    font-size: 13px;
    margin-top: 10px;
    margin-bottom: 5px;
}
#checking_oder_page .total_money {
    padding: 20px;
    background: #f7f7f7;
    border-top: 1px solid #efefef;
}
.widt_thanhtoan {
    display: inline-block;
    width: 120px;
    text-align: right;
}
.txt_16 {
    font-size: 16px;
}
.txt_18 {
    font-size: 18px;
}
a.txt_color_2, .txt_color_2 {
    color: #ff6600;
}
.title_sp_info_oder, .title_sp_info_oder b {
    color: #000;
}
</style>
<div class="main container">
	<div class="title_box text-center"><h4 class="title">Kết quả tra cứu đơn hàng</h4></div>
	<div class="width_common main">
	   <div id="checking_oder_page">
		  <div class="info_customer_order">
			 <div class="space_bottom_20">
				<div class="space_bottom_5">
				   <b>Mã đơn hàng:</b> <?php echo $order['ccode']; ?>
				</div>
				<div class="space_bottom_5">
				   <b>Trạng thái:</b> <?php echo $status['corder_status']; ?>
				</div>
				<div class="customer_order_name space_bottom_5"><b>Ngày đặt hàng:</b> <?php echo date("d/m/Y H:i",$order['ctime']); ?></div>
				<div class="space_bottom_5"><b>Hình thức thanh toán:</b></div>
				<div class="customer_order_address">
				   Thanh toán khi nhận hàng                    
				</div>
				<div class="payment-action">
				</div>
			 </div>
			 <div class="space_bottom_10">
				<div class="space_bottom_10"><b>Thông tin khách hàng</b></div>
				<div class="customer_order_name space_bottom_5"></div>
				<b class="space_bottom_5">Họ tên: <?php echo $order['cfullname']; ?></b>
				<div class="customer_order_address">
				   Điện thoại: <?php echo $order['cphone']; ?>                       <br>
				   Địa chỉ: <?php echo $order['caddress']; ?>                   
				</div>
			 </div>
			 
		  </div>
		  <div class="main_info_checking_order">
			 <div class="width_common block_status_order">
				<div class="shipping_status relative <?php echo $active_step; ?> ">
				   <div class="order_tree">
					  <span class="order_point_tree"></span>
					  <span class="order_point_tree_2"></span>
					  <span class="order_point_tree_3"></span>
					  <span class="order_point_tree_4"></span>
				   </div>
				   <div class="item_tree status_1">
					  <!--<span class="time_tree">Ngày </span>-->
					  <span class="time_tree"><?php echo date("d/m/Y H:i",$order['ctime']); ?></span>
					  <span class="des_tree">Đặt hàng thành công</span>
				   </div>
				   <div class="item_tree status_2">
					  <span class="time_tree"></span>
					  <span class="des_tree">Kiểm hàng và đóng gói</span>
				   </div>
				   <div class="item_tree status_3">
					  <span class="time_tree"></span>
					  <span class="des_tree">Chuyển cho shipper</span>
				   </div>
				   <div class="item_tree status_4">
					  <span class="time_tree"><?php echo date("d/m/Y H:i",$time_giao_hang); ?></span>
					  <span class="des_tree">Dự kiến giao hàng</span>
				   </div>
				</div>
			 </div>
			 <div class="info_detail_order width_common">
				<?php $total = 0; $total_sale=0; $total_no_sale=0; $list = get_order_detail_by_order($order['nid']); 
				foreach($list as $cart){
									$price_old='';
									if($cart['niscolor']==1) {
									   $color = get_color_detail($cart['nid_product']);
									   $product = get_product_detail_full($color['nid_product']);
									   //$brand = get_brand_product_by_id($product['nid_brand_products']);
									   if($color['fprice_sale'] < $color['fprice'] && $product['ncheck']==1) {
											$price=$color['fprice_sale'];
											$price_old=$color['fprice'];
											$total_sale = $total_sale+($color['fprice']-$color['fprice_sale'])*$cart['nquantity'];
									   } else 
											$price=$color['fprice'];
										$total_no_sale += $color['fprice']*$cart['nquantity'];
										$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'].'-'.$cart['nid_product'];
								   } else {
									   $product = get_product_detail_full($cart['nid_product']);
									   //$brand = get_brand_product_by_id($product['nid_brand_products']);
									   if($product['fprice_sale'] < $product['fprice'] && $product['ncheck']==1) {
											$price=$product['fprice_sale'];
											$price_old=$product['fprice'];
											$total_sale = $total_sale+($product['fprice']-$product['fprice_sale'])*$cart['nquantity'];
									   } else
											$price=$product['fprice'];	
										$total_no_sale += $product['fprice']*$cart['nquantity'];
										$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'];
								   }
								   $total += $price*$cart['nquantity'];
					?>
				<a href="<?php echo $href; ?>" target="_blank" class="item_info_order width_common space_bottom_10">
				   <span class="thumb_sp">
				   <img src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" class="loading" data-was-processed="true">
				   </span>
				   <div class="title_sp_info_oder">
					  <?php /*<div><b class="brand_name"><span><?php if(isset($brand['nid'])) echo $brand['cbrand_products']; else echo "Apupi Cosmetics"; ?></span></b> - <?php echo $product['ccode_product']; ?></div>*/ ?>
					  <div class="title_sp_order"><?php echo $product['cproducts']; ?>
					  <?php if($cart['niscolor']==1) { ?>
											&nbsp;<span style="color: #04AA6D;margin-top: 5px;display: inline-block;"><i class="fa fa-check" aria-hidden="true"></i> <?php echo $color['cname']; ?></span>
										<?php } ?>	
					  </div>
					  <div><b><?php echo $cart['nquantity']; ?> x <span class="txt_color_2"><span class="price"><?php echo number_format($price); ?>₫ <?php if($price_old!='') echo '&nbsp; <del style="color:#ccc;">'.number_format($price_old).'₫</del>'; ?></span></span></b></div>
				   </div>
				</a>
				<?php } ?>
			 </div>
			 <div class="total_money width_common">
				<div class="width_common space_bottom_10 text-right">
				   Tổng tiền
				   <strong class=" widt_thanhtoan txt_16"><span class="price"><?php echo number_format($total_no_sale);?>₫</span></strong>
				</div>
				<div class="width_common space_bottom_10 text-right">
				   Khuyến mãi
				   <strong class=" widt_thanhtoan txt_16"><span class="price">-<?php echo number_format($total_sale);?>₫</span></strong>
				</div>
				<?php if($order['cgiam_gia']!="") { ?>
				<div class="width_common space_bottom_10 text-right">
				   Giảm giá
				   <strong class=" widt_thanhtoan txt_16"><span class="price">-<?php echo number_format($order['cgiam_gia']);?>₫</span></strong>
				</div>
				<?php } ?>
				<div class="width_common space_bottom_10 text-right">
				   Phí vận chuyển
				   <strong class=" widt_thanhtoan txt_16"><span class="price">0₫</span></strong>
				</div>
				<div class="width_common space_bottom_10 text-right">
				   Tổng thanh toán
				   <strong class=" widt_thanhtoan txt_18 txt_color_2"><span class="price"><?php echo number_format($order['ntotal']);?> ₫</span></strong>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>	
<?php 
   $this->load->view($view_folder.'/modules/mod_footer');
   $this->load->view($view_folder.'/footer');
   ?>