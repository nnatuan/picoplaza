<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend Real Estate Main Listing System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class products extends CI_Controller
{
    var $event          = '';
    var $ccode_province = '';
    var $ccode_cat      = '';
    
    var $title          = 'Danh sách bất động sản toàn quốc — PICO SAIGON';
    var $tags           = '';
    var $description    = '';
    
    // Các tiêu chí lọc động nhận diện từ bộ lọc Sidebar bên hông
    var $nid_province   = 0;
    var $nid_cat        = 0;
    var $price_range    = '';
    var $m_where_clause = '';

    // Tham số cấu hình phân trang hệ thống
    var $ncurr_page     = 1;
    var $nrow_per_page  = 12; // Thiết lập hiển thị lưới 3 cột cân đối bên phải
    var $ntotal_page    = 0;
    var $ntotal_row     = 0;
    
    var $type_sort      = '';
    var $price          = '';
    var $sort_price     = '';

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

    // Các hàm Router Entrypoint của hệ thống URL Rewrite
    function set_page($type_sort, $page)
    {
        $this->type_sort = $type_sort;
        $this->ncurr_page = max(1, (int)$page);
        $this->do_process();
    }

    function set_page_cat($ccode_cat, $page)
    {
        $this->ccode_cat = trim($ccode_cat);
        $this->ncurr_page = max(1, (int)$page);
        $this->event = 'list_cat';
        $this->do_process();
    }

    function index()
    {	
        $this->do_process();
    }

    // Luồng xử lý dữ liệu tập trung
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }

    // 1. TIẾP NHẬN DỮ LIỆU TỪ BỘ LỌC HOẶC PHÂN TRANG
    private function get_data()
    {
        // Tiếp nhận số trang khi bấm nút chuyển trang
        if (isset($_POST['txt_current_page'])) {
            $this->ncurr_page = max(1, (int)$_POST['txt_current_page']);
        }

        // Đọc dữ liệu từ bộ lọc bên hông trái (Sidebar Filter)
        if (isset($_POST['cbo_nid_province'])) {
            $this->nid_province = (int)$_POST['cbo_nid_province'];
            $_SESSION['prod_filter_province'] = $this->nid_province;
        } elseif (isset($_SESSION['prod_filter_province'])) {
            $this->nid_province = $_SESSION['prod_filter_province'];
        }

        if (isset($_POST['cbo_nid_cat_product'])) {
            $this->nid_cat = (int)$_POST['cbo_nid_cat_product'];
            $_SESSION['prod_filter_cat'] = $this->nid_cat;
        } elseif (isset($_SESSION['prod_filter_cat'])) {
            $this->nid_cat = $_SESSION['prod_filter_cat'];
        }

        if (isset($_POST['cbo_price_range'])) {
            $this->price_range = trim($_POST['cbo_price_range']);
            $_SESSION['prod_filter_price_range'] = $this->price_range;
        } elseif (isset($_SESSION['prod_filter_price_range'])) {
            $this->price_range = $_SESSION['prod_filter_price_range'];
        }
    }

    // 2. XÂY DỰNG MỆNH ĐỀ WHERE VÀ TÍNH TOÁN SỐ TRANG
    private function caculate_data()
    {
        if ($this->ncurr_page == '' OR $this->ncurr_page < 1) {
            $this->ncurr_page = 1;
        }

        // Bắt đầu khởi tạo mệnh đề WHERE lọc sạch dính trạng thái hoạt động
        $str_where = ' WHERE a.nstatus = 1 ';

        // Trường hợp 1: Nếu người dùng đang xem theo SEO URL phân mục (Ví dụ: /products/set_page_cat/can-ho/1)
        if (!empty($this->ccode_cat)) {
            $str_where .= ' AND c.ccode = ' . $this->db->escape($this->ccode_cat) . ' ';
        }

        // Trường hợp 2: Thêm các điều kiện lọc chéo từ Sidebar Form nếu có chọn
        if ($this->nid_province > 0) {
            $str_where .= ' AND a.nid_province = ' . (int)$this->nid_province . ' ';
        }
        if ($this->nid_cat > 0) {
            $str_where .= ' AND a.nid_cat_product = ' . (int)$this->nid_cat . ' ';
        }

        // Phân tích khoảng ngân sách quy đổi ra số thực tế để truy vấn
        if ($this->price_range === 'under_2b') {
            $str_where .= ' AND a.nprice_value < 2000000000 ';
        } elseif ($this->price_range === '2b_5b') {
            $str_where .= ' AND a.nprice_value >= 2000000000 AND a.nprice_value <= 5000000000 ';
        } elseif ($this->price_range === '5b_10b') {
            $str_where .= ' AND a.nprice_value >= 5000000000 AND a.nprice_value <= 10000000000 ';
        } elseif ($this->price_range === 'over_10b') {
            $str_where .= ' AND a.nprice_value > 10000000000 ';
        }

        $this->m_where_clause = $str_where;

        // Gọi hàm helper dùng chung để đếm tổng số dòng dựa trên chuỗi WHERE vừa dựng
        $trow = get_count_search($this->m_where_clause);
		
        $this->ntotal_row = $trow;	
        $this->ntotal_page = ceil($trow / $this->nrow_per_page); // Áp dụng hàm ceil tính tổng số trang chuẩn xác
        
        if ($this->ncurr_page > $this->ntotal_page) {
            $this->ncurr_page = max(1, $this->ntotal_page);
        }
    }

    // 3. ĐÓNG GÓI DỮ LIỆU TRẢ VỀ VIEW SẢN PHẨM CHÍNH
    private function do_business()
    {
        $offset = ($this->ncurr_page - 1) * $this->nrow_per_page;
        
        // Cập nhật tiêu đề trang động cho tối ưu SEO
        if (!empty($this->ccode_cat)) {
            $this->title = "Bất động sản phân khúc " . uppercase_first($this->ccode_cat) . " — PICO SAIGON";
        }

        $data['title']          = $this->title;
        $data['tags']           = $this->tags;
        $data['description']    = $this->description;
        $data['ccode_cat']      = $this->ccode_cat;
        $data['ccode_province'] = $this->ccode_province;

        // Trả ngược trạng thái bộ lọc ra ngoài View để giữ các thẻ selected trong ô select
        $data['nid_province']   = $this->nid_province;
        $data['nid_cat']        = $this->nid_cat;
        $data['price_range']    = $this->price_range;

        $data['ncurr_page']     = $this->ncurr_page;
        $data['nrow_per_page']  = $this->nrow_per_page;
        $data['ntotal_page']    = $this->ntotal_page;
        $data['total_row']      = $this->ntotal_row;
        $data['type_sort']      = $this->type_sort;
        $data['sort_price']     = $this->sort_price;

        // Gọi hàm helper lấy danh sách sản phẩm phân trang sạch sẽ
        $data['obj_products_result'] = get_list_search($this->m_where_clause, $offset, $this->nrow_per_page);

        $this->load->view('products', $data);
    }

    private function destroy_data()
    {
    }
}
/* End of file Products.php */