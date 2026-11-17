<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class news extends CI_Controller
{
    var $event          = '';
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

    function index()
    {
        $this->do_process();
    }

    function do_process()
    {
        // Lấy danh sách toàn bộ nhóm tin (danh mục tcat_news)
        $categories = get_all_news_categories();
        $news_by_category = array();

        if (!empty($categories)) {
            foreach ($categories as $cat) {
                // Bốc 4 tin mới nhất trong mỗi nhóm
                $cat_news = get_news_by_cat_id($cat['nid'], 4);
                
                // Chỉ lấy nhóm nào thực sự có tin đăng
                if (!empty($cat_news)) {
                    // Xử lý Route Link chuyển trang theo yêu cầu: clink hoặc /ban-tin/ccode
                    $group_link = !empty($cat['clink']) ? $cat['clink'] : base_url() . 'news-list/' . $cat['ccode'];

                    $news_by_category[] = array(
                        'cat_info'  => $cat,
                        'cat_link'  => $group_link,
                        'news_list' => $cat_news
                    );
                }
            }
        }

        $data['title']            = $this->title;
        $data['tags']             = $this->tags;
        $data['description']      = $this->description;
        $data['news_by_category'] = $news_by_category;
        $data['menu_top']         = 'news';
        
        $this->load->view('news', $data);
    }
}