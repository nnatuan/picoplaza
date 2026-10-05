<!--start menu-->
<script type='text/javascript' src='jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(). 'css/flexslider.css'; ?>"/>
<script type="text/javascript" src="<?php echo base_url(). 'js/jquery.flexslider.js'; ?>"></script>
<style>
		.flexslider ol, .flexslider ul, .flexslider li {
			margin: 0;
			padding: 0;
		}
		ol.flex-control-nav {
			display: none;
		}
		.flexslider {
			float: none;
		}
		
		.flexslider .slides > li:first-child {display: block; -webkit-backface-visibility: visible;} 
	</style>
	
      <div class="container">
         <div class="row">
            <div class="box-menu-top ">
               <div class="wrapper-first box-nav-cate-home clearfix" id="box-nav-cate-home">
                  <div class="col-left">
                     <div class="box-menu-cate">
                        <ul class="list-items-menu nav-cate-home active" id="nav-cate-home">
                           <?php 
								$list = get_group_product_all();
								foreach($list as $data){
								?>
						   <li class="item-menu">
                              <a href="<?php echo base_url().'san-pham/'.$data['ccode']; ?>" class=" link">
                              <span class="fal fa-tv"></span>
                              <?php echo $data['cname']; ?></a>
                           </li>
                           <?php } ?>
						</ul>
                     </div>
                  </div>
                  <div class="col-right">
						 <div class="flexslider">
						   <ul class="slides">
							  <?php 
								 $obj_data= get_banner_list();
								 foreach($obj_data as $data){
								 ?>
							  <li class="tmhomeslider-container">
								 <a href="<?php echo $data['cbanner_images']?>">
								 <img src="<?php echo base_url().'upload/banner/'.$data['cimage'] ?>" />
								 </a>
							  </li>
							  <?php }?>						 
						   </ul>
						</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--end menu-->
<script type="text/javascript">
   $(window).load(function() {
   	  $('.flexslider').flexslider({
   		pauseOnHover: true,
   		slideshowSpeed: 2000,
		//controlNav: false, //tat nut tron
		//animation: "slide" //che do chuyen slide
   	  });
   	});
   //writeBookmarkLink('http://prestashop-demos.org/PRS07/PRS070151/en/', 'Demo Store', 'bookmark');
</script>	  