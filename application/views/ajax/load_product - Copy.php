<?php  
		$ccode_sec = $_POST['ccode_sec'];
		$nrow_per_page = $_POST['nrow_per_page'];
		$ncurr_page = $_POST['ncurr_page'];
		$sort_price = 0;
		$str_brand = '';
		
		$price_min = 5000;
		$price_max = 2000000;
		if($_POST['price_range']!="") {
			$price_range = $_POST['price_range'];
			$pieces = explode(",", $price_range);
			$price_min = $pieces[0];
			$price_max = $pieces[1];
			//exit($price_min);
		}
		
		$cb_km = [];
		if($_POST['cb_km']!="") {
			$cb_km = json_decode($_POST['cb_km'],true);
		}
		
		if($_POST['cb_brand']!="") { 
			$arr_brand = json_decode($_POST['cb_brand'],true);
			
			if(count($arr_brand)>0) {
				$str_brand = '(';
				$count = count($arr_brand); $i=1;
				foreach($arr_brand as $item){
					$str_brand.=$item;
					if($i<$count)
						$str_brand.=',';
					$i++;
				}
				$str_brand.=')';
			} 
		} 
        $list = get_product_page_by_sec($ccode_sec, $nrow_per_page, $ncurr_page, $sort_price, $cb_km, $str_brand, $price_min, $price_max);
		
   foreach ($list as $product) {
   $obj_color_list = get_product_color($product['nid']);
   if(isset($obj_color_list[0]['nid'])){
   				$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'].'-'.$obj_color_list[0]['nid'];
   				$fprice = $obj_color_list[0]['fprice'];
   				$fprice_sale = $obj_color_list[0]['fprice_sale'];
   			} else {
   				$href=base_url().$product['ccode_sec'].'/'.$product['ccode_cat'].'/'.$product['ccode'];
   				$fprice = $product['fprice'];
   				$fprice_sale = $product['fprice_sale'];
   			}
   			$fprice = $product['fprice'];
   			$fprice_sale = $product['fprice_sale'];
   ?>
<li class="cate-pro-short" data-id="28025">
   <div class="lt-product-group-image">
      <a href="<?php echo $href ?>" rel="nofollow">
      <img id="product_link" class="cpslazy loaded" data-src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" alt="" style="width: 100%;" data-ll-status="loaded" src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>">
      </a>
      <!-- Giảm % -->
   </div>
   <div class="lt-product-group-info">
      <a href="<?php echo $href; ?>">
         <h3 id="product_link" class=""><?php echo $product['cproducts']; ?></h3>
      </a>
      <div class="price-box">
         <?php if ($fprice_sale < $fprice && $product['ncheck'] == 1) { ?>	
         <span class="regular-price">
         <span class="price"><?php echo number_format($fprice_sale); ?> ₫</span>                                                                                                                     
         </span>
         <span class="old-price"><del><?php echo number_format($fprice); ?> ₫</del></span>
         <?php } else { ?>
         <span class="regular-price">
         <span class="price"><?php if($fprice >0) echo number_format($fprice)."đ"; else echo "Liên hệ"; ?></span>
         </span>  
         <?php } ?>
      </div>
      <div class="clear"></div>
   </div>
   <?php if($product['nhethang']== 1) { ?>
   <div class="label-het-hang">
      Hết hàng
   </div>
   <?php } ?>
</li>
<?php } ?>