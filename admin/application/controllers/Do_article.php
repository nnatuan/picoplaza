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
 * do_article class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Hoang Minh An 
 *------------------------------------------------------------------
 */     
class do_article extends CI_Controller  
{	
	var $m_language 		= ''; // nhan ngon ngu tu file language
	var $m_nid_user_login 	= ''; // nhan iduser tu session

	var $m_nid 				= ''; // nhan nid cua phuong xa can chinh sua
	var $m_event			= ''; // nhan su kien cap nhat hoac bo qua
	var $m_button_click		= ''; // nhan su kien tu hidden button o trang tkb_news
	
	var	$m_link_page  		= ''; // nhan link cua su kien
	var $m_link_cancel 		='';  // link toi trang tkb_news_listview

	var $m_form_title 		= ''; // tieu de cua form
	var $m_hidden_image_old = ''; // giu lai duong dan cua hinh anh cu
	
	// Nhung bien dung cho doi tuong.			  
	var $m_txt_nid 				= ''; // nhan ma tin tuc
	var $cindex 				= ''; // nhan ma tin tuc	
	var $m_txt_ctitle	 		= ''; // nhan ten tin tuc
	var $m_txt_ctag		 		= ''; // nhan ten tin tuc
	var $m_txt_cthumb_img		= ''; // nhan duong dan hinh anh
	var $m_cbof_nid_lang		= ''; // nhan language
	//var $m_chk_nstatus			= ''; // nhan trang thai
	var $m_txt_cshort_content 	= ''; // nhan tom tat tin
	var $m_txt_ccontent	 	    = ''; // nhan chi tiet tin
	var $m_lang			 	    = ''; // nhan chi tiet tin
	var $m_arr_new				= ''; // nhan thong tin goc cua tin can dich
	var $m_chk_alwcmt			= '';

	 
	// bien nhan ve combobox category
	var $m_cbo_nid_sec_news_view	= '';
	var $m_cbo_nid_cat_news_view	= '';

	var $m_obj_sec_news_view		= '';
	var $m_obj_cat_news_view 		= '';

	var $m_obj_language				= '1';
	var $m_nid_news_org				= '';
	var	$m_lang_org					= '';
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_sec 		    = ''; 
	var $m_error_cat 	    	= ''; 
	var $m_error_ccontent 	    = ''; 
	var $m_error_ctitle		 	= '';
	var $m_error_cshort_content	= '';	
	var $m_error_msg	= '';
	
	var $m_link_cancel_trans	= '';
	
	//englist
	var $eng_ctitle				= '';
	var $eng_cshort_content		= '';
	var $eng_ccontent			= '';		
	var $m_txt_cnote = '';
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com
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
		$this->load->model('article_model');
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}		
	}
	
	/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

 * @finished date	: 2009/12/13
 * @description		: Lay nid tu view tkb_news_listview
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
		return $this->lang->line('lbl.news.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_news_listview_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_news_listview_'.$cookie_name);
 }

