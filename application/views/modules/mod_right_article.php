<div class="elementor-element elementor-element-e5afb6b e-con-full e-flex e-con e-child" data-id="e5afb6b" data-element_type="container">
                  <div class="elementor-element elementor-element-971ad9e e-con-full e-flex e-con e-child" data-id="971ad9e" data-element_type="container" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                     <div class="elementor-element elementor-element-8d19818 elementor-widget elementor-widget-heading" data-id="8d19818" data-element_type="widget" data-widget_type="heading.default">
                        <div class="elementor-widget-container">
                           <h4 class="elementor-heading-title elementor-size-default">POST LATEST</h4>
                        </div>
                     </div>
                     <div class="elementor-element elementor-element-a986a76 elementor-grid-1 elementor-posts--thumbnail-left elementor-grid-tablet-2 elementor-grid-mobile-1 elementor-widget elementor-widget-posts" data-id="a986a76" data-element_type="widget" data-settings="{&quot;classic_columns&quot;:&quot;1&quot;,&quot;classic_row_gap&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:14,&quot;sizes&quot;:[]},&quot;classic_columns_tablet&quot;:&quot;2&quot;,&quot;classic_columns_mobile&quot;:&quot;1&quot;,&quot;classic_row_gap_tablet&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]},&quot;classic_row_gap_mobile&quot;:{&quot;unit&quot;:&quot;px&quot;,&quot;size&quot;:&quot;&quot;,&quot;sizes&quot;:[]}}" data-widget_type="posts.classic">
                        <div class="elementor-widget-container">
                           <div class="elementor-posts-container elementor-posts elementor-posts--skin-classic elementor-grid">
                              <?php $list = get_news_latest_by_cat(1); 
								foreach($list as $data) {
							?>
							  <article class="elementor-post elementor-grid-item post-76 post type-post status-publish format-standard has-post-thumbnail hentry category-wealth-management">
                                 <a class="elementor-post__thumbnail__link" href="#" tabindex="-1" >
                                    <div class="elementor-post__thumbnail"><img width="300" height="200" data-src="<?php echo base_url().'upload/image_article/'.$data['cimage_thumb'] ?>" class="attachment-medium size-medium wp-image-91 lazyload" alt="Businessman team analyzing financial statement finance task with calculator and laptop. Wealth" src="<?php echo base_url().'upload/image_article/'.$data['cimage_thumb'] ?>" style="--smush-placeholder-width: 300px; --smush-placeholder-aspect-ratio: 300/200;" /></div>
                                 </a>
                                 <div class="elementor-post__text">
                                    <div class="elementor-post__title">
                                       <a href="<?php echo base_url().'tin-tuc/'.$data['ccode'] ?>"><?php echo $data['ctitle']; ?></a>
                                    </div>
                                    <div class="elementor-post__meta-data">
                                       <span class="elementor-post-date"><?php echo $data['ddate01']; ?></span>
                                    </div>
                                 </div>
                              </article>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
           