<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Tokaban Standard System
 *
 * Tokaban framework for PHP
 *
 * @package		tkb_standard_system
 * @author		Tokaban R&D Team
 * @copyright	Copyright (c) 2009, Tokaban, Inc. 
 * @since		Version 2.0
 *   
 */ 
   
// ------------------------------------------------------------------------
class do_login extends CI_Controller 
{	
	var $m_language 		= ''; 
	var $m_nid_user 		= ''; 
			 
	var $m_link_page		= ''; 
	var $m_event_index		= ''; 
	var $m_view_index		= '';
	 
	var $m_error_message	= '';
	var $m_form_title		= '';
	var $m_txt_user_name	= ''; 
	var $m_txt_password		= ''; 
	// ------------------------------------------------------------------------
	
/** 
 * Constructor
 *
 * Load cac thu vien can su dung cho class 
 *
 * @access	public 
 */	
function __construct()
	{ 
		parent::__construct();  
		session_start();
		$this->load->database();
		$this->load->helper('ap_function');
		$this->load->helper('ap_db');
		$this->load->helper('ap_html');
		$this->load->helper('ap_object');		
				
		// BAT TRANG THAI DA DUOC LOGIN.
		// SU DUNG HOOK DE KIEM TRA.
		//$this->tokaban_system_check = '2'; 
		$this->config->check_system_login = '2';
		// 
		// CAC DINH NGHIA CAN THIET KHAC
		// 
	} 
	
	// ------------------------------------------------------------------------
	
/**
 * Goi tuan tu cac ham theo dung quy dinh ve luong du lieu
 * 
 * @access	public
 */		
function index()
	{
		$this->do_process();
	}		
	
	// ------------------------------------------------------------------------

/**
 * Goi tuan tu cac ham theo dung quy dinh ve luong du lieu
 * 
 * @access	public
 */		
private function do_process()
	{
		$this->get_data(); 
		$this->caculate_data(); 
		$this->do_business();
		$this->destroy_data();
	}		
	
/**
 * Khong can xu ly
 *  
 * @access	private
 */	
private function get_data()
	{		
		$this->m_language = Fget_userdata('session_user_language');										
		$this->m_nid_user = Fget_userdata('session_nid_user');
		
		// Your code at here
		if(isset($_POST['txt_user_name']))
				$this->m_txt_user_name 		= $_POST['txt_user_name'];
	
		if(isset($_POST['txt_password']))
				$this->m_txt_password 		= $_POST['txt_password'];
				
		if(isset($_POST['hidden_button']))
				$this->m_event_index 		= $_POST['hidden_button'];		
	}

	// ------------------------------------------------------------------------
	
/**
 * Khong can xu ly
 *
 * @access	private
 */		
private function caculate_data()
	{		
		
		$this->load->language('ap',$this->m_language);
		// Your code at here
				
		//
		// Cac truong hop khac
		//					
		$this->m_view_index 	= 'login_view';
		$this->m_link_page 		= base_url().'index.php/do_login';
	}
	
