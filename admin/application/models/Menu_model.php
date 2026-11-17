<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    var $table_name = 'tmenu';

    function __construct()
    {
        parent::__construct();
    }

    function get_byid($nid)
    {
        $this->db->where('nid', (int)$nid);
        $query = $this->db->get(Fget_ap_table($this->table_name));
        return $query->row_array();
    }

    function get_count_listview($where_clause = '')
    {
        $str_sql = " SELECT COUNT(nid) as total_rows FROM " . Fget_ap_table($this->table_name) . " " . $where_clause;
        $query   = $this->db->query($str_sql);
        $row     = $query->row_array();
        return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
    }

    function get_listview($where_clause = '', $orderby_clause = 'cindex ASC', $row_per_page = 10, $current_page = 1, $total_row = 0)
    {
        $start_row = ($current_page - 1) * $row_per_page;
        if ($start_row < 0) $start_row = 0;

        $str_sql = " SELECT * FROM " . Fget_ap_table($this->table_name) . " ";
        $str_sql .= $where_clause . " ";
        $str_sql .= " ORDER BY " . $orderby_clause . " ";
        $str_sql .= " LIMIT " . (int)$start_row . ", " . (int)$row_per_page;

        $query = $this->db->query($str_sql);
        return $query->result_array();
    }

    function insert($data)
    {
        $this->db->insert(Fget_ap_table($this->table_name), $data);
        return $this->db->insert_id();
    }

    function update_bynid($nid, $data)
    {
        $this->db->where('nid', (int)$nid);
        return $this->db->update(Fget_ap_table($this->table_name), $data);
    }

    function delete_byid($nid)
    {
        $this->db->where('nid', (int)$nid);
        return $this->db->delete(Fget_ap_table($this->table_name));
    }
}