<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Quản Lý Danh Mục Phòng Ban Thẩm Định (Listview)
 * =================================================================
 */

class Do_department_listview extends CI_Controller
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
            $where_sql .= " AND (d.cname LIKE '%" . $this->db->escape_like_str($search) . "%' OR d.ccode LIKE '%" . $this->db->escape_like_str($search) . "%') ";
        }

        $str_query = " SELECT d.*, 
                       (SELECT COUNT(*) FROM " . Fget_ap_table('tuser') . " u WHERE u.nid_dept = d.nid AND u.cdel = '0') as staff_count,
                       (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " s WHERE s.nid_dept = d.nid AND s.cstep_status = 'PENDING') as pending_count
                       FROM " . Fget_ap_table('tdepartment') . " d " . $where_sql . " 
                       ORDER BY d.cindex+0 ASC, d.nid ASC ";
        $list = $this->db->query($str_query)->result_array();

        $data['list']        = $list;
        $data['search']      = $search;
        $data['menu_active'] = 'department';

        $this->load->view('department_view/department_listview', $data);
    }

    function f_delete($nid)
    {
        $nid = (int)$nid;
        if ($nid <= 0) {
            redirect(base_url('index.php/do_department_listview'));
            return;
        }

        // Kiểm tra xem có nhân viên đang gán vào phòng ban này không
        $staff_count = $this->db->where('nid_dept', $nid)->where('cdel', '0')->count_all_results(Fget_ap_table('tuser'));
        if ($staff_count > 0) {
            $_SESSION['flash_error'] = 'Không thể xóa phòng ban này vì đang có ' . $staff_count . ' nhân viên trực thuộc. Vui lòng chuyển nhân viên sang phòng ban khác trước!';
            redirect(base_url('index.php/do_department_listview'));
            return;
        }

        // Kiểm tra xem có bước thẩm định nào đang chờ duyệt không
        $step_count = $this->db->where('nid_dept', $nid)->where('cstep_status', 'PENDING')->count_all_results(Fget_ap_table('tdoc_approval_step'));
        if ($step_count > 0) {
            $_SESSION['flash_error'] = 'Không thể xóa phòng ban này vì đang có ' . $step_count . ' hồ sơ đang trong tiến trình chờ thẩm định!';
            redirect(base_url('index.php/do_department_listview'));
            return;
        }

        $this->db->where('nid', $nid)->delete(Fget_ap_table('tdepartment'));
        $_SESSION['flash_msg'] = 'Đã xóa phòng ban thành công!';
        redirect(base_url('index.php/do_department_listview'));
    }

    function f_status($nid, $status)
    {
        $nid = (int)$nid;
        $status = ((int)$status == 1) ? 1 : 0;
        $this->db->where('nid', $nid)->update(Fget_ap_table('tdepartment'), array('nstatus' => $status));
        $_SESSION['flash_msg'] = 'Đã cập nhật trạng thái phòng ban thành công!';
        redirect(base_url('index.php/do_department_listview'));
    }
}
