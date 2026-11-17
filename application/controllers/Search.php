<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend Real Estate Search System.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class search extends CI_Controller {

    var $event          = '';
    var $title          = 'Kết quả tìm kiếm bất động sản — PICO SAIGON';
    var $tags           = '';
    var $description    = ''; 
    
    var $nid_province   = 0;
    var $nid_cat        = 0;
    var $price_range    = '';
    var $m_where_clause = '';

    var $ncurr_page     = 1;
    var $nrow_per_page  = 12; 
    var $ntotal_page    = 0;

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
        $this->load->language('ap', 'eng');

        if (isset($_POST['txt_current_page'])) {
            $this->ncurr_page = max(1, (int)$_POST['txt_current_page']);
        }

        if (isset($_POST['cbo_nid_province'])) {
            $this->nid_province = (int)$_POST['cbo_nid_province'];
            $_SESSION['search_filter_province'] = $this->nid_province;
        } elseif (isset($_SESSION['search_filter_province'])) {
            $this->nid_province = $_SESSION['search_filter_province'];
        }

        if (isset($_POST['cbo_nid_cat_product'])) {
            $this->nid_cat = (int)$_POST['cbo_nid_cat_product'];
            $_SESSION['search_filter_cat'] = $this->nid_cat;
        } elseif (isset($_SESSION['search_filter_cat'])) {
            $this->nid_cat = $_SESSION['search_filter_cat'];
        }

        if (isset($_POST['cbo_price_range'])) {
            $this->price_range = trim($_POST['cbo_price_range']);
            $_SESSION['search_filter_price_range'] = $this->price_range;
        } elseif (isset($_SESSION['search_filter_price_range'])) {
            $this->price_range = $_SESSION['search_filter_price_range'];
        }
    }
	
    private function caculate_data()
    {
        // Xây dựng điều kiện WHERE lọc động bọc escape an toàn
        $str_where = ' WHERE a.nstatus = 1 ';
        
        if ($this->nid_province > 0) {
            $str_where .= ' AND a.nid_province = ' . (int)$this->nid_province . ' ';
        }
        if ($this->nid_cat > 0) {
            $str_where .= ' AND a.nid_cat_product = ' . (int)$this->nid_cat . ' ';
        }

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

        // ĐÃ GỘP HÀM: Gọi hàm đếm tổng từ Model riêng biệt vừa tạo
        $total_rows = get_count_search($this->m_where_clause);

        $this->ntotal_page = ceil($total_rows / $this->nrow_per_page);
        if ($this->ncurr_page > $this->ntotal_page) {
            $this->ncurr_page = max(1, $this->ntotal_page);
        }
    }
	
    private function do_business()
    {	
        $offset = ($this->ncurr_page - 1) * $this->nrow_per_page;

        $data['title']              = $this->title;
        $data['tags']               = $this->tags;
        $data['description']        = $this->description;
        
        $data['nid_province']       = $this->nid_province;
        $data['nid_cat']            = $this->nid_cat;
        $data['price_range']        = $this->price_range;
        
        $data['ncurr_page']         = $this->ncurr_page;
        $data['nrow_per_page']      = $this->nrow_per_page;
        $data['ntotal_page']        = $this->ntotal_page;
        
        // ĐÃ GỘP HÀM: Bốc danh sách phân trang gọn gàng từ Model
        $data['obj_search_result']  = get_list_search($this->m_where_clause, $offset, $this->nrow_per_page);
        $data['menu_top']           = 'search';	

        $this->load->view('search', $data);	
    }
	
    private function destroy_data()
    {
    }
}