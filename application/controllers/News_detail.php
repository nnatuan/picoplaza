<?php 
class news_detail extends CI_Controller {

var $event 				= '';
var	$obj_news			= '';
var	$obj_all_news		= '';
var $m_nid				= '';
var $m_language			= 'vni';
var $m_nid_sec			= '';
var $m_ccode_cat		= '';
var $m_ccode_sec		= '';
var $m_ccode			= '';
var $cat_news			= '';
var $sec_news			= '';
var $ckey_word			= '';
var $ctitle				= '';
/* Paging*/
var $ctr_name			= '';
var	$ncurrent_page		= 1;
var	$nrow_per_page		= 10;
var $ntotal_row			= 0;


/* Paging*/
var $nid_section		= '';
var $nid_cat			= '';
var $img_cpt			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 

var $txt_name			= '';
var	$txt_title			= '';
var $txt_content		= '';

var $tag_detail			= '';
var $title_detail		= '';
var $short_detail		= '';
var $view_folder = '';
var $xem_truoc = 0;

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

// Dinh nghia ham rut gon khi set language cho cac label.
// 
private function m_language_key($str_key)
{
	return $this->lang->line('lbl.news.'.$str_key);
}

function detail($ccode)
{
	
	//update hit for article
	//$data_news = get_news_by_code($ccode);
//	$arr_data = array(								
//				'nhit'				=> $data_news['nhit']+1
//		        );
//	$this->db->where('ccode', $ccode);
//	$this->db->update(Fget_ap_table('tnews'), $arr_data);

	$this->m_nid = $ccode;
	$this->event = 'detail';
	$this->do_process();
}
function xem_truoc($ccode)
{
	
	//update hit for article
	//$data_news = get_news_by_code($ccode);
//	$arr_data = array(								
//				'nhit'				=> $data_news['nhit']+1
//		        );
//	$this->db->where('ccode', $ccode);
//	$this->db->update(Fget_ap_table('tnews'), $arr_data);
	$this->xem_truoc = 1;
	$this->m_nid = $ccode;
	$this->event = 'detail';
	$this->do_process();
}
function news_byid($nid)
{
	
	//update hit for article
	$data_news = get_news_byid_detail($nid);
	$arr_data = array(								
				'nhit'				=> $data_news['nhit']+1
		        );
	$this->db->where('nid', $nid);
	$this->db->update(Fget_ap_table('tnews'), $arr_data);

	$this->m_nid = $data_news['ccode'];
	$this->event = 'detail';
	$this->do_process();
}

function page($current_page)
{	
	$this->ncurrent_page			= $current_page;
	$this->do_process();
}

function index()
{
	$this->do_process();
}

function page_cat($ccode,$current_page)
{
	$this->event	 = 'cat';
	$this->m_ccode_cat = $ccode;
	$this->ncurrent_page			= $current_page;
	$this->do_process();	
}

function cat($ccode)
{
	$this->event	 = 'cat';
	$this->m_ccode_cat = $ccode;
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
//	if(isset($_POST['txt_name']))
//	{
//		$this->txt_name = $_POST['txt_name'];
//		$this->txt_title = $_POST['txt_title'];
//		$this->txt_content = $_POST['txt_content'];
//		$arr_data =	array(						
//			'nid_news'			=> $this->m_nid,	
//			'status'			=>	1,
//			'cname'				=> $this->txt_name,
//			'ctitle'			=> $this->txt_title,
//			'ccomment'			=> $this->txt_content,
//			'ddate01'			=> dbget_current_date()
//		);
//		$this->db->insert(Fget_ap_table('tcomment'), $arr_data);	
//		redirect ('news/detail/'.$this->m_nid);	
//	//	$this->db->update(Fget_ap_table('tcomment'), $arr_data);
//	}	
}
	
private function caculate_data()
{
	$this->load->language('ap', $this->m_language);
	if($this->event == 'sec')
	{	
		$this->sec_news			= $this->news_model->get_name_sec($this->m_ccode_sec);
		$nid_sec				= $this->news_model->get_id_sec_new($this->m_ccode_sec);
		$this->m_nid_sec		= $nid_sec['nid'];
		$this->ntotal_row		= $this->news_model->count_record_sec($this->m_nid_sec);
		$this->ctr_name			= 'news/page_sec/'.$this->m_ccode_sec;
		$this->obj_news			= $this->news_model->get_listview($this->get_where_news_string(),'ddate01','asc',$this->nrow_per_page,$this->ncurrent_page,$this->ntotal_row);
	}	
	else if($this->event == 'cat')
	{

		$this->cat_news			= $this->news_model->get_name_cat($this->m_ccode_cat);
		$this->ntotal_row		= $this->news_model->count_record_cat($this->m_ccode_cat);

		$this->ctr_name			= 'news/page_cat/'.$this->m_ccode_cat;
		$this->obj_all_news		= $this->news_model->get_listall($this->m_ccode_cat);
		$this->obj_news			= $this->news_model->get_listview($this->get_where_news_string(),'ddate01','asc',$this->nrow_per_page,$this->ncurrent_page,$this->ntotal_row);

		
	}
	else if($this->event == 'detail')
	{
		$this->obj_news			= get_news_by_code($this->m_nid);
		$this->nid_section		= $this->obj_news['nid_section_news'];
		$this->nid_cat			= $this->obj_news['nid_cat_news'];
		$this->title		 	= $this->obj_news['ctitle'];
		$this->description	 	= strip_tags($this->obj_news['cshort_content']);
		$this->tags		 		= $this->obj_news['ctag'];
	}
 	$this->event			= $this->event == ''?'view':$this->event;
	
	
}

private function do_business()
{	
	$data['nid_sec']	= $this->m_nid_sec;
	$data['nid_cat']	= $this->m_ccode_cat;
	$data['event']		= $this->event;
	/*
	$data_news = get_news_by_id_detail($this->m_nid);
	if($data_news['nstatus']==0 && $this->xem_truoc==0)
		redirect(base_url().'page-not-found.html');
	*/
	$data['obj_news']		= $this->obj_news;
	$data['obj_all_news']	= $this->obj_all_news;
	$data['lbl_tinmoi']	= $this->m_language_key('tinmoi');
	$data['lbl_tin']	= $this->m_language_key('tin');
	$data['paging']		= Hpaging($this->ntotal_row,$this->ncurrent_page,$this->nrow_per_page,$this->ctr_name,'');
	$data['link_page']	= base_url().'index.php/news';
	
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	$data['g_ishome']		= 0;
	if ($this->nid_cat == 1)
        $data['menu_top'] = 'dichvu';
    else
        $data['menu_top'] = 'tintuc';
	if($this->event == 'sec')
		{
		$data['ccode']		= $this->sec_news['ccode'];
		$data['sec_news']	= $this->sec_news['csec_news'];
		$data['title']		= $this->sec_news['csec_news'];
		$data['tags']		= $this->sec_news['cnote'];
		$data['description']= $this->description;
		}
	else if($this->event == 'cat')
		{
		
		$data['ccode']		= $this->cat_news['ccode_cat'];
		$data['cat_news']	= $this->cat_news['ccat_news'];
		$data['title']		= $this->cat_news['ccat_news'];
		$data['tags']		= $this->cat_news['cnote'];
		$data['ccode_sec']	= $this->cat_news['ccode_sec'];
		$data['description']= $this->cat_news['cnote'];
		}
	else if($this->event == 'cat_news')
		{
		
		$data['cat_news']	= $this->cat_news['ccat_news'];
		$data['title']		= $this->cat_news['ccat_news'];
		$data['tags']		= $this->cat_news['ctag'];
		$data['ccode_sec']	= $this->cat_news['ccode_sec'];
		$data['ccode']		= $this->cat_news['ccode_cat'];
		$data['description']= $this->cat_news['cnote'];
		}
	else if($this->event == 'detail')
	{
		$data['ccode_cat']	= $this->m_ccode_cat;
		$data['ccode_sec']	= $this->m_ccode_sec;
		$data['cat_news']	= $this->cat_news;
		$data['title']		= $this->title;
		$data['tags']		= $this->tags;
		$data['clink']		= base_url().'bai/'.$this->m_ccode;
		$data['ccode']		= $this->m_ccode;
		$data['description']= $this->description;
	}
	$data['view_folder']    = $this->view_folder;
	$data['menu_top'] = 'news';
	
	/*
	$menu_data = get_menu_frontend();
	$menu_tree = build_menu_tree($menu_data, 0);
	$data['menu_html'] = render_menu_tree($menu_tree, 'elementor-nav-menu');
	$data['mobile_menu_html'] = render_mobile_menu($menu_tree);	
	*/
	$this->load->view('news_detail',$data);	
	
}
	
private function destroy_data()
{
			
}
private function get_where_news_string()
{
		$str		= ' WHERE nid is not null ';
		
		if($this->m_nid_sec != '')
			$str  .= ' AND ccode_cat like "%'.$this->m_nid_sec.'%" ';	
		
		if($this->m_ccode_cat != '')
			$str  .= ' AND ccode_cat like "%'.$this->m_ccode_cat.'%"';	
		
		if($this->m_nid !='')
			$str	   .= ' AND ccode = "'.$this->m_nid.'" ';
//Dieu kien get record nstatus
//0:Khong active
//1:Active
		return $str ;
}

}