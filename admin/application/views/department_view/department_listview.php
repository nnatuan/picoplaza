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
                <a href="<?php echo base_url('index.php/do_department/f_add'); ?>" class="btn btn-info btn-sm" style="float: right;">
                    <i class="fa fa-plus"></i> Thêm Phòng Ban Mới
                </a>
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
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-sitemap"></i> QUẢN LÝ DANH MỤC PHÒNG BAN THẨM ĐỊNH</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Form tìm kiếm -->
                        <form method="GET" action="<?php echo base_url('index.php/do_department_listview'); ?>" class="form-inline" style="margin-bottom: 20px; gap: 10px; display: flex;">
                            <input type="text" name="keyword" value="<?php echo htmlspecialchars($search); ?>" class="form-control" placeholder="Tìm theo tên hoặc mã phòng ban..." style="width: 320px;">
                            <button type="submit" class="btn btn-info btn-sm" style="margin-bottom:0;"><i class="fa fa-search"></i> Tìm Kiếm</button>
                            <?php if(!empty($search)): ?>
                                <a href="<?php echo base_url('index.php/do_department_listview'); ?>" class="btn btn-default btn-sm" style="margin-bottom:0;">Xem tất cả</a>
                            <?php endif; ?>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr style="background:#f1f5f9;">
                                        <th style="width: 50px; text-align: center;">STT</th>
                                        <th style="width: 140px; text-align: center;">Mã Phòng Ban</th>
                                        <th class="text-left">Tên Phòng Ban</th>
                                        <th class="text-left">Mô Tả Chức Năng Thẩm Định</th>
                                        <th style="width: 120px; text-align: center;">Nhân Sự Gán</th>
                                        <th style="width: 110px; text-align: center;">Đang Chờ Duyệt</th>
                                        <th style="width: 80px; text-align: center;">Thứ Tự</th>
                                        <th style="width: 100px; text-align: center;">Trạng Thái</th>
                                        <th style="width: 140px; text-align: center;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($list)): ?>
                                        <?php $stt = 1; foreach($list as $row): ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $stt++; ?></td>
                                                <td style="text-align: center; font-weight: 700; color: #0284c7; font-family: monospace;">
                                                    <?php echo htmlspecialchars($row['ccode']); ?>
                                                </td>
                                                <td class="text-left">
                                                    <strong style="color:#0f172a; font-size:14px;"><?php echo htmlspecialchars($row['cname']); ?></strong>
                                                    <?php if(!empty($row['ctelegram_group_id'])): ?>
                                                        <div style="font-size: 12px; color: #0284c7; margin-top: 4px;">
                                                            <i class="fa fa-telegram"></i> Group: <code><?php echo htmlspecialchars($row['ctelegram_group_id']); ?></code>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-left" style="color:#64748b; font-size:13px;">
                                                    <?php echo !empty($row['cdescription']) ? nl2br(htmlspecialchars($row['cdescription'])) : '<em style="color:#cbd5e1;">(Chưa có mô tả)</em>'; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($row['staff_count'] > 0): ?>
                                                        <span class="badge badge-info" style="background:#0284c7;"><i class="fa fa-users"></i> <?php echo $row['staff_count']; ?> nhân viên</span>
                                                    <?php else: ?>
                                                        <span style="color:#94a3b8; font-size:12px;">Chưa có</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($row['pending_count'] > 0): ?>
                                                        <span class="badge badge-warning" style="background:#ea580c; color:#fff;"><?php echo $row['pending_count']; ?> hồ sơ</span>
                                                    <?php else: ?>
                                                        <span style="color:#10b981; font-size:12px;"><i class="fa fa-check"></i> Đã xong</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center; font-weight: 600;"><?php echo (int)$row['cindex']; ?></td>
                                                <td style="text-align: center;">
                                                    <?php if($row['nstatus'] == 1): ?>
                                                        <a href="<?php echo base_url('index.php/do_department_listview/f_status/' . $row['nid'] . '/0'); ?>" title="Bấm để tạm ngưng" onclick="return confirm('Tạm ngưng hoạt động phòng ban này?');">
                                                            <span class="badge badge-success" style="background:#16a34a; cursor:pointer;"><i class="fa fa-check"></i> Hoạt động</span>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo base_url('index.php/do_department_listview/f_status/' . $row['nid'] . '/1'); ?>" title="Bấm để kích hoạt" onclick="return confirm('Kích hoạt hoạt động lại phòng ban này?');">
                                                            <span class="badge badge-secondary" style="background:#64748b; cursor:pointer;"><i class="fa fa-pause"></i> Tạm ngưng</span>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('index.php/do_department/f_edit/' . $row['nid']); ?>" class="btn btn-warning btn-xs btn-action" title="Chỉnh sửa">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="<?php echo base_url('index.php/do_department_listview/f_delete/' . $row['nid']); ?>" class="btn btn-danger btn-xs btn-action" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa phòng ban [<?php echo addslashes($row['cname']); ?>]?');">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" style="text-align: center; padding: 30px; color: #94a3b8;">
                                                <i class="fa fa-folder-open-o" style="font-size: 32px; display:block; margin-bottom: 10px;"></i>
                                                Chưa có phòng ban nào trong hệ thống.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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
