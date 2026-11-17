<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class do_news extends CI_Controller
{
    var $m_language = '';
    var $m_nid_user_login = '';
    var $m_nid = '';
    var $m_event = '';
    var $m_button_click = '';
    var $m_link_page = '';
    var $m_link_cancel = '';
    var $m_form_title = '';
    var $m_hidden_height_old = '';
    var $m_hidden_image_old = '';
    var $m_hidden_image_old_fb = '';
    var $m_hidden_image_old_iphone = '';
    var $m_txt_nid = '';
    var $m_txt_ccode = '';
    var $m_txt_ctitle = '';
    var $m_txt_cauthor = '';
    var $m_txt_ctag = '';
    var $m_txt_cindex = '';
    var $m_txt_cheight_img = '';
    var $m_txt_cthumb_img = '';
    var $m_txt_cfb_img = '';
    var $m_txt_ciphone_img = '';
    var $m_cbof_nid_cat_news = '';
    var $m_cbof_nid_section_news = '';
    var $m_txt_cshort_content = '';
    var $m_txt_ccontent = '';
    var $m_arr_new = '';
    var $m_chk_alwcmt = '';
    var $m_obj_section_news_view = '';
    var $m_obj_cat_news_view = '';
    var $m_error_ccontent = '';
    var $m_error_ctitle = '';
    var $m_error_cshort_content = '';
	var $m_error_msg		= '';
	var $m_txt_cnote = '';
	var $cdate = '';
	var $obj_check_type = [];
	var $cproduct_str_id = '';
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
        $this->config->check_system_login = '1';
        $this->load->model('news_model');
        $this->load->model('cat_news_model');
		
		if (!check_staff_permission(array('admin', 'content_mgr'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.news.' . $str_key);
    }
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_news_listview_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_news_listview_' . $cookie_name);
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
            $path                   = './upload/image_article/';
            $this->m_txt_cthumb_img = Fupload_resize_img($_FILES["txt_cthumb_img"], '../' . $path, 2000, 2000);
			//$file = $_FILES['txt_cthumb_img']['name'];
			//$ext = pathinfo($file, PATHINFO_EXTENSION);
			//exit($file.$ext);
			//if ($this->m_txt_cthumb_img != '' && pathinfo($_FILES['txt_cthumb_img']['name'], PATHINFO_EXTENSION) != "webp") 
			//	$this->m_txt_cthumb_img = $this->convert_webp('../' . $path . $this->m_txt_cthumb_img);
        }
        if (isset($_FILES["txt_cheight_img"])) {
            $path                    = './upload/image_height_article/';
            $this->m_txt_cheight_img = Fupload_resize_img($_FILES["txt_cheight_img"], '../' . $path, 180, 235);
        }
        if (isset($_FILES["txt_cfb_img"])) {
            $path                = './upload/image_article/';
            $this->m_txt_cfb_img = Fupload_resize_img($_FILES["txt_cfb_img"], '../' . $path, 600, 315);
        }
        if (isset($_FILES["txt_ciphone_img"])) {
            $path                    = './upload/ios/';
            $this->m_txt_ciphone_img = Fupload_resize_img($_FILES["txt_ciphone_img"], '../' . $path, 80, 80);
        }
        if (isset($_POST['cbof_nid_cat_news']))
            $this->m_cbof_nid_cat_news = $_POST['cbof_nid_cat_news'];
        if (isset($_POST['txt_ctitle'])) {
            $this->m_txt_ccode   = $_POST['txt_ccode'];
            $this->m_txt_ctitle  = $_POST['txt_ctitle'];
//            $this->m_txt_cauthor = $_POST['txt_cauthor'];
            //$this->m_txt_ctag    = $_POST['txt_ctag'];
            $this->m_txt_cindex  = $_POST['txt_cindex'];
//			$this->m_txt_cnote        = trim($_POST['txt_cnote']);
            if (!empty($_POST['chk_alwcmt']))
                $this->m_chk_alwcmt = 1;
            else
                $this->m_chk_alwcmt = 0;
            $this->m_txt_cshort_content = $_POST['txt_cshort_content'];
            $this->m_txt_ccontent       = $_POST['txt_ccontent'];
			//$this->cdate       = $_POST['cdate'];
			//$this->cproduct_str_id       = $_POST['cproduct_str_id'];
        }
        if (isset($_POST['hidden_nid']))
            $this->m_nid = $_POST['hidden_nid'];
        if (isset($_POST['hidden_event']))
            $this->m_event = $_POST['hidden_event'];
        if (isset($_POST['hidden_button']))
            $this->m_button_click = $_POST['hidden_button'];
        if (isset($_POST['hidden_height_old']))
            $this->m_hidden_height_old = $_POST['hidden_height_old'];
        if (isset($_POST['hidden_image_old']))
            $this->m_hidden_image_old = $_POST['hidden_image_old'];
        if (isset($_POST['hidden_image_old_fb']))
            $this->m_hidden_image_old_fb = $_POST['hidden_image_old_fb'];
        if (isset($_POST['hidden_image_old_iphone']))
            $this->m_hidden_image_old_iphone = $_POST['hidden_image_old_iphone'];
    }
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_news_listview';
        switch ($this->m_event) {
            case 'edit':
                $this->m_form_title            = $this->m_language_key('FormEditTitle');
                $this->m_link_page             = base_url() . 'index.php/do_news/f_update_edit';
                $this->m_arr_new               = $this->news_model->get_new_byid($this->m_nid);
                $news                          = $this->news_model->get_byid($this->m_nid);
                //$this->m_txt_cheight_img       = $news['cimage_height'];
                $this->m_txt_cthumb_img        = $news['cimage_thumb'];
                $this->m_txt_cfb_img           = $news['cimage_fb'];
                //$this->m_txt_ciphone_img       = $news['cimage_iphone'];
                $this->m_txt_ccode             = $news['ccode'];
                $this->m_txt_ctitle            = $news['ctitle'];
                //$this->m_txt_cauthor           = $news['cauthor'];
                $this->m_txt_ctag              = $news['ctag'];
                $this->m_txt_cindex            = $news['cindex'];
				$this->m_txt_cnote             = $news['cnote'];
                $this->m_cbof_nid_cat_news     = $news['nid_cat_news'];
                $this->m_cbof_nid_section_news = $news['nid_section_news'];
                //$this->m_chk_alwcmt            = $news['alwcmt'];
                $this->m_txt_cshort_content    = $news['cshort_content'];
                $this->m_txt_ccontent          = $news['ccontent'];
				//$this->cdate          = $news['cdate'];
				//$this->cproduct_str_id          = $news['cproduct_str_id'];
				//$this->obj_check_type              = get_check_subsite($this->m_nid);
                $this->m_event                 = 'update_edit';
                break;
            case 'add':
                $this->m_form_title = $this->m_language_key('FormAddTitle');
                $this->m_link_page  = base_url() . 'index.php/do_news/f_update_add';
                $this->m_event      = 'update_add';
                break;
            case 'update_edit':
                $this->m_form_title = $this->m_language_key('FormEditTitle');
                if ($this->m_button_click == 'btn_submit')
                    if ($this->update_data() == TRUE)
                        redirect('do_news_listview');
                $this->m_form_title = $this->m_language_key('FormEditTitle');
                $this->m_link_page  = base_url() . 'index.php/do_news/f_update_edit';
                break;
            case 'update_add':
                $this->m_form_title = $this->m_language_key('FormAddTitle');
                if ($this->m_button_click == 'btn_submit')
                    if ($this->insert_data() == TRUE)
                        redirect('do_news_listview');
                break;
            default: {
            }
        }
        $this->m_obj_section_news_view = Obj_get_section_news();
        $this->m_obj_cat_news_view     = Obj_get_cat_news_by_nidsec_notnull();
    }
    private function do_business()
    {
        $data['event']               = $this->m_event;
        //$data['menu']                = Fget_menu_html($this->m_nid_user_login);
        $data['lbl_form_title']      = $this->m_form_title;
        $data['link_page']           = $this->m_link_page;
        $data['link_cancel']         = $this->m_link_cancel;
        $data['btn_update']          = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']          = $this->lang->line('btn.0000.Cancel');
        $data['lbl_tag']             = $this->lang->line('lbl.0000.Tag');
        $data['fr_img']              = Fstr_replace('admin/', '', base_url());
        $data['get_icon_notnull']    = Fget_icon_notnull();
        $data['get_message_notnull'] = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
        ;
        $data['nid']                      = $this->m_nid;
        $data['lbl_form_title']           = $this->m_form_title;
        $data['lbl_nid']                  = $this->m_language_key('nid');
        $data['lbl_image_height']         = $this->m_language_key('image_height');
        $data['lbl_image']                = $this->m_language_key('image');
        $data['lbl_image_fb']             = $this->m_language_key('image_fb');
        $data['lbl_image_iphone']         = $this->m_language_key('image_iphone');
        $data['lbl_code']                 = $this->m_language_key('code');
        $data['lbl_title']                = $this->m_language_key('title');
        $data['lbl_author']               = $this->m_language_key('author');
        $data['lbl_cat']                  = $this->m_language_key('cat');
        $data['lbl_index']                = $this->m_language_key('index');
        $data['lbl_section_news']         = $this->m_language_key('section_news');
        $data['lbl_short_content']        = $this->m_language_key('shortcontent');
        $data['lbl_content']              = $this->m_language_key('content');
        $data['lbl_status']               = $this->m_language_key('status');
        $data['lbl_lang']                 = $this->m_language_key('lang');
        $data['lbl_first']                = $this->m_language_key('first');
        $data['lbl_alwcmt']               = $this->m_language_key('alwcmt');
        $data['gencbo_section_news_list'] = Fgen_html_combobox('no', 'cbof_nid_section_news', $this->m_cbof_nid_section_news, 'width:350px;', $this->m_obj_section_news_view, 'nid', 'csection_news', 'submit', '');
        $data['gencbo_cat_news_list']     = Fgen_html_combobox('no', 'cbof_nid_cat_news', $this->m_cbof_nid_cat_news, '', $this->m_obj_cat_news_view, 'nid', 'ccat_news', 'nosubmit', '');
        $data['txt_ccode']                = $this->m_txt_ccode;
        $data['txt_ctitle']               = $this->m_txt_ctitle;
        //$data['txt_cauthor']              = $this->m_txt_cauthor;
        $data['txt_ctag']                 = $this->m_txt_ctag;
        $data['txt_cindex']               = $this->m_txt_cindex;
		$data['txt_cnote']                   = $this->m_txt_cnote;
		$data['cdate']                   = $this->cdate;
		$data['cproduct_str_id']                   = $this->cproduct_str_id;
        $data['hidden_height_old']        = $this->m_hidden_height_old;
        $data['hidden_image_old']         = $this->m_hidden_image_old;
        $data['hidden_image_old_fb']      = $this->m_hidden_image_old_fb;
        $data['hidden_image_old_iphone']  = $this->m_hidden_image_old_iphone;
        if ($this->m_txt_cheight_img != '')
            $data['txt_cheight_img'] = $this->m_txt_cheight_img;
        else
            $data['txt_cheight_img'] = $this->m_hidden_height_old;
        if ($this->m_txt_cthumb_img != '')
            $data['txt_cthumb_img'] = $this->m_txt_cthumb_img;
        else
            $data['txt_cthumb_img'] = $this->m_hidden_image_old;
        if ($this->m_txt_cfb_img != '')
            $data['txt_cfb_img'] = $this->m_txt_cfb_img;
        else
            $data['txt_cfb_img'] = $this->m_hidden_image_old_fb;
        if ($this->m_txt_ciphone_img != '')
            $data['txt_ciphone_img'] = $this->m_txt_ciphone_img;
        else
            $data['txt_ciphone_img'] = $this->m_hidden_image_old_iphone;
        $data['chk_alwcmt']           = $this->m_chk_alwcmt;
        $data['txt_cshort_content']   = $this->m_txt_cshort_content;
        $data['txt_ccontent']         = $this->m_txt_ccontent;
        $data['error_ctitle']         = $this->m_error_ctitle;
        $data['error_ccontent']       = $this->m_error_ccontent;
        $data['error_cshort_content'] = $this->m_error_cshort_content;
		$data['m_message']		= $this->m_error_msg;
        $data['menu_active']          = 'news';
		$data['obj_check_type']            = $this->obj_check_type;
		//exit(count($this->obj_check_type).'-'.$this->m_nid);
        $this->load->view('news_view/index.php', $data);
    }
    private function destroy_data()
    {
    }
    private function check_valid_not_null()
    {
        if ($this->m_txt_ccode == '') {
            $this->m_error_msg = $this->m_language_key('code') . $this->lang->line('msg.0000.ErorNotNull');
            return FALSE;
        }
        if ($this->m_txt_ctitle == '') {
            $this->m_error_msg = $this->m_language_key('title') . $this->lang->line('msg.0000.ErorNotNull');
            return FALSE;
        }
        if ($this->m_txt_ccontent == '') {
            $this->m_error_msg = $this->m_language_key('content') . $this->lang->line('msg.0000.ErorNotNull');
            return FALSE;
        }
        return TRUE;
    }
    private function check_valid_before_insert()
    {
        if ($this->check_valid_not_null() == FALSE)
            return FALSE;
        if (fbcheck_exists_key_addnew('tnews', 'ccode', $this->m_txt_ctitle) == FALSE) {
            $this->m_error_msg = $this->m_language_key('code') . $this->lang->line('msg.0000.ErorDoubleKey');
            return FALSE;
        }
        if (fbcheck_exists_key_addnew('tnews', 'ctitle', $this->m_txt_ctitle) == FALSE) {
            $this->m_error_msg = $this->m_language_key('title') . $this->lang->line('msg.0000.ErorDoubleKey');
            return FALSE;
        }
        return TRUE;
    }
    private function insert_data()
    {
        if ($this->check_valid_before_insert() == TRUE) {
            $data = array(
                'ccode' => $this->m_txt_ccode,
                'ctitle' => $this->m_txt_ctitle,
                //'cauthor' => $this->m_txt_cauthor,
                'ctag' => $this->m_txt_ctag,
                'cindex' => $this->m_txt_cindex,
				'cnote' => $this->m_txt_cnote,
				//'cdate' => $this->cdate,
				//'cproduct_str_id' => $this->cproduct_str_id,
                'nstatus' => 1,
				'chome' => '0',
                //'nactive' => 0,
                //'nimg' => 0,
                //'cimage_height' => $this->m_txt_cheight_img,
                'cimage_thumb' => $this->m_txt_cthumb_img,
                'cimage_fb' => $this->m_txt_cfb_img,
                //'cimage_iphone' => $this->m_txt_ciphone_img,
                'cshort_content' => $this->m_txt_cshort_content,
                'ccontent' => $this->m_txt_ccontent,
                'nid_section_news' => 6,
                'nid_cat_news' => $this->m_cbof_nid_cat_news,
                //'alwcmt' => $this->m_chk_alwcmt,
                'niduser01' => $this->m_nid_user_login,
                'niduser02' => $this->m_nid_user_login,
                'ddate01' => dbget_current_date(),
                'ddate02' => dbget_current_date()
            );
            $this->news_model->insert($data);
			$nid_news = dbget_identity();
			$this->insert_site($nid_news);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private function check_valid_before_update()
    {
        if ($this->check_valid_not_null() == FALSE)
            return FALSE;
        if (fbcheck_exists_key_update('tnews', 'ccode', $this->m_txt_ccode, $this->m_nid) == FALSE) {
            $this->m_error_msg = $this->m_language_key('code') . $this->lang->line('msg.0000.ErorDoubleKey');
            return FALSE;
        }
        if (fbcheck_exists_key_update('tnews', 'ctitle', $this->m_txt_ctitle, $this->m_nid) == FALSE) {
            $this->m_error_msg = $this->m_language_key('title') . $this->lang->line('msg.0000.ErorDoubleKey');
            return FALSE;
        }
        return TRUE;
    }
    private function update_data()
    {
        if ($this->check_valid_before_update()) {
            $data = array(
                'ccode' => $this->m_txt_ccode,
                'ctitle' => $this->m_txt_ctitle,
                //'cauthor' => $this->m_txt_cauthor,
				'cnote' => $this->m_txt_cnote,
				//'cdate' => $this->cdate,
				//'cproduct_str_id' => $this->cproduct_str_id,
                'ctag' => $this->m_txt_ctag,
                'cindex' => $this->m_txt_cindex,
                'cshort_content' => $this->m_txt_cshort_content,
                'nid_cat_news' => $this->m_cbof_nid_cat_news,
                'ccontent' => $this->m_txt_ccontent,
                //'ctime' => time(),
                //'alwcmt' => $this->m_chk_alwcmt,
                'niduser02' => $this->m_nid_user_login,
                'ddate02' => dbget_current_date()
            );
            
            if ($this->m_txt_cthumb_img != '') {
                $path = '.././upload/image_article/';
                if(file_exists($path . $this->m_hidden_image_old))
					delfile($path . $this->m_hidden_image_old);
                $data['cimage_thumb'] = $this->m_txt_cthumb_img;
            }
			/*
			if ($this->m_txt_cheight_img != '') {
                $path = '.././upload/image_height_article/';
                delfile($path . $this->m_hidden_height_old);
                $data['cimage_height'] = $this->m_txt_cheight_img;
            }
            if ($this->m_txt_cfb_img != '') {
                $path = '.././upload/image_article/';
                delfile($path . $this->m_hidden_image_old_fb);
                $data['cimage_fb'] = $this->m_txt_cfb_img;
            }
            if ($this->m_txt_ciphone_img != '') {
                $path = '.././upload/ios/';
                delfile($path . $this->m_hidden_image_old_iphone);
                $data['cimage_iphone'] = $this->m_txt_ciphone_img;
            }
			*/
            $this->news_model->update_bynid($this->m_nid, $data);
			//$this->update_site();
            return TRUE;
        } else {
            return FALSE;
        }
    }
    function delete_image_iphone($nid)
    {
        $obj_data = $this->news_model->get_byid($nid);
        $path     = '.././upload/ios/';
        if (file_exists($path . $obj_data['cimage_iphone']))
            unlink($path . $obj_data['cimage_iphone']);
        $data['cimage_iphone'] = '';
        $this->news_model->update_bynid($nid, $data);
        gen_xml_category($nid);
        gen_xml_article($nid);
        echo 'Deleted images!!';
    }
    function delete_image_thumb($nid)
    {
        $obj_data = $this->news_model->get_byid($nid);
        $path     = '.././upload/image_article/';
        if (file_exists($path . $obj_data['cimage_thumb']))
            unlink($path . $obj_data['cimage_thumb']);
        $data['cimage_thumb'] = '';
        $this->news_model->update_bynid($nid, $data);
        echo 'Deleted images!!';
    }
    function delete_height_thumb($nid)
    {
        $obj_data = $this->news_model->get_byid($nid);
        $path     = '.././upload/image_height_article/';
       // if (file_exists($path . $obj_data['cimage_height']))
       //     unlink($path . $obj_data['cimage_height']);
       // $data['cimage_height'] = '';
        $this->news_model->update_bynid($nid, $data);
        echo 'Deleted images!!';
    }
    function delete_image_fb($nid)
    {
        $obj_data = $this->news_model->get_byid($nid);
        $path     = '.././upload/fbthumb/';
        if (file_exists($path . $obj_data['cimage_fb']))
            unlink($path . $obj_data['cimage_fb']);
        $data['cimage_fb'] = '';
        $this->news_model->update_bynid($nid, $data);
        echo 'Deleted images!!';
    }
	function insert_site($nid_news)
    {
        foreach ($_POST['chk_type'] as $nid) {
            //$tmp  = explode(',', $nid);
            $data = array(
                "nid_news" => $nid_news,
                "nid_subsite" => $nid
            );
            $this->db->insert("tnews_subsite", $data);
        }
    }
	function update_site()
    {
        $this->db->where("nid_news", $this->m_nid);
        $this->db->delete("tnews_subsite");
        $data = '';
        foreach ($_POST['chk_type'] as $nid) {
            //$tmp  = explode(',', $nid);
            $data = array(
                "nid_news" => $this->m_nid,
                "nid_subsite" => $nid
            );
            $this->db->insert("tnews_subsite", $data);
        }
    }
}
