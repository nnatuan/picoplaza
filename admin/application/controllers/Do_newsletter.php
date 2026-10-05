<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class do_newsletter extends CI_Controller
{    
    var $m_nid_user_login   = ''; 
    var $m_link_page        = ''; 
    var $m_event            = ''; 
         
    var $m_where_clause     = ''; 
    var $m_total_row        = 0;  
    var $m_total_page       = 0;  
        
    var $m_current_page     = 0;  
    var $m_row_per_page     = 10; 
    
    var $m_txtf_cemail      = '';
    var $m_txtf_nstatus     = '';
    
    var $m_obj_data_view    = array();
    var $m_error_msg        = '';

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();

        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));
        
        $this->config->check_system_login = '1';  
		
		if (!check_staff_permission(array('admin', 'mail_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }

    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_newsletter_' . $cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_newsletter_' . $cookie_name);
    }

    function index() { $this->do_process(); }

    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }

    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');

        if (isset($_POST['hidden_button'])) {
            $this->m_event = trim($_POST['hidden_button']);
        }

        if (isset($_POST['txt_current_page'])) {
            $this->m_current_page = (int)$_POST['txt_current_page'];
        }

        if (isset($_POST['cbo_row_per_page'])) {
            $this->m_row_per_page = (int)$_POST['cbo_row_per_page'];
        }

        if ($this->m_event == 'btn_search') {
            $this->m_txtf_cemail  = trim($_POST['txtf_cemail']);
            $this->m_txtf_nstatus = trim($_POST['txtf_nstatus']);

            $this->f_set_cookie('txtf_cemail', $this->m_txtf_cemail);
            $this->f_set_cookie('txtf_nstatus', $this->m_txtf_nstatus);
            $this->m_current_page = 1;
        }
        
        if ($this->m_event == 'btn_refresh') {
            $this->f_set_cookie('txtf_cemail', '');
            $this->f_set_cookie('txtf_nstatus', '');
            $this->m_current_page = 1;
        }
    }

    private function caculate_data()
    {       
        $this->m_link_page = base_url() . 'index.php/do_newsletter/';

        if ($this->m_event == 'btn_next') { $this->m_current_page++; }
        if ($this->m_event == 'btn_back') { $this->m_current_page--; }

        if ($this->m_event == 'btn_send_bulk_email') {
			$email_subject = trim($_POST['txt_email_subject']);
			$email_content = trim($_POST['txt_email_content']);
			
			$arr_selected_nids = isset($_POST['chk_email_id']) ? $_POST['chk_email_id'] : array();

			if ($email_subject == '' || $email_content == '') {
				$this->m_error_msg = 'Vui lòng nhập đầy đủ tiêu đề và nội dung bản tin!';
			} 
			elseif (empty($arr_selected_nids)) {
				$this->m_error_msg = 'Vui lòng tích chọn ít nhất một thành viên để gửi!';
			} 
			else {
				$clean_nids = array_map('intval', $arr_selected_nids);
				$str_in_clause = implode(',', $clean_nids);

				// Truy vấn lấy danh sách thành viên được chọn
				$str_emails = ' SELECT cemail, cfullname FROM ' . Fget_ap_table('tmember') . ' WHERE nstatus = 1 AND cemail != "" AND nid IN (' . $str_in_clause . ') ';
				$list_emails = $this->db->query($str_emails)->result_array();

				if (!empty($list_emails)) {
					// ĐÃ BỎ FOREACH: Gọi send_mail_mailjet ĐÚNG 1 LẦN duy nhất
					$res = send_mail_mailjet($list_emails, $email_subject, $email_content);

					if ($res) {
						$this->m_error_msg = 'Hệ thống đã gửi thành công bản tin đến toàn bộ ' . count($list_emails) . ' thành viên được chọn!';
					} else {
						$this->m_error_msg = 'Có lỗi xảy ra trong quá trình kết nối Mailjet API!';
					}
				} else {
					$this->m_error_msg = 'Không tìm thấy địa chỉ email hợp lệ trong nhóm được chọn.';
				}
			}
			$this->m_event = 'view';
		}

        $this->m_txtf_cemail  = $this->f_get_cookie('txtf_cemail');
        $this->m_txtf_nstatus = $this->f_get_cookie('txtf_nstatus');
        
        $this->m_where_clause = $this->get_where_string();  
        $this->m_total_row    = get_newsletter_member_count($this->m_where_clause);     
        
        if ($this->m_row_per_page <= 0) {
            $this->m_row_per_page = Fget_userdata('session_user_row_per_page');         
        } else {
            Fset_userdata('session_user_row_per_page', $this->m_row_per_page);          
        }
    
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
        
        if ($this->m_current_page <= 0) {
            $this->m_current_page = dbget_cookie('cookie_newsletter_txt_current_page');
        }
            
        if ($this->m_current_page <= 0) $this->m_current_page = 1;      
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
        
		if ($this->m_total_page <= 0) $this->m_total_page = 1;
        if ($this->m_current_page <= 0) $this->m_current_page = 1;
		
        dbset_cookie('cookie_newsletter_txt_current_page', $this->m_current_page);   
        
        $start_row = ($this->m_current_page - 1) * $this->m_row_per_page;
        $this->m_obj_data_view = get_newsletter_member_pagination($this->m_where_clause, $start_row, $this->m_row_per_page);
    
        if($this->m_event == '') $this->m_event = 'view';       
    }

    private function get_where_string()
    {
        $str_result = ' WHERE nid IS NOT NULL AND cemail != "" ';
        if ($this->m_txtf_cemail != '') {
            $str_result .= ' AND (cemail LIKE "%' . $this->db->escape_like_str($this->m_txtf_cemail) . '%" OR cfullname LIKE "%' . $this->db->escape_like_str($this->m_txtf_cemail) . '%" OR cphone LIKE "%' . $this->db->escape_like_str($this->m_txtf_cemail) . '%") ';
        }
        if ($this->m_txtf_nstatus != '') {
            $str_result .= ' AND nstatus = ' . (int)$this->m_txtf_nstatus . ' ';
        }
        return $str_result;
    }

    private function do_business()
    {
        $data['link_page']          = $this->m_link_page;
        $data['event']              = 'view';
        
        $data['txt_total_row']      = $this->m_total_row;
        $data['txt_total_page']     = $this->m_total_page;
        $data['txt_current_page']   = $this->m_current_page;

        $data['txtf_cemail']        = $this->m_txtf_cemail;
        $data['txtf_nstatus']       = $this->m_txtf_nstatus;
        $data['obj_listview']       = $this->m_obj_data_view;

        $data['btn_choose']         = 'Chọn trang';

        $data['m_message']          = $this->m_error_msg;
        $data['menu_active']        = 'newsletter_list';
		$data['fr_img']             = Fstr_replace('admin/','',base_url());
        $this->load->view('newsletter_view/index', $data);
    }

    private function destroy_data() {}
}