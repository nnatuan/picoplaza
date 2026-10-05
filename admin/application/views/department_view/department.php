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
                <a href="<?php echo base_url('index.php/do_department_listview'); ?>" class="btn btn-secondary btn-sm" style="float: right;">
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
                <div class="x_panel qcare-form-panel">
                    <div class="x_title">
                        <h2><i class="fa fa-sitemap"></i> <?php echo $title_action; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form action="<?php echo ($event == 'add') ? base_url('index.php/do_department/f_save_add') : base_url('index.php/do_department/f_save_edit'); ?>" method="POST" class="form-horizontal form-label-left">
                            <input type="hidden" name="nid" value="<?php echo $dept['nid']; ?>">

                            <h5 class="qcare-form-section-title section-blue">THÔNG TIN PHÒNG BAN THẨM ĐỊNH</h5>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tên Phòng Ban <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="cname" value="<?php echo htmlspecialchars($dept['cname']); ?>" required="required" class="form-control" placeholder="Ví dụ: Phòng Kỹ Thuật, Ban An Ninh, Phòng Kế Toán & Pháp Lý...">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Mã Phòng Ban (Code)</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="ccode" value="<?php echo htmlspecialchars($dept['ccode']); ?>" class="form-control" placeholder="Ví dụ: DEPT_KT, DEPT_BQL, DEPT_KTPL (để trống tự sinh)" style="text-transform: uppercase;">
                                    <small class="text-muted"><i class="fa fa-info-circle"></i> Mã định danh duy nhất dùng trong luồng phân quyền và xuất báo cáo.</small>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Mô Tả Chức Năng Thẩm Định</label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name="cdescription" class="form-control" rows="3" placeholder="Mô tả các nội dung nghiệp vụ phòng ban này cần thẩm định (ví dụ: Bản vẽ kỹ thuật, an toàn PCCC, kết cấu điện nước...)..."><?php echo htmlspecialchars($dept['cdescription']); ?></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"><i class="fa fa-telegram" style="color: #0284c7;"></i> ID Nhóm Telegram</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" name="ctelegram_group_id" value="<?php echo isset($dept['ctelegram_group_id']) ? htmlspecialchars($dept['ctelegram_group_id']) : ''; ?>" class="form-control" placeholder="Ví dụ: -1005521381147 hoặc -5521381147" oninput="this.value = this.value.replace(/[^0-9\\-]/g, '');">
                                    <small class="text-muted"><i class="fa fa-info-circle"></i> ID nhóm chat Telegram của phòng ban nhận thông báo khẩn khi có hồ sơ mới cần duyệt (ID nhóm thường bắt đầu bằng dấu trừ <code>-</code>).</small>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Thứ Tự Sắp Xếp</label>
                                <div class="col-md-2 col-sm-2">
                                    <input type="number" name="cindex" value="<?php echo (int)$dept['cindex']; ?>" class="form-control" min="1">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Trạng Thái Hoạt Động</label>
                                <div class="col-md-3 col-sm-3">
                                    <select name="nstatus" class="form-control">
                                        <option value="1" <?php echo ($dept['nstatus'] == 1) ? 'selected' : ''; ?>>1: Đang hoạt động</option>
                                        <option value="0" <?php echo ($dept['nstatus'] == 0) ? 'selected' : ''; ?>>0: Tạm ngưng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button type="submit" class="btn btn-success qcare-form-btn">
                                        <i class="fa fa-save"></i> <?php echo ($event == 'add') ? 'Thêm Mới Phòng Ban' : 'Lưu Thay Đổi'; ?>
                                    </button>
                                    <a href="<?php echo base_url('index.php/do_department_listview'); ?>" class="btn btn-secondary qcare-form-btn">
                                        <i class="fa fa-chevron-left"></i> Hủy Bỏ
                                    </a>
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
