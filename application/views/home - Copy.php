<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>

<section class="hero">
  <!-- DYNAMIC BACKGROUND SLIDER LAYER -->
  <div class="hero-slider">
	<?php 
		$obj_data = get_banner_list();
		// Bổ sung $key để lấy chỉ mục vòng lặp (bắt đầu từ số 0)
		foreach($obj_data as $key => $row){
	?>
		<div class="slide-item <?php if($key === 0) echo 'active'; ?>" data-bg="<?php echo base_url().'upload/banner/'.$row['cimage']; ?>"></div>
	<?php } ?>
    <div class="slide-overlay"></div>
  </div>

  <!-- SLIDER MANUAL ARROWS -->
  <button class="slider-arrow arrow-left" aria-label="Slide trước" onclick="moveSlide(-1)"><i class="fa-solid fa-chevron-left"></i></button>
  <button class="slider-arrow arrow-right" aria-label="Slide kế tiếp" onclick="moveSlide(1)"><i class="fa-solid fa-chevron-right"></i></button>

  <!-- SLIDER DOTS NAVIGATION -->
  <div class="slider-dots">
    <div class="dot active" onclick="setSlide(0)"></div>
    <div class="dot" onclick="setSlide(1)"></div>
    <div class="dot" onclick="setSlide(2)"></div>
  </div>

  <div class="hero-inner">
	  <div class="eyebrow">Nền tảng bất động sản toàn quốc</div>
	  <h1>Tìm ngôi nhà tiếp theo,<br><em>ở khắp Việt Nam.</em></h1>
	  <p class="lede">Từ Hà Nội đến Cần Thơ, xem tin đăng minh bạch, tải hồ sơ pháp lý và bản vẽ trực tiếp trên từng bất động sản, theo dõi yêu cầu hỗ trợ — tất cả trong một nền tảng.</p>

	  <form name="frm_hero_search" method="POST" action="<?php echo base_url(); ?>search">
		<div class="search-card">
		  
		  <div class="field">
			<label for="search-province">Tỉnh / Thành phố</label>
			<select id="search-province" name="cbo_nid_province">
			  <option value="0">Tất cả tỉnh, thành</option>
			  <?php 
				$provinces = get_province_all();
				foreach($provinces as $prov) { 
			  ?>
				<option value="<?php echo $prov['nid']; ?>"><?php echo $prov['ctitle']; ?></option>
			  <?php } ?>
			</select>
		  </div>
		  
		  <div class="field">
			<label for="search-cat">Loại hình</label>
			<select id="search-cat" name="cbo_nid_cat_product">
			  <option value="0">Tất cả loại hình</option>
			  <?php 
				$categories = get_cat_product_all();
				foreach($categories as $cat) {
			  ?>
				<option value="<?php echo $cat['nid']; ?>"><?php echo $cat['ctitle']; ?></option>
				<?php } ?>
			</select>
		  </div>
		  
		  <div class="field">
			<label for="search-price">Mức giá</label>
			<select id="search-price" name="cbo_price_range">
			  <option value="">Tất cả mức giá</option>
			  <option value="under_2b">Dưới 2 tỷ</option>
			  <option value="2b_5b">2 – 5 tỷ</option>
			  <option value="5b_10b">5 – 10 tỷ</option>
			  <option value="over_10b">Trên 10 tỷ</option>
			</select>
		  </div>
		  
		  <button type="submit" class="search-btn">
			<i class="fa-solid fa-magnifying-glass"></i>
			Tìm kiếm
		  </button>
		</div>
	  </form>
	</div>

  <!-- signature skyline illustration -->
  <svg class="skyline" viewBox="0 0 1440 260" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <defs>
      <linearGradient id="skyFade" x1="0" y1="0" x2="0" y2="1">
        <stop offset="0%" stop-color="#b65c38" stop-opacity="0.16"/>
        <stop offset="100%" stop-color="#b65c38" stop-opacity="0.02"/>
      </linearGradient>
    </defs>
    <g fill="none" stroke="#a9782a" stroke-opacity="0.22" stroke-width="1.2">
      <rect x="20" y="150" width="60" height="110" fill="url(#skyFade)"/>
      <rect x="95" y="120" width="40" height="140" fill="url(#skyFade)"/>
      <path d="M175 260 L175 110 Q188 80 205 65 Q222 80 235 110 L235 260 Z" fill="url(#skyFade)"/>
      <rect x="255" y="170" width="34" height="90" fill="url(#skyFade)"/>
      <rect x="300" y="140" width="50" height="120" fill="url(#skyFade)"/>
      <rect x="365" y="190" width="30" height="70" fill="url(#skyFade)"/>
      <path d="M430 260 L440 40 L452 30 L464 40 L474 260 Z" fill="url(#skyFade)"/>
      <rect x="500" y="160" width="46" height="100" fill="url(#skyFade)"/>
      <rect x="560" y="130" width="34" height="130" fill="url(#skyFade)"/>
      <rect x="610" y="185" width="60" height="75" fill="url(#skyFade)"/>
      <rect x="690" y="150" width="40" height="110" fill="url(#skyFade)"/>
      <rect x="745" y="175" width="30" height="85" fill="url(#skyFade)"/>
      <rect x="790" y="120" width="50" height="140" fill="url(#skyFade)"/>
      <rect x="855" y="195" width="70" height="65" fill="url(#skyFade)"/>
      <rect x="940" y="145" width="38" height="115" fill="url(#skyFade)"/>
      <rect x="990" y="175" width="46" height="85" fill="url(#skyFade)"/>
      <rect x="1050" y="130" width="30" height="130" fill="url(#skyFade)"/>
      <rect x="1095" y="165" width="55" height="95" fill="url(#skyFade)"/>
      <rect x="1165" y="195" width="34" height="65" fill="url(#skyFade)"/>
      <rect x="1215" y="150" width="46" height="110" fill="url(#skyFade)"/>
      <rect x="1275" y="180" width="30" height="80" fill="url(#skyFade)"/>
      <rect x="1320" y="140" width="50" height="120" fill="url(#skyFade)"/>
      <rect x="1385" y="170" width="40" height="90" fill="url(#skyFade)"/>
    </g>
  </svg>
