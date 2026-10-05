<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><small></small></h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>QUẢN LÝ DANH SÁCH CÔNG VIỆC NHẮC VIỆC NỘI BỘ</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        
                                        <div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <input class="form-control" name="txtf_ctitle" type="text" value="<?php echo isset($txtf_ctitle) ? $txtf_ctitle : ''; ?>" placeholder="Tìm tên công việc..." style="width: 250px; display: inline-block;" />
                                            
											<?php /*
                                            <select class="form-control" name="txtf_nstatus" style="width: 180px; display: inline-block;">
                                                <option value="">-- Trạng thái --</option>
                                                <option value="0" <?php if(isset($txtf_nstatus) && $txtf_nstatus === '0') echo 'selected'; ?>>0 — Chưa làm (Pending)</option>
                                                <option value="1" <?php if(isset($txtf_nstatus) && $txtf_nstatus === '1') echo 'selected'; ?>>1 — Đang làm (Active)</option>
                                                <option value="2" <?php if(isset($txtf_nstatus) && $txtf_nstatus === '2') echo 'selected'; ?>>2 — Đã hoàn thành</option>
                                            </select>
											*/ ?>
											
                                            <input name="btn_header_search" type="button" class="btn btn-info" value="Tìm kiếm" 
                                                onclick="js_SetSubmitButtonClick(this.form, 'btn_search');" style="margin: 0;" />
                                            
                                            <a href="<?php echo base_url(); ?>index.php/do_task_management/f_add" class="btn btn-success" style="margin: 0;"><i class="fa fa-plus"></i> Thêm việc mới</a>
                                        </div>

                                        <table class="table table-striped table-bordered" style="width:100%; font-size: 13.5px;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 60px; text-align: center;">Mã việc</th>
                                                    <th>Nội dung công việc cần xử lý</th>
                                                    <th style="width: 180px;">Nhân sự phụ trách</th>
                                                    <th style="width: 130px; text-align: center;">Hạn hoàn thành</th>
                                                    <th style="width: 160px; text-align: center;">Cảnh báo tiến độ</th> 
													<?php /*<th style="width: 110px; text-align: center;">Trạng thái</th>*/ ?>
                                                    <th style="width: 130px; text-align: center;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($obj_listview as $row): 
                                                    // Tính toán nhãn đếm ngược cảnh báo Mail cho Admin giám sát
                                                    $days = (int)$row['days_left'];
                                                    if ($days < 0) {
                                                        $time_badge = '<span class="badge badge-danger" style="background:#d9534f;">Quá hạn '.abs($days).' ngày</span>';
                                                    } elseif ($days === 0) {
                                                        $time_badge = '<span class="badge badge-warning" style="background:#f0ad4e; color:#fff;">Hết hạn hôm nay!</span>';
                                                    } elseif ($days === 1) {
                                                        $time_badge = '<span class="badge badge-info" style="background:#5bc0de;">Còn 1 ngày (Chờ gửi mail)</span>';
                                                    } else {
                                                        $time_badge = '<span class="badge badge-secondary" style="background:#94a3b8;">Còn '.$days.' ngày</span>';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td style="text-align: center; font-family: 'JetBrains Mono', monospace; font-weight: 700; color: #a9782a;">
                                                            #<?php echo $row['nid']; ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>index.php/do_task_management/f_edit/<?php echo $row['nid']; ?>" style="font-weight: 600; color: #b65c38; text-decoration: underline;">
                                                                <?php echo htmlspecialchars($row['ctitle']); ?>
                                                            </a>
                                                            <?php if(!empty($row['cdescription'])): ?>
                                                                <br/><small style="color: #64748b;"><?php echo htmlspecialchars($row['cdescription']); ?></small>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><strong><?php echo $row['staff_name']; ?></strong></td>
                                                        <td style="text-align: center; font-family: 'JetBrains Mono', monospace;"><?php echo date('d/m/Y H:i', strtotime($row['ddue_date'])); ?></td>
                                                        <td style="text-align: center;"><?php echo $time_badge; ?></td> 
														<?php /*
														<td style="text-align: center;">
                                                            <?php if($row['nstatus'] == 0): ?>
                                                                <span class="badge badge-danger" style="background: #b65c38;">Chưa làm</span>
                                                            <?php elseif($row['nstatus'] == 1): ?>
                                                                <span class="badge badge-warning" style="background: #c9973f; color: #fff;">Đang làm</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-success" style="background: #3f6b57;">Đã xong</span>
                                                            <?php endif; ?>
                                                        </td>
														*/ ?>
                                                        <td style="text-align: center;">
                                                            <a href="<?php echo base_url() . 'index.php/do_task_management/f_edit/' . $row['nid']; ?>" 
															   class="btn btn-warning btn-xs btn-action" title="Sửa">
															   <i class="fa fa-edit"></i> Sửa
															</a>
                                                            <input name="btn_delete_row" type="button" class="btn btn-danger btn-xs btn-action" value="Xóa" 
                                                                onclick="if(confirm('Bạn có chắc muốn xóa công việc này?')) { document.getElementById('hidden_nid').value='<?php echo $row['nid']; ?>'; js_SetSubmitButtonClick(this.form, 'btn_delete'); }" />
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php if(empty($obj_listview)): ?>
                                                    <tr>
                                                        <td colspan="7" style="text-align: center; padding: 24px; color: #94a3b8; font-style: italic;">Không tìm thấy lịch nhắc việc nào khớp với bộ lọc dữ liệu.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>

                                        <table class="table-listview-pagging" style="width: 100%;">
                                            <tr>
                                                <td align="right">
                                                    <div style="display:inline-flex; align-items:center;">
                                                        <label class="col-form-label" style="margin-right:10px;">Tổng số dòng: <strong><?php echo $txt_total_row; ?></strong></label>
                                                        <?php if($txt_current_page > 1): ?>
                                                            <input class="btn btn-secondary btn-sm" name="btn_back" type="button" value="<<" onclick="js_SetSubmitButtonClick(this.form, this.name);"/>&nbsp;
                                                        <?php endif ?>
                                                        <label class="col-form-label">Trang: <?php echo $txt_current_page; ?> / <?php echo $txt_total_page; ?></label>&nbsp;
                                                        <?php if($txt_current_page < $txt_total_page): ?>
                                                            <input class="btn btn-secondary btn-sm" name="btn_next" type="button" value=">>" onclick="js_SetSubmitButtonClick(this.form, this.name);"/>&nbsp;
                                                        <?php endif ?>
                                                        <input class="form-control" name="txt_current_page" type="text" value="<?php echo $txt_current_page; ?>" style="text-align:center; height:31px; width:50px; display:inline-block;" size="5" />&nbsp;
                                                        <input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-info btn-sm" style="margin:0;" />
                                                    </div>	
                                                </td>
                                            </tr>					
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="hidden_button" id="hidden_button" value="" />
    <input type="hidden" name="hidden_nid" id="hidden_nid" value="" />
</form>