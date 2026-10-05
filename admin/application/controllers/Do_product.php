<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */    
   
/**
 *------------------------------------------------------------------
 * do_product class
 *
 * Quan ly them, sua thong tin san pham Bat Dong San toan quoc
 *------------------------------------------------------------------
 */     
class do_product extends CI_Controller  
{
    // Hệ thống	
    var $m_nid_user_login    = ''; // Nhận iduser từ session

    var $m_nid               = ''; // Nhận nid sản phẩm cần chỉnh sửa
    var $m_event             = ''; // Nhận sự kiện (add/edit/update)
    var $m_button_click      = ''; // Nhận sự kiện click nút từ view
	
    var $m_link_page         = ''; // Link submit form
    var $m_link_cancel       = ''; // Link quay về trang danh sách
    var $m_form_title        = ''; // Tiêu đề biểu mẫu

    // Biến đối tượng khớp chính xác với CSDL picosaigon_tproduct mở rộng
    var $m_cbo_nid_cat_product = ''; // Mã nhóm danh mục (nid_cat_product)
    var $m_cbo_nid_province    = ''; // Mã tỉnh thành toàn quốc (nid_province)
    var $m_txt_ccode           = ''; // Mã slug URL (ccode)
    var $m_txt_ctitle          = ''; // Tiêu đề tin đăng (ctitle)
    var $m_txt_clocation_detail= ''; // Địa chỉ chi tiết BĐS (clocation_detail)
    var $m_txt_cprice_display  = ''; // Giá hiển thị chữ (cprice_display)
    var $m_txt_nprice_value    = 0;  // Giá trị số thực tế VNĐ (nprice_value)
    var $m_txt_narea           = 0.00;// Diện tích m2 (narea)
    var $m_txt_nbedroom        = 0;  // Số phòng ngủ (nbedroom)
    var $m_txt_nbathroom       = 0;  // Số nhà vệ sinh (nbathroom)
    var $m_txt_cshort_content  = ''; // Mô tả tóm tắt (cshort_content)
    var $m_txt_ccontent        = ''; // Nội dung chi tiết (ccontent)
    var $m_txt_cmaps_iframe    = ''; // Mã nhúng bản đồ (cmaps_iframe)
    var $m_txt_nstatus         = 1;  // Bật/Tắt hiển thị: 1-Hoạt động, 0-Khóa (nstatus)
    var $m_txt_nproduct_status = 1;  // Trạng thái nghiệp vụ BĐS: 1-Đang bán, 2-Tạm ẩn, 3-Đã bán (nproduct_status)
    var $m_txt_cimage          = ''; // Đường dẫn file ảnh chính (cimage)

    var $m_hidden_image_old    = ''; // Giữ lại tên ảnh cũ khi sửa tin
    var $m_error_msg           = ''; // Thông báo lỗi hiển thị ra view

    // Đối tượng dữ liệu binding lên combobox
    var $m_obj_cat_product_view = '';
    var $m_obj_province_view    = '';
	var $cindex    = 0;
	
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
        $this->load->model('product_model');
		
