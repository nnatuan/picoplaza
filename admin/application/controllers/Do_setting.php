<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 /**
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 * 				: an_hm
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */    
   
/**
 *------------------------------------------------------------------
 * do_setting class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An 
 *------------------------------------------------------------------
 */     
class do_setting extends CI_Controller  
{
//He thong	
	var $m_language 		= ''; // nhan ngon ngu tu file language
	var $m_nid_user_login 	= ''; // nhan iduser tu session

	var $m_nid 				= ''; // nhan nid cua phuong xa can chinh sua
	var $m_event			= ''; // nhan su kien cap nhat hoac bo qua
	var $m_button_click		= ''; // nhan su kien tu hidden button o trang ap_news
	
	var	$m_link_page  		= ''; // nhan link cua su kien
	var $m_link_cancel 		='';  // link toi trang ap_news_listview

	var $m_form_title 		= ''; // tieu de cua form
	
// Nhung bien dung cho doi tuong.			  
	var $m_txt_nid 			= ''; // nhan ma tin 
	var $m_txt_cname		= '';// dai dien cho bien cname
	var $curl	 	= '';	
	var $cphone	 	= '';	
	var $ccompany	 	= '';
	var $caddress				= '';
	var $cmeta_key_global				= '';
	var $ctitle_global				= '';
	var $cmeta_desc_global				= '';
	var $cmau_nen				= '';
	var $cmau_menu				= '';
	var $cmau_top				= '';
	var $cmau_text_menu				= '';
	var $nid_province				= '';
	var $nid_district				= '';
	var $cemail				= '';
	var $nid_ward				= '';
	var $ctoken				= '';
	var $ctoken_ghtk				= '';
	var $msg				= '';
	var $m_txt_cnote		= '';
	var $m_txt_user01		= '';
	var $m_txt_ddate01		='';
	var $m_obj_data_view    = '';
	
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_msg 	    = ''; 
	var $m_txt_cthumb_img_logo		= '';
	var $m_hidden_image_old_logo 	= '';
	var $m_txt_cthumb_img_fav		= '';
	var $m_hidden_image_old_fav 	= '';
	var $m_txt_cthumb_img_fb		= '';
	var $m_hidden_image_old_fb 	= '';
	
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
				
		// Kiem tra dieu kien login theo ma so he thong 1
		$this->config->check_system_login = '1';
		// Load cac thu vien rieng can thiet khac neu co
		$this->load->model('setting_model');
		
		
	}

	/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Lay nid tu view ap_news_listview
 * @access	        : public
 *
 * @param string	: $nid   : truong khoa chinh cua tnews
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
		return $this->lang->line('lbl.setting.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_setting_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_setting_'.$cookie_name);
 }
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Lay nid tu view ap_news_listview
 * @access	        : public
 *
 * @param string	: $nid   : truong khoa chinh cua tnews
 *                  : 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
/* 
function f_edit($nid) // ham chinh sua, tham so la nid cua phuong xa can chinh sua
	{
		$this->m_event = 'edit';
		$this->m_nid   = $nid;		 	
		$this->do_process();		
	}
	*/
