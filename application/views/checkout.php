<?php
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   $member = '';
   if(isset($_SESSION['nid_member']))
	   $member = get_member_by_id($_SESSION['nid_member']);
   
   $total = 0;$giam_gia = 0;
   if(isset($_SESSION['total']))
	   $total = $_SESSION['total'];
   if(isset($_SESSION['nsale']))
	   $giam_gia = $_SESSION['nsale'];
   ?>  
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/styles-m.min.css" media="all" />   
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/cart.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/checkout.min.css" media="all" />
<style>
.checkout-index-index {
	margin-top: 30px;
	margin-bottom: 30px;
}
.cart-summary {
   float: right;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border: 0;
}
.checkout-index-index .page-title-wrapper h1{
    border-bottom: 0;
}
.checkout-index-index .page-title-wrapper h1:after {
	content:none;
}
.product-item-price .label {
    padding: 0;
    vertical-align: baseline;
    border-radius: .25em;
    font-size: 10px;
    line-height: 1.6;
    font-weight: 600;
    color: #8f8d8a;
}
.product-item-price .price {
    font-size: 10px;
}
.fieldset {
    background: none;
}
.opc .step-title {
    background: none;
    padding: 0;
    text-align: left;
	/*margin:0 !important;*/
}
.label {
    font-size: initial;
	color: #000;
	padding: 0;
	text-align: left;
}
.checkout-index-index .opc-block-summary .block.items-in-cart.active>.title:after {
    content: none;
}
.checkout-index-index .opc-block-summary .minicart-items .product-item span.label {
    font-size: 12px;
}
.checkout-index-index {
  overflow-y: hidden;
}
.checkout-index-index .opc-wrapper .shipping-address-form-wrapper, .checkout-index-index .opc-block-summary .block.items-in-cart, .checkout-index-index .opc-block-summary .block.discount, .checkout-index-index .opc-block-summary .block.totals-in-cart, .checkout-index-index .opc-block-summary .block.items-in-cart>.title, .checkout-index-index .opc-block-summary .block.discount>.title, .checkout-index-index .opc-block-summary .block.totals-in-cart>.title, .checkout-index-index .table-checkout-shipping-method {
    background: #fff;
}
legend {
    border-bottom: 0;
}
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
<div class="ajax-loader">
	<p><i class="fa fa-spinner fa-spin fa-3x"></i><br> <em>loading...</em></p>
