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
 * do_employee_listview class
 *
 * Quan ly danh muc tai khoan
 * 
 * @subpackage	controllers
 * @category	 
 
 *------------------------------------------------------------------
 */	
class do_employee_listview extends CI_Controller
{ 	 
	// Cac bien bat buoc phai co.
	// de chay cac ham co ban cua lop.
	var $m_language   			= ''; 	 
	var $m_nid_user_login   	= '';  
	
	var	$m_link_page  			= ''; 
	var $m_link_export			= '';
	var $m_link_excel 			= '';
		
	var $m_event         		= ''; 				 
	  
	var $m_where_clause   		= ''; 			 
	var $m_orderby_clause 		= ''; 		
	var $m_orderby_sort   		= '';
	var $m_sort_img   			= '';
		 
	var $m_total_row  			= 0;  				
	var $m_total_page 			= 0;				
	 
	var $m_current_page  		= 0; 			
	var $m_previous_page 		= 0; 			 
	var $m_next_page     		= 0;				 
	var $m_row_per_page     	= 10;  

	var $m_txtf_ccode 			= ''; 
	var $m_txtf_cuserid			= '';
	var $m_txtf_cisadmin		= '';
	var $m_txtf_clastname		= ''; 
	var $m_txtf_cmiddlename		= '';
	var $m_txtf_cfirstname		= '';
	var $m_txtf_cemail			= '';
	var $m_txtf_cnote       	= '';

	var $m_obj_data_view    	= '';
	var $m_obj_user_type_view   = '';
	
	var $m_report_view_address 	= 'employee_view/index';
	var $m_excel_view_address  	= 'employee_view/employee_excel.php';
	var $m_print_view_address  	= 'employee_view/employee_listview_print.php';
	var $m_excel_file			= 'employeelist.xls';
	
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
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
		// Khoi tao, load cac doi tuong co ban cua he thong.
		session_start();
		$this->load->database();	
		// load cac ham helper co ban.
		// Khong duoc tu y thay doi thong tin nay 
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view');
		$this->load->helper('ap_object');
		$this->load->model('tkblib_model');
		// Load model doi tuong dac thu 
				
		$this->load->model('employee_model');
		
		// Kiem tra dieu kien login theo ma so he thong 1.
		$this->config->check_system_login = '1';	// Kiem tra chuc nang duoc thuc hien dung luong xu ly du lieu.
		//$this->tokaban_system_check = 'do_employee'; // kiem tra su dung function.
	}	

//
// Tat ca cac controller luon luon phai su dung ham ay de xax sinh thong tin cookie.
//Bat buoc phai viet ham nay trong all cac controller
private function m_cookie($str_key)
	{
		return 'cookie_employee_listview_'.$str_key;					
	}		
		
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
 * @description		: Sap xep du lieu tang dan, giam dan theo ten field
 * @access	        : public
 *
 * @param string	: $field_name   : ten truong
 *                  : $orderby_sort : kieu sap xep
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function f_active($nid,$status)   
{
	if($status == '0')
		$status = '1';
	else
		$status = '0';
		
	$data =	array(		
								
		'cstatus'				=> $status,
		);
	$this->employee_model->update_bynid($nid, $data);		
	
	$this->do_process();
	
}   
function f_sort($field_name, $orderby_sort)
	{
		$this->m_event = 'view';
		dbset_cookie($this->m_cookie('m_orderby_clause'), $field_name);
		dbset_cookie($this->m_cookie('m_orderby_sort'), $orderby_sort);
		$this->do_process();
	}
function f_print()
 	{
		$this->m_event = 'print';
		$this->do_process();
	}