function f_edit() 
	{
		$setting = get_setting_by_user(Fget_userdata('session_nid_user'));
		if(!isset($setting['nid']))
			redirect(base_url().'trang-chu');
		$this->m_event = 'edit';
		$this->m_nid   = $setting['nid'];		 	
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
		
		if(isset($_FILES["txt_cthumb_img_logo"]))
		{
		 	$path						= './upload/logo/';
			$this->m_txt_cthumb_img_logo 	= Fupload_resize_img($_FILES["txt_cthumb_img_logo"],$path,300,300);
		}
		if(isset($_FILES["txt_cthumb_img_fav"]))
		{
		 	$path						= './upload/logo/';
			$this->m_txt_cthumb_img_fav 	= Fupload_resize_img($_FILES["txt_cthumb_img_fav"],'../'.$path,300,300);
		}
		if(isset($_FILES["txt_cthumb_img_fb"]))
		{
		 	$path						= './upload/fb/';
			$this->m_txt_cthumb_img_fb 	= Fupload_resize_img($_FILES["txt_cthumb_img_fb"],'../'.$path,600,315);
		}
		
		if (isset($_POST['txt_cname']))
			$this->m_txt_cname			 	= trim($_POST['txt_cname']);
		if (isset($_POST['curl']))
			$this->curl			 	= trim($_POST['curl']);	
		if (isset($_POST['cphone']))
			$this->cphone			 	= trim($_POST['cphone']);	
		if (isset($_POST['ccompany']))
			$this->ccompany			 	= trim($_POST['ccompany']);	
		if (isset($_POST['caddress']))
			$this->caddress			 	= trim($_POST['caddress']);	
		if (isset($_POST['cmeta_key_global']))
			$this->cmeta_key_global			 	= trim($_POST['cmeta_key_global']);	
		if (isset($_POST['ctitle_global']))
			$this->ctitle_global			 	= trim($_POST['ctitle_global']);	
		if (isset($_POST['cmeta_desc_global']))
			$this->cmeta_desc_global			 	= trim($_POST['cmeta_desc_global']);	
		if (isset($_POST['cmau_nen']))
			$this->cmau_nen			 	= trim($_POST['cmau_nen']);	
		if (isset($_POST['cmau_menu']))
			$this->cmau_menu			 	= trim($_POST['cmau_menu']);	
		if (isset($_POST['cmau_top']))
			$this->cmau_top			 	= trim($_POST['cmau_top']);
		if (isset($_POST['cmau_text_menu']))
			$this->cmau_text_menu			 	= trim($_POST['cmau_text_menu']);
		if (isset($_POST['nid_province']))
			$this->nid_province			 	= trim($_POST['nid_province']);	
		if (isset($_POST['nid_district']))
			$this->nid_district			 	= trim($_POST['nid_district']);	
		if (isset($_POST['cemail']))
			$this->cemail			 	= trim($_POST['cemail']);
		if (isset($_POST['nid_ward']))
			$this->nid_ward			 	= trim($_POST['nid_ward']);
		if (isset($_POST['ctoken']))
			$this->ctoken			 	= trim($_POST['ctoken']);
		if (isset($_POST['ctoken_ghtk']))
			$this->ctoken_ghtk			 	= trim($_POST['ctoken_ghtk']);
		
// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
			
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];
		
		if (isset($_POST['hidden_image_old_logo']))
			$this->m_hidden_image_old_logo	= $_POST['hidden_image_old_logo'];	
		if (isset($_POST['hidden_image_old_fav']))
			$this->m_hidden_image_old_fav	= $_POST['hidden_image_old_fav'];	
		if (isset($_POST['hidden_image_old_fb']))
			$this->m_hidden_image_old_fb	= $_POST['hidden_image_old_fb'];		
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
		if(Fget_userdata('session_user_isadmin')==1)
			redirect(do_home);
		
// Link khi click nut cancel
		$this->m_link_page 	= base_url() . 'index.php/do_setting/f_update_edit';	
		$this->m_link_cancel = base_url() . 'index.php/do_setting_listview';	
		
		switch ($this->m_event)
		{
			case 'edit':	
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_setting/f_update_edit';	

				$setting = $this->setting_model->get_byid($this->m_nid);
					$this->m_txt_cname	 				= $setting['cname'];
					$this->curl		 			= $setting['curl'];
					$this->cphone		 			= $setting['cphone'];
					$this->ccompany		 			= $setting['ccompany'];
					$this->caddress					= $setting['caddress'];
					$this->cmeta_key_global					= $setting['cmeta_key_global'];
					$this->ctitle_global					= $setting['ctitle_global'];
					$this->cmeta_desc_global					= $setting['cmeta_desc_global'];
					$this->cmau_nen					= $setting['cmau_nen'];
					$this->cmau_menu					= $setting['cmau_menu'];
					$this->cmau_top					= $setting['cmau_top'];
					$this->cmau_text_menu					= $setting['cmau_text_menu'];
					$this->nid_province					= $setting['nid_province'];
					$this->nid_district					= $setting['nid_district'];
					$this->cemail					= $setting['cemail'];
					$this->nid_ward					= $setting['nid_ward'];
					$this->ctoken					= $setting['ctoken'];
//					$this->ctoken_ghtk					= $setting['ctoken_ghtk'];
					
					$this->m_txt_cthumb_img_logo  	= $setting['cimage_logo'];
					$this->m_txt_cthumb_img_fav  	= $setting['cimage_favicon'];
					$this->m_txt_cthumb_img_fb  	= $setting['cimage_fb'];
				$this->m_event 	= 'update_edit';
				break;
			case 'add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				$this->m_event 	= 'update_add';
				break;
			case 'update_edit':
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				
				if ($this->m_button_click == 'btn_submit')
				if ($this->update_data()==TRUE) {
					$this->msg = "Thông tin đã được cập nhật.";
						//redirect ('cai-dat');
				}
				
				$this->m_link_page 	= base_url() . 'index.php/do_setting/f_update_edit';
				break;
			
			case 'update_add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_setting_listview');
				$this->m_link_page 	= base_url() . 'index.php/do_setting/f_update_add';
			
					break;
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
//He thong					
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
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');;
		
