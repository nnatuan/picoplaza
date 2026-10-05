<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Chi tiết & Thao tác Thẩm Định Phòng Ban
 * =================================================================
 */

class Do_dept_review extends CI_Controller
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
        if (!check_staff_permission(array('admin', 'doc_reviewer'))) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function detail($submission_id = 0, $dept_id = 0)
    {
        $submission_id = (int)$submission_id;
        $dept_id       = (int)$dept_id;

        if ($submission_id <= 0 || $dept_id <= 0) {
            redirect(base_url() . 'index.php/do_dept_review_listview');
            return;
        }

        $submission = get_doc_submission_by_id($submission_id);
        if (empty($submission)) {
            redirect(base_url() . 'index.php/do_dept_review_listview');
            return;
        }

        // Lấy thông tin bước thẩm định của phòng này
        $current_step = get_dept_step_info($submission_id, $dept_id);

        if (empty($current_step)) {
            redirect(base_url() . 'index.php/do_dept_review_listview');
            return;
        }

        $data['submission']   = $submission;
        $data['current_step'] = $current_step;
        $data['all_steps']    = get_doc_approval_steps($submission_id);
        $data['logs']         = get_doc_logs($submission_id);
        $data['menu_active']  = 'dept_review';

        $this->load->view('do_dept_review/detail', $data);
    }

    function process_action()
    {
        $submission_id = (int)$this->input->post('nid_submission');
        $dept_id       = (int)$this->input->post('nid_dept');
        $action        = trim($this->input->post('action')); // APPROVED hoặc REJECTED
        $reason_note   = trim($this->input->post('reason_note'));

        $staff_user_id = isset($_SESSION['session_user_id']) ? (int)$_SESSION['session_user_id'] : 1;

        $res = workflow_dept_review($submission_id, $dept_id, $staff_user_id, $action, $reason_note);

        if ($res['status']) {
            $_SESSION['flash_msg'] = 'Thành công: ' . $res['message'];
        } else {
            $_SESSION['flash_error'] = 'Lỗi: ' . $res['message'];
        }

        redirect(base_url() . 'index.php/do_dept_review/detail/' . $submission_id . '/' . $dept_id);
    }
}
