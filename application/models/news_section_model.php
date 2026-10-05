<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class news_section_model  extends Model
{ 
	
function news_section_model() 
	{	
		parent::Model();
		$this->m_table_name = Fget_ap_table('tnews');
		$this->m_view_name 	= Vnew_view();

	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87
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
function get_listview($str_where_clause, $str_order_by_clause,$oder_by ='', $num_row_per_page =0, $num_current_page =0, $num_total_row=0)
	{		
		$str_query = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query = $str_query . ' ' . $str_where_clause . ' ';
		
		if (trim($str_order_by_clause)!= '')
		{
			$str_query = $str_query . ' order by ddate01 desc, nid desc ';
		}
		//if (trim($oder_by)!= '')
//		{
//			$str_query .= $oder_by ;
//		}
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}
		//echo $str_query;
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - an_hm87
 * @finished date	: 2009/011/09
 * @description		: Tra ve detail theo id
 * @access	        : public
 *
 * @param string	: $nid
 * 					: 
 * @return string	: $obj_result->row_array() : 
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */

function get_detail_byid($nid)
{
	$str_query = ' SELECT * FROM  '.$this->m_table_name.' where nid = '. $nid;	
		$obj_result = $this->db->query($str_query); 
		return $obj_result->row_array();
}

function count_record($where_string)
	{	
		$str_query 	 = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query	.= $where_string;
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
		
	
	
//		$this->db->where('cshow','1');	
	//	$obj_result = $this->db->get($this->m_table_name); 
		//return $obj_result->num_rows();
	}
/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	
	

}
