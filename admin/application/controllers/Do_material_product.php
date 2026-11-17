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
class do_material_product extends CI_Controller  
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
	var $m_txt_nid 			  	= ''; // nhan ma tin 
	var $ccode			  	= '';// dai dien cho bien ccode
	var $m_txt_cmaterial_products 	= '';
	var $m_txt_ctag			= ''; // nhan tag tin tuc	

	var $m_txt_cnote				= '';
	var $m_txt_nstatus				= '';
	var $m_txt_cindex				= '';
	var $m_txt_user01				= '';
	var $m_txt_ddate01				='';
	var $m_obj_data_view    		= '';
	var $eng_cmaterial_products 	= '';
	
	// Cac bien can xuat hien thi thong bao len view cho nguoi dung xem.
	var $m_error_msg 	    		= ''; 
	var $m_link_cancel_trans	= '';
	var $cproduct_fb ='';
	
	var $m_hidden_image_old_banner1 	= ''; 
	var $m_hidden_image_old_banner2 	= ''; 
	var $m_hidden_image_old_banner3 	= ''; 
	var $cbanner1		= '';
	var $cbanner2		= '';
	var $cbanner3		= '';
	var $clink_banner1			  	= '';
	var $clink_banner2			  	= '';
	var $clink_banner3			  	= '';
	var $m_cbo_nid_group 	= '';
	var $m_obj_group_view = '';
	
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
				
		// Kiem tra dieu kien login theo ma so he thong 1
		$this->config->check_system_login = '1';
		// Load cac thu vien rieng can thiet khac neu co
		$this->load->model('material_product_model');
		
		
		
	}

function delete_image($nid)
	{
		$obj_data = $this->material_product_model->get_byid($nid);
		$path				= '.././upload/banner/';
		unlink($path.$obj_data['cimage']);
		
		$data['cimage']		=  '' ;
		$this->material_product_model->update_bynid($nid, $data);	
		echo 'Deleted images!!';
	}
	
