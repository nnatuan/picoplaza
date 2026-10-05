<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System - Ticket Listview Controller.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */   
        
class do_ticket_listview extends CI_Controller
{    
    // Các biến bắt buộc điều hướng hệ thống Core của anh Tuấn
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
    
    // Thuộc tính tiếp nhận ô lọc filter tìm kiếm
    var $m_txtf_cticket_code = '';
    var $m_txtf_cname        = '';
    var $m_txtf_nstatus      = '';
    
    var $m_obj_data_view    = array(); // Chứa mảng dữ liệu trả ra view

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();

        $this->load->helper('ap_db');
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_object');
        
        // Nạp model tticket
        $this->load->model('ticket_model');
		$this->config->check_system_login = '1';  
		
		if (!check_staff_permission(array('admin', 'ticket_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }

    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_ticket_listview_' . $cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_ticket_listview_' . $cookie_name);
    }

    function index()
    {
        $this->do_process();
    }

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

        // Nhận tham số click sort cột tiêu đề
        if (isset($_POST['hidden_orderby_clause'])) {
            $this->m_orderby_clause = trim($_POST['hidden_orderby_clause']);
            $this->m_orderby_sort   = trim($_POST['hidden_orderby_sort']);
        }

        // Đọc các ô lọc filter tìm kiếm khi submit nút tìm kiếm
        if ($this->m_event == 'btn_search') {
            $this->m_txtf_cticket_code = trim($_POST['txtf_cticket_code']);
            $this->m_txtf_cname        = trim($_POST['txtf_cname']);
            $this->m_txtf_nstatus      = trim($_POST['txtf_nstatus']);

            $this->f_set_cookie('txtf_cticket_code', $this->m_txtf_cticket_code);
            $this->f_set_cookie('txtf_cname', $this->m_txtf_cname);
            $this->f_set_cookie('txtf_nstatus', $this->m_txtf_nstatus);
            $this->m_current_page = 1;
        }
        
        // Reset bộ lọc sạch sẽ khi bấm hủy bộ lọc
        if ($this->m_event == 'btn_refresh') {
            $this->f_set_cookie('txtf_cticket_code', '');
            $this->f_set_cookie('txtf_cname', '');
            $this->f_set_cookie('txtf_nstatus', '');
            $this->m_current_page = 1;
        }
    }

    // 2. KHỐI TÍNH TOÁN DỮ LIỆU ĐỒNG BỘ 100% CẤU TRÚC ANH GỬI
    private function caculate_data()
    {       
        $this->m_link_page = base_url() . 'index.php/do_ticket_listview/';

        if ($this->m_event == 'btn_next') { $this->m_current_page++; }
        if ($this->m_event == 'btn_back') { $this->m_current_page--; }

        // Xử lý nút xóa hàng loạt hoặc đơn lẻ
        if ($this->m_event == 'btn_delete' && isset($_POST['hidden_nid'])) {
            $nid_del = (int)$_POST['hidden_nid'];
            $this->db->delete(Fget_ap_table('tticket'), array('nid' => $nid_del));
            $this->db->delete(Fget_ap_table('tticket_log'), array('nid_ticket' => $nid_del));
            $this->m_event = 'view';
        }

        if (trim($this->m_orderby_clause) == '') {
            $this->m_orderby_clause = $this->f_get_cookie('m_orderby_clause');
            $this->m_orderby_sort   = $this->f_get_cookie('m_orderby_sort');
        }
        
        // Mặc định sắp xếp theo Thời gian tạo giảm dần nếu chưa có yêu cầu sort riêng biệt
        if (trim($this->m_orderby_clause) == '') {
            $this->m_orderby_clause = 'dcreated_at';
            $this->m_orderby_sort   = 'desc';           
        }
        
        $this->f_set_cookie('m_orderby_clause', $this->m_orderby_clause);
        $this->f_set_cookie('m_orderby_sort', $this->m_orderby_sort);       
    
        // Lấy lại các giá trị lọc đã lưu từ Cookie
        $this->m_txtf_cticket_code = $this->f_get_cookie('txtf_cticket_code');
        $this->m_txtf_cname        = $this->f_get_cookie('txtf_cname');
        $this->m_txtf_nstatus      = $this->f_get_cookie('txtf_nstatus');
        
        $this->m_where_clause = $this->get_where_string();  
        //exit($this->m_where_clause);
        // Đếm tổng số dòng thỏa mãn điều kiện lọc từ Ticket_model
        $this->m_total_row = $this->ticket_model->get_count_listview($this->m_where_clause);     
        
        if ($this->m_row_per_page <= 0)
            $this->m_row_per_page = Fget_userdata('session_user_row_per_page');         
        else
            Fset_userdata('session_user_row_per_page', $this->m_row_per_page);          
    
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
        
        if ($this->m_current_page <= 0)
            $this->m_current_page = dbget_cookie('cookie_ticket_listview_txt_current_page');
            
        if ($this->m_current_page <= 0) $this->m_current_page = 1;      
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
        
        dbset_cookie('cookie_ticket_listview_txt_current_page', $this->m_current_page);   
        
        $this->m_obj_data_view = $this->ticket_model->get_listview(
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
        $str_result = ' WHERE nid IS NOT NULL AND cdel=0 ';
        if ($this->m_txtf_cticket_code != '') {
            $str_result .= ' AND cticket_code LIKE "%' . $this->db->escape_like_str($this->m_txtf_cticket_code) . '%" ';
        }
        if ($this->m_txtf_cname != '') {
            $str_result .= ' AND cname LIKE "%' . $this->db->escape_like_str($this->m_txtf_cname) . '%" ';
        }
        if ($this->m_txtf_nstatus != '') {
            $str_result .= ' AND nstatus = ' . (int)$this->m_txtf_nstatus . ' ';
        }
        return $str_result;
    }

    private function do_business()
    {
        $data['link_page']          = $this->m_link_page;
        $data['event']              = 'view'; // Giữ luồng nạp ticket_listview trong index.php
        
        $data['txt_total_row']      = $this->m_total_row;
        $data['txt_total_page']     = $this->m_total_page;
        $data['txt_current_page']   = $this->m_current_page;

        // Trả dữ liệu sort cột tiêu đề
        $data['orderby_sort']       = $this->m_orderby_sort;
        $data['sort_img']           = $this->m_sort_img;

        // Binding dữ liệu các ô lọc tìm kiếm ngược lại view
        $data['txtf_cticket_code']  = $this->m_txtf_cticket_code;
        $data['txtf_cname']         = $this->m_txtf_cname;
        $data['txtf_nstatus']       = $this->m_txtf_nstatus;

        $data['obj_listview']       = $this->m_obj_data_view;

        $data['btn_choose']         = 'Chọn trang';
        //$data['menu']               = Fget_menu_html($this->m_nid_user_login);
        $data['menu_active']        = 'ticket_list';

        $this->load->view('ticket_view/index', $data);
    }

    private function destroy_data()
    {
    }
	
	function f_delete($nid) {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');

        $data_delete = array(
            'cdel'          => '1',
            'niduser_updated' => $this->m_nid_user_login,
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        $res_delete = $this->db->where('nid', (int)$nid)->update('tticket', $data_delete);

        redirect('do_ticket_listview');
    }
}
/* End of file do_ticket_listview.php */