<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel qcare-form-panel">
                    <div class="x_title">
                        <h2><i class="fa fa-file-text-o"></i> <?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <form name="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            
                            <h5 class="qcare-form-section-title section-blue">I. THÔNG TIN CẤU HÌNH TẬP TIN</h5>
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Tên/Tiêu đề File <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>" required="required" class="form-control" placeholder="Ví dụ: Đơn đăng ký thẻ cư dân Tòa A">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Mô tả thông tin</label>
                                <div class="col-md-8 col-sm-8">
                                    <textarea name="txt_cdescription" class="form-control" rows="3" placeholder="Nhập tóm tắt ghi chú hướng dẫn sử dụng file..."><?php echo $txt_cdescription; ?></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
								<label class="col-form-label col-md-2 col-sm-2 label-align">Phân loại tập tin</label>
								<div class="col-md-3 col-sm-3">
									<select name="cbof_ctype" class="form-control" onchange="js_ToggleTabSetting(this.value);">
										<option value="document" <?php echo ($cbof_ctype == 'document') ? 'selected' : ''; ?>>Mẫu biểu Tòa nhà</option>
										<option value="internal" <?php echo ($cbof_ctype == 'internal') ? 'selected' : ''; ?>>Tài liệu Nội bộ</option>
										<option value="rules" <?php echo ($cbof_ctype == 'rules') ? 'selected' : ''; ?>>Nội quy - Quy định</option>
									</select>
								</div>

								<label class="col-form-label col-md-2 col-sm-2 label-align" id="lbl_tab_setting" style="<?php echo ($cbof_ctype == 'internal') ? 'display:none;' : ''; ?>">Quyền hiển thị</label>
								<div class="col-md-3 col-sm-3" id="box_tab_setting" style="<?php echo ($cbof_ctype == 'internal') ? 'display:none;' : ''; ?>">
									<select name="cbof_caccess_type" class="form-control">
										<option value="public" <?php echo ($cbof_caccess_type == 'public') ? 'selected' : ''; ?>>Public (Tất cả mọi người)</option>
										<option value="member" <?php echo ($cbof_caccess_type == 'member') ? 'selected' : ''; ?>>Member (Chỉ thành viên)</option>
									</select>
								</div>
							</div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Đính kèm Tập tin <?php echo ($event == 'add') ? '<span class="required">*</span>' : ''; ?></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="file" name="file_upload" class="form-control-file" />
                                    <?php if(!empty($txt_cfile_path)): ?>
                                        <div style="margin-top: 8px;">
                                            <span class="label label-info"><i class="fa fa-paperclip"></i> File hiện tại: <?php echo $txt_cfile_path; ?> (<?php echo $txt_cfile_size; ?>)</span>
                                        </div>
                                    <?php endif; ?>
                                    <small class="text-muted" style="display: block; margin-top: 5px;">Hỗ trợ định dạng: PDF, DOC, DOCX, XLS, XLSX, PPT, ZIP, RAR, JPG, PNG (Dung lượng tối đa 20MB).</small>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Trạng thái</label>
                                <div class="col-md-3 col-sm-3">
                                    <select name="cbof_nstatus" class="form-control">
                                        <option value="1" <?php echo ($cbof_nstatus == '1') ? 'selected' : ''; ?>>1: Cho phép hiển thị</option>
                                        <option value="0" <?php echo ($cbof_nstatus == '0') ? 'selected' : ''; ?>>0: Ẩn tập tin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-success qcare-form-btn" name="btn_submit" value="btn_submit" onclick="js_SetSubmitButtonClick(this.form, this.name);"><i class="fa fa-save"></i> Lưu thông tin Tập tin</button>
                                    <button class="btn btn-secondary qcare-form-btn" type="button" onclick="location.href='<?php echo $link_cancel; ?>'"><i class="fa fa-chevron-left"></i> Quay về</button>
                                </div>
                            </div>

                            <input name="hidden_nid" type="hidden" value="<?php echo $nid; ?>" />
                            <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
                            <input name="txt_old_file_path" type="hidden" value="<?php echo $txt_cfile_path; ?>" />
                            <input name="txt_old_file_size" type="hidden" value="<?php echo $txt_cfile_size; ?>" />
                            <input type="hidden" name="hidden_button" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function js_ToggleTabSetting(val) {
    if (val === 'internal') {
        document.getElementById('lbl_tab_setting').style.display = 'none';
        document.getElementById('box_tab_setting').style.display = 'none';
    } else {
        document.getElementById('lbl_tab_setting').style.display = 'block';
        document.getElementById('box_tab_setting').style.display = 'block';
    }
}

document.querySelector('input[name="file_upload"]').addEventListener('change', function() {
    var max_size = 20 * 1024 * 1024; // 20 MB
    if (this.files[0] && this.files[0].size > max_size) {
        alert('File bạn chọn quá lớn (' + (this.files[0].size / (1024*1024)).toFixed(2) + ' MB). Vui lòng chọn file dưới 20 MB!');
        this.value = ''; // Reset input file
    }
});
</script>