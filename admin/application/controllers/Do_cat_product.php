<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * =================================================================
 * PICO SAIGON Standard System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */    
   
/**
 *------------------------------------------------------------------
 * do_cat_product class
 *
 * Quan ly them, sua thong tin danh muc loai hinh bat dong san
 *------------------------------------------------------------------
 */     
class do_cat_product extends CI_Controller  
{
    // Hệ thống	
    var $m_language          = ''; 
    var $m_nid_user_login    = ''; // Nhận iduser từ session

    var $m_nid               = ''; // Nhận nid danh mục cần chỉnh sửa
    var $m_event             = ''; // Nhận sự kiện (add/edit/update)
    var $m_button_click      = ''; // Nhận sự kiện click nút từ view
	
    var $m_link_page         = ''; // Link submit form
    var $m_link_cancel       = ''; // Link quay về trang danh sách

    // Biến đối tượng khớp chính xác với CSDL picosaigon_tcat_product
    var $m_txt_ctitle = ''; // Tên danh mục (ctitle)
    var $m_txt_ccode         = ''; // Mã slug (ccode)
    var $m_txt_cindex        = ''; // Thứ tự chỉ mục sắp xếp (cindex)
    var $m_txt_nstatus       = ''; // Trạng thái hoạt động (nstatus)

    var $m_error_msg         = ''; // Thông báo lỗi hiển thị ra view

