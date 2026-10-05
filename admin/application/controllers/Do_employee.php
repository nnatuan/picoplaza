<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */    
    
/**
 *------------------------------------------------------------------
 * do_employee class
 *
 * Quan ly them, sua thong tin danh muc thanh pho
 *
 * @subpackage	controllers
 * @category	
 
 *------------------------------------------------------------------
 */	
class do_employee extends CI_Controller 
{	
	var $m_language   			= ''; 	 
	var $m_nid_user_login   	= ''; 
	
	var	$m_link_page  			= ''; 
	var $m_link_cancel 			='';
	
	var $m_event         		= ''; 				 
	var $m_hidden_button		= '';
	
	var $m_form_title 			= '';
		
	var $m_nid 					= ''; 			 
	var $m_txt_ccode 			= ''; 
	var $m_txt_cuserid			= '';
	var $m_txt_cemail			= '';
	var $m_txt_cpassword		= '';
	var $m_txt_cisadmin			= '';
	var $m_txt_clastname		= ''; 
	var $m_txt_cmiddlename		= '';
	var $m_txt_cfirstname		= '';

	var $m_txt_cnote       	= '';
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_ccode 	    	= '';
	var $m_error_message 	= '';
	
	var $m_obj_user_type_view='';	
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/09/05
 * @description		: Ham khoi tao, load cac thu vien can dung cho class
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
function __construct()
	{ 
		parent::__construct();
		session_start();
		//Load cac thu vien he thong.
		$this->load->database();
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view');
		$this->load->helper('ap_object');

		// Load model doi tuong dac thu 
		$this->load->model('employee_model');

		// Kiem tra hook dieu kien xem view.
		$this->config->check_system_login = '1';
				
	}

function f_edit($nid)
	{
		$this->m_event = 'edit';
		$this->m_nid   = $nid;		 	
		$this->do_process();		
	}

function f_update_edit()
	{	
		$this->m_event = 'update_edit';		
		$this->do_process();
	}
	
function f_add()
	{						
		$this->m_event 	= 'add';
		$this->m_form_title = $this->lang->line('lbl.employee.FormAddTitle');
		$this->m_nid 	= '0';
		$this->do_process();
	}

function f_update_add()
	{			
		$this->m_event = 'update_add';
		$this->do_process();		
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/09/05
 * @description		: Goi tuan tu cac ham theo dung quy dinh ve luong du lieu
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
function do_process()
	{
		$this->get_data();
		$this->caculate_data();
		$this->do_business();
		$this->destroy_data();
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Nhan du lieu tu cac nguon du lieu khac nhau.
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
		// Lay nid user tu session
		$this->m_nid_user_login = Fget_userdata('session_nid_user');

		// Lay ma ngon ngu tu session.
		// Load file ngon ngu can su dung.
		$this->m_language 		= Fget_userdata('session_user_language');	
		$this->load->language('ap', $this->m_language);
		
		// Xac dinh cac gia tri duoc post tu view.
		// Can kiem tra tren tung form cu the.
		if (isset($_POST['txt_cuserid']))
		{
			//$this->m_txt_ccode 				= $_POST['txt_ccode'];
			$this->m_txt_cuserid 			= $_POST['txt_cuserid'];
			$this->m_txt_cemail 			= $_POST['txt_cemail'];
			$this->m_txt_cpassword 			= $_POST['txt_cpassword'];
			
			$this->m_txt_cfirstname 		= $_POST['txt_cfirstname'];
			$this->m_txt_cmiddlename 		= $_POST['txt_cmiddlename'];
			$this->m_txt_clastname 			= $_POST['txt_clastname'];
			
			$this->m_txt_cisadmin 			= $_POST['txt_cisadmin'];
			$this->m_txt_cnote 				= $_POST['txt_cnote'];		
		}
		
		// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
			
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Tinh toan du lieu
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
		// Link khi click nut cancel
		$this->m_link_cancel = base_url() . 'index.php/do_employee_listview';		
		$this->m_obj_user_type_view   = Obj_get_user_type_list($this->m_nid_user_login );
		// Xu ly tuy theo su kien.
		switch ($this->m_event)
		{
			case 'edit':										
				$this->m_form_title = $this->lang->line('lbl.employee.FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_employee/f_update_edit';								
				$this->m_event 	= 'update_edit';
				
				// Chi trong truong hop edit thi moi lay thong tin doi tuong.
				// Chi to chuc bien va nhan nhung thong tin can thiet phuc vu cho viec xu ly ma thoi.
				$obj_data = $this->employee_model->get_byid($this->m_nid);				
				$this->m_txt_ccode 			= $obj_data['ccode'];
				$this->m_txt_cuserid 		= $obj_data['cuserid'];
				$this->m_txt_cemail 		= $obj_data['cemail'];
				$this->m_txt_cpassword 		= Obj_get_password_normal();
				$this->m_txt_cfirstname 	= $obj_data['cfirstname'];
				$this->m_txt_cmiddlename 	= $obj_data['cmiddlename'];
				$this->m_txt_clastname 		= $obj_data['clastname'];
				$this->m_txt_cisadmin 		= $obj_data['cisadmin'];					
				$this->m_txt_cnote 			= $obj_data['cnote'];									 				
				break;
						
			case 'add':
				$this->m_form_title = $this->lang->line('lbl.employee.FormAddTitle');	
				$this->m_link_page 	= base_url() . 'index.php/do_employee/f_update_add';
				$this->m_event 	= 'update_add';
				$this->m_txt_cpassword 		= Obj_get_password_normal();
				break;
				
			case 'update_edit':

				if ($this->m_button_click == 'btn_submit')
					if ($this->update_data() === TRUE)
						redirect ('do_employee_listview');
								
				$this->m_form_title = $this->lang->line('lbl.employee.FormAddTitle');	
				$this->m_link_page 	= base_url() . 'index.php/do_employee/f_update_edit';
				break;
			
			case 'update_add':

				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_employee_listview');
						
				//				
				$this->m_form_title = $this->lang->line('lbl.employee.FormAddTitle');	
				$this->m_link_page 	= base_url() . 'index.php/do_employee/f_update_add';
				break;
		}		
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
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
		$data['event'] 				= $this->m_event;
		$data['menu'] 				= Fget_menu_html($this->m_nid_user_login);
								
		$data['lbl_form_title'] 	= $this->m_form_title;
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;
		
		// Ten cac button		
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		
		// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
		
		$data['nid'] 					= $this->m_nid;
		
		// Tieu de cac truong
		$data['lbl_ccode']          	= $this->lang->line('lbl.employee.ccode');
		$data['lbl_cuserid']          	= $this->lang->line('lbl.employee.cuserid');
		$data['lbl_cemail']          	= $this->lang->line('lbl.employee.cemail');
		$data['lbl_cpassword']     		= $this->lang->line('lbl.employee.cpassword');
		$data['lbl_cconfirm_password']  = $this->lang->line('lbl.employee.cconfirm_password');
		$data['lbl_cfirstname']     	= $this->lang->line('lbl.employee.cfirstname');
		$data['lbl_cmiddlename']     	= $this->lang->line('lbl.employee.cmiddlename');
		$data['lbl_clastname']     		= $this->lang->line('lbl.employee.clastname');
		$data['lbl_cisadmin']     		= $this->lang->line('lbl.employee.cisadmin');
		$data['lbl_cnote']     			= $this->lang->line('lbl.employee.cnote');
	
		// Gia tri hien thi	
		$data['txt_ccode']         		= $this->m_txt_ccode;
		$data['txt_cuserid']         	= $this->m_txt_cuserid;
		$data['txt_cemail']         	= $this->m_txt_cemail;
		$data['txt_cpassword']         	= $this->m_txt_cpassword;
		$data['txt_cfirstname']        	= $this->m_txt_cfirstname;
		$data['txt_cmiddlename']       	= $this->m_txt_cmiddlename;
		$data['txt_clastname']         	= $this->m_txt_clastname;		
		$data['txt_cisadmin']          	= $this->m_txt_cisadmin;		
		$data['txt_cnote']    			= $this->m_txt_cnote;

		// Message thogn bao loi
		$data['error_ccode']		= $this->m_error_ccode;		
		$data['m_message']		= $this->m_error_message;
		$data['gencbo_user_type']	= Fgen_html_combobox('', 'txt_cisadmin', $this->m_txt_cisadmin, '', $this->m_obj_user_type_view, 'nid', 'cuser_type','nosubmit');
		// Load view voi su kien tuong ung.
		$data['menu_active']		= 'employee';
		$this->load->view('employee_view/index.php',$data);
		
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
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

/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
private function check_valid_not_null()
	{
		// Kiem tra truong ccode khong rong.
		/*
		if(trim($this->m_txt_ccode) == '')
		{
			$this->m_error_message = $this->lang->line('lbl.employee.ccode') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		*/
		if(trim($this->m_txt_cuserid) == '')
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cuserid') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		if(trim($this->m_txt_clastname) == '')
		{
			$this->m_error_message = $this->lang->line('lbl.employee.clastname') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		if(trim($this->m_txt_cemail) == '')
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cemail') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		
		/*if(trim($this->m_txt_cisadmin) == '')
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cisadmin') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}	*/	
		
		return TRUE;
	}
/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Kiem tra du lieu truoc khi insert
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
private function check_valid_before_insert()
	{
		if ($this->check_valid_not_null()== FALSE)
			return FALSE;
		if(trim($this->m_txt_cpassword) == '' || trim(Obj_get_password_normal())==trim(trim($this->m_txt_cpassword)))
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cpassword') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		/*
		// Kiem tra ma bao cao khong duoc trung
		if (fbcheck_exists_key_addnew('tuser', 'ccode',$this->m_txt_ccode)==FALSE)
		{
			$this->m_error_message = $this->lang->line('lbl.employee.ccode') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		*/
		// Kiem tra ten dang nhap khong duoc trung
		if (fbcheck_exists_key_addnew('tuser', 'cuserid',$this->m_txt_cuserid)==FALSE)
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cuserid') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Insert du lieu
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
private function insert_data()
	{
		if ($this->check_valid_before_insert())
		{
			// Ma hoa password truoc khi cap nhat.
			$data =	array(								
				'ccode' 		=> $this->m_txt_ccode,
				'cuserid'		=> $this->m_txt_cuserid,
				'cemail' 		=> $this->m_txt_cemail,
				'cpassword' 	=> Fget_encode($this->m_txt_cpassword),
				'cfirstname' 	=> $this->m_txt_cfirstname,
				'cmiddlename' 	=> $this->m_txt_cmiddlename,
				'clastname' 	=> $this->m_txt_clastname,
				'cisadmin' 	=> $this->m_txt_cisadmin,
				'cstatus' 		=> '0',
				'cnote' 		=> $this->m_txt_cnote,		
				'cdel' 			=> '0',
				'niduser01'     => $this->m_nid_user_login,
				'niduser02'     => $this->m_nid_user_login,
				'ddate01'		=> dbget_current_date(),
				'ddate02'		=> dbget_current_date()
				);
			// Goi phuong thuc cap nhat thong tin vao database.	
			$this->employee_model->insert($data);			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Kiem tra du lieu truoc khi update
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
private function check_valid_before_update()
	{
		if ($this->check_valid_not_null()== FALSE)
			return FALSE;
		
		// Kiem tra ma bao cao khong duoc phep trung		
		/*
		if (fbcheck_exists_key_update('tuser', 'ccode',$this->m_txt_ccode, $this->m_nid)==FALSE)
		{
			$this->m_error_message = $this->lang->line('lbl.employee.ccode') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		*/
		// Kiem tra en dang nhap khong duoc phep trung
		if (fbcheck_exists_key_update('tuser', 'cuserid',$this->m_txt_cuserid, $this->m_nid)==FALSE)
		{
			$this->m_error_message = $this->lang->line('lbl.employee.cuserid') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		
		//
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @finished date	: 2009/11/10
 * @description		: Update du lieu vao table.
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
private function update_data()
	{	
		if ($this->check_valid_before_update())
		{
			// Ma hoa password truoc khi cap nhat.
			if (trim(Obj_get_password_normal())!=$this->m_txt_cpassword)			
				$data =	array(								
					'ccode' 		=> $this->m_txt_ccode,
					'cuserid'		=> $this->m_txt_cuserid,
					'cemail' 		=> $this->m_txt_cemail,
					'cpassword' 	=> Fget_encode($this->m_txt_cpassword),
					'cfirstname' 	=> $this->m_txt_cfirstname,
					'cmiddlename' 	=> $this->m_txt_cmiddlename,
					'clastname' 	=> $this->m_txt_clastname,
					'cisadmin' 	=> $this->m_txt_cisadmin,
					'cnote' 		=> $this->m_txt_cnote,
					'niduser02'     => $this->m_nid_user_login,
					'ddate02'		=> dbget_current_date()
					);
			else
				$data =	array(								
					'ccode' 		=> $this->m_txt_ccode,
					'cuserid'		=> $this->m_txt_cuserid,
					'cemail' 		=> $this->m_txt_cemail,
					'cfirstname' 	=> $this->m_txt_cfirstname,
					'cmiddlename' 	=> $this->m_txt_cmiddlename,
					'clastname' 	=> $this->m_txt_clastname,
					'cisadmin' 	=> $this->m_txt_cisadmin,
					'cnote' 		=> $this->m_txt_cnote,
					'niduser02'     => $this->m_nid_user_login,
					'ddate02'		=> dbget_current_date()
					);
			
			$this->employee_model->update_bynid($this->m_nid, $data);		
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
// End do_employee class
}	
// End of file do_employee.php
// Location: controllers/do_employee.php



