<?php
class data_comment extends CI_Controller
{
    var $data_view = '';
    var $title = '';
    var $tags = '';
    var $description = '';

	var $cname = '';
    var $cemail = '';
    var $cphone = '';
	var $ccontent = '';
	var $nid_product = '';
	
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
		if (isset($_POST['cname']))
            $this->cname = $_POST['cname'];
        if (isset($_POST['cemail']))
            $this->cemail = $_POST['cemail'];
        if (isset($_POST['cphone']))
            $this->cphone = $_POST['cphone'];
		if (isset($_POST['ccontent']))
            $this->ccontent = $_POST['ccontent'];
		if (isset($_POST['nid_product']))
            $this->nid_product = $_POST['nid_product'];
    }
    private function caculate_data()
    {
        $data = array(
            "cname" => $this->cname,
            "cemail" => $this->cemail,
            "cphone" => $this->cphone,
            "ccontent" => $this->ccontent,
			"nid_product" => $this->nid_product,
            "nstatus" => 1,
            "ddate01" => dbget_current_date()
        );
        $this->db->insert("tcomment", $data);
		exit("done");
    }
    private function do_business()
    {
    //$this->output->cache(10);
        $data['title']        = $this->title;
        $data['tags']         = $this->tags;
        $data['description']  = $this->description;
        $data['menu_sec']     = '';
        $data['menu_cat']     = '';
        $data['menu_top']     = 'data_comment';
        $data['g_isdata']     = 0;
        $this->load->view('data_comment', $data);
    }
    private function destroy_data()
    {
    }
}