	// ------------------------------------------------------------------------
	
/**
 * Thiet lap cac session dung chung cho toan he thong 
 * Redirect do_login controller
 *
 * @access	private
 */		

function get_barcode($code){
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');

		//generate barcode
		//$temp = rand(10000, 99999);
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());//exit("a");
		//<img src="http://nhapchuot.net/demo/new_project/admin/index.php/do_login/get_barcode/99998888"/>

}
function get_qrcode(){

	$this->load->library('ciqrcode');

header("Content-Type: image/png");
$temp = rand(10000, 99999);
$params['data'] = "http://nhapchuot.net/demo/new_project/admin";
$this->ciqrcode->generate($params);exit("aa");
}
private function do_business()
	{			
		//
		// Kiem tra dieu kien login		
		//

		
		if(trim($this->m_event_index)=='btn_login')
			if($this->check_valid_login()===TRUE) 
				//redirect ('do_config_listview');
				redirect ('do_home');
		//
		// Dinh nghia thong tin chung cua he thong can su dung trong view 
		//
		
		
		//
		// Dinh nghia cac thong tin rieng can su dung trong view
		//
		
		$data['link_page']        		= $this->m_link_page;
		
		$data['lbl_form_title']        	= $this->lang->line('lbl.0001.FormTitle');
		$data['lbl_form_slogan']       	= $this->lang->line('lbl.0001.FormSlogan');
		
		$data['lbl_user_name']			= $this->lang->line('lbl.0001.UserName');
		$data['lbl_password']			= $this->lang->line('lbl.0001.Password');
		
		$data['btn_login'] 	        	= $this->lang->line('btn.0001.Login');
				
		$data['error_message'] 			= $this->m_error_message;
		
		$data['txt_user_name'] 			= $this->m_txt_user_name;
		$data['event'] 			= 'login';
		$data['txt_password'] 			= '';
		$data['fr_img']              = Fstr_replace('admin/', '', base_url());
		$data['menu_active']			= 'login';
		$data['base_url_admin']	= Fstr_replace(Fget_admin_folder(),'',base_url());
		// LOAD view tuong ung theo su kien bien dieu khien $m_event
		$this->load->view('login_view/index', $data);
	}
		
	// ------------------------------------------------------------------------
	
/**
 * Khong can xy ly
 *
 * @access	private
 */	
private function destroy_data()
	{
		
	}

//
// DINH NGHIA CAC HAM LOGIC CAN THIET KHAC TAI DAY
//
private function check_valid_login()
	{
		// Kiem tra user dang nhap khong duoc phep rong
		if (trim($this->m_txt_user_name)=='')
		{
			$this->m_error_message = $this->lang->line('lbl.0001.UserName') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		// Kiem tra thong tin mat khau khong duoc phep rong
		if (trim($this->m_txt_password)=='')
		{
			$this->m_error_message = $this->lang->line('lbl.0001.Password') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
				
		// Kiem tra thong tin user va mat khau ton tai trong he thong du lieu
		$nid_user = Obj_is_user($this->m_txt_user_name,$this->m_txt_password);

		if ($nid_user=='invalid')
			{
				//$this->m_error_message =  $this->lang->line('err.0001.unsuccess_login'); 
				$this->m_error_message =  "Username or Password is incorrect";
				return FALSE;
			}
		else // Xu ly truong hop dang nhap thong tin thanh cong
			{
				// Cap nhat thong tin dang nhap vao he thong
				$arr_data =	array(
					'nid_user'			=> $nid_user,
					'cstatus'			=> '1',
					);
				$this->db->where('cid_session',Fget_userdata('session_working'));
				$this->db->update(Fget_ap_table('tsession'), $arr_data);
				
				// Xac dinh bo sung cac thong tin login		
				$obj_user_row = Obj_get_user_datarow($nid_user);
				//$str_user_fullname= $obj_user_row['cfirstname'] . ' ' . $obj_user_row['cmiddlename'] . ' ' . $obj_user_row['clastname'];
				$str_user_fullname= $obj_user_row['cfullname'];
				
				//Fset_userdata('session_user_name',$obj_user_row['cuserid']);
				Fset_userdata('session_nid_user',$nid_user);
				Fset_userdata('session_user_full_name',$str_user_fullname);
				Fset_userdata('session_user_role',$obj_user_row['crole']);
				Fset_userdata('session_avatar',$obj_user_row['cavatar']);
				
				//Fset_userdata('session_user_permission','');
				//Fset_userdata('session_user_menu_permission','');
				//Fset_userdata('session_user_organization_permission','');
				//Fset_userdata('session_user_management','');				
				return TRUE;
			}							
	}

// END do_init class
}		
/* End of file do_init.php */
/* Location: controller/do_init.php */