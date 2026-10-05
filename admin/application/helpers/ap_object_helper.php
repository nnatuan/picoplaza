<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function Obj_get_menu_list($str_nid_user='') 
	{ 
		$str_sql=' SELECT * FROM ' . Fget_ap_table('tmenu') . ' WHERE cdel=0 AND cmenu<>"" AND cstatus = 1 ORDER BY cindex asc ';
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();		
		//$obj_helper->db->where('cdel','0');
		//$obj_helper->db->where('cmenu<>',$stremty);
		//$obj_helper->db->order_by("cindex", "asc"); 
		//$obj_result 	= $obj_helper->db->get(Fget_ap_table('tmenu')); 
		$obj_result 	= $obj_helper->db->query($str_sql); 
		$obj_results 	= $obj_result->result_array();
		// update thong tin cmenu theo ngon ngu su dung
		
		for ($i=0; $i<count($obj_results); $i++) 
			$obj_results[$i]['cmenu'] = Fview_textindex($obj_results[$i]['cindex']) . $obj_helper->lang->line($obj_results[$i]['cmenu']); 
		
		return 	$obj_results;
	} 
	
 //
 //
 //

function Obj_get_user_type_list($str_nid_user='') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		
		$obj_helper->db->where('cdel','0');
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tuser_type')); 
		$obj_results 	= $obj_result->result_array();
		
		return 	$obj_results;
	}

function Obj_get_user_list($str_nid_user='') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		
		$str_query = ' SELECT view.* FROM ' . Vuser_view()  ; 
		$str_query .= ' WHERE nid > 3 ' ; 
		$obj_results = $obj_helper->db->query($str_query);
		$obj_results 	= $obj_results->result_array();
		
		return 	$obj_results;
	}

function Obj_get_user_permission_list($str_nid_user='') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		
		$str_query = ' SELECT view.* FROM ' . Vuser_view()  ; 
		$str_query .= ' WHERE nid > 3 ' ; 
		$obj_results = $obj_helper->db->query($str_query);
		$obj_results 	= $obj_results->result_array();
		
		return 	$obj_results;
	}
	    
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/07/23
 * @description		: Gan gia tri cookie voi mot tu khoa tuong ung
 * 					: 	Yeu cau phai co 2 thong so tokaban session: 
 * 					: 	
 * 					: 	
 * @access	        : public  
 * @param string	: 
 * 					: 
 *
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function Obj_get_user_name($str_nid_user) 
	{ 
		$obj_helper =& get_instance();
		$obj_helper->load->database();
		
		$str_full_name = 'Guest';
		$obj_helper->db->where('nid',$str_nid_user);
		$obj_result 	= $obj_helper->db->get('tuser');
		$obj_results 	= $obj_result->result_array();
		
		foreach($obj_results as $rows)
			{
				$str_full_name 	.= $rows['cfirstname'] . ' ';
				
				$str_full_name  .= $rows['cmiddlename'] . ' ';
				$str_full_name  .= $rows['clastname'];
			}
		return 	$str_full_name;
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan - huan_lv77@tokaban.com
 * @finished date	: 2009/07/23
 * @description		: Gan gia tri cookie voi mot tu khoa tuong ung
 * 					: 	Yeu cau phai co 2 thong so tokaban session: 
 * 					: 	
 * 					: 	
 * @access	        : public 
 * @param string	: 
 * 					: 
 *
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function Obj_is_user($str_userid, $str_password) 
	{ 
		$obj_helper =& get_instance();
		$obj_helper->load->database();
		
		$str_password = Obj_get_password_encode($str_password);
		// kiem tra userid
		// return 'invalid_userid';
		
		$obj_helper->db->where('cuserid',$str_userid);
		$obj_result 	= $obj_helper->db->get('tuser');
		if ($obj_result->num_rows() <= 0)
			return 'invalid';
			
		
		// kiem tra password	
		// return 'invalid_password';
		$obj_helper->db->where('cpassword',$str_password);
		$obj_result 	= $obj_helper->db->get('tuser');
		$obj_results 	= $obj_result->result_array();		
		if ($obj_result->num_rows() <= 0)
			return 'invalid';
			
		// Kiem tra userid va password	
		// return 'invalid_user_password';		
		$obj_helper->db->where('cstatus','1');
		$obj_helper->db->where('cuserid',$str_userid);
		$obj_helper->db->where('cpassword',$str_password);
		$obj_result 	= $obj_helper->db->get('tuser');
		
		if ($obj_result->num_rows() <= 0)
			return 'invalid';		
		else
			{
				$obj_row = $obj_result->row_array();
				return $obj_row['nid'];
			}
		
	}

function Obj_get_user_datarow($nid) 
	{ 
		$obj_helper =& get_instance();
		$obj_helper->load->database();

		$obj_helper->db->where('nid',$nid);
		$obj_result 	= $obj_helper->db->get('tuser');		
		return  $obj_result->row_array();
	}

//
// Da duoc kiem tra
//
function Obj_get_password_normal()
	{
		//return 'tokabanwithyourpassword';	
		return 'Mật khẩu được bảo vệ';
	}
	
//
// Da kiem tra
//
function Obj_get_password_encode($str_password)
	{
		if(empty($str_password))
			return $str_password;
		else
			return md5($str_password);			
	}

//
// Chua kiem tra duoc, bao loi
// Da duoc kiem tra
//
function Obj_get_encode($str_data)
	{
		return base64_encode(Obj_get_password_normal() . $str_data); 
	}
	
//
// Ham giai ma. 
// Da duoc kiem tra.
//	
function Obj_get_decode($str_data)
	{
		$str_key = Obj_get_password_normal();
		$str_decode = base64_decode($str_data);
		 
		if (strpos($str_key,substr($str_decode,0,strlen($str_key))) === false)
			return '';
			
		return substr($str_decode,strlen($str_key) - strlen($str_decode));
	}

function Obj_get_sec_news() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tsection_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

//
//
//
function Obj_get_cat_news() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

//
//
//
function Obj_get_cat_news_by_nidsec($nid_sec = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($nid_sec != '')
			$obj_helper->db->where('nid_section_news',$nid_sec);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
//
//
function Obj_get_cat_news_by_nidsec_notnull($nid_sec = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($nid_sec != '')
			$obj_helper->db->where('nid_section_news',$nid_sec);
		//else
			//$obj_helper->db->where('nid_section_news',0);
		$obj_helper->db->order_by('cindex','asc');
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

//
function Obj_get_section_news() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tsection_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

//
//
//
function Obj_get_tlanguage() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tlanguage')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
//
//
//Lay ngon ngu loai bo nhung ngon ngu da ton tai

function Obj_get_tlanguage2($arr_idlang) 
	{ 	
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where_not_in('nid',$arr_idlang);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tlanguage')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_status_list($arr_idlang) 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where_not_in('nid',$arr_idlang);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tfaq')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_group_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tgroup_product')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function Obj_get_material_product_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tmaterial_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
	
	/*
function Obj_get_cat_product_list($nid_material_products)
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_material_products',$nid_material_products);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
	*/
function Obj_get_cat_product_list()
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		//$obj_helper->db->where('nid_material_products',$nid_material_products);
		$obj_helper->db->where('cdel','0');
		$obj_helper->db->order_by('cindex','asc');
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_product')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
//function Obj_get_brand_product_list($nid_cat_products)
function Obj_get_brand_product_list()
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
//		$obj_helper->db->where('nid_cat_products',$nid_cat_products);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tbrand_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}


function Obj_get_material_work_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tmaterial_works')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_cat_work_list($nid = '', $material = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($material != '')
			$obj_helper->db->where('nid_material_works',$material);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_works')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_order_status_list($nid = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('torder_status')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_ship_type_list() 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tship_type')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function Obj_get_order_detail_by_nid_order($nid = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_order',$nid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('torder_detail')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function get_news_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tnews');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();

	}
function get_product_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();

	}
