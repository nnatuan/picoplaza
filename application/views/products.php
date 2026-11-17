<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/product_detail.css?v<?php echo time(); ?>" media="all" />	 
<style>
  /* Khung chứa trang BĐS 1 cột full 1180px */
  .products-page-container {
    max-width: 1180px;
    margin: 30px auto 60px;
    padding: 0 32px;
    width: 100%;
    box-sizing: border-box;
  }
  @media (max-width: 640px) {
    .products-page-container { padding: 0 20px; margin: 20px auto 40px; }
  }

  .page-header {
    margin-bottom: 28px;
    border-bottom: 2px solid var(--primary-red);
    padding-bottom: 12px;
  }
  .page-header h1 {
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin: 0;
  }
  .page-header p {
    color: var(--text-soft);
    font-size: 14px;
    margin: 6px 0 0 0;
  }

  /* Lưới Lưới 3 cột vuông vắn đồng bộ Home */
  .grid-listings-3col {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
  }
  @media (max-width: 900px) { .grid-listings-3col { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 580px) { .grid-listings-3col { grid-template-columns: 1fr; } }

  .loc-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-top: 8px;
  }
  .loc-container .loc { margin-top: 0; flex: 1; min-height: 42px; }
  
  .btn-inline-maps {
    background: var(--paper-3);
    color: var(--text-soft);
    border: 1px solid var(--line);
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: var(--radius);
    display: inline-flex;
    align-items: center;
    gap: 4px;
    white-space: nowrap;
    transition: all 0.12s ease;
  }
  .btn-inline-maps:hover {
    background: var(--primary-red);
    border-color: var(--primary-red);
    color: #ffffff;
  }

  /* Khối phân trang */
  .products-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 48px;
    border-top: 1px solid var(--line);
    padding-top: 28px;
  }
  .page-btn {
    border: 1px solid var(--line);
    background: #fff;
    color: var(--text);
    padding: 8px 15px;
    font-size: 13.5px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.15s ease;
    border-radius: 2px;
  }
  .page-btn:hover {
    border-color: var(--primary-red);
    color: var(--primary-red);
  }
  .page-btn.active {
    background: var(--primary-red);
    color: #fff;
    border-color: var(--primary-red);
    cursor: default;
  }

  /* Thẻ Iframe Modal */
  .maps-modal-content {
    width: 100%;
    max-width: 850px;
    height: 70vh;
    background: var(--paper);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  }
  .maps-modal-content iframe {
    width: 100% !important;
    height: 100% !important;
    border: none !important;
  }
</style>

