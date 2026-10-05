<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class news_list extends CI_Controller
{
    var $event          = '';
    var $obj_news_list  = array();
    var $cur_page       = 1;
    var $nrow_per_page  = 9;
    var $ntotal_row     = 0;
    var $total_page     = 0;
    
    var $cat_param      = '0'; // Có thể là ID số hoặc ccode (slug)
    var $cat_info       = array();
    
    var $title          = 'BẢN TIN PICO PLAZA';
    var $tags           = '';
    var $description    = '';

    function __construct()
    { 
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_function', 'ap_object', 'ap_html', 'ap_view_helper', 'ap_db', 'ap_module'));
    }

    function cat_page($cat_param = '0', $page = 1)
    {
        $this->cat_param = trim($cat_param);
        $this->cur_page  = max(1, (int)$page);

        // Lấy thông tin tiêu đề danh mục nếu có
        if (!empty($this->cat_param) && $this->cat_param !== '0') {
            $this->cat_info = get_cat_news_info($this->cat_param);
            if (!empty($this->cat_info['ccat_news'])) {
                $this->title = $this->cat_info['ccat_news'];
            }
        }

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

    private function get_data()
    {
        if (isset($_POST['txt_current_page'])) {
            $this->cur_page = max(1, (int)$_POST['txt_current_page']);
        }
    }

    private function caculate_data()
    {
        if ($this->cur_page < 1) $this->cur_page = 1;

        // Truyền thẳng cat_param (ID hoặc ccode) vào hàm đếm và bốc danh sách
        $this->ntotal_row = get_count_news($this->cat_param);
		
        $this->total_page = ceil($this->ntotal_row / $this->nrow_per_page);
        if ($this->total_page < 1) $this->total_page = 1;
        
        if ($this->cur_page > $this->total_page) {
            $this->cur_page = $this->total_page;
        }

        $offset = ($this->cur_page - 1) * $this->nrow_per_page;

        $this->obj_news_list = get_list_news($this->cat_param, $offset, $this->nrow_per_page);
    }

    private function do_business()
    {
        $data['cat_param']     = $this->cat_param;
        $data['cat_info']      = $this->cat_info;
        $data['total_row']     = $this->ntotal_row;
        $data['row_per_page']  = $this->nrow_per_page;
        $data['total_page']    = $this->total_page;
        $data['cur_page']      = $this->cur_page;
        
        $data['title']         = $this->title;
        $data['tags']          = $this->tags;
        $data['description']   = $this->description;
        $data['obj_news_list'] = $this->obj_news_list;
        $data['menu_top']      = 'news';
        
        $this->load->view('news_list', $data);
    }
}