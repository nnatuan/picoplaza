<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<style>
h1.shop-page-title {
    margin-top: 20px;
}
.shop-container {
    margin-bottom: 30px;
}
</style>
<div class="shop-page-title category-page-title page-title ">
            <div class="page-title-inner flex-row  medium-flex-wrap container">
               <div class="flex-col flex-grow medium-text-center">
					<div class="is-small">
                     <nav class="woocommerce-breadcrumb breadcrumbs uppercase"><a href="<?php echo base_url(); ?>">Trang chủ</a> <span class="divider">/</span> <?php echo $title; ?></nav>
                  </div>
                  <h1 class="shop-page-title is-xlarge"><?php echo $title; ?></h1>
               </div>
            </div>
         </div>
         <main id="main" class="">
            <div class="row category-page-row">
               <div class="large-12">
                  <div class="shop-container">
                     <div class="woocommerce-notices-wrapper"></div>
                     <div class="woof_products_top_panel"></div>
                     <div class="products row row-small large-columns-5 medium-columns-3 small-columns-2 has-equal-box-heights">
                        <?php //$cf = get_config_by_id(8);
						$list = get_product_page_by_sec($ccode_sec, $nrow_per_page, $ncurr_page);
								foreach ($list as $product) { 
									if($product['cimage_resize']!="") {
										$img_url = base_url().'upload/images_product/resize_images/'.$product['cimage_resize'];
										if (!file_exists($img_url)) 
											$img_url = base_url().'upload/images_product/full_images/'.$product['cimage'];
									} else
										$img_url = 'https://placehold.co/300x300';
						?>
						<div class="product-small col has-hover product type-product post-8391 status-publish first instock product_cat-giay-decal product_cat-giay-cac-loai has-post-thumbnail shipping-taxable purchasable product-type-simple">
                           <div class="col-inner">
                              <div class="badge-container absolute left top z-1">
                              </div>
                              <div class="product-small box ">
                                 <div class="box-image">
                                    <div class="image-zoom">
                                       <a href="<?php echo base_url().'san-pham/'.$product['ccode']; ?>" aria-label="">
                                       <img width="247" height="296" src="<?php echo $img_url; ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" decoding="async" fetchpriority="high" />				</a>
                                    </div>
                                    <div class="image-tools is-small top right show-on-hover">
                                    </div>
                                    <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                    </div>
                                    <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                    </div>
                                 </div>
                                 <div class="box-text box-text-products text-center grid-style-2">
                                    <div class="title-wrapper">
                                       
                                       <p class="name product-title woocommerce-loop-product__title"><a href="<?php echo base_url().'san-pham/'.$product['ccode']; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link"><?php echo $product['cproducts']; ?>	</a></p>
                                    </div>
                                    <div class="price-wrapper">
                                       <span class="price"><span class="woocommerce-Price-amount amount"><bdi><?php echo number_format($product['fprice']); ?><span class="woocommerce-Price-currencySymbol">&#8363;</span></bdi></span></span>
                                    </div>
                                    <div class="add-to-cart-button"><a href="<?php echo base_url().'san-pham/'.$product['ccode']; ?>" class="primary is-small mb-0 button product_type_simple add_to_cart_button is-outline">Mua ngay</a></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <?php } ?>
                     </div>
                     <!-- row -->
                  </div>
                  <!-- shop container -->
               </div>
            </div>
         </main>
         

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>js/jquery.twbsPagination.min.js" type="text/javascript"></script>
<script type="text/javascript">
	<?php if($ncurr_page>0){ ?>
            currentPage = <?php echo $ncurr_page;?>;
        <?php }else{ ?>
            currentPage = 1;
        <?php }?>	
    (function($) { 
        $(document).ready(function() {
			window.pagObj = $('#pagination').twbsPagination({
                totalPages: <?php echo $ntotal_page; ?>,
                visiblePages: 5,
                startPage: currentPage,
                initiateStartPageClick:false,
                first:"&laquo;",
                last:"&raquo;",
                prev:"&lsaquo;",
                next:"&rsaquo;",
                onPageClick: function (event, page) {    
                location.href = '<?php echo base_url().'phan-loai/'.$obj_sec['ccode'].'/trang-'; ?>' +page;
                    //console.info(page + ' (from options)');
                }
            });
		});	
    })(jQuery); 
</script>   
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
   ?>