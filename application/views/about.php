<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/about.css?v<?php echo time(); ?>" media="all" />	  
<section class="page-hero">
  <div class="wrap">
    <div class="breadcrumb">
      <a href="<?php echo base_url(); ?>">Trang chủ</a> <i class="fa-solid fa-chevron-right"></i> <span>Giới thiệu</span>
    </div>
    <div class="eyebrow" style="color:var(--primary-red);">Về PICO Saigon</div>
    <h1 style="margin-top:14px;">Đồng hành cùng người Việt,<br><em>ở bất cứ đâu bạn gọi là nhà.</em></h1>
    <p class="lede">Từ một văn phòng nhỏ tại Sài Gòn năm 2018, PICO đã trở thành nền tảng bất động sản minh bạch, phục vụ khách hàng trên khắp 34 tỉnh, thành — với quy trình rõ ràng, hồ sơ pháp lý được kiểm duyệt và đội ngũ chuyên viên tận tâm ở từng khu vực.</p>
  </div>
  <svg class="page-hero-skyline" viewBox="0 0 1440 220" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
    <defs><linearGradient id="phSky" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#da251c" stop-opacity="0.12"/><stop offset="100%" stop-color="#da251c" stop-opacity="0.01"/></linearGradient></defs>
    <g fill="none" stroke="#da251c" stroke-opacity="0.18" stroke-width="1.2">
      <rect x="40" y="120" width="60" height="100" fill="url(#phSky)"/>
      <path d="M150 220 L150 90 Q163 65 178 52 Q193 65 206 90 L206 220 Z" fill="url(#phSky)"/>
      <rect x="240" y="140" width="50" height="80" fill="url(#phSky)"/>
      <path d="M420 220 L430 30 L440 22 L450 30 L460 220 Z" fill="url(#phSky)"/>
      <rect x="540" y="130" width="46" height="90" fill="url(#phSky)"/>
      <rect x="900" y="110" width="50" height="110" fill="url(#phSky)"/>
      <rect x="1050" y="150" width="60" height="70" fill="url(#phSky)"/>
      <rect x="1200" y="120" width="46" height="100" fill="url(#phSky)"/>
      <rect x="1320" y="145" width="60" height="75" fill="url(#phSky)"/>
    </g>
  </svg>
</section>

