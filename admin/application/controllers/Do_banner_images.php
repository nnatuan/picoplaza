<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class do_banner_images extends CI_Controller
{
    var $m_language = '';
    var $m_nid_user_login = '';
    var $m_nid = '';
    var $m_event = '';
    var $m_button_click = '';
    var $m_link_page = '';
    var $m_link_cancel = '';
    var $m_link_cancel_trans = '';
    var $m_form_banner_images = '';
    var $m_hidden_image_old = '';
    var $m_txt_cthumb_img = '';
	var $m_hidden_image_old_mobile = '';
    var $m_txt_cthumb_img_mobile = '';
    var $m_txt_nid = '';
    var $m_txt_ccode = '';
    var $m_txt_ctag = '';
    var $m_txt_cbanner_images = '';
    var $m_nid_news_org = '';
    var $m_cbof_nid_lang = '';
    var $m_txt_cnote = '';
    var $m_txt_nstatus = '';
    var $m_txt_cindex = '';
    var $m_arr_new = '';
    var $m_error_msg = '';
	var $cview = '';
	var $cloc_banner = '';
    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_object');
     
        //$this->tokaban_system_check = '1';
		$this->config->check_system_login = '1';
        $this->load->model('banner_images_model');
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('B?n khong co quy?n truy c?p ch?c nang nay!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}	
    }
    function delete_image($nid)
    {
        $obj_data = $this->banner_images_model->get_byid($nid);
        $path     = '.././upload/banner/';
        unlink($path . $obj_data['cimage']);
        $data['cimage'] = '';
        $this->banner_images_model->update_bynid($nid, $data);
        echo 'da xoa images!!';
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.banner_images.' . $str_key);
    }
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_banner_images_listview_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_banner_images_listview_' . $cookie_name);
    }
    function f_edit($nid)
    {
        $this->m_event = 'edit';
        $this->m_nid   = $nid;
        $this->do_process();
    }
    function f_update_edit()
    {
        $this->m_event = 'update_edit';
        $this->do_process();
    }
    function f_add()
    {
        $this->m_event = 'add';
        $this->m_nid   = '0';
        $this->do_process();
    }
    function f_update_add()
    {
        $this->m_event = 'update_add';
        $this->do_process();
    }
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }
	private function convert_webp($path)
    {
		$webp_img = webpConvert2($path);
		delfile($path);
		return(basename($webp_img));
	}
    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');
        if (isset($_FILES["txt_cthumb_img"])) {
            $path                   = './upload/banner/';
            $this->m_txt_cthumb_img = Fupload_resize_img($_FILES["txt_cthumb_img"], '../' . $path, 3000, 3000);
			if ($this->m_txt_cthumb_img != '') 
				$this->m_txt_cthumb_img = $this->convert_webp('../' . $path . $this->m_txt_cthumb_img);
        }
		if (isset($_FILES["txt_cthumb_img_mobile"])) {
            $path                   = './upload/banner/';
            $this->m_txt_cthumb_img_mobile = Fupload_resize_img($_FILES["txt_cthumb_img_mobile"], '../' . $path, 3000, 3000);
			if ($this->m_txt_cthumb_img_mobile != '') 
				$this->m_txt_cthumb_img_mobile = $this->convert_webp('../' . $path . $this->m_txt_cthumb_img_mobile);
        }
        if (isset($_POST['txt_cbanner_images'])) {
            $this->m_txt_cbanner_images = $_POST['txt_cbanner_images'];
            if ($this->m_event == 'add' || $this->m_event == 'update_add' || $this->m_event == 'add_trans' || $this->m_event == 'update_add_trans')
                $this->m_cbof_nid_lang = '1';
            $this->m_txt_ccode   = $_POST['txt_ccode'];
            $this->m_txt_cindex  = $_POST['txt_cindex'];
            $this->m_txt_cnote   = $_POST['txt_cnote'];
            //$this->m_txt_nstatus = $_POST['txt_nstatus'];
//			$this->cview = $_POST['cview'];
        }
        if (isset($_POST['txt_cbanner_images_trans'])) {
            $this->m_txt_cbanner_images = $_POST['txt_cbanner_images_trans'];
            $this->m_txt_nstatus        = $_POST['txt_nstatus'];
            if ($this->m_event == 'add_trans' || $this->m_event == 'update_add_trans')
                $this->m_cbof_nid_lang = $_POST['cbof_nid_lang'];
        }
        if (isset($_POST['hidden_nid']))
            $this->m_nid = $_POST['hidden_nid'];
        if (isset($_POST['hidden_image_old']))
            $this->m_hidden_image_old = $_POST['hidden_image_old'];
		if (isset($_POST['hidden_image_old_mobile']))
            $this->m_hidden_image_old_mobile = $_POST['hidden_image_old_mobile'];
        if (isset($_POST['hidden_event']))
            $this->m_event = $_POST['hidden_event'];
        if (isset($_POST['hidden_button']))
            $this->m_button_click = $_POST['hidden_button'];
        if (isset($_POST['hidden_nid_news_org']))
            $this->m_nid_news_org = $_POST['hidden_nid_news_org'];
		if (isset($_POST['cloc_banner']))
            $this->cloc_banner = $_POST['cloc_banner'];
    }
    private function caculate_data()
    {
        $id_org_news               = $this->f_get_cookie('nid_news_org');
        $this->m_link_cancel       = base_url() . 'index.php/do_banner_images_listview';
        $this->m_link_cancel_trans = base_url() . 'index.php/do_banner_images_listview/f_list_trans/' . $id_org_news;
        switch ($this->m_event) {
            case 'edit':
                $this->m_form_banner_images = $this->m_language_key('FormEditTitle');
                $this->m_link_page          = base_url() . 'index.php/do_banner_images/f_update_edit';
                $banner_images              = $this->banner_images_model->get_byid($this->m_nid);
                $this->m_txt_cnote          = $banner_images['cnote'];
                $this->m_txt_cthumb_img     = $banner_images['cimage'];
				$this->m_txt_cthumb_img_mobile     = $banner_images['cimage_mobile'];
                $this->m_txt_cbanner_images = $banner_images['cbanner_images'];
                $this->m_txt_nid            = $banner_images['nid'];
                $this->m_txt_ccode          = $banner_images['ccode'];
                $this->m_txt_ctag           = $banner_images['ctag'];
                $this->m_txt_cindex         = $banner_images['cindex'];
                $this->m_txt_nstatus        = $banner_images['nstatus'];
				$this->cview        = $banner_images['cview'];
				$this->cloc_banner 			= $banner_images['nid_loc_banner'];
                $this->m_event              = 'update_edit';
                break;
            case 'add':
                $this->m_form_banner_images = $this->m_language_key('FormAddTitle');
                $this->m_link_page          = base_url() . 'index.php/do_banner_images/f_update_add';
                $this->m_event              = 'update_add';
                break;
            case 'update_edit':
                $this->m_form_banner_images = $this->m_language_key('FormEditTitle');
                if ($this->m_button_click == 'btn_submit')
                    if ($this->update_data() == TRUE)
                        redirect('do_banner_images_listview');
                $this->m_link_page = base_url() . 'index.php/do_banner_images/f_update_edit';
                break;
            case 'update_add':
                if ($this->m_button_click == 'btn_submit')
                    if ($this->insert_data() == TRUE)
                        redirect('do_banner_images_listview');
                $this->m_form_banner_images = $this->m_language_key('FormAddbanner_images');
                $this->m_link_page          = base_url() . 'index.php/do_banner_images/f_update_add';
                break;
        }
        if ($this->m_nid_news_org == '')
            $this->m_nid_news_org = $this->f_get_cookie('nid_news_org');
		
		//$this->obj_loc_banner = get_all_loc_banner();
    }
    private function do_business()
    {
        $data['event']               = $this->m_event;
        //$data['menu']                = Fget_menu_html($this->m_nid_user_login);
        $data['link_page']           = $this->m_link_page;
        $data['link_cancel']         = $this->m_link_cancel;
        $data['link_cancel_trans']   = $this->m_link_cancel_trans;
        $data['btn_update']          = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']          = $this->lang->line('btn.0000.Cancel');
        $data['lbl_tag']             = $this->lang->line('lbl.0000.Tag');
        $data['fr_img']              = Fstr_replace('admin/', '', base_url());
        $data['get_icon_notnull']    = Fget_icon_notnull();
        $data['get_message_notnull'] = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
        ;
        $data['nid']               = $this->m_nid;
        $data['lbl_form_title']    = $this->m_form_banner_images;
        $data['lbl_nid']           = $this->m_language_key('nid');
        $data['lbl_code']          = $this->m_language_key('ccode');
        $data['lbl_banner_images'] = $this->m_language_key('banner_images');
        $data['lbl_lang']          = $this->m_language_key('lang');
        $data['lbl_index']         = $this->m_language_key('index');
        $data['lbl_note']          = $this->m_language_key('note');
        $data['lbl_status']        = $this->m_language_key('status');
        $data['lbl_first']         = $this->m_language_key('first');
        $data['no_edit_lang']      = $this->m_language_key('no_edit_lang');
        if ($this->m_txt_cthumb_img != '')
            $data['txt_cthumb_img'] = $this->m_txt_cthumb_img;
        else
            $data['txt_cthumb_img'] = $this->m_hidden_image_old;
		if ($this->m_txt_cthumb_img_mobile != '')
            $data['txt_cthumb_img_mobile'] = $this->m_txt_cthumb_img_mobile;
        else
            $data['txt_cthumb_img_mobile'] = $this->m_hidden_image_old_mobile;
        $data['hidden_nid_news_org'] = $this->m_nid_news_org;
        $data['txt_cbanner_images']  = $this->m_txt_cbanner_images;
        $data['txt_cnote']           = $this->m_txt_cnote;
        $data['txt_ccode']           = $this->m_txt_ccode;
        $data['txt_ctag']            = $this->m_txt_ctag;
        $data['txt_nid']             = $this->m_txt_nid;
        $data['txt_nstatus']         = $this->m_txt_nstatus;
        $data['txt_cindex']          = $this->m_txt_cindex;
		$data['cview']          = $this->cview;
        $data['gen_cbo_status']      = Fget_combobox_yes_no('ko', 'txt_nstatus', $this->m_txt_nstatus, 'width:308px', $this->lang->line('lbl.0000.Yes'), $this->lang->line('lbl.0000.No'));
		//$data['gencbo_loc_banner_list']   = Fgen_html_combobox('no', 'cloc_banner', $this->cloc_banner, 'width:308px', $this->obj_loc_banner, 'nid', 'cname', 'nosubmit', '');
        $data['menu_active']         = 'banner_image';
        if ($this->m_arr_new > 0) {
            $data['lang'] = $this->m_lang;
            $data['data'] = $this->m_arr_new;
        }
        $data['m_message'] = $this->m_error_msg;
        $this->load->view('banner_images_view/index.php', $data);
    }
    private function destroy_data()
    {
    }
    private function check_valid_not_null()
    {
        if ($this->m_event == 'add' OR $this->m_event == 'update_add')
            if (trim($this->m_txt_ccode) == '') {
                $this->m_error_msg = $this->m_language_key('code') . $this->lang->line('msg.0000.ErorNotNull');
                return FALSE;
            }
       // if (trim($this->m_txt_cbanner_images) == '') {
       //     $this->m_error_msg = $this->m_language_key('banner_images') . $this->lang->line('msg.0000.ErorNotNull');
       //     return FALSE;
      //  }
        return TRUE;
    }
    private function check_valid_before_insert()
    {
        if ($this->check_valid_not_null() == FALSE)
            return FALSE;
     //   if (fbcheck_exists_key_addnew('tbanner_images', 'ccode', $this->m_txt_ccode) == FALSE) {
    //        $this->m_error_msg = $this->lang->line('lbl.banner_images.code') . $this->lang->line('msg.0000.ErorDoubleKey');
     //       return FALSE;
      //  }
     //   if (fbcheck_exists_key_addnew('tbanner_images', 'cbanner_images', $this->m_txt_cbanner_images) == FALSE) {
       //     $this->m_error_msg = $this->lang->line('lbl.banner_images.banner_images') . $this->lang->line('msg.0000.ErorDoubleKey');
      //      return FALSE;
      //  }
        return TRUE;
    }
    private function insert_data()
    {
        if ($this->m_txt_cthumb_img == '')
            $this->m_txt_cthumb_img = $this->m_hidden_image_old;
		if ($this->m_txt_cthumb_img_mobile == '')
            $this->m_txt_cthumb_img_mobile = $this->m_hidden_image_old_mobile;
        if ($this->check_valid_before_insert()) {
            $data = array(
                'cbanner_images' => $this->m_txt_cbanner_images,
                'cnote' => $this->m_txt_cnote,
                'cimage' => $this->m_txt_cthumb_img,
				'cimage_mobile' => $this->m_txt_cthumb_img_mobile,
                'ccode' => $this->m_txt_ccode,
                'ctag' => $this->m_txt_ctag,
                'cindex' => $this->m_txt_cindex,
                'nid' => $this->m_txt_nid,
                'nstatus' => 1,
				//'cview' => $this->cview,
                'niduser01' => $this->m_nid_user_login,
				'nid_loc_banner' => $this->cloc_banner,
                'ddate01' => dbget_current_date()
            );
            $this->banner_images_model->insert($data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private function check_valid_before_update()
    {
        if ($this->check_valid_not_null() == FALSE)
            return FALSE;
       // if (fbcheck_exists_key_update('tbanner_images', 'cbanner_images', $this->m_txt_cbanner_images, $this->m_nid) == FALSE) {
       //     $this->m_error_msg = $this->m_language_key('banner_images') . $this->lang->line('msg.0000.ErorDoubleKey');
       //     return FALSE;
      //  }
      //  if (fbcheck_exists_key_update('tbanner_images', 'ccode', $this->m_txt_ccode, $this->m_nid) == FALSE) {
       //     $this->m_error_msg = $this->m_language_key('ccode') . $this->lang->line('msg.0000.ErorDoubleKey');
       //     return FALSE;
       // }
        return TRUE;
    }
    private function update_data()
    {
        if ($this->check_valid_before_update()) {
            if ($this->m_txt_cthumb_img != '' && $this->m_hidden_image_old != '') {
                $path = '.././upload/banner/';
				if(file_exists($path . $this->m_hidden_image_old))
					unlink($path . $this->m_hidden_image_old);
            }
            if ($this->m_txt_cthumb_img == '')
                $this->m_txt_cthumb_img = $this->m_hidden_image_old;
			
			if ($this->m_txt_cthumb_img_mobile != '' && $this->m_hidden_image_old_mobile != '') {
                $path = '.././upload/banner/';
				if(file_exists($path . $this->m_hidden_image_old_mobile))
					unlink($path . $this->m_hidden_image_old_mobile);
            }
            if ($this->m_txt_cthumb_img_mobile == '')
                $this->m_txt_cthumb_img_mobile = $this->m_hidden_image_old_mobile;
            $data = array(
                'cbanner_images' => $this->m_txt_cbanner_images,
                'cindex' => $this->m_txt_cindex,
                'ccode' => $this->m_txt_ccode,
                'ctag' => $this->m_txt_ctag,
                'cimage' => $this->m_txt_cthumb_img,
				'cimage_mobile' => $this->m_txt_cthumb_img_mobile,
                //'nstatus' => $this->m_txt_nstatus,
                'cnote' => $this->m_txt_cnote,
				//'cview' => $this->cview,
                'niduser02' => $this->m_nid_user_login,
				'nid_loc_banner' => $this->cloc_banner,
                'ddate02' => dbget_current_date()
            );
            $this->banner_images_model->update_bynid($this->m_nid, $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private function update_index($nid, $index)
    {
        $data = array(
            'cindex' => $index
        );
        $this->banner_images_model->update_bynid($nid, $data);
    }
    private function update_code($nid, $code)
    {
        $data = array(
            'ccode' => $code
        );
        $this->banner_images_model->update_bynid($nid, $data);
    }
}


