<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */   
  
/** *------------------------------------------------------------------
 * do_product_listview class
 *
 * Quan ly danh sach san pham Bat Dong San toan quoc
 *------------------------------------------------------------------
 */	    
class do_product_listview extends CI_Controller
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

    // Các biến phục vụ bộ lọc tìm kiếm (FILTER) chuẩn hóa theo CSDL mới tinh gọn
    var $m_txtf_ctitle         = ''; // Lọc theo Tiêu đề BĐS (ctitle)
    var $m_txtf_ccode          = ''; // Lọc theo Mã Code / Slug (ccode)
    var $m_cbo_nid_cat_product = ''; // Lọc theo Nhóm danh mục (nid_cat_product)
    var $m_cbo_nid_province    = ''; // Lọc theo Tỉnh/Thành phố toàn quốc (nid_province)
    var $m_txtf_nproduct_status= ''; // Lọc theo Trạng thái giao dịch BĐS (nproduct_status)
    var $m_txtf_nstatus        = ''; // Lọc theo Bật/Tắt hiển thị hệ thống (nstatus)

    // Đối tượng chứa danh sách đổ lên combo lọc row
    var $m_obj_cat_product_view = '';
    var $m_obj_province_view    = '';

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
		
        $this->load->model('product_model'); 	
        $this->config->check_system_login = '1'; 
		
		if (!check_staff_permission(array('admin', 'product_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }	
		
    function f_sort($field_name, $orderby_sort)
    {
        $this->m_orderby_clause = $field_name;
        $this->m_orderby_sort   = $orderby_sort;
        $this->do_process();
    }

    private function f_set_cookie($cookie_name, $cookie_value)
    { 
        return dbset_cookie('cookie_product_listview_'.$cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    { 
        return dbget_cookie('cookie_product_listview_'.$cookie_name);
    }

    // Hàm Bật/Tắt hiển thị hệ thống chung qua trường nstatus
    function f_active($nid, $status)   
    {
        if($status == '0') $status = '1';
        else $status = '0';
		
        $data = array('nstatus' => $status);
        $this->product_model->update_bynid($nid, $data);		
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
        
        // GIỮ NGUYÊN: Nạp file ngôn ngữ tại get_data tránh phát sinh lỗi hệ thống hệ tầng
        $this->load->language('ap', 'eng');
		
        if(isset($_POST['hidden_button']))
        {
            $hidden_button = $_POST['hidden_button']; 
            switch($hidden_button) 
            {
                case "btn_filter": // Hành động nhấn nút Lọc tìm kiếm
                    $this->m_txtf_ctitle          = isset($_POST['txtf_ctitle']) ? $_POST['txtf_ctitle'] : '';
                    $this->m_txtf_ccode           = isset($_POST['txtf_ccode']) ? $_POST['txtf_ccode'] : '';
                    $this->m_cbo_nid_cat_product  = isset($_POST['cbo_nid_cat_product']) ? $_POST['cbo_nid_cat_product'] : '';
                    $this->m_cbo_nid_province     = isset($_POST['cbo_nid_province']) ? $_POST['cbo_nid_province'] : '';
                    $this->m_txtf_nproduct_status = isset($_POST['txtf_nproduct_status']) ? $_POST['txtf_nproduct_status'] : '';
                    $this->m_txtf_nstatus         = isset($_POST['txtf_nstatus']) ? $_POST['txtf_nstatus'] : '';
			
                    // Lưu trạng thái lọc vào Cookie hệ thống để giữ bộ lọc khi reload chuyển trang
                    $this->f_set_cookie('txtf_ctitle', $this->m_txtf_ctitle);
                    $this->f_set_cookie('txtf_ccode', $this->m_txtf_ccode);
                    $this->f_set_cookie('cbo_nid_cat_product', $this->m_cbo_nid_cat_product);
                    $this->f_set_cookie('cbo_nid_province', $this->m_cbo_nid_province);
                    $this->f_set_cookie('txtf_nproduct_status', $this->m_txtf_nproduct_status);
                    $this->f_set_cookie('txtf_nstatus', $this->m_txtf_nstatus);
                    break;			
	
                case "btn_row_per_page": 
                    if (isset($_POST['txt_row_per_page']))
                        $this->m_row_per_page = Fconvert_to_int($_POST['txt_row_per_page']);
                    break;

                case "btn_page_number": 
                    $this->m_current_page = isset($_POST['txt_current_page']) ? $_POST['txt_current_page'] : 1;
                    break;
				
                case "btn_next": 
                    $this->m_current_page = $_POST['txt_current_page'] + 1;
                    break;	
				
                case "btn_previous": 
                    $this->m_current_page = $_POST['txt_current_page'] - 1;
                    break;	
				
                case "btn_add": // Chuyển sang màn hình thêm mới sản phẩm
                    redirect(base_url() . 'index.php/do_product/f_add');
                    break;
				
                case "btn_delete": 
                    $this->delete();
                    break;
            }
        }					
    } 
	
    // Xử lý logic tính toán dữ liệu sản phẩm toàn quốc
    private function caculate_data()
    {	   
        $this->m_link_page = base_url() . 'index.php/do_product_listview/';

        if (trim($this->m_orderby_clause) == '')
        {
            $this->m_orderby_clause = $this->f_get_cookie('m_orderby_clause');
            $this->m_orderby_sort   = $this->f_get_cookie('m_orderby_sort');
        }
		
        if (trim($this->m_orderby_clause) == '')
        {
            $this->m_orderby_clause = 'ctitle';
            $this->m_orderby_sort   = 'asc';			
        }
		
        $this->f_set_cookie('m_orderby_clause', $this->m_orderby_clause);
        $this->f_set_cookie('m_orderby_sort', $this->m_orderby_sort);		 
	
        // Lấy lại các giá trị lọc đã lưu từ Cookie
        $this->m_txtf_ctitle          = $this->f_get_cookie('txtf_ctitle');
        $this->m_txtf_ccode           = $this->f_get_cookie('txtf_ccode');
        $this->m_cbo_nid_cat_product  = $this->f_get_cookie('cbo_nid_cat_product');
        $this->m_cbo_nid_province     = $this->f_get_cookie('cbo_nid_province');
        $this->m_txtf_nproduct_status = $this->f_get_cookie('txtf_nproduct_status');
        $this->m_txtf_nstatus         = $this->f_get_cookie('txtf_nstatus');
		
        $this->m_where_clause = $this->get_where_string();	
		
        // Đếm tổng số sản phẩm BĐS thỏa mãn điều kiện lọc
        $this->m_total_row = $this->product_model->get_count_listview($this->m_where_clause);		
		
        if ($this->m_row_per_page <= 0)
            $this->m_row_per_page = Fget_userdata('session_user_row_per_page');			
        else
            Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
        $this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
        if ($this->m_current_page <= 0)
            $this->m_current_page = dbget_cookie('cookie_product_listview_txt_current_page');
			
        if ($this->m_current_page <= 0) $this->m_current_page = 1;		
        if ($this->m_current_page > $this->m_total_page) $this->m_current_page = $this->m_total_page;
		
        dbset_cookie('cookie_product_listview_txt_current_page', $this->m_current_page);	
		
        // Thực thi hàm lấy danh sách phân trang sản phẩm
        $this->m_obj_data_view = $this->product_model->get_listview(
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

        // Lấy danh sách danh mục và tỉnh thành đổ lên combobox hàng lọc FILTER ROW
        $this->m_obj_cat_product_view = Obj_get_cat_product_list($this->m_nid_user_login);
        $this->m_obj_province_view    = Obj_get_province_list();
    }
	   
    // Đóng gói tham số truyền ra giao diện View (Gán cứng chuỗi Tiếng Việt trực tiếp)
    private function do_business()
    {	
        $data['orderby_field'] = $this->m_orderby_clause;
        $data['orderby_sort']  = $this->m_orderby_sort;
        $data['sort_img']      = $this->m_sort_img;
        $data['link_page']     = $this->m_link_page;
		
        $data['btn_add']       = 'Thêm mới';
        $data['btn_delete']    = 'Xóa các mục chọn';
        $data['btn_choose']    = 'Chọn';
        $data['btn_filter']    = 'Tìm kiếm';
        
        $data['msg_invalid_before_delete'] = 'Vui lòng tích chọn sản phẩm trước khi xóa!';
        $data['msg_confirm_before_delete'] = 'Bạn có chắc chắn muốn xóa các sản phẩm bất động sản đã chọn?';
        $data['lbl_rows_per_page']         = 'Số dòng hiển thị';
		
        $data['txt_row_per_page']   = $this->m_row_per_page;
        $data['txt_current_page']   = $this->m_current_page;
        $data['txt_total_page']     = $this->m_total_page;			
				
        $data['event']              = $this->m_event;
        $data['txtf_ctitle']        = $this->m_txtf_ctitle;
        $data['txtf_ccode']         = $this->m_txtf_ccode;
        $data['cbo_nid_cat_product']  = $this->m_cbo_nid_cat_product;
        $data['cbo_nid_province']     = $this->m_cbo_nid_province;
        $data['txtf_nstatus']         = $this->m_txtf_nstatus;
        $data['txtf_nproduct_status'] = $this->m_txtf_nproduct_status;
        $data['m_message']            = $this->m_message;
		
        // 1. Tạo combobox lọc danh mục nhóm & tỉnh thành toàn quốc ngoài Grid
        $data['gencbo_cat_product'] = Fgen_html_combobox('', 'cbo_nid_cat_product', $this->m_cbo_nid_cat_product, '', $this->m_obj_cat_product_view, 'nid', 'ctitle', 'nosubmit', '');
        $data['gencbo_province']    = Fgen_html_combobox('', 'cbo_nid_province', $this->m_cbo_nid_province, '', $this->m_obj_province_view, 'nid', 'ctitle', 'nosubmit', '');
		$data['gen_cbo_status']     = Fget_combobox_yes_no('', 'txt_nstatus', $this->m_txtf_nstatus, 'width:100%', $this->lang->line('lbl.0000.Yes'), $this->lang->line('lbl.0000.No'));
			
        // 3. Gán cứng mảng tĩnh sinh combobox lọc 3 trạng thái giao dịch nghiệp vụ BĐS cố định (nproduct_status)
        $arr_product_status = array(
            '1' => 'Đang bán',
            '2' => 'Tạm ẩn',
            '3' => 'Đã bán'
        );
        $html_pstatus = '<select name="txtf_nproduct_status" id="txtf_nproduct_status" class="form-control" style="width:100%">';
        $html_pstatus .= '<option value=""></option>';
        foreach ($arr_product_status as $key => $value) {
            if ($this->m_txtf_nproduct_status == $key) {
                $html_pstatus .= '<option value="' . $key . '" selected="selected">' . $value . '</option>';
            } else {
                $html_pstatus .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $html_pstatus .= '</select>';
        $data['gen_cbo_product_status'] = $html_pstatus;

        $data['data_view']          = $this->m_obj_data_view;
        //$data['menu']               = Fget_menu_html($this->m_nid_user_login);
        $data['menu_active']        = 'product';

        $this->load->view('product_view/index.php', $data);
    }
	
    // Xây dựng chuỗi lọc Query WHERE khớp chuẩn CSDL rút gọn (Toàn quốc)
    private function get_where_string()
    {
        $str_result = ' WHERE nid is not null AND cdel=0 ';
        if ($this->m_txtf_ctitle != '')
            $str_result .= ' AND ctitle like "%' . trim($this->m_txtf_ctitle) . '%" ';
        if ($this->m_txtf_ccode != '')
            $str_result .= ' AND ccode like "%' . trim($this->m_txtf_ccode) . '%" ';
        if ($this->m_cbo_nid_cat_product != '' && $this->m_cbo_nid_cat_product != '0')
            $str_result .= ' AND nid_cat_product = ' . $this->m_cbo_nid_cat_product;
        if ($this->m_cbo_nid_province != '' && $this->m_cbo_nid_province != '0')
            $str_result .= ' AND nid_province = ' . $this->m_cbo_nid_province;
        if ($this->m_txtf_nstatus != '')
            $str_result .= ' AND nstatus = ' . $this->m_txtf_nstatus;
        if ($this->m_txtf_nproduct_status != '')
            $str_result .= ' AND nproduct_status = ' . $this->m_txtf_nproduct_status;
		
        return $str_result;
    }
	
    // Kiểm tra liên kết khóa ngoại trước khi xóa file vật lý và record
    function check_valid_delete($nid)
    {
        // Có thể bổ sung check liên kết bảng picosaigon_tfiles đính kèm dự án sau này nếu cần
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
                    // Lấy thông tin bài viết cũ để tiến hành xóa file ảnh vật lý trên ổ cứng server
                    $obj_data = $this->product_model->get_byid($nid);
                    if($obj_data['cimage'] != '')
                    {
                        $path = '.././upload/images_product/full_images/';
                        if(file_exists($path . $obj_data['cimage'])) {
                            unlink($path . $obj_data['cimage']);
                        }
                    }
                    $this->product_model->delete_byid($nid);	
                }
                else
                    $this->m_message = 'Không thể xóa bất động sản do có ràng buộc dữ liệu hồ sơ liên quan!';
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

        $res_delete = $this->db->where('nid', (int)$nid)->update('tproduct', $data_delete);

        redirect('do_product_listview');
    }	
}