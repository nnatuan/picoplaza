<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class do_menu extends CI_Controller
{
    var $m_nid_user_login = '';
    var $m_nid            = '';
    var $m_event          = '';
    var $m_button_click   = '';
    var $m_link_page      = '';
    var $m_link_cancel    = '';
    var $m_form_menu      = '';
    
    var $m_txt_ctitle     = '';
    var $m_txt_clink      = '';
    var $m_txt_cindex     = '1';
    var $m_txt_nstatus    = '1';
    var $m_error_msg      = '';

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));

        $this->config->check_system_login = '1';
        $this->load->model('menu_model');

        // Phân quyền: Admin + Content Manager
        if (!check_staff_permission(array('admin'))) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function f_edit($nid)
    {
        $this->m_event = 'edit';
        $this->m_nid   = $nid;
        $this->do_process();
    }

    function f_update_edit()
    {
        $this->m_event = 'update_edit';
        $this->do_process();
    }

    function f_add()
    {
        $this->m_event = 'add';
        $this->m_nid   = '0';
        $this->do_process();
    }

    function f_update_add()
    {
        $this->m_event = 'update_add';
        $this->do_process();
    }

    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }

    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');

        if (isset($_POST['txt_ctitle'])) {
            $this->m_txt_ctitle  = trim($_POST['txt_ctitle']);
            $this->m_txt_clink   = trim($_POST['txt_clink']);
            $this->m_txt_cindex  = trim($_POST['txt_cindex']);
        }

        if (isset($_POST['hidden_nid']))
            $this->m_nid = $_POST['hidden_nid'];
        if (isset($_POST['hidden_event']))
            $this->m_event = $_POST['hidden_event'];
        if (isset($_POST['hidden_button']))
            $this->m_button_click = $_POST['hidden_button'];
    }

    private function caculate_data()
    {
        $this->m_link_cancel = base_url() . 'index.php/do_menu_listview';

        switch ($this->m_event) {
            case 'edit':
                $this->m_form_menu  = "Chỉnh sửa Menu";
                $this->m_link_page  = base_url() . 'index.php/do_menu/f_update_edit';
                $menu_row           = $this->menu_model->get_byid($this->m_nid);
                if (!empty($menu_row)) {
                    $this->m_txt_ctitle  = $menu_row['ctitle'];
                    $this->m_txt_clink   = $menu_row['clink'];
                    $this->m_txt_cindex  = $menu_row['cindex'];
                    $this->m_txt_nstatus = $menu_row['nstatus'];
                }
                $this->m_event = 'update_edit';
                break;

            case 'add':
                $this->m_form_menu = "Thêm mới Menu";
                $this->m_link_page = base_url() . 'index.php/do_menu/f_update_add';
                $this->m_event     = 'update_add';
                break;

            case 'update_edit':
                $this->m_form_menu = "Chỉnh sửa Menu";
                if ($this->m_button_click == 'btn_submit') {
                    if ($this->update_data() == TRUE)
                        redirect('do_menu_listview');
                }
                $this->m_link_page = base_url() . 'index.php/do_menu/f_update_edit';
                break;

            case 'update_add':
                if ($this->m_button_click == 'btn_submit') {
                    if ($this->insert_data() == TRUE)
                        redirect('do_menu_listview');
                }
                $this->m_form_menu = "Thêm mới Menu";
                $this->m_link_page = base_url() . 'index.php/do_menu/f_update_add';
                break;
        }
    }

    private function do_business()
    {
        $data['event']           = $this->m_event;
        $data['link_page']       = $this->m_link_page;
        $data['link_cancel']     = $this->m_link_cancel;
        $data['nid']             = $this->m_nid;
        $data['lbl_form_title']  = $this->m_form_menu;

        $data['txt_ctitle']      = $this->m_txt_ctitle;
        $data['txt_clink']       = $this->m_txt_clink;
        $data['txt_cindex']      = $this->m_txt_cindex;
        $data['txt_nstatus']     = $this->m_txt_nstatus;

        $data['menu_active']     = 'menu_mgr';
        $data['m_message']       = $this->m_error_msg;

        $this->load->view('menu_view/index.php', $data);
    }

    private function destroy_data() {}

    private function check_valid_not_null()
    {
        if (trim($this->m_txt_ctitle) == '') {
            $this->m_error_msg = "Tiêu đề Menu không được để trống!";
            return FALSE;
        }
        return TRUE;
    }

    private function insert_data()
    {
        if ($this->check_valid_not_null()) {
            $data = array(
                'ctitle'    => $this->m_txt_ctitle,
                'clink'     => $this->m_txt_clink,
                'cindex'    => $this->m_txt_cindex,
                'nstatus'   => 1,
                'niduser01' => $this->m_nid_user_login,
                'ddate01'   => dbget_current_date()
            );
            $this->menu_model->insert($data);
            return TRUE;
        }
        return FALSE;
    }

    private function update_data()
    {
        if ($this->check_valid_not_null()) {
            $data = array(
                'ctitle'    => $this->m_txt_ctitle,
                'clink'     => $this->m_txt_clink,
                'cindex'    => $this->m_txt_cindex,
                'niduser02' => $this->m_nid_user_login,
                'ddate02'   => dbget_current_date()
            );
            $this->menu_model->update_bynid($this->m_nid, $data);
            return TRUE;
        }
        return FALSE;
    }
}