<div class="row-list active hide-add-row" style="background:#fff;color:#438EB9;padding:0;height: 34px;">
						<div class="cell-order" style="padding-top: 8px;">#</div>
						   <div class="cell-action" style="padding-top: 16px;">&nbsp;</div>
						   <div class="row-product" style="margin-top: 7px;padding-left:0;">
							  <div class="cell-name not-units tit-cart">
									Sản phẩm
							  </div>
							  <div class="cell-units tit-cart">
								Đơn vị
							  </div>
							  <div class="cell-quatity tit-cart">
								SL
							  </div>
							  <div class="cell-change-price tit-cart">
								 Đơn giá
							  </div>
							  <div class="cell-units tit-cart">
								&nbsp;
							  </div>
							  <div class="cell-price tit-cart">Thành tiền</div>
							  <div class="cell-action text-center">
							  </div>
						   </div>
						</div>
						
<?php 
							$list = get_order_detail_tmp_by_order($_SESSION['nid_order_tmp']);
							$i = 1; $price=''; $id='';
							foreach($list as $cart){
							   $product = get_product_byid($cart['nid_product']);
							   $id=$product['nid'];
							   if($product['fprice_sale'] != 0 && $product['fprice_sale'] != '')
									$price=$product['fprice_sale'];
								else
									$price=$product['fprice'];
						  
						?>
						
						<div class="row-list  active hide-add-row" ng-class="{'active': (($root.cartItemsOrder &amp;&amp; $last) || (!$root.cartItemsOrder &amp;&amp; $first)), 'row-promotion': item.isGift(), 'hide-order':!($root.cartDisplayOptions.numberOrder), 'hide-code':!($root.cartDisplayOptions.code), 'hide-change-price':!($root.cartDisplayOptions.price), 'hide-price':!($root.cartDisplayOptions.total), 'hide-add-row':!($root.cartDisplayOptions.clone) }" ng-repeat="item in $root.activeCart.Items | filter: vm.filterCartItems track by $index" kv-scroll-cart-items="">
						   <!---->
						   <div class="cell-order" ng-if="$root.cartDisplayOptions.numberOrder"><?php echo $i; ?></div>
						   <!---->
						   <div class="cell-action"><a id="btn-del-<?php echo $id; ?>" onclick="del_cart('<?php echo $cart['nid_product'] ?>','<?php echo $cart['nquantity'] ?>','<?php echo $price; ?>');" class="btn-icon btn-delete" ng-click="vm.removeProduct(item)" title="Xóa hàng hóa" tabindex="4" kv-next-focus="#productSearchInput"><i></i></a></div>
						   <div class="row-product">
							  <div class="cell-name not-units" ng-class="{'not-units':!($root.session.Setting.UseMultiUnit &amp;&amp; item.Unit)}">
								 <h4>
									<?php echo $product['cproducts']?> <!----> <!----> <!---->
								 </h4>
								 <!---->
							  </div>
							  <div class="cell-quatity" ng-class="{error: (vm.itemHasWarning(item))}">
								<button type="button" class="btn-icon down" onclick="decrementValue('<?php echo $cart['nid'] ?>')"><i class="fa fa-angle-down"></i></button>
								<form action="" method="post"><input type="number" min="1" id="number-<?php echo $cart['nid'] ?>" onkeyup="change_qty_cart('<?php echo $cart['nid'] ?>')" pattern="[0-9]{10,11}" required="required" value="<?php echo $cart['nquantity'] ?>" class="form-control in-table ng-pristine ng-untouched ng-valid ng-not-empty" tabindex="8"></form>
								<button type="button" class="btn-icon up" onclick="incrementValue('<?php echo $cart['nid'] ?>')"><i class="fa fa-angle-up"></i></button></div>
							  <!---->
							  <div class="cell-change-price">
								 <!---->
								 <div class="popup-anchor">
									<button class="form-control in-table cart-item-0" id="unit-price-<?php echo $id; ?>"><?php echo Fview_price($price) ?>
									</button> 
								 </div>
								 <!----><!---->
							  </div>
							  
							  <div class="cell-units" style="text-align:right;position:relative;">
								<a href="javascript:void(0);" onclick="show_form_chiet_khau('<?php echo $id; ?>')">Chiết khấu</a>
								<div class="form-chiet-xuat" id="form-chiet-xuat-<?php echo $id; ?>">
									<label>Giảm giá(đ)</label><input type="text" id="cx_cprice_sale_vnd_<?php echo $cart['nid']; ?>" value="<?php echo $cart['cprice_sale_vnd'] ?>" placeholder="Giảm giá(đ)">
									<label>Giảm giá(%)</label><input type="text" id="cx_cprice_sale_per_<?php echo $cart['nid']; ?>" value="<?php echo $cart['cprice_sale_per'] ?>" placeholder="Giảm giá(%)">
									<textarea id="cx_cnote_<?php echo $cart['nid']; ?>" required placeholder="Ghi chú"><?php echo $cart['cnote'] ?></textarea>
									<a href="javascript:void(0);" onclick="update_chiet_khau('<?php echo $cart['nid']; ?>')" class="button btn btn-info" style="padding: 3px 8px;margin-right:5px;">Xác nhận</a>
									<a href="javascript:void(0);" onclick="hide_form_chiet_khau()" class="button btn btn-info" style="padding: 3px 8px;">Đóng</a>
								</div>
							  </div>
							  <!----><!---->
							  <?php $thanh_tien = $price*$cart['nquantity'] - $cart['cprice_sale_vnd'] - (($price*$cart['nquantity'])*($cart['cprice_sale_per']/100)); ?>
							  <div class="cell-price" id="total-<?php echo $id; ?>" ng-if="$root.cartDisplayOptions.total"><?php echo Fview_price($thanh_tien);?></div>
							  <!---->
							  <div class="cell-action text-center">
								 <!---->
							  </div>
						   </div>

						   <!---->
						</div>
						<?php $i++; } ?>