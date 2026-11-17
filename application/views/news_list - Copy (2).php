<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
  /* Khung chứa trang tin tức */
  .news-page-container {
    max-width: 1180px;
    margin: 30px auto 60px;
    padding: 0 32px;
    width: 100%;
    box-sizing: border-box;
  }
  @media (max-width: 640px) {
    .news-page-container { padding: 0 20px; margin: 20px auto 40px; }
  }

  .news-page-header {
    margin-bottom: 28px;
    border-bottom: 2px solid var(--primary-red);
    padding-bottom: 12px;
  }
  .news-page-header h1 {
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin: 0;
  }

  /* ---------- BÀI NỔI BẬT LỚN PHÍA TRÊN (VNEXPRESS STYLE) ---------- */
  .featured-news-card {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 32px;
    padding-bottom: 36px;
    margin-bottom: 36px;
    border-bottom: 1px solid var(--line);
    align-items: flex-start;
    width: 100%;
  }
  @media (max-width: 820px) {
    .featured-news-card {
      grid-template-columns: 1fr;
      gap: 20px;
    }
  }

  .featured-news-thumb {
    width: 100%;
    height: 350px;
    border-radius: 4px;
    overflow: hidden;
    position: relative;
    background: var(--paper-2);
  }
  .featured-news-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }
  .featured-news-card:hover .featured-news-thumb img {
    transform: scale(1.03);
  }

  .featured-news-body {
    display: flex;
    flex-direction: column;
  }

  .featured-news-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    font-size: 13px;
    color: var(--text-soft);
    margin-bottom: 12px;
  }
  .featured-news-meta .news-tag {
    background: var(--paper-2);
    color: var(--primary-red);
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 10.5px;
    text-transform: uppercase;
  }

  .featured-news-body h2 {
    font-size: clamp(22px, 2.5vw, 28px);
    font-weight: 700;
    line-height: 1.3;
    margin: 0 0 14px 0;
  }
  .featured-news-body h2 a {
    color: var(--text);
    transition: color 0.15s ease;
  }
  .featured-news-body h2 a:hover {
    color: var(--primary-red);
  }

  .featured-news-desc {
    font-size: 15px;
    line-height: 1.65;
    color: var(--text-soft);
    margin: 0 0 20px 0;
  }

  .btn-read-more {
    color: var(--primary-red);
    font-weight: 700;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
  }
  .btn-read-more:hover {
    color: var(--primary-red-deep);
  }

  /* ---------- PHÂN TRANG ---------- */
  .news-pagination {
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
</style>

<form name="frm_news_pagination" method="POST" action="<?php echo base_url(); ?>news_list/cat_page/<?php echo $nid_cat; ?>/<?php echo $cur_page; ?>">
  
  <main class="news-page-container">
    
    <div class="news-page-header">
      <h1><?php echo !empty($title) ? $title : 'BẢN TIN PICO PLAZA'; ?></h1>
    </div>

    <?php 
      if (!empty($obj_news_list)): 
        // 1. TÁCH BÀI VIẾT ĐẦU TIÊN LÀM TIN NỔI BẬT KHỔ LỚN
        $featured_news  = $obj_news_list[0];
        $remaining_news = array_slice($obj_news_list, 1);
    ?>

      <!-- BÀI NỔI BẬT LỚN TRÊN CÙNG -->
      <article class="featured-news-card">
        <div class="featured-news-thumb">
          <a href="<?php echo base_url(); ?>news/<?php echo $featured_news['ccode']; ?>">
            <?php if(!empty($featured_news['cimage_thumb'])): ?>
              <img src="<?php echo base_url(); ?>upload/image_article/<?php echo $featured_news['cimage_thumb']; ?>" alt="<?php echo htmlspecialchars($featured_news['ctitle']); ?>">
            <?php else: ?>
              <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(135deg,#da251c,#0f172a); color:#fff;">
                <i class="fa-solid fa-newspaper" style="font-size:64px;"></i>
              </div>
            <?php endif; ?>
          </a>
        </div>

        <div class="featured-news-body">
          <div class="featured-news-meta">
            <span class="news-tag"><?php echo !empty($featured_news['ccat_news']) ? htmlspecialchars($featured_news['ccat_news']) : 'Tin nổi bật'; ?></span>
            <span><i class="fa-regular fa-clock"></i> <?php echo date('d/m/Y', strtotime($featured_news['ddate01'])); ?></span>
          </div>

          <h2>
            <a href="<?php echo base_url(); ?>news/<?php echo $featured_news['ccode']; ?>">
              <?php echo htmlspecialchars($featured_news['ctitle']); ?>
            </a>
          </h2>

          <p class="featured-news-desc">
            <?php echo !empty($featured_news['cshort_content']) ? Fstr_limit($featured_news['cshort_content'], 200) : ''; ?>
          </p>

          <div>
            <a href="<?php echo base_url(); ?>news/<?php echo $featured_news['ccode']; ?>" class="btn-read-more">
              Đọc tiếp <i class="fa-solid fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </article>

      <!-- 2. CÁC ITEM CÒN LẠI HIỂN THỊ CHUẨN GRID VÀ STYLE GIỐNG HOME -->
      <?php if (!empty($remaining_news)): ?>
        <div class="news-grid">
          <?php 
            foreach($remaining_news as $data) {
              // Danh sách dải màu Gradient ngẫu nhiên cho các tin không có ảnh đại diện
              $news_gradients = [
                'linear-gradient(135deg,#5b7a95,#8aa5bb)',
                'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
                'linear-gradient(135deg,#9b7fa0,#c3aac6)'
              ];
              $random_news_grad = $news_gradients[array_rand($news_gradients)];
              
              // Tự động nhận diện Icon theo chuỗi text của danh mục tag tin tức
              $news_icon = 'fa-chart-line';
              if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'pháp lý') !== false) $news_icon = 'fa-scale-balanced';
              if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'đầu tư') !== false) $news_icon = 'fa-umbrella-beach';
          ?>
            <article class="news-card">
              <div class="news-thumb" data-gradient="<?php echo $random_news_grad; ?>">
                <?php if(!empty($data['cimage_thumb'])): ?>
                  <img src="<?php echo base_url(); ?>upload/image_article/<?php echo $data['cimage_thumb']; ?>" alt="<?php echo htmlspecialchars($data['ctitle']); ?>" style="width:100%; height:100%; object-fit:cover; position:absolute;">
                <?php else: ?>
                  <i class="fa-solid <?php echo $news_icon; ?>"></i>
                <?php endif; ?>
              </div>
              
              <div class="news-body">
                <span class="news-tag"><?php echo !empty($data['ccat_news']) ? htmlspecialchars($data['ccat_news']) : 'Tin tức'; ?></span>
                <h3>
                  <a href="<?php echo base_url(); ?>news/<?php echo $data['ccode']; ?>">
                    <?php echo htmlspecialchars($data['ctitle']); ?>
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
      <?php endif; ?>

    <?php else: ?>
      <div style="text-align: center; padding: 80px 0; color: var(--text-soft); font-style: italic;">
        Hệ thống đang cập nhật dữ liệu các bài đăng tin tức mới!
      </div>
    <?php endif; ?>

    <!-- PHÂN TRANG -->
    <?php if(isset($total_page) && $total_page > 1): ?>
      <div class="news-pagination">
        <?php if($cur_page > 1): ?>
          <button type="button" class="page-btn" onclick="js_NewsGoToPage(<?php echo $cur_page - 1; ?>)">« Trước</button>
        <?php endif; ?>

        <?php for($i = 1; $i <= $total_page; $i++): ?>
          <button type="button" class="page-btn <?php if($i === $cur_page) echo 'active'; ?>"
                  onclick="<?php echo ($i !== $cur_page) ? 'js_NewsGoToPage('.$i.')' : 'return false;'; ?>">
            <?php echo $i; ?>
          </button>
        <?php endfor; ?>

        <?php if($cur_page < $total_page): ?>
          <button type="button" class="page-btn" onclick="js_NewsGoToPage(<?php echo $cur_page + 1; ?>)">Sau »</button>
        <?php endif; ?>
      </div>
    <?php endif; ?>

  </main>

  <input type="hidden" id="txt_current_page" name="txt_current_page" value="<?php echo isset($cur_page) ? $cur_page : 1; ?>" />
</form>

<script type="text/javascript">
function js_NewsGoToPage(pageNumber) {
    document.getElementById('txt_current_page').value = pageNumber;
    document.frm_news_pagination.action = "<?php echo base_url(); ?>news_list/cat_page/<?php echo $nid_cat; ?>/" + pageNumber;
    document.frm_news_pagination.submit();
}
</script>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>