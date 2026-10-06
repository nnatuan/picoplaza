<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA - Multi-Department Document Workflow Engine & Helper
 * Prefix: picoplaza_
 * =================================================================
 */

if (!function_exists('Fgenerate_doc_code')) {
    function Fgenerate_doc_code()
    {
        $prefix = 'HS-' . date('Ym') . '-';
        $rand = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
        return $prefix . $rand;
    }
}

if (!function_exists('get_all_active_doc_types')) {
    function get_all_active_doc_types()
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT * FROM " . Fget_ap_table('tdoc_type') . " WHERE nstatus = 1 ORDER BY cindex ASC, nid ASC";
        return $ci->db->query($query)->result_array();
    }
}

if (!function_exists('get_doc_type_by_id')) {
    function get_doc_type_by_id($nid)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT * FROM " . Fget_ap_table('tdoc_type') . " WHERE nid = " . (int)$nid . " LIMIT 1";
        return $ci->db->query($query)->row_array();
    }
}

if (!function_exists('get_all_departments')) {
    function get_all_departments()
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT * FROM " . Fget_ap_table('tdepartment') . " WHERE nstatus = 1 ORDER BY cindex ASC, nid ASC";
        return $ci->db->query($query)->result_array();
    }
}

if (!function_exists('get_department_by_id')) {
    function get_department_by_id($nid)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT * FROM " . Fget_ap_table('tdepartment') . " WHERE nid = " . (int)$nid . " LIMIT 1";
        return $ci->db->query($query)->row_array();
    }
}

if (!function_exists('workflow_submit_document')) {
    function workflow_submit_document($data, $send_notify = true)
    {
        $ci =& get_instance();
        $ci->load->database();

        $doc_type = get_doc_type_by_id($data['nid_doc_type']);
        if (empty($doc_type)) {
            return false;
        }

        $code = !empty($data['ccode']) ? $data['ccode'] : Fgenerate_doc_code();
        $submission_data = array(
            'ccode'           => $code,
            'nid_user'        => isset($data['nid_user']) ? (int)$data['nid_user'] : 0,
            'nid_doc_type'    => (int)$data['nid_doc_type'],
            'ccustomer_name'  => trim($data['ccustomer_name']),
            'ccustomer_phone' => trim($data['ccustomer_phone']),
            'ccustomer_email' => trim($data['ccustomer_email']),
            'ctitle'          => trim($data['ctitle']),
            'cnote'           => isset($data['cnote']) ? trim($data['cnote']) : '',
            'cfile_path'      => $data['cfile_path'],
            'cstatus'         => 'IN_REVIEW',
            'ddate_submit'    => date('Y-m-d H:i:s')
        );

        $ci->db->insert(Fget_ap_table('tdoc_submission'), $submission_data);
        $submission_id = $ci->db->insert_id();

        if (!$submission_id) {
            return false;
        }

        // Tự động đảm bảo schema DB hỗ trợ cdepts_view và cpermission
        if (!$ci->db->field_exists('cdepts_view', Fget_ap_table('tdoc_type'))) {
            $ci->db->query("ALTER TABLE " . Fget_ap_table('tdoc_type') . " ADD COLUMN `cdepts_view` varchar(255) DEFAULT '' AFTER `cdepts_required`");
        }
        if (!$ci->db->field_exists('cpermission', Fget_ap_table('tdoc_approval_step'))) {
            $ci->db->query("ALTER TABLE " . Fget_ap_table('tdoc_approval_step') . " ADD COLUMN `cpermission` enum('APPROVE','VIEW') NOT NULL DEFAULT 'APPROVE' AFTER `nid_staff_user`");
        }

        // 1. Phân luồng các phòng ban có quyền DUYỆT (cdepts_required)
        $dept_approve_ids = !empty($doc_type['cdepts_required']) ? explode(',', $doc_type['cdepts_required']) : array();
        foreach ($dept_approve_ids as $dept_id) {
            $dept_id = (int)trim($dept_id);
            if ($dept_id > 0) {
                $step_data = array(
                    'nid_submission' => $submission_id,
                    'nid_dept'       => $dept_id,
                    'cpermission'    => 'APPROVE',
                    'cstep_status'   => 'PENDING'
                );
                $ci->db->insert(Fget_ap_table('tdoc_approval_step'), $step_data);
            }
        }

        // 2. Phân luồng các phòng ban CHỈ XEM (cdepts_view)
        $dept_view_ids = !empty($doc_type['cdepts_view']) ? explode(',', $doc_type['cdepts_view']) : array();
        foreach ($dept_view_ids as $dept_id) {
            $dept_id = (int)trim($dept_id);
            if ($dept_id > 0 && !in_array($dept_id, $dept_approve_ids)) {
                $step_data = array(
                    'nid_submission' => $submission_id,
                    'nid_dept'       => $dept_id,
                    'cpermission'    => 'VIEW',
                    'cstep_status'   => 'PENDING'
                );
                $ci->db->insert(Fget_ap_table('tdoc_approval_step'), $step_data);
            }
        }

        // Ghi log khởi tạo
        workflow_add_log(
            $submission_id,
            isset($data['nid_user']) ? $data['nid_user'] : 0,
            'customer',
            'SUBMIT',
            'INIT',
            'IN_REVIEW',
            'Khách hàng đã nộp hồ sơ thẩm định thành công. Đang chờ các phòng ban thẩm định.'
        );

        // Bắn thông báo Telegram & Mailjet nếu bật notify đồng bộ
        if ($send_notify) {
            workflow_notify_new_submission($submission_id, $code, $data['ccustomer_name'], $doc_type['cname']);
        }

        return $code;
    }
}

