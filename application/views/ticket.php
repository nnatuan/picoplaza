<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
  .portal-container {
    max-width: 1180px;
    margin: 40px auto;
    padding: 0 32px;
    font-family: 'Manrope', sans-serif;
  }
  @media (max-width:640px){ .portal-container { padding:0 20px; } }

  .portal-grid {
    display: grid;
    grid-template-columns: 1fr 1.1fr;
    gap: 50px;
    align-items: start;
  }
  @media (max-width: 900px){ .portal-grid { grid-template-columns: 1fr; gap: 40px; } }

  .portal-info h1 {
    font-size: 32px;
    line-height: 1.2;
    margin-bottom: 16px;
    font-family: 'Manrope', sans-serif;
  }
  .portal-info p.lede {
    color: var(--text-soft);
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 24px;
  }

  .ticket-real-box {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: var(--radius);
    box-shadow: 0 15px 35px rgba(15, 23, 42, 0.04);
    overflow: hidden;
  }

  .ticket-head-bar {
    background: var(--paper-3);
    padding: 18px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid var(--primary-red);
  }
  .ticket-head-bar .code-title {
    font-family: 'Manrope', sans-serif;
    font-size: 14px;
    font-weight: 700;
    color: var(--primary-red-deep);
  }

  .status-pill {
    font-size: 11.5px;
    font-weight: 700;
    padding: 5px 12px;
    border-radius: 20px;
    color: #fff;
  }
  .status-pill.status-1 { background: var(--primary-red); }    /* Mới tiếp nhận */
  .status-pill.status-2 { background: var(--accent-orange); } /* Đang xử lý */
  .status-pill.status-3 { background: #3f6b57; }               /* Đã giải quyết */

  .ticket-body-main {
    padding: 24px;
  }
  .ticket-body-main h2 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 10px;
    line-height: 1.3;
    color: var(--text);
    font-family: 'Manrope', sans-serif;
  }
  .ticket-desc-text {
    font-size: 14px;
    color: var(--text-soft);
    line-height: 1.6;
    background: var(--paper-2);
    padding: 16px;
    border-radius: var(--radius);
    margin-bottom: 28px;
    white-space: pre-line;
  }

  /* TRỤC TIMELINE THỰC TẾ */
  .timeline-flow {
    display: grid;
    gap: 20px;
    position: relative;
    padding-left: 4px;
  }
  .timeline-flow::before {
    content: "";
    position: absolute;
    left: 9px; top: 8px; bottom: 8px;
    width: 1px;
    background: var(--line);
  }

  .tl-node-row {
    display: flex;
    gap: 16px;
    align-items: flex-start;
    position: relative;
  }
  .tl-node-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-top: 6px;
    flex: none;
    z-index: 2;
    background: var(--line);
  }
  .tl-node-row.node-done .tl-node-dot { background: #3f6b57; }
  .tl-node-row.node-active .tl-node-dot { 
    background: var(--primary-red); 
    box-shadow: 0 0 0 4px rgba(218, 37, 28, 0.18); 
  }

  .tl-node-content {
    flex: 1;
  }
  .tl-node-msg {
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text);
    line-height: 1.4;
  }
  .tl-node-msg.staff-reply {
    color: var(--primary-red-deep);
  }
  .tl-node-time {
    font-size: 11px;
    color: var(--mist);
    font-family: 'Manrope', sans-serif;
    margin-top: 3px;
  }

  .info-list-meta {
    list-style: none;
    padding: 0; margin: 24px 0 0 0;
    font-size: 13.5px;
    display: grid;
    gap: 12px;
    border-top: 1px dashed var(--line);
    padding-top: 18px;
  }
  .info-list-meta li span { font-weight: 700; color: var(--text); }
  
  .attach-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--primary-red);
    font-weight: 700;
    text-decoration: underline;
  }
  .attach-link:hover {
    color: var(--primary-red-deep);
  }
  .btn-portal-back {
    display: inline-block;
    margin-top: 24px;
    background: var(--text);
    color: #fff;
    padding: 12px 24px;
    font-size: 13.5px;
    font-weight: 700;
    border-radius: var(--radius);
    transition: background 0.15s ease;
  }
  .btn-portal-back:hover { background: var(--primary-red); }
</style>

