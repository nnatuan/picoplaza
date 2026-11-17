<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class home_model extends Model
{
	
function home_model() 
	{	
		parent::Model();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An- an_hm87@tokaban.com
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
function get_listview()
	{		
		$str_query = ' SELECT * FROM '.Vproduct();
		$str_query .= ' WHERE nid is not null ';	
		$str_query .= ' ORDER BY ddate02 desc,nid desc';	
		$str_query .= ' LIMIT 0,12 ';	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}

function get_detail_byid($nid)
{
	$str_query = ' SELECT * FROM  crm_tnews where nid = '. $nid;	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->row_array();
}
/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	
	

}
