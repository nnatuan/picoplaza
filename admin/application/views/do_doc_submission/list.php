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
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>QUẢN TRỊ TỔNG THỂ HỒ SƠ & PHÊ DUYỆT (ADMIN)</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Bộ lọc hồ sơ -->
                        <form method="GET" action="<?php echo base_url('index.php/do_doc_submission_listview'); ?>" class="form-inline" style="margin-bottom: 20px; gap: 10px; display: flex; flex-wrap: wrap;">
                            <input type="text" name="code" value="<?php echo htmlspecialchars($filter_code); ?>" class="form-control" placeholder="Mã hồ sơ hoặc tên khách..." style="width: 250px;">

                            <select name="status" class="form-control">
                                <option value="">-- Tất cả trạng thái --</option>
                                <option value="IN_REVIEW" <?php if($filter_status == 'IN_REVIEW') echo 'selected'; ?>>Đang thẩm định phòng ban</option>
                                <option value="WAITING_ADMIN" <?php if($filter_status == 'WAITING_ADMIN') echo 'selected'; ?>>Chờ Admin duyệt</option>
                                <option value="COMPLETED" <?php if($filter_status == 'COMPLETED') echo 'selected'; ?>>Hoàn tất (Đã duyệt)</option>
                                <option value="REJECTED" <?php if($filter_status == 'REJECTED') echo 'selected'; ?>>Bị từ chối</option>
                            </select>

                            <button type="submit" class="btn btn-primary" style="margin-bottom:0;"><i class="fa fa-search"></i> Tìm kiếm & Lọc</button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr style="background:#f1f5f9;">
                                        <th style="width: 120px; text-align: center;">Mã Hồ Sơ</th>
                                        <th>Loại Đề Xuất / Tiêu Đề</th>
                                        <th style="width: 200px;">Khách Hàng</th>
                                        <th style="width: 140px; text-align: center;">Tiến Độ Phòng</th>
                                        <th style="width: 160px; text-align: center;">Trạng Thái Hệ Thống</th>
                                        <th style="width: 140px; text-align: center;">Thời Gian Nộp</th>
                                        <th style="width: 130px; text-align: center;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($list)): ?>
                                        <?php foreach($list as $row): ?>
                                            <tr>
                                                <td style="text-align: center; font-weight: 700; color: #ea580c; font-family: monospace;">
                                                    #<?php echo $row['ccode']; ?>
                                                    <?php if($row['is_override'] == 1): ?>
                                                        <br><span class="badge badge-warning" style="font-size:10px; background:#f59e0b; color:#fff;">OVERRIDE</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong style="color:#0f172a;"><?php echo htmlspecialchars($row['doc_type_name']); ?></strong><br/>
                                                    <small style="color:#64748b;"><?php echo htmlspecialchars($row['ctitle']); ?></small>
                                                </td>
                                                <td>
                                                    <strong><?php echo htmlspecialchars($row['ccustomer_name']); ?></strong><br/>
                                                    <small style="color:#64748b;"><?php echo htmlspecialchars($row['ccustomer_phone']); ?></small>
                                                </td>
                                                <td style="text-align: center;">
                                                    <span class="badge badge-info" style="font-size:12px;">
                                                        <?php echo $row['approved_steps']; ?> / <?php echo $row['total_steps']; ?> Phòng
                                                    </span>
                                                </td>
                                                <td style="text-align: center;">
                                                    <?php if($row['cstatus'] == 'COMPLETED'): ?>
                                                        <span class="badge badge-success"><i class="fa fa-check"></i> HOÀN TẤT</span>
                                                    <?php elseif($row['cstatus'] == 'WAITING_ADMIN'): ?>
                                                        <span class="badge badge-danger" style="background:#ea580c;"><i class="fa fa-hourglass-half"></i> CHỜ ADMIN DUYỆT</span>
                                                    <?php elseif($row['cstatus'] == 'IN_REVIEW'): ?>
                                                        <span class="badge badge-primary" style="background:#0284c7;"><i class="fa fa-clock-o"></i> ĐANG THẨM ĐỊNH</span>
                                                    <?php elseif($row['cstatus'] == 'REJECTED'): ?>
                                                        <span class="badge badge-danger"><i class="fa fa-times"></i> BỊ TỪ CHỐI</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td style="text-align: center; font-size: 12.5px; color:#64748b;">
                                                    <?php echo date('d/m/Y H:i', strtotime($row['ddate_submit'])); ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('index.php/do_doc_submission/detail/' . $row['nid']); ?>" 
                                                       class="btn btn-warning btn-xs btn-action" title="Quản trị hồ sơ">
                                                        <i class="fa fa-cog"></i> Quản Trị
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" style="text-align: center; color: #64748b; padding: 20px;">
                                                Chưa có hồ sơ nào trong hệ thống.
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
