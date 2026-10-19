<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>

<!-- Thư viện xử lý PDF trực tiếp phía trình duyệt để đóng dấu mộc đỏ -->
<script src="https://cdn.jsdelivr.net/npm/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
<script>
if (typeof PDFLib === 'undefined') {
    document.write('<script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"><\/script>');
}
</script>

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
                <div style="font-size:13px; color:#94a3b8;">HỒ SƠ TRỰC TUYẾN</div>
                <div class="code-title">#<?php echo htmlspecialchars($doc['ccode']); ?></div>
            </div>
            <div>
                <?php 
                    $st = $doc['cstatus'];
                    if ($st == 'WAITING_ADMIN') {
                        $st = 'COMPLETED';
                    }
                    $st_class = strtolower($st);
                    $st_label = 'Đang thẩm định';
                    if ($st == 'IN_REVIEW') $st_label = 'Đang Thẩm Định (Phòng Ban)';
                    elseif ($st == 'COMPLETED') $st_label = 'Hoàn Tất - Đã Thông Qua';
                    elseif ($st == 'REJECTED') $st_label = 'Từ Chối Thẩm Định';
                ?>
                <span class="status-tag <?php echo $st_class; ?>"><?php echo $st_label; ?></span>
            </div>
        </div>

        <!-- Stepper tiến độ (3 bước: Khởi tạo -> Thẩm định phòng ban -> Cấp văn bản xác nhận) -->
        <div class="track-stepper">
            <div class="stepper-step done">
                <div class="stepper-circle"><i class="fa-solid fa-check"></i></div>
                <div class="stepper-label">1. Khởi tạo & Upload</div>
            </div>

            <div class="stepper-step <?php echo ($st == 'IN_REVIEW' ? 'active' : ($st == 'COMPLETED' ? 'done' : ($st == 'REJECTED' ? 'failed' : ''))); ?>">
                <div class="stepper-circle"><?php echo ($st == 'COMPLETED') ? '<i class="fa-solid fa-check"></i>' : ($st == 'REJECTED' ? '<i class="fa-solid fa-xmark"></i>' : '2'); ?></div>
                <div class="stepper-label">2. Thẩm định phòng ban</div>
            </div>

            <div class="stepper-step <?php echo ($st == 'COMPLETED' ? 'done' : ''); ?>">
                <div class="stepper-circle"><?php echo ($st == 'COMPLETED') ? '<i class="fa-solid fa-award"></i>' : '3'; ?></div>
                <div class="stepper-label">3. Cấp văn bản xác nhận</div>
            </div>
        </div>

        <div class="track-body">
            <!-- Thông báo trạng thái đặc biệt -->
            <?php if ($st == 'COMPLETED'): ?>
                <div style="background:#ecfdf5; border:2px solid #10b981; border-radius:14px; padding:24px; margin-bottom:28px; text-align:center;">
                    <div style="font-size:36px; margin-bottom:8px; color:#10b981;"><i class="fa-solid fa-circle-check"></i></div>
                    <h3 style="color:#065f46; font-size:20px; font-weight:800; margin:0 0 6px;">HỒ SƠ ĐÃ ĐƯỢC THẨM ĐỊNH THÔNG QUA</h3>
                    <p style="color:#047857; font-size:14.5px; margin:0 0 16px;">Tất cả các phòng ban chuyên môn đã phê duyệt hoàn tất hồ sơ của Quý khách.</p>
                    <a href="<?php echo base_url(!empty($doc['cfile_approved']) ? $doc['cfile_approved'] : $doc['cfile_path']); ?>" 
                       id="btnDownloadApproved" 
                       onclick="return handleDownloadApproved(event);" 
                       data-file="<?php echo base_url($doc['cfile_path']); ?>"
                       data-approved="<?php echo !empty($doc['cfile_approved']) ? base_url($doc['cfile_approved']) : ''; ?>"
                       data-code="<?php echo htmlspecialchars($doc['ccode']); ?>"
                       data-date="<?php echo !empty($doc['ddate_completed']) ? date('d/m/Y', strtotime($doc['ddate_completed'])) : date('d/m/Y'); ?>"
                       data-save-url="<?php echo base_url('doc_portal/ajax_save_approved_file'); ?>"
                       style="display:inline-flex; align-items:center; gap:8px; background:#10b981; color:#fff; font-weight:800; padding:13px 30px; border-radius:8px; text-decoration:none; box-shadow:0 4px 14px rgba(16,185,129,0.35); font-size:15px; cursor:pointer; transition:all 0.2s;">
                        <i class="fa-solid fa-file-circle-check" id="btnDownloadIcon"></i> <span id="btnDownloadText">TẢI HỒ SƠ ĐÃ XÁC NHẬN</span>
                    </a>
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

            <!-- Ma trận thẩm định song song của các phòng ban có quyền duyệt -->
            <div class="dept-matrix-box">
                <h4 style="font-size:16px; font-weight:800; color:#0f172a; margin-bottom:12px;"><i class="fa-solid fa-building" style="color: #ea580c; margin-right: 6px;"></i> Tiến Độ Thẩm Định Tại Các Phòng Ban Chuyên Môn</h4>
                <div class="dept-card-grid">
                    <?php 
                        $approve_steps = array();
                        if (!empty($steps)) {
                            foreach ($steps as $st) {
                                if (!isset($st['cpermission']) || $st['cpermission'] !== 'VIEW') {
                                    $approve_steps[] = $st;
                                }
                            }
                        }
                    ?>
                    <?php if (!empty($approve_steps)): ?>
                        <?php foreach ($approve_steps as $step): ?>
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
                    <?php else: ?>
                        <div style="color: #64748b; font-size: 13.5px; font-style: italic; padding: 12px; background: #f8fafc; border-radius: 8px; width: 100%;">
                            <i class="fa-solid fa-info-circle" style="color: #0284c7;"></i> Hồ sơ thuộc diện Admin duyệt trực tiếp, không qua phòng ban thẩm định.
                        </div>
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

