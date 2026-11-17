<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend - Member Ticket Listing Management.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class My_tickets extends CI_Controller
{
    var $title       = 'Hỗ trợ của tôi — PICO SAIGON';
    var $tags        = '';
    var $description = '';
	
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_function', 'ap_object', 'ap_html', 'ap_view_helper', 'ap_db', 'ap_module'));
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

    private function get_data() {}

    private function caculate_data()
    {
        if (!isset($_SESSION['session_nid_member'])) {
            redirect(base_url() . 'index.php/auth');
        }
    }

    private function do_business()
    {
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
		
        $nid_member = (int)$_SESSION['session_nid_member'];

        // 1. Lấy thông tin tài khoản thành viên để đối soát Email
        $member_info = get_member_by_id($nid_member);
        $member_email = !empty($member_info) ? $member_info['cemail'] : '';

        // 2. Truy vấn danh sách Ticket khớp chính xác với Email của thành viên
        // Sử dụng Fget_ap_table để tránh viết cứng tiền tố bảng
        $str_query = "SELECT nid, cticket_code, ctitle, ccontent, nstatus, dcreated_at ";
        $str_query .= "FROM " . Fget_ap_table('tticket') . " ";
        $str_query .= "WHERE cemail = " . $this->db->escape($member_email) . " ";
        $str_query .= "ORDER BY nid DESC LIMIT 0, 100";

        $data['tickets'] = $this->db->query($str_query)->result_array();

        $this->load->view('my_tickets', $data);
    }

    private function destroy_data() {}
}