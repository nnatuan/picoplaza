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
 * do_load_menu_type class
 *
 * Quan ly category
 *
 * @subpackage	controllers
 * @category	
 * @author		Phan Ngoc Hung
 *------------------------------------------------------------------
 */ 	    
 
class do_load_menu_type extends Controller
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
		var $m_row_per_page     	= 0;
		
		// Product
		var $m_where_clause_product   		= ''; // nhan dieu kien where trong cac lenh loc hay chon trang 			
		var $m_orderby_clause_product 		= ''; // nhan truong de sap xep
		var $m_orderby_sort_product   		= ''; // nhan yeu cau de sap xep
		var $m_sort_image_product   		= '';
			
		var $m_total_row_product  			= 0;  // nhan tong so hang du lieu 				
		var $m_total_page_product 			= 0;  // nhan tong so trang du lieu			
		
		var $m_current_page_product  		= 0; 			
		var $m_previous_page_product 		= 0; 			
		var $m_next_page_product     		= 0;				
		var $m_row_per_page_product     	= 0;  
		
		var $m_err_delete			= '';
		// Cac bien tuy bien cua lop doi tuong
		var $m_txtf_cname 			= ''; // nhan ma tin 
		
		// cac truong loc cho man hinh chon bai viet
		var $m_txtf_ctitle			= '';
		var $m_cbof_nid_sec_news	= ''; // combobox section
		var $m_cbof_nid_cat_news	= ''; // combobox category
		var $m_obj_sec_news_view 	= '';
		var $m_obj_cat_news_view 	= '';
		
		var $m_txt_article			= '';
		
		// cac truong loc cho man hinh chon bai viet
		var $m_txtf_cproduct			= '';
		var $m_cbof_nid_sec_product		= ''; // combobox section
		var $m_cbof_nid_cat_product		= ''; // combobox category
		var $m_obj_sec_news_product 	= '';
		var $m_obj_cat_news_product 	= '';
		
		var $m_txt_product			= '';
		
		var $m_type					= '';
		var $m_event_ajax			= '';		
		var $m_iditem				= '';
		
		var $m_obj_data_view    		= '';
		var $m_obj_data_product_view    = '';
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
function do_load_menu_type() 
	{ 		
		parent::Controller(); 
		session_start();
		$this->load->database();	
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_object');
		$this->load->helper('ap_view'); 	// load de su dung cac truong trong database duoc khai bao trong helper
		$this->load->model('news_model'); 	// load de su dung cac ham duoc khai bao trong model	
		//$this->load->model('product_model'); 
		// Kiem tra dieu kien login theo ma so he thong 1.
		$this->tokaban_system_check = '1'; 	
	}	
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com

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
		return $this->lang->line('lbl.load_menu_type.'.$str_key);
	}

function option($type = '', $iditem = '', $temp = '')
{
	$this->m_type 		= $type;
	$this->m_iditem		= $iditem;	
	if($temp != '')
		$this->m_iditem .= '/'.$temp;
	$this->do_process();
}

//function process_artcle_list()
//	{
//		if (isset($_POST['txt_article']))
//			$this->m_txt_article					= $_POST['txt_article'];);
//		$this->do_process();
//	}
	
		
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
function f_sort($field_name, $orderby_sort,$p_nid_type = '', $p_event_ajax = '')
	{
		$this->m_orderby_clause = $field_name;
		$this->m_orderby_sort   = $orderby_sort;
		$this->m_type  = $p_nid_type;
		$this->m_event_ajax = $p_event_ajax;
		$this->do_process();
	}

