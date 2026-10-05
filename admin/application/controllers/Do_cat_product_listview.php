<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */   
  
/** *------------------------------------------------------------------
 * do_cat_product_listview class
 *
 * Quan ly danh sach danh muc loai hinh bat dong san (Gom sach CSS thua)
 *------------------------------------------------------------------
 */	    
class do_cat_product_listview extends CI_Controller
{ 	 
    // Các biến bắt buộc điều hướng hệ thống
    var $m_nid_user_login   = ''; // Nhận iduser từ session
    var $m_link_page        = ''; // Đường dẫn điều hướng của form listview
    var $m_event            = ''; // Nhận sự kiện xử lý hành động
		 
    var $m_where_clause     = ''; // Nhận chuỗi điều kiện ép vào mệnh đề WHERE SQL 			
    var $m_orderby_clause   = ''; // Tên trường cần sắp xếp (SORT)
    var $m_orderby_sort     = ''; // Kiểu sắp xếp (ASC / DESC)
    var $m_sort_img         = ''; // Icon mũi tên hiển thị tiêu đề cột SORT
			
    var $m_total_row        = 0;  // Tổng số hàng dữ liệu trong DB 				
    var $m_total_page       = 0;  // Tổng số phân trang dữ liệu 			
		
    var $m_current_page     = 0;  // Trang hiện tại
    var $m_row_per_page     = 10; // Số dòng trên mỗi trang hiển thị
    var $m_message          = ''; // Chuỗi tin nhắn cảnh báo

    // Các biến phục vụ bộ lọc tìm kiếm (FILTER) chuẩn hóa theo CSDL mới
    var $m_txtf_ctitle      = ''; // Lọc theo Tên danh mục (ctitle)
    var $m_txtf_ccode       = ''; // Lọc theo Mã Code / Slug (ccode)
    var $m_txtf_cindex      = ''; // Lọc theo Chỉ mục vị trí (cindex)
    var $m_txtf_nstatus     = ''; // Lọc theo Trạng thái (nstatus)
    var $m_txtf_dcreated_at = ''; // Lọc theo Ngày khởi tạo (dcreated_at)

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
		
        $this->load->model('cat_product_model'); 	
        $this->config->check_system_login = '1'; 
		
