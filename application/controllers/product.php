<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
  .products-layout-container {
    max-width: 1180px;
    margin: 40px auto;
    padding: 0 32px;
    display: grid;
    grid-template-columns: 280px 1fr; /* Cột trái 280px, cột phải tự co giãn */
    gap: 32px;
    align-items: start;
  }
  @media (max-width: 900px) {
    .products-layout-container {
      grid-template-columns: 1fr; /* Trên màn hình nhỏ chuyển thành 1 cột đứng */
      gap: 24px;
      padding: 0 20px;
    }
  }

  /* --- STYLE BỘ LỌC BÊN TRÁI (SIDEBAR) --- */
  .filter-sidebar {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    padding: 24px;
    position: sticky;
    top: 80px; /* Dính theo màn hình khi cuộn chuột xuống */
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.02);
  }
  .filter-sidebar h2 {
    font-size: 15px;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
    font-family: 'JetBrains Mono', monospace;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--gold);
    padding-bottom: 8px;
    color: var(--text);
  }
  .filter-sidebar .field {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-bottom: 18px;
  }
  .filter-sidebar .field label {
    font-family: 'JetBrains Mono', monospace;
    font-size: 11px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-soft);
    font-weight: 600;
  }
  .filter-sidebar .field select {
    appearance: none;
    border: 1px solid var(--line);
    background: #fff url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="10" height="6"><path d="M0 0L5 6L10 0" fill="%2364748b"/></svg>') no-repeat right 12px center;
    padding: 11px 30px 11px 12px;
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
    font-weight: 600;
    border-radius: var(--radius);
    color: var(--text);
    transition: border-color 0.15s;
    width: 100%;
  }
  .filter-sidebar .field select:focus {
    outline: none;
    border-color: var(--brick);
  }
  .filter-sidebar .search-btn {
    width: 100%;
    background: var(--brick);
    color: #ffffff;
    border: none;
    padding: 12px;
    font-weight: 700;
    font-size: 14.5px;
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background 0.15s;
    margin-top: 10px;
  }
  .filter-sidebar .search-btn:hover {
    background: #984a2c;
  }

  /* --- CỘT PHẢI: TIÊU ĐỀ & LƯỚI GRID HIỂN THỊ BDS --- */
  .products-main-content .page-header {
    margin-bottom: 24px;
    border-bottom: 1px solid var(--line);
    padding-bottom: 16px;
  }
  .products-main-content .page-header h1 {
    font-size: 24px;
    font-weight: 700;
  }
  .products-main-content .page-header p {
    color: var(--text-soft);
    font-size: 13.5px;
    margin: 4px 0 0 0;
  }

  .grid-listings {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 cột bên phải để vừa vặn không gian */
    gap: 24px;
  }
  @media (max-width: 580px) {
    .grid-listings { grid-template-columns: 1fr; }
  }

  /* Định dạng lại khối vị trí & nút maps inline */
  .loc-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-top: 8px;
  }
  .loc-container .loc { margin-top: 0; flex: 1; }
  
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
    background: var(--brick);
    border-color: var(--brick);
    color: #ffffff;
  }

  /* Khối phân trang */
  .products-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 32px;
    border-top: 1px dashed var(--line);
    padding-top: 24px;
  }
  .page-btn {
    border: 1px solid var(--line);
    background: var(--card);
    color: var(--text);
    padding: 8px 14px;
    font-size: 13.5px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.15s ease;
    border-radius: var(--radius);
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

<div class="products-layout-container">
    
    <aside class="filter-sidebar">
    <h2><i class="fa-solid fa-sliders"></i> Bộ lọc</h2>
    
    <form name="frm_hero_search" method="POST" action="">
        
        <div class="field">
            <label for="search-province">Tỉnh / Thành phố</label>
            <select id="search-province" name="cbo_nid_province">
                <option value="0">Tất cả tỉnh, thành</option>
                <?php 
                    $provinces = get_province_all();
                    foreach($provinces as $prov) { 
                ?>
                    <option value="<?php echo $prov['nid']; ?>" <?php if(isset($nid_province) && $prov['nid'] == $nid_province) echo 'selected'; ?>>
                        <?php echo $prov['ctitle']; ?>
                    </option>
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
                    <option value="<?php echo $cat['nid']; ?>" <?php if(isset($nid_cat) && $cat['nid'] == $nid_cat) echo 'selected'; ?>>
                        <?php echo $cat['ctitle']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="field">
            <label for="search-price">Mức giá</label>
            <select id="search-price" name="cbo_price_range">
                <option value="" <?php if(empty($price_range)) echo 'selected'; ?>>Tất cả mức giá</option>
                <option value="under_2b" <?php if(isset($price_range) && $price_range === 'under_2b') echo 'selected'; ?>>Dưới 2 tỷ</option>
                <option value="2b_5b" <?php if(isset($price_range) && $price_range === '2b_5b') echo 'selected'; ?>>2 – 5 tỷ</option>
                <option value="5b_10b" <?php if(isset($price_range) && $price_range === '5b_10b') echo 'selected'; ?>>5 – 10 tỷ</option>
                <option value="over_10b" <?php if(isset($price_range) && $price_range === 'over_10b') echo 'selected'; ?>>Trên 10 tỷ</option>
            </select>
        </div>
        
        <button type="submit" class="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
        </button>
    </form>
</aside>

    <main class="products-main-content">
        
        <div class="page-header">
            <h1><?php echo !empty($ccode_cat) ? 'Danh mục: ' . uppercase_first($ccode_cat) : 'Tất Cả Bất Động Sản'; ?></h1>
            <p>Hiện có tổng số <strong><?php echo $total_row; ?></strong> tin đăng bất động sản chính chủ, minh bạch pháp lý.</p>
        </div>

        <div class="grid-listings">
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

            <?php if(empty($obj_products_result)): ?>
                <div style="grid-column: span 2; text-align: center; padding: 64px 0; color: var(--text-soft); font-style: italic;">
                    Không tìm thấy bài đăng bất động sản nào theo tiêu chí tìm kiếm.
                </div>
            <?php endif; ?>
        </div>

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
</div>

<form name="frm_products_pagination" method="POST" action="">
    <input type="hidden" id="txt_current_page" name="txt_current_page" value="<?php echo $ncurr_page; ?>" />
</form>

<div id="js-maps-modal" class="lightbox-modal">
  <button type="button" class="lightbox-close" id="js-maps-close"><i class="fa-solid fa-xmark"></i></button>
  <div class="lightbox-content-wrap maps-modal-content" id="js-maps-body"></div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // 1. Render dải màu Gradient ngẫu nhiên
    const thumbBoxes = document.querySelectorAll('.thumb[data-gradient]');
    thumbBoxes.forEach(function(box) {
        const gradientStr = box.getAttribute('data-gradient');
        if (gradientStr) { box.style.background = gradientStr; }
    });

    // 2. Xử lý Popup Modal Iframe Maps
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

    mapsCloseBtn.addEventListener('click', function() {
        mapsModal.classList.remove('open');
        mapsBody.innerHTML = '';
    });

    mapsModal.addEventListener('click', function(e) {
        if (e.target === mapsModal) {
            mapsModal.classList.remove('open');
            mapsBody.innerHTML = '';
        }
    });
});

// Điều phối chuyển trang phân trang an toàn
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