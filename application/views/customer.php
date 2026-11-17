<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   ?>   
<div class="main container">
	
   <div class="row">
		<div class="col-md-9">
		<div class="title_box"><h4 class="title">Hình ảnh khách hàng</h4></div>
		<div class="row">
		
								<?php $list=get_customer();
								foreach($list as $data) { ?>
								<div class="col-md-4">
									<div class="box-kh">
									  <a href="<?php echo $data['caddress']; ?>" target="_blank"><img class="img-kh" src="<?php echo base_url().'upload/image_customer/'.$data['cimage']; ?>" /></a>
									  <h3 class="tit-kh text-center"><a href="<?php echo $data['caddress']; ?>" target="_blank"><?php echo $data['cname']; ?></a></h3>
								  </div>
								</div>
								<?php } ?>
							 
							</div>

      </div>	
			<div class="col-md-3">
				<div class="title_box"><h4 class="title">Sản phẩm nổi bật</h4></div>
				<div class="row">
					<?php $i=1;
						$list_product = get_product_hot(6);
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
					<div class="col-md-6">
						<div class="item-pro-spec <?php if($i>4) echo "no-border-bottom"; ?>">
							<a href="<?php echo $href; ?>"><img class="cpslazy loaded" style="width: 100%;object-fit: cover;" data-src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" alt="" title="" data-ll-status="loaded" src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>"></a>
							<h5><?php echo $product['cproducts']; ?></h5>
							<?php if ($fprice_sale < $fprice) { ?>
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
					</div>
					<?php $i++;} ?>
				</div>
			</div>
   </div>
</div>
<?php 
   $this->load->view($view_folder.'/modules/mod_footer');
   $this->load->view($view_folder.'/footer');
   ?>