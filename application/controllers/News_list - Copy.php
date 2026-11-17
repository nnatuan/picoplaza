<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend News & Blog Listing Portal.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class news_list extends CI_Controller
{
    var $event          = '';
    var $obj_news_list  = '';
    var $m_nid          = '';
    var $m_language     = 'eng';
    var $ctr_name       = '';
    
    // Cấu hình tham số phân trang đồng bộ hệ thống
    var $cur_page       = 1;
    var $nrow_per_page  = 9; // Để số 9 để chia lưới Grid 3 cột cực kỳ vuông vắn và cân đối
    var $ntotal_row     = 0;
    var $total_page     = 0;
    
    var $nid_section    = '';
    var $nid_cat        = 0;
    
    var $title          = 'Bản tin PICO PLAZA';
    var $tags           = '';
    var $description    = '';
    var $view_folder    = '';

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

    function cat($nid_cat)
    {
        $this->nid_cat  = max(0, (int)$nid_cat);
        $this->event    = 'view_cat';
        $this->do_process();
    }

    function cat_page($nid_cat, $page)
    {
        $this->nid_cat  = max(0, (int)$nid_cat);
        $this->cur_page = max(1, (int)$page);
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
        $this->destroy_data();
    }

    private function get_data()
    {
        // Tiếp nhận giá trị trang hiện tại nếu có hành động chuyển trang POST lên
        if (isset($_POST['txt_current_page'])) {
            $this->cur_page = max(1, (int)$_POST['txt_current_page']);
        }
    }

    private function caculate_data()
    {
        if ($this->cur_page == '' OR $this->cur_page < 1) {
            $this->cur_page = 1;
        }

        // ĐÃ CẬP NHẬT: Gọi hàm đếm tổng tin tức hoạt động từ helper toàn cục vừa xây dựng
        $this->ntotal_row = get_count_news($this->nid_cat);
		
        // Tính toán tổng số trang bằng toán học chuẩn xác
        $this->total_page = ceil($this->ntotal_row / $this->nrow_per_page);
        
        if ($this->cur_page > $this->total_page) {
            $this->cur_page = max(1, $this->total_page);
        }

        $offset = ($this->cur_page - 1) * $this->nrow_per_page;

        // ĐÃ CẬP NHẬT: Gọi hàm bốc danh sách phân trang sạch sẽ kết hợp Explicit Join từ helper
        $this->obj_news = get_list_news($this->nid_cat, $offset, $this->nrow_per_page);
        
        $this->event = $this->event == '' ? 'view' : $this->event;
    }

    private function do_business()
    {
        // Đổi title động nếu đang đứng ở danh mục cụ thể và bảng tcat_news có hàm hỗ trợ lấy tên
        if ($this->nid_cat > 0 && function_exists('get_cat_news_title')) {
            $cat_title = get_cat_news_title($this->nid_cat);
            if (!empty($cat_title)) {
                $this->title = "Danh mục tin tức: " . $cat_title . " — PICO SAIGON";
            }
        }

        $data['event']         = $this->event;
        $data['nid_cat']       = $this->nid_cat;
        $data['nid_sec']       = $this->nid_section;
        $data['total_row']     = $this->ntotal_row;
        $data['row_per_page']  = $this->nrow_per_page;
        $data['total_page']    = $this->total_page;
        $data['cur_page']      = $this->cur_page;
        
        $data['title']         = $this->title;
        $data['tags']          = $this->tags;
        $data['description']   = $this->description;
        $data['obj_news_list'] = $this->obj_news;
        
        $data['menu_sec']      = '';
        $data['menu_cat']      = '';
        $data['menu_top']      = 'news_list';
        
        $this->load->view('news_list', $data);
    }

    private function destroy_data()
    {
    }
}
/* End of file News_list.php */