function f_edit($nid) // ham chinh sua, tham so la nid cua phuong xa can chinh sua
	{
		$this->m_event = 'edit';
        $this->m_nid   = $nid;
        $this->do_process();	
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		$this->m_event = 'add';
        $this->m_nid   = '0';
        $this->do_process();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		// Kiem tra hinh anh duoc upload
		if(isset($_FILES["txt_cthumb_img"]))
		{
			
		 	$path						= './upload/images/';
			$this->m_txt_cthumb_img 	= Fupload_resize_img($_FILES["txt_cthumb_img"],'../'.$path,254,254);
		}
		// Can kiem tra tren tung form cu the.
		if (isset($_POST['txt_ctitle']))
		{
			$this->m_txt_ctitle		 	= $_POST['txt_ctitle'];
		
			if (!empty($_POST['chk_alwcmt']))
				$this->m_chk_alwcmt			= 1;
			//$this->m_txt_ctag 			= $_POST['txt_ctag'];
			//$this->m_txt_cshort_content	= $_POST['txt_cshort_content'];
			$this->m_txt_ccontent 		= $_POST['txt_ccontent'];

		}
		if(isset($_POST['cbo_nid_sec_news_view']))
			$this->m_cbo_nid_sec_news_view		=   $_POST['cbo_nid_sec_news_view'];
		if(isset($_POST['cbo_nid_cat_news_view']))
			$this->m_cbo_nid_cat_news_view 		=   $_POST['cbo_nid_cat_news_view'];
//			
		$this->m_cbof_nid_lang		= '1';
		// Nhan thong tin cua tin dich
		if (isset($_POST['txt_ctitle_trans']))
		{
			$this->m_txt_ctitle		 	= $_POST['txt_ctitle_trans'];

			$this->m_cbof_nid_cat_news	= $_POST['cbof_nid_cat_news'];
			if (!empty($_POST['chk_alwcmt']))
				$this->m_chk_alwcmt			= 1;
			$this->m_txt_cshort_content	= $_POST['txt_cshort_content_trans'];
			$this->m_txt_ccontent 		= $_POST['txt_ccontent_trans'];
			$this->cindex 				= $_POST['cindex'];

		}
		if (isset($_POST['txt_cnote']))
			$this->m_txt_cnote 			= $_POST['txt_cnote'];
		// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
		if (isset($_POST['eng_ctitle']))
			$this->eng_ctitle 			= $_POST['eng_ctitle'];
		if (isset($_POST['eng_cshort_content']))
			$this->eng_cshort_content 			= $_POST['eng_cshort_content'];
		if (isset($_POST['eng_ccontent']))
			$this->eng_ccontent 			= $_POST['eng_ccontent'];
				
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];
		if (isset($_POST['hidden_image_old']))
			$this->m_hidden_image_old	= $_POST['hidden_image_old'];
		if (isset($_POST['hidden_nid_news_org']))
		{
			$this->m_nid_news_org		= $_POST['hidden_nid_news_org'];
			
		}
		if (isset($_POST['hidden_cbof_nid_lang']))
		{
			$this->m_cbof_nid_lang		= $_POST['hidden_cbof_nid_lang'];
			
		}	
	
	}
		

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		$this->m_link_cancel = base_url() . 'index.php/do_article_listview';	
		$this->m_link_cancel_trans = base_url() . 'index.php/do_article_listview/f_list_trans/'.$this->f_get_cookie('nid_news_org');		
		$id_org_news				= $this->f_get_cookie('nid_news_org');
		$this->m_obj_cat_news_view 	= Obj_get_cat_news();
// Xu ly tuy theo su kien.
//echo $this->m_event;

		switch ($this->m_event)
		{
			case 'edit':	
				$this->m_form_title 		= $this->m_language_key('FormEditTitle');
				$this->m_arr_new			= $this->article_model->get_new_byid($this->m_nid);
				$news 						= $this->article_model->get_byid($this->m_nid);	
				$this->m_txt_cthumb_img  	= $news['cimage_thumb'];
				$this->m_txt_ctitle		 	= $news['ctitle'];
				$this->m_txt_ctag		 	= $news['ctag'];
				$this->cindex	 			= $news['cindex'];
				$this->m_chk_alwcmt			= $news['alwcmt'];	
				$this->m_txt_cshort_content	= $news['cshort_content'];
				$this->m_txt_ccontent 				= $news['ccontent'];
				$this->eng_ctitle			= $news['eng_ctitle'];	
				$this->eng_cshort_content	= $news['eng_cshort_content'];
				$this->eng_ccontent 		= $news['eng_ccontent'];
				$this->m_txt_cnote             = $news['cnote'];

//				$this->m_cbo_nid_sec_news_view		= $news['nid_sec_news'];
	//			$this->m_cbo_nid_cat_news_view		= $news['nid_cat_news'];
				
				$this->m_event 	= 'update_edit';	
				break;
			case 'add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_article/f_update_add';
				$this->m_event 	= 'update_add';
				break;
	
			case 'update_edit':

				if ($this->m_button_click == 'btn_submit')
						if ($this->update_data()==TRUE)
								redirect ('do_article_listview');

				$this->m_form_title = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_article/f_update_edit';
				break;

			case 'update_add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_article_listview');
				break;

							
		}		

			if($this->m_nid_news_org =='')
			$this->m_nid_news_org = $this->f_get_cookie('nid_news_org');

	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		$data['lbl_form_title'] 	= $this->m_form_title;
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;		
		$data['link_cancel_trans'] 	= $this->m_link_cancel_trans;
		// Ten cac button		
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		$data['fr_img']			= Fstr_replace('admin/','',base_url());

		// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
		
		
		// Tieu de cac truong
		$data['lbl_nid']          	= $this->m_language_key('nid');
		$data['lbl_image']			= $this->m_language_key('image');
		$data['lbl_title']    		= $this->m_language_key('title');
		$data['lbl_tag']    		= $this->m_language_key('tag');
		$data['lbl_cat']    		= $this->m_language_key('cat');
		$data['lbl_sec']    		= $this->m_language_key('sec');
		$data['lbl_short_content']  = $this->m_language_key('shortcontent');
		$data['lbl_cindex']     	= $this->m_language_key('cindex');
		$data['lbl_content']     	= $this->m_language_key('content');
		$data['lbl_status']			= $this->m_language_key('status');
		$data['lbl_lang']			= $this->m_language_key('lang');
		$data['lbl_first']			= $this->m_language_key('first');
		$data['lbl_alwcmt']	        = $this->m_language_key('alwcmt');
		$data['lbl_choose_sec_news'] 	= $this->m_language_key('choose_sec_news');
		$data['lbl_choose_cat_news']	= $this->m_language_key('choose_cat_news');

		$data['nid'] 					= $this->m_nid;
		$data['menu_active']		= 'article';
		
