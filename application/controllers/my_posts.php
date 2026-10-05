<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        .page-header {
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 15px;
        }
        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
        }
        .page-title i {
            color: #b65c38;
            margin-right: 8px;
        }
        .btn-post {
            background-color: #b65c38;
            color: #fff;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }
        .btn-post:hover {
            background-color: #a04f2e;
        }
        
        /* GIỮ NGUYÊN LAYOUT HÀNG NGANG (LISTVIEW) */
        .post-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .post-card {
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 16px;
            display: flex;
            gap: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .post-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        /* Khung chứa ảnh hoặc dải màu thay thế */
        .post-img-wrap {
            width: 140px;
            height: 100px;
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background-color: #f1f5f9;
        }
        .post-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .post-img-wrap i {
            font-size: 32px;
            color: rgba(255, 255, 255, 0.9);
            text-shadow: 0 1px 3px rgba(0,0,0,0.15);
        }
        
        .post-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .post-main-detail h4 {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
            line-height: 1.4;
        }
        .post-main-detail h4 a {
            color: #1e293b;
            text-decoration: none;
        }
        .post-main-detail h4 a:hover {
            color: #b65c38;
        }
        .post-meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #64748b;
            margin-bottom: 6px;
        }
        .post-meta span i {
            margin-right: 4px;
            color: #94a3b8;
        }
        .post-price {
            font-size: 15px;
            font-weight: 700;
            color: #b65c38;
            font-family: 'JetBrains Mono', monospace;
        }
        
        .post-status-zone {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
            min-width: 140px;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
            text-align: center;
        }
        .badge-approved {
            background-color: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }
        .badge-pending {
            background-color: #fff7ed;
            color: #ea580c;
            border: 1px solid #ffedd5;
        }
        .post-actions {
            display: flex;
            gap: 8px;
        }
        .btn-action {
            font-size: 12px;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            border: 1px solid #cbd5e1;
            color: #475569;
            background: #fff;
        }
        .btn-action:hover {
            background: #f8fafc;
            color: #1e293b;
        }
        .empty-state {
            text-align: center;
            padding: 50px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            color: #94a3b8;
            font-style: italic;
        }
    </style>


<div class="page-container">
    
    <div class="page-header">
        <div class="page-title">
            <i class="fa-solid fa-building"></i> Tin đăng của tôi
        </div>

    </div>

    <div class="post-list">
        <?php 
        if (!empty($list) && is_array($list)):
            foreach ($list as $row) {
                // Định dạng ngày đăng sang d/m/Y
                $date_display = date('d/m/Y', strtotime($row['dcreated_at']));
                
                // 1. Cấu hình dải màu ngẫu nhiên làm ảnh nền trống
                $gradients = [
                    'linear-gradient(135deg,#5b7a95,#8aa5bb)',
                    'linear-gradient(135deg,#a8795a,#c9a17e)',
                    'linear-gradient(135deg,#7f9a7e,#a9c0a4)',
                    'linear-gradient(135deg,#9b7fa0,#c3aac6)'
                ];
                $random_gradient = $gradients[array_rand($gradients)];
                
                // 2. Nhận diện danh mục để đổ Icon Class chuẩn xác
                $icon_class = 'fa-building';
                if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'nhà') !== false) $icon_class = 'fa-house';
                if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'đất') !== false) $icon_class = 'fa-mountain-sun';
                if(isset($row['ctitle_cat']) && strpos(mb_strtolower($row['ctitle_cat']), 'shop') !== false) $icon_class = 'fa-store';
        ?>
                <div class="post-card">
                    <div class="post-img-wrap" data-gradient="<?php echo $random_gradient; ?>" style="<?php if(empty($row['cimage'])) echo 'background: ' . $random_gradient . ';'; ?>">
                        <?php if(!empty($row['cimage'])): ?>
                            <img src="<?php echo base_url(); ?>upload/images_product/full_images/<?php echo $row['cimage']; ?>" alt="<?php echo htmlspecialchars($row['ctitle']); ?>">
                        <?php else: ?>
                            <i class="fa-solid <?php echo $icon_class; ?>"></i>
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-info">
                        <div class="post-main-detail">
                            <h4>
                                <a href="<?php echo base_url(); ?>index.php/post/<?php echo $row['ccode']; ?>" target="_blank">
                                    <?php echo htmlspecialchars($row['ctitle']); ?>
                                </a>
                            </h4>
                            <div class="post-meta">
                                <span><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['ctitle_province']); ?></span>
                                <span><i class="fa-solid fa-vector-square"></i> <?php echo number_format($row['narea'], 2); ?> m²</span>
                                <span><i class="fa-solid fa-calendar-days"></i> <?php echo $date_display; ?></span>
                            </div>
                        </div>
                        <div class="post-price"><?php echo htmlspecialchars($row['cprice_display']); ?></div>
                    </div>
                    
                    <div class="post-status-zone">
                        <?php if ((int)$row['nstatus'] === 1): ?>
                            <span class="badge badge-approved"><i class="fa-solid fa-circle-check"></i> Đã duyệt tin</span>
                        <?php else: ?>
                            <span class="badge badge-pending"><i class="fa-solid fa-clock"></i> Chờ kiểm duyệt</span>
                        <?php endif; ?>
                        
                        <div class="post-actions">
                            <a href="<?php echo base_url(); ?>post/<?php echo $row['ccode']; ?>" target="_blank" class="btn-action">
                                <i class="fa-solid fa-eye"></i> Xem
                            </a>
                            <a href="<?php echo base_url(); ?>edit_post/<?php echo $row['nid']; ?>" class="btn-action">
                                <i class="fa-solid fa-pen-to-square"></i> Sửa
                            </a>
                        </div>
                    </div>
                </div>
        <?php 
            } 
        else: 
        ?>
            <div class="empty-state">
                <i class="fa-solid fa-folder-open" style="font-size: 32px; margin-bottom: 10px; display: block; color: #cbd5e1;"></i>
                Bạn chưa gửi yêu cầu đăng tin bất động sản nào trên hệ thống PICO Saigon.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>