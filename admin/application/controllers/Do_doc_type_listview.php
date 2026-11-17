<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Quản Lý Loại Hồ Sơ & Biểu Mẫu (Listview)
 * =================================================================
 */

class Do_doc_type_listview extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (session_status() == PHP_SESSION_NONE) {
            @session_start();
        }
        $this->load->database();
		$this->load->helper(array('url', 'ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object', 'workflow'));
        $this->config->check_system_login = '1';
        if (!check_staff_permission('admin')) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function index()
    {
        $search = trim($this->input->get('keyword'));

        $where_sql = " WHERE 1=1 ";
        if (!empty($search)) {
            $where_sql .= " AND (t.cname LIKE '%" . $this->db->escape_like_str($search) . "%' OR t.ccode LIKE '%" . $this->db->escape_like_str($search) . "%') ";
        }

        $str_query = " SELECT t.* FROM " . Fget_ap_table('tdoc_type') . " t " . $where_sql . " ORDER BY t.cindex+0 ASC, t.nid ASC ";
        $list = $this->db->query($str_query)->result_array();

        // Lấy danh sách phòng ban để map tên phòng ban
        $departments = get_all_departments();
        $dept_map = array();
        foreach ($departments as $d) {
            $dept_map[$d['nid']] = $d['cname'];
        }

        $data['list']        = $list;
        $data['dept_map']    = $dept_map;
        $data['search']      = $search;
        $data['menu_active'] = 'doc_type';

        $this->load->view('doc_type_view/list', $data);
    }
}
