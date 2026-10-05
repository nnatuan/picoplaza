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

    <div class="form-card">
        <div class="form-head">
            <h1><i class="fa-solid fa-file-circle-plus"></i> Nộp Hồ Sơ Thẩm Định Trực Tuyến</h1>
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
                <label class="form-label">Tiêu Đề Hồ Sơ / Mã Mặt Bằng Gian Hàng <span class="req">*</span></label>
                <input type="text" name="txt_title" class="form-control" placeholder="VD: Đăng ký thi công cải tạo gian hàng Tầng 3 - L3-08" required>
            </div>

            <div class="form-group">
                <label class="form-label">Ghi Chú Chi Tiết Cho Phòng Thẩm Định</label>
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
            </div>

            <button type="submit" id="btn_submit_doc" class="btn-submit"><i class="fa-solid fa-paper-plane" style="margin-right: 8px;"></i> Gửi Hồ Sơ Thẩm Định Ngay</button>
        </form>
    </div>
</div>

<!-- OVERLAY LOADING TRANSPARENT KHI SUBMIT -->
<div id="doc_submit_overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(15, 23, 42, 0.75); backdrop-filter:blur(6px); -webkit-backdrop-filter:blur(6px); z-index:999999; justify-content:center; align-items:center; flex-direction:column; text-align:center; padding:20px; box-sizing:border-box;">
    <div style="background:rgba(30, 41, 59, 0.95); border:1px solid rgba(255,255,255,0.15); border-radius:20px; padding:36px 40px; max-width:440px; box-shadow:0 20px 50px rgba(0,0,0,0.5); display:flex; flex-direction:column; align-items:center;">
        <div class="submit-spinner" style="width:54px; height:54px; border:4px solid rgba(234, 88, 12, 0.2); border-top-color:#ea580c; border-radius:50%; animation:spin-loader 0.8s linear infinite; margin-bottom:20px;"></div>
        <h3 style="color:#ffffff; font-size:19px; font-weight:800; margin:0 0 8px 0; letter-spacing:-0.3px;">Đang Xử Lý & Gửi Hồ Sơ...</h3>
        <p style="color:#94a3b8; font-size:13.5px; line-height:1.6; margin:0 0 14px 0;">
            Hệ thống đang tải lên tệp đính kèm và gửi thông báo thẩm định tới các phòng ban phụ trách.
        </p>
        <div style="background:rgba(234,88,12,0.12); border:1px dashed rgba(234,88,12,0.4); border-radius:8px; padding:8px 14px; font-size:12px; color:#fdba74;">
            <i class="fa-solid fa-hourglass-half"></i> Vui lòng giữ nguyên màn hình trong giây lát...
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
        document.getElementById('file_selected_name').innerHTML = '<i class="fa-solid fa-circle-check"></i> Đã chọn: ' + input.files[0].name + ' (' + (input.files[0].size/1024/1024).toFixed(2) + ' MB)';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var uploadBox = document.getElementById('file_upload_box');
    var fileInput = document.getElementById('file_input');
    var submitForm = document.querySelector('form.form-body');
    var submitBtn  = document.getElementById('btn_submit_doc');
    var overlay    = document.getElementById('doc_submit_overlay');

    // Chặn click nhiều lần & hiển thị màn hình trong suốt loading
    if (submitForm) {
        submitForm.addEventListener('submit', function(e) {
            // Kiểm tra các trường bắt buộc
            if (!submitForm.checkValidity()) {
                return;
            }

            // Kiểm tra file đính kèm
            if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
                alert('Vui lòng chọn tệp hồ sơ scan hoặc chụp ảnh đính kèm (*)!');
                e.preventDefault();
                return;
            }

            // Hiển thị Overlay Loading & Khóa nút bấm
            if (overlay) {
                overlay.style.display = 'flex';
            }
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin" style="margin-right: 8px;"></i> Đang gửi hồ sơ...';
            }
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