function get_cat_product_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tcat_products');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();

	}
function get_sec_product_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tmaterial_products');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();

	}

//
function Obj_get_cat_faq() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_faq')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_news() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tnews')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

//
function Obj_get_news_byid($nid) 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid',$nid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tnews')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_function_fronend_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nstatus',1);
		$obj_helper->db->order_by('nid asc'); 
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tfunction_frontend')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_cat_news_list_for_menu() 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
 
		$str_query = ' SELECT a.nid as nid, ';
		$str_query .= ' a.ccat_news as ccat_news, ';
		$str_query .= ' b.csection_news as csection_news';
		$str_query .= ' FROM '.Fget_ap_table('tcat_news').' as a ';
		$str_query .= ' LEFT JOIN '.Fget_ap_table('tsection_news').' as b ON (a.nid_section_news = b.nid) ';	
		$str_query .= ' WHERE a.nid is not null ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}

function Obj_get_sec_news_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nstatus',1);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tsection_news')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
	
// Menu frontend
function Obj_get_menu_frontend_list() 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();		
		$str_sql=' SELECT * FROM ' . Fget_ap_table('tmenu_frontend') . ' WHERE nid is not null AND nstatus = 1 ORDER BY ccat_index asc, nindex asc ';
		$obj_result 	= $obj_helper->db->query($str_sql); 
		$obj_results 	= $obj_result->result_array();
		
		// update thong tin cmenu theo ngon ngu su dung
		
		for ($i=0; $i<count($obj_results); $i++) 
			$obj_results[$i]['cmenu'] = Fview_textindex($obj_results[$i]['ccat_index']) . $obj_results[$i]['cmenu']; 
		
		return 	$obj_results;
	}

function Obj_get_city_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->order_by('ccity','asc');
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcity')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}


