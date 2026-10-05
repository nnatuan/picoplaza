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
 * do_news class
 *
 * Quan ly them, sua thong tin danh muc quan huyen
 *
 * @subpackage	controllers
 * @category	
 * @author		Cao An Phu 
 *------------------------------------------------------------------
 */     
class do_gallery_img extends CI_Controller  
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
	var $m_hidden_image_old = ''; // giu lai duong dan cua hinh anh cu
	var $m_txt_cthumb_img				= '';
	
	var $m_hidden_image_old_icon 	= ''; // giu lai duong dan cua hinh anh cu
	var $m_txt_cthumb_img_icon		= '';
	
// Nhung bien dung cho doi tuong.			  
	var $m_txt_nid 			  		= ''; // nhan ma tin 
	var $nid_product			  	= '';// dai dien cho bien ccode
	var $ctitle		 				= '';
	var $cimg_color					= ''; // nhan tag tin tuc	
	var $cimg						= '';
	var $cindex						= '';
	var $nstatus					= '';
	
	var $m_txt_user01				= '';
	var $m_txt_ddate01				='';
	var $m_obj_data_view    		= '';
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_msg 	    		= ''; 
	var $m_link_cancel_trans	= '';
	
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
		//Load cac thu vien he thong.
		$this->load->database();
		
		$this->load->helper('ap_db');	
		$this->load->helper('ap_function');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view');
		$this->load->helper('ap_object');
		//$this->load->helper('ap_fck'); // load thu vien de xuat ra trinh soan thao van ban
				
		// Kiem tra dieu kien login theo ma so he thong 1
		$this->config->check_system_login = '1';
		// Load cac thu vien rieng can thiet khac neu co
		$this->load->model('gallery_img_model');
		
	}

function delete_image($nid)
	{
		$obj_data = $this->gallery_img_model->get_byid($nid);
		$path				= '.././upload/color/';
		unlink($path.$obj_data['cimage']);
		
		$data['cimage']		=  '' ;
		$this->gallery_img_model->update_bynid($nid, $data);	
		echo 'Deleted images!!';
	}
	
function delete_image_icon($nid)
	{
		$obj_data = $this->gallery_img_model->get_byid($nid);
		$path				= '.././upload/color_thumb/';
		unlink($path.$obj_data['cicon']);
		
		$data['cicon']		=  '' ;
		$this->gallery_img_model->update_bynid($nid, $data);	
		echo 'Deleted Icon!!';
	}
	/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		return $this->lang->line('lbl.material.'.$str_key);
	}
	
//Function Set Cookies
private function f_set_cookie($cookie_name,$cookie_value)
 { 
	return dbset_cookie('cookie_material_'.$cookie_name,$cookie_value);
 }
//Get Cookie

private function f_get_cookie($cookie_name)
 { 
	return dbget_cookie('cookie_material_'.$cookie_name);
 }
/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		// Kiem tra hinh anh duoc upload
		//if(isset($_FILES["cimg_color"]))
//		{
//			
//		 	$path						= './upload/color_thumb/';
//			$this->cimg_color 	= Fupload_resize_img($_FILES["cimg_color"],'../'.$path,227,385);
//		}
		
		// Kiem tra hinh anh duoc upload
		if(isset($_FILES["cimg"]))
		{
			
		 	$path							= './upload/gallery/';
			$this->cimg 	= Fupload_resize_img($_FILES["cimg"],'../'.$path,2000,2000);
//			$this->cimg_color 	= Fupload_resize_img($_FILES["cimg_color"],'../'.$path,150,84);
		}
		
		if (isset($_POST['ctitle']))
			$this->ctitle		 	= trim($_POST['ctitle']);
		if (isset($_POST['cindex']))
			$this->cindex		 	= trim($_POST['cindex']);
			
