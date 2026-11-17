<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System - Task Listview Controller.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */   
        
class Do_task_management_listview extends CI_Controller
{    
    var $m_nid_user_login   = ''; 
    var $m_link_page        = ''; 
    var $m_event            = ''; 
         
    var $m_where_clause     = ''; 
    var $m_orderby_clause   = ''; 
    var $m_orderby_sort     = ''; 
    var $m_sort_img         = ''; 
            
    var $m_total_row        = 0;  
    var $m_total_page       = 0;  
        
    var $m_current_page     = 0;  
    var $m_row_per_page     = 0; 
    
    // Bộ lọc Tìm kiếm công việc
    var $m_txtf_ctitle      = '';
    var $m_txtf_nstatus     = '';
    
    var $m_obj_data_view    = array();

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

    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_task_listview_' . $cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_task_listview_' . $cookie_name);
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
        if (isset($_POST['hidden_orderby_clause'])) {
            $this->m_orderby_clause = trim($_POST['hidden_orderby_clause']);
            $this->m_orderby_sort   = trim($_POST['hidden_orderby_sort']);
        }

        if ($this->m_event == 'btn_search') {
            $this->m_txtf_ctitle  = trim($_POST['txtf_ctitle']);
            $this->m_txtf_nstatus = trim($_POST['txtf_nstatus']);

            $this->f_set_cookie('txtf_ctitle', $this->m_txtf_ctitle);
            $this->f_set_cookie('txtf_nstatus', $this->m_txtf_nstatus);
            $this->m_current_page = 1;
        }
        
        if ($this->m_event == 'btn_refresh') {
            $this->f_set_cookie('txtf_ctitle', '');
            $this->f_set_cookie('txtf_nstatus', '');
            $this->m_current_page = 1;
        }
    }

    private function caculate_data()
    {       
        $this->m_link_page = base_url() . 'index.php/do_task_management_listview/';

        if ($this->m_event == 'btn_next') $this->m_current_page++;
        if ($this->m_event == 'btn_back') $this->m_current_page--;

        // Xử lý nút xóa công việc hàng loạt hoặc đơn lẻ
        if ($this->m_event == 'btn_delete' && isset($_POST['hidden_nid'])) {
            $nid_del = (int)$_POST['hidden_nid'];
            $this->db->delete(Fget_ap_table('ttask'), array('nid' => $nid_del));
            $this->m_event = 'view';
        }

        if (trim($this->m_orderby_clause) == '') {
            $this->m_orderby_clause = $this->f_get_cookie('m_orderby_clause');
            $this->m_orderby_sort   = $this->f_get_cookie('m_orderby_sort');
        }
        
        if (trim($this->m_orderby_clause) == '') {
            $this->m_orderby_clause = 't.nid';
            $this->m_orderby_sort   = 'desc';           
        }
        
        $this->f_set_cookie('m_orderby_clause', $this->m_orderby_clause);
        $this->f_set_cookie('m_orderby_sort', $this->m_orderby_sort);       
    
        $this->m_txtf_ctitle  = $this->f_get_cookie('txtf_ctitle');
        $this->m_txtf_nstatus = $this->f_get_cookie('txtf_nstatus');
        
        $this->m_where_clause = $this->get_where_string();  
        $this->m_total_row    = get_task_count_listview($this->m_where_clause);     
        
        if ($this->m_row_per_page <= 0)
            $this->m_row_per_page = Fget_userdata('session_user_row_per_page');         
        else
            Fset_userdata('session_user_row_per_page', $this->m_row_per_page);          
    
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
        
        if ($this->m_current_page <= 0)
            $this->m_current_page = dbget_cookie('cookie_task_listview_txt_current_page');
            
        if ($this->m_current_page <= 0) $this->m_current_page = 1;      
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
        
        dbset_cookie('cookie_task_listview_txt_current_page', $this->m_current_page);   
        
        $this->m_obj_data_view = get_task_listview(
            $this->m_where_clause,
            $this->m_orderby_clause.' '.$this->m_orderby_sort, 
            $this->m_row_per_page, 
            $this->m_current_page, 
            $this->m_total_row
        );
    
        if (trim($this->m_orderby_sort) == 'asc' || trim($this->m_orderby_sort) == '')
            $this->m_orderby_sort = 'desc';         
        else
            $this->m_orderby_sort = 'asc';
        
        $this->m_sort_img = Fget_image_sort($this->m_orderby_sort);
        if($this->m_event == '') $this->m_event = 'view';       
    }

    private function get_where_string()
    {
        $str_result = ' WHERE t.nid IS NOT NULL ';
        if ($this->m_txtf_ctitle != '') {
            $str_result .= ' AND t.ctitle LIKE "%' . $this->db->escape_like_str($this->m_txtf_ctitle) . '%" ';
        }
        if ($this->m_txtf_nstatus != '') {
            $str_result .= ' AND t.nstatus = ' . (int)$this->m_txtf_nstatus . ' ';
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

        $data['orderby_sort']       = $this->m_orderby_sort;
        $data['sort_img']           = $this->m_sort_img;

        $data['txtf_ctitle']        = $this->m_txtf_ctitle;
        $data['txtf_nstatus']       = $this->m_txtf_nstatus;
        $data['obj_listview']       = $this->m_obj_data_view;

        $data['btn_choose']         = 'Chọn trang';
        $data['menu_active']        = 'task_list';

        $this->load->view('task_management_view/index', $data);
    }

    private function destroy_data() {}
}