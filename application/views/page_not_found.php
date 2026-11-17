<?php 
   $this->load->view('header');
   $this->load->view('header_end'); 
   $this->load->view('modules/mod_header');
?>  

<div style="min-height:420px;padding-top: 50px; width: 1200px;margin: 0 auto;margin-top: 50px;">
    <h3 style="text-align:center;">Trang bạn tìm kiếm không có.</br> Click vào <a href="<?php echo base_url(); ?>" style="text-decoration:underline;color:red;">đây</a> để quay về trang chủ</h3>
</div>
<?php 
$this->load->view('modules/mod_footer');
$this->load->view('footer');
?>