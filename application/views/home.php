<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>

<section class="hero">
  <div class="hero-slider">
    <?php 
        $obj_data = get_banner_list();
        if(!empty($obj_data)):
            foreach($obj_data as $key => $row):
    ?>
        <div class="slide-item <?php if($key === 0) echo 'active'; ?>">
            <img src="<?php echo base_url().'upload/banner/'.$row['cimage']; ?>" alt="Pico Saigon Banner" class="banner-img" />
        </div>
    <?php 
            endforeach;
        endif; 
    ?>
  </div>

  <!-- NÚT MŨI TÊN ĐIỀU HƯỚNG TAY -->
  <?php if(!empty($obj_data) && count($obj_data) > 1): ?>
    <button type="button" class="slider-arrow arrow-left" aria-label="Slide trước" onclick="moveSlide(-1)"><i class="fa-solid fa-chevron-left"></i></button>
    <button type="button" class="slider-arrow arrow-right" aria-label="Slide kế tiếp" onclick="moveSlide(1)"><i class="fa-solid fa-chevron-right"></i></button>

    <!-- NÚT DOTS TỰ ĐỘNG THEO SỐ LƯỢNG BANNER -->
    <div class="slider-dots">
      <?php foreach($obj_data as $key => $row): ?>
        <div class="dot <?php if($key === 0) echo 'active'; ?>" onclick="setSlide(<?php echo $key; ?>)"></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

<?php echo get_article_content_by_id(1); ?>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>