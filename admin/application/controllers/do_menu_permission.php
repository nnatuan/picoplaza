<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 * 				: an_hm87
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */   
  
/**
 *------------------------------------------------------------------
 * do_department_permission class 
 *
 * Quan ly danh muc thanh pho
 *
 * @subpackage	controllers 
 * @category	
 * @author		Hoang Minh An
 *------------------------------------------------------------------
 */	
 
class do_menu_permission extends Controller 
{ 	 
		// Cac bien bat buoc phai co 
		// de chay cac ham co ban cua lop 
		var $m_language   					= ''; 	 
		var $m_nid_user_login   			= ''; 
		
		var	$m_link_page  					= '';
		var $m_button_click					= '';
		var $m_event         				= '';
		  
		var $m_user_where_clause   			= ''; 			
		var $m_department_where_clause   	= ''; 			
				
		// Cac bien tuy bien cua lop doi tuong 
		var $m_txtf_user_name 				= '';   
		var $m_cbof_user   					= ''; 
		var $m_cbof_menu  					= ''; 
		 
		
		var $m_obj_user_list     			= '';	// Su dung de hien thi tren combobox.
		var $m_obj_menu_list     			= '';	// Su dung de hien thi tren combobox.		     
		
		var $m_obj_user_data_view    		= '';
		var $m_obj_menu_data_view    		= '';
		var $m_obj_result_data_view    		= ''; 

private function m_cookie($str_key)
	{
		return 'cookie_menu_permission_'.$str_key;					
	}	
private function m_lang($str_key)
	{
		return 'menu_permission.'.$str_key;					
	}	
	 
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/11/20
 * @description		: 
 * @access	        : public
 *
 * @param string	: None
 * 					: 
 * @return string	: None 
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */
function do_menu_permission()
	{ 		
		parent::Controller(); 
		session_start();  
		$this->load->database();	
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view_helper');
		$this->load->helper('ap_object_helper');  
		
		$this->load->model('permission_model');
		// Kiem tra dieu kien login theo ma so he thong 1.
		$this->tokaban_system_check = '1'; 	
	}	
//		
//
//
function index()
	{				
		$this->do_process();
	}    
//
//
//			
function do_process() 
	{
		$this->get_data(); 		
		$this->caculate_data(); 		
		$this->do_business(); 		
		$this->destroy_data();
	} 

/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/11/20
 * @description		: Nhan du lieu
 * @access	        : private
 *
 * @param string	: None
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
private function get_data()
	{         
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		$this->m_language = Fget_userdata('session_user_language');		
		// Load file ngon ngu can su dung
		$this->load->language('tokaban', $this->m_language);
		
		if(isset($_POST['cbof_user']))
			dbset_cookie($this->m_cookie('cbof_user'), $_POST['cbof_user']);				
		
		if(isset($_POST['txtf_user']))
			dbset_cookie($this->m_cookie('txtf_user'), $_POST['txtf_user']);
		
		if(isset($_POST['cbof_menu']))
			dbset_cookie($this->m_cookie('cbof_menu'), $_POST['cbof_menu']);
			
		// Kiem tra va nhan cac bien hidden neu co.			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];																
	} 
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/11/20
 * @description		: Xu ly du lieu
 * @access	        : private
 *
 * @param string	: None
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
private function caculate_data()
	{	   		
		switch ($this->m_button_click)
		{
			case 'btn_save':
			{
				$this->set_user_menu_permission();
				break;
			}	
			case 'btn_cancel':
				redirect ('do_home');
				break;
			default:
				break;		
		}	
		// Kiem tra va gan gia tri tuong ung cho ten truong va kieu sap xep.
		// phuc vu cho chuc nang sort.
		$this->m_cbof_user 			= dbget_cookie($this->m_cookie('cbof_user'));
		$this->m_txtf_user_name   	= dbget_cookie($this->m_cookie('txtf_user'));
		$this->m_cbof_menu 			= dbget_cookie($this->m_cookie('cbof_menu'));
				
		// Xac dinh cac duogn dan can su dung cho view hien thi thong tin controller.		
		$this->m_link_page 			= base_url() . 'index.php/do_menu_permission/';
		
		// Xac dinh thong tin user hien thi tren combobox.
		$this->m_obj_user_list	=	Obj_get_user_list($this->m_nid_user_login);
		//
		$this->m_obj_menu_list	=	Obj_get_menu_list($this->m_nid_user_login);
		
		// Xac dinh thong tin user de hien thi len man hinh phan quyen.
		// Dung chung voi chuc nang phan quyen theo don vi phong ban
		$this->m_obj_user_data_view   = $this->permission_model->get_user_department($this->m_nid_user_login, $this->m_txtf_user_name);
		
		// Xac dinh thong tin menu de hien thi tren man hinh.
		$this->m_obj_menu_data_view   = $this->permission_model->get_menu($this->m_nid_user_login, $this->m_cbof_menu);
		
		// Xac dinh thong tin ket qua phan quyen menu tuong ung voi tung user.
		$this->m_obj_result_data_view = $this->permission_model->get_user_menu_result($this->m_nid_user_login, $this->m_cbof_user);
		
	}
	   
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/11/20
 * @description		: Xu ly nghiep vu
 * @access	        : private
 *
 * @param string	: None
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
private function do_business()
	{	
				
		
		// Xac dinh cac duong link
		 // Duong dan URL den controller
		$data['link_page']          	= $this->m_link_page;
		
		// Ten cac button he thong
		$data['btn_save'] 	        		= $this->lang->line('btn.0000.Save');
		$data['btn_cancel'] 	        	= $this->lang->line('btn.0000.Cancel');
		$data['btn_choose'] 	        	= $this->lang->line('btn.0000.Choose');
		
		// Tieu de form
		$data['lbl_form_title']    			= $this->lang->line($this->m_lang('FormViewTitle'));
		$data['lbl_basic_title']    		= '';//$this->lang->line('lbl.0000.BasicPermision');
		
		
		$data['lbl_account_information'] 	= $this->lang->line($this->m_lang('UserList'));
		$data['lbl_menu']			 		= $this->lang->line($this->m_lang('MenuList'));
		$data['lbl_menu_permission_result'] = $this->lang->line($this->m_lang('UserMenuPermissionResult'));

		// Xac dinh cac gia tri can cho chuc nang loc.
		$data['txtf_user_name']        	= $this->m_txtf_user_name;
		$data['cbof_menu']		= $this->m_cbof_menu;
		
		// Xac dinh mang du lieu de hien thi tren view
		$data['data_user_view']         = $this->m_obj_user_data_view;
		$data['data_menu_view']   		= $this->m_obj_menu_data_view; 
		$data['data_result_view']		= $this->m_obj_result_data_view;  
		
		$data['gencbo_user']	= Fgen_html_combobox('', 'cbof_user', $this->m_cbof_user, 'auto', $this->m_obj_user_list, 'nid', 'cfullname','nosubmit');
		$data['gencbo_menu']	= Fgen_html_combobox('', 'cbof_menu', $this->m_cbof_menu, 'auto', $this->m_obj_menu_list, 'cindex', 'cmenu','nosubmit');
		
		// Load view tuong ung voi su kien m_event.
		$data['event'] = 'view';//$this->m_event;
		
		$data['menu_active']		= 'permission';
		// Xac dinh thong tin menu		
		$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		$this->load->view('menu_permission_view/index', $data);
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/11/20
 * @description		: Huy du lieu
 * @access	        : private
 *
 * @param string	: None
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */				
private function destroy_data()
	{
	
	}
//
//
//	
private function set_user_menu_permission()
	{
		if (!empty($_POST['chk_user_items']))
			foreach ($_POST['chk_user_items'] as $nid_user)
			{
				// Huy het nhung dong thong tin phan quyen hien tai.
				$this->permission_model->delete_user_menu_bynid($nid_user);				
				// Xet cac thong tin department moi de phan quyen lai.
				if (!empty($_POST['chk_menu_items']))
					foreach ($_POST['chk_menu_items'] as $nid_menu)
					{
					$data =	array(								
						'nid_user' 		=> $nid_user,
						'nid_menu' 		=> $this->permission_model->get_menu_by_cindex($nid_menu)
						);
					// Goi phuong thuc cap nhat thong tin vao database.	
					$this->permission_model->insert_user_menu($data);
					}					
			}
			
	}


// End do_city_listview class
}	
// End of file do_city_listview.php
// Location: controllers/do_city_listview.php
