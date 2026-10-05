<?php
class ajax_load_product_sec extends CI_Controller
{
    var $data_view = '';
    var $title = '';
    var $tags = '';
    var $description = '';
	var $view_folder = '';
    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');
        $this->load->helper('ap_object');
        $this->load->helper('ap_function');
        $this->load->helper('ap_view');
        $this->load->helper('ap_module');
        reset_page();
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
		$this -> load -> library('Mobile_Detect');
    	$detect = new Mobile_Detect();
    	if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
        	$this->view_folder ='mobile';
    	}else
    		$this->view_folder ='desktop';
    }
    private function do_business()
    {
    //$this->output->cache(10);
        $data['title']        = $this->title;
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_top']     = 'ajax_load_product_sec';
		$data['view_folder']    = $this->view_folder;
        $this->load->view($this->view_folder.'/ajax/load_product_sec', $data);
    }
    private function destroy_data()
    {
    }
}