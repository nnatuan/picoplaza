<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Thêm / Sửa Phòng Ban Thẩm Định
 * =================================================================
 */

class Do_department extends CI_Controller
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

    function f_add()
    {
        $this->ensure_schema();
        $data['title_action'] = 'Thêm Phòng Ban Thẩm Định Mới';
        $data['event']        = 'add';
        $data['dept']         = array(
            'nid'                => 0,
            'ccode'              => '',
            'cname'              => '',
            'cdescription'       => '',
            'ctelegram_group_id' => '',
            'nstatus'            => 1,
            'cindex'             => 1
        );
        $data['menu_active']  = 'department';

        $this->load->view('department_view/department', $data);
    }

    function f_save_add()
    {
        $this->ensure_schema();
        $cname              = trim($this->input->post('cname'));
        $ccode              = trim($this->input->post('ccode'));
        $cdescription       = trim($this->input->post('cdescription'));
        $ctelegram_group_id = trim($this->input->post('ctelegram_group_id'));
        $nstatus            = (int)$this->input->post('nstatus');
        $cindex             = (int)$this->input->post('cindex');

        if (empty($cname)) {
            $_SESSION['flash_error'] = 'Vui lòng nhập tên phòng ban!';
            redirect(base_url('index.php/do_department/f_add'));
            return;
        }

        if (empty($ccode)) {
            $ccode = 'DEPT_' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
        } else {
            $ccode = strtoupper(preg_replace('/[^A-Za-z0-9_]/', '', $ccode));
        }

        // Kiểm tra trùng mã code
        $check = $this->db->where('ccode', $ccode)->count_all_results(Fget_ap_table('tdepartment'));
        if ($check > 0) {
            $_SESSION['flash_error'] = 'Mã phòng ban "' . htmlspecialchars($ccode) . '" đã tồn tại!';
            redirect(base_url('index.php/do_department/f_add'));
            return;
        }

        $insert_data = array(
            'ccode'              => $ccode,
            'cname'              => $cname,
            'cdescription'       => $cdescription,
            'ctelegram_group_id' => !empty($ctelegram_group_id) ? $ctelegram_group_id : NULL,
            'nstatus'            => $nstatus,
            'cindex'             => $cindex
        );

        $this->db->insert(Fget_ap_table('tdepartment'), $insert_data);
        $_SESSION['flash_msg'] = 'Thêm mới phòng ban "' . htmlspecialchars($cname) . '" thành công!';
        redirect(base_url('index.php/do_department_listview'));
    }

    function f_edit($nid)
    {
        $this->ensure_schema();
        $nid = (int)$nid;
        $dept = $this->db->where('nid', $nid)->get(Fget_ap_table('tdepartment'))->row_array();
        if (empty($dept)) {
            $_SESSION['flash_error'] = 'Không tìm thấy thông tin phòng ban!';
            redirect(base_url('index.php/do_department_listview'));
            return;
        }

        $data['title_action'] = 'Chỉnh Sửa Phòng Ban: ' . htmlspecialchars($dept['cname']);
        $data['event']        = 'edit';
        $data['dept']         = $dept;
        $data['menu_active']  = 'department';

        $this->load->view('department_view/department', $data);
    }

    function f_save_edit()
    {
        $this->ensure_schema();
        $nid                = (int)$this->input->post('nid');
        $cname              = trim($this->input->post('cname'));
        $ccode              = trim($this->input->post('ccode'));
        $cdescription       = trim($this->input->post('cdescription'));
        $ctelegram_group_id = trim($this->input->post('ctelegram_group_id'));
        $nstatus            = (int)$this->input->post('nstatus');
        $cindex             = (int)$this->input->post('cindex');

        if ($nid <= 0 || empty($cname)) {
            $_SESSION['flash_error'] = 'Vui lòng nhập đầy đủ thông tin phòng ban!';
            redirect(base_url('index.php/do_department/f_edit/' . $nid));
            return;
        }

        if (empty($ccode)) {
            $ccode = 'DEPT_' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 5));
        } else {
            $ccode = strtoupper(preg_replace('/[^A-Za-z0-9_]/', '', $ccode));
        }

        // Kiểm tra trùng mã code với phòng ban khác
        $check = $this->db->where('ccode', $ccode)->where('nid !=', $nid)->count_all_results(Fget_ap_table('tdepartment'));
        if ($check > 0) {
            $_SESSION['flash_error'] = 'Mã phòng ban "' . htmlspecialchars($ccode) . '" đã được sử dụng bởi phòng ban khác!';
            redirect(base_url('index.php/do_department/f_edit/' . $nid));
            return;
        }

        $update_data = array(
            'ccode'              => $ccode,
            'cname'              => $cname,
            'cdescription'       => $cdescription,
            'ctelegram_group_id' => !empty($ctelegram_group_id) ? $ctelegram_group_id : NULL,
            'nstatus'            => $nstatus,
            'cindex'             => $cindex
        );

        $this->db->where('nid', $nid)->update(Fget_ap_table('tdepartment'), $update_data);
        $_SESSION['flash_msg'] = 'Cập nhật thông tin phòng ban "' . htmlspecialchars($cname) . '" thành công!';
        redirect(base_url('index.php/do_department_listview'));
    }

    private function ensure_schema()
    {
        $table = Fget_ap_table('tdepartment');
        if (!$this->db->field_exists('ctelegram_group_id', $table)) {
            $this->load->dbforge();
            $fields = array(
                'ctelegram_group_id' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50',
                    'null' => TRUE,
                    'default' => NULL
                )
            );
            $this->dbforge->add_column($table, $fields);
        }
    }
}
