<?php  
		$ccode_cat = $_POST['ccode_cat'];
		$nrow_per_page = $_POST['nrow_per_page'];
		$ncurr_page = $_POST['ncurr_page'];
		$str_brand = '';
		$sort = $_POST['sort'];
		if($sort=="")
			$sort=1;
		
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
		
		$list = get_product_page_by_cat_ajax($ccode_cat, $nrow_per_page, $ncurr_page, $cb_km, $str_brand, $price_min, $price_max, $sort);
		$count_item = get_count_product_by_cat_ajax($ccode_cat, $cb_km, $str_brand, $price_min, $price_max);
		
		
	$list_product_str = '';
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
   
 
$list_product_str .= '<li class="cate-pro-short" data-id="28025">
   <div class="lt-product-group-image">
      <a href="'.$href.'" rel="nofollow">
      <img id="product_link" class="cpslazy loaded" data-src="'.base_url().'upload/images_product/resize_images/'.$product['cimage_resize'].'" alt="" style="width: 100%;" data-ll-status="loaded" src="'.base_url().'upload/images_product/resize_images/'.$product['cimage_resize'].'"></a>
   </div>
   <div class="lt-product-group-info">
      <a href="'.$href.'">
         <h3 id="product_link" class="">'.$product['cproducts'].'</h3>
      </a>
      <div class="price-box">'; 
         if ($fprice_sale < $fprice && ($product['ncheck'] == 1 || $product['cflash'] == 1)) {
         $list_product_str .= '<span class="regular-price">
         <span class="price">'.number_format($fprice_sale).'₫</span>                                                                                                                     
         </span>
         <span class="old-price"><del>'.number_format($fprice).'₫</del></span>';
         } else {
         $list_product_str .= '<span class="regular-price">
         <span class="price">'; if($fprice >0) $list_product_str .= number_format($fprice).'đ'; else $list_product_str .= 'Liên hệ';
		 $list_product_str .='</span>
         </span>';
         }
      $list_product_str .= '</div>
      <div class="clear"></div>
   </div>';
   if($product['nhethang']== 1) {
   $list_product_str .= '<div class="label-het-hang">
      Hết hàng
   </div>';
   }
$list_product_str .= '</li>';
}

$totalPages = round($count_item/20 + 0.4);
if($totalPages<=0)
	$totalPages=1;
$result = array(
	'list_product_str' => $list_product_str,
	'totalPages' => $totalPages,
	'count_item' => $count_item
);
exit(json_encode($result));

?>