</section>

<?php $m = get_module_byid(1); ?>
<section class="about" id="about">
  <div class="wrap about-grid">
    <div class="about-visual">
      <img src="<?php echo base_url().'upload/images_module/'.$m['cimage']; ?>" alt="About us" class="about-img">
    </div>
    <div class="about-text">
      <div class="eyebrow">Giới thiệu</div>
	  <?php echo $m['cnote'];
	  /*
      <h2>Hành trình cùng người Việt tìm nơi an cư</h2>
      <p>Thành lập từ Sài Gòn, PICO đồng hành cùng hàng nghìn gia đình và nhà đầu tư trên khắp Việt Nam tìm kiếm bất động sản phù hợp — với quy trình minh bạch, hồ sơ pháp lý rõ ràng và đội ngũ chuyên viên tận tâm ở từng khu vực.</p>
      <div class="about-stats">
        <div><div class="num mono">2018</div><div class="label">Năm thành lập</div></div>
        <div><div class="num mono">120+</div><div class="label">Chuyên viên tư vấn</div></div>
        <div><div class="num mono">5.400+</div><div class="label">Giao dịch thành công</div></div>
      </div>
      <ul class="about-values">
        <li><i class="fa-solid fa-check"></i> Minh bạch thông tin, không phát sinh chi phí ẩn</li>
        <li><i class="fa-solid fa-check"></i> Hồ sơ pháp lý được kiểm duyệt trước khi đăng tin</li>
        <li><i class="fa-solid fa-check"></i> Hỗ trợ khách hàng xuyên suốt quá trình giao dịch</li>
      </ul>
	  */ ?>
    </div>
  </div>
</section>