<!-- SCRIPT ĐÓNG DẤU MỘC ĐỎ "ĐÃ DUYỆT" TỰ ĐỘNG LÊN GÓC PHẢI TRÊN CỦA FILE -->
<script type="text/javascript">
/**
 * Tạo con dấu mộc đỏ "ĐÃ DUYỆT" bằng HTML5 Canvas với độ phân giải cao (Retina/Print 300DPI)
 */
function generateRedStampDataUrl(docCode, approvedDate) {
    var canvas = document.createElement('canvas');
    var dpr = 2; // Nhân đôi độ phân giải để siêu nét khi in/phóng to
    var stampW = 260;
    var stampH = 110;
    canvas.width = stampW * dpr;
    canvas.height = stampH * dpr;
    var ctx = canvas.getContext('2d');
    ctx.scale(dpr, dpr);

    // 1. Nền mộc nhạt mờ tự nhiên (hiệu ứng mực đỏ thẩm thấu)
    ctx.fillStyle = 'rgba(254, 242, 242, 0.55)';
    drawStampRoundRect(ctx, 4, 4, stampW - 8, stampH - 8, 8, true, false);

    // 2. Viền ngoài đôi
    ctx.strokeStyle = '#c5221f';
    ctx.lineWidth = 2.8;
    drawStampRoundRect(ctx, 4, 4, stampW - 8, stampH - 8, 8, false, true);

    // Viền trong nét thanh
    ctx.strokeStyle = '#c5221f';
    ctx.lineWidth = 1.1;
    drawStampRoundRect(ctx, 9, 9, stampW - 18, stampH - 18, 5, false, true);

    // 3. Tiêu đề đơn vị: BAN QUẢN LÝ PICO PLAZA
    ctx.fillStyle = '#c5221f';
    ctx.font = 'bold 11px Arial, "Segoe UI", Tahoma, sans-serif';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';
    ctx.fillText('BAN QUẢN LÝ PICO PLAZA', stampW / 2, 25);

    // Đường kẻ phân cách trên
    ctx.strokeStyle = '#c5221f';
    ctx.lineWidth = 0.8;
    ctx.beginPath();
    ctx.moveTo(20, 36);
    ctx.lineTo(stampW - 20, 36);
    ctx.stroke();

    // 4. Chữ chính: ★ ĐÃ DUYỆT ★ (Dùng bold chuẩn + viền nét thanh đồng đều để chữ Ệ không bị lệch font)
    ctx.font = 'bold 21px Arial, "Segoe UI", Tahoma, sans-serif';
    ctx.lineWidth = 0.5;
    ctx.strokeStyle = '#c5221f';
    ctx.strokeText('★ ĐÃ DUYỆT ★', stampW / 2, 58);
    ctx.fillText('★ ĐÃ DUYỆT ★', stampW / 2, 58);

    // Đường kẻ phân cách dưới
    ctx.beginPath();
    ctx.moveTo(20, 78);
    ctx.lineTo(stampW - 20, 78);
    ctx.stroke();

    // 5. Dòng mã hồ sơ & Ngày duyệt
    var dateStr = approvedDate || '<?php echo date("d/m/Y"); ?>';
    var codeStr = docCode ? ('#' + docCode + '  •  ') : '';
    ctx.font = 'bold 9.5px Arial, "Segoe UI", Tahoma, sans-serif';
    ctx.fillText(codeStr + 'NGÀY: ' + dateStr, stampW / 2, 91);

    return canvas.toDataURL('image/png');
}

