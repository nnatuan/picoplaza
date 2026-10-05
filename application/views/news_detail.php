<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
  .news-detail-container {
    max-width: 800px;
    margin: 50px auto;
    padding: 0 24px;
    font-family: 'Manrope', sans-serif;
  }
  @media (max-width: 640px) {
    .news-detail-container { margin: 30px auto; padding: 0 20px; }
  }

  .news-detail-header {
    margin-bottom: 32px;
    border-bottom: 1px solid var(--line);
    padding-bottom: 24px;
  }
  .news-detail-header .news-tag {
    display: inline-block;
    background: var(--paper-3);
    color: var(--text);
    font-size: 12px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: var(--radius);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 16px;
  }
  .news-detail-header h1 {
    font-size: clamp(26px, 4vw, 38px);
    font-weight: 800;
    line-height: 1.3;
    color: var(--text);
    margin-bottom: 18px;
    font-family: 'Fraunces', serif;
  }
  .news-detail-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 13.5px;
    color: var(--text-soft);
    font-weight: 500;
  }
  .news-detail-meta span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
  }
  .news-detail-meta i {
    color: var(--mist);
  }

  .news-detail-cover {
    width: 100%;
    border-radius: var(--radius);
    overflow: hidden;
    border: 1px solid var(--line);
    margin-bottom: 36px;
    background: var(--paper-2);
  }
  .news-detail-cover img {
    width: 100%;
    height: auto;
    max-height: 450px;
    object-fit: cover;
    display: block;
  }

  .news-detail-body {
    font-size: 16.5px;
    line-height: 1.8;
    color: var(--text);
  }

  .news-detail-body img {
    max-width: 100%;
    height: auto;
    border-radius: var(--radius);
    margin: 16px 0;
  }

  .news-detail-footer {
    margin-top: 48px;
    padding-top: 24px;
    border-top: 1px dashed var(--line);
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .btn-news-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    font-weight: 700;
    color: var(--text);
    transition: color 0.15s ease;
  }
  .btn-news-back:hover {
    color: var(--brick);
  }
</style>

<main class="news-detail-container">
  
  <div class="news-detail-header">
    <span class="news-tag"><?php echo get_cat_news_title($obj_news['nid_cat_news']); ?></span>
    
    <h1><?php echo $obj_news['ctitle']; ?></h1>
    
    <div class="news-detail-meta">
      <span><i class="fa-regular fa-calendar"></i> <?php echo $obj_news['ddate02']; ?></span>
      <span><i class="fa-regular fa-folder"></i> PICO PLAZA</span>
    </div>
  </div>

  <?php if(!empty($obj_news['cimage'])): ?>
    <div class="news-detail-cover">
      <img src="<?php echo base_url(); ?>upload/news/<?php echo $obj_news['cimage']; ?>" alt="<?php echo $obj_news['ctitle']; ?>">
    </div>
  <?php endif; ?>

  <article class="news-detail-body">
    <?php echo $obj_news['ccontent']; ?>
  </article>

</main>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>