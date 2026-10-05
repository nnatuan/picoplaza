<footer>
  <div class="wrap">
    <div class="foot-grid">
      
      <!-- CỘT 1: THÔNG TIN THƯƠNG HIỆU & GIỚI THIỆU + LIÊN HỆ -->
      <div class="foot-brand">
        <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'upload/fb/'.get_logo(); ?>" /></a></div>
        <p><?php echo strip_tags(get_module_note(14)); ?></p>
        
        <!-- THÔNG TIN LIÊN HỆ -->
        <ul class="foot-contact-info">
          <li><i class="fa-solid fa-location-dot"></i> <?php echo get_value_by_config(20); ?></li>
          <li><i class="fa-solid fa-headset"></i> <?php echo strip_tags(get_module_note(7)); ?></li>
          <li class="mono"><i class="fa-solid fa-phone"></i> <?php echo get_value_by_config(12); ?> <span>|</span> <?php echo get_value_by_config(14); ?></li>
          <li class="mono"><i class="fa-solid fa-envelope"></i> <?php echo get_value_by_config(1); ?></li>
        </ul>
      </div>

      <!-- CỘT 2: ĐỔ MENU LIÊN KẾT NHANH ĐỘNG TỪ BẢNG TMENU -->
      <div>
        <h5>Liên kết nhanh</h5>
        <ul>
          <?php 
            $foot_menus = get_frontend_menu();
            if (!empty($foot_menus)):
                foreach ($foot_menus as $menu_item):
                    $foot_url = $menu_item['clink'];
                    if (!empty($foot_url) && !preg_match("~^(?:f|ht)tps?://~i", $foot_url)) {
                        $foot_url = base_url() . ltrim($foot_url, '/');
                    } else if (empty($foot_url)) {
                        $foot_url = base_url();
                    }
          ?>
                    <li><a href="<?php echo $foot_url; ?>"><?php echo htmlspecialchars($menu_item['ctitle']); ?></a></li>
          <?php 
                endforeach;
            else: 
          ?>
                <li><a href="<?php echo base_url(); ?>">Trang chủ</a></li>
                <li><a href="<?php echo base_url(); ?>about">Giới thiệu</a></li>
                <li><a href="<?php echo base_url(); ?>posts">Bất động sản</a></li>
                <li><a href="<?php echo base_url(); ?>news">Tin tức</a></li>
                <li><a href="<?php echo base_url(); ?>gallery">Gallery</a></li>
                <li><a href="<?php echo base_url(); ?>portal">Cổng khách hàng</a></li>
                <li><a href="<?php echo base_url(); ?>files">Mẫu biểu</a></li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- CỘT 3: IFRAME GOOGLE MAPS ĐỊA CHỈ -->
      <div class="foot-maps-col">
        <h5>Địa chỉ dẫn đường Google Map</h5>
        <div class="foot-map-embed">
          <?php echo get_value_by_config(22); 
		  /*
		  <iframe 
            src="https://www.google.com/maps?q=Tầng+3,+Tòa+nhà+Xuân+Thủy,+số+173,+đường+Xuân+Thủy,+Phường+Cầu+Giấy,+Thành+phố+Hà+Nội,+Việt+Nam&output=embed" 
            width="100%" 
            height="190" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
		  */ ?>
        </div>
      </div>

    </div>

    <div class="bottom-bar">
      <div>© 2026 PICO Saigon. Bảo lưu mọi quyền.</div>
	  <?php /*
      <div class="socials">
        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" aria-label="Zalo"><i class="fa-solid fa-comment-dots"></i></a>
        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
      </div>
	  */ ?>
    </div>
  </div>
</footer>

<!-- POPUP LIGHTBOX ALBUM CÓ PREV NEXT -->
<div id="customLightbox" class="custom-lightbox-modal" onclick="closeLightbox(event)">
    <span class="lightbox-close-btn" onclick="forceCloseLightbox()">&times;</span>
    
    <!-- Nút điều hướng Slide -->
    <button class="lightbox-nav-btn prev-btn" onclick="changeLightboxImage(-1)">
        <i class="fa-solid fa-chevron-left"></i>
    </button>
    <button class="lightbox-nav-btn next-btn" onclick="changeLightboxImage(1)">
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    <div class="lightbox-content-wrap">
        <img id="lightboxTargetImg" src="" alt="Gallery Image">
        <div class="lightbox-info-bar">
            <span id="lightboxTargetCaption"></span>
            <span id="lightboxCounter" class="lightbox-counter"></span>
        </div>
    </div>
</div>

<!-- NÚT CHAT ZALO VÀ NÚT SCROLL TO TOP -->
<div class="fab-wrapper">
    <input id="fabCheckbox" type="checkbox" class="fab-checkbox">
    <label class="fab" for="fabCheckbox">
        <i class="icon-cps-fab-menu"></i>
    </label>
    <div class="fab-wheel">

    <?php 
      $item= get_config_by_id(15);
      if($item['nstatus']==1){
    ?>
		<a class="fab-action fab-action-1" href="<?php echo $item['cvalue']; ?>">
            <span class="fab-title"><?php echo $item['cname']; ?></span>
            <div class="fab-button fab-button-4"><i class="icon-cps-chat-zalo"></i></div>
        </a>
        <?php }?>
        <?php 
      $item= get_config_by_id(16);
      if($item['nstatus']==1){
    ?>
        <a class="fab-action fab-action-2" href="<?php echo $item['cvalue']; ?>">
            <span class="fab-title"><?php echo $item['cname']; ?></span>
            <div class="fab-button fab-button-4"><i class="icon-cps-chat-zalo"></i></div>
        </a>
         <?php }?>
         <?php 
      $item= get_config_by_id(17);
      if($item['nstatus']==1){
    ?>
        <a class="fab-action fab-action-3" href="<?php echo $item['cvalue']; ?>" target="_blank">
            <span class="fab-title"><?php echo $item['cname']; ?></span>
            <div class="fab-button fab-button-4"><i class="icon-cps-chat-zalo"></i></div>
        </a>
        <?php }?>
         <?php 
      $item= get_config_by_id(19);
      if($item['nstatus']==1){
    ?>
        <a class="fab-action fab-action-4" href="<?php echo $item['cvalue']; ?>" target="_blank">
            <span class="fab-title"><?php echo $item['cname']; ?></span>
            <div class="fab-button fab-button-4"><i class="icon-cps-chat-zalo"></i></div>
        </a>
        <?php }?>
    </div>
</div>
<div class="header-overlay-2" style="background: rgba(0, 0, 0, 0.53);"></div>

<button id="btn-scroll-top" title="Lên đầu trang" onclick="scrollToTop()">
    <i class="fa-solid fa-chevron-up"></i>
</button>
