<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class do_ticket extends CI_Controller  
{
    var $m_language          = ''; 
    var $m_nid_user_login    = ''; 

    var $m_nid               = ''; 
    var $m_event             = ''; 
    var $m_button_click      = ''; 
	
    var $m_link_page         = ''; 
    var $m_link_cancel       = ''; 

    var $m_txt_content_reply = ''; 
    var $m_txt_nstatus       = ''; 

    var $m_error_msg         = ''; 

    function __construct()
    { 
        parent::__construct();
        session_start();
        
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));
			
        $this->config->check_system_login = '1';
        $this->load->model('ticket_model');
		
        if (!check_staff_permission(array('admin', 'ticket_mgr'))) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function f_edit($nid)
    {
        $this->m_event = 'edit';
        $this->m_nid   = $nid;		 	
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
		
        if (isset($_POST['txt_nstatus']))
        {
            $this->m_txt_nstatus       = trim($_POST['txt_nstatus']);
            $this->m_txt_content_reply = trim($_POST['txt_content_reply']);
        }
		
        if (isset($_POST['hidden_nid']))
            $this->m_nid            = $_POST['hidden_nid'];
		
        if (isset($_POST['hidden_event']))
            $this->m_event          = $_POST['hidden_event'];
			
        if (isset($_POST['hidden_button']))
            $this->m_button_click   = $_POST['hidden_button'];
    }
		
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_ticket_listview';		
		
        switch ($this->m_event)
        {
            case 'edit':	
                $this->m_form_title = 'XỬ LÝ CHI TIẾT & PHẢN HỒI TICKET CỦA KHÁCH HÀNG';
                $this->m_link_page  = base_url() . 'index.php/do_ticket/f_update_edit';	

                $ticket = $this->ticket_model->get_byid($this->m_nid);
                if (empty($ticket)) {
                    redirect('do_ticket_listview');
                }

                $this->m_txt_nstatus = $ticket['nstatus'];
                $this->m_event       = 'update_edit';
                break;

            case 'update_edit':
                $this->m_form_title = 'XỬ LÝ CHI TIẾT & PHẢN HỒI TICKET CỦA KHÁCH HÀNG';
                $this->m_link_page  = base_url() . 'index.php/do_ticket/f_update_edit';
                
                if ($this->m_button_click == 'btn_submit')
                {
                    if ($this->update_data() == TRUE)
                        redirect('do_ticket_listview');
                }
                break;
        }		
    }

    private function do_business()
    {					
        $data['event']          = $this->m_event;
        $data['lbl_form_title'] = $this->m_form_title;
		
        $data['link_page']      = $this->m_link_page;
        $data['link_cancel']    = $this->m_link_cancel;		

        $data['btn_update']     = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']     = $this->lang->line('btn.0000.Cancel');
		
        $data['m_message']      = $this->m_error_msg;

        $ticket = $this->ticket_model->get_byid($this->m_nid);
        $data['ticket'] = $ticket;

        // Bốc danh sách logs timeline đã bao gồm tên Nhân viên từ helper
        $data['ticket_logs'] = Fget_ticket_logs($this->m_nid);

        // Combobox trạng thái ticket
        $str_cbo = '<select name="txt_nstatus" class="form-control" style="width:100%">';
        $str_cbo .= '<option value="1" '.($this->m_txt_nstatus == 1 ? "selected":"").'>1 — Mới tiếp nhận (New)</option>';
        $str_cbo .= '<option value="2" '.($this->m_txt_nstatus == 2 ? "selected":"").'>2 — Đang tiến hành xử lý (Active)</option>';
        $str_cbo .= '<option value="3" '.($this->m_txt_nstatus == 3 ? "selected":"").'>3 — Đã giải quyết (Resolved)</option>';
        $str_cbo .= '</select>';
        $data['gen_cbo_status'] = $str_cbo;
		
        $data['nid']            = $this->m_nid;
        $data['menu_active']    = 'ticket_list';

        $this->load->view('ticket_view/index.php', $data);
    }

    private function update_data()
    {
        $current_datetime = date('Y-m-d H:i:s');
        
        $data_ticket = array(
            'nstatus' => $this->m_txt_nstatus
        );
        
        if ($this->m_txt_nstatus == 3) {
            $data_ticket['dresolved_at'] = $current_datetime;
        }
        
        $this->ticket_model->update_bynid($this->m_nid, $data_ticket);

        // Khi nhân viên nhập phản hồi, lưu ID tài khoản đăng nhập hiện tại vào nid_user_reply
        if ($this->m_txt_content_reply != '') {
            $data_log = array(
                'nid_ticket'      => $this->m_nid,
                'cis_staff_reply' => '1',
                'ccontent_reply'  => $this->m_txt_content_reply,
                'nid_user_reply'  => $this->m_nid_user_login, // ID nhân viên trực tiếp ấn nút
                'dreply_at'       => $current_datetime
            );
            Finsert_data_global('tticket_log', $data_log);
        }
        
        if ($this->m_txt_nstatus == 3 && $this->m_txt_content_reply == '') {
            $data_log_system = array(
                'nid_ticket'      => $this->m_nid,
                'cis_staff_reply' => '1',
                'ccontent_reply'  => 'Hệ thống xác nhận sự cố/yêu cầu đã được Ban Quản Trị xử lý dứt điểm hoàn tất.',
                'nid_user_reply'  => $this->m_nid_user_login,
                'dreply_at'       => $current_datetime
            );
            Finsert_data_global('tticket_log', $data_log_system);
        }

        return TRUE;
    }
}