function delete_image_icon($nid)
	{
		$obj_data = $this->material_product_model->get_byid($nid);
		$path				= '.././upload/images_product/sec/';
		unlink($path.$obj_data['cicon']);
		
		$data['cicon']		=  '' ;
		$this->material_product_model->update_bynid($nid, $data);	
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
		if(get_check_permission(37))
			$this->do_process();
		else 
			redirect(base_url().'index.php/do_access_denied');		
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
		if(get_check_permission(36))
			$this->do_process();
		else 
			redirect(base_url().'index.php/do_access_denied');
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
private function convert_webp($path)
    {
		$webp_img = webpConvert2($path);
		delfile($path);
		return(basename($webp_img));
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
		
		// Kiem tra hinh anh duoc upload
		if (isset($_FILES["cproduct_fb"])) {
            if ($_FILES["cproduct_fb"]["name"] != '') {
                    $path_fb               = '.././upload/images_product/sec/';
					$this->cproduct_fb = Fupload_resize_img($_FILES["cproduct_fb"], $path_fb, 600, 315);
				}
			}
		if(isset($_FILES["cbanner1"]))
		{
		 	$path						= './upload/images_product/sec/';
			$this->cbanner1 	= Fupload_resize_img($_FILES["cbanner1"],'../'.$path,1920,300);
		}
		if(isset($_FILES["cbanner2"]))
		{
		 	$path						= './upload/images_product/sec/';
			$this->cbanner2 	= Fupload_resize_img($_FILES["cbanner2"],'../'.$path,1000,1000);
		}
		if(isset($_FILES["cbanner3"]))
		{
		 	$path						= './upload/images_product/sec/';
			$this->cbanner3 	= Fupload_resize_img($_FILES["cbanner3"],'../'.$path,1000,1000);
		}	
		if (isset($_POST['eng_cmaterial_products']))
			$this->eng_cmaterial_products=$_POST['eng_cmaterial_products'];
		if (isset($_POST['ccode']))
			$this->ccode=$_POST['ccode'];
		if (isset($_POST['clink_banner1']))
			$this->clink_banner1=$_POST['clink_banner1'];
		if (isset($_POST['clink_banner2']))
			$this->clink_banner2=$_POST['clink_banner2'];
		if (isset($_POST['clink_banner3']))
			$this->clink_banner3=$_POST['clink_banner3'];
			
			
		// Kiem tra hinh anh duoc upload
		if(isset($_FILES["txt_cthumb_img"]))
		{
		 	$path							= '.././upload/images_product/sec/';
			$this->m_txt_cthumb_img 	= Fupload_resize_img($_FILES["txt_cthumb_img"],$path,2000,2000);
			if ($this->m_txt_cthumb_img != '') 
				$this->m_txt_cthumb_img = $this->convert_webp($path . $this->m_txt_cthumb_img);
		}
		if(isset($_FILES["txt_cthumb_img_icon"]))
		{
		 	$path							= '.././upload/images_product/sec/';
			$this->m_txt_cthumb_img_icon 	= Fupload_resize_img($_FILES["txt_cthumb_img_icon"],$path,550,550);
			if ($this->m_txt_cthumb_img_icon != '') 
				$this->m_txt_cthumb_img_icon = $this->convert_webp($path . $this->m_txt_cthumb_img_icon);
		}
		
		if (isset($_POST['txt_cmaterial_products']))
		{
			$this->m_txt_cmaterial_products		 	= trim($_POST['txt_cmaterial_products']);
			$this->m_txt_cindex		 				= trim($_POST['txt_cindex']);
			$this->m_txt_cnote		 				= trim($_POST['txt_cnote']);
			//$this->m_txt_nstatus	 				= trim($_POST['txt_nstatus']);
			$this->m_cbo_nid_group  = trim($_POST['cbo_nid_group']);
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
		if (isset($_POST['hidden_image_old_banner1']))
			$this->m_hidden_image_old_banner1	= $_POST['hidden_image_old_banner1'];
		if (isset($_POST['hidden_image_old_banner2']))
			$this->m_hidden_image_old_banner2	= $_POST['hidden_image_old_banner2'];	
		if (isset($_POST['hidden_image_old_banner3']))
			$this->m_hidden_image_old_banner3	= $_POST['hidden_image_old_banner3'];	
		
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
		$this->m_link_page 	= base_url() . 'index.php/do_material_product/f_update_edit';	
		$this->m_link_cancel = base_url() . 'index.php/do_material_product_listview';	
		
		switch ($this->m_event)
		{
			case 'edit':	
				$this->m_form_title = $this->m_language_key('FormEditTitle');
				$this->m_link_page 	= base_url() . 'index.php/do_material_product/f_update_edit';	

				$materials = $this->material_product_model->get_byid($this->m_nid);
					$this->m_txt_cmaterial_products 	= $materials['cmaterial_products'];
					$this->m_txt_cnote					= $materials['cnote'];
					$this->m_txt_cindex					= $materials['cindex'];
					$this->m_txt_nstatus				= $materials['nstatus'];
					$this->m_txt_cthumb_img  			= $materials['cimage'];
					$this->cbanner1  			= $materials['cbanner1'];	
					$this->cbanner2  			= $materials['cbanner2'];	
					$this->cbanner3  			= $materials['cbanner3'];	
					$this->m_txt_cthumb_img_icon		= $materials['cicon'];
					$this->eng_cmaterial_products		= $materials['eng_cmaterial_products'];
					$this->ccode		= $materials['ccode'];
					$this->clink_banner1		= $materials['clink_banner1'];
					$this->clink_banner2		= $materials['clink_banner2'];
					$this->clink_banner3		= $materials['clink_banner3'];
					$this->cproduct_fb            		= $materials['cproduct_fb'];
					$this->m_cbo_nid_group 	= $materials['nid_group'];
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
							redirect ('do_material_product_listview');
			
				
				$this->m_link_page 	= base_url() . 'index.php/do_material_product/f_update_edit';
				break;
			
			case 'update_add':
				$this->m_form_title = $this->m_language_key('FormAddTitle');
				if ($this->m_button_click == 'btn_submit')
						if ($this->insert_data()==TRUE)
							redirect ('do_material_product_listview');
				$this->m_link_page 	= base_url() . 'index.php/do_material_product/f_update_add';
			
					break;
		}	
		$this->m_obj_group_view 	= Obj_get_group_list($this->m_nid_user_login);	
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
		$data['menu'] 				= Fget_menu_html($this->m_nid_user_login);
		$data['lbl_form_title'] 	= $this->m_form_title;
		
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
		$data['lbl_form_title'] 		= $this->m_form_title;
		$data['lbl_name'] 				= $this->m_language_key('cmaterial');
		$data['lbl_index'] 				= $this->m_language_key('index');
		$data['lbl_cnote'] 				= $this->m_language_key('cnote');
		$data['lbl_nstatus'] 			= $this->m_language_key('nstatus');
// lbl err
		$data['m_message']			=$this->m_error_msg;
		
//Bien doi tuong 
		// Gia tri hien thi
		if($this->m_txt_cthumb_img != '')
			$data['txt_cthumb_img'] 	= $this->m_txt_cthumb_img;
		else
			$data['txt_cthumb_img'] 	= $this->m_hidden_image_old;
		
		// Gia tri hien thi
		if($this->m_txt_cthumb_img_icon != '')
			$data['txt_cthumb_img_icon'] 	= $this->m_txt_cthumb_img_icon;
		else
			$data['txt_cthumb_img_icon'] 	= $this->m_hidden_image_old_icon;
		
		if($this->cbanner1 != '')
			$data['cbanner1'] 	= $this->cbanner1;
		else
			$data['cbanner1'] 	= $this->m_hidden_image_old_banner1;
		
		if($this->cbanner2 != '')
			$data['cbanner2'] 	= $this->cbanner2;
		else
			$data['cbanner2'] 	= $this->m_hidden_image_old_banner2;
		
		if($this->cbanner3 != '')
			$data['cbanner3'] 	= $this->cbanner3;
		else
			$data['cbanner3'] 	= $this->m_hidden_image_old_banner3;
		
		$data['txt_ctag'] 				= $this->m_txt_ctag;
		
		$data['txt_cmaterial_products']		=$this->m_txt_cmaterial_products;
		$data['txt_cindex']					=$this->m_txt_cindex;
		$data['txt_cnote']					=$this->m_txt_cnote;
		$data['txt_nstatus']				=$this->m_txt_nstatus;
		$data['eng_cmaterial_products']				=$this->eng_cmaterial_products;
		$data['ccode']				=$this->ccode;
		$data['clink_banner1']				=$this->clink_banner1;
		$data['clink_banner2']				=$this->clink_banner2;
		$data['clink_banner3']				=$this->clink_banner3;
		$data['cproduct_fb']               = $this->cproduct_fb;
		$data['gen_cbo_status']				= Fget_combobox_yes_no('no','txt_nstatus',$this->m_txt_nstatus,'width:258px',$this->lang->line('lbl.0000.Yes'),$this->lang->line('lbl.0000.No'));
		$data['gencbo_group_list']	= Fgen_html_combobox('no', 'cbo_nid_group', $this->m_cbo_nid_group, '', $this->m_obj_group_view, 'nid', 'cname','nosubmit','');
//Truyen bien nid cho view
		$data['nid']						=$this->m_nid;

		$data['menu_active']		= 'material_product';
	
// Load view voi su kien tuong ung.
		$this->load->view('material_product_view/index.php',$data);
		
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
		
		if($this->m_txt_cmaterial_products == '')
		{
			$this->m_error_msg	= $this->m_language_key('cmaterial') . $this->lang->line('msg.0000.ErorNotNull');
			return FALSE;
		}
		if($this->ccode == '')
		{
			$this->m_error_msg	= 'Code' . $this->lang->line('msg.0000.ErorNotNull');
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
		if (fbcheck_exists_key_addnew('tmaterial_products', 'cmaterial_products',$this->m_txt_cmaterial_products)==FALSE)
		{
			$this->m_error_msg	 	= $this->m_language_key('cmaterial') . $this->lang->line('msg.0000.ErorDoubleKey');
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
						'ccode'		=> $this->ccode,
						'clink_banner1'		=> $this->clink_banner1,
						'clink_banner2'		=> $this->clink_banner2,
						'clink_banner3'		=> $this->clink_banner3,
						'cmaterial_products'		=> $this->m_txt_cmaterial_products,
						'cnote'						=> $this->m_txt_cnote,
						'eng_cmaterial_products'	=> $this->eng_cmaterial_products,
						'cimage'					=> $this->m_txt_cthumb_img,
						'cicon'						=> $this->m_txt_cthumb_img_icon,
						'cbanner1'					=> $this->cbanner1,	
						'cbanner2'					=> $this->cbanner2,	
						'cbanner3'					=> $this->cbanner3,	
						'ctag'						=> $this->m_txt_ctag,	
						'cindex'					=> $this->m_txt_cindex,
						'nstatus'					=> 1,
						'nspecial'					=> 0,		
						'cproduct_fb' => $this->cproduct_fb,
						'nid_group'		=> $this->m_cbo_nid_group,	
						'niduser01'     			=> $this->m_nid_user_login,
						'ddate01'					=> dbget_current_date()
						);
		
		// Goi phuong thuc cap nhat thong tin vao database.	
		$this->material_product_model->insert($data);
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

			if (fbcheck_exists_key_update('tmaterial_products', 'cmaterial_products',$this->m_txt_cmaterial_products, $this->m_nid)==FALSE)
		{
		
			$this->m_error_msg	 	= $this->m_language_key('cmaterial') . $this->lang->line('msg.0000.ErorDoubleKey');

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
			'ccode'		=> $this->ccode,		
			'clink_banner1'		=> $this->clink_banner1,
						'clink_banner2'		=> $this->clink_banner2,
						'clink_banner3'		=> $this->clink_banner3,
			'cmaterial_products'		=> $this->m_txt_cmaterial_products,
			'cnote'						=> $this->m_txt_cnote,
			'cindex'					=> $this->m_txt_cindex,
			'ctag'						=> $this->m_txt_ctag,	
			'eng_cmaterial_products'	=> $this->eng_cmaterial_products,
			'nid_group'		=> $this->m_cbo_nid_group,	
			//'nstatus'					=> $this->m_txt_nstatus,		
			'niduser01'     			=> $this->m_nid_user_login,
			'ddate01'					=> dbget_current_date()
			);
			if ($this->m_txt_cthumb_img != '') {
                $path = '.././upload/images_product/sec/';
				if(file_exists($path. $this->m_hidden_image_old))
					delfile($path . $this->m_hidden_image_old);
                $data['cimage'] = $this->m_txt_cthumb_img;
            }
			if ($this->m_txt_cthumb_img_icon != '') {
                $path = '.././upload/images_product/sec/';
				if(file_exists($path. $this->hidden_image_old_icon))
					delfile($path . $this->hidden_image_old_icon);
                $data['cicon'] = $this->m_txt_cthumb_img_icon;
            }
			/*
			if ($this->cproduct_fb != '') {
               // $path = '.././upload/images_product/fb/';
              //  delfile($path . $this->m_hidden_image_old);
                $data['cproduct_fb'] = $this->cproduct_fb;
            }
			if ($this->cbanner1 != '') {
                $path = '.././upload/images_product/sec/';
                delfile($path . $this->m_hidden_image_old_banner1);
                $data['cbanner1'] = $this->cbanner1;
            }
			if ($this->cbanner2 != '') {
                $path = '.././upload/images_product/sec/';
                delfile($path . $this->m_hidden_image_old_banner2);
                $data['cbanner2'] = $this->cbanner2;
            }
			if ($this->cbanner3 != '') {
                $path = '.././upload/images_product/sec/';
                delfile($path . $this->m_hidden_image_old_banner3);
                $data['cbanner3'] = $this->cbanner3;
            }
			*/
			$this->material_product_model->update_bynid($this->m_nid, $data);		

			return TRUE; 
		}
		else
		{
			return FALSE;
		}
	}

}


// End do_news class
	
// End of file do_news.php
// Location: controllers/do_news.php