//		echo $data['cbo_nid_cat_news_view'];
		$data['cbo_nid_cat_news_view']	= $this->m_cbo_nid_cat_news_view;
		
		// Gia tri hien thi
		//var_dump($this->m_obj_language);

	//	$data['gencbo_language_list']	= Fgen_html_combobox('co', 'cbof_nid_lang', $this->m_cbof_nid_lang, '', $this->m_obj_language, 'nid', 'clanguage','nosubmit','');
		$data['txt_ctitle'] 		= $this->m_txt_ctitle;
		if($this->m_txt_cthumb_img != '')
			$data['txt_cthumb_img'] 	= $this->m_txt_cthumb_img;
		else
			$data['txt_cthumb_img'] 	= $this->m_hidden_image_old;
		//$data['chk_nstatus'] 		= $this->m_chk_nstatus;
		$data['chk_alwcmt']			= $this->m_chk_alwcmt;
		$data['txt_cshort_content'] = $this->m_txt_cshort_content;
		$data['txt_ctag'] 			= $this->m_txt_ctag;
		$data['txt_ccontent'] 		= $this->m_txt_ccontent;
		$data['cindex'] 			= $this->cindex;
		$data['hidden_nid_news_org']= $this->m_nid_news_org;
		$data['hidden_cbof_nid_lang']=$this->m_cbof_nid_lang;
		$data['eng_ctitle'] 			= $this->eng_ctitle;
		$data['eng_cshort_content']= $this->eng_cshort_content;
		$data['eng_ccontent']=$this->eng_ccontent;
		$data['txt_cnote']                   = $this->m_txt_cnote;
		
		if($this->m_arr_new>0)
		{	
			$data['lang']				= $this->m_lang;
			$data['data']				= $this->m_arr_new;
			
		}

		// Message thogn bao loi
		$data['error_ctitle']		= $this->m_error_ctitle;
		$data['error_sec']			= $this->m_error_sec;
		$data['error_cat']			= $this->m_error_cat;
		$data['error_ccontent']		= $this->m_error_ccontent;
		$data['error_cshort_content']= $this->m_error_cshort_content;
		$data['m_message']		= $this->m_error_msg;
		
		// Load view voi su kien tuong ung.
		$this->load->view('article_view/index.php',$data);
		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		if($this->m_txt_ctitle == '')
		{
			$this->m_error_msg	= $this->m_language_key('title') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		
		//if($this->m_cbo_nid_cat_news_view == '')
//		{
//			$this->m_error_cat	= $this->m_language_key('cat') . $this->lang->line('msg.0000.ErorNotNull');
//			return FALSE;
//		}
		// Kiem tra truong short content khong rong
//		if($this->m_txt_cshort_content == '')
//		{
//			$this->m_error_cshort_content	= $this->m_language_key('shortcontent') . $this->lang->line('msg.0000.ErorNotNull');
//			return FALSE;
//		}	
		// Kiem tra truong content khong rong
		if($this->m_txt_ccontent == '')
		{
			$this->m_error_msg	= $this->m_language_key('content') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}

		
		return TRUE;
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		
	//	if (fbcheck_exists_key_addnew('tnews', 'ctitle',$this->m_txt_ctitle)==FALSE)
//		{
//			$this->m_error_ctitle	 	= $this->m_language_key('title') . $this->lang->line('msg.0000.ErorDoubleKey');
//			return FALSE;		
//		}
	
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
				'ctitle'		=> $this->m_txt_ctitle,
				'ctag'			=> $this->m_txt_ctag,
				'nstatus'		=> 0,
				'cimage_thumb'	=> $this->m_txt_cthumb_img,
				'cshort_content'=> $this->m_txt_cshort_content,
				'cindex'		=> $this->cindex,				
				'ccontent'		=> $this->m_txt_ccontent,
				'alwcmt' 		=> $this->m_chk_alwcmt,	
				'ctype' 			=> 1,
				'eng_ctitle'		=> $this->eng_ctitle,				
				'eng_cshort_content'		=> $this->eng_cshort_content,
				'eng_ccontent' 		=> $this->eng_ccontent,	
				'cnote' => $this->m_txt_cnote,
				
				'niduser01'     => $this->m_nid_user_login,
				'ddate01'		=> dbget_current_date(),
				'niduser02'     => $this->m_nid_user_login,
				'ddate02'		=> dbget_current_date()
				);
			if($this->m_txt_cthumb_img !='')
			{
				$path						='.././upload/images/';
//				delfile($path.$this->m_hidden_image_old);
				$data	['cimage_thumb']	=  $this->m_txt_cthumb_img ;
			}
				
		// Goi phuong thuc cap nhat thong tin vao database.	
			$this->article_model->insert($data);
					
		return TRUE;
		}
		else
		{
			return FALSE;
		}
	}




