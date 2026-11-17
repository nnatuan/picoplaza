<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class news_model  extends Model
{
	
function news_model() 
	{	
		parent::Model();
		$this->m_table_name = Fget_ap_table('tnews');
		$this->m_view_name 	= Vnew_view();

	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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
function get_listall($nid)
	{		
		$str_query = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query .= ' WHERE ccode_cat like "%'.$nid.'%"';
		$str_query .= ' ORDER BY cindex asc';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_listview($str_where_clause, $str_order_by_clause,$oder_by ='', $num_row_per_page =0, $num_current_page =0, $num_total_row=0)
	{		
		$str_query = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query = $str_query . ' ' . $str_where_clause . ' ';
		
		if (trim($str_order_by_clause)!= '')
		{
			$str_query = $str_query . ' order by ddate01 desc, nid desc ';
		}
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}
	
function get_listview_search($str_where_clause, $str_order_by_clause,$num_row_per_page =0, $num_current_page =0, $num_total_row=0)
	{		
		$str_query = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query = $str_query . ' ' . $str_where_clause . ' ';
		$str_query = $str_query . ' order by ddate01 desc, nid desc ';
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}
		$obj_result = $this->db->query($str_query);
		return $obj_result->result_array();
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Cao An Phu - phu_ca86@tokaban.com
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

function get_count_list($str)
	{	
		$str_query 	 = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query	.= 'WHERE nid is not null'. $str;
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_count_list_search($str)
	{	
		$str_query 	 = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query	.=  $str;
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}

function count_record_cat($nid_cat = '')
	{	
		$str_query 	 = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query	.= 'where ccode_cat = "'.$nid_cat.'"';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
function count_record_sec($nid_sec = '')
	{	
		$str_query 	 = ' SELECT * FROM  '.$this->m_view_name;	
		$str_query	.= 'where nid_section_news ="'.$nid_sec.'"';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
function get_id_sec_new($ccode = '')
	{	
		$str_query 	 = ' SELECT * FROM '.Fget_ap_table('tsection_news');	
		$str_query	.= ' WHERE ccode ="'.$ccode.'"';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->row_array();
	}
	
/**
 |====================================================================
 | DANH SACH CAC HAM DINH NGHIA THEM
 |====================================================================
 */
	function get_name_cat($ccode = '')
	{	
		$str_query 	 = ' SELECT a.ccode as ccode_cat , a.ccat_news as ccat_news, a.cnote as cnote ,a.ctag, a.cnote ,  b.ccode as ccode_sec  FROM ';	
		$str_query 	.= ' '.Fget_ap_table('tcat_news').' as a , ';	
		$str_query 	.= ' '.Fget_ap_table('tsection_news').' as b  ';	
		$str_query	.= ' WHERE a.ccode like "%'.$ccode.'%"';
		$str_query	.= ' AND b.nid = a.nid_section_news ';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->row_array();
	}
	function get_name_sec($ccode = '')
	{	
		$str_query 	 = ' SELECT * FROM '.Fget_ap_table('tsection_news');	
		$str_query	.= ' where ccode like "%'.$ccode.'%"';
		$obj_result = $this->db->query($str_query);  
		return $obj_result->row_array();
	}

	

}