function f_sort_product($field_name, $orderby_sort,$p_nid_type = '', $p_event_ajax = '')
	{
		$this->m_orderby_clause_product = $field_name;
		$this->m_orderby_sort_product   = $orderby_sort;
		$this->m_type  = $p_nid_type;
		$this->m_event_ajax = $p_event_ajax;
		$this->do_process();
	}
 
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
	return dbset_cookie('cookie_load_menu_type_'.$cookie_name,$cookie_value);
 }
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
	return dbget_cookie('cookie_load_menu_type_'.$cookie_name);
 }				
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
function index($p_nid_type = '', $p_event_ajax = '')
	{			
		$this->m_type  = $p_nid_type;
		$this->m_event_ajax = $p_event_ajax;
		$this->do_process();
	}    
			
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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

		if(isset($_POST['hidden_button']))
		{
			$hidden_button =$_POST['hidden_button']; //gan su kien tu listview chuyen sang thong qua hidden button

			switch($hidden_button) // lua chon xu ly tuy thuoc vao su kien hidden button
			{
				case "btn_filter": //su kien loc
				{
					if (isset($_POST['txtf_ctitle']))
						$this->m_txtf_ctitle			= $_POST['txtf_ctitle'];
					if (isset($_POST['cbof_nid_cat_news']))	
						$this->m_cbof_nid_cat_news		= 	$_POST['cbof_nid_cat_news'];
					if (isset($_POST['cbof_nid_sec_news']))
						$this->m_cbof_nid_sec_news		= 	$_POST['cbof_nid_sec_news'];	
						
					$this->f_set_cookie('m_txtf_ctitle',$this->m_txtf_ctitle);
					$this->f_set_cookie('m_cbof_nid_cat_news',$this->m_cbof_nid_cat_news);
					$this->f_set_cookie('m_cbof_nid_sec_news',$this->m_cbof_nid_sec_news);
					
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
				// Product
				case "btn_filter_product": //su kien loc
				{
					
					if (isset($_POST['txtf_cproduct']))
						$this->m_txtf_cproduct				= $_POST['txtf_cproduct'];
					if (isset($_POST['cbof_nid_cat_product']))	
						$this->m_cbof_nid_cat_product		= 	$_POST['cbof_nid_cat_product'];
					if (isset($_POST['cbof_nid_sec_product']))
						$this->m_cbof_nid_sec_product		= 	$_POST['cbof_nid_sec_product'];	
						
					$this->f_set_cookie('m_txtf_cproduct',$this->m_txtf_cproduct);
					$this->f_set_cookie('m_cbof_nid_cat_product',$this->m_cbof_nid_cat_product);
					$this->f_set_cookie('m_cbof_nid_sec_product',$this->m_cbof_nid_sec_product);
					
					break;			
	
				}
				case "btn_row_per_page_product": // su kien chon so dong tren trang
				{
					if (isset($_POST['txt_row_per_page_product']))
					{
           			 	$this->m_row_per_page_product = Fconvert_to_int($_POST['txt_row_per_page_product']);
						//$this->f_set_cookie('m_row_per_page',$this->m_row_per_page);		
						
					}
					break;
				}

				case "btn_page_number_product": // su kien chon so trang
				{
					$this->m_current_page_product = 1;
					
					if (isset($_POST['txt_current_page_product']))
					$this->m_current_page_product = $_POST['txt_current_page_product'];
												
				 	break;	
				
				}
				case "btn_header_page_number_product": // su kien chon so trang tren dau bang
				{
					$this->m_current_page_product = 1;
					
					if (isset($_POST['txt_header_current_page']))
					$this->m_current_page_product = $_POST['txt_header_current_page_product'];
												
				 	break;	
				
				}
				case ("btn_next_product") : // su kien chuyen den trang ke tiep
				{
					$this->m_current_page_product = $_POST['txt_current_page_product'];
					$this->m_current_page_product += 1;
					
					break;	
				
				}
				case ("btn_previous_product") : // su kien lui lai trang phia truoc
				{
					$this->m_current_page_product = $_POST['txt_current_page_product'];
					$this->m_current_page_product -= 1;
					
					break;	
				
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
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
			$this->m_orderby_clause = 'nid';
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
		$this->m_txtf_ctitle		= $this->f_get_cookie('m_txtf_ctitle');
		$this->m_cbof_nid_cat_news	= $this->f_get_cookie('m_cbof_nid_cat_news');		
		$this->m_cbof_nid_sec_news	= $this->f_get_cookie('m_cbof_nid_sec_news');
		
		
		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause 		= $this->get_where_string();	
		
		// Lay tong so dong
		$this->m_total_row 			= $this->news_model->get_count_listview($this->m_where_clause);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang
		if ($this->m_row_per_page <= 0)
			$this->m_row_per_page  = Fget_userdata('session_user_row_per_page');			
		else
			Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
	    // Tinh toan tong so trang
		$this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		if ($this->m_current_page <= 0)
			$this->m_current_page = dbget_cookie('cookie_menu_article_listview_txt_current_page');
			
		if ($this->m_current_page <= 0)
			$this->m_current_page = 1;		
			
		if ($this->m_current_page > $this->m_total_page)
			$this->m_current_page = $this->m_total_page;

					
		dbset_cookie('cookie_menu_article_listview_txt_current_page', $this->m_current_page);	
		
		// Xac dinh cac duong dan can su dung cho view hien thi thong tin controller.		
		$this->m_link_page 			= base_url() . 'index.php/do_load_menu_type/';
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		$this->m_obj_data_view   = $this->news_model->get_listview( $this->m_where_clause, 
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
		//$this->m_obj_city_view 	= Obj_get_city_list($this->m_nid_user_login);
		
		//nhan object de chuan bi cho combobox 
		$this->m_obj_cat_news_view 	= Obj_get_cat_news($this->m_nid_user_login);
		$this->m_obj_sec_news_view 	= Obj_get_sec_news($this->m_nid_user_login);
		
		if (trim($this->m_orderby_sort) == 'asc' || trim($this->m_orderby_sort) == '')
			$this->m_orderby_sort   = 'desc';			
		else
			$this->m_orderby_sort   = 'asc';
		
		// Xac dinh image can hien thi tuong ung theo dieu kien sort.	
		$this->m_sort_img       = Fget_image_sort($this->m_orderby_sort);
		
		// Product
		if (trim($this->m_orderby_clause_product)=='')
		{
			$this->m_orderby_clause_product = 'nid';
			$this->m_orderby_sort_product   = $this->f_get_cookie('m_orderby_sort_product');
		}
		
		// neu chua co dieu kien sap xep thi mac dinh la sap xep theo ma phuong xa va co thu tu tang dan
		if (trim($this->m_orderby_clause_product)=='')
		{
			$this->m_orderby_clause_product = 'nid';
			$this->m_orderby_sort_product   = 'asc';			
		}
		
		$this->f_set_cookie('m_orderby_clause_product',$this->m_orderby_clause_product);
		$this->f_set_cookie('m_orderby_sort_product',$this->m_orderby_sort_product);		 
	
		// Lay gia tri tu cookie, phuc vu cho chuc nang loc
		$this->m_txtf_cproduct			= $this->f_get_cookie('m_txtf_cproduct');
		$this->m_cbof_nid_cat_product	= $this->f_get_cookie('m_cbof_nid_cat_product');		
		$this->m_cbof_nid_sec_product	= $this->f_get_cookie('m_cbof_nid_sec_product');
		
		
		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause_product 		= $this->get_where_string_product();	
		
		// Lay tong so dong
		//$this->m_total_row_product 			= $this->product_model->get_count_listview($this->m_where_clause_product);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang
		if ($this->m_row_per_page_product <= 0)
			$this->m_row_per_page_product  = Fget_userdata('session_user_row_per_page');			
		else
			Fset_userdata('session_user_row_per_page', $this->m_row_per_page_product);			
	
	    // Tinh toan tong so trang
		$this->m_total_page_product = Fget_total_page($this->m_row_per_page_product, $this->m_total_row_product);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		if ($this->m_current_page_product <= 0)
			$this->m_current_page_product = dbget_cookie('cookie_menu_product_listview_txt_current_page');
			
		if ($this->m_current_page_product <= 0)
			$this->m_current_page_product = 1;		
			
		if ($this->m_current_page_product > $this->m_total_page_product)
			$this->m_current_page_product = $this->m_total_page_product;

					
		dbset_cookie('cookie_menu_product_listview_txt_current_page', $this->m_current_page_product);	
		
		// Xac dinh cac duong dan can su dung cho view hien thi thong tin controller.		
		$this->m_link_page_product 			= base_url() . 'index.php/do_load_menu_type/';
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		//$this->m_obj_data_product_view   = $this->product_model->get_listview( $this->m_where_clause_product, 
		//															$this->m_orderby_clause_product . ' ' . 																	$this->m_orderby_sort_product , 
		//															$this->m_row_per_page_product, 
		//															$this->m_current_page_product, 
		//															$this->m_total_row_product );
		// -------------------------------------------
		// LUU Y:
		// KHONG DUOC TU Y THAY DOI THONG TIN CUA NHUNG DOAN CODE DA DUOC XU LY BEN DUOI.
		// -------------------------------------------
		// Xac dinh kieu sap xep.
		// Phai xu ly tinh huong nay sau khi da thuc hien truy van du lieu xac dinh cac dong thong tin da truy xuat.
		//nhan object de chuan bi cho combobox 
		//$this->m_obj_city_view 	= Obj_get_city_list($this->m_nid_user_login);
		
		//nhan object de chuan bi cho combobox 
		//$this->m_obj_cat_product_view 	= Obj_get_cat_product_list($this->m_nid_user_login,'');
		//$this->m_obj_sec_product_view 	= Obj_get_material_product_list($this->m_nid_user_login);
		
		if (trim($this->m_orderby_sort_product) == 'asc' || trim($this->m_orderby_sort_product) == '')
			$this->m_orderby_sort_product   = 'desc';			
		else
			$this->m_orderby_sort_product   = 'asc';
		
		// Xac dinh image can hien thi tuong ung theo dieu kien sort.	
		$this->m_sort_img_product       = Fget_image_sort($this->m_orderby_sort_product);
		
		// Xac dinh su kien form
		if($this->m_event == '')
			$this->m_event='view';		
			
		
	}
	   
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
		$data['lbl_form_title'] 	= $this->lang->line('lbl.sponline.title.form');
	
		
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
		
		// So dong tren trang
		$data['lbl_rows_per_page'] 	= $this->lang->line('lbl.0000.RowPerPage');
		
		//Lbl cho man hinh load menu
		$data['lbl_product_detail']          = $this->m_language_key('product_detail');
		$data['lbl_ajax_load_article']       = $this->m_language_key('ajax_load_article');
		$data['lbl_ajax_load_default']       = $this->m_language_key('ajax_load_default');
		$data['lbl_ajax_load_sec_news']      = $this->m_language_key('ajax_load_sec_news');
		$data['lbl_ajax_load_cat_news']      = $this->m_language_key('ajax_load_cat_news');
		$data['lbl_ajax_load_sec_product'] 	 = $this->m_language_key('ajax_load_sec_product');
		$data['lbl_ajax_load_cat_product']   = $this->m_language_key('ajax_load_cat_product');
		
		// Chi tiet listview bai viet
		$data['lbl_select_article']		    = $this->m_language_key('select_article');
		$data['lbl_carticle']		         = $this->m_language_key('carticle');
		$data['lbl_sec_article'] 	         = $this->m_language_key('sec_article');
		$data['lbl_cat_article']	         = $this->m_language_key('cat_article');
		
		// Chi tiet listview san pham
		$data['lbl_select_product']          = $this->m_language_key('select_product');
		$data['lbl_cproduct']          		 = $this->m_language_key('cproduct');
		$data['lbl_sec_product']		     = $this->m_language_key('sec_product');
		$data['lbl_cat_product']        	 = $this->m_language_key('cat_product');
		
		// Xac dinh so dong tren trang
		$data['txt_row_per_page']   = $this->m_row_per_page;

		// Xac dinh gia tri trang hien tai
		$data['txt_current_page']   = $this->m_current_page;
		
		// Xac dinh tong so trang
		$data['txt_total_page']     = $this->m_total_page;			
				
		// Xac dinh cac gia tri can cho chuc nang loc
		$data['txtf_ctitle']		= $this->m_txtf_ctitle;
		
		$data['txt_article']		= $this->m_txt_article;
		$data['iditem']				= $this->m_iditem;

		// Xac dinh mang du lieu de hien thi tren view
		$data['data_view']             = $this->m_obj_data_view; 
		
		
		//product
		// Xac dinh ten truong can sap xep
		$data['orderby_field_product'] 	= $this->m_orderby_clause_product;
		
		// Xac dinh kieu sap xep
		$data['orderby_sort_product']   = $this->m_orderby_sort_product;
		$data['sort_img_product']       = $this->m_sort_img_product;

		// Xac dinh cac duong link
		 // Duong dan URL den controller
		$data['link_page_product']      = $this->m_link_page_product;
		// So dong tren trang
		$data['lbl_rows_per_page_product'] 	= $this->lang->line('lbl.0000.RowPerPage');
		
		// Xac dinh so dong tren trang
		$data['txt_row_per_page_product']   = $this->m_row_per_page_product;

		// Xac dinh gia tri trang hien tai
		$data['txt_current_page_product']   = $this->m_current_page_product;
		
		// Xac dinh tong so trang
		$data['txt_total_page_product']     = $this->m_total_page_product;			
				
		// Xac dinh cac gia tri can cho chuc nang loc
		$data['txtf_cproduct']				= $this->m_txtf_cproduct;
		
		$data['txt_product']				= $this->m_txt_product;

		// Xac dinh mang du lieu de hien thi tren view
		$data['data_product_view']             = $this->m_obj_data_product_view;
		
		//load object combobox
		//$data['gencbo_cat_product_list']	= Fgen_html_combobox('', 'cbof_nid_cat_product', $this->m_cbof_nid_cat_product, '', $this->m_obj_cat_product_view, 'nid', 'ccat_products','nosubmit','');
		
		//$data['gencbo_sec_product_list']	= Fgen_html_combobox('', 'cbof_nid_sec_product', $this->m_cbof_nid_sec_product, '', $this->m_obj_sec_product_view, 'nid', 'cmaterial_products','nosubmit','');
		
		//ket thuc product
		
		// Xac dinh thong tin menu
		$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		
		//Kiem tra neu la truong hop xuat excel thi chay ham goi export_excel va dung lai
		if($this->m_event == 'excel')
		{
			$data['datas'] = $this->news_model->get_listview_report($this->m_where_clause, 
																	$this->m_orderby_clause . ' ' . $this->m_orderby_sort);
			$this->news_model->export_excel('sponline_report.xls',$data);
			return;
		}
		if($this->m_event == 'print')
		{
			$this->load->view('sponline_view/ap_load_menu_type_print', $data);
			return;
		}
		
		// Load view tuong ung voi su kien m_event.
		//load object combobox
		$data['gencbo_cat_news_list']	= Fgen_html_combobox('', 'cbof_nid_cat_news', $this->m_cbof_nid_cat_news, '', $this->m_obj_cat_news_view, 'nid', 'ccat_news','nosubmit','');
		
		$data['gencbo_sec_news_list']	= Fgen_html_combobox('', 'cbof_nid_sec_news', $this->m_cbof_nid_sec_news, '', $this->m_obj_sec_news_view, 'nid', 'csection_news','nosubmit','');
		
		$data['event'] = $this->m_event;
		header("Content-Type: text/html; charset=UTF-8");

		if($this->m_type == 6)
			$this->load->view('menu_frontend_view/ajax_load_sec_news', $data);
		else if($this->m_type == 7)
			$this->load->view('menu_frontend_view/ajax_load_cat_news', $data);
		else if($this->m_type == 8)
		{
			if($this->m_event_ajax == 1)
				$this->load->view('menu_frontend_view/ajax_load_article_list', $data);						
			else
				$this->load->view('menu_frontend_view/ajax_load_article', $data);			
		}
		else if($this->m_type == 11)
			$this->load->view('menu_frontend_view/ajax_load_sec_product', $data);
		else if($this->m_type == 12)
			$this->load->view('menu_frontend_view/ajax_load_cat_product', $data);
		else if($this->m_type == 13)
		{	
			if($this->m_event_ajax == 2)
				$this->load->view('menu_frontend_view/ajax_load_product_detail_list', $data);						
			else
				$this->load->view('menu_frontend_view/ajax_load_product_detail', $data);
		}
		else
			$this->load->view('menu_frontend_view/ajax_load_default', $data);
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
		
		if ($this->m_txtf_ctitle != '')
			$str_result = $str_result . ' AND ctitle like "%' . trim($this->m_txtf_ctitle) . '%" ';
		if ($this->m_cbof_nid_sec_news != '')
			$str_result = $str_result . ' AND nid_section_news = ' . trim($this->m_cbof_nid_sec_news) . ' ';
		if ($this->m_cbof_nid_cat_news != '')
			$str_result = $str_result . ' AND nid_cat = "' . trim($this->m_cbof_nid_cat_news) . '" ';
	
		return $str_result;
	}
	
private function get_where_string_product()
   {
		$str_result = ' WHERE nid is not null ';
		
		if ($this->m_txtf_cproduct != '')
			$str_result = $str_result . ' AND cproducts like "%' . trim($this->m_txtf_cproduct) . '%" ';
		if ($this->m_cbof_nid_sec_product != '')
			$str_result = $str_result . ' AND nid_material_products = ' . trim($this->m_cbof_nid_sec_product) . ' ';
		if ($this->m_cbof_nid_cat_product != '')
			$str_result = $str_result . ' AND nid_cat_products = "' . trim($this->m_cbof_nid_cat_product) . '" ';
	
		return $str_result;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Phan Ngoc Hung - hung_pn89@tokaban.com
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
					$this->news_model->delete_byid($nid);

	}		
	  

// End do_load_menu_type class
}	
// End of file do_load_menu_type.php
// Location: controllers/do_load_menu_type.php
