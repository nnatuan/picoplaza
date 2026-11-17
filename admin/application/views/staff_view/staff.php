<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel qcare-form-panel">
                    <div class="x_title">
                        <h2><i class="fa fa-user"></i> <?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />

                        <form name="form_main" method="post" action="<?php echo $link_page; ?>" class="form-horizontal form-label-left">
                            
                            <h5 class="qcare-form-section-title section-blue">I. THÔNG TIN QUẢN TRỊ TÀI KHOẢN</h5>
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Tên đăng nhập <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_cuserid" value="<?php echo $txt_cuserid; ?>" required="required" class="form-control" <?php echo ($event == 'edit') ? 'readonly style="background:#eee;"' : ''; ?> placeholder="Ví dụ: staff01" oninput="this.value = this.value.toLowerCase().replace(/[^a-z0-9_]/g, '');">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Mật khẩu truy cập <?php echo ($event == 'add') ? '<span class="required">*</span>' : ''; ?></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="password" name="txt_cpassword" class="form-control" placeholder="<?php echo ($event == 'edit') ? 'Bỏ trống nếu giữ nguyên mật khẩu cũ' : 'Nhập mật khẩu truy cập'; ?>" <?php echo ($event == 'add') ? 'required="required"' : ''; ?>>
                                </div>
                            </div>

                            <?php 
                                $selected_roles = !empty($arr_crole) ? (is_array($arr_crole) ? $arr_crole : explode(',', $arr_crole)) : (!empty($cbof_crole) ? explode(',', $cbof_crole) : array());
                                $is_doc_reviewer = in_array('doc_reviewer', $selected_roles);
                            ?>
                            <div class="item form-group">
								<label class="col-form-label col-md-2 col-sm-2 label-align">Phân quyền vai trò <span class="required">*</span></label>
								<div class="col-md-8 col-sm-8">
									<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:15px; margin-bottom:5px;">
                                        <p style="margin-bottom:10px; font-weight:600; color:#334155; font-size:13px;">
                                            <i class="fa fa-shield text-primary"></i> Tích chọn một hoặc nhiều vai trò phân quyền cho tài khoản nhân viên (có thể kết hợp nhiều quyền):
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="admin" id="role_admin" <?php echo in_array('admin', $selected_roles) ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong class="text-danger"><i class="fa fa-star"></i> Quản trị viên</strong> <span class="text-muted" style="font-size:12px;">(Toàn quyền hệ thống)</span></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="doc_reviewer" id="role_doc_reviewer" <?php echo $is_doc_reviewer ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong style="color:#d97706 !important;"><i class="fa fa-file-text-o"></i> Phê duyệt hồ sơ</strong> <span class="text-muted" style="font-size:12px;">(Thẩm định phòng ban)</span></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="product_mgr" id="role_product_mgr" <?php echo in_array('product_mgr', $selected_roles) ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong class="text-primary"><i class="fa fa-sitemap"></i> Quản lý Tin đăng</strong> <span class="text-muted" style="font-size:12px;">(Bài đăng & Nhóm)</span></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="content_mgr" id="role_content_mgr" <?php echo in_array('content_mgr', $selected_roles) ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong class="text-info"><i class="fa fa-pencil-square-o"></i> Quản trị Nội dung</strong> <span class="text-muted" style="font-size:12px;">(Tin tức, Slide, Module)</span></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="ticket_mgr" id="role_ticket_mgr" <?php echo in_array('ticket_mgr', $selected_roles) ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong style="color:#f97316;"><i class="fa fa-ticket"></i> Quản lý Ticket</strong> <span class="text-muted" style="font-size:12px;">(Hỗ trợ khách hàng)</span></span>
                                                </label>
                                            </div>
                                            <div class="col-md-6 col-sm-12" style="margin-bottom:8px;">
                                                <label style="cursor:pointer; font-weight:normal; display:flex; align-items:center; gap:8px; background:#fff; border:1px solid #cbd5e1; padding:8px 12px; border-radius:6px; margin-bottom:0;">
                                                    <input type="checkbox" name="arr_crole[]" value="mail_mgr" id="role_mail_mgr" <?php echo in_array('mail_mgr', $selected_roles) ? 'checked' : ''; ?> onchange="onRoleChange();" style="width:16px; height:16px; cursor:pointer;">
                                                    <span><strong class="text-success"><i class="fa fa-envelope-o"></i> Quản lý Mail</strong> <span class="text-muted" style="font-size:12px;">(Bản tin & Email Marketing)</span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
								</div>
							</div>

                            <div class="item form-group">
								<label class="col-form-label col-md-2 col-sm-2 label-align">Trạng thái khóa</label>
								<div class="col-md-8 col-sm-8">
									<select name="cbof_cstatus" class="form-control" style="max-width:300px;">
										<option value="1" <?php echo ($cbof_cstatus == '1') ? 'selected' : ''; ?>>1: Cho phép hoạt động</option>
										<option value="0" <?php echo ($cbof_cstatus == '0') ? 'selected' : ''; ?>>0: Tạm khóa tài khoản</option>
									</select>
								</div>
							</div>

                            <!-- Dòng chọn phòng ban: Tự động hiển thị khi tích chọn vai trò Chuyên viên Thẩm định Hồ sơ -->
                            <div class="item form-group" id="dept_selection_row" style="<?php echo $is_doc_reviewer ? '' : 'display:none;'; ?>">
                                <label class="col-form-label col-md-2 col-sm-2 label-align" style="color:#0284c7; font-weight:bold;">
                                    <i class="fa fa-sitemap"></i> Phòng ban trực thuộc <span class="required">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8">
                                    <select name="cbof_nid_dept" id="cbof_nid_dept" class="form-control" style="border-color:#0284c7; max-width:500px;">
                                        <option value="0">-- Chọn phòng ban phụ trách thẩm định --</option>
                                        <?php if (!empty($departments)): foreach ($departments as $dept): ?>
                                            <option value="<?php echo $dept['nid']; ?>" <?php echo ($cbof_nid_dept == $dept['nid']) ? 'selected' : ''; ?>>
                                                [<?php echo htmlspecialchars($dept['ccode']); ?>] <?php echo htmlspecialchars($dept['cname']); ?>
                                            </option>
                                        <?php endforeach; endif; ?>
                                    </select>
                                    <small class="text-muted"><i class="fa fa-info-circle"></i> Nhân viên thuộc phòng ban nào thì khi vào hệ thống chỉ nhận và thẩm định hồ sơ được giao cho phòng ban đó.</small>
                                </div>
                            </div>

                            <script type="text/javascript">
                                function onRoleChange() {
                                    var docReviewerCb = document.getElementById('role_doc_reviewer');
                                    var deptRow = document.getElementById('dept_selection_row');
                                    if (docReviewerCb && docReviewerCb.checked) {
                                        deptRow.style.display = '';
                                    } else {
                                        deptRow.style.display = 'none';
                                    }
                                }
                            </script>

                            <h5 class="qcare-form-section-title section-teal">II. THÔNG TIN HỒ SƠ LÝ LỊCH CÁ NHÂN</h5>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Họ và Tên <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_cfullname" value="<?php echo $txt_cfullname; ?>" required="required" class="form-control" placeholder="Nhập đầy đủ tên nhân viên">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Số điện thoại</label>
                                <div class="col-md-3 col-sm-3">
                                    <input type="text" name="txt_chandphone" value="<?php echo $txt_chandphone; ?>" class="form-control" placeholder="Nhập số di động" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                </div>
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Email</label>
                                <div class="col-md-3 col-sm-3">
                                    <input type="email" name="txt_cemail" value="<?php echo $txt_cemail; ?>" class="form-control" placeholder="Nhập địa chỉ email">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Giới tính</label>
                                <div class="col-md-3 col-sm-3">
                                    <select name="cbof_cgender" class="form-control">
                                        <option value="Nam" <?php echo ($cbof_cgender == 'Nam') ? 'selected' : ''; ?>>Nam</option>
                                        <option value="Nữ" <?php echo ($cbof_cgender == 'Nữ') ? 'selected' : ''; ?>>Nữ</option>
                                    </select>
                                </div>
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Ngày sinh</label>
                                <div class="col-md-3 col-sm-3">
                                    <input type="date" name="txt_dbirthday" value="<?php echo $txt_dbirthday; ?>" class="form-control">
                                </div>
                            </div>
							
							<div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Telegram Chat ID</label>
                                <div class="col-md-8 col-sm-8">
                                    <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                        <div style="width: 250px;">
                                            <input type="text" name="txt_ctelegram_chat_id" value="<?php echo $txt_ctelegram_chat_id; ?>" class="form-control" placeholder="Ví dụ: 5864192305" oninput="this.value = this.value.replace(/[^0-9\-]/g, '');">
                                        </div>
                                        <span class="text-muted" style="font-size: 12.5px; font-weight: 600;">
                                            <i class="fa fa-info-circle text-danger"></i> Dùng để gửi thông báo đếm ngược hạn xử lý công việc tự động qua Bot.
                                        </span>
                                    </div>
                                </div>
                            </div>
							
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-success qcare-form-btn" name="btn_submit" value="btn_submit" onclick="js_SetSubmitButtonClick(this.form, this.name);"><i class="fa fa-save"></i> Lưu thông tin tài khoản</button>
                                    <button class="btn btn-secondary qcare-form-btn" type="button" onclick="location.href='<?php echo $link_cancel; ?>'"><i class="fa fa-chevron-left"></i> Quay về</button>
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