</div>
<script type="text/javascript">
function incrementValue(_id, _iscolor)
{
	tag = 'cquantity_'+_id+'_'+_iscolor;
    var value = parseInt(document.getElementById(tag).value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
	if(value <= 10) {
		document.getElementById(tag).value = value;
		jQuery.post( "<?php echo base_url().'thao-tac/cap-nhat-san-pham'?>", { id: _id, qty: value, iscolor: _iscolor })
		  .done(function( data ) {  		
			//location.reload();
			jQuery('#total_label').text(format_vnd(data));
			jQuery('#total').val(data);
		  });
	}
}
function decrementValue(_id, _iscolor)
{
	tag = 'cquantity_'+_id+'_'+_iscolor;
    var value = parseInt(document.getElementById(tag).value, 10);
    value = isNaN(value) ? 0 : value;
    value--;
	if(value != 0) {
		document.getElementById(tag).value = value;
		jQuery.post( "<?php echo base_url().'thao-tac/cap-nhat-san-pham'?>", { id: _id, qty: value, iscolor: _iscolor })
		  .done(function( data ) {  		
			//location.reload();
			jQuery('#total_label').text(format_vnd(data));
			jQuery('#total').val(data);
		  });
	}
}
	function format_vnd(value) {
		return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
	}
   function update_cart(_id, _iscolor){
   	_qty = jQuery("#cquantity_"+_id).val();   
   		jQuery.post( "<?php echo base_url().'thao-tac/cap-nhat-san-pham'?>", { id: _id, qty: _qty, iscolor: _iscolor })
   	  .done(function( data ) {  		
   		//location.reload();
		jQuery('#total_label').text(format_vnd(data));
		jQuery('#total').val(data);
   	  });
   }   
   function del_cart(_id, _iscolor){
   	cfm= confirm("Bạn muốn xóa sản phẩm này khỏi giỏ hàng của mình ?");
   	if(cfm == true){
   		jQuery.post( "<?php echo base_url().'thao-tac/xoa-san-pham'?>", { id: _id, iscolor: _iscolor })
   	  .done(function( data ) {	
   		location.reload();
   	  });
   	}
   }
   function update_cart_m(_id, _iscolor){
   	_qty = jQuery("#cquantity_m_"+_id).val();   
   		jQuery.post( "<?php echo base_url().'thao-tac/cap-nhat-san-pham'?>", { id: _id, qty: _qty, iscolor: _iscolor })
   	  .done(function( data ) {  		
   		location.reload();
   	  });
   }   
   function check_code_sale(){
            _code = jQuery("#cps_coupon_input").val();
			_total = jQuery("#total").val();
			if(_code != "") {
				jQuery.post("<?php echo base_url()?>thao-tac/check-code-sale", {
					 ccode: _code,
					 total: _total
				})
				.done(function(data) {
					 if(data == "0") {
						//jQuery("#err_msg_code").text("Mã không đúng hoặc không tồn tại.");
						//jQuery("#err_msg_code").css({'display': 'block'});
						alert("Mã không đúng hoặc không tồn tại.");
					 } else if(data == "2") {
						//jQuery("#err_msg_code").text("Số tiền tối thiểu chưa đạt để áp dụng MGG này.");
						//jQuery("#err_msg_code").css({'display': 'block'});
						alert("Số tiền tối thiểu chưa đạt để áp dụng MGG này.");
					 } else {
						//$("#err_msg_code").css({'display': 'none'});
						window.location.reload();
					 }
				});
			} else {
				alert("Vui lòng nhập mã giảm giá nếu có.");
				//jQuery("#err_msg_code").text("Vui lòng nhập mã rồi nhấn Áp dụng.");
				//jQuery("#err_msg_code").css({'display': 'block'});
			}
	}
</script>
<script type="text/javascript">
   function setShipping(_value){
	   if(_value=='1') {
		   jQuery('#at_home').addClass('active');
		   jQuery('#at_shop').removeClass('active');
		   jQuery('#box-addresss').removeClass('hide');
		   jQuery('#box-shop').addClass('hide');
	   } else {
		   jQuery('#at_shop').addClass('active');
		   jQuery('#at_home').removeClass('active');
		   jQuery('#box-addresss').addClass('hide');
		   jQuery('#box-shop').removeClass('hide');
	   }
	   
   		jQuery.post( "<?php echo base_url().'ajax_actions/ajax_set_shipping'?>", { value: _value })
   	  .done(function( data ) {  		
   		//location.reload();
   	  });
   } 
   function update_district(_nid){
   		jQuery.post( "<?php echo base_url().'data_load_district'?>", { nid: _nid })
   	  .done(function( data ) {  		
   		jQuery('#nid_district').html(data);
   	  });
   } 
   function update_ward(_nid){
   		jQuery.post( "<?php echo base_url().'data_load_ward'?>", { nid: _nid })
   	  .done(function( data ) { 
   		jQuery('#nid_ward').html(data);
   	  });
   } 
   
</script>  
<form method="post" action="<?php echo base_url().'gio-hang'?>">
<input type="hidden" id="total" value="<?php echo $total; ?>" />
<div class="container checkout-index-index">
	<div id="checkout" data-bind="scope:'checkout'" class="checkout-container">
   <div class="opc-main">
      <div class="opc-column">
         <!-- ko foreach: getRegion('authentication') --><!--/ko-->
         <!-- ko foreach: getRegion('messages') -->
         <!-- ko template: getTemplate() -->
         <div data-role="checkout-messages" class="messages" data-bind="visible: isVisible(), click: removeAll">
            <!-- ko foreach: messageContainer.getErrorMessages() --><!--/ko-->
            <!-- ko foreach: messageContainer.getSuccessMessages() --><!--/ko-->
         </div>
         <!-- /ko -->
         <!-- ko template: getTemplate() -->
         <div class="ampickup-map-popup" data-bind="fadeVisible: visible" style="display: none;">
            <div class="ampickup-overlay" data-bind="click: hidePopup"></div>
            <div class="ampickup-content">
               <span class="ampickup-close" data-bind="click: hidePopup"></span>
               <span class="ampickup-title" data-bind="i18n: 'Choose a Store'">Choose a Store</span>
               <!-- ko if:  mapIsLoaded()--><!-- /ko -->
            </div>
         </div>
         <!-- /ko -->
         <!--/ko-->
         <div class="opc-wrapper">
            <ol class="opc" id="checkoutSteps">

               <li id="shipping" class="checkout-shipping-address" data-bind="fadeVisible: visible()">
                  <div class="step-title" data-role="title" data-bind="i18n: 'Shipping information'">Thông tin giao hàng</div>
					<?php /*
					<p><span data-bind="i18n: 'Become a member of Hoi Cam to enjoy thousands of special promotions!'">Trở thành thành viên Hội Cam để được hưởng hàng ngàn chương trình ưu đãi đặc biệt!</span></p>
					*/ ?>
                  <div id="checkout-step-shipping" class="step-content" data-role="content">

                     <div class="shipping-address-form-wrapper">

                        <div class="form form-login">
                           <fieldset id="customer-email-fieldset" class="fieldset">
                              <div class="field required">
                                 <label class="label" for="customer-email"><span data-bind="i18n: 'Email'">Email</span></label>
                                 <div class="control">
                                    <input class="input-text" type="email" name="cemail" id="customer-email" placeholder="Nhập email của bạn" value="<?php echo $member['cemail']; ?>">
                                 </div>
                              </div>
                           </fieldset>
                        </div>

                        <div class="form form-shipping-address">
                           <div id="shipping-new-address-form" class="fieldset address">
                              <div class="field" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="UU8VW3F">
                                    <!-- ko if: element.label --><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <select class="select" name="" id="UU8VW3F" aria-invalid="false" placeholder=""></select>
                                 </div>
                              </div>
                              <div class="field" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.region" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="FN46PRQ">
                                    <!-- ko if: element.label --><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <input class="input-text" type="text" name="region" placeholder="" aria-invalid="false" id="FN46PRQ">
                                 </div>
                              </div>
                  
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.shipping_address_type">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="X5WJJ0J">
                                    <span data-bind="i18n: element.label">Loại địa chỉ</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <div class="admin__field-control" data-bind="css: {'_with-tooltip': $data.tooltip}">
                                       <!-- ko foreach: options -->
                                       <div class="admin__field admin__field-radio-option">
                                          <input id="1" value="0" type="radio" name="caddress_type" checked>
                                          <label class="admin__field-label" data-bind="attr: {for: ko.uid}, text: label" for="1">Nhà riêng</label>
                                       </div>
                                       <div class="admin__field admin__field-radio-option">
                                          <input id="2" value="1" type="radio" name="caddress_type">
                                          <label class="admin__field-label" data-bind="attr: {for: ko.uid}, text: label" for="2">Công ty</label>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                      
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.lastname">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="Y1KP8EN">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Họ tên</span>
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <input class="input-text" type="text" name="cname" placeholder="Họ tên" value="<?php echo $member['cname']; ?>">
                                 </div>
                              </div>
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.firstname">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="JUPRB58">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Số điện thoại</span>
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <input class="input-text" type="text" name="cphone" placeholder="Số điện thoại" value="<?php echo $member['cphone']; ?>">
                                 </div>
                              </div>
                             
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.city_id">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="NSXF1B6">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Tỉnh/Thành Phố</span>
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
									<select id="nid_province" name="nid_province" class="select placeholder" onchange="load_district(this.value);" required>
												<?php /*
												<select id="nid_province" name="nid_province" class="select placeholder" onchange="update_district(this.value);" required>
												$list = get_province_all();
												foreach($list as $data) {
												?>
												<option value="<?php echo $data['nid']; ?>"><?php echo $data['cname']; ?></option>
												<?php } */?>
									</select>
                                 </div>
                              </div>
                              
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.district_id">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="I28JPA6">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Quận/Huyện</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <select id="nid_district" name="nid_district" class="select placeholder" onchange="load_ward(this.value);" required>
												<?php /*
											<select id="nid_district" name="nid_district" class="select placeholder" onchange="update_ward(this.value);" required>	
												$list = get_district_by_province(63);
												foreach($list as $data) {
												?>
												<option value="<?php echo $data['nid']; ?>"><?php echo $data['cname']; ?></option>
												<?php } */ ?>
											</select>
                                 </div>
                              </div>

                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.ward_id">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="CTMR256">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Phường/Xã</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <select id="nid_ward" name="nid_ward" class="select placeholder" required>
									</select>
                                 </div>
                              </div>

                              <fieldset class="field street admin__control-fields required" data-bind="css: additionalClasses">
                                 <legend class="label">
                                    <span data-bind="i18n: element.label">Địa chỉ</span>
                                 </legend>
                                 <div class="control">
                                    <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="shippingAddress.street.0">
                                       <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                          <input class="input-text" type="text" id="caddress" name="caddress" placeholder="Nhập Số nhà, Tên đường, Tòa nhà." required onkeyup="update_address_full();">
                                       </div>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>

                        <div data-bind="visible: canVisibleBlock">
                           <div data-bind="visible: canVisibleInShippingStep">
                              <fieldset class="fieldset">
                                 <div class="field">
                                    <label class="label" for="comment-code">
                                    <span data-bind="i18n: label_fieldset">Ghi chú đơn hàng</span>
                                    </label>
                                    <div class="control">
                                       <textarea class="input-text" id="order-note" name="cnote" rows="5" maxlength="200" placeholder="Nhập nội dung"></textarea>
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>
                        <!-- /ko --><!-- /ko -->
                        <!-- /ko -->
                        <!-- /ko --><!-- /ko -->
                     </div>
                  </div>
               </li>
               <!--Shipping method template-->
               <li id="opc-shipping_method" class="checkout-shipping-method" data-bind="fadeVisible: visible(), blockLoader: isLoading" role="presentation">
                  <div class="checkout-shipping-method">
                     <div class="step-title" data-role="title" data-bind="i18n: 'Shipping Methods'">Phương thức vận chuyển</div>
                     <!-- ko foreach: getRegion('before-shipping-method-form') --><!-- ko template: getTemplate() -->
                     <!-- ko foreach: {data: elems, as: 'element'} -->
                     <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                     <div class="shipping-policy-block field-tooltip" data-bind="visible: config.isEnabled" style="display: none;">
                        <span class="field-tooltip-action" tabindex="0" data-toggle="dropdown" data-bind="mageInit: {'dropdown':{'activeClass': '_active'}}" aria-haspopup="true" aria-expanded="false" role="button">
                           <!-- ko i18n: 'See our Shipping Policy' --><span>Xem chính sách vận chuyển của chúng tôi</span><!-- /ko -->
                        </span>
                        <div class="field-tooltip-content" data-target="dropdown" aria-hidden="true">
                           <span data-bind="html: config.shippingPolicyContent"></span>
                        </div>
                     </div>

                     <div id="checkout-step-shipping_method" class="step-content" data-role="content" role="tabpanel" aria-hidden="false">
                        
						   <!-- ko template: shippingMethodListTemplate -->
						   <div id="checkout-shipping-method-load">
							  <table class="table-checkout-shipping-method">
								 <tbody>
									<!-- ko foreach: { data: rates(), as: 'method'} -->
									<!--ko template: { name: element.shippingMethodItemTemplate} -->
									<tr class="row -selected" data-bind="css: {'-selected': element.rates().length == 1 || element.carrierSelected(method)}, click: element.selectShippingMethod">
									   <td class="col col-method" colspan="4">
										  <div class="shipping-method-wrap">
											 <!-- ko ifnot: method.error_message --><input type="radio" class="radio" checked="true" value="0" name="cpayment_method"><!-- /ko -->
											 <label>
												<span class="method_title" data-bind="attr: {'id': 'label_method_' + method.method_code + '_' + method.carrier_code}, text: method.method_title" id="label_method_viettelPostCarrier_viettelPostCarrier"></span>
												<!-- ko if: (method.method_title) --><!-- /ko -->
												<span class="carrier_title" data-bind="attr: {'id': 'label_carrier_' + method.method_code + '_' + method.carrier_code}, text: method.carrier_title" id="label_carrier_viettelPostCarrier_viettelPostCarrier">Giao hàng tiêu chuẩn</span>
												<p class="shipping-method-desc" data-bind="text: method.extension_attributes.description">Phí giao 20K (nội thành HCM &amp; Hà Nội); phí giao 30K (ngoại tỉnh). MIỄN PHÍ GIAO HÀNG đơn từ 89K. Dự kiến giao hàng từ 2-5 ngày, trừ Chủ Nhật, Lễ Tết.</p>
												<!-- /ko -->
												<!-- /ko -->
											 </label>
										  </div>
										  <!-- ko if: method.error_message --><!-- /ko -->
									   </td>
									</tr>
									<!-- /ko -->
									<!-- /ko -->
								 </tbody>
							  </table>
						   </div>
					
                     </div>
                  </div>
               </li>

               <li id="payment" role="presentation" class="checkout-payment-method" data-bind="fadeVisible: isVisible" style="display: none;">
                  <div id="checkout-step-payment" class="step-content" data-role="content" role="tabpanel" aria-hidden="false">
                     <!-- ko if: (quoteIsVirtual) --><!--/ko-->

                        <input data-bind="attr: {value: getFormKey()}" type="hidden" name="form_key" value="8EzLgU6vLxRMiToa">
                        <fieldset class="fieldset">
                           <legend class="legend">
                              <span data-bind="i18n: 'Payment Information'">Thông tin thanh toán</span>
                           </legend>
                           <!-- ko foreach: getRegion('place-order-captcha') -->
                           <!-- ko template: getTemplate() -->
                           <input name="captcha_form_id" type="hidden" data-bind="value: formId,  attr: {'data-scope': dataScope}" value="payment_processing_request" data-scope="">
                           <!-- ko if: (isRequired() && getIsVisible())--><!-- /ko -->
                           <!-- /ko -->
                           <!-- /ko -->
                           <!-- ko foreach: getRegion('beforeMethods') -->
                           <!-- ko template: getTemplate() -->
                           <!-- ko foreach: {data: elems, as: 'element'} -->
                           <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                           <div>
                              <!-- ko foreach: {data: getRegion('place-order-recaptcha'), as: 'recaptcha'} --><!-- /ko -->
                           </div>
                           <hr>
                           <!-- /ko --><!-- /ko -->
                           <!-- /ko -->
                           <!-- /ko -->
                           <!-- /ko -->
                           <div id="checkout-payment-method-load" class="opc-payment" data-bind="visible: isPaymentMethodsAvailable" style="display: none;">
                              <!-- ko foreach: getRegion('payment-methods-list') -->
                              <!-- ko template: getTemplate() -->
                              <!-- ko if: isPaymentMethodsAvailable() --><!-- /ko -->
                              <!-- ko ifnot: isPaymentMethodsAvailable() -->
                              <div class="no-payments-block" data-bind="i18n: 'No Payment Methods'">Không có phương thức thanh toán</div>
                              <!-- /ko -->
                              <!-- /ko -->
                              <!-- /ko -->
                           </div>
                           <div class="no-quotes-block" data-bind="visible: isPaymentMethodsAvailable() == false">
                              <!-- ko i18n: 'No Payment method available.'--><span>Không có phương thức thanh toán có sẵn.</span><!-- /ko -->
                           </div>
                           <div class="fieldset vat-invoice">
                              <!-- ko foreach: getRegion('vat-invoice') --><!-- ko template: getTemplate() -->
                              <!-- ko foreach: {data: elems, as: 'element'} -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div class="field" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="additional-data.vat_invoice.save_vat_invoice">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="VRDH399">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Xuất hóa đơn công ty</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <!-- ko ifnot: element.hasAddons() -->
                                    <!-- ko template: element.elementTmpl -->
                                    <div class="choice field">
                                       <input type="checkbox" class="checkbox" data-bind="
                                          checked: value,
                                          attr: {
                                          id: uid,
                                          disabled: disabled,
                                          name: inputName,
                                          'aria-describedby': getDescriptionId(),
                                          'aria-required': required,
                                          'aria-invalid': error() ? true : 'false'
                                          },
                                          hasFocus: focused" id="VRDH399" name="vat_invoice[save_vat_invoice]" aria-invalid="false">
                                       <label class="label" data-bind="checked: value, attr: { for: uid }" for="VRDH399">
                                       <span data-bind="text: description || label">Xuất hóa đơn công ty</span>
                                       </label>
                                       <!-- ko if: note -->
                                       <div class="field-note vat-note" data-bind="attr: {id: noticeId}, click: function(data, event) { return showContent(data, event) }" id="notice-VRDH399">
                                          <span data-bind="text: note">Vui lòng xem điều khoản xuất hóa đơn</span>
                                       </div>
                                       <!-- /ko -->
                                    </div>
                                    <!-- /ko -->
                                    <!-- /ko -->
                                    <!-- ko if: element.hasAddons() --><!-- /ko -->
                                    <!-- ko if: element.tooltip --><!-- /ko -->
                                    <!-- ko if: element.notice --><!-- /ko -->
                                    <!-- ko if: element.error() --><!-- /ko -->
                                    <!-- ko if: element.warn() --><!-- /ko -->
                                 </div>
                              </div>
                              <!-- /ko --><!-- /ko -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="additional-data.vat_invoice.company_name" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="RD7WEXQ">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Tên công ty</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <!-- ko ifnot: element.hasAddons() -->
                                    <!-- ko template: element.elementTmpl --><!-- input field element and corresponding bindings -->
                                    <input class="input-text" type="text" data-bind="
                                       value: value,
                                       valueUpdate: 'keyup',
                                       hasFocus: focused,
                                       attr: {
                                       name: inputName,
                                       placeholder: placeholder,
                                       'aria-describedby': getDescriptionId(),
                                       'aria-required': required,
                                       'aria-invalid': error() ? true : 'false',
                                       id: uid,
                                       disabled: disabled
                                       }" aria-required="true" aria-invalid="false" data-validate="{required:true, 'validate-no-html-tags':true}" name="vat_invoice[company_name]" placeholder="Nhập đầy đủ tên công ty" id="RD7WEXQ">
                                    <!-- /ko -->
                                    <!-- /ko -->
                                    <!-- ko if: element.hasAddons() --><!-- /ko -->
                                    <!-- ko if: element.tooltip --><!-- /ko -->
                                    <!-- ko if: element.notice --><!-- /ko -->
                                    <!-- ko if: element.error() --><!-- /ko -->
                                    <!-- ko if: element.warn() --><!-- /ko -->
                                 </div>
                              </div>
                              <!-- /ko --><!-- /ko -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="additional-data.vat_invoice.tax_code" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="AGX12G3">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Mã Số Thuế</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <!-- ko ifnot: element.hasAddons() -->
                                    <!-- ko template: element.elementTmpl --><!-- input field element and corresponding bindings -->
                                    <input class="input-text" type="text" data-bind="
                                       value: value,
                                       valueUpdate: 'keyup',
                                       hasFocus: focused,
                                       attr: {
                                       name: inputName,
                                       placeholder: placeholder,
                                       'aria-describedby': getDescriptionId(),
                                       'aria-required': required,
                                       'aria-invalid': error() ? true : 'false',
                                       id: uid,
                                       disabled: disabled
                                       }" aria-required="true" aria-invalid="false" data-validate="{required:true, 'validate-no-html-tags':true}" name="vat_invoice[tax_code]" placeholder="Nhập mã số thuế" id="AGX12G3">
                                    <!-- /ko -->
                                    <!-- /ko -->
                                    <!-- ko if: element.hasAddons() --><!-- /ko -->
                                    <!-- ko if: element.tooltip --><!-- /ko -->
                                    <!-- ko if: element.notice --><!-- /ko -->
                                    <!-- ko if: element.error() --><!-- /ko -->
                                    <!-- ko if: element.warn() --><!-- /ko -->
                                 </div>
                              </div>
                              <!-- /ko --><!-- /ko -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="additional-data.vat_invoice.company_address" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="LNE295E">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Địa chỉ công ty</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <!-- ko ifnot: element.hasAddons() -->
                                    <!-- ko template: element.elementTmpl --><!-- input field element and corresponding bindings -->
                                    <input class="input-text" type="text" data-bind="
                                       value: value,
                                       valueUpdate: 'keyup',
                                       hasFocus: focused,
                                       attr: {
                                       name: inputName,
                                       placeholder: placeholder,
                                       'aria-describedby': getDescriptionId(),
                                       'aria-required': required,
                                       'aria-invalid': error() ? true : 'false',
                                       id: uid,
                                       disabled: disabled
                                       }" aria-required="true" aria-invalid="false" data-validate="{required:true, 'validate-no-html-tags':true}" name="vat_invoice[company_address]" placeholder="Nhập đầy đủ địa chỉ" id="LNE295E">
                                    <!-- /ko -->
                                    <!-- /ko -->
                                    <!-- ko if: element.hasAddons() --><!-- /ko -->
                                    <!-- ko if: element.tooltip --><!-- /ko -->
                                    <!-- ko if: element.notice --><!-- /ko -->
                                    <!-- ko if: element.error() --><!-- /ko -->
                                    <!-- ko if: element.warn() --><!-- /ko -->
                                 </div>
                              </div>
                              <!-- /ko --><!-- /ko -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div class="field _required" data-bind="visible: visible, attr: {'name': element.dataScope}, css: additionalClasses" name="additional-data.vat_invoice.company_email" style="display: none;">
                                 <label class="label" data-bind="attr: { for: element.uid }" for="MWROXKY">
                                    <!-- ko if: element.label --><span data-bind="i18n: element.label">Email</span><!-- /ko -->
                                 </label>
                                 <div class="control" data-bind="css: {'_with-tooltip': element.tooltip}">
                                    <!-- ko ifnot: element.hasAddons() -->
                                    <!-- ko template: element.elementTmpl --><!-- input field element and corresponding bindings -->
                                    <input class="input-text" type="text" data-bind="
                                       value: value,
                                       valueUpdate: 'keyup',
                                       hasFocus: focused,
                                       attr: {
                                       name: inputName,
                                       placeholder: placeholder,
                                       'aria-describedby': getDescriptionId(),
                                       'aria-required': required,
                                       'aria-invalid': error() ? true : 'false',
                                       id: uid,
                                       disabled: disabled
                                       }" aria-required="true" aria-invalid="false" data-validate="{required:true, 'validate-no-html-tags':true}" name="vat_invoice[company_email]" placeholder="Nhập email" id="MWROXKY">
                                    <!-- /ko -->
                                    <!-- /ko -->
                                    <!-- ko if: element.hasAddons() --><!-- /ko -->
                                    <!-- ko if: element.tooltip --><!-- /ko -->
                                    <!-- ko if: element.notice --><!-- /ko -->
                                    <!-- ko if: element.error() --><!-- /ko -->
                                    <!-- ko if: element.warn() --><!-- /ko -->
                                 </div>
                              </div>
                              <!-- /ko --><!-- /ko -->
                              <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                              <div data-bind="css: $data.additionalClasses, html: getContentUnsanitizedHtml(), visible: visible" class="field invoice_note admin__scope-old" style="display: none;">*Hóa đơn điện tử sẽ được gửi đến email của bạn sau khi đơn hàng hoàn tất</div>
                              <!-- ko if: showSpinner --><!-- /ko -->
                              <!-- /ko --><!-- /ko -->
                              <!-- /ko -->
                              <!-- /ko --><!-- /ko -->
                           </div>
                           <!-- ko foreach: getRegion('afterMethods') -->
                           <!-- ko template: getTemplate() -->
                           <!-- ko foreach: {data: elems, as: 'element'} -->
                           <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                           <div class="payment-option _collapsible opc-payment-additional discount-code" id="block-mpmultiplecoupons-discount" data-bind="mageInit: {'collapsible':{'openedState': '_active'}}" data-collapsible="true" role="tablist">
                              <div class="payment-option-title field choice" data-role="title" role="tab" aria-selected="false" aria-expanded="false" tabindex="0">
                                 <span class="action action-toggle" id="block-mpmultiplecoupons-discount-heading" role="heading" aria-level="2" data-bind="text: blockTitle">Áp dụng giảm giá</span>
                              </div>
                              <div class="payment-option-content" data-role="content" aria-labelledby="block-mpmultiplecoupons-discount-heading" data-bind="blockLoader: isLoading" role="tabpanel" aria-hidden="true" style="display: none;">
                                 <!-- ko foreach: getRegion('messages') -->
                                 <!-- ko template: getTemplate() -->
                                 <div data-role="mpmultiplecoupons-messages" class="messages mpmultiplecoupons-messages" data-bind="visible: isVisible()">
                                    <!-- ko foreach: messageContainer.getErrorMessages() --><!--/ko-->
                                    <!-- ko foreach: messageContainer.getSuccessMessages() --><!--/ko-->
                                 </div>
                                 <!-- /ko -->
                                 <!--/ko-->
                
                     
                     </div>
                     </div>
                     <!-- /ko --><!-- /ko -->
                     <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() --><div data-bind="visible: canVisibleBlock">
                     <div data-bind="visible: !canVisibleInShippingStep" style="display: none;">
                     <fieldset class="fieldset">
                     <div class="field">
                     <label class="label" for="comment-code">
                     <span data-bind="i18n: label_fieldset">Ghi chú đơn hàng</span>
                     </label>
                     <div class="control">
                     <textarea class="input-text" id="order-note" name="order-note-billing" rows="5" maxlength="200" data-bind="attr:{placeholder: $t(placeholder_textarea)} " placeholder="Nhập nội dung"></textarea>
                     </div>
                     </div>
                     </fieldset>
                     </div>
                     </div>
                     <!-- /ko --><!-- /ko -->
                     <!-- ko if: hasTemplate() --><!-- ko template: getTemplate() -->
                     <div class="payment-option _collapsible opc-payment-additional giftcardaccount " id="giftcardaccount-placer" data-bind="mageInit: {'collapsible':{'openedState': '_active'}}" data-collapsible="true" role="tablist">
                     <div class="payment-option-title field choice" data-role="title" role="tab" aria-selected="false" aria-expanded="false" tabindex="0">
                     <span class="action action-toggle" id="block-giftcard-heading" role="heading" aria-level="2">
                     <!-- ko i18n: 'Apply Gift Card'--><span>Áp dụng thẻ quà tặng</span><!-- /ko -->
                     </span>
                     </div>
                     <div class="payment-option-content" data-role="content" role="tabpanel" aria-hidden="true" style="display: none;">
                     <div data-role="checkout-messages" class="messages" data-bind="visible: isVisible(), click: removeAll">
                     </div>
                     
                     </div>
                     </div>
                     </fieldset>
                  </div>
               </li>
            </ol>
         </div>
      </div>
      <!-- ko foreach: getRegion('sidebar') -->
      <!-- ko template: getTemplate() -->
      <div class="opc-sidebar" id="opc-sidebar">
         <!-- ko foreach: getRegion('summary') -->
         <!-- ko template: getTemplate() -->
         <div class="opc-block-summary" data-bind="blockLoader: isLoading">
            <span data-bind="i18n: 'Order Details'" class="title">CHI TIẾT ĐƠN HÀNG</span>
            <!-- ko foreach: elems() -->
            <!-- ko template: getTemplate() -->
            <div class="block items-in-cart active">
               <div class="title" data-role="title" role="tab" aria-selected="false" aria-expanded="true" tabindex="0">
                  <strong role="heading" aria-level="1" data-bind="attr: { 'data-label': $t('Order information') }" data-label="Thông tin đơn hàng">
                     <span>Giỏ hàng</span>
                     <span class="total-number">(6 sản phẩm)</span>
                  </strong>
               </div>
               <div class="content minicart-items" data-role="content" role="tabpanel" aria-hidden="false">
                  <div class="minicart-items-wrapper">
                     <ol class="minicart-items">
                        <?php //$total = 0;
							$obj_cart = $_SESSION["cart"];	
								foreach($obj_cart as $cart){
									if($cart['iscolor']==1) {
									   $color = get_color_detail($cart['id']);
									   $product = get_product_detail($color['nid_product']);
									   //$name = $product['cproducts'].' <span style="color:#04AA6D;font-size: 14px;"><i class="fa fa-check" aria-hidden="true"></i> '.$color['cname'];
										$name = $product['cproducts'];
										
									   $fprice = $color['fprice'];
									   $fprice_sale = $color['fprice_sale'];
								   } else {
									   $product = get_product_detail($cart['id']);
									   $name = $product['cproducts'];
									   
									   $fprice = $product['fprice'];
									   $fprice_sale = $product['fprice_sale'];
								   }
								   
								   if($fprice_sale < $fprice && ($product['ncheck'] == 1 || $product['cflash'] == 1)) {
									    $thanh_tien = $fprice_sale*$cart['qty'];
										//$total += $thanh_tien;
								   } else {
										$thanh_tien = $fprice*$cart['qty'];
										//$total += $thanh_tien;
									}
									
									$total_sale = $total; $_SESSION['nsale'] = 0;
									if(isset($_SESSION['price_sale'])) {
										$total_sale = $total_sale - $_SESSION['price_sale']; 
										$_SESSION['nsale'] = $_SESSION['price_sale'];
									} 
							?>
                        <li class="product-item">
                           <div class="product">
                              <span class="product-image-container" style="height: 78px; width: 78px;">
                              <span class="product-image-wrapper">
                              <img loading="lazy" src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>" width="156" height="156">
                              </span>
                              </span>
                              <div class="product-item-details">
                                 <div class="product-item-inner">
                                    <div class="product-item-name-block">
                                       <strong class="product-item-name"><?php echo $name;?></strong>
                                    </div>
                                    <div class="product-item-qty-wrapper">
                                       <?php if($cart['iscolor']==1) { ?>
                                       <div class="product-item-variant">
                                          <span class="label">Phân loại:</span>
                                          <span class="value"><?php echo $color['cname']; ?></span>
                                       </div>
                                       <?php } ?>
                                       <span class="product-item-qty">
                                       <span class="label">Số lượng:</span>
                                       <span class="value"><?php echo $cart['qty']?></span>
                                       </span>
                                    </div>
                                    <div class="product-item-price-wrapper">
                                       <span class="product-price" data-bind="html: getPriceItem($parent)"><?php echo number_format($fprice); ?></span>
                                       <p class="product-item-subtotal">
                                          <span class="label">Thành tiền:</span>
                                          <span class="value subtotal"><?php echo number_format($thanh_tien); ?></span>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </li>
						<?php } ?>
                     </ol>
                  </div>
               </div>
               <div class="items-cart-total mobile-hide">
                  <span class="label" data-bind="i18n: 'Total amount'">Tổng tiền</span>
                  <span class="value" data-bind="html: getTotalValue()"><?php echo number_format($total); ?></span>
               </div>
            </div>
            <!-- /ko -->
            <!-- ko template: getTemplate() -->
            <div class="block discount" id="block-mpmultiplecoupons-discount">
               <div class="title">
                  <strong id="block-mpmultiplecoupons-discount-heading" role="heading" aria-level="2" data-bind="attr: {'data-checkout-title': $t('Apply Discount Code')}" data-checkout-title="Áp dụng giảm giá">
                  <span data-bind="i18n: 'Discount'">Mã giảm giá</span>
                  </strong>
               </div>
               <div class="content" aria-labelledby="block-mpmultiplecoupons-discount-heading" data-bind="blockLoader: isLoading">
                  <!-- ko foreach: getRegion('messages') -->
                  <!-- ko template: getTemplate() -->
                  <div data-role="mpmultiplecoupons-messages" class="messages mpmultiplecoupons-messages" data-bind="visible: isVisible()">
                     <!-- ko foreach: messageContainer.getErrorMessages() --><!--/ko-->
                     <!-- ko foreach: messageContainer.getSuccessMessages() --><!--/ko-->
                  </div>
                  <!-- /ko -->
                  <!--/ko-->
                  
                     <div class="fieldset coupon">
                        <div class="field">
                           <div class="control">
                              <input type="text" class="input-text" id="cps_coupon_input" name="mpmultiplecoupons_code" data-bind="value: inputCode, valueUpdate: 'keyUp', attr: {placeholder: $t('Enter discount code')}" data-validate="{required:true}" placeholder="Nhập mã giảm giá của bạn">
                              <input type="hidden" class="input-text" data-bind="value: couponCode">
                           </div>
                        </div>
                        <div class="actions-toolbar">
                           <div class="primary">
                              <button class="action primary" type="button" onclick="check_code_sale();">
                              <span data-bind="i18n: 'Apply Discount'">Áp dụng</span>
                              </button>
                           </div>
                        </div>
                     </div>
                     <div class="mpmultiplecoupons-applied" data-bind="visible: isApplied()" style="display: none;">
                        <!-- ko foreach: {data: arrayCode, as: 'code'} --><!-- /ko -->
                     </div>
                  
               </div>

               <div id="term-popup-container"></div>
               <div id="coupons-popup" class="coupons-popup" data-bind="visible: popupDialog" style="display: none;">
                  <div class="modalWindow" data-bind="with:popupDialog"></div>
               </div>
               <!-- /ko -->
               <!--/ko-->
            </div>
            <!-- /ko -->
            <!-- ko template: getTemplate() -->
            <!-- ko if: isDisplayed() -->
            <div class="block totals-in-cart">
               <div class="title"><strong data-bind="i18n: 'Your order'">Đơn hàng của bạn</strong></div>
               <table class="data table table-totals">
                  <caption class="table-caption" data-bind="i18n: 'Order Summary'">Tóm tắt đơn hàng</caption>
                  <tbody>
                     <tr class="totals sub">
                        <th  scope="row">
                           <span class="title" data-bind="i18n: title">Tạm tính</span>
                        </th>
                        <td class="amount">
                           <span class="price" data-bind="text: getValue(), attr:{'data-label': title}" data-label="Tạm tính"><?php echo number_format($total); ?></span>
                           <!-- ko foreach: elems() --><!-- /ko -->
                        </td>
                     </tr>

                     <tr class="totals shipping excl totals-shipping-summary">
                        <th  scope="row">
                           <span class="label" data-bind="i18n: title">Phí vận chuyển</span>
                           <span class="value" data-bind="text: getShippingMethodTitle()"></span>
                        </th>
                        <td class="amount">

                           <span class="not-calculated" data-bind="text: getValue(), attr: {'data-th': title}" data-th="Phí vận chuyển">Chưa tính</span>
                           <!-- /ko -->
                        </td>
                     </tr>

                     <tr class="totals-mpmultiplecoupons-summary" data-bind="mageInit: {'toggleAdvanced':{'baseToggleClass': 'expanded', 'toggleContainers': '.totals-mpmultiplecoupons-details'}},
                        css: {'totals-tax-summary': getCoupons().length}">
                        <th  scope="row" colspan="1">
                           <span class="detailed" data-bind="text: getTitle()">Mã giảm giá</span>
                        </th>
                        <td data-bind="attr: {'data-th': getTitle()}" class="amount" data-th="Mã giảm giá">
                           <span class="price" data-bind="text: getValue()"><?php echo number_format($giam_gia); ?></span>
                        </td>
                     </tr>
                     <!-- ko foreach: { data: getCoupons(), as: 'coupon' } --><!-- /ko -->
                     <!-- /ko -->
                     <tr class="totals-mpmultiplecoupons-spacing">
                        <th></th>
                        <td></td>
                     </tr>

                     <tr class="grand totals checkout-mobile-sticky">
                        <th  scope="row">
                           <strong data-bind="i18n: title">Tổng thanh toán</strong>
                        </th>
                        <td class="amount" data-bind="attr: {'data-th': $t(title)}" data-th="Tổng thanh toán">
                           <strong><span class="price" data-bind="text: getValue()"><?php echo number_format($total); ?></span></strong>
                           <!-- ko foreach: elems() --><!-- /ko -->
                        </td>
                     </tr>
                     <tr class="cart-totals-bottom">
                        <th class="totals-include-vat">
                           <span class="value sub-title" data-bind="text: label">*Đã bao gồm VAT</span>
                        </th>
                        <td class="totals-membership">
                           <!-- ko if: isCustomerLoggedIn() && isRewardAvailable() --><!-- /ko -->
                        </td>
                     </tr>

                  </tbody>
               </table>
            </div>

            <div class="actions-toolbar">
               <div class="primary">
                  <button type="submit" name="btn_submit" value="submit" class="action primary next-step-button"  >
                  <span data-bind="i18n: buttonText">Xác nhận thanh toán</span>
                  </button>
               </div>
            </div>

         </div>

         <div class="opc-block-shipping-information">
            <!-- ko foreach: getRegion('shipping-information') --><!--/ko-->
         </div>
      </div>
   </div>
</div>
</div>
<input type="hidden" id="caddress_full" name="caddress_full" />
</form>

<script>
    jQuery(window).on('load', function() {
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
					rs = JSON.parse(result);
					//alert(rs.code);
					var list = rs.data;
					var content = '<option value="">-- Vui lòng chọn một mục --</option>';
					for (var i = 0; i < list.length; i++) {
						var item = list[i];
						content += '<option value="' + item.PROVINCE_ID + '">' + item.PROVINCE_NAME + '</option>';
					};
					jQuery("#nid_province").html(content);
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
					jQuery("#nid_district").html(content);
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
					jQuery("#nid_ward").html(content);
				}
			});
	}
	function update_address_full() {
		jQuery("#caddress_full").val(jQuery("#caddress").val() + ', ' + jQuery("#nid_ward option:selected").text() + ', ' + jQuery("#nid_district option:selected").text() + ', ' + jQuery("#nid_province option:selected").text());
	}
</script>
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>