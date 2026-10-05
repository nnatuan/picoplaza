<form name="frm_file_list" id="frm_file_list" method="post" action="<?php echo $link_page; ?>">
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo $lbl_form_title; ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            
                            <div class="top-filter qcare-top-filter" style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
								<?php if (has_staff_role('admin')): ?>
                                <input name="btn_header_add" type="button" class="btn btn-primary" value="Tải lên Tập tin / Mẫu biểu" 
                                    onclick="js_SetSubmitButtonClick(this.form,'btn_add');" />
                                <?php endif; ?>
								
                                <!-- Nút Tải ZIP cho các file được chọn -->
                                <button type="button" class="btn btn-success" onclick="js_SetSubmitButtonClick(this.form, 'btn_download_zip');">
                                    <i class="fa fa-file-archive-o"></i> Tải về ZIP các file chọn
                                </button>
                                
                                <input type="hidden" name="hidden_button" id="hidden_button"/>	
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                  <thead>
										<tr>
											 <th style="width: 70px; text-align: center;">
												#<input type="checkbox" onclick="js_ToggleCheckAllFiles(this);" style="transform: scale(1.1); cursor: pointer; margin-left: 8px;" />
                                             </th>
											 <th>Tên tập tin / Mẫu biểu</th>
											 <th class="qcare-th-center" style="width: 170px;">Phân loại</th>
											 <th class="qcare-th-center" style="width: 140px;">Hiển thị</th>
                                             <th class="qcare-th-center" style="width: 110px;">Dung lượng</th>
											 <th class="qcare-th-center" style="width: 110px;">Trạng thái</th>
											 <th class="qcare-th-center qcare-th-action" style="width: 180px;">Thao tác</th>
										</tr>
									</thead>
                                  <tbody>
                                    <!-- CỘT BỘ LỌC TÌM KIẾM -->
                                    <tr class="filter qcare-filter-row">
                                        <td class="text-center">
											<input name="btn_filter" type="button" class="btn btn-info btn-sm" value="Lọc" 
												onclick="js_SetSubmitButtonClick(this.form, this.name);" />
										</td>
                                        <td>
                                            <input name="txtf_ctitle" type="text" class="form-control input-sm" value="<?php echo isset($txtf_ctitle) ? $txtf_ctitle : ''; ?>" placeholder="Tìm tên/tiêu đề tập tin..." />
                                        </td>
                                        <td>
                                            <select name="cbof_ctype" class="form-control input-sm" onchange="js_SetSubmitButtonClick(this.form, 'btn_filter');">
                                                <option value="">-- Tất cả --</option>
                                                <option value="document" <?php echo (isset($cbof_ctype) && $cbof_ctype == 'document') ? 'selected' : ''; ?>>Mẫu biểu Tòa nhà</option>
                                                <option value="internal" <?php echo (isset($cbof_ctype) && $cbof_ctype == 'internal') ? 'selected' : ''; ?>>Tài liệu Nội bộ</option>
												<option value="rules" <?php echo (isset($cbof_ctype) && $cbof_ctype == 'rules') ? 'selected' : ''; ?>>Nội quy - Quy định</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="cbof_caccess_type" class="form-control input-sm" onchange="js_SetSubmitButtonClick(this.form, 'btn_filter');">
                                                <option value="">-- Tất cả --</option>
                                                <option value="public" <?php echo (isset($cbof_caccess_type) && $cbof_caccess_type == 'public') ? 'selected' : ''; ?>>Công khai</option>
                                                <option value="member" <?php echo (isset($cbof_caccess_type) && $cbof_caccess_type == 'member') ? 'selected' : ''; ?>>Khách hàng</option>
                                            </select>
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    
                                    <!-- DANH SÁCH DỮ LIỆU -->
                                    <?php 
                                        if (isset($data_view) && is_array($data_view) && !empty($data_view)):
                                            $i = ($txt_current_page - 1) * $txt_row_per_page + 1; 
                                            foreach($data_view as $data):
                                    ?>
                                      <tr class="even pointer">
                                         <td class="text-center" style="vertical-align: middle;">
                                            <?php echo $i; ?><input type="checkbox" name="chk_file_id[]" value="<?php echo $data['nid']; ?>" class="chk_item_file" style="transform: scale(1.1); cursor: pointer; margin-left: 8px;" />
                                         </td>
                                         <td>
                                            <strong><i class="fa fa-file-text-o text-primary"></i> <?php echo $data['ctitle']; ?></strong>
                                            <?php if(!empty($data['cdescription'])): ?>
                                                <br/><small class="text-muted"><?php echo $data['cdescription']; ?></small>
                                            <?php endif; ?>
                                         </td>
                                         <td class="text-center">
                                            <?php 
                                                if ($data['ctype'] == 'document') {
                                                    echo '<span class="badge bg-blue">Mẫu biểu Tòa nhà</span>';
                                                } elseif ($data['ctype'] == 'rules') {
                                                    echo '<span class="badge bg-orange" style="background:#d97706; color:#fff;">Nội quy - Quy định</span>';
                                                } else {
                                                    echo '<span class="badge bg-secondary">Tài liệu Nội bộ</span>';
                                                }
                                            ?>
                                         </td>
                                         <td class="text-center">
                                            <?php 
                                                if ($data['caccess_type'] == 'member') {
                                                    echo '<span class="label label-warning">Khách hàng</span>';
                                                } else {
                                                    echo '<span class="label label-success">Công khai</span>';
                                                }
                                            ?>
                                         </td>
                                         <td class="text-center"><?php echo !empty($data['cfile_size']) ? $data['cfile_size'] : '-'; ?></td>
                                         <td class="text-center">
                                            <?php 
                                                if ($data['nstatus'] == 1) echo '<span class="badge bg-green">Hiển thị</span>';
                                                else echo '<span class="badge bg-red">Ẩn</span>';
                                            ?>
                                         </td>
                                         <td class="text-center">
                                            <a href="<?php echo base_url() . 'index.php/do_file_listview/f_download_single/' . $data['nid']; ?>" class="btn btn-info btn-xs btn-action" title="Tải về"><i class="fa fa-download"></i> Tải về</a>
											<?php if ($role == 'admin'): ?>
											<a href="<?php echo base_url() . 'index.php/do_file/f_edit/' . $data['nid']; ?>" class="btn btn-warning btn-xs btn-action"><i class="fa fa-edit"></i> Sửa</a>
											<a href="<?php echo base_url() . 'index.php/do_file_listview/f_delete/' . $data['nid']; ?>" class="btn btn-danger btn-xs btn-action" onclick="return confirm('Bạn có chắc muốn xóa tập tin này?');"><i class="fa fa-trash"></i></a>
											<?php endif; ?>
										</td>
                                      </tr>
                                    <?php $i++; endforeach; else: ?>
                                      <tr><td colspan="7" class="text-center" style="font-style:italic; padding:20px;">Chưa có tập tin/mẫu biểu nào trong hệ thống.</td></tr>
                                    <?php endif; ?>
                                  </tbody>
                                </table>
                            </div>
                            
                            <table class="table qcare-table-pagination" cellspacing="1">
								<tr><td></td><td class="qcare-pagination-block"><div class="form-inline pull-right"><label><?php echo $lbl_rows_per_page; ?>:</label>&nbsp;<input class="form-control text-center input-sm" name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>" />&nbsp;<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" /></div></td><td class="qcare-pagination-block"><div class="form-inline pull-right"><?php if($txt_current_page > 1): ?><input class="btn btn-default btn-sm" name="btn_previous" type="button" value="<<" onclick="js_SetSubmitButtonClick(this.form, 'btn_previous');"/>&nbsp;<?php endif; ?><label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>&nbsp;<?php if($txt_current_page < $txt_total_page): ?><input class="btn btn-default btn-sm" name="btn_next" type="button" value=">>" onclick="js_SetSubmitButtonClick(this.form, 'btn_next');"/>&nbsp;<?php endif ?><input class="form-control text-center input-sm" name="txt_current_page" type="text" value="<?php echo $txt_current_page; ?>" size="5" />&nbsp;<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" /></div></td></tr>					
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input name="hidden_nid" type="hidden" value="0" />
    <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
</form>

<script type="text/javascript">
function js_ToggleCheckAllFiles(master) {
    var checkboxes = document.getElementsByClassName('chk_item_file');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = master.checked;
    }
}
</script>