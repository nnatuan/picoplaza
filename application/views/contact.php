<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');		
?>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125389.17219063547!2d107.71195628715694!3d10.856263540914332!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317433a4e8fbd4e3%3A0xd2e6871790f35906!2zVMOibiBM4bqtcCwgQsOsbmggVGh14bqtbiwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1776136251131!5m2!1svi!2s" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<div class="wrap-main">
         <div class="wrap-form-page">
            <div class="wrap-content">
               <div class="row align-items-center">
                  <div class="col-md-6">
                     <div class="content-right content-form">
                        <h3 data-aos="fade-right" data-aos-delay="50" data-aos-duration="800">Đăng ký ngay để nhận ưu đãi học phí</h3>
                        <p data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">Bạn muốn tự tin cầm lái, làm chủ tay lái trên mọi cung đường? Hãy tham gia ngay khóa học lái xe tại Hoàng Thịnh</p>
                     </div>
                     <div class="info-company">
                        <div class="list-info" data-aos="fade-right" data-aos-delay="150" data-aos-duration="800">
                           <label>Số điện thoại</label>
                           <p><?php echo get_value_by_config(12); ?> - <?php echo get_value_by_config(14); ?></p>
                        </div>
                        <div class="list-info" data-aos="fade-right" data-aos-delay="200" data-aos-duration="800">
                           <label>Email</label>
                           <p><?php echo get_value_by_config(1); ?></p>
                        </div>
                        <div class="list-info" data-aos="fade-right" data-aos-delay="250" data-aos-duration="800">
                           <label>Địa chỉ</label>
                           <p><?php echo get_value_by_config(20); ?></p>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="group-form" data-aos="fade-up" data-aos-duration="800">
                        <h3>Đăng ký học ngay !</h3>
                        <form class="form-newsletters validation-newsletters" method="post" action="" enctype="multipart/form-data">
                           <div class="row">
                              <div class="input-newsletters col-sm-6">
                                 <label>Họ và tên</label>
                                 <input type="text" class="form-control" id="ten" name="cname" placeholder="Nguyễn Văn A" required />
                              </div>
                              <div class="input-newsletters col-sm-6">
                                 <label>Số điện thoại</label>
                                 <input type="text" class="form-control" id="dienthoai" name="cphone" placeholder="0123 456 789" required />
                              </div>
                           </div>
                           <div class="row">
                              <div class="input-newsletters col-sm-6">
                                 <label>Email</label>
                                 <input type="email" class="form-control" id="email" name="cemail" placeholder="@gmail.com" required />
                              </div>
                              <div class="input-newsletters col-sm-6">
                                 <label>Chọn khóa học</label>
                                 <select class="form-control" id="hangxe" name="changxe" required >
                                    <option value="">Hạng xe</option>
                                    <option value="Hạng C">Hạng C</option>
                                    <option value="Hạng B2">Hạng B2</option>
                                    <option value="Hạng B1">Hạng B1</option>
                                 </select>
                              </div>
                           </div>
                           <div class="input-newsletters">
                              <label>Nội dung</label>
                              <textarea class="form-control" id="noidung" name="cnote" placeholder="Nội dung"></textarea>
                           </div>
                           <input type="submit" name="btn_submit_baogia" class="btn btn-primary" name="submit-newsletters" value="Đăng ký" />
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="50" data-aos-duration="800">
               <p class="raochan"><img src="assets/images/raochan.png"/></p>
            </div>
         </div>
      </div>
                   
<?php 
	$this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>