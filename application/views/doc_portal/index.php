<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');

   $member_name = !empty($member['cfullname']) ? $member['cfullname'] : (!empty($member['cusername']) ? $member['cusername'] : 'Quý khách');
?>

<style>
.doc-portal-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #ffffff;
    padding: 50px 0 45px;
    margin-bottom: 35px;
    position: relative;
    border-bottom: 3px solid #ea580c;
}
.doc-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
}
.hero-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}
.hero-title {
    font-size: 30px;
    font-weight: 800;
    margin-bottom: 8px;
    letter-spacing: -0.5px;
    color: #ffffff !important;
    display: flex;
    align-items: center;
    gap: 12px;
}
.hero-subtitle {
    font-size: 15px;
    color: #cbd5e1 !important;
    max-width: 650px;
    line-height: 1.6;
    margin: 0;
}
.btn-new-submission {
    background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
    color: #ffffff !important;
    padding: 13px 26px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 800;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 6px 16px rgba(234, 88, 12, 0.4);
    transition: all 0.25s ease;
}
.btn-new-submission:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(234, 88, 12, 0.5);
    background: linear-gradient(135deg, #c2410c 0%, #ea580c 100%);
}

/* Stat Cards */
.stat-cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 35px;
}
@media (max-width: 900px) {
    .stat-cards-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 500px) {
    .stat-cards-grid { grid-template-columns: 1fr; }
}
.stat-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 20px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.06);
}
.stat-card-info h3 {
    font-size: 26px;
    font-weight: 800;
    margin: 0 0 4px;
    color: #0f172a;
}
.stat-card-info p {
    font-size: 13px;
    font-weight: 600;
    color: #64748b;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.stat-card-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}
.stat-card-icon.blue { background: #e0f2fe; color: #0284c7; }
.stat-card-icon.amber { background: #fef3c7; color: #d97706; }
.stat-card-icon.green { background: #dcfce7; color: #16a34a; }
.stat-card-icon.red { background: #fee2e2; color: #dc2626; }

.section-heading {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.section-heading .title-left {
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Submissions Table */
.submissions-table-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 45px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.04);
}
.table-responsive {
    overflow-x: auto;
}
.sub-table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    font-size: 14px;
}
.sub-table thead tr {
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    color: #475569;
    font-weight: 700;
}
.sub-table th {
    padding: 16px 20px;
    white-space: nowrap;
}
.sub-table td {
    padding: 16px 20px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.sub-table tr:hover td {
    background: #f8fafc;
}
.doc-code-badge {
    display: inline-block;
    font-family: 'SFMono-Regular', Consolas, monospace;
    font-weight: 800;
    color: #ea580c;
    background: #fff7ed;
    padding: 4px 10px;
    border-radius: 6px;
    border: 1px solid #fed7aa;
}

/* Template Grid */
.template-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 22px;
    margin-bottom: 50px;
}
.template-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 24px;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.04);
}
.template-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 28px rgba(0,0,0,0.08);
    border-color: #cbd5e1;
}
.template-icon {
    width: 46px;
    height: 46px;
    border-radius: 10px;
    background: #ffedd5;
    color: #ea580c;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 14px;
}
.template-name {
    font-size: 16px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.4;
}
.template-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 20px;
    flex-grow: 1;
}
.template-actions {
    display: flex;
    gap: 10px;
}
.btn-download-tpl {
    flex: 1;
    background: #f1f5f9;
    color: #334155;
    text-align: center;
    padding: 9px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
.btn-download-tpl:hover {
    background: #e2e8f0;
    color: #0f172a;
}
.btn-submit-now {
    flex: 1.2;
    background: #ea580c;
    color: #ffffff !important;
    text-align: center;
    padding: 9px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
.btn-submit-now:hover {
    background: #c2410c;
}

/* Empty State */
.empty-docs-box {
    text-align: center;
    padding: 50px 20px;
    color: #64748b;
}
.empty-icon {
    font-size: 48px;
    color: #cbd5e1;
    margin-bottom: 15px;
}

/* Workflow Steps */
.workflow-steps-box {
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 50px;
}
.steps-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-top: 20px;
}
@media (max-width: 768px) {
    .steps-grid { grid-template-columns: 1fr; }
}
.step-item {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
}
.step-number {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #ea580c;
    color: #fff;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
}
.step-item h4 {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}
.step-item p {
    font-size: 13px;
    color: #64748b;
    line-height: 1.4;
    margin: 0;
}
</style>

<div class="doc-portal-hero">
    <div class="doc-container">
        <div class="hero-header-flex">
            <div>
                <h1 class="hero-title">
                    <i class="fa-solid fa-folder-tree" style="color: #ea580c;"></i>
                    Hồ Sơ Thẩm Định Của Bạn
                </h1>
                <p class="hero-subtitle">Xin chào <strong><?php echo htmlspecialchars($member_name); ?></strong>! Theo dõi tiến độ duyệt hồ sơ trực tuyến từ các phòng ban Pico Plaza và nộp hồ sơ mới nhanh chóng.</p>
            </div>
            <div>
                <a href="<?php echo base_url('doc_portal/submit'); ?>" class="btn-new-submission">
                    <i class="fa-solid fa-file-circle-plus"></i> + Nộp Hồ Sơ Mới
                </a>
            </div>
        </div>
    </div>
</div>

<div class="doc-container">
    <?php if (isset($_SESSION['doc_flash_error'])): ?>
        <div style="background:#fee2e2; border:1px solid #f87171; color:#991b1b; padding:14px 20px; border-radius:10px; margin-bottom:24px; font-weight:600;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-right: 6px;"></i> <?php echo $_SESSION['doc_flash_error']; unset($_SESSION['doc_flash_error']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['doc_flash_success'])): ?>
        <div style="background:#dcfce7; border:1px solid #4ade80; color:#166534; padding:14px 20px; border-radius:10px; margin-bottom:24px; font-weight:600;">
            <i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i> <?php echo $_SESSION['doc_flash_success']; unset($_SESSION['doc_flash_success']); ?>
        </div>
    <?php endif; ?>

    <!-- STAT CARDS -->
    <div class="stat-cards-grid">
        <div class="stat-card">
            <div class="stat-card-info">
                <h3><?php echo isset($stats['total']) ? $stats['total'] : 0; ?></h3>
                <p>Tổng Hồ Sơ</p>
            </div>
            <div class="stat-card-icon blue"><i class="fa-solid fa-folder-closed"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-info">
                <h3><?php echo isset($stats['in_progress']) ? $stats['in_progress'] : 0; ?></h3>
                <p>Đang Thẩm Định</p>
            </div>
            <div class="stat-card-icon amber"><i class="fa-solid fa-spinner fa-spin"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-info">
                <h3><?php echo isset($stats['completed']) ? $stats['completed'] : 0; ?></h3>
                <p>Đã Phê Duyệt</p>
            </div>
            <div class="stat-card-icon green"><i class="fa-solid fa-circle-check"></i></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-info">
                <h3><?php echo isset($stats['rejected']) ? $stats['rejected'] : 0; ?></h3>
                <p>Bị Từ Chối</p>
            </div>
            <div class="stat-card-icon red"><i class="fa-solid fa-circle-xmark"></i></div>
        </div>
    </div>

    <!-- SUBMISSIONS LIST -->
    <div class="section-heading">
        <div class="title-left">
            <i class="fa-solid fa-clock-rotate-left" style="color: #ea580c;"></i> Danh Sách Hồ Sơ Đã Nộp
        </div>
        <form action="<?php echo base_url('doc_portal/track'); ?>" method="GET" style="display: flex; gap: 8px;">
            <input type="text" name="code" placeholder="Tra cứu mã (VD: HS-...)" required style="padding: 7px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; outline: none; width: 190px;">
            <button type="submit" style="background:#0f172a; color:#fff; border:none; border-radius:8px; padding:7px 14px; font-size:13px; font-weight:700; cursor:pointer;"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <div class="submissions-table-card">
        <?php if (!empty($my_submissions)): ?>
            <div class="table-responsive">
                <table class="sub-table">
                    <thead>
                        <tr>
                            <th>Mã Hồ Sơ</th>
                            <th>Loại Hồ Sơ & Tiêu Đề</th>
                            <th>Ngày Gửi</th>
                            <th style="text-align: center;">Tiến Độ PB</th>
                            <th style="text-align: center;">Trạng Thái</th>
                            <th style="text-align: center;">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($my_submissions as $sub): ?>
                            <tr>
                                <td>
                                    <span class="doc-code-badge">#<?php echo $sub['ccode']; ?></span>
                                </td>
                                <td>
                                    <strong style="color:#0f172a; font-size: 14.5px;"><?php echo htmlspecialchars($sub['doc_type_name']); ?></strong>
                                    <div style="color:#64748b; font-size: 13px; margin-top: 3px;">
                                        <?php echo htmlspecialchars($sub['ctitle']); ?>
                                    </div>
                                </td>
                                <td style="color:#64748b; font-size: 13px; white-space: nowrap;">
                                    <?php 
                                        $sub_time = !empty($sub['ddate_submit']) ? $sub['ddate_submit'] : (!empty($sub['dcreated_at']) ? $sub['dcreated_at'] : 'now');
                                        echo date('d/m/Y H:i', strtotime($sub_time)); 
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php 
                                        $tot = isset($sub['total_steps']) ? (int)$sub['total_steps'] : 0;
                                        $app = isset($sub['approved_steps']) ? (int)$sub['approved_steps'] : 0;
                                        if ($tot > 0) {
                                            $percent = round(($app / $tot) * 100);
                                            echo '<div style="font-weight:700; font-size:12.5px; color:#334155; margin-bottom:4px;">' . $app . '/' . $tot . ' PB</div>';
                                            echo '<div style="width:70px; height:5px; background:#e2e8f0; border-radius:3px; margin:0 auto; overflow:hidden;">';
                                            echo '<div style="width:' . $percent . '%; height:100%; background:#ea580c;"></div>';
                                            echo '</div>';
                                        } else {
                                            echo '<span style="color:#94a3b8; font-size:12px;">--</span>';
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center; white-space: nowrap;">
                                    <?php 
                                        $mst = $sub['cstatus'];
                                        if ($mst == 'COMPLETED') {
                                            echo '<span style="background:#dcfce7; color:#166534; font-weight:800; padding:5px 12px; border-radius:20px; font-size:12px; display:inline-flex; align-items:center; gap:4px;"><i class="fa-solid fa-circle-check"></i> ĐÃ DUYỆT</span>';
                                        } elseif ($mst == 'REJECTED') {
                                            echo '<span style="background:#fee2e2; color:#991b1b; font-weight:800; padding:5px 12px; border-radius:20px; font-size:12px; display:inline-flex; align-items:center; gap:4px;"><i class="fa-solid fa-circle-xmark"></i> TỪ CHỐI</span>';
                                        } elseif ($mst == 'WAITING_ADMIN') {
                                            echo '<span style="background:#fef3c7; color:#92400e; font-weight:800; padding:5px 12px; border-radius:20px; font-size:12px; display:inline-flex; align-items:center; gap:4px;"><i class="fa-solid fa-hourglass-half"></i> CHỜ ADMIN DUYỆT</span>';
                                        } else {
                                            echo '<span style="background:#e0f2fe; color:#0369a1; font-weight:800; padding:5px 12px; border-radius:20px; font-size:12px; display:inline-flex; align-items:center; gap:4px;"><i class="fa-solid fa-spinner fa-spin"></i> ĐANG THẨM ĐỊNH</span>';
                                        }
                                    ?>
                                </td>
                                <td style="text-align: center; white-space: nowrap;">
                                    <a href="<?php echo base_url('doc_portal/track/' . $sub['ccode']); ?>" style="background:#fff7ed; border:1px solid #fed7aa; color:#ea580c; font-weight:700; padding:6px 12px; border-radius:8px; text-decoration:none; display:inline-flex; align-items:center; gap:5px; font-size:13px; transition:all 0.2s;">
                                        <i class="fa-solid fa-eye"></i> Xem Tiến Độ
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-docs-box">
                <div class="empty-icon"><i class="fa-regular fa-folder-open"></i></div>
                <h4 style="font-size: 17px; font-weight: 700; color: #1e293b; margin: 0 0 8px;">Bạn chưa nộp hồ sơ thẩm định nào</h4>
                <p style="font-size: 14px; margin: 0 0 20px; color: #64748b;">Chọn một trong các biểu mẫu bên dưới hoặc bấm nút nộp hồ sơ để bắt đầu quy trình xét duyệt.</p>
                <a href="<?php echo base_url('doc_portal/submit'); ?>" class="btn-new-submission" style="font-size: 14px; padding: 10px 20px;">
                    <i class="fa-solid fa-plus"></i> Nộp Hồ Sơ Đầu Tiên
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- TEMPLATE CATALOG -->
    <div class="section-heading">
        <div class="title-left">
            <i class="fa-solid fa-file-invoice" style="color: #ea580c;"></i> Danh Mục Biểu Mẫu Chuẩn Pico Plaza
        </div>
    </div>

    <div class="template-grid">
        <?php if (!empty($doc_types)): ?>
            <?php foreach ($doc_types as $type): ?>
                <div class="template-card">
                    <div>
                        <div class="template-icon"><i class="fa-solid fa-clipboard-list"></i></div>
                        <div class="template-name"><?php echo htmlspecialchars($type['cname']); ?></div>
                        <div class="template-desc"><?php echo nl2br(htmlspecialchars($type['cdescription'])); ?></div>
                    </div>
                    <div class="template-actions">
                        <?php if (!empty($type['cfile_template'])): ?>
                            <a href="<?php echo base_url($type['cfile_template']); ?>" target="_blank" class="btn-download-tpl" download><i class="fa-solid fa-file-pdf"></i> Tải PDF</a>
                        <?php endif; ?>
                        <a href="<?php echo base_url('doc_portal/submit/' . $type['nid']); ?>" class="btn-submit-now">Nộp Hồ Sơ <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color:#64748b;">Chưa có danh mục biểu mẫu nào được kích hoạt.</p>
        <?php endif; ?>
    </div>

    <!-- WORKFLOW PROCESS -->
    <div class="workflow-steps-box">
        <h3 style="font-size:18px; font-weight:800; color:#0f172a; margin:0 0 8px;">Quy Trình 4 Bước Thẩm Định & Trả Kết Quả</h3>
        <p style="font-size:14px; color:#64748b; margin:0;">Hệ thống đảm bảo tính minh bạch, chính xác và đồng bộ qua nhiều cấp phòng ban.</p>
        
        <div class="steps-grid">
            <div class="step-item">
                <div class="step-number">1</div>
                <h4>Tải mẫu & Ký tên</h4>
                <p>Khách hàng tải biểu mẫu PDF chuẩn, điền thông tin và ký xác nhận thủ công.</p>
            </div>
            <div class="step-item">
                <div class="step-number">2</div>
                <h4>Scan/Upload hồ sơ</h4>
                <p>Chụp ảnh hoặc scan file đã ký và tải lên hệ thống với định dạng PDF/JPG/PNG.</p>
            </div>
            <div class="step-item">
                <div class="step-number">3</div>
                <h4>Thẩm định song song</h4>
                <p>Hệ thống tự động phân luồng tới các phòng ban phụ trách thẩm định chuyên môn.</p>
            </div>
            <div class="step-item">
                <div class="step-number">4</div>
                <h4>Admin duyệt & Kết quả</h4>
                <p>Admin duyệt quyết định cuối và mở quyền tải văn bản chính thức "Đã xác nhận".</p>
            </div>
        </div>
    </div>
</div>

<?php 
   $this->load->view('modules/mod_footer'); 
   $this->load->view('footer');
?>
