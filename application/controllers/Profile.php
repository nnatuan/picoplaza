<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend - Member Profile Management.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Profile extends CI_Controller
{
    var $title       = 'Profile — PICO SAIGON';
	var $tags         = '';
    var $description  = '';
    var $m_error_msg = '';
    var $m_succ_msg  = '';

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
        // 1. Chốt chặn bảo mật nếu phiên đăng nhập hết hạn
        if (!isset($_SESSION['session_nid_member'])) {
            redirect(base_url() . 'auth');
        }

        $nid_member = (int)$_SESSION['session_nid_member'];

        // 2. Tiếp nhận sự kiện khi người dùng nhấn nút Lưu Cập Nhật
        if (isset($_POST['hidden_action']) && $_POST['hidden_action'] === 'update_profile') {
            $this->process_update_profile($nid_member);
        }

        // 3. Truy vấn bốc dữ liệu mới nhất từ bảng tmember ra hiển thị
        $str_query = 'SELECT nid, cusername, cfullname, cemail, cphone, cavatar, dcreated_at FROM ' . Fget_ap_table('tmember') . ' WHERE nid = ' . $nid_member . ' LIMIT 0,1';
        $data['member'] = $this->db->query($str_query)->row_array();

        $data['title']     = $this->title;
		$data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['m_error']   = $this->m_error_msg;
        $data['m_success'] = $this->m_succ_msg;

        $this->load->view('profile', $data);
    }

    private function process_update_profile($nid_member)
    {
        $txt_cfullname = trim($_POST['txt_cfullname']);
        $txt_cphone    = trim($_POST['txt_cphone']);
        $txt_cpassword = trim($_POST['txt_cpassword']);

        // Xác thực các trường dữ liệu bắt buộc
        if ($txt_cfullname == '') {
            $this->m_error_msg = 'Họ và tên không được để trống!';
            return;
        }

        // Bốc dữ liệu bản ghi cũ để đối soát file ảnh avatar cũ
        $str_query = 'SELECT cavatar, cpassword FROM ' . Fget_ap_table('tmember') . ' WHERE nid = ' . $nid_member . ' LIMIT 0,1';
        $old_member = $this->db->query($str_query)->row_array();

        $new_avatar = $old_member['cavatar'];

        // Xử lý upload ảnh đại diện mới nếu có tệp chọn
        if (isset($_FILES["file_cavatar"]) && $_FILES["file_cavatar"]["name"] != '') {
            $path = FCPATH . 'upload/avatar/';
            
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            
            // Xóa file ảnh avatar cũ trên máy chủ để dọn sạch tài nguyên
            if (!empty($old_member['cavatar']) && file_exists($path . $old_member['cavatar'])) {
                @unlink($path . $old_member['cavatar']);
            }
            
            // Upload và hạ cấu trúc size file avatar theo hàm core hệ thống của anh
            $new_avatar = Fupload_resize_img($_FILES["file_cavatar"], $path, 1000, 1000);
        }

        // Đóng gói mảng dữ liệu sạch chuẩn bị cập nhật
        $data_update = array(
            'cfullname'   => $txt_cfullname,
            'cphone'      => $txt_cphone,
            'cavatar'     => $new_avatar,
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        // Xử lý cập nhật mật khẩu mới bằng chuỗi md5 nếu người dùng có điền vào ô
        if ($txt_cpassword != '') {
            if (strlen($txt_cpassword) < 6) {
                $this->m_error_msg = 'Mật khẩu mới phải có độ dài tối thiểu từ 6 ký tự trở lên!';
                return;
            }
            $data_update['cpassword'] = md5($txt_cpassword);
        }

        $this->db->where('nid', $nid_member);
        if ($this->db->update(Fget_ap_table('tmember'), $data_update)) {
            $this->m_succ_msg = 'Cập nhật hồ sơ tài khoản thành công!';
        } else {
            $this->m_error_msg = 'Đã xảy ra lỗi hệ thống khi lưu thông tin!';
        }
    }
}