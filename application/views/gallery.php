<?php 
   $this->load->view('header');
   $this->load->view('header_end'); 
   $this->load->view('modules/mod_header');
?>
<main class="page-container">
  <div class="wrap">
	<?php echo get_module_note(16); 
	/*
    <div class="section-head">
      <div>
        <div class="eyebrow">Không gian thực tế</div>
        <h2>Thư viện ảnh dự án</h2>
      </div>
    </div>
	*/ ?>
	
    <!-- MASONRY MÃNG LƯỚI PHA TRỘN TỰ NHIÊN -->
    <div class="masonry-gallery-grid">
        <?php 
            foreach($list as $key => $row) {
                $img_caption = 'Hình ảnh dự án PICO';
                if (!empty($row['ctitle'])) {
                    $img_caption = $row['ctitle'];
                }

                $json_sub_images = htmlspecialchars(json_encode($row['sub_images']), ENT_QUOTES, 'UTF-8');
                $main_thumb_url  = base_url() . 'upload/gallery/' . $row['cimage'];
        ?>
            <div class="masonry-item" 
                 data-caption="<?php echo htmlspecialchars($img_caption); ?>"
                 data-images='<?php echo $json_sub_images; ?>'
                 data-bg="<?php echo $main_thumb_url; ?>"
                 onclick="openGalleryLightbox(this)">
                
                <div class="masonry-thumb-wrap">
                    <img src="<?php echo $main_thumb_url; ?>" alt="<?php echo htmlspecialchars($img_caption); ?>" class="masonry-img" loading="lazy" />
                    <div class="masonry-overlay">
                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                        <span><?php echo $img_caption; ?></span>
                    </div>
                </div>

            </div>
        <?php } ?>
    </div>

  </div>
</main>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>