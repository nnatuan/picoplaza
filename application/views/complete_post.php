<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
    /* BỎ DISPLAY FLEX Ở BODY ĐỂ TRÁNH LỖI VỠ LAYOUT HEADER / FOOTER */
    .success-wrapper {
        background-color: #f8fafc;
        padding: 60px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 350px); /* Tự động bù trừ khoảng trống cho vừa khít màn hình */
    }

    .success-container {
        max-width: 580px;
        width: 100%;
        background-color: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    /* Hiệu ứng hoạt họa cho vòng tròn Icon thành công */
    .icon-box {
        width: 80px;
        height: 80px;
        background-color: #f0fdf4;
        border: 2px solid #bbf7d0;
        color: #16a34a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px auto;
        font-size: 36px;
        animation: scaleUp 0.4s ease-out forwards;
    }
    
    .status-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }
    .status-desc {
        font-size: 15px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    
    /* Hộp thông báo trạng thái chờ duyệt nổi bật */
    .alert-moderation {
        background-color: #fff7ed;
        border: 1px solid #ffedd5;
        border-left: 4px solid #ea580c;
        border-radius: 6px;
        padding: 16px;
        text-align: left;
        margin-bottom: 35px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }
    .alert-moderation i {
        color: #ea580c;
        font-size: 18px;
        margin-top: 2px;
    }
    .alert-moderation p {
        font-size: 14px;
        color: #c2410c;
        font-weight: 500;
        line-height: 1.5;
	    margin-top: 0;	
    }
    
    /* Khu vực nút bấm điều hướng hành động */
    .action-group {
        display: flex;
        gap: 15px;
        justify-content: center;
    }
    .btn-action-post {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .btn-action-primary {
        background-color: #b65c38;
        color: #fff;
        border: 1px solid #b65c38;
    }
    .btn-action-primary:hover {
        background-color: #a04f2e;
        border-color: #a04f2e;
    }
    .btn-action-secondary {
        background-color: #fff;
        color: #475569;
        border: 1px solid #cbd5e1;
    }
    .btn-action-secondary:hover {
        background-color: #f8fafc;
        color: #1e293b;
        border-color: #94a3b8;
    }
    
    @keyframes scaleUp {
        0% { transform: scale(0.6); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>

<div class="success-wrapper">
    <div class="success-container">
        
        <div class="icon-box">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        
        <h2 class="status-title">Đăng Tin Thành Công!</h2>
        <p class="status-desc">
            Cảm ơn bạn đã tin tưởng và lựa chọn sàn giao dịch <strong>PICO Saigon</strong>. <br>
            Tin đăng bất động sản của bạn đã được gửi lên hệ thống thành công!
        </p>
        
        <div class="alert-moderation">
            <i class="fa-solid fa-clock-rotate-left"></i>
            <div>
                <p>Tin đăng của bạn đang ở trạng thái chờ duyệt.</p>
                <p style="color: #64748b; font-weight: 400; margin-top: 4px; font-size: 13px;">
                    Đội ngũ chuyên viên nội bộ của chúng tôi đang tiến hành rà soát các thông số kỹ thuật và hồ sơ đính kèm. Bài viết sẽ được xuất bản công khai ngoài trang chủ ngay sau khi được phê duyệt.
                </p>
            </div>
        </div>
        
        <div class="action-group">
            <a href="<?php echo base_url(); ?>my_posts" class="btn-action-post btn-action-secondary">
                <i class="fa-solid fa-table-list"></i> Quản lý tin đăng
            </a>
            <a href="<?php echo base_url(); ?>post_listing" class="btn-action-post btn-action-primary">
                <i class="fa-solid fa-circle-plus"></i> Tiếp tục đăng tin
            </a>
        </div>
        
    </div>
</div>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>