<script src="https://code.jquery.com/jquery-latest.min.js "></script>
<script src="<?php echo base_url(); ?>js/my_scripts.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>sell/main.3f67b9f1.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>sell/my_style.css">
<?php $setting = get_setting_by_user(Fget_userdata('session_nid_user')); 

if($ccode_order!="") {
/*	
	echo '<script type="text/javascript">$( document ).ready(function() {deleteCookie();});</script>';
	$list = get_order_detail_by_order($ccode_order);
	foreach ($list as $data) {
		$product = get_product_byid($data['nid_product']);
		if($product['fprice_sale'] != 0 && $product['fprice_sale'] != '')
			$price=$product['fprice_sale'];
		else
			$price=$product['fprice'];
		echo '<script type="text/javascript">$( document ).ready(function() {
			add_product('.$product["nid"].','.$product["cproducts"].','.$price.','.$data["nquantity"].')
		});</script>';
	}
*/	
?>
<script type="text/javascript">
jQuery(window).on('load', function() {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>ajax_actions/get_order",
				type: 'POST',
				datatype: "json",
				data: { ccode: '<?php echo $ccode_order; ?>' },
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
				},
				success : function (result){
					document.cookie = "product_list=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
					//alert(result);
					order = JSON.parse(result);
					order_detail = order.order_detail;
					//alert(order_detail);
					console.log(order_detail);
					$('#to_name').val(order.to_name);
					$('#to_phone').val(order.to_phone);
					$('#PRODUCT_PRICE').val(order.ntotal);
					$('#PRODUCT_PRICE_view').val(format_vnd(order.ntotal));
					$('#cprice_sale_vnd_view').val(format_vnd(order.giam_gia));
					$('#cprice_sale_vnd').val(order.giam_gia);
					//$('.ntotal').val(format_vnd(order.ntotal));
					//alert(order_detail.length);
					for (var i = 0; i < order_detail.length; i++) {
						//alert(order_detail[i].nid_product+order_detail[i].cproducts+order_detail[i].cprice+order_detail[i].nquantity);
						add_product(order_detail[i].nid_product,order_detail[i].cproducts,order_detail[i].cprice,order_detail[i].nquantity);
					}
					
					//active_change_event("cprice_sale_vnd");
				}
			});
})			
</script>
<?php } else { ?>
<script type="text/javascript">	
window.onload = function() {
	//deleteCookie();
	//alert(getCookie(cname)+'-');cname
	/*
	cname = getCookie("cname");
	cemail = getCookie("cemail");
	cphone = getCookie("cphone");
	caddress = getCookie("caddress");
	cmst = getCookie("cmst");
	cprice_sale = getCookie("cprice_sale");
	cvat = getCookie("cvat");
	cship = getCookie("cship");
	cprice_receive = getCookie("cprice_receive");
	cprice_refund = getCookie("cprice_refund");
	cnote = getCookie("cnote");
	cpayment_method = getCookie("cpayment_method");
	
	if(cname!="")
		$("#cname").val(cname);
	if(cemail!="")
		$("#cemail").val(cemail);
	if(cphone!="")
		$("#cphone").val(cphone);
	if(caddress!="")
		$("#caddress").val(caddress);
	if(cmst!="")
		$("#cmst").val(cmst);
	if(cprice_sale!="") {
		$("#cprice_sale_vnd").val(cprice_sale);
		$("#cprice_sale_vnd_view").val(format_vnd(cprice_sale));
	}
	if(cvat!="") {
		$("#cvat").val(cvat);
		$("#cvat_view").val(format_vnd(cvat));
	}
	if(cship!="") {
		$("#cship").val(cship);
		$("#cship_view").val(format_vnd(cship));
	}
	if(cprice_receive!="") {
		$("#cprice_receive").val(cprice_receive);
		$("#cprice_receive_format").val(format_vnd(cprice_receive));
	}
	if(cprice_refund!="") {
		$("#cprice_refund").val(cprice_refund);
		$("#cprice_refund_format").val(format_vnd(cprice_refund));
	}
	if(cnote!="")
		$("#cnote").val(cnote);
	if(cpayment_method!="")
		$("input[name=cpayment_method][value=" + getCookie("cpayment_method") + "]").prop('checked', true);
	*/
	
	str = '';
	order_list = getCookie("order_list");
	if(order_list!="") {
		order_list = JSON.parse(order_list);
		//alert(order_list);
		for(i=0;i<order_list.length;i++) {
			item = order_list[i];
			_class = "";
			if(item.nactive==1) 
				_class = 'class="active"';
									
			str += '					<li '+ _class+'>';
			//str += '							  <a onclick="active_order('+item.nid+')" '+ _class+'><span skip-disable="">'+item.nid+'</span></a>';
			str += '							  <a onclick="active_order('+item.nid+')" '+ _class+'><span skip-disable="">Đơn hàng '+(i+1)+'</span></a>';
			str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
			str += '						 </li>';
		}
	} else {
		let arr = new Array();
		var newDate = new Date();
		var item = {nid: newDate.getTime(), nactive: 1};
		arr.push(item);
		//alert(arr);
		setCookie("order_list", JSON.stringify(arr), 30);		
		str += '					<li class=active>';
		//str += '							  <a onclick="active_order('+item.nid+')" class="active"><span skip-disable="">'+item.nid+'</span></a>';
		str += '							  <a onclick="active_order('+item.nid+')" class="active"><span skip-disable="">Đơn hàng 1</span></a>';
		str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
		str += '						 </li>';
								
		setCookie("nid_order_active", item.nid, 30);
		
		let arr_cus = new Array(); 
		var item_cus = {nid_order: item.nid, cname: "", cemail: "", cphone: "", caddress: "", cmst: "", cprice_sale: 0, cvat: 0, cship: 0, cprice_receive: 0, cprice_refund: 0, cnote: "", cpayment_method: 0};
		arr_cus.push(item_cus);
		setCookie("customer_list", JSON.stringify(arr_cus), 30);
		//alert(arr_cus.length);
	}
	//setCookie("nid_order_active", 1, 30);
	$("#order_list").html(str);
	//alert((getCookie("customer_list"));
	
	//product_list = JSON.parse((getCookie("product_list")));
	//console.log(getCookie("product_list"));
	//alert(count(product_list));
	
	/*
	product_list = getCookie("product_list");
	if(product_list!="") {
		list = JSON.parse(product_list);
		//console.log(list);
		str = '';
		for($i=0;$i<list.length;$i++) {
			item = "";
			str += item.nid_product;
		}
		alert(str);
	} else 
		console.log(product_list);
	*/
	//console.log(getCookie("customer_list"));
	update_customer_form();
	update_product_form();
};
</script>
<?php } ?>

