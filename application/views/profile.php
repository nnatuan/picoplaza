<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
  .profile-wrapper { background-color: #f8fafc; padding: 40px 0; min-height: calc(100vh - 300px); }
  .profile-grid { display: grid; grid-template-columns: 280px 1fr; gap: 30px; max-width: 1180px; margin: 0 auto; padding: 0 32px; }
  @media (max-width: 850px) { .profile-grid { grid-template-columns: 1fr; } }
  
  /* Thẻ hiển thị avatar bên trái */
  .profile-sidebar { background: var(--card); border: 1px solid var(--line); border-radius: 6px; padding: 30px 20px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.02); height: fit-content; }
  .avatar-preview-box { width: 120px; height: 120px; border-radius: 50%; background: var(--paper-3); margin: 0 auto 16px auto; display: flex; align-items: center; justify-content: center; font-size: 44px; color: var(--mist); overflow: hidden; border: 2px solid var(--line); position: relative; }
  .avatar-preview-box img { width: 100%; height: 100%; object-fit: cover; }
  .profile-sidebar h3 { font-size: 18px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
  .profile-sidebar p { font-size: 13px; color: var(--text-soft); }
  
  /* Khối Form thông tin bên phải */
  .profile-content { background: var(--card); border: 1px solid var(--line); border-top: 3px solid var(--brick); border-radius: 4px; padding: 35px; box-shadow: 0 15px 35px rgba(0,0,0,0.02); }
  .profile-content h2 { font-size: 22px; font-weight: 700; margin-bottom: 6px; display: flex; align-items: center; gap: 8px; }
  .profile-content h2 i { color: var(--brick); font-size: 18px; }
  .profile-content .lede { font-size: 13.5px; color: var(--text-soft); margin-bottom: 25px; padding-bottom: 12px; border-bottom: 1px dashed var(--line); }
  
  .form-group { margin-bottom: 20px; }
  .form-group label { display: block; font-size: 13.5px; font-weight: 700; margin-bottom: 8px; color: var(--text); }
  .form-group input[type=text], .form-group input[type=email], .form-group input[type=password] { width: 100%; border: 1px solid var(--line); border-radius: 2px; padding: 12px 14px; font-family: 'Manrope', sans-serif; font-size: 14px; color: var(--text); background: var(--card); }
  .form-group input:focus { outline: none; border-color: var(--brick); }
  .form-group input[readonly] { background-color: var(--paper-3); cursor: not-allowed; color: var(--text-soft); }
  
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  @media (max-width: 580px) { .form-row { grid-template-columns: 1fr; gap: 0; } }
  
  /* Hệ thống nhãn thông báo */
  .alert-box { padding: 12px 16px; border-radius: 4px; font-size: 14px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
  .alert-box.error { background: #fff1f2; border: 1px solid #ffe4e6; color: #b91c1c; }
  .alert-box.success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; }
  
  .btn-submit-profile { background: var(--brick); color: #ffffff; border: none; padding: 12px 26px; font-weight: 700; font-size: 14.5px; border-radius: 2px; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background .15s; }
  .btn-submit-profile:hover { background: #984a2c; }
</style>

<div class="profile-wrapper">
    <div class="profile-grid">
        
        <aside class="profile-sidebar">
            <div class="avatar-preview-box">
                <?php if(!empty($member['cavatar'])): ?>
                    <img src="<?php echo base_url(); ?>upload/avatar/<?php echo $member['cavatar']; ?>" alt="Avatar">
                <?php else: ?>
                    <i class="fa-solid fa-user-gear"></i>
                <?php endif; ?>
            </div>
            <h3><?php echo htmlspecialchars($member['cfullname']); ?></h3>
            <p>@<?php echo htmlspecialchars($member['cusername']); ?></p>
            <p style="margin-top: 10px; font-size: 12px; color: var(--mist);">
                <i class="fa-solid fa-calendar-days"></i> Tham gia: <?php echo date('d/m/Y', strtotime($member['dcreated_at'])); ?>
            </p>

            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--line); text-align: left;">
                <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                    <li>
                        <a href="<?php echo base_url(); ?>profile" style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; background: #ea580c; color: #fff; font-weight: 700; text-decoration: none; font-size: 13.5px;">
                            <i class="fa-regular fa-id-card"></i> Trang cá nhân
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>doc_portal" style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: #475569; font-weight: 600; text-decoration: none; font-size: 13.5px; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#ea580c';" onmouseout="this.style.background='transparent'; this.style.color='#475569';">
                            <i class="fa-solid fa-folder-tree"></i> Hồ sơ thẩm định
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>my_tickets" style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: #475569; font-weight: 600; text-decoration: none; font-size: 13.5px; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'; this.style.color='#ea580c';" onmouseout="this.style.background='transparent'; this.style.color='#475569';">
                            <i class="fa-solid fa-ticket"></i> Ticket của tôi
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>auth/logout" style="display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 8px; color: #dc2626; font-weight: 600; text-decoration: none; font-size: 13.5px; transition: all 0.2s;" onmouseover="this.style.background='#fee2e2';" onmouseout="this.style.background='transparent';">
                            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <main class="profile-content">
            <h2><i class="fa-solid fa-id-card"></i> Quản lý thông tin tài khoản</h2>
            <p class="lede">Cập nhật thông tin cá nhân chính xác để tăng uy tín khi đăng tin mua bán bất động sản.</p>

            <?php if(!empty($m_error)): ?>
                <div class="alert-box error"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $m_error; ?></div>
            <?php endif; ?>
            <?php if(!empty($m_success)): ?>
                <div class="alert-box success"><i class="fa-solid fa-circle-check"></i> <?php echo $m_success; ?></div>
            <?php endif; ?>

            <form name="frm_profile" method="POST" action="" enctype="multipart/form-data">
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Tên tài khoản đăng nhập (Không thể sửa) <span style="color:var(--brick);">*</span></label>
                        <input type="text" value="<?php echo htmlspecialchars($member['cusername']); ?>" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ Email đăng nhập (Không thể sửa) <span style="color:var(--brick);">*</span></label>
                        <input type="email" value="<?php echo htmlspecialchars($member['cemail']); ?>" readonly="readonly">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="txt_cfullname">Họ và tên thành viên <span style="color:var(--brick);">*</span></label>
                        <input type="text" id="txt_cfullname" name="txt_cfullname" value="<?php echo htmlspecialchars($member['cfullname']); ?>" placeholder="Nhập họ và tên đầy đủ...">
                    </div>
                    <div class="form-group">
                        <label for="txt_cphone">Số điện thoại liên hệ</label>
                        <input type="text" id="txt_cphone" name="txt_cphone" value="<?php echo htmlspecialchars($member['cphone']); ?>" placeholder="Ví dụ: 0931111111">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="file_cavatar">Thay đổi hình ảnh đại diện</label>
                        <input type="file" id="file_cavatar" name="file_cavatar" accept="image/*">
                        <span style="font-size: 12px; color: var(--text-soft); margin-top: 4px; display: block;">* Định dạng: JPG, PNG (Dưới 2MB).</span>
                    </div>
                    <div class="form-group">
                        <label for="txt_cpassword">Mật khẩu mới (Để trống nếu giữ nguyên)</label>
                        <input type="password" id="txt_cpassword" name="txt_cpassword" placeholder="Nhập mật khẩu mới từ 6 ký tự...">
                    </div>
                </div>

                <div style="margin-top: 25px; padding-top: 20px; border-top: 1px solid var(--line);">
                    <button type="submit" class="btn-submit-profile">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi hồ sơ
                    </button>
                </div>

                <input type="hidden" name="hidden_action" value="update_profile">
            </form>
        </main>

    </div>
</div>
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>