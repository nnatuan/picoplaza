<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-users"></i> DANH SÁCH KHÁCH HÀNG NHẬN TIN</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card-box table-responsive">
                                
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 60px; text-align: center;">
												#<input type="checkbox" id="chk_all_emails" onclick="js_ToggleCheckAll(this);" style="transform: scale(1.1); cursor: pointer;margin-left: 10px;" /></th>
                                            <th>Địa chỉ Email khách hàng</th>
                                            <th style="width: 160px; text-align: center;">Thời gian đăng ký</th>
                                            <th style="width: 90px; text-align: center;">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          $stt = ($txt_current_page - 1) * 20; 
                                          foreach($obj_listview as $row): 
                                              $stt++;
                                        ?>
                                            <tr>
                                                <td style="text-align: center;">
													<?php echo $stt; ?><input type="checkbox" name="chk_email_id[]" value="<?php echo $row['nid']; ?>" class="chk_item_email" style="transform: scale(1.1); cursor: pointer;margin-left: 10px;" />
												</td>
                                                <td><strong><?php echo $row['cemail']; ?></strong></td>
                                                <td style="text-align: center; font-size: 13px;">
                                                    <?php echo date('H:i d/m/Y', strtotime($row['dcreated_at'])); ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url() . 'index.php/do_newsletter/f_delete/' . $row['nid']; ?>" 
														   class="btn btn-danger btn-xs btn-action" title="Xóa" 
														   onclick="return confirm('Bạn có chắc muốn xóa (ẩn) Email này?');"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                        <?php if(empty($obj_listview)): ?>
                                            <tr>
                                                <td colspan="5" style="text-align: center; padding: 24px; color: #94a3b8; font-style: italic;">Không tìm thấy địa chỉ email nào khớp với bộ lọc dữ liệu.</td>
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
				
				<div class="col-md-6 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-paper-plane"></i> GỬI EMAIL HÀNG LOẠT</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="form-group">
                                <label style="font-weight: 700;">Tiêu đề Email Bản tin <span class="text-danger">*</span></label>
                                <input type="text" name="txt_email_subject" class="form-control" placeholder="Ví dụ: Cập nhật rổ hàng biệt thự Mini Quận 9 giá tốt tháng này..." />
                            </div>
                            
                            <div class="form-group" style="margin-top: 15px;">
                                <label style="font-weight: 700;">Nội dung chi tiết Bản tin (Hỗ trợ thẻ HTML) <span class="text-danger">*</span></label>
                                <textarea id="editor" name="txt_email_content" class="form-control" rows="10" placeholder="Nhập nội dung thông điệp chiến dịch gửi đến khách hàng..." style="resize: vertical;font-size: 13.5px;"></textarea>
                            </div>
                            
                            <div class="ln_solid"></div>
                            
                            <button type="button" class="btn btn-success btn-block" onclick="js_ValidateAndSendBulk(this.form);">
                                <i class="fa fa-envelope"></i> GỬI THÔNG BÁO
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" name="hidden_button" id="hidden_button" value="" />
    <input type="hidden" name="hidden_nid" id="hidden_nid" value="" />
</form>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
function js_SetSubmitButtonClick(obj_form, btn_name) {
    obj_form.hidden_button.value = btn_name;
    obj_form.submit();		
}	

// ĐÃ THÊM: Hàm xử lý Check / Uncheck toàn bộ danh sách email hiển thị
function js_ToggleCheckAll(master) {
    var checkboxes = document.getElementsByClassName('chk_item_email');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = master.checked;
    }
}

// ĐÃ THÊM: Hàm kiểm tra nghiệp vụ trước khi tiến hành submit phát động chiến dịch
function js_ValidateAndSendBulk(obj_form) {
    var checkboxes = document.getElementsByClassName('chk_item_email');
    var has_checked = false;
    
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            has_checked = true;
            break;
        }
    }
    
    if (!has_checked) {
        alert('Vui lòng tích chọn ít nhất một địa chỉ Email khách hàng từ danh sách bên trái để gửi tin!');
        return false;
    }
    
    if (confirm('Hệ thống sẽ thực thi gửi email bản tin đến các khách hàng được chọn. Xác nhận gửi?')) {
        js_SetSubmitButtonClick(obj_form, 'btn_send_bulk_email');
    }
}
</script>
<script>
    var roxyFileman = '<?php echo $fr_img?>/fileman/index.html'; 
    $(function(){
        CKEDITOR.replace('editor', {
            filebrowserBrowseUrl: roxyFileman,
            height: '280px',
            filebrowserImageBrowseUrl: roxyFileman + '?type=image',
            removeDialogTabs: 'link:upload;image:upload',
            toolbar: [
                { name: 'clipboard', items: ['Undo', 'Redo'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'RemoveFormat'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
                { name: 'links', items: ['Link', 'Unlink'] },
                { name: 'insert', items: ['Image', 'HorizontalRule'] },
                { name: 'tools', items: ['Maximize', 'Source'] }
            ],
            removePlugins: 'elementspath,fileupload,dropviewer,uploadwidget,uploadimage',
            resize_enabled: true
        });
    });
</script>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>