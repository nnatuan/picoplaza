<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Do_member_listview extends CI_Controller
{ 	 
    var $m_nid_user_login   = ''; 
    var $m_link_page        = ''; 
    var $m_event            = 'view'; 
    var $m_where_clause     = ''; 
    
    var $m_total_row        = 0;  
    var $m_total_page       = 0;  
    var $m_current_page     = 1; 			
    var $m_row_per_page     = 10;  
    
    // Bộ lọc tìm kiếm
    var $m_txtf_cusername   = ''; 
    var $m_txtf_cfullname   = ''; 
    var $m_txtf_cemail      = ''; 
    var $m_txtf_cphone      = ''; 

    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();	
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));	
        $this->config->check_system_login = '1'; 	
        $this->m_link_page = base_url() . 'index.php/do_member_listview/';
		
		if (!check_staff_permission('admin')) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }	
    
    private function f_set_cookie($cookie_name, $cookie_value) { 
        return dbset_cookie('cookie_member_listview_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name) { 
        return dbget_cookie('cookie_member_listview_' . $cookie_name);
    }				
    
    function index() {				
        $this->do_process();
    }    
            
    function do_process() {
        $this->get_data(); 		
        $this->caculate_data(); 		
        $this->do_business(); 		
    } 

    private function get_data()
    {        
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        
        if (isset($_POST['hidden_button'])) { 
            $hidden_button = $_POST['hidden_button'];
            switch ($hidden_button) {
                case "btn_filter":
                    $this->m_txtf_cusername = isset($_POST['txtf_cusername']) ? trim($_POST['txtf_cusername']) : '';
                    $this->m_txtf_cfullname = isset($_POST['txtf_cfullname']) ? trim($_POST['txtf_cfullname']) : '';
                    $this->m_txtf_cemail    = isset($_POST['txtf_cemail']) ? trim($_POST['txtf_cemail']) : '';
                    $this->m_txtf_cphone    = isset($_POST['txtf_cphone']) ? trim($_POST['txtf_cphone']) : '';
                    
                    $this->f_set_cookie('m_txtf_cusername', $this->m_txtf_cusername);
                    $this->f_set_cookie('m_txtf_cfullname', $this->m_txtf_cfullname);
                    $this->f_set_cookie('m_txtf_cemail', $this->m_txtf_cemail);
                    $this->f_set_cookie('m_txtf_cphone', $this->m_txtf_cphone);
                    $this->m_current_page = 1;
                    break;			
    
                case "btn_row_per_page":
                    if (isset($_POST['txt_row_per_page'])) $this->m_row_per_page = (int)$_POST['txt_row_per_page'];
                    break;
                    
                case "btn_page_number":
                    if (isset($_POST['txt_current_page'])) $this->m_current_page = (int)$_POST['txt_current_page'];
                    break;	
                
                case "btn_next":
                    $this->m_current_page = (int)$_POST['txt_current_page'] + 1;
                    break;	
                
                case "btn_previous":
                    $this->m_current_page = (int)$_POST['txt_current_page'] - 1;
                    break;	
                
                case "btn_add":
                    redirect(base_url() . 'index.php/do_member/f_add');
                    break;
            }
        }
    } 
    
    private function caculate_data()
    {	   
        $this->m_txtf_cusername = $this->f_get_cookie('m_txtf_cusername');
        $this->m_txtf_cfullname = $this->f_get_cookie('m_txtf_cfullname');
        $this->m_txtf_cemail    = $this->f_get_cookie('m_txtf_cemail');
        $this->m_txtf_cphone    = $this->f_get_cookie('m_txtf_cphone');
        
        $str_result = ' WHERE cdel = "0" ';
        
        if ($this->m_txtf_cusername != '')
            $str_result .= ' AND cusername like "%' . $this->db->escape_like_str($this->m_txtf_cusername) . '%" ';
        if ($this->m_txtf_cfullname != '')
            $str_result .= ' AND cfullname like "%' . $this->db->escape_like_str($this->m_txtf_cfullname) . '%" ';
        if ($this->m_txtf_cemail != '')
            $str_result .= ' AND cemail like "%' . $this->db->escape_like_str($this->m_txtf_cemail) . '%" ';
        if ($this->m_txtf_cphone != '')
            $str_result .= ' AND cphone like "%' . $this->db->escape_like_str($this->m_txtf_cphone) . '%" ';
            
        $this->m_where_clause = $str_result;	
        
        $this->m_total_row = Obj_get_member_count($this->m_where_clause);		
        
        if ($this->m_row_per_page <= 0) $this->m_row_per_page = 10;			
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
        
        if ($this->m_current_page <= 0) $this->m_current_page = 1;		
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
        
        $n_start_row = ($this->m_current_page - 1) * $this->m_row_per_page;
        if($n_start_row < 0) $n_start_row = 0;

        $this->m_obj_data_view = Obj_get_member_pagination($this->m_where_clause, $n_start_row, $this->m_row_per_page);
    }
       
    private function do_business()
    {	
        $data['lbl_form_title']     = "Quản lý Tài khoản Khách hàng";
        $data['link_page']          = $this->m_link_page;
        $data['btn_choose']         = "Chọn";
        $data['lbl_rows_per_page']  = "Số dòng hiển thị";
        
        $data['txt_row_per_page']   = $this->m_row_per_page;
        $data['txt_current_page']   = $this->m_current_page;
        $data['txt_total_page']     = $this->m_total_page;			              
        
        $data['txtf_cusername']   = $this->m_txtf_cusername; 
        $data['txtf_cfullname']   = $this->m_txtf_cfullname;
        $data['txtf_cemail']      = $this->m_txtf_cemail; 
        $data['txtf_cphone']      = $this->m_txtf_cphone; 
		
        $data['menu_active']      = 'member';
        $data['data_view']        = $this->m_obj_data_view; 
        $data['event']            = $this->m_event; 

        $this->load->view('member_view/index.php', $data);
    }
    
    function f_delete($nid) {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');

        $data_delete = array(
            'cdel'        => '1',
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('nid', (int)$nid)->update('tmember', $data_delete);

        redirect('do_member_listview');
    }
}