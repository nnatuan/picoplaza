<?php 
class article extends CI_Controller {

var $event 				= '';
var	$obj_about			='';
var $m_language			='eng';
var $ccode		= '';
var $nid		= '';
var $nid_cat			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 
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
function detail_code($ccode)	
{
	$this->ccode = $ccode;
	$this->do_process();

}

private function get_data()
{  
	
}
	
private function caculate_data()
{

}
	
private function do_business()
{	
	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	$data['nid']			= $this->nid;
	$data['ccode']			= $this->ccode;
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= $this->nid;
	$data['g_ishome']		= 0;
	$data['view_folder']    = $this->view_folder;
	$this->load->view('article',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_guide_string()
{
		

		return $str ;
}

}