function Obj_get_cat_wood_by_nidsec($nid_sec = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($nid_sec != '')
			$obj_helper->db->where('nid_section_news',$nid_sec);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_wood')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
	
function Obj_get_section_wood() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tsection_wood')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function Obj_get_product_img($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_product',$nid);
		$obj_helper->db->order_by("ddate01", "desc");
		$obj_helper->db->order_by("nid", "desc"); 
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tgallery_detail')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_news_img($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_product',$nid);
		$obj_helper->db->order_by("ddate01", "desc");
		$obj_helper->db->order_by("nid", "desc"); 
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tnews_gallery_detail')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function get_img_by_cat($id_cat){
	
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('id_cus',$id_cat);
		$obj_helper->db->order_by("nid", "desc");
		$obj_helper->db->limit("5", "0");
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tfiles_detail')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function get_img_by_product($nid){
	
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_product',$nid);
		$obj_helper->db->order_by("nid", "desc");
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tproduct_images')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_code_sale_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcode_sale')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
/*	
function Obj_get_loai_bds_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tloai_bds')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function Obj_get_loai_tin_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tloai_tin')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_huong_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('thuong')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function Obj_get_district_list($nid_province)
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_province',$nid_province);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tdistrict')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}		
*/	
function get_user_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tuser');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();

	}	
	function get_user_type_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tuser_type');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_color_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tcolor');
		$str_query .= ' WHERE nid = '.$nid;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_gift_by_order($nid_order){
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tgift');
		$str_query .= ' WHERE nid_cart = '.$nid_order;			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}
function get_news_all(){
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * FROM '.Fget_ap_table('tnews');		
		$str_query .= ' WHERE nstatus=1 ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}
function get_sec_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
	$str_query .= ' WHERE a.nstatus=1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_brand_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
	$str_query .= ' WHERE a.nstatus=1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_cat_by_sec($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
	$str_query .= ' WHERE a.nstatus=1 ';
	$str_query .= ' AND nid_material_products = '.$nid;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_product_by_cat($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	$str_query .= ' WHERE a.nstatus=1 ';
	$str_query .= ' AND nid_cat_products = '.$nid;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_product_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	//$str_query .= ' WHERE a.nstatus=1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_member_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid = "'.$nid.'"';
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->row_array();
}
function get_count_bid_by_product_bid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tbid').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_product_bid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_bid_win_by_product_bid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tbid_win').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_product_bid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_check_subsite($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid_news',$nid);
		//$obj_helper->db->order_by("nid", "desc"); 
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tnews_subsite')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function get_subsite_all() 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tsubsite')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function get_all_loc_banner(){
	
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->order_by("cindex + 0", "asc");
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tlocation_banner')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}
function get_access_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('taccess').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' ORDER BY a.nid_group, a.nid';
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}
function get_flashsale_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('tflashsale').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	//$str_query .= ' ORDER BY a.nid';
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}
function get_flashsale_product($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('tflashsale_product').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_product = '.$nid;
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}
function get_permission_by_user_type($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('tpermission').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_user_type = '.$nid;
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}
function get_check_permission($nid_access)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.nid';
	$str_query .= ' FROM '.Fget_ap_table('tpermission').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_access = '.$nid_access;
	$str_query .= ' AND a.nid_user_type = '.Fget_userdata('session_user_isadmin');
	
	$obj_result = $obj_helper->db->query($str_query);
	if(isset($obj_result->row_array()['nid']))
		return true;
	return false;
}
function get_config_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_config_value($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.cvalue';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cvalue'];
	}	
function get_sec_product_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cmaterial_products'];
	}	
function get_cat_product_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccat_products'];
	}	
function get_product_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cproducts'];
	}	
function get_cat_product_id_sec($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['nid_material_products'];
	}
function get_order_status_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('torder_status').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['corder_status'];
	}	
function get_order_by_code($ccode)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.nid, a.cfullname, a.cphone, a.ntotal, a.cgiam_gia, a.nid_province, a.nid_district, a.nid_ward, a.caddress';
	$str_query .= ' FROM '.Fget_ap_table('torder').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.ccode = "' . $ccode . '"';
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->row_array();
}		
function get_order_detail($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.nid_product, a.cprice, a.nquantity, a.niscolor';
	$str_query .= ' FROM '.Fget_ap_table('torder_detail').' as a ';
	$str_query .= ' WHERE a.nid_order = '.$nid;
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}	
function get_setting_by_user($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('tsetting').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_user = '.$nid;
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->row_array();
}	
function get_product_by_key($nid_user, $key)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT nid, cimage_resize, cproducts, fprice_sale, fprice, cbarcode, ncheck';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	//$str_query .= ' AND niduser01 = '.$nid_user;
	$str_query .= ' AND (a.cproducts like "%'.$key.'%"';
	$str_query .= ' OR a.ccode like "%'.$key.'%")';
	$str_query .= ' LIMIT 0,20 ';
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->result_array();
}
function get_product_color($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcolor').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';
	if($nid !='')
		$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_customer_by_phone($cphone)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcustomer').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.cphone = "' . $cphone . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_field_by_table($table,$id,$field)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table($table).' as a ';
		$str_query .= ' WHERE a.nid = '.$id;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()[$field];
	}	
function get_code_sec($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccode'];
	}
function get_code_cat($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccode'];
	}	
