<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   $bar1=0;$bar2=0;$bar3=0;$bar4=0;$bar5=0;$diem=0;
							  $list = get_rating_by_product($obj_detail['nid']);
							  $qty=count($list);
								foreach($list as $data) { 
									$diem += $data['crating'];
									if($data['crating']==1) 
										$bar1 += 1;
									elseif($data['crating']==2) 
										$bar2 += 1;	
									elseif($data['crating']==3) 
										$bar3 += 1;	
									elseif($data['crating']==4) 
										$bar4 += 1;	
									elseif($data['crating']==5) 
										$bar5 += 1;	
								}
   ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript">
function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
	if(value <= 10)
		document.getElementById('number').value = value;
}
function decrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
	if(value != 0)
		document.getElementById('number').value = value;
}
function view_more(id)
{
	jQuery('#btn-showmore-'+id).css("display", "none");
	jQuery('#tab-'+id).css("height", "auto");
	//jQuery('.product-left_blog-content_showmore').css("display", "none");
	//jQuery('.blog-content').css("height", "auto");
}
function select_id_color_lv2(id)
{
    jQuery('#nid_color_lv2').val(id);
	jQuery('.option-b-c').removeClass("selected");
	jQuery('#select-id-'+id).addClass("selected");
}
function add_cart_lv2(){
	nid = jQuery('#nid_color_lv2').val();
	jQuery.post( "<?php echo base_url(); ?>thao-tac/mua-san-pham", { id_pro: nid, qty_pro: 1, iscolor: 2 })
		.done(function( data ) {
			location.href="<?php echo base_url(); ?>gio-hang";
	});	
}	
function select_img(id)
{
	//alert(id);
	/*
	jQuery('#sub-img-'+id).trigger('click');
	jQuery('#div-sub-img-'+id).trigger('click');
	
	var src = jQuery('#sub-img-'+id).attr('data-src');	
		jQuery(".sub-img").removeClass('active');
		jQuery(this).addClass('active');		
		jQuery("#image-main").attr('src',src);*/
		
	//swiper.update();
    //var $invoker = $(e.relatedTarget);
    //swiper.slideTo($invoker.data('slider'));	
	
	//var src = jQuery('#sub-img-'+id).attr('src');
	//alert(src);
	var src = jQuery('#img-src-'+id).val();
	jQuery(".swiper-slide-active").attr('src',src);
}
jQuery( document ).ready(function() {
	jQuery('img.swiper-lazy').on('click', function(e) {
		var src = jQuery(this).attr('src');
		//alert(src);
		jQuery(".swiper-slide-active").attr('src',src);
    });
});

jQuery(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    jQuery('html, body').animate({
        scrollTop: jQuery(jQuery.attr(this, 'href')).offset().top
    }, 500);
});
</script>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style_product.css"/> 
<?php 
   $obj_color_list = get_product_color($obj_detail['nid']);
   $obj_color_detail = get_color_detail($nid_color);
   
	//$fnc_cart = 'add_cart("'.$obj_color_detail['nid']. '","1","'.$niscolor .'")';
   ?>  
