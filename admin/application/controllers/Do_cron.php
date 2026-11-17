<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON CMS - Task Reminder Cronjob (Mail & Telegram).
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Do_cron extends CI_Controller
{
    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_object', 'ap_function', 'ap_view'));

        $this->config->check_system_login = '2';
    }

	/* cố định gửi tin nhắn khi còn 1 ngày hoặc ngày cuối cùng
    function cron_remind_email()
    {
        $current_date  = date('Y-m-d');
        $tomorrow_date = date('Y-m-d', strtotime('+1 day'));
        
        // Mảng lưu danh sách các ID Telegram đã gửi thành công
        $arr_sent_tele_ids = array();
        
        // ID Nhóm Chat Telegram chung của Ban Quản Trị / Admin PICO
        $admin_group_id = "YOUR_ADMIN_TELEGRAM_GROUP_ID"; 

        // --- KỊCH BẢN 1: CẢNH BÁO TRƯỚC 1 NGÀY ---
        $tasks_1day = get_tasks_remind_1day($tomorrow_date);
        foreach ($tasks_1day as $task) {
            $subject = "[PICO SAIGON] Nhắc việc: Công việc sắp hết hạn vào ngày mai!";
            $message = "Chào " . $task['cfullname'] . ",<br><br>Hệ thống nhắc việc thông báo công việc: <strong>" . $task['ctitle'] . "</strong> sắp hết hạn vào ngày mai (" . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "). Vui lòng kiểm tra và hoàn thành đúng hạn.<br>Trân trọng!";
            
            // Thực thi gửi Email cho nhân viên phụ trách
            $mail_status = $this->send_mail_core($task['cemail'], $subject, $message);
            
            if ($mail_status) {
                // Đóng gói chuỗi văn bản thuần chuẩn mã hóa UTF-8 gửi qua Telegram
                $tg_msg = "🔔 <b>[NHẮC VIỆC PICO SAIGON]</b>\n";
                $tg_msg .= "📌 <b>Công việc:</b> " . $task['ctitle'] . "\n";
                if (!empty($task['cdescription'])) {
                    $tg_msg .= "📝 <b>Mô tả:</b> " . strip_tags($task['cdescription']) . "\n";
                }
                $tg_msg .= "👤 <b>Nhân sự phụ trách:</b> " . $task['cfullname'] . "\n";
                $tg_msg .= "⏰ <b>Hạn chót:</b> " . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "\n";
                $tg_msg .= "⚠️ <i>Trạng thái: Sắp hết hạn vào ngày mai! Vui lòng hoàn thành đúng hạn.</i>";
                
                // 1. Nhắn Telegram cho chính nhân viên phụ trách (Nếu tài khoản có cấu hình chat_id)
                if(!empty($task['ctelegram_chat_id'])) {
                    if (send_telegram_core($task['ctelegram_chat_id'], $tg_msg)) {
                        $arr_sent_tele_ids[] = $task['ctelegram_chat_id'];
                    }
                }
                
                // 2. Đồng thời nhắn vào Nhóm chat giám sát tiến độ của Admin
                if (!empty($admin_group_id)) {
                    if (send_telegram_core($admin_group_id, $tg_msg)) {
                        $arr_sent_tele_ids[] = $admin_group_id;
                    }
                }

                // Cập nhật cờ xác nhận đã quét qua database
                //$this->db->where('nid', $task['nid']);
                //$this->db->update('ttask', array('nis_mail_sent_1day' => 1));
            }
        }

        // --- KỊCH BẢN 2: CẢNH BÁO ĐÚNG NGÀY HẾT HẠN (KHẨN CẤP) ---
        $tasks_due = get_tasks_remind_duedate($current_date);
        foreach ($tasks_due as $task) {
            $subject = "[PICO SAIGON] CẢNH BÁO: Công việc của bạn HẾT HẠN HÔM NAY!";
            $message = "Chào " . $task['cfullname'] . ",<br><br><strong>KHẨN CẤP:</strong> Công việc được giao: <strong>" . $task['ctitle'] . "</strong> có lịch hết hạn vào ngày hôm nay (" . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "). Vui lòng xử lý và cập nhật trạng thái trên CMS gấp.<br>Trân trọng!";
            
            //$mail_status = $this->send_mail_core($task['cemail'], $subject, $message);
            $mail_status = 1;
            if ($mail_status) {
                $tg_msg = "🚨 <b>[CẢNH BÁO KHẨN CẤP - PICO SAIGON]</b>\n";
                $tg_msg .= "📌 <b>Công việc:</b> " . $task['ctitle'] . "\n";
                if (!empty($task['cdescription'])) {
                    $tg_msg .= "📝 <b>Mô tả:</b> " . trim(strip_tags($task['cdescription'])) . "\n";
                }
                $tg_msg .= "👤 <b>Nhân sự phụ trách:</b> " . $task['cfullname'] . "\n";
                $tg_msg .= "⏰ <b>Hạn chót:</b> " . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "\n";
                $tg_msg .= "🔥 <b>TÌNH TRẠNG: HẾT HẠN HÔM NAY!</b> Vui lòng xử lý dứt điểm và cập nhật trạng thái gấp.";
                
                // 1. Nhắn Telegram trực tiếp cho nhân viên
                if(!empty($task['ctelegram_chat_id'])) {
                    if (send_telegram_core($task['ctelegram_chat_id'], $tg_msg)) {
                        $arr_sent_tele_ids[] = $task['ctelegram_chat_id'];
                    }
                }
                
                // 2. Nhắn Telegram báo cáo khẩn vào nhóm Admin điều hành
                if (!empty($admin_group_id)) {
                    if (send_telegram_core($admin_group_id, $tg_msg)) {
                        $arr_sent_tele_ids[] = $admin_group_id;
                    }
                }

                // Cập nhật cờ báo đúng ngày hết hạn vào database
                //$this->db->where('nid', $task['nid']);
                //$this->db->update('ttask', array('nis_mail_sent_duedate' => 1));
            }
        }

        // Tách lọc lấy danh sách ID duy nhất không bị lặp
        $arr_sent_tele_ids = array_unique($arr_sent_tele_ids);
        $str_sent_tele = !empty($arr_sent_tele_ids) ? implode(', ', $arr_sent_tele_ids) : 'Không có';

        echo "Cronjob nhắc việc (Mail & Telegram) đã thực thi thành công vào lúc: " . date('Y-m-d H:i:s') . " | Các ID Tele đã gửi: " . $str_sent_tele;
    }
	*/
	function cron_remind_email()
    {
        // Lấy cấu hình số phút trước hạn để bật nhắc nhở (ID 21)
        $remind_before_minutes = (int)get_config_value(21);
        if ($remind_before_minutes <= 0) $remind_before_minutes = 60; // Mặc định 60 phút nếu ID 21 rỗng

        // Mảng lưu danh sách các ID Telegram đã gửi thành công
        $arr_sent_tele_ids = array();
        
        // ID Nhóm Chat Telegram chung của Ban Quản Trị / Admin PICO
        $admin_group_id = "YOUR_ADMIN_TELEGRAM_GROUP_ID"; 

        // Quét các công việc còn lại dưới $remind_before_minutes phút
        $tasks_remind = get_tasks_nearing_deadline_by_minutes($remind_before_minutes);

        foreach ($tasks_remind as $task) {
            $minutes_left = (int)$task['minutes_left'];
            
            $subject = "[PICO SAIGON] CẢNH BÁO: Công việc sắp tới hạn xử lý!";
            $message = "Chào " . $task['cfullname'] . ",<br><br><strong>THÔNG BÁO HẠN XỬ LÝ:</strong> Công việc được giao: <strong>" . $task['ctitle'] . "</strong> chỉ còn khoảng <strong>" . $minutes_left . " phút</strong> nữa là tới hạn (" . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "). Vui lòng kiểm tra và hoàn thành trên CMS.<br>Trân trọng!";
            
            // 1. Gửi Email cho nhân viên phụ trách qua Mailjet API
            $mail_status = $this->send_mail_core($task['cemail'], $subject, $message, $task['cfullname']);

            if ($mail_status) {
                // 2. Đóng gói nội dung tin nhắn Telegram
                $tg_msg = "⏰ <b>[PICO SAIGON - NHẮC VIỆC TỚI HẠN]</b>\n";
                $tg_msg .= "📌 <b>Công việc:</b> " . $task['ctitle'] . "\n";
                if (!empty($task['cdescription'])) {
                    $tg_msg .= "📝 <b>Mô tả:</b> " . trim(strip_tags($task['cdescription'])) . "\n";
                }
                $tg_msg .= "👤 <b>Nhân sự phụ trách:</b> " . $task['cfullname'] . "\n";
                $tg_msg .= "⏳ <b>Thời gian còn lại:</b> khoảng <b>" . $minutes_left . " phút</b>\n";
                $tg_msg .= "⏰ <b>Hạn chót:</b> " . date('H:i d/m/Y', strtotime($task['ddue_date'])) . "\n";
                $tg_msg .= "🔥 <i>Vui lòng xử lý dứt điểm và cập nhật trạng thái gấp.</i>";
                
                // Nhắn Telegram riêng cho nhân viên phụ trách
                if (!empty($task['ctelegram_chat_id'])) {
                    if (send_telegram_core($task['ctelegram_chat_id'], $tg_msg)) {
                        $arr_sent_tele_ids[] = $task['ctelegram_chat_id'];
                    }
                }
                
                // Nhắn Telegram vào nhóm Admin điều hành
                if (!empty($admin_group_id)) {
                    if (send_telegram_core($admin_group_id, $tg_msg)) {
                        $arr_sent_tele_ids[] = $admin_group_id;
                    }
                }

                // Cập nhật cờ đánh dấu đã gửi nhắc nhở thành công vào DB
                $this->db->where('nid', $task['nid']);
                $this->db->update('ttask', array('nis_mail_sent_duedate' => 1));
            }
        }

        // Tách lọc lấy danh sách ID Telegram duy nhất không bị lặp
        $arr_sent_tele_ids = array_unique($arr_sent_tele_ids);
        $str_sent_tele = !empty($arr_sent_tele_ids) ? implode(', ', $arr_sent_tele_ids) : 'Không có';

        echo "Cronjob nhắc việc (Cấu hình: " . $remind_before_minutes . " phút) đã thực thi qua Mailjet lúc: " . date('Y-m-d H:i:s') . " | Các ID Tele đã gửi: " . $str_sent_tele;
    }

	private function send_mail_core($to_email, $subject, $message)
	{
		return send_mail_mailjet($to_email, $subject, $message);
	}
	
	/*
    private function send_mail_core($to_email, $subject, $message)
    {
        $this->load->library('email');
        $config = array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'system-noreply@picosaigon.vn', 
            'smtp_pass' => 'xxxxxxxxx', 
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        );
        $this->email->initialize($config);
        $this->email->from('system-noreply@picosaigon.vn', 'Hệ Thống Nhắc Việc PICO');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        
        return $this->email->send();
    }
	*/
}