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

    /**
     * Endpoint Realtime kiểm tra hồ sơ mới cho phòng ban đang đăng nhập
    /**
     * API Lấy danh sách thông báo cho Dropdown Menu & Số lượng chưa đọc
     */
    function ajax_get_notifications()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            @session_write_close();
        }

        $staff_user_id = (int)Fget_userdata('session_nid_user');
        if ($staff_user_id <= 0 && isset($_SESSION['session_nid_user'])) {
            $staff_user_id = (int)$_SESSION['session_nid_user'];
        }

        ensure_notification_table_exists();

        // Tự động khởi tạo dữ liệu mẫu từ các hồ sơ gần đây nếu bảng notification đang trống
        $count_all = $this->db->count_all(Fget_ap_table('tdoc_notification'));
        if ($count_all == 0) {
            $recent_subs = $this->db->order_by('nid', 'DESC')->limit(10)->get(Fget_ap_table('tdoc_submission'))->result_array();
            if (!empty($recent_subs)) {
                foreach ($recent_subs as $s) {
                    $steps = $this->db->where('nid_submission', $s['nid'])->get(Fget_ap_table('tdoc_approval_step'))->result_array();
                    $doc_type = get_doc_type_by_id($s['nid_doc_type']);
                    $type_name = !empty($doc_type['cname']) ? $doc_type['cname'] : 'Hồ sơ';
                    if (!empty($steps)) {
                        foreach ($steps as $st) {
                            $link = 'index.php/do_dept_review/detail/' . $s['nid'] . '/' . $st['nid_dept'];
                            create_doc_notification(
                                $s['nid'],
                                $st['nid_dept'],
                                'NEW_SUBMISSION',
                                'Hồ sơ thẩm định #' . $s['ccode'],
                                'Khách hàng ' . $s['ccustomer_name'] . ' nộp ' . $type_name . ' cần thẩm định.',
                                $link
                            );
                        }
                    }
                    create_doc_notification(
                        $s['nid'],
                        0,
                        'NEW_SUBMISSION',
                        'Hồ sơ thẩm định #' . $s['ccode'],
                        'Khách hàng ' . $s['ccustomer_name'] . ' nộp ' . $type_name . ' vào hệ thống.',
                        'index.php/do_doc_submission_listview'
                    );
                }
            }
        }

        $data = get_staff_notifications($staff_user_id, 15);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
            'status'       => true,
            'unread_count' => $data['unread_count'],
            'items'        => $data['items']
        ));
        exit();
    }

    /**
     * API Đánh dấu thông báo đã đọc (1 mục hoặc tất cả)
     */
    function ajax_mark_as_read()
    {
        $staff_user_id = (int)Fget_userdata('session_nid_user');
        if ($staff_user_id <= 0 && isset($_SESSION['session_nid_user'])) {
            $staff_user_id = (int)$_SESSION['session_nid_user'];
        }

        $notif_id = (int)$this->input->get_post('notif_id');
        $mark_all = (int)$this->input->get_post('mark_all');

        if ($mark_all == 1) {
            mark_notification_as_read(0, $staff_user_id);
        } else {
            mark_notification_as_read($notif_id, $staff_user_id);
        }

        $data = get_staff_notifications($staff_user_id, 1);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
            'status'       => true,
            'unread_count' => $data['unread_count']
        ));
        exit();
    }

    /**
     * Realtime Polling Endpoint - Kiểm tra có hồ sơ mới được nộp hay không
     */
    function ajax_check_new_submissions()
    {
        if (session_status() == PHP_SESSION_ACTIVE) {
            @session_write_close();
        }

        $last_id = (int)$this->input->get('last_id');
        $staff_user_id = (int)Fget_userdata('session_nid_user');
        if ($staff_user_id <= 0 && isset($_SESSION['session_nid_user'])) {
            $staff_user_id = (int)$_SESSION['session_nid_user'];
        }

        $is_admin = has_staff_role('admin');

        $user_dept = 0;
        if ($staff_user_id > 0) {
            $user_row = $this->db->where('nid', $staff_user_id)->get(Fget_ap_table('tuser'))->row_array();
            if (!empty($user_row) && isset($user_row['nid_dept'])) {
                $user_dept = (int)$user_row['nid_dept'];
            }
        }

        $this->db->select_max('nid', 'max_id');
        $max_row = $this->db->get(Fget_ap_table('tdoc_submission'))->row_array();
        $current_max_id = !empty($max_row['max_id']) ? (int)$max_row['max_id'] : 0;

        $new_items = array();

        if ($last_id > 0 && $current_max_id > $last_id) {
            $this->db->select('s.nid, s.ccode, s.ctitle, s.ccustomer_name, s.ddate_submit, t.cname as doc_type_name, step.nid_dept');
            $this->db->from(Fget_ap_table('tdoc_submission') . ' s');
            $this->db->join(Fget_ap_table('tdoc_type') . ' t', 's.nid_doc_type = t.nid', 'left');
            $this->db->join(Fget_ap_table('tdoc_approval_step') . ' step', 's.nid = step.nid_submission', 'left');
            $this->db->where('s.nid >', $last_id);
            $this->db->where('s.cstatus', 'IN_REVIEW');

            if (!$is_admin && $user_dept > 0) {
                $this->db->where('step.nid_dept', $user_dept);
            }

            $this->db->order_by('s.nid', 'DESC');
            $this->db->limit(5);
            $rows = $this->db->get()->result_array();

            $seen_ids = array();
            if (!empty($rows)) {
                foreach ($rows as $r) {
                    if (in_array($r['nid'], $seen_ids)) continue;
                    $seen_ids[] = $r['nid'];

                    $target_dept = !empty($r['nid_dept']) ? $r['nid_dept'] : $user_dept;
                    $review_url = base_url() . 'index.php/do_dept_review/detail/' . $r['nid'] . '/' . ($target_dept > 0 ? $target_dept : 1);
                    $new_items[] = array(
                        'nid'           => $r['nid'],
                        'ccode'         => $r['ccode'],
                        'ctitle'        => $r['ctitle'],
                        'ccustomer_name'=> $r['ccustomer_name'],
                        'doc_type_name' => $r['doc_type_name'],
                        'review_url'    => $review_url
                    );
                }
            }
        }

        // Lấy unread_count hiện tại
        $notif_data = get_staff_notifications($staff_user_id, 1);

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array(
            'has_new'         => count($new_items) > 0,
            'max_id'          => $current_max_id,
            'unread_count'    => $notif_data['unread_count'],
            'new_submissions' => $new_items
        ));
        exit();
    }
}


