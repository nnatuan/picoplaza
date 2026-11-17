<?php 
$key = $_POST['key']; 
$list = get_product_by_key($nid_user, $key);
$price = '';
$base_url = Fstr_replace('admin/', '', base_url());
foreach ($list as $product) {
			$img_url = $base_url.'upload/images_product/resize_images/'.$product['cimage_resize'];
			$obj_color_list = get_product_color($product['nid']);
			if(isset($obj_color_list[0]['nid'])) {
				foreach($obj_color_list as $color) {
					$fprice = $color['fprice'];
					$fprice_sale = $color['fprice_sale'];
					if($fprice_sale < $fprice && $product['ncheck'] == 1)
						$price = $fprice_sale;
					else
						$price = $fprice;
?>
			   <li onclick="add_product('<?php echo $color['nid']; ?>','<?php echo $product['cproducts'].' - (Phân loại: <strong>'.$color['cname'].'</strong>)'; ?>','<?php echo $price; ?>','1','1');">
				 <div class="search-product-info">
					<p class="name-item">
						<img src="<?php echo $img_url; ?>" />
						<?php echo $product['cproducts']; ?> 
						<i class="attribute-label"><?php echo $color['cname']; ?></i> 
						<i class="unit-label"><?php echo number_format($price).'đ'; ?></i>
					</p>
				 </div>
			  </li>
			<?php } } else { 
					$fprice = $product['fprice'];
					$fprice_sale = $product['fprice_sale'];
					if($fprice_sale < $fprice && $product['ncheck'] == 1)
						$price = $fprice_sale;
					else
						$price = $fprice;
			?>
				<li onclick="add_product('<?php echo $product['nid']; ?>','<?php echo $product['cproducts']; ?>','<?php echo $price; ?>','1','0');">
				 <div class="search-product-info">
					<p class="name-item">
						<img src="<?php echo $img_url; ?>" />
						<?php echo $product['cproducts']; ?> 
						<i class="unit-label"><?php echo number_format($price).'đ'; ?></i>
					</p>
				 </div>
			  </li>
		 <?php } ?>		
<?php } ?>