<section class="listings" id="listings">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="eyebrow">Đăng &amp; quản lý bất động sản</div>
        <h2>Tin đăng nổi bật</h2>
      </div>
      <p>Cập nhật từ khắp các tỉnh, thành — mỗi tin đăng đi kèm sơ đồ mặt bằng, hình ảnh thực tế và bản đồ tích hợp Google Maps.</p>
    </div>

    <div class="grid-listings">
		<?php 
			$list = get_product_hot();
			foreach($list as $row) {
				$gradients = [
					'linear-gradient(135deg,#5b7a95,#8aa5bb)',
					'linear-gradient(135deg,#a8795a,#c9a17e)',
					'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
					'linear-gradient(135deg,#9b7fa0,#c3aac6)'
				];
				$random_gradient = $gradients[array_rand($gradients)];
				
				$icon_class = 'fa-building';
				if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'nhà') !== false) $icon_class = 'fa-house';
				if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'đất') !== false) $icon_class = 'fa-mountain-sun';
				if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'shop') !== false) $icon_class = 'fa-store';
		?>
			<div class="card">
				<div class="thumb" data-gradient="<?php echo $random_gradient; ?>">
					<span class="ribbon selling">ĐANG BÁN</span>
					
					<?php if(!empty($row['cimage'])): ?>
						<img src="<?php echo base_url(); ?>upload/images_product/full_images/<?php echo $row['cimage']; ?>" alt="<?php echo $row['ctitle']; ?>">
					<?php else: ?>
						<i class="fa-solid <?php echo $icon_class; ?>"></i>
					<?php endif; ?>
				</div>
				
				<div class="card-body">
					<h3>
						<a href="<?php echo base_url(); ?>post/<?php echo $row['ccode']; ?>">
							<?php echo $row['ctitle']; ?>
						</a>
					</h3>
					
					<div class="loc-container">
						<div class="loc">
							<i class="fa-solid fa-location-dot"></i> 
							<?php echo $row['clocation_detail']; if(isset($row['ctitle_province'])) echo ', ' . $row['ctitle_province']; ?>
						</div>
						
						<?php if(!empty($row['cmaps_iframe'])): ?>
							<button type="button" class="btn-inline-maps" data-maps-raw="<?php echo htmlspecialchars($row['cmaps_iframe']); ?>">
								<i class="fa-solid fa-map-location-dot"></i> Bản đồ
							</button>
						<?php endif; ?>
					</div>
					
					<div class="specs">
						<span><i class="fa-solid fa-vector-square"></i> <?php echo $row['narea']; ?> m²</span>
						<?php if($row['nbedroom'] > 0): ?>
							<span><i class="fa-solid fa-bed"></i> <?php echo $row['nbedroom']; ?> PN</span>
						<?php endif; ?>
						<?php if($row['nbathroom'] > 0): ?>
							<span><i class="fa-solid fa-bath"></i> <?php echo $row['nbathroom']; ?> WC</span>
						<?php endif; ?>
					</div>
					
					<div class="card-footer">
						<div class="price mono"><?php echo $row['cprice_display']; ?></div>
						<a class="view-link" href="<?php echo base_url(); ?>post/<?php echo $row['ccode']; ?>">Xem chi tiết →</a>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div id="js-maps-modal" class="lightbox-modal">
		<button type="button" class="lightbox-close" id="js-maps-close"><i class="fa-solid fa-xmark"></i></button>
		<div class="lightbox-content-wrap maps-modal-content" id="js-maps-body"></div>
	</div>
  </div>
</section>

<section class="cta">
  <div class="wrap cta-inner">
    <div>
      <h2>Bạn có bất động sản muốn đăng bán?</h2>
      <p>Tạo tin đăng miễn phí trong vài phút — thêm hình ảnh, sơ đồ mặt bằng và bản đồ vị trí ngay lập tức.</p>
    </div>
    <a href="<?php echo base_url(); ?>post_listing" class="btn" style="background:var(--paper); color:var(--text); padding:14px 28px; font-size:15px; border:1px solid var(--line);">Đăng tin miễn phí →</a>
  </div>
</section>