if (!function_exists('workflow_dept_review')) {
    function workflow_dept_review($submission_id, $dept_id, $staff_user_id, $action, $reason_note = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $submission = get_doc_submission_by_id($submission_id);
        if (empty($submission) || $submission['cstatus'] !== 'IN_REVIEW') {
            return array('status' => false, 'message' => 'Hồ sơ không ở trạng thái chờ phòng ban thẩm định.');
        }

        // Kiểm tra quyền hạn của phòng ban: Nếu chỉ có quyền VIEW thì KHÔNG được duyệt/từ chối
        $current_step = get_dept_step_info($submission_id, $dept_id);
        if (!empty($current_step) && isset($current_step['cpermission']) && $current_step['cpermission'] === 'VIEW') {
            return array('status' => false, 'message' => 'Phòng ban của bạn chỉ được cấp quyền XEM hồ sơ, không được phép thao tác duyệt hoặc từ chối.');
        }

        $action = strtoupper($action);
        if (!in_array($action, array('APPROVED', 'REJECTED'))) {
            return array('status' => false, 'message' => 'Hành động không hợp lệ.');
        }

        if ($action === 'REJECTED' && empty(trim($reason_note))) {
            return array('status' => false, 'message' => 'Bắt buộc nhập lý do từ chối.');
        }

        // Cập nhật bước duyệt của phòng ban này
        $step_update = array(
            'nid_staff_user' => (int)$staff_user_id,
            'cstep_status'   => $action,
            'creason_note'   => $reason_note,
            'dtime_action'   => date('Y-m-d H:i:s')
        );
        $ci->db->where('nid_submission', (int)$submission_id);
        $ci->db->where('nid_dept', (int)$dept_id);
        $ci->db->update(Fget_ap_table('tdoc_approval_step'), $step_update);

        $dept_info = get_department_by_id($dept_id);
        $dept_name = !empty($dept_info) ? $dept_info['cname'] : 'Phòng ban #' . $dept_id;

        if ($action === 'REJECTED') {
            // Cơ chế song song độc lập: 1 phòng từ chối -> Toàn bộ hồ sơ bị REJECTED
            $sub_update = array(
                'cstatus'        => 'REJECTED',
                'creject_reason' => '[' . $dept_name . '] ' . $reason_note
            );
            $ci->db->where('nid', (int)$submission_id);
            $ci->db->update(Fget_ap_table('tdoc_submission'), $sub_update);

            workflow_add_log(
                $submission_id,
                $staff_user_id,
                'dept_staff',
                'DEPT_REJECT',
                'IN_REVIEW',
                'REJECTED',
                '[' . $dept_name . '] Từ chối thẩm định: ' . $reason_note
            );

            // Gửi thông báo cho khách hàng
            workflow_notify_customer_status($submission_id, 'REJECTED', $sub_update['creject_reason']);

            return array('status' => true, 'message' => 'Đã từ chối hồ sơ thành công.');
        } else {
            // Phòng ban Approved
            workflow_add_log(
                $submission_id,
                $staff_user_id,
                'dept_staff',
                'DEPT_APPROVE',
                'IN_REVIEW',
                'IN_REVIEW',
                '[' . $dept_name . '] Đã phê duyệt bước thẩm định chuyên môn.'
            );

            // Kiểm tra xem tất cả phòng ban CÓ QUYỀN DUYỆT (cpermission = 'APPROVE') đã Approved hết chưa
            $query_steps = "SELECT * FROM " . Fget_ap_table('tdoc_approval_step') . " 
                            WHERE nid_submission = " . (int)$submission_id . " 
                            AND (cpermission = 'APPROVE' OR cpermission IS NULL OR cpermission = '')";
            $approve_steps = $ci->db->query($query_steps)->result_array();

            $all_approved = true;
            foreach ($approve_steps as $step) {
                if ($step['cstep_status'] !== 'APPROVED') {
                    $all_approved = false;
                    break;
                }
            }

            if ($all_approved && count($approve_steps) > 0) {
                // Tự động chuyển trạng thái sang WAITING_ADMIN
                $ci->db->where('nid', (int)$submission_id);
                $ci->db->update(Fget_ap_table('tdoc_submission'), array('cstatus' => 'WAITING_ADMIN'));

                workflow_add_log(
                    $submission_id,
                    0,
                    'system',
                    'TRANSITION_WAITING_ADMIN',
                    'IN_REVIEW',
                    'WAITING_ADMIN',
                    'Tất cả các phòng ban chức năng đã thẩm định thông qua. Hồ sơ đã chuyển sang cấp Admin xem xét.'
                );

                // Bắn cảnh báo cho Admin
                workflow_notify_admin_waiting($submission_id);
            }

            return array('status' => true, 'message' => 'Đã thẩm định thông qua.');
        }
    }
}

