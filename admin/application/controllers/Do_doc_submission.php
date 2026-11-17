<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Chi Tiết & Phê Duyệt Cấp Quản Trị Tối Cao
 * Hỗ trợ Admin Review & Cơ Chế Can Thiệp Đặc Biệt (Admin Override)
 * =================================================================
 */

class Do_doc_submission extends CI_Controller
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

    function detail($id = 0)
    {
        $id = (int)$id;
        if ($id <= 0) {
            redirect(base_url() . 'index.php/do_doc_submission_listview');
            return;
        }

        $submission = get_doc_submission_by_id($id);
        if (empty($submission)) {
            redirect(base_url() . 'index.php/do_doc_submission_listview');
            return;
        }

        $data['submission']  = $submission;
        $data['steps']       = get_doc_approval_steps($id);
        $data['logs']        = get_doc_logs($id);
        $data['menu_active'] = 'doc_submission';

        $this->load->view('do_doc_submission/detail', $data);
    }

    // 1. Phê duyệt chuẩn cấp Admin (Khi hồ sơ đã ở WAITING_ADMIN)
    function admin_review()
    {
        $submission_id = (int)$this->input->post('nid_submission');
        $action        = trim($this->input->post('action')); // APPROVED hoặc REJECTED
        $reason_note   = trim($this->input->post('reason_note'));
        $admin_user_id = isset($_SESSION['session_user_id']) ? (int)$_SESSION['session_user_id'] : 1;

        $approved_file = '';
        if (isset($_FILES['file_approved']) && $_FILES['file_approved']['name'] != '') {
            $upload_dir = '.././upload/approved_docs/';
            if (!is_dir($upload_dir)) {
                @mkdir($upload_dir, 0777, true);
            }
            $ext = strtolower(pathinfo($_FILES['file_approved']['name'], PATHINFO_EXTENSION));
            $new_name = 'approved_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            if (move_uploaded_file($_FILES['file_approved']['tmp_name'], $upload_dir . $new_name)) {
                $approved_file = 'upload/approved_docs/' . $new_name;
            }
        }

        $res = workflow_admin_review($submission_id, $admin_user_id, $action, $reason_note, $approved_file);

        if ($res['status']) {
            $_SESSION['flash_msg'] = 'Thành công: ' . $res['message'];
        } else {
            $_SESSION['flash_error'] = 'Lỗi: ' . $res['message'];
        }

        redirect(base_url() . 'index.php/do_doc_submission/detail/' . $submission_id);
    }

    // 2. Cơ chế Can thiệp đặc biệt (Admin Override: Force Approve / Force Reject)
    function admin_override()
    {
        $submission_id   = (int)$this->input->post('nid_submission');
        $override_action = trim($this->input->post('override_action')); // FORCE_APPROVE hoặc FORCE_REJECT
        $admin_note      = trim($this->input->post('admin_note'));
        $admin_user_id   = isset($_SESSION['session_user_id']) ? (int)$_SESSION['session_user_id'] : 1;

        if (empty($admin_note)) {
            $_SESSION['flash_error'] = 'Ràng buộc kiểm soát: Bắt buộc nhập Admin Note lý do can thiệp!';
            redirect(base_url() . 'index.php/do_doc_submission/detail/' . $submission_id);
            return;
        }

        $approved_file = '';
        if (isset($_FILES['file_approved_override']) && $_FILES['file_approved_override']['name'] != '') {
            $upload_dir = '.././upload/approved_docs/';
            if (!is_dir($upload_dir)) {
                @mkdir($upload_dir, 0777, true);
            }
            $ext = strtolower(pathinfo($_FILES['file_approved_override']['name'], PATHINFO_EXTENSION));
            $new_name = 'force_approved_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            if (move_uploaded_file($_FILES['file_approved_override']['tmp_name'], $upload_dir . $new_name)) {
                $approved_file = 'upload/approved_docs/' . $new_name;
            }
        }

        $res = workflow_admin_override($submission_id, $admin_user_id, $override_action, $admin_note, $approved_file);

        if ($res['status']) {
            $_SESSION['flash_msg'] = 'Đã thực hiện can thiệp Admin Override: ' . $res['message'];
        } else {
            $_SESSION['flash_error'] = 'Lỗi Override: ' . $res['message'];
        }

        redirect(base_url() . 'index.php/do_doc_submission/detail/' . $submission_id);
    }
}
