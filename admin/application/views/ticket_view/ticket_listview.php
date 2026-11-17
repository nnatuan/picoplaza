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
                            <h2>QUẢN LÝ DANH SÁCH TICKET HỖ TRỢ KHÁCH HÀNG</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class=\"collapse-link\"><i class=\"fa fa-chevron-up\"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        
                                        <div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <input class="form-control" name="txtf_cticket_code" type="text" value="<?php echo $txtf_cticket_code; ?>" placeholder="Mã Ticket (Ví dụ: PS-1042)" style="width: 180px; display: inline-block;" />
                                            <input class="form-control" name="txtf_cname" type="text" value="<?php echo $txtf_cname; ?>" placeholder="Họ tên khách hàng..." style="width: 220px; display: inline-block;" />
                                            
                                            <select class="form-control" name="txtf_nstatus" style="width: 180px; display: inline-block;">
                                                <option value="">-- Trạng thái --</option>
                                                <option value="1" <?php if($txtf_nstatus === '1') echo 'selected'; ?>>1 — Mới tiếp nhận</option>
                                                <option value="2" <?php if($txtf_nstatus === '2') echo 'selected'; ?>>2 — Đang xử lý</option>
                                                <option value="3" <?php if($txtf_nstatus === '3') echo 'selected'; ?>>3 — Đã giải quyết</option>
                                            </select>

                                            <input name="btn_header_search" type="button" class="btn btn-info" value="Tìm kiếm" 
                                                onclick="js_SetSubmitButtonClick(this.form, 'btn_search');" style="margin: 0;" />
                                        </div>

                                        <table class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 110px; text-align: center;">Mã Ticket</th>
                                                    <th style="width: 200px;">Khách hàng</th>
                                                    <th>Tiêu đề nội dung yêu cầu</th>
                                                    <th style="width: 140px; text-align: center;">Thời gian</th>
                                                    <th style="width: 130px; text-align: center;">Trạng thái</th>
                                                    <th style="width: 130px; text-align: center;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($obj_listview as $row): ?>
                                                    <tr>
                                                        <td style="text-align: center; font-family: 'JetBrains Mono', monospace; font-weight: 700; color: #a9782a;">
                                                            #<?php echo $row['cticket_code']; ?>
                                                        </td>
                                                        <td>
                                                            <strong><?php echo $row['cname']; ?></strong><br/>
                                                            <small style="color: #64748b;"><?php echo $row['cemail']; ?></small>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url(); ?>index.php/do_ticket/f_edit/<?php echo $row['nid']; ?>" style="font-weight: 600; color: #b65c38; text-decoration: underline;">
                                                                <?php echo $row['ctitle']; ?>
                                                            </a>
                                                        </td>
                                                        <td style="text-align: center; font-size: 13px;">
                                                            <?php echo date('H:i d/m/Y', strtotime($row['dcreated_at'])); ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <?php if($row['nstatus'] == 1): ?>
                                                                <span class="badge badge-danger" style="background: #b65c38;">Mới nhận</span>
                                                            <?php elseif($row['nstatus'] == 2): ?>
                                                                <span class="badge badge-warning" style="background: #c9973f; color: #fff;">Đang xử lý</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-success" style="background: #3f6b57;">Đã xong</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td style="text-align: center;">
                                                            <a href="<?php echo base_url() . 'index.php/do_ticket/f_edit/' . $row['nid']; ?>" 
															   class="btn btn-warning btn-xs btn-action" title="">
															   <i class="fa fa-edit"></i> Chi tiết
															</a>
															<a href="<?php echo base_url() . 'index.php/do_ticket_listview/f_delete/' . $row['nid']; ?>" 
														   class="btn btn-danger btn-xs btn-action" title="Xóa" 
														   onclick="return confirm('Bạn có chắc muốn xóa (ẩn) Ticket này?');"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php if(empty($obj_listview)): ?>
                                                    <tr>
                                                        <td colspan="7" style="text-align: center; padding: 24px; color: #94a3b8; font-style: italic;">Không tìm thấy yêu cầu Ticket nào khớp với bộ lọc dữ liệu.</td>
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