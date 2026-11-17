<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 * 				: phu_ca86	
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */   
  
/** 
 *------------------------------------------------------------------
 * do_article_listview class
 *
 * Quan ly tin tuc
 *
 * @subpackage	controllers
 * @category	
 * @author		Cao An Phu 
 *------------------------------------------------------------------
 */	   
  
class do_article_listview extends CI_Controller
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
		
		// Cac bien tuy bien cua lop doi tuong
		var $m_txtf_nid 			= ''; // nhan ma tin 
		var $m_txtf_ctitle			= ''; // nhan tieu de tin
		var $m_cbof_nid_sec_news	= ''; // combobox section
		var $m_cbof_nid_cat_news	= ''; // combobox category
		var $m_txtf_nstatus       	= ''; // nhan trang thai tin
		var $m_txtf_nid_user01		= ''; // nguoi tao
		var $m_txtf_ddate01			= ''; // ngay tao
		var $m_nid_news_trans		= '';
		var $m_arr_id_news_trans	= '';
		var $m_txtf_alwcmt			= '';
		var $guard					= ''; // nhan su kien full news_tran
		var $m_err_delete			= '';
		var $m_cbof_language		= '';
		
		// bien nhan ve combobox category
		var $m_obj_sec_news_view 	= '';
		var $m_obj_cat_news_view 	= '';
		var $m_obj_language			= '';
				
		var $m_obj_data_view    	= '';
		var $m_hidden_id_org		= ''; // nhan id ban tin goc tu bien hidden
		var	$m_obj_org_id			= '';
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
		$this->load->helper('ap_object');	// load d
		
		$this->load->model('article_model'); 	// load de su dung cac ham duoc khai bao trong model	
		// Xac dinh cac duong dan can su dung cho view hien thi thong tin controller.		
		$this->m_link_page 			= base_url() . 'index.php/do_article_listview/';
		
		// Kiem tra dieu kien login theo ma so he thong 1.
		$this->config->check_system_login = '1';
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
	}	
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Lay nid tu view tkb_city_listview
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
		return $this->lang->line('lbl.aricle.'.$str_key);
	}
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
function f_sort_trans($field_name, $orderby_sort,$id_trans)
	{
		$this->m_orderby_clause = $field_name;
		$this->m_orderby_sort   = $orderby_sort;
		$this->f_list_trans($id_trans);
	}

 


