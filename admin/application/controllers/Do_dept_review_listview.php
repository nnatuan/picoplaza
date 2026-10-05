<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Cổng Thẩm Định Phòng Ban (Listview)
 * =================================================================
 */

class Do_dept_review_listview extends CI_Controller
{
    var $m_nid_user_login   = ''; 
    var $m_link_page        = ''; 
    
    var $m_total_row        = 0;  
    var $m_total_page       = 0;  
    var $m_current_page     = 1; 			
    var $m_row_per_page     = 15;  
    
    // Bộ lọc tìm kiếm
    var $m_dept_id          = 0; 
    var $m_step_status      = ''; 
    var $m_filter_keyword   = ''; 
    var $m_permission       = ''; 

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

        $this->m_link_page = base_url() . 'index.php/do_dept_review_listview';
    }

    private function f_set_cookie($cookie_name, $cookie_value) { 
        return dbset_cookie('cookie_dept_review_listview_' . $cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name) { 
        return dbget_cookie('cookie_dept_review_listview_' . $cookie_name);
    }

    function index()
    {
        $this->do_process();
    }

    function do_process()
    {
        $this->get_data();
        $this->calculate_data();
        $this->do_business();
    }

    private function get_data()
    {
        $this->m_nid_user_login = (int)Fget_userdata('session_nid_user');
        if ($this->m_nid_user_login <= 0 && isset($_SESSION['session_nid_user'])) {
            $this->m_nid_user_login = (int)$_SESSION['session_nid_user'];
        }

        // Khởi tạo mặc định phòng ban của user nếu chưa có cookie
        $user_dept = 0;
        if ($this->m_nid_user_login > 0) {
            $user_row = $this->db->where('nid', $this->m_nid_user_login)->get(Fget_ap_table('tuser'))->row_array();
            if (!empty($user_row) && isset($user_row['nid_dept'])) {
                $user_dept = (int)$user_row['nid_dept'];
            }
        }

        // Đọc từ cookie trước
        $cookie_dept = $this->f_get_cookie('m_dept_id');
        if ($cookie_dept !== false && $cookie_dept !== null && $cookie_dept !== '') {
            $this->m_dept_id = (int)$cookie_dept;
        } elseif ($user_dept > 0) {
            $this->m_dept_id = $user_dept;
        }

        $cookie_status = $this->f_get_cookie('m_step_status');
        if ($cookie_status !== false && $cookie_status !== null) {
            $this->m_step_status = (string)$cookie_status;
        }

        $cookie_keyword = $this->f_get_cookie('m_filter_keyword');
        if ($cookie_keyword !== false && $cookie_keyword !== null) {
            $this->m_filter_keyword = (string)$cookie_keyword;
        }

        // Hỗ trợ GET parameter nếu có truyền trực tiếp từ URL
        if ($this->input->get('dept_id') !== null) {
            $this->m_dept_id = (int)$this->input->get('dept_id');
            $this->f_set_cookie('m_dept_id', $this->m_dept_id);
        }
        if ($this->input->get('step_status') !== null) {
            $this->m_step_status = trim($this->input->get('step_status'));
            $this->f_set_cookie('m_step_status', $this->m_step_status);
        }
        if ($this->input->get('permission') !== null) {
            $this->m_permission = trim($this->input->get('permission'));
        }

        if (isset($_POST['hidden_button'])) {
            $hidden_button = $_POST['hidden_button'];
            switch ($hidden_button) {
                case "btn_filter":
                    $this->m_dept_id        = isset($_POST['cbof_dept_id']) ? (int)$_POST['cbof_dept_id'] : 0;
                    $this->m_step_status    = isset($_POST['cbof_step_status']) ? trim($_POST['cbof_step_status']) : '';
                    $this->m_filter_keyword = isset($_POST['txtf_keyword']) ? trim($_POST['txtf_keyword']) : '';
                    
                    $this->f_set_cookie('m_dept_id', $this->m_dept_id);
                    $this->f_set_cookie('m_step_status', $this->m_step_status);
                    $this->f_set_cookie('m_filter_keyword', $this->m_filter_keyword);
                    $this->m_current_page = 1;
                    break;

                case "btn_row_per_page":
                    if (isset($_POST['txt_row_per_page'])) {
                        $this->m_row_per_page = (int)$_POST['txt_row_per_page'];
                    }
                    break;

                case "btn_page_number":
                    if (isset($_POST['txt_current_page'])) {
                        $this->m_current_page = (int)$_POST['txt_current_page'];
                    }
                    break;

                case "btn_next":
                    $this->m_current_page = (int)$_POST['txt_current_page'] + 1;
                    break;

                case "btn_previous":
                    $this->m_current_page = (int)$_POST['txt_current_page'] - 1;
                    break;
            }
        }
    }

    private function calculate_data()
    {
        $this->m_total_row = get_dept_review_count(
            $this->m_dept_id,
            $this->m_step_status,
            $this->m_permission,
            $this->m_filter_keyword
        );

        if ($this->m_row_per_page <= 0) $this->m_row_per_page = 15;
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);

        if ($this->m_current_page <= 0) $this->m_current_page = 1;
        if ($this->m_total_page > 0 && $this->m_current_page > $this->m_total_page) {
            $this->m_current_page = $this->m_total_page;
        }

        $n_start_row = ($this->m_current_page - 1) * $this->m_row_per_page;
        if ($n_start_row < 0) $n_start_row = 0;

        $this->m_data_view = get_dept_review_list(
            $this->m_dept_id,
            $this->m_step_status,
            $this->m_permission,
            $n_start_row,
            $this->m_row_per_page,
            $this->m_filter_keyword
        );
    }

    private function do_business()
    {
        $data['lbl_form_title']     = ($this->m_permission === 'VIEW') ? 'DANH SÁCH HỒ SƠ CHỈ XEM (THEO DÕI TIẾN ĐỘ)' : 'CỔNG TIẾP NHẬN & THẨM ĐỊNH HỒ SƠ PHÒNG BAN';
        $data['page_title']         = $data['lbl_form_title'];
        $data['link_page']          = $this->m_link_page;
        $data['btn_choose']         = "Chọn";
        $data['lbl_rows_per_page']  = "Số dòng hiển thị";

        $data['txt_row_per_page']   = $this->m_row_per_page;
        $data['txt_current_page']   = $this->m_current_page;
        $data['txt_total_page']     = $this->m_total_page;
        $data['total_row']          = $this->m_total_row;

        $data['departments']        = get_all_departments();
        $data['selected_dept']      = $this->m_dept_id;
        $data['cbof_dept_id']       = $this->m_dept_id;
        $data['filter_status']      = $this->m_step_status;
        $data['cbof_step_status']   = $this->m_step_status;
        $data['txtf_keyword']       = $this->m_filter_keyword;
        $data['filter_permission']  = $this->m_permission;
        $data['is_view_only_mode']  = ($this->m_permission === 'VIEW');
        $data['menu_active']        = ($this->m_permission === 'VIEW') ? 'dept_view' : 'dept_review';
        $data['list']               = $this->m_data_view;
        $data['data_view']          = $this->m_data_view;

        $this->load->view('do_dept_review/list', $data);
    }
}
