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
    
    var $m_where_clause = '';

    // Cấu hình phân trang: 12 item để chia 3 cột cực kỳ cân đối (4 hàng)
    var $ncurr_page     = 1;
    var $nrow_per_page  = 12; 
    var $ntotal_page    = 0;
    var $ntotal_row     = 0;
    
    var $type_sort      = '';

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

    function set_page($type_sort, $page)
    {
        $this->type_sort  = $type_sort;
        $this->ncurr_page = max(1, (int)$page);
        $this->do_process();
    }

    function set_page_cat($ccode_cat, $page)
    {
        $this->ccode_cat  = trim($ccode_cat);
        $this->ncurr_page = max(1, (int)$page);
        $this->event      = 'list_cat';
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
        if (isset($_POST['txt_current_page'])) {
            $this->ncurr_page = max(1, (int)$_POST['txt_current_page']);
        }
    }

    private function caculate_data()
    {
        if ($this->ncurr_page == '' OR $this->ncurr_page < 1) {
            $this->ncurr_page = 1;
        }

        $str_where = ' WHERE a.nstatus = 1 ';

        // Lọc theo SEO URL Danh mục nếu có
        if (!empty($this->ccode_cat)) {
            $str_where .= ' AND c.ccode = ' . $this->db->escape($this->ccode_cat) . ' ';
        }

        $this->m_where_clause = $str_where;

        // Đếm tổng số tin
        $trow = get_count_search($this->m_where_clause);
		
        $this->ntotal_row  = $trow;	
        $this->ntotal_page = ceil($trow / $this->nrow_per_page);
        
        if ($this->ncurr_page > $this->ntotal_page) {
            $this->ncurr_page = max(1, $this->ntotal_page);
        }
    }

    private function do_business()
    {
        $offset = ($this->ncurr_page - 1) * $this->nrow_per_page;
        
        if (!empty($this->ccode_cat)) {
            $this->title = "Bất động sản phân khúc " . uppercase_first($this->ccode_cat) . " — PICO SAIGON";
        }

        $data['title']          = $this->title;
        $data['tags']           = $this->tags;
        $data['description']    = $this->description;
        $data['ccode_cat']      = $this->ccode_cat;
        $data['ccode_province'] = $this->ccode_province;

        $data['ncurr_page']     = $this->ncurr_page;
        $data['nrow_per_page']  = $this->nrow_per_page;
        $data['ntotal_page']    = $this->ntotal_page;
        $data['total_row']      = $this->ntotal_row;

        // Bốc danh sách tin BĐS
        $data['obj_products_result'] = get_list_search($this->m_where_clause, $offset, $this->nrow_per_page);

        $this->load->view('products', $data);
    }

    private function destroy_data()
    {
    }
}