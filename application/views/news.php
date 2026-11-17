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

  /* KHOẢNG CÁCH GIỮA CÁC NHÓM TIN */
  .news-category-block {
    margin-bottom: 50px;
  }

  .news-page-header {
    margin-bottom: 24px;
    border-bottom: 2px solid var(--primary-red);
    padding-bottom: 10px;
  }
  .news-page-header h2 {
    font-size: 22px;
    font-weight: 800;
    color: var(--text);
    text-transform: uppercase;
    letter-spacing: 0.02em;
    margin: 0;
  }

  /* TIN ĐẠI DIỆN LỚN NẰM TRÊN */
  .featured-news-card {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 32px;
    padding-bottom: 28px;
    margin-bottom: 28px;
    border-bottom: 1px dashed var(--line);
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
    height: 320px;
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

  .featured-news-body h3 {
    font-size: clamp(20px, 2.2vw, 26px);
    font-weight: 700;
    line-height: 1.35;
    margin: 0 0 14px 0;
  }
  .featured-news-body h3 a {
    color: var(--text);
    transition: color 0.15s ease;
  }
  .featured-news-body h3 a:hover {
    color: var(--primary-red);
  }

  .featured-news-desc {
    font-size: 14.5px;
    line-height: 1.65;
    color: var(--text-soft);
    margin: 0;
  }

  /* GRID 3 TIN NHỎ Ở DƯỚI */
  .sub-news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }
  @media (max-width: 900px) { .sub-news-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 620px) { .sub-news-grid { grid-template-columns: 1fr; } }

  .sub-news-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 3px;
    overflow: hidden;
  }
  .sub-news-thumb {
    height: 160px;
    position: relative;
    overflow: hidden;
  }
  .sub-news-body {
    padding: 16px 18px 18px;
  }
  .sub-news-body .news-tag {
    font-size: 10.5px;
    text-transform: uppercase;
    color: var(--primary-red);
    background: var(--paper-2);
    padding: 3px 8px;
    border-radius: 20px;
    font-weight: 600;
  }
  .sub-news-body h4 {
    font-size: 15.5px;
    margin-top: 10px;
    margin-bottom: 8px;
    line-height: 1.4;
    font-weight: 600;
  }
  .sub-news-body h4 a { color: var(--text); }
  .sub-news-body h4 a:hover { color: var(--primary-red); }
  .sub-news-body p {
    font-size: 13px;
    color: var(--text-soft);
    margin: 0 0 12px 0;
    line-height: 1.5;
  }
  .sub-news-meta {
    font-size: 12px;
    color: var(--mist);
  }

  /* NÚT XEM THÊM Ở CUỐI MỖI NHÓM TIN (VUÔNG VẮN NHƯ ẢNH MẪU) */
  .category-more-wrap {
    text-align: center;
    margin-top: 30px;
  }
  .btn-category-more {
    display: inline-block;
    padding: 10px 32px;
    border: 2px solid #000;
    color: #000;
    font-weight: 800;
    font-size: 15px;
    text-decoration: none;
    transition: all 0.2s ease;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  }
  .btn-category-more:hover {
    background: #000;
    color: #fff;
  }
</style>

<main class="news-page-container">

  <?php if (!empty($news_by_category)): ?>
    
    <?php foreach ($news_by_category as $group): 
        $cat_info  = $group['cat_info'];
        $cat_link  = $group['cat_link'];
        $news_list = $group['news_list'];

        // Tin đầu tiên làm tin đại diện lớn
        $featured_news = $news_list[0];
        // 3 tin còn lại nằm phía dưới
        $sub_news = array_slice($news_list, 1);
    ?>

      <!-- TỪNG KHỐI NHÓM TIN TỨC -->
      <section class="news-category-block">
        
        <div class="news-page-header">
          <h2><?php echo htmlspecialchars($cat_info['ccat_news']); ?></h2>
        </div>

        <!-- 1. TIN ĐẠI DIỆN LỚN -->
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
              <span class="news-tag"><?php echo htmlspecialchars($cat_info['ccat_news']); ?></span>
              <span><i class="fa-regular fa-clock"></i> <?php echo $featured_news['ddate02']; ?></span>
            </div>

            <h3>
              <a href="<?php echo base_url(); ?>news/<?php echo $featured_news['ccode']; ?>">
                <?php echo htmlspecialchars($featured_news['ctitle']); ?>
              </a>
            </h3>

            <p class="featured-news-desc">
              <?php echo !empty($featured_news['cshort_content']) ? Fstr_limit($featured_news['cshort_content'], 220) : ''; ?>
            </p>
          </div>
        </article>

        <!-- 2. 3 TIN NHỎ Ở DƯỚI -->
        <?php if (!empty($sub_news)): ?>
          <div class="sub-news-grid">
            <?php foreach ($sub_news as $item): 
                $news_gradients = [
                  'linear-gradient(135deg,#5b7a95,#8aa5bb)',
                  'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
                  'linear-gradient(135deg,#9b7fa0,#c3aac6)'
                ];
                $random_news_grad = $news_gradients[array_rand($news_gradients)];
            ?>
              <article class="sub-news-card">
                <div class="sub-news-thumb" style="background: <?php echo $random_news_grad; ?>;">
                  <?php if(!empty($item['cimage_thumb'])): ?>
                    <img src="<?php echo base_url(); ?>upload/image_article/<?php echo $item['cimage_thumb']; ?>" alt="<?php echo htmlspecialchars($item['ctitle']); ?>" style="width:100%; height:100%; object-fit:cover;">
                  <?php else: ?>
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#fff;">
                      <i class="fa-solid fa-newspaper" style="font-size:36px;"></i>
                    </div>
                  <?php endif; ?>
                </div>
                
                <div class="sub-news-body">
                  <span class="news-tag"><?php echo htmlspecialchars($cat_info['ccat_news']); ?></span>
                  <h4>
                    <a href="<?php echo base_url(); ?>news/<?php echo $item['ccode']; ?>">
                      <?php echo htmlspecialchars($item['ctitle']); ?>
                    </a>
                  </h4>
                  <p><?php echo !empty($item['cshort_content']) ? Fstr_limit($item['cshort_content'], 100) : ''; ?></p>
                  <div class="sub-news-meta">
                    <i class="fa-regular fa-calendar"></i> <?php echo $item['ddate02']; ?>
                  </div>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <!-- NÚT XEM THÊM Ở CUỐI MỖI NHÓM TIN -->
        <div class="category-more-wrap">
          <a href="<?php echo $cat_link; ?>" class="btn-category-more">Xem thêm</a>
        </div>

      </section>

    <?php endforeach; ?>

  <?php else: ?>
    <div style="text-align: center; padding: 80px 0; color: var(--text-soft); font-style: italic;">
      Hệ thống đang cập nhật dữ liệu các bài đăng tin tức mới!
    </div>
  <?php endif; ?>

</main>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>