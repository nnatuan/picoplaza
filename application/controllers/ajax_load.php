<?php 
class ajax_load extends Controller {

var $event 				= '';
var	$obj_ajax			='';
var $m_language			='eng';

var $nid_material		= '';
var $nid_cat			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 

function ajax_load()
	{
		parent::Controller();	
		session_start();
		
		$this->load->database();	
		$this->load->helper('ap_function');
		$this->load->helper('ap_object');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view_helper');
		$this->load->helper('ap_db');
//		$this->load->helper('ap_module');		

	}

// Dinh nghia ham rut gon khi set cookie cho cac bien.
//
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_guide_'.$cookie_name,$cookie_value);
 }
 
// Dinh nghia ham rut gon khi get cookie cho cac bien.
//
private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_ajax_'.$cookie_name);
 }
	
// Dinh nghia ham rut gon khi set language cho cac label.
// 
private function m_language_key($str_key)
{
	return $this->lang->line('lbl.ajax.'.$str_key);
}


function load()
{
	
	
	$id= '44';
	$field  = 'cvitri';
	if(isset($_POST['id']))	
		$id = $_POST['id'];

	if(isset($_POST['field']))	
		$field = $_POST['field'];
	$this->db->select($field);
	$this->db->where('nid',$id);
	$obj_result = $this->db->get('tproducts');
	$obj_result = $obj_result->row_array();
	exit($obj_result[$field]);
		
}
function index()
{
	//$this->do_process();
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
	$this->load->language('ap', $this->m_language);
}
	
private function do_business()
{	
	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= 'ajax';
	$data['g_ishome']		= 0;

	//$this->load->view('ajax',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_guide_string()
{
		$str		= 'where nstatus = "1"';	
		//$str	   .= 'AND ccode_cat_news = "'.$this->m_nid_cat_news.'" ';
//Dieu kien get record nstatus
//0:Khong active
//1:Active

		return $str ;
}

}