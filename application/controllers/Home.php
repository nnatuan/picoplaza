<?php
class home extends CI_Controller
{
    var $data_view = '';
    var $title = '';
    var $tags = '';
    var $description = '';
    var $curr_page = '';
    var $row_per_page = '18';
    var $total_page = '';
    var $ntotal_row = 0;
	var $view_folder = '';
	var $cname	= '';
	var $cphone	= '';
	var $cloai_phong	= '';
	var $cnguoi_lon ='';
	var $ctre_em ='';
	var $btn_submit ='';
	
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
        if(isset($_POST['btn_submit']))
			$this->btn_submit = $_POST['btn_submit'];
		if(isset($_POST['cname']))
			$this->cname = $_POST['cname'];
		if(isset($_POST['cphone']))
			$this->cphone = $_POST['cphone'];
		if(isset($_POST['cloai_phong']))
			$this->cloai_phong = $_POST['cloai_phong'];
		if(isset($_POST['cnguoi_lon']))
			$this->cnguoi_lon = $_POST['cnguoi_lon'];	
		if(isset($_POST['ctre_em']))
			$this->ctre_em = $_POST['ctre_em'];	
    }
    private function caculate_data()
    {
        $obj_data = get_config_byid(3);
        foreach ($obj_data as $data):
            $this->title = $data['cvalue'];
        endforeach;
        $obj_data = get_config_byid(2);
        foreach ($obj_data as $data):
            $this->tags = $data['cvalue'];
        endforeach;
        $obj_data = get_config_byid(4);
        foreach ($obj_data as $data):
            $this->description = $data['cvalue'];
        endforeach;

    }

    private function do_business()
    {
    //$this->output->cache(10);
        $data['title']        = $this->title;
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_top']     = 'home';

        $this->load->view('home', $data);
    }
    private function destroy_data()
    {
    }
}