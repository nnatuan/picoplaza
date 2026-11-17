<?php 
class booking extends CI_Controller {

var $event 				= '';
var	$obj_about			='';
var $m_language			='eng';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 
var $cqty = '';
var $cphone = '';
var $cdate = '';
var $btn_submit = '';
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
function detail($nid)	
{
	$this->nid = $nid;
	$this->do_process();

}
private function get_data()
{  
	if (isset($_POST['cqty']))
            $this->cqty = $_POST['cqty'];
        if (isset($_POST['cphone']))
            $this->cphone = $_POST['cphone'];
		 if (isset($_POST["cdate"]))
            $this->cdate = $_POST["cdate"];
		if (isset($_POST["btn_submit"]))
            $this->btn_submit = $_POST["btn_submit"];
}
	
private function caculate_data()
{
	if ($this->btn_submit != '') {
		$data           = array(
            "cqty" => $this->cqty,
            "cphone" => $this->cphone,
			"cdate" => $this->cdate,
			"ctime" => time(),
        );
        $this->db->insert("tregister", $data);
		redirect(base_url() . 'hoan-tat-dat-ban');
    }
}
	
private function do_business()
{	
	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	$data['nid']			= $this->nid;
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= 'booking';
	$this->load->view('booking',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_guide_string()
{
		

		return $str ;
}

}