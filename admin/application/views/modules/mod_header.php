<div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;    margin-bottom: 10px;">
			  <a href="<?php echo base_url(); ?>index.php/do_home" class="site_title"><img src="<?php $fr_img = Fstr_replace('admin/', '', base_url()); $cf = get_config_by_id(8); echo $fr_img.'upload/fb/'.$cf['cimage']; ?>" style="height: 30px;margin-right: 5px;"> <span>CMS</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php 
					$user_avatar = Fget_userdata('session_avatar');
					$fr_img      = Fstr_replace(Fget_admin_folder(), '', base_url()); // Lấy URL gốc ngoài frontend
					$avatar_url  = base_url() . 'images/user.jpg'; // Ảnh mặc định trong admin

					// FCPATH là đường dẫn tuyệt đối đến thư mục root (pico-saigon/admin/)
					// FCPATH . '../upload/avatar/' sẽ trỏ đúng ra pico-saigon/upload/avatar/
					if (!empty($user_avatar) && file_exists(FCPATH . '../upload/avatar/' . $user_avatar)) {
						$avatar_url = $fr_img . 'upload/avatar/' . $user_avatar;
					}
				?>
				<img src="<?php echo $avatar_url; ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo Fget_userdata('session_user_full_name'); ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <?php $role = get_current_staff_role(); ?>

				<ul class="nav side-menu">
					<!-- Trang chủ & Hướng dẫn: Tất cả các quyền đều thấy -->
					<li><a href="<?php echo base_url(); ?>index.php/do_home"><i class="fa fa-home"></i> Trang Chủ </a></li>

					<!-- 1. CẤU HÌNH HỆ THỐNG: CHỈ QUẢN TRỊ VIÊN (ADMIN) -->
					<?php if (has_staff_role('admin')): ?>
					<li>
						<a><i class="fa fa-cogs"></i> Thiết Lập Hệ Thống <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url(); ?>index.php/do_config_listview">Cấu Hình Website </a></li>
							<li><a href="<?php echo base_url(); ?>index.php/do_menu_listview">Quản Lý Menu </a></li>
							<li><a href="<?php echo base_url(); ?>index.php/do_department_listview">Quản Lý Phòng Ban</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/do_staff_listview">Quản Lý Nhân Viên</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/do_task_management_listview">Hệ thống nhắc việc</a></li>
						</ul>
					</li>
					<?php endif; ?>

					<!-- 2. QUẢN TRỊ NỘI DUNG: ADMIN + CONTENT_MGR -->
					<?php if (check_staff_permission(array('admin', 'content_mgr'))): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_module_listview"><i class="fa fa-puzzle-piece"></i> Quản Lý Module </a></li>
						<li><a href="<?php echo base_url(); ?>index.php/do_banner_images_listview"><i class="fa fa-picture-o"></i> Quản Lý Slide </a></li>
						<li><a href="<?php echo base_url(); ?>index.php/do_article_listview"><i class="fa fa-pencil-square-o"></i> Quản Lý Bài Viết </a></li>
						<li><a href="<?php echo base_url(); ?>index.php/do_gallery_listview"><i class="fa fa-picture-o"></i> Thư viện ảnh </a></li>
						<li>
						<a><i class="fa fa-newspaper-o"></i> Quản Lý Tin Tức <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url(); ?>index.php/do_cat_news_listview">Nhóm</a></li>			
							<li><a href="<?php echo base_url(); ?>index.php/do_news_listview">Tin Tức</a></li>
						</ul>
					</li>
					<?php endif; ?>

					<!-- 3. QUẢN LÝ TIN ĐĂNG / SẢN PHẨM: ADMIN + PRODUCT_MGR -->
					<?php if (check_staff_permission(array('admin', 'product_mgr'))): ?>
					<li>
						<a><i class="fa fa-sitemap"></i> Quản Lý Tin Đăng <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url(); ?>index.php/do_cat_product_listview">Nhóm</a></li>			
							<li><a href="<?php echo base_url(); ?>index.php/do_product_listview">Bài Đăng</a></li>
						</ul>
					</li>
					<?php endif; ?>
	
					<!-- 4. QUẢN LÝ KHÁCH HÀNG: ADMIN -->
					<?php if (has_staff_role('admin')): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_member_listview"><i class="fa fa-users"></i> Quản Lý Khách Hàng </a></li>
					<?php endif; ?>

					<!-- 5. QUẢN LÝ TICKET: ADMIN + TICKET_MGR -->
					<?php if (check_staff_permission(array('admin', 'ticket_mgr'))): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_ticket_listview"><i class="fa fa-ticket"></i> Quản Lý Ticket </a></li>
					<?php endif; ?>

					<!-- 5.1. QUẢN LÝ HỒ SƠ & THẨM ĐỊNH ĐA PHÒNG BAN: ADMIN + DOC_REVIEWER -->
					<?php if (check_staff_permission(array('admin', 'doc_reviewer'))): ?>
					<li>
						<a><i class="fa fa-file-text-o"></i> Thẩm Định & Phê Duyệt <span class="fa fa-chevron-down"></span></a>
						<ul class="nav child_menu">
							<li><a href="<?php echo base_url(); ?>index.php/do_dept_review_listview">Cổng Thẩm Định Phòng Ban</a></li>
							<?php if (has_staff_role('admin')): ?>
								<li><a href="<?php echo base_url(); ?>index.php/do_doc_submission_listview">Quản Trị Phê Duyệt Hồ Sơ</a></li>
								<li><a href="<?php echo base_url(); ?>index.php/do_doc_type_listview">Cấu Hình Loại Hồ Sơ & Biểu Mẫu</a></li>
							<?php endif; ?>
						</ul>
					</li>
					<?php endif; ?>

					<!-- 6. QUẢN LÝ MAIL: ADMIN + MAIL_MGR -->
					<?php if (check_staff_permission(array('admin', 'mail_mgr'))): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_newsletter"><i class="fa fa-envelope-o"></i> Hệ Thống Email & Bản Tin </a></li>
					<?php endif; ?>

					<!-- Công việc & Hướng dẫn: Tất cả các quyền đều dùng được -->
					<li><a href="<?php echo base_url(); ?>index.php/do_file_listview"><i class="fa fa-file"></i> File / Mẫu Biểu / Nội Quy </a></li>
					<li><a href="<?php echo base_url(); ?>index.php/do_task"><i class="fa fa-tasks"></i> Công Việc Của Tôi </a></li>
					<?php if (check_staff_permission(array('admin', 'doc_reviewer'))): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_dept_view_listview"><i class="fa fa-eye"></i> Xem Hồ Sơ </a></li>
					<?php endif; ?>
					<?php if (has_staff_role('admin')): ?>
						<li><a href="<?php echo base_url(); ?>index.php/do_guide"><i class="fa fa-book"></i> Hướng Dẫn Sử Dụng </a></li>
					<?php endif; ?>
				</ul>
              </div>             
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url().'index.php/do_logout'?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
					<img src="<?php echo $avatar_url; ?>">
					<?php echo Fget_userdata('session_user_full_name'); ?>
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="<?php echo base_url().'index.php/do_profile'?>"> Hồ sơ</a>
                    <a class="dropdown-item"  href="<?php echo base_url().'index.php/do_logout'?>"><i class="fa fa-sign-out pull-right"></i> Đăng xuất</a>
                  </div>
                </li>
			  </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->