<section class="features">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="eyebrow">Nền tảng</div>
        <h2>Vì sao chọn PICO Saigon</h2>
      </div>
      <p>Bốn hệ thống cốt lõi giữ cho việc mua bán bất động sản rõ ràng, có thể theo dõi được.</p>
    </div>
    <div class="feat-grid">
      <div class="feat">
        <div class="num mono">01</div>
		<?php echo get_module_note(2); 
		/*
        <h3>Bản đồ tích hợp</h3>
        <p>Xem chính xác vị trí, khu vực lân cận của từng bất động sản trên Google Maps ngay trong tin đăng.</p>
        <i class="fa-solid fa-map-location-dot"></i>
		*/ ?>
      </div>
      <div class="feat">
        <div class="num mono">02</div>
		<?php echo get_module_note(3); 
		/*
        <h3>Hồ sơ minh bạch</h3>
        <p>Tải hợp đồng, sơ đồ mặt bằng và giấy tờ pháp lý trực tiếp — không cần đăng nhập để xem tin công khai.</p>
        <i class="fa-solid fa-file-shield"></i>
		*/ ?>
      </div>
      <div class="feat">
        <div class="num mono">03</div>
		<?php echo get_module_note(4); 
		/*
        <h3>Hỗ trợ theo ticket</h3>
        <p>Gửi yêu cầu hỗ trợ kèm mô tả và file đính kèm, đội ngũ PICO tiếp nhận và phản hồi có thể theo dõi.</p>
        <i class="fa-solid fa-headset"></i>
		*/ ?>
      </div>
      <div class="feat">
        <div class="num mono">04</div>
		<?php echo get_module_note(5); 
		/*
        <h3>Thông báo tức thời</h3>
        <p>Nhận email ngay khi có tin đăng phù hợp mới hoặc khi ticket hỗ trợ của bạn được cập nhật.</p>
        <i class="fa-solid fa-envelope-open-text"></i>
		*/ ?>
      </div>
    </div>
  </div>
</section>

<section class="news" id="news">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="eyebrow">Cập nhật thị trường</div>
        <h2>Tin tức &amp; phân tích</h2>
      </div>
      <p>Góc nhìn thị trường, pháp lý và xu hướng đầu tư bất động sản mới nhất từ đội ngũ PICO.</p>
    </div>
    <div class="news-grid">
		<?php 
			$news_list = get_news_home();
			foreach($news_list as $data) {
				// Danh sach giai mau Gradient ngau nhien cho cac tin không có anh dai dien
				$news_gradients = [
					'linear-gradient(135deg,#5b7a95,#8aa5bb)',
					'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
					'linear-gradient(135deg,#9b7fa0,#c3aac6)'
				];
				$random_news_grad = $news_gradients[array_rand($news_gradients)];
				
				// Tu dong nhan dien Icon theo chuỗi text của danh mục tag tin tuc
				$news_icon = 'fa-chart-line';
				if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'pháp lý') !== false) $news_icon = 'fa-scale-balanced';
				if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'đầu tư') !== false) $news_icon = 'fa-umbrella-beach';
		?>
			<article class="news-card">
				<div class="news-thumb" data-gradient="<?php echo $random_news_grad; ?>">
					<?php if(!empty($data['cimage'])): ?>
						<img src="<?php echo base_url(); ?>upload/news/<?php echo $data['cimage']; ?>" alt="<?php echo $data['ctitle']; ?>" style="width:100%; height:100%; object-fit:cover; position:absolute;">
					<?php else: ?>
						<i class="fa-solid <?php echo $news_icon; ?>"></i>
					<?php endif; ?>
				</div>
				
				<div class="news-body">
					<span class="news-tag"><?php echo !empty($data['ccat_news']) ? $data['ccat_news'] : 'Tin tức'; ?></span>
					<h3>
						<a href="<?php echo base_url(); ?>news/<?php echo $data['ccode']; ?>">
							<?php echo $data['ctitle']; ?>
						</a>
					</h3>
					<p><?php echo !empty($data['cshort_content']) ? Fstr_limit($data['cshort_content'], 120) : ''; ?></p>
					
					<div class="news-meta">
						<span><i class="fa-regular fa-calendar"></i> <?php echo $data['ddate01']; ?></span>
						<a class="view-link" href="<?php echo base_url(); ?>news/<?php echo $data['ccode']; ?>">Đọc thêm →</a>
					</div>
				</div>
			</article>
		<?php } ?>
	</div>
  </div>
</section>