<main class="products-page-container">
    <?php echo get_module_note(19); 
	/*
    <div class="page-header">
        <h1><?php echo !empty($ccode_cat) ? 'DANH MỤC: ' . uppercase_first($ccode_cat) : 'TẤT CẢ BẤT ĐỘNG SẢN'; ?></h1>
        <p>Hiện có tổng số <strong><?php echo $total_row; ?></strong> tin đăng bất động sản chính chủ, minh bạch pháp lý.</p>
    </div>
	*/ ?>
    <div class="grid-listings-3col">
        <?php 
            foreach($obj_products_result as $row) {
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
				
				$p_status = isset($row['nproduct_status']) ? (int)$row['nproduct_status'] : 1;
        ?>
            <article class="card">
                <div class="thumb" data-gradient="<?php echo $random_gradient; ?>">
                    <?php 
						switch ($p_status) {
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
                    
                    <?php if(!empty($row['cimage'])): ?>
                        <img src="<?php echo base_url(); ?>upload/images_product/full_images/<?php echo $row['cimage']; ?>" alt="<?php echo htmlspecialchars($row['ctitle']); ?>">
                    <?php else: ?>
                        <i class="fa-solid <?php echo $icon_class; ?>"></i>
                    <?php endif; ?>
                </div>
                
                <div class="card-body">
                    <h3>
                        <a href="<?php echo base_url(); ?>post/<?php echo $row['ccode']; ?>">
                            <?php echo htmlspecialchars($row['ctitle']); ?>
                        </a>
                    </h3>
                    
                    <div class="loc-container">
                        <div class="loc">
                            <i class="fa-solid fa-location-dot"></i> 
                            <?php echo htmlspecialchars($row['clocation_detail']); if(isset($row['ctitle_province'])) echo ', ' . htmlspecialchars($row['ctitle_province']); ?>
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
                        <div class="price mono"><?php echo htmlspecialchars($row['cprice_display']); ?></div>
                        <a class="view-link" href="<?php echo base_url(); ?>post/<?php echo $row['ccode']; ?>">Xem chi tiết →</a>
                    </div>
                </div>
            </article>
        <?php } ?>

        <?php if(empty($obj_products_result)): ?>
            <div style="grid-column: span 3; text-align: center; padding: 80px 0; color: var(--text-soft); font-style: italic;">
                Hiện tại chưa có bài đăng bất động sản nào trong mục này.
            </div>
        <?php endif; ?>
    </div>

    <!-- PHÂN TRANG -->
    <?php if($ntotal_page > 1): ?>
        <div class="products-pagination">
            <?php if($ncurr_page > 1): ?>
                <button type="button" class="page-btn" onclick="js_ProductsGoToPage(<?php echo $ncurr_page - 1; ?>)">« Trước</button>
            <?php endif; ?>

            <?php for($i = 1; $i <= $ntotal_page; $i++): ?>
                <button type="button" class="page-btn <?php if($i === $ncurr_page) echo 'active'; ?>"
                        onclick="<?php echo ($i !== $ncurr_page) ? 'js_ProductsGoToPage('.$i.')' : 'return false;'; ?>">
                    <?php echo $i; ?>
                </button>
            <?php endfor; ?>

            <?php if($ncurr_page < $ntotal_page): ?>
                <button type="button" class="page-btn" onclick="js_ProductsGoToPage(<?php echo $ncurr_page + 1; ?>)">Sau »</button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</main>

<form name="frm_products_pagination" method="POST" action="">
    <input type="hidden" id="txt_current_page" name="txt_current_page" value="<?php echo $ncurr_page; ?>" />
</form>

<div id="js-maps-modal" class="lightbox-modal">
  <button type="button" class="lightbox-close" id="js-maps-close"><i class="fa-solid fa-xmark"></i></button>
  <div class="lightbox-content-wrap maps-modal-content" id="js-maps-body"></div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const thumbBoxes = document.querySelectorAll('.thumb[data-gradient]');
    thumbBoxes.forEach(function(box) {
        const gradientStr = box.getAttribute('data-gradient');
        if (gradientStr) { box.style.background = gradientStr; }
    });

    const inlineMapsBtns = document.querySelectorAll('.btn-inline-maps');
    const mapsModal      = document.getElementById('js-maps-modal');
    const mapsBody       = document.getElementById('js-maps-body');
    const mapsCloseBtn   = document.getElementById('js-maps-close');

    inlineMapsBtns.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const rawIframe = this.getAttribute('data-maps-raw');
            if (rawIframe) {
                mapsBody.innerHTML = rawIframe;
                mapsModal.classList.add('open');
            }
        });
    });

    if(mapsCloseBtn) {
        mapsCloseBtn.addEventListener('click', function() {
            mapsModal.classList.remove('open');
            mapsBody.innerHTML = '';
        });
    }

    if(mapsModal) {
        mapsModal.addEventListener('click', function(e) {
            if (e.target === mapsModal) {
                mapsModal.classList.remove('open');
                mapsBody.innerHTML = '';
            }
        });
    }
});

function js_ProductsGoToPage(pageNumber) {
    document.getElementById('txt_current_page').value = pageNumber;
    
    <?php if(!empty($ccode_cat)): ?>
        document.frm_products_pagination.action = "<?php echo base_url(); ?>products/set_page_cat/<?php echo $ccode_cat; ?>/" + pageNumber;
    <?php else: ?>
        document.frm_products_pagination.action = "<?php echo base_url(); ?>products/set_page/all/" + pageNumber;
    <?php endif; ?>
    
    document.frm_products_pagination.submit();
}
</script>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>