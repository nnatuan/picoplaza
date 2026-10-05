<?php 
class change_pass extends CI_Controller {

var $event 				= '';
var	$obj_about			='';
var $m_language			='eng';

var $nid		= '';
var $nid_cat			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 
var $view_folder = '';
var $msg ='';
var $btn_submit ='';
function __construct()
    {
        parent::__construct();
		session_start();
		
		$this->load->database();	
		$this->load->helper('ap_function');
		$this->load->helper('ap_object');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view_helper');
		$this->load->helper('ap_db');
		$this->load->helper('ap_module');		

	}



function index()
{
	$this->do_process();
}
	
function do_process() 
{
	$this->get_data(); 		
	$this->caculate_data(); 		
	$this->do_business(); 		
	$this->destroy_data();
}
function detail($nid)	
{
	$this->nid = $nid;
	$this->do_process();

}
private function get_data()
{  
	if(isset($_POST['btn_submit']))
		$this->btn_submit = $_POST['btn_submit'];
}
	
private function caculate_data()
{
	if (!isset($_SESSION['nid_member'])) {
		redirect(base_url().'login');
	}
	
	if($this->btn_submit != '')
	{	
		$this->msg = '<span style="color:green;">Cập nhật mật khẩu thành công!</span>';
		if(isset($_POST['cpassword']) && $_POST["cpassword"]!="" && $_POST["cpassword_old"]!="") {
			if(get_member_password($_SESSION['nid_member']) != md5($_POST["cpassword_old"])) {
				$this->msg = "Mật khẩu cũ không đúng!";
				//return;
			} elseif(strlen($_POST["cpassword"])>5) {
				if ($_POST["cpassword"] === $_POST["confirm_password"]) {
					$this->db->set('cpassword',md5($_POST["cpassword"]));
					$this->db->where('nid',$_SESSION['nid_member']);
					$this->db->update('tmember');
				} else {
					$this->msg = "Mật khẩu xác nhận không khớp!";
					//return;
				}
			} else {
				$this->msg = "Mật khẩu chứa ít nhất 6 ký tự!";
				//return;
			}
		} else {
			$this->msg = "Vui lòng nhập đủ thông tin.";
			//return;
		}
	}
		
		$this -> load -> library('Mobile_Detect');
    	$detect = new Mobile_Detect();
    	if ($detect->isMobile() || $detect->isTablet() || $detect->isAndroidOS()) {
        	$this->view_folder ='mobile';
    	}else
    		$this->view_folder ='desktop';
}
	
private function do_business()
{	
	$data['title']        = "Đổi mật khẩu";
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	$data['nid']			= $this->nid;
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= 'change_pass';
	$data['msg']  = $this->msg;

	$data['view_folder']    = $this->view_folder;
	$this->load->view($this->view_folder.'/change_pass',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_guide_string()
{
		

		return $str ;
}

}