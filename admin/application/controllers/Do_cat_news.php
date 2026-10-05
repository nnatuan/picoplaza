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
 * do_cat_news class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An  
 *------------------------------------------------------------------
 */    
class do_cat_news extends CI_Controller 
{	
	var $m_language 		= ''; // nhan ngon ngu tu file language
	var $m_nid_user_login 	= ''; // nhan iduser tu session

	var $m_nid 				= ''; // nhan nid cua phuong xa can chinh sua
	var $m_event			= ''; // nhan su kien cap nhat hoac bo qua
	var $m_button_click		= ''; // nhan su kien tu hidden button o trang ap_cat_news
	
	var	$m_link_page  		= ''; // nhan link cua su kien
	var $m_link_cancel 		='';  // link toi trang ap_cat_news_listview 

	var $m_form_cat_news 		= ''; // tieu de cua form
	
	// Nhung bien dung cho doi tuong.			
	var $m_txt_nid 			= ''; // nhan ma tin tuc
	var $m_txt_ccode		= ''; // nhan ma tin tuc
	var $clink			= '';	
	var $m_txt_ccat_news 	= ''; // nhan ten tin tuc
	var $m_cbof_nid_section_news	= ''; // nhan section	
	var $m_nid_news_org		= '';	
	var $m_cbof_nid_lang	= ''; // nhan language	
	var $m_txt_cnote		= ''; // nhan duong dan hinh anh
	var $m_txt_nstatus		= ''; // nhan trang thai
	var $m_txt_cindex   	= ''; // nhan tom tat tin
	var $m_arr_new			= '';

	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_obj_section_news_view 	= '';
	var $m_error_msg		= '';

/** 
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com
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
		//Load cac thu vien he thong.
		$this->load->database();
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view');
		$this->load->helper('ap_object');
		//$this->load->helper('ap_fck'); // load thu vien de xuat ra trinh soan thao van ban
				
		// Kiem tra dieu kien login theo ma so he thong 1

		// Load cac thu vien rieng can thiet khac neu co
		$this->load->model('cat_news_model');		
		$this->config->check_system_login = '1';
		
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
		return $this->lang->line('lbl.cat_news.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_cat_news_listview_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_cat_news_listview_'.$cookie_name);
 }

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
function f_edit($nid) // ham chinh sua, tham so la nid cua phuong xa can chinh sua
	{
		$this->m_event = 'edit';
		$this->m_nid   = $nid;		 	
		$this->do_process();		
	}


/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: 
 * @access	        : public
 *
 * @param string	: None
 *                  : 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function f_update_edit() // ham update cac thong tin da chinh sua
	{	
		$this->m_event = 'update_edit';		
		$this->do_process();
	}

	
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: 
 * @access	        : public
 *
 * @param string	: None
 *                  : 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function f_add() // ham them phuong xa
	{				
		$this->m_event 	= 'add';
		$this->m_nid 	= '0';
		$this->do_process();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: 
 * @access	        : public
 *
 * @param string	: None
 *                  : 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function f_update_add() // ham cap nhat thong tin cua phuong xa moi can tao
	{		
		$this->m_event = 'update_add';
		$this->do_process();		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
function do_process() // ham xu ly
	{
		$this->get_data();
		$this->caculate_data();
		$this->do_business();
		$this->destroy_data();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
		// Lay nid user tu session
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		// Load file ngon ngu can su dung
		$this->load->language('ap', 'eng');
		
		// Can kiem tra tren tung form cu the.
		if (isset($_POST['txt_ccat_news']))
		{
			$this->m_txt_ccat_news	 	= $_POST['txt_ccat_news'];
			$this->m_txt_ccode			= $_POST['txt_ccode'];
			$this->clink			= $_POST['clink'];
			$this->m_txt_cindex			= $_POST['txt_cindex'];
//			$this->m_txt_cnote 			= $_POST['txt_cnote'];
//			$this->m_txt_nstatus 		= $_POST['txt_nstatus'];
//			$this->m_cbof_nid_section_news	= $_POST['cbof_nid_section_news'];
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
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
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
		$this->m_link_cancel = base_url() . 'index.php/do_cat_news_listview';		
		$this->m_obj_section_news_view 	= Obj_get_section_news();
		// Xu ly tuy theo su kien.

		switch ($this->m_event)
		{
			case 'edit':										
				$this->m_form_cat_news = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_cat_news/f_update_edit';	
				
				// Chi trong truong hop edit thi moi lay thong tin doi tuong.
				// Chi to chuc bien va nhan nhung thong tin can thiet phuc vu cho viec xu ly ma thoi.
				$cat_news = $this->cat_news_model->get_byid($this->m_nid);	
						
				$this->m_txt_cnote  	= $cat_news['cnote'];	
				$this->m_txt_ccat_news	= $cat_news['ccat_news'];
				$this->m_txt_nid		= $cat_news['nid'];
				$this->m_txt_ccode		= $cat_news['ccode'];
				$this->clink		= $cat_news['clink'];				
				$this->m_txt_cindex		= $cat_news['cindex'];
				$this->m_txt_nstatus 	= $cat_news['nstatus'];	
				$this->m_cbof_nid_section_news	= $cat_news['nid_section_news'];
					
				$this->m_event 	= 'update_edit';	
				break;
												
			case 'add':
				$this->m_arr_new = '';
				$this->m_form_cat_news = $this->m_language_key('FormAddTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_cat_news/f_update_add';
				$this->m_event 	= 'update_add';
				break;
				
			case 'update_edit':
				$this->m_form_cat_news = $this->m_language_key('FormEditTitle');
			
				if ($this->m_button_click == 'btn_submit')
						if ($this->update_data()==TRUE)
							redirect ('do_cat_news_listview');
				
				$this->m_link_page 	= base_url() . 'index.php/do_cat_news/f_update_edit';
				break;
			
			case 'update_add':
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_cat_news_listview');
						
				//
				
				$this->m_form_cat_news = $this->m_language_key('FormAddcat_news');
				$this->m_link_page 	= base_url() . 'index.php/do_cat_news/f_update_add';
				break;
			default:{}
						
		}	
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
								
		$data['event'] 				= $this->m_event;
		//$data['menu'] = Fget_menu_html($this->m_nid_user_login);								
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;		
		
		// Ten cac button		
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		$data['lbl_tag']	 		= $this->lang->line('lbl.0000.Tag');
		$data['fr_img']			= Fstr_replace('admin/','',base_url());

		// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');;
		
		$data['nid'] 				= $this->m_nid;
		
		// tieu de form
		$data['lbl_form_title'] 	= $this->m_form_cat_news;
		
		// Tieu de cac truong
		$data['lbl_nid']          	= $this->m_language_key('nid');
		$data['lbl_code']          	= $this->m_language_key('ccode');		
		$data['lbl_cat_news']    	= $this->m_language_key('cat_news');
		$data['lbl_section_news']	= $this->m_language_key('section_news');		
		$data['lbl_index']  		= $this->m_language_key('index');
		$data['lbl_note']     		= $this->m_language_key('note');
		$data['lbl_status']			= $this->m_language_key('status');
		$data['lbl_first']			= $this->m_language_key('first');						

		// Gia tri hien thi
		$data['txt_ccat_news'] 			= $this->m_txt_ccat_news;
		$data['txt_cnote'] 				= $this->m_txt_cnote;
		$data['txt_ccode'] 				= $this->m_txt_ccode;
		$data['clink'] 				= $this->clink;		
		$data['txt_nid'] 				= $this->m_txt_nid;
		$data['txt_nstatus'] 			= $this->m_txt_nstatus;
		$data['txt_cindex'] 			= $this->m_txt_cindex;
		$data['gen_cbo_status']			= Fget_combobox_yes_no('ko','txt_nstatus',$this->m_txt_nstatus,'width:300px;',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		
		// Gia tri hien thi
		$data['gencbo_section_news_list']	= Fgen_html_combobox('co', 'cbof_nid_section_news', $this->m_cbof_nid_section_news, 'width:300px;', $this->m_obj_section_news_view, 'nid', 'csection_news','nosubmit','');

		// Message thogn bao loi
		$data['m_error_msg']		= $this->m_error_msg;

		$data['menu_active']		= 'cat_news';
		// Load view voi su kien tuong ung.
		$this->load->view('cat_news_view/index.php',$data);
		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

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
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
private function check_valid_not_null()
	{
		
		// Kiem tra truong cat_news khong rong
		if($this->m_event == 'add' OR $this->m_event == 'update_add')
		if(trim($this->m_txt_ccode) == '')
		{
			$this->m_error_msg	= $this->m_language_key('code') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		
		if(trim($this->m_txt_ccat_news) == '')
		{
			$this->m_error_msg	= $this->m_language_key('cat_news') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		
		return TRUE;
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
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

		if (fbcheck_exists_key_addnew('tcat_news', 'ccode',$this->m_txt_ccode)==FALSE)
		{
			$this->m_error_msg	 	= $this->lang->line('lbl.cat_news.code') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Insert du lieu vao tcity
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
				$data =	array(								
				'ccat_news'		=> $this->m_txt_ccat_news,
				//'nid_section_news' => $this->m_cbof_nid_section_news,
				'nid_section_news' => 6,
				'cnote'			=> $this->m_txt_cnote,
				'ccode'			=> $this->m_txt_ccode,
				'clink'			=> $this->clink,				
				'cindex'		=> $this->m_txt_cindex,
				'nid' 			=> $this->m_txt_nid,
				'nstatus' 		=> 1,				
				'niduser01'     => $this->m_nid_user_login,
				'ddate01'		=> dbget_current_date(),
				'niduser02'     => $this->m_nid_user_login,
				'ddate02'		=> dbget_current_date()
				);

			// Goi phuong thuc cap nhat thong tin vao database.	
			$this->cat_news_model->insert($data);		
		return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
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
			
		if (fbcheck_exists_key_update('tcat_news', 'ccode',$this->m_txt_ccode,$this->m_nid)==FALSE)
		{
			$this->m_error_msg	 	= $this->m_language_key('ccode') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Update du lieu vao tcity
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
			$data =	array(								
				'ccat_news'			=> $this->m_txt_ccat_news,
				//'nid_section_news' => $this->m_cbof_nid_section_news,
				'cindex'			=> $this->m_txt_cindex,
				'ccode'				=> $this->m_txt_ccode,
				'clink'				=> $this->clink,				
				//'nstatus' 			=> $this->m_txt_nstatus,
				'cnote'				=> $this->m_txt_cnote,
				'niduser02'			=> $this->m_nid_user_login,
				'ddate02'			=> dbget_current_date()
		        );

			$this->cat_news_model->update_bynid($this->m_nid, $data);		
			
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}
}
// End do_cat_news class
	
// End of file do_cat_news.php
// Location: controllers/do_cat_news.php