		if (!check_staff_permission(array('admin', 'product_mgr'))) {
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

    // Nhận dữ liệu từ biểu mẫu POST và FILE hình ảnh
    private function get_data()
    {
        $this->load->language('ap', 'eng');
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
		
        // Xử lý tệp tin ảnh đại diện chính upload
        if(isset($_FILES["txt_cimage"]))
        {
            if($_FILES["txt_cimage"]["name"] != '')
            {
                $path = '.././upload/images_product/full_images/';
                $this->m_txt_cimage = Fupload_resize_img($_FILES["txt_cimage"], $path, 2000, 1000);
            }
        }

        if (isset($_POST['txt_ctitle']))
        {
            $this->m_cbo_nid_cat_product  = $_POST['cbo_nid_cat_product'];
            $this->m_cbo_nid_province     = $_POST['cbo_nid_province'];
            $this->m_txt_ccode            = trim($_POST['txt_ccode']);
            $this->m_txt_ctitle           = trim($_POST['txt_ctitle']);
            $this->m_txt_clocation_detail = trim($_POST['txt_clocation_detail']);
            $this->m_txt_cprice_display   = trim($_POST['txt_cprice_display']);
            
            $this->m_txt_nprice_value     = Fconvert_to_int(str_replace('.', '', $_POST['txt_nprice_value']));
            $this->m_txt_narea            = (double)$_POST['txt_narea'];
            $this->m_txt_nbedroom          = Fconvert_to_int($_POST['txt_nbedroom']);
            $this->m_txt_nbathroom         = Fconvert_to_int($_POST['txt_nbathroom']);
            
            $this->m_txt_cshort_content   = trim($_POST['txt_cshort_content']);
            $this->m_txt_ccontent         = trim($_POST['txt_ccontent']);
            $this->m_txt_cmaps_iframe     = trim($_POST['txt_cmaps_iframe']);
            $this->m_txt_nstatus          = trim($_POST['txt_nstatus']);
            $this->m_txt_nproduct_status  = trim($_POST['txt_nproduct_status']); 
			$this->cindex            = trim($_POST['cindex']);
        }
		
        if (isset($_POST['hidden_nid']))
            $this->m_nid              = $_POST['hidden_nid'];
        if (isset($_POST['hidden_image_old']))
            $this->m_hidden_image_old = $_POST['hidden_image_old'];
        if (isset($_POST['hidden_event']))
            $this->m_event            = $_POST['hidden_event'];
        if (isset($_POST['hidden_button']))
            $this->m_button_click     = $_POST['hidden_button'];
    }
		
    // Tính toán và định hướng luồng nghiệp vụ
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_product_listview';		
		
        switch ($this->m_event)
        {
            case 'edit':	
                $this->m_link_page  = base_url() . 'index.php/do_product/f_edit/' . $this->m_nid;	

                $product = $this->product_model->get_byid($this->m_nid);

                $this->m_cbo_nid_cat_product   = $product['nid_cat_product'];
                $this->m_cbo_nid_province      = $product['nid_province'];
                $this->m_txt_ccode             = $product['ccode'];
                $this->m_txt_ctitle            = $product['ctitle'];
                $this->m_txt_clocation_detail  = $product['clocation_detail'];
                $this->m_txt_cprice_display    = $product['cprice_display'];
                $this->m_txt_nprice_value      = $product['nprice_value'];
                $this->m_txt_narea             = $product['narea'];
                $this->m_txt_nbedroom          = $product['nbedroom'];
                $this->m_txt_nbathroom         = $product['nbathroom'];
                $this->m_txt_cshort_content    = $product['cshort_content'];
                $this->m_txt_ccontent          = $product['ccontent'];
                $this->m_txt_cmaps_iframe      = $product['cmaps_iframe'];
                $this->m_txt_nstatus           = $product['nstatus'];
                $this->m_txt_cimage            = $product['cimage'];
                $this->m_txt_nproduct_status   = $product['nproduct_status']; 
                $this->cindex   = $product['cindex']; 
                $this->m_form_title = 'Chỉnh sửa: <span class="text-danger">' . $this->m_txt_ctitle . '</span>';
                $this->m_event = 'update_edit';
                break;

            case 'add':
                $this->m_form_title = 'Thêm mới bất động sản';
                $this->m_link_page  = base_url() . 'index.php/do_product/f_update_add';
                $this->m_txt_nproduct_status = 1; 
                $this->m_txt_nstatus       = 1; 
                $this->m_event      = 'update_add';
                break;

            case 'update_edit':
                $this->m_form_title = 'Chỉnh sửa bất động sản';
                $this->m_link_page  = base_url() . 'index.php/do_product/f_update_edit';
                if ($this->m_button_click == 'btn_submit')
                {
                    if ($this->update_data() == TRUE)
                        redirect('do_product_listview');
                }
                break;
			
            case 'update_add':
                $this->m_form_title = 'Thêm mới bất động sản';
                $this->m_link_page  = base_url() . 'index.php/do_product/f_update_add';
                if ($this->m_button_click == 'btn_submit')
                {
                    if ($this->insert_data() == TRUE)
                        redirect('do_product_listview');
                }
                break;
        }		

        // Lấy danh sách danh mục và tỉnh thành đổ lên combobox view
        $this->m_obj_cat_product_view = Obj_get_cat_product_list();
        $this->m_obj_province_view    = Obj_get_province_list();
    }

