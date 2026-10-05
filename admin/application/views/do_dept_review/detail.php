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
                <a href="<?php echo base_url('index.php/do_dept_review_listview'); ?>" class="btn btn-secondary btn-sm" style="float: right;"><i class="fa fa-arrow-left"></i> Trở về danh sách</a>
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
            <!-- Cột trái: Thông tin hồ sơ & Trình duyệt tài liệu trực tiếp -->
            <div class="col-md-8 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>THẨM ĐỊNH HỒ SƠ: #<?php echo htmlspecialchars($submission['ccode']); ?> — TỆP ĐÍNH KÈM</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php 
                            $file_ext = strtolower(pathinfo($submission['cfile_path'], PATHINFO_EXTENSION));
                            $file_url = base_url('../' . $submission['cfile_path']);
                        ?>
                        <div style="margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                            <span class="badge badge-secondary">Định dạng: <?php echo strtoupper($file_ext); ?></span>
                            <a href="<?php echo $file_url; ?>" target="_blank" class="btn btn-sm btn-outline-primary" download><i class="fa fa-download"></i> Tải về máy</a>
                        </div>

                        <!-- Document Viewer -->
                        <div style="background: #1e293b; border-radius: 8px; padding: 10px; min-height: 520px; display: flex; align-items: center; justify-content: center;">
                            <?php if ($file_ext === 'pdf'): ?>
                                <iframe src="<?php echo $file_url; ?>" style="width: 100%; height: 600px; border: none; border-radius: 6px;"></iframe>
                            <?php else: ?>
                                <img src="<?php echo $file_url; ?>" alt="Hồ sơ đính kèm" style="max-width: 100%; max-height: 600px; object-fit: contain; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.3);">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Thao tác phê duyệt & Lịch sử -->
            <div class="col-md-4 col-sm-12">
                <!-- Box Thao tác thẩm định -->
                <div class="x_panel">
                    <div class="x_title">
                        <h4>Thao Tác Thẩm Định [<?php echo htmlspecialchars($current_step['dept_name']); ?>]</h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php 
                            $is_view_only = (isset($current_step['cpermission']) && $current_step['cpermission'] === 'VIEW');
                        ?>
                        <div style="margin-bottom: 15px;">
                            <strong style="font-size: 13px;">Quyền hạn bước này:</strong>
                            <?php if($is_view_only): ?>
                                <span class="badge badge-secondary" style="background:#64748b; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-eye"></i> CHỈ XEM HỒ SƠ</span>
                            <?php else: ?>
                                <span class="badge badge-primary" style="background:#0284c7; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-check-square-o"></i> THẨM ĐỊNH & DUYỆT</span>
                            <?php endif; ?>
                        </div>

                        <div style="margin-bottom: 15px;">
                            <strong style="font-size: 13px;">Trạng thái:</strong>
                            <?php if($is_view_only): ?>
                                <span class="badge badge-info" style="background:#3b82f6; color:#fff; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-info-circle"></i> ĐANG THEO DÕI TIẾN ĐỘ</span>
                            <?php elseif($current_step['cstep_status'] == 'APPROVED'): ?>
                                <span class="badge badge-success" style="background:#16a34a; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-check"></i> ĐÃ PHÊ DUYỆT</span>
                            <?php elseif($current_step['cstep_status'] == 'REJECTED'): ?>
                                <span class="badge badge-danger" style="background:#dc2626; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-times"></i> ĐÃ TỪ CHỐI</span>
                            <?php else: ?>
                                <span class="badge badge-warning" style="background:#ea580c; color:#fff; font-size:12px; padding:4px 8px; font-weight:600;"><i class="fa fa-clock-o"></i> ĐANG CHỜ THẨM ĐỊNH</span>
                            <?php endif; ?>
                        </div>

                        <?php if($is_view_only): ?>
                            <div class="alert alert-info" style="font-size:13px; background:#f0f9ff; border-color:#bae6fd; color:#0369a1; margin-bottom:0;">
                                <i class="fa fa-info-circle"></i> <strong>Chế độ Xem thông tin:</strong> Phòng ban của bạn được phân quyền <strong>Chỉ Xem</strong> hồ sơ này để nắm bắt tiến độ, không có quyền thao tác duyệt hoặc từ chối.
                            </div>
                        <?php elseif($current_step['cstep_status'] == 'PENDING' && $submission['cstatus'] == 'IN_REVIEW'): ?>
                            <form action="<?php echo base_url('index.php/do_dept_review/process_action'); ?>" method="POST" onsubmit="return confirm('Xác nhận phê duyệt thông qua bước thẩm định này?');" style="margin-bottom: 10px;">
                                <input type="hidden" name="nid_submission" value="<?php echo $submission['nid']; ?>">
                                <input type="hidden" name="nid_dept" value="<?php echo $current_step['nid_dept']; ?>">
                                <input type="hidden" name="action" value="APPROVED">
                                <button type="submit" class="btn btn-success btn-sm btn-block" style="font-weight: 600; padding: 7px 12px; font-size: 13px;">
                                    <i class="fa fa-check"></i> PHÊ DUYỆT THÔNG QUA (APPROVE)
                                </button>
                            </form>

                            <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#rejectModal" style="font-weight: 600; padding: 7px 12px; font-size: 13px;">
                                <i class="fa fa-times"></i> TỪ CHỐI HỒ SƠ (REJECT)
                            </button>
                        <?php else: ?>
                            <div class="alert alert-info" style="font-size:13px;">
                                Bước thẩm định này đã được hoàn tất hoặc hồ sơ đã chuyển sang giai đoạn khác.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Box Thông tin khách hàng & hồ sơ -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Thông Tin Hồ Sơ</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled">
                            <li><strong>Khách hàng:</strong> <?php echo htmlspecialchars($submission['ccustomer_name']); ?></li>
                            <li><strong>SĐT:</strong> <?php echo htmlspecialchars($submission['ccustomer_phone']); ?></li>
                            <li><strong>Email:</strong> <?php echo htmlspecialchars($submission['ccustomer_email']); ?></li>
                            <li><strong>Loại hồ sơ:</strong> <?php echo htmlspecialchars($submission['doc_type_name']); ?></li>
                            <li><strong>Tiêu đề:</strong> <?php echo htmlspecialchars($submission['ctitle']); ?></li>
                            <li><strong>Thời gian nộp:</strong> <?php echo date('d/m/Y H:i', strtotime($submission['ddate_submit'])); ?></li>
                            <?php if(!empty($submission['cnote'])): ?>
                                <li style="margin-top:8px;"><strong>Ghi chú khách:</strong> <em><?php echo nl2br(htmlspecialchars($submission['cnote'])); ?></em></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Box Tiến độ các phòng ban khác -->
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tiến Độ Các Phòng Ban</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-sm">
                            <?php foreach($all_steps as $st): ?>
                                <tr>
                                    <td>
                                        <strong><?php echo htmlspecialchars($st['dept_name']); ?></strong>
                                        <?php if(isset($st['cpermission']) && $st['cpermission'] === 'VIEW'): ?>
                                            <span class="badge badge-secondary" style="font-size:10px; background:#64748b; margin-left:4px;">Chỉ xem</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="text-align: right;">
                                        <?php if(isset($st['cpermission']) && $st['cpermission'] === 'VIEW'): ?>
                                            <span style="color:#64748b; font-weight:600;"><i class="fa fa-eye"></i> Theo dõi</span>
                                        <?php elseif($st['cstep_status'] == 'APPROVED'): ?>
                                            <span style="color:#16a34a; font-weight:700;"><i class="fa fa-check"></i> Đã duyệt</span>
                                        <?php elseif($st['cstep_status'] == 'REJECTED'): ?>
                                            <span style="color:#dc2626; font-weight:700;"><i class="fa fa-times"></i> Từ chối</span>
                                        <?php else: ?>
                                            <span style="color:#ea580c; font-weight:700;"><i class="fa fa-clock-o"></i> Chờ</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Từ Chối Hồ Sơ Bắt Buộc Nhập Lý Do -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url('index.php/do_dept_review/process_action'); ?>" method="POST" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color:#dc2626; font-weight:800;"><i class="fa fa-times-circle"></i> TỪ CHỐI THẨM ĐỊNH HỒ SƠ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="nid_submission" value="<?php echo $submission['nid']; ?>">
                <input type="hidden" name="nid_dept" value="<?php echo $current_step['nid_dept']; ?>">
                <input type="hidden" name="action" value="REJECTED">

                <div class="form-group">
                    <label style="font-weight:700; color:#0f172a;">Lý do từ chối thẩm định <span class="text-danger">* (Bắt buộc)</span>:</label>
                    <textarea name="reason_note" class="form-control" rows="4" placeholder="Nhập chi tiết các điểm chưa đạt yêu cầu để khách hàng sửa đổi bổ sung..." required></textarea>
                </div>
                <div class="alert alert-warning" style="font-size:12.5px;">
                    <i class="fa fa-exclamation-triangle"></i> <strong>Lưu ý:</strong> Khi bạn từ chối, toàn bộ hồ sơ sẽ ngay lập tức chuyển trạng thái <strong>REJECTED</strong> và gửi email thông báo lý do đến khách hàng.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                <button type="submit" class="btn btn-danger" style="font-weight:700;"><i class="fa fa-times"></i> Xác nhận Từ chối hồ sơ</button>
            </div>
        </form>
    </div>
</div>

<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>
