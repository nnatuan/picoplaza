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
 * do_color class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An 
 *------------------------------------------------------------------
 */     
class do_color extends CI_Controller  
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
	var $m_txt_cindex	 	= 0;	

	var $m_txt_cnote		= '';
	var $m_txt_user01		= '';
	var $m_txt_ddate01		='';
	var $m_obj_data_view    = '';
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_msg 	    = ''; 
	var $m_hidden_image_old = '';
	var $m_txt_cthumb_img = '';
	var $m_txt_ccode = '';
	var $ccode_color		= '';
	var $fprice		= '';
	var $fprice_sale		= '';
	var $nremain		= '';
	var $cdescription		= '';
	var $nid_product = '';
	var $cbarcode = '';
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
		$this->load->model('color_model');
		
		
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
		return $this->lang->line('lbl.color.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_color_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_color_'.$cookie_name);
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
		$this->nid_product = $_SESSION['nid_product'];
		if (isset($_FILES["txt_cthumb_img"])) {
            $path                   = './upload/color/';
            //$this->m_txt_cthumb_img = Fupload_recolor_img($_FILES["txt_cthumb_img"], '../' . $path, 300, 150);
			$this->m_txt_cthumb_img = Fupload_recolor_img($_FILES["txt_cthumb_img"], '../' . $path, 1000, 1000);
        }
		
		if (isset($_POST['txt_cname']))
		{
//			$this->m_txt_ccode			 	= trim($_POST['txt_ccode']);
			$this->m_txt_cname			 	= trim($_POST['txt_cname']);
			$this->m_txt_cindex			 	= trim($_POST['txt_cindex']);		
			//$this->m_txt_cnote		 		= trim($_POST['txt_cnote']);	
			//$this->ccode_color			 	= trim($_POST['ccode_color']);
			$this->fprice			 	= $_POST['fprice'];
			$this->fprice_sale			= $_POST['fprice_sale'];
//			$this->nremain			 	= $_POST['nremain'];
//			$this->cdescription			= $_POST['cdescription'];
		}
		
// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
			
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];
		
		if (isset($_POST['hidden_image_old']))
			$this->m_hidden_image_old	= $_POST['hidden_image_old'];	
		
		if (isset($_POST['cbarcode']))
            $this->cbarcode = trim($_POST['cbarcode']);
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
		$this->m_link_page 	= base_url() . 'index.php/do_color/f_update_edit';	
		$this->m_link_cancel = base_url() . 'index.php/do_color_listview';	
		
		switch ($this->m_event)
		{
			case 'edit':	
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_color/f_update_edit';	

				$color = $this->color_model->get_byid($this->m_nid);
//					$this->m_txt_ccode                 = $color['ccode'];
					$this->m_txt_cname	 				= $color['cname'];
					$this->m_txt_cindex		 			= $color['cindex'];
//					$this->m_txt_cnote					= $color['cnote'];
//					$this->m_txt_cthumb_img        = $color['cimage'];
					$this->ccode_color		 			= $color['ccode_color'];
					$this->fprice		 			= $color['fprice'];
					$this->fprice_sale		 			= $color['fprice_sale'];
					//$this->nremain		 			= $color['nremain'];
					//$this->cdescription		 			= $color['cdescription'];
					//$this->cbarcode               = $color['cbarcode'];
					
				$this->m_event 	= 'update_edit';
				break;
			case 'add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				$this->m_event 	= 'update_add';
				break;
			case 'update_edit':
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				
				if ($this->m_button_click == 'btn_submit')
				if ($this->update_data()==TRUE)
							redirect ('do_color_listview');
			
				
				$this->m_link_page 	= base_url() . 'index.php/do_color/f_update_edit';
				break;
			
			case 'update_add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_color_listview');
				$this->m_link_page 	= base_url() . 'index.php/do_color/f_update_add';
			
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
		$data['txt_ccode']                   = $this->m_txt_ccode;
		$data['txt_cname']					= $this->m_txt_cname;
		$data['txt_cindex']					= $this->m_txt_cindex;
		$data['txt_cnote']					= $this->m_txt_cnote;
		$data['ccode_color']					= $this->ccode_color;
		$data['fprice']					= $this->fprice;
		$data['fprice_sale']					= $this->fprice_sale;
		$data['nremain']					= $this->nremain;
		$data['cdescription']					= $this->cdescription;
		$data['cbarcode']               = $this->cbarcode;
//Truyen bien nid cho view
		$data['nid']						=$this->m_nid;
		$data['nid_product']      = $this->nid_product;
		
		if ($this->m_txt_cthumb_img != '')
            $data['txt_cthumb_img'] = $this->m_txt_cthumb_img;
        else
            $data['txt_cthumb_img'] = $this->m_hidden_image_old;

		$data['menu_active']			= 'color';
		$data['menu_group_active']		= 'product';
		$data['fr_img']              = Fstr_replace('admin/', '', base_url());
		
		
// Load view voi su kien tuong ung.
		$this->load->view('color_view/index.php',$data);
		
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
		
		if($this->m_txt_cname == '')
		{
			$this->m_error_msg	= $this->m_language_key('cname') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		/*
		if($this->ccode_color == '')
		{
			$this->m_error_msg	= "Mã màu " . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}*/
		
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
		/*
		if (fbcheck_exists_key_addnew('tcolor', 'cname',$this->m_txt_cname)==FALSE)
		{
			$this->m_error_msg	 	= $this->m_language_key('cname') . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		*/

	
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
						//'ccode' => $this->m_txt_ccode,
						'cname'						=> $this->m_txt_cname,
						'cindex'					=> $this->m_txt_cindex,
						'nstatus'					=> 1,
						//'chome'					=> 0,
						//'cnote'						=> $this->m_txt_cnote,	
						//'niduser01'     			=> $this->m_nid_user_login,
						//'ddate01'					=> dbget_current_date(),
						//'niduser02'     			=> $this->m_nid_user_login,
						//'cimage' => $this->m_txt_cthumb_img,
						'ccode_color'						=> $this->ccode_color,
						'fprice'						=> $this->fprice,
						'fprice_sale'						=> $this->fprice_sale,
						'nremain'						=> $this->nremain,
						'cdescription'						=> $this->cdescription,
						'nid_product' => $this->nid_product,
						'cbarcode' => $this->cbarcode

						//'ddate02'					=> dbget_current_date()
						);
		
		// Goi phuong thuc cap nhat thong tin vao database.	
		$this->color_model->insert($data);
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
		/*
		if (fbcheck_exists_key_update('tcolor', 'cname',$this->m_txt_cname, $this->m_nid)==FALSE)
		{
		
			$this->m_error_msg	 	= $this->m_language_key('cname') . $this->lang->line('msg.0000.ErorDoubleKey');

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
			//'ccode' => $this->m_txt_ccode,			
			'cname'						=> $this->m_txt_cname,
			'cindex'					=> $this->m_txt_cindex,
			'ccode_color'					=> $this->ccode_color,
			'fprice'						=> $this->fprice,
			'fprice_sale'						=> $this->fprice_sale,
			'nremain'						=> $this->nremain,
			'cdescription'						=> $this->cdescription,
			'nid_product' => $this->nid_product,
			'cbarcode' => $this->cbarcode
			//'cnote'						=> $this->m_txt_cnote,	
			//'niduser02'     			=> $this->m_nid_user_login,
			//'ddate02'					=> dbget_current_date()
			);

			$this->color_model->update_bynid($this->m_nid, $data);		
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

}


// End do_color class
	
// End of file do_color.php
// Location: controllers/do_color.php




