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
 * do_gallery_img_listviewview class
 *
 * Quan ly danh muc materia
 *
 * @subpackage	controllers
 * @category	
 * @author		Cao An Phu 
 *------------------------------------------------------------------
 */	   
  
class do_gallery_img_listview extends CI_Controller
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
		var $m_row_per_page     	= 100;  
		
		var $m_message				= '';
// Cac bien tuy bien cua lop doi tuong
		var $m_txtf_nid 			  	= ''; // nhan ma tin 
		var $nid_product			  	= '';
		var $cimg						= '';
		var $cindex						= '';
		var $nstatus					= '';		
		var $m_obj_data_view    		= '';
		var $id_product					= '';
		var $ctitle						= '';
		
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
		$this->load->helper('ap_object');	// load de su dung ham de tra ve doi tuong combobox		
		$this->load->model('gallery_img_model'); 	// load de su dung cac ham duoc khai bao trong model	
		// Xac dinh cac duong dan can su dung cho view hien thi thong tin controller.		
		
		
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
function get($id_product)
{
	dbset_cookie('nid_gallery_img',$id_product);
	$this->do_process();
}
	
 function f_active($nid,$status)   
{
	if($status == '0')
		$status = '1';
	else
		$status = '0';
		
			$data =	array(		
										
				'nstatus'				=> $status,
		        );
			$this->gallery_img_model->update_bynid($nid, $data);		
		
		$this->do_process();
}