function get_ward_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tward').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cname'];
	}	
function get_district_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tdistrict').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cname'];
	}	
function Obj_get_province_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tprovince')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}	
function get_province_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tprovince').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cname'];
	}	
function get_qty_by_order($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT sum(nquantity) as qty ';
		$str_query .= ' FROM '.Fget_ap_table('torder_detail').' as a ';
		$str_query .= ' WHERE a.nid_order = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['qty'];
	}	
function get_trip_by_order_vtp($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('ttrip').' as a ';
		$str_query .= ' WHERE a.ORDER_NUMBER = "' . $ccode . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_gallery_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*';
	$str_query .= ' FROM '.Fget_ap_table('tgallery').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid = '.$nid;
	$obj_result = $obj_helper->db->query($str_query); 
	return $obj_result->row_array();
}	

/**
 *-------------------------------------------------------------------
 * Hàm gửi Email dùng Mailjet REST API v3.1 (Gửi đơn hoặc Gửi hàng loạt 1 lần cURL)
 * @param string|array $to_email : Chuỗi 'a@gmail.com' HOẶC Mảng array('a@gmail.com', 'b@gmail.com')
 *                                 HOẶC Mảng array(array('Email' => 'a@gmail.com', 'Name' => 'A'))
 *-------------------------------------------------------------------
 */
function send_mail_mailjet($to_email, $subject, $message, $to_name = '')
{
    $api_key    = '6e0bab7456a99c77513304e446491805';
    $secret_key = '86540048b9dbdd27a70f57753f460d65';
    
    $from_email = 'info@picoplaza.vn'; 
    $from_name  = 'Hệ Thống PICO PLAZA';
    if (function_exists('get_config_value')) {
        $cfg = get_config_value(23);
        if (!empty($cfg)) $from_name = $cfg;
    } elseif (function_exists('get_value_by_config')) {
        $cfg = get_value_by_config(23);
        if (!empty($cfg)) $from_name = $cfg;
    }

    // 1. Đóng gói danh sách người nhận (To)
    $arr_to = array();

    if (is_array($to_email)) {
        foreach ($to_email as $item) {
            if (is_array($item)) {
                // Trường hợp mảng chứa cả Email & Name
                if (!empty($item['cemail'])) {
                    $arr_to[] = array(
                        'Email' => $item['cemail'],
                        'Name'  => !empty($item['cfullname']) ? $item['cfullname'] : $item['cemail']
                    );
                }
            } else {
                // Trường hợp mảng chuỗi Email đơn thuần
                if (!empty($item)) {
                    $arr_to[] = array('Email' => $item, 'Name' => $item);
                }
            }
        }
    } else {
        // Trường hợp chỉ gửi cho 1 Email đơn
        if (!empty($to_email)) {
            $arr_to[] = array(
                'Email' => $to_email,
                'Name'  => !empty($to_name) ? $to_name : $to_email
            );
        }
    }

    // Nếu danh sách nhận rỗng thì ngắt luôn
    if (empty($arr_to)) return FALSE;

    // 2. Đóng gói Payload gửi 1 lần duy nhất cho Mailjet
    $data_payload = array(
        'Messages' => array(
            array(
                'From' => array(
                    'Email' => $from_email,
                    'Name'  => $from_name
                ),
                'To'       => $arr_to, // Truyền toàn bộ danh sách khách hàng vào đây
                'Subject'  => $subject,
                'HTMLPart' => $message
            )
        )
    );

    // 3. Gọi cURL duy nhất 1 lần (Timeout 5-8s)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":" . $secret_key);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);

    $response  = @curl_exec($ch);
    $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    @curl_close($ch);

    return ($http_code == 200 || $http_code == 201);
}

/**
 *-------------------------------------------------------------------
 * @description     : Ham chen du lieu dung chung cho tat ca cac bang
 * @access          : public
 * @param string    : $table_name : Ten bang rut gon (Tu dong qua Fget_ap_table)
 * @param array     : $data       : Mang du lieu sach can chen
 * @return int|bool : Tra ve ID vua insert neu thanh cong, nguoc lai tra ve FALSE
 *-------------------------------------------------------------------
 */
function Finsert_data_global($table_name, $data)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    if ($obj_helper->db->insert(Fget_ap_table($table_name), $data)) {
        return $obj_helper->db->insert_id();
    }
    return FALSE;
}

/**
 *-------------------------------------------------------------------
 * Lấy lịch sử log Timeline Ticket kèm Họ tên Nhân viên trả lời
 *-------------------------------------------------------------------
 */
function Fget_ticket_logs($nid_ticket)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT a.*, u.cfullname as staff_name ";
    $str_query .= " FROM " . Fget_ap_table('tticket_log') . " as a ";
    $str_query .= " LEFT JOIN " . Fget_ap_table('tuser') . " as u ON a.nid_user_reply = u.nid ";
    $str_query .= " WHERE a.nid_ticket = " . (int)$nid_ticket . " ";
    $str_query .= " ORDER BY a.dreply_at ASC, a.nid ASC ";
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy toàn bộ danh sách tài liệu hồ sơ của BĐS trong trang quản trị CMS
 * @access          : public
 * @param int       : $nid_product : ID sản phẩm bất động sản
 * @return array    : Mảng danh sách tài liệu hồ sơ
 *-------------------------------------------------------------------
 */
