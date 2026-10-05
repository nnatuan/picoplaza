<header>
	<?php echo get_module_note(6); ?>
  
  <div class="nav">
    <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'upload/fb/'.get_logo(); ?>" /></a></div>
	
    <ul class="nav-links">
      <?php 
        $current_uri     = trim(uri_string(), '/');
        $current_segment = $this->uri->segment(1);
        if (empty($current_segment)) {
            $current_segment = 'home';
        }

        $frontend_menus = get_frontend_menu();
        if (!empty($frontend_menus)):
            foreach ($frontend_menus as $menu_item):
                // Xử lý link: Nếu clink chưa có http/https và không rỗng thì nối với base_url()
                $menu_url = $menu_item['clink'];
                if (!empty($menu_url) && !preg_match("~^(?:f|ht)tps?://~i", $menu_url)) {
                    $menu_url = base_url() . ltrim($menu_url, '/');
                } else if (empty($menu_url)) {
                    $menu_url = base_url();
                }

                // Nhận diện trạng thái active
                $raw_link     = trim($menu_item['clink'], '/');
                $clean_link   = preg_replace('~^https?://[^/]+/~i', '', $raw_link);
                $clean_link   = trim(str_replace(array(base_url(), 'index.php'), '', $clean_link), '/');
                $menu_segment = !empty($clean_link) ? explode('/', $clean_link)[0] : '';

                $is_active = false;
                if (empty($clean_link) || $clean_link == 'home') {
                    $is_active = ($current_segment == 'home' || empty($current_uri));
                } else {
                    $is_active = ($current_segment == $menu_segment) || ($current_uri == $clean_link) || (strpos($current_uri, $clean_link) === 0);
                }

                // Không hiển thị doc_portal trên thanh menu chính bên ngoài (chỉ nằm trong menu profile của khách đã đăng nhập)
                if ($clean_link == 'doc_portal' || $menu_segment == 'doc_portal') {
                    continue;
                }
      ?>
                <li class="<?php echo $is_active ? 'active' : ''; ?>">
                    <a href="<?php echo $menu_url; ?>" class="<?php echo $is_active ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($menu_item['ctitle']); ?>
                    </a>
                </li>
      <?php 
            endforeach;
        else: 
      ?>
            <!-- Fallback danh sách mặc định nếu chưa cấu hình DB -->
            <li class="<?php echo ($current_segment == 'home' || empty($current_uri)) ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>" class="<?php echo ($current_segment == 'home' || empty($current_uri)) ? 'active' : ''; ?>">Trang chủ</a></li>
            <li class="<?php echo ($current_segment == 'about') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>about" class="<?php echo ($current_segment == 'about') ? 'active' : ''; ?>">Giới thiệu</a></li>            
            <li class="<?php echo ($current_segment == 'news') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>news" class="<?php echo ($current_segment == 'news') ? 'active' : ''; ?>">Tin tức</a></li>
            <li class="<?php echo ($current_segment == 'portal') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>portal" class="<?php echo ($current_segment == 'portal') ? 'active' : ''; ?>">Cổng hỗ trợ</a></li>
            <li class="<?php echo ($current_segment == 'files') ? 'active' : ''; ?>"><a href="<?php echo base_url(); ?>files" class="<?php echo ($current_segment == 'files') ? 'active' : ''; ?>">Mẫu biểu</a></li>
      <?php endif; ?>
    </ul>
    <div class="nav-actions">
      
      <?php if(isset($_SESSION['session_nid_member'])): ?>
        <div class="user-profile-dropdown">
          <button class="user-dropdown-btn" onclick="toggleUserMenu(event);">
            <i class="fa-regular fa-user"></i> 
            <span><?php echo $_SESSION['session_cusername']; ?></span>
            <i class="fa-solid fa-angle-down arrow-icon"></i>
          </button>
          
          <ul class="user-dropdown-menu" id="userDropdownMenu">
            <li><a href="<?php echo base_url(); ?>profile"><i class="fa-regular fa-id-card"></i> Trang cá nhân</a></li>
            <li><a href="<?php echo base_url(); ?>doc_portal"><i class="fa-solid fa-folder-tree"></i> Hồ sơ thẩm định</a></li>
			<li><a href="<?php echo base_url(); ?>my_tickets"><i class="fa-solid fa-ticket"></i> Ticket của tôi</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url(); ?>auth/logout" class="logout-link"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
          </ul>
        </div>
        <script>
        if (typeof toggleUserMenu !== 'function') {
          function toggleUserMenu(e) {
            if (e) e.stopPropagation();
            var menu = document.getElementById('userDropdownMenu');
            var btnArrow = document.querySelector('.user-dropdown-btn .arrow-icon');
            if (menu) {
              menu.classList.toggle('show');
              if (btnArrow) {
                btnArrow.style.transform = menu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
              }
            }
          }
          window.addEventListener('click', function(e) {
            var dropdown = document.querySelector('.user-profile-dropdown');
            if (dropdown && !dropdown.contains(e.target)) {
              var menu = document.getElementById('userDropdownMenu');
              var btnArrow = document.querySelector('.user-dropdown-btn .arrow-icon');
              if (menu && menu.classList.contains('show')) {
                menu.classList.remove('show');
                if (btnArrow) btnArrow.style.transform = 'rotate(0deg)';
              }
            }
          });
        }
        </script>
      <?php else: ?>
        <a href="<?php echo base_url(); ?>auth" class="btn btn-ghost-dark">Đăng nhập</a>
      <?php endif; ?>

      <a href="<?php echo base_url(); ?>post_listing" class="btn btn-gold hide">Đăng tin</a>
      <button class="menu-toggle" aria-label="Mở menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>