<div class="main-container col1-layout">
               <div class="main container container2">
                  <div class="breadcrumbs">
                     <ul>
                        <li class="home">
                           <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a>
                           <i class="fa fa-angle-right"></i>
                        </li>
                        <li class="category4">
                           <a href="<?php echo base_url().'san-pham/'.$sec_pro['ccode']; ?>" title=""><?php echo $sec_pro['cmaterial_products']; ?></a>
                           <i class="fa fa-angle-right"></i>
                        </li>
                        <li class="category138">
                           <a href="<?php echo base_url().'san-pham/'.$sec_pro['ccode'].'/'.$cat_pro['ccode']; ?>" title=""><?php echo $cat_pro['ccat_products']; ?></a>
                           <i class="fa fa-angle-right"></i>
                        </li>
                        <li class="product">
                           <?php echo $title; ?>                                  
                        </li>
                     </ul>
                  </div>
                  <div class="col-main">
                     <script defer>
                        var selectedSimpleProductId = 25206;
                        var productType = "configurable";
                        var productJsonConfig = {"priceFormat":{"pattern":"%s\u00a0\u20ab","precision":2,"requiredPrecision":2,"decimalSymbol":",","groupSymbol":".","groupLength":3,"integerRequired":1},"includeTax":"false","showIncludeTax":false,"showBothPrices":false,"idSuffix":"_clone","oldPlusDisposition":0,"plusDisposition":0,"plusDispositionTax":0,"oldMinusDisposition":0,"minusDisposition":0,"productId":"25205","productPrice":22500000,"productOldPrice":23990000,"priceInclTax":22500000,"priceExclTax":22500000,"skipCalculate":1,"defaultTax":0,"currentTax":0,"tierPrices":[],"tierPricesInclTax":[],"swatchPrices":null};
                        var storeId = 1;
                        window.addEventListener('DOMContentLoaded', function() {
                        var salePrice = 22500000;
                        console.log('productId: 25205');
                        console.log('Stock available: 46');
                        console.log('Default selected product ID: 25206');
                        })
                     </script>
                     <div id="messages_product_view" class="module"></div>
                     <div class="product-view module">
                        <div class="topview hide">
                           <h1><?php echo $title; ?></h1>
						   <?php if($qty>0) { ?>
						   <div class="rate-star"><i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i>
						   <a href="#danhgia">(Có <?php echo $qty; ?> đánh giá)</a>
						   </div>
						   <?php } ?>
                        </div>
                        <div class="product-essential module">
                           <form method="post" >
                              <div class="left w100">
                                 <div class="product-img-box left">
									<?php $list = get_img_by_product($obj_detail['nid']);
									if(count($list)>0) { ?>
                                    <div class="gallery-top swiper-container">
                                       <div class="product-image-gallery swiper-wrapper">
											<?php $i=0;
													foreach ($list as $img) { ?>
											<input type="hidden" id="img-src-<?php echo $img['nid']; ?>" value="<?php echo base_url().'upload/images_product/sub_images/'.$img['cimage']; ?>" />
                                          <img id="image-<?php echo $i; ?>"
                                             class="gallery-image swiper-slide swiper-lazy"
                                             data-src="<?php echo base_url().'upload/images_product/sub_images/'.$img['cimage']; ?>" />
                                          <?php $i++;} ?>
                                       </div>
                                    </div>
                                    <div class="more-views module gallery-thumbs swiper-container">
                                       <div id="product-more-images" class="left swiper-wrapper">
											<?php $i=0;
													foreach ($list as $img) { ?>
                                          <div class="lt-product-more-image item swiper-slide">
                                             <img class="swiper-lazy" id="sub-img-<?php echo $img['nid']; ?>" data-src="<?php echo base_url().'upload/images_product/sub_images/'.$img['cimage']; ?>"/>
                                          </div>
                                          <?php } ?>
                                       </div>
                                       <div class="swiper-button-prev"><i class="fa fa-chevron-left fa-2x"></i></div>
                                       <div class="swiper-button-next"><i class="fa fa-chevron-right fa-2x"></i></div>
                                    </div>
									<?php } else { ?>
									<div class="gallery-top swiper-container">
                                       <div class="product-image-gallery swiper-wrapper">
                                          <img itemprop="image" id="image-main"
                                             class="gallery-image swiper-slide swiper-lazy"
                                             data-src="<?php echo base_url()?>upload/images_product/full_images/<?php echo $obj_detail['cimage']?>" />
                                       </div>
                                    </div>
                                    <div class="more-views module gallery-thumbs swiper-container">
                                       <div id="product-more-images" class="left swiper-wrapper">
											<div class="lt-product-more-image item swiper-slide">
                                             <img class="swiper-lazy" data-src="<?php echo base_url()?>upload/images_product/full_images/<?php echo $obj_detail['cimage']?>" />
                                          </div>
                                       </div>
                                       <div class="swiper-button-prev"><i class="fa fa-chevron-left fa-2x"></i></div>
                                       <div class="swiper-button-next"><i class="fa fa-chevron-right fa-2x"></i></div>
                                    </div>
									<?php } ?>
									
									
                                    <script defer>
                                       window.addEventListener('DOMContentLoaded', function() {
                                           var galleryThumbs = new Swiper('.gallery-thumbs', {
                                               spaceBetween: 10,
                                               slidesPerView: 4,
                                               freeMode: true,
                                               watchSlidesVisibility: true,
                                               watchSlidesProgress: true,
                                               lazy: true,
                                               navigation: {
                                                   nextEl: '.swiper-button-next',
                                                   prevEl: '.swiper-button-prev',
                                               }
                                           });
                                           var galleryTop = new Swiper('.gallery-top', {
                                               spaceBetween: 30,
                                               lazy: true,
                                               thumbs: {
                                                   swiper: galleryThumbs,
                                               }
                                           });
                                       });
                                    </script>
                                    <?php $m = get_module_byid(34); echo $m['cnote'];
									/*
                                    <div class="slogan-product-detail">
										<div>
											<img src="https://cdn-icons-png.freepik.com/256/16993/16993905.png?semt=ais_hybrid">FREESHIP TOÀN QUỐC
										</div>
										<div>
											<img src="https://cdn-icons-png.freepik.com/256/16993/16993905.png?semt=ais_hybrid">GIAO HÀNG 4H
										</div>
										<div>
											<img src="https://cdn-icons-png.freepik.com/256/16993/16993905.png?semt=ais_hybrid">BẠN MỚI NHẬN MÃ 10%
										</div>
                                    </div>
									*/
									 ?>
                                 </div>
                                 <div class="product-shop right">
										<div class="div-detail-1 hide">
												<?php if($obj_detail['cfreeship'] == 1) { ?>
													<img src="<?php echo base_url(); ?>images/freeship.png" class="icon_nowfree">
												<?php } ?>
												<a href="#" class="brand-label"><?php $brand = get_brand_product_by_id($obj_detail['nid_brand_products']); ?><?php if(isset($brand['nid'])) echo $brand['cbrand_products']; else echo "Apupi Cosmetics"; ?></a>
											</div>
											<h1><?php echo $title; ?></h1>
										<div class="div-detail-2">
												<div class="rate-star"><i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i> <i class="fa fa-star checked"></i>
											   <a href="#danhgia"><?php echo $qty; ?> đánh giá</a> | Mã sản phẩm: <?php if($obj_detail['ccode_product']!="") echo $obj_detail['ccode_product']; else echo "<em>Updating...</em>"; ?>
											   </div>
											</div>
										<div class="">
										   <div class="linked">
											<?php foreach($obj_color_list as $color){?>
											  <a class="item i-25205  <?php if($color['nid'] == $nid_color) echo 'active'; ?>" href="<?php echo base_url().$sec_pro['ccode'].'/'.$cat_pro['ccode'].'/'.$obj_detail['ccode'].'-'.$color['nid']; ?>">
											  <span><i class="iconmobile-opt"></i><?php echo $color['cname']?> <?php if($color['nid'] == $nid_color) echo '<span class="fa fa-check"></span>'; ?></span>
											  <strong><?php if ($color['fprice_sale'] < $color['fprice'] && ($obj_detail['ncheck'] == 1 || $obj_detail['cflash'] == 1)) echo number_format($color['fprice_sale']).'&nbsp;&nbsp;<del style="color: #716b6b;">'.number_format($color['fprice']).'</del>'; else echo number_format($color['fprice']); ?></strong>
											  </a>
											  <?php }?>
										   </div>
										</div>
										
									
                                    <div class="cb">
                                       <!-- Promotion Pack -->
                                       <aside class="promotion_wrapper">
                                          <b id="promotion_header"><i class="fa fa-gift" aria-hidden="true"></i> Chương Trình Ưu Đãi</b>
                                          <div class="khuyenmai-info">
                                             <!-- CTKM chung -->
                                             <div class="kmChung">
                                             </div>
                                             <!--<hr style="margin-top: 5px;margin-bottom: 5px;">-->
                                             <!-- CTKM riêng -->
                                             <div id="lt-promotion-pack" class="">
												<?php $m = get_module_byid(13); echo $m['cnote']; ?>
                                             </div>
                                          </div>
                                       </aside>

                                    </div>
                                    <!-- Sản phẩm được mua Online -->
                                    <?php if($obj_detail['nhethang']=='1') { ?>
									<p class="btn_het_hang">Sản phẩm này tạm hết hàng!</p>
									<?php } else { ?>
									<div class="div-btn-cart">
									<div class="field qty">
									   <div class="control">
										  <button type="button" class="decrease-qty" onclick="decrementValue();"><span>-</span></button> 
										  <input type="number" name="qty" id="number" min="0" max="5" value="1" title="Số lượng" class="input-text qty">
										  <button type="button" class="increase-qty" onclick="incrementValue();"><span>+</span></button>
									   </div>
									</div>
									<a class="btn-cart btn-add-cart" onclick='add_cart_no_redirect("<?php echo $obj_color_detail['nid']; ?>","1","1");'>
                                    Cho Vào Giỏ
									</a>
									<a class="btn-cart btn-buy-cart" onclick='add_cart("<?php echo $obj_color_detail['nid']; ?>","1","1");'>
                                    Mua Ngay
									</a>
									<?php if($obj_detail['clink_shopee_as']!="") { ?>
									<a class="btn-cart btn-shopee-cart"  href="<?php echo $obj_detail['clink_shopee_as']; ?>" target="_blank">
                                    Mua Trên Shopee					
									</a>
									<?php } if($obj_detail['ctiktok']!="") { ?>
									<a class="btn-cart btn-tiktok-cart"  href="<?php echo $obj_detail['ctiktok']; ?>" target="_blank">
                                    Mua Trên Tiktok					
									</a>
									<?php } ?>
									</div>
									<?php } ?>		
                                 </div>
                                 
								 <div class="clear"></div>
                              </div>                             
							  
						   </div>
                              <!-- CrossSell -->
                              <div class="clear"></div>
                           </form>
                        </div>
                        <?php if($obj_detail['cdetail']!="") { ?>
                        <hr />
						<?php } ?>
                        <div class="product-bottom-sec">
                           <div class="left w100">
                              <div class="blog-content">
								 <div id="tabs-container">
									<ul class="tabs-menu">
										<li class="current"><a href="javascript:void(0)" data-href="#tab-1">Giới thiệu</a></li>
										<li><a href="javascript:void(0)" data-href="#tab-2">Công dụng</a></li>
										<li><a href="javascript:void(0)" data-href="#tab-3">Thành phần</a></li>
										<li><a href="javascript:void(0)" data-href="#tab-4">Hướng dẫn sử dụng</a></li>
										<li><a href="javascript:void(0)" data-href="#tab-5">Thông tin thêm</a></li>
									</ul>
									<div class="tab">
										<div id="tab-1" class="tab-content active">
											<?php echo $obj_detail['cgioi_thieu']; ?>
											<?php if($obj_detail['cgioi_thieu']!="") { ?>
											<div id="btn-showmore-1" class="product-left_blog-content_showmore"><a title="Đọc thêm" href="javascript:void(0);" onclick="view_more(1);" class="button_readmore">Đọc thêm <i class="fa fa-angle-down"></i></a></div>
											<?php } ?>
										</div>
										<div id="tab-2" class="tab-content">
											<?php echo $obj_detail['ccong_dung']; ?>
											<?php if($obj_detail['ccong_dung']!="") { ?>
											<div id="btn-showmore-2" class="product-left_blog-content_showmore"><a title="Đọc thêm" href="javascript:void(0);" onclick="view_more(2);" class="button_readmore">Đọc thêm <i class="fa fa-angle-down"></i></a></div>
											<?php } ?>
										</div>
										<div id="tab-3" class="tab-content">
											<?php echo $obj_detail['cthanh_phan']; ?>
											<?php if($obj_detail['cthanh_phan']!="") { ?>
											<div id="btn-showmore-3" class="product-left_blog-content_showmore"><a title="Đọc thêm" href="javascript:void(0);" onclick="view_more(3);" class="button_readmore">Đọc thêm <i class="fa fa-angle-down"></i></a></div>
											<?php } ?>
										</div>
										<div id="tab-4" class="tab-content">
											<?php echo $obj_detail['chdsd']; ?>
											<?php if($obj_detail['chdsd']!="") { ?>
											<div id="btn-showmore-4" class="product-left_blog-content_showmore"><a title="Đọc thêm" href="javascript:void(0);" onclick="view_more(4);" class="button_readmore">Đọc thêm <i class="fa fa-angle-down"></i></a></div>
											<?php } ?>
										</div>
										<div id="tab-5" class="tab-content">
											<?php echo $obj_detail['cthong_tin_them']; ?>
											<?php if($obj_detail['cthong_tin_them']!="") { ?>
											<div id="btn-showmore-5" class="product-left_blog-content_showmore"><a title="Đọc thêm" href="javascript:void(0);" onclick="view_more(5);" class="button_readmore">Đọc thêm <i class="fa fa-angle-down"></i></a></div>
											<?php } ?>
										</div>
									</div>
                              </div>
							</div>
                              <!-- Youtube -->
                              <div class="product-bottom-info">
                                 <!-- SHOW CÁC SUGGEST PRODUCT -->

                                 <div class="el-product-group">
                                    <div class="lt-product-group">
                                       <div class="products-container">
                                          <div class="title_box">
                                             <h2 class="my-2 title" style="padding-left: 15px; padding-top: 15px;">Sản phẩm liên quan</h2>
                                          </div>
                                          <div class="clear"></div>
                                          <ul class="cols cols-5" id="product_slide">
											<?php  
											$list_product = get_product_relate($obj_detail['nid'],$obj_detail['nid_cat_products']);
											foreach ($list_product as $product) {
																	$obj_color_list = get_product_color($product['nid']);
																	if(isset($obj_color_list[0]['nid'])) {
																		$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'].'-'.$obj_color_list[0]['nid'];
																		$fprice = $obj_color_list[0]['fprice'];
																		$fprice_sale = $obj_color_list[0]['fprice_sale'];
																	} else {
																		$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'];
																		$fprice = $product['fprice'];
																		$fprice_sale = $product['fprice_sale'];
																	}
											?>
                                             <li class="product">
                                                <a href="<?php echo $href; ?>">
                                                   <div class="lt-product-group-image">
                                                      <img src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" />
                                                   </div>
                                                   <div class="lt-product-group-info">
                                                      <h3><?php echo $product['cproducts']; ?></h3>
                                                      <div class="price-box product__box-price">
                                                        <?php if ($fprice_sale < $fprice && ($product['ncheck'] == 1 || $product['cflash'] == 1)) { ?>
														 <p class="special-price">
															<?php echo number_format($fprice_sale); ?> ₫                                                                                                                            
														 </p>
														 <p class="old-price"><?php if($fprice>0) echo number_format($fprice).' ₫'; else echo "Liên hệ"; ?></p>
														 <?php } else { ?>
														  <p class="special-price">
															<?php if($fprice>0) echo number_format($fprice).' ₫'; else echo "Liên hệ"; ?>                                                                                                                           
														 </p>
														<?php } ?>
                                                      </div>
                                                      
													  
                                                <div class="clear"></div>
                                                </div>
                                                </a>
                                             </li>
											<?php } ?>
                                          </ul>
                                          <div class="clear"></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              
                             <section class="listReviews listReviews-25864" id="danhgia">
								<h3 class="h3-danhgia"><?php echo $qty; ?> Đánh giá <?php echo $title; ?> <span></span></h3>

								<div class="row reviews_detail">
									<div class="diem col-md-4">
										<h3>SAO TRUNG BÌNH</h3>
										<p class="averageRatings"><?php if($qty!=0) echo round($diem/$qty, 1); ?> <i class="fa fa-star checked"></i>
										</p>
									</div>
									<div class="thongke col-md-8">
										<div>
											<div class="side">
												<div>5 <i class="fa fa-star checked"></i></div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div class="bar bar-5" style="width:<?php if($qty!=0) echo $bar5/$qty*100; ?>%"></div>
												</div>
											</div>
											<div class="side text-right">
												<div><?php echo $bar5; ?> đánh giá</div>
											</div>
										</div>
										<div>
											<div class="side">
												<div>4 <i class="fa fa-star checked"></i></div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div class="bar bar-4" style="width:<?php if($qty!=0) echo $bar4/$qty*100; ?>%"></div>
												</div>
											</div>
											<div class="side text-right">
												<div><?php echo $bar4; ?> đánh giá</div>
											</div>
										</div>
										<div>
											<div class="side">
												<div>3 <i class="fa fa-star checked"></i></div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div class="bar bar-3" style="width:<?php if($qty!=0) echo $bar3/$qty*100; ?>%"></div>
												</div>
											</div>
											<div class="side text-right">
												<div><?php echo $bar3; ?> đánh giá</div>
											</div>
										</div>
										<div>
											<div class="side">
												<div>2 <i class="fa fa-star checked"></i></div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div class="bar bar-2" style="width:<?php if($qty!=0) echo $bar2/$qty*100; ?>%"></div>
												</div>
											</div>
											<div class="side text-right">
												<div><?php echo $bar2; ?> đánh giá</div>
											</div>
										</div>
										<div>
											<div class="side">
												<div>1 <i class="fa fa-star checked"></i></div>
											</div>
											<div class="middle">
												<div class="bar-container">
													<div class="bar bar-1" style="width:<?php if($qty!=0) echo $bar1/$qty*100; ?>%"></div>
												</div>
											</div>
											<div class="side text-right">
												<div><?php echo $bar1; ?> đánh giá</div>
											</div>
										</div>
									</div>
									<div class="danhgia col-md-3 hide">
										<button class="btn btn-danger guiDanhGia">Gửi đánh giá của bạn</button>
									</div>

									<div class="formReview col-md-12">
										<form id="formReview" method="post" enctype="multipart/form-data">
											<div class="stars">
												<span><b>Vui lòng chọn đánh giá: </b></span>
												<label class="rate">
													<input type="radio" name="crating" id="star1" value="1">
													<i class="fa fa-star-o star one-star"></i>
												</label>
												<label class="rate">
													<input type="radio" name="crating" id="star2" value="2">
													<i class="fa fa-star-o star two-star"></i>
												</label>
												<label class="rate">
													<input type="radio" name="crating" id="star3" value="3">
													<i class="fa fa-star-o star three-star"></i>
												</label>
												<label class="rate">
													<input type="radio" name="crating" id="star4" value="4">
													<i class="fa fa-star-o star four-star"></i>
												</label>
												<label class="rate">
													<input type="radio" name="crating" id="star5" value="5">
													<i class="fa fa-star-o star five-star"></i>
												</label>
											</div>
											<div class="review">
												<div class="col-md-6">
													<div class="form-group">
														<label for="detail">Đánh giá:</label>
														<textarea class="form-control" rows="5" id="ccontent_rating" name="detail"></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="nickname">Họ và tên:</label>
														<input type="text" class="form-control" id="cname_rating" name="nickname">
													</div>
													<div class="form-group">
														<label for="phone">Số điện thoại:</label>
														<input type="text" class="form-control" id="cphone_rating" name="phone">
													</div>
													<center><button type="button" class="btn btn-danger" onclick="submit_rating('<?php echo $obj_detail['nid']; ?>');">Gửi đánh giá</button></center>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="listReviews">
									<div class="list col-md-12"> 
										<ul class="list-detail">
											<?php $list = get_rating_by_product_limit($obj_detail['nid']);
											foreach($list as $data) { ?>
											<li id="review-8010">
												<div class="reviewer"><span><?php echo $data['cname']; ?></span> | <label class="smemberRv"><i class="fa fa-check-circle" aria-hidden="true"></i> Đã mua tại cửa hàng</label> | Ngày <?php echo date("d/m/Y H:i:s",$data['ctime']); ?> </div>
												<div class="review-content"><p><span>
												<?php for($i=1;$i<6;$i++) { ?>
												<i class="fa fa-star <?php if($i<=$data['crating']) echo 'checked' ?>"></i>
												<?php } ?>  
												</span><i><?php echo $data['ccontent']; ?></i></p>
												</div>
											</li><hr>
											<?php } ?>                        
										</ul>
									</div>
								</div>
							</section>
							<?php $list = get_comment_by_product($obj_detail['nid']); ?>
							<div data-nosnippet="" class="f-left comment_box">
							   <div class="f-left comment_info">
								  <span class="totalcomment" id="total_comment"><b>Hỏi và đáp (<?php echo count($list); ?> Bình luận)</b></span>
							   </div>
							   <div class="f-left form-add">
								  <div class="main_form">
									 <textarea class="form-control" name="detail" id="review_field" cols="5" rows="5" placeholder="Xin mời để lại câu hỏi, chúng tôi sẽ trả lời trong 1h từ 8h - 22h mỗi ngày." onfocus="comment.backToMainCmt()"></textarea>
									 <div class="f-left user_action_wrap">
										<div class="cmt_left">
										   <a href="<?php echo base_url(); ?>quy-dinh-dang-binh-luan" class="poli" target="_blank">Quy định đăng bình luận</a>
										</div>
										<div class="cmt_right">
										   <a class="button" href="javascript:void(0)" id="btnSendCmt" onclick="comment.sendCmt();">Gửi</a>
										</div>
									 </div>
								  </div>
							   </div>
							   <div class="f-left comment_wrap">
								  <ul class="listcomment" data-index="1" data-load="0" data-count="" id="product_comment_list_25864">
									<?php foreach($list as $data) { ?>
									 <li class="f-left cmt_item" id="item_598415">
										<div class="rowuser">
										   <a href="javascript:void(0)">
											  <div><?php echo $data['cname'][0]; ?></div>
											  <strong><?php echo $data['cname']; ?></strong>
										   </a>
										   <a class="icon-cps-pin hide" onclick="pinComment.pinComment(598415)"></a>
										</div>
										<div class="question"><?php echo $data['ccontent']; ?><br></div>
										<div class="actionuser"><a href="javascript:void(0)" class="time"><?php echo date("d/m/Y H:i:s",$data['ctime']); ?></a></div>
										<?php $list2 = get_reply_by_comment($data['nid']); 
										if(count($list2)>0) { ?>
										<div class="reply_list">
										   <?php $i=0;
										   foreach($list2 as $rep) {
										   ?>
										   <div class="cmt_item rep_item" style="<?php if($i>0) echo 'border-top: 1px solid #dfdfdf;'; ?>;">
											  <div class="rowuser">
												 <a href="javascript:void(0)">
													<?php /*<div <?php if($rep['ctype']==1) echo 'class="admin-name"'; ?>><?php echo $rep['cname'][0]; ?></div>*/ ?>
													<div class="div-rep-icon"><img src="<?php echo base_url(); ?>images/logo.png" /></div>
													<strong class="name-ad">Admin<?php //echo $rep['cname']; ?></strong></a>
												 </a>
											  </div>
											  <div class="question"><?php echo $rep['ccontent']; ?></div>
											  
										   </div>
										   <?php $i++;} ?>
										</div>
										<?php } ?>
										<div class="form_reply_wrap" id="form_reply_<?php echo $data['nid']; ?>"></div>
									 </li>
									<?php } ?>
								  </ul>
								  <div class="f-left hide">
									 <a id="cmt_loadmore" href="javascript:void(0)" class="btn btn-default btn-sm" onclick="comment.loadMore()">Xem thêm</a>
								  </div>
							   </div>
							</div>
                           </div>
                           <div class="clear"></div>
						   
                        </div>
                     </div>
                  </div>
               </div>
            </div>
  

