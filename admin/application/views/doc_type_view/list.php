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
                <a href="<?php echo base_url('index.php/do_doc_type/f_add'); ?>" class="btn btn-info btn-sm" style="float: right;">
                    <i class="fa fa-plus"></i> Thêm Mới
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
                        <h2>QUẢN LÝ LOẠI HỒ SƠ, BIỂU MẪU & CẤU HÌNH PHÒNG THẨM ĐỊNH</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Form tìm kiếm -->
                        <form method="GET" action="<?php echo base_url('index.php/do_doc_type_listview'); ?>" class="form-inline" style="margin-bottom: 20px; gap: 10px; display: flex;">
                            <input type="text" name="keyword" value="<?php echo htmlspecialchars($search); ?>" class="form-control" placeholder="Tìm kiếm theo tên hoặc mã loại hồ sơ..." style="width: 320px;">
                            <button type="submit" class="btn btn-info btn-sm" style="margin-bottom:0;"><i class="fa fa-search"></i> Tìm Kiếm</button>
                            <?php if(!empty($search)): ?>
                                <a href="<?php echo base_url('index.php/do_doc_type_listview'); ?>" class="btn btn-default btn-sm" style="margin-bottom:0;">Xem tất cả</a>
                            <?php endif; ?>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr style="background:#f1f5f9;">
                                        <th style="width: 60px; text-align: center;">STT</th>
                                        <th style="width: 130px; text-align: center;">Mã Loại</th>
                                        <th class="text-left">Tên Loại Hồ Sơ / Đề Xuất</th>
                                        <th style="width: 150px; text-align: center;">Tệp Biểu Mẫu PDF</th>
                                        <th style="width: 250px;">Phòng Ban Duyệt Song Song</th>
                                        <th style="width: 90px; text-align: center;">Trạng Thái</th>
                                        <th style="width: 140px; text-align: center;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($list)): ?>
                                        <?php $stt = 1; foreach($list as $row): ?>
                                            <tr>
                                                <td style="text-align: center;"><?php echo $stt++; ?></td>
                                                <td style="text-align: center; font-weight: 700; color: #a9782a; font-family: monospace;">
                                                    #<?php echo htmlspecialchars($row['ccode']); ?>
                                                </td>
                                                <td class="text-left">
                                                    <strong style="color:#0f172a; font-size:14px;"><?php echo htmlspecialchars($row['cname']); ?></strong>
                                                    <?php if(!empty($row['cdescription'])): ?>
                                                        <br/><small style="color:#64748b;"><?php echo nl2br(htmlspecialchars($row['cdescription'])); ?></small>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if(!empty($row['cfile_template'])): ?>
                                                        <a href="<?php echo base_url('../' . $row['cfile_template']); ?>" target="_blank" class="btn btn-default btn-xs btn-action" download style="color:#dc2626;">
                                                            <i class="fa fa-file-pdf-o"></i> Tải Mẫu PDF
                                                        </a>
                                                    <?php else: ?>
                                                        <span style="color:#94a3b8; font-size:12px;">Chưa có tệp</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        $dept_approve_ids = !empty($row['cdepts_required']) ? explode(',', $row['cdepts_required']) : array();
                                                        $dept_view_ids    = !empty($row['cdepts_view']) ? explode(',', $row['cdepts_view']) : array();
                                                        $has_any = false;

                                                        if(!empty($dept_approve_ids) && $dept_approve_ids[0] != ''):
                                                            foreach($dept_approve_ids as $did):
                                                                $did = trim($did);
                                                                if(empty($did)) continue;
                                                                $has_any = true;
                                                                $dname = isset($dept_map[$did]) ? $dept_map[$did] : 'Phòng #' . $did;
                                                    ?>
                                                                <span class="badge badge-info" style="background:#0284c7; margin: 2px;" title="Quyền Duyệt">
                                                                    <i class="fa fa-check-square-o"></i> <?php echo htmlspecialchars($dname); ?>
                                                                </span>
                                                    <?php 
                                                            endforeach;
                                                        endif;

                                                        if(!empty($dept_view_ids) && $dept_view_ids[0] != ''):
                                                            foreach($dept_view_ids as $did):
                                                                $did = trim($did);
                                                                if(empty($did)) continue;
                                                                $has_any = true;
                                                                $dname = isset($dept_map[$did]) ? $dept_map[$did] : 'Phòng #' . $did;
                                                    ?>
                                                                <span class="badge badge-secondary" style="background:#64748b; margin: 2px;" title="Chỉ Xem">
                                                                    <i class="fa fa-eye"></i> <?php echo htmlspecialchars($dname); ?> (Xem)
                                                                </span>
                                                    <?php 
                                                            endforeach;
                                                        endif;

                                                        if (!$has_any):
                                                    ?>
                                                        <span style="color:#94a3b8; font-size:12px;">Admin duyệt trực tiếp</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('index.php/do_doc_type/f_status/' . $row['nid']); ?>" title="Bấm để đổi trạng thái">
                                                        <?php if($row['nstatus'] == 1): ?>
                                                            <i class="i-status fa fa-check text-success" title="Đang hiển thị"></i>
                                                        <?php else: ?>
                                                            <i class="i-status fa fa-times text-danger" title="Tạm ngưng"></i>
                                                        <?php endif; ?>
                                                    </a>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('index.php/do_doc_type/f_edit/' . $row['nid']); ?>" 
                                                       class="btn btn-warning btn-xs btn-action" title="Sửa">
                                                        <i class="fa fa-edit"></i> Sửa
                                                    </a>
                                                    <a href="<?php echo base_url('index.php/do_doc_type/f_delete/' . $row['nid']); ?>" 
                                                       class="btn btn-danger btn-xs btn-action" 
                                                       onclick="return confirm('Bạn có chắc chắn muốn xóa loại hồ sơ này?');" title="Xóa">
                                                        <i class="fa fa-trash"></i> Xóa
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" style="text-align: center; color: #64748b; padding: 20px;">
                                                Chưa có loại hồ sơ nào trong hệ thống. Bấm "+ Thêm Loại Hồ Sơ & Biểu Mẫu Mới" ở trên để tạo.
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