    // Gắn dữ liệu và xuất dữ liệu ra tầng giao diện View
    private function do_business()
    {					
        $data['event']              = $this->m_event;
        $data['lbl_form_title']     = $this->m_form_title;
		
        $data['link_page']          = $this->m_link_page;
        $data['link_cancel']        = $this->m_link_cancel;		
		
        $data['btn_update']         = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']         = $this->lang->line('btn.0000.Cancel');

        $data['fr_img']             = Fstr_replace('admin/','',base_url());
        $data['m_message']          = $this->m_error_msg;

        // Dữ liệu binding ngược lại ô input form
        $data['cbo_nid_cat_product']   = $this->m_cbo_nid_cat_product;
        $data['cbo_nid_province']      = $this->m_cbo_nid_province;
        $data['txt_ccode']             = $this->m_txt_ccode;
        $data['txt_ctitle']            = $this->m_txt_ctitle;
        $data['txt_clocation_detail']  = $this->m_txt_clocation_detail;
        $data['txt_cprice_display']    = $this->m_txt_cprice_display;
        $data['txt_nprice_value']      = $this->m_txt_nprice_value;
        $data['txt_narea']             = $this->m_txt_narea;
        $data['txt_nbedroom']          = $this->m_txt_nbedroom;
        $data['txt_nbathroom']         = $this->m_txt_nbathroom;
        $data['txt_cshort_content']    = $this->m_txt_cshort_content;
        $data['txt_ccontent']          = $this->m_txt_ccontent;
        $data['txt_cmaps_iframe']      = $this->m_txt_cmaps_iframe;
		$data['cindex']      = $this->cindex;
		
        if($this->m_txt_cimage == '')
            $this->m_txt_cimage = $this->m_hidden_image_old;
        $data['txt_cimage'] = $this->m_txt_cimage;
		
        // Tạo combobox danh mục nhóm, tỉnh thành toàn quốc bằng hàm helper dựng sẵn
        $data['gencbo_cat_product'] = Fgen_html_combobox('no', 'cbo_nid_cat_product', $this->m_cbo_nid_cat_product, '', $this->m_obj_cat_product_view, 'nid', 'ctitle', 'nosubmit', '');
        $data['gencbo_province']    = Fgen_html_combobox('no', 'cbo_nid_province', $this->m_cbo_nid_province, '', $this->m_obj_province_view, 'nid', 'ctitle', 'nosubmit', '');
        $data['gen_cbo_status']     = Fget_combobox_yes_no('no', 'txt_nstatus', $this->m_txt_nstatus, 'width:100%', $this->lang->line('lbl.0000.Yes'), $this->lang->line('lbl.0000.No'));
        
        // 2. Tự tạo cấu trúc vòng lặp gán cứng cố định cho 4 option nghiệp vụ BĐS (Không dùng hàm helper)
        $arr_product_status = array(
            '1' => 'Đang bán',
            '2' => 'Tạm ẩn',
            '3' => 'Đã bán',
			'4' => 'Cho thuê'
        );
        $html_pstatus = '<select name="txt_nproduct_status" id="txt_nproduct_status" class="form-control" style="width:100%">';
        foreach ($arr_product_status as $key => $value) {
            if ($this->m_txt_nproduct_status == $key) {
                $html_pstatus .= '<option value="' . $key . '" selected="selected">' . $value . '</option>';
            } else {
                $html_pstatus .= '<option value="' . $key . '">' . $value . '</option>';
            }
        }
        $html_pstatus .= '</select>';
        $data['gen_cbo_product_status'] = $html_pstatus; 
		
        $data['nid']                = $this->m_nid;
        $data['menu_active']        = 'product';

        // ĐÃ BỔ SUNG: Gọi helper lấy danh sách hồ sơ đính kèm truyền ra ngoài giao diện quản lý Tab 4
        $this->load->helper('ap_object');
        $data['document_list']      = get_product_documents($this->m_nid);

        $this->load->view('product_view/index.php', $data);
    }

    private function check_valid_not_null()
    {
        if($this->m_txt_ctitle == '') {
            $this->m_error_msg = 'Tiêu đề tin đăng không được để trống';
            return FALSE;
        }
        if($this->m_txt_ccode == '') {
            $this->m_error_msg = 'Mã Code Url không được để trống';
            return FALSE;
        }
        if($this->m_cbo_nid_cat_product == '' || $this->m_cbo_nid_cat_product == 0) {
            $this->m_error_msg = 'Vui lòng chọn Nhóm danh mục';
            return FALSE;
        }
        if($this->m_cbo_nid_province == '' || $this->m_cbo_nid_province == 0) {
            $this->m_error_msg = 'Vui lòng chọn Tỉnh / Thành phố';
            return FALSE;
        }
        return TRUE;
    }

