<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend Authentication System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Auth extends CI_Controller
{
    var $event        = '';
    var $title        = 'Tài khoản — PICO SAIGON';
    var $tags         = '';
    var $description  = '';
    var $m_error_msg  = ''; 

    var $m_txt_username = '';
    var $m_txt_password = '';
    var $m_txt_fullname = '';
    var $m_txt_email    = '';
    var $m_txt_phone    = '';

    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_object');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view_helper');
        $this->load->helper('ap_db');
        $this->load->helper('ap_module'); 
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
        $this->load->language('ap', 'eng');

        if (isset($_POST['hidden_action'])) {
            $this->event = trim($_POST['hidden_action']);
        }

        if (isset($_POST['txt_username'])) {
            $this->m_txt_username = trim($_POST['txt_username']);
            $this->m_txt_password = trim($_POST['txt_password']);
        }

        if (isset($_POST['txt_email'])) {
            $this->m_txt_fullname = trim($_POST['txt_fullname']);
            $this->m_txt_email    = trim($_POST['txt_email']);
            $this->m_txt_phone    = trim($_POST['txt_phone']);
        }
    }

    private function caculate_data()
    {
        if (isset($_SESSION['session_nid_member'])) {
            redirect(base_url());
        }

        switch ($this->event) {
            case 'login': 
                $this->process_login();
                break;

            case 'register': 
                $this->process_register();
                break;
        }
    }

    private function process_login()
    {
        if ($this->m_txt_username == '' || $this->m_txt_password == '') {
            $this->m_error_msg = 'Vui lòng điền đầy đủ tên tài khoản và mật khẩu!';
            return;
        }

        $member = get_member_login($this->m_txt_username, $this->m_txt_password);

        if (!empty($member)) {
            if ($member['nstatus'] == 1) {
                $_SESSION['session_nid_member'] = $member['nid'];
                $_SESSION['session_cusername']  = $member['cfullname'];
                redirect(base_url());
            } else {
                $this->m_error_msg = 'Tài khoản của bạn hiện đang bị khóa hệ thống!';
            }
        } else {
            $this->m_error_msg = 'Tên đăng nhập hoặc mật khẩu không chính xác!';
        }
    }

    private function process_register()
    {
        if ($this->m_txt_username == '' || $this->m_txt_email == '' || $this->m_txt_password == '') {
            $this->m_error_msg = 'Vui lòng điền đầy đủ các trường thông tin bắt buộc (*)!';
            return;
        }

        if (Fcheck_member_duplicate($this->m_txt_username, $this->m_txt_email) == TRUE) {
            $this->m_error_msg = 'Tên tài khoản hoặc địa chỉ Email này đã tồn tại trên hệ thống!';
            return;
        }

        $current_datetime = date('Y-m-d H:i:s');
        $data_insert = array(
            'cusername'   => $this->m_txt_username,
            'cpassword'   => md5($this->m_txt_password), 
            'cfullname'   => $this->m_txt_fullname,
            'cemail'      => $this->m_txt_email,
            'cphone'      => $this->m_txt_phone,
            'nstatus'     => 1, 
            'dcreated_at' => $current_datetime,
            'dupdated_at' => $current_datetime
        );

        // GỌI HÀM DÙNG CHUNG: Truyền tên bảng tmember vào để insert hệ thống
        $insert_id = Finsert_data_global('tmember', $data_insert);

        if ($insert_id != FALSE) {
            $_SESSION['session_nid_member'] = $insert_id;
            $_SESSION['session_cusername']  = $this->m_txt_fullname;
            redirect(base_url());
        } else {
            $this->m_error_msg = 'Đã có lỗi phát sinh trong quá trình khởi tạo tài khoản!';
        }
    }

    private function do_business()
    {
        $data['title']        = $this->title;
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_top']     = 'auth';
        
        $data['m_message']    = $this->m_error_msg;
        $data['txt_username'] = $this->m_txt_username;
        $data['txt_fullname'] = $this->m_txt_fullname;
        $data['txt_email']    = $this->m_txt_email;
        $data['txt_phone']    = $this->m_txt_phone;

        $this->load->view('auth', $data);    
    }

    private function destroy_data()
    {
    }
	
	function logout()
    {
        unset($_SESSION['session_nid_member']);
        unset($_SESSION['session_cusername']);
        redirect(base_url());
    }
}