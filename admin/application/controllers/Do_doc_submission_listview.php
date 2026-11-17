<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Quản Trị Danh Sách Hồ Sơ (Listview)
 * =================================================================
 */

class Do_doc_submission_listview extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            @session_start();
        }
        $this->load->database();
		$this->load->helper(array('url', 'ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object', 'workflow'));
        $this->config->check_system_login = '1';
        if (!check_staff_permission('admin')) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function index()
    {
        $filter_status = $this->input->get('status');
        $filter_code   = trim($this->input->get('code'));

        $data['list']          = get_doc_submissions_list($filter_status, $filter_code);
        $data['filter_status'] = $filter_status;
        $data['filter_code']   = $filter_code;
        $data['menu_active']   = 'doc_submission';

        $this->load->view('do_doc_submission/list', $data);
    }
}