    private function insert_data()
    {
        if ($this->check_valid_not_null() == TRUE)
        {
            $current_datetime = date('Y-m-d H:i:s'); 
            $data = array(	
                'nid_cat_product'  => $this->m_cbo_nid_cat_product,
                'nid_province'     => $this->m_cbo_nid_province,
                'ccode'            => $this->m_txt_ccode,
                'ctitle'           => $this->m_txt_ctitle,
                'clocation_detail' => $this->m_txt_clocation_detail,
                'cprice_display'   => $this->m_txt_cprice_display,
                'nprice_value'     => $this->m_txt_nprice_value,
                'narea'            => $this->m_txt_narea,
                'nbedroom'         => $this->m_txt_nbedroom,
                'nbathroom'        => $this->m_txt_nbathroom,
                'cshort_content'   => $this->m_txt_cshort_content,
                'ccontent'         => $this->m_txt_ccontent,
                'cmaps_iframe'     => $this->m_txt_cmaps_iframe,
                'nstatus'          => $this->m_txt_nstatus,        
                'nproduct_status'  => $this->m_txt_nproduct_status, 
                'nactive'          => 1,
                'cimage'           => $this->m_txt_cimage,
				'cindex'           => $this->cindex,
                'niduser_created'  => $this->m_nid_user_login,
                'dcreated_at'      => $current_datetime,
                'dupdated_at'      => $current_datetime
            );
		
            $this->product_model->insert($data);
            $insert_id = $this->db->insert_id();

            // Lưu hoặc đính kèm tài liệu ngay khi insert thành công sản phẩm mới
            if ($insert_id > 0) {
                $this->save_product_documents_admin($insert_id, $this->m_txt_ccode);
            }
            return TRUE;
        }
        return FALSE;
    }

    private function update_data()
    {
        if ($this->check_valid_not_null() == TRUE)
        {
            $data = array(								
                'nid_cat_product'  => $this->m_cbo_nid_cat_product,
                'nid_province'     => $this->m_cbo_nid_province,
                'ccode'            => $this->m_txt_ccode,
                'ctitle'           => $this->m_txt_ctitle,
                'clocation_detail' => $this->m_txt_clocation_detail,
                'cprice_display'   => $this->m_txt_cprice_display,
                'nprice_value'     => $this->m_txt_nprice_value,
                'narea'            => $this->m_txt_narea,
                'nbedroom'         => $this->m_txt_nbedroom,
                'nbathroom'        => $this->m_txt_nbathroom,
                'cshort_content'   => $this->m_txt_cshort_content,
                'ccontent'         => $this->m_txt_ccontent,
                'cmaps_iframe'     => $this->m_txt_cmaps_iframe,
                'nstatus'          => $this->m_txt_nstatus,        
                'nproduct_status'  => $this->m_txt_nproduct_status, 
				'cindex'           => $this->cindex,
                'niduser_updated'  => $this->m_nid_user_login,
                'dupdated_at'      => date('Y-m-d H:i:s') 
            );

            if ($this->m_txt_cimage != '') {
                $path = '.././upload/images_product/full_images/';
                if(file_exists($path . $this->m_hidden_image_old) && !empty($this->m_hidden_image_old)) {
                    unlink($path . $this->m_hidden_image_old);
                }
                $data['cimage'] = $this->m_txt_cimage;
            }
			
            $this->product_model->update_bynid($this->m_nid, $data);
            
            // Cập nhật tài liệu vật lý hoặc thay đổi cấp độ kiểm soát truy cập từ admin
            $this->save_product_documents_admin($this->m_nid, $this->m_txt_ccode);
            return TRUE; 
        }
        return FALSE;
    }

