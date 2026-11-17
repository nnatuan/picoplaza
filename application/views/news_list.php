<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
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
    padding-bottom: 10px;
  }
  .news-page-header h1 {
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin: 0;
  }

  /* TIN NỔI BẬT ĐẦU TRANG */
  .featured-news-card {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 32px;
    padding-bottom: 32px;
    margin-bottom: 32px;
    border-bottom: 1px dashed var(--line);
    align-items: flex-start;
    width: 100%;
  }
  @media (max-width: 820px) {
    .featured-news-card { grid-template-columns: 1fr; gap: 20px; }
  }

  .featured-news-thumb {
    width: 100%;
    height: 330px;
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

  .featured-news-body { display: flex; flex-direction: column; }
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
    font-size: clamp(20px, 2.3vw, 26px);
    font-weight: 700;
    line-height: 1.35;
    margin: 0 0 14px 0;
  }
  .featured-news-body h2 a { color: var(--text); transition: color 0.15s ease; }
  .featured-news-body h2 a:hover { color: var(--primary-red); }

  .featured-news-desc {
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
    margin: 0;
  }

  /* GRID DANH SÁCH TIN NHỎ */
  .news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  @media (max-width: 900px) { .news-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 620px) { .news-grid { grid-template-columns: 1fr; } }

  .sub-news-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 3px;
    overflow: hidden;
  }
  .sub-news-thumb { height: 160px; position: relative; overflow: hidden; }
  .sub-news-body { padding: 16px 18px 18px; }
  .sub-news-body .news-tag {
    font-size: 10.5px;
    text-transform: uppercase;
    color: var(--primary-red);
    background: var(--paper-2);
    padding: 3px 8px;
    border-radius: 20px;
    font-weight: 600;
  }
  .sub-news-body h3 {
    font-size: 15.5px;
    margin: 10px 0 8px 0;
    line-height: 1.4;
    font-weight: 600;
  }
  .sub-news-body h3 a { color: var(--text); }
  .sub-news-body h3 a:hover { color: var(--primary-red); }
  .sub-news-body p {
    font-size: 13px;
    color: var(--text-soft);
    margin: 0 0 12px 0;
    line-height: 1.5;
  }
  .sub-news-meta { font-size: 12px; color: var(--mist); }

  /* THANH PHÂN TRANG SỐ */
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

<?php 
  // Lấy ccode hoặc ID để tạo link phân trang
  $cat_param = !empty($cat_info['ccode']) ? $cat_info['ccode'] : $nid_cat;
?>

<form name="frm_news_pagination" method="POST" action="<?php echo base_url(); ?>news-list/<?php echo $cat_param; ?>/<?php echo $cur_page; ?>">
  
  <main class="news-page-container">
    
    <div class="news-page-header">
      <h1><?php echo htmlspecialchars($title); ?></h1>
    </div>

    <?php 
      if (!empty($obj_news_list)): 
        // Bài viết đầu tiên làm tin đại diện khổ lớn
        $featured_news  = $obj_news_list[0];
        $remaining_news = array_slice($obj_news_list, 1);

        $featured_cat_title = !empty($featured_news['ccat_news']) ? $featured_news['ccat_news'] : (!empty($cat_info['ccat_news']) ? $cat_info['ccat_news'] : 'Tin tức');
    ?>

      <!-- BÀI ĐẠI DIỆN LỚN NẰM TRÊN -->
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
            <span class="news-tag"><?php echo htmlspecialchars($featured_cat_title); ?></span>
            <span><i class="fa-regular fa-clock"></i> <?php echo $featured_news['ddate02']; ?></span>
          </div>

          <h2>
            <a href="<?php echo base_url(); ?>news/<?php echo $featured_news['ccode']; ?>">
              <?php echo htmlspecialchars($featured_news['ctitle']); ?>
            </a>
          </h2>

          <p class="featured-news-desc">
            <?php echo !empty($featured_news['cshort_content']) ? Fstr_limit($featured_news['cshort_content'], 220) : ''; ?>
          </p>
        </div>
      </article>

      <!-- DANH SÁCH BÀI VIẾT CÒN LẠI -->
      <?php if (!empty($remaining_news)): ?>
        <div class="news-grid">
          <?php foreach($remaining_news as $data): 
              $news_gradients = [
                'linear-gradient(135deg,#5b7a95,#8aa5bb)',
                'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
                'linear-gradient(135deg,#9b7fa0,#c3aac6)'
              ];
              $random_news_grad = $news_gradients[array_rand($news_gradients)];
              $item_cat_title = !empty($data['ccat_news']) ? $data['ccat_news'] : (!empty($cat_info['ccat_news']) ? $cat_info['ccat_news'] : 'Tin tức');
          ?>
            <article class="sub-news-card">
              <div class="sub-news-thumb" style="background: <?php echo $random_news_grad; ?>;">
                <?php if(!empty($data['cimage_thumb'])): ?>
                  <img src="<?php echo base_url(); ?>upload/image_article/<?php echo $data['cimage_thumb']; ?>" alt="<?php echo htmlspecialchars($data['ctitle']); ?>" style="width:100%; height:100%; object-fit:cover;">
                <?php else: ?>
                  <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#fff;">
                    <i class="fa-solid fa-newspaper" style="font-size:36px;"></i>
                  </div>
                <?php endif; ?>
              </div>
              
              <div class="sub-news-body">
                <span class="news-tag"><?php echo htmlspecialchars($item_cat_title); ?></span>
                <h3>
                  <a href="<?php echo base_url(); ?>news/<?php echo $data['ccode']; ?>">
                    <?php echo htmlspecialchars($data['ctitle']); ?>
                  </a>
                </h3>
                <p><?php echo !empty($data['cshort_content']) ? Fstr_limit($data['cshort_content'], 100) : ''; ?></p>
                
                <div class="sub-news-meta">
                  <i class="fa-regular fa-calendar"></i> <?php echo $data['ddate02']; ?>
                </div>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

    <?php else: ?>
      <div style="text-align: center; padding: 80px 0; color: var(--text-soft); font-style: italic;">
        Chưa có bài viết nào trong danh mục này!
      </div>
    <?php endif; ?>

    <!-- THANH PHÂN TRANG -->
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
    document.frm_news_pagination.action = "<?php echo base_url(); ?>news-list/<?php echo $cat_param; ?>/" + pageNumber;
    document.frm_news_pagination.submit();
}
</script>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>