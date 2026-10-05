<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<style>
.doc-track-wrap {
    max-width: 1000px;
    margin: 40px auto 80px;
    padding: 0 20px;
    font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
}
.track-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
    overflow: hidden;
    margin-bottom: 30px;
}
.track-header {
    background: #0f172a;
    color: #ffffff;
    padding: 24px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}
.track-header .code-title {
    font-size: 20px;
    font-weight: 800;
    color: #ffedd5;
}
.track-header .status-tag {
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 13px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-tag.in_review { background: #3b82f6; color: #ffffff; }
.status-tag.waiting_admin { background: #f59e0b; color: #ffffff; }
.status-tag.completed { background: #10b981; color: #ffffff; }
.status-tag.rejected { background: #ef4444; color: #ffffff; }

.track-stepper {
    padding: 30px 40px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    position: relative;
}
@media (max-width: 768px) {
    .track-stepper { flex-direction: column; gap: 20px; }
}
.stepper-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    position: relative;
    z-index: 2;
    flex: 1;
}
.stepper-circle {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
    transition: all 0.3s;
}
.stepper-step.active .stepper-circle {
    background: #ea580c;
    color: #ffffff;
    box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.2);
}
.stepper-step.done .stepper-circle {
    background: #10b981;
    color: #ffffff;
}
.stepper-step.failed .stepper-circle {
    background: #ef4444;
    color: #ffffff;
}
.stepper-label {
    font-size: 13px;
    font-weight: 700;
    color: #475569;
}
.stepper-step.active .stepper-label {
    color: #ea580c;
}

.track-body {
    padding: 30px 40px;
}
.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}
@media (max-width: 640px) {
    .info-grid { grid-template-columns: 1fr; }
}
.info-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 16px 20px;
}
.info-label {
    font-size: 12.5px;
    color: #64748b;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 4px;
}
.info-val {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
}

.dept-matrix-box {
    margin-bottom: 30px;
}
.dept-card-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
    gap: 16px;
    margin-top: 14px;
}
@media (max-width: 640px) {
    .dept-card-grid { grid-template-columns: 1fr; }
}
.dept-card {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 20px;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.02);
}
.dept-card.approved { border-left: 5px solid #10b981; }
.dept-card.rejected { border-left: 5px solid #ef4444; }
.dept-card.pending { border-left: 5px solid #f59e0b; }

.dept-card-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
}
.dept-card-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    white-space: nowrap;
}
.dept-status-badge {
    white-space: nowrap;
    flex-shrink: 0;
    font-size: 12px;
    font-weight: 800;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.dept-status-badge.approved { background: #dcfce7; color: #166534; }
.dept-status-badge.rejected { background: #fee2e2; color: #991b1b; }
.dept-status-badge.pending { background: #fef3c7; color: #b45309; }

.timeline-logs {
    border-left: 2px solid #e2e8f0;
    padding-left: 20px;
    margin-left: 10px;
    margin-top: 16px;
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
}
.timeline-dot {
    position: absolute;
    left: -27px;
    top: 3px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ea580c;
    border: 2px solid #ffffff;
}
.timeline-time {
    font-size: 12px;
    color: #94a3b8;
    font-weight: 600;
}
.timeline-note {
    font-size: 14px;
    color: #334155;
    margin-top: 4px;
}
</style>

<div class="doc-track-wrap">
    <div style="margin-bottom: 16px; display:flex; justify-content:space-between; align-items:center;">
        <a href="<?php echo base_url('doc_portal'); ?>" style="color:#64748b; font-size:14px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:6px;"><i class="fa-solid fa-arrow-left"></i> Quay lại Danh sách Hồ Sơ</a>
        <a href="<?php echo base_url('doc_portal/submit'); ?>" style="color:#ea580c; font-size:14px; text-decoration:none; font-weight:700;"><i class="fa-solid fa-plus" style="margin-right: 4px;"></i> Nộp Hồ Sơ Mới</a>
    </div>

    <div class="track-card">
        <div class="track-header">
            <div>
                <div style="font-size:13px; color:#94a3b8;">HỒ SƠ THẨM ĐỊNH TRỰC TUYẾN</div>
                <div class="code-title">#<?php echo htmlspecialchars($doc['ccode']); ?></div>
            </div>
            <div>
                <?php 
                    $st = $doc['cstatus'];
                    $st_class = strtolower($st);
                    $st_label = 'Đang thẩm định';
                    if ($st == 'IN_REVIEW') $st_label = 'Đang Thẩm Định (Phòng Ban)';
                    elseif ($st == 'WAITING_ADMIN') $st_label = 'Chờ Admin Phê Duyệt';
                    elseif ($st == 'COMPLETED') $st_label = 'Hoàn Tất - Đã Xác Nhận';
                    elseif ($st == 'REJECTED') $st_label = 'Từ Chối Thẩm Định';
                ?>
                <span class="status-tag <?php echo $st_class; ?>"><?php echo $st_label; ?></span>
            </div>
        </div>

        <!-- Stepper tiến độ -->
        <div class="track-stepper">
            <div class="stepper-step done">
                <div class="stepper-circle"><i class="fa-solid fa-check"></i></div>
                <div class="stepper-label">1. Khởi tạo & Upload</div>
            </div>

            <div class="stepper-step <?php echo ($st == 'IN_REVIEW' ? 'active' : (($st == 'WAITING_ADMIN' || $st == 'COMPLETED') ? 'done' : ($st == 'REJECTED' ? 'failed' : ''))); ?>">
                <div class="stepper-circle"><?php echo ($st == 'WAITING_ADMIN' || $st == 'COMPLETED') ? '<i class="fa-solid fa-check"></i>' : ($st == 'REJECTED' ? '<i class="fa-solid fa-xmark"></i>' : '2'); ?></div>
                <div class="stepper-label">2. Thẩm định phòng ban</div>
            </div>

            <div class="stepper-step <?php echo ($st == 'WAITING_ADMIN' ? 'active' : ($st == 'COMPLETED' ? 'done' : ($st == 'REJECTED' ? 'failed' : ''))); ?>">
                <div class="stepper-circle"><?php echo ($st == 'COMPLETED') ? '<i class="fa-solid fa-check"></i>' : '3'; ?></div>
                <div class="stepper-label">3. Admin phê duyệt</div>
            </div>

            <div class="stepper-step <?php echo ($st == 'COMPLETED' ? 'done' : ''); ?>">
                <div class="stepper-circle"><?php echo ($st == 'COMPLETED') ? '<i class="fa-solid fa-award"></i>' : '4'; ?></div>
                <div class="stepper-label">4. Cấp văn bản xác nhận</div>
            </div>
        </div>

        <div class="track-body">
            <!-- Thông báo trạng thái đặc biệt -->
            <?php if ($doc['cstatus'] == 'COMPLETED'): ?>
                <div style="background:#ecfdf5; border:2px solid #10b981; border-radius:14px; padding:24px; margin-bottom:28px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:8px; color:#10b981;"><i class="fa-solid fa-circle-check"></i></div>
                    <h3 style="color:#065f46; font-size:20px; font-weight:800; margin:0 0 6px;">HỒ SƠ ĐÃ ĐƯỢC PHÊ DUYỆT THÀNH CÔNG</h3>
                    <p style="color:#047857; font-size:14.5px; margin:0 0 16px;">Văn bản chính thức đã được ký duyệt xác nhận bởi Ban Quản Trị Pico Plaza.</p>
                    <?php if (!empty($doc['cfile_approved'])): ?>
                        <a href="<?php echo base_url($doc['cfile_approved']); ?>" target="_blank" download style="display:inline-block; background:#10b981; color:#fff; font-weight:800; padding:12px 28px; border-radius:8px; text-decoration:none; box-shadow:0 4px 12px rgba(16,185,129,0.3);"><i class="fa-solid fa-file-pdf" style="margin-right: 6px;"></i> TẢI VĂN BẢN ĐÃ XÁC NHẬN (OFFICIAL PDF)</a>
                    <?php else: ?>
                        <a href="<?php echo base_url($doc['cfile_path']); ?>" target="_blank" download style="display:inline-block; background:#10b981; color:#fff; font-weight:800; padding:12px 28px; border-radius:8px; text-decoration:none;"><i class="fa-solid fa-file-pdf" style="margin-right: 6px;"></i> TẢI HỒ SƠ ĐÃ XÁC NHẬN</a>
                    <?php endif; ?>
                </div>
            <?php elseif ($doc['cstatus'] == 'REJECTED'): ?>
                <div style="background:#fef2f2; border:2px solid #ef4444; border-radius:14px; padding:24px; margin-bottom:28px;">
                    <h3 style="color:#991b1b; font-size:18px; font-weight:800; margin:0 0 8px;"><i class="fa-solid fa-triangle-exclamation" style="margin-right: 6px;"></i> HỒ SƠ BỊ TỪ CHỐI THẨM ĐỊNH</h3>
                    <div style="color:#7f1d1d; font-size:14.5px; background:#ffffff; padding:14px; border-radius:8px; border:1px solid #fecaca; margin-bottom:14px;">
                        <strong>Lý do từ chối:</strong> <?php echo nl2br(htmlspecialchars($doc['creject_reason'])); ?>
                    </div>
                    <a href="<?php echo base_url('doc_portal/submit/' . $doc['nid_doc_type']); ?>" style="display:inline-block; background:#ea580c; color:#fff; font-weight:700; padding:10px 20px; border-radius:8px; text-decoration:none; font-size:14px;"><i class="fa-solid fa-rotate-left" style="margin-right: 6px;"></i> Chỉnh sửa và nộp lại hồ sơ</a>
                </div>
            <?php endif; ?>

            <!-- Thông tin chi tiết hồ sơ -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Loại hồ sơ</div>
                    <div class="info-val"><?php echo htmlspecialchars($doc['doc_type_name']); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Thời gian nộp</div>
                    <div class="info-val"><?php echo date('d/m/Y H:i', strtotime($doc['ddate_submit'])); ?></div>
                </div>
                <div class="info-item">
                    <div class="info-label">Khách hàng / Doanh nghiệp</div>
                    <div class="info-val"><?php echo htmlspecialchars($doc['ccustomer_name']); ?> (<?php echo htmlspecialchars($doc['ccustomer_phone']); ?>)</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tệp gốc đã tải lên</div>
                    <div class="info-val">
                        <a href="<?php echo base_url($doc['cfile_path']); ?>" target="_blank" style="color:#ea580c; text-decoration:underline;"><i class="fa-solid fa-file-lines" style="margin-right: 4px;"></i> Xem tệp hồ sơ đính kèm</a>
                    </div>
                </div>
            </div>

            <!-- Ma trận thẩm định song song của các phòng ban -->
            <div class="dept-matrix-box">
                <h4 style="font-size:16px; font-weight:800; color:#0f172a; margin-bottom:12px;"><i class="fa-solid fa-building" style="color: #ea580c; margin-right: 6px;"></i> Tiến Độ Thẩm Định Tại Các Phòng Ban Chuyên Môn</h4>
                <div class="dept-card-grid">
                    <?php if (!empty($steps)): ?>
                        <?php foreach ($steps as $step): ?>
                            <?php 
                                $step_st = $step['cstep_status'];
                                $card_class = strtolower($step_st);
                            ?>
                            <div class="dept-card <?php echo $card_class; ?>">
                                <div class="dept-card-head">
                                    <strong class="dept-card-title"><?php echo htmlspecialchars($step['dept_name']); ?></strong>
                                    <?php if ($step_st == 'APPROVED'): ?>
                                        <span class="dept-status-badge approved"><i class="fa-solid fa-circle-check"></i> ĐÃ DUYỆT</span>
                                    <?php elseif ($step_st == 'REJECTED'): ?>
                                        <span class="dept-status-badge rejected"><i class="fa-solid fa-circle-xmark"></i> TỪ CHỐI</span>
                                    <?php else: ?>
                                        <span class="dept-status-badge pending"><i class="fa-solid fa-clock"></i> ĐANG CHỜ</span>
                                    <?php endif; ?>
                                </div>
                                <?php if (!empty($step['creason_note'])): ?>
                                    <div style="font-size:13px; color:#475569; background:#f8fafc; padding:8px; border-radius:6px; margin-top:6px;">
                                        <em>"<?php echo htmlspecialchars($step['creason_note']); ?>"</em>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($step['dtime_action'])): ?>
                                    <div style="font-size:11.5px; color:#94a3b8; margin-top:6px;">
                                        Lúc: <?php echo date('d/m/Y H:i', strtotime($step['dtime_action'])); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Nhật ký lịch sử Audit Trail -->
            <div style="margin-top: 36px;">
                <h4 style="font-size:16px; font-weight:800; color:#0f172a; margin-bottom:12px;"><i class="fa-solid fa-clock-rotate-left" style="color: #ea580c; margin-right: 6px;"></i> Nhật Ký Xử Lý Hồ Sơ (Audit Trail)</h4>
                <div class="timeline-logs">
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-time"><?php echo date('d/m/Y H:i:s', strtotime($log['ddate_log'])); ?> — <strong>[<?php echo strtoupper($log['cuser_role']); ?>]</strong></div>
                                <div class="timeline-note"><?php echo htmlspecialchars($log['cnote']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['just_submitted']) && $_GET['just_submitted'] == '1'): ?>
<!-- Background AJAX Notification Trigger: Gửi Telegram & Email ngầm không làm lag trang -->
<script type="text/javascript">
(function() {
    var notifyUrl = '<?php echo base_url("doc_portal/ajax_send_notifications/" . $doc["ccode"]); ?>';
    if (window.fetch) {
        fetch(notifyUrl, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function(response) {
            return response.json();
        }).then(function(res) {
            console.log('[PICO Notifications] Background dispatched:', res);
        }).catch(function(err) {
            console.log('[PICO Notifications] Background error:', err);
        });
    } else if (window.jQuery) {
        jQuery.post(notifyUrl);
    }
})();
</script>
<?php endif; ?>

<?php 
   $this->load->view('modules/mod_footer'); 
   $this->load->view('footer');
?>

