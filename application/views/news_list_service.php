<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<link rel='stylesheet' id='elementor-post-93-css' href='https://demokit.creativemox.com/capwise/wp-content/uploads/sites/9/elementor/css/post-93.css?ver=1747924150' media='all' />
<link rel='stylesheet' id='widget-posts-css' href='https://demokit.creativemox.com/capwise/wp-content/plugins/elementor-pro/assets/css/widget-posts.min.css?ver=3.28.1' media='all' />
<div data-elementor-type="archive" data-elementor-id="93" class="elementor elementor-93 elementor-location-archive" data-elementor-post-type="elementor_library">
         <div class="elementor-element elementor-element-61245ee e-flex e-con-boxed e-con e-parent" data-id="61245ee" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
            <div class="e-con-inner">
               <div class="elementor-element elementor-element-8ece534 e-con-full e-flex e-con e-child" data-id="8ece534" data-element_type="container">
                  <div class="elementor-element elementor-element-7e44e66 elementor-invisible elementor-widget elementor-widget-heading" data-id="7e44e66" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:200}" data-widget_type="heading.default">
                     <div class="elementor-widget-container">
                        <h1 class="elementor-heading-title elementor-size-default">Services</h1>
                     </div>
                  </div>
                  <div class="elementor-element elementor-element-3f6e676 elementor-invisible elementor-widget elementor-widget-heading" data-id="3f6e676" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:300}" data-widget_type="heading.default">
                     <div class="elementor-widget-container">
                        <h4 class="elementor-heading-title elementor-size-default"></h4>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="elementor-element elementor-element-da5d41e e-flex e-con-boxed e-con e-parent" data-id="da5d41e" data-element_type="container">
            <div class="e-con-inner">
               <div class="elementor-element elementor-element-441d968 elementor-grid-3 elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-posts--thumbnail-top elementor-posts__hover-gradient load-more-align-center elementor-widget elementor-widget-archive-posts" data-id="441d968" data-element_type="widget" data-settings="{&quot;archive_cards_row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:21,&quot;sizes&quot;:[]},&quot;pagination_type&quot;:&quot;load_more_on_click&quot;,&quot;archive_cards_columns&quot;:&quot;3&quot;,&quot;archive_cards_columns_tablet&quot;:&quot;2&quot;,&quot;archive_cards_columns_mobile&quot;:&quot;1&quot;,&quot;archive_cards_row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:35,&quot;sizes&quot;:[]},&quot;archive_cards_row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;load_more_spinner&quot;:{&quot;value&quot;:&quot;fas fa-spinner&quot;,&quot;library&quot;:&quot;fa-solid&quot;}}" data-widget_type="archive-posts.archive_cards">
                  <div class="elementor-widget-container">
                     <div class="elementor-posts-container elementor-posts elementor-posts--skin-cards elementor-grid">
					 <?php foreach($obj_news_list as $data) { ?>
                        <article class="elementor-post elementor-grid-item post-76 post type-post status-publish format-standard has-post-thumbnail hentry category-wealth-management">
                           <div class="elementor-post__card">
                              <a class="elementor-post__thumbnail__link" href="<?php echo base_url().'tin-tuc/'.$data['ccode'] ?>" tabindex="-1" >
                                 <div class="elementor-post__thumbnail"><img fetchpriority="high" width="1280" height="853" src="<?php echo base_url().'upload/image_article/'.$data['cimage_thumb'] ?>" class="attachment-full size-full wp-image-91" alt="" decoding="async" srcset="<?php echo base_url().'upload/image_article/'.$data['cimage_thumb'] ?>" sizes="(max-width: 1280px) 100vw, 1280px" /></div>
                              </a>

                              <div class="elementor-post__text">
                                 <div class="elementor-post__title">
                                    <a href="<?php echo base_url().'tin-tuc/'.$data['ccode'] ?>" ><?php echo $data['ctitle']; ?></a>
                                 </div>
                                 <div class="elementor-post__excerpt">
                                    <p><?php echo strip_tags($data['cshort_content']); ?></p>
                                 </div>
                              </div>
                              <div class="elementor-post__meta-data">
                                 <span class="elementor-post-date"><?php echo $data['ddate01']; ?></span>
                              </div>
                           </div>
                        </article>
                       <?php } ?> 
					 </div>
                     <span class="e-load-more-spinner">
                        <svg aria-hidden="true" class="e-font-icon-svg e-fas-spinner" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                           <path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path>
                        </svg>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
   ?>