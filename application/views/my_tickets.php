<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
    .ticket-page-container {
        max-width: 1180px;
        margin: 40px auto;
        padding: 0 32px;
        font-family: 'Manrope', sans-serif;
    }
    @media (max-width: 640px) { .ticket-page-container { padding: 0 20px; } }

    .ticket-page-header {
        margin-bottom: 30px;
        border-bottom: 1px dashed var(--line);
        padding-bottom: 15px;
    }
    .ticket-page-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text);
        font-family: 'Manrope', sans-serif;
    }
    .ticket-page-title i {
        color: var(--primary-red);
        margin-right: 10px;
    }

    /* Bố cục danh sách Ticket dạng hàng (Row-Bar) */
    .ticket-list-wrapper {
        display: grid;
        gap: 16px;
    }
    .ticket-row-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 4px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.01);
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .ticket-row-card:hover {
        border-color: var(--primary-red);
        box-shadow: 0 10px 25px rgba(218, 37, 28, 0.04);
    }
    @media (max-width: 768px) {
        .ticket-row-card { flex-direction: column; align-items: flex-start; gap: 16px; padding: 20px; }
    }

    /* Khung hiển thị mã định danh nổi bật */
    .ticket-code-badge {
        background: var(--paper-3);
        color: var(--text);
        font-family: 'Manrope', sans-serif;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 14px;
        border-radius: 2px;
        border-left: 3px solid var(--primary-red);
        min-width: 105px;
        text-align: center;
    }

    .ticket-info-block {
        flex: 1;
    }
    .ticket-info-block h4 {
        font-size: 16px;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 6px 0;
        line-height: 1.4;
        font-family: 'Manrope', sans-serif;
    }
    .ticket-info-block .meta-time {
        font-size: 12.5px;
        color: var(--text-soft);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* Nhãn trạng thái tròn mềm mại */
    .status-dot-pill {
        font-size: 12px;
        font-weight: 700;
        padding: 4px 14px;
        border-radius: 20px;
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .status-dot-pill.st-1 { background: var(--primary-red); }
    .status-dot-pill.st-2 { background: var(--accent-orange); color: #fff; }
    .status-dot-pill.st-3 { background: #3f6b57; }

    /* Nút xem chi tiết */
    .btn-view-progress {
        background: transparent;
        color: var(--text);
        border: 1px solid var(--line);
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 700;
        border-radius: 2px;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.15s ease;
    }
    .btn-view-progress:hover {
        background: var(--primary-red);
        color: #fff !important;
        border-color: var(--primary-red);
    }
    @media (max-width: 768px) {
        .btn-view-progress { width: 100%; justify-content: center; text-align: center; }
    }

    .ticket-empty-box {
        text-align: center;
        padding: 60px 40px;
        background: var(--card);
        border: 1px dashed var(--line);
        border-radius: 4px;
        color: var(--text-soft);
        font-style: italic;
    }
</style>

<div class="ticket-page-container">
    
    <div class="ticket-page-header">
        <div class="ticket-page-title">
            <i class="fa-solid fa-headset"></i> Yêu cầu hỗ trợ của tôi
        </div>
    </div>

    <div class="ticket-list-wrapper">
        <?php 
        if (!empty($tickets) && is_array($tickets)):
            foreach ($tickets as $row) {
                $date_display = date('d/m/Y — H:i', strtotime($row['dcreated_at']));
        ?>
                <div class="ticket-row-card">
                    <div class="ticket-code-badge">
                        #<?php echo $row['cticket_code']; ?>
                    </div>
                    
                    <div class="ticket-info-block">
                        <h4><?php echo htmlspecialchars($row['ctitle']); ?></h4>
                        <div class="meta-time">
                            <i class="fa-solid fa-clock"></i> Khởi tạo vào lúc: <?php echo $date_display; ?>
                        </div>
                    </div>
                    
                    <div>
                        <?php if ((int)$row['nstatus'] === 1): ?>
                            <span class="status-dot-pill st-1"><i class="fa-solid fa-circle-dot"></i> Mới nhận</span>
                        <?php elseif ((int)$row['nstatus'] === 2): ?>
                            <span class="status-dot-pill st-2"><i class="fa-solid fa-spinner"></i> Đang xử lý</span>
                        <?php else: ?>
                            <span class="status-dot-pill st-3"><i class="fa-solid fa-circle-check"></i> Đã xong</span>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <a href="<?php echo base_url(); ?>ticket/detail/<?php echo $row['cticket_code']; ?>" class="btn-view-progress">
                            <i class="fa-solid fa-magnifying-glass"></i> Xem tiến độ
                        </a>
                    </div>
                </div>
        <?php 
            } 
        else: 
        ?>
            <div class="ticket-empty-box">
                <i class="fa-solid fa-comments-question" style="font-size: 36px; margin-bottom: 12px; display: block; color: var(--mist);"></i>
                Hiện tại hệ thống chưa ghi nhận yêu cầu phản ánh hoặc ticket hỗ trợ sự cố nào từ tài khoản của bạn.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>