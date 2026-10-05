<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
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

<style>
.main {
  width: 680px;
}
.cart h2 {
  font-weight: 700;
  margin-bottom: 15px;
}
.clear {
  clear: both;
}
.cart {
  min-height: 500px;
}
.col-main {
  width: 680px;
  margin: 0 auto;
  margin-top: 20px;
  margin-bottom: 20px;
  padding: 15px;
  box-sizing: content-box; 
    border-radius: 10px;  
	box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}
.left {
  float: left;
}
.right {
  float: right;
}
.form-control {
  border: 1px solid #eee !important;
}
.price-container {
  float: left;
  width: 100%;
}
.info-buy-product input[type="text"] {
    width: 100%;
    box-sizing: border-box;	
}
.price del {
	margin-left: 5px;
    color: #999;
}
.btn_order {
	width: 100%;
    background-color: #f50;
    height: auto;
    color: #fff;
    font-size: 20px;
    padding: 10px;
    border-radius: 5px;
    border: 0;
	box-sizing: border-box;	
	line-height: 26px;
}
strong {
    font-weight: bold;	
}
.price {
    color: #FF6F1C;
}
label {
    margin-bottom: 10px;
    display: block;
	font-weight: normal !important;
}
.form-control {
    margin-bottom: 15px;
}
</style>
<div class="bt-blog-header-content">
            <section data-bb-version="5.4.2" id="bt_bb_section699d6778da45b" class="bt_bb_section bt_bb_color_scheme_7 bt_bb_layout_boxed_1800_limit bt_bb_vertical_align_top bt_bb_background_overlay_alternate_left_gradient bt_bb_top_spacing_large bt_bb_bottom_spacing_large bt_bb_negative_margin_none bt_bb_shape_soft-medium-rounded bt_bb_top_left_shape bt_bb_top_right_shape bt_bb_bottom_left_shape bt_bb_bottom_right_shape" style="; --section-primary-color:var(--light-color); --section-secondary-color:var(--alternate-color);" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_large&quot;,&quot;def&quot;:&quot;large&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_large&quot;,&quot;def&quot;:&quot;large&quot;},&quot;bt_bb_negative_margin_&quot;:{&quot;current_class&quot;:&quot;bt_bb_negative_margin_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
               <div class="bt_bb_background_image_holder_wrapper">
                  <div class="bt_bb_background_image_holder bt_bb_parallax"  data-parallax="0.6" data-parallax-offset="0" data-parallax-zoom-start="1" data-parallax-zoom-end="1" data-parallax-blur-start="0" data-parallax-blur-end="0" data-parallax-opacity-start="1" data-parallax-opacity-end="1" style=" background-image:url('<?php $m = get_module_byid(1); echo base_url().'upload/images_module/'.$m['cimage']; ?>');"></div>
               </div>
               <div class="bt_bb_port">
                  <div class="bt_bb_cell">
                     <div class="bt_bb_cell_inner">
                        <div data-bb-version="5.4.2" class="bt_bb_row bt_bb_row_width_boxed_1200 bt_bb_row_width_boxed "  data-bt-override-class="{&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                           <div class="bt_bb_row_holder" >
                              <div data-bb-version="5.4.2"  class="bt_bb_column col-xxl-6 col-xl-6 col-xs-12 col-sm-12 col-md-12 col-lg-6 bt_bb_vertical_align_middle bt_bb_align_left bt_bb_padding_none bt_bb_animation_fade_in animate" style="; --column-width:6;" data-width="6" data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_left&quot;,&quot;def&quot;:&quot;left&quot;},&quot;bt_bb_padding_&quot;:{&quot;current_class&quot;:&quot;bt_bb_padding_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_fade_in animate&quot;,&quot;def&quot;:&quot;fade_in animate&quot;}}">
                                 <div class="bt_bb_column_content">
                                    <div class="bt_bb_column_content_inner">
                                       <div data-bb-version="5.4.3" class="bt_bb_separator_v2 bt_bb_border_style_none bt_bb_color_scheme_27 bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium bt_bb_border_thickness_1 bt_bb_icon_size_normal bt_bb_text_size_normal bt_bb_separator_v2_without_content" style="; --primary-color:#fff; --secondary-color:#000;" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_medium&quot;,&quot;def&quot;:&quot;medium&quot;},&quot;bt_bb_border_thickness_&quot;:{&quot;current_class&quot;:&quot;bt_bb_border_thickness_1&quot;,&quot;def&quot;:&quot;1&quot;},&quot;bt_bb_icon_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_icon_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_text_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_text_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <div class="bt_bb_separator_v2_inner"><span class="bt_bb_separator_v2_inner_before"></span><span class="bt_bb_separator_v2_inner_content"><span  data-ico-="" class="bt_bb_icon_holder"></span></span><span class="bt_bb_separator_v2_inner_after"></span></div>
                                       </div>
                                       <header data-bb-version="5.4.3" class="bt_bb_headline bt_bb_dash_none bt_bb_size_huge bt_bb_align_inherit" data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_huge&quot;,&quot;def&quot;:&quot;huge&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;def&quot;:&quot;inherit&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <h1 class="bt_bb_headline_tag"><span class="bt_bb_headline_content"><span>Giỏ hàng</span></span></h1>
                                       </header>
                                       <div data-bb-version="5.4.2" class="bt_bb_separator_v2 bt_bb_border_style_none bt_bb_color_scheme_27 bt_bb_top_spacing_none bt_bb_bottom_spacing_medium bt_bb_border_thickness_1 bt_bb_icon_size_normal bt_bb_text_size_normal bt_bb_separator_v2_without_content" style="; --primary-color:#fff; --secondary-color:#000;" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_medium&quot;,&quot;def&quot;:&quot;medium&quot;},&quot;bt_bb_border_thickness_&quot;:{&quot;current_class&quot;:&quot;bt_bb_border_thickness_1&quot;,&quot;def&quot;:&quot;1&quot;},&quot;bt_bb_icon_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_icon_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_text_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_text_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <div class="bt_bb_separator_v2_inner"><span class="bt_bb_separator_v2_inner_before"></span><span class="bt_bb_separator_v2_inner_content"><span  data-ico-="" class="bt_bb_icon_holder"></span></span><span class="bt_bb_separator_v2_inner_after"></span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div data-bb-version="5.4.2"  class="bt_bb_column col-xxl-6 col-xl-6 col-xs-12 col-sm-12 col-md-12 col-lg-6 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_none" style="; --column-width:6;" data-width="6" data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_left&quot;,&quot;def&quot;:&quot;left&quot;},&quot;bt_bb_padding_&quot;:{&quot;current_class&quot;:&quot;bt_bb_padding_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                 <div class="bt_bb_column_content">
                                    <div class="bt_bb_column_content_inner"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- cell_inner -->
                  </div>
                  <!-- cell -->
               </div>
               <!-- port -->
            </section>
         </div>	  

            <main id="primary" class="site-main">
                     <div id="main" class="" role="main">
                  <div class="col-main">
                     <div class="module" style="border-bottom: 1px solid #a1c806;line-height: 30px;">
                        <div class="right" style="color:#a1c806;">
                           <i class="fa fa-shopping-basket" aria-hidden="true"></i> Giỏ hàng của bạn
                        </div>
                        <div class="left">		
                           <a href="<?php echo base_url(); ?>"><i class="fa fa-chevron-left"></i> Tiếp tục mua hàng</a>
                        </div>
                        <div class="clear"></div>
                     </div>
                     <div class="cart">
                           <div class="module">
							<?php 
							$obj_cart = '';
							$total = 0;
							if(isset($_SESSION["cart"]))
							$obj_cart = $_SESSION["cart"];				
							if($obj_cart !=''){
								foreach($obj_cart as $cart){
									$product = get_product_detail($cart['id']);
									$price_old='';
									if($product['fprice_sale'] < $product['fprice'] && $product['ncheck']==1) {
										$price=$product['fprice_sale'];
										$price_old=$product['fprice'];
									} else
										$price=$product['fprice'];
									$total += $price*$cart['qty'];	
							?>
                              <div class="cart-item" style="border-bottom: solid 1px #eee; padding: 15px 0; position: relative;">
                                 <div class="right right-cart" style="width: 515px;">
                                    <h5 class="product-name" style="margin-bottom: 5px;margin-top: 5px; color: #333;">
                                       <?php echo $product['cproducts']?>								   
                                    </h5>
                                    <span class="price">
										<?php echo number_format($price); ?>₫ <?php if($price_old!='') echo '&nbsp; <del style="color:#ccc;">'.number_format($price_old).'₫</del>'; ?>
									</span>		
                                    <div style="margin-top: 20px;">
                                       <div class="right">
                                          <select name="cquantity" id="cquantity_<?php echo $cart['id']?>" style="width: 60px;height: 35px;border: 1px solid #eee;    border-radius: 5px;text-align: center;">
											 <?php for($j=1;$j<6;$j++){?>
											 <option <?php if($cart['qty']==$j){?>selected="selected"<?php }?>><?php echo $j?></option>
											 <?php }?>
										  </select>
                                       </div>
                                       <div class="right" style="line-height: 35px; margin-right: 15px;">
                                          <a href="javascript:del_cart('<?php echo $cart['id'] ?>');">Xóa khỏi giỏ</a> | <a href="javascript:update_cart('<?php echo $cart['id']?>');">Cập nhật</a>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="left left-cart" style="width: 120px;">
                                    <img style="width: 100%;height: 120px;object-fit: cover;border-radius:5px;" src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" alt="" />			
                                 </div>
                                 <div class="clear"></div>
                              </div>
                                <?php } ?>    
                           </div>
                           <div style="padding: 15px; border-bottom: solid 1px #eee;">
                              <div class="price-container" id="grand-total-content">
                                 <div class="left" style="font-size: 14px;">
                                    - Tổng tiền:
                                 </div>
                                 <div class="right">
                                    <strong style="font-size: 14px;" id="el-grand-total"><span class="price"><?php echo number_format($total);?> ₫</span></strong>
                                 </div>
                              </div>
                              <div class="price-container" id="discount-price-content" style="display:none">
                                 <div class="left" style="font-size: 14px;">
                                    - Giảm phiếu mua hàng:
                                 </div>
                                 <div class="right">
                                    <strong><span id ="el-discount-price"></span></strong>
                                 </div>
                              </div>
                              <div class="price-container" id="final-price-content" style="display:none">
                                 <div class="left" style="font-size: 16px;">
                                    <strong>- Cần thanh toán:</strong>
                                 </div>
                                 <div class="right">
                                    <strong><span class="price" id="el-final-price" style="font-size: 17px;"></span></strong>
                                 </div>
                              </div>
                              <input type="hidden" name="grandTotal" id="cart-grandTotal" value="48280000">
                              <div class="clear"></div>
                           </div>
                           
                           <p style="padding: 10px 15px 0 0;text-align: right;color: #d70018;"><i>* Giao hàng tận nơi</i></p>
                        
						<form method="post" action="<?php echo base_url().'gio-hang'?>" >
						<div class="info-buy-product" style="padding: 10px 0;">
						   <div class="module">
							  <h3>Thông tin mua hàng</h3>
							  <!----> 
								<div>
									<label>Họ và tên (bắt buộc)</label>
									<input type="text" name="cname" class="form-control" required>
								</div>
								<div>
									<label>Số điện thoại đặt hàng (bắt buộc)</label> 
									<input type="text" name="cphone" class="form-control" required>
								</div>
								<div>
									<label>Địa chỉ (bắt buộc)</label> 
									<input type="text" name="caddress" class="form-control" required>
								</div>
								<div>
									 <label>Lưu ý</label> 
									 <input type="text" name="cnote" class="form-control">
								</div>
							  </div>
						   </div>

						   <!----> 
						   <div id="payment-selection" class="module">
							  <button type="submit" name="bnt_submit01" value="submit" class="btn btn_order" style="width: 100%;"><strong>ĐẶT HÀNG THANH TOÁN SAU</strong> <br>
							  (Trả tiền tại nhà hoặc tại cửa hàng)
							  </button> 
						   </div>
						</div>
						<input type="hidden" name="ctotal" value="<?php echo $total; ?>" />
                        </form>
                     </div>
					
					<?php }else{?>
					 <p style="text-align:center;padding-top:20px;">Giỏ hàng của bạn chưa có sản phẩm.</p>
					 <?php }?> 														
                  </div>
               </main>

</div>	  
<?php 
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>