<?php echo $obj_content['ccontent'];
/*
<section class="story">
  <div class="wrap story-grid">
    <div class="story-visual">
      <div class="sv-tile sv-1"><i class="fa-solid fa-building-columns"></i></div>
      <div class="sv-tile sv-2"><i class="fa-solid fa-handshake"></i></div>
      <div class="sv-tile sv-3"><i class="fa-solid fa-map-location-dot"></i></div>
    </div>
    <div class="story-text">
      <div class="eyebrow" style="color:var(--primary-red);">Câu chuyện của chúng tôi</div>
      <h2>Bắt đầu từ một câu hỏi đơn giản: vì sao mua nhà lại khó hiểu đến vậy?</h2>
      <p>PICO Saigon ra đời năm 2018 từ trăn trở của một nhóm nhỏ những người làm bất động sản tại Tp. Hồ Chí Minh: khách hàng thường phải tự mò mẫm giữa hàng loạt tin đăng thiếu thông tin, hồ sơ pháp lý không rõ ràng và quy trình hỗ trợ rời rạc.</p>
      <p>Chúng tôi xây dựng PICO như một nền tảng lấy sự minh bạch làm gốc — mỗi tin đăng đi kèm bản đồ, sơ đồ mặt bằng và giấy tờ pháp lý được kiểm duyệt; mỗi yêu cầu hỗ trợ đều có thể theo dõi từ đầu đến cuối. Sau 8 năm, hành trình đó đã đưa PICO từ một văn phòng tại Sài Gòn đến mạng lưới phục vụ khách hàng trên khắp cả nước.</p>
      <div class="story-stats">
        <div><div class="num">2018</div><div class="label">Năm thành lập</div></div>
        <div><div class="num">120+</div><div class="label">Chuyên viên tư vấn</div></div>
        <div><div class="num">5.400+</div><div class="label">Giao dịch thành công</div></div>
      </div>
    </div>
  </div>
</section>

<section class="mvv">
  <div class="wrap">
    <div class="section-head centered">
      <div class="eyebrow">Kim chỉ nam</div>
      <h2>Sứ mệnh, tầm nhìn &amp; giá trị cốt lõi</h2>
      <p>Ba trụ cột định hướng mọi quyết định của PICO Saigon, từ sản phẩm đến cách chúng tôi phục vụ khách hàng mỗi ngày.</p>
    </div>
    <div class="mvv-grid">
      <div class="mvv-card">
        <div class="mvv-icon"><i class="fa-solid fa-bullseye"></i></div>
        <h3>Sứ mệnh</h3>
        <p>Giúp mọi gia đình và nhà đầu tư Việt Nam tiếp cận thông tin bất động sản đầy đủ, chính xác — để mỗi quyết định mua bán đều được đưa ra trong sự an tâm.</p>
      </div>
      <div class="mvv-card">
        <div class="mvv-icon"><i class="fa-solid fa-eye"></i></div>
        <h3>Tầm nhìn</h3>
        <p>Trở thành nền tảng bất động sản đáng tin cậy hàng đầu tại Việt Nam, nơi minh bạch thông tin là tiêu chuẩn mặc định, không phải ngoại lệ.</p>
      </div>
      <div class="mvv-card">
        <div class="mvv-icon"><i class="fa-solid fa-seedling"></i></div>
        <h3>Giá trị cốt lõi</h3>
        <p>Minh bạch trong từng tin đăng, tận tâm trong từng yêu cầu hỗ trợ, và không ngừng cải tiến quy trình để phục vụ khách hàng tốt hơn mỗi ngày.</p>
      </div>
    </div>
  </div>
</section>

<section class="timeline-section">
  <div class="wrap">
    <div class="section-head centered">
      <div class="eyebrow" style="color:var(--primary-red);">Chặng đường</div>
      <h2>Hành trình phát triển</h2>
      <p>Từ một văn phòng nhỏ đến nền tảng phục vụ khách hàng trên khắp Việt Nam.</p>
    </div>
    <div class="tl-track">
      <div class="tl-row">
        <div class="tl-marker">2018</div>
        <div class="tl-content">
          <div class="yr">THÀNH LẬP</div>
          <h4>Văn phòng đầu tiên tại Tp. Hồ Chí Minh</h4>
          <p>PICO Saigon khởi nghiệp với một đội ngũ nhỏ, tập trung vào phân khúc căn hộ và nhà phố tại khu vực nội thành.</p>
        </div>
      </div>
      <div class="tl-row">
        <div class="tl-marker">2020</div>
        <div class="tl-content">
          <div class="yr">MỞ RỘNG</div>
          <h4>Ra mắt hệ thống quản lý tin đăng trực tuyến</h4>
          <p>Chuyển đổi từ quy trình giấy tờ thủ công sang nền tảng số, cho phép khách hàng xem hồ sơ pháp lý ngay trên tin đăng.</p>
        </div>
      </div>
      <div class="tl-row">
        <div class="tl-marker">2022</div>
        <div class="tl-content">
          <div class="yr">TĂNG TRƯỞNG</div>
          <h4>Mở rộng ra Hà Nội, Đà Nẵng và Cần Thơ</h4>
          <p>PICO bắt đầu phục vụ khách hàng ngoài Tp. Hồ Chí Minh, xây dựng mạng lưới chuyên viên tư vấn tại từng khu vực.</p>
        </div>
      </div>
      <div class="tl-row">
        <div class="tl-marker">2024</div>
        <div class="tl-content">
          <div class="yr">CHUẨN HÓA</div>
          <h4>Ra mắt cổng chăm sóc khách hàng theo ticket</h4>
          <p>Mọi yêu cầu hỗ trợ được số hóa và có thể theo dõi theo thời gian thực, rút ngắn thời gian phản hồi trung bình.</p>
        </div>
      </div>
      <div class="tl-row">
        <div class="tl-marker">2026</div>
        <div class="tl-content">
          <div class="yr">HIỆN TẠI</div>
          <h4>Phủ sóng 34 tỉnh, thành trên cả nước</h4>
          <p>PICO Saigon tiếp tục mở rộng đội ngũ chuyên viên và danh mục tin đăng, hướng tới trở thành nền tảng bất động sản minh bạch hàng đầu Việt Nam.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="team">
  <div class="wrap">
    <div class="section-head centered">
      <div class="eyebrow">Con người PICO</div>
      <h2>Đội ngũ đứng sau nền tảng</h2>
      <p>Bốn nhóm chuyên trách phối hợp chặt chẽ để mỗi tin đăng và mỗi yêu cầu hỗ trợ đều được xử lý đúng người, đúng việc.</p>
    </div>
    <div class="team-grid">
      <div class="team-card">
        <div class="team-avatar"><i class="fa-solid fa-handshake-angle"></i></div>
        <h3>Đội ngũ Kinh doanh</h3>
        <p>Tư vấn trực tiếp, thẩm định nhu cầu và kết nối khách hàng với bất động sản phù hợp.</p>
      </div>
      <div class="team-card">
        <div class="team-avatar"><i class="fa-solid fa-scale-balanced"></i></div>
        <h3>Đội ngũ Pháp lý</h3>
        <p>Kiểm duyệt hồ sơ, sổ đỏ và hợp đồng trước khi mọi tin đăng được công bố công khai.</p>
      </div>
      <div class="team-card">
        <div class="team-avatar"><i class="fa-solid fa-headset"></i></div>
        <h3>Chăm sóc khách hàng</h3>
        <p>Tiếp nhận và xử lý ticket hỗ trợ, đồng hành cùng khách hàng xuyên suốt giao dịch.</p>
      </div>
      <div class="team-card">
        <div class="team-avatar"><i class="fa-solid fa-code"></i></div>
        <h3>Đội ngũ Công nghệ</h3>
        <p>Vận hành và cải tiến nền tảng — từ hệ thống upload file đến cổng ticket trực tuyến.</p>
      </div>
    </div>
  </div>
</section>

<section class="impact">
  <div class="wrap">
    <div class="section-head centered" style="margin-bottom:52px;">
      <div class="eyebrow" style="color:var(--accent-orange);">Bằng con số</div>
      <h2 style="color:#fff;">Quy mô PICO Saigon hôm nay</h2>
    </div>
    <div class="impact-grid">
      <div class="impact-item"><i class="fa-solid fa-building"></i><div class="num">1.240+</div><div class="label">Tin đăng đang hoạt động</div></div>
      <div class="impact-item"><i class="fa-solid fa-map-location-dot"></i><div class="num">34</div><div class="label">Tỉnh, thành phủ sóng</div></div>
      <div class="impact-item"><i class="fa-solid fa-users"></i><div class="num">3.600+</div><div class="label">Khách hàng tin dùng</div></div>
      <div class="impact-item"><i class="fa-solid fa-headset"></i><div class="num">24/7</div><div class="label">Hỗ trợ qua cổng ticket</div></div>
    </div>
  </div>
</section>

<section class="coverage">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="eyebrow">Vùng phủ sóng</div>
        <h2>Có mặt tại các khu vực trọng điểm</h2>
      </div>
      <p>Đội ngũ chuyên viên tư vấn tại chỗ ở các thành phố lớn, hỗ trợ khách hàng nhanh chóng và sát thực tế địa phương.</p>
    </div>
    <div class="coverage-grid">
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Tp. Hồ Chí Minh</h4><span>Trụ sở chính</span></div></div>
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Hà Nội</h4><span>Văn phòng khu vực</span></div></div>
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Đà Nẵng</h4><span>Văn phòng khu vực</span></div></div>
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Cần Thơ</h4><span>Văn phòng khu vực</span></div></div>
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Khánh Hòa</h4><span>Đại diện kinh doanh</span></div></div>
      <div class="coverage-item"><i class="fa-solid fa-location-dot"></i><div><h4>Hải Phòng</h4><span>Đại diện kinh doanh</span></div></div>
    </div>
  </div>
</section>

<section class="cta">
  <div class="wrap cta-inner">
    <div>
      <h2>Sẵn sàng đồng hành cùng PICO Saigon?</h2>
      <p>Xem tin đăng mới nhất hoặc kết nối trực tiếp với đội ngũ chuyên viên tư vấn của chúng tôi.</p>
    </div>
    <div class="cta-actions">
      <a href="<?php echo base_url(); ?>posts" class="btn" style="background:var(--navy); color:var(--accent-orange); padding:14px 26px; font-size:15px; font-weight:700;">Xem tin đăng</a>
      <a href="#" class="btn" style="background:#fffdf7; color:var(--primary-red); padding:14px 26px; font-size:15px; font-weight:700; border:1px solid rgba(255,255,255,0.12);">Liên hệ đội ngũ</a>
    </div>
  </div>
</section>
*/ ?>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>