//lbl_form
		$data['lbl_form_title'] 		= $this->m_form_title;
		$data['lbl_cname'] 				= $this->m_language_key('cname');
		$data['lbl_cindex'] 			= $this->m_language_key('cindex');
		$data['lbl_cnote'] 				= $this->m_language_key('cnote');
// lbl err
		$data['lbl_error_msg']			= $this->m_error_msg;
		
//Bien doi tuong 
		// Gia tri hien thi

		$data['txt_cname']					= $this->m_txt_cname;
		$data['curl']					= $this->curl;
		$data['cphone']					= $this->cphone;
		$data['ccompany']					= $this->ccompany;
		$data['caddress']					= $this->caddress;
		$data['cmeta_key_global']					= $this->cmeta_key_global;
		$data['ctitle_global']					= $this->ctitle_global;
		$data['cmeta_desc_global']					= $this->cmeta_desc_global;
		$data['cmau_nen']					= $this->cmau_nen;
		$data['cmau_menu']					= $this->cmau_menu;
		$data['cmau_top']					= $this->cmau_top;
		$data['cmau_text_menu']					= $this->cmau_text_menu;
		$data['nid_province']					= $this->nid_province;
		$data['nid_district']					= $this->nid_district;
		$data['cemail']					= $this->cemail;
		$data['nid_ward']					= $this->nid_ward;
		$data['ctoken']					= $this->ctoken;
		$data['ctoken_ghtk']					= $this->ctoken_ghtk;
		
		$data['msg']					= $this->msg;
//Truyen bien nid cho view
		$data['nid']						=$this->m_nid;

		$data['menu_active']			= 'setting';
		//$data['gen_cbo_status']				= Fget_combobox_yes_no('no','nstatus',$this->nstatus,'width:150px',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		//$data['gen_cbo_all']				= Fget_combobox_yes_no('no','ccompany',$this->ccompany,'width:150px',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		$data['menu_active']		= 'setting';
		$data['menu_group_active']		= '';
		$data['fr_img']				= Fstr_replace('admin/','',base_url());
		if($this->m_txt_cthumb_img_logo != '')
			$data['txt_cthumb_img_logo'] 	= $this->m_txt_cthumb_img_logo;
		else
			$data['txt_cthumb_img_logo'] 	= $this->m_hidden_image_old_logo;
		
		if($this->m_txt_cthumb_img_fav != '')
			$data['txt_cthumb_img_fav'] 	= $this->m_txt_cthumb_img_fav;
		else
			$data['txt_cthumb_img_fav'] 	= $this->m_hidden_image_old_fav;
		
		if($this->m_txt_cthumb_img_fb != '')
			$data['txt_cthumb_img_fb'] 	= $this->m_txt_cthumb_img_fb;
		else
			$data['txt_cthumb_img_fb'] 	= $this->m_hidden_image_old_fb;
