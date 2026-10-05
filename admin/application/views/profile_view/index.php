<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <?php if (!empty($m_message)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle"></i> <?php echo $m_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($m_error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle"></i> <?php echo $m_error; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- CỘT BÊN TRÁI: CẬP NHẬT THÔNG TIN CÁ NHÂN -->
            <div class="col-md-8 col-sm-12">
                <div class="x_panel" style="border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                    <div class="x_title">
                        <h2><i class="fa fa-user text-primary"></i> Chi tiết thông tin tài khoản</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="post" action="<?php echo base_url(); ?>index.php/do_profile/update_profile" enctype="multipart/form-data">
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Tên đăng nhập</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user_info['cuserid']); ?>" readonly style="background:#f1f5f9; font-weight:600;">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Họ và tên <span class="text-danger">*</span></label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_cfullname" class="form-control" value="<?php echo htmlspecialchars($user_info['cfullname']); ?>" required>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Email liên hệ</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="email" name="txt_cemail" class="form-control" value="<?php echo htmlspecialchars($user_info['cemail']); ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Số điện thoại</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_chandphone" class="form-control" value="<?php echo htmlspecialchars($user_info['chandphone']); ?>">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">ID Chat Telegram</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="text" name="txt_ctelegram_chat_id" class="form-control" value="<?php echo htmlspecialchars($user_info['ctelegram_chat_id']); ?>" placeholder="Dùng để nhận thông báo công việc">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Giới tính</label>
                                <div class="col-md-8 col-sm-8">
                                    <select name="cbo_cgender" class="form-control">
                                        <option value="male" <?php if($user_info['cgender'] == 'male') echo 'selected'; ?>>Nam</option>
                                        <option value="female" <?php if($user_info['cgender'] == 'female') echo 'selected'; ?>>Nữ</option>
                                        <option value="other" <?php if($user_info['cgender'] == 'other') echo 'selected'; ?>>Khác</option>
                                    </select>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ngày sinh</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="date" name="txt_dbirthday" class="form-control" value="<?php echo $user_info['dbirthday']; ?>">
                                </div>
                            </div>
							
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Ảnh đại diện</label>
                                <div class="col-md-8 col-sm-8">
                                    <input type="file" name="txt_cavatar" class="form-control-file">
                                    <?php if (!empty($user_info['cavatar'])): ?>
                                        <div style="margin-top: 10px;">
                                            <img src="<?php echo base_url() . '../upload/avatar/' . $user_info['cavatar']; ?>" alt="Avatar" style="width: 90px; height: 90px; object-fit: cover; border-radius: 50%; border: 2px solid #cbd5e1;">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
							
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Cập nhật thông tin</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <!-- CỘT BÊN PHẢI: ĐỔI MẬT KHẨU & THÔNG TIN HỆ THỐNG -->
            <div class="col-md-4 col-sm-12">
                <div class="x_panel" style="border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.05);">
                    <div class="x_title">
                        <h2><i class="fa fa-key text-danger"></i> Đổi mật khẩu</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form method="post" action="<?php echo base_url(); ?>index.php/do_profile/change_password">
                            
                            <div class="form-group">
                                <label>Mật khẩu hiện tại <span class="text-danger">*</span></label>
                                <input type="password" name="txt_old_password" class="form-control" required placeholder="********">
                            </div>

                            <div class="form-group">
                                <label>Mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="txt_new_password" class="form-control" required placeholder="Ít nhất 6 ký tự">
                            </div>

                            <div class="form-group">
                                <label>Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                                <input type="password" name="txt_renew_password" class="form-control" required placeholder="Nhập lại mật khẩu mới">
                            </div>

                            <div class="ln_solid"></div>
                            <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-shield"></i> Xác nhận đổi mật khẩu</button>

                        </form>
                    </div>
                </div>
				
				<?php /*
                <div class="x_panel" style="border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.05); margin-top:15px;">
                    <div class="x_title">
                        <h2><i class="fa fa-info-circle text-info"></i> Thông tin tài khoản</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><strong>Chức vụ / Vai trò:</strong> <span class="badge bg-primary"><?php echo strtoupper($user_info['crole']); ?></span></p>
                        <p><strong>Ngày tạo tài khoản:</strong> <?php echo date('d/m/Y H:i', strtotime($user_info['ddate_created'])); ?></p>
                        <p><strong>Cập nhật gần nhất:</strong> <?php echo !empty($user_info['ddate_updated']) ? date('d/m/Y H:i', strtotime($user_info['ddate_updated'])) : 'Chưa cập nhật'; ?></p>
                    </div>
                </div>
				*/ ?>
            </div>

        </div>
    </div>
</div>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>