<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<nav class="breadcrumb text-start  parallax-initiated" data-style="parallax" aria-label="breadcrumbs" style="background-position: 50% 75.3588px;">
   <div class="container">
      <div class="row">
         <h1 class="breadcrumb_title">Dịch vụ</h1>
         <a href="<?php echo base_url()?>" title="Back to the frontpage">Trang chủ</a>
         <span aria-hidden="true" class="breadcrumb__sep">/</span>
         <span>Dịch vụ</span>
      </div>
   </div>
</nav>   
<div class="clearfix"></div>
         <div class="shifter-page is-moved-by-drawer" id="container">
            <!-- content for layout -->
            <div id="shopify-section-template--18580269301929__main" class="shopify-section index-section home-blog-section">
               <div class="dt-sc-section-wrapper"  >
                  <div class="container-fluid spacing_enabled" data-section-id="template--18580269301929__main" data-section-type="main-blog-template">
                     <div class="row">
                        
                           <div class="blog-template-content">
                              <div class="dt-sc-blog-section  dt-sc-column three-column">
								<?php $list = get_product_page_by_cat($ccode_cat, $nrow_per_page, $ncurr_page);
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
               </div>
               <style data-shopify>.dt-sc-blog-section .dt-sc-blog-item .dt-sc-blog-image[class*="with-overlay-normal"]:before {     
                  color: var(--DTTertiaryColor);
                  color: ;
                  background: currentcolor;  }
                  .dt-sc-blog-section .dt-sc-blog-item .dt-sc-blog-image[class*="with-overlay-gradient"]:before {
                  background-image: linear-gradient(180deg, rgba(238, 238, 238, 0), 
                  #eeeeee);
                  background-image: linear-gradient(180deg, , 
                  ); 
                  }
                  .dt-sc-blog-section .dt-sc-blog-item:hover .dt-sc-blog-image[class*="with-overlay-normal"]:before,
                  .dt-sc-blog-section .dt-sc-blog-item:hover .dt-sc-blog-image[class*="with-overlay-gradient"]:before { opacity: 0; }
                  .dt-sc-blog-section .dt-sc-blog-item .dt-sc-blog-meta.with-meta-icons p[class*="dt-sc-blog-"] svg,
                  .dt-sc-blog-section .dt-sc-blog-item .dt-sc-blog-item.with-meta-icons .dt-sc-blog-content .dt-sc-blog-meta p[class*="dt-sc-blog-"] svg { display: none; }
                  .dt-sc-blog-section .dt-sc-blog-item {  box-shadow: var(--DTboxShadow);   }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style { box-shadow: none; overflow: visible; }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style .dt-sc-blog-content { box-shadow: var(--DTboxShadow); }  
                  .dt-sc-blog-section .dt-sc-blog-item.list-style { box-shadow: var(--DTboxShadow); overflow: hidden; }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style .dt-sc-blog-content { box-shadow: none; }  
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item { background: none; border-radius: 0; }  
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item .dt-sc-blog-content { background: var(--DT_Blog_BG_Color); border-radius: var(--DT_Blog_Border_Radius); }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item .dt-sc-blog-image img { border-radius: var(--DT_Blog_Border_Radius); }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style { flex-wrap: wrap; }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.overlay-style { padding: 20px; }
                  @media (min-width: 1541px) {
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-image { width: 50%; }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-content { width: 50%; }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-image {
                  width: calc(50% - (calc(30px)/2));
                  }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-content {
                  width: calc(50% - (calc(30px)/2));
                  }
                  }
                  @media (max-width: 1540px) {
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-image { width: 40%; }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-content { width: 60% }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-image { 
                  width: calc(40% - (calc(30px)/2));
                  }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-content { 
                  width: calc(60% - (calc(30px)/2));
                  }
                  }
                  @media (min-width: 1200px) { 
                  .home-blog-section .dt-sc-section-wrapper{ margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px; }
                  }
                  @media only screen and (max-width: 1199px) {
                  .home-blog-section .dt-sc-section-wrapper{ margin-top:0px; margin-bottom:0px;padding-top:0px; padding-bottom:0px;}
                  }
                  @media (max-width: 767px) {
                  .dt-sc-blog-section .dt-sc-blog-item.list-style { flex-wrap: wrap; }
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-image  { 
                  margin-bottom: 30px;
                  }
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-image,
                  .dt-sc-blog-section .dt-sc-blog-item.list-style > .dt-sc-blog-content,
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-image,
                  .dt-sc-blog-section.style-2 .dt-sc-blog-item.list-style > .dt-sc-blog-content { 
                  width: 100%;
                  }
                  }
               </style>
            </div>
            <!-- content for layout -->   
         </div>
         <div class="clearfix"></div>
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>