<?php 
class ajax_product extends Controller {

var $data_view		 = '';
var $nid			 = '';

function ajax_product()
	{
		parent::Controller();
		session_start();
		$this->load->database();
		$this->load->helper('ap_db');
		$this->load->helper('ap_object');
		$this->load->helper('ap_function');
		$this->load->helper('ap_view');
		$this->load->helper('ap_module');
	
	}


function getid($nid)
	{
		$this->nid	= $nid;
		$this->do_process();
	}

// Dinh nghia ham rut gon khi set cookie cho cac bien.
//
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_home_'.$cookie_name,$cookie_value);
 }
 
// Dinh nghia ham rut gon khi get cookie cho cac bien.
//
private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_home_'.$cookie_name);
 }
	
// Dinh nghia ham rut gon khi set language cho cac label.
// 
private function m_language_key($str_key)
	{
		return $this->lang->line('lbl.home.'.$str_key);
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
		$obj_data	= get_product_byid($this->nid);
		
		$str_return='<div class="Tooltip_view">';
		$str_return .= '<div> <span style="color:#11539F;">'.$obj_data['cproducts'].'</span></div>'; 
			$price	= '';
			if($obj_data['fprice_sale'] != 0 && $obj_data['fprice_sale'] != '')
				$price	= show_price($obj_data['fprice_sale']).show_price_sale($obj_data['fprice']);
			else
				$price	= show_price($obj_data['fprice']);
			$str_return .= '<div style="margin-top:5px;"> <span style="color:red;"> Giá : '.$price.' VNĐ  </span></div>';
		$str_return .= '<br>';

		$str_return .= '<div style="max-width:300px; border-top:1px #ccc solid;">'.$obj_data['cdescription'].'</div>';
		$str_return.= '</div>';
		
		header("Content-Type: text/html; charset=UTF-8");				
		echo $str_return;
	}
	
private function destroy_data()
	{
			
	}
}