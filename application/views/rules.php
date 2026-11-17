<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>

<div class="page-container">
	<?php echo get_module_note(18); 
	/*
  <div class="section-head" style="margin-bottom: 24px;">
    <div>
      <span class="eyebrow">Quy định & Vận hành</span>
      <h2>Nội quy & Quy định Tòa nhà</h2>
    </div>
    <p>Tổng hợp các văn bản nội quy, quy định vận hành và hướng dẫn an toàn dành cho Thành viên và Khách hàng tại PICO Saigon.</p>
  </div>
  */ ?>

  <!-- TAB SWITCHER -->
  <div class="doc-tab-nav">
    <button class="doc-tab-btn active" onclick="switchDocTab(this, 'tab-public')">
      <i class="fa-solid fa-scale-balanced"></i> Nội quy Công khai
    </button>
    <button class="doc-tab-btn" onclick="switchDocTab(this, 'tab-member')">
      <i class="fa-solid fa-user-shield"></i> Dành cho Khách hàng
    </button>
  </div>

  <!-- TAB 1: NỘI QUY PUBLIC -->
  <div id="tab-public" class="doc-tab-content active">
    <?php if(!empty($rules_public)): ?>
      <div class="doc-grid">
        <?php foreach($rules_public as $doc): ?>
          <div class="doc-card">
            <div class="doc-icon"><i class="fa-solid fa-book-bookmark"></i></div>
            <div class="doc-info">
              <h4><?php echo $doc['ctitle']; ?></h4>
              <p><?php echo !empty($doc['cdescription']) ? $doc['cdescription'] : 'Không có mô tả chi tiết.'; ?></p>
              <div class="doc-meta">
                <span><i class="fa-solid fa-hard-drive"></i> <?php echo !empty($doc['cfile_size']) ? $doc['cfile_size'] : '-'; ?></span>
                <span><i class="fa-solid fa-calendar-day"></i> <?php echo date('d/m/Y', strtotime($doc['dcreated_at'])); ?></span>
              </div>
            </div>
            <div class="doc-action">
              <a href="<?php echo base_url() . 'index.php/rules/download/' . $doc['nid']; ?>" class="btn-doc-download">
                <i class="fa-solid fa-download"></i> Tải về
              </a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="doc-empty-box">
        <i class="fa-regular fa-folder-open"></i>
        <p>Hiện chưa có văn bản nội quy nào được đăng tải.</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- TAB 2: NỘI QUY MEMBER -->
  <div id="tab-member" class="doc-tab-content">
    <?php if($is_logged_in): ?>
      <?php if(!empty($rules_member)): ?>
        <div class="doc-grid">
          <?php foreach($rules_member as $doc): ?>
            <div class="doc-card card-member">
              <div class="doc-icon"><i class="fa-solid fa-file-shield"></i></div>
              <div class="doc-info">
                <h4><?php echo $doc['ctitle']; ?></h4>
                <p><?php echo !empty($doc['cdescription']) ? $doc['cdescription'] : 'Văn bản nội quy dành riêng cho tài khoản Khách hàng đã đăng nhập.'; ?></p>
                <div class="doc-meta">
                  <span><i class="fa-solid fa-hard-drive"></i> <?php echo !empty($doc['cfile_size']) ? $doc['cfile_size'] : '-'; ?></span>
                  <span><i class="fa-solid fa-calendar-day"></i> <?php echo date('d/m/Y', strtotime($doc['dcreated_at'])); ?></span>
                </div>
              </div>
              <div class="doc-action">
                <a href="<?php echo base_url() . 'index.php/rules/download/' . $doc['nid']; ?>" class="btn-doc-download btn-member-dl">
                  <i class="fa-solid fa-download"></i> Tải về (Khách hàng)
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="doc-empty-box">
          <i class="fa-regular fa-folder-open"></i>
          <p>Hiện chưa có văn bản nội quy nào được đăng tải.</p>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <!-- YÊU CẦU ĐĂNG NHẬP NẾU CHƯA LOGGED IN -->
      <div class="doc-lock-box">
        <div class="lock-icon"><i class="fa-solid fa-lock"></i></div>
        <h3>Quy định dành riêng cho Khách hàng</h3>
        <p>Vui lòng đăng nhập tài khoản Khách hàng do Ban Quản Lý cấp để xem và tải các quy định hành chính nội bộ.</p>
        <a href="<?php echo base_url(); ?>index.php/auth" class="btn btn-gold" style="margin-top: 15px;">
          <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập ngay
        </a>
      </div>
    <?php endif; ?>
  </div>

