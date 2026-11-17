<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date	: 2009/011/09
 * @description		: Tra ve tong so dong tu cau lenh sql tuong ung
 * @access	        : public
 *
 * @param string	: $str_where_clause       : menh de where
 * 					: 
 * @return string	: $obj_result->num_rows() : tong so dong
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function get_user_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tuser').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_material_products()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 asc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_material_product_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 asc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_material_product_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' AND nspecial = 1 ';
		$str_query .= ' ORDER BY cindex+0, nid desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	

function get_config_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
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
function get_config_byid2($nid)
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
function get_module_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmodule').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		//$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}

function get_config_site($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
	
/*End Important helper*/
	//
function get_banner_list()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tbanner_images');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_banner_location($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tbanner_images');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' AND nid_loc_banner = '.$nid;
		$str_query .= ' ORDER BY cindex+0 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
//
function get_home_product()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';
		$str_query .= ' LIMIT 0,20 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_home_menu()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_center_menu()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.chome	  =	1';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_specific_product()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.ncheck =	1';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';
		$str_query .= ' LIMIT 0,3 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_product_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_product_by_id_hh($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid, a.nhethang';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_other_product_by_cat($nid,$nid_cat)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid != "'.$nid.'"';
		$str_query .= ' AND a.nid_cat_products = '.$nid_cat;
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';			
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}

/*
function get_count_search($keyword)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND (a.ccode like "%'.$keyword.'%"';
		$str_query .= ' OR a.cproducts like "%'.$keyword.'%")';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_search($keyword,$row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.ccode like "%'.$keyword.'%"';
		$str_query .= ' AND (a.ccode like "%'.$keyword.'%"';
		$str_query .= ' OR a.cproducts like "%'.$keyword.'%")';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';	
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_count_search($keyword)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nid IN (SELECT nid_product as nid FROM '.Fget_ap_table('ttag'). ' where cname = "'.$keyword.'")';
		$str_query .= ' AND a.ctag like "%'.$keyword.'%"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}*/