<input type="hidden" id="nid_comment" />
<input type="hidden" id="nid_type" />
<input type="hidden" id="cpage" value="1" />
<!-- Modal -->
<div class="modal fade" id="popup_cmt_form" tabindex="-1" role="dialog" aria-labelledby="popup_cmt_form" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header" style="padding:10px;">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title" style="text-align:center;font-size:20px;">THÔNG TIN NGƯỜI GỬI</h4>
		</div>
		<div class="modal-body">
			<div class="">
				<form method="post" id="comment-form" class="popup_cmt_form">
					<input name="form_key" type="hidden" value="uTxqpecQJqmpZnNK" />
					<div class="form-list">
						<div class="input-box">
							<input type="text" name="cname" id="cname" class="input-text required-entry" value="" placeholder="Họ tên (bắt buộc)"/>
						</div>
					</div>
					<div class="form-list">
						<div class="input-box">
							<input type="text" name="cphone" id="cphone" class="input-text" value="" placeholder="Số điện thoại"/>
						</div>
					</div>	
					<button id="cps_comment_post" type="button" title="Gửi bình luận" class="button" onclick="send_cmt('<?php echo $obj_detail['nid']; ?>');"><b>Gửi bình luận</b></button>
				</form>
			</div>
		</div>
	</div>
  </div>