<style>
.footer {
	display:none;
}
.header {
	margin-top: 0;
    height: 52px;	
	
}
.autocomplete .output-complete ul li .search-product-info p {
	line-height: 14px;
}
.x_panel {
    padding: 10px 10px;
}
#notify {
	position:fixed;
	right:10px;
	bottom:10px;
	padding:10px;
	background:#fff;
	color: green;
	display:none;
}
.col-left {
	float: none;
    width: 100%;
    margin-right: 15px;
    padding-right: 0;
}
.col-right {
    position: sticky;
    width: calc(100% - 250px);
    bottom: 0;
    right: 12px;
    height: auto;
    box-shadow: none;
    border: 0;
    flex: 0 0 376px;
    width: 376px;	
}
.div-scroll {
	height: 200px;
	overflow-y: scroll;
}
.form-group {
    width: 33.333%;
	float: left;
    margin-left: 0;
}
.form-group-col2 {
	width:50%;
}
.form-group-col2 .form-label {
    width: 160px !important;
}
.form-group-col2 .form-output {
    margin-left: 160px !important;
}
.group-address .form-group {
    width: 24%;
}
.wrapper .wrap-content {
    display: flex;
    margin: 80px auto;
    padding: 0 53px;
    max-width: 1619px;
}
.nav-md .container.body .right_col {
    margin-left: 0;
}
.nav-md .container.body .col-md-3.left_col, .main_container .top_nav, footer {
	display:none;
}
.x_panel, .wrapper .wrap-content {
    background: #f5f5f5;
    border: 0;
}
.group-left {background:#fff;margin-bottom:15px;padding:15px;}
.group-left:last-child {margin-bottom:0;}
.group-left-product {min-height:375px;}
.wrapper .wrap-content {
    margin: 60px auto;
}
/*.nav-md .container.body .right_col {min-height:auto !important;}*/
</style>
	<script type="text/javascript">
				 function add_cart_detail(_id){
					 var _quantity = $("#number").val();
					 add_cart(_id, _quantity);
				 }
				 function add_cart(_id,_quantity, _price){
					$.ajax({
						url : "<?php echo base_url(); ?>index.php/ajax_actions/add_cart",
						type : "post",
						dataType:"text",
						data : {
							id_pro: _id, 
							quantity_pro: _quantity
						},
						success : function (result){
							location.href="<?php echo base_url()?>index.php/do_sell";
						}
					}); 
				  }	

				  function del_cart(_id, _quantity, _price){
					$.ajax({
						url : "<?php echo base_url().'index.php/ajax_actions/remove_cart'?>",
						type : "post",
						dataType:"text",
						data : {
							id: _id
						},
						success : function (result){
							//location.href="<?php echo base_url()?>index.php/do_sell";
						},
						complete:function(){
							$.ajax({
								url : "<?php echo base_url(); ?>index.php/data_reload_product",
								type : "post",
								dataType:"text",
								data : {
									 //key : _key
								},
								success : function (result){
									window.location.href = "<?php echo base_url()?>index.php/do_sell";
								}
							});
						}
					}); 
				   }
				   function incrementValue(_id)
					{
						/*
						var value = parseInt(document.getElementById('number-'+id+'-'+_iscolor).value, 10);
						value = isNaN(value) ? 0 : value;
						value++;
						document.getElementById('number-'+id+'-'+_iscolor).value = value;
						$("#total-"+id+'-'+_iscolor).text((price*value).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
						document.getElementById("number-"+id+'-'+_iscolor).setAttribute('onchange','change_quantity_cart('+id+','+_iscolor+','+price+','+value+');');
						document.getElementById("btn-del-"+id+'-'+_iscolor).setAttribute('onclick','del_cart('+id+','+_iscolor+','+value+','+price+');');
						$.post( "<?php echo base_url()?>index.php/ajax_actions/ajax_post_cart", { id_pro: id, quantity_pro: 1, iscolor:_iscolor })
						$("#total-price").val(parseInt($("#total-price-nosale").val())+parseInt(price));
						$("#total-price-nosale").val(parseInt($("#total-price").val()));
						$(".total-price").text($("#total-price").val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
						calculation();
						*/
						$.ajax({
							type: "POST",
							url: "<?php echo base_url()?>index.php/ajax_actions/increment_cart",
							data: { id: _id },
							success: function(msg) {
								location.href = "<?php echo base_url()?>index.php/do_sell";
							}
						});
					}
					function decrementValue(_id)
					{
						/*
						var value = parseInt(document.getElementById('number-'+id+'-'+_iscolor).value, 10);
						value = isNaN(value) ? 0 : value;
						value--;
						if(value != 0) {
							document.getElementById('number-'+id+'-'+_iscolor).value = value;
							$("#total-"+id+'-'+_iscolor).text((price*value).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
							document.getElementById("number-"+id+'-'+_iscolor).setAttribute('onchange','change_quantity_cart('+id+','+_iscolor+','+price+','+value+');');
							document.getElementById("btn-del-"+id+'-'+_iscolor).setAttribute('onclick','del_cart('+id+','+_iscolor+','+value+','+price+');');
							$.post( "<?php echo base_url()?>index.php/ajax_actions/ajax_decrement_cart", { id_pro: id, iscolor:_iscolor})
							$("#total-price").val($("#total-price-nosale").val()-price);
							$("#total-price-nosale").val(parseInt($("#total-price").val()));
							$(".total-price").text($("#total-price").val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
							calculation();
						}*/
						var value = parseInt(document.getElementById('number-'+_id).value, 10);
						value = isNaN(value) ? 0 : value;
						value--;
						if(value != 0) {
							$.ajax({
								type: "POST",
								url: "<?php echo base_url()?>index.php/ajax_actions/decrement_cart",
								data: { id: _id },
								success: function(msg) {
									location.href = "<?php echo base_url()?>index.php/do_sell";
								}
							});
						}
					}
					function change_quantity_cart(_id)
					{
						/*
						var quantity_new = parseInt($("#number-"+id+'-'+_iscolor).val());
						$("#total-"+id+'-'+_iscolor).text((price*quantity_new).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
						document.getElementById("number-"+id+'-'+_iscolor).setAttribute('onchange','change_quantity_cart('+id+','+_iscolor+','+price+','+quantity_new+');');
						$.post("<?php echo base_url()?>index.php/ajax_actions/ajax_change_quantity_cart", { id_pro: id, iscolor:_iscolor, quantity_pro: quantity_new })
						$("#total-price").val($("#total-price-nosale").val()-(price*quantity_old)+(price*quantity_new));
						$("#total-price-nosale").val(parseInt($("#total-price").val()));
						$(".total-price").text($("#total-price").val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
						calculation();
						*/
						var quantity_new = parseInt($("#number-"+_id).val());
						$.post("<?php echo base_url()?>index.php/ajax_actions/change_quantity_cart", {id: _id, quantity_pro: quantity_new })
						.done(function(data) {
							window.location.href = "<?php echo base_url()?>index.php/do_sell";
						});
						
					}
					function showmenu () { 
						$('.menu-bar ul').toggle();
					}
					function logout() {
						$.post("<?php echo base_url().'thao-tac/dang-xuat'?>")
						.done(function(data) {
							window.location.reload();
						});
					}
					function change_color(_id) {
						_id_color = $('#select-color-'+_id).find(":selected").val();
						$.post("<?php echo base_url()?>index.php/ajax_actions/change_color", {id: _id, id_color: _id_color})
						.done(function(data) {
							window.location.href = "<?php echo base_url()?>index.php/do_sell";
						});
					}
function calculation(){
	$('#cprice_receive').val("");
	$('#cprice_receive_format').val("");
	$('#cprice_refund').val("");
	$('#cprice_refund_format').val("");
	$('#cprice_sale_vnd').val(0);
	$('#cprice_sale_vnd_format').val(0);
	$('#cprice_sale_per').val(0);
	//change_price_sale();
}	
function show_form_chiet_khau(id){
	$('.form-chiet-xuat').css({'display': 'none'});
	$('#form-chiet-xuat-'+id).css({'display': 'block'});
}
/*
function show_form_chiet_khau(id,iscolor){
	$('.form-chiet-xuat').css({'display': 'none'});
	$('#form-chiet-xuat-'+id+'-'+iscolor).css({'display': 'block'});
}
*/
function hide_form_chiet_khau(){
	$('.form-chiet-xuat').css({'display': 'none'});
}				
function update_chiet_khau(_id)
	{
		var _cprice_sale_vnd = parseInt($("#cx_cprice_sale_vnd_"+_id).val());
		//var _cprice_sale_per = parseInt($("#cx_cprice_sale_per_"+_id).val());
		var _cprice_sale_per = 0;
		var _cnote = $("#cx_cnote_"+_id).val();
		//alert(_cprice_sale_vnd+'-'+_cprice_sale_per+'-'+_cnote);
		$.post("<?php echo base_url()?>index.php/ajax_actions/update_chiet_khau_cart", { id: _id, cprice_sale_vnd: _cprice_sale_vnd, cprice_sale_per: _cprice_sale_per, cnote: _cnote })
		.done(function(data) {
			window.location.href = "<?php echo base_url()?>index.php/do_sell";
		});
	}	
function update_order_name(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_name'?>",{value: _value});
}
function update_order_email(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_email'?>",{value: _value});
}
function update_order_sdt(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_sdt'?>",{value: _value});
}
function update_order_address(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_address'?>",{value: _value});
}
function update_order_mst(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_mst'?>",{value: _value});
}
function update_order_note(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_note'?>",{value: _value});
}
function update_order_price_receive(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_price_receive'?>",{value: _value});
}
function update_order_cprice_sale(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_cprice_sale'?>",{value: _value});
}
function update_order_vat(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_vat'?>",{value: _value});
}
function update_order_ship(_value) {
	$.post("<?php echo base_url().'index.php/ajax_actions/update_order_ship'?>",{value: _value});
}

function themDonHangTam()
	{
		$.post( "<?php echo base_url()?>index.php/ajax_actions/themDonHangTam")
		.done(function(data) {
			window.location.href = "<?php echo base_url()?>index.php/do_sell";
		});
	}
function xoaDonHangTam(_id)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/ajax_actions/xoaDonHangTam",
			data: { id: _id },
			success: function(msg) {
				location.href = "<?php echo base_url()?>index.php/do_sell";
			}
		});
	}
function kichHoatDonHangTam(_id)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/ajax_actions/kichHoatDonHangTam",
			data: { id: _id },
			success: function(msg) {
				location.href = "<?php echo base_url()?>index.php/do_sell";
			}
		});
	}