		if (!check_staff_permission(array('admin', 'product_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }	
	
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.cat.'.$str_key);
    }
		
    function f_sort($field_name, $orderby_sort)
    {
        $this->m_orderby_clause = $field_name;
        $this->m_orderby_sort   = $orderby_sort;
        $this->do_process();
    }

    private function f_set_cookie($cookie_name, $cookie_value)
    { 
        return dbset_cookie('cookie_cat_product_listview_'.$cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    { 
        return dbget_cookie('cookie_cat_product_listview_'.$cookie_name);
    }

    function f_active($nid, $status)   
    {
        if($status == '0') $status = '1';
        else $status = '0';
		
        $data = array('nstatus' => $status);
        $this->cat_product_model->update_bynid($nid, $data);		
        $this->do_process();
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
    } 

    // Tiếp nhận các hành động tương tác từ Grid Danh sách
    private function get_data()
    {         
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');
		
        if(isset($_POST['hidden_button']))
        {
            $hidden_button = $_POST['hidden_button']; 
            switch($hidden_button) 
            {
                case "btn_filter": // Hành động nhấn nút Lọc tìm kiếm
                    $this->m_txtf_ctitle      = isset($_POST['txtf_ctitle']) ? $_POST['txtf_ctitle'] : '';
                    $this->m_txtf_ccode       = isset($_POST['txtf_ccode']) ? $_POST['txtf_ccode'] : '';
                    $this->m_txtf_cindex      = isset($_POST['txtf_cindex']) ? $_POST['txtf_cindex'] : '';
                    $this->m_txtf_nstatus     = isset($_POST['txtf_nstatus']) ? $_POST['txtf_nstatus'] : '';
                    $this->m_txtf_dcreated_at = isset($_POST['txtf_dcreated_at']) ? $_POST['txtf_dcreated_at'] : '';
			
                    // Lưu trạng thái lọc vào Cookie hệ thống để giữ bộ lọc khi reload chuyển trang
                    $this->f_set_cookie('txtf_ctitle', $this->m_txtf_ctitle);
                    $this->f_set_cookie('txtf_ccode', $this->m_txtf_ccode);
                    $this->f_set_cookie('txtf_cindex', $this->m_txtf_cindex);
                    $this->f_set_cookie('txtf_nstatus', $this->m_txtf_nstatus);
                    $this->f_set_cookie('txtf_dcreated_at', $this->m_txtf_dcreated_at);
                    break;			
	
                case "btn_row_per_page": // Thay đổi cấu hình số lượng dòng trên một trang hiển thị
                    if (isset($_POST['txt_row_per_page']))
                        $this->m_row_per_page = Fconvert_to_int($_POST['txt_row_per_page']);
                    break;

                case "btn_page_number": // Chọn nhảy số phân trang trực tiếp
                    $this->m_current_page = isset($_POST['txt_current_page']) ? $_POST['txt_current_page'] : 1;
                    break;
				
                case "btn_next": // Nhấn nút Tiến trang sau (Next)
                    $this->m_current_page = $_POST['txt_current_page'] + 1;
                    break;	
				
                case "btn_previous": // Nhấn nút Lùi trang trước (Previous)
                    $this->m_current_page = $_POST['txt_current_page'] - 1;
                    break;	
				
                case "btn_add": // Chuyển sang màn hình thêm mới danh mục
                    redirect(base_url() . 'index.php/do_cat_product/f_add');
                    break;
				
                case "btn_delete": // Xóa hàng loạt các dòng đã tích chọn checkbox
                    $this->delete();
                    break;
            }
        }					
    } 
	
    // Xử lý logic tính toán dữ liệu
    private function caculate_data()
    {	   
        $this->m_link_page = base_url() . 'index.php/do_cat_product_listview/';

        if (trim($this->m_orderby_clause) == '')
        {
            $this->m_orderby_clause = $this->f_get_cookie('m_orderby_clause');
            $this->m_orderby_sort   = $this->f_get_cookie('m_orderby_sort');
        }
		
        // Mặc định sắp xếp theo Tên danh mục tăng dần nếu chưa có yêu cầu sort riêng biệt
        if (trim($this->m_orderby_clause) == '')
        {
            $this->m_orderby_clause = 'ctitle';
            $this->m_orderby_sort   = 'asc';			
        }
		
        $this->f_set_cookie('m_orderby_clause', $this->m_orderby_clause);
        $this->f_set_cookie('m_orderby_sort', $this->m_orderby_sort);		 
	
        // Lấy lại các giá trị lọc đã lưu từ Cookie
        $this->m_txtf_ctitle      = $this->f_get_cookie('txtf_ctitle');
        $this->m_txtf_ccode       = $this->f_get_cookie('txtf_ccode');
        $this->m_txtf_cindex      = $this->f_get_cookie('txtf_cindex');
        $this->m_txtf_nstatus     = $this->f_get_cookie('txtf_nstatus');
        $this->m_txtf_dcreated_at = $this->f_get_cookie('txtf_dcreated_at');
		
        $this->m_where_clause = $this->get_where_string();	
		
        // Đếm tổng số dòng thỏa mãn điều kiện lọc
        $this->m_total_row = $this->cat_product_model->get_count_listview($this->m_where_clause);		
		
        if ($this->m_row_per_page <= 0)
            $this->m_row_per_page = Fget_userdata('session_user_row_per_page');			
        else
            Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
        if ($this->m_current_page <= 0)
            $this->m_current_page = dbget_cookie('cookie_cat_product_listview_txt_current_page');
			
        if ($this->m_current_page <= 0) $this->m_current_page = 1;		
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
		
        dbset_cookie('cookie_cat_product_listview_txt_current_page', $this->m_current_page);	
		
        // Thực thi hàm lấy danh sách phân trang từ Model dữ liệu
        $this->m_obj_data_view = $this->cat_product_model->get_listview(
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
	   
    // Đóng gói tham số truyền ra giao diện View
    private function do_business()
    {	
        $data['orderby_field'] = $this->m_orderby_clause;
        $data['orderby_sort']  = $this->m_orderby_sort;
        $data['sort_img']      = $this->m_sort_img;
        $data['link_page']     = $this->m_link_page;
		
        $data['lbl_form_title'] = $this->m_language_key('title.form');

        // Khai báo nhãn hiển thị ngôn ngữ giao diện cột Grid hệt như CSDL mới
        $data['lbl_ctitle']     = $this->m_language_key('ctitle');
        $data['lbl_ccode']      = $this->m_language_key('ccode');
        $data['lbl_index']      = $this->m_language_key('cindex');
        $data['lbl_nstatus']    = $this->m_language_key('nstatus');
        $data['lbl_date01']     = $this->m_language_key('dcreated_at');
		
        $data['btn_add']       = $this->lang->line('btn.0000.Add');
        $data['btn_delete']    = $this->lang->line('btn.0000.Delete');
        $data['btn_choose']    = $this->lang->line('btn.0000.Choose');
        $data['btn_filter']    = $this->lang->line('btn.0000.Filter');
        
        $data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
        $data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
        $data['lbl_rows_per_page']         = $this->lang->line('lbl.0000.RowPerPage');
		
        $data['txt_row_per_page']   = $this->m_row_per_page;
        $data['txt_current_page']   = $this->m_current_page;
        $data['txt_total_page']     = $this->m_total_page;			
				
        $data['event']              = $this->m_event;
        $data['txtf_ctitle']        = $this->m_txtf_ctitle;
        $data['txtf_ccode']         = $this->m_txtf_ccode;
        $data['txtf_cindex']        = $this->m_txtf_cindex;
        $data['txtf_dcreated_at']   = $this->m_txtf_dcreated_at;
        $data['m_message']          = $this->m_message;
		
        // Tạo combobox lọc trạng thái thu gọn
        $data['gen_cbo_status']     = Fget_combobox_yes_no('', 'txtf_nstatus', $this->m_txtf_nstatus, 'width:100%', $this->lang->line('lbl.0000.Yes'), $this->lang->line('lbl.0000.No'));
			
        $data['data_view']          = $this->m_obj_data_view;
        //$data['menu']               = Fget_menu_html($this->m_nid_user_login);
        $data['menu_active']        = 'cat_product';

        $this->load->view('cat_product_view/index.php', $data);
    }
	
    // Xây dựng chuỗi lọc Query WHERE nối mảng (Tối ưu theo ctitle và dcreated_at)
    private function get_where_string()
    {
        $str_result = ' WHERE nid is not null AND cdel=0 ';
        if ($this->m_txtf_ctitle != '')
            $str_result .= ' AND ctitle like "%' . trim($this->m_txtf_ctitle) . '%" ';
        if ($this->m_txtf_ccode != '')
            $str_result .= ' AND ccode like "%' . trim($this->m_txtf_ccode) . '%" ';
        if ($this->m_txtf_nstatus != '')
            $str_result .= ' AND nstatus like "%' . trim($this->m_txtf_nstatus) . '%" ';
        if ($this->m_txtf_cindex != '')
            $str_result .= ' AND cindex like "%' . trim($this->m_txtf_cindex) . '%" ';
        if ($this->m_txtf_dcreated_at != '')
            // Sử dụng DATE() ép chuỗi tìm kiếm khoảng datetime chuẩn xác
            $str_result .= ' AND DATE(dcreated_at) = "' . Fget_strdate($this->m_txtf_dcreated_at) . '" '; 
		
        return $str_result;
    }
	
    // Kiểm tra ràng buộc khóa ngoại trước khi chạy hàm xóa
    function check_valid_delete($nid)
    {
        $this->db->where('nid_cat_product', $nid); // Khớp chuẩn khóa ngoại của bảng sản phẩm tproduct
        $obj_result  = $this->db->get(Fget_ap_table('tproduct')); 
        if($obj_result->num_rows() > 0)
            return FALSE;
			
        return TRUE;
    }

    private function delete()
    {					
        if (!empty($_POST['chk']))
        {
            foreach ($_POST['chk'] as $nid)
            {	
                if($this->check_valid_delete($nid))						
                {
                    $this->cat_product_model->delete_byid($nid);	
                }
                else
                    $this->m_message = $this->lang->line('lbl.0000.message_valid_delete');
            }
        }
    }		
	
	function f_delete($nid) {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');

        $data_delete = array(
            'cdel'          => '1',
            'niduser_updated' => $this->m_nid_user_login,
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        $res_delete = $this->db->where('nid', (int)$nid)->update('tcat_product', $data_delete);

        redirect('do_cat_product_listview');
    }
}