// Kiem tra va nhan cac bien hidden neu co.
		if (isset($_POST['hidden_nid']))
			$this->m_nid 			= $_POST['hidden_nid'];
			
		if (isset($_POST['hidden_event']))
			$this->m_event			= $_POST['hidden_event'];
			
		if (isset($_POST['hidden_button']))
			$this->m_button_click	= $_POST['hidden_button'];
		
		if (isset($_POST['hidden_image_old']))
			$this->m_hidden_image_old	= $_POST['hidden_image_old'];
		
		if (isset($_POST['hidden_image_old_icon']))
			$this->m_hidden_image_old_icon	= $_POST['hidden_image_old_icon'];
			
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
		$this->m_link_page 	= base_url() . 'index.php/do_gallery_img/f_update_edit';	
		$this->m_link_cancel = base_url() . 'index.php/do_gallery_img_listview';	
		$this->nid_product = dbget_cookie('nid_gallery_img');
		switch ($this->m_event)
		{
			case 'edit':	
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_gallery_img/f_update_edit';	
				$materials = $this->gallery_img_model->get_byid($this->m_nid);
				$this->ctitle 				= $materials['ctitle'];
				$this->cimg_color			= $materials['cimg_color'];
				$this->cimg					= $materials['cimg'];
				$this->nstatus				= $materials['nstatus'];				
				$this->cindex				= $materials['cindex'];
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
							redirect ('do_gallery_img_listview');
			
				
				$this->m_link_page 	= base_url() . 'index.php/do_gallery_img/f_update_edit';
				break;
			
			case 'update_add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_gallery_img_listview');
				$this->m_link_page 	= base_url() . 'index.php/do_gallery_img/f_update_add';
			
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
//He thong					
		$data['event'] 				= $this->m_event;
		//$data['menu'] 				= Fget_menu_html($this->m_nid_user_login);		
		
		$data['link_page'] 			= $this->m_link_page;
		$data['link_cancel'] 		= $this->m_link_cancel;		
		$data['link_cancel_trans'] 	= $this->m_link_cancel_trans;
// Ten cac button		
		$data['btn_update'] 		= $this->lang->line('btn.0000.Update');
		$data['btn_cancel'] 		= $this->lang->line('btn.0000.Cancel');
		$data['lbl_tag'] 			= $this->lang->line('lbl.0000.Tag');
		$data['fr_img']			= Fstr_replace('admin/','',base_url());

// Ky hieu dung de xac dinh cac truong thong tin khong duoc phep thieu.
		$data['get_icon_notnull']   	= Fget_icon_notnull();		
		$data['get_message_notnull']   	= Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');;
		
//lbl_form
		$data['lbl_form_title'] 		= 'Thư viện ảnh';
		$data['lbl_name'] 				= $this->m_language_key('cmaterial');
		$data['lbl_index'] 				= $this->m_language_key('index');
		$data['lbl_cnote'] 				= $this->m_language_key('cnote');
		$data['lbl_nstatus'] 			= $this->m_language_key('nstatus');
// lbl err
		$data['lbl_error_msg']			=$this->m_error_msg;

		
