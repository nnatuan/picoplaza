<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class do_product_img extends CI_Controller
{
    var $m_language = '';
    var $m_nid_user_login = '';
    var $m_nid = '';
    var $m_event = '';
    var $m_button_click = '';
    var $m_hidden_button = '';
    var $m_link_page = '';
    var $m_link_cancel = '';
    var $m_form_product_gallery = 'Product Images Gallery';
    var $m_hidden_image_old = '';
    var $m_txt_cthumb_img = '';
    var $m_cproduct_gallery = '';
    var $m_txt_nid = '';
    var $m_nid_product = '';
    var $m_error_msg = '';
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
    }
    function get_id($nid)
    {
        $this->m_nid_product = $nid;
        $this->m_event       = 'list';
        $this->do_process();
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.product_gallery.' . $str_key);
    }
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_product_gallery_listview_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_product_gallery_listview_' . $cookie_name);
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
    function index()
    {
        $this->m_event = 'add';
        $this->do_process();
    }
    function get_gallery($nid_product)
    {
        $this->m_event       = 'add';
        $this->m_nid_product = $nid_product;
        $this->f_set_cookie('m_nid_product', $this->m_nid_product);
        $this->do_process();
    }
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }
    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->load->language('ap', 'eng');
        if (isset($_POST['hidden_nid']))
            $this->m_nid = $_POST['hidden_nid'];
        if (isset($_POST['hidden_event']))
            $this->m_event = $_POST['hidden_event'];
        if (isset($_POST['hidden_button_click']))
            $this->m_button_click = $_POST['hidden_button_click'];
        if (isset($_POST['hidden_button']))
            $this->m_hidden_button = $_POST['hidden_button'];
    }
    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_product_img_listview';
        if ($this->m_hidden_button == 'btn_delete') {
            $this->delete();
        }
        switch ($this->m_event) {
            case 'edit':
                $this->m_form_product_gallery = $this->m_language_key('FormEditTitle');
                $this->m_link_page            = base_url() . 'index.php/do_product_img/f_update_edit';
                $this->m_event                = 'update_edit';
                break;
            case 'list':
                $this->m_form_product_gallery = $this->m_language_key('FormEditTitle');
                $this->m_link_page            = base_url() . 'index.php/do_product_img/f_update_edit';
                $this->m_event                = 'update_list';
                break;
            case 'add':
                $this->m_form_product_gallery = $this->m_language_key('FormAddTitle');
                $this->m_link_page            = base_url() . 'index.php/do_product_img/f_update_add';
                $this->m_event                = 'update_add';
                break;
            case 'update_edit':
                $this->m_form_product_gallery = $this->m_language_key('FormEditTitle');
                if ($this->m_button_click == 'btn_submit')
                    if ($this->update_data() == TRUE)
                        redirect(base_url() . 'index.php/do_product_img/get_gallery/' . $this->m_nid_product);
                $this->m_link_page = base_url() . 'index.php/do_product_img/f_update_edit';
                break;
            case 'update_add':
                if ($this->m_button_click == 'btn_submit')
                    if ($this->insert_data() == TRUE) {
                        $new_id = dbget_identity();
                        redirect(base_url() . 'index.php/do_product_img/f_edit/' . $new_id);
                    }
                $this->m_link_page = base_url() . 'index.php/do_product_img/f_update_add';
                break;
        }
    }
    private function do_business()
    {
        $data['event']                     = $this->m_event;
        $data['msg_invalid_before_delete'] = $this->lang->line('msg.0000.InvalidBeforeDelete');
        $data['msg_confirm_before_delete'] = $this->lang->line('msg.0000.ConfirmBeforeDelete');
        $data['link_page']                 = $this->m_link_page;
        $data['link_cancel']               = $this->m_link_cancel;
        $data['lbl_form_title']            = 'Product images';
        $data['btn_delete']                = $this->lang->line('btn.0000.Delete');
        $data['btn_update']                = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']                = $this->lang->line('btn.0000.Cancel');
        $data['lbl_tag']                   = $this->lang->line('lbl.0000.Tag');
        $data['fr_img']                    = Fstr_replace('admin/', '', base_url());
        $data['get_icon_notnull']          = Fget_icon_notnull();
        $data['get_message_notnull']       = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');
        $data['nid']                       = $this->m_nid;
        $data['nid_product']               = $this->m_nid_product;
        $data['m_error_msg']               = $this->m_error_msg;
        $data['menu_active']               = 'product_gallery';
        $this->load->view('product_gallery_view/index', $data);
    }
    private function destroy_data()
    {
    }
    private function check_valid_not_null()
    {
        if ($this->m_txt_cthumb_img == '') {
            $this->m_error_msg = 'Please choose a image!';
            return FALSE;
        }
        return TRUE;
    }
    private function check_valid_before_insert()
    {
        if ($this->check_valid_not_null() == FALSE)
            return FALSE;
        return TRUE;
    }
    private function insert_data()
    {
        if ($this->check_valid_before_insert()) {
            $data = array(
                'cimage_full' => $this->m_txt_cthumb_img,
                'nid_product' => $this->m_nid_product,
                'cgallery_detail' => $this->m_cproduct_gallery,
                'niduser01' => $this->m_nid_user_login,
                'niduser02' => $this->m_nid_user_login,
                'ddate02' => dbget_current_date(),
                'ddate01' => dbget_current_date()
            );
            $this->db->insert(Fget_ap_table('tgallery_detail'), $data);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    private function check_valid_before_update()
    {
        return TRUE;
    }
	/*
    function insert_img($nid_product)
    {
            $targetFolder = './../upload/images_product/sub_images/';
       		
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
              $data = array(
                'nid_product' => $nid_product,
                'cimage' => $file_name,
                'ddate01' => dbget_current_date()
            );
            $this->db->insert(Fget_ap_table('tproduct_images'), $data);
            
            $fileParts  = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
                $output = array("success" => true, "message" => "Success!");
                
            } else {
                $output = array("success" => false, "error" => "Failure!");
                //echo 'Invalid file type.';
            }
            header("Content-Type: application/json; charset=utf-8");
            echo json_encode($output);
    }
	*/
	private function convert_webp($path)
    {
		$webp_img = webpConvert2($path);
		delfile($path);
		return(basename($webp_img));
	}
	function insert_img($nid_product)
    {
            $targetFolder = './../upload/images_product/sub_images/';
            
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

            $fileParts  = pathinfo($_FILES['Filedata']['name']);
            if (in_array($fileParts['extension'], $fileTypes)) {
                move_uploaded_file($tempFile, $targetFile);
				
				//chuyen sang webp
				$file_name = $this->convert_webp($targetFile);
				//chuyen sang webp

				$data = array(
					'nid_product' => $nid_product,
					'cimage' => $file_name,
					'ddate01' => dbget_current_date()
				);
				$this->db->insert(Fget_ap_table('tproduct_images'), $data);
			
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
    	$targetFolder = './../upload/images_product/sub_images/';
    	$this->db->where("nid",$id);
    	$obj_img =  $this->db->get("tproduct_images");
    	$obj_img = $obj_img->row_array();
    	if(isset($obj_img['nid'])){
    		@unlink($targetFolder.$obj_img['cimage']);
    		$this->db->where("nid",$id);
    		$this->db->delete("tproduct_images");
    	}
    	exit('ok');
    }
}