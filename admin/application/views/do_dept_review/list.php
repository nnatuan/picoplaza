<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>

<form name="frm_dept_review_list" id="frm_dept_review_list" method="post" action="<?php echo isset($link_page) ? $link_page : base_url('index.php/do_dept_review_listview'); ?>">
    <input type="hidden" name="hidden_button" id="hidden_button" value="" />
    
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
                            <h2><i class="fa <?php echo !empty($is_view_only_mode) ? 'fa-eye' : 'fa-check-square-o'; ?>"></i> <?php echo !empty($page_title) ? $page_title : 'CỔNG TIẾP NHẬN & THẨM ĐỊNH HỒ SƠ PHÒNG BAN'; ?></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <?php if(!empty($is_view_only_mode)): ?>
                                <div class="alert alert-info" style="background:#f0f9ff; border:1px solid #bae6fd; color:#0369a1; border-radius:6px; margin-bottom:15px; padding:10px 15px;">
                                    <i class="fa fa-info-circle"></i> <strong>Chế độ Xem Hồ Sơ:</strong> Dưới đây là các hồ sơ khách hàng nộp mà phòng ban của bạn được gắn quyền <strong>Chỉ Xem / Theo Dõi</strong> để nắm bắt thông tin và phối hợp nghiệp vụ.
                                </div>
                            <?php endif; ?>

                            <!-- Thanh Bộ Lọc -->
                            <div class="well" style="padding: 12px 15px; margin-bottom: 15px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px;">
                                <div class="row" style="margin-bottom: 0;">
                                    <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 8px;">
                                        <label style="font-size: 12px; margin-bottom: 4px; color: #475569;">Phòng ban:</label>
                                        <select name="cbof_dept_id" class="form-control input-sm" onchange="js_SetSubmitButtonClick(this.form, 'btn_filter');">
                                            <option value="0">-- Tất cả phòng ban --</option>
                                            <?php if(!empty($departments)): foreach($departments as $dept): ?>
                                                <option value="<?php echo $dept['nid']; ?>" <?php if(isset($selected_dept) && $selected_dept == $dept['nid']) echo 'selected'; ?>>
                                                    <?php echo htmlspecialchars($dept['cname']); ?>
                                                </option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 8px;">
                                        <label style="font-size: 12px; margin-bottom: 4px; color: #475569;">Trạng thái thẩm định:</label>
                                        <select name="cbof_step_status" class="form-control input-sm" onchange="js_SetSubmitButtonClick(this.form, 'btn_filter');">
                                            <option value="">-- Tất cả trạng thái --</option>
                                            <option value="PENDING" <?php if(isset($filter_status) && $filter_status == 'PENDING') echo 'selected'; ?>>Chờ thẩm định</option>
                                            <option value="APPROVED" <?php if(isset($filter_status) && $filter_status == 'APPROVED') echo 'selected'; ?>>Đã phê duyệt</option>
                                            <option value="REJECTED" <?php if(isset($filter_status) && $filter_status == 'REJECTED') echo 'selected'; ?>>Đã từ chối</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-sm-8 col-xs-12" style="margin-bottom: 8px;">
                                        <label style="font-size: 12px; margin-bottom: 4px; color: #475569;">Từ khóa tìm kiếm:</label>
                                        <input type="text" name="txtf_keyword" class="form-control input-sm" 
                                               value="<?php echo isset($txtf_keyword) ? htmlspecialchars($txtf_keyword) : ''; ?>" 
                                               placeholder="Nhập mã hồ sơ, tên khách, SĐT, tiêu đề..." />
                                    </div>

                                    <div class="col-md-2 col-sm-4 col-xs-12" style="margin-bottom: 8px;">
                                        <label style="font-size: 12px; margin-bottom: 4px; display: block; color: transparent;">&nbsp;</label>
                                        <button type="button" class="btn btn-primary btn-sm btn-block" onclick="js_SetSubmitButtonClick(this.form, 'btn_filter');">
                                            <i class="fa fa-search"></i> Tìm kiếm / Lọc
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="background:#f1f5f9;">
                                            <th style="width: 45px; text-align: center;">STT</th>
                                            <th style="width: 120px; text-align: center;">Mã Hồ Sơ</th>
                                            <th>Loại Hồ Sơ / Tiêu Đề</th>
                                            <th style="width: 200px;">Khách Hàng Nộp</th>
                                            <th style="width: 170px;">Phòng Ban Phụ Trách</th>
                                            <th style="width: 130px; text-align: center;">Trạng Thái</th>
                                            <th style="width: 130px; text-align: center;">Thời Gian Nộp</th>
                                            <th style="width: 120px; text-align: center;">Thao Tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(!empty($list)): 
                                                $cur_page = isset($txt_current_page) ? (int)$txt_current_page : 1;
                                                $r_per_page = isset($txt_row_per_page) ? (int)$txt_row_per_page : 15;
                                                $stt = ($cur_page - 1) * $r_per_page + 1;
                                                foreach($list as $row): 
                                        ?>
                                                <tr>
                                                    <td style="text-align: center; color: #64748b;"><?php echo $stt++; ?></td>
                                                    <td style="text-align: center; font-weight: 700; color: #ea580c; font-family: monospace; font-size: 13px;">
                                                        #<?php echo $row['ccode']; ?>
                                                    </td>
                                                    <td>
                                                        <strong style="color:#0f172a; font-size: 13px;"><?php echo htmlspecialchars($row['doc_type_name']); ?></strong><br/>
                                                        <small style="color:#475569; display: inline-block; margin-top: 3px;"><?php echo htmlspecialchars($row['ctitle']); ?></small>
                                                    </td>
                                                    <td>
                                                        <strong style="color:#1e293b;"><i class="fa fa-user" style="color:#94a3b8;"></i> <?php echo htmlspecialchars($row['ccustomer_name']); ?></strong><br/>
                                                        <small style="color:#64748b;"><i class="fa fa-phone" style="color:#94a3b8;"></i> <?php echo htmlspecialchars($row['ccustomer_phone']); ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info" style="background:#0284c7; padding: 4px 8px;"><?php echo htmlspecialchars($row['dept_name']); ?></span><br/>
                                                        <?php if(isset($row['cpermission']) && $row['cpermission'] === 'VIEW'): ?>
                                                            <span class="badge badge-secondary" style="background:#64748b; font-size:10.5px; margin-top:4px;"><i class="fa fa-eye"></i> Chỉ xem</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-success" style="background:#16a34a; font-size:10.5px; margin-top:4px;"><i class="fa fa-check-square-o"></i> Quyền Duyệt</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <?php if(isset($row['cpermission']) && $row['cpermission'] === 'VIEW'): ?>
                                                            <span class="badge badge-secondary" style="background:#64748b; padding: 4px 8px;"><i class="fa fa-eye"></i> THEO DÕI</span>
                                                        <?php elseif($row['cstep_status'] == 'APPROVED'): ?>
                                                            <span class="badge badge-success" style="background:#16a34a; padding: 4px 8px;"><i class="fa fa-check"></i> ĐÃ DUYỆT</span>
                                                        <?php elseif($row['cstep_status'] == 'REJECTED'): ?>
                                                            <span class="badge badge-danger" style="background:#dc2626; padding: 4px 8px;"><i class="fa fa-times"></i> TỪ CHỐI</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-warning" style="background:#f59e0b; padding: 4px 8px;"><i class="fa fa-clock-o"></i> CHỜ DUYỆT</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td style="text-align: center; color: #64748b; font-size: 12px;">
                                                        <?php echo !empty($row['ddate_submit']) ? date('d/m/Y H:i', strtotime($row['ddate_submit'])) : '--'; ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="<?php echo base_url('index.php/do_dept_review/detail/' . $row['nid_submission'] . '/' . $row['nid_dept']); ?>" 
                                                           class="btn <?php echo (isset($row['cpermission']) && $row['cpermission'] === 'VIEW') ? 'btn-default' : 'btn-info'; ?> btn-xs btn-action" 
                                                           title="<?php echo (isset($row['cpermission']) && $row['cpermission'] === 'VIEW') ? 'Xem chi tiết' : 'Xem & Thẩm định'; ?>">
                                                            <i class="fa <?php echo (isset($row['cpermission']) && $row['cpermission'] === 'VIEW') ? 'fa-eye' : 'fa-pencil-square-o'; ?>"></i> 
                                                            <?php echo (isset($row['cpermission']) && $row['cpermission'] === 'VIEW') ? 'Xem Hồ Sơ' : 'Thẩm định'; ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php endforeach; else: ?>
                                            <tr>
                                                <td colspan="8" style="text-align: center; color: #64748b; padding: 30px; font-style: italic;">
                                                    <i class="fa fa-folder-open-o fa-2x" style="color: #cbd5e1; display: block; margin-bottom: 8px;"></i>
                                                    Không tìm thấy hồ sơ nào phù hợp tiêu chí lọc.
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Bảng Phân Trang Chuẩn Hệ Thống -->
                            <?php if(isset($txt_total_page)): ?>
                                <table class="table qcare-table-pagination" cellspacing="1" style="margin-top: 15px;">
                                    <tr>
                                        <td>
                                            <span style="color: #64748b; font-size: 12.5px;">
                                                <i class="fa fa-list-ul"></i> Tổng số: <strong><?php echo isset($total_row) ? $total_row : count($list); ?></strong> hồ sơ
                                            </span>
                                        </td>
                                        <td class="qcare-pagination-block">
                                            <div class="form-inline pull-right">
                                                <label><?php echo isset($lbl_rows_per_page) ? $lbl_rows_per_page : 'Số dòng hiển thị'; ?>:</label>&nbsp;
                                                <input class="form-control text-center input-sm" name="txt_row_per_page" type="text" size="5" value="<?php echo isset($txt_row_per_page) ? $txt_row_per_page : 15; ?>" />&nbsp;
                                                <input name="btn_row_per_page" type="button" value="<?php echo isset($btn_choose) ? $btn_choose : 'Chọn'; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" />
                                            </div>
                                        </td>
                                        <td class="qcare-pagination-block">
                                            <div class="form-inline pull-right">
                                                <?php if(isset($txt_current_page) && $txt_current_page > 1): ?>
                                                    <input class="btn btn-default btn-sm" name="btn_previous" type="button" value="<<" onclick="js_SetSubmitButtonClick(this.form, 'btn_previous');" title="Trang trước" />&nbsp;
                                                <?php endif; ?>
                                                <label><?php echo (isset($txt_current_page) ? $txt_current_page : 1) . ' / ' . (isset($txt_total_page) ? max(1, $txt_total_page) : 1); ?></label>&nbsp;
                                                <?php if(isset($txt_current_page) && isset($txt_total_page) && $txt_current_page < $txt_total_page): ?>
                                                    <input class="btn btn-default btn-sm" name="btn_next" type="button" value=">>" onclick="js_SetSubmitButtonClick(this.form, 'btn_next');" title="Trang tiếp theo" />&nbsp;
                                                <?php endif; ?>
                                                <input class="form-control text-center input-sm" name="txt_current_page" type="text" value="<?php echo isset($txt_current_page) ? $txt_current_page : 1; ?>" size="5" />&nbsp;
                                                <input name="btn_page_number" type="button" value="<?php echo isset($btn_choose) ? $btn_choose : 'Chọn'; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" />
                                            </div>
                                        </td>
                                    </tr>					
                                </table>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>
