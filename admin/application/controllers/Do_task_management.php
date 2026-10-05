<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System - Task Detail Processing Controller.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */    
   
class Do_task_management extends CI_Controller  
{
    var $m_language          = ''; 
    var $m_nid_user_login    = ''; 

    var $m_nid               = ''; 
    var $m_event             = ''; 
    var $m_button_click      = ''; 
	
    var $m_link_page         = ''; 
    var $m_link_cancel       = ''; 

    // Các biến tiếp nhận Form nhập liệu
    var $m_txt_ctitle        = '';
    var $m_txt_cdescription  = '';
    var $m_cbo_nid_assignee  = 0;
    var $m_txt_ddue_date     = '';
    var $m_txt_nstatus       = 0;

    var $m_error_msg         = ''; 
    var $m_form_title        = '';

    function __construct()
    { 
        parent::__construct();
        session_start();
        
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));
        $this->config->check_system_login = '1';
		
		if (!check_staff_permission(array('admin'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }

    function f_add()
    {
        $this->m_event = 'add';
        $this->do_process();
    }

    function f_edit($nid)
    {
        $this->m_event = 'edit';
        $this->m_nid   = $nid;		 	
        $this->do_process();			
    }

    function f_update_add()
    {
        $this->m_event = 'update_add';
        $this->do_process();
    }

    function f_update_edit()
    {	
        $this->m_event = 'update_edit';		
        $this->do_process();
    }
	
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
    }

    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');
		
        if (isset($_POST['txt_ctitle'])) {
            $this->m_txt_ctitle       = trim($_POST['txt_ctitle']);
            $this->m_txt_cdescription = trim($_POST['txt_cdescription']);
            $this->m_cbo_nid_assignee = (int)$_POST['cbo_nid_assignee'];
            $this->m_txt_ddue_date    = trim($_POST['txt_ddue_date']);
            $this->m_txt_nstatus      = (int)$_POST['txt_nstatus'];
        }
		
        if (isset($_POST['hidden_nid']))    $this->m_nid          = $_POST['hidden_nid'];
        if (isset($_POST['hidden_event']))  $this->m_event        = $_POST['hidden_event'];
        if (isset($_POST['hidden_button'])) $this->m_button_click = $_POST['hidden_button'];
    }
		
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_task_management_listview';		
		
        switch ($this->m_event)
        {
            case 'add':
                $this->m_form_title = 'KHỞI TẠO & GIAO CÔNG VIỆC MỚI CHO NHÂN VIÊN';
                $this->m_link_page  = base_url() . 'index.php/do_task_management/f_update_add';
                $this->m_txt_nstatus = 0;
                $this->m_event       = 'update_add';
                break;

            case 'update_add':
                $this->m_form_title = 'KHỞI TẠO & GIAO CÔNG VIỆC MỚI CHO NHÂN VIÊN';
                $this->m_link_page  = base_url() . 'index.php/do_task_management/f_update_add';
                
                if ($this->m_button_click == 'btn_submit') {
                    if ($this->insert_data() == TRUE) redirect('do_task_management_listview');
                }
                break;

            case 'edit':	
                $this->m_form_title = 'CHỈNH SỬA VÀ THAY ĐỔI TIẾN ĐỘ CÔNG VIỆC';
                $this->m_link_page  = base_url() . 'index.php/do_task_management/f_update_edit';	

                $task = get_task_byid($this->m_nid);
                if (empty($task)) redirect('do_task_management_listview');

                $this->m_txt_ctitle       = $task['ctitle'];
                $this->m_txt_cdescription = $task['cdescription'];
                $this->m_cbo_nid_assignee = $task['nid_assignee'];
                $this->m_txt_ddue_date    = $task['ddue_date'];
                $this->m_txt_nstatus      = $task['nstatus'];
                
                $this->m_event            = 'update_edit';
                break;

            case 'update_edit':
                $this->m_form_title = 'CHỈNH SỬA VÀ THAY ĐỔI TIẾN ĐỘ CÔNG VIỆC';
                $this->m_link_page  = base_url() . 'index.php/do_task_management/f_update_edit';
                
                if ($this->m_button_click == 'btn_submit') {
                    if ($this->update_data() == TRUE) redirect('do_task_management_listview');
                }
                break;
        }		
    }

    private function do_business()
    {					
        $data['event']              = $this->m_event;
        $data['lbl_form_title']     = $this->m_form_title;
		
        $data['link_page']          = $this->m_link_page;
        $data['link_cancel']        = $this->m_link_cancel;		
        $data['m_message']          = $this->m_error_msg;

        $data['txt_ctitle']         = $this->m_txt_ctitle;
        $data['txt_cdescription']   = $this->m_txt_cdescription;
        $data['cbo_nid_assignee']   = $this->m_cbo_nid_assignee;
        $data['txt_ddue_date']      = $this->m_txt_ddue_date;
        $data['txt_nstatus']        = $this->m_txt_nstatus;

        // Bốc danh sách nhân viên đổ vào ô select dropdown gán việc
        $data['staffs']             = get_staff_list();

        // Xây dựng Combobox chọn nhanh trạng thái công việc
        $str_cbo = '<select name="txt_nstatus" class="form-control" style="width:100%">';
        $str_cbo .= '<option value="0" '.($this->m_txt_nstatus == 0 ? "selected":"").'>0 — Chưa tiến hành (Pending)</option>';
        $str_cbo .= '<option value="1" '.($this->m_txt_nstatus == 1 ? "selected":"").'>1 — Đang làm (Active)</option>';
        $str_cbo .= '<option value="2" '.($this->m_txt_nstatus == 2 ? "selected":"").'>2 — Đã hoàn thành (Completed)</option>';
        $str_cbo .= '</select>';
        $data['gen_cbo_status']     = $str_cbo;
		
        $data['nid']                = $this->m_nid;
        $data['menu_active']        = 'task_list';

        $this->load->view('task_management_view/index.php', $data);
    }

    private function insert_data()
    {
        if ($this->m_txt_ctitle == '' || $this->m_cbo_nid_assignee == 0 || $this->m_txt_ddue_date == '') {
            $this->m_error_msg = 'Vui lòng điền đầy đủ tiêu đề, nhân sự và ngày hết hạn!';
            return FALSE;
        }

        $data_insert = array(
            'ctitle'                => $this->m_txt_ctitle,
            'cdescription'          => $this->m_txt_cdescription,
            'nid_assignee'          => $this->m_cbo_nid_assignee,
            'ddue_date'             => $this->m_txt_ddue_date,
            'nstatus'               => $this->m_txt_nstatus,
            'nis_mail_sent_1day'    => 0,
            'nis_mail_sent_duedate' => 0,
            'dcreated_at'           => date('Y-m-d H:i:s')
        );

        return $this->db->insert(Fget_ap_table('ttask'), $data_insert);
    }

    private function update_data()
    {
        if ($this->m_txt_ctitle == '' || $this->m_cbo_nid_assignee == 0 || $this->m_txt_ddue_date == '') {
            $this->m_error_msg = 'Vui lòng điền đầy đủ tiêu đề, nhân sự và ngày hết hạn!';
            return FALSE;
        }

        $data_update = array(
            'ctitle'       => $this->m_txt_ctitle,
            'cdescription' => $this->m_txt_cdescription,
            'nid_assignee' => $this->m_cbo_nid_assignee,
            'ddue_date'    => $this->m_txt_ddue_date,
            'nstatus'      => $this->m_txt_nstatus
        );
        
        // Nếu chuyển sang trạng thái đã xong (2), tự động reset cờ gửi mail nếu cần thiết
        if ($this->m_txt_nstatus == 2) {
            $data_update['nis_mail_sent_1day']    = 1;
            $data_update['nis_mail_sent_duedate'] = 1;
        }

        $this->db->where('nid', $this->m_nid);
        return $this->db->update(Fget_ap_table('ttask'), $data_update);
    }
}