function get_product_documents($nid_product)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tdocument') . ' ';
    $str_query .= ' WHERE nstatus = 1 AND nid_product = ' . (int)$nid_product;
    $str_query .= ' ORDER BY ctype_doc ASC, nid DESC ';
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách toàn bộ nhân viên nội bộ CMS để Admin giao việc
 *-------------------------------------------------------------------
 */
function get_staff_list()
{
	$obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = "SELECT nid, cfullname, cuserid ";
    $str_query .= "FROM " . Fget_ap_table('tuser') . " ";
    $str_query .= "WHERE cstatus = '1' AND crole = 'staff' ";
    $str_query .= "ORDER BY cfullname ASC";
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách nhân viên nội bộ theo Vai trò (Role)
 * @param string|array $role : Tên vai trò (vd: 'ticket_mgr') hoặc mảng các vai trò
 * @return array    : Mảng danh sách tài khoản hợp lệ
 *-------------------------------------------------------------------
 */
function get_staff_by_role($role = 'ticket_mgr')
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = "SELECT nid, cfullname, cuserid, crole ";
    $str_query .= "FROM " . Fget_ap_table('tuser') . " ";
    $str_query .= "WHERE cstatus = '1' AND cdel = '0' ";
    
    if (is_array($role)) {
        $str_query .= "AND crole IN ('" . implode("','", $role) . "') ";
    } else if (!empty($role)) {
        $str_query .= "AND crole = " . $obj_helper->db->escape($role) . " ";
    }
    
    $str_query .= "ORDER BY cfullname ASC";
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Đếm tổng số tài khoản nội bộ dựa theo bộ lọc tĩnh
 */
function Obj_get_staff_count($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT COUNT(nid) as total_rows FROM ' . Fget_ap_table('tuser') . $str_where_clause;
    $obj_result = $obj_helper->db->query($str_query);  
    $row = $obj_result->row_array();
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 * Lấy danh sách tài khoản nội bộ phân trang
 */
function Obj_get_staff_pagination($str_where_clause, $n_start_row, $n_row_per_page)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    // TỐI ƯU SELECT: Lấy đầy đủ các trường cần render trên bảng danh sách nhân sự
    $str_query = ' SELECT nid, cuserid, cfullname, cemail, chandphone, crole, nid_dept, cstatus ';
    $str_query .= ' FROM ' . Fget_ap_table('tuser') . $str_where_clause;
    $str_query .= ' ORDER BY nid DESC ';
    $str_query .= ' LIMIT ' . (int)$n_start_row . ', ' . (int)$n_row_per_page;
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->result_array();
}

/**
 * Lấy thông tin chi tiết một tài khoản nhân sự phục vụ sửa đổi (Edit mode)
 */
function Obj_get_staff_row($nid)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tuser') . ' WHERE nid = ' . (int)$nid;
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->row_array();
}

/**
 * Đếm tổng số lượng thành viên/khách hàng dựa theo bộ lọc
 */
