<?php
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
   ?>
<!-- main-area -->
      <main>
         <!-- breadcrumb-area -->
         <section class="breadcrumb-area d-flex align-items-center" style="background-image: url(https://htmldemo.zcubethemes.com/thesignatures/img/bg/test-bg.png);background-position: center; background-repeat: no-repeat;background-size: cover;" >
            <div class="container">
               <div class="row">
                  <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="breadcrumb-wrap text-center">
                        <div class="breadcrumb-title mt-100 mb-30">
                           <h2>HOÀN TẤT ĐẶT BÀN</h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- breadcrumb-area-end -->
         <!-- about-area -->
         <section id="about" class="about-area about-p pt-100 pb-80 p-relative">
            <div class="container">
                <p style="font-size: 20px;line-height: 30px;text-align:center;">Quý khách đã đặt bàn thành công, chúng tôi sẽ sớm liên hệ với bạn.<br>Chân thành cảm ơn Quý khách đã tin tưởng và sử dụng dịch vụ!</p>
			</div>
         </section>
         <!-- about-area-end -->
      </main>
      <!-- main-area-end -->	 
<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>