// Load view voi su kien tuong ung.
		$this->load->view('setting_view/index.php',$data);
		
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
		
		// Kiem tra truong title khong rong

		if($this->ccompany == '')
		{
			$this->m_error_msg	= "Tên công ty " . $this->lang->line('msg.0000.ErorNotNull');
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
		{
			return FALSE;
		}
		
		if (fbcheck_exists_key_addnew('tsetting', 'ccompany',$this->ccompany)==FALSE)
		{
			$this->m_error_msg	 	= "Tên công ty " . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
	
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Insert du lieu vao tnews
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
			
		if ($this->check_valid_before_insert()== TRUE)
		{
			$data =	array(								
			'cname'						=> $this->m_txt_cname,
			'curl'					=> $this->curl,
			'cphone'					=> $this->cphone,
			'ccompany'					=> $this->ccompany,
			'caddress'					=> $this->caddress,
			'cmeta_key_global'						=> $this->cmeta_key_global,
			'ctitle_global'						=> $this->ctitle_global,
			'cmeta_desc_global'						=> $this->cmeta_desc_global,
			'cmau_nen'						=> $this->cmau_nen,
			'cmau_menu'						=> $this->cmau_menu,
			'cmau_top'						=> $this->cmau_top,
			'cmau_text_menu'						=> $this->cmau_text_menu,
			'nid_province'						=> $this->nid_province,
			'nid_district'						=> $this->nid_district,
			'cemail'						=> $this->cemail,
			'nid_ward'						=> $this->nid_ward,
			'ctoken'						=> $this->ctoken,
			//'ctoken_ghtk'						=> $this->ctoken_ghtk,
			'cimage_logo' => $this->m_txt_cthumb_img_logo,
			'cimage_favicon' => $this->m_txt_cthumb_img_fav,
			'cimage_fb' => $this->m_txt_cthumb_img_fb
			);
		
		// Goi phuong thuc cap nhat thong tin vao database.	
		$this->setting_model->insert($data);
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
		//if ($this->check_valid_not_null()== FALSE)
		//	return FALSE;
		
		/*
		if (fbcheck_exists_key_update('tsetting', 'cname',$this->m_txt_cname, $this->m_nid)==FALSE)
		{
		
			$this->m_error_msg	 	= "Tên setting " . $this->lang->line('msg.0000.ErorDoubleKey');

			return FALSE;		
		}
		*/
		
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com

 * @finished date	: 2009/12/13
 * @description		: Update du lieu vao tnews
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
		if ($this->check_valid_before_update()==TRUE)
		{	
			$data =	array(								
			'cname'						=> $this->m_txt_cname,
			'curl'					=> $this->curl,
			'cphone'					=> $this->cphone,
			'ccompany'					=> $this->ccompany,
			'caddress'					=> $this->caddress,
			'cmeta_key_global'						=> $this->cmeta_key_global,
			'ctitle_global'						=> $this->ctitle_global,
			'cmeta_desc_global'						=> $this->cmeta_desc_global,
			'cmau_nen'						=> $this->cmau_nen,
			'cmau_menu'						=> $this->cmau_menu,
			'cmau_top'						=> $this->cmau_top,
			'cmau_text_menu'						=> $this->cmau_text_menu,
			'nid_province'						=> $this->nid_province,
			'nid_district'						=> $this->nid_district,
			'cemail'						=> $this->cemail,
			'nid_ward'					=> $this->nid_ward,
			'ctoken'						=> $this->ctoken,
			//'ctoken_ghtk'						=> $this->ctoken_ghtk
			);

			if ($this->m_txt_cthumb_img_logo != '') {
                $path = '.././upload/logo/';
                delfile($path . $this->m_hidden_image_old_logo);
                $data['cimage_logo'] = $this->m_txt_cthumb_img_logo;
            }
			if ($this->m_txt_cthumb_img_fav != '') {
                $path = '.././upload/logo/';
                delfile($path . $this->m_hidden_image_old_fav);
                $data['cimage_favicon'] = $this->m_txt_cthumb_img_fav;
            }
			if ($this->m_txt_cthumb_img_fb != '') {
                $path = '.././upload/fb/';
                delfile($path . $this->m_hidden_image_old_fb);
                $data['cimage_fb'] = $this->m_txt_cthumb_img_fb;
            }
			$this->setting_model->update_bynid($this->m_nid, $data);		
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

}


// End do_setting class
	
// End of file do_setting.php
// Location: controllers/do_setting.php




