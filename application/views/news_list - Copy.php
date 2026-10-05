<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
  /* Khối tiêu đề trang tin tức */
  .news-page-header {
    margin-bottom: 36px;
    border-bottom: 1px solid var(--line);
    padding-bottom: 20px;
  }
  .news-page-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: var(--text);
  }
  .news-page-header p {
    color: var(--text-soft);
    font-size: 14.5px;
    margin-top: 6px;
  }

  /* Lưới Grid 3 cột vuông vắn đồng bộ ngoài Home */
  .news-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
  }
  @media (max-width: 900px) { .news-grid { grid-template-columns: 1fr 1fr; } }
  @media (max-width: 620px) { .news-grid { grid-template-columns: 1fr; } }

  .news-card {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: 3px;
    overflow: hidden;
    transition: transform .18s ease, box-shadow .18s ease;
  }
  .news-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.05);
  }
  .news-thumb {
    height: 160px;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  .news-thumb i {
    font-size: 38px;
    color: rgba(255, 255, 255, 0.9);
    position: relative;
    z-index: 2;
  }
  .news-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    top: 0; left: 0;
    z-index: 1;
  }

  /* Khối phân trang tin tức dùng chung form ẩn */
  .news-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    margin-top: 40px;
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
</style>

<form name="frm_news_pagination" method="POST" action="<?php echo base_url(); ?>news_list/cat_page/<?php echo $nid_cat; ?>/<?php echo $cur_page; ?>">
  
  <main class="page-container">
    
    <div class="news-page-header">
      <h1><?php echo $title; ?></h1>
      <p>Tổng hợp các bài viết chia sẻ kinh nghiệm, phân tích biến động thị trường bất động sản.</p>
    </div>

    <div class="news-grid">
      <?php 
        foreach($obj_news_list as $data) {
            // Dải màu Gradient nền ngẫu nhiên cho bài không tải ảnh đại diện
            $news_gradients = [
                'linear-gradient(135deg,#5b7a95,#8aa5bb)',
                'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
                'linear-gradient(135deg,#9b7fa0,#c3aac6)'
            ];
            $random_news_grad = $news_gradients[array_rand($news_gradients)];
            
            // Tự động nhận diện lớp Icon Font-Awesome theo tên chuỗi text danh mục
            $news_icon = 'fa-chart-line';
            if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'pháp lý') !== false) $news_icon = 'fa-scale-balanced';
            if(isset($data['ccat_news']) && strpos(mb_strtolower($data['ccat_news']), 'đầu tư') !== false) $news_icon = 'fa-umbrella-beach';
      ?>
        <article class="news-card">
          <div class="news-thumb" data-gradient="<?php echo $random_news_grad; ?>">
            <?php if(!empty($data['cimage'])): ?>
              <img src="<?php echo base_url(); ?>upload/news/<?php echo $data['cimage']; ?>" alt="<?php echo $data['ctitle']; ?>">
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
            
            <p><?php echo !empty($data['cshort_content']) ? Fstr_limit($data['cshort_content'], 110) : ''; ?></p>
            
            <div class="news-meta">
              <span><i class="fa-regular fa-calendar"></i> <?php echo $data['ddate01']; ?></span>
              <a class="view-link" href="<?php echo base_url(); ?>news/<?php echo $data['ccode']; ?>">Đọc thêm →</a>
            </div>
          </div>
        </article>
      <?php } ?>

      <?php if(empty($obj_news_list)): ?>
        <div style="grid-column: span 3; text-align: center; padding: 64px 0; color: var(--text-soft); font-style: italic;">
          Hệ thống đang cập nhật dữ liệu các bài đăng tin tức mới!
        </div>
      <?php endif; ?>
    </div>

    <?php if($total_page > 1): ?>
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

  <input type="hidden" id="txt_current_page" name="txt_current_page" value="<?php echo $cur_page; ?>" />
</form>

<script type="text/javascript">
// Điều khiển gửi dữ liệu form phân trang đồng bộ về Controller sạch
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