function get_count_search($keyword)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND (a.ccode like "%'.$keyword.'%"';
		//$str_query .= ' OR a.cproducts like "%'.$keyword.'%")';
		$str = explode(' ',$keyword);
		for($i=0;$i<count($str);$i++) {
			$str_query .= ' AND (a.cproducts like "%'.$str[$i].'%"';
			$str_query .= ' OR a.ccode like "%'.$str[$i].'%")';
		}
		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_search($keyword,$row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND (a.ccode like "%'.$keyword.'%"';
		
		$str = explode(' ',$keyword);
		for($i=0;$i<count($str);$i++) {
			$str_query .= ' AND (a.cproducts like "%'.$str[$i].'%"';
			$str_query .= ' OR a.ccode like "%'.$str[$i].'%")';
		}	
		
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';	
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
/*	
function get_search($keyword,$row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid IN (SELECT nid_product as nid FROM '.Fget_ap_table('ttag'). ' where cname = "'.$keyword.'")';
		$str_query .= ' AND a.ctag like "%'.$keyword.'%"';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';	
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}*/
function reset_page()
{
	$_SESSION['curr_page_product'] = '1';
	$_SESSION['curr_page_search'] = '1';
		
}

function get_news_byccode_detail($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$nid.'"';
		$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_section_news_byid($nid_sec)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid,a.ccat_news,a.cimage,a.ctag, a.cnote, a.ccode';
		$str_query .= ' FROM '.Fget_ap_table('tcat_news').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		if($nid_sec != '')
			$str_query .= ' AND a.nid = '.$nid_sec;
		else
			$str_query .= ' AND a.nid is not null ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_count_news_by_cat($nid_sec)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		if($nid_sec != '')
			$str_query .= ' AND a.nid_cat_news = '.$nid_sec;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_news_by_cat($nid_sec,$row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		if($nid_sec != '')
			$str_query .= ' AND a.nid_cat_news = '.$nid_sec;
		
		//$str_query .= ' AND a.nid NOT IN '.$str;

		$str_query .= ' ORDER BY a.nid+0 desc ';			
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_count_news()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_news_paging($row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.nid+0 desc ';			
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_news_by_cat_no_page($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a, ';
		$str_query .= Fget_ap_table('tcat_news').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_news = b.nid';		
		$str_query .= ' AND a.nid_cat_news = '.$nid;		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_news_xem_nhieu_nhat()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a, ';
		$str_query .= Fget_ap_table('tcat_news').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nid IN (SELECT nid_news as nid FROM ' . Fget_ap_table('tnews_subsite') . ' where nid_subsite  = "' . $nid_subsite . '") ';
		$str_query .= ' AND a.nid_cat_news = b.nid';		
		$str_query .= ' ORDER BY a.cview+0 desc ';			
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_news_xem_nhieu_nhat_not_me($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as code_cat';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a, ';
		$str_query .= Fget_ap_table('tcat_news').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid != '.$nid;
		$str_query .= ' AND a.nid_cat_news = b.nid';		
		$str_query .= ' ORDER BY a.cview+0 desc ';			
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}		
	function get_hot_news()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nactive =	1';	
		$str_query .= ' LIMIT 0,1';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
	function get_other_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nactive !=1 ';	
		$str_query .= ' ORDER BY nid desc ';		
		$str_query .= ' LIMIT 0,10';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
	
	function get_home_section()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tsection_news').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_service()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		//$str_query .= ' AND a.nactive !=1 ';	
		$str_query .= ' AND a.nid_section_news = "7"';
		$str_query .= ' ORDER BY nid desc ';		
		//$str_query .= ' LIMIT 0,10';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
	
	function get_other_news($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid != "'.$nid.'"';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';		
$str_query .= ' LIMIT 0,5 ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_news_by_id_detail($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$nid.'"';
	//	$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_article_by_code($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tarticle').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_article_list()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tarticle').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND nid > 1';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_product_cat_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_product_sec_byid($nid) //theo ccode
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_product_group_by_code($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tgroup_product').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$ccode.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_product_brand_by_code($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$ccode.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}		
function get_product_cat($ccode_cat, $row_per_page, $curr_page, $type_sort)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		if ($type_sort == 0) {
			$str_query .= ' ORDER BY a.fprice';
		} else if ($type_sort == 1) {
			$str_query .= ' ORDER BY a.fprice desc';
		} else if ($type_sort == 2) {
			$str_query .= ' ORDER BY a.cproducts+0';
		} else if ($type_sort == 3) {
			$str_query .= ' ORDER BY a.cproducts desc';
		} else if ($type_sort == 4) {
			$str_query .= ' ORDER BY a.nid';
		} else if ($type_sort == 5) {
			$str_query .= ' ORDER BY a.nid desc';
		} else if ($type_sort == 6) {
		}
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_cat_tt($ccode_cat, $row_per_page, $curr_page, $type_sort, $arr_tt)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		if ($type_sort == 0) {
			$str_query .= ' ORDER BY a.fprice';
		} else if ($type_sort == 1) {
			$str_query .= ' ORDER BY a.fprice desc';
		} else if ($type_sort == 2) {
			$str_query .= ' ORDER BY a.cproducts+0';
		} else if ($type_sort == 3) {
			$str_query .= ' ORDER BY a.cproducts desc';
		} else if ($type_sort == 4) {
			$str_query .= ' ORDER BY a.nid';
		} else if ($type_sort == 5) {
			$str_query .= ' ORDER BY a.nid desc';
		} else if ($type_sort == 6) {
		}
		$str_query .= ' AND a.nid IN (SELECT DISTINCT nid_product as nid FROM ' . Fget_ap_table('tproduct_attribute');	
		$str_query .= ' WHERE nid is not null ';
		foreach ($arr_tt as $tt)  {
			$str_query .= ' AND nid_attribute = ' . $tt;
		}
		$str_query .= ')';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_cat2($row_per_page,$curr_page)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as cat_ccode';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a,  ';
		$str_query .= Fget_ap_table('tcat_products').' as b  ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND b.ccode = "'.$nid.'"';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_sec($ccode_sec, $row_per_page, $curr_page, $type_sort)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if ($type_sort == 0) {
			$str_query .= ' ORDER BY a.fprice';
		} else if ($type_sort == 1) {
			$str_query .= ' ORDER BY a.fprice desc';
		} else if ($type_sort == 2) {
			$str_query .= ' ORDER BY a.cproducts+0';
		} else if ($type_sort == 3) {
			$str_query .= ' ORDER BY a.cproducts desc';
		} else if ($type_sort == 4) {
			$str_query .= ' ORDER BY a.nid';
		} else if ($type_sort == 5) {
			$str_query .= ' ORDER BY a.nid desc';
		} else if ($type_sort == 6) {
		}
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_sec_tt($ccode_sec, $row_per_page, $curr_page, $type_sort, $arr_tt)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if ($type_sort == 0) {
			$str_query .= ' ORDER BY a.fprice';
		} else if ($type_sort == 1) {
			$str_query .= ' ORDER BY a.fprice desc';
		} else if ($type_sort == 2) {
			$str_query .= ' ORDER BY a.cproducts+0';
		} else if ($type_sort == 3) {
			$str_query .= ' ORDER BY a.cproducts desc';
		} else if ($type_sort == 4) {
			$str_query .= ' ORDER BY a.nid';
		} else if ($type_sort == 5) {
			$str_query .= ' ORDER BY a.nid desc';
		} else if ($type_sort == 6) {
		}
		$str_query .= ' AND a.nid IN (SELECT DISTINCT nid_product as nid FROM ' . Fget_ap_table('tproduct_attribute');	
		$str_query .= ' WHERE nid is not null ';
		foreach ($arr_tt as $tt)  {
			$str_query .= ' AND nid_attribute = ' . $tt;
		}
		$str_query .= ')';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
	
function get_count_product_by_mat($nid_material_products)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    $str_query = ' SELECT a.nid';
    $str_query .= ' FROM ' . Fget_ap_table('tproducts') . ' as a ';  
    $str_query .= ' WHERE a.nid is not null ';
    $str_query .= ' AND a.nstatus =	1';
    if($nid_material_products!='')
    	$str_query .= ' AND a.nid_material_products = "'.$nid_material_products.'"';
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->num_rows();
	//exit($obj_result->num_rows()); 
}
function get_count_product_ctkm_by_cat($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.ncheck =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_product_by_cat($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_count_product_by_cat_het_hang($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nhethang != 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}		
function get_count_product_by_cat_mobile($ccode, $sort)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		if($sort!="") {
			if($sort==1)
				$str_query .= ' AND a.cnoi_bat = 1';
			elseif($sort==2)
				$str_query .= ' AND a.nnew = 1';
			elseif($sort==3)
				$str_query .= ' AND a.cbest_sell = 1';	
		} 
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_page_by_cat_mobile($ccode_cat, $row_per_page, $curr_page, $sort)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		
		if($sort!="") {
			if($sort==1)
				$str_query .= ' AND a.cnoi_bat = 1';
			elseif($sort==2)
				$str_query .= ' AND a.nnew = 1';
			elseif($sort==3)
				$str_query .= ' AND a.cbest_sell = 1';	
			elseif($sort==4) 
				$str_query .= ' ORDER BY a.fprice';
			elseif($sort==5)
				$str_query .= ' ORDER BY a.fprice desc';
		} else 
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_page_by_cat($ccode_cat, $row_per_page, $curr_page, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_page_by_cat_het_hang($ccode_cat, $row_per_page, $curr_page, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nhethang != 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_by_cat_filter($ccode,$price)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		if($price=='1')
			$str_query .= ' AND a.fprice < 5000000';
		else if($price=='2')
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price=='3')
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price=='4')
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		else if($price==7)
			$str_query .= ' AND a.cmoi = 1';
		else if($price==8)
			$str_query .= ' AND a.ctbh = 1';
		else if($price==9)
			$str_query .= ' AND a.c99 = 1';

		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_page_by_cat_filter($ccode_cat, $row_per_page, $curr_page, $price, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		else if($price==7)
			$str_query .= ' AND a.cmoi = 1';
		else if($price==8)
			$str_query .= ' AND a.ctbh = 1';
		else if($price==9)
			$str_query .= ' AND a.c99 = 1';
		
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_by_sec($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_count_product_by_sec_het_hang($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nhethang != 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}		
function get_count_product_by_sec_mobile($ccode, $sort)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		if($sort!="") {
			if($sort==1)
				$str_query .= ' AND a.cnoi_bat = 1';
			elseif($sort==2)
				$str_query .= ' AND a.nnew = 1';
			elseif($sort==3)
				$str_query .= ' AND a.cbest_sell = 1';	
		} 
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}		
function get_product_page_by_sec_mobile($ccode_sec, $row_per_page, $curr_page, $sort)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		
		if($sort!="") {
			if($sort==1)
				$str_query .= ' ORDER BY a.cnoi_bat';
			elseif($sort==2)
				$str_query .= ' ORDER BY a.nnew';
			elseif($sort==3)
				$str_query .= ' ORDER BY a.cbest_sell';
			elseif($sort==4) 
				$str_query .= ' ORDER BY a.fprice';
			elseif($sort==5)
				$str_query .= ' ORDER BY a.fprice desc';
		} else 
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}			
function get_product_page_by_sec($ccode_sec, $row_per_page, $curr_page, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_page_by_sec_het_hang($ccode_sec, $row_per_page, $curr_page, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nhethang != 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_by_sec_filter($ccode_sec,$price)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		else if($price==7)
			$str_query .= ' AND a.cmoi = 1';
		else if($price==8)
			$str_query .= ' AND a.ctbh = 1';
		else if($price==9)
			$str_query .= ' AND a.c99 = 1';

		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_page_by_sec_filter($ccode_sec, $row_per_page, $curr_page, $price, $sort_price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode_sec.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		else if($price==7)
			$str_query .= ' AND a.cmoi = 1';
		else if($price==8)
			$str_query .= ' AND a.ctbh = 1';
		else if($price==9)
			$str_query .= ' AND a.c99 = 1';
		
		if($sort_price=='0') 
			$str_query .= ' ORDER BY a.fprice+0 desc ';
		else if($sort_price=='1')
			$str_query .= ' ORDER BY a.fprice+0 asc ';
		else
			$str_query .= ' ORDER BY a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}		
function get_count_product_group($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tgroup_product').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$str_query .= ' AND a.nid_group_product = b.nid';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_group($ccode_group, $row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_group.'"';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_count_product_group_filter($ccode,$price)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tgroup_product').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_group_product = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';

		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}		
function get_product_group_filter($ccode_group, $row_per_page, $curr_page, $price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_group.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_doi_moi()
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		//$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		//$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_search($key)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND (a.cproducts like "%'.$key.'%"';
		$str_query .= ' OR a.ccode like "%'.$key.'%")';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_by_sec($ccode)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		//$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		//$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_by_group($ccode_group)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_group.'"';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_by_group_search($ccode_group,$key)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_group.'"';
		$str_query .= ' AND (a.cproducts like "%'.$key.'%"';
		$str_query .= ' OR a.ccode like "%'.$key.'%")';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_by_group_not_me($ccode_group,$nid_product)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid != "'.$nid_product.'"';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_group_product = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_group.'"';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_doi_moi_by_sec_search($ccode,$key)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		$str_query .= ' AND (a.cproducts like "%'.$key.'%"';
		$str_query .= ' OR a.ccode like "%'.$key.'%")';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_product_doi_moi_by_sec_not_me($ccode,$nid_product)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid != "'.$nid_product.'"';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cdoi_moi = 1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.ccode = "'.$ccode.'"';
		$str_query .= ' ORDER BY a.nid+0 desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_brand_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_brand_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_count_product_brand($ccode_brand)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tbrand_products').' as b ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_brand_products = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_brand.'"';
		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_brand($ccode_brand, $row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tbrand_products').' as d ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND a.nid_brand_products = d.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_brand.'"';
		$str_query .= ' ORDER BY  a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_brand_filter($ccode_group, $ccode_brand, $price)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tbrand_products').' as d, ';
		$str_query .= Fget_ap_table('tgroup_product').' as e ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.nid_brand_products = d.nid';
		$str_query .= ' AND a.nid_group_product = e.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_brand.'"';
		$str_query .= ' AND e.ccode = "'.$ccode_group.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_brand_filter($ccode_group, $ccode_brand, $row_per_page, $curr_page, $price)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tbrand_products').' as d, ';
		$str_query .= Fget_ap_table('tgroup_product').' as e ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.nid_brand_products = d.nid';
		$str_query .= ' AND a.nid_group_product = e.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_brand.'"';
		$str_query .= ' AND e.ccode = "'.$ccode_group.'"';
		if($price==1)
			$str_query .= ' AND a.fprice < 5000000';
		else if($price==2)
			$str_query .= ' AND (a.fprice >= 5000000 AND a.fprice <= 10000000)';
		else if($price==3)
			$str_query .= ' AND (a.fprice >= 10000000 AND a.fprice <= 15000000)';
		else if($price==4)
			$str_query .= ' AND (a.fprice >= 15000000 AND a.fprice <= 20000000)';
		else if($price==5)
			$str_query .= ' AND (a.fprice >= 20000000 AND a.fprice <= 30000000)';
		else if($price==6)
			$str_query .= ' AND a.fprice >= 30000000';
		$str_query .= ' ORDER BY  a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_cat($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_product_cat_tt($ccode, $arr_tt)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND b.ccode = "'.$ccode.'"';
		$str_query .= ' AND a.nid IN (SELECT DISTINCT nid_product as nid FROM ' . Fget_ap_table('tproduct_attribute');	
		$str_query .= ' WHERE nid is not null ';
		foreach ($arr_tt as $tt)  {
			$str_query .= ' AND nid_attribute = ' . $tt;
		}
		$str_query .= ')';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_count_product_cat2()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
	//	$str_query .= ' AND b.ccode = "'.$nid.'"';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_product_sec($ccode_sec)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_material_products = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_sec.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_product_sec_tt($ccode_sec, $arr_tt)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_material_products = b.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_sec.'"';
		$str_query .= ' AND a.nid IN (SELECT DISTINCT nid_product as nid FROM ' . Fget_ap_table('tproduct_attribute');	
		$str_query .= ' WHERE nid is not null ';
		foreach ($arr_tt as $tt)  {
			$str_query .= ' AND nid_attribute = ' . $tt;
		}
		$str_query .= ')';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_menu_left($nid_sec)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		if($nid_sec !='')	
		$str_query .= ' AND a.nid_material_products =	"'.$nid_sec.'"';	
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}
function Fview_price($number)
{
	return number_format($number).' đ';
}
function get_product_relate($nid_product,$nid_cat_products)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nstatus =	1';
		if($nid_product !='')
			$str_query .= ' AND a.nid != "'.$nid_product.'"';		
		if($nid_cat_products !='')
			$str_query .= ' AND a.nid_cat_products = "'.$nid_cat_products.'"';	
		$str_query .= ' ORDER BY  a.nid+0 desc ';	
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}

function get_menutop()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('ttopmenu').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' ORDER BY  a.cindex+0 asc ';	
		//$str_query .= ' LIMIT 0,8';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_product_detail($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	//$str_query .= ' AND a.nstatus =	1';	
	$str_query .= ' AND a.nid = '.$nid;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_detail_full($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
	//$str_query .= ' AND a.nstatus =	1';	
	$str_query .= ' AND a.nid = '.$nid;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function Bget_guest_online()
{
    $obj_helper =& get_instance();
    $session    = session_id();
    $time       = time();
    $tbl_name   = 'tguest_online';
    $time_check = $time - 300;
    $online     = 7;
    $obj_helper->db->where('csession_id', $session);
    $obj_result = $obj_helper->db->get($tbl_name);
    if ($obj_result->num_rows() == 0) {
        $data_log = array(
            'csession_id' => $session,
            'ctime_log' => $time
        );
        $obj_helper->db->insert($tbl_name, $data_log);
        $obj_helper->db->set('ntotal', 'ntotal+1', FALSE);
        $obj_helper->db->where('nid', 1);
        $obj_helper->db->update('total_visit');
    } else {
        $data_log = array(
            'ctime_log' => $time
        );
        $obj_helper->db->where('csession_id', $session);
        $obj_helper->db->update($tbl_name, $data_log);
    }
    $obj_result = $obj_helper->db->get($tbl_name);
    $online += $obj_result->num_rows();
    $obj_helper->db->where('ctime_log <', $time_check);
    $obj_helper->db->delete($tbl_name);
    return $online;
}
function Bget_total_vistis()
{
    $total = '0';
    $obj_helper =& get_instance();
    $obj_helper->db->where('nid', '1');
    $obj_result = $obj_helper->db->get('total_visit');
    $obj_result = $obj_result->row_array();
    $total      = $obj_result['ntotal'];
    return $total;
}
function get_products_mat_paging($nid_material_products,$ncurrent_page,$nrow_per_page) //note
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    $str_query = ' SELECT *';
    $str_query .= ' FROM ' . Fget_ap_table('tproducts').' as a';
    $str_query .= ' WHERE nid is not null ';
    $str_query .= ' AND nstatus = 1 ';
	if($nid_material_products !='')
		$str_query .= ' AND nid_material_products = "'.$nid_material_products.'"';
	$str_query .=  ' limit '. ($ncurrent_page -1 )* $nrow_per_page . ' , ' . $nrow_per_page;	
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}
function get_material_by_idl($nid_material)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    $str_query = ' SELECT *';
    $str_query .= ' FROM ' . Fget_ap_table('tmaterial_products') . ' as a ';
    $str_query .= ' WHERE a.nid is not null ';
   
     if($nid_material !='')
		$str_query .= ' AND a.nid	 ="'.$nid_material.'"';
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->row_array();
}	
function get_product_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nhome = 1';		
		$str_query .= ' LIMIT 0,8';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_bymat($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_material_products = "'.$nid.'"';		
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_bycat($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = "'.$nid.'"';		
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_hot_by_sec($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,1';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_product_noi_bat_by_sec($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.cnoi_bat = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,1';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}		
function get_product_bymat_home($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nhome = 1 ';
		$str_query .= ' AND a.ncheck != 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_bygroup_home($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid AND a.nid_group_product = d.nid';
		$str_query .= ' AND a.nid_group_product = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nhome = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 desc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_bygroup_home_mobile($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid AND a.nid_group_product = d.nid';
		$str_query .= ' AND a.nid_group_product = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nhome = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 desc ';
		$str_query .= ' LIMIT 0,4';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_bymat_home_mobile($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nhome = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,4';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
	/*
function get_product_km()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,30';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	*/
function get_count_product_thanh_ly()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nstatus_365 =	1';
		$str_query .= ' AND a.cthanh_ly = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
/*	
function get_product_thanh_ly($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nstatus_365 =	1';
		$str_query .= ' AND a.cthanh_ly = 1 ';	
		$str_query .= ' AND a.cdong_gia != 1 ';
		$str_query .= ' AND a.cflash != 1 ';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' ORDER BY a.fprice_sale asc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	*/
function get_product_thanh_ly()
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nstatus_365 =	1';
		$str_query .= ' AND a.cthanh_ly = 1 ';	
		$str_query .= ' AND a.cdong_gia != 1 ';
		$str_query .= ' AND a.cflash != 1 ';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' ORDER BY a.fprice_sale asc ';
		//$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_hang_moi()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nstatus_365 =	1';
		$str_query .= ' AND a.nnew = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}	
function get_product_hang_moi($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' AND a.nstatus_365 =	1';
		$str_query .= ' AND a.nnew = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}		
function get_count_product_km()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.ncheck = 1 ';
		$str_query .= ' AND a.cflash != 1 ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_product_ban_chay()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cbest_sell = 1 ';
		//$str_query .= ' AND a.cflash != 1 ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_product_dong_gia_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		//$str_query .= ' AND a.c9k = 1 ';	
		$str_query .= ' AND a.cdong_gia = 1 ';	
		//$str_query .= ' AND a.cflash != 1 ';	
		//$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.cindex+0 desc ';
		//$str_query .= ' LIMIT 0,12';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_product_with($price_bill)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		//$str_query .= ' AND a.c9k = 1 ';	
		$str_query .= ' AND a.cdong_gia = 1 ';		
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.cap_dung_bill <= '.$price_bill;
		//$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.cindex+0 desc ';
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_ctkm($ccode_cat, $row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND b.ccode = "'.$ccode_cat.'"';
		$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_km($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_ban_chay($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cbest_sell = 1 ';	
		//$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' ORDER BY a.ctime_update desc, a.cindex+0, a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_product_km_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.ddate02 desc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_km_relate($nid_product,$nid_cat_products)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		if($nid_product !='')
			$str_query .= ' AND a.nid != "'.$nid_product.'"';		
		if($nid_cat_products !='')
			$str_query .= ' AND a.nid_cat_products = "'.$nid_cat_products.'"';		
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.ddate02 desc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_deal_soc()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.cdeal_soc = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.ddate02 desc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_product_km_home_mobile()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' ORDER BY a.ddate02 desc ';
		$str_query .= ' LIMIT 0,4';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_flash_sale()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.cflash = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,6';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}

function get_product_hang_moi_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nnew = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';	
		$str_query .= ' AND a.cnoi_bat != 1 ';
		$str_query .= ' ORDER BY a.ctime_update+0 desc';
		$str_query .= ' LIMIT 0,12';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_count_product_xakho()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nnew = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_product_xakho($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nnew = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
function get_count_product_giamsoc()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cgiam_soc = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_product_giamsoc($row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.cgiam_soc = 1 ';	
		$str_query .= ' AND a.cflash != 1 ';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}	
	/*
	function get_product_hang_moi()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
		$str_query .= ' AND a.nhome = 1 ';	
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,12';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	*/
function get_product_new()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' ORDER BY a.nid desc ';
		$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_group_byid($nid) //theo id
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tgroup_product').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_product_brand_byid($nid) //theo id
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_product_cat_byid2($nid) //theo id
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_product_sec_byid2($nid) //theo id
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_news_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' ORDER BY cindex+0, a.nid+0 desc ';			
		$obj_result = $obj_helper->db->query($str_query);
		return $obj_result->result_array();
	}
function get_news_all_by_cat($nid_cat)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		if($nid_cat != '')
			$str_query .= ' AND a.nid_cat_news = '.$nid_cat;		
		$str_query .= ' ORDER BY cindex+0, a.nid+0 desc ';			
		$obj_result = $obj_helper->db->query($str_query);
		return $obj_result->result_array();
	}
function get_news_latest_by_cat($nid_cat)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as code_cat';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a, ';
		$str_query .= Fget_ap_table('tcat_news').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_news = b.nid';		
		$str_query .= ' AND a.nid_cat_news = '.$nid_cat;	
		$str_query .= ' ORDER BY a.cindex+0, a.nid+0 desc ';			
		$str_query .= ' LIMIT 0,5';	
		$obj_result = $obj_helper->db->query($str_query);
		return $obj_result->result_array();
	}
/*	
function get_news_home_by_cat($nid_cat)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as code_cat';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a, ';
		$str_query .= Fget_ap_table('tcat_news').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.chome = 1';
		$str_query .= ' AND a.nid_cat_news = b.nid';	
		$str_query .= ' AND a.nid_cat_news = '.$nid_cat;		
		$str_query .= ' ORDER BY a.cindex+0, a.nid+0 desc ';			
		$str_query .= ' LIMIT 0,4 ';
		$obj_result = $obj_helper->db->query($str_query);
		return $obj_result->result_array();
	}
	*/
	function get_cat_news_name($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_news').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccat_news'];
	}
function get_news_home()
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.chome = 1';	
		$str_query .= ' ORDER BY a.nid+0 desc, cindex+0 ';			
		$str_query .= ' LIMIT 0,4 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}		
function get_news_home_by_cat($nid_cat)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.chome = 1';
		//$str_query .= ' AND a.nid IN (SELECT nid_news as nid FROM ' . Fget_ap_table('tnews_subsite') . ' where nid_subsite  = "' . $nid_subsite . '") ';
		if($nid_cat != '')
			$str_query .= ' AND a.nid_cat_news = '.$nid_cat;	
		$str_query .= ' ORDER BY a.nid+0 desc, cindex+0 ';			
		$str_query .= ' LIMIT 0,4 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}		
function get_product_mat()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' ORDER BY a.nid desc ';
		$str_query .= ' LIMIT 0,3';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_cat_product_bymat($nid_sec)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		//$str_query .= ' AND a.nspecial =	1';	
		if($nid_sec !='')	
		$str_query .= ' AND a.nid_material_products =	"'.$nid_sec.'"';	
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		//$str_query .= ' LIMIT 0,10';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}
function get_cat_product_bymat_home($nid_sec)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' AND a.nspecial =	1';	
		if($nid_sec !='')	
		$str_query .= ' AND a.nid_material_products =	"'.$nid_sec.'"';	
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		$str_query .= ' LIMIT 0,5';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}
function get_product_hot($limit)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' AND a.ncheck = 1';
		$str_query .= ' ORDER BY a.nid desc ';
		$str_query .= ' LIMIT 0, ' . $limit;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_product_preorder($limit)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' AND a.cdat_truoc = 1';
		$str_query .= ' ORDER BY a.nid desc ';
		$str_query .= ' LIMIT 0, ' . $limit;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_img_by_product($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_images').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	//$str_query .= ' AND a.nstatus =	1';
	$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$str_query .= ' ORDER BY a.nid desc ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}

function get_product_in_array($array)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		//$str_query .= ' AND a.nid_material_products = "'.$nid.'"';	
		$str_query .= ' AND a.nstatus = 1 ';
	//	$str_query .= ' AND a.ncheck = 1 ';	
		$str_query .= ' AND a.nid IN('.$array.')';	
		
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$str_query .= ' LIMIT 0,12';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_code_sale_member($nid_code, $nid_member)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_sale_member').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	//$str_query .= ' AND a.nstatus =	1';		
	$str_query .= ' AND a.nid_code = '.$nid_code;
	$str_query .= ' AND a.nid_member = '.$nid_member;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}	
function get_code_sale_detail($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_sale').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';	
	//$str_query .= ' AND a.nid != 1';	
	$str_query .= ' AND a.nid = '.$nid;
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_code_sale_home()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_sale').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';	
	$str_query .= ' AND a.chome = 1';
	$str_query .= ' LIMIT 0,3';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_code_sale_all()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_sale').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';	
	//$str_query .= ' AND a.nid != 1';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_code_sale_bycode($code)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_sale').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';	
	//$str_query .= ' AND a.nid != 1';	
	$str_query .= ' AND a.ccode = "' . $code . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_sec_by_brand($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tmaterial_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_brand_products = '.$nid;
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_cat_by_sec($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_material_products = '.$nid;
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_attribute_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tattribute').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_brand_product_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_brand_product_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_group_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tgroup_product').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_group_product_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tgroup_product').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_group_product_home()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tgroup_product').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.chome = 1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_brand_product_by_group($ccode)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT DISTINCT a.nid, a.ccode, a.cbrand_products';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' AND a.nid = b.nid_brand_products ';
		
		$str_query .= ' AND b.nid IN (SELECT DISTINCT nid_material_products as nid FROM ' . Fget_ap_table('tproducts').' as c, ';	
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE c.nid_group_product = d.nid ';
		$str_query .= ' AND d.ccode = "' . $ccode . '"';
		$str_query .= ')';
		
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}	
function get_brand_product_by_group_home($ccode)
{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT DISTINCT a.nid, a.ccode, a.cbrand_products';
		$str_query .= ' FROM '.Fget_ap_table('tbrand_products').' as a, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as b ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';	
		$str_query .= ' AND a.nid = b.nid_brand_products ';
		
		$str_query .= ' AND b.nid IN (SELECT DISTINCT nid_material_products as nid FROM ' . Fget_ap_table('tproducts').' as c, ';	
		$str_query .= Fget_ap_table('tgroup_product').' as d ';
		$str_query .= ' WHERE c.nid_group_product = d.nid ';
		$str_query .= ' AND d.ccode = "' . $ccode . '"';
		$str_query .= ')';
		
		$str_query .= ' ORDER BY a.cindex+0 asc, a.nid desc ';	
		$str_query .= ' LIMIT 0,8';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
}	
function get_count_search_brand($keyword, $ccode_group, $ccode_brand)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tbrand_products').' as d, ';
		$str_query .= Fget_ap_table('tgroup_product').' as e ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.nid_brand_products = d.nid';
		$str_query .= ' AND a.nid_group_product = e.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_brand.'"';
		$str_query .= ' AND e.ccode = "'.$ccode_group.'"';
		
		$str_query .= ' AND (a.cproducts like "%'.$keyword.'%"';
		$str_query .= ' OR a.ccode like "%'.$keyword.'%")';
		/*
		$str = explode(' ',$keyword);
		for($i=0;$i<count($str);$i++) {
			$str_query .= ' AND (a.cproducts like "%'.$str[$i].'%"';
			$str_query .= ' OR a.ccode like "%'.$str[$i].'%")';
		}*/

		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_product_brand_search($keyword, $ccode_group, $ccode_brand, $row_per_page, $curr_page)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c, ';
		$str_query .= Fget_ap_table('tbrand_products').' as d, ';
		$str_query .= Fget_ap_table('tgroup_product').' as e ';
		
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid';
		$str_query .= ' AND a.nid_material_products = c.nid';
		$str_query .= ' AND c.nid_brand_products = d.nid';
		$str_query .= ' AND a.nid_group_product = e.nid';
		$str_query .= ' AND d.ccode = "'.$ccode_brand.'"';
		$str_query .= ' AND e.ccode = "'.$ccode_group.'"';
		
		$str_query .= ' AND (a.cproducts like "%'.$keyword.'%"';
		$str_query .= ' OR a.ccode like "%'.$keyword.'%")';
		/*
		$str = explode(' ',$keyword);
		for($i=0;$i<count($str);$i++) {
			$str_query .= ' AND (a.cproducts like "%'.$str[$i].'%"';
			$str_query .= ' OR a.ccode like "%'.$str[$i].'%")';
		}*/
		
		$str_query .= ' ORDER BY  a.nid+0 desc ';
		$str_query .= ' LIMIT '.($curr_page -1)*$row_per_page.', '.$row_per_page;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();	
	}
function get_count_color($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tcolor').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_product = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->num_rows();
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
function get_color_detail($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcolor').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	if($nid !='')
		$str_query .= ' AND a.nid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_8_product_random()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.nid';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus =	1';
	$str_query .= ' AND a.cflash = 1';	
	$str_query .= ' ORDER BY RAND() ';	
	$str_query .= ' LIMIT 0,8';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_flash_today($time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tflash').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.ctime = "' . $time . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_flash_byid($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tflash').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_search_product($keyword)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str = explode(' ',$keyword);
		for($i=0;$i<count($str);$i++) {
			$str_query .= ' AND (a.cproducts like "%'.$str[$i].'%"';
			$str_query .= ' OR a.ccode like "%'.$str[$i].'%")';
		}
		/*
		$str_query .= ' AND (a.ccode like "%'.$keyword.'%"';
		$str_query .= ' OR a.cproducts like "%'.$keyword.'%")';
		*/
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';	
		$str_query .= ' LIMIT 0,20';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_img_kh()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tcustomer_img').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		//$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_customer()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tcustomer').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		//$str_query .= ' AND a.nstatus =	1';
		//$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_color_lv2($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcolor_lv2').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	if($nid !='')
		$str_query .= ' AND a.nid_color = "' . $nid . '"';
	$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_color_lv2_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcolor_lv2').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_comment_by_news($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcomment').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$str_query .= ' AND a.cpage = 2 ';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_comment_by_product($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tcomment').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$str_query .= ' AND a.cpage = 1 ';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_reply_by_comment($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('treply').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_comment = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_rating_by_product($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('trating').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_rating_by_product_limit($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('trating').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_product = "' . $nid . '"';
	$str_query .= ' ORDER BY a.ctime desc ';
	$str_query .= ' LIMIT 0,5 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_schedule_curr($time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tschedule').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nstatus = 1 ';
	$str_query .= ' AND a.ctime = "' . $time . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_province_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tprovince').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_district_by_province($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tdistrict').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		//$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_province = ' . $nid;
		$str_query .= ' ORDER BY a.cindex+0, a.nid desc ';		
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_member_by_userid($cid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.cid = "' . $cid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_member_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
	$str_query .= ' WHERE a.nid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_bid_win_by_member($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid_win').' as a ';
	$str_query .= ' WHERE a.nid_member = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_bid_win_by_product_bid($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid_win').' as a ';
	$str_query .= ' WHERE a.nid_product_bid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_bid_log_by_id_today($nid,$time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_bid_log').' as a ';
	$str_query .= ' WHERE a.nid_product_bid = "' . $nid . '"';
	$str_query .= ' AND a.ctime_search = "' . $time . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_bid_win_by_product_bid_today($nid,$time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid_win').' as a ';
	$str_query .= ' WHERE a.nid_product_bid = "' . $nid . '"';
	$str_query .= ' AND a.ctime_search = "' . $time . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function lay_dau_gia_cao_nhat_theo_sp($nid,$time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid').' as a ';
	$str_query .= ' WHERE a.nid_product = "' . $nid . '"';
	$str_query .= ' AND a.ctime_search = "' . $time . '"';
	$str_query .= ' ORDER BY a.cprice desc ';
	$str_query .= ' LIMIT 0,1';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function lay_dau_gia_cao_nhat_theo_sp_bid($nid,$time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid').' as a ';
	$str_query .= ' WHERE a.nid_product_bid = "' . $nid . '"';
	$str_query .= ' AND a.ctime_search = "' . $time . '"';
	$str_query .= ' ORDER BY a.cprice desc ';
	$str_query .= ' LIMIT 0,1';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function lay_dau_gia_theo_sp($nid,$time)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tbid').' as a ';
	$str_query .= ' WHERE a.nid_product_bid = "' . $nid . '"';
	$str_query .= ' AND a.ctime_search = "' . $time . '"';
	$str_query .= ' ORDER BY a.cprice desc ';
	$str_query .= ' LIMIT 0,5';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_member($cid, $cpassword)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT *';
	$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.cid = "' . $cid . '"';
	if($cpassword != "anmytest")
		$str_query .= ' AND (a.cpassword = "' . md5($cpassword) . '")';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_random_bot($nid_bot)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.nid';
	$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.ctype = 0 ';
	$str_query .= ' AND a.nid != "' . $nid . '"';
	$str_query .= ' ORDER BY RAND() ';	
	$str_query .= ' LIMIT 0,1';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_bid_bot_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_bid').' as a ';
	$str_query .= ' WHERE a.nid = "' . $nid . '"';
	$str_query .= ' AND a.nstatus = 1 ';
	$str_query .= ' AND a.cbid = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_bid_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_bid').' as a ';
	$str_query .= ' WHERE a.nid = "' . $nid . '"';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_bid_by_product($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_bid').' as a ';
	$str_query .= ' WHERE a.nid_product = "' . $nid . '"';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_product_bid_by_date($ctime)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproduct_bid').' as a ';
	$str_query .= ' WHERE a.ctime_search = "' . $ctime . '"';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}	
function get_order_by_member($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('torder').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid_member = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_order_by_code_and_id($ccode, $cid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('torder').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.ccode = "' . $ccode . '"';
	$str_query .= ' AND (a.nphone = "' . $cid . '"';
	$str_query .= ' OR a.cemail = "' . $cid . '")';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_order_by_id($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('torder').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.nid = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_order_status_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('torder_status').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus = 1';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_order_detail_by_order($nid)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('torder_detail').' as a ';
	$str_query .= ' WHERE a.nid_order = "' . $nid . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_point_list($nid_member, $date_str)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tpoint_list').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_member = "'.$nid_member.'"';
		$str_query .= ' AND a.ctime_search = "'.$date_str.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_product_doi_qua()
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.cdoi_qua = 1';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->result_array();
}
function get_code_vqmm($ccode)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tcode_vqmm').' as a ';
	$str_query .= ' WHERE a.ccode = "' . $ccode . '"';
	$str_query .= ' AND a.nstatus = 1 ';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_dong_gia_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tdong_gia').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_dong_gia_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tdong_gia').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}		
function get_product_by_dong_gia($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*, b.ccode as ccode_cat, c.ccode as ccode_sec ';
		$str_query .= ' FROM '.Fget_ap_table('tproducts').' as a, ';
		$str_query .= Fget_ap_table('tcat_products').' as b, ';
		$str_query .= Fget_ap_table('tmaterial_products').' as c ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' AND a.nid_cat_products = b.nid AND a.nid_material_products = c.nid ';
		$str_query .= ' AND a.cdong_gia = 1';
		$str_query .= ' AND a.cprice_dong_gia != ""';
		$str_query .= ' AND a.nid_dong_gia = "' . $nid . '"';
		$str_query .= ' ORDER BY a.cindex+0 desc, a.nid desc ';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_mail_register($mail)
{
	$obj_helper =& get_instance(); 
	$obj_helper->load->database();	
	$str_query = ' SELECT a.* ';
	$str_query .= ' FROM '.Fget_ap_table('tregister').' as a ';
	$str_query .= ' WHERE a.nid is not null ';
	$str_query .= ' AND a.cemail = "' . $mail . '"';
	$obj_result = $obj_helper->db->query($str_query);  
	return $obj_result->row_array();
}
function get_member_password($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "' . $nid . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cpassword'];
	}
function get_order_tmp_by_ip($cip,$date) {
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('torder').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus = 0 ';
		$str_query .= ' AND a.cip = "' . $cip . '"';
		$str_query .= ' AND a.ddate01 = "' . $date . '"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
}
function webpConvert2($file, $compression_quality = 80)
{
    // check if file exists
    if (!file_exists($file)) {
        return false;
    }
    $file_type = exif_imagetype($file);
    //https://www.php.net/manual/en/function.exif-imagetype.php
    //exif_imagetype($file);
    // 1    IMAGETYPE_GIF
    // 2    IMAGETYPE_JPEG
    // 3    IMAGETYPE_PNG
    // 6    IMAGETYPE_BMP
    // 15   IMAGETYPE_WBMP
    // 16   IMAGETYPE_XBM
	
	/*
	$jpg=imagecreatefromjpeg('filename.jpg');
	$w=imagesx($jpg);
	$h=imagesy($jpg);
	$webp=imagecreatetruecolor($w,$h);
	imagecopy($webp,$jpg,0,0,0,0,$w,$h);
	imagewebp($webp, 'filename.webp', 80);
	imagedestroy($jpg);
	imagedestroy($webp);
	*/
	
    $output_file =  $file . '.webp';
    if (file_exists($output_file)) {
        return $output_file;
    }
    if (function_exists('imagewebp')) {
        switch ($file_type) {
            case '1': //IMAGETYPE_GIF
                $image = imagecreatefromgif($file);
                break;
            case '2': //IMAGETYPE_JPEG
                $image = imagecreatefromjpeg($file);
                break;
            case '3': //IMAGETYPE_PNG
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;
            case '6': // IMAGETYPE_BMP
                $image = imagecreatefrombmp($file);
                break;
            case '15': //IMAGETYPE_Webp
               return false;
                break;
            case '16': //IMAGETYPE_XBM
                $image = imagecreatefromxbm($file);
                break;
            default:
                return false;
        }
        // Save the image
        $result = imagewebp($image, $output_file, $compression_quality);
        if (false === $result) {
            return false;
        }
        // Free up memory
        imagedestroy($image);
        return $output_file;
    } elseif (class_exists('Imagick')) {
        $image = new Imagick();
        $image->readImage($file);
        if ($file_type === "3") {
            $image->setImageFormat('webp');
            $image->setImageCompressionQuality($compression_quality);
            $image->setOption('webp:lossless', 'true');
        }
        $image->writeImage($output_file);
        return $output_file;
    }
    return false;
}