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
                <a href="<?php echo base_url('index.php/do_doc_type_listview'); ?>" class="btn btn-secondary btn-sm" style="float: right;">
                    <i class="fa fa-arrow-left"></i> Quay lại danh sách
                </a>
            </div>
        </div>
        <div class="clearfix"></div>

        <?php if(isset($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle"></i> <?php echo $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo htmlspecialchars($title_action); ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php 
                            $form_action = ($event == 'add') ? base_url('index.php/do_doc_type/f_save_add') : base_url('index.php/do_doc_type/f_save_edit');
                        ?>
                        <form action="<?php echo $form_action; ?>" method="POST" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            <input type="hidden" name="nid" value="<?php echo $doc_type['nid']; ?>">

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tên Loại Hồ Sơ / Đề Xuất <span class="text-danger">*</span></label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" name="cname" value="<?php echo htmlspecialchars($doc_type['cname']); ?>" class="form-control" placeholder="VD: Hồ sơ Đăng ký Thuê Mặt Bằng / Văn Phòng" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mã Loại Hồ Sơ (Code)</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="text" name="ccode" value="<?php echo htmlspecialchars($doc_type['ccode']); ?>" class="form-control" placeholder="VD: HS_THUE, HS_THICONG (Để trống sẽ tự sinh mã)">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mô Tả / Hướng Dẫn Áp Dụng</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea name="cdescription" class="form-control" rows="4" placeholder="Mô tả đối tượng khách hàng áp dụng, các giấy tờ kèm theo cần chuẩn bị..."><?php echo htmlspecialchars($doc_type['cdescription']); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Tệp Biểu Mẫu Chuẩn (PDF)</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="file" name="file_template" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                                    <small style="color:#64748b;">Khách hàng sẽ tải tệp này về để in, điền thông tin và ký tên trước khi nộp.</small>
                                    
                                    <?php if(!empty($doc_type['cfile_template'])): ?>
                                        <div style="margin-top: 8px; padding: 6px 12px; background: #f8fafc; border-radius: 6px; display: inline-block;">
                                            <span style="color:#16a34a; font-weight:700;"><i class="fa fa-file-pdf-o"></i> Tệp hiện tại:</span>
                                            <a href="<?php echo base_url('../' . $doc_type['cfile_template']); ?>" target="_blank" download style="color:#ea580c; font-weight:700; text-decoration:underline; margin-left: 6px;">
                                                <?php echo basename($doc_type['cfile_template']); ?> (Tải xem thử)
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    Phòng Ban Thẩm Định Song Song <br>
                                    <small style="font-weight:normal; color:#64748b;">(Phân quyền Duyệt hoặc Xem cho từng phòng ban)</small>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px;">
                                        <?php if(!empty($departments)): ?>
                                            <table class="table table-borderless" style="margin-bottom: 0;">
                                                <thead>
                                                    <tr style="border-bottom: 2px solid #cbd5e1; color: #334155;">
                                                        <th style="width: 80px; text-align: center; padding: 6px 8px; font-weight: 700; color: #0284c7;">
                                                            <i class="fa fa-check-square-o"></i> Duyệt
                                                        </th>
                                                        <th style="width: 85px; text-align: center; padding: 6px 8px; font-weight: 700; color: #64748b;">
                                                            <i class="fa fa-eye"></i> Chỉ Xem
                                                        </th>
                                                        <th style="padding: 6px 12px; font-weight: 700;">
                                                            Phòng ban chức năng
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $sel_approve = isset($selected_depts_approve) ? $selected_depts_approve : (isset($selected_depts) ? $selected_depts : array());
                                                        $sel_view    = isset($selected_depts_view) ? $selected_depts_view : array();
                                                    ?>
                                                    <?php foreach($departments as $dept): ?>
                                                        <?php 
                                                            $is_approve = in_array($dept['nid'], $sel_approve);
                                                            $is_view    = in_array($dept['nid'], $sel_view);
                                                        ?>
                                                        <tr style="border-bottom: 1px solid #f1f5f9;">
                                                            <td style="text-align: center; vertical-align: middle; padding: 10px 8px;">
                                                                <input type="checkbox" name="depts_approve[]" value="<?php echo $dept['nid']; ?>" 
                                                                       id="dept_approve_<?php echo $dept['nid']; ?>" 
                                                                       <?php if($is_approve) echo 'checked'; ?> 
                                                                       onchange="handleDeptCheck(<?php echo $dept['nid']; ?>, 'approve');"
                                                                       style="width: 18px; height: 18px; cursor: pointer;">
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle; padding: 10px 8px;">
                                                                <input type="checkbox" name="depts_view[]" value="<?php echo $dept['nid']; ?>" 
                                                                       id="dept_view_<?php echo $dept['nid']; ?>" 
                                                                       <?php if($is_view) echo 'checked'; ?> 
                                                                       onchange="handleDeptCheck(<?php echo $dept['nid']; ?>, 'view');"
                                                                       style="width: 18px; height: 18px; cursor: pointer;">
                                                            </td>
                                                            <td style="vertical-align: middle; padding: 10px 12px;">
                                                                <label for="dept_approve_<?php echo $dept['nid']; ?>" style="cursor: pointer; margin: 0; font-size: 14px;">
                                                                    <strong style="color:#0f172a;"><?php echo htmlspecialchars($dept['cname']); ?></strong>
                                                                    <?php if(!empty($dept['cdescription'])): ?>
                                                                        <span style="color:#64748b; font-size:12.5px;"> — <?php echo htmlspecialchars($dept['cdescription']); ?></span>
                                                                    <?php endif; ?>
                                                                </label>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                            <div style="margin-top: 10px; font-size: 12px; color: #64748b; border-top: 1px dashed #e2e8f0; padding-top: 8px;">
                                                <i class="fa fa-info-circle text-info"></i> <strong>Ghi chú:</strong> Phòng ban chọn <strong>Duyệt</strong> mặc định sẽ có toàn quyền <em>Xem thông tin + Duyệt/Từ chối</em>. Cột <strong>Chỉ Xem</strong> dành cho phòng ban chỉ cần theo dõi tiến độ mà không cần thao tác duyệt.
                                            </div>

                                            <script type="text/javascript">
                                                function handleDeptCheck(deptId, type) {
                                                    var approveCb = document.getElementById('dept_approve_' + deptId);
                                                    var viewCb = document.getElementById('dept_view_' + deptId);
                                                    if (type === 'approve' && approveCb.checked) {
                                                        if (viewCb) viewCb.checked = false;
                                                    } else if (type === 'view' && viewCb.checked) {
                                                        if (approveCb) approveCb.checked = false;
                                                    }
                                                }
                                            </script>
                                        <?php else: ?>
                                            <p style="color:#94a3b8; margin:0;">Chưa có phòng ban nào trong hệ thống.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Thứ tự hiển thị</label>
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <input type="number" name="cindex" value="<?php echo $doc_type['cindex']; ?>" class="form-control" min="0" style="width: 120px;">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Trạng Thái</label>
                                <div class="col-md-7 col-sm-7 col-xs-12" style="padding-top: 6px;">
                                    <label style="margin-right: 20px; cursor: pointer;">
                                        <input type="radio" name="nstatus" value="1" <?php if($doc_type['nstatus'] == 1) echo 'checked'; ?>> <span style="color:#16a34a; font-weight:700;">Hoạt động</span>
                                    </label>
                                    <label style="cursor: pointer;">
                                        <input type="radio" name="nstatus" value="0" <?php if($doc_type['nstatus'] == 0) echo 'checked'; ?>> <span style="color:#64748b; font-weight:700;">Tạm ngưng</span>
                                    </label>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group row">
                                <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-info" style="font-weight: 600;">
                                        <i class="fa fa-save"></i> Lưu Dữ Liệu
                                    </button>
                                    <a href="<?php echo base_url('index.php/do_doc_type_listview'); ?>" class="btn btn-default">Hủy bỏ</a>
                                </div>
                            </div>
                        </form>
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