</div>

<!-- CSS DÙNG CHUNG STYLE TRANG TÀI LIỆU -->
<style type="text/css">
.doc-tab-nav {
  display: flex;
  gap: 12px;
  border-bottom: 2px solid var(--line);
  margin-bottom: 30px;
}
.doc-tab-btn {
  background: none;
  border: none;
  padding: 12px 20px;
  font-size: 15px;
  font-weight: 700;
  color: var(--text-soft);
  border-bottom: 3px solid transparent;
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  margin-bottom: -2px;
}
.doc-tab-btn.active {
  color: var(--primary-red);
  border-bottom-color: var(--primary-red);
}
.doc-tab-content { display: none; }
.doc-tab-content.active { display: block; animation: fadeIn 0.3s ease; }

.doc-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 16px;
}
.doc-card {
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: 4px;
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 20px;
  transition: transform 0.15s ease, box-shadow 0.15s ease;
}
.doc-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.04);
}
.doc-icon {
  width: 50px;
  height: 50px;
  border-radius: 6px;
  background: #fff5ed;
  color: var(--accent-orange);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
}
.doc-info { flex: 1; }
.doc-info h4 { font-size: 16px; font-weight: 700; margin: 0 0 6px 0; color: var(--text); }
.doc-info p { font-size: 13.5px; color: var(--text-soft); margin: 0 0 8px 0; line-height: 1.5; }
.doc-meta { display: flex; gap: 18px; font-size: 12px; color: var(--mist); }
.doc-meta i { margin-right: 4px; }

.btn-doc-download {
  background: var(--paper-3);
  color: var(--text);
  border: 1px solid var(--line);
  padding: 10px 18px;
  font-size: 13.5px;
  font-weight: 700;
  border-radius: 4px;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  transition: all 0.15s ease;
}
.btn-doc-download:hover {
  background: var(--primary-red);
  border-color: var(--primary-red);
  color: #ffffff;
}

.doc-lock-box {
  text-align: center;
  padding: 50px 20px;
  background: var(--paper-2);
  border: 1px dashed var(--line);
  border-radius: 6px;
  max-width: 600px;
  margin: 20px auto;
}
.doc-lock-box .lock-icon {
  width: 60px; height: 60px; border-radius: 50%;
  background: #fff5ed; color: var(--accent-orange);
  display: flex; align-items: center; justify-content: center;
  font-size: 24px; margin: 0 auto 16px;
}
.doc-lock-box h3 { font-size: 18px; font-weight: 700; margin-bottom: 8px; }
.doc-lock-box p { font-size: 14px; color: var(--text-soft); line-height: 1.6; }

.doc-empty-box {
  text-align: center; padding: 40px; color: var(--text-soft); font-size: 15px;
}
.doc-empty-box i { font-size: 36px; color: var(--mist); margin-bottom: 10px; display: block; }

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(4px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>

<script type="text/javascript">
function switchDocTab(btn, tabId) {
  var buttons = document.getElementsByClassName('doc-tab-btn');
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].classList.remove('active');
  }
  btn.classList.add('active');

  var contents = document.getElementsByClassName('doc-tab-content');
  for (var j = 0; j < contents.length; j++) {
    contents[j].classList.remove('active');
  }
  document.getElementById(tabId).classList.add('active');
}
</script>

<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>