<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Do_file_listview extends CI_Controller
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
    var $m_txtf_ctitle      = ''; 
    var $m_cbof_ctype       = ''; 
    var $m_cbof_caccess_type = ''; 

    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();	
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object', 'download'));	
        $this->config->check_system_login = '1'; 	
        $this->m_link_page = base_url() . 'index.php/do_file_listview/';
    }	
    
    private function f_set_cookie($cookie_name, $cookie_value) { 
        return dbset_cookie('cookie_file_listview_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name) { 
        return dbget_cookie('cookie_file_listview_' . $cookie_name);
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
                    $this->m_txtf_ctitle       = isset($_POST['txtf_ctitle']) ? trim($_POST['txtf_ctitle']) : '';
                    $this->m_cbof_ctype        = isset($_POST['cbof_ctype']) ? $_POST['cbof_ctype'] : '';
                    $this->m_cbof_caccess_type = isset($_POST['cbof_caccess_type']) ? $_POST['cbof_caccess_type'] : '';
                    
                    $this->f_set_cookie('m_txtf_ctitle', $this->m_txtf_ctitle);
                    $this->f_set_cookie('m_cbof_ctype', $this->m_cbof_ctype);
                    $this->f_set_cookie('m_cbof_caccess_type', $this->m_cbof_caccess_type);
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
                    redirect(base_url() . 'index.php/do_file/f_add');
                    break;

                case "btn_download_zip":
                    $this->f_download_selected_zip();
                    break;
            }
        }
    } 
    
    private function caculate_data()
    {	   
        $this->m_txtf_ctitle       = $this->f_get_cookie('m_txtf_ctitle');
        $this->m_cbof_ctype        = $this->f_get_cookie('m_cbof_ctype');
        $this->m_cbof_caccess_type = $this->f_get_cookie('m_cbof_caccess_type');
        
        $str_result = ' WHERE cdel = "0" ';
        
        if ($this->m_txtf_ctitle != '')
            $str_result .= ' AND ctitle like "%' . $this->db->escape_like_str($this->m_txtf_ctitle) . '%" ';
        if ($this->m_cbof_ctype != '')
            $str_result .= ' AND ctype = "' . $this->db->escape_like_str($this->m_cbof_ctype) . '" ';
        if ($this->m_cbof_caccess_type != '')
            $str_result .= ' AND caccess_type = "' . $this->db->escape_like_str($this->m_cbof_caccess_type) . '" ';
            
        $this->m_where_clause = $str_result;	
        
        $this->m_total_row = Obj_get_file_count($this->m_where_clause);		
        
        if ($this->m_row_per_page <= 0) $this->m_row_per_page = 10;			
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
        
        if ($this->m_current_page <= 0) $this->m_current_page = 1;		
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
        
        $n_start_row = ($this->m_current_page - 1) * $this->m_row_per_page;
        if($n_start_row < 0) $n_start_row = 0;

        $this->m_obj_data_view = Obj_get_file_pagination($this->m_where_clause, $n_start_row, $this->m_row_per_page);
    }
       
    private function do_business()
    {	
        $data['lbl_form_title']     = "Quản lý Tập tin & Mẫu biểu Tòa nhà";
        $data['link_page']          = $this->m_link_page;
        $data['btn_choose']         = "Chọn";
        $data['lbl_rows_per_page']  = "Số dòng hiển thị";
        
        $data['txt_row_per_page']   = $this->m_row_per_page;
        $data['txt_current_page']   = $this->m_current_page;
        $data['txt_total_page']     = $this->m_total_page;			              
        
        $data['txtf_ctitle']        = $this->m_txtf_ctitle; 
        $data['cbof_ctype']         = $this->m_cbof_ctype;
        $data['cbof_caccess_type']  = $this->m_cbof_caccess_type; 
		
        $data['menu_active']        = 'file';
        $data['data_view']          = $this->m_obj_data_view; 
        $data['event']              = $this->m_event; 
		$data['fr_img']             = Fstr_replace('admin/','',base_url());
		
        $this->load->view('file_view/index.php', $data);
    }
    
    // Tải xuống file đơn lẻ
    function f_download_single($nid) {
        $row = Obj_get_file_row($nid);
        
        if (!empty($row)) {
            // Trỏ đường dẫn tuyệt đối ra ngoài thư mục admin (thư mục gốc)
            $real_path = FCPATH . '../' . $row['cfile_path'];
            
            if (file_exists($real_path)) {
                force_download($real_path, NULL);
                return;
            }
        }
        
        echo "<script>alert('File không tồn tại trên hệ thống server!'); window.history.back();</script>";
    }

    // Tải hàng loạt file được chọn gom vào 1 file nén ZIP
    private function f_download_selected_zip() {
        $arr_nids = isset($_POST['chk_file_id']) ? $_POST['chk_file_id'] : array();
        if (empty($arr_nids)) {
            echo "<script>alert('Vui lòng tích chọn ít nhất một file để tải dạng ZIP!'); window.history.back();</script>";
            return;
        }

        $clean_nids = array_map('intval', $arr_nids);
        $this->db->where_in('nid', $clean_nids);
        $this->db->where('cdel', '0');
        $files = $this->db->get(Fget_ap_table('tfiles'))->result_array();

        if (!empty($files)) {
            // Load thư viện zip
            $this->load->library('zip');

            // Gán trực tiếp instance nếu CI chưa tự động bind
            $CI =& get_instance();
            if (!isset($this->zip) && isset($CI->zip)) {
                $this->zip = $CI->zip;
            }

            $has_file = false;

            foreach ($files as $f) {
                // Trỏ đường dẫn tuyệt đối ra ngoài thư mục admin (thư mục gốc)
                $real_path = FCPATH . '../' . $f['cfile_path'];
                
                if (file_exists($real_path)) {
                    $this->zip->read_file($real_path);
                    $has_file = true;
                }
            }

            if ($has_file) {
                $filename = 'Pico_Files_' . date('Ymd_His') . '.zip';
                $this->zip->download($filename);
                return;
            }
        }

        echo "<script>alert('Các file được chọn không tồn tại trên server!'); window.history.back();</script>";
    }

    function f_delete($nid) {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');

        $data_delete = array(
            'cdel'        => '1',
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        $this->db->where('nid', (int)$nid)->update('tfiles', $data_delete);
        redirect('do_file_listview');
    }
}