</script>
<?php 
	/*
	$total = 0;
	$count = 0;
		
		$list = get_order_detail_tmp_by_order($_SESSION['nid_order_tmp']);
		foreach($list as $cart){
				$product = get_product_byid($cart['nid_product']);
				if($product['fprice_sale'] != 0 && $product['fprice_sale'] != '')
					$price=$product['fprice_sale'];
				else
					$price=$product['fprice'];

			$thanh_tien = $price*$cart['nquantity'] - $cart['cprice_sale_vnd'] - (($price*$cart['nquantity'])*($cart['cprice_sale_per']/100));
			//$total = $total + ($price*$cart['quantity']);
			$total = $total + $thanh_tien;
			$count = $count + $cart['nquantity'];
		} 
*/
?>
<script language="javascript">
            function ajax_search_product(_type){
				if(_type=='1') {
					var _key = $('#key_search').val();
					if(_key != "") {
						$.ajax({
							url : "<?php echo base_url(); ?>index.php/data_search_product",
							type : "post",
							dataType:"text",
							data : {
								 key : _key,
								 type : _type
							},
							success : function (result){
								$('#list-product').html(result);
								$('#box-search-product').show();
							}
						});
					} else {
						$('#box-search-product').hide();
					}
				} else {
					var _key = $('#key_search_barcode').val();
					if(_key != "" && _key.length >= 2) {
						$.ajax({
							url : "<?php echo base_url(); ?>index.php/data_search_product",
							type : "post",
							dataType:"text",
							data : {
								 key : _key,
								 type : _type
							},
							success : function (result){
								$('#list-product').html(result);
								$('#box-search-product').show();
							}
						});
					} else {
						$('#box-search-product').hide();
					}
				}
            }
			
			function ajax_search_customer(){
				var _key = $('#cphone').val();
					if(_key != "") {
						$.ajax({
							url : "<?php echo base_url(); ?>index.php/data_search_customer",
							type : "post",
							dataType:"text",
							data : {
								 key : _key
							},
							success : function (result){
								if(result!='0') {
									$('#list-customer').html(result);
									$('#list-customer').show();
								} else 
									$('#list-customer').hide();
							}
						});
					} else {
						$('#list-customer').hide();
					}	
            }
			function select_customer(id){
					$.ajax({
							url : "<?php echo base_url(); ?>index.php/ajax_actions/get_customer_by_id",
							type : "post",
							dataType:"text",
							data : {
								 nid : id
							},
							success : function (result){
								cus = JSON.parse(result);
								$("#cname").val(cus.cname);
								$("#cphone").val(cus.cphone);
								$("#caddress").val(cus.caddress);
								$("#cmst").val(cus.cmst);
								update_customer_cookie("cname",cus.cname);
								update_customer_cookie("cphone",cus.cphone);
								update_customer_cookie("caddress",cus.caddress);
								update_customer_cookie("cmst",cus.cmst);
								$('#list-customer').hide();
							}
					});
            }
	function change_mode_search(){
		$('#box-search-product').hide();
		$('#key_search').val('');
		$('#key_search_barcode').val('');
		var mode = $('#mode-search').val();
		if(mode == 1) {
			$('#key_search').css('z-index', '1');
			$('#key_search_barcode').css('z-index', '2');
			$('#mode-search').val(0);
		} else {
			$('#key_search').css('z-index', '2');
			$('#key_search_barcode').css('z-index', '1');
			$('#mode-search').val(1);
		}	
	}
	function change_type_customer(){
		if ($("#check_customer_old").prop('checked')==true){ 
			$('.required-input').removeAttr('required');
			$('#check_customer_old').val(1);
			$('#info-customer').css({'display': 'none'});
			$('#info-customer-old').css({'display': 'block'});
		} else {
			$('.required-input').prop('required',true);
			$('#check_customer_old').val(0);
			$('#info-customer').css({'display': 'block'});
			$('#info-customer-old').css({'display': 'none'});
		}
	}
	/*
	function change_price_refund(price_receive){
		//var price_total = parseInt($('#total-price').val());
		var price_total = parseInt($('#total-price').val());
		if(price_receive >= price_total) {
			$('#cprice_refund').val(price_receive - price_total);
			$("#cprice_refund_format").val($('#cprice_refund').val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		} else {
			$('#cprice_refund').val(0);
			$('#cprice_refund_format').val(0);
		}
		update_order_price_receive(price_receive);
	}
	*/
	function change_price_refund_format(){
		var str = $('#cprice_receive_format').val().split(",");
		var result = '';
		for(i=0;i<str.length;i++) {
			result = result + str[i];
		}
		$('#cprice_receive').val(result);
		$("#cprice_receive_format").val($('#cprice_receive').val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$('#cprice_receive').trigger('onchange');
	}
	function change_price_sale(){
		//alert('1');
		//tinh giam gia vnd
		var str = $('#cprice_sale_vnd_format').val().split(",");
		var result1 = '';
		for(i=0;i<str.length;i++) {
			result1 = result1 + str[i];
		}
		var total_price_nosale = $("#total-price-nosale").val();
		if(parseInt(result1) >= parseInt(total_price_nosale)) 
			result1=0;
		
		//tinh giam gia %
		var result2 = $('#cprice_sale_per').val();
		if(parseInt(result2) > 50) {
			result2 = 0;
			$('#cprice_sale_per').val(0);
		} else
			result2 = total_price_nosale*(result2/100);
		
		if(parseInt(result2) >= parseInt(total_price_nosale)) 
			$('#cprice_sale_per').val(0);
		
		$('#cprice_sale_vnd').val(result1);
		$("#cprice_sale_vnd_format").val($('#cprice_sale_vnd').val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$("#total-price").val(total_price_nosale - result1 - result2);
		$(".total-price").text($("#total-price").val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
		
		$('#cprice_receive_format').trigger("keyup");
	}
	
$(document).ready(function() {	
	$("#cprice_receive_format,#cprice_sale_per,#cprice_sale_vnd_format").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();		
        }
    });
});