/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		
	//	if (fbcheck_exists_key_update('tnews', 'ctitle',$this->m_txt_ctitle,$this->m_nid)==FALSE)
//		{
//			$this->m_error_ctitle	 	= $this->m_language_key('title') . $this->lang->line('msg.0000.ErorDoubleKey');
//			return FALSE;		
//		}
		
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu2212@gmail.com

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
		if ($this->check_valid_before_update()==true)
		{
			$data =	array(								
				'ctitle'			=> $this->m_txt_ctitle,
				'ctag'				=> $this->m_txt_ctag,
				'cindex'			=> $this->cindex,				
				'cshort_content'	=> $this->m_txt_cshort_content,
				'ccontent' 			=> $this->m_txt_ccontent,
				'alwcmt' 			=> $this->m_chk_alwcmt,
				'eng_ctitle'		=> $this->eng_ctitle,				
				'eng_cshort_content'		=> $this->eng_cshort_content,
				'eng_ccontent' 		=> $this->eng_ccontent,	
				'cnote' => $this->m_txt_cnote,
				
				'niduser02'			=> $this->m_nid_user_login,
				'ddate02'		=> dbget_current_date()
		        );

			if($this->m_txt_cthumb_img !='')
			{
				$path						='.././upload/images/';
				delfile($path.$this->m_hidden_image_old);
				$data	['cimage_thumb']	=  $this->m_txt_cthumb_img ;
			}
			$this->article_model->update_bynid($this->m_nid,$data);
//			$lang = array(
//				'nid_language'		=> $this->m_cbof_nid_lang
//						);
//			$this->lang_article_model->update_bynid($this->m_nid,$this->m_nid,$lang);
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}


	
function del_img($p_nid)
	{
	
		$tmp_news	= $this->article_model->get_byid($p_nid);
		$img_del	= $tmp_news['cimage_thumb'];
		if($img_del !='')
		{
			$path						='.././upload/images/';
			delfile($path.$img_del);
			$data 	= array('cimage_thumb'	=>'');
		}
		$this->article_model->update_bynid($p_nid,$data);
	}

}


// End do_article class
	
// End of file do_article.php
// Location: controllers/do_article.php