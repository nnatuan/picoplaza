<?php 
	$this->load->view('header');
	//$this->load->view('header_end');
	//$this->load->view('modules/mod_header'); 
	//$cf_logo = get_config_by_id(12);
?>

<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?php echo $link_page; ?>" method="post" name="form_main">
              <h1>CMS</h1>
              <div>
                <input type="text" name="txt_user_name" class="form-control" placeholder="ID tài khoản" required="" />
              </div>
              <div>
                <input type="password" name="txt_password" class="form-control" placeholder="Mật khẩu" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-rounded btn-danger submit" name="btn_login" onclick="js_SetSubmitButtonClick(this.form, this.name);" value="<?php echo $btn_login ?>">Đăng nhập</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                
                <div class="clearfix"></div>
                <br />

                <div>
				  <img src="<?php $fr_img = Fstr_replace('admin/', '', base_url()); $cf = get_config_by_id(8); echo $fr_img.'upload/fb/'.$cf['cimage']; ?>" alt="" style="height: 50px;margin-bottom: 10px;">
                  <p>Hệ thống quản trị nội dung Website</p>
                </div>
              </div>
			  <input type="hidden" name="hidden_button"  value = "" />
            </form>
          </section>
        </div>

      </div>
    </div>
<script src="<?php echo base_url(); ?>js/js.js"></script>	
<?php	
	//$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>
