<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON CMS - Task Reminder System (Refactored & Clean).
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Do_task extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');	
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_object');

        // Đồng bộ biến cấu hình chặn login bắt buộc của CMS
        $this->config->check_system_login = '1';
    }

    // 1. Nhắc việc nội bộ trực quan khi nhân viên đăng nhập CMS
    function index()
    {
        // ĐÃ ĐỔI: Kiểm tra session nhân sự quản trị hệ thống CMS
        if (!isset($_SESSION['session_nid_user'])) {
            redirect(base_url() . 'index.php/do_login');
        }

        $nid_staff    = (int)$_SESSION['session_nid_user'];
        $current_date = date('Y-m-d');

        // Gọi hàm chuyên biệt đã tách từ helper sạch sẽ
        $data['tasks'] = get_staff_active_tasks($nid_staff, $current_date);
        $data['title'] = "Hệ thống nhắc việc nội bộ PICO Saigon";
		$data['menu_active'] = "do_task";
		
        $this->load->view('task_view/index.php', $data);
    }

    // 2. Kích hoạt gửi Email cảnh báo đếm ngược thời gian
    function cron_remind_email()
    {
        $current_date  = date('Y-m-d');
        $tomorrow_date = date('Y-m-d', strtotime('+1 day'));

        // --- KỊCH BẢN 1: CẢNH BÁO TRƯỚC 1 NGÀY ---
        $tasks_1day = get_tasks_remind_1day($tomorrow_date);
        foreach ($tasks_1day as $task) {
            $subject = "[PICO SAIGON] Nhắc việc: Công việc sắp hết hạn vào ngày mai!";
            $message = "Chào " . $task['cfullname'] . ",<br><br>Hệ thống nhắc việc thông báo công việc: <strong>" . $task['ctitle'] . "</strong> sắp hết hạn vào ngày mai (" . $task['ddue_date'] . "). Vui lòng kiểm tra và hoàn thành đúng hạn.<br>Trân trọng!";
            
            if ($this->send_mail_core($task['cemail'], $subject, $message)) {
                $this->db->where('nid', $task['nid']);
                $this->db->update('picosaigon_ttask', array('nis_mail_sent_1day' => 1));
            }
        }

        // --- KỊCH BẢN 2: CẢNH BÁO ĐÚNG NGÀY HẾT HẠN ---
        $tasks_due = get_tasks_remind_duedate($current_date);
        foreach ($tasks_due as $task) {
            $subject = "[PICO SAIGON] CẢNH BÁO: Công việc của bạn HẾT HẠN HÔM NAY!";
            $message = "Chào " . $task['cfullname'] . ",<br><br><strong>KHẨN CẤP:</strong> Công việc được giao: <strong>" . $task['ctitle'] . "</strong> có lịch hết hạn vào ngày hôm nay (" . $task['ddue_date'] . "). Vui lòng xử lý và cập nhật trạng thái trên CMS gấp.<br>Trân trọng!";
            
            if ($this->send_mail_core($task['cemail'], $subject, $message)) {
                $this->db->where('nid', $task['nid']);
                $this->db->update('picosaigon_ttask', array('nis_mail_sent_duedate' => 1));
            }
        }

        echo "Cronjob nhắc việc đã thực thi thành công vào lúc: " . date('Y-m-d H:i:s');
    }

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
}