function f_export()
 	{
		$this->m_event = 'export';		
		$this->do_process();
	}	
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
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
function index()
	{	
		$this->m_event='view';
		if(get_check_permission(4))
			$this->do_process();
		else 
			redirect(base_url().'index.php/do_access_denied');		
	}    
			
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
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
 
 * @finished date	: 2009/11/11
 * @description		: Nhan du lieu dau vao tu cac nguon khac nhau
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
		// Load file ngon ngu can su dung.
		$this->load->language('ap', $this->m_language);
		
		// Xu ly cac truong hop can truy xuat listview
		// Xac dinh su kien goi doi tuong listview
		$button_click='';
		if(isset($_POST['hidden_button']))
			{
			$button_click =$_POST['hidden_button'];
			switch(trim($button_click))
				{
					case "btn_filter":
					{					
						if (isset($_POST['txtf_ccode']))		
							dbset_cookie($this->m_cookie('m_txtf_ccode'), $_POST['txtf_ccode']);						
						if (isset($_POST['txtf_cuserid']))		
							dbset_cookie($this->m_cookie('m_txtf_cuserid'), $_POST['txtf_cuserid']);
						if (isset($_POST['txtf_cemail']))		
							dbset_cookie($this->m_cookie('m_txtf_cemail'), $_POST['txtf_cemail']);								
						if (isset($_POST['txtf_cisadmin']))		
							dbset_cookie($this->m_cookie('m_txtf_cisadmin'), $_POST['txtf_cisadmin']);	
						if (isset($_POST['txtf_clastname']))		
							dbset_cookie($this->m_cookie('m_txtf_clastname'), $_POST['txtf_clastname']);
						if (isset($_POST['txtf_cmiddlename']))		
							dbset_cookie($this->m_cookie('m_txtf_cmiddlename'), $_POST['txtf_cmiddlename']);		
						if (isset($_POST['txtf_cfirstname']))		
							dbset_cookie($this->m_cookie('m_txtf_cfirstname'), $_POST['txtf_cfirstname']);
						if (isset($_POST['txtf_cnote']))		
							dbset_cookie($this->m_cookie('m_txtf_cnote'), $_POST['txtf_cnote']);
						break;
					}
					
					case  "btn_next":
					{							
						if (isset($_POST['txt_header_current_page']))
							$number_page	=	$_POST['txt_header_current_page'];
						
						$number_page = $number_page+1;
						dbset_cookie($this->m_cookie('m_current_page'), $number_page);
						break;	
					}
					
					case  "btn_previous":
					{							
						if (isset($_POST['txt_header_current_page']))
							$number_page	=	$_POST['txt_header_current_page'];
						
						$number_page = $number_page-1;
						dbset_cookie($this->m_cookie('m_current_page'), $number_page);
						break;	
					}
															
					case  "btn_row_per_page":
					{						
						if (isset($_POST['txt_row_per_page']))
							Fset_userdata('session_user_row_per_page', $_POST['txt_row_per_page']);
						break;
					}
					case  "btn_row_per_page":
					{						
						if (isset($_POST['txt_row_per_page']))
							Fset_userdata('session_user_row_per_page', $_POST['txt_row_per_page']);
						break;
					}
					case  "btn_header_page_number":
					{						
						if (isset($_POST['txt_header_current_page']))					
							dbset_cookie($this->m_cookie('m_current_page'), $_POST['txt_header_current_page']);												
						break;	
					}				
					case  "btn_footer_page_number":
					{	
						if (isset($_POST['txt_footer_current_page']))
							dbset_cookie($this->m_cookie('m_current_page'), $_POST['txt_footer_current_page']);
						break;
					}
					
					case "btn_add":
					{	
						redirect ('do_employee/f_add');						
						break;
					}
										
					//Default use to delete
					case  "btn_delete":
					{
						if (!empty($_POST['chk']))
							foreach ($_POST['chk'] as $nid)
								$this->employee_model->delete_byid($nid);
					}	
					default:
					{
						//	cac truong hop khac
					}
				}
			}
	} 
	
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
 * @description		: Xu ly cac bien du lieu truoc khi su dung.
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
	    // Kiem tra va gan gia tri tuong ung cho ten truong va kieu sap xep
		// phuc vu cho chuc nang sort
		
		$this->m_orderby_clause = dbget_cookie($this->m_cookie('m_orderby_clause'));
		$this->m_orderby_sort   = dbget_cookie($this->m_cookie('m_orderby_sort'));
		
		if (trim($this->m_orderby_clause)=='')
		{
			$this->m_orderby_clause = 'ccode';
			$this->m_orderby_sort   = 'asc';
			// Luu thong tin sap xep vao cookie de su dung cho lan sau neu can.
			dbset_cookie($this->m_cookie('m_orderby_clause'), $this->m_orderby_clause);
			dbset_cookie($this->m_cookie('m_orderby_sort'), $this->m_orderby_sort);	
		}
			
		// Lay gia tri tu cookie, phuc vu cho chuc nang loc
		$this->m_txtf_ccode 		= dbget_cookie($this->m_cookie('m_txtf_ccode'));
		$this->m_txtf_cuserid 		= dbget_cookie($this->m_cookie('m_txtf_cuserid'));
		$this->m_txtf_cemail 		= dbget_cookie($this->m_cookie('m_txtf_cemail'));
		$this->m_txtf_cfirstname 	= dbget_cookie($this->m_cookie('m_txtf_cfirstname'));
		$this->m_txtf_cmiddlename	= dbget_cookie($this->m_cookie('m_txtf_cmiddlename'));
		$this->m_txtf_clastname		= dbget_cookie($this->m_cookie('m_txtf_clastname'));
		$this->m_txtf_cnote 		= dbget_cookie($this->m_cookie('m_txtf_cnote'));
		$this->m_txtf_cisadmin 		= dbget_cookie($this->m_cookie('m_txtf_cisadmin'));
				
		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause 		= $this->get_where_string();
		
		// Lay tong so dong
		$this->m_total_row 			= $this->employee_model->get_count_listview($this->m_where_clause);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang		
		$this->m_row_per_page  = Fget_userdata('session_user_row_per_page');			
		if ($this->m_row_per_page<=0)
			{
				$this->m_row_per_page=1;
				Fset_userdata('session_user_row_per_page', $this->m_row_per_page);
			}
	    // Tinh toan tong so trang
		$this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		$this->m_current_page = dbget_cookie($this->m_cookie('m_current_page'));
					
		if ($this->m_current_page <= 0)
			$this->m_current_page = 1;					
		if ($this->m_current_page > $this->m_total_page)
			$this->m_current_page = $this->m_total_page;		
		// Gan gia tri sau khi tinh toan thanh vao cookie de su dung cho lan sau neu co. 	
		dbset_cookie($this->m_cookie('m_current_page'), $this->m_current_page);
						
		// Xac dinh cac duogn dan can su dung cho view hien thi thong tin controller.		
		$this->m_link_page 			= base_url() . 'index.php/do_employee_listview';
				
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		$this->m_obj_data_view   = $this->employee_model->get_listview( $this->m_where_clause, 
														$this->m_orderby_clause . ' ' . $this->m_orderby_sort , 
														$this->m_row_per_page, 
														$this->m_current_page, 
														$this->m_total_row );
		
		$this->m_obj_user_type_view   = Obj_get_user_type_list($this->m_nid_user_login );
		
		// -------------------------------------------
		// LUU Y:
		// KHONG DUOC TU Y THAY DOI THONG TIN CUA NHUNG DOAN CODE DA DUOC XU LY BEN DUOI.
		// -------------------------------------------
		// Xac dinh kieu sap xep.
		// Phai xu ly tinh huong nay sau khi da thuc hien truy van du lieu xac dinh cac dong thong tin da truy xuat.
		if (trim($this->m_orderby_sort) == 'asc' || trim($this->m_orderby_sort) == '')
			$this->m_orderby_sort   = 'desc';			
		else
			$this->m_orderby_sort   = 'asc';
		
		// Xac dinh image can hien thi tuong ung theo dieu kien sort.	
		$this->m_sort_img       = Fget_image_sort($this->m_orderby_sort);	

		if($this->m_event == '')
			$this->m_event='view';	
	}
	   
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
 * @description		: Xu ly nghiep vu. Dieu huong du lieu. Truyen du lieu.
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
		$data['lbl_form_title'] = $this->lang->line('lbl.employee.FormViewTitle');
							
		// Tieu de cac truong
		$data['lbl_ddate01']     	= $this->lang->line('lbl.0000.Date01');
		$data['lbl_ddate02']     	= $this->lang->line('lbl.0000.Date02');		
		
		$data['lbl_ccode']          = $this->lang->line('lbl.employee.ccode');
		$data['lbl_cuserid']        = $this->lang->line('lbl.employee.cuserid');
		$data['lbl_cemail']         = $this->lang->line('lbl.employee.cemail');
		$data['lbl_cfirstname']     = $this->lang->line('lbl.employee.cfirstname');
		$data['lbl_cmiddlename']    = $this->lang->line('lbl.employee.cmiddlename');
		$data['lbl_clastname']     	= $this->lang->line('lbl.employee.clastname');
		$data['lbl_cisadmin']     	= $this->lang->line('lbl.employee.cisadmin');
		$data['lbl_cnote']     		= $this->lang->line('lbl.employee.cnote');						
					
		// Xac dinh mang du lieu de hien thi tren view
		$data['data_view']          = $this->m_obj_data_view;
		switch($this->m_event)
		{		
			case 'export':
			{	
				$data['data_report'] 		= $this->m_obj_data_view;
				$this->tkblib_model->export_excel($this->m_excel_file,$data, $this->m_excel_view_address);
				break;
			}
			
			case 'print':
			{
				$data['data_report'] 		= $this->m_obj_data_view;
				$this->load->view($this->m_print_view_address, $data);
				return;
			}
				
			default:
			{								
				// Xac dinh ten truong can sap xep
				$data['orderby_field'] = $this->m_orderby_clause;
				
				// Xac dinh kieu sap xep
				$data['orderby_sort']   = $this->m_orderby_sort;
				$data['sort_img']       = $this->m_sort_img;
		
				// Xac dinh cac duong link
				// Duong dan URL den controller
				$data['link_page']          = $this->m_link_page;
				$data['link_export']        = $this->m_link_export;
				
				// Ten cac button he thong
				$data['btn_add'] 	        = $this->lang->line('btn.0000.Add');
				$data['btn_delete'] 	    = $this->lang->line('btn.0000.Delete');
				$data['btn_export']         = $this->lang->line('btn.0000.Export');
				$data['btn_choose'] 	    = $this->lang->line('btn.0000.Choose');
				$data['btn_filter']         = $this->lang->line('btn.0000.Filter');
				$data['btn_print']         = $this->lang->line('btn.0000.Print');
						
				// Cac thong bao khi nhan button Xoa
				$data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
				$data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
				
				// So dong tren trang
				$data['lbl_rows_per_page'] 	= $this->lang->line('lbl.rows_per_page');
				
				// Xac dinh so dong tren trang
				$data['txt_row_per_page']   = $this->m_row_per_page;
		
				// Xac dinh gia tri trang hien tai
				$data['txt_current_page']   = $this->m_current_page;
				
				// Xac dinh tong so trang
				$data['txt_total_page']     = $this->m_total_page;	
				
				// Xac dinh cac gia tri can cho chuc nang loc
				$data['txtf_ccode']         = $this->m_txtf_ccode;
				$data['txtf_cisadmin']      = $this->m_txtf_cisadmin;
				$data['txtf_cfirstname']    = $this->m_txtf_cfirstname;
				$data['txtf_cmiddlename']   = $this->m_txtf_cmiddlename;
				$data['txtf_clastname']     = $this->m_txtf_clastname;
				$data['txtf_cemail']        = $this->m_txtf_cemail;
				$data['txtf_cuserid']       = $this->m_txtf_cuserid;
				$data['txtf_cnote']    		= $this->m_txtf_cnote;
		
				// Xac dinh thong tin menu
				$data['menu'] 				= Fget_menu_html($this->m_nid_user_login);
				// Load view tuong ung voi su kien m_event.
				$data['event'] 				= $this->m_event;				
				$data['gencbo_user_type']	= Fgen_html_combobox('', 'txtf_cisadmin', $this->m_txtf_cisadmin, '', $this->m_obj_user_type_view, 'nid', 'cuser_type','nosubmit');
				$data['default_hidden']		= 'default';
				$data['menu_active']		= 'employee';
				//exit('1');
				$this->load->view($this->m_report_view_address, $data);
			}
		}	
	}
	
