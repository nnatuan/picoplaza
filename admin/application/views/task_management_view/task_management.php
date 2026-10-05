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
                        <?php if(!empty($m_message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $m_message; ?>
                            </div>
                        <?php endif; ?>

                        <form name='form_main' method="post" action="<?php echo $link_page; ?>">
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Tiêu đề công việc <span class="text-danger">*</span></strong></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_ctitle" value="<?php echo htmlspecialchars($txt_ctitle); ?>" class="form-control" placeholder="Ví dụ: Phản hồi Ticket hỗ trợ, Đối soát hồ sơ pháp lý căn hộ..." required="required">
                                </div>	
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Nhân sự phụ trách <span class="text-danger">*</span></strong></label>
                                <div class="col-md-4 col-sm-4 ">
                                    <select name="cbo_nid_assignee" class="form-control" required="required">
                                        <option value="0">-- Chọn nhân viên xử lý --</option>
                                        <?php foreach($staffs as $s): ?>
                                            <option value="<?php echo $s['nid']; ?>" <?php if($s['nid'] == $cbo_nid_assignee) echo 'selected="selected"'; ?>>
                                                <?php echo htmlspecialchars($s['cfullname']); ?> (<?php echo $s['cuserid']; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>	
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Hạn hoàn thành <span class="text-danger">*</span></strong></label>
                                <div class="col-md-10 col-sm-3 " style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <div style="width: 260px;"><input type="datetime-local" name="txt_ddue_date" value="<?php echo $txt_ddue_date; ?>" class="form-control" required="required"></div>
									
									<span class="text-muted">
                                        <strong style="color:#2c3e50;">SA</strong> = Sáng/Đêm (AM) | <strong style="color:#2c3e50;">CH</strong> = Chiều/Tối (PM).
                                    </span>
                                </div>	
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Mô tả nội dung chi tiết</strong></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <textarea class="form-control" name="txt_cdescription" rows="4" placeholder="Ghi chú chi tiết yêu cầu công việc cụ thể để nhân viên nắm bắt tiến độ nhanh nhất..."><?php echo htmlspecialchars($txt_cdescription); ?></textarea>
                                </div>	
                            </div>
							
							<?php /*
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Trạng thái tiến độ</strong></label>
                                <div class="col-md-4 col-sm-4 ">
                                    <?php echo $gen_cbo_status; ?>
                                </div>	
                            </div>
							*/ ?>
							
                            <div class="ln_solid" style="margin: 25px 0;"></div>
                            
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-primary" name="btn_submit" value="Lưu dữ liệu" 
                                        onclick="js_SetSubmitButtonClick(this.form, this.name);">Lưu công việc</button>
                                    <button class="btn btn-danger" type="button" name="btn_cancel" value="Hủy" 
                                        onclick="location.href='<?php echo $link_cancel; ?>'">Quay về danh sách</button>
                                </div>
                            </div>

                            <input name="hidden_nid" type="hidden" value="<?php echo $nid; ?>" />
                            <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
                            <input type="hidden" name="hidden_button" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>