<!-- ---------- GALLERY SECTION WITH POPUP LIGHTBOX ---------- -->
<section class="gallery" id="gallery">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="eyebrow">Không gian thực tế</div>
        <h2>Thư viện ảnh dự án</h2>
      </div>
      <p>Hình ảnh thực tế từ các dự án tiêu biểu đang được giao dịch trên hệ thống PICO Saigon. Click vào hình để xem phóng to.</p>
    </div>
    <div class="gallery-grid">
		<?php 
			$gallery_list = get_gallery();
			foreach($gallery_list as $key => $row) {
				// Tự động map chỉ mục vòng lặp (0->5) thành lớp layout g-1, g-2, g-3, g-4, g-5, g-6 của anh
				$tile_index = $key + 1;
				
				// Lấy tên chú thích tương ứng (Nếu DB có trường ctitle, anh thay thế vào $row['ctitle'])
				$img_caption = 'Hình ảnh dự án PICO';
				if (!empty($row['ctitle'])) {
					$img_caption = $row['ctitle'];
				}
		?>
			<div class="g-tile g-<?php echo $tile_index; ?>" 
				 data-bg="<?php echo base_url(); ?>upload/gallery/<?php echo $row['cimg']; ?>" 
				 onclick="openLightbox(this)">
				<i class="fa-solid fa-magnifying-glass-plus"></i>
				<span><?php echo $img_caption; ?></span>
			</div>
		<?php } ?>
	</div>
  </div>
</section>



<section class="portal" id="portal" style="padding: 60px 0; background: #f8fafc; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line);">
  <div class="wrap">
    
    <div class="portal-box-center">
      <div class="portal-header" style="text-align: center; margin-bottom: 20px;">
        <div class="eyebrow" style="color:var(--brick); font-weight: 700; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; margin-bottom: 6px;">Cổng Chăm Sóc Khách Hàng</div>
        <h2 style="font-size: 28px; font-weight: 800; color: var(--text);">Trung Tâm Hỗ Trợ &amp; Tiếp Nhận Sự Cố</h2>
      </div>

      <p class="portal-lead-text">
        Gặp sự cố về thủ tục pháp lý, thanh toán hoặc cần đính kèm tệp tin tài liệu bàn giao? Hãy gửi ngay ticket hỗ trợ, hệ thống sẽ điều phối trực tiếp tới bộ phận CSKH chuyên trách giải quyết và minh bạch tiến độ từ đầu đến cuối.
      </p>
      
      <ul class="steps-horizontal">
        <li>
          <div class="step-num">1</div>
          <div>
            <h4>Tạo ticket hỗ trợ</h4>
            <p>Mô tả vấn đề vướng mắc và đính kèm file chứng từ liên quan.</p>
          </div>
        </li>
        <li>
          <div class="step-num">2</div>
          <div>
            <h4>Đội ngũ PICO tiếp nhận</h4>
            <p>Nhân viên hoặc quản trị viên chuyên trách trực tiếp vào cuộc xử lý.</p>
          </div>
        </li>
        <li>
          <div class="step-num">3</div>
          <div>
            <h4>Theo dõi trực quan</h4>
            <p>Trạng thái cập nhật liên tục: Mới tiếp nhận &rarr; Đang xử lý &rarr; Đã hoàn tất.</p>
          </div>
        </li>
      </ul>

      <div style="margin-top: 30px;">
        <a href="<?php echo base_url(); ?>portal" class="btn-portal-action">
          <i class="fa-solid fa-paper-plane"></i> Gửi Yêu Cầu Hỗ Trợ Ngay <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>

  </div>
</section>


