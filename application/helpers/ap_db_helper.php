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
   
/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date	: 2009/07/23
 * @description		: Gan gia tri cookie voi mot tu khoa tuong ung
 * 					: 	Yeu cau phai co 2 thong so tokaban session: 
 * 					: 	1 - sesion_working.
 * 					: 	2 - session_nid_user. 
 * @access	        : public
 * @param string	: $str_cookie_name		: Key of dbcookie
 * 					: $str_cookie_value		: Value of dbcookie key.
 *
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function dbset_cookie($str_cookie_name, $str_cookie_value) 
	{
		$obj_helper =& get_instance();
		$obj_helper->load->database();
			
		// Xac dinh cac thong tin tu thu vien session
		$num_nid_session		= Fget_userdata('session_working');
		$num_nid_user 			= Fget_userdata('session_nid_user');
			
		if ($num_nid_user == 0)
		{
			//
			// Truong hop la khach, dung sessionid de xac dinh thong tin cookie
			//
			$obj_helper->db->where('cid_session',$num_nid_session);
			$obj_helper->db->where('ckey',$str_cookie_name);
			$obj_result = $obj_helper->db->get(Fget_ap_table2('tcookie'));
			if ($obj_result->num_rows() >= 1)
			{
				//
				// Truong hop ton tai dong thong tin cookie tuong ung
				//
				$arr_data =	array(								
					'cvalue' 			=> $str_cookie_value,
					);
				$obj_helper->db->where('cid_session',$num_nid_session);
				$obj_helper->db->where('ckey',$str_cookie_name);	
				$obj_helper->db->update(Fget_ap_table2('tcookie'), $arr_data);
			}
			else
			{
				//
				// Truong hop ton tai dong thong tin cookie tuong ung
				//
				$arr_data =	array(								
					'cid_session' 		=> $num_nid_session,
					'nid_user' 			=> 0,
					'ckey' 				=> $str_cookie_name,
					'cvalue' 			=> $str_cookie_value,
					'cstatus' 			=> 1,
					);
				$obj_helper->db->where('cid_session',$num_nid_session);
				$obj_helper->db->where('ckey',$str_cookie_name);	
				$obj_helper->db->insert(Fget_ap_table2('tcookie'), $arr_data);
			}
		}	
		else
		{
			// Truong hop la thanh vien, dung nid_user de xac dinh thong tin cookie
			$obj_helper->db->where('nid_user',$num_nid_user);
			$obj_helper->db->where('ckey',$str_cookie_name);
			$obj_result = $obj_helper->db->get(Fget_ap_table2('tcookie'));
			if ($obj_result->num_rows() >= 1)
			{
				// Truong hop ton tai dong thong tin cookie tuong ung
				$arr_data =	array(								
					'cvalue' 			=> $str_cookie_value,
					);
				$obj_helper->db->where('nid_user',$num_nid_user);
				$obj_helper->db->where('ckey',$str_cookie_name);	
				$obj_helper->db->update(Fget_ap_table2('tcookie'), $arr_data);
			}
			else
			{
				// Truong hop ton tai dong thong tin cookie tuong ung
				$arr_data =	array(								
					'cid_session' 		=> $num_nid_session,
					'nid_user' 			=> $num_nid_user,
					'ckey' 				=> $str_cookie_name,
					'cvalue' 			=> $str_cookie_value,
					'cstatus' 			=> 1,
					);
				$obj_helper->db->where('nid_user',$num_nid_session);
				$obj_helper->db->where('ckey',$str_cookie_name);	
				$obj_helper->db->insert(Fget_ap_table2('tcookie'), $arr_data);
			}
		}
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date	: 2009/07/23
 * @description		: Truy xuat mot gia tri cookie tuong ung.
 * 					: 	Yeu cau phai co 2 thong so tokaban session: 
 * 					: 	1 - sesion_working.
 * 					: 	2 - session_nid_user.  
 * @access	        : public
 * @param string	: $str_cookie_name		: Key of dbcookie
 *
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */				
function dbget_cookie($str_cookie_name)
{
	$obj_helper =& get_instance(); 	
	$obj_helper->load->database();
	// Xac dinh cac thong tin tu thu vien session
	$num_nid_session		= Fget_userdata('session_working');
	$num_nid_user 			= Fget_userdata('session_nid_user');
	
	if ($num_nid_user == 0)
	{	
		//
		// Truong hop la khach, dung sessionid de xac dinh cookie.
		// Trong truong hop khong co thi tra ve gia tri rong.
		//
		$obj_helper->db->where('cid_session',$num_nid_session);
		$obj_helper->db->where('ckey',$str_cookie_name);
		$obj_result = $obj_helper->db->get(Fget_ap_table2('tcookie'));
		if ($obj_result->num_rows() >= 1)
		{
			$obj_row = $obj_result->row_array();
			return $obj_row['cvalue'];
		}
		else
		{
			return '';
		}			
	}
	else
	{
		// Truong hop la khach, dung sessionid de xac dinh cookie.
		// Trong truong hop khong co thi tra ve gia tri rong.
		// Truong hop la khach, dung sessionid de xac dinh cookie.
		// Trong truong hop khong co thi tra ve gia tri rong.
		$obj_helper->db->where('nid_user',$num_nid_user);
		$obj_helper->db->where('ckey',$str_cookie_name);
		$obj_result = $obj_helper->db->get(Fget_ap_table2('tcookie'));
		if ($obj_result->num_rows() >= 1)
		{
			$obj_row = $obj_result->row_array();
			return $obj_row['cvalue'];
		}
		else
		{
			return '';
		}
	}
}


//get indentity
function dbget_identity()
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		
		$str_query = 'SELECT @@IDENTITY as identity' ;
		$obj_result = $obj_helper->db->query($str_query);
		foreach ($obj_result->result() as $row)
		   {
			  return $row->identity;
		   }	
	}