function format_price(id_input_view){
		var tag_input = $('#'+id_input_view.replace("_view", ""));
		var tag_input_view = $('#'+id_input_view);
		var str = tag_input_view.val().split(",");
		var result = '';
		for(i=0;i<str.length;i++) {
			result = result + str[i];
		}
		tag_input.val(result);
		tag_input_view.val(tag_input.val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
	}
/*	
function tinh_tong(){
				var total = 0;

				//var total_price_nosale = $("#total-price-nosale").val();
				//var cprice_sale_vnd = $("#cprice_sale_vnd").val();
				//var cvat = $('#cvat').val();
				//var cship = $('#cship').val();	
				//total = parseInt(total_price_nosale) + parseInt(cvat) + parseInt(cship) - parseInt(cprice_sale_vnd);

				total = parseInt(total_price_nosale) + parseInt(cvat) - parseInt(cprice_sale_vnd);
				
				$('#total-price').val(total);
				$(".total-price").text($("#total-price").val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " đ");
				//$('#ntotal').trigger('change');
            }	
*/			
function active_change_event(tag){
	$('#'+tag).trigger('change');
}
</script>	
<style>
.header {
	border: 0;
}
.wrapper.invoice .header {
    background-color: #eee;
	border: 0;
	margin-bottom: 20px;
}
.search-wrapper {
    float: none;
	padding: 7px 0 0 10px;
}
.search-wrapper .search-content.active {
    width: 100%;
}
.header .header-tab-wrap .content-tab {
    display: block;
}
.header .header-tab-wrap ul li:not(.add-btn) a {
	background-color: #db4e65;
    height: 36px;
	border-top-left-radius: 3px;
    border-top-right-radius: 3px;	
	padding-top: 5px;
}
.header .header-tab-wrap ul li:not(.add-btn) a.active {
	color: #db4e65;
}
.header .header-tab-wrap ul li .close-tab {
    top: 18px;
}
.header .header-tab-wrap ul li.add-btn a {
    height: 36px;
    padding-top: 12px;	
	border-top-left-radius: 3px;
    border-top-right-radius: 3px;	
}
.header .header-tab-wrap ul li {
	padding-top: 10px;
}
.header .header-tab {
	padding: 0;
	margin: 0 370px 0 555px;
    margin-right: 0;	
}
.search-wrapper .search-content .autocomplete .form-control {
	height:32px;
}
.search-wrapper .form-control {
    box-shadow: none;
}
.sidebar-footer a span {
    color: #5A738E;
}
#list-customer {display:none;position:absolute;top:26px;left:0;background:#fff;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;z-index:9;width: 100%;padding: 5px;}
</style>
<script>
function setCookie(cname,cvalue,exdays) { //exdays: so ngay luu giu cookie
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
function deleteAllCookies() {
    /*
	const cookies = document.cookie.split(";");

    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i];
        const eqPos = cookie.indexOf("=");
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
	*/
	document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
}
function deleteCookie() {
	document.cookie = "order_list=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "product_list=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
	document.cookie = "customer_list=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
function checkCookie() {
  var user=getCookie("username");
  if (user != "") {
    alert("Welcome again " + user);
  } else {
     user = prompt("Please enter your name:","");
     if (user != "" && user != null) {
       setCookie("username", user, 30);
     }
  }
}

function format_vnd(value) {
	return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
}
function add_product(id,_name,_price,_qty) {
	var item = {nid_product: id, name: _name, price: _price, quantity: _qty};
	
	let arr = new Array();
	product_list = getCookie("product_list");
	
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	flag = 1;
	let obj = arr.find((o, i) => {
		if (o.nid_product === id) {
			flag = 0;
		}
	});
	
	if(flag == 1)
		arr.push(item);
	
	setCookie("product_list", JSON.stringify(arr), 30);
	$('#box-search-product').hide();
	update_product_form();
}
function remove_product(id) {
	let arr = new Array();
	product_list = getCookie("product_list");
	
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	
	for(var i = 0; i < arr.length; i++) {
		if(arr[i].nid_product==id) {
			arr.splice(i, 1);
			break;
		}
	}
	setCookie("product_list", JSON.stringify(arr), 30);

	update_product_form();
}
function update_quantity(index, value, type) {
	let arr = new Array();
	product_list = getCookie("product_list");
	
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	/*
	if(type==2) { // nếu nhập giá trị cụ thể
		if(value>0)
			arr[index] = {nid_order: arr[index].nid_order, nid_product: arr[index].nid_product, name: arr[index].name, price: arr[index].price, quantity: value};
		else
			arr[index] = {nid_order: arr[index].nid_order, nid_product: arr[index].nid_product, name: arr[index].name, price: arr[index].price, quantity: arr[index].quantity};
	} else if(type==1) { // tăng 1 đv
		arr[index] = {nid_order: arr[index].nid_order, nid_product: arr[index].nid_product, name: arr[index].name, price: arr[index].price, quantity: arr[index].quantity+1};
	} else if(arr[index].quantity-1>0) { // giảm 1 đv
		arr[index] = {nid_order: arr[index].nid_order, nid_product: arr[index].nid_product, name: arr[index].name, price: arr[index].price, quantity: arr[index].quantity-1};
	}
	*/
	
	if(type==2) { // nếu nhập giá trị cụ thể
		if(value>0)
			arr[index].quantity = value;
	} else if(type==1) { // tăng 1 đv
		arr[index].quantity = arr[index].quantity+1;
	} else if(arr[index].quantity-1>0) { // giảm 1 đv
		arr[index].quantity = arr[index].quantity-1;
	}
	
	setCookie("product_list", JSON.stringify(arr), 30);
	
	update_product_form();
}
function update_price(index, value) {
	let arr = new Array();
	product_list = getCookie("product_list");
	
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	arr[index].price = value;	
	
	setCookie("product_list", JSON.stringify(arr), 30);
	
	update_product_form();
}

function update_product_form() {
	//nid_order = getCookie("nid_order_active");
	/*
	forEach(arr, function(element){
		str += element.nid_product;
	});
	*/
	product_list = getCookie("product_list");
	let arr = new Array();
	if(product_list!="") 
		arr = JSON.parse(product_list);	

	//alert(arr.length);
	ntotal = 0;
	str = '';
	for(i=0;i<arr.length;i++) {
		//str += arr[$i].nid_product;
		//if(arr[i].nid_order == nid_order) {
			ntotal += arr[i].price*arr[i].quantity;
			
			str += '<div class="row-list  active hide-add-row">';
							  
			str += '				   <div class="cell-order">'+ (i+1) +'</div>';
							   
			str += '				   <div class="cell-action"><a onclick="remove_product('+arr[i].nid_product+');" class="btn-icon btn-delete"><i></i></a></div>';
			str += '				   <div class="row-product">';
			str += '					  <div class="cell-name not-units">';
			str += '						 <h4>' +arr[i].name+'</h4></div>';
						  
			str += '					  <div class="cell-quatity">';
			str += '						<button type="button" class="btn-icon down" onclick="update_quantity('+i+',1,0)"><i class="fa fa-angle-down"></i></button>';
									
			str += '								<form action="" method="post"><input type="number" min="1" onkeyup="update_quantity('+i+',this.value,2)" pattern="[0-9]{10,11}" required="required" value="'+arr[i].quantity+'" class="form-control in-table ng-pristine ng-untouched ng-valid ng-not-empty" tabindex="8"></form>';
											
			str += '						<button type="button" class="btn-icon up" onclick="update_quantity('+i+',1,1)"><i class="fa fa-angle-up"></i></button></div>';
								
			str += '					  <div class="cell-change-price">';
									
			str += '						 <div class="popup-anchor">';
			str += '							<input type="text" onblur="update_price('+i+',this.value)" pattern="[0-9]{10,11}" required="required" value="'+arr[i].price+'" class="form-control in-table ng-pristine ng-untouched ng-valid ng-not-empty" tabindex="8">';
								
			str += '						 </div>';
									 
			str += '					  </div>';
								  			  
								  
			str += '					  <div class="cell-price">'+ arr[i].price*arr[i].quantity +'</div>';
								 
			str += '					  <div class="cell-action text-center">';
									
			str += '					  </div>';
														  
			str += '				   </div>';
						  
			str += '				</div>';
		//}
		
	}
	//alert(str);
	
	$("#ntotal_noship").val(ntotal);
	/*
	_cprice_sale_vnd = parseInt($("#cprice_sale_vnd").val());
	_cvat = parseInt($("#cvat").val());
	_cship = parseInt($("#cship").val());
	//ntotal = ntotal - _cprice_sale_vnd + _cvat + _cship;
	//ntotal = ntotal - _cprice_sale_vnd + _cvat;
	//alert(_cprice_sale_vnd +'-'+ _cvat + '-'+_cship);

	if($('[name="payment_type_id"]').val()==1)
		ntotal = ntotal + _cship;
	if(ntotal<0)
		ntotal=0;

	$("#ntotal").val(ntotal);
	$(".ntotal").text(format_vnd(ntotal));
	*/
	
	tinh_tong();
	
	$("#product_list").html(str);
	//alert(str);
	
	$("#cprice_receive_format").trigger('onkeyup');
}
function tinh_tong() {	
	ntotal_noship = parseInt($("#ntotal_noship").val());
	cship = parseInt($("#cship").val());
	cprice_sale_vnd = parseInt($("#cprice_sale_vnd").val());
	
	//if($('[name="payment_type_id"]:checked').val()==2 && $('#PRODUCT_PRICE').val()!='0')
	if($('[name="payment_type_id"]:checked').val()==2)	
		ntotal = ntotal_noship + cship;
	else
		ntotal = ntotal_noship;
	
	ntotal = ntotal - cprice_sale_vnd;
	
	//alert(ntotal);
	if(ntotal<0)
		ntotal=0;

	$("#ntotal").val(ntotal);
	$(".ntotal").text(format_vnd(ntotal));
}
function add_order() {
	//order_list = getCookie("order_list");
	arr = JSON.parse(getCookie("order_list"));	

	let arr_new = new Array();
	count = arr.length;
	//alert(arr.length);
	str = '';
	for(i=0;i<count;i++) {
		var item = {nid: arr[i].nid, nactive: 0};
		//alert(item.nid);
		arr_new.push(item);
					
			str += '					<li>';
			str += '							  <a onclick="active_order('+item.nid+')"><span skip-disable="">Đơn hàng '+(i+1)+'</span></a>';
			str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
			str += '						 </li>';
	}
		
	var newDate = new Date();
	var item = {nid: newDate.getTime(), nactive: 1};	
	arr_new.push(item);
	str += '					<li class="active">';
	str += '							  <a onclick="active_order('+item.nid+')" class="active"><span skip-disable="">Đơn hàng '+(count+1)+'</span></a>';
	str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
	str += '						 </li>';
			
	setCookie("order_list", JSON.stringify(arr_new), 30);
	
	setCookie("nid_order_active", item.nid, 30);
	
	$("#order_list").html(str);	
	
	arr_cus = JSON.parse(getCookie("customer_list"));
	var item_cus = {nid_order: item.nid, cname: "", cemail: "", cphone: "", caddress: "", cmst: "", cprice_sale: 0, cvat: 0, cship: 0, cprice_receive: 0, cprice_refund: 0, cnote: "", cpayment_method: 0};
	arr_cus.push(item_cus);
	setCookie("customer_list", JSON.stringify(arr_cus), 30);
	//alert(JSON.stringify(arr_cus));
	update_customer_form();
	update_product_form();
}	
function remove_order(id) {
	arr = JSON.parse(getCookie("order_list"));	
	count = arr.length;
	
	let arr_new = new Array();
	
	for(i=0;i<count;i++) {
		item = {nid: arr[i].nid, nactive: 0};
		if(item.nid!=id)
			arr_new.push(item);
	}

	str = '';
	last_index = arr_new.length-1;
	arr_new[last_index] = {nid: arr_new[last_index].nid, nactive: 1};
	count = arr_new.length;
	for(i=0;i<count;i++) {
		item = arr_new[i];
		_class = "";
		if(item.nactive==1) 
			_class = 'class="active"';
									
		str += '					<li '+ _class+'>';
		str += '							  <a onclick="active_order('+item.nid+')" '+ _class+'><span skip-disable="">Đơn hàng '+(i+1)+'</span></a>';
		str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
		str += '						 </li>';
	}
	$("#order_list").html(str);	
	
	setCookie("nid_order_active", arr_new[last_index].nid, 30);
	setCookie("order_list", JSON.stringify(arr_new), 30);
	
	//xoa sp theo order
	product_list = getCookie("product_list");
	let arr_new_product = new Array();
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	str = '';
	for(i=0;i<arr.length;i++) {
		item = arr[i];
		if(item.nid_order!=id)
			arr_new_product.push(item);
	}
	setCookie("product_list", JSON.stringify(arr_new_product), 30);
	
	//xóa kh theo order
	customer_list = getCookie("customer_list");
	let arr_new_customer = new Array();
	if(customer_list!="") 
		arr_cus = JSON.parse(customer_list);	
	
	str = '';
	for(i=0;i<arr_cus.length;i++) {
		item = arr_cus[i];
		if(item.nid_order!=id)
			arr_new_customer.push(item);
	}
	setCookie("customer_list", JSON.stringify(arr_new_customer), 30);
	
	update_customer_form();
	update_product_form();
}
function active_order(id) {
	arr = JSON.parse(getCookie("order_list"));	
	count = arr.length;
	
	let arr_new = new Array();
	
	for(i=0;i<count;i++) {
		if(arr[i].nid!=id)
			item = {nid: arr[i].nid, nactive: 0};
		else {
			item = {nid: arr[i].nid, nactive: 1};
			setCookie("nid_order_active", item.nid, 30);
		}
		arr_new.push(item);
	}

	str = '';
	count = arr_new.length;
	for(i=0;i<count;i++) {
		var item = arr_new[i];
		_class = "";
		if(item.nactive==1) 
			_class = 'class="active"';
									
		str += '					<li '+ _class+'>';
		str += '							  <a onclick="active_order('+item.nid+')" '+ _class+'><span skip-disable="">Đơn hàng '+(i+1)+'</span></a>';
		str += '							  <span skip-disable="" onclick="remove_order('+item.nid+');" class="close-tab" title="Đóng"><i class="mask mask-delete"></i></span>';
		str += '						 </li>';
	}
	$("#order_list").html(str);	

	setCookie("order_list", JSON.stringify(arr_new), 30);
	
	update_customer_form();
	update_product_form();
}	
function update_customer_form() {
	nid_order = getCookie("nid_order_active");
	customer_list = getCookie("customer_list");
	//console.log(nid_order);
	//console.log(customer_list);
	if(customer_list!="") 
		arr_cus = JSON.parse(customer_list);	
	//console.log(arr_cus);
	
	/*
	var cus = arr_cus.filter(obj => {
	  return obj.nid_order === nid_order
	});
	*/
	
	var cus = arr_cus.find(o => o.nid_order == nid_order);
	
	//console.log(cus);
	//console.log(cus.cname);
	$("#cname").val(cus.cname);
	//$("#cemail").val(cus.cemail);
	$("#cphone").val(cus.cphone);
	$("#caddress").val(cus.caddress);
	$("#cmst").val(cus.cmst);
	$("#cprice_sale_vnd").val(cus.cprice_sale);
	$("#cprice_sale_vnd_view").val(format_vnd(cus.cprice_sale));
	$("#cvat").val(cus.cvat);
	$("#cvat_view").val(format_vnd(cus.cvat));
	$("#cship").val(cus.cship);
	$("#cship_view").val(format_vnd(cus.cship));
	$("#cprice_receive").val(cus.cprice_receive);
	$("#cprice_receive_format").val(format_vnd(cus.cprice_receive));
	$("#cprice_refund").val(cus.cprice_refund);
	$("#cprice_refund_format").val(format_vnd(cus.cprice_refund));
	$("#cnote").val(cus.cnote);
	$("input[name=cpayment_method][value=" + cus.cpayment_method + "]").prop('checked', true);
}
function update_customer_cookie(field, value) {
	//alert(field+value);
	nid_order = getCookie("nid_order_active");
	customer_list = getCookie("customer_list");
	if(customer_list!="") 
		arr_cus = JSON.parse(customer_list);	
	
	/*
	var cus = arr_cus.filter(obj => {
	  return obj.nid_order === nid_order
	});
	cus.field = value;
	
	var obj = arr_cus.find(obj => {
	  return obj.nid_order == nid_order
	});
	*/
	
	objIndex = arr_cus.findIndex((obj => obj.nid_order == nid_order));

	//console.log("Before update: ", arr_cus[objIndex]);

	//arr_cus[objIndex].field = value; //ko hoạt động
	arr_cus[objIndex][field] = value;
	//alert(arr_cus[objIndex][field]);
	
	//console.log("After update: ", arr_cus[objIndex]);
	setCookie("customer_list", JSON.stringify(arr_cus), 30);
}

function check_count_product_order() {
	//nid_order_active = getCookie("nid_order_active");
	//let arr = [];
	//list = getCookie("product_list");
	//alert(document.cookie.indexOf('product_list='));
	//if (list != null) 	
	if(document.cookie.indexOf('product_list=') == -1) // -1 là ko tồn tại
		return false;
		
	arr = JSON.parse(getCookie("product_list"));
	if(arr.length==0)
		return false;

	return true;
}

function insert_order() {
	//thong tin nguoi nhan
	_ORDER_NUMBER = $("#ORDER_NUMBER").val();
	_to_name = $("#to_name").val();
	_to_phone = $("#to_phone").val();
	_to_address = $("#to_address").val();
	_full_address = _to_address + ', ' + $("#RECEIVER_WARD option:selected").text() + ', ' + $("#RECEIVER_DISTRICT option:selected").text() + ', ' + $("#RECEIVER_PROVINCE option:selected").text();
	/*
	_RECEIVER_WARD = $("#RECEIVER_WARD option:selected").text();
	_RECEIVER_DISTRICT = $("#RECEIVER_DISTRICT option:selected").text();
	_RECEIVER_PROVINCE = $("#RECEIVER_PROVINCE option:selected").text();
	*/
	_RECEIVER_WARD = $("#RECEIVER_WARD").val();
	_RECEIVER_DISTRICT = $("#RECEIVER_DISTRICT").val();
	_RECEIVER_PROVINCE = $("#RECEIVER_PROVINCE").val();
	_MONEY_COLLECTION = $("#MONEY_COLLECTION").val();
	_MONEY_TOTALVAT = $("#MONEY_TOTALVAT").val();
	_weight = $("#weight").val();
	_length = $("#length").val();
	_width = $("#width").val();
	_height = $("#height").val();
	
	_PRODUCT_PRICE = $("#PRODUCT_PRICE").val();
	_ORDER_PAYMENT = $("#ORDER_PAYMENT").val();
	_ORDER_SERVICE = $("#ORDER_SERVICE").val();
	_ORDER_NOTE = $("#ORDER_NOTE").val();
	_ntotal = $("#ntotal").val();
	_cgiam_gia = $("#cprice_sale_vnd").val();
	//_cship = $("#cship").val();
	
	if(_ORDER_NUMBER!="")
		if(_ORDER_NUMBER.length<8) {
			alert("Mã đơn hàng phải chứa ít nhất 8 ký tự.");
			return;
		}

	
	//_cpayment_method = $('input[name="cpayment_method"]:checked').val();

	_nid_order_active = getCookie("nid_order_active");
	_product_list = getCookie("product_list");

	//alert(getCookie("product_list"));
	if(check_count_product_order()==true) {
		if(_to_name!="" && _to_phone!="" && _to_address!="") {
			$.ajax({
				url:  "<?php echo base_url(); ?>index.php/ajax_actions/insert_order_vtp",
				type: "post",
				dataType: "text",
				data: {
					ORDER_NUMBER: _ORDER_NUMBER,
					to_name: _to_name,
					to_phone: _to_phone,
					to_address: _to_address,
					full_address: _full_address,
					RECEIVER_WARD: _RECEIVER_WARD,
					RECEIVER_DISTRICT: _RECEIVER_DISTRICT,
					RECEIVER_PROVINCE: _RECEIVER_PROVINCE,
					MONEY_COLLECTION: _MONEY_COLLECTION,
					MONEY_TOTALVAT: _MONEY_TOTALVAT,
					weight: _weight,
					length: _length,
					width: _width,
					height: _height,
					ORDER_PAYMENT: _ORDER_PAYMENT,
					ORDER_SERVICE: _ORDER_SERVICE,
					ORDER_NOTE: _ORDER_NOTE,
					PRODUCT_PRICE: _PRODUCT_PRICE,
					//payment_type_id: _payment_type_id,
					nid_order_active: _nid_order_active,
					product_list: _product_list,
					ntotal: _ntotal,
					cgiam_gia: _cgiam_gia,
					//cship: _cship,
				},
				success: function(result) {
					//alert(result);
					//console.log(result);
					
					rs = JSON.parse(result);
					console.log(rs);
					if(rs.status==200) {
						alert("Tạo đơn hàng thành công");
						//deleteAllCookies();
						deleteCookie();
						location.reload();
						//location.href="";"<?php echo base_url().'index.php/do_order/f_edit_ghn/'; ?>"+result;
					} else
						alert(rs.status + ' - ' + rs.message);
				}
			});
		} else
			alert("Vui lòng nhập đầy đủ thông tin.");
	} else
		alert("Vui lòng chọn ít nhất 1 sản phẩm.");
	
	//setCookie("order_list", JSON.stringify(arr_new), 30);
	
	//update_product_form();
}
function emty_order() {
	nid_order = getCookie("nid_order_active");

	let arr = new Array();
	product_list = getCookie("product_list");
	
	if(product_list!="") 
		arr = JSON.parse(product_list);	
	
	count = arr.length;

	let arr_new = new Array();
	
	for(i=0;i<count;i++) {
		item = arr[i];
		if(item.nid_order!=nid_order)
			arr_new.push(item);
	}

	setCookie("product_list", JSON.stringify(arr_new), 30);
	
	update_product_form();
}
function emty_customer_info() {
	$("#cname").val("");
	//$("#cemail").val("");
	$("#cphone").val("");
	$("#caddress").val("");
	$("#cmst").val("");
	$("#cprice_sale_vnd").val(0);
	$("#cprice_sale_vnd_view").val(0);
	$("#cvat").val(0);
	$("#cvat_view").val(0);
	$("#cship").val(0);
	$("#cship_view").val(0);
	$("#cprice_receive").val(0);
	$("#cprice_receive_format").val(0);
	$("#ntotal").val(0);
	$("#cnote").val("");
	setCookie('cname',"",30);
	setCookie('cemail',"",30);
	setCookie('cphone',"",30);
	setCookie('caddress',"",30);
	setCookie('cmst',"",30);
	setCookie('cprice_sale',0,30);
	setCookie('cvat',0,30);
	setCookie('cship',0,30);
	setCookie('cprice_receive',0,30);
	setCookie('cnote',"",30);
}	
function search_customer_by_phone(_value)
	{
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/ajax_actions/search_customer_by_phone",
			data: { value: _value },
			success: function(result) {
				//alert(result);
				if(result!='0') {
					//alert(result);
					data = JSON.parse(result);
					$("#cname_old").val(data.cname);
					$("#cemail_old").val(data.cemail);
					$("#caddress_old").val(data.caddress);
					$("#cmst_old").val(data.cma_so_thue);
				}
			}
		});
	}
function change_price_refund(price_receive){
		//var price_total = parseInt($('#total-price').val());
		var price_total = parseInt($('#ntotal').val());
		if(price_receive >= price_total) {
			$('#cprice_refund').val(price_receive - price_total);
			$("#cprice_refund_format").val($('#cprice_refund').val().toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		} else {
			$('#cprice_refund').val(0);
			$('#cprice_refund_format').val(0);
		}
		//update_order_price_receive(price_receive);
	}
	
</script>
<style>
.group-left h3 {font-weight:bold;border-bottom:1px solid #eee;padding-bottom: 10px;}
.h15 {height:15px;}
.form-group-100 {width:100%;}
.form-group-100 .form-label {
    width: 160px !important;
}
.form-group-100 .form-output {
    margin-left: 160px !important;
}
.col-right-content .form-group {
    width: 100%;
}
.col-right-content .form-group .form-label {
    width: 100% !important;
}
.col-right-content .form-group .form-output {
    margin-left: 0 !important;
}
.form-control-custom {
    text-align: left;
	height: auto;
}
.col-right-container .form-group textarea {
    height: 90px;
}
input[type="text"]:disabled {
  background: #F7F7F7;
  padding:10px;
}
.form-group-gui .form-output input {
    height: 30px;
}
.form-group-gui .form-label {
    width: 95px !important;
}
.form-group-gui .form-output {
    margin-left: 95px !important;
}
.wraper-payment-content .payment-component-child > .form-group > .form-label.control-label {
    color: #999;
}
.form-control-custom {
    border-radius: 3px;
}
a {color:#0056b3ad;}
a:hover {color:#0056b3;}
.ajax-loader {
  visibility: hidden;
  background-color: rgba(0,0,0,0.5);
  position: fixed;
  z-index: +100 !important;
  width: 100%;
  height:100%;
  top: 0;
  left: 0;
  text-align: center;
}
.ajax-loader p {
	font-size:20px !important;
	position: absolute;
	top: 45%;
	color: #fff;
	width:100%;
	text-align:center;
    letter-spacing: 3px;	
}
.ajax-loader p .fa {
	font-size:30px !important;
}
</style>
<div id="notify"></div>
<!-- page content -->
<div style="position:fixed;top:0;background:#F7F7F7;width: 100%;box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;z-index: 99;font-size: 16px;font-weight:bold;">
	<div class="container" style="max-width: 1619px;padding: 0 53px;">
		<div class="row">
			<div class="col-md-6" style="padding:13px;">
				<a href="<?php echo base_url(); ?>index.php/do_home"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> QUAY VỀ</a>
			</div>
			<div class="col-md-6">
				<div class="d-flex align-items-center justify-content-end">
					<div>
						<h5 class="mg0" style="color:#ed1c32;text-transform:uppercase;"><strong>TẠO ĐƠN Viettelpost</strong></h5>
					</div>
					<div><img src="<?php echo base_url(); ?>images/vtp.png" style="width:52px;object-fit: contain;margin-left: 10px;" /></div>
				</div>
			</div>
		</div>
	</div>
</div>
			<div class="right_col" role="main">
				<div class="">
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 pd0">
							<div class="x_panel">
								<div class="wrapper invoice">
								 <div class="wrap-content cb">
									<div class="col-left">
										<div class="group-left">
											<h3>Thông tin người gửi</h3>
																						   <div class="row">
																								<div class="col-md-6">
																									<div class="form-group form-group-100 form-group-gui">
																										<label class="form-label control-label">Họ tên <span style="color:red;">(*)</span></label>
																										<div class="form-output">
																										   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="cname_gui" name="cname_gui" value="<?php echo $setting['ccompany']; ?>" placeholder="" autocomplete="off" disabled ></div>
																										</div>
																									</div>
																								</div>
																								<div class="col-md-6">
																									<div class="form-group form-group-100 form-group-gui">
																										<label class="form-label control-label">SĐT <span style="color:red;">(*)</span></label>
																										<div class="form-output">
																										   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="cphone_gui" name="cphone" value="<?php echo $setting['cphone']; ?>" placeholder="" autocomplete="off" disabled ></div>
																										</div>
																									</div>
																								</div>
																								<div class="col-md-6">
																									<div class="form-group form-group-100 form-group-gui">
																										<label class="form-label control-label">Email <span style="color:red;">(*)</span></label>
																										<div class="form-output">
																										   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="cemail_gui" name="cemail_gui" value="<?php echo $setting['cemail']; ?>" placeholder="" autocomplete="off" disabled ></div>
																										</div>
																									</div>
																								</div>
																								<div class="col-md-6">
																									<div class="form-group form-group-100 form-group-gui">
																										<label class="form-label control-label">Địa chỉ <span style="color:red;">(*)</span></label>
																										<div class="form-output">
																										   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="cdia_chi_gui" name="cdia_chi_gui" value="<?php echo $setting['caddress']; ?>" placeholder="" autocomplete="off" disabled ></div>
																										</div>
																									</div>
																								</div>
																						   </div>
										</div>
										<div class="group-left">
											<h3>Thông tin người nhận</h3>
											<div class="form-group">
																						<label class="form-label control-label">Họ tên <span style="color:red;">(*)</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="to_name" name="to_name" value="<?php //echo $order_tmp['cname']; ?>" onkeyup='update_customer_cookie("to_name",this.value);' required></div>
																						</div>
																					 </div>
											<div class="form-group">
																						<label class="form-label control-label">SĐT <span style="color:red;">(*)</span><span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty required-input" id="to_phone" name="to_phone" value="<?php //echo $order_tmp['cphone']; ?>" onkeyup='update_customer_cookie("to_phone",this.value);' placeholder="" autocomplete="off" required></div>
																						</div>
																						<div id="list-customer"></div>
																					 </div>
											<div class="form-group">
																						<label class="form-label control-label">Thành phố <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<select id="RECEIVER_PROVINCE" class="form-control-custom" onchange="load_district(this.value);">
																									<option value=""></option>
																								</select>
																						   </div>
																						</div>
																					 </div>	
																				<div class="form-group">
																						<label class="form-label control-label">Quận/Huyện <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<select id="RECEIVER_DISTRICT" class="form-control-custom" onchange="load_ward(this.value);">
																									<option value=""></option>
																								</select>
																						   </div>
																						</div>
																					 </div>	
																				<div class="form-group">
																						<label class="form-label control-label">Phường/Xã <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<select id="RECEIVER_WARD" class="form-control-custom" onchange="tinh_phi_ship();">
																									<option value=""></option>
																								</select>
																						   </div>
																						</div>
																					 </div>	
																				 <div class="form-group">
																						<label class="form-label control-label">Đường/Số nhà <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="to_address" name="" value=""></div>
																						</div>
																					 </div>		
											<div class="cb"></div>									
										</div>
										
										<div class="group-left group-left-product">
											<h3>Thông tin hàng hóa</h3>
											<div class="row">
											<div class="col-md-5">
												<div class="form-group form-group-100">
																						<label class="form-label control-label">Trọng lượng kiện hàng (g) <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="weight" name="" onblur="tinh_phi_ship();"></div>
																						</div>
																						</div>
																					 </div>	
											<div class="col-md-7">
												<div class="form-group form-group-100">
																						<label class="form-label control-label">Kích thước bưu kiện (cm)<span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<div class="row">
																								<div class="col-md-4">
																								<input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="length" placeholder="Chiều dài" onblur="tinh_phi_ship();">
																								</div>
																								<div class="col-md-4">
																								<input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="width" placeholder="Chiều rộng" onblur="tinh_phi_ship();">
																								</div>
																								<div class="col-md-4">
																								<input type="text" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="height" placeholder="Chiều cao" onblur="tinh_phi_ship();">
																								</div>
																								</div>
																						   </div>
																						</div>
																					 </div>	
																					</div>	
											</div>	
											<div class="group-address cb" style="border-bottom:1px dotted #eee;padding-bottom:15px;">
																					<button type="button" class="btn btn-danger hide" onclick="tinh_phi_ship();" style="background: #ed1c32; color: #fff;display:none">Xem trước phí ship</button>
																					<span id="ship_label_ghn" class="" style="font-size: 14px;color:#ed1c32"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> Phí ship quy đổi ước tính : <span id="total_ghn" style="font-weight: bold;font-size: 18px;">Không xác định</span></span>
																				</div>
											<div class="h15"></div>
											<div class="header">
												<div class="search-wrapper">
													  <div class="search-content active">
														 <div kv-autocomplete="vm.autocomplete" ng-model="vm.productSearchTerm" attr-placeholder="Tìm mặt hàng (F3)" template-id="productItemTempl" attr-inputid="productSearchInput" data="vm.products" on-type="vm.searchTermChanged" attr-inputclass="form-control" on-select="vm.onProductSelected" on-select-empty="vm.onEmptyListSelect" on-select-no-match="vm.onNoMatchCode" no-auto-select="vm.isHideMode" is-scale="vm.search_method == 'search-3'" on-tindex="vm.tabIndex" kv-show-popup="vm.showRelatedProductPopup" is-bar-scanner="vm.isBarScanner" class="ng-pristine ng-untouched ng-valid ng-empty">
															<div class="autocomplete " id="">
															   <i class="fa fa-search" style="z-index:3"></i>
															   <input id="key_search" type="text" onkeyup="ajax_search_product('1')" ng-model="vm.searchParam" placeholder="Nhập tên sản phẩm cần tìm..." autocomplete="off" class="form-control form-control ng-touched ng-dirty ng-empty">
															   <input id="key_search_barcode" type="text" onkeyup="ajax_search_product('0')" ng-model="vm.searchParam" placeholder="Mã barcode" class="form-control form-control ng-touched ng-dirty ng-empty">
															   <div id="box-search-product" class="output-complete ng-hide" ng-show="vm.completing">
																   <ul id="list-product">
																	  
																   </ul>
																</div>
															</div>
														 </div>
													  </div>
												</div>
											 </div>
											 <div id="list-product-cart" class="product-cart-list" ng-init="showEditNote = []">		
												<div class="row-list active hide-add-row" style="background:#fff;color:#db4e65;padding:0;height: 34px;">
												<div class="cell-order" style="padding-top: 8px;">#</div>
												   <div class="cell-action" style="padding-top: 16px;">&nbsp;</div>
												   <div class="row-product" style="margin-top: 7px;padding-left:0;">
													  <div class="cell-name not-units tit-cart">
															Sản phẩm
													  </div>
													  <div class="cell-quatity tit-cart">
														SL
													  </div>
													  <div class="cell-change-price tit-cart">
														 Đơn giá
													  </div>
													  
													  <div class="cell-price tit-cart">Thành tiền</div>
													  <div class="cell-action text-center">
													  </div>
												   </div>
												</div>
												<div id="product_list">
												
												</div>
											 </div>
										</div> 
									</div>
									
									<div class="col-right">
									   <form id="order-form" action="" method="post">
									   
									   <input type="hidden" id="ntotal" name="ntotal" value="" />
									   <input type="hidden" id="ntotal_noship" name="ntotal_noship" value="" />
									   <input type="hidden" id="total-price-nosale" value="" />
									   <input type="hidden" id="cship" name="cship" value="0" />
									   <div class="col-right-content">
										  <div class="col-right-container">
											 <div class="col-right-inside">
												<div class="wraper-payment-content">
													  <div class="wraper-payment ">
														 
														 <div class="kv-tabs">
															   <ul class="mr-bg">
																  <!---->
																  <li><a class="tabBut_0  tabbut_new active">Thông tin bổ sung</a></li>
															  
															   </ul>
															   <div class="">
																  <!---->
																 
																	 <div>
																		<!---->
																	   
																		   <div class="payment-component">
																			  <div class="payment-component-child">
																				<div class="form-group hide">
																						<label class="form-label control-label">Nhập mã đơn hàng tự chọn <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="ORDER_NUMBER" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" value="" placeholder="Có thể để trống" pattern=".{8,}" title="Mã ĐH chứa ít nhất 8 ký tự"></div>
																						</div>
																					 </div>
																				<div class="form-group">
																						<label class="form-label control-label">Giá trị đơn hàng<span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="PRODUCT_PRICE_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" onkeyup="format_price(this.id); active_change_event('PRODUCT_PRICE');" value="0" required placeholder="Trường hợp mất hàng , bể hàng sẽ đền theo giá trị của đơn hàng"></div>
																						   <input type="hidden" id="PRODUCT_PRICE" name="PRODUCT_PRICE" onchange="update_customer_cookie('PRODUCT_PRICE',this.value);update_product_form();" value="0">
																						</div>
																					 </div>
																				<div class="form-group">
																						<label class="form-label control-label">Giảm giá <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="cprice_sale_vnd_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" onkeyup="format_price(this.id); active_change_event('cprice_sale_vnd');" value="0" required></div>
																						   <input type="hidden" id="cprice_sale_vnd" name="cprice_sale_vnd" onchange="update_customer_cookie('cprice_sale',this.value);update_product_form();" value="0">
																						</div>
																					 </div>		 
																				<?php /*
																				<div class="form-group">
																						<label class="form-label control-label">Phí ship <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="cship_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" onkeyup="format_price(this.id); active_change_event('cship');" value="0" required></div>
																						   <input type="hidden" id="cship" name="cship" onchange="update_order_ship(this.value);update_customer_cookie('cship',this.value);update_product_form();" value="0">
																						</div>
																					 </div>	 	 
																				<div class="form-group">
																						<label class="form-label control-label">Khách đưa <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="cprice_receive_format" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" onkeyup="change_price_refund_format();active_change_event('cprice_refund');" value="0" required></div>
																						   <input type="hidden" id="cprice_receive" onchange="change_price_refund(this.value);update_customer_cookie('cprice_receive',this.value);" name="cprice_receive" value="0">
																						</div>
																					 </div>
																				 <div class="form-group">
																						<label class="form-label control-label">Tiền thừa <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="cprice_refund_format" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" value="0" readonly></div>
																							<input type="hidden" id="cprice_refund" name="cprice_refund" value="0" onchange="update_customer_cookie('cprice_refund',this.value);">
																						</div>
																					 </div>	
																					<div class="form-group">
																						<label class="form-label control-label">Giao hàng thất bại thu tiền <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="MONEY_TOTALVAT_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" value="0" onkeyup="format_price(this.id); active_change_event('MONEY_TOTALVAT');"></div>
																							<input type="hidden" id="MONEY_TOTALVAT" name="MONEY_TOTALVAT" value="0" onchange="update_customer_cookie('MONEY_TOTALVAT',this.value);">
																						</div>
																					 </div> 
																					 <div class="form-group">
																					<label class="form-label control-label">Bên thanh toán <span class="badge km ng-hide">Km</span></label>
																					<div style="padding-top:10px;">
																						<div class="time-ship" style="margin-left: 0;">
																							<input name="payment_type_id" id="payment_type_id_1" type="radio" value="1" onchange="update_customer_cookie('payment_type_id',this.value);tinh_tong();" checked="checked" ><label for="payment_type_id_1">Người bán/Người gửi</label>
																						</div>
																						<div class="time-ship">
																							<input name="payment_type_id" id="payment_type_id_2" type="radio" value="2" onchange="update_customer_cookie('payment_type_id',this.value);tinh_tong();"><label for="payment_type_id_2">Người mua/Người nhận</label>
																						</div>
																							
																					</div>
																				 </div>	 
																				*/ ?>
																				<div class="form-group">
																						<label class="form-label control-label">Tiền hàng cần thu hộ (không bao gồm tiền cước) <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="MONEY_COLLECTION_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" value="0" onkeyup="format_price(this.id); active_change_event('MONEY_COLLECTION');"></div>
																							<input type="hidden" id="MONEY_COLLECTION" name="MONEY_COLLECTION" value="0" onchange="update_customer_cookie('MONEY_COLLECTION',this.value);">
																						</div>
																					 </div>	
																				<div class="form-group">
																						<label class="form-label control-label">Phí VAT <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor"><input type="text" id="MONEY_TOTALVAT_view" class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" value="0" onkeyup="format_price(this.id); active_change_event('MONEY_TOTALVAT');"></div>
																							<input type="hidden" id="MONEY_TOTALVAT" name="MONEY_TOTALVAT" value="0" onchange="update_customer_cookie('MONEY_TOTALVAT',this.value);">
																						</div>
																					 </div>	

																				<div class="form-group">
																						<label class="form-label control-label">Loại vận đơn <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<select id="ORDER_PAYMENT" class="form-control-custom">
																									<option value="1">Không thu tiền</option>
																									<option value="2">Thu hộ tiền cước và tiền hàng</option>
																									<option value="3" selected>Thu hộ tiền hàng</option>
																									<option value="4">Thu hộ tiền cước</option>
																								</select>
																						   </div>
																						</div>
																					 </div>	 
																				<div class="form-group">
																						<label class="form-label control-label">Dịch vụ <span class="badge km ng-hide">Km</span></label>
																						<div class="form-output">
																						   <div class="popup-anchor">
																								<select id="ORDER_SERVICE" class="form-control-custom">
																								</select>
																						   </div>
																						</div>
																					 </div>	
																					 
																				<div class="form-group">
																					<label class="form-label control-label" style="width: 80px">Ghi chú <span class="badge km ng-hide">Km</span></label>
																					<div class="form-output">
																						<div class="popup-anchor"><textarea class="form-control-custom ng-valid ng-touched ng-dirty ng-not-empty" id="ORDER_NOTE" name="ORDER_NOTE" onkeyup="update_customer_cookie('ORDER_NOTE',this.value);" placeholder="Ghi chú cho đơn hàng."></textarea></div>
																					</div>		
																				 </div>
																				 
																				
																				<div class="form-group form-group-total" style="right: 0;top: 0;background: #eee;text-align:center;font-size:18px;line-height: 32px;margin: 0;padding: 5px !important;margin: 10px 0;">
																					<strong class="desktop">Tổng tiền hàng: </strong>
																					<span class="text-hightlight ntotal"></span>
																				 </div>
																				<div class="cb"></div>
																				 
																				 
																			  </div>
																		   </div>
																	  
																		<!----><!---->
																	 </div>
															   

															   </div>
															
															</div>
														 
														 <!---->
													  </div>
												</div>
											 </div>

										  </div>
										  <!----><!----><!---->
										  <div ng-if="$root.activeCart.isInvoice()" class="wrap-button no-print-button" style="height:auto;">
											 <!----> <button onclick="insert_order();" type="button" name="btn_submit" value="submit" class="btn btn-danger" ng-click="vm.saveTransaction()" id="saveTransaction" style="width:100%;">Tạo đơn hàng</button>
										  </div>
										  <!---->
									   </div>
									   </form>
									</div>
									</div>
								 </div>							
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->
<div class="ajax-loader">
	<p><i class="fa fa-spinner fa-spin fa-3x"></i><br> <em>loading...</em></p>
</div>			
<script>
    jQuery(window).on('load', function() {
		/*
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_shop_info",
				type: 'GET',
				datatype: "json",
				//contentType: 'application/json; charset=utf-8',
				//crossDomain: true,
				//processData: false,
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					//alert(result);
					rs = JSON.parse(result);
					//console.log(result);
					//alert(rs.code);
					var data = rs.data.shops;
					//console.log(data);
					//alert(data.name);
					jQuery("#cname_gui").val(data[0].name);
					jQuery("#cphone_gui").val(data[0].phone);
					jQuery("#cdia_chi_gui").val(data[0].address);
				}
			});
			*/
			
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_province",
				type: 'GET',
				datatype: "json",
				//contentType: 'application/json; charset=utf-8',
				//crossDomain: true,
				//processData: false,
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					/*
					alert(result);
					alert(result["nid"]); 
					alert(result.nid);
					cus = JSON.parse(result);
					alert(cus.nid);
					*/
					rs = JSON.parse(result);
					//console.log(result);
					//alert(rs.code);
					var list = rs.data;
					//console.log(list);
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.PROVINCE_ID + '">' + item.PROVINCE_NAME + '</option>';
					};
					//jQuery("#nid_province_gui").html(content);
					jQuery("#RECEIVER_PROVINCE").html(content);
					//jQuery("#RECEIVER_PROVINCE").val("202").change();
					//jQuery("#RECEIVER_DISTRICT").val("3695").change();
					//jQuery("#RECEIVER_DISTRICT").trigger("change");
					//load_district(202);
					//load_ward(3695);
				}
			});
			
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_service",
				type: 'GET',
				datatype: "json",
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){			
					rs = JSON.parse(result);
					var list = rs.data;
					//console.log(list);
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.SERVICE_CODE + '">' + item.SERVICE_NAME + '</option>';
					};
					jQuery("#ORDER_SERVICE").html(content);
					jQuery("#ORDER_SERVICE").val("VCN").change();
				}
			});	
	});
	
	
	
	function load_district(value) {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_district",
				type: 'POST',
				datatype: "json",
				data: { nid_province: value },
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.DISTRICT_ID + '">' + item.DISTRICT_NAME + '</option>';
					};
					jQuery("#RECEIVER_DISTRICT").html(content);
				}
			});
	}
	function load_ward(value) {
		jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_ward",
				type: 'POST',
				datatype: "json",
				data: { nid_district: value },
				beforeSend: function(){
					jQuery('.ajax-loader').css("visibility", "visible");
				},
				complete: function(){
					jQuery('.ajax-loader').css("visibility", "hidden");
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.WARDS_ID + '">' + item.WARDS_NAME + '</option>';
					};
					jQuery("#RECEIVER_WARD").html(content);
				}
			});
	}
	
	/*
	$(document).on("change", "#nid_province_gui", function() {
	   jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_district",
				type: 'POST',
				datatype: "json",
				data: { nid_province: this.value },
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
					};
					jQuery("#nid_district_gui").html(content);
				}
			});
	});
	$(document).on("change", "#RECEIVER_PROVINCE", function() {
	   jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_district",
				type: 'POST',
				datatype: "json",
				data: { nid_province: this.value },
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.DistrictID + '">' + item.DistrictName + '</option>';
					};
					jQuery("#RECEIVER_DISTRICT").html(content);
				}
			});
	});
	$(document).on("change", "#nid_district_gui", function() {
	   jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_ward",
				type: 'POST',
				datatype: "json",
				data: { nid_district: this.value },
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';
					};
					jQuery("#ccode_ward_gui").html(content);
				}
			});
	});
	$(document).on("change", "#RECEIVER_DISTRICT", function() {
	   jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/get_ward",
				type: 'POST',
				datatype: "json",
				data: { nid_district: this.value },
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
				},
				success : function (result){	
					rs = JSON.parse(result);
					var list = rs.data;
					var content = '';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.WardCode + '">' + item.WardName + '</option>';
					};
					jQuery("#RECEIVER_WARD").html(content);
				}
			});
	});
	*/
	
	function tinh_phi_ship() {
		_weight = jQuery("#weight").val();
		_length = jQuery("#length").val();
		_width = jQuery("#width").val();
		_height = jQuery("#height").val();
		_RECEIVER_PROVINCE = jQuery("#RECEIVER_PROVINCE").val();
		_RECEIVER_DISTRICT = jQuery("#RECEIVER_DISTRICT").val();
		
		//alert(_weight+'-'+_length+'-'+_width+'-'+_height+'-'+_nid_district_gui+'-'+_RECEIVER_DISTRICT+'-'+_RECEIVER_WARD);
		//if(_weight!="" && _length!="" && _width!="" && _height!="" && _RECEIVER_PROVINCE!="" && _RECEIVER_DISTRICT!="") {
		if(_weight!="" && _RECEIVER_PROVINCE!="" && _RECEIVER_DISTRICT!="") {	
			//alert('1');
			jQuery.ajax({
				url: "<?php echo base_url(); ?>get_json_vtp/tinh_phi_ship",
				type: 'POST',
				datatype: "json",
				data: { 
					weight: _weight, 
					length: _length, 
					width: _width, 
					height: _height,
					RECEIVER_PROVINCE: _RECEIVER_PROVINCE, 
					RECEIVER_DISTRICT: _RECEIVER_DISTRICT, 
				},
				beforeSend: function(){
					//jQuery('#loading-img').show();
				},
				complete: function(){
					//jQuery('#loading-img').hide();
					tinh_tong();
				},
				success : function (result){
					jQuery("#ship_label_ghn").show();
					//alert(result);
					console.log(result);
					rs = JSON.parse(result);
					
					var data = rs.data;
					
					jQuery("#cship").val(data.MONEY_TOTAL_FEE);
					jQuery("#total_ghn").text(format_vnd(data.MONEY_TOTAL_FEE));
				}
			});
		} else 
			jQuery("#total_ghn").text('Không xác định');
			//alert('Thiếu thông tin để tính phí, vui lòng nhập đủ thông tin và thử lại.');
	}
</script>			