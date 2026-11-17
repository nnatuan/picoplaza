<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend Customer Ticket Portal System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Ticket extends CI_Controller
{
    var $event        = '';
    var $title        = 'Cổng chăm sóc khách hàng — PICO SAIGON';
    var $tags         = '';
    var $description  = '';
    var $m_error_msg  = '';

    // Thuộc tính nhận từ form
    var $m_txt_name        = '';
    var $m_txt_email       = '';
    var $m_txt_title       = '';
    var $m_txt_content     = '';
    var $m_txt_file_attach = '';

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
        redirect(base_url());
    }

    // Hàm nhận xử lý gửi Form từ ngoài Trang chủ
    function create()
    {
        $this->get_data();
        if ($this->event === 'create_ticket') {
            $this->process_create_ticket();
        } else {
            redirect(base_url());
        }
    }
	
	function valid_captcha()
    {
        $recaptcha_secret = "6Lf9Rz0dAAAAALFTS7bZOzYXDYz9PkrOVIr54AaQ";
        $response         = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $_POST['g-recaptcha-response']);
        $response         = json_decode($response, true);
        if ($response["success"] === true) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
    private function get_data()
    {
        if (isset($_POST['hidden_action'])) {
            $this->event = trim($_POST['hidden_action']);
        }

        if (isset($_FILES["file_attach"]) && $_FILES["file_attach"]["name"] != '') {
            $path = './upload/tickets/';
            $this->m_txt_file_attach = Fupload_resize_img($_FILES["file_attach"], $path, 2000, 1000);
        }

        if (isset($_POST['txt_email'])) {
            $this->m_txt_name    = trim($_POST['txt_name']);
            $this->m_txt_email   = trim($_POST['txt_email']);
            $this->m_txt_title   = trim($_POST['txt_title']);
            $this->m_txt_content = trim($_POST['txt_content']);
        }
    }

    private function process_create_ticket()
    {
		if (!$this->valid_captcha()) {
            $_SESSION['ticket_flash_error'] = 'Xác thực reCAPTCHA không thành công.';
            redirect(base_url() . 'portal#ticket-form');
        }
		
        if ($this->m_txt_name == '' || $this->m_txt_email == '' || $this->m_txt_title == '' || $this->m_txt_content == '') {
            $_SESSION['ticket_flash_error'] = 'Vui lòng điền đầy đủ các thông tin bắt buộc (*)!';
            redirect(base_url() . 'portal#ticket-form');
        }

        $ticket_code = Fgenerate_ticket_code();
        $current_datetime = date('Y-m-d H:i:s');

        $data_insert = array(
            'cticket_code'     => $ticket_code,
            'cname'            => $this->m_txt_name,
            'cemail'           => $this->m_txt_email,
            'ctitle'           => $this->m_txt_title,
            'ccontent'         => $this->m_txt_content,
            'cfile_attach'     => $this->m_txt_file_attach,
            'nstatus'          => 1, // 1: Mới tạo
            'nid_staff_assign' => NULL,
            'dcreated_at'      => $current_datetime,
            'dresolved_at'     => NULL
        );

        $insert_id = Finsert_data_global('tticket', $data_insert);

        if ($insert_id != FALSE) {
            // TỰ ĐỘNG CHÈN LÒG KHỞI TẠO ĐẦU TIÊN VÀO TIMELINE LOG
            $data_log = array(
                'nid_ticket'      => $insert_id,
                'cis_staff_reply' => '0',
                'ccontent_reply'  => 'Hệ thống đã tiếp nhận yêu cầu hỗ trợ thành công.',
                'nid_user_reply'  => NULL,
                'dreply_at'       => $current_datetime
            );
            Finsert_data_global('tticket_log', $data_log);

            // ĐIỀU HƯỚNG SANG TRANG CHI TIẾT TICKET RIÊNG BIỆT VỪA TẠO
            redirect(base_url() . 'ticket/detail/' . $ticket_code);
        } else {
            $_SESSION['ticket_flash_error'] = 'Hệ thống bận, không thể xử lý. Vui lòng thử lại!';
            redirect(base_url() . 'portal#ticket-form');
        }
    }

    // HÀM HIỂN THỊ TRANG CHI TIẾT TICKET RIÊNG BIỆT ĐỔ DATA THỰC TẾ
    function detail($ticket_code = '')
    {
		if (!isset($_SESSION['session_nid_member'])) {
            redirect(base_url() . 'index.php/auth');
        }
		
        $ticket_code = trim($ticket_code);
        if ($ticket_code == '') {
            redirect(base_url());
        }

        // Lấy data thực tế từ 2 hàm helper
        $ticket = get_ticket_by_code($ticket_code);
        if (empty($ticket)) {
            redirect(base_url());
        }

        $data['title']        = 'Tra cứu Ticket #' . $ticket['cticket_code'] . ' — PICO SAIGON';
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_top']     = 'portal';
        
        $data['ticket']       = $ticket;
        $data['ticket_logs']  = Fget_ticket_logs($ticket['nid']);

        $this->load->view('ticket', $data);
    }
}