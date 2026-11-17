<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>   
<main id="main" class="">
                  <div class="page-wrapper page-right-sidebar">
                     <div class="row">
                        <div id="content" class="large-9 left col col-divided" role="main">
                           <div class="page-inner">
                              <header class="entry-header">
                                 <p id="breadcrumbs"><span><span><a href="<?php echo base_url(); ?>" >Trang chủ</a> » <span class="breadcrumb_last" aria-current="page"><?php echo get_cat_name($obj_news['nid_cat_news']); ?></span></span></span></span></p>
                              </header>
							  <h1 class="entry-title mb uppercase"><?php echo $obj_news['ctitle']; ?></h1>
                              <?php echo $obj_news['ccontent']; ?>
                           </div>
                        </div>
                        <div class="large-3 col">
                           <?php $this->load->view('modules/mod_right_article'); ?>
						</div>
                     </div>
                  </div>
               </main>
               
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
   ?>