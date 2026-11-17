<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 * 				: hung_pn89	
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */    
  
/**
 *------------------------------------------------------------------
 * do_banner_images_listview class
 *
 * Quan ly category
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An
 *------------------------------------------------------------------
 */  	   
  
class do_banner_images_listview extends CI_Controller
{ 	 
		// Cac bien bat buoc phai co 
		// de chay cac ham co ban cua lop
		var $m_nid_user_login   	= ''; // nhan iduser tu session
		
		var	$m_link_page  			= ''; // chua duong dan toi cac trang khac nhau trong moi event
		var $m_link_export			= '';
		
		var $m_event         		= ''; // nhan event de xu ly				
		 
		var $m_where_clause   		= ''; // nhan dieu kien where trong cac lenh loc hay chon trang 			
		var $m_orderby_clause 		= ''; // nhan truong de sap xep
		var $m_orderby_sort   		= ''; // nhan yeu cau de sap xep
		var $m_sort_image   		= '';
			
		var $m_total_row  			= 0;  // nhan tong so hang du lieu 				
		var $m_total_page 			= 0;  // nhan tong so trang du lieu			
		
		var $m_current_page  		= 0; 			
		var $m_previous_page 		= 0; 	 		
		var $m_next_page     		= 0;				
		var $m_row_per_page     	= 10;  
		
		var $m_err_delete				='';
		// Cac bien tuy bien cua lop doi tuong
		var $m_txtf_nid 			= ''; // nhan ma tin 
		var $m_txtf_cbanner_images		= ''; // nhan tieu de category
		var $m_txtf_nstatus       	= ''; // nhan trang thai category
		//var $m_txtf_cindex       	= ''; // nhan trang thai category
		var $m_txtf_ccode       	= ''; // nhan trang thai category	
		var $m_chkf_ctag	       	= 0;	
		var $m_txtf_ddate01			= ''; // ngay tao
		var $m_cbof_language		= '';
		var $m_arr_id_news_trans	= '';
		var $m_hidden_id_org		= '';
		var $guard					= ''; // nhan su kien full news_tran		
		
		var $m_obj_language			= '';

		
		var $m_obj_data_view    	= ''; 
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
		$this->load->database();	
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html'); 	// load de su dung ham tao ra khoi combobox tren trang view
		$this->load->helper('ap_view'); 	// load de su dung cac truong trong database duoc khai bao trong helper
		$this->load->helper('ap_object');	// load de su dung ham de tra ve doi tuong combobox
		
		$this->load->model('banner_images_model'); 	// load de su dung cac ham duoc khai bao trong model	
		// Kiem tra dieu kien login theo ma so he thong 1.
		//$this->tokaban_system_check = '1'; 
		$this->config->check_system_login = '1';
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
	}	
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Lay nid tu view ap_city_listview
 * @access	        : public
 *
 * @param string	: $nid   : truong khoa chinh cua tcity
 *                  : 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
 
 private function m_language_key($str_key)
	{
		return $this->lang->line('lbl.banner_images.'.$str_key);
	}
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
function f_sort($field_name, $orderby_sort)
	{
		$this->m_orderby_clause = $field_name;
		$this->m_orderby_sort   = $orderby_sort;
		
		$this->do_process();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
 * @description		: Xuat exel
 * @access	        : public
 *
 * @param string	: 
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */
 function f_print()
 	{
		$this->m_event = 'print';
		$this->do_process();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
 * @description		: Khai bao ten cookie cho table chuan 1 lan, sau gia tri sau se them rieng cho tung phan
 * @access	        : public
 *
 * @param string	: $cookie_name  : ten cookie
 *                  : $cookie_value : gia tri cua cookie
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_banner_images_listview_'.$cookie_name,$cookie_value);
 }
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
 * @description		: Khai bao lai ham lay cookie cho rieng man hinh nay
 * @access	        : public
 *
 * @param string	: $cookie_name   : ten cookie
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_banner_images_listview_'.$cookie_name);
 }				

