<?php 
$key = $_POST['key']; 
$list = get_product_by_key($nid_user, $key);
$price = '';
foreach ($list as $product) {
			$id=$product['nid'];
			$iscolor=0;
			if($product['fprice_sale'] != 0 && $product['fprice_sale'] != '')
				$price=$product['fprice_sale'];
			else
				$price=$product['fprice'];
			

?>
			   <li onclick="add_product('<?php echo $id; ?>','<?php echo $product['cproducts']; ?>','<?php echo $price; ?>','1');">
				 
				 <div class="search-product-info" ng-if="suggestion.Id">
					<p class="name-item"><?php echo $product['cproducts']; ?> <i class="attribute-label"></i> <i class="unit-label"></i> </p>
					<p><span class="codeValue"><?php echo $product['cbarcode']; ?></span><span translate="" class="price-item"><span>Giá</span></span>: <span class="priceValue"><?php echo number_format($price).' đ'; ?></span> </p>
					
				 </div>
				 <!----> <!----> 
			  </li>
<?php } ?>