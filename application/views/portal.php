<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<main class="page-container">
  <div class="wrap">
    <div class="portal-header" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 16px; margin-bottom: 24px;">
      <div>
        <div class="eyebrow" style="color:var(--brick);">Cổng Chăm Sóc Khách Hàng</div>
        <h2 style="margin: 0;">Trung Tâm Hỗ Trợ & Tiếp Nhận Sự Cố</h2>
      </div>
      <div>
        <a href="<?php echo base_url(); ?>doc_portal" class="btn-doc-portal-action" style="background: linear-gradient(135deg, #ea580c 0%, #f97316 100%); color: #ffffff; padding: 12px 22px; border-radius: 8px; font-weight: 800; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(234, 88, 12, 0.35); transition: all 0.2s ease;">
          <i class="fa-solid fa-folder-tree"></i> Nộp Hồ Sơ Thẩm Định <i class="fa-solid fa-arrow-right" style="font-size: 12px;"></i>
        </a>
      </div>
    </div>

    <!-- Banner điều hướng nhanh sang Cổng Hồ Sơ Thẩm Định -->
    <div style="background: #fff7ed; border: 1px solid #fed7aa; border-left: 4px solid #ea580c; border-radius: 10px; padding: 16px 20px; margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 14px;">
      <div style="display: flex; align-items: center; gap: 14px;">
        <div style="width: 44px; height: 44px; border-radius: 10px; background: #ffedd5; color: #ea580c; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
          <i class="fa-solid fa-file-signature"></i>
        </div>
        <div>
          <strong style="color: #9a3412; font-size: 15px; display: block; margin-bottom: 2px;">Bạn cần đăng ký thuê mặt bằng, thi công cải tạo hoặc sửa chữa kỹ thuật?</strong>
          <span style="color: #7c2d12; font-size: 13.5px;">Truy cập Cổng Thẩm Định Hồ Sơ để tải biểu mẫu chuẩn và theo dõi tiến độ phê duyệt đa phòng ban trực tuyến.</span>
        </div>
      </div>
      <a href="<?php echo base_url(); ?>doc_portal" style="background: #ea580c; color: #ffffff; padding: 9px 18px; border-radius: 6px; font-size: 13.5px; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
        Đến Cổng Thẩm Định <i class="fa-solid fa-chevron-right" style="font-size: 11px;"></i>
      </a>
    </div>

    <div class="portal-grid">      
      <div>
        <p class="portal-lead-text">
          Gặp sự cố về thủ tục pháp lý, thanh toán hoặc cần đính kèm tệp tin tài liệu bàn giao? Hãy gửi ngay ticket hỗ trợ, hệ thống sẽ điều phối trực tiếp tới bộ phận CSKH chuyên trách giải quyết và minh bạch tiến độ từ đầu đến cuối.
        </p>
        
        <ul class="steps portal-steps-flow">
          <li><div class="step-num">1</div><div><h4>Tạo ticket hỗ trợ</h4><p>Mô tả vấn đề vướng mắc và đính kèm file chứng từ liên quan.</p></div></li>
          <li><div class="step-num">2</div><div><h4>Đội ngũ PICO tiếp nhận</h4><p>Nhân viên hoặc quản trị viên chuyên trách trực tiếp vào cuộc xử lý.</p></div></li>
          <li><div class="step-num">3</div><div><h4>Theo dõi trực quan</h4><p>Trạng thái cập nhật liên tục: Mới tiếp nhận → Đang xử lý → Đã hoàn tất.</p></div></li>
        </ul>

        <div class="ticket-mock">
          <div class="ticket-head">
            <div class="mono">MÔ PHỎNG TICKET #PS-1042</div>
            <span class="pill">Đang xử lý</span>
          </div>
          <div class="ticket-body">
            <h4>Yêu cầu xác nhận sổ hồng — Nhà phố Kim Mã</h4>
            <p>Khách hàng cần bản sao sổ hồng đã công chứng để hoàn tất hồ sơ vay ngân hàng.</p>
            <div class="timeline">
              <div class="tl-item"><div class="tl-dot done"></div><div><div class="t-title">Ticket được tạo</div><div class="t-time">28/06/2026 — 09:14</div></div></div>
              <div class="tl-item"><div class="tl-dot done"></div><div><div class="t-title">Nhân viên tiếp nhận</div><div class="t-time">28/06/2026 — 10:02</div></div></div>
              <div class="tl-item"><div class="tl-dot active"></div><div><div class="t-title">Đang xác minh giấy tờ</div><div class="t-time">29/06/2026 — 14:30</div></div></div>
              <div class="tl-item"><div class="tl-dot pending"></div><div><div class="t-title">Hoàn tất &amp; phản hồi khách hàng</div><div class="t-time">Chưa cập nhật</div></div></div>
            </div>
          </div>
        </div>
      </div>

      <div class="tf-card" id="ticket-form">
        <h3><i class="fa-solid fa-paper-plane"></i> Tạo Ticket Hỗ Trợ Nhanh</h3>
        
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
            <label for="tf-title">Tiêu đề nội dung cần hỗ trợ <span class="required-star">*</span></label>
            <input id="tf-title" name="txt_title" type="text" placeholder="Ví dụ: Cần bản sao công chứng sổ hồng dự án Landmark">
          </div>

          <div class="tf-field">
            <label for="tf-desc">Mô tả vấn đề cần hỗ trợ <span class="required-star">*</span></label>
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
		  
          <button type="submit" class="tf-submit">Gửi Yêu Cầu Hỗ Trợ <i class="fa-solid fa-arrow-right"></i></button>
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