<?php 
class complete_cart extends CI_Controller {

var $event 				= '';
var	$obj_complete_cart		='';
var $m_language			='eng';

var $nid_material		= '';
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
		$this->load->helper('ap_cart');
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
	return dbget_cookie('cookie_complete_cart_'.$cookie_name);
 }
	
// Dinh nghia ham rut gon khi set language cho cac label.
// 
private function m_language_key($str_key)
{
	return $this->lang->line('lbl.complete_cart.'.$str_key);
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

	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']			= 'complete_cart';
	
	/*
	$menu_data = get_menu_frontend();
	$menu_tree = build_menu_tree($menu_data, 0);
	$data['menu_html'] = render_menu_tree($menu_tree, 'elementor-nav-menu');
	$data['mobile_menu_html'] = render_mobile_menu($menu_tree);	
	*/
	$this->load->view('complete_cart',$data);	
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