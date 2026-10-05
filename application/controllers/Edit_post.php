<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend - Member Edit Post Listing System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class edit_post extends CI_Controller
{
    var $title        = 'Sửa tin đăng bất động sản — PICO SAIGON';
	var $tags         = '';
    var $description  = '';
    var $m_error_msg  = '';
    var $m_product_id = 0;

    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_object');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view_helper');
        $this->load->helper('ap_db');
        $this->load->helper('ap_module');
    }

    function index($nid = 0)
    {
        $this->m_product_id = Fconvert_to_int($nid);
        if ($this->m_product_id <= 0) {
            redirect(base_url() . 'my_posts');
        }

        $this->do_process();
    }

    private function do_process()
    {
        // 1. Chặn bảo mật đăng nhập
        if (!isset($_SESSION['session_nid_member'])) {
            redirect(base_url() . 'auth');
        }

        // 2. Lấy dữ liệu bài đăng gốc phục vụ đối soát chính chủ
        $str_query = 'SELECT * FROM ' . Fget_ap_table('tproduct') . ' WHERE nid = ' . $this->m_product_id . ' LIMIT 0,1';
        $product = $this->db->query($str_query)->row_array();

        if (empty($product) || $product['niduser_created'] != $_SESSION['session_nid_member']) {
            redirect(base_url() . 'index.php/my_listing'); // Không phải chính chủ thì trả về danh sách
        }

        // 3. Tiếp nhận xử lý sự kiện khi bấm nút Lưu cập nhật
        if (isset($_POST['hidden_action']) && $_POST['hidden_action'] === 'edit_post') {
            $this->process_update_listing($product);
        }

        $this->do_business($product);
    }

    private function process_update_listing($old_product)
    {
        $txt_ctitle           = trim($_POST['txt_ctitle']);
		$txt_ccode            = $_POST['txt_ccode'];
        $cbo_nid_cat_product  = $_POST['cbo_nid_cat_product'];
        $cbo_nid_province     = $_POST['cbo_nid_province'];
        $txt_clocation_detail = trim($_POST['txt_clocation_detail']);
        $txt_cprice_display   = trim($_POST['txt_cprice_display']);
        $txt_nprice_value     = Fconvert_to_int(str_replace('.', '', $_POST['txt_nprice_value']));
        $txt_narea            = (double)$_POST['txt_narea'];
        $txt_nbedroom          = Fconvert_to_int($_POST['txt_nbedroom']);
        $txt_nbathroom         = Fconvert_to_int($_POST['txt_nbathroom']);
        $txt_cshort_content   = trim($_POST['txt_cshort_content']);
        $txt_ccontent         = trim($_POST['txt_ccontent']);
        $txt_cmaps_iframe     = trim($_POST['txt_cmaps_iframe']);

        if (
            $txt_ctitle == '' || $cbo_nid_cat_product == 0 || $cbo_nid_province == 0 ||
            $txt_clocation_detail == '' || $txt_cprice_display == '' || $txt_nprice_value <= 0 || $txt_narea <= 0
        ) {
            $this->m_error_msg = 'Vui lòng điền đầy đủ các thông số bắt buộc của bất động sản!';
            return;
        }

        // Xử lý cập nhật ảnh đại diện mới nếu có tải lên (Xóa ảnh cũ để dọn dẹp server)
        $new_image = $old_product['cimage'];
        if (isset($_FILES["txt_cimage"]) && $_FILES["txt_cimage"]["name"] != '') {
            $path = FCPATH . 'upload/images_product/full_images/';
            if (!empty($old_product['cimage']) && file_exists($path . $old_product['cimage'])) {
                @unlink($path . $old_product['cimage']);
            }
            $new_image = Fupload_resize_img($_FILES["txt_cimage"], $path, 2000, 1000);
        }

        $current_datetime = date('Y-m-d H:i:s');
        $data_update = array(
			'nstatus'  => 0, 
            'nid_cat_product'  => $cbo_nid_cat_product,
            'nid_province'     => $cbo_nid_province,
            'ctitle'           => $txt_ctitle,
			'ccode'            => $txt_ccode,
            'clocation_detail' => $txt_clocation_detail,
            'cprice_display'   => $txt_cprice_display,
            'nprice_value'     => $txt_nprice_value,
            'narea'            => $txt_narea,
            'nbedroom'         => $txt_nbedroom,
            'nbathroom'        => $txt_nbathroom,
            'cshort_content'   => $txt_cshort_content,
            'ccontent'         => $txt_ccontent,
            'cmaps_iframe'     => $txt_cmaps_iframe,
            'cimage'           => $new_image,
            'dupdated_at'      => $current_datetime
        );

        $this->db->where('nid', $this->m_product_id);
        if ($this->db->update(Fget_ap_table('tproduct'), $data_update)) {
            
            // Xử lý tệp tin hồ sơ đính kèm (Upload đè dọn dẹp dung lượng server giống Admin)
            $doc_types = ['contract', 'diagram', 'legal'];
            $secure_path = FCPATH . 'upload/document/';

            foreach ($doc_types as $type) {
                $file_field = 'doc_file_' . $type;
                if (isset($_FILES[$file_field]) && $_FILES[$file_field]['name'] != '') {
                    
                    // Xóa file cũ trên server nếu đã tồn tại trước đó
                    $str_doc_query = 'SELECT cfile_path FROM ' . Fget_ap_table('tdocument') . ' WHERE nid_product = ' . $this->m_product_id . ' AND ctype_doc = "' . $type . '" LIMIT 0,1';
                    $old_doc = $this->db->query($str_doc_query)->row_array();
                    if (!empty($old_doc) && file_exists($secure_path . $old_doc['cfile_path'])) {
                        @unlink($secure_path . $old_doc['cfile_path']);
                    }

                    $file_ext = pathinfo($_FILES[$file_field]['name'], PATHINFO_EXTENSION);
                    $new_file_name = 'doc_' . $type . '_' . uniqid() . '_' . time() . '.' . $file_ext;
                    
                    if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $secure_path . $new_file_name)) {
                        
                        if (!empty($old_doc)) {
                            // Nếu đã có bản ghi từ trước -> Update đè đường dẫn tệp mới
                            $this->db->where(array('nid_product' => $this->m_product_id, 'ctype_doc' => $type));
                            $this->db->update(Fget_ap_table('tdocument'), array('cfile_path' => $new_file_name, 'dcreated_at' => $current_datetime));
                        } else {
                            // Nếu chưa có bản ghi -> Thêm mới hoàn toàn bản ghi hồ sơ
                            $data_doc = array(
                                'nid_product'   => $this->m_product_id,
                                'ctitle'        => 'Tai-lieu-' . $type . '-' . $old_product['ccode'],
                                'cfile_path'    => $new_file_name,
                                'ctype_doc'     => $type,
                                'naccess_level' => 1, 
                                'nstatus'       => 1,
                                'dcreated_at'   => $current_datetime
                            );
                            Finsert_data_global('tdocument', $data_doc);
                        }
                    }
                }
            }

            redirect(base_url() . 'complete_post');
        } else {
            $this->m_error_msg = 'Đã có lỗi xảy ra khi cập nhật dữ liệu!';
        }
    }

    private function do_business($product)
    {
        $data['title']        = $this->title;
		$data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['m_message']    = $this->m_error_msg;
        $data['product']      = $product;

        // Bốc danh sách hồ sơ hiện tại để check sự tồn tại của file trên server
        $str_doc_query = 'SELECT ctype_doc, cfile_path FROM ' . Fget_ap_table('tdocument') . ' WHERE nid_product = ' . $this->m_product_id;
        $existing_docs = $this->db->query($str_doc_query)->result_array();
        
        $docs_mapped = array();
        foreach ($existing_docs as $d) {
            $docs_mapped[$d['ctype_doc']] = $d['cfile_path'];
        }
        $data['existing_docs'] = $docs_mapped;

        $data['obj_cat_product'] = get_active_cat_product();
        $data['obj_province']    = get_active_province(); 

        $this->load->view('edit_post', $data);    
    }
}