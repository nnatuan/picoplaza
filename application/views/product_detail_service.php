<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>  
<style>
.product-template-content {
	float: none;
    width: 100%;
}
.desc_pro {
	margin-top:20px !important;
}
</style>	
<nav class="breadcrumb text-start  parallax-initiated" data-style="parallax" aria-label="breadcrumbs" style="background-position: 50% 43.0208px;">
   <div class="container">
      <div class="row">
         <h1 class="breadcrumb_title">Dịch vụ</h1>
         <a href="<?php echo base_url()?>" title="Back to the frontpage">Trang chủ</a>
		 <span aria-hidden="true" class="breadcrumb__sep">/</span>
         <a href="<?php echo base_url().'san-pham/danh-muc/'.$obj_cat['ccode'];?>" title=""><?php echo $obj_cat['ccat_products'];?></a>  
         <span aria-hidden="true" class="breadcrumb__sep">/</span>
         <span><?php echo $title; ?></span>
      </div>
   </div>
</nav>
<div class="clearfix"></div>
<div class="shifter-page is-moved-by-drawer" id="container">
            <!-- content for layout -->
            <div id="shopify-section-template--18580270383273__main" class="shopify-section main-product-template">
               <div class="container-fluid spacing_enabled">
                  <div class="row ">
                  
                        <div class="product-template-content">
                           <div class="text-center sidebar_btn">
                              <a class="dt-sc-btn toggleIcon  "> <i class="fa fa-caret-right" aria-hidden="true"></i> </a>
                           </div>
                           <div data-template-style="product-template-default" class="product-template__container page-width template-product" id="ProductSection-template--18580270383273__main" data-section-id="template--18580270383273__main" data-section-type="product-template" data-enable-history-state="true">
                              <div class="product-page-row product-media-size--small">
                                 <div class="product_image_width product-gallery-template--18580270383273__main sidebar-sticky zoom-type-inner" id="product-gallery" data-zoom-method="inner">
                                    <div class="product-item-wrap slider-template--18580270383273__main   swiper-gallery-inline" id="slider" data-dT_media_group>
                                       <img class="product-item-img zoom-img" src="<?php echo base_url()?>upload/images_product/full_images/<?php echo $obj_detail['cimage']?>" alt="" data-srczoom="<?php echo base_url()?>upload/images_product/full_images/<?php echo $obj_detail['cimage']?>" title="" width="960" height="1110" loading="lazy">
                                    </div>
                                 </div>
                                 <div class="product-description-product-template product-description-template--18580270383273__main sidebar-sticky" id="product-description">
                                    <div class="product-item-caption-white  sidebar_template--18580270383273__main" id="sidebar">
                                       <div class="product-meta-block">
                                          <h3 class="product-title"><?php echo $title; ?></h3>
                                          <div class="line_bottom"></div>
										  <div class="desc_pro">
												<?php echo $obj_detail['cdescription']; ?>
											 </div>
											<div> 
											 <a class="support-button" href="tel:<?php echo get_value_by_config(9); ?>"><i class="fa fa-phone" aria-hidden="true"></i>Tư vấn hỗ trợ</a>
											 </div> 
                                       </div>
                                       
                                    </div>
                                 </div>
                              </div>
                              <div class="product-tab">
                                 <div class="dt-sc-tabs-container">
                                    <div class="dt-sc-tabs dt-sc-list-inline">       
                                       <button class="tablinks" onclick="openTab(event, 'tab-gioithieu')">Giới thiệu</button>
                                       <button class="tablinks" onclick="openTab(event, 'tab-dactinh')">Đặc tính kỹ thuật</button>
                                       <button class="tablinks" onclick="openTab(event, 'tab-tinhnang')">Tính năng vượt trội</button>
									   <button class="tablinks" onclick="openTab(event, 'tab-tailieu')">Tài liệu (link download)</button>
									   <button class="tablinks" onclick="openTab(event, 'tab-phukien')">Vật tư và phụ kiện</button>
                                    </div>
                                    <div class="dt-sc-tabs-content  product-single__description rte" id="tab-gioithieu" style="display:block;">
                                       <?php echo $obj_detail['cdetail']; ?>
                                    </div>
                                    <div class="dt-sc-tabs-content rte"  id="tab-dactinh">
                                       <?php echo $obj_detail['cdac_tinh']; ?>
                                    </div>
                                    <div class="dt-sc-tabs-content" id="tab-tinhnang">
                                       <?php echo $obj_detail['ctinh_nang']; ?>
									</div>
									<div class="dt-sc-tabs-content" id="tab-tailieu">
                                       <?php echo $obj_detail['ctai_lieu']; ?>
									</div>
									<div class="dt-sc-tabs-content" id="tab-phukien">
                                       <?php echo $obj_detail['cphu_kien']; ?>
									</div>
                                 </div>
								 <script>
                                    $(function() {  
                                    var Accordion = function(el, multiple) {
                                    this.el = el || {};
                                    this.multiple = multiple || false;
                                    var links = this.el.find('.dt-sc-simple-accordion-link');
                                    links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
                                    }
                                    Accordion.prototype.dropdown = function(e) {
                                    var $el = e.data.el;
                                    	$this = $(this),
                                    	$next = $this.next();
                                            $(this).toggleClass("active");
                                    $next.slideToggle();   		
                                    }	
                                    
                                    var accordion = new Accordion($('#accordion'), false);
                                    });
                                    
                                    // $(document).on('click', '.dt-sc-simple-accordion-link', function() {
                                    //     if ($(this).hasClass("active")) {
                                    //         $(".dt-sc-simple-accordion-link").removeClass("active");
                                    //     } else {
                                    //         $(".dt-sc-simple-accordion-link").removeClass("active");
                                    //         $(this).addClass("active");
                                    //     }
                                    // });
                                    
                                    function openTab(evt, TabName) {
                                      var i, tabcontent, tablinks;
                                      tabcontent = document.getElementsByClassName("dt-sc-tabs-content");
                                      for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].style.display = "none";
                                      }
                                      tablinks = document.getElementsByClassName("tablinks");
                                      for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                                      }
                                      document.getElementById(TabName).style.display = "block";
                                      evt.currentTarget.className += " active";
                                    }
                                    $( ".tablinks" ).first().addClass( "active" );
                                    $( ".dt-sc-tabs-content" ).first().css( "display", "block" );
                                 </script>
                                 <style data-shopify>
                                    .simple-accordion .dt-sc-accordion-simple #shopify-product-reviews{ padding-top:10px;}     
                                    .simple-accordion .dt-sc-accordion-simple { margin-bottom: var(--DTGutter_Width); padding: 20px 30px; line-height: 1.5; background-color:var(--DTform_BG); }
                                    .simple-accordion .dt-sc-simple-accordion-link { cursor:pointer; padding: 15px 45px 15px 30px; position: relative; transition: var(--DTBaseTransition); border-bottom: 1px solid var(--DTColor_Border);}
                                    .simple-accordion .dt-sc-simple-accordion-link:before, 
                                    .simple-accordion .dt-sc-simple-accordion-link:after { position: absolute;  content: " ";  top: 50%; transform: translateY(-50%); left: auto; margin-top: -3px; background-color: var(--DTLinkColor); transition: var(--DTBaseTransition); -webkit-transition: var(--DTBaseTransition); opacity: 1; }
                                    .simple-accordion .dt-sc-simple-accordion-link:after { width: 15px; height: 1px; right: 23px; }
                                    .simple-accordion .dt-sc-simple-accordion-link:before { height: 15px; width: 1px; right: 30px; }
                                    .simple-accordion .dt-sc-simple-accordion-link.active:before { height: 0; }
                                    .simple-accordion .dt-sc-simple-accordion-link .title { margin:0; padding:0;}
                                    .simple-accordion .dt-sc-simple-accordion-link:hover,
                                    .simple-accordion .dt-sc-simple-accordion-link.active { background-color: var(--DTTertiaryColor); }
                                    .simple-accordion .dt-sc-simple-accordion-link:nth-last-child(2) { border:none; }
                                 </style>
                              </div>
                           </div>
                        </div>
                       
					 
                  </div>
               </div>
               <script type="application/json" id="ProductJson-template--18580270383273__main">{"id":7626489266345,"title":"Professional Straight Line Jigsaw","handle":"professional-straight-line-jigsaw","description":"\u003cdiv class=\"sr-layout-block bsc-info\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"sr-layout-subblock\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"sr-txt-title\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"dt-sc-pro-desc-content\"\u003e\n\u003cp\u003e \u003c\/p\u003e\n\u003c\/div\u003e\n\u003cdiv class=\"dt-sc-dtails-wrap\"\u003e\n\u003cdiv class=\"dt-sc-pro-specification\"\u003e\n\u003cdiv class=\"accordion-collapse-spec\"\u003e\n\u003cdiv class=\"accordion-collapse collapse show\"\u003e\n\u003cdiv class=\"accordion-body\"\u003e\n\u003cdiv class=\"row d-none d-sm-none d-md-flex d-lg-flex no-padding price-breakup\"\u003e\n\u003ch5\u003e\n\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003c\/a\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eProduct Details.\u003c\/span\u003e\u003c\/a\u003e\n\u003c\/h5\u003e\n\u003cdiv class=\"col-12 d-flex d-md-none\"\u003e\n\u003cdiv class=\"col-12 no-padding price-breakup-mobile\"\u003e\n\u003ctable class=\"table\"\u003e\n\u003ctbody\u003e\n\u003ctr\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eChuck Size\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\"\u003e\u003cspan\u003e10 to 20 mm\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003eQuantity\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd\u003e\u003cspan\u003e1 Box\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eProduct Number\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\"\u003e\u003cspan\u003egfug87865hhj6 \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003ePower\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003e1000 W\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003eVariable Speed\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eYes\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003ePower Source\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eElectric (A.C)\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003c\/tbody\u003e\n\u003c\/table\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003csection class=\"detail-with-diamond\" id=\"stone-details\"\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\n\u003ch5\u003e\u003cbr\u003e\u003c\/h5\u003e\n\u003c\/a\u003e\n\u003cdiv class=\"content\"\u003e\u003c\/div\u003e\n\u003c\/section\u003e\n\u003c\/div\u003e\n\u003ch5\u003e\n\u003ca class=\"toggle\" href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eBasic Info\u003c\/span\u003e\u003c\/a\u003e.\u003c\/h5\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\n\u003cli\u003e\u003cspan\u003e This tool set comes with a wide collection of tools that is suitable for technicians worldwide.\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eIt is made from high-quality vanadium steel\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThe premium finish of the product will work as scratch-proof\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThis box contains 12 pieces of hex sockets\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThese tools are cold-forged to provide 4x performance and better life than other brands\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThese are universal tools that are easy to handle for any mechanics and technicians. \u003c\/span\u003e\u003c\/li\u003e\n\u003c\/ul\u003e\n\u003ch5\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eTools Specification.\u003c\/span\u003e\u003c\/a\u003e\u003c\/h5\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\n\u003cli\u003e\u003cspan class=\"dt-sc-pro-title-label\" mce-data-marked=\"1\"\u003e6 Months \u003cspan data-mce-fragment=\"1\"\u003ewarranty from the date of purchase\u003c\/span\u003e\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan class=\"dt-sc-pro-title-label\" mce-data-marked=\"1\"\u003eCorded-Electric Drill Tool Kit for professionals\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003e High efficient electronic control technology\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eVery light-weight, compact and easy to use \u003c\/span\u003e\u003c\/li\u003e\n\u003c\/ul\u003e\n\u003c\/div\u003e\n\u003chr\u003e\n\u003cdiv class=\"dt-sc-pro-specification legal\"\u003e\n\u003ch5\u003e\u003ca class=\"toggle\" href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eProduction.\u003c\/span\u003e\u003c\/a\u003e\u003c\/h5\u003e\n\u003ctable class=\"table\" width=\"548\" height=\"226\" data-mce-fragment=\"1\"\u003e\n\u003ctbody data-mce-fragment=\"1\"\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd class=\"\" style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eCountry Of Origin\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eGermany\n \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cspan\u003e\u003cstrong\u003eGeneric Name\u003c\/strong\u003e\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eVanadium Tools Set\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd class=\"\" style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMaterial\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eVanadium Steel\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eManufacturer Name\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eShopify Themes\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eManufacturer Address\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003e1st Cross, church street, east Germany Road, Germany\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMarketers Name\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eShopify Themes creator\n\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eProduct Diversification\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eScrewdriver, plier and hex key \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMaterial\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eC45 or CRV steel\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003c\/tbody\u003e\n\u003c\/table\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\u003c\/ul\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003cdiv class=\"sr-layout-content detail-desc\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"async-rich-info\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"rich-text cf\" data-mce-fragment=\"1\"\u003e\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e","published_at":"2022-11-23T00:24:39-05:00","created_at":"2022-10-12T03:05:21-04:00","vendor":"Framework","type":"Jigsaw","tags":[],"price":45000,"price_min":45000,"price_max":63000,"available":true,"price_varies":true,"compare_at_price":null,"compare_at_price_min":0,"compare_at_price_max":0,"compare_at_price_varies":false,"variants":[{"id":42660996710569,"title":"1kg \/ 50mm \/ Corded Electric","option1":"1kg","option2":"50mm","option3":"Corded Electric","sku":"","requires_shipping":true,"taxable":true,"featured_image":{"id":37281690615977,"product_id":7626489266345,"position":1,"created_at":"2022-11-23T00:19:08-05:00","updated_at":"2022-11-23T00:19:09-05:00","alt":null,"width":960,"height":1110,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749","variant_ids":[42660996710569]},"available":true,"name":"Professional Straight Line Jigsaw - 1kg \/ 50mm \/ Corded Electric","public_title":"1kg \/ 50mm \/ Corded Electric","options":["1kg","50mm","Corded Electric"],"price":45000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","featured_media":{"alt":null,"id":29659642101929,"position":1,"preview_image":{"aspect_ratio":0.865,"height":1110,"width":960,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749"}},"requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}},{"id":42763786322089,"title":"1.2kg \/ 65mm \/ Corded Electric","option1":"1.2kg","option2":"65mm","option3":"Corded Electric","sku":"","requires_shipping":true,"taxable":true,"featured_image":{"id":37281690714281,"product_id":7626489266345,"position":2,"created_at":"2022-11-23T00:19:16-05:00","updated_at":"2022-11-23T00:19:17-05:00","alt":null,"width":960,"height":1110,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10.1.jpg?v=1669180757","variant_ids":[42763786322089]},"available":true,"name":"Professional Straight Line Jigsaw - 1.2kg \/ 65mm \/ Corded Electric","public_title":"1.2kg \/ 65mm \/ Corded Electric","options":["1.2kg","65mm","Corded Electric"],"price":63000,"weight":0,"compare_at_price":null,"inventory_management":"shopify","barcode":"","featured_media":{"alt":null,"id":29659642200233,"position":2,"preview_image":{"aspect_ratio":0.865,"height":1110,"width":960,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10.1.jpg?v=1669180757"}},"requires_selling_plan":false,"selling_plan_allocations":[],"quantity_rule":{"min":1,"max":null,"increment":1}}],"images":["\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749","\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10.1.jpg?v=1669180757"],"featured_image":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749","options":["Item Weight","Blade Length","Power Source"],"media":[{"alt":null,"id":29659642101929,"position":1,"preview_image":{"aspect_ratio":0.865,"height":1110,"width":960,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749"},"aspect_ratio":0.865,"height":1110,"media_type":"image","src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10_29ed08c9-a6c8-4ba6-861f-54b7e3990265.jpg?v=1669180749","width":960},{"alt":null,"id":29659642200233,"position":2,"preview_image":{"aspect_ratio":0.865,"height":1110,"width":960,"src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10.1.jpg?v=1669180757"},"aspect_ratio":0.865,"height":1110,"media_type":"image","src":"\/\/dt-multispare.myshopify.com\/cdn\/shop\/products\/shop10.1.jpg?v=1669180757","width":960}],"requires_selling_plan":false,"selling_plan_groups":[],"content":"\u003cdiv class=\"sr-layout-block bsc-info\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"sr-layout-subblock\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"sr-txt-title\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"dt-sc-pro-desc-content\"\u003e\n\u003cp\u003e \u003c\/p\u003e\n\u003c\/div\u003e\n\u003cdiv class=\"dt-sc-dtails-wrap\"\u003e\n\u003cdiv class=\"dt-sc-pro-specification\"\u003e\n\u003cdiv class=\"accordion-collapse-spec\"\u003e\n\u003cdiv class=\"accordion-collapse collapse show\"\u003e\n\u003cdiv class=\"accordion-body\"\u003e\n\u003cdiv class=\"row d-none d-sm-none d-md-flex d-lg-flex no-padding price-breakup\"\u003e\n\u003ch5\u003e\n\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003c\/a\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eProduct Details.\u003c\/span\u003e\u003c\/a\u003e\n\u003c\/h5\u003e\n\u003cdiv class=\"col-12 d-flex d-md-none\"\u003e\n\u003cdiv class=\"col-12 no-padding price-breakup-mobile\"\u003e\n\u003ctable class=\"table\"\u003e\n\u003ctbody\u003e\n\u003ctr\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eChuck Size\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\"\u003e\u003cspan\u003e10 to 20 mm\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003eQuantity\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd\u003e\u003cspan\u003e1 Box\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eProduct Number\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\"\u003e\u003cspan\u003egfug87865hhj6 \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003ePower\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003e1000 W\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003eVariable Speed\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eYes\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr\u003e\n\u003ctd\u003e\u003cspan\u003ePower Source\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd class=\"\"\u003e\u003cspan\u003eElectric (A.C)\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003c\/tbody\u003e\n\u003c\/table\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003csection class=\"detail-with-diamond\" id=\"stone-details\"\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\n\u003ch5\u003e\u003cbr\u003e\u003c\/h5\u003e\n\u003c\/a\u003e\n\u003cdiv class=\"content\"\u003e\u003c\/div\u003e\n\u003c\/section\u003e\n\u003c\/div\u003e\n\u003ch5\u003e\n\u003ca class=\"toggle\" href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eBasic Info\u003c\/span\u003e\u003c\/a\u003e.\u003c\/h5\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\n\u003cli\u003e\u003cspan\u003e This tool set comes with a wide collection of tools that is suitable for technicians worldwide.\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eIt is made from high-quality vanadium steel\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThe premium finish of the product will work as scratch-proof\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThis box contains 12 pieces of hex sockets\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThese tools are cold-forged to provide 4x performance and better life than other brands\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eThese are universal tools that are easy to handle for any mechanics and technicians. \u003c\/span\u003e\u003c\/li\u003e\n\u003c\/ul\u003e\n\u003ch5\u003e\u003ca href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" class=\"toggle\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eTools Specification.\u003c\/span\u003e\u003c\/a\u003e\u003c\/h5\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\n\u003cli\u003e\u003cspan class=\"dt-sc-pro-title-label\" mce-data-marked=\"1\"\u003e6 Months \u003cspan data-mce-fragment=\"1\"\u003ewarranty from the date of purchase\u003c\/span\u003e\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan class=\"dt-sc-pro-title-label\" mce-data-marked=\"1\"\u003eCorded-Electric Drill Tool Kit for professionals\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003e High efficient electronic control technology\u003c\/span\u003e\u003c\/li\u003e\n\u003cli\u003e\u003cspan\u003eVery light-weight, compact and easy to use \u003c\/span\u003e\u003c\/li\u003e\n\u003c\/ul\u003e\n\u003c\/div\u003e\n\u003chr\u003e\n\u003cdiv class=\"dt-sc-pro-specification legal\"\u003e\n\u003ch5\u003e\u003ca class=\"toggle\" href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\" data-mce-href=\"https:\/\/dt-aurum.myshopify.com\/collections\/shop01-home\/products\/plain-couple-ring\"\u003e\u003cspan\u003eProduction.\u003c\/span\u003e\u003c\/a\u003e\u003c\/h5\u003e\n\u003ctable class=\"table\" width=\"548\" height=\"226\" data-mce-fragment=\"1\"\u003e\n\u003ctbody data-mce-fragment=\"1\"\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd class=\"\" style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eCountry Of Origin\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eGermany\n \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cspan\u003e\u003cstrong\u003eGeneric Name\u003c\/strong\u003e\u003c\/span\u003e\u003c\/td\u003e\n\u003ctd style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eVanadium Tools Set\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd class=\"\" style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMaterial\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"small-case\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eVanadium Steel\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eManufacturer Name\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eShopify Themes\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eManufacturer Address\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003e1st Cross, church street, east Germany Road, Germany\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMarketers Name\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eShopify Themes creator\n\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eProduct Diversification\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eScrewdriver, plier and hex key \u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003ctr data-mce-fragment=\"1\"\u003e\n\u003ctd style=\"width: 349.688px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 349.688px;\"\u003e\u003cstrong\u003eMaterial\u003c\/strong\u003e\u003c\/td\u003e\n\u003ctd class=\"\" style=\"width: 179.312px;\" data-mce-fragment=\"1\" data-mce-style=\"width: 179.312px;\"\u003e\u003cspan\u003eC45 or CRV steel\u003c\/span\u003e\u003c\/td\u003e\n\u003c\/tr\u003e\n\u003c\/tbody\u003e\n\u003c\/table\u003e\n\u003cul class=\"dt-sc-pro-specification-details\"\u003e\u003c\/ul\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e\n\u003cdiv class=\"sr-layout-content detail-desc\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"async-rich-info\" data-mce-fragment=\"1\"\u003e\n\u003cdiv class=\"rich-text cf\" data-mce-fragment=\"1\"\u003e\u003c\/div\u003e\n\u003c\/div\u003e\n\u003c\/div\u003e"}</script>
               <script type="application/json" id="ModelJson-template--18580270383273__main">[]</script>
               <script type="application/json" id="ProductTemplate-7626489266345">{ "template": "product-template" } </script>
               <style data-shopify>/*--Full-width-meta-lable--*/
                  /*--One-half-meta-lable--*/
                  .product-description-product-template .product-deal,
                  .product-description-product-template .product-price,
                  .product-description-product-template .product-price .price-list,
                  .quickview-description .product-price,
                  .product-item-caption .product-price{ display: flex; flex-wrap: wrap; align-items: center; margin:0; }
                  .product-item-caption-white .product-template-content .product-label,
                  .product-item-caption-white .product-label,
                  .product-item-caption-white .product-template-content label { min-width: 140px; }
                  .swatch-group,  *[class*="variant-inventory-template"]{ display: flex; flex-wrap: wrap; width: calc(100% - 140px);}
                  .product-description-product-template .product-price .price-list{ width: calc(100% - 140px); }
                  @media only screen and (max-width: 1199px) {
                  }
                  .main-swiper-container.swiper-gallery-inline-slider .swiper-slide {pointer-events:none;}
                  .main-swiper-container.swiper-gallery-inline-slider .swiper-slide.swiper-slide-active {pointer-events:all;}
                  .product-single__media model-viewer { margin: 0 auto; width: auto;}
                  .main-product-template { position:relative; }
                  .main-product-template .product-detail-nav { width: 100%; display: flex; justify-content: space-between; position: fixed; top: 50%; transform: translateY(-50%);
                  left: 0; width: 100%; display: flex; justify-content: space-between; }
                  .main-product-template .product-detail-nav .nav-btn a { background-color: var(--DTBodyBGColor); box-shadow: var(--DTboxShadow_light); padding: 0.5rem; display: flex; justify-content: center;
                  min-height: 100px; position:relative; z-index:4; }
                  .main-product-template .product-detail-nav .nav-btn a:hover { background-color: var(--DTTertiaryColor); }
                  .main-product-template .product-detail-nav .nav-btn a svg { width: 1.5rem; }
                  .main-product-template .product-detail-nav .nav-btn a span { position: absolute; pointer-events: none; opacity: 0; padding: 5px 15px; transition: var(--DTBaseTransition);
                  top: 50%; word-break: normal; white-space: nowrap; margin-bottom: 0; visibility: hidden; background-color: var(--DTTertiaryColor); color: var(--DTColor_Body);
                  font-size: var(--DTFontSizeBase); transform: translateY(-50%); writing-mode: horizontal-tb; }
                  p.fake_counter_p{     margin: 15px 0 15px 0;}
                  .product-attributes p.product-label.not_color-swatch-title{ margin-bottom:10px;}
                  .main-product-template .product-detail-nav .nav-btn.prev-btn a span { left: 100%; right: auto; }
                  .main-product-template .product-detail-nav .nav-btn.next-btn a span { right: 100%; left: auto; }
                  .main-product-template .product-detail-nav .nav-btn a span:before { content: ""; position: absolute; top: 50%; transform: translateY(-50%); width: 0; height: 0; }
                  .main-product-template .product-detail-nav .nav-btn.prev-btn a span:before { right: 100%; left: auto; border-top: 7px solid transparent; border-bottom: 7px solid transparent; border-right: 7px solid var(--DTTertiaryColor); }
                  .main-product-template .product-detail-nav .nav-btn.next-btn a span:before { left: 100%; right: auto; border-top: 7px solid transparent; border-bottom: 7px solid transparent; border-left: 7px solid var(--DTTertiaryColor); }
                  .main-product-template .product-detail-nav .nav-btn a:hover span { opacity: 1; visibility: visible; }
                  .main-product-template .product-detail-nav .nav-btn.prev-btn a:hover span { left: calc(100% + 20px); }
                  .main-product-template .product-detail-nav .nav-btn.next-btn a:hover span { right: calc(100% + 20px); }
                  .main-product-template .product-detail-nav .previous-btn { writing-mode: vertical-rl; }
                  .main-product-template .product-detail-nav .next-btn { writing-mode: sideways-lr; }
                  .swatch .swatch-element.color label{ min-width: auto; width:70px; height:30px; padding:3px; border:1px solid var(--DTColor_Border); display: flex; align-items: center; justify-content: center; border-radius:0; }
                  .swatch .swatch-element.color label i{ position: absolute;    display: block;    border-radius: 50%;    background-position: center; top:  7px; bottom:  7px; left:  7px; right:  47px; border: 1px solid; border-color: var(--DTColor_Border)!important; }
                  .swatch .swatch-element.color label sub {  bottom: 0; left: 10px;}
                  .product-description-product-template .product-meta-block .sale-off { position: absolute; left: 197px; top: 57px; padding: 3px 19px 3px 8px; background: var(--DT_discount_color); color: var(--DTBodyBGColor); font-size:calc(var(--DTFontSizeBase) - 2px); }
                  .product-description-product-template .product-meta-block .sale-off:after{content:"";background:var(--DTBodyBGColor);  width: 20px; height: 24px; top: 1px; position: absolute; right: -12px; transform: rotate(45deg);}
                  /*Responsive*/
                  @media only screen and (min-width: 1200px) {
                  #shopify-section-template--18580270383273__main.main-product-template .row > div { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px; }
                  }
                  @media only screen and (max-width: 1199px) {
                  #shopify-section-template--18580270383273__main.main-product-template .row > div { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px;}
                  }
                  @media(max-width:370px) and (min-width: 320px){.product-description-product-template .product-meta-block .sale-off{top: 48px; left:170px;} }
                  @media(max-width:767px){ .product-description-product-template .product-meta-block .sale-off{  top: 52px;}}
                  #shopify-section-template--18580270383273__main.main-product-template .swiper-gallery-vert-slider.swiper-container .swiper-slide>div { background:var(--DTBodyBGColor); opacity: 1; height: 100%; object-fit: cover;}
                  .featured-tag span.badge.badge--sale {
                  position: absolute;
                  top: 2px;
                  z-index:2;
                  right: 2px;
                  background-image: url(sale.png);
                  background-repeat: no-repeat;
                  height: 104px;
                  width: 104px;
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  color: var(--DTColor_Heading);
                  font-weight: 700;text-transform: uppercase;
                  }
                  #shopify-section-template--18580270383273__main.main-product-template .swiper-button-next,
                  #shopify-section-template--18580270383273__main.main-product-template .swiper-button-prev{border-radius: var(--DTRadius);}
                  #shopify-section-template--18580270383273__main.main-product-template .swiper-container .swiper-slide img.product-item-img{height:auto;}
                  #shopify-section-template--18580270383273__main.main-product-template .swiper-slide{
                  height:auto;
                  background:var(var(--DTBodyBGColor))
                  }
                  #shopify-section-template--18580270383273__main.main-product-template .product-item-img>video{
                  position:absolute;
                  top:0;
                  left:0;
                  right:0;
                  }
               </style>
            </div>
            <div id="shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446" class="shopify-section index-section home-image-gallery">
               
               <style data-shopify>#shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-heading .dt-sc-main-heading { color: var(--DTColor_Heading); color:; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-heading .dt-sc-sub-heading { color: var(--DTColor_Heading); color:; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-heading .dt-sc-heading-description { color: var(--DTColor_Body); color:; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-heading .dt-sc-btn {
                  background: var(--DT_Button_BG_Color); background:;
                  color: var(--DT_Button_Text_Color); color:;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-heading .dt-sc-btn:hover {
                  background: var(--DT_Button_BG_Hover_Color); background:;
                  color: var(--DT_Button_Text_Hover_Color); color:;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-overlay:before  {
                  color: var(--DTTertiaryColor);
                  color: ;
                  background: currentcolor;
                  opacity: 0.5;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item {
                  display: flex;
                  flex-wrap: wrap;
                  align-items: center;
                  justify-content: center;
                  flex-direction: column;
                  text-align: center;
                  height: 450px;
                  position: relative;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay {
                  position: absolute; height: 100%; width: 100%; display: grid; align-content: center; justify-content: center; top: 0; left: 0;
                  background: rgba(244, 225, 64, 0.5); flex-direction: column; gap: 15px;
                  background: ; opacity: 0; transition:var(--DTBaseTransition);
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item:hover .image-gallery-overlay {
                  opacity: 1;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay > * {
                  color: var(--DT_Button_Text_Color); color: ;
                  font-size: var(--DTFontSizeBase); font-size: 24px;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay > * { margin: 0; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title { position: relative; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:before,
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:after {
                  content: ''; position: absolute; left: 0; bottom: 0; background-color: currentcolor; height: 2px;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:before {
                  width: 0; transition: width ease 0.4s; -webkit-transition: width ease 0.4s;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:after {
                  width: 100%; transition: all ease 0.6s; -webkit-transition: all ease 0.6s;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:hover::before {
                  width: 100%;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item .image-gallery-overlay .image-overlay-title:hover::after {
                  left: 100%; width: 0; transition: all ease 0.2s; -webkit-transition: all ease 0.2s;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .product-detail .image-bar__item img{object-fit:contain}
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item a,
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item img { height: 100%;
                  width: 100%;
                  object-fit: cover;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item svg {
                  min-width: 150px;
                  height: auto;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section {
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  flex-wrap: wrap;
                  position: relative;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .image-bar__section-inner { margin: 0; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .dt-sc-image-list-btn { position: absolute; padding: 20px 80px; border-radius: var(--DTRadius);
                  z-index: 1;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .dt-sc-image-list-btn {
                  background: var(--DT_Button_BG_Color); background-color: ;
                  color: var(--DT_Button_Text_Color); color: ; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .dt-sc-image-list-btn:hover { background: var(--DT_Button_BG_Hover_Color);
                  background-color: ;
                  color: var(--DT_Button_Text_Hover_Color); color: ; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section-inner { gap: var(--DTGutter_Width);  gap: 30px; }
                  /*  Carousel Styles */
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container { width: 100%; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container [class*="swiper-container"] { margin: 0; padding: 0; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container [class*="swiper-container"] .image-bar__section-inner { gap: 0; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-arrows > .dt-sc-btn[class*="swiper-button-"] {
                  background: var(--DT_Button_BG_Color);
                  background: ;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-arrows > .dt-sc-btn[class*="swiper-button-"]:after {
                  color: var(--DT_Button_Text_Color);
                  color: ;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-arrows > .dt-sc-btn:hover {
                  background: var(--DT_Button_BG_Hover_Color);
                  background: ;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-arrows > .dt-sc-btn:hover[class*="swiper-button-"]:after {
                  color: var(--DT_Button_Text_Hover_Color);
                  color: ;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-pagination-bullet {
                  background: var(--DTSecondaryColor);
                  background: ;
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .swiper-container .swiper-pagination-bullet.swiper-pagination-bullet-active {
                  background: var(--DTPrimaryColor);
                  background: ;
                  }
                  @media (max-width:1540px) {
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item { height: 400px; }
                  }
                  @media only screen and (min-width: 1200px) {
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-section-wrapper { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px; }
                  }
                  @media only screen and (max-width: 1199px) {
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-section-wrapper { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px;}
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item { height: 350px; }
                  }
                  @media (max-width:767px) {
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .dt-sc-image-list-btn { position: static; margin-top: 30px; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__item { height: 300px; }
                  }
                  @media only screen and (min-width: 577px) and (max-width: 767px) {
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .product-detail .image-bar__section .image-bar__section-inner { grid-template-columns: repeat(1,1fr); }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .image-bar__section .image-bar__section-inner { grid-template-columns: repeat(2,1fr); }
                  }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-swiper-slider.swiper-container { margin-bottom: 50px; }
                  #shopify-section-template--18580270383273__6622e507-978d-4926-abfe-7730deab8446.home-image-gallery .dt-sc-swiper-slider.swiper-container .swiper-pagination { bottom: -40px; }
               </style>
            </div>
            <div id="shopify-section-template--18580270383273__product-recommendations" class="shopify-section">
			   <div class="container">	
				  <div class="row">
				  <h3 class="section-header__title text-center">Dịch vụ liên quan</h3>
					<div class="dT_VProdRecommendations blog-template-content">
                              <div class="dt-sc-blog-section  dt-sc-column three-column">
								<?php $list = get_product_relate($obj_detail['nid'],$obj_detail['nid_cat_products']);
								foreach ($list as $product) { ?>
                                 <div class="dt-sc-blog-item  text-start grid-style vertical-top"
                                    >
                                    <div class="dt-sc-blog-image">
                                       <div class="article__grid-image-wrapper">   
                                          <a href="<?php echo base_url().'dich-vu/'.$product['ccode']; ?>">
                                          <img
                                             srcset="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>"
                                             src="<?php echo base_url().'upload/images_product/resize_images/'.$product['cimage_resize']?>"
                                             sizes="(min-width: 1440px) 670px, (min-width: 750px) calc(100vw - 130px), calc(100vw - 50px)"
                                             alt=""
                                             class="motion-reduce"
                                             loading="lazy"
                                             width="1230"
                                             height="685"
                                             >
                                          </a>
                                       </div>
                                    </div>
                                    <div class="dt-sc-blog-content">
                                       <div class="dt-sc-blog-meta ">
                                          <p class="dt-sc-blog-author">
                                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                                                <path d="M25 1C11.8 1 1 11.8 1 25c0 7.1 3.1 13.5 8 17.9v0l0.3 0.3c0.1 0.1 0.1 0.1 0.2 0.1 0.4 0.4 0.9 0.7 1.3 1 0.1 0.1 0.2 0.2 0.4 0.3 0.5 0.3 1 0.7 1.5 1 0.1 0.1 0.2 0.1 0.3 0.1 0.6 0.3 1.1 0.6 1.7 0.9 0 0 0 0 0 0 1.2 0.6 2.6 1.1 3.9 1.5 0 0 0.1 0 0.1 0 0.6 0.2 1.3 0.3 2 0.4 0.1 0 0.1 0 0.2 0 0.6 0.1 1.3 0.2 1.9 0.3 0.1 0 0.2 0 0.2 0C23.7 49 24.3 49 25 49s1.3 0 2-0.1c0.1 0 0.2 0 0.2 0 0.7-0.1 1.3-0.1 1.9-0.3 0.1 0 0.1 0 0.2 0 0.7-0.1 1.3-0.3 2-0.4 0 0 0.1 0 0.1 0 1.4-0.4 2.7-0.9 3.9-1.5 0 0 0 0 0 0 0.6-0.3 1.2-0.6 1.7-0.9 0.1 0 0.2-0.1 0.3-0.1 0.5-0.3 1-0.6 1.5-1 0.1-0.1 0.2-0.2 0.4-0.3 0.5-0.3 0.9-0.7 1.3-1 0.1-0.1 0.1-0.1 0.2-0.1l0.3-0.3v0c4.9-4.4 8-10.8 8-17.9C49 11.8 38.2 1 25 1zM25 25c-4.4 0-8-3.6-8-8s3.6-8 8-8 8 3.6 8 8S29.4 25 25 25zM28 27c6.1 0 11 4.9 11 11v4c0 0-0.1 0.1-0.1 0.1 -0.4 0.3-0.8 0.6-1.2 0.9 -0.1 0.1-0.2 0.1-0.3 0.2 -0.4 0.3-0.9 0.6-1.4 0.9 -0.1 0.1-0.2 0.1-0.3 0.1 -0.5 0.3-1 0.5-1.5 0.8 -0.1 0-0.1 0-0.2 0.1 -1.7 0.8-3.4 1.3-5.2 1.6 -0.1 0-0.1 0-0.2 0 -0.6 0.1-1.1 0.2-1.7 0.2 -0.1 0-0.2 0-0.2 0C26.2 47 25.6 47 25 47s-1.2 0-1.8-0.1c-0.1 0-0.2 0-0.2 0 -0.6-0.1-1.1-0.1-1.7-0.2 -0.1 0-0.1 0-0.2 0 -1.8-0.3-3.6-0.9-5.2-1.6 -0.1 0-0.1 0-0.2-0.1 -0.5-0.2-1-0.5-1.5-0.8 -0.1 0-0.2-0.1-0.3-0.1 -0.5-0.3-0.9-0.6-1.4-0.9 -0.1-0.1-0.2-0.1-0.3-0.2 -0.4-0.3-0.8-0.6-1.2-0.9 0 0-0.1-0.1-0.1-0.1V38c0-6.1 4.9-11 11-11H28zM41 40.1V38c0-6.3-4.5-11.5-10.4-12.7C33.3 23.5 35 20.4 35 17c0-5.5-4.5-10-10-10s-10 4.5-10 10c0 3.4 1.7 6.5 4.4 8.3C13.5 26.5 9 31.7 9 38v2.1C5.3 36.1 3 30.8 3 25 3 12.9 12.9 3 25 3s22 9.9 22 22C47 30.8 44.7 36.1 41 40.1z"/>
                                             </svg>
                                             <span>by Admin</span>
                                          </p>
                                          <p class="dt-sc-blog-date">
                                             <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                                <g>
                                                   <g>
                                                      <path d="M500.364,221.091c-6.982,0-11.636,4.655-11.636,11.636v46.545v69.818v11.636c0,12.8-10.473,23.273-23.273,23.273h-23.273
                                                         c-19.782,0-34.909,15.127-34.909,34.909v23.273c0,12.8-10.473,23.273-23.273,23.273h-58.182H34.909
                                                         c-6.982,0-11.636-4.655-11.636-11.636V232.727c0-6.982-4.655-11.636-11.636-11.636S0,225.745,0,232.727v221.091
                                                         c0,19.782,15.127,34.909,34.909,34.909h290.909H384h15.127c15.127,0,30.255-5.818,40.727-17.455l54.691-54.691
                                                         c10.473-10.473,17.455-25.6,17.455-40.727v-15.127v-11.636v-69.818v-46.545C512,225.745,507.345,221.091,500.364,221.091z
                                                         M429.382,450.327c0-2.327,1.164-4.655,1.164-8.145v-23.273c0-6.982,4.655-11.636,11.636-11.636h23.273
                                                         c2.327,0,4.655,0,8.145-1.164L429.382,450.327z"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <path d="M477.091,58.182h-81.455V34.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v23.273H139.636V34.909
                                                         c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v23.273H34.909C15.127,58.182,0,73.309,0,93.091v93.091
                                                         c0,6.982,4.655,11.636,11.636,11.636h488.727c6.982,0,11.636-4.655,11.636-11.636V93.091
                                                         C512,73.309,496.873,58.182,477.091,58.182z M488.727,174.545H23.273V93.091c0-6.982,4.655-11.636,11.636-11.636h81.455v26.764
                                                         c-6.982,3.491-11.636,11.636-11.636,19.782c0,12.8,10.473,23.273,23.273,23.273S151.273,140.8,151.273,128
                                                         c0-8.145-4.655-16.291-11.636-19.782V81.455h232.727v26.764c-6.982,3.491-11.636,11.636-11.636,19.782
                                                         c0,12.8,10.473,23.273,23.273,23.273S407.273,140.8,407.273,128c0-8.145-4.655-16.291-11.636-19.782V81.455h81.455
                                                         c6.982,0,11.636,4.655,11.636,11.636V174.545z"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="209.455" cy="267.636" r="23.273"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="302.545" cy="267.636" r="23.273"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="395.636" cy="267.636" r="23.273"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="116.364" cy="372.364" r="23.273"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="209.455" cy="372.364" r="23.273"/>
                                                   </g>
                                                </g>
                                                <g>
                                                   <g>
                                                      <circle cx="302.545" cy="372.364" r="23.273"/>
                                                   </g>
                                                </g>
                                             </svg>
                                             <time datetime="2022-10-13T04:24:12Z"><?php echo $product['ddate01']; ?></time>
                                          </p>
                                          
                                       </div>
                                       <h5 class="dt-sc-blog-title"><a href="#"><?php echo $product['cproducts']; ?></a></h5>
                                       <div class="dt-sc-blog-description"><?php echo strip_tags($product['cdescription']); ?></div>
                                       <a href="#" class="dt-sc-btn">Xem thêm</a> 
                                    </div>
                                 </div>
                                 <?php } ?>
							  </div>
                              
                           </div>
                           
					
				  </div>
			   </div>
			   <style>
				  .dT_VProdRecommendations{ margin-top:40px;}
				  @media only screen and (min-width: 1200px) { #shopify-section-template--18580270383273__product-recommendations { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px; } }
				  @media only screen and (max-width: 1199px) { #shopify-section-template--18580270383273__product-recommendations { margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px;} }
			   </style>
			</div> 
            <script src="//dt-multispare.myshopify.com/cdn/shop/t/6/assets/jquery.tmpl.min.js?v=32513529418586026101745066302" type="text/javascript"></script>
            <script src="//dt-multispare.myshopify.com/cdn/shop/t/6/assets/jquery.products.min.js?v=24665545266736317551745066302" type="text/javascript"></script>
            <div id="recently-viewed-products" class="recently-viewed-products clearfix" style="display:none">
               <p id="recently">Recently viewed!</p>
            </div>
            <script id="recently-viewed-product-template"  type="text/x-jquery-tmpl">
               <div id="product-${handle}" class="product">
                 <div class="image"> <a href="${url}"> <img src="${Shopify.Products.resizeImage(featured_image, "medium")}" /> </a> </div>
                 <div class="details">
                   <a href="${url}">
                     <span class="title">${title}</span>
                     <span class="price">{{if price_varies}}{{/if}}${Shopify.formatMoney(price)}</span>
                 </a>
                 </div>
                  <form action="/cart/add" method="post" class="variants" id="product-actions-${id}" enctype="multipart/form-data" style="padding:0px;">    
                           {{if !available}} 
                           <input class="btn add-to-cart-btn" type="submit"  value="Unavailable" disabled="disabled"/>
                           {{else variants.length > 1 }}
                           <input class="btn" type="button" onclick="window.location.href='${url}'"  value="Select Options"/>
                           {{else}}
                           <input type="hidden" name="id" value="${variants[0].id}" />      
                           <input class="btn add-to-cart-btn" type="submit"  value="Add to Cart"/>
                           {{/if}}
                 </form>
                 </div>
               
            </script>
            <script> 
               Shopify.Products.showRecentlyViewed( { howManyToShow:3 } );  
               
               $(document).ready(function(){
                 $("#recently").click(function(){
                   $("#recently-viewed-products .product").slideToggle(750);
                 });
               });
            </script>
            <style>  
               #recently { position: relative; line-height: normal; display: flex; align-items: center; width: 100%; justify-content: center; }
               #recently:after{ content: "\f0dd"; font-family: FontAwesome; display: block; line-height: normal; margin-left: 10px; transform: translateY(-3px);
               -webkit-transform: translateY(-3px); font-size: 16px; }
               .recently-viewed-products { position: fixed; cursor: pointer; right: 15px; width: 200px; top: 50%; text-align: center; z-index: 3; padding: 15px; box-shadow: var(--DTboxShadow);
               background-color: var(--DTBodyBGColor); box-shadow: var(--DTboxShadow_light); display: flex; flex-wrap: wrap; justify-content: space-evenly; 
               transition: all cubic-bezier(.47,1.21,.47,1.21) .3s; -webkit-transition: all cubic-bezier(.47,1.21,.47,1.21) .3s; }
               .product-attributes .swatch-group{ padding-left:20px;}
               .recently-viewed-products .product { line-height: normal; font-size: 16px; margin-top: 10px; width: 30%; display: none; }
               .recently-viewed-products .product form { display:none; }
               .recently-viewed-products .product .details { padding-top: 15px; margin-bottom: -15px; }
               .recently-viewed-products .product .details > a { position: absolute; opacity: 0; visibility: hidden; left: auto; width: 100%; top: 100%; bottom: auto; padding: 15px;
               transition: all cubic-bezier(.47,1.21,.47,1.21) .3s; -webkit-transition: all cubic-bezier(.47,1.21,.47,1.21) .3s; display: flex; justify-content: center; flex-wrap: wrap; align-items: center;  background-color: var(--DTTertiaryColor);
               left: -10px; box-shadow: var(--DTboxShadow_light); }
               .recently-viewed-products .product .details > a span.price { font-size: 75%; margin-top: 5px; display: block; width: 100%; font-weight: bold; }
               .recently-viewed-products .product .image { margin:0; position: relative; width: 100%; padding-bottom: 100%; }
               .recently-viewed-products .product .image > a { transition: var(--DTBaseTransition); -webkit-transition: var(--DTBaseTransition); width: 100%; height: auto; box-shadow: 0 0 0 2px transparent inset; display: inline-block; position: absolute; left: 0; top: 0; padding-bottom: 100%; }
               .recently-viewed-products .product .image > a img { z-index: -1; object-fit: cover; width: 100%; position: absolute; height: 100%;  left: 0; object-position: center; }
               .recently-viewed-products .product:hover .image > a { box-shadow: 0 0 0 2px var(--DTPrimaryColor) inset; }
               .recently-viewed-products:hover{ background-color: var(--DTBodyBGColor); }
               .recently-viewed-products .product:hover .details > a { left: 0; opacity:1; visibility: visible; }
            </style>
         </div>
         <div class="clearfix"></div>         	 
<?php 
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>
