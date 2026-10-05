<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   if($nid!="")
		$obj_content = Bget_article($nid);
	else
		$obj_content = get_article_by_code($ccode);
   ?>   
<div class="bt-blog-header-content">
            <section data-bb-version="5.4.2" id="bt_bb_section699d6778da45b" class="bt_bb_section bt_bb_color_scheme_7 bt_bb_layout_boxed_1800_limit bt_bb_vertical_align_top bt_bb_background_overlay_alternate_left_gradient bt_bb_top_spacing_large bt_bb_bottom_spacing_large bt_bb_negative_margin_none bt_bb_shape_soft-medium-rounded bt_bb_top_left_shape bt_bb_top_right_shape bt_bb_bottom_left_shape bt_bb_bottom_right_shape" style="; --section-primary-color:var(--light-color); --section-secondary-color:var(--alternate-color);" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_large&quot;,&quot;def&quot;:&quot;large&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_large&quot;,&quot;def&quot;:&quot;large&quot;},&quot;bt_bb_negative_margin_&quot;:{&quot;current_class&quot;:&quot;bt_bb_negative_margin_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
               <div class="bt_bb_background_image_holder_wrapper">
                  <div class="bt_bb_background_image_holder bt_bb_parallax"  data-parallax="0.6" data-parallax-offset="0" data-parallax-zoom-start="1" data-parallax-zoom-end="1" data-parallax-blur-start="0" data-parallax-blur-end="0" data-parallax-opacity-start="1" data-parallax-opacity-end="1" style=" background-image:url('<?php $m = get_module_byid(1); echo base_url().'upload/images_module/'.$m['cimage']; ?>');"></div>
               </div>
               <div class="bt_bb_port">
                  <div class="bt_bb_cell">
                     <div class="bt_bb_cell_inner">
                        <div data-bb-version="5.4.2" class="bt_bb_row bt_bb_row_width_boxed_1200 bt_bb_row_width_boxed "  data-bt-override-class="{&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                           <div class="bt_bb_row_holder" >
                              <div data-bb-version="5.4.2"  class="bt_bb_column col-xxl-6 col-xl-6 col-xs-12 col-sm-12 col-md-12 col-lg-6 bt_bb_vertical_align_middle bt_bb_align_left bt_bb_padding_none bt_bb_animation_fade_in animate" style="; --column-width:6;" data-width="6" data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_left&quot;,&quot;def&quot;:&quot;left&quot;},&quot;bt_bb_padding_&quot;:{&quot;current_class&quot;:&quot;bt_bb_padding_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_fade_in animate&quot;,&quot;def&quot;:&quot;fade_in animate&quot;}}">
                                 <div class="bt_bb_column_content">
                                    <div class="bt_bb_column_content_inner">
                                       <div data-bb-version="5.4.3" class="bt_bb_separator_v2 bt_bb_border_style_none bt_bb_color_scheme_27 bt_bb_top_spacing_normal bt_bb_bottom_spacing_medium bt_bb_border_thickness_1 bt_bb_icon_size_normal bt_bb_text_size_normal bt_bb_separator_v2_without_content" style="; --primary-color:#fff; --secondary-color:#000;" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_medium&quot;,&quot;def&quot;:&quot;medium&quot;},&quot;bt_bb_border_thickness_&quot;:{&quot;current_class&quot;:&quot;bt_bb_border_thickness_1&quot;,&quot;def&quot;:&quot;1&quot;},&quot;bt_bb_icon_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_icon_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_text_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_text_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <div class="bt_bb_separator_v2_inner"><span class="bt_bb_separator_v2_inner_before"></span><span class="bt_bb_separator_v2_inner_content"><span  data-ico-="" class="bt_bb_icon_holder"></span></span><span class="bt_bb_separator_v2_inner_after"></span></div>
                                       </div>
                                       <header data-bb-version="5.4.3" class="bt_bb_headline bt_bb_dash_none bt_bb_size_huge bt_bb_align_inherit" data-bt-override-class="{&quot;bt_bb_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_size_huge&quot;,&quot;def&quot;:&quot;huge&quot;},&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_inherit&quot;,&quot;def&quot;:&quot;inherit&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <h1 class="bt_bb_headline_tag"><span class="bt_bb_headline_content"><span><?php echo $title; ?></span></span></h1>
                                       </header>
                                       <div data-bb-version="5.4.2" class="bt_bb_separator_v2 bt_bb_border_style_none bt_bb_color_scheme_27 bt_bb_top_spacing_none bt_bb_bottom_spacing_medium bt_bb_border_thickness_1 bt_bb_icon_size_normal bt_bb_text_size_normal bt_bb_separator_v2_without_content" style="; --primary-color:#fff; --secondary-color:#000;" data-bt-override-class="{&quot;bt_bb_top_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_top_spacing_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_bottom_spacing_&quot;:{&quot;current_class&quot;:&quot;bt_bb_bottom_spacing_medium&quot;,&quot;def&quot;:&quot;medium&quot;},&quot;bt_bb_border_thickness_&quot;:{&quot;current_class&quot;:&quot;bt_bb_border_thickness_1&quot;,&quot;def&quot;:&quot;1&quot;},&quot;bt_bb_icon_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_icon_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_text_size_&quot;:{&quot;current_class&quot;:&quot;bt_bb_text_size_normal&quot;,&quot;def&quot;:&quot;normal&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                          <div class="bt_bb_separator_v2_inner"><span class="bt_bb_separator_v2_inner_before"></span><span class="bt_bb_separator_v2_inner_content"><span  data-ico-="" class="bt_bb_icon_holder"></span></span><span class="bt_bb_separator_v2_inner_after"></span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div data-bb-version="5.4.2"  class="bt_bb_column col-xxl-6 col-xl-6 col-xs-12 col-sm-12 col-md-12 col-lg-6 bt_bb_vertical_align_top bt_bb_align_left bt_bb_padding_none" style="; --column-width:6;" data-width="6" data-bt-override-class="{&quot;bt_bb_align_&quot;:{&quot;current_class&quot;:&quot;bt_bb_align_left&quot;,&quot;def&quot;:&quot;left&quot;},&quot;bt_bb_padding_&quot;:{&quot;current_class&quot;:&quot;bt_bb_padding_none&quot;,&quot;def&quot;:&quot;none&quot;},&quot;bt_bb_animation_&quot;:{&quot;current_class&quot;:&quot;bt_bb_animation_no_animation&quot;,&quot;def&quot;:&quot;no_animation&quot;}}">
                                 <div class="bt_bb_column_content">
                                    <div class="bt_bb_column_content_inner"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- cell_inner -->
                  </div>
                  <!-- cell -->
               </div>
               <!-- port -->
            </section>
         </div>
         <div id="content" class="site-content">
            <main id="primary" class="site-main">
               <?php echo $obj_content['ccontent']; ?>
            </main>
         </div>
         <!-- .site-content --> 
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
   ?>