<div class="portal-container">
  <div class="portal-grid">
    
    <div class="portal-info">
      <div class="eyebrow" style="color:var(--primary-red);">Cổng dịch vụ hành chính</div>
      <h1>Cổng thông tin tra cứu xử lý Ticket yêu cầu</h1>
      <p class="lede">Hệ thống minh bạch hóa toàn bộ tiến trình điều phối hỗ trợ kỹ thuật, thủ tục, pháp lý giấy tờ cho khách hàng của PICO Saigon.</p>
      
      <div style="background: var(--paper-2); padding: 20px; border-left: 3px solid var(--accent-orange);">
        <h4 style="margin:0 0 6px 0; font-size:14px; font-weight:700;">📌 Lưu ý dành cho khách hàng:</h4>
        <p style="margin:0; font-size:13px; color:var(--text-soft); line-height:1.5;">Hãy lưu lại đường dẫn URL của trang này để truy cập trực tiếp kiểm tra tiến độ phản hồi từ quản trị viên bất cứ lúc nào.</p>
      </div>
      
      <a href="<?php echo base_url(); ?>my_tickets" class="btn-portal-back"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
    </div>

    <div class="ticket-real-box">
      <div class="ticket-head-bar">
        <div class="code-title">TICKET #<?php echo $ticket['cticket_code']; ?></div>
        
        <?php if($ticket['nstatus'] == 1): ?>
          <span class="status-pill status-1">Mới tiếp nhận</span>
        <?php elseif($ticket['nstatus'] == 2): ?>
          <span class="status-pill status-2">Đang xử lý</span>
        <?php else: ?>
          <span class="status-pill status-3">Đã giải quyết</span>
        <?php endif; ?>
      </div>

      <div class="ticket-body-main">
        <h2><?php echo $ticket['ctitle']; ?></h2>
        <div class="ticket-desc-text"><?php echo $ticket['ccontent']; ?></div>

        <div class="timeline-flow">
          <?php 
          $total_logs = count($ticket_logs);
          foreach($ticket_logs as $index => $log): 
              // Dòng cuối cùng gán class active để sáng đèn
              $is_last = ($index === $total_logs - 1 && $ticket['nstatus'] != 3);
              $class_node = ($ticket['nstatus'] == 3) ? 'node-done' : ($is_last ? 'node-active' : 'node-done');
          ?>
            <div class="tl-node-row <?php echo $class_node; ?>">
              <div class="tl-node-dot"></div>
              <div class="tl-node-content">
                <div class="tl-node-msg <?php echo ($log['cis_staff_reply'] == '1') ? 'staff-reply' : ''; ?>">
                  <?php if($log['cis_staff_reply'] == '1'): ?>
                    <i class="fa-solid fa-user-shield"></i> <strong>Chuyên viên phản hồi:</strong>
                  <?php endif; ?>
                  <?php echo $log['ccontent_reply']; ?>
                </div>
                <div class="tl-node-time"><?php echo date('d/m/Y — H:i', strtotime($log['dreply_at'])); ?></div>
              </div>
            </div>
          <?php endforeach; ?>

          <?php if($ticket['nstatus'] == 3): ?>
            <div class="tl-node-row node-done">
              <div class="tl-node-dot" style="background:#3f6b57; box-shadow: 0 0 0 4px rgba(63,107,87,0.18);"></div>
              <div class="tl-node-content">
                <div class="tl-node-msg" style="color:#3f6b57; font-weight:700;"><i class="fa-solid fa-circle-check"></i> Đóng Ticket — Sự cố đã được xử lý hoàn tất.</div>
                <div class="tl-node-time"><?php echo date('d/m/Y — H:i', strtotime($ticket['dresolved_at'])); ?></div>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <ul class="info-list-meta">
          <li><span>Khách hàng yêu cầu:</span> <?php echo $ticket['cname']; ?></li>
          <li><span>Địa chỉ Email nhận báo:</span> <?php echo $ticket['cemail']; ?></li>
          <li><span>Thời gian khởi tạo:</span> <?php echo date('H:i, d/m/Y', strtotime($ticket['dcreated_at'])); ?></li>
          <?php if(!empty($ticket['cfile_attach'])): ?>
            <li>
              <span>Tài liệu đính kèm:</span> 
              <a href="<?php echo base_url(); ?>upload/tickets/<?php echo $ticket['cfile_attach']; ?>" target="_blank" class="attach-link">
                <i class="fa-solid fa-paperclip"></i> Xem file đính kèm
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

  </div>
</div>

<?php 
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>