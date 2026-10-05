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
 * do_module class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An  
 *------------------------------------------------------------------
 */    
class do_module extends CI_Controller 
{	
	var $m_language 		= ''; // nhan ngon ngu tu file language
	var $m_nid_user_login 	= ''; // nhan iduser tu session

	var $m_nid 				= ''; // nhan nid cua phuong xa can chinh sua
	var $m_event			= ''; // nhan su kien cap nhat hoac bo qua
	var $m_button_click		= ''; // nhan su kien tu hidden button o trang ap_module
	
	var	$m_link_page  		= ''; // nhan link cua su kien
	var $m_link_cancel 		='';  // link toi trang ap_module_listview 

	var $m_form_module 		= ''; // tieu de cua form
	
	var $m_hidden_image_old 	= ''; // giu lai duong dan cua hinh anh cu
	var $m_txt_cthumb_img		= ''; // nhan duong dan hinh anh
	// Nhung bien dung cho doi tuong.			
	var $m_txt_nid 			= ''; // nhan ma tin tuc
	var $m_txt_ccode		= ''; // nhan ma tin tuc
	var $m_txt_ctag			= ''; // nhan tag tin tuc	
	var $m_txt_cmodule 	= ''; // nhan ten tin tuc
	var $m_txt_cnote		= ''; // nhan duong dan hinh anh
	var $m_txt_nstatus		= ''; // nhan trang thai
	var $clink   	= ''; // nhan tom tat tin
	var $m_arr_new			= '';

	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
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
				
