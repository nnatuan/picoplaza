<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Newsletter Marketing System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Newsletter extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
		$this->load->helper('ap_function');
        $this->load->helper('ap_module');
    }
	
	function index() {
        redirect(base_url());
    }

    function register_email()
    {
        header('Content-Type: application/json; charset=utf-8');

        $email = isset($_POST['txt_email']) ? trim($_POST['txt_email']) : '';

        // 1. Kiểm tra validation phía Backend xem có trống hoặc sai định dạng không
        if ($email == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(array('status' => 'error', 'message' => 'Địa chỉ email không đúng định dạng hợp lệ!'));
            exit;
        }

        // 2. Rà soát kiểm tra trùng lặp email trong cơ sở dữ liệu
        $str_query = ' SELECT nid FROM ' . Fget_ap_table('tnewsletter') . ' WHERE cemail = ' . $this->db->escape($email) . ' LIMIT 0,1 ';
        $check_exist = $this->db->query($str_query)->row_array();

        if (!empty($check_exist)) {
            echo json_encode(array('status' => 'error', 'message' => 'Địa chỉ email này đã đăng ký nhận bản tin trên hệ thống trước đó!'));
            exit;
        }

        // 3. Đóng gói mảng dữ liệu sạch để lưu vào table tnewsletter
        $data_insert = array(
            'cemail'      => $email,
            'nstatus'     => 1, // 1: Kích hoạt trạng thái nhận tin bài định kỳ
            'dcreated_at' => date('Y-m-d H:i:s')
        );

        // Gọi hàm insert global dùng chung có sẵn trong hệ thống của anh
        $insert_id = Finsert_data_global('tnewsletter', $data_insert);

        if ($insert_id != FALSE) {
            echo json_encode(array('status' => 'success', 'message' => 'Chúc mừng! Bạn đã đăng ký nhận bản tin BĐS PICO thành công.'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Đã xảy ra lỗi hệ thống trong quá trình lưu trữ dữ liệu!'));
        }
        exit;
    }
}