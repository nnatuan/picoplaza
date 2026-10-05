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
 * do_news_img class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Cao An Phu  
 *------------------------------------------------------------------
 */    
class do_news_img extends Controller 
{	
	var $m_language 		= ''; // nhan ngon ngu tu file language
	var $m_nid_user_login 	= ''; // nhan iduser tu session

	var $m_nid 				= ''; // nhan nid cua phuong xa can chinh sua
	var $m_event			= ''; // nhan su kien cap nhat hoac bo qua
	var $m_button_click		= ''; // nhan su kien tu hidden button o trang ap_product_gallery
	var $m_hidden_button	= '';
	var	$m_link_page  		= ''; // nhan link cua su kien
	var $m_link_cancel 		='';  // link toi trang ap_product_gallery_listview 

	var $m_form_product_gallery 		= ' Images Gallery'; // tieu de cua form
	
	var $m_hidden_image_old 	= ''; // giu lai duong dan cua hinh anh cu
	var $m_txt_cthumb_img		= ''; // nhan duong dan hinh anh
	
	var $m_cproduct_gallery		= '';
	// Nhung bien dung cho doi tuong.			
	var $m_txt_nid 			= ''; // nhan ma tin tuc
	
	var $m_nid_product		= '';

	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_msg		= '';
	 
	

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
function do_news_img()
	{ 			
		
		parent::Controller();
		session_start();
		//Load cac thu vien he thong.
		$this->load->database();
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view');
		$this->load->helper('ap_object');
	//	$this->load->helper('ap_fck'); // load thu vien de xuat ra trinh soan thao van ban
				
		// Kiem tra dieu kien login theo ma so he thong 1
		$this->tokaban_system_check = '1';
		// Load cac thu vien rieng can thiet khac neu co
		//$this->load->model('product_gallery_model');	
		
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
 
 private function m_language_key($str_key)
	{
		return $this->lang->line('lbl.product_gallery.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_product_gallery_listview_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_product_gallery_listview_'.$cookie_name);
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
function f_edit($nid) // ham chinh sua, tham so la nid cua phuong xa can chinh sua
	{
		$this->m_event = 'edit';
		$this->m_nid   = $nid;		 	
		$this->do_process();		
	}
	

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
 function index()
 {
 	$this->m_event 	= 'add';
	$this->do_process();
 }
 
function get_gallery($nid_product)
	{
		$this->m_event 	= 'add';
		$this->m_nid_product	= $nid_product;
		$this->f_set_cookie('m_nid_product',$this->m_nid_product);
		$this->do_process();
	}
 	
function do_process() // ham xu ly
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
		// Lay nid user tu session
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		// Load file ngon ngu can su dung
		$this->load->language('ap', 'eng');
		
		// Xac dinh cac gia tri duoc post tu view.
		
		// Kiem tra hinh anh duoc upload
		// Kiem tra hinh anh duoc upload
		if(isset($_FILES["txt_cthumb_img"]))
		{
			if($_FILES["txt_cthumb_img"]['name'] != '')
			{
				$this->m_cproduct_gallery	= $_FILES["txt_cthumb_img"]['name'];
				$path						= './upload/images_news/full_images/';
				$this->m_txt_cthumb_img 	= Fupload_resize_img($_FILES["txt_cthumb_img"],'../'.$path,800,800);
			}
		}
		
		// Can kiem tra tren tung form cu the.
		
		// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
		
		if (isset($_POST['hidden_nid_product']))
		{
		
			$this->m_nid_product 	= $_POST['hidden_nid_product'];
			$this->f_set_cookie('m_nid_product',$this->m_nid_product);
		}
		
			
		if (isset($_POST['hidden_image_old']))
			$this->m_hidden_image_old	= $_POST['hidden_image_old'];
				
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button_click']))
			$this->m_button_click	= $_POST['hidden_button_click'];
		
		if (isset($_POST['hidden_button']))
			$this->m_hidden_button	= $_POST['hidden_button'];
	
	}
		

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		$this->m_link_cancel = base_url() . 'index.php/do_news_img_listview';
		//$this->m_obj_cat_news_gallery_view 	= Obj_get_cat_product_gallery();		
		
		$this->m_nid_product 			= $this->f_get_cookie('m_nid_product');
		
		// Xu ly tuy theo su kien.
		if($this->m_hidden_button == 'btn_delete')
		{
			$this->delete();
		}
		
		switch ($this->m_event)
		{
			case 'edit':										
				$this->m_form_product_gallery = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_news_img/f_update_edit';	
				
				// Chi trong truong hop edit thi moi lay thong tin doi tuong.
				// Chi to chuc bien va nhan nhung thong tin can thiet phuc vu cho viec xu ly ma thoi.
				$this->db->where('nid',$this->m_nid);
				
				$obj_result = $this->db->get(Fget_ap_table('tnews_gallery_detail')); 
				$product_gallery = $obj_result->row_array();	
				
				$this->m_txt_nid			= $product_gallery['nid'];
				$this->m_nid_product		= $product_gallery['nid_product'];
				$this->m_txt_cthumb_img		= $product_gallery['cimage_full'];	
					
				$this->m_event 	= 'update_edit';
				break;
								
			case 'add':
				$this->m_form_product_gallery = $this->m_language_key('FormAddTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_news_img/f_update_add';
				$this->m_event 	= 'update_add';
				break;
				
			case 'update_edit':
				$this->m_form_product_gallery = $this->m_language_key('FormEditTitle');
				
				if ($this->m_button_click == 'btn_submit')
						if ($this->update_data()==TRUE)
						
							redirect (base_url().'index.php/do_news_img/get_gallery/'.$this->m_nid_product);
				
				$this->m_link_page 	= base_url() . 'index.php/do_news_img/f_update_edit';
				break;
			
			case 'update_add':
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
						{
							$new_id	= dbget_identity();
							redirect (base_url().'index.php/do_news_img/f_edit/'.$new_id);
						}
						
				//
				
				//$this->m_form_product_gallery = $this->m_language_key('FormAddproduct_gallery');
				$this->m_link_page 	= base_url() . 'index.php/do_news_img/f_update_add';
				break;
						
		}	
	

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
								
		$data['event'] 				= $this->m_event;
		
		// Cac thong bao khi nhan button Xoa
		$data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
		$data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;				
		
		// Ten cac button		
		$data['btn_delete'] 	    = $this->lang->line('btn.0000.Delete');
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		$data['lbl_tag'] 			= $this->lang->line('lbl.0000.Tag');
		$data['fr_img']				= Fstr_replace('admin/','',base_url());

		// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');;
		
		$data['nid'] 				= $this->m_nid;
		
		// tieu de form
		$data['lbl_form_title'] 	= $this->m_form_product_gallery;
		
		
		// Tieu de cac truong
		$data['lbl_nid']          	= $this->m_language_key('nid');						

		// Gia tri hien thi
		if($this->m_txt_cthumb_img != '')
			$data['txt_cthumb_img'] 	= $this->m_txt_cthumb_img;
		else
			$data['txt_cthumb_img'] 	= $this->m_hidden_image_old;
			
		$data['nid_product']		= $this->m_nid_product;
		
		// Message thogn bao loi
		$data['m_error_msg']		= $this->m_error_msg;
		$data['menu_active']		= 'product_gallery';

		// Load view voi su kien tuong ung.
		if($this->m_event == 'edit' || $this->m_event == 'update_edit')
			$this->load->view('news_gallery_view/crop_images',$data);
		else
			$this->load->view('news_gallery_view/index',$data);
		
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
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
private function check_valid_not_null()
	{
		
		// Kiem tra truong product_gallery khong rong
		if($this->m_txt_cthumb_img == '')
		{
			$this->m_error_msg	= 'Please choose a image!';
			return FALSE;
		}
		return TRUE;
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
				
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
				'cimage_full'	=> $this->m_txt_cthumb_img,	
				'nid_product'	=> $this->m_nid_product,	
				'cgallery_detail'	=> $this->m_cproduct_gallery,									
				'niduser01'     => $this->m_nid_user_login,
				'niduser02'     => $this->m_nid_user_login,
				'ddate02'		=> dbget_current_date(),
				'ddate01'		=> dbget_current_date()
				);

			// Goi phuong thuc cap nhat thong tin vao database.
			$this->db->insert(Fget_ap_table('tnews_gallery_detail'), $data);		
		return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		//Get the new coordinates to crop the image.
		$x1 = $_POST["x1"];
		$y1 = $_POST["y1"];
		$x2 = $_POST["x2"];
		$y2 = $_POST["y2"];
		$w = $_POST["w"];
		$h = $_POST["h"];
		
		//Scale the image to the thumb_width set above
		$scale = 118/$w;
		$path_full				= './upload/images_news/full_images/';
		$path_thumb				= './upload/images_news/thumb_images/';

		$large_image_location	= '../'.$path_full.$this->m_hidden_image_old;
		$thumb_image_location	= '../'.$path_thumb.'thumb_'.$this->m_hidden_image_old;
		$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
		if ($this->check_valid_before_update())
		{
			$data =	array(		
				'cimage_thumb'		=> 'thumb_'.$this->m_hidden_image_old,							
				'niduser02'			=> $this->m_nid_user_login,
				'ddate02'			=> $this->m_nid_user_login
		        );

			$this->db->where('nid', $this->m_nid);
			$this->db->update(Fget_ap_table('tnews_gallery_detail'), $data);				
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
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
			foreach ($_POST['chk'] as $nid)
			{
				$this->db->where('nid',$nid);
				$obj_result = $this->db->get(Fget_ap_table('tnews_gallery_detail')); 
				$obj_data = $obj_result->row_array();
				if($obj_data['cimage_full'] != '')
				{
					$path		= '.././upload/images_news/full_images/';
					@unlink($path.$obj_data['cimage_full']);
				}
				if($obj_data['cimage_thumb'] != '')
				{
					$path		= '.././upload/images_news/thumb_images/';
					@unlink($path.$obj_data['cimage_thumb']);
				}
				$this->db->where('nid', $nid);
				$this->db->delete(Fget_ap_table('tnews_gallery_detail'));
			}
	}	

}
// End do_news_img class
	
// End of file do_news_img.php
// Location: controllers/do_news_img.php