function drawStampRoundRect(ctx, x, y, width, height, radius, fill, stroke) {
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
    if (fill) ctx.fill();
    if (stroke) ctx.stroke();
}

function dataUrlToArrayBuffer(dataUrl) {
    var binary = atob(dataUrl.split(',')[1]);
    var len = binary.length;
    var bytes = new Uint8Array(len);
    for (var i = 0; i < len; i++) {
        bytes[i] = binary.charCodeAt(i);
    }
    return bytes.buffer;
}

/**
 * Đóng dấu mộc đỏ lên file PDF
 */
async function stampPdfDocument(pdfArrayBuffer, docCode, approvedDate) {
    var PDFDocument = PDFLib.PDFDocument;
    var degrees = PDFLib.degrees;
    var pdfDoc = await PDFDocument.load(pdfArrayBuffer, { ignoreEncryption: true });

    // Tạo ảnh con dấu mộc đỏ dạng PNG
    var stampDataUrl = generateRedStampDataUrl(docCode, approvedDate);
    var stampPngBytes = dataUrlToArrayBuffer(stampDataUrl);
    var stampImage = await pdfDoc.embedPng(stampPngBytes);

    var pages = pdfDoc.getPages();
    if (pages.length > 0) {
        var firstPage = pages[0];
        var size = firstPage.getSize();
        var width = size.width;
        var height = size.height;

        // Kích thước tinh chỉnh con dấu: rộng 132pt (~46mm), cao 50pt (~17.5mm)
        var stampW = 132;
        var stampH = 50;
        var marginX = 16;
        var marginY = 8; // Đẩy nhích sát lên mép trên để tránh hoàn toàn tiêu đề

        var rotation = 0;
        try {
            rotation = firstPage.getRotation().angle || 0;
        } catch (e) {
            rotation = 0;
        }

        var posX, posY, rotAngle;
        if (rotation === 90) {
            posX = width - stampH - marginY;
            posY = marginX;
            rotAngle = 90 - 1.5;
        } else if (rotation === 180) {
            posX = marginX;
            posY = marginY;
            rotAngle = 180 - 1.5;
        } else if (rotation === 270) {
            posX = marginY;
            posY = height - stampW - marginX;
            rotAngle = 270 - 1.5;
        } else {
            // Chuẩn mặc định: góc trên bên phải
            posX = width - stampW - marginX;
            posY = height - stampH - marginY;
            rotAngle = -1.5; // Nghiêng nhẹ -1.5 độ tự nhiên, không bị chúc góc trái xuống tiêu đề
        }

        firstPage.drawImage(stampImage, {
            x: posX,
            y: posY,
            width: stampW,
            height: stampH,
            opacity: 0.95,
            rotate: degrees(rotAngle)
        });
    }

    return await pdfDoc.save();
}

/**
 * Đóng dấu mộc đỏ lên file ảnh (JPG/PNG)
 */
function stampImageDocument(imgUrl, docCode, approvedDate, callback) {
    var img = new Image();
    img.crossOrigin = 'anonymous';
    img.onload = function() {
        var canvas = document.createElement('canvas');
        canvas.width = img.naturalWidth;
        canvas.height = img.naturalHeight;
        var ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);

        var stampImg = new Image();
        stampImg.onload = function() {
            var stampW = Math.max(180, Math.min(canvas.width * 0.22, 340));
            var stampH = stampW * (110 / 260);
            var marginX = canvas.width * 0.02;
            var marginY = canvas.height * 0.012;
            var posX = canvas.width - stampW - marginX;
            var posY = marginY;

            ctx.save();
            ctx.translate(posX + stampW / 2, posY + stampH / 2);
            ctx.rotate(-1.5 * Math.PI / 180);
            ctx.globalAlpha = 0.95;
            ctx.drawImage(stampImg, -stampW / 2, -stampH / 2, stampW, stampH);
            ctx.restore();

            canvas.toBlob(function(blob) {
                callback(blob);
            }, 'image/jpeg', 0.95);
        };
        stampImg.src = generateRedStampDataUrl(docCode, approvedDate);
    };
    img.onerror = function() {
        callback(null);
    };
    img.src = imgUrl;
}