//Bien doi tuong 
		// Gia tri hien thi
		if($this->cimg != '')
			$data['cimg'] 	= $this->cimg;
		else
			$data['cimg'] 	= $this->m_hidden_image_old;		
		// Gia tri hien thi
		if($this->cimg_color != '')
			$data['cimg_color'] 	= $this->cimg_color;
		else
			$data['cimg_color'] 	= $this->m_hidden_image_old_icon;					
		$data['ctitle']						=$this->ctitle;
		$data['cimg_color']					=$this->cimg_color;
		$data['cindex']						=$this->cindex;		
		$data['gen_cbo_status']				= Fget_combobox_yes_no('no','nstatus',$this->nstatus,'width:250px',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
//Truyen bien nid cho view
		$data['nid']						=$this->m_nid;
		$data['menu_active']		= 'material_product';
	
// Load view voi su kien tuong ung.
		$this->load->view('gallery_img_view/index.php',$data);
		
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
		
		// Kiem tra truong title khong rong
		
		if($this->ctitle == '')
		{
			$this->m_error_msg	= 'Title' . $this->lang->line('msg.0000.ErorNotNull');
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
		{
			return FALSE;
		}
		if (fbcheck_exists_key_addnew('tgallery_img', 'ctitle',$this->ctitle)==FALSE)
		{
			$this->m_error_msg	 	= 'Title' . $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
	
		return TRUE;		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
		if($this->m_txt_cthumb_img == '')
			$this->m_txt_cthumb_img = $this->m_hidden_image_old;
		
		if($this->m_txt_cthumb_img_icon == '')
			$this->m_txt_cthumb_img_icon = $this->m_hidden_image_old_icon;
			
		if ($this->check_valid_before_insert()== TRUE)
		{
		$data =	array(								
						'nid_product'		=> $this->nid_product,
						'cimg_color'		=> $this->cimg_color,
						'ctitle'			=> $this->ctitle,
						'cimg'				=> $this->cimg,
						'nstatus'			=> 1,
						'nhome'			=> 0,
						'cindex'			=> $this->cindex,
						'niduser01'     	=> $this->m_nid_user_login,
						'ddate01'			=> dbget_current_date()
						);
		
		// Goi phuong thuc cap nhat thong tin vao database.	
		$this->gallery_img_model->insert($data);
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
		if ($this->check_valid_not_null()== FALSE)
			return FALSE;

		if (fbcheck_exists_key_update('tgallery_img', 'ctitle',$this->ctitle, $this->m_nid)==FALSE)
		{		
			$this->m_error_msg	 	= 'Title'. $this->lang->line('msg.0000.ErorDoubleKey');
			return FALSE;		
		}
		
		return TRUE;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com

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
						'nid_product'		=> $this->nid_product,
						'cimg_color'		=> $this->cimg_color,
						'ctitle'			=> $this->ctitle,
						'nstatus'			=> 1,
						'cindex'			=> $this->cindex,
						'niduser01'     	=> $this->m_nid_user_login,
						'ddate01'			=> dbget_current_date()
			);
			if($this->cimg != '')
				$data['cimg'] = $this->cimg;
				
			$this->gallery_img_model->update_bynid($this->m_nid, $data);		
			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}
private function convert_webp($path)
    {
		$webp_img = webpConvert2($path);
		delfile($path);
		return(basename($webp_img));
	}	
function insert_img($nid_product)
    {
            $targetFolder = './../upload/gallery/';
            
            $tempFile   = $_FILES['Filedata']['tmp_name'];
            $file = $_FILES['Filedata'];
            $file_name = explode(".", $file["name"]);
            $file_name = $file_name[0].'_'.date('Ymdhis').'.'.$file_name[1];

            $targetPath =  $targetFolder;
            $targetFile = rtrim($targetPath, '/') . '/' . $file_name;
            $fileTypes  = array(
                'jpg',
                'jpeg',
                'gif',
                'png'
            );
			
			/*
            $data = array(
                'nid_product' => $nid_product,
                'cimg' => $file_name,
                'ddate01' => dbget_current_date()
            );
            $this->db->insert(Fget_ap_table('tgallery_img'), $data);
			*/
            
            $fileParts  = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
				
				if ($file_name != '' && pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION) != "webp") 
					$file_name = $this->convert_webp($targetFolder . $file_name);
				
				$data = array(
						'nid_product' => $nid_product,
						'cimg' => $file_name,
						'ddate01' => dbget_current_date()
				);
				$this->db->insert(Fget_ap_table('tgallery_img'), $data);
					
                $output = array("success" => true, "message" => "Success!");
                
            } else {
                $output = array("success" => false, "error" => "Failure!");
                //echo 'Invalid file type.';
            }
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($output);
    }
function delete_img(){
    	$id ='';
    	if(isset($_POST['nid']))
    		$id = $_POST['nid'];
    	$targetFolder = './../upload/gallery/';
    	$this->db->where("nid",$id);
    	$obj_img =  $this->db->get("tgallery_img");
    	$obj_img = $obj_img->row_array();
    	if(isset($obj_img['nid'])){
    		@unlink($targetFolder.$obj_img['cimg']);
    		$this->db->where("nid",$id);
    		$this->db->delete("tgallery_img");
    	}
    	exit('ok');
    }	
}
// End do_news class	
// End of file do_news.php
// Location: controllers/do_news.php