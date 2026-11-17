<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class order_complete_model extends Model 
{
	
	var $m_table_name = ''; // ten table can su dung trong model.
	
function order_complete_model() 
	{	
		parent::Model();
		$this->m_table_name = Fget_ap_table('torder'); // gan ten table su dung trong database cho bien lay table su dung trong model
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

// Cach truy xuat gia tri tra ve $obj_row['nid']
function get_byid($nid)
	{
		$this->db->where('nid',$nid);
		$obj_result = $this->db->get($this->m_table_name); 
		return $obj_result->row_array();
	}
	
function get_order_detail($nid)
	{
		$this->db->where('nid_order',$nid);
		$obj_result = $this->db->get(Fget_ap_table('torder_detail')); 
		return $obj_result->result_array();
	}


/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	
	

}
