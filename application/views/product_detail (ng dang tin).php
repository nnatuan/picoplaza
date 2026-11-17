<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
  .detail-container {
    max-width: 1180px;
    margin: 30px auto;
    padding: 0 30px;
    display: grid;
    /* ĐÃ CẬP NHẬT: Khóa cứng sidebar 300px, phần còn lại tự động co giãn theo 1fr */
    grid-template-columns: 1fr 300px;
    gap: 30px;
  }
  
  @media (max-width: 950px) {
    .detail-container { 
      grid-template-columns: 1fr; 
      gap: 30px; 
      padding: 0 20px; 
    }
  }

  /* ---------- LEFT CONTENT ---------- */
  .detail-main {
    background: var(--card);
    /* Bắt buộc để các phần tử con bên trong nhận diện biên giới Grid, không kéo phình layout */
    min-width: 0; 
  }
  
  .detail-meta-top {
    display: flex;
    gap: 12px;
    align-items: center;
    margin-bottom: 14px;
  }

  .cat-badge {
    background: var(--paper-3);
    color: var(--text);
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: var(--radius);
  }

  .status-badge {
    background: var(--jade);
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: var(--radius);
    font-family: 'JetBrains Mono', monospace;
  }

  .detail-main h1 {
    font-size: clamp(24px, 3.5vw, 32px);
    line-height: 1.25;
    margin-bottom: 16px;
    color: var(--text);
    /* Chống tràn text tiêu đề cực đoan */
    word-wrap: break-word; 
    overflow-wrap: break-word;
  }

  .detail-location {
    font-size: 14.5px;
    color: var(--text-soft);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--line);
  }

  .detail-location i { color: var(--brick); }

  /* Grid Thông số Core BĐS */
  .detail-specs-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1px;
    background: var(--line);
    border: 1px solid var(--line);
    margin-bottom: 36px;
  }

  .spec-item {
    background: var(--paper-2);
    padding: 20px;
    text-align: center;
  }

  .spec-item .label {
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    color: var(--text-soft);
    letter-spacing: 0.05em;
    margin-bottom: 6px;
  }

  .spec-item .val {
    font-size: 18px;
    font-weight: 800;
    color: var(--text);
  }
  
  .spec-item .val.price-color {
    color: var(--brick);
    font-family: 'JetBrains Mono', monospace;
  }

  /* Ảnh đại diện sản phẩm */
  .detail-gallery {
    width: 100%;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--line);
    margin-bottom: 36px;
    background: var(--paper-2);
  }

  .detail-gallery img {
    width: 100%;
    height: auto;
    max-height: 480px;
    object-fit: cover;
    display: block;
  }

  /* Khối Content mô tả chi tiết */
  .section-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 16px;
    padding-bottom: 8px;
    border-bottom: 2px solid var(--gold);
    display: inline-block;
  }

  .detail-content-text {
    font-size: 15.5px;
    line-height: 1.75;
    color: var(--text);
    margin-bottom: 44px;
    white-space: pre-line;
  }

  /* --- HỆ THỐNG PHÂN KHU TÀI LIỆU CHỐNG TRÀN TUYỆT ĐỐI --- */
  .doc-section { 
    margin-bottom: 44px; 
    background: var(--card); 
    border: 1px solid var(--line); 
    padding: 24px; 
    border-radius: var(--radius);
    width: 100%;
    box-sizing: border-box;
    overflow: hidden; /* Chốt chặn an toàn vòng ngoài cùng */
  }

  .doc-category-group { 
    margin-bottom: 20px;
    width: 100%;
    box-sizing: border-box;
  }

  .doc-list { 
    list-style: none; 
    padding: 0; 
    margin: 0; 
    display: grid; 
    gap: 10px;
    width: 100%;
  }

  .doc-item {  
    display: flex;  
    justify-content: space-between;  
    align-items: center;  
    padding: 12px 16px;  
    background: var(--paper-2);  
    border: 1px solid var(--line);  
    border-radius: var(--radius);  
    gap: 16px; 
    width: 100%;
    max-width: 100%; /* Khóa cứng không cho thẻ li vượt quá độ rộng vùng main */
    box-sizing: border-box;
    overflow: hidden; /* Cắt bỏ bất kỳ thành phần nào cố tình phình ra */
  }

  .doc-info {  
    display: flex;  
    align-items: center;  
    gap: 10px;  
    font-size: 14px;  
    font-weight: 600;  
    flex: 1;
    min-width: 0; /* Bắt buộc để flex item có thể co nhỏ hơn nội dung của nó */
    max-width: calc(100% - 200px); /* Ép chừa tối thiểu 200px cho cụm nút Tải về + Nhãn trạng thái bên phải */
  }

  .doc-info span {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis; /* Bắt buộc sinh dấu ba chấm (...) */
    display: block;
    width: 100%;
    min-width: 0;
    word-break: break-all; /* Nếu trình duyệt không kịp render ellipsis, ép bẻ gãy chữ xuống hoặc ẩn đi */
  }

  .doc-info i {  
    color: var(--brick);  
    flex-shrink: 0; 
  }
  
  .doc-actions-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-shrink: 0; /* Tuyệt đối không cho cụm này co cụm hay rớt dòng */
  }
  .doc-category-title {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    text-transform: uppercase;
    color: var(--text-soft);
    letter-spacing: 0.05em;
    margin-bottom: 10px;
    display: block;
}

  .badge-level { 
    font-size: 10.5px; 
    padding: 2px 6px; 
    font-weight: 700; 
    border-radius: 2px; 
    text-transform: uppercase; 
  }
  .badge-level.pub { background: var(--paper-3); color: var(--text-soft); }
  .badge-level.cust { background: #e0f2fe; color: #0369a1; }
  .badge-level.sec { background: #fee2e2; color: #b91c1c; }
  
  .btn-download-doc { 
    font-size: 13px; 
    font-weight: 700; 
    color: var(--text); 
    border: 1px solid var(--line); 
    padding: 5px 12px; 
    background: var(--card); 
    transition: all 0.15s; 
    border-radius: var(--radius);
  }
  .btn-download-doc:hover { 
    background: var(--brick); 
    color: #fff; 
    border-color: var(--brick); 
  }

  /* Khối Map Iframe */
  .detail-map-wrap {
    margin-bottom: 44px;
  }

  .detail-map-wrap iframe {
    width: 100% !important;
    height: 350px !important;
    border: 1px solid var(--line) !important;
  }

  /* ---------- RIGHT SIDEBAR OWNER ---------- */
  .detail-sidebar {
    position: relative;
    /* Cố định bề rộng vùng không gian của Sidebar */
    width: 300px; 
  }
  
  @media (max-width: 950px) {
    .detail-sidebar {
      width: 100%;
    }
  }

  .owner-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-top: 3px solid var(--brick);
    padding: 25px;
    position: sticky;
    top: 100px;
    box-shadow: 0 15px 35px -10px rgba(15,23,42,0.04);
  }

  .owner-card h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-soft);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 20px;
    text-align: center;
  }

  .owner-profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 24px;
  }

  .owner-avatar {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: var(--paper-3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    color: var(--mist);
    margin-bottom: 12px;
    border: 1px solid var(--line);
    overflow: hidden;
  }
  
  .owner-avatar img { width: 100%; height: 100%; object-fit: cover; }

  .owner-name {
    font-size: 18px;
    font-weight: 700;
    color: var(--text);
  }

  .btn-contact-phone {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: var(--brick);
    color: #ffffff;
    padding: 14px;
    font-size: 16px;
    font-weight: 800;
    border-radius: var(--radius);
    font-family: 'JetBrains Mono', monospace;
    transition: background 0.15s ease;
  }

  .btn-contact-phone:hover {
    background: #984a2c;
  }

  /* ---------- RELATED LISTINGS ---------- */
  .relate-section {
    background: var(--paper-2);
    padding: 64px 0;
    border-top: 1px solid var(--line);
  }
  .relate-head { font-size: 24px; margin-bottom: 28px; text-align: center; }
  .relate-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
  @media (max-width:850px) { .relate-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width:580px) { .relate-grid { grid-template-columns: 1fr; } }
</style>

<main class="detail-container">
  
  <article class="detail-main">
    <div class="detail-meta-top">
      <span class="cat-badge"><?php echo $product['ctitle_cat']; ?></span>
      <span class="status-badge">ĐANG GIAO DỊCH</span>
    </div>

    <h1><?php echo htmlspecialchars($product['ctitle']); ?></h1>
    
    <div class="detail-location">
      <i class="fa-solid fa-location-dot"></i> 
      <span><?php echo htmlspecialchars($product['clocation_detail']); ?>, <?php echo htmlspecialchars($product['ctitle_province']); ?></span>
    </div>

    <div class="detail-gallery">
      <?php if(!empty($product['cimage'])): ?>
        <img src="<?php echo base_url(); ?>upload/images_product/full_images/<?php echo $product['cimage']; ?>" alt="<?php echo htmlspecialchars($product['ctitle']); ?>">
      <?php else: ?>
        <div style="height:260px; display:flex; align-items:center; justify-content:center; color:var(--mist); background:#e2e8f0;"><i class="fa-regular fa-image" style="font-size:48px;"></i></div>
      <?php endif; ?>
    </div>

    <div class="detail-specs-grid">
      <div class="spec-item">
        <div class="label">Mức giá</div>
        <div class="val price-color"><?php echo htmlspecialchars($product['cprice_display']); ?></div>
      </div>
      <div class="spec-item">
        <div class="label">Diện tích</div>
        <div class="val"><?php echo number_format($product['narea'], 2); ?> m²</div>
      </div>
      <div class="spec-item">
        <div class="label">Cấu trúc phòng</div>
        <div class="val" style="font-size:14.5px;"><i class="fa-solid fa-bed"></i> <?php echo $product['nbedroom']; ?> PN / <i class="fa-solid fa-bath"></i> <?php echo $product['nbathroom']; ?> WC</div>
      </div>
    </div>

    <div>
      <h2 class="section-title">Thông tin mô tả chi tiết</h2>
      <div class="detail-content-text"><?php echo htmlspecialchars($product['ccontent']); ?></div>
    </div>

    <div class="doc-section">
      <h2 class="section-title">Hồ sơ tài liệu đính kèm</h2>
      
      <?php 
      $doc_types = [
          'contract' => 'Hợp đồng giao dịch',
          'diagram'  => 'Sơ đồ thiết kế / Bản vẽ chi tiết',
          'legal'    => 'Hồ sơ pháp lý bất động sản'
      ];
      
      foreach($doc_types as $type_key => $type_name) {
          $filtered_docs = array_filter($document_list, function($d) use ($type_key) {
              return $d['ctype_doc'] === $type_key;
          });
          
          if(!empty($filtered_docs)) {
      ?>
          <div class="doc-category-group">
              <span class="doc-category-title"><?php echo $type_name; ?></span>
              <ul class="doc-list">
                  <?php foreach($filtered_docs as $doc) { ?>
                      <li class="doc-item">
                          <div class="doc-info">
                              <i class="fa-regular fa-file-pdf"></i>
                              <span><?php echo htmlspecialchars($doc['ctitle']); ?></span>
                          </div>
                          
                          <div class="doc-actions-wrap">
                              <?php if($doc['naccess_level'] == 1) { ?>
                                  <span class="badge-level pub">Công khai</span>
                              <?php } elseif($doc['naccess_level'] == 2) { ?>
                                  <span class="badge-level cust">Thành viên</span>
                              <?php } else { ?>
                                  <span class="badge-level sec">Bảo mật</span>
                              <?php } ?>
                              
                              <a href="javascript:void(0);" class="btn-download-doc" onclick="js_SecureDownload(<?php echo $doc['nid']; ?>);">
                                    <i class="fa-solid fa-download"></i> Tải về
                              </a>
                          </div>
                      </li>
                  <?php } ?>
              </ul>
          </div>
      <?php }} ?>

      <?php if(empty($document_list)): ?>
          <div class="doc-empty-msg">Không có tài liệu nào được đính kèm cho sản phẩm này.</div>
      <?php endif; ?>
    </div>

    <?php if(!empty($product['cmaps_iframe'])): ?>
      <div class="detail-map-wrap">
        <h2 class="section-title">Vị trí trên bản đồ</h2>
        <div><?php echo $product['cmaps_iframe']; ?></div>
      </div>
    <?php endif; ?>
  </article>

  <aside class="detail-sidebar">
    <div class="owner-card">
      <h3>Người đăng tin</h3>
      
      <div class="owner-profile">
        <div class="owner-avatar">
          <?php if(!empty($owner['cavatar'])): ?>
            <img src="<?php echo base_url(); ?>upload/avatar/<?php echo $owner['cavatar']; ?>" alt="Avatar">
          <?php else: ?>
            <i class="fa-solid fa-user-tie"></i>
          <?php endif; ?>
        </div>
        <div class="owner-name"><?php echo !empty($owner['cfullname']) ? htmlspecialchars($owner['cfullname']) : 'Chuyên viên PICO'; ?></div>
        <div style="font-size:12px; color:var(--text-soft); margin-top:4px;">Thành viên PICO Saigon</div>
      </div>

      <?php if(!empty($owner['cphone'])): ?>
        <a href="tel:<?php echo $owner['cphone']; ?>" class="btn-contact-phone">
          <i class="fa-solid fa-phone-volume animate__animated animate__tada animate__infinite"></i> 
          <?php echo htmlspecialchars($owner['cphone']); ?>
        </a>
      <?php else: ?>
        <div style="text-align:center; font-size:13px; color:var(--text-soft); font-style:italic;">Đang cập nhật số...</div>
      <?php endif; ?>
    </div>
  </aside>
</main>

<section class="relate-section">
  <div class="wrap">
    <h2 class="relate-head">Bất động sản cùng phân khúc liên quan</h2>
    <div class="relate-grid">
      <?php foreach($obj_product_relate as $relate): ?>
        <div class="card" style="background:#fff; border:1px solid var(--line);">
          <div class="thumb" style="background:linear-gradient(135deg,#5b7a95,#8aa5bb); height:140px;">
            <span class="ribbon selling" style="font-size:9.5px;">ĐANG BÁN</span>
            <i class="fa-solid fa-building" style="font-size:32px;"></i>
          </div>
          <div class="card-body" style="padding:16px;">
            <h3 style="font-size:15.5px;"><a href="<?php echo base_url(); ?>product_detail/view/<?php echo $relate['ccode']; ?>"><?php echo htmlspecialchars($relate['ctitle']); ?></a></h3>
            <div class="loc" style="font-size:12px;"><i class="fa-solid fa-location-dot"></i> Khu vực: <?php echo htmlspecialchars($relate['ctitle_province']); ?></div>
            <div class="card-footer" style="margin-top:12px; padding-top:10px;">
              <div class="price mono" style="font-size:14.5px; color:var(--brick);"><?php echo htmlspecialchars($relate['cprice_display']); ?></div>
              <a class="view-link" href="<?php echo base_url(); ?>product_detail/view/<?php echo $relate['ccode']; ?>" style="font-size:12px;">Xem ngay →</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      <?php if(empty($obj_product_relate)): ?>
        <div style="grid-column: span 3; text-align:center; color:var(--text-soft); font-size:14px; font-style:italic;">Chưa có bất động sản tương tự cùng danh mục phân khúc này.</div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
function js_SecureDownload(nidDoc) {
    if(!nidDoc) return;
    
    $.ajax({
        url: '<?php echo base_url(); ?>document/download_file/' + nidDoc,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                window.location.href = response.download_url;
            } else {
                alert(response.message);
            }
        },
        error: function() {
            alert('Hệ thống xử lý tệp tin gặp sự cố bất khả kháng, vui lòng thử lại sau!');
        }
    });
}
</script>
<?php 
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>