<?php
class about extends CI_Controller
{
    var $event = '';
    var $obj_about = '';
    var $m_language = 'eng';
    var $nid_material = '';
    var $nid_cat = '';
    var $title = '';
    var $tags = '';
    var $description = '';
	var $view_folder = '';
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
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_guide_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_about_' . $cookie_name);
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.about.' . $str_key);
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
    }
    private function caculate_data()
    {

    }
    private function do_business()
    {
        //$this->output->cache(10);
        $obj_data            = Bget_article(1);
        $data['title']       = "Giới thiệu";
        $data['tags']        = $obj_data['ctag'];
        $data['description'] = strip_tags($obj_data['cshort_content']);
        $data['menu_sec']    = '';
        $data['menu_cat']    = '';
        $data['menu_top']    = 'about';
        $data['g_ishome']    = 0;
        $data['obj_content'] = $obj_data;
		/*
		$menu_data = get_menu_frontend();
		$menu_tree = build_menu_tree($menu_data, 0);
		$data['menu_html'] = render_menu_tree($menu_tree, 'elementor-nav-menu');
		$data['mobile_menu_html'] = render_mobile_menu($menu_tree);
		*/
        $this->load->view('about', $data);
    }
    private function destroy_data()
    {
    }
    private function get_where_guide_string()
    {
        $str = 'where nstatus = "1"';
        return $str;
    }
}