function f_active_nspecial($nid,$status = '')   
{
	if($status == '0')
		$status = '1';
	else
		$status = '0';
		
			$data =	array(		
										
				'nhome'				=> $status,
		        );
			$this->gallery_img_model->update_bynid($nid, $data);		
		
		$this->do_process();
}
 
 
 private function m_language_key($str_key)
	{
		return $this->lang->line('lbl.material.'.$str_key);
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
	return dbset_cookie('cookie_material_product_listview_'.$cookie_name,$cookie_value);
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
	return dbget_cookie('cookie_material_product_listview_'.$cookie_name);
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
		
		if(isset($_POST['hidden_button']))
		{
			$hidden_button = $_POST['hidden_button']; //gan su kien tu listview chuyen sang thong qua hidden button
			switch($hidden_button) // lua chon xu ly tuy thuoc vao su kien hidden button
			{
				case "btn_filter": //su kien loc
				{
					
				//Phan vung nhan bien loc	
				if(isset($_POST['nid_product']))	
					$this->nid_product 			=   $_POST['nid_product'];
				if(isset($_POST['cindex']))	
					$this->cindex 			=   $_POST['cindex'];	
				if(isset($_POST['txtf_cindex']))	
					$this->m_txtf_cindex 			=   $_POST['txtf_cindex'];	
			
				if(isset($_POST['nstatus']))	
					$this->nstatus 			=   $_POST['nstatus'];	
				if(isset($_POST['ctitle']))	
					$this->ctitle 			=   $_POST['ctitle'];	

				//Vung gan bien loc vao cookie
				//$this->f_set_cookie('nid_product',$this->nid_product);
				$this->f_set_cookie('cindex',$this->cindex);
				$this->f_set_cookie('nstatus',$this->nstatus);
				$this->f_set_cookie('ctitle',$this->ctitle);
						
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
					redirect(base_url() . 'index.php/do_gallery_img/f_add');
				}
				
				case "btn_delete" : // su kien delete data
				{
					$this->delete();
					break;
				}
				case "btn_header_add":
				{
					redirect(base_url() . 'do_gallery_img/f_add_trans');
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
	
//		Xac dinh link page:
		$this->m_link_page 			= base_url() . 'index.php/do_gallery_img_listview/';
	    // Kiem tra va gan gia tri tuong ung cho ten truong va kieu sap xep
		// phuc vu cho chuc nang sort
		$this->nid_product = dbget_cookie('nid_gallery_img');
		
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
		//$this->nid_product 			= $this->f_get_cookie('nid_product');
		$this->cimg 						= $this->f_get_cookie('cimg');
		$this->cindex 						= $this->f_get_cookie('cindex');
		$this->nstatus 						= $this->f_get_cookie('nstatus');
		$this->ctitle 						= $this->f_get_cookie('ctitle');
		
		// Xac dinh menh de where cua cau lenh sql		
		$this->m_where_clause 		= $this->get_where_string();	
		
		// Lay tong so dong
		$this->m_total_row 			= $this->gallery_img_model->get_count_listview($this->m_where_clause);		
		
		// Kiem tra va gan gia tri tuong ung cho bien so dong tren trang
		if ($this->m_row_per_page <= 0)
			$this->m_row_per_page  = Fget_userdata('session_user_row_per_page');			
		else
			Fset_userdata('session_user_row_per_page', $this->m_row_per_page);			
	
	    // Tinh toan tong so trang
		$this->m_total_page = Fget_total_page($this->m_row_per_page, $this->m_total_row);
		
		// Kiem tra va gan gia tri tuong ung cho bien trang hien tai
		if ($this->m_current_page <= 0)
			$this->m_current_page = dbget_cookie('cookie_material_product_listview_txt_current_page');
			
		if ($this->m_current_page <= 0)
			$this->m_current_page = 1;		
			
		if ($this->m_current_page > $this->m_total_page)
			$this->m_current_page = $this->m_total_page;
		
		dbset_cookie('cookie_material_product_listview_txt_current_page', $this->m_current_page);	
		
		
		// Lay mang du lieu duoc tra ve tu cau lenh sql
		
		$this->m_obj_data_view   = $this->gallery_img_model->get_listview( $this->m_where_clause, 
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
		$this->m_obj_cat_news_view 	= Obj_get_cat_news($this->m_nid_user_login);
		
		
		
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
	//	echo Fget_userdata('session_begin_application').'aaaaaaaaaaaaa';

		// Xac dinh ten truong can sap xep
		$data['orderby_field'] 		= $this->m_orderby_clause;
		
		// Xac dinh kieu sap xep
		$data['orderby_sort']   	= $this->m_orderby_sort;
		$data['sort_img']       	= $this->m_sort_img;

		// Xac dinh cac duong link
		 // Duong dan URL den controller
		$data['link_page']          = $this->m_link_page;
		
		// tieu de danh muc
		$data['lbl_form_title'] =  'Thư viện ảnh';
		$data['m_message'] 		=  $this->m_message;

		// tieu de cac truong
	
		$data['lbl_title'] 	        	= $this->m_language_key('title');
		$data['lbl_index'] 	   	    	= $this->m_language_key('index');
		$data['lbl_cmateria'] 	        = $this->m_language_key('cmaterial');
		$data['lbl_cnote'] 	        	= $this->m_language_key('cnote');
		$data['lbl_nstatus'] 	        = $this->m_language_key('nstatus');
		$data['lbl_date01'] 	        = $this->m_language_key('date01');
		$data['lbl_niduser01'] 	        = $this->m_language_key('niduser01');

		// Ten cac button he thong
		$data['btn_add'] 	        	= $this->lang->line('btn.0000.Add');
		$data['btn_delete'] 	    	= $this->lang->line('btn.0000.Delete');
		$data['btn_export']         	= $this->lang->line('btn.0000.Export');
		$data['btn_choose'] 	    	= $this->lang->line('btn.0000.Choose');
		$data['btn_filter']         	= $this->lang->line('btn.0000.Filter');
		$data['btn_print']          	= $this->lang->line('btn.0000.Print');
		
		// Cac thong bao khi nhan button Xoa
		$data['error_full_trans']		   = $this->m_language_key('full.trans');
		$data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
		$data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
		// So dong tren trang
		$data['lbl_rows_per_page'] 	= $this->lang->line('lbl.0000.RowPerPage');
		$data['lbl_not_tag'] 	    = $this->lang->line('lbl.0000.DataNotTag');
		// Xac dinh so dong tren trang
		$data['txt_row_per_page']   = $this->m_row_per_page;

		// Xac dinh gia tri trang hien tai
		$data['txt_current_page']   = $this->m_current_page;
		
		// Xac dinh tong so trang
		$data['txt_total_page']     = $this->m_total_page;			
				
		// Xac dinh cac gia tri can cho chuc nang loc
		$data['event']							= $this->m_event;
		$data['txtf_nid']         				= $this->m_txtf_nid;

		$data['cimg']							= $this->cimg;
		$data['cindex']    						= $this->cindex;
		$data['ctitle']    						= $this->ctitle;
		
		$data['gen_cbo_status']					= Fget_combobox_yes_no('','nstatus',$this->nstatus,'width:98%',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		// Xac dinh mang du lieu de hien thi tren view
		$data['data_view']         				= $this->m_obj_data_view;
		//$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		
		$data['nid_product']     = $this->nid_product;
		$data['fr_img']              = Fstr_replace('admin/', '', base_url());
		$data['menu_active']		= 'color_list';
		$this->load->view('gallery_img_view/index.php', $data);
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
		$str_result = ' WHERE nid is not null AND nid_product = "'.$this->nid_product.'"';
		if ($this->cindex != '')
			$str_result = $str_result . ' AND cindex = "' . Fget_strdate($this->cindex) . '" ';
		if ($this->ctitle != '')
			$str_result = $str_result . ' AND ctitle = "' . Fget_strdate($this->ctitle) . '" ';			
		if ($this->nstatus != '')
			$str_result = $str_result . ' AND nstatus like "%' . trim($this->nstatus) . '%" ';
				
		return $str_result;
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
			if($this->check_valid_delete($nid))						
			{
				$obj_data = $this->gallery_img_model->get_byid($nid);
				if($obj_data['cimg'] != '')
				{
					$path		= '.././upload/color/';
					@unlink($path.$obj_data['cimg']);
				}
				if($obj_data['cimg_color'] != '')
				{
					$path		= '.././upload/color_thumb/';
					@unlink($path.$obj_data['cimg_color']);
				}
				$this->gallery_img_model->delete_byid($nid);	
			}
			else
				$this->m_message = $this->lang->line('lbl.0000.message_valid_delete'); 
		}
	}
			
}		

function check_valid_delete($nid)
	{
		return TRUE;
	}
// End do_gallery_img_listviewview class
}	
// End of file do_gallery_img_listviewview.php
// Location: controllers/do_gallery_img_listviewview.php