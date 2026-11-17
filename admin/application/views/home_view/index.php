<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?> 
<style type="text/css">
.dash-icon-box {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
}
.dash-icon-box i {
    color: #ffffff;
    font-size: 22px;
}
.order-box {
    border-radius: 8px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.order-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0,0,0,0.08);
}
.order-box p { margin: 0; }
.dash-title-text {
    font-size: 15px;
    margin: 0 0 3px 0;
    white-space: nowrap; /* Giữ tiêu đề trên 1 dòng không bị rớt chữ */
}
</style>

<!-- 8 mã màu phù hợp #E3F6FF #ebf3ff #f2f0ff #e3faf5 #fff6e6 #FFE5F1 #E0F4FF #EDF6E5 -->
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					
					<div class="row">
						<div class="col-md-12 col-sm-12 pd0">
							<div class="x_panel">
								
								<div class="container">
									<!-- MỞ RỘNG RỘNG TỐI ĐA 980PX DỄ THỞ HƠN -->
									<div class="d-flex align-items-center justify-content-center" style="width:100%; max-width:980px; margin:0 auto; height:calc(100vh - 130px);">
									<div class="row d-flex align-items-center justify-content-center h100" style="width:100%;">
								
										<?php $role = get_current_staff_role(); ?>


										<!-- 1. CẤU HÌNH WEBSITE: CHỈ ADMIN -->
										<?php if (has_staff_role('admin')): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #E3F6FF;" onclick='location.href="<?php echo base_url(); ?>index.php/do_config_listview"'>
												<div class="d-flex align-items-center">
													<div class="dash-icon-box" style="background:#0284c7;"><i class="fa fa-cogs"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#0369a1;"><strong>CẤU HÌNH WEBSITE</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Cài đặt số điện thoại, email liên hệ, thông tin chung...</p>
													</div>	
												</div>	
											</div>
										</div>
										<?php endif; ?>

										<!-- 2. QUẢN LÝ NHÂN VIÊN: CHỈ ADMIN -->
										<?php if (has_staff_role('admin')): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #ebf3ff;" onclick='location.href="<?php echo base_url(); ?>index.php/do_staff_listview"'>
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#2563eb;"><i class="fa fa-user"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#1d4ed8;"><strong>QUẢN LÝ NHÂN VIÊN</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Quản lý nhân viên và phân quyền công việc</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 3. QUẢN LÝ KHÁCH HÀNG: CHỈ ADMIN -->
										<?php if (has_staff_role('admin')): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #fDF2F8;" onclick='location.href="<?php echo base_url(); ?>index.php/do_member_listview"'>
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#d946ef;"><i class="fa fa-users"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#a21caf;"><strong>QUẢN LÝ KHÁCH HÀNG</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Quản lý danh sách tài khoản thành viên</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 4. THƯ VIỆN ẢNH GALLERY: ADMIN + CONTENT_MGR -->
										<?php if (check_staff_permission(array('admin', 'content_mgr'))): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #ECFDF5;" onclick='location.href="<?php echo base_url(); ?>index.php/do_gallery_listview"'>
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#059669;"><i class="fa fa-camera"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#047857;"><strong>THƯ VIỆN ẢNH</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Quản lý bộ sưu tập album ảnh</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 5. QUẢN LÝ TIN ĐĂNG / SẢN PHẨM: ADMIN + PRODUCT_MGR -->
										<?php if (check_staff_permission(array('admin', 'product_mgr'))): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #fff6e6;" onclick='location.href="<?php echo base_url(); ?>index.php/do_product_listview"'>
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#ea580c;"><i class="fa fa-sitemap"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#c2410c;"><strong>QUẢN LÝ TIN ĐĂNG BĐS</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Duyệt đăng tin và kiểm soát các bài đăng</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 6. THẨM ĐỊNH & PHÊ DUYỆT HỒ SƠ: ADMIN + DOC_REVIEWER -->
										<?php if (check_staff_permission(array('admin', 'doc_reviewer'))): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #fef9c3;" onclick="location.href='<?php echo base_url(); ?>index.php/do_dept_review_listview'">
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#ca8a04;"><i class="fa fa-file-text-o"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#a16207;"><strong>THẨM ĐỊNH HỒ SƠ</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Cổng tiếp nhận và thẩm định hồ sơ theo phòng ban</p>
													</div>
												</div>					
											</div>
										</div>

										<!-- 6.1. XEM HỒ SƠ (CHỈ XEM): ADMIN + DOC_REVIEWER -->
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #FEF9C3;" onclick="location.href='<?php echo base_url(); ?>index.php/do_dept_view_listview'">
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#ca8a04;"><i class="fa fa-file-text-o"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#a16207;"><strong>XEM HỒ SƠ</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Cổng tiếp nhận và theo dõi hồ sơ chỉ xem theo phòng ban</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 7. QUẢN LÝ TICKET: ADMIN + TICKET_MGR -->
										<?php if (check_staff_permission(array('admin', 'ticket_mgr'))): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #ffe4cc;" onclick="location.href='<?php echo base_url(); ?>index.php/do_ticket_listview'">
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#f97316;"><i class="fa fa-ticket"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#c2410c;"><strong>QUẢN LÝ TICKET HỖ TRỢ</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Tiếp nhận & phản hồi Ticket hỗ trợ từ khách hàng</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 8. HỆ THỐNG EMAIL & BẢN TIN: ADMIN + MAIL_MGR -->
										<?php if (check_staff_permission(array('admin', 'mail_mgr'))): ?>
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #f0f7ff;" onclick="location.href='<?php echo base_url(); ?>index.php/do_newsletter'">
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#2563eb;"><i class="fa fa-envelope-o"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#1d4ed8;"><strong>HỆ THỐNG EMAIL & BẢN TIN</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Quản lý dữ liệu đăng ký và gửi email marketing</p>
													</div>
												</div>					
											</div>
										</div>
										<?php endif; ?>

										<!-- 9. QUẢN LÝ FILE / MẪU BIỂU: TẤT CẢ VAI TRÒ DÙNG ĐƯỢC -->
										<div class="col-md-6">
											<div class="order-box" style="padding:18px 20px; background: #FEF3C7;" onclick='location.href="<?php echo base_url(); ?>index.php/do_file_listview"'>
												<div class="d-flex align-items-center">	
													<div class="dash-icon-box" style="background:#d97706;"><i class="fa fa-file-text-o"></i></div>
													<div style="flex:1; min-width:0;">
														<h5 class="dash-title-text" style="color:#b45309;"><strong>QUẢN LÝ FILE / MẪU BIỂU</strong></h5>
														<p class="mg0" style="font-size:13px; color:#475569;">Quản lý và cập nhật tài liệu biểu mẫu tòa nhà</p>
													</div>
												</div>					
											</div>
										</div>

									</div>	
								  </div>
							</div>
							</div>
						</div>
					</div>

					
				</div>
			</div>
			<!-- /page content --> 
	
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>