    function __construct()
    { 
        parent::__construct();
        session_start();
        
        // Load các thư viện hệ thống
        $this->load->database();
        $this->load->helper('ap_db');	
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_object');
			
        $this->config->check_system_login = '1';
		$this->load->model('cat_product_model');
		
		if (!check_staff_permission(array('admin', 'product_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }
	
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.cat.'.$str_key);
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

    function f_add()
    {				
        $this->m_event  = 'add';
        $this->m_nid    = '0';
        $this->do_process();
    }

    function f_update_add()
    {		
        $this->m_event = 'update_add';
        $this->do_process();
    }
	
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
    }

    // Nhận dữ liệu từ biểu mẫu POST
    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');
		
        if (isset($_POST['txt_ctitle']))
        {
            $this->m_txt_ctitle 	   = trim($_POST['txt_ctitle']);
            $this->m_txt_ccode         = trim($_POST['txt_ccode']);
            $this->m_txt_cindex        = trim($_POST['txt_cindex']);
            $this->m_txt_nstatus       = trim($_POST['txt_nstatus']);
        }
		
        if (isset($_POST['hidden_nid']))
            $this->m_nid            = $_POST['hidden_nid'];
		
        if (isset($_POST['hidden_event']))
            $this->m_event          = $_POST['hidden_event'];
			
        if (isset($_POST['hidden_button']))
            $this->m_button_click   = $_POST['hidden_button'];
    }
		
    // Tính toán và định hướng luồng nghiệp vụ
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_cat_product_listview';		
		
        switch ($this->m_event)
        {
            case 'edit':	
                $this->m_form_title = $this->m_language_key('FormEditTitle');
                $this->m_link_page  = base_url() . 'index.php/do_cat_product/f_update_edit';	

                $cat = $this->cat_product_model->get_byid($this->m_nid);

                $this->m_txt_ctitle = $cat['ctitle'];
                $this->m_txt_ccode         = $cat['ccode'];
                $this->m_txt_cindex        = $cat['cindex'];
                $this->m_txt_nstatus       = $cat['nstatus'];
                
                $this->m_event = 'update_edit';
                break;

            case 'add':
                $this->m_form_title = $this->m_language_key('FormAddTitle');
                $this->m_link_page  = base_url() . 'index.php/do_cat_product/f_update_add';
                $this->m_event      = 'update_add';
                break;

            case 'update_edit':
                $this->m_form_title = $this->m_language_key('FormEditTitle');
                $this->m_link_page  = base_url() . 'index.php/do_cat_product/f_update_edit';
                if ($this->m_button_click == 'btn_submit')
                {
                    if ($this->update_data() == TRUE)
                        redirect('do_cat_product_listview');
                }
                break;
			
            case 'update_add':
                $this->m_form_title = $this->m_language_key('FormAddTitle');
                $this->m_link_page  = base_url() . 'index.php/do_cat_product/f_update_add';
                if ($this->m_button_click == 'btn_submit')
                {
                    if ($this->insert_data() == TRUE)
                        redirect('do_cat_product_listview');
                }
                break;
        }		
    }

    // Gắn dữ liệu và xuất dữ liệu ra tầng giao diện View
    private function do_business()
    {					
        $data['event']              = $this->m_event;
        //$data['menu']               = Fget_menu_html($this->m_nid_user_login);
        $data['lbl_form_title']     = $this->m_form_title;
		
        $data['link_page']          = $this->m_link_page;
        $data['link_cancel']        = $this->m_link_cancel;		

        $data['btn_update']         = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']         = $this->lang->line('btn.0000.Cancel');
        
        $data['get_icon_notnull']   = Fget_icon_notnull();		
        $data['get_message_notnull'] = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
		
        $data['lbl_ccat_product']   = $this->m_language_key('ccat_product');
        $data['lbl_ccode']          = $this->m_language_key('ccode');
        $data['lbl_index']          = $this->m_language_key('index');
        $data['lbl_nstatus']        = $this->m_language_key('nstatus');
		
        $data['m_message']          = $this->m_error_msg;

        // Dữ liệu bốc ngược lại ô input form
        $data['txt_ctitle'] 	    = $this->m_txt_ctitle;
        $data['txt_ccode']          = $this->m_txt_ccode;
        $data['txt_cindex']         = $this->m_txt_cindex;
		
        // Tạo combobox trạng thái kích hoạt hoạt động
        $data['gen_cbo_status']     = Fget_combobox_yes_no('no', 'txt_nstatus', $this->m_txt_nstatus, 'width:100%', $this->lang->line('lbl.0000.Yes'), $this->lang->line('lbl.0000.No'));
		
        $data['nid']                = $this->m_nid;
        $data['menu_active']        = 'cat_product';

        $this->load->view('cat_product_view/index.php', $data);
    }

    private function check_valid_not_null()
    {
        if($this->m_txt_ctitle == '')
        {
            $this->m_error_msg = $this->m_language_key('ccat_product') . $this->lang->line('msg.0000.ErorNotNull');
            return FALSE;
        }
        if($this->m_txt_ccode == '')
        {
            $this->m_error_msg = $this->m_language_key('ccode') . $this->lang->line('msg.0000.ErorNotNull');
            return FALSE;
        }
        return TRUE;
    }

    // Logic kiểm tra và thêm mới (Datetime cấu hình hoàn chỉnh)
    private function insert_data()
    {
        if ($this->check_valid_not_null() == TRUE)
        {
            $current_datetime = date('Y-m-d H:i:s'); 
            $data = array(	
                'ctitle'  		  => $this->m_txt_ctitle,
                'ccode'           => $this->m_txt_ccode,
                'cindex'          => $this->m_txt_cindex,
                'nstatus'         => $this->m_txt_nstatus,
                'niduser_created' => $this->m_nid_user_login,
                'dcreated_at'     => $current_datetime,
                'dupdated_at'     => $current_datetime
            );
		
            $this->cat_product_model->insert($data);
            return TRUE;
        }
        return FALSE;
    }

    // Logic kiểm tra và cập nhật (Datetime cấu hình hoàn chỉnh)
    private function update_data()
    {
        if ($this->check_valid_not_null() == TRUE)
        {
            $data = array(								
                'ctitle'  		  => $this->m_txt_ctitle,
                'ccode'           => $this->m_txt_ccode,
                'cindex'          => $this->m_txt_cindex,
                'nstatus'         => $this->m_txt_nstatus,
                'niduser_updated' => $this->m_nid_user_login,
                'dupdated_at'     => date('Y-m-d H:i:s') 
            );
			
            $this->cat_product_model->update_bynid($this->m_nid, $data);
            return TRUE; 
        }
        return FALSE;
    }
}