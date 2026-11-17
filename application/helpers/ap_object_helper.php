<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokaban R&D Team.
 * 				:  
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */ 

function Obj_get_menu_list($str_nid_user='') 
	{ 
		$str_sql=' SELECT * FROM ' . Fget_ap_table('tmenu') . ' WHERE cdel=0 AND cmenu<>"" ORDER BY cindex asc ';
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
		$obj_results = $obj_helper->db->query($str_query);
		$obj_results 	= $obj_results->result_array();
		
		return 	$obj_results;
	}

function Obj_get_user_permission_list($str_nid_user='') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		
		$str_query = ' SELECT view.* FROM ' . Vuser_view()  ; 
		$obj_results = $obj_helper->db->query($str_query);
		$obj_results 	= $obj_results->result_array();
		
		return 	$obj_results;
	}
	    
/**
 *-------------------------------------------------------------------
 * @creator 		: 
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
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tuser'));
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
 * @creator 		: 
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
		$obj_helper->db->where('customerid',$str_userid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcustomer'));
		if ($obj_result->num_rows() <= 0)
			return 'invalid';
			
		
		// kiem tra password	
		// return 'invalid_password';
		$obj_helper->db->where('cpassword',$str_password);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcustomer'));
		$obj_results 	= $obj_result->result_array();		
		if ($obj_result->num_rows() <= 0)
			return 'invalid';
			
		// Kiem tra userid va password	
		// return 'invalid_user_password';		
		$obj_helper->db->where('customerid',$str_userid);
		$obj_helper->db->where('cpassword',$str_password);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcustomer'));
		
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
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcustomer'));		
		return  $obj_result->row_array();
	}

//
// Da duoc kiem tra
//
function Obj_get_password_normal()
	{
		return 'tokabanwithyourpassword';		
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
function Obj_get_material_product_list($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->order_by("cindex", "asc"); 
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tmaterial_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_cat_product_list($material = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($material != '')
			$obj_helper->db->where('nid_material_products',$material);
		$obj_helper->db->order_by("cindex", "asc");
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}


function Obj_get_material_product_byid($nid = '') 
	{ 
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid',$nid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tmaterial_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_cat_product_byid($nid = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($nid != '')
			$obj_helper->db->where('nid',$nid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tcat_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function Obj_get_brand_product_byid($nid = '') 
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		if($nid != '')
			$obj_helper->db->where('nid',$nid);
		$obj_result 	= $obj_helper->db->get(Fget_ap_table('tbrand_products')); 
		$obj_results 	= $obj_result->result_array();
		return 	$obj_results;
	}

function dbcount_product_sec($nid)
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		$obj_helper->db->where('nid_material_products',$nid);
		$obj_result = $obj_helper->db->get(Fget_ap_table('tproducts'));
		return $obj_result->num_rows();		
	}

function dbcount_product_cat($nid)
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		$obj_helper->db->where('nid_cat_products',$nid);
		$obj_result = $obj_helper->db->get(Fget_ap_table('tproducts'));
		return $obj_result->num_rows();		
	}
function Oget_news_img($id_news)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tnews_gallery_detail').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_product = "'.$id_news.'"';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function Oget_wood_img($id_news)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tgallery_detail').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_product = "'.$id_news.'"';	
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function Oget_sec_wood()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tsection_wood').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nstatus = "1"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	

function Oget_mod_cat_wood($nid_sec = '')
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.*';
		$str_query .= ' FROM '.Fget_ap_table('tcat_wood').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		if($nid_sec != '')
			$str_query .= ' AND a.nid_section_news = '.$nid_sec;
		$str_query .= ' AND a.nstatus =	1';
		$str_query .= ' ORDER BY a.cindex+0 asc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function Bget_article($nid)
	{		
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();
		$obj_helper->db->where('nid',$nid);
		$obj_result = $obj_helper->db->get('tarticle');
		$obj_result = $obj_result->row_array();		
		return $obj_result;
	}	
		