<?php
class Data_popup extends CI_Controller
{
    var $title = '';
    var $tags = '';
    var $description = '';

    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_object');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
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
        
    }

    private function caculate_data()
    {

    }
    private function do_business()
    {	
		$this->title = "Liên hệ";
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
        $data['menu_cat']    = '';
        $data['menu_news']   = '';
        $data['menu_top'] = 'data_popup';
		
        $this->load->view('ajax/data_popup', $data);
    }
    private function destroy_data()
    {
    }
}