function Obj_get_member_count($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT COUNT(nid) as total_rows FROM ' . Fget_ap_table('tmember') . $str_where_clause;
    $row = $obj_helper->db->query($str_query)->row_array();
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 * Lấy danh sách thành viên/khách hàng phân trang
 */
function Obj_get_member_pagination($str_where_clause, $n_start_row, $n_row_per_page)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT nid, cusername, cfullname, cemail, cphone, nstatus, nis_staff, dcreated_at ';
    $str_query .= ' FROM ' . Fget_ap_table('tmember') . $str_where_clause;
    $str_query .= ' ORDER BY nid DESC ';
    $str_query .= ' LIMIT ' . (int)$n_start_row . ', ' . (int)$n_row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy thông tin chi tiết một tài khoản thành viên (Edit mode)
 */
function Obj_get_member_row($nid)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tmember') . ' WHERE nid = ' . (int)$nid;
    return $obj_helper->db->query($str_query)->row_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Đếm tổng số dòng danh sách Email nhận bản tin phục vụ phân trang
 * @access          : public
 * @param string    : $str_where_clause : Chuỗi điều kiện lọc SQL
 * @return int      : Tổng số dòng
 *-------------------------------------------------------------------
 */
function get_newsletter_count($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT COUNT(nid) as total_rows FROM ' . Fget_ap_table('tnewsletter') . $str_where_clause;
    $row = $obj_helper->db->query($str_query)->row_array();
    
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách Email nhận bản tin phân trang theo bộ lọc
 * @access          : public
 * @param string    : $str_where_clause : Chuỗi điều kiện lọc SQL
 * @param int       : $n_start_row      : Hàng bắt đầu lấy dữ liệu
 * @param int       : $n_row_per_page   : Số lượng dòng trên một trang
 * @return array    : Mảng danh sách Email
 *-------------------------------------------------------------------
 */
function get_newsletter_pagination($str_where_clause, $n_start_row, $n_row_per_page)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT nid, cemail, nstatus, dcreated_at ';
    $str_query .= ' FROM ' . Fget_ap_table('tnewsletter') . $str_where_clause;
    $str_query .= ' ORDER BY nid DESC ';
    $str_query .= ' LIMIT ' . (int)$n_start_row . ', ' . (int)$n_row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * Đếm tổng số lượng thành viên tmember nhận tin
 *-------------------------------------------------------------------
 */
function get_newsletter_member_count($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT COUNT(nid) as total_rows FROM ' . Fget_ap_table('tmember') . $str_where_clause;
    $row = $obj_helper->db->query($str_query)->row_array();
    
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 *-------------------------------------------------------------------
 * Lấy danh sách thành viên tmember phân trang kèm Họ tên, SĐT, Email
 *-------------------------------------------------------------------
 */
function get_newsletter_member_pagination($str_where_clause, $n_start_row, $n_row_per_page)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT nid, cfullname, cphone, cemail, nstatus ';
    $str_query .= ' FROM ' . Fget_ap_table('tmember') . $str_where_clause;
    $str_query .= ' ORDER BY nid DESC ';
    $str_query .= ' LIMIT ' . (int)$n_start_row . ', ' . (int)$n_row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Đếm tổng số lượng tập tin / mẫu biểu dựa theo bộ lọc
 */
function Obj_get_file_count($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT COUNT(nid) as total_rows FROM ' . Fget_ap_table('tfiles') . $str_where_clause;
    $row = $obj_helper->db->query($str_query)->row_array();
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 * Lấy danh sách tập tin / mẫu biểu phân trang
 */
function Obj_get_file_pagination($str_where_clause, $n_start_row, $n_row_per_page)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tfiles') . $str_where_clause;
    $str_query .= ' ORDER BY nid DESC ';
    $str_query .= ' LIMIT ' . (int)$n_start_row . ', ' . (int)$n_row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy thông tin chi tiết một tập tin (Edit mode)
 */
function Obj_get_file_row($nid)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tfiles') . ' WHERE nid = ' . (int)$nid;
    return $obj_helper->db->query($str_query)->row_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách công việc chưa hoàn thành được giao cho nhân viên
 * @access          : public
 * @param int       : $nid_staff    : ID tài khoản nhân viên
 * @param string    : $current_date : Ngày hiện tại (Y-m-d)
 * @return array    : Mảng danh sách công việc kèm số ngày còn lại
 *-------------------------------------------------------------------
 */
function get_staff_active_tasks($nid_staff, $current_date)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, DATEDIFF(t.ddue_date, " . $obj_helper->db->escape($current_date) . ") as days_left ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " as t ";
    $str_query .= "WHERE t.nid_assignee = " . (int)$nid_staff . " AND t.nstatus != 2 ";
    $str_query .= "ORDER BY t.ddue_date ASC";
                  
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Quét danh sách công việc sắp hết hạn vào ngày mai phục vụ gửi mail
 * @access          : public
 * @param string    : $tomorrow_date : Ngày mai (Y-m-d)
 * @return array    : Mảng danh sách công việc kèm thông tin nhân sự nhận mail
 *-------------------------------------------------------------------
 */
/*
function get_tasks_remind_1day($tomorrow_date)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, m.cemail, m.cfullname ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " m ON t.nid_assignee = m.nid ";
    $str_query .= "WHERE t.ddue_date = " . $obj_helper->db->escape($tomorrow_date) . " ";
    //$str_query .= "AND t.nstatus != 2 ";
    $str_query .= "AND t.nis_mail_sent_1day = 0";
                  
    return $obj_helper->db->query($str_query)->result_array();
}
*/
function get_tasks_remind_1day($tomorrow_date)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, m.cemail, m.cfullname, m.ctelegram_chat_id ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " m ON t.nid_assignee = m.nid ";
    // CẬP NHẬT: Bọc DATE(t.ddue_date) để so sánh chuẩn xác với Y-m-d
    $str_query .= "WHERE DATE(t.ddue_date) = " . $obj_helper->db->escape($tomorrow_date) . " ";
    $str_query .= "AND t.nis_mail_sent_1day = 0";
    //$str_query .= "AND t.nstatus != 2 ";
	
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Quét danh sách công việc hết hạn đúng ngày hôm nay phục vụ gửi mail khẩn
 * @access          : public
 * @param string    : $current_date : Ngày hôm nay (Y-m-d)
 * @return array    : Mảng danh sách công việc kèm thông tin nhân sự nhận mail
 *-------------------------------------------------------------------
 */
/* 
function get_tasks_remind_duedate($current_date)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, m.cemail, m.cfullname ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " m ON t.nid_assignee = m.nid ";
    $str_query .= "WHERE t.ddue_date = " . $obj_helper->db->escape($current_date) . " ";
    //$str_query .= "AND t.nstatus != 2 ";
    $str_query .= "AND t.nis_mail_sent_duedate = 0";
                  
    return $obj_helper->db->query($str_query)->result_array();
}
*/
function get_tasks_remind_duedate($current_date)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, m.cemail, m.cfullname, m.ctelegram_chat_id ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " m ON t.nid_assignee = m.nid ";
    // CẬP NHẬT: Bọc DATE(t.ddue_date) để so sánh chuẩn xác với Y-m-d
    $str_query .= "WHERE DATE(t.ddue_date) = " . $obj_helper->db->escape($current_date) . " ";
    $str_query .= "AND t.nis_mail_sent_duedate = 0";
    //$str_query .= "AND t.nstatus != 2 ";
	
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * Quét danh sách công việc sắp tới hạn xử lý trong khoảng N phút
 * @param int $remind_before_minutes : Số phút bật nhắc nhở trước deadline
 * @return array                     : Mảng công việc kèm số phút còn lại (minutes_left)
 *-------------------------------------------------------------------
 */
function get_tasks_nearing_deadline_by_minutes($remind_before_minutes = 60)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $remind_before_minutes = (int)$remind_before_minutes;
    if ($remind_before_minutes <= 0) $remind_before_minutes = 60; // Mặc định 60 phút nếu giá trị truyền vào không hợp lệ
    
    $str_query = "SELECT t.*, m.cemail, m.cfullname, m.ctelegram_chat_id, ";
    $str_query .= "TIMESTAMPDIFF(MINUTE, NOW(), t.ddue_date) as minutes_left ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " m ON t.nid_assignee = m.nid ";
    // Điều kiện: Thời gian còn lại <= $remind_before_minutes và chưa quá hạn (minutes_left >= 0)
    $str_query .= "WHERE TIMESTAMPDIFF(MINUTE, NOW(), t.ddue_date) <= " . $remind_before_minutes . " ";
    $str_query .= "AND TIMESTAMPDIFF(MINUTE, NOW(), t.ddue_date) >= 0 ";
    $str_query .= "AND t.nis_mail_sent_duedate = 0 ";
                  
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : (Admin) Lấy toàn bộ danh sách công việc đã giao kèm tên nhân sự
 * @access          : public
 * @return array    : Mảng danh sách tất cả công việc trong hệ thống
 *-------------------------------------------------------------------
 */
function get_admin_all_tasks()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT t.*, u.cfullname as staff_name ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " u ON t.nid_assignee = u.nid ";
    $str_query .= "ORDER BY t.nid DESC";
                  
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * Đếm tổng số lượng công việc phục vụ phân trang danh sách Admin
 *-------------------------------------------------------------------
 */
function get_task_count_listview($str_where_clause)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = "SELECT COUNT(t.nid) as total_rows FROM " . Fget_ap_table('ttask') . " t " . $str_where_clause;
    $row = $obj_helper->db->query($str_query)->row_array();
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 *-------------------------------------------------------------------
 * Lấy danh sách công việc phân trang kèm theo tên nhân sự xử lý
 *-------------------------------------------------------------------
 */
function get_task_listview($str_where_clause, $str_orderby, $n_row_per_page, $n_current_page, $n_total_row)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $n_start_row = ($n_current_page - 1) * $n_row_per_page;
    if ($n_start_row < 0) $n_start_row = 0;
    
    $current_date = date('Y-m-d');

    $str_query = "SELECT t.*, u.cfullname as staff_name, DATEDIFF(t.ddue_date, " . $obj_helper->db->escape($current_date) . ") as days_left ";
    $str_query .= "FROM " . Fget_ap_table('ttask') . " t ";
    $str_query .= "INNER JOIN " . Fget_ap_table('tuser') . " u ON t.nid_assignee = u.nid ";
    $str_query .= $str_where_clause . " ";
    $str_query .= "ORDER BY " . $str_orderby . " ";
    $str_query .= "LIMIT " . (int)$n_start_row . ", " . (int)$n_row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * Lấy thông tin chi tiết một bản ghi công việc theo nid
 *-------------------------------------------------------------------
 */
function get_task_byid($nid)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();
    
    $str_query = "SELECT * FROM " . Fget_ap_table('ttask') . " WHERE nid = " . (int)$nid;
    return $obj_helper->db->query($str_query)->row_array();
}

/**
 *-------------------------------------------------------------------
 * Quét danh sách email cấu hình hệ thống của toàn bộ tài khoản Admin CMS
 *-------------------------------------------------------------------
 */
function get_admin_emails()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = "SELECT cemail FROM " . Fget_ap_table('tuser') . " WHERE cstatus = '1' AND cisadmin = 1";
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * Gửi tin nhắn qua API Telegram Bot (Core)
 *-------------------------------------------------------------------
 */
function send_telegram_core($chat_id, $message_text)
{
    $chat_id = trim($chat_id);
    if (empty($chat_id) || empty($message_text)) return FALSE;
    
    $bot_token = "8829107476:AAEJlU-4xdYDBffuMmNM5LDTyXN6L9VUD5A"; // Điền Token Bot Telegram vào đây
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    
    $data = array(
        'chat_id'    => $chat_id,
        'text'       => $message_text,
        'parse_mode' => 'HTML'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 600);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = @curl_exec($ch);
    $curl_err = @curl_error($ch);
    $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    @curl_close($ch);
    
    $res_arr = !empty($response) ? json_decode($response, true) : null;
    
    // Ghi log kiểm tra hoạt động Telegram
    $log_line = date('Y-m-d H:i:s') . " | ChatID: " . $chat_id . " | HTTP: " . $http_code . " | Response: " . (!empty($response) ? trim($response) : $curl_err) . "\n";
    @file_put_contents(FCPATH . 'telegram_debug.log', $log_line, FILE_APPEND);
    
    // TỰ ĐỘNG XỬ LÝ KHI GROUP ĐƯỢC NÂNG CẤP LÊN SUPERGROUP (MIGRATE TO CHAT ID)
    if (!empty($res_arr) && empty($res_arr['ok'])) {
        $retry_id = '';
        if (!empty($res_arr['parameters']['migrate_to_chat_id'])) {
            $retry_id = $res_arr['parameters']['migrate_to_chat_id'];
        }
        
        if (!empty($retry_id)) {
            $data['chat_id'] = $retry_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 600);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            $response = @curl_exec($ch);
            $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            @curl_close($ch);
            
            $log_retry = date('Y-m-d H:i:s') . " | RETRY ChatID: " . $retry_id . " | HTTP: " . $http_code . " | Response: " . (!empty($response) ? trim($response) : '') . "\n";
            @file_put_contents(FCPATH . 'telegram_debug.log', $log_retry, FILE_APPEND);
        }
    }
    
    return $response;
}

/**
 *-------------------------------------------------------------------
 * Gửi tin nhắn Telegram hàng loạt đồng thời (Parallel cURL Multi)
 * Tương thích 100% PHP 5.6, PHP 7.x, PHP 8.x, không gây nghẽn timeout
 * @param array $messages Mảng chứa danh sách array('chat_id' => ..., 'text' => ...)
 *-------------------------------------------------------------------
 */
function send_telegram_multi($messages = array())
{
    if (empty($messages) || !is_array($messages)) return FALSE;
    
    $bot_token = "8829107476:AAEJlU-4xdYDBffuMmNM5LDTyXN6L9VUD5A";
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    
    $mh = curl_multi_init();
    $curl_handles = array();
    
    foreach ($messages as $i => $item) {
        if (empty($item['chat_id']) || empty($item['text'])) continue;
        
        $ch = curl_init();
        $data = array(
            'chat_id'    => $item['chat_id'],
            'text'       => $item['text'],
            'parse_mode' => 'HTML'
        );
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        
        curl_multi_add_handle($mh, $ch);
        $curl_handles[$i] = $ch;
    }
    
    if (empty($curl_handles)) {
        curl_multi_close($mh);
        return FALSE;
    }
    
    $running = null;
    do {
        $mrc = curl_multi_exec($mh, $running);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($running > 0 && $mrc == CURLM_OK) {
        if (curl_multi_select($mh, 0.2) == -1) {
            usleep(50000);
        }
        do {
            $mrc = curl_multi_exec($mh, $running);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
    
    foreach ($curl_handles as $ch) {
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);
    return TRUE;
}

/**
 * Lấy danh sách nhóm quyền (Roles) của Nhân viên đang đăng nhập CMS dưới dạng mảng
 */
function get_current_staff_roles()
{
    $role_str = Fget_userdata('session_user_role');
    if (empty($role_str)) {
        return array('admin'); // Mặc định admin nếu chưa thiết lập
    }
    $roles = explode(',', $role_str);
    return array_values(array_filter(array_map('trim', $roles)));
}

/**
 * Lấy nhóm quyền (Role) của Nhân viên đang đăng nhập CMS
 */
function get_current_staff_role()
{
    $role = Fget_userdata('session_user_role');
    return !empty($role) ? $role : 'admin'; // Mặc định admin nếu chưa thiết lập
}

/**
 * Kiểm tra xem Nhân viên có sở hữu vai trò cụ thể không (hoặc là admin)
 */
function has_staff_role($role)
{
    $roles = get_current_staff_roles();
    if (in_array('admin', $roles)) {
        return true;
    }
    return in_array($role, $roles);
}

/**
 * Kiểm tra xem Nhân viên có quyền truy cập chức năng này hay không
 * @param array|string $allowed_roles Danh sách các Role được phép
 */
function check_staff_permission($allowed_roles = array())
{
    $current_roles = get_current_staff_roles();
    
    // Quản trị viên (admin) luôn có toàn quyền
    if (in_array('admin', $current_roles)) {
        return true;
    }

    if (!is_array($allowed_roles)) {
        $allowed_roles = array($allowed_roles);
    }

    foreach ($allowed_roles as $r) {
        if (in_array($r, $current_roles)) {
            return true;
        }
    }

    return false;
}