<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<main class="page-container">
  <div class="wrap">
    <div class="portal-header" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
      <div>
        
        <h2 style="margin: 0;">CỔNG KHÁCH HÀNG</h2>
      </div>
      
    </div>

    <div class="portal-grid">      
      <div>
          <?php echo (get_module_note(20)); ?>
          <?php echo (get_module_note(21)); ?>
      </div>

      <div class="tf-card" id="ticket-form">
        <h3><i class="fa-solid fa-paper-plane"></i> Tạo Phiếu Góp Ý</h3>
        
        <?php if(isset($_SESSION['ticket_flash_error']) && $_SESSION['ticket_flash_error'] != ''): ?>
          <div class="backend-alert-error">
            <i class="fa-solid fa-circle-exclamation"></i>
            <?php 
              echo $_SESSION['ticket_flash_error']; 
              unset($_SESSION['ticket_flash_error']); 
            ?>
          </div>
        <?php endif; ?>

        <div id="js-ticket-alert" class="js-alert-error">
          <i class="fa-solid fa-circle-exclamation"></i> <span id="js-ticket-alert-text"></span>
        </div>

        <form name="frm_customer_ticket" method="POST" action="<?php echo base_url(); ?>ticket/create" enctype="multipart/form-data" onsubmit="return validateCustomerTicket();">
          <div class="tf-row">
            <div class="tf-field">
              <label for="tf-name">Họ và tên <span class="required-star">*</span></label>
              <input id="tf-name" name="txt_name" type="text" placeholder="Nguyễn Văn A" value="<?php echo $txt_name; ?>" <?php echo $readonly; ?>>
            </div>
            <div class="tf-field">
              <label for="tf-email">Địa chỉ email <span class="required-star">*</span></label>
              <input id="tf-email" name="txt_email" type="text" placeholder="name@example.com" value="<?php echo $txt_email; ?>" <?php echo $readonly; ?>>
            </div>
          </div>

          <div class="tf-field">
            <label for="tf-title">Tiêu đề nội dung góp ý <span class="required-star">*</span></label>
            <input id="tf-title" name="txt_title" type="text" placeholder="Ví dụ: Cần bản sao công chứng sổ hồng dự án Landmark">
          </div>

          <div class="tf-field">
            <label for="tf-desc">Mô tả vấn đề góp ý <span class="required-star">*</span></label>
            <textarea id="tf-desc" name="txt_content" rows="5" placeholder="Vui lòng ghi rõ chi tiết nội dung hoặc các vướng mắc thủ tục cần trợ giúp..."></textarea>
          </div>

          <div class="tf-field">
            <label for="tf-upload">Đính kèm tài liệu liên quan <span class="text-muted">(Hình ảnh, PDF dưới 2MB)</span></label>
            <div class="tf-file">
              <label class="tf-file-btn" for="tf-upload">Chọn tệp</label>
              <input id="tf-upload" name="file_attach" type="file" accept="image/*,application/pdf" hidden onchange="document.getElementById('tf-filename').textContent = this.files.length ? this.files[0].name : 'Không có tệp nào được chọn';">
              <span class="tf-file-name" id="tf-filename">Không có tệp nào được chọn</span>
            </div>
          </div>
		  
		  <div class="tf-field">
			<div class="g-recaptcha" data-sitekey="6Lf9Rz0dAAAAAOVHMuWHKEFCXad_HLjn5g21reHr"></div>
		  </div>
		  
          <button type="submit" class="tf-submit">Gửi Phiếu <i class="fa-solid fa-arrow-right"></i></button>
          <input type="hidden" name="hidden_action" value="create_ticket">
        </form>
      </div>

    </div>
  </div>
</main>
<script src='https://www.google.com/recaptcha/api.js'></script>
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>