if (!function_exists('workflow_admin_review')) {
    function workflow_admin_review($submission_id, $admin_user_id, $action, $reason_note = '', $approved_file = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $submission = get_doc_submission_by_id($submission_id);
        if (empty($submission) || $submission['cstatus'] !== 'WAITING_ADMIN') {
            return array('status' => false, 'message' => 'Hồ sơ chưa sẵn sàng cho cấp Admin phê duyệt.');
        }

        $action = strtoupper($action);
        if ($action === 'APPROVED') {
            $sub_update = array(
                'cstatus'         => 'COMPLETED',
                'cfile_approved'  => $approved_file,
                'cadmin_note'     => $reason_note,
                'ddate_completed' => date('Y-m-d H:i:s')
            );
            $ci->db->where('nid', (int)$submission_id);
            $ci->db->update(Fget_ap_table('tdoc_submission'), $sub_update);

            workflow_add_log(
                $submission_id,
                $admin_user_id,
                'admin',
                'ADMIN_APPROVE',
                'WAITING_ADMIN',
                'COMPLETED',
                'Admin đã phê duyệt hoàn tất hồ sơ và cấp văn bản chính thức.'
            );

            workflow_notify_customer_status($submission_id, 'COMPLETED');
            return array('status' => true, 'message' => 'Hồ sơ đã được phê duyệt COMPLETED thành công.');
        } else {
            if (empty(trim($reason_note))) {
                return array('status' => false, 'message' => 'Bắt buộc nhập lý do từ chối cấp quản trị.');
            }
            $sub_update = array(
                'cstatus'        => 'REJECTED',
                'creject_reason' => '[Admin Review] ' . $reason_note,
                'cadmin_note'    => $reason_note
            );
            $ci->db->where('nid', (int)$submission_id);
            $ci->db->update(Fget_ap_table('tdoc_submission'), $sub_update);

            workflow_add_log(
                $submission_id,
                $admin_user_id,
                'admin',
                'ADMIN_REJECT',
                'WAITING_ADMIN',
                'REJECTED',
                '[Admin Từ chối] ' . $reason_note
            );

            workflow_notify_customer_status($submission_id, 'REJECTED', $sub_update['creject_reason']);
            return array('status' => true, 'message' => 'Đã từ chối hồ sơ.');
        }
    }
}