/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : Lay ngay hien tai
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function dbget_current_date()
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		
		$str_query = 'SELECT CURRENT_DATE() AS system_date' ;		
		$obj_result = $obj_helper->db->query($str_query);
		
	   	foreach ($obj_result->result() as $row)
			  return $row->system_date;
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : Xac dinh thong tin id cua user khi xac dinh thong tin userid va password tuong ung
 * @access	        : public
 * @param string	: 
 * @Input			: $str_table_name 	: ten table can kiem tra.
 * 					: $str_field_name	: ten truong can kiem tra.
 * 					: $str_field_value	: gia tri can kiem tra.
 * 					: $str_event		: edit : Sua thong tin. addnew : Them thong tin.
 * 				    : 
 * @return string	: 'FALSE'			: Trung khoa.
 * 					: 'TRUE'	 		: Thong tin hop le.
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function fbcheck_exists_key_addnew($str_table_name, $str_field_name, $str_field_value)
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		
		// Luu y cach su dung thu vien ham DB va cach khai bao menh de where.
		$obj_helper->db->where($str_field_name,$str_field_value);
		$obj_result = $obj_helper->db->get(Fget_ap_table($str_table_name));
		if ($obj_result->num_rows() <= 0)
			return  TRUE;
					
		// return false neu thong tin hop le.
		return FALSE; 		
	}

//
//
//	
function fbcheck_exists_key_update($str_table_name, $str_field_name, $str_field_value, $str_nid)
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		
		$str_db_value='';
		// truy xuat du lieu trong db theo ID.
		// xac dinh gia tri key theo truong.
		$obj_helper->db->where($str_field_name,$str_field_value);
		$obj_result = $obj_helper->db->get(Fget_ap_table($str_table_name));
		if ($obj_result->num_rows() <= 0)
			return  TRUE;
		else
		{
			$obj_row = $obj_result->row_array();			
			$str_db_value = $obj_row['nid'];
			
			if (trim($str_db_value)==trim($str_nid))
				return TRUE;
			else			
				return FALSE;	
		}
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : 
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function dbget_obj_from_tablename($tableviewname='')
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		
		// Xac dinh ten truong can hien thi theo language dang su dung.
		$field_name = Fget_userdata('session_user_language');
		
		$str_query  = 'SELECT nid as nid, ';
		$str_query .= $field_name . ' as cvalue  ';
		$str_query .= ' FROM ' . Fget_ap_table($tableviewname). ' ' ;
		$str_query .= ' order by nid  ';
				
		$obj_result = $obj_helper->db->query($str_query);
		return $obj_result->result_array();	   	
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : 
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function dbget_obj_month_list()
	{
		return dbget_obj_from_tablename('vmonth');
	}	

/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : 
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function dbget_obj_use_status_list()
	{
		return dbget_obj_from_tablename('vusestatus');		
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: 
 * @finished date 	: 2009/04/08.
 * @Description	    : 
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function dbcount_img_product($nid_product)
	{
		$obj_helper =& get_instance(); 	
		$obj_helper->load->database();
		$obj_helper->db->where('nid_products',$nid_product);
		$obj_result = $obj_helper->db->get(Fget_ap_table('timage_products'));
		return $obj_result->num_rows();		
	}				