/**
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
 * @description		: Huy cac doi tuong khong can su dung nua sau khi load view.
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
 *-------------------------------------------------------------------
 
 * @finished date	: 2009/11/11
 * @description		: Thiet lap menh de where cho cau lenh sql
 * @access	        : private
 *
 * @param string	: None
 * 					
 * @return string	: $str_result : menh de where
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */					
private function get_where_string()
   {
		$str_result = ' WHERE view.nid is not null ';
		if ($this->m_txtf_ccode != '')
			$str_result = $str_result . ' AND ccode like "%' . $this->m_txtf_ccode . '%" ';
			
		if ($this->m_txtf_cemail != '')
			$str_result .= ' AND cemail like "%' . $this->m_txtf_cemail . '%" ';
		if ($this->m_txtf_cuserid != '')
			$str_result .= ' AND cuserid like "%' . $this->m_txtf_cuserid . '%" ';   
		if ($this->m_txtf_cfirstname != '')
			$str_result .= ' AND cfirstname like "%' . $this->m_txtf_cfirstname . '%" ';   
		if ($this->m_txtf_cmiddlename != '')
			$str_result .= ' AND cmiddlename like "%' . $this->m_txtf_cmiddlename . '%" ';   
		if ($this->m_txtf_clastname != '')
			$str_result .= ' AND clastname like "%' . $this->m_txtf_clastname . '%" ';   
		if ($this->m_txtf_cisadmin != '')
			$str_result .= ' AND cisadmin like "%' . $this->m_txtf_cisadmin . '%" ';   	
					
		if ($this->m_txtf_cnote != '')
			$str_result = $str_result . ' AND cnote like "%' . $this->m_txtf_cnote . '%" ';  
			
		$str_result     .= 'AND nid > 3';
		return $str_result;
	}

// End do_city_listview class
}	
// End of file do_city_listview.php
// Location: controllers/do_city_listview.php