    /**
     *-------------------------------------------------------------------
     * @description     : Hàm xử lý Upload tài liệu và Phân quyền tập trung trong CMS
     * @access          : private
     *-------------------------------------------------------------------
     */
    private function save_product_documents_admin($nid_product, $ccode)
    {
        $doc_types = array('contract', 'diagram', 'legal');
        $secure_path = '.././upload/document/';
        $current_datetime = date('Y-m-d H:i:s');

        // Tự động khởi tạo thư mục nếu chưa có
        if (!is_dir($secure_path)) {
            @mkdir($secure_path, 0777, true);
        }

        foreach ($doc_types as $type) {
            $file_field  = 'doc_file_' . $type;
            $level_field = 'doc_level_' . $type;
            
            $access_level = isset($_POST[$level_field]) ? (int)$_POST[$level_field] : 1;

            // Kiểm tra chắc chắn có file tải lên và không có lỗi upload
            if (isset($_FILES[$file_field]) && $_FILES[$file_field]['error'] == UPLOAD_ERR_OK && $_FILES[$file_field]['name'] != '') {
                
                $file_ext      = strtolower(pathinfo($_FILES[$file_field]['name'], PATHINFO_EXTENSION));
                $new_file_name = 'doc_' . $type . '_' . uniqid() . '_' . time() . '.' . $file_ext;
                $target_file   = $secure_path . $new_file_name;

                // Chuyển tệp tin vào thư mục upload/document/
                if (@move_uploaded_file($_FILES[$file_field]['tmp_name'], $target_file)) {
                    
                    $check = $this->db->query('SELECT nid, cfile_path FROM ' . Fget_ap_table('tdocument') . ' WHERE nid_product = ' . (int)$nid_product . ' AND ctype_doc = "' . $type . '" AND nstatus = 1')->row_array();

                    if (!empty($check)) {
                        // Xóa file cũ trên ổ cứng nếu đã tồn tại
                        if (file_exists($secure_path . $check['cfile_path']) && !empty($check['cfile_path'])) {
                            @unlink($secure_path . $check['cfile_path']);
                        }
                        
                        $this->db->where('nid', $check['nid']);
                        $this->db->update(Fget_ap_table('tdocument'), array(
                            'cfile_path'    => $new_file_name,
                            'naccess_level' => $access_level,
                            'dcreated_at'   => $current_datetime
                        ));
                    } else {
                        $data_doc = array(
                            'nid_product'   => (int)$nid_product,
                            'ctitle'        => 'Tai-lieu-' . $type . '-' . $ccode,
                            'cfile_path'    => $new_file_name,
                            'ctype_doc'     => $type,
                            'naccess_level' => $access_level,
                            'nstatus'       => 1,
                            'dcreated_at'   => $current_datetime
                        );
                        Finsert_data_global('tdocument', $data_doc);
                    }
                }
            } else {
                // Chỉ cập nhật lại cấp độ truy cập nếu không upload file mới
                $this->db->query('UPDATE ' . Fget_ap_table('tdocument') . ' SET naccess_level = ' . $access_level . ' WHERE nid_product = ' . (int)$nid_product . ' AND ctype_doc = "' . $type . '" AND nstatus = 1');
            }
        }
    }
	
	/**
     *-------------------------------------------------------------------
     * @description     : Hàm nhận Ajax xóa vĩnh viễn tệp tài liệu BĐS
     * @access          : public
     *-------------------------------------------------------------------
     */
    public function ajax_delete_document()
    {
        $doc_id = isset($_POST['doc_id']) ? (int)$_POST['doc_id'] : 0;
        
        if ($doc_id <= 0) {
            echo json_encode(array('status' => 'error', 'message' => 'Dữ liệu không hợp lệ!'));
            return;
        }

        $secure_path = '.././upload/document/';
        $check = $this->db->query('SELECT nid, cfile_path FROM ' . Fget_ap_table('tdocument') . ' WHERE nid = ' . $doc_id)->row_array();

        if (!empty($check)) {
            // Xóa file vật lý trong thư mục upload/document/
            if (file_exists($secure_path . $check['cfile_path']) && !empty($check['cfile_path'])) {
                @unlink($secure_path . $check['cfile_path']);
            }

            // Xóa record trong CSDL
            $this->db->where('nid', $doc_id);
            if ($this->db->delete(Fget_ap_table('tdocument'))) {
                echo json_encode(array('status' => 'success', 'message' => 'Đã xóa vĩnh viễn tệp tài liệu thành công!'));
                return;
            }
        }

        echo json_encode(array('status' => 'error', 'message' => 'Không tìm thấy tệp tài liệu cần xóa!'));
    }
}