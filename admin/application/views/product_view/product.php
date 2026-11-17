<style>
.document_box {
	min-height: inherit;background: #fafafa; border: 1px solid #e5e5e5; margin-bottom: 18px; padding: 16px; border-radius: 4px;
}
.document_box .x_title {
	border-bottom: 1px dashed #ddd; padding-bottom: 8px; margin-bottom: 15px;
}
.document_box .x_title h2 {
	font-size: 14px; font-weight: 700; color: #333; margin: 0;
}
</style>
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
                        <h2><?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php /* if(!empty($m_message)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $m_message; ?>
                            </div>
                        <?php } */ ?>

                        <form name="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">
                            
                            <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab1" role="tab" aria-selected="true">Thông tin cơ bản</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab2" role="tab" aria-selected="false">Nội dung bài viết</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab3" role="tab" aria-selected="false">Hình ảnh & Bản đồ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="document-tab" data-toggle="tab" href="#tab4" role="tab" aria-selected="false">Hồ sơ tài liệu đính kèm</a>
                                </li>
                            </ul>
										
                            <div class="tab-content" id="myTabContent">
                                
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Tiêu đề <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>" required="required" class="form-control" onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Mã Code URL <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" id="txt_ccode" name="txt_ccode" value="<?php echo $txt_ccode; ?>" required="required" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Nhóm danh mục <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <?php echo $gencbo_cat_product; ?>
                                        </div>	
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Tỉnh / Thành phố <span class="required">*</span></label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <?php echo $gencbo_province; ?>
                                        </div>	
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Địa chỉ chi tiết</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="txt_clocation_detail" value="<?php echo $txt_clocation_detail; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Giá hiển thị</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="txt_cprice_display" value="<?php echo $txt_cprice_display; ?>" placeholder="Ví dụ: 3,2 tỷ, Thỏa thuận" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Giá trị số (VNĐ)</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="txt_nprice_value" value="<?php echo $txt_nprice_value; ?>" placeholder="Lưu số nguyên để lọc khoảng giá, ví dụ: 3200000000" class="form-control num_only">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Diện tích (m²)</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="txt_narea" value="<?php echo $txt_narea; ?>" placeholder="Ví dụ: 78.5" class="form-control">
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Phòng ngủ / Vệ sinh</label>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" name="txt_nbedroom" value="<?php echo $txt_nbedroom; ?>" placeholder="Số phòng ngủ" class="form-control num_only">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <input type="text" name="txt_nbathroom" value="<?php echo $txt_nbathroom; ?>" placeholder="Số nhà vệ sinh" class="form-control num_only">
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Trạng thái giao dịch</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <?php echo $gen_cbo_product_status; ?>
                                        </div>	
                                    </div>

                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Trạng thái hiển thị</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <?php echo $gen_cbo_status; ?>
                                        </div>	
                                    </div>
									<div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Chỉ mục</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input type="text" name="cindex" value="<?php echo $cindex; ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab2" role="tabpanel">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Mô tả tóm tắt</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <textarea class="form-control" name="txt_cshort_content" style="height:120px;"><?php echo $txt_cshort_content; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Nội dung chi tiết</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <textarea class="form-control" id="editor1" name="txt_ccontent"><?php echo $txt_ccontent; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab3" role="tabpanel">
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Hình ảnh đại diện</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <input name="txt_cimage" type="file" id="txt_cimage" class="form-control-file">
                                            <br>
                                            <?php if($txt_cimage != ''): ?>
                                                <img class="img-thumbnail mt-2" width="240" src="<?php echo $fr_img.'upload/images_product/full_images/'.$txt_cimage; ?>"/>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="item form-group">
                                        <label class="col-form-label col-md-2 col-sm-2 label-align">Mã bản đồ Google Maps</label>
                                        <div class="col-md-8 col-sm-8 ">
                                            <textarea class="form-control" name="txt_cmaps_iframe" rows="5" placeholder="Dán đoạn mã Iframe nhúng từ Google Maps vào đây..."><?php echo $txt_cmaps_iframe; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="tab4" role="tabpanel">
									<br />
									<?php 
									  $cms_docs = array(
										  'contract' => array('title' => 'Hồ sơ Hợp đồng giao dịch', 'icon' => 'fa-file'),
										  'diagram'  => array('title' => 'Sơ đồ thiết kế / Bản vẽ chi tiết', 'icon' => 'fa-compass'),
										  'legal'    => array('title' => 'Hồ sơ giấy tờ pháp lý BĐS', 'icon' => 'fa-gavel')
									  );
									  foreach($cms_docs as $key => $meta) {
										  $current_doc = NULL;
										  if (!empty($document_list)) {
											  foreach ($document_list as $d) {
												  if ($d['ctype_doc'] === $key) { 
													  $current_doc = $d; 
													  break; 
												  }
											  }
										  }
									?>
										<div class="x_panel document_box">
											<div class="x_title">
												<h2>
													<i class="fa <?php echo $meta['icon']; ?> text-success"></i> <?php echo $meta['title']; ?>
												</h2>
												<div class="clearfix"></div>
											</div>
											
											<div class="x_content">
												<div class="item form-group">
													<label class="col-form-label col-md-3 col-sm-3 label-align">Quyền kiểm soát truy cập</label>
													<div class="col-md-7 col-sm-7">
														<select name="doc_level_<?php echo $key; ?>" class="form-control">
															<option value="1" <?php if(!empty($current_doc) && $current_doc['naccess_level'] == 1) echo 'selected="selected"'; ?>>Mức 1: Khu vực công khai (Khách vãng lai)</option>
															<option value="2" <?php if(!empty($current_doc) && $current_doc['naccess_level'] == 2) echo 'selected="selected"'; ?>>Mức 2: Khu vực khách hàng (Cần đăng nhập)</option>
															<option value="3" <?php if(!empty($current_doc) && $current_doc['naccess_level'] == 3) echo 'selected="selected"'; ?>>Mức 3: Khu vực bảo mật (Chỉ nhân viên nội bộ)</option>
														</select>
													</div>
												</div>

												<div class="item form-group">
													<label class="col-form-label col-md-3 col-sm-3 label-align">Tải tệp tin mới đè lên</label>
													<div class="col-md-7 col-sm-7">
														<input type="file" name="doc_file_<?php echo $key; ?>" class="form-control-file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
														<small class="form-text text-muted" style="margin-top: 4px;">* Định dạng được chấp nhận: PDF, DOC, DOCX, JPG, PNG (Dưới 5MB).</small>
													</div>
												</div>

												<div class="item form-group js-doc-row-<?php echo $key; ?>" style="margin-top: 12px; <?php echo empty($current_doc) ? 'display:none;' : ''; ?>">
													<label class="col-form-label col-md-3 col-sm-3 label-align">Tệp hiện tại trên server</label>
													<div class="col-md-7 col-sm-7" style="padding-top: 6px;">
														<a href="<?php echo !empty($current_doc) ? base_url() . '../upload/document/' . $current_doc['cfile_path'] : '#'; ?>" target="_blank" class="text-primary font-weight-bold mr-2 js-doc-link-<?php echo $key; ?>">
															<i class="fa fa-external-link"></i> <span class="js-doc-name-<?php echo $key; ?>"><?php echo !empty($current_doc) ? $current_doc['cfile_path'] : ''; ?></span>
														</a>
														<span class="badge badge-secondary mr-3" style="font-size: 10px; font-weight: 500;">
															<?php echo !empty($current_doc) ? date('d/m/Y H:i', strtotime($current_doc['dcreated_at'])) : ''; ?>
														</span>

														<!-- NÚT XÓA FILE TRỰC TIẾP QUA AJAX -->
														<button type="button" class="btn btn-danger btn-sm" onclick="js_DeleteProductDocument('<?php echo !empty($current_doc) ? $current_doc['nid'] : 0; ?>', '<?php echo $key; ?>')">
															<i class="fa fa-trash"></i> Xóa tệp này
														</button>
													</div>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
                            </div>
										
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-primary" name="btn_submit" value="<?php echo $btn_update; ?>" 
                                        onclick="js_SetSubmitButtonClick(this.form, this.name);">Xác nhận</button>
                                    <button class="btn btn-danger" type="button" name="btn_cancel" value="<?php echo $btn_cancel; ?>" 
                                        onclick="location.href='<?php echo $link_cancel; ?>'">Quay về</button>
                                </div>
                            </div>
                            
                            <input name="hidden_nid" type="hidden" value="<?php echo $nid; ?>" />
                            <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
                            <input name="hidden_image_old" type="hidden" value="<?php echo $txt_cimage; ?>" />
                            <input type="hidden" name="hidden_button" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-latest.min.js"></script>				
<script type="text/javascript">
$(document).ready(function() {
    $('input.num_only').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

function js_SetSubmitButtonClick(obj_form, btn_name) {
    obj_form.hidden_button.value = btn_name;
    obj_form.submit();		
}

// HÀM XÓA FILE HỒ SƠ TÀI LIỆU QUA AJAX
function js_DeleteProductDocument(doc_id, type_key) {
    if (!doc_id || doc_id == 0) {
        alert('Tệp này chưa tồn tại hoặc đã bị xóa!');
        return false;
    }

    if (confirm('CẢNH BÁO: Bạn có chắc chắn muốn XÓA VĨNH VIỄN tệp tài liệu này khỏi hệ thống không?')) {
        $.ajax({
            url: '<?php echo base_url(); ?>index.php/do_product/ajax_delete_document',
            type: 'POST',
            data: { doc_id: doc_id },
            dataType: 'json',
            success: function(res) {
                if (res.status === 'success') {
                    alert(res.message);
                    // Ẩn dòng tệp hiển thị ngay lập tức không cần F5
                    $('.js-doc-row-' + type_key).slideUp(200);
                } else {
                    alert(res.message);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra trong quá trình xử lý, vui lòng thử lại!');
            }
        });
    }
}
</script>