		// Kiem tra dieu kien login theo ma so he thong 1
		$this->config->check_system_login = '1';
		// Load cac thu vien rieng can thiet khac neu co
		$this->load->model('module_model');		
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
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
		return $this->lang->line('lbl.module.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_module_listview_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_module_listview_'.$cookie_name);
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
private function convert_webp($path)
    {
		$webp_img = webpConvert2($path);
		delfile($path);
		return(basename($webp_img));
	} 
private function get_data()
	{
		// Lay nid user tu session
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		// Load file ngon ngu can su dung
		$this->load->language('ap', 'eng');
		
		// Xac dinh cac gia tri duoc post tu view.
		
		// Kiem tra hinh anh duoc upload
		// Kiem tra hinh anh duoc upload
		if(isset($_FILES["txt_cthumb_img"]))
		{
		 	$path						= './upload/images_module/';
			$this->m_txt_cthumb_img 	= Fupload_resize_img($_FILES["txt_cthumb_img"],'../'.$path,2000,2000);
			if ($this->m_txt_cthumb_img != '') 
				$this->m_txt_cthumb_img = $this->convert_webp('../' . $path . $this->m_txt_cthumb_img);
		}
		
		
		
		// Can kiem tra tren tung form cu the.
		if (isset($_POST['txt_cmodule']))
		{
			$this->m_txt_cmodule	 	= $_POST['txt_cmodule'];
//			$this->m_txt_ccode			= $_POST['txt_ccode'];
			$this->clink			= $_POST['clink'];
			$this->m_txt_cnote 			= $_POST['txt_cnote'];
//			$this->m_txt_nstatus 		= $_POST['txt_nstatus'];
		}
		
		// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
			
		if (isset($_POST['hidden_image_old']))
			$this->m_hidden_image_old	= $_POST['hidden_image_old'];	
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
		$this->m_link_cancel = base_url() . 'index.php/do_module_listview';		
		
		// Xu ly tuy theo su kien.
		switch ($this->m_event)
		{
			case 'edit':										
				$this->m_form_module = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_module/f_update_edit';	
				
				// Chi trong truong hop edit thi moi lay thong tin doi tuong.
				// Chi to chuc bien va nhan nhung thong tin can thiet phuc vu cho viec xu ly ma thoi.
				$module = $this->module_model->get_byid($this->m_nid);	
						
				$this->m_txt_cnote  	= $module['cnote'];	
				$this->m_txt_cthumb_img  	= $module['cimage'];
				$this->m_txt_cmodule	= $module['cmodule'];
				$this->m_txt_nid		= $module['nid'];
				$this->m_txt_ccode		= $module['ccode'];
				$this->m_txt_ctag		= $module['ctag'];				
				$this->clink		= $module['clink'];
				$this->m_txt_nstatus 	= $module['nstatus'];	
					
				$this->m_event 	= 'update_edit';	
				break;
									
			case 'add':
				$this->m_form_module = $this->m_language_key('FormAddTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_module/f_update_add';
				$this->m_event 	= 'update_add';
				break;
				
			case 'update_edit':
				$this->m_form_module = $this->m_language_key('FormEditTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->update_data()==TRUE)
							redirect ('do_module_listview');
				
				$this->m_link_page 	= base_url() . 'index.php/do_module/f_update_edit';
				break;
			
			case 'update_add':
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_module_listview');
						
				//
				
				$this->m_form_module = $this->m_language_key('FormAddmodule');
				$this->m_link_page 	= base_url() . 'index.php/do_module/f_update_add';
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
								
		$data['event'] 				= $this->m_event;
		//$data['menu'] 				= Fget_menu_html($this->m_nid_user_login);
								
//		$data['lbl_form_module'] 	= $this->m_form_module;
		
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;				
		
		// Ten cac button		
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		$data['lbl_tag'] 			= $this->lang->line('lbl.0000.Tag');
		$data['fr_img']				= Fstr_replace('admin/','',base_url());

		// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');;
		
		$data['nid'] 				= $this->m_nid;
		
		// tieu de form
		$data['lbl_form_title'] 	= $this->m_form_module;
		
		// Tieu de cac truong
		$data['lbl_nid']          	= $this->m_language_key('nid');
		$data['lbl_code']          	= $this->m_language_key('ccode');		
		$data['lbl_module']    		= $this->m_language_key('module');		
		$data['lbl_index']  		= $this->m_language_key('index');
		$data['lbl_note']     		= $this->m_language_key('note');
		$data['lbl_status']			= $this->m_language_key('status');
		$data['lbl_first']			= $this->m_language_key('first');						

		// Gia tri hien thi
		if($this->m_txt_cthumb_img != '')
			$data['txt_cthumb_img'] 	= $this->m_txt_cthumb_img;
		else
			$data['txt_cthumb_img'] 	= $this->m_hidden_image_old;
			
			
		$data['txt_cmodule'] 			= $this->m_txt_cmodule;
		$data['txt_cnote'] 				= $this->m_txt_cnote;
		$data['txt_ccode'] 				= $this->m_txt_ccode;
		$data['txt_ctag'] 				= $this->m_txt_ctag;		
		$data['txt_nid'] 				= $this->m_txt_nid;
		$data['txt_nstatus'] 			= $this->m_txt_nstatus;
		$data['clink'] 			= $this->clink;
		$data['gen_cbo_status']			= Fget_combobox_yes_no('ko','txt_nstatus',$this->m_txt_nstatus,'width:304px',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		
		// Message thogn bao loi
		$data['m_message']		= $this->m_error_msg;
		$data['menu_active']		= 'module';
		
		// Load view voi su kien tuong ung.
		$this->load->view('module_view/index.php',$data);
		
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
		
		// Kiem tra truong module khong rong
		//if($this->m_event == 'add' OR $this->m_event == 'update_add')
		/*
		if(trim($this->m_txt_ccode) == '')
		{
			$this->m_error_msg	= $this->m_language_key('code') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		*/
		if(trim($this->m_txt_cmodule) == '')
		{
			$this->m_error_msg	= $this->m_language_key('module') . $this->lang->line('msg.0000.ErorNotNull');
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
		
		/*
		if (fbcheck_exists_key_addnew('tmodule', 'ccode',$this->m_txt_ccode)==FALSE)
		{
			$this->m_error_msg	 	= $this->lang->line('lbl.module.code') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		*/	
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
				'cmodule'		=> $this->m_txt_cmodule,
				'cnote'			=> $this->m_txt_cnote,
				'cimage'		=> $this->m_txt_cthumb_img,
				'ccode'			=> $this->m_txt_ccode,
				'ctag'			=> $this->m_txt_ctag,				
				'clink'		=> $this->clink,
				'nid' 			=> $this->m_txt_nid,
				'nstatus' 		=> 1,				
				'niduser01'     => $this->m_nid_user_login,
				'ddate01'		=> dbget_current_date(),
				'ddate02'		=> dbget_current_date()
				);

			// Goi phuong thuc cap nhat thong tin vao database.	
			$this->module_model->insert($data);		
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
		/*if (fbcheck_exists_key_update('tmodule', 'cmodule',$this->m_txt_cmodule,$this->m_nid)==FALSE )
		{
			$this->m_error_msg	 	= $this->m_language_key('module') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}*/
		
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
				'cmodule'		=> $this->m_txt_cmodule,
				'clink'			=> $this->clink,
				'ccode'				=> $this->m_txt_ccode,
				//'cimage'			=> $this->m_txt_cthumb_img,
				'ctag'				=> $this->m_txt_ctag,				
				//'nstatus' 			=> $this->m_txt_nstatus,
				'cnote'				=> $this->m_txt_cnote,
				'niduser02'			=> $this->m_nid_user_login,
				'ddate02'		=> dbget_current_date()
		        );
			if ($this->m_txt_cthumb_img != '') {
                $path = '.././upload/images_module/';
                if(file_exists($path . $this->m_hidden_image_old))
					delfile($path . $this->m_hidden_image_old);
				$data['cimage'] = $this->m_txt_cthumb_img;
            }
			
			$this->module_model->update_bynid($this->m_nid, $data);		
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
 /**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87@tokaban.com
 * @finished date	: 2009/24/12
 * @description		: Truong hop dac biet cap nhat index cua nhom tin dich khi tin goc thay doi
 * @access	        : public
 *
 * @param string	: nid cua tin
 * 					: 
 * @return string	: $obj_result->num_rows() : tong so dong
 *-------------------------------------------------------------------
 * @editor   	    : 14/1/2009
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */
	
private function update_index($nid,$index)
	{	

			$data =	array(								
				'clink'			=> $index
		        );

			$this->module_model->update_bynid($nid, $data);					
		
	}
private function update_code($nid,$code)
	{	

			$data =	array(								
				'ccode'			=> $code
		        );

			$this->module_model->update_bynid($nid, $data);					
		
	}	


}
// End do_module class
	
// End of file do_module.php
// Location: controllers/do_module.php



