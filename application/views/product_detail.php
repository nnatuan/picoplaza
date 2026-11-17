<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/product_detail.css?v<?php echo time(); ?>" media="all" />	  

<main class="detail-container">
  
  <article class="detail-main">
    <div class="detail-meta-top">
      <span class="cat-badge"><?php echo $product['ctitle_cat']; ?></span>
      <?php 
		$p_status = isset($product['nproduct_status']) ? (int)$product['nproduct_status'] : 1;
		switch ($p_status) {
			case 1:
				echo '<span class="status-badge selling">ĐANG BÁN</span>';
				break;
			case 2:
				echo '<span class="status-badge hidden-status">TẠM ẨN</span>';
				break;
			case 3:
				echo '<span class="status-badge sold">ĐÃ BÁN</span>';
				break;
			case 4:
				echo '<span class="status-badge renting">CHO THUÊ</span>';
				break;
			default:
				echo '<span class="status-badge selling">ĐANG BÁN</span>';
				break;
		}
	  ?>
    </div>

    <h1><?php echo htmlspecialchars($product['ctitle']); ?></h1>
    
    <div class="detail-location">
      <i class="fa-solid fa-location-dot"></i> 
      <span><?php echo htmlspecialchars($product['clocation_detail']); ?>, <?php echo htmlspecialchars($product['ctitle_province']); ?></span>
    </div>

    <!-- KHỐI ẢNH ĐẠI DIỆN -->
    <div class="detail-gallery">
      <?php if(!empty($product['cimage'])): ?>
        <img src="<?php echo base_url(); ?>upload/images_product/full_images/<?php echo $product['cimage']; ?>" alt="<?php echo htmlspecialchars($product['ctitle']); ?>">
      <?php else: ?>
        <div style="height:320px; display:flex; align-items:center; justify-content:center; color:var(--mist); background:#e2e8f0;"><i class="fa-regular fa-image" style="font-size:48px;"></i></div>
      <?php endif; ?>
    </div>

    <!-- KHỐI THÔNG SỐ CỐT LÕI + NÚT GỌI ĐIỆN NHANH -->
    <div class="detail-specs-wrap">
      <div class="detail-specs-grid">
        <div class="spec-item">
          <div class="label">Mức giá</div>
          <div class="val price-color"><?php echo htmlspecialchars($product['cprice_display']); ?></div>
        </div>
        <div class="spec-item">
          <div class="label">Diện tích</div>
          <div class="val"><?php echo number_format($product['narea'], 2); ?> m²</div>
        </div>
		<?php if($product['nproduct_status']!=4) { ?>
        <div class="spec-item">
          <div class="label">Cấu trúc phòng</div>
          <div class="val" style="font-size:15px;"><i class="fa-solid fa-bed"></i> <?php echo $product['nbedroom']; ?> PN / <i class="fa-solid fa-bath"></i> <?php echo $product['nbathroom']; ?> WC</div>
        </div>
		<?php } ?>
      </div>

      <?php echo get_module_note(15);
	  /*if(!empty($owner['cphone'])): ?>
        <a href="tel:<?php echo $owner['cphone']; ?>" class="btn-contact-phone-inline">
          <i class="fa-solid fa-phone-volume"></i> Gọi ngay: <?php echo htmlspecialchars($owner['cphone']); ?>
        </a>
      <?php endif;*/ ?>
	  
    </div>

    <!-- MÔ TẢ CHI TIẾT -->
    <div>
      <h2 class="section-title">Thông tin mô tả chi tiết</h2>
      <div class="detail-content-text"><?php echo $product['ccontent']; //htmlspecialchars($product['ccontent']); ?></div>
    </div>

    <!-- TÀI LIỆU ĐÍNH KÈM -->
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
          <div class="doc-empty-msg" style="color:var(--text-soft); font-style:italic;">Không có tài liệu nào được đính kèm cho sản phẩm này.</div>
      <?php endif; ?>
    </div>

    <!-- BẢN ĐỒ BĐS -->
    <?php if(!empty($product['cmaps_iframe'])): ?>
      <div class="detail-map-wrap">
        <h2 class="section-title">Vị trí trên bản đồ</h2>
        <div><?php echo $product['cmaps_iframe']; ?></div>
      </div>
    <?php endif; ?>
  </article>

</main>

<!-- SẢN PHẨM CÙNG PHÂN KHÚC LIÊN QUAN -->
<section class="relate-section">
  <div class="wrap">
    <h2 class="relate-head">Bất động sản cùng phân khúc liên quan</h2>
    <div class="relate-grid">
      <?php foreach($obj_product_relate as $relate): 
	  $r_status = isset($relate['nproduct_status']) ? (int)$relate['nproduct_status'] : 1;
	  ?>
        <div class="card" style="background:#fff; border:1px solid var(--line);">
          <div class="thumb" style="background:linear-gradient(135deg,#5b7a95,#8aa5bb); height:150px;">
            <?php 
						switch ($r_status) {
							case 1:
								echo '<span class="ribbon status-badge selling">ĐANG BÁN</span>';
								break;
							case 2:
								echo '<span class="ribbon status-badge hidden-status">TẠM ẨN</span>';
								break;
							case 3:
								echo '<span class="ribbon status-badge sold">ĐÃ BÁN</span>';
								break;
							case 4:
								echo '<span class="ribbon status-badge renting">CHO THUÊ</span>';
								break;
							default:
								echo '<span class="ribbon status-badge selling">ĐANG BÁN</span>';
								break;
						}
					?>
            <i class="fa-solid fa-building" style="font-size:32px;"></i>
          </div>
          <div class="card-body" style="padding:16px;">
            <h3 style="font-size:15.5px;"><a href="<?php echo base_url(); ?>product_detail/view/<?php echo $relate['ccode']; ?>"><?php echo htmlspecialchars($relate['ctitle']); ?></a></h3>
            <div class="loc" style="font-size:12px;"><i class="fa-solid fa-location-dot"></i> Khu vực: <?php echo htmlspecialchars($relate['ctitle_province']); ?></div>
            <div class="card-footer" style="margin-top:12px; padding-top:10px;">
              <div class="price mono" style="font-size:14.5px; color:var(--primary-red);"><?php echo htmlspecialchars($relate['cprice_display']); ?></div>
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