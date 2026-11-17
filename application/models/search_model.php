<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class search_model extends Model
{
	
function search_model() 
	{	
		$this->m_table_name = Fget_ap_table('tnews');
		$this->m_view_name 	= Vnew_view();
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
 function get_count_list_product_search($where_str)
	{		
		$str_query = ' SELECT nid FROM '.Vnew_view();
		$str_query .= ' WHERE nid is not null ';
		if($where_str != '')
			$str_query .= $where_str;
		else
		{
			if(Fget_userdata('where_str') != '')
				$str_query .= Fget_userdata('where_str');
			else
				$str_query .= ' AND nid is null';
		}
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
 
function get_list_product_search($where_str,$num_total_row = 0,$num_current_page,$num_row_per_page)
	{
		$str_query = ' SELECT * FROM '.Vnew_view();
		$str_query .= ' WHERE nid is not null ';
		if($where_str != '')
			$str_query .= $where_str;
		else
		{
			if(Fget_userdata('where_str') != '')
				$str_query .= Fget_userdata('where_str');
			else
				$str_query .= ' AND nid is null';
		}		
		$str_query .= ' ORDER BY cindex desc';	
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}	
		$obj_result = $this->db->query($str_query); 

		return $obj_result->result_array();
	}


/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	
	

}
