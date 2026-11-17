<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small></small></h3>
            </div>
            <div class="title_right text-right" style="margin-bottom: 10px;">
                <a href="<?php echo base_url('index.php/do_doc_submission_listview'); ?>" class="btn btn-secondary btn-sm" style="float: right;"><i class="fa fa-arrow-left"></i> Trở về danh sách</a>
            </div>
        </div>
        <div class="clearfix"></div>

        <?php if(isset($_SESSION['flash_msg'])): ?>
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> <?php echo $_SESSION['flash_msg']; unset($_SESSION['flash_msg']); ?>
            </div>
        <?php endif; ?>
        <?php if(isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> <?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Cột trái: Trình xem tài liệu & Thông tin -->
            <div class="col-md-7 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>QUẢN TRỊ HỒ SƠ: #<?php echo htmlspecialchars($submission['ccode']); ?> — TỆP ĐÍNH KÈM</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php 
                            $file_ext = strtolower(pathinfo($submission['cfile_path'], PATHINFO_EXTENSION));
                            $file_url = base_url('../' . $submission['cfile_path']);
                        ?>
                        <div style="background: #1e293b; border-radius: 8px; padding: 10px; min-height: 500px; display: flex; align-items: center; justify-content: center;">
                            <?php if ($file_ext === 'pdf'): ?>
                                <iframe src="<?php echo $file_url; ?>" style="width: 100%; height: 550px; border: none; border-radius: 6px;"></iframe>
                            <?php else: ?>
                                <img src="<?php echo $file_url; ?>" alt="Hồ sơ" style="max-width: 100%; max-height: 550px; object-fit: contain; border-radius: 6px;">
                            <?php endif; ?>
                        </div>

                        <?php if(!empty($submission['cfile_approved'])): ?>
                            <div style="margin-top: 15px; padding: 12px; background: #ecfdf5; border: 1px solid #10b981; border-radius: 8px;">
                                <strong style="color:#065f46;"><i class="fa fa-file-pdf-o"></i> Tệp văn bản chính thức đã xác nhận:</strong>
                                <a href="<?php echo base_url('../' . $submission['cfile_approved']); ?>" target="_blank" class="btn btn-sm btn-success" style="margin-left: 10px; margin-bottom:0;"><i class="fa fa-download"></i> Xem / Tải về</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Audit Log -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Nhật Ký Kiểm Toán (Audit Trail)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Vai trò</th>
                                    <th>Hành động</th>
                                    <th>Nội dung chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($logs as $log): ?>
                                    <tr>
                                        <td><small><?php echo date('d/m/Y H:i', strtotime($log['ddate_log'])); ?></small></td>
                                        <td><span class="badge badge-secondary"><?php echo $log['cuser_role']; ?></span></td>
                                        <td><strong><?php echo $log['caction']; ?></strong></td>
                                        <td><?php echo htmlspecialchars($log['cnote']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Trạng thái các phòng & Các hành động Admin -->
            <div class="col-md-5 col-sm-12">
                <!-- Box Trạng thái & Các bước phòng ban -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tiến Độ Thẩm Định Các Phòng Ban</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Phòng ban</th>
                                    <th>Trạng thái</th>
                                    <th>Ghi chú / Lý do</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($steps as $st): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($st['dept_name']); ?></strong>
                                            <?php if(isset($st['cpermission']) && $st['cpermission'] === 'VIEW'): ?>
                                                <span class="badge badge-secondary" style="font-size:10px; background:#64748b; margin-left:4px;">Chỉ xem</span>
                                            <?php else: ?>
                                                <span class="badge badge-primary" style="font-size:10px; background:#0284c7; margin-left:4px;">Duyệt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isset($st['cpermission']) && $st['cpermission'] === 'VIEW'): ?>
                                                <span class="badge badge-secondary" style="background:#64748b;"><i class="fa fa-eye"></i> THEO DÕI</span>
                                            <?php elseif($st['cstep_status'] == 'APPROVED'): ?>
                                                <span class="badge badge-success"><i class="fa fa-check"></i> ĐÃ DUYỆT</span>
                                            <?php elseif($st['cstep_status'] == 'REJECTED'): ?>
                                                <span class="badge badge-danger"><i class="fa fa-times"></i> TỪ CHỐI</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning"><i class="fa fa-clock-o"></i> CHỜ DUYỆT</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><small><?php echo htmlspecialchars($st['creason_note']); ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Box Phê duyệt Cấp Quản trị (Admin Review) -->
                <?php if($submission['cstatus'] == 'WAITING_ADMIN'): ?>
                    <div class="x_panel" style="border: 1.5px solid #ea580c; border-radius: 4px;">
                        <div class="x_title">
                            <h2 style="color: #ea580c; font-weight:700; font-size: 15px;"><i class="fa fa-check-square-o"></i> Phê Duyệt Cấp Quản Trị (Admin)</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p style="color:#64748b; font-size:13px; margin-bottom:12px;">Tất cả phòng ban chuyên môn đã thông qua. Vui lòng đưa ra quyết định cấp quản trị:</p>

                            <form action="<?php echo base_url('index.php/do_doc_submission/admin_review'); ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="nid_submission" value="<?php echo $submission['nid']; ?>">

                                <div class="form-group" style="margin-bottom: 10px;">
                                    <label style="font-weight:600; font-size:13px;">Đính kèm tệp văn bản chính thức đã xác nhận (PDF):</label>
                                    <input type="file" name="file_approved" class="form-control input-sm" accept=".pdf,.jpg,.png">
                                </div>

                                <div class="form-group" style="margin-bottom: 12px;">
                                    <label style="font-weight:600; font-size:13px;">Ghi chú phản hồi cho khách hàng:</label>
                                    <textarea name="reason_note" class="form-control input-sm" rows="2" placeholder="Ghi chú thêm..."></textarea>
                                </div>

                                <div style="display:flex; gap:10px;">
                                    <button type="submit" name="action" value="APPROVED" class="btn btn-success btn-sm" style="flex:1; font-weight:600; padding:7px 12px; font-size:12.5px;" onclick="return confirm('Xác nhận thông qua và hoàn tất hồ sơ?');">
                                        <i class="fa fa-check"></i> THÔNG QUA (APPROVED)
                                    </button>
                                    <button type="submit" name="action" value="REJECTED" class="btn btn-danger btn-sm" style="flex:1; font-weight:600; padding:7px 12px; font-size:12.5px;" onclick="return confirm('Xác nhận từ chối hồ sơ này?');">
                                        <i class="fa fa-times"></i> TỪ CHỐI (REJECTED)
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Box Cơ chế Quản trị & Can thiệp đặc biệt (Admin Override) -->
                <div class="x_panel" style="border: 1.5px dashed #dc2626; background: #fffaf0; border-radius: 4px;">
                    <div class="x_title">
                        <h2 style="color: #dc2626; font-weight:700; font-size: 15px;"><i class="fa fa-bolt"></i> Quyền Can Thiệp Đặc Biệt (Admin Override)</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="alert alert-danger" style="font-size:12px; padding:6px 10px; margin-bottom:12px; line-height: 1.4;">
                            <i class="fa fa-shield"></i> <strong>Ràng buộc an toàn:</strong> Cho phép can thiệp khẩn cấp bỏ qua bước xét duyệt hoặc hủy xử lý ngay lập tức. Bắt buộc nhập <strong>Admin Note</strong> lý do can thiệp.
                        </div>

                        <form action="<?php echo base_url('index.php/do_doc_submission/admin_override'); ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="nid_submission" value="<?php echo $submission['nid']; ?>">

                            <div class="form-group" style="margin-bottom: 10px;">
                                <label style="font-weight:600; font-size:13px; color:#991b1b;">Admin Note - Lý do can thiệp <span class="text-danger">* (Bắt buộc)</span>:</label>
                                <textarea name="admin_note" class="form-control input-sm" rows="2" placeholder="Ghi rõ lý do khẩn cấp thực hiện Force Approve hoặc Force Reject..." required><?php echo htmlspecialchars($submission['cadmin_note']); ?></textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 12px;">
                                <label style="font-weight:600; font-size:13px;">Tệp văn bản đính kèm (nếu Force Approve):</label>
                                <input type="file" name="file_approved_override" class="form-control input-sm" accept=".pdf,.jpg,.png">
                            </div>

                            <div style="display:flex; gap:10px;">
                                <button type="submit" name="override_action" value="FORCE_APPROVE" class="btn btn-warning btn-sm" style="flex:1; font-weight:600; padding:7px 12px; font-size:12px; color:#fff; background:#ea580c; border-color:#ea580c;" onclick="return confirm('CẢNH BÁO: Bạn đang thực hiện FORCE APPROVE (Phê duyệt khẩn cấp bỏ qua các phòng ban còn lại). Tiếp tục?');">
                                    <i class="fa fa-bolt"></i> FORCE APPROVE
                                </button>
                                <button type="submit" name="override_action" value="FORCE_REJECT" class="btn btn-danger btn-sm" style="flex:1; font-weight:600; padding:7px 12px; font-size:12px;" onclick="return confirm('CẢNH BÁO: Bạn đang thực hiện FORCE REJECT (Hủy dừng xử lý hồ sơ ngay lập tức). Tiếp tục?');">
                                    <i class="fa fa-ban"></i> FORCE REJECT
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Box Chi tiết người nộp -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thông Tin Khách Hàng</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><strong>Khách hàng:</strong> <?php echo htmlspecialchars($submission['ccustomer_name']); ?></p>
                        <p><strong>Điện thoại:</strong> <?php echo htmlspecialchars($submission['ccustomer_phone']); ?></p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($submission['ccustomer_email']); ?></p>
                        <p><strong>Tiêu đề:</strong> <?php echo htmlspecialchars($submission['ctitle']); ?></p>
                        <p><strong>Thời gian nộp:</strong> <?php echo date('d/m/Y H:i', strtotime($submission['ddate_submit'])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>
