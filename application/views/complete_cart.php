<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<header class="page-header" style="--primary-color:var(--light-color);--secondary-color:var(--accent-color); ;background-image:url('<?php $m = get_module_byid(1); echo base_url().'upload/images_module/'.$m['cimage']; ?>');">
            <div class="page-header-inner">
               <div class="entry-meta entry-super-meta"></div>
               <!-- .entry-super-meta -->
               <h2 class="page-title">Hoàn tất đặt hàng</h2>
               <div class="entry-meta entry-sub-meta"></div>
               <!-- .entry-sub-meta -->		
            </div>
            <!-- .page-header-inner -->
         </header>   
<div id="content" class="site-content">
            <main id="primary" class="site-main">
               <article id="post-1062" class="post-1062 post type-post status-publish format-standard has-post-thumbnail hentry category-diy category-guides tag-cleaning tag-services tag-tips-tricks">
                  <div class="entry-content">
                     <div class="entry-content-inner">
                        <div class="bt_bb_wrapper" data-templates-time="">
							<p>Đơn hàng của Quý khách đã được đặt thành công, chúng tôi sẽ sớm liên hệ với bạn.<br>Chân thành cảm ơn Quý khách đã tin tưởng và sử dụng dịch vụ.</p>
                        </div>
                        <span id="bt_bb_fe_preview_toggler" class="bt_bb_fe_preview_toggler" title="Edit/Preview"></span>		
                     </div>
                     <!-- .entry-content-inner -->
                  </div>
               </article>
           
            </main>

         </div>
         <!-- .site-content -->	  
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>