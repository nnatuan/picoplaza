<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');

   $name_val  = !empty($member['cfullname']) ? $member['cfullname'] : (!empty($member['cusername']) ? $member['cusername'] : '');
   $phone_val = !empty($member['cphone']) ? $member['cphone'] : '';
   $email_val = !empty($member['cemail']) ? $member['cemail'] : '';
?>

<style>
.doc-submit-wrap {
    max-width: 860px;
    margin: 40px auto 70px;
    padding: 0 20px;
    font-family: 'Manrope', -apple-system, BlinkMacSystemFont, sans-serif;
}
.form-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
    overflow: hidden;
}
.form-head {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #ffffff;
    padding: 30px 36px;
    border-bottom: 3px solid #ea580c;
}
.form-head h1 {
    font-size: 24px;
    font-weight: 800;
    margin: 0 0 8px;
    color: #ffffff !important;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-head p {
    font-size: 14.5px;
    color: #cbd5e1 !important;
    margin: 0;
    line-height: 1.5;
}
.form-body {
    padding: 36px;
}
.form-group {
    margin-bottom: 22px;
}
.form-label {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 8px;
}
.form-label .req {
    color: #dc2626;
}
.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 14.5px;
    color: #0f172a;
    box-sizing: border-box;
    outline: none;
    transition: all 0.2s;
    font-family: inherit;
}
.form-control:focus {
    border-color: #ea580c;
    box-shadow: 0 0 0 3px rgba(234, 88, 12, 0.15);
}
.file-upload-box {
    border: 2px dashed #cbd5e1;
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    background: #f8fafc;
    cursor: pointer;
    transition: all 0.2s ease;
}
.file-upload-box:hover {
    border-color: #ea580c;
    background: #fff7ed;
}
.file-upload-box.dragover {
    border-color: #ea580c !important;
    background: #ffedd5 !important;
    transform: scale(1.01);
    box-shadow: 0 0 0 4px rgba(234, 88, 12, 0.2);
}
.btn-submit {
    background: linear-gradient(135deg, #ea580c 0%, #f97316 100%);
    color: #ffffff;
    border: none;
    border-radius: 10px;
    padding: 14px 32px;
    font-size: 16px;
    font-weight: 800;
    cursor: pointer;
    width: 100%;
    box-shadow: 0 4px 12px rgba(234, 88, 12, 0.3);
    transition: all 0.2s;
}
.btn-submit:hover {
    background: linear-gradient(135deg, #c2410c 0%, #ea580c 100%);
    box-shadow: 0 6px 16px rgba(234, 88, 12, 0.4);
}
.member-badge-tip {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
    padding: 10px 14px;
    border-radius: 8px;
    font-size: 13px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>

<div class="doc-submit-wrap">
    <div style="margin-bottom: 16px;">
        <a href="<?php echo base_url('doc_portal'); ?>" style="color:#64748b; font-size:14px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:6px;">
            <i class="fa-solid fa-arrow-left"></i> Quay lại Danh sách Hồ sơ
        </a>
    </div>

    <?php if (isset($_SESSION['doc_flash_error'])): ?>
        <div style="background:#fee2e2; border:1px solid #f87171; color:#991b1b; padding:14px 20px; border-radius:10px; margin-bottom:20px; font-weight:600;">
            <i class="fa-solid fa-triangle-exclamation" style="margin-right: 6px;"></i> <?php echo $_SESSION['doc_flash_error']; unset($_SESSION['doc_flash_error']); ?>
        </div>
    <?php endif; ?>

    <!-- KHUNG HIỂN THỊ LỖI CHI TIẾT KỸ THUẬT (CLIENT AJAX CATCH) -->
    <div id="client_error_alert" style="display:none; margin-bottom:20px;"></div>

    <div class="form-card">
        <div class="form-head">
            <h1><i class="fa-solid fa-file-circle-plus"></i> Nộp Hồ Sơ Trực Tuyến</h1>
            <p>Hồ sơ sẽ được tự động liên kết vào tài khoản thành viên của bạn và chuyển tới các phòng ban thẩm định chuyên môn.</p>
        </div>

        <form action="<?php echo base_url('doc_portal/submit'); ?>" method="POST" enctype="multipart/form-data" class="form-body">
            <input type="hidden" name="action_submit_doc" value="1">

            <div class="member-badge-tip">
                <i class="fa-solid fa-id-card-clip" style="color: #16a34a; font-size: 16px;"></i>
                <span>Tài khoản nộp: <strong><?php echo htmlspecialchars($name_val); ?></strong> (Thông tin cá nhân đã được tự động điền)</span>
            </div>

            <div class="form-group">
                <label class="form-label">Loại hồ sơ / Đề xuất <span class="req">*</span></label>
                <?php if (!empty($selected_type)): ?>
                    <input type="hidden" name="nid_doc_type" value="<?php echo $selected_type['nid']; ?>">
                    <select class="form-control" disabled style="background:#f1f5f9; cursor:not-allowed; color:#1e293b; font-weight:700;">
                        <option value="<?php echo $selected_type['nid']; ?>" selected>
                            <?php echo htmlspecialchars($selected_type['cname']); ?>
                        </option>
                    </select>
                    <div style="font-size:12.5px; color:#64748b; margin-top:6px; display:flex; align-items:center; gap:5px;">
                        <i class="fa-solid fa-lock" style="color:#ea580c;"></i> Đã chọn: <strong><?php echo htmlspecialchars($selected_type['cname']); ?></strong> 
                        <a href="<?php echo base_url('doc_portal/submit'); ?>" style="color:#ea580c; text-decoration:underline; font-weight:600; margin-left:6px;">(Chọn loại khác)</a>
                    </div>
                <?php else: ?>
                    <select name="nid_doc_type" class="form-control" required>
                        <option value="">-- Chọn loại hồ sơ đề xuất --</option>
                        <?php if (!empty($doc_types)): ?>
                            <?php foreach ($doc_types as $type): ?>
                                <option value="<?php echo $type['nid']; ?>">
                                    <?php echo htmlspecialchars($type['cname']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                <?php endif; ?>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label class="form-label">Tên Doanh Nghiệp / Cá Nhân Nộp <span class="req">*</span></label>
                    <input type="text" name="txt_name" class="form-control" value="<?php echo htmlspecialchars($name_val); ?>" placeholder="Công ty TNHH ABC hoặc Nguyễn Văn A" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Số Điện Thoại Liên Hệ <span class="req">*</span></label>
                    <input type="tel" name="txt_phone" class="form-control" value="<?php echo htmlspecialchars($phone_val); ?>" placeholder="0901234567" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email Nhận Kết Quả <span class="req">*</span></label>
                <input type="email" name="txt_email" class="form-control" value="<?php echo htmlspecialchars($email_val); ?>" placeholder="contact@doanhnghiep.com" required>
            </div>

            <div class="form-group">
                <label class="form-label">Tiêu Đề Hồ Sơ <span class="req">*</span></label>
                <input type="text" name="txt_title" class="form-control" placeholder="VD: Đăng ký thi công cải tạo gian hàng Tầng 3 - L3-08" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ghi Chú Chi Tiết</label>
                <textarea name="txt_note" class="form-control" rows="3" placeholder="Ghi chú thêm về thời gian dự kiến thi công, yêu cầu kỹ thuật đặc biệt..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Tệp Hồ Sơ Scan / Chụp Ảnh (PDF, JPG, PNG) <span class="req">*</span></label>
                <div class="file-upload-box" id="file_upload_box" onclick="document.getElementById('file_input').click();">
                    <div style="font-size: 36px; margin-bottom: 8px; color: #ea580c;"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                    <div style="font-weight: 700; color: #0f172a; font-size: 15px;">Bấm vào đây để chọn tệp hoặc kéo thả file vào</div>
                    <div style="font-size: 13px; color: #64748b; margin-top: 4px;">Chấp nhận file PDF, JPG, PNG (Dung lượng tối đa 15MB)</div>
                    <div id="file_selected_name" style="margin-top: 10px; font-weight: 700; color: #16a34a;"></div>
                </div>
                <input type="file" id="file_input" name="file_document" accept=".pdf,.jpg,.jpeg,.png" style="display:none;" onchange="showFileName(this)" required>
                <div style="margin-top: 8px; font-size: 12px; color: #64748b; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                    <span><i class="fa-solid fa-circle-info" style="color: #ea580c;"></i> Khuyến khích gửi file dưới 5MB để tải lên nhanh chóng và ổn định</span>
                    <span style="color:#94a3b8;"><i class="fa-solid fa-shield-halved"></i> Giới hạn tối đa 15MB</span>
                </div>
            </div>

            <button type="submit" id="btn_submit_doc" class="btn-submit"><i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Gửi Hồ Sơ Ngay</button>
        </form>
    </div>
</div>

<!-- OVERLAY LOADING & PROGRESS BAR KHI SUBMIT -->
<div id="doc_submit_overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(15, 23, 42, 0.8); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px); z-index:999999; justify-content:center; align-items:center; flex-direction:column; text-align:center; padding:20px; box-sizing:border-box;">
    <div style="background:rgba(30, 41, 59, 0.96); border:1px solid rgba(255,255,255,0.15); border-radius:20px; padding:32px 36px; max-width:480px; width:100%; box-shadow:0 25px 60px rgba(0,0,0,0.6); display:flex; flex-direction:column; align-items:center; box-sizing:border-box;">
        <div id="overlay_spinner" class="submit-spinner" style="width:52px; height:52px; border:4px solid rgba(234, 88, 12, 0.2); border-top-color:#ea580c; border-radius:50%; animation:spin-loader 0.8s linear infinite; margin-bottom:18px;"></div>
        <div id="overlay_icon_done" style="display:none; font-size:48px; color:#22c55e; margin-bottom:18px;"><i class="fa-solid fa-circle-check"></i></div>
        <h3 id="overlay_title" style="color:#ffffff; font-size:18px; font-weight:800; margin:0 0 8px 0; letter-spacing:-0.3px;">Đang Tải Lên & Xử Lý Hồ Sơ...</h3>
        <p id="overlay_desc" style="color:#94a3b8; font-size:13px; line-height:1.5; margin:0 0 16px 0;">
            Dữ liệu đang được truyền tải lên máy chủ Web Server...
        </p>
        
        <!-- Thanh tiến trình upload thực tế -->
        <div style="width:100%; background:rgba(255,255,255,0.12); border-radius:10px; height:12px; overflow:hidden; margin-bottom:8px;">
            <div id="upload_progress_bar" style="width:0%; height:100%; background:linear-gradient(90deg, #ea580c, #f97316); border-radius:10px; transition:width 0.15s ease;"></div>
        </div>
        <div style="display:flex; justify-content:space-between; width:100%; font-size:12px; color:#cbd5e1; margin-bottom:14px; font-weight:600;">
            <span id="upload_progress_percent">0%</span>
            <span id="upload_progress_bytes">0 MB / 0 MB</span>
        </div>

        <div id="overlay_status_tip" style="background:rgba(234,88,12,0.12); border:1px dashed rgba(234,88,12,0.4); border-radius:8px; padding:8px 14px; font-size:12px; color:#fdba74; width:100%; box-sizing:border-box;">
            <i class="fa-solid fa-hourglass-half"></i> Vui lòng không đóng trình duyệt trong khi đang tải tệp...
        </div>
    </div>
</div>

<style>
@keyframes spin-loader {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
function showFileName(input) {
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var sizeMB = (file.size / (1024 * 1024)).toFixed(2);
        var ext = file.name.split('.').pop().toLowerCase();
        var allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];

        // Đóng thông báo lỗi cũ nếu có
        var alertEl = document.getElementById('client_error_alert');
        if (alertEl) alertEl.style.display = 'none';

        if (allowedExts.indexOf(ext) === -1) {
            alert('Chỉ chấp nhận tệp định dạng PDF, JPG, PNG!');
            input.value = '';
            document.getElementById('file_selected_name').innerHTML = '';
            return;
        }

        if (file.size > 15 * 1024 * 1024) {
            alert('Tệp bạn chọn có dung lượng ' + sizeMB + ' MB, vượt quá giới hạn 15MB!\nVui lòng nén file tại https://www.ilovepdf.com/compress_pdf trước khi gửi.');
            input.value = '';
            document.getElementById('file_selected_name').innerHTML = '<span style="color:#dc2626;"><i class="fa-solid fa-circle-xmark"></i> Tệp quá lớn (' + sizeMB + ' MB) - Vượt mức cho phép 15MB!</span>';
            return;
        }

        var isLarge = file.size > 5 * 1024 * 1024;
        var sizeColor = isLarge ? '#ea580c' : '#16a34a';
        var warnNote = isLarge ? ' <span style="font-size:12px; color:#ea580c; font-weight:normal;">(Tệp khá lớn ' + sizeMB + ' MB, có thể mất thêm thời gian để gửi)</span>' : '';

        document.getElementById('file_selected_name').innerHTML = '<i class="fa-solid fa-circle-check" style="color:' + sizeColor + ';"></i> <span style="color:' + sizeColor + ';">Đã chọn: ' + file.name + ' (' + sizeMB + ' MB)</span>' + warnNote;
    }
}

function showDiagnosticAlert(title, contentHtml, type) {
    var alertEl = document.getElementById('client_error_alert');
    if (!alertEl) return;

    var bgColor = type === 'warning' ? '#fffbeb' : '#fef2f2';
    var borderColor = type === 'warning' ? '#f59e0b' : '#ef4444';
    var titleColor = type === 'warning' ? '#b45309' : '#b91c1c';
    var iconClass = type === 'warning' ? 'fa-triangle-exclamation' : 'fa-circle-xmark';

    alertEl.style.display = 'block';
    alertEl.style.background = bgColor;
    alertEl.style.border = '1.5px solid ' + borderColor;
    alertEl.style.borderRadius = '12px';
    alertEl.style.padding = '18px 22px';
    alertEl.style.color = '#1e293b';
    alertEl.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1)';

    alertEl.innerHTML = `
        <div style="display:flex; align-items:flex-start; gap:12px;">
            <i class="fa-solid ${iconClass}" style="color:${titleColor}; font-size:22px; margin-top:2px;"></i>
            <div style="flex:1;">
                <h4 style="margin:0 0 8px 0; color:${titleColor}; font-size:16px; font-weight:800; letter-spacing:-0.2px;">${title}</h4>
                <div style="font-size:13.5px; line-height:1.6; color:#334155;">${contentHtml}</div>
            </div>
            <button type="button" onclick="document.getElementById('client_error_alert').style.display='none';" style="background:none; border:none; color:#94a3b8; font-size:18px; cursor:pointer; padding:0; margin-left:8px;" title="Đóng">&times;</button>
        </div>
    `;

    // Cuộn mượt màn hình lên đầu để người dùng đọc thông tin
    window.scrollTo({ top: alertEl.offsetTop - 80, behavior: 'smooth' });
}

document.addEventListener('DOMContentLoaded', function() {
    var uploadBox = document.getElementById('file_upload_box');
    var fileInput = document.getElementById('file_input');
    var submitForm = document.querySelector('form.form-body');
    var submitBtn  = document.getElementById('btn_submit_doc');
    var overlay    = document.getElementById('doc_submit_overlay');

    var progressBar = document.getElementById('upload_progress_bar');
    var progressPercent = document.getElementById('upload_progress_percent');
    var progressBytes = document.getElementById('upload_progress_bytes');
    var overlayTitle = document.getElementById('overlay_title');
    var overlayDesc = document.getElementById('overlay_desc');
    var overlaySpinner = document.getElementById('overlay_spinner');
    var overlayDone = document.getElementById('overlay_icon_done');

    function resetSubmitButton() {
        if (overlay) overlay.style.display = 'none';
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.style.opacity = '1';
            submitBtn.style.cursor = 'pointer';
            submitBtn.innerHTML = '<i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Gửi Hồ Sơ Ngay';
        }
        if (progressBar) progressBar.style.width = '0%';
        if (progressPercent) progressPercent.innerText = '0%';
        if (overlaySpinner) overlaySpinner.style.display = 'block';
        if (overlayDone) overlayDone.style.display = 'none';
    }

    if (submitForm) {
        submitForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Chặn tải trang full-page để bắt lỗi chính xác qua AJAX

            if (!submitForm.checkValidity()) {
                submitForm.reportValidity();
                return;
            }

            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                alert('Vui lòng chọn tệp hồ sơ scan hoặc chụp ảnh đính kèm (*)!');
                return;
            }

            var file = fileInput.files[0];
            var totalMB = (file.size / (1024 * 1024)).toFixed(2);
            if (file.size > 15 * 1024 * 1024) {
                alert('Tệp đính kèm (' + totalMB + ' MB) vượt quá giới hạn 15MB. Vui lòng nén file PDF trước khi nộp!');
                return;
            }

            // Đóng cảnh báo lỗi cũ
            var alertEl = document.getElementById('client_error_alert');
            if (alertEl) alertEl.style.display = 'none';

            // Kích hoạt Overlay & Trạng thái nút
            if (overlay) overlay.style.display = 'flex';
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right: 8px;"></i> Đang gửi dữ liệu...';
            }
            if (overlayTitle) overlayTitle.innerText = 'Đang Tải Lên & Xử Lý Hồ Sơ...';
            if (overlayDesc) overlayDesc.innerText = 'Dữ liệu tệp ' + file.name + ' (' + totalMB + ' MB) đang được truyền lên máy chủ...';
            if (progressBytes) progressBytes.innerText = '0 MB / ' + totalMB + ' MB';

            var formData = new FormData(submitForm);
            formData.append('is_ajax', '1');

            var xhr = new XMLHttpRequest();
            xhr.open('POST', submitForm.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            var loadedMB = '0.00';

            // Cập nhật thanh tiến trình upload theo thời gian thực
            if (xhr.upload) {
                xhr.upload.addEventListener('progress', function(event) {
                    if (event.lengthComputable) {
                        var percent = Math.round((event.loaded / event.total) * 100);
                        loadedMB = (event.loaded / (1024 * 1024)).toFixed(2);
                        if (progressBar) progressBar.style.width = percent + '%';
                        if (progressPercent) progressPercent.innerText = percent + '%';
                        if (progressBytes) progressBytes.innerText = loadedMB + ' MB / ' + totalMB + ' MB';

                        if (percent >= 100) {
                            if (overlayDesc) overlayDesc.innerText = 'Tệp đã truyền tải xong. Máy chủ đang ghi lưu CSDL & gửi thông báo Telegram...';
                        }
                    }
                });
            }

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var res = JSON.parse(xhr.responseText);
                            if (res.status) {
                                if (progressBar) progressBar.style.width = '100%';
                                if (progressPercent) progressPercent.innerText = '100%';
                                if (overlayTitle) overlayTitle.innerText = 'Nộp Hồ Sơ Thành Công!';
                                if (overlayDesc) overlayDesc.innerText = res.message || 'Hồ sơ đã được gửi thành công. Đang chuyển tới trang theo dõi...';
                                if (overlaySpinner) overlaySpinner.style.display = 'none';
                                if (overlayDone) overlayDone.style.display = 'block';

                                setTimeout(function() {
                                    window.location.href = res.redirect || '<?php echo base_url('doc_portal'); ?>';
                                }, 700);
                                return;
                            } else {
                                resetSubmitButton();
                                showDiagnosticAlert('Không thể nộp hồ sơ', res.message, 'warning');
                                return;
                            }
                        } catch(err) {
                            resetSubmitButton();
                            showDiagnosticAlert(
                                'Phản hồi không xác định từ máy chủ',
                                'Máy chủ trả về kết quả nhưng không đúng định dạng JSON. Vui lòng tải lại trang hoặc kiểm tra kết nối mạng.<br><small style="color:#64748b;">Nội dung phản hồi: ' + (xhr.responseText ? xhr.responseText.substring(0, 200) : 'Rỗng') + '</small>',
                                'danger'
                            );
                            return;
                        }
                    } else {
                        // BẮT MÃ LỖI TẢI TỆP VÀ HIỂN THỊ THÔNG BÁO THÂN THIỆN CHO KHÁCH HÀNG
                        resetSubmitButton();
                        var code = xhr.status;
                        var detailHtml = '';

                        if (code === 500 || code === 413) {
                            detailHtml = `
                                <div>
                                    <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6;">
                                        Tệp đính kèm của bạn (<strong>${totalMB} MB</strong>) có dung lượng quá lớn khiến hệ thống chưa thể tiếp nhận.
                                    </p>
                                    <div style="background:#ffffff; border-left:4px solid #ea580c; padding:12px 16px; margin-bottom:12px; border-radius:6px; font-size:13.5px; line-height:1.7;">
                                        👉 <strong>Cách xử lý:</strong><br>
                                        Vui lòng dùng công cụ này để nén file trước khi submit: 
                                        <a href="https://www.ilovepdf.com/compress_pdf" target="_blank" rel="noopener noreferrer" style="color:#ea580c; font-weight:700; text-decoration:underline; word-break:break-all;">https://www.ilovepdf.com/compress_pdf</a><br>
                                        hoặc liên hệ Ban quản trị để được hỗ trợ.
                                    </div>
                                </div>
                            `;
                            showDiagnosticAlert('Dung lượng tệp đính kèm quá lớn', detailHtml, 'danger');
                        } else if (code === 0) {
                            detailHtml = `
                                <div>
                                    <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6;">
                                        Quá trình gửi tệp (<strong>${totalMB} MB</strong>) bị gián đoạn do đường truyền mạng hoặc tệp có dung lượng quá lớn.
                                    </p>
                                    <div style="background:#ffffff; border-left:4px solid #ea580c; padding:12px 16px; margin-bottom:12px; border-radius:6px; font-size:13.5px; line-height:1.7;">
                                        👉 <strong>Cách xử lý:</strong><br>
                                        Vui lòng dùng công cụ này để nén file trước khi submit: 
                                        <a href="https://www.ilovepdf.com/compress_pdf" target="_blank" rel="noopener noreferrer" style="color:#ea580c; font-weight:700; text-decoration:underline; word-break:break-all;">https://www.ilovepdf.com/compress_pdf</a><br>
                                        hoặc liên hệ Ban quản trị để được hỗ trợ.
                                    </div>
                                </div>
                            `;
                            showDiagnosticAlert('Quá trình gửi hồ sơ bị gián đoạn', detailHtml, 'danger');
                        } else {
                            detailHtml = `
                                <div>
                                    <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6;">
                                        Đã xảy ra lỗi trong quá trình gửi hồ sơ.
                                    </p>
                                    <div style="background:#ffffff; border-left:4px solid #ea580c; padding:12px 16px; margin-bottom:12px; border-radius:6px; font-size:13.5px; line-height:1.7;">
                                        👉 <strong>Cách xử lý:</strong><br>
                                        Vui lòng dùng công cụ này để nén file trước khi submit: 
                                        <a href="https://www.ilovepdf.com/compress_pdf" target="_blank" rel="noopener noreferrer" style="color:#ea580c; font-weight:700; text-decoration:underline; word-break:break-all;">https://www.ilovepdf.com/compress_pdf</a><br>
                                        hoặc liên hệ Ban quản trị để được hỗ trợ.
                                    </div>
                                </div>
                            `;
                            showDiagnosticAlert('Không thể gửi hồ sơ', detailHtml, 'danger');
                        }
                    }
                }
            };

            xhr.onerror = function() {
                resetSubmitButton();
                var detailHtml = `
                    <div>
                        <p style="margin:0 0 10px 0; font-size:14px; line-height:1.6;">
                            Đường truyền mạng bị gián đoạn hoặc tệp đính kèm (<strong>${totalMB} MB</strong>) có dung lượng quá lớn khiến máy chủ ngắt kết nối.
                        </p>
                        <div style="background:#ffffff; border-left:4px solid #ea580c; padding:12px 16px; margin-bottom:12px; border-radius:6px; font-size:13.5px; line-height:1.7;">
                            👉 <strong>Cách xử lý:</strong><br>
                            Vui lòng dùng công cụ này để nén file trước khi submit: 
                            <a href="https://www.ilovepdf.com/compress_pdf" target="_blank" rel="noopener noreferrer" style="color:#ea580c; font-weight:700; text-decoration:underline; word-break:break-all;">https://www.ilovepdf.com/compress_pdf</a><br>
                            hoặc liên hệ Ban quản trị để được hỗ trợ.
                        </div>
                    </div>
                `;
                showDiagnosticAlert('Không thể kết nối tới hệ thống', detailHtml, 'danger');
            };

            xhr.send(formData);
        });
    }

    if (uploadBox && fileInput) {
        ['dragenter', 'dragover'].forEach(function(eventName) {
            uploadBox.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                uploadBox.classList.add('dragover');
            }, false);
        });

        ['dragleave', 'dragend'].forEach(function(eventName) {
            uploadBox.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
                uploadBox.classList.remove('dragover');
            }, false);
        });

        uploadBox.addEventListener('drop', function(e) {
            e.preventDefault();
            e.stopPropagation();
            uploadBox.classList.remove('dragover');

            var dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length > 0) {
                var file = dt.files[0];
                var ext = file.name.split('.').pop().toLowerCase();
                var allowedExts = ['pdf', 'jpg', 'jpeg', 'png'];

                if (allowedExts.indexOf(ext) === -1) {
                    alert('Chỉ chấp nhận tệp định dạng PDF, JPG, PNG!');
                    return;
                }

                if (file.size > 15 * 1024 * 1024) {
                    alert('Dung lượng tệp vượt quá giới hạn 15MB!');
                    return;
                }

                try {
                    var dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                } catch(err) {
                    fileInput.files = dt.files;
                }
                showFileName(fileInput);
            }
        }, false);
    }
});
</script>

<?php 
   $this->load->view('modules/mod_footer'); 
   $this->load->view('footer');
?>