if (!function_exists('workflow_admin_override')) {
    function workflow_admin_override($submission_id, $admin_user_id, $override_action, $admin_note, $approved_file = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $submission = get_doc_submission_by_id($submission_id);
        if (empty($submission)) {
            return array('status' => false, 'message' => 'Hồ sơ không tồn tại.');
        }

        if (empty(trim($admin_note))) {
            return array('status' => false, 'message' => 'Ràng buộc kiểm soát: Bắt buộc nhập Admin Note lý do can thiệp!');
        }

        $old_status = $submission['cstatus'];
        $override_action = strtoupper($override_action);

        if ($override_action === 'FORCE_APPROVE') {
            // Force Approve: Phê duyệt nhanh, bỏ qua các bước xét duyệt còn lại
            $sub_update = array(
                'cstatus'         => 'COMPLETED',
                'is_override'     => 1,
                'cadmin_note'     => $admin_note,
                'cfile_approved'  => $approved_file,
                'ddate_completed' => date('Y-m-d H:i:s')
            );
            $ci->db->where('nid', (int)$submission_id);
            $ci->db->update(Fget_ap_table('tdoc_submission'), $sub_update);

            // Cập nhật tất cả bước PENDING thành APPROVED với note can thiệp
            $ci->db->where('nid_submission', (int)$submission_id);
            $ci->db->where('cstep_status', 'PENDING');
            $ci->db->update(Fget_ap_table('tdoc_approval_step'), array(
                'cstep_status' => 'APPROVED',
                'creason_note' => '[Admin Force Approve] Bỏ qua duyệt khẩn cấp',
                'dtime_action' => date('Y-m-d H:i:s')
            ));

            workflow_add_log(
                $submission_id,
                $admin_user_id,
                'admin',
                'FORCE_APPROVE',
                $old_status,
                'COMPLETED',
                '[ADMIN OVERRIDE - FORCE APPROVE] Lý do: ' . $admin_note
            );

            workflow_notify_customer_status($submission_id, 'COMPLETED');
            return array('status' => true, 'message' => 'Đã thực hiện FORCE APPROVE thành công.');
        } elseif ($override_action === 'FORCE_REJECT') {
            // Force Reject: Hủy/Dừng xử lý hồ sơ lập tức ở bất kỳ giai đoạn nào
            $sub_update = array(
                'cstatus'        => 'REJECTED',
                'is_override'    => 1,
                'cadmin_note'    => $admin_note,
                'creject_reason' => '[Admin Force Reject] ' . $admin_note
            );
            $ci->db->where('nid', (int)$submission_id);
            $ci->db->update(Fget_ap_table('tdoc_submission'), $sub_update);

            workflow_add_log(
                $submission_id,
                $admin_user_id,
                'admin',
                'FORCE_REJECT',
                $old_status,
                'REJECTED',
                '[ADMIN OVERRIDE - FORCE REJECT] Lý do: ' . $admin_note
            );

            workflow_notify_customer_status($submission_id, 'REJECTED', $sub_update['creject_reason']);
            return array('status' => true, 'message' => 'Đã thực hiện FORCE REJECT hồ sơ.');
        } else {
            return array('status' => false, 'message' => 'Hành động override không hợp lệ.');
        }
    }
}

if (!function_exists('workflow_add_log')) {
    function workflow_add_log($submission_id, $user_id, $role, $action, $old_status, $new_status, $note)
    {
        $ci =& get_instance();
        $ci->load->database();

        $log_data = array(
            'nid_submission' => (int)$submission_id,
            'nid_user'       => (int)$user_id,
            'cuser_role'     => $role,
            'caction'        => $action,
            'cold_status'    => $old_status,
            'cnew_status'    => $new_status,
            'cnote'          => $note,
            'cip_address'    => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.1',
            'ddate_log'      => date('Y-m-d H:i:s')
        );

        $ci->db->insert(Fget_ap_table('tdoc_log'), $log_data);
    }
}

if (!function_exists('get_doc_submission_by_id')) {
    function get_doc_submission_by_id($nid)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT s.*, t.cname as doc_type_name, t.ccode as doc_type_code 
                  FROM " . Fget_ap_table('tdoc_submission') . " s
                  LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                  WHERE s.nid = " . (int)$nid . " LIMIT 1";
        return $ci->db->query($query)->row_array();
    }
}

if (!function_exists('get_doc_submission_by_code')) {
    function get_doc_submission_by_code($code)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT s.*, t.cname as doc_type_name, t.ccode as doc_type_code 
                  FROM " . Fget_ap_table('tdoc_submission') . " s
                  LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                  WHERE s.ccode = " . $ci->db->escape(trim($code)) . " LIMIT 1";
        return $ci->db->query($query)->row_array();
    }
}

if (!function_exists('get_doc_approval_steps')) {
    function get_doc_approval_steps($submission_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT step.*, d.cname as dept_name, d.ccode as dept_code, d.ctelegram_group_id, u.cfullname as staff_name
                  FROM " . Fget_ap_table('tdoc_approval_step') . " step
                  LEFT JOIN " . Fget_ap_table('tdepartment') . " d ON step.nid_dept = d.nid
                  LEFT JOIN " . Fget_ap_table('tuser') . " u ON step.nid_staff_user = u.nid
                  WHERE step.nid_submission = " . (int)$submission_id . "
                  ORDER BY d.cindex ASC, step.nid ASC";
        return $ci->db->query($query)->result_array();
    }
}

if (!function_exists('get_doc_logs')) {
    function get_doc_logs($submission_id)
    {
        $ci =& get_instance();
        $ci->load->database();
        $query = "SELECT * FROM " . Fget_ap_table('tdoc_log') . " WHERE nid_submission = " . (int)$submission_id . " ORDER BY nid ASC";
        return $ci->db->query($query)->result_array();
    }
}