/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
	return dbset_cookie('cookie_news_listview_'.$cookie_name,$cookie_value);
 }
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
	return dbget_cookie('cookie_news_listview_'.$cookie_name);
 }				
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
 * @finished date	: 2009/12/13
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
		$this->do_process();
	}    
			
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		$this->load->language('ap', 'eng');
		
		if(isset($_POST['cbof_nid_sec_news']))
		{	
			$this->m_cbof_nid_sec_news =   $_POST['cbof_nid_sec_news'];
			$this->f_set_cookie('m_cbof_nid_sec_news',$this->m_cbof_nid_sec_news);
		}
		if(isset($_POST['cbof_nid_cat_news']))
		{	
			$this->m_cbof_nid_cat_news 		=   $_POST['cbof_nid_cat_news'];
			$this->f_set_cookie('m_cbof_nid_cat_news',$this->m_cbof_nid_cat_news);
		}
		
		
		if(isset($_POST['hidden_id_org']))
		{
			$this->m_hidden_id_org						=	$_POST['hidden_id_org'];
		}
		if(isset($_POST['hidden_button']))
		{
			$hidden_button = $_POST['hidden_button']; //gan su kien tu listview chuyen sang thong qua hidden button
			switch($hidden_button) // lua chon xu ly tuy thuoc vao su kien hidden button
			{
				case "btn_filter": //su kien loc
				{
						if(isset($_POST['hidden_event']))
						$this->m_event		= $_POST['hidden_event'];
				
						$this->m_txtf_ctitle 			=   $_POST['txtf_ctitle'];

						$this->m_txtf_nid_user01 	    = 	$_POST['txtf_nid_user01'];
						$this->m_txtf_ddate01 	    	= 	$_POST['txtf_ddate01'];
						$this->m_cbof_language 	    	= 	'1';
					
					$this->f_set_cookie('m_txtf_ctitle',$this->m_txtf_ctitle);
//					$this->f_set_cookie('m_txtf_alwcmt',$this->m_txtf_alwcmt);
					$this->f_set_cookie('m_txtf_nstatus',$this->m_txtf_nstatus);
					$this->f_set_cookie('m_txtf_nid_user01',$this->m_txtf_nid_user01);
					$this->f_set_cookie('m_txtf_ddate01',$this->m_txtf_ddate01);
					$this->f_set_cookie('m_cbof_language',$this->m_cbof_language);

						
					break;			
	
				}
				case "btn_row_per_page": // su kien chon so dong tren trang
				{
					if (isset($_POST['txt_row_per_page']))
					{
           			 	$this->m_row_per_page = Fconvert_to_int($_POST['txt_row_per_page']);
						//$this->f_set_cookie('m_row_per_page',$this->m_row_per_page);		
						
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
					redirect(base_url() . 'index.php/do_article/f_add');
				}
				
				case "btn_delete" : // su kien delete data
				{
					$this->delete();
					break;
				}
				
				case "btn_add_trans":
				{
//					redirect(base_url() . 'index.php/do_article/f_add_trans/'.$this->m_hidden_id_org);
					redirect(base_url() . 'index.php/do_article/f_cfm_trans');
				}
				case "btn_header_add":
				{
					redirect(base_url() . 'index.php/do_article/f_add_trans');
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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
//		$this->m_txtf_nid 			= $this->f_get_cookie('m_txtf_nid');
		$this->m_txtf_ctitle		= $this->f_get_cookie('m_txtf_ctitle');
		$this->m_txtf_nstatus 		= $this->f_get_cookie('m_txtf_nstatus');
//		$this->m_txtf_alwcmt 		= $this->f_get_cookie('m_txtf_alwcmt');	
		$this->m_txtf_nid_user01	= $this->f_get_cookie('m_txtf_nid_user01');
		$this->m_txtf_ddate01		= $this->f_get_cookie('m_txtf_ddate01');
		$this->m_cbof_language		= $this->f_get_cookie('m_cbof_language');
		$this->m_cbof_nid_cat_news	= $this->f_get_cookie('m_cbof_nid_cat_news');
		$this->m_cbof_nid_sec_news	= $this->f_get_cookie('m_cbof_nid_sec_news');

		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause 		= $this->get_where_string();	
		
		// Lay tong so dong
		$this->m_total_row 			= $this->article_model->get_count_listview($this->m_where_clause);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang
		if ($this->m_row_per_page <= 0)
			$this->m_row_per_page  = Fget_userdata('session_user_row_per_page');			
		else
			Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
	    // Tinh toan tong so trang
		$this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		if ($this->m_current_page <= 0)
			$this->m_current_page = dbget_cookie('cookie_news_listview_txt_current_page');
			
		if ($this->m_current_page <= 0)
			$this->m_current_page = 1;		
			
		if ($this->m_current_page > $this->m_total_page)
			$this->m_current_page = $this->m_total_page;
		
		dbset_cookie('cookie_news_listview_txt_current_page', $this->m_current_page);	
		
		
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		
		$this->m_obj_data_view   = $this->article_model->get_listview( $this->m_where_clause, 
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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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

		$data['err_delete']			= $this->m_err_delete;
		
// Xac dinh ten truong can sap xep
		$data['orderby_field'] 		= $this->m_orderby_clause;

// Xac dinh kieu sap xep
		$data['orderby_sort']   	= $this->m_orderby_sort;
		$data['sort_img']       	= $this->m_sort_img;

// Xac dinh cac duong link
// Duong dan URL den controller
		$data['link_page']          = $this->m_link_page;
		
// tieu de danh muc
		$data['lbl_form_title'] = 'Article management';

		// tieu de cac truong

		$data['guard']				= $this->guard;
		$data['lbl_title'] 	        = $this->m_language_key('title');
		$data['lbl_cat'] 	        = $this->m_language_key('cat');
		$data['lbl_sec'] 	        = $this->m_language_key('sec');
		$data['lbl_status']	        = $this->m_language_key('status');
		$data['lbl_alwcmt']	        = $this->m_language_key('alwcmt');
		$data['lbl_nid'] 	        = $this->m_language_key('nid');
		$data['lbl_user01'] 	    = $this->m_language_key('user01');
		$data['lbl_date01'] 	    = $this->m_language_key('date01');
		$data['lbl_lang']			= $this->m_language_key('lang');
		$data['lbl_trans']			= $this->m_language_key('trans');
		$data['lbl_back']			= $this->m_language_key('back');
		$data['lbl_get_trans']		= $this->m_language_key('get_trans');

// Ten cac button he thong
		$data['btn_add'] 	        = $this->lang->line('btn.0000.Add');
		$data['btn_delete'] 	    = $this->lang->line('btn.0000.Delete');
		$data['btn_export']         = $this->lang->line('btn.0000.Export');
		$data['btn_choose'] 	    = $this->lang->line('btn.0000.Choose');
		$data['btn_filter']         = $this->lang->line('btn.0000.Filter');
		$data['btn_print']          = $this->lang->line('btn.0000.Print');
		$data['menu_active']		= 'article';
// Cac thong bao khi nhan button Xoa
		$data['error_full_trans']		   = $this->m_language_key('full.trans');
		$data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
		$data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
		$data['error_delete_active']	   = $this->m_err_delete;
		// So dong tren trang
		$data['lbl_rows_per_page'] 	= $this->lang->line('lbl.0000.RowPerPage');
		
		// Xac dinh so dong tren trang
		$data['txt_row_per_page']   = $this->m_row_per_page;

		// Xac dinh gia tri trang hien tai
		$data['txt_current_page']   = $this->m_current_page;
		
		// Xac dinh tong so trang
		$data['txt_total_page']     = $this->m_total_page;			
				
		// Xac dinh cac gia tri can cho chuc nang loc
		$data['event']				= $this->m_event;
		$data['txtf_nid']         	= $this->m_txtf_nid;
		$data['txtf_ctitle']		= $this->m_txtf_ctitle;
//		$data['cbof_nid_cat_news']	= $this->m_cbof_nid_cat_news;
		$data['txtf_nstatus']    	= $this->m_txtf_nstatus;
		$data['m_txtf_alwcmt']    	= $this->m_txtf_alwcmt;
		$data['txtf_nid_user01']    = $this->m_txtf_nid_user01;
		$data['txtf_ddate01']    	= $this->m_txtf_ddate01;
		
		$data['hidden_id_org']		= $this->m_hidden_id_org;
		
		// Xac dinh mang du lieu de hien thi tren view
		$data['data_view']         	= $this->m_obj_data_view;
		//return;
		//load object combobox
		
		// Xac dinh thong tin menu
		//$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		$data['gen_cbo_status']			= Fget_combobox_yes_no('','txtf_nstatus',$this->m_txtf_nstatus,'width:98%',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
				
		
		// Load view tuong ung voi su kien m_event.
		$data['event'] 			= $this->m_event;
		$data['nid']	   		= $this->m_nid_news_trans;
		$this->load->view('article_view/index.php', $data);
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
		if ($this->m_txtf_nid != '')
			$str_result = $str_result . ' AND nid like "%' . trim($this->m_txtf_nid) . '%" ';
		if ($this->m_txtf_ctitle != '')
			$str_result = $str_result . ' AND ctitle like "%' . trim($this->m_txtf_ctitle) . '%" ';
		if ($this->m_cbof_nid_sec_news != '')
			$str_result = $str_result . ' AND nid_sec_news = "' . trim($this->m_cbof_nid_sec_news) . '" ';
		//if ($this->m_cbof_nid_cat_news != '')
			//$str_result = $str_result . ' AND nid_cat_news = "' . trim($this->m_cbof_nid_cat_news) . '" ';
		if ($this->m_txtf_nstatus != '')
			$str_result = $str_result . ' AND nstatus like "%' . trim($this->m_txtf_nstatus) . '%" ';
		if ($this->m_txtf_alwcmt != '')
			$str_result = $str_result . ' AND alwcmt like "%' . trim($this->m_txtf_alwcmt) . '%" ';
		if ($this->m_txtf_nid_user01 != '')
			$str_result = $str_result . ' AND cfullname like "%' . (trim($this->m_txtf_nid_user01) ). '%" ';
		if ($this->m_txtf_ddate01 != '')
			$str_result = $str_result . ' AND ddate01 like "%' . Fget_strdate(trim($this->m_txtf_ddate01) ). '%" ';
		return $str_result;
	}
function checkvalid_delete($id)
{

	
			return TRUE;

	
}
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
	{
		foreach ($_POST['chk'] as $nid)
		{
			if($this->checkvalid_delete($nid))						
			{
			
				$this->article_model->delete_byid($nid);
			}			
		}
	}	
}		
// Da ngon ngu
//Active News #
//private function update_status($nid,$nid_cat,$status)
//	{	
//			$data =	array(								
//				'nstatus'			=> $status
//		        );
//			$this->article_model->update_bynid($nid,$nid_cat,$data);		
//	}

//Set active news
//status =1: active
//		 =0: not active

 function f_active($nid)   
	{

	$tmp 		= $this->article_model->get_byid($nid);
	$nstatus 	= 0;
	if(count($tmp) > 0)
	{
		$nstatus = $tmp['cishome']==0?1:0;
	}
	$data =	array(		
										
				'cishome'				=> $nstatus ,
		        );
			$this->article_model->update_bynid($nid, $data);		
		
		redirect('do_article_listview');
	}


// End do_article_listview class
}	
// End of file do_article_listview.php
// Location: controllers/do_article_listview.php
