<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

class product_model extends Model
{
	
function product_model() 
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
 function get_count_list_product_by_catid($nid_material,$nid_cat)
	{		
		$str_query = ' SELECT nid FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;
		$str_query .= ' AND nid_cat_products = '.$nid_cat;		
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
	
function get_count_list_product_by_brandid($nid_material,$nid_cat,$nid_brand)
	{		
		$str_query = ' SELECT nid FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;
		$str_query .= ' AND nid_cat_products = '.$nid_cat;
		$str_query .= ' AND nid_brand_products = '.$nid_brand;		
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}
 
function get_list_product_by_catid($nid_material,$nid_cat,$num_total_row = 0,$num_current_page,$num_row_per_page)
	{		
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;
		$str_query .= ' AND nid_cat_products = '.$nid_cat;		
		$str_query .= ' ORDER BY nid desc';	
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}

function get_list_product_by_brandid($nid_material,$nid_cat,$nid_brand,$num_total_row = 0,$num_current_page,$num_row_per_page)
	{		
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;
		$str_query .= ' AND nid_cat_products = '.$nid_cat;	
		$str_query .= ' AND nid_brand_products = '.$nid_brand;		
		$str_query .= ' ORDER BY nid desc';	
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}

function get_detail_byid($nid)
	{
		$str_query = ' SELECT * FROM  '.Fget_ap_table('tproducts').' ' ;	
		$str_query .= ' WHERE nid = '. $nid;	
			$obj_result = $this->db->query($str_query);  
			return $obj_result->row_array();
	}

function get_image_product_byid($nid)
	{
		$str_query = ' SELECT * FROM  '.Vimage_product().' ' ;	
		$str_query .= ' WHERE nid_products = '. $nid;
		$str_query .= ' ORDER BY cindex ';	
			$obj_result = $this->db->query($str_query);  
			return $obj_result->result_array();
	}

function get_count_list_product_by_matid($nid_material)
	{		
		$str_query = ' SELECT nid FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nid_material_products = '.$nid_material;	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}

function get_list_product_by_matid($nid_material,$num_total_row = 0,$num_current_page,$num_row_per_page)
	{		
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;	
		$str_query .= ' ORDER BY nid desc';	
		if ($num_total_row > 0)
		{	
			$str_query .=  ' limit '. ($num_current_page -1 )* $num_row_per_page . ' , ' . $num_row_per_page;		
		}	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}
	
function get_special_product_by_matid($nid_material)
	{		
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND nspecial_products = 1';
		$str_query .= ' AND nid_material_products = '.$nid_material;	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->result_array();
	}


function get_count_list_product_sale()
	{		
		$str_query = ' SELECT nid FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND fprice_sale <> 0 ';
		$str_query .= ' AND fprice_sale <> "" ';	
		$obj_result = $this->db->query($str_query);  
		return $obj_result->num_rows();
	}

function get_list_product_sale($num_total_row = 0,$num_current_page,$num_row_per_page)
	{		
		$str_query = ' SELECT * FROM '.Fget_ap_table('tproducts');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1';
		$str_query .= ' AND fprice_sale <> 0 ';
		$str_query .= ' AND fprice_sale <> "" ';	
		$str_query .= ' ORDER BY nid desc';	
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
