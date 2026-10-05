<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class payment_model extends Model
{
	
	var $m_table_name = ''; // ten table can su dung trong model.
	
function payment_model() 
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
function insert_order($arr_data)
	{
		$this->db->insert($this->m_table_name, $arr_data);		
	}

function insert_order_detail($arr_data)
	{
		$this->db->insert(Fget_ap_table('torder_detail'), $arr_data);		
	}

//
//
//
function update_bynid($num_nid, $arr_data)
	{
		$this->db->where('nid', $num_nid);
		$this->db->update($this->m_table_name, $arr_data);
	}

// Cach truy xuat gia tri tra ve $obj_row['nid']
function get_byid($nid)
	{
		$this->db->where('nid',$nid);
		$obj_result = $this->db->get($this->m_table_name); 
		return $obj_result->row_array();
	}

// Cach truy xuat gia tri tra ve $obj_row['nid']
function get_byid_customer($nid)
	{
		$this->db->where('nid',$nid);
		$obj_result = $this->db->get(Fget_ap_table('tcustomer')); 
		return $obj_result->row_array();
	}

/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	
	

}
