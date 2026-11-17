<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?> 
<style>
.order-box {border-radius:10px;margin-bottom:15px;cursor:pointer;}
.order-box:hover {box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;}
.order-box p {margin:0;}
</style>

<!-- 8 mã màu phù hợp #E3F6FF #ebf3ff #f2f0ff #e3faf5 #fff6e6 #FFE5F1 #E0F4FF #EDF6E5 -->
<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					
					<div class="row">
						<div class="col-md-12 col-sm-12 pd0">
							<div class="x_panel">
								
								<div class="container">
									<div class="d-flex align-items-center justify-content-center" style="width:900px;margin:0 auto;height:calc(100vh - 130px);">
									<div class="row d-flex align-items-center justify-content-center h100">
								
										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #E3F6FF;" onclick='location.href="<?php echo base_url(); ?>index.php/do_config_listview"'>
												<div class="d-flex">
													<div><img src="<?php echo base_url(); ?>images/config.webp" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5><strong>CẤU HÌNH WEBSITE</strong></h5>
														<p class="mg0">Cài đặt số điện thoại, email liên hệ, các liên kết...</p>
													</div>	
												</div>	
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #ebf3ff;" onclick='location.href="<?php echo base_url(); ?>index.php/do_staff_listview"'>
												<div class="d-flex">	
													<div><img src="<?php echo base_url(); ?>images/user_config.png" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5><strong>QUẢN LÝ NHÂN VIÊN</strong></h5>
														<p class="mg0">Quản lý nhân viên và phân quyền công việc</p>
													</div>
												</div>					
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #f2f0ff;" onclick='location.href="<?php echo base_url(); ?>index.php/do_module_listview"'>
												<div class="d-flex">	
													<div><img src="<?php echo base_url(); ?>images/module.webp" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5><strong>QUẢN LÝ MODULE</strong></h5>
														<p class="mg0">Cập nhật nội dung các thành phần của Website</p>
													</div>
												</div>					
											</div>
										</div>

										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #FFE5F1;" onclick='location.href="<?php echo base_url(); ?>index.php/do_banner_images_listview"'>
												<div class="d-flex">	
													<div><img src="<?php echo base_url(); ?>images/slide.webp" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5><strong>QUẢN LÝ SLIDE</strong></h5>
														<p class="mg0">Cập nhật các banner mới cho Website</p>
													</div>
												</div>					
											</div>
										</div>
										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #fff6e6;" onclick='location.href="<?php echo base_url(); ?>index.php/do_product_listview"'>
												<div class="d-flex">	
													<div><img src="<?php echo base_url(); ?>images/edit.png" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5 style="color:#f26522"><strong>QUẢN LÝ TIN ĐĂNG</strong></h5>
														<p class="mg0">Cập nhật xem xét duyệt bài đăng từ các thành viên</p>
													</div>
												</div>					
											</div>
										</div>
										<div class="col-md-6">
											<div class="order-box" style="padding:20px;background: #EDF6E5;" onclick='location.href="<?php echo base_url(); ?>index.php/do_news_listview"'>
												<div class="d-flex">	
													<div><img src="<?php echo base_url(); ?>images/news.webp" style="width:50px;object-fit: contain;margin-right: 10px;border-radius:5px;" /></div>
													<div>
														<h5><strong>QUẢN LÝ TIN TỨC</strong></h5>
														<p class="mg0">Cập nhật tin tức mới lên Website</p>
													</div>
												</div>					
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="order-box" style="padding:20px; background: #ffe4cc; cursor: pointer; border: 1px solid #ffe4cc; border-radius: 5px;" onclick="location.href='<?php echo base_url(); ?>index.php/do_ticket_listview'">
												<div class="d-flex">	
													<div>
														<img src="<?php echo base_url(); ?>images/product.webp" style="width:50px; height:50px; object-fit: contain; margin-right: 15px; border-radius:5px;" />
													</div>
													<div>
														<h5 style="color:#f26522; margin-top: 2px; margin-bottom: 5px;"><strong>QUẢN LÝ TICKET</strong></h5>
														<p class="mg0" style="color: #64748b; font-size: 13px;">Tiếp nhận và phản hồi các yêu cầu hỗ trợ từ khách hàng</p>
													</div>
												</div>					
											</div>
										</div>

										<div class="col-md-6">
											<div class="order-box" style="padding:20px; background: #f0f7ff; cursor: pointer; border: 1px solid #d0e7ff; border-radius: 5px;" onclick="location.href='<?php echo base_url(); ?>index.php/do_newsletter'">
												<div class="d-flex">	
													<div>
														<img src="<?php echo base_url(); ?>images/mail.png" style="width:50px; height:50px; object-fit: contain; margin-right: 15px; border-radius:5px;" />
													</div>
													<div>
														<h5 style="color:#1e40af; margin-top: 2px; margin-bottom: 5px;"><strong>HỆ THỐNG EMAIL & BẢN TIN</strong></h5>
														<p class="mg0" style="color: #64748b; font-size: 13px;">Quản lý dữ liệu đăng ký và gửi email marketing hàng loạt</p>
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