<?php /*
<section class="ticket-form">
  <div class="wrap tf-grid">
    <div class="tf-info">
      <div class="eyebrow" style="color:var(--brick);">Cổng chăm sóc khách hàng</div>
      <h2>Trung tâm hỗ trợ &amp; chăm sóc khách hàng</h2>
      <p>Gặp sự cố về thủ tục, thanh toán hoặc cần đính kèm tệp tin bàn giao? Hãy gửi ngay ticket hỗ trợ, đội ngũ chuyên viên PICO sẽ phản hồi lập tức.</p>
      <div class="tf-feature">
        <div class="tf-icon"><i class="fa-solid fa-headset"></i></div>
        <div>
          <h4>Phân quyền xử lý chuyên nghiệp</h4>
          <p>Hệ thống điều phối ticket trực tiếp tới bộ phận Admin &amp; Staff chuyên trách.</p>
        </div>
      </div>
    </div>

    <div class="tf-card" id="ticket-form">
	  <h3><i class="fa-solid fa-paper-plane"></i> Tạo Ticket Hỗ Trợ Nhanh</h3>
	  
	  <?php if(isset($_SESSION['ticket_flash_error']) && $_SESSION['ticket_flash_error'] != ''): ?>
		<div style="padding: 12px 16px; margin-bottom: 20px; font-size: 13.5px; font-weight: 600; text-align: center; border-radius: var(--radius); background: #fff1f2; border: 1px solid #ffe4e6; color: #b91c1c;">
		  <i class="fa-solid fa-circle-exclamation"></i>
		  <?php 
			echo $_SESSION['ticket_flash_error']; 
			unset($_SESSION['ticket_flash_error']); 
		  ?>
		</div>
	  <?php endif; ?>

	  <div id="js-ticket-alert" style="display:none; padding: 12px 16px; margin-bottom: 20px; font-size: 13.5px; font-weight: 600; text-align: center; border-radius: var(--radius); background: #fff1f2; border: 1px solid #ffe4e6; color: #b91c1c;">
		<i class="fa-solid fa-circle-exclamation"></i> <span id="js-ticket-alert-text"></span>
	  </div>

	  <form name="frm_customer_ticket" method="POST" action="<?php echo base_url(); ?>ticket/create" enctype="multipart/form-data" onsubmit="return validateCustomerTicket();">
		<div class="tf-row">
		  <div class="tf-field">
			<label for="tf-name">Họ và tên <span style="color: var(--brick);">*</span></label>
			<input id="tf-name" name="txt_name" type="text" placeholder="Nguyễn Văn A">
		  </div>
		  <div class="tf-field">
			<label for="tf-email">Địa chỉ email <span style="color: var(--brick);">*</span></label>
			<input id="tf-email" name="txt_email" type="text" placeholder="name@example.com">
		  </div>
		</div>

		<div class="tf-field">
		  <label for="tf-title">Tiêu đề nội dung cần hỗ trợ <span style="color: var(--brick);">*</span></label>
		  <input id="tf-title" name="txt_title" type="text" placeholder="Ví dụ: Cần bản sao công chứng sổ hồng dự án Landmark">
		</div>

		<div class="tf-field">
		  <label for="tf-desc">Mô tả vấn đề cần hỗ trợ <span style="color: var(--brick);">*</span></label>
		  <textarea id="tf-desc" name="txt_content" rows="5" placeholder="Vui lòng ghi rõ chi tiết nội dung hoặc các vướng mắc thủ tục cần trợ giúp..."></textarea>
		</div>

		<div class="tf-field">
		  <label for="tf-upload">Đính kèm tài liệu liên quan <span>(Tối đa 1GB)</span></label>
		  <div class="tf-file">
			<label class="tf-file-btn" for="tf-upload">Chọn tệp</label>
			<input id="tf-upload" name="file_attach" type="file" accept="image/*,application/pdf" hidden onchange="document.getElementById('tf-filename').textContent = this.files.length ? this.files[0].name : 'Không có tệp nào được chọn';">
			<span class="tf-file-name" id="tf-filename">Không có tệp nào được chọn</span>
		  </div>
		</div>

		<button type="submit" class="tf-submit">Gửi Yêu Cầu Hỗ Trợ <i class="fa-solid fa-arrow-right"></i></button>
		<input type="hidden" name="hidden_action" value="create_ticket">
	  </form>
	</div>
  </div>
</section>
*/ ?>

<section class="newsletter">
  <div class="wrap nl-inner">
    <div class="nl-icon"><i class="fa-solid fa-envelope"></i></div>
    <h2>Đăng Ký Nhận Bản Tin BĐS Độc Quyền</h2>
    <p>Nhận ngay thông báo tin tức thị trường mới nhất và danh sách các tin đăng vừa cập nhật từ đội ngũ PICO.</p>
    
    <form class="nl-form" id="js-form-newsletter" onsubmit="submitNewsletter(event);">
      <input type="email" id="js-nl-email" placeholder="Địa chỉ email của bạn..." aria-label="Địa chỉ email" required>
      <button type="submit" id="js-nl-btn">Đăng ký</button>
    </form>
  </div>
</section>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>