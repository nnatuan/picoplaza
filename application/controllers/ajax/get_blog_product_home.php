<?php 
class get_blog_product_home extends Controller {

var	$nid_cat_products		= '';
var $data_view				= '';

var $m_error_msg			= '';
 
function get_blog_product_home()
	{
		parent::Controller();
		session_start();
		$this->load->database();
		$this->load->helper('ap_db');
		$this->load->helper('ap_function');
		$this->load->helper('ap_view');
		$this->load->helper('ap_module');
		
	}

// Dinh nghia ham rut gon khi set cookie cho cac bien.
//
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_get_blog_product_home_'.$cookie_name,$cookie_value);
 }
 
// Dinh nghia ham rut gon khi get cookie cho cac bien.
//
private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_get_blog_product_home_'.$cookie_name);
 }
	
// Dinh nghia ham rut gon khi set language cho cac label.
// 
private function m_language_key($str_key)
	{
		return $this->lang->line('lbl.get_blog_product_home.'.$str_key);
	}

function get_blog_product($nid_cat_product = '')
	{
		$this->nid_cat_products	 = $nid_cat_product;
		$this->do_process();
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
		$this->load->language('ap', 'eng');
	}
	
private function caculate_data()
	{
		
	}
	
private function do_business()
	{	
		header("Content-Type: text/html; charset=UTF-8");
		$data['nid_cat_product']	= $this->nid_cat_products;
		$this->load->view('ajax/mod_blog_product', $data);
	}
	
private function destroy_data()
	{
				
	}

}