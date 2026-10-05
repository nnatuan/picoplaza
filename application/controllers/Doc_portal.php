<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA - Document Approval & Customer Service Portal
 * Controller xử lý luồng Khách hàng nộp hồ sơ & theo dõi tiến độ
 * =================================================================
 */

class Doc_portal extends CI_Controller
{
    var $title       = 'Hồ Sơ Thẩm Định Của Tôi — PICO PLAZA';
    var $tags        = 'pico plaza, thẩm định hồ sơ, phê duyệt trực tuyến, biểu mẫu';
    var $description = 'Cổng dịch vụ tiếp nhận, thẩm định và phê duyệt hồ sơ dành cho thành viên Pico Plaza';

    function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            @session_start();
        }
        $this->load->database();
        $this->load->helper(array('url', 'file', 'ap_function', 'ap_object', 'ap_html', 'ap_view_helper', 'ap_db', 'ap_module', 'workflow'));
    }

    private function check_auth()
    {
        if (!isset($_SESSION['session_nid_member']) || empty($_SESSION['session_nid_member'])) {
            $_SESSION['auth_redirect_url'] = current_url();
            redirect(base_url() . 'auth');
            exit();
        }
        return (int)$_SESSION['session_nid_member'];
    }

    function index()
    {
        $user_id = $this->check_auth();
        $member  = get_member_by_id($user_id);

        $data['title']        = $this->title;
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_top']     = 'profile';
        $data['member']       = $member;

        // Lấy danh sách hồ sơ của member
        $my_submissions = get_my_doc_submissions($user_id);
        $data['my_submissions'] = $my_submissions;

        // Thống kê số liệu hồ sơ
        $stats = array(
            'total'       => count($my_submissions),
            'in_progress' => 0,
            'completed'   => 0,
            'rejected'    => 0,
            'waiting'     => 0
        );

        if (!empty($my_submissions)) {
            foreach ($my_submissions as $sub) {
                $st = strtoupper($sub['cstatus']);
                if ($st == 'COMPLETED') {
                    $stats['completed']++;
                } elseif ($st == 'REJECTED') {
                    $stats['rejected']++;
                } elseif ($st == 'WAITING_ADMIN') {
                    $stats['waiting']++;
                    $stats['in_progress']++;
                } else {
                    $stats['in_progress']++;
                }
            }
        }
        $data['stats'] = $stats;

        // Lấy danh mục loại hồ sơ & biểu mẫu
        $data['doc_types'] = get_all_active_doc_types();

        $this->load->view('doc_portal/index', $data);
    }

    function submit($type_id = '')
    {
        $user_id = $this->check_auth();
        $member  = get_member_by_id($user_id);

        $type_id = (int)$type_id;
        $doc_type = get_doc_type_by_id($type_id);

        // Xử lý nộp form POST
        if ($this->input->post('action_submit_doc')) {
            $this->process_submit($user_id);
            return;
        }

        $data['title']         = 'Nộp Hồ Sơ Thẩm Định Mới — PICO PLAZA';
        $data['tags']          = $this->tags;
        $data['description']   = $this->description;
        $data['menu_top']      = 'profile';
        $data['member']        = $member;
        $data['doc_types']     = get_all_active_doc_types();
        $data['selected_type'] = $doc_type;

        $this->load->view('doc_portal/submit', $data);
    }

    private function process_submit($user_id)
    {
        $doc_type_id = (int)$this->input->post('nid_doc_type');
        $cust_name   = trim($this->input->post('txt_name'));
        $cust_phone  = trim($this->input->post('txt_phone'));
        $cust_email  = trim($this->input->post('txt_email'));
        $doc_title   = trim($this->input->post('txt_title'));
        $doc_note    = trim($this->input->post('txt_note'));

        if (empty($doc_type_id) || empty($cust_name) || empty($cust_phone) || empty($cust_email) || empty($doc_title)) {
            $_SESSION['doc_flash_error'] = 'Vui lòng điền đầy đủ các thông tin bắt buộc (*)!';
            redirect(base_url() . 'doc_portal/submit/' . $doc_type_id);
            return;
        }

        // Upload file scan/ảnh hồ sơ đã ký tay
        $uploaded_file_path = '';
        if (isset($_FILES['file_document']) && $_FILES['file_document']['name'] != '') {
            $upload_dir = './upload/documents/' . date('Ym') . '/';
            if (!is_dir($upload_dir)) {
                @mkdir($upload_dir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['file_document']['name'], PATHINFO_EXTENSION));
            $allowed_exts = array('pdf', 'jpg', 'jpeg', 'png');
            if (!in_array($ext, $allowed_exts)) {
                $_SESSION['doc_flash_error'] = 'Chỉ chấp nhận tệp định dạng PDF, JPG, PNG!';
                redirect(base_url() . 'doc_portal/submit/' . $doc_type_id);
                return;
            }

            $new_filename = 'doc_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            $target_file  = $upload_dir . $new_filename;

            if (move_uploaded_file($_FILES['file_document']['tmp_name'], $target_file)) {
                $uploaded_file_path = 'upload/documents/' . date('Ym') . '/' . $new_filename;
            } else {
                $_SESSION['doc_flash_error'] = 'Không thể lưu tệp đính kèm. Vui lòng thử lại!';
                redirect(base_url() . 'doc_portal/submit/' . $doc_type_id);
                return;
            }
        } else {
            $_SESSION['doc_flash_error'] = 'Bắt buộc tải lên bản scan/chụp ảnh hồ sơ đã ký!';
            redirect(base_url() . 'doc_portal/submit/' . $doc_type_id);
            return;
        }

        $submit_data = array(
            'nid_user'        => $user_id,
            'nid_doc_type'    => $doc_type_id,
            'ccustomer_name'  => $cust_name,
            'ccustomer_phone' => $cust_phone,
            'ccustomer_email' => $cust_email,
            'ctitle'          => $doc_title,
            'cnote'           => $doc_note,
            'cfile_path'      => $uploaded_file_path
        );

        $doc_code = workflow_submit_document($submit_data, false); // false để AJAX chạy ngầm thông báo, không làm chậm quá trình submit

        if ($doc_code) {
            $_SESSION['doc_flash_success'] = 'Hồ sơ mã #' . $doc_code . ' đã được gửi thẩm định thành công!';
            redirect(base_url() . 'doc_portal/track/' . $doc_code . '?just_submitted=1');
        } else {
            $_SESSION['doc_flash_error'] = 'Lỗi hệ thống trong quá trình gửi hồ sơ. Vui lòng liên hệ hỗ trợ!';
            redirect(base_url() . 'doc_portal/submit/' . $doc_type_id);
        }
    }

    function track($code = '')
    {
        $user_id = $this->check_auth();
        $member  = get_member_by_id($user_id);

        $code = trim($code);
        if (empty($code)) {
            $code = trim($this->input->get('code'));
        }

        if (empty($code)) {
            redirect(base_url() . 'doc_portal');
            return;
        }

        $submission = get_doc_submission_by_code($code);
        if (empty($submission)) {
            $_SESSION['doc_flash_error'] = 'Không tìm thấy hồ sơ với mã #' . htmlspecialchars($code);
            redirect(base_url() . 'doc_portal');
            return;
        }

        // Kiểm tra quyền sở hữu hồ sơ nếu hồ sơ thuộc về member khác
        if (!empty($submission['nid_user']) && (int)$submission['nid_user'] !== $user_id) {
            // Cho phép nếu email hoặc phone trùng khớp
            $cust_email = isset($member['cemail']) ? strtolower(trim($member['cemail'])) : '';
            $sub_email  = strtolower(trim($submission['ccustomer_email']));
            if ($cust_email === '' || $cust_email !== $sub_email) {
                $_SESSION['doc_flash_error'] = 'Bạn không có quyền truy cập hồ sơ này!';
                redirect(base_url() . 'doc_portal');
                return;
            }
        }

        $data['title']       = 'Tiến Độ Hồ Sơ #' . $submission['ccode'] . ' — PICO PLAZA';
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
        $data['menu_top']    = 'profile';
        $data['member']      = $member;
        $data['doc']         = $submission;
        $data['steps']       = get_doc_approval_steps($submission['nid']);
        $data['logs']        = get_doc_logs($submission['nid']);

        $this->load->view('doc_portal/track', $data);
    }

    /**
     * AJAX ngầm gửi thông báo Telegram & Email khi nộp hồ sơ thành công
     */
    function ajax_send_notifications($code = '')
    {
        // Tắt session lock sớm để không block các request khác
        if (session_status() == PHP_SESSION_ACTIVE) {
            @session_write_close();
        }

        $code = trim($code);
        if (empty($code)) {
            echo json_encode(array('status' => false, 'message' => 'Mã hồ sơ trống'));
            return;
        }

        $submission = get_doc_submission_by_code($code);
        if (empty($submission)) {
            echo json_encode(array('status' => false, 'message' => 'Hồ sơ không tồn tại'));
            return;
        }

        // Thực thi gửi thông báo Telegram & Email
        if (function_exists('workflow_notify_new_submission')) {
            workflow_notify_new_submission($submission['nid'], $submission['ccode'], $submission['ccustomer_name'], $submission['doc_type_name']);
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('status' => true, 'message' => 'Đã gửi thông báo Telegram & Email thành công', 'code' => $code));
        exit();
    }
}