if (!function_exists('workflow_notify_new_submission')) {
    function workflow_notify_new_submission($submission_id, $code = '', $customer_name = '', $type_name = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $sub = get_doc_submission_by_id($submission_id);
        if (empty($sub)) return;

        // Đảm bảo helper gửi Telegram & Email được nạp
        if (!function_exists('send_telegram_core') || !function_exists('send_mail_mailjet')) {
            $ci->load->helper('ap_module');
        }
        if (!function_exists('send_telegram_core') || !function_exists('send_mail_mailjet')) {
            $ci->load->helper('ap_object');
        }

        $admin_url = (strpos(base_url(), '/admin') !== false) ? rtrim(base_url(), '/') : rtrim(base_url(), '/') . '/admin';
        
        // Kiểm tra nền tảng thông báo: 1 = Telegram, 0 = Viber (Config nid = 25)
        $notify_platform = function_exists('get_value_by_config') ? get_value_by_config(25) : (function_exists('get_config_value') ? get_config_value(25) : '1');
        if ($notify_platform === '' || $notify_platform === null) {
            $notify_platform = '1';
        }
        $notify_platform = (string)trim($notify_platform);

        // 1. GỬI THÔNG BÁO TỚI NHÓM CỦA TỪNG PHÒNG BAN THẨM ĐỊNH
        $steps = get_doc_approval_steps($submission_id);
        if (!empty($steps)) {
            $sent_groups = array();
            foreach ($steps as $step) {
                $group_id = !empty($step['ctelegram_group_id']) ? trim($step['ctelegram_group_id']) : '';
                if (empty($group_id) || in_array($group_id, $sent_groups)) continue;
                $sent_groups[] = $group_id;

                $dept_title = !empty($step['dept_name']) ? $step['dept_name'] : 'PHÒNG BAN';
                $dept_msg = "🏢 <b>[HỒ SƠ THẨM ĐỊNH MỚI — " . htmlspecialchars(mb_strtoupper($dept_title, 'UTF-8'), ENT_QUOTES, 'UTF-8') . "]</b>\n";
                $dept_msg .= "🏷️ <b>Mã hồ sơ:</b> #" . htmlspecialchars($sub['ccode'], ENT_QUOTES, 'UTF-8') . "\n";
                $dept_msg .= "📄 <b>Loại hồ sơ:</b> " . htmlspecialchars($sub['doc_type_name'], ENT_QUOTES, 'UTF-8') . "\n";
                $dept_msg .= "📌 <b>Tiêu đề:</b> " . htmlspecialchars($sub['ctitle'], ENT_QUOTES, 'UTF-8') . "\n";
                $dept_msg .= "👤 <b>Người nộp:</b> " . htmlspecialchars($sub['ccustomer_name'], ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($sub['ccustomer_phone'], ENT_QUOTES, 'UTF-8') . ")\n";
                $dept_msg .= "📧 <b>Email:</b> " . htmlspecialchars($sub['ccustomer_email'], ENT_QUOTES, 'UTF-8') . "\n";
                if (!empty($sub['cnote'])) {
                    $dept_msg .= "📝 <b>Ghi chú:</b> " . htmlspecialchars(trim(strip_tags($sub['cnote'])), ENT_QUOTES, 'UTF-8') . "\n";
                }
                if (!empty($sub['cfile_path'])) {
                    $dept_msg .= "📎 <b>Tệp hồ sơ:</b> <a href=\"" . htmlspecialchars(base_url($sub['cfile_path']), ENT_QUOTES, 'UTF-8') . "\">Xem tệp scan/ảnh</a>\n";
                }
                $dept_msg .= "⏰ <b>Thời gian nộp:</b> " . date('d/m/Y H:i', strtotime($sub['ddate_submit'])) . "\n";
                $dept_msg .= "⚡ <i>Vui lòng chuyên viên phòng ban đăng nhập CMS Pico Plaza <a href=\"" . htmlspecialchars($admin_url, ENT_QUOTES, 'UTF-8') . "\">tại đây</a> để thẩm định.</i>";

                if ($notify_platform === '0' && function_exists('send_viber_core')) {
                    // Gửi qua Viber Bot
                    send_viber_core($group_id, $dept_msg);
                } elseif (function_exists('send_telegram_core')) {
                    // Mặc định gửi qua Telegram
                    send_telegram_core($group_id, $dept_msg);
                }
            }
        }

        // 2. GỬI THÔNG BÁO VÀO NHÓM BAN QUẢN TRỊ / ADMIN
        if ($notify_platform === '0' && function_exists('send_viber_core')) {
            // Viber Admin Receiver ID (Config nid = 27 hoặc dùng chung nid = 24)
            $viber_admin_id = function_exists('get_value_by_config') ? get_value_by_config(27) : (function_exists('get_config_value') ? get_config_value(27) : '');
            if (empty($viber_admin_id)) {
                $viber_admin_id = function_exists('get_value_by_config') ? get_value_by_config(24) : (function_exists('get_config_value') ? get_config_value(24) : '');
            }
            if (!empty($viber_admin_id)) {
                $admin_msg = "📋 <b>[HỒ SƠ MỚI TIẾP NHẬN — TOÀN HỆ THỐNG]</b>\n";
                $admin_msg .= "🏷️ <b>Mã hồ sơ:</b> #" . htmlspecialchars($sub['ccode'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "👤 <b>Khách hàng:</b> " . htmlspecialchars($sub['ccustomer_name'], ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($sub['ccustomer_phone'], ENT_QUOTES, 'UTF-8') . ")\n";
                $admin_msg .= "📄 <b>Loại hồ sơ:</b> " . htmlspecialchars($sub['doc_type_name'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "📌 <b>Tiêu đề:</b> " . htmlspecialchars($sub['ctitle'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "⏳ <b>Trạng thái:</b> ĐANG THẨM ĐỊNH SONG SONG\n";
                $admin_msg .= "⏰ <b>Thời gian:</b> " . date('d/m/Y H:i', strtotime($sub['ddate_submit'])) . "\n";
                $admin_msg .= "👉 <i>Vui lòng truy cập trang quản trị <a href=\"" . htmlspecialchars($admin_url, ENT_QUOTES, 'UTF-8') . "\">tại đây</a></i>";
                send_viber_core($viber_admin_id, $admin_msg);
            }
        } elseif (function_exists('send_telegram_core')) {
            $admin_group_id = function_exists('get_value_by_config') ? get_value_by_config(24) : (function_exists('get_config_value') ? get_config_value(24) : '');
            if (!empty($admin_group_id)) {
                $admin_msg = "📋 <b>[HỒ SƠ MỚI TIẾP NHẬN — TOÀN HỆ THỐNG]</b>\n";
                $admin_msg .= "🏷️ <b>Mã hồ sơ:</b> #" . htmlspecialchars($sub['ccode'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "👤 <b>Khách hàng:</b> " . htmlspecialchars($sub['ccustomer_name'], ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($sub['ccustomer_phone'], ENT_QUOTES, 'UTF-8') . ")\n";
                $admin_msg .= "📄 <b>Loại hồ sơ:</b> " . htmlspecialchars($sub['doc_type_name'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "📌 <b>Tiêu đề:</b> " . htmlspecialchars($sub['ctitle'], ENT_QUOTES, 'UTF-8') . "\n";
                $admin_msg .= "⏳ <b>Trạng thái:</b> ĐANG THẨM ĐỊNH SONG SONG\n";
                $admin_msg .= "⏰ <b>Thời gian:</b> " . date('d/m/Y H:i', strtotime($sub['ddate_submit'])) . "\n";
                $admin_msg .= "⚡ <i>Hệ thống đã tự động gửi cảnh báo tới nhóm Telegram các phòng ban phụ trách.</i>\n";
                $admin_msg .= "👉 <i>Vui lòng truy cập trang quản trị <a href=\"" . htmlspecialchars($admin_url, ENT_QUOTES, 'UTF-8') . "\">tại đây</a></i>";

                send_telegram_core($admin_group_id, $admin_msg);
            }
        }

        // 3. GỬI EMAIL XÁC NHẬN TIẾP NHẬN HỒ SƠ CHO KHÁCH HÀNG (TIMEOUT NHANH 2s - KHÔNG NGHẼN)
        if (!empty($sub['ccustomer_email']) && function_exists('send_mail_mailjet')) {
            $frontend_base = (strpos(base_url(), '/admin') !== false) ? preg_replace('#/admin/?$#', '/', base_url()) : base_url();
            $frontend_base = rtrim($frontend_base, '/') . '/';
            $portal_track_url = $frontend_base . 'doc_portal/track/' . $sub['ccode'];

            $subject = '[PICO PLAZA] Tiếp nhận hồ sơ thẩm định #' . $sub['ccode'] . ' thành công';

            $content = "Kính gửi Quý khách <strong>" . htmlspecialchars($sub['ccustomer_name']) . "</strong>,<br><br>";
            $content .= "Hệ thống PICO PLAZA xin thông báo: Hồ sơ thẩm định của Quý khách đã được tiếp nhận thành công vào hệ thống và đang được các phòng ban chức năng tiến hành thẩm định.<br><br>";
            $content .= "📋 <strong>THÔNG TIN HỒ SƠ:</strong><br>";
            $content .= "• <strong>Mã hồ sơ:</strong> <strong style='color:#ea580c;'>#" . htmlspecialchars($sub['ccode']) . "</strong><br>";
            $content .= "• <strong>Loại hồ sơ:</strong> " . htmlspecialchars($sub['doc_type_name']) . "<br>";
            $content .= "• <strong>Tiêu đề:</strong> " . htmlspecialchars($sub['ctitle']) . "<br>";
            $content .= "• <strong>Thời gian tiếp nhận:</strong> " . date('d/m/Y H:i', strtotime($sub['ddate_submit'])) . "<br>";
            $content .= "• <strong>Trạng thái:</strong> <span style='color:#0284c7; font-weight:bold;'>Đang thẩm định song song</span><br><br>";
            $content .= "Để theo dõi vui lòng <a href='" . $portal_track_url . "' style='color:#ea580c; font-weight:bold; text-decoration:underline;'>truy cập portal tại đây</a> để biết thông tin chi tiết.<br><br>";
            $content .= "Trân trọng,<br><strong>Ban Quản Lý PICO PLAZA</strong>";

            $receiver = array(array('cemail' => $sub['ccustomer_email'], 'cfullname' => $sub['ccustomer_name']));
            @send_mail_mailjet($receiver, $subject, $content);
        }
    }
}

if (!function_exists('workflow_notify_admin_waiting')) {
    function workflow_notify_admin_waiting($submission_id)
    {
        $sub = get_doc_submission_by_id($submission_id);
        if (empty($sub)) return;

        $admin_group_id = function_exists('get_value_by_config') ? get_value_by_config(24) : (function_exists('get_config_value') ? get_config_value(24) : '');
        if (!empty($admin_group_id) && function_exists('send_telegram_core')) {
            $admin_url = (strpos(base_url(), '/admin') !== false) ? rtrim(base_url(), '/') : rtrim(base_url(), '/') . '/admin';
            $msg = "🔔 <b>[HỒ SƠ ĐỦ ĐIỀU KIỆN CHỜ ADMIN DUYỆT]</b>\n";
            $msg .= "🏷️ <b>Mã hồ sơ:</b> #" . htmlspecialchars($sub['ccode'], ENT_QUOTES, 'UTF-8') . "\n";
            $msg .= "👤 <b>Khách hàng:</b> " . htmlspecialchars($sub['ccustomer_name'], ENT_QUOTES, 'UTF-8') . "\n";
            $msg .= "✅ <b>Trạng thái:</b> ĐÃ QUA THẨM ĐỊNH TOÀN BỘ PHÒNG BAN\n";
            $msg .= "👑 <i>Vui lòng Admin truy cập trang quản trị <a href=\"" . $admin_url . "\">tại đây</a> để phê duyệt và cấp văn bản chính thức.</i>";
            send_telegram_core($admin_group_id, $msg);
        }
    }
}

if (!function_exists('workflow_notify_customer_status')) {
    function workflow_notify_customer_status($submission_id, $status, $reason = '')
    {
        $sub = get_doc_submission_by_id($submission_id);
        if (empty($sub) || empty($sub['ccustomer_email'])) return;

        if (function_exists('send_mail_mailjet')) {
            $status_text = ($status === 'COMPLETED') ? 'ĐÃ ĐƯỢC PHÊ DUYỆT HOÀN TẤT' : 'BỊ TỪ CHỐI';
            $subject = '[PICO PLAZA] Kết quả thẩm định hồ sơ #' . $sub['ccode'] . ' - ' . $status_text;
            
            $content = "Kính gửi Quý khách <strong>" . htmlspecialchars($sub['ccustomer_name']) . "</strong>,<br><br>";
            $content .= "Hệ thống PICO PLAZA xin thông báo về tình trạng hồ sơ <strong>#" . $sub['ccode'] . "</strong> (" . htmlspecialchars($sub['ctitle']) . "):<br><br>";
            $content .= "• <strong>Trạng thái:</strong> <strong style='color:" . ($status === 'COMPLETED' ? '#16a34a' : '#dc2626') . ";'>" . $status_text . "</strong><br>";
            if (!empty($reason)) {
                $content .= "• <strong>Lý do / Phản hồi:</strong> " . nl2br(htmlspecialchars($reason)) . "<br>";
            }
            $content .= "• <strong>Thời gian:</strong> " . date('d/m/Y H:i') . "<br><br>";

            if ($status === 'COMPLETED') {
                $track_url = base_url() . 'doc_portal/track/' . $sub['ccode'];
                $content .= "Quý khách có thể truy cập đường link sau để tải về văn bản chính thức đã được xác nhận:<br>";
                $content .= "<a href='" . $track_url . "' style='padding: 10px 18px; background: #ea580c; color: #fff; text-decoration: none; border-radius: 6px; display: inline-block; font-weight: bold;'>TẢI VĂN BẢN XÁC NHẬN</a><br><br>";
            } else {
                $content .= "Quý khách vui lòng kiểm tra lý do trên và cập nhật lại hồ sơ theo quy định.<br><br>";
            }

            $content .= "Trân trọng,<br><strong>Ban Quản Lý PICO PLAZA</strong>";

            $receiver = array(array('cemail' => $sub['ccustomer_email'], 'cfullname' => $sub['ccustomer_name']));
            send_mail_mailjet($receiver, $subject, $content);
        }
    }
}

if (!function_exists('get_my_doc_submissions')) {
    function get_my_doc_submissions($user_id)
    {
        $ci =& get_instance();
        $ci->load->database();

        $user_id = (int)$user_id;
        if ($user_id <= 0) return array();

        // Lấy thông tin email của member để tìm hồ sơ
        $member_row = $ci->db->where('nid', $user_id)->get(Fget_ap_table('tmember'))->row_array();
        $member_email = !empty($member_row['cemail']) ? trim($member_row['cemail']) : '';

        $where_cond = " (s.nid_user = " . $user_id;
        if (!empty($member_email)) {
            $where_cond .= " OR s.ccustomer_email = " . $ci->db->escape($member_email);
        }
        $where_cond .= ") ";

        $str_query = " SELECT s.*, t.cname as doc_type_name,
                       (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid) as total_steps,
                       (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid AND cstep_status = 'APPROVED') as approved_steps
                       FROM " . Fget_ap_table('tdoc_submission') . " s
                       LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                       WHERE " . $where_cond . " 
                       ORDER BY s.nid DESC ";
        return $ci->db->query($str_query)->result_array();
    }
}

if (!function_exists('get_dept_review_list')) {
    function get_dept_review_list($dept_id = 0, $filter_status = '', $filter_permission = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $where_sql = " WHERE 1=1 ";
        if ((int)$dept_id > 0) {
            $where_sql .= " AND step.nid_dept = " . (int)$dept_id . " ";
        }
        if (!empty($filter_status)) {
            $where_sql .= " AND step.cstep_status = " . $ci->db->escape($filter_status) . " ";
        }
        if (!empty($filter_permission)) {
            if ($filter_permission === 'VIEW') {
                $where_sql .= " AND step.cpermission = 'VIEW' ";
            } elseif ($filter_permission === 'APPROVE') {
                $where_sql .= " AND (step.cpermission = 'APPROVE' OR step.cpermission IS NULL OR step.cpermission = '') ";
            }
        }

        $str_query = " SELECT step.*, s.ccode, s.ccustomer_name, s.ccustomer_phone, s.ctitle, s.cstatus as submission_status, 
                              s.ddate_submit, s.cfile_path, d.cname as dept_name, t.cname as doc_type_name
                       FROM " . Fget_ap_table('tdoc_approval_step') . " step
                       INNER JOIN " . Fget_ap_table('tdoc_submission') . " s ON step.nid_submission = s.nid
                       LEFT JOIN " . Fget_ap_table('tdepartment') . " d ON step.nid_dept = d.nid
                       LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                       " . $where_sql . "
                       ORDER BY (CASE WHEN step.cstep_status = 'PENDING' THEN 1 ELSE 2 END) ASC, s.nid DESC ";
        return $ci->db->query($str_query)->result_array();
    }
}

if (!function_exists('get_dept_step_info')) {
    function get_dept_step_info($submission_id, $dept_id)
    {
        $ci =& get_instance();
        $ci->load->database();

        $str_query = " SELECT step.*, d.cname as dept_name, d.ccode as dept_code
                       FROM " . Fget_ap_table('tdoc_approval_step') . " step
                       LEFT JOIN " . Fget_ap_table('tdepartment') . " d ON step.nid_dept = d.nid
                       WHERE step.nid_submission = " . (int)$submission_id . " AND step.nid_dept = " . (int)$dept_id . " 
                       LIMIT 1 ";
        return $ci->db->query($str_query)->row_array();
    }
}

if (!function_exists('get_doc_submissions_list')) {
    function get_doc_submissions_list($filter_status = '', $filter_code = '')
    {
        $ci =& get_instance();
        $ci->load->database();

        $where_sql = " WHERE 1=1 ";
        if (!empty($filter_status)) {
            $where_sql .= " AND s.cstatus = " . $ci->db->escape($filter_status) . " ";
        }
        if (!empty($filter_code)) {
            $where_sql .= " AND (s.ccode LIKE '%" . $ci->db->escape_like_str($filter_code) . "%' OR s.ccustomer_name LIKE '%" . $ci->db->escape_like_str($filter_code) . "%') ";
        }

        $str_query = " SELECT s.*, t.cname as doc_type_name,
                              (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid) as total_steps,
                              (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid AND cstep_status = 'APPROVED') as approved_steps
                       FROM " . Fget_ap_table('tdoc_submission') . " s
                       LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                       " . $where_sql . "
                       ORDER BY s.nid DESC ";
        return $ci->db->query($str_query)->result_array();
    }
}