</div>  
<script>
function send_cmt(_id){
	var _nid_comment = jQuery('#nid_comment').val();
	var _nid_type = jQuery('#nid_type').val();
	var _cpage = jQuery('#cpage').val();
	if(_nid_type == 0) 
		var _ccontent = jQuery('#review_field').val();
	else 
		var _ccontent = jQuery('#review_field_'+_nid_comment).val();
	
	//alert(_nid_type);return;
		var _cname = jQuery('#cname').val();
		var _cphone = jQuery('#cphone').val();
		//var _cemail = jQuery('#cemail').val();
		
				if(_cname != '') {
					jQuery.ajax({
						url : "<?php echo base_url(); ?>ajax_actions/send_cmt",
						type : "post",
						dataType:"text",
						data : {
							 nid_product : _id,
							 cname : _cname,
							 cphone : _cphone,
							 ccontent : _ccontent,
							 //cemail : _cemail,
							 nid_comment : _nid_comment,
							 nid_type : _nid_type,
							 cpage : _cpage,
						},
						success : function (result){
							window.location.reload();
						}
					});
				} else 
					alert('Bạn vui lòng nhập họ tên.');
            }
			
function submit_rating(_id){
		var _crating = jQuery("input[name=crating]:checked").val();
		var _cname = jQuery('#cname_rating').val();
		var _cphone = jQuery('#cphone_rating').val();
		var _ccontent = jQuery('#ccontent_rating').val();
		//alert(_crating);
		if(_cname != '' && _cphone != '' && _ccontent != '') {
					jQuery.ajax({
						url : "<?php echo base_url(); ?>ajax_actions/rating",
						type : "post",
						dataType:"text",
						data : {
							 nid_product : _id,
							 crating : _crating,
							 cname : _cname,
							 cphone : _cphone,
							 ccontent : _ccontent
						},
						success : function (result){
							window.location.reload();
						}
					});
				} else 
					alert('Bạn vui lòng nhập đầy đủ thông tin.');
}	

function setCookie(cname,cvalue,exdays) { 
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires=" + d.toGMTString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
window.onload = function() {
	jQuery('#cname').val(getCookie("cname"));
	jQuery('#cphone').val(getCookie("cphone"));
};			
</script>
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>
