<?php
class contact extends CI_Controller
{
    var $data_view = '';
    var $title = '';
    var $tags = '';
    var $description = '';
	var $cname	= '';
	var $cphone	= '';
	var $cemail	= '';
	var $cnote ='';
	var $btn_submit ='';
	var $btn_submit_baogia ='';
	var $changxe = '';
	var $err_cap = '';
	var $langsite = '';	
	var $msg = '';
    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_object');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_db');
		 $this->load->helper('ap_mail');
        $this->load->helper('ap_module');
		$this->load->helper('ap_captcha');
    }
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_contact_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_contact_' . $cookie_name);
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.contact.' . $str_key);
    }
    function index()
    {
        $this->do_process();
    }
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }
    private function get_data()
    {
        $lang_ = 'eng';
        if (isset($_SESSION['_lang']))
            $lang_ = $_SESSION['_lang'];
        $this->load->language('ap', $lang_);
        $this->langsite = $lang_;
		
		if(isset($_POST['btn_submit']))
			$this->btn_submit = $_POST['btn_submit'];
		if(isset($_POST['cname']))
			$this->cname = $_POST['cname'];
		if(isset($_POST['cphone']))
			$this->cphone = $_POST['cphone'];
		if(isset($_POST['cemail']))
			$this->cemail = $_POST['cemail'];
		if(isset($_POST['cnote']))
			$this->cnote = $_POST['cnote'];	
		if(isset($_POST['cemail']))
			$this->cemail = $_POST['cemail'];	
		if(isset($_POST['changxe']))
			$this->changxe = $_POST['changxe'];	
		if(isset($_POST['btn_submit_baogia']))
			$this->btn_submit_baogia = $_POST['btn_submit_baogia'];	
    }
	function valid_form()
    {
        $recaptcha_secret = "6LeB-hAUAAAAANuqVrQymYJGRxlMpi8EG9Gm7I8_";
        $response         = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
        $response         = json_decode($response, true);
        if ($response["success"] === true) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	function isValidEmail($email){ 
		return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
	}
    private function caculate_data()
    {
		if($this->btn_submit != '')
		{	
			
		}

		if($this->btn_submit_baogia != '')
		{	
			if ($this->btn_submit_baogia != '') {
				$data = array(
					"cname"    => $this->cname,
					"cphone"   => $this->cphone,
					"cemail" => $this->cemail,
					"changxe"  => $this->changxe,
					"cnote"  => $this->cnote,
					"ctime"    => time()
				);
				$this->db->insert("tregister", $data);

				$str = '
				<div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #e0e0e0; border-top: 4px solid #ee1c25;">
					<div style="padding: 20px; background-color: #f9f9f9;">
						<h2 style="color: #ee1c25; margin-top: 0; text-transform: uppercase; font-size: 18px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">
							Đăng ký khóa học
						</h2>
						<p style="margin: 10px 0;">Hệ thống vừa tiếp nhận một yêu đăng ký khóa học mới từ khách hàng với thông tin chi tiết như sau:</p>
						
						<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
							<tr>
								<td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold; width: 35%;">Khách hàng:</td>
								<td style="padding: 10px; border-bottom: 1px solid #eee;">' . htmlspecialchars($this->cname) . '</td>
							</tr>
							<tr>
								<td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Số điện thoại:</td>
								<td style="padding: 10px; border-bottom: 1px solid #eee;">' . htmlspecialchars($this->cphone) . '</td>
							</tr>
							<tr>
								<td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Email:</td>
								<td style="padding: 10px; border-bottom: 1px solid #eee;">' . htmlspecialchars($this->cemail) . '</td>
							</tr>
							<tr>
								<td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Chọn khóa học:</td>
								<td style="padding: 10px; border-bottom: 1px solid #eee;">' . htmlspecialchars($this->changxe) . '</td>
							</tr>
							<tr>
								<td style="padding: 10px; border-bottom: 1px solid #eee; font-weight: bold;">Thời gian gửi:</td>
								<td style="padding: 10px; border-bottom: 1px solid #eee;">' . date('H:i:s d/m/Y', $data['ctime']) . '</td>
							</tr>
						</table>
						
						<p style="font-size: 12px; color: #777; font-style: italic; margin-top: 20px;">
							* Đây là email tự động từ hệ thống Học Lái Xe BKMN. Vui lòng phản hồi khách hàng trong thời gian sớm nhất.
						</p>
					</div>
					<div style="background-color: #333; color: #fff; text-align: center; padding: 10px; font-size: 11px;">
						&copy; ' . date('Y') . ' Học Lái Xe BKMN. All rights reserved.
					</div>
				</div>';
				exit($str);
				$obj_data = get_config_byid(1);
				$email_to = '';
				foreach ($obj_data as $row) {
					$email_to = $row['cvalue'];
				}
				if (!empty($email_to)) {
					SendMail("no_reply@laixebkmn.com", $email_to, "Đăng ký khóa học - " . $this->cname, $str, "Học Lái Xe BKMN");
				}

				redirect(base_url() . 'da-gui-yeu-cau');
			}
		}
    }
    private function do_business()
    {	
		$this->title = "Liên hệ";
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
        $data['menu_cat']    = '';
        $data['menu_news']   = '';
        $data['menu_top'] = 'contact';
        $data['langsite']    = $this->langsite;

		$data['cname']    = $this->cname;
		$data['cphone']    = $this->cphone;
		$data['cemail']    = $this->cemail;

		$data['cnote']    = $this->cnote;
		$data['err_cap']    = $this->err_cap;
		$data['msg'] = $this->msg;
		
		/*
		$menu_data = get_menu_frontend();
		$menu_tree = build_menu_tree($menu_data, 0);
		$data['menu_html'] = render_menu_tree($menu_tree, 'elementor-nav-menu');
		$data['mobile_menu_html'] = render_mobile_menu($menu_tree);
		*/
        $this->load->view('contact', $data);
    }
    private function destroy_data()
    {
    }
}