function index()
	{				
		$this->do_process();
	}    
			
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
		$this->m_err_delete = $this->m_language_key('err_delete');		
		print_r($this->m_err_delete);
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		$this->load->language('ap', 'eng');
		if(isset($_POST['hidden_button']))
		{
			$hidden_button =$_POST['hidden_button']; //gan su kien tu listview chuyen sang thong qua hidden button
			switch($hidden_button) // lua chon xu ly tuy thuoc vao su kien hidden button
			{
				case "btn_filter": //su kien loc
				{
						if(isset($_POST['hidden_event']))
						$this->m_event		= $_POST['hidden_event'];
						
						if($this->m_event ==  'list_trans')
						{
						$this->m_txtf_cbanner_images 		=   $_POST['txtf_cbanner_images'];
						$this->m_txtf_nstatus 	    	= 	$_POST['txt_nstatus'];
						$this->m_txtf_ccode 	    	= 	$_POST['txtf_ccode'];						
						$this->m_txtf_ddate01 	    	= 	$_POST['txtf_ddate01'];
						$this->m_cbof_language 	    	= 	$_POST['cbof_language'];	
						
						return;											
						}
						
					if (!empty($_POST['chkf_ctag']))
						$this->m_chkf_ctag		 		=   $_POST['chkf_ctag'];
					$this->f_set_cookie('m_chkf_ctag',$this->m_chkf_ctag);
							
					if (isset($_POST['txtf_ccode']))
					{
//						$this->m_txtf_nid  				= 	$_POST['txtf_nid'];
						$this->m_txtf_cbanner_images 		=   $_POST['txtf_cbanner_images'];
						//$this->m_txtf_cindex	 		=   $_POST['txtf_cindex'];						
						$this->m_txtf_ccode		 		=   $_POST['txtf_ccode'];												
						$this->m_txtf_ntatus 	    	= 	$_POST['txtf_nstatus'];
						$this->m_txtf_ddate01 	    	= 	$_POST['txtf_ddate01'];
//						$this->m_cbof_language 	    	= 	$_POST['cbof_language'];
					}		

					
					$this->f_set_cookie('m_txtf_nid',$this->m_txtf_nid);
					$this->f_set_cookie('m_txtf_ccode',$this->m_txtf_ccode);					
					$this->f_set_cookie('m_txtf_cbanner_images',$this->m_txtf_cbanner_images);
					//$this->f_set_cookie('m_txtf_cindex',$this->m_txtf_cindex);
					$this->f_set_cookie('m_txtf_nstatus',$this->m_txtf_ntatus);
					$this->f_set_cookie('m_txtf_ddate01',$this->m_txtf_ddate01);
//					$this->f_set_cookie('m_cbof_language',$this->m_cbof_language);	
					break;			
	
				}
				case "btn_row_per_page": // su kien chon so dong tren trang
				{
					if (isset($_POST['txt_row_per_page']))
					{
           			 	$this->m_row_per_page = Fconvert_to_int($_POST['txt_row_per_page']);
						
					}
					break;
				}
				case "btn_page_number": // su kien chon so trang
				{
					$this->m_current_page = 1;
					
					if (isset($_POST['txt_current_page']))
					$this->m_current_page = $_POST['txt_current_page'];
												
				 	break;	
				
				}
				case "btn_header_page_number": // su kien chon so trang tren dau bang
				{
					$this->m_current_page = 1;
					
					if (isset($_POST['txt_header_current_page']))
					$this->m_current_page = $_POST['txt_header_current_page'];
												
				 	break;	
				
				}
				case ("btn_next") : // su kien chuyen den trang ke tiep
				{
					$this->m_current_page = $_POST['txt_current_page'];
					$this->m_current_page += 1;
					
					break;	
				
				}
				case ("btn_previous") : // su kien lui lai trang phia truoc
				{
					$this->m_current_page = $_POST['txt_current_page'];
					$this->m_current_page -= 1;
					
					break;	
				
				}
				case "btn_export": // su kien export ra excel
				{
					$this->m_event = 'excel';
					break;
				}
				
				case "btn_add" : // su kien add them data
				{
					redirect(base_url() . 'index.php/do_banner_images/f_add');
				}
				
				case "btn_delete" : // su kien delete data
				{
					$this->delete();
				}
				default:
				{
		
					//hien tai default khong lam gi ca
				}
			}
		
		}
							
	} 
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
	    // Kiem tra va gan gia tri tuong ung cho ten truong va kieu sap xep
		$this->m_link_page 			= base_url() . 'index.php/do_banner_images_listview/';	
		// phuc vu cho chuc nang sort
		if (trim($this->m_orderby_clause)=='')
		{
			$this->m_orderby_clause = $this->f_get_cookie('m_orderby_clause');
			$this->m_orderby_sort   = $this->f_get_cookie('m_orderby_sort');
		}
		
		// neu chua co dieu kien sap xep thi mac dinh la sap xep theo ma phuong xa va co thu tu tang dan

		if (trim($this->m_orderby_clause)=='')
		{
			$this->m_orderby_clause = 'nid';
			$this->m_orderby_sort   = 'asc';			
		}
		
		$this->f_set_cookie('m_orderby_clause',$this->m_orderby_clause);
		$this->f_set_cookie('m_orderby_sort',$this->m_orderby_sort);		 
	
		// Lay gia tri tu cookie, phuc vu cho chuc nang loc
		$this->m_txtf_nid 			= $this->f_get_cookie('m_txtf_nid');
		$this->m_txtf_ccode			= $this->f_get_cookie('m_txtf_ccode');
		$this->m_chkf_ctag			= $this->f_get_cookie('m_chkf_ctag');		
		$this->m_txtf_cbanner_images		= $this->f_get_cookie('m_txtf_cbanner_images');
		//$this->m_txtf_cindex		= $this->f_get_cookie('m_txtf_cindex');		
		$this->m_txtf_nstatus 		= $this->f_get_cookie('m_txtf_nstatus');	
		$this->m_txtf_ddate01		= $this->f_get_cookie('m_txtf_ddate01');	
		
		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause 		= $this->get_where_string();	
		
		// Lay tong so dong
		$this->m_total_row 			= $this->banner_images_model->get_count_listview($this->m_where_clause);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang
		if ($this->m_row_per_page <= 0)
			$this->m_row_per_page  = Fget_userdata('session_user_row_per_page');			
		else
			Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
	    // Tinh toan tong so trang
		$this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		if ($this->m_current_page <= 0)
			$this->m_current_page = dbget_cookie('cookie_banner_images_listview_txt_current_page');
			
		if ($this->m_current_page <= 0)
			$this->m_current_page = 1;		
			
		if ($this->m_current_page > $this->m_total_page)
			$this->m_current_page = $this->m_total_page;
		
		dbset_cookie('cookie_banner_images_listview_txt_current_page', $this->m_current_page);	
		
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		$this->m_obj_data_view   = $this->banner_images_model->get_listview( $this->m_where_clause, 
																	$this->m_orderby_clause . ' ' . 																	$this->m_orderby_sort , 
																	$this->m_row_per_page, 
																	$this->m_current_page, 
																	$this->m_total_row );

		// -------------------------------------------
		// LUU Y:
		// KHONG DUOC TU Y THAY DOI THONG TIN CUA NHUNG DOAN CODE DA DUOC XU LY BEN DUOI.
		// -------------------------------------------
		// Xac dinh kieu sap xep.
		// Phai xu ly tinh huong nay sau khi da thuc hien truy van du lieu xac dinh cac dong thong tin da truy xuat.
		//nhan object de chuan bi cho combobox 
		
		
		if (trim($this->m_orderby_sort) == 'asc' || trim($this->m_orderby_sort) == '')
			$this->m_orderby_sort   = 'desc';			
		else
			$this->m_orderby_sort   = 'asc';
		
		// Xac dinh image can hien thi tuong ung theo dieu kien sort.	
		$this->m_sort_img       = Fget_image_sort($this->m_orderby_sort);
		
		// Xac dinh su kien form
		if($this->m_event == '')
			$this->m_event='view';		
	}
	   
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
		// Load file ngon ngu can su dung

		
		// Xac dinh ten truong can sap xep
		$data['orderby_field'] 	= $this->m_orderby_clause;
		
		// Xac dinh kieu sap xep
		$data['orderby_sort']   = $this->m_orderby_sort;
		$data['sort_img']       = $this->m_sort_img;

		// Xac dinh cac duong link
		 // Duong dan URL den controller
		$data['link_page']          = $this->m_link_page;
		
		// tieu de danh muc
		//$data['lbl_form_title'] = $this->m_language_key('title.form');
		$data['lbl_form_title'] = "Quản lý Slide";
		
		// tieu de cac truong
		$data['guard']				= $this->guard;		
		$data['lbl_banner_images'] 	= $this->m_language_key('banner_images');
		$data['lbl_nid'] 	        = $this->m_language_key('nid');
		$data['lbl_index'] 	        = $this->m_language_key('index');
		$data['lbl_code'] 	        = $this->m_language_key('ccode');		
		$data['lbl_status']	        = $this->m_language_key('status');
		$data['lbl_user01'] 	    = $this->m_language_key('niduser01');
		$data['lbl_date01'] 	    = $this->m_language_key('date01');
		$data['lbl_lang']			= $this->m_language_key('lang');
		$data['lbl_trans']			= $this->m_language_key('trans');
		$data['lbl_back']			= $this->m_language_key('back');
		$data['lbl_get_trans']		= $this->m_language_key('get_trans');
				
		$data['lbl_not_tag'] 	    = $this->lang->line('lbl.0000.DataNotTag');
		// Ten cac button he thong
		$data['btn_add'] 	        = $this->lang->line('btn.0000.Add');
		$data['btn_delete'] 	    = $this->lang->line('btn.0000.Delete');
		$data['btn_export']         = $this->lang->line('btn.0000.Export');
		$data['btn_choose'] 	    = $this->lang->line('btn.0000.Choose');
		$data['btn_filter']         = $this->lang->line('btn.0000.Filter');
		$data['btn_print']          = $this->lang->line('btn.0000.Print');
		
		$data['err_delete']			= $this->m_err_delete;
		
		// Cac thong bao khi nhan button Xoa
		$data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
		$data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
		$data['error_full_trans']		   = $this->m_language_key('full.trans');		

		// So dong tren trang
		$data['lbl_rows_per_page'] 	= $this->lang->line('lbl.0000.RowPerPage');
		
		// Xac dinh so dong tren trang
		$data['txt_row_per_page']   = $this->m_row_per_page;

		// Xac dinh gia tri trang hien tai
		$data['txt_current_page']   = $this->m_current_page;
		
		// Xac dinh tong so trang
		$data['txt_total_page']     = $this->m_total_page;			
		$data['hidden_id_org']		= $this->m_hidden_id_org;				
		// Xac dinh cac gia tri can cho chuc nang loc
		if($this->m_event=='list_trans')
		$data['nid']				= $this->m_nid_banner_images_trans;
		$data['txtf_nid']         	= $this->m_txtf_nid;
		$data['txtf_ccode']        	= $this->m_txtf_ccode;
		$data['chkf_ctag']        	= $this->m_chkf_ctag;	
		$data['txtf_cbanner_images']		= $this->m_txtf_cbanner_images;
		//$data['txtf_cindex']		= $this->m_txtf_cindex;		
		$data['txtf_nstatus']    	= $this->m_txtf_nstatus;
		$data['txtf_ddate01']    	= $this->m_txtf_ddate01;
		$data['gen_cbo_status']			= Fget_combobox_yes_no('','txtf_nstatus',$this->m_txtf_nstatus,'width:98%',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
//		$data['gencbo_language_list']	= Fgen_html_combobox('', 'cbof_language', $this->m_cbof_language, '', $this->m_obj_language, 'nid', 'clanguage','nosubmit','');

		$data['menu_active']		= 'banner_image';
		
		// Xac dinh mang du lieu de hien thi tren view
		$data['data_view']             = $this->m_obj_data_view; 
		
		// Xac dinh thong tin menu
		//$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		
		//Kiem tra neu la truong hop xuat excel thi chay ham goi export_excel va dung lai
		if($this->m_event == 'excel')
		{
			$data['datas'] = $this->banner_images_model->get_listview_report($this->m_where_clause, 
																	$this->m_orderby_clause . ' ' . $this->m_orderby_sort);
			$this->banner_images_model->export_excel('banner_images_report.xls',$data);
			return;
		}
		if($this->m_event == 'print')
		{
			$this->load->view('banner_images_view/ap_banner_images_listview_print', $data);
			return;
		}
		
		// Load view tuong ung voi su kien m_event.
		if($this->m_event == 'list_trans')
		$data['lbl_form_title'] =  $this->m_language_key('title.tran.form');
		
		$data['event'] = $this->m_event;
		$this->load->view('banner_images_view/index.php', $data);
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
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
		$str_result = ' WHERE nid is not null ';
		
		if ($this->m_txtf_cbanner_images != '')
			$str_result = $str_result . ' AND cbanner_images like "%' . trim($this->m_txtf_cbanner_images) . '%" ';
		//if ($this->m_txtf_cindex != '')
		//	$str_result = $str_result . ' AND cindex like "%' . trim($this->m_txtf_cindex) . '%" ';
		if ($this->m_txtf_ccode != '')
			$str_result = $str_result . ' AND ccode like "%' . trim($this->m_txtf_ccode) . '%" ';
		if ($this->m_chkf_ctag == 1)
			$str_result = $str_result . ' AND ctag = "" ';			
		if ($this->m_txtf_nid != '')
			$str_result = $str_result . ' AND nid = "' . trim($this->m_txtf_nid) . '" ';
		if ($this->m_txtf_nstatus != '')
			$str_result = $str_result . ' AND nstatus like "%' . trim($this->m_txtf_nstatus) . '%" ';
		if ($this->m_txtf_ddate01 != '')
			$str_result = $str_result . ' AND ddate01 like "%' . Fget_strdate(trim($this->m_txtf_ddate01) ). '%" ';
				
		return $str_result;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - hung_pn89@tokaban.com
 * @finished date	: 2009/12/13
 * @description		: Xoa du lieu trong DB theo gia tri nid tuong ung
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
private function delete()
	{					
		if (!empty($_POST['chk']))
			foreach ($_POST['chk'] as $nid)
			{
				$obj_data = $this->banner_images_model->get_byid($nid);
				if(isset($obj_data['cimage']) && $obj_data['cimage']!= '')
				{
					$path		= '.././upload/banner/';
					@unlink($path.$obj_data['cimage']);
				}
				$this->banner_images_model->delete_byid($nid);
			}
	}		
	  
 function f_active($nid)   
{

	$tmp 		= $this->banner_images_model->get_byid($nid);
	$nstatus 	= 0;
	if(count($tmp) > 0)
	{
		$nstatus = $tmp['nstatus']==0?1:0;
	}
	$data =	array(		
										
				'nstatus'				=> $nstatus ,
		        );
			$this->banner_images_model->update_bynid($nid, $data);		
		
		$this->do_process();
}
// End do_banner_images_listview class
}	
// End of file do_banner_images_listview.php
// Location: controllers/do_banner_images_listview.php
