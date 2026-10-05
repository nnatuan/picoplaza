<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class lai_suat_tra_gop_model extends CI_Model
{
    var $m_table_name = '';
    var $m_view_name = '';
    function __construct() 
	{	
		parent::__construct();
        $this->m_table_name = Fget_ap_table('tlai_suat_tra_gop');
        $this->m_view_name  = Vlai_suat_tra_gop_view();
    }
    function get_byid($nid)
    {
        $this->db->where('nid', $nid);
        $obj_result = $this->db->get($this->m_table_name);
        return $obj_result->row_array();
    }
    function get_by_status($status)
    {
        $this->db->where('nstatus', $status);
        $obj_result = $this->db->get($this->m_table_name);
        return $obj_result->result_array();
    }
    function insert($arr_data)
    {
        $this->db->insert($this->m_table_name, $arr_data);
    }
    function update_bynid($num_nid, $arr_data)
    {
        $this->db->where('nid', $num_nid);
        $this->db->update($this->m_table_name, $arr_data);
    }
    private function checkvalid_delete($num_nid)
    {
        $this->db->where('nid', $num_nid);
        $obj_result = $this->db->get(Fget_ap_table('tarticle'));
        return TRUE;
    }
    function delete_byid($num_nid)
    {
        if ($this->checkvalid_delete($num_nid) === TRUE AND $num_nid > 5) {
            $this->db->where('nid', $num_nid);
            $this->db->delete($this->m_table_name);
        }
    }
    function get_listview_report($str_where_clause, $str_order_by_clause)
    {
        $str_query = ' SELECT * FROM  ' . $this->m_view_name;
        $str_query = $str_query . ' ' . $str_where_clause . ' ';
        if (trim($str_order_by_clause) != '') {
            $str_query = $str_query . ' order by ' . $str_order_by_clause;
        }
        $obj_result = $this->db->query($str_query);
        return $obj_result->result_array();
    }
    function export_excel($report_name, $data)
    {
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=" . $report_name);
        header("Pragma: no-cache");
        header("Expires: 0");
        print($this->load->view('article_view/tkb_article_excel.php', $data));
    }
    function get_count_listview($str_where_clause)
    {
        $str_query  = ' SELECT nid FROM ' . $this->m_view_name;
        $str_query  = $str_query . ' ' . $str_where_clause . ' ';
        $obj_result = $this->db->query($str_query);
        return $obj_result->num_rows();
    }
    function get_listview($str_where_clause, $str_order_by_clause, $num_row_per_page, $num_current_page, $num_total_row)
    {
        $str_query = 'SELECT * FROM  ' . $this->m_view_name;
        $str_query = $str_query . ' ' . $str_where_clause . ' ';
        if (trim($str_order_by_clause) != '') {
            $str_query = $str_query . ' order by ' . $str_order_by_clause . ' ';
        }
        if ($num_total_row > 0) {
            $str_query = $str_query . ' limit ' . ($num_current_page - 1) * $num_row_per_page . ' , ' . $num_row_per_page;
        }
        $obj_result = $this->db->query($str_query);
        return $obj_result->result_array();
    }
    function get_new_byid($nid)
    {
        $this->db->where('nid', $nid);
        $obj_result = $this->db->get($this->m_table_name);
        return $obj_result->row_array();
    }
    function get_article_by_catid($nid)
    {
        $this->db->where('nid_cat_article', $nid);
        $obj_result = $this->db->get($this->m_table_name);
        return $obj_result->row_array();
    }
}
