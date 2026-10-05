<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<style>
   .header-navigation>ul {
   display: none;
   }
   #column-left:hover ul{
   display: block;		
   }
   #column-left {
   position: absolute;
   z-index: 999;
   width: 230px;
   }
   .full {
   margin-top: 30px;
   }
   #column-left .box-category-heading {
   cursor: pointer;
   }
   .container.content-top .row {
	   position: relative;
   }
   .right-slideshow {
	   position: absolute;
	   right: 0;
   }
   .top1, .top2 .logo, .top2-right-top, .top2-right-bot, #column-left {
	   animation: none;
   }
</style>
<div class="container content-top">
   <div class="row">
      <?php $this->load->view('modules/mod_menu_left'); ?>
   </div>
</div>
<div class="content full">
   <div id="columns" class="contentin container">
      <?php //$this->load->view('modules/mod_content_header');?>            
      <div class="product full">
         <h1 class="h1-title">Lỗi</h1>
         <p style="text-align:center;">
			<?php 
				echo "Truy cập không hợp lệ!";
			  ?>  
         </p>
      </div>
   </div>
</div>
<?php $this->load->view('modules/mod_footer');?>
<?php $this->load->view('footer');?>