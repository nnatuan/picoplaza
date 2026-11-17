<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
  .search-container {
    max-width: 1180px;
    margin: 40px auto;
    padding: 0 32px;
  }
  @media (max-width: 640px) {
    .search-container { padding: 0 20px; }
  }

  /* Khối tiêu đề thông tin kết quả */
  .search-result-header {
    margin-bottom: 32px;
    border-bottom: 1px solid var(--line);
    padding-bottom: 20px;
  }
  .search-result-header h1 {
    font-size: 26px;
    font-weight: 700;
    color: var(--text);
  }
  .search-result-header p {
    color: var(--text-soft);
    font-size: 14.5px;
    margin-top: 6px;
  }

  /* Khối phân trang Frontend liên kết Form Submit */
  .search-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 20px;
    border-top: 1px dashed var(--line);
    padding-top: 28px;
  }
  .page-btn {
    border: 1px solid var(--line);
    background: var(--card);
    color: var(--text);
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
  }
  .page-btn:hover {
    border-color: var(--brick);
    color: var(--brick);
  }
  .page-btn.active {
    background: var(--text);
    color: #fff;
    border-color: var(--text);
    cursor: default;
  }
</style>

<form name="frm_search_pagination" method="POST" action="<?php echo base_url(); ?>search">
  
  <div class="search-container">
    
    <div class="search-result-header">
      <h1>Kết Quả Tìm Kiếm Bất Động Sản</h1>
      <p>Hệ thống tìm thấy <strong><?php echo count($obj_search_result); ?></strong> bất động sản phù hợp với tiêu chí tra cứu của bạn.</p>
    </div>

    <div class="grid-listings">  
      <?php foreach($obj_search_result as $row) {
          // Cấu hình các dải màu Gradient ngẫu nhiên làm nền cho tin không có ảnh
				$gradients = [
					'linear-gradient(135deg,#5b7a95,#8aa5bb)',
					'linear-gradient(135deg,#a8795a,#c9a17e)',
					'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
					'linear-gradient(135deg,#9b7fa0,#c3aac6)'
				];
				$random_gradient = $gradients[array_rand($gradients)];
				
				// Tự động nhận diện lớp Icon Font-Awesome theo tên danh mục phân loại bđs
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
	  
      <?php if(empty($obj_search_result)): ?>
        <div style="grid-column: span 3; text-align: center; padding: 48px 0; color: var(--text-soft); font-style: italic; font-size: 15px;">
          <i class="fa-solid fa-magnifying-glass-chart" style="font-size: 32px; display: block; margin-bottom: 12px; color: var(--mist);"></i>
          Không tìm thấy bất động sản nào phù hợp với bộ lọc hiện tại. Vui lòng điều chỉnh lại khu vực hoặc mức giá!
        </div>
      <?php endif; ?>

    </div>

    <?php if($ntotal_page > 1): ?>
      <div class="search-pagination">
        <?php if($ncurr_page > 1): ?>
          <button type="button" class="page-btn" onclick="js_SearchGoToPage(<?php echo $ncurr_page - 1; ?>)">« Trước</button>
        <?php endif; ?>

        <?php for($i = 1; $i <= $ntotal_page; $i++): ?>
          <button type="button" class="page-btn <?php if($i === $ncurr_page) echo 'active'; ?>" 
                  onclick="<?php echo ($i !== $ncurr_page) ? 'js_SearchGoToPage('.$i.')' : 'return false;'; ?>">
            <?php echo $i; ?>
          </button>
        <?php endfor; ?>

        <?php if($ncurr_page < $ntotal_page): ?>
          <button type="button" class="page-btn" onclick="js_SearchGoToPage(<?php echo $ncurr_page + 1; ?>)">Sau »</button>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </div>

  <input type="hidden" id="txt_current_page" name="txt_current_page" value="<?php echo $ncurr_page; ?>" />
</form>

<div id="js-maps-modal" class="lightbox-modal">
	<button type="button" class="lightbox-close" id="js-maps-close"><i class="fa-solid fa-xmark"></i></button>
	<div class="lightbox-content-wrap maps-modal-content" id="js-maps-body"></div>
</div>
	
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // Tự động bốc chuỗi Gradient từ thuộc tính data gán thay thế cho CSS inline
    const thumbBoxes = document.querySelectorAll('.thumb[data-gradient]');
    thumbBoxes.forEach(function(box) {
        const gradientStr = box.getAttribute('data-gradient');
        if (gradientStr) {
            box.style.background = gradientStr;
        }
    });
});

// Điều khiển submit form chuyển trang đồng bộ
function js_SearchGoToPage(pageNumber) {
    document.getElementById('txt_current_page').value = pageNumber;
    document.frm_search_pagination.submit();
}
</script>

<?php 
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>