/**
 * Xử lý khi người dùng nhấn nút "TẢI HỒ SƠ ĐÃ XÁC NHẬN"
 */
async function handleDownloadApproved(e) {
    if (e && e.preventDefault) e.preventDefault();

    var btn = document.getElementById('btnDownloadApproved');
    var btnIcon = document.getElementById('btnDownloadIcon');
    var btnText = document.getElementById('btnDownloadText');
    if (!btn) return false;

    var originalFileUrl = btn.getAttribute('data-file');
    var approvedFileUrl = btn.getAttribute('data-approved');
    var docCode = btn.getAttribute('data-code') || '';
    var approvedDate = btn.getAttribute('data-date') || '';
    var saveUrl = btn.getAttribute('data-save-url') || '';

    // Hiển thị trạng thái đang xử lý tải về
    btn.style.pointerEvents = 'none';
    btn.style.opacity = '0.85';
    if (btnIcon) btnIcon.className = 'fa-solid fa-spinner fa-spin';
    if (btnText) btnText.innerText = 'Đang tải về...';

    try {
        var isPdf = originalFileUrl.toLowerCase().indexOf('.pdf') !== -1;
        var ext = isPdf ? 'pdf' : (originalFileUrl.toLowerCase().indexOf('.png') !== -1 ? 'png' : 'jpg');
        var downloadFilename = 'Ho_so_xac_nhan_' + docCode + '.' + ext;

        var res = await fetch(originalFileUrl);
        if (!res.ok) throw new Error('Không thể tải tệp gốc (' + res.status + ')');

        var finalBlob = null;
        if (isPdf) {
            if (typeof PDFLib === 'undefined') {
                throw new Error('Thư viện PDFLib chưa sẵn sàng');
            }
            var buffer = await res.arrayBuffer();
            var stampedPdfBytes = await stampPdfDocument(buffer, docCode, approvedDate);
            finalBlob = new Blob([stampedPdfBytes], { type: 'application/pdf' });
        } else {
            finalBlob = await new Promise(function(resolve, reject) {
                stampImageDocument(originalFileUrl, docCode, approvedDate, function(blob) {
                    if (blob) resolve(blob);
                    else reject(new Error('Lỗi đóng dấu ảnh'));
                });
            });
        }

        if (!finalBlob) throw new Error('Không tạo được file đóng dấu');

        // Kích hoạt tải file về máy
        var blobUrl = URL.createObjectURL(finalBlob);
        var downloadLink = document.createElement('a');
        downloadLink.href = blobUrl;
        downloadLink.download = downloadFilename;
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);

        // Lưu bản có dấu lên server chạy ngầm trong nền
        if (saveUrl) {
            try {
                var formData = new FormData();
                formData.append('code', docCode);
                formData.append('stamped_file', finalBlob, downloadFilename);
                fetch(saveUrl, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                }).then(function(r) { return r.json(); }).then(function(savedRes) {
                    if (savedRes && savedRes.file_url) {
                        btn.setAttribute('data-approved', savedRes.file_url);
                    }
                }).catch(function(saveErr) {
                    console.log('[STAMP SAVE ERROR]', saveErr);
                });
            } catch (errPost) {
                console.log(errPost);
            }
        }

        // Cập nhật giao diện thành công
        if (btnIcon) btnIcon.className = 'fa-solid fa-circle-check';
        if (btnText) btnText.innerText = 'Đã tải về thành công!';

        setTimeout(function() {
            btn.style.pointerEvents = 'auto';
            btn.style.opacity = '1';
            if (btnIcon) btnIcon.className = 'fa-solid fa-file-circle-check';
            if (btnText) btnText.innerText = 'TẢI HỒ SƠ ĐÃ XÁC NHẬN';
        }, 3000);

    } catch (err) {
        console.error('[STAMP ERROR]', err);
        // Fallback an toàn: Nếu trình duyệt không hỗ trợ, vẫn mở tải file gốc
        if (btnIcon) btnIcon.className = 'fa-solid fa-file-pdf';
        if (btnText) btnText.innerText = 'TẢI HỒ SƠ ĐÃ XÁC NHẬN';
        btn.style.pointerEvents = 'auto';
        btn.style.opacity = '1';
        window.open(originalFileUrl, '_blank');
    }

    return false;
}
</script>

<?php 
   $this->load->view('modules/mod_footer'); 
   $this->load->view('footer');
?>

