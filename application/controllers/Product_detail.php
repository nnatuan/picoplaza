<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend Product Detail System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Product_detail extends CI_Controller
{
    var $event        = '';
    var $title        = 'Chi tiết bất động sản — PICO SAIGON';
    var $tags         = '';
    var $description  = '';
    var $m_ccode      = ''; // Chứa mã slug URL của sản phẩm cần xem

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

    function view($ccode = '')
    {
        $this->m_ccode = trim($ccode);
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
        $this->load->language('ap', 'eng');
    }

    private function caculate_data()
    {
        if ($this->m_ccode == '') {
            redirect(base_url());
        }
    }

    private function do_business()
    {
        // Gọi hàm helper đóng gói sạch sẽ lấy chi tiết BĐS
        $product = get_product_detail($this->m_ccode);

        // Nếu sản phẩm không tồn tại hoặc bị ẩn, đẩy về trang chủ công khai
        if (empty($product)) {
            redirect(base_url());
        }

        // Đổ cấu hình tiêu đề SEO mượt mà theo tên BĐS chính chủ
        $data['title']        = $product['ctitle'] . ' — PICO SAIGON';
        $data['tags']         = $this->tags;
        $data['description']  = !empty($product['cshort_content']) ? $product['cshort_content'] : $this->description;
        $data['menu_top']     = 'product_detail';

        // Đóng gói trả thông tin sản phẩm ra ngoài View
        $data['product']      = $product;
		
        // Bốc thông tin liên hệ của chính chủ Thành viên tmember đăng tin này
        $data['owner']        = get_member_owner_listing($product['niduser_created']);
		
		// Tính toán cấp quyền của user và bốc tài liệu đính kèm tương ứng
        //$current_level          = check_current_user_level();
        //$data['document_list']  = get_product_documents($product['nid'], $current_level);
		$data['document_list'] = get_product_documents($product['nid']);
		
        // Lấy danh sách tin đăng cùng nhóm loại hình liên quan (Trừ chính nó)
        $data['obj_product_relate'] = get_product_related($product['nid_cat_product'], $product['nid'], 3);

        $this->load->view('product_detail', $data);    
    }

    private function destroy_data()
    {
    }
}