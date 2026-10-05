<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class do_menu_listview extends CI_Controller
{
    var $m_nid_user_login   = '';
    var $m_link_page        = '';
    var $m_event            = '';
    var $m_where_clause     = '';
    var $m_orderby_clause   = '';
    var $m_orderby_sort     = '';
    var $m_sort_img         = '';

    var $m_total_row        = 0;
    var $m_total_page       = 0;
    var $m_current_page     = 1;
    var $m_row_per_page     = 20;

    var $m_txtf_ctitle      = '';
    var $m_obj_data_view    = '';

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));

        $this->config->check_system_login = '1';
        $this->load->model('menu_model');

        if (!check_staff_permission(array('admin'))) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_menu_listview_' . $cookie_name, $cookie_value);
    }

    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_menu_listview_' . $cookie_name);
    }

    function index()
    {
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

        if (isset($_POST['hidden_button'])) {
            $hidden_button = $_POST['hidden_button'];
            switch ($hidden_button) {
                case "btn_filter":
                    if (isset($_POST['txtf_ctitle'])) {
                        $this->m_txtf_ctitle = $_POST['txtf_ctitle'];
                    }
                    $this->f_set_cookie('m_txtf_ctitle', $this->m_txtf_ctitle);
                    break;

                case "btn_add":
                    redirect(base_url() . 'index.php/do_menu/f_add');
                    break;

                case "btn_delete":
                    $this->delete();
                    break;
            }
        }
    }

    private function caculate_data()
    {
        $this->m_link_page   = base_url() . 'index.php/do_menu_listview/';
        $this->m_txtf_ctitle = $this->f_get_cookie('m_txtf_ctitle');

        $this->m_where_clause = $this->get_where_string();
        $this->m_total_row    = $this->menu_model->get_count_listview($this->m_where_clause);

        $this->m_obj_data_view = $this->menu_model->get_listview(
            $this->m_where_clause,
            'cindex ASC, nid DESC',
            $this->m_row_per_page,
            $this->m_current_page,
            $this->m_total_row
        );

        if ($this->m_event == '') $this->m_event = 'view';
    }

    private function do_business()
    {
        $data['link_page']      = $this->m_link_page;
        $data['lbl_form_title'] = "Quản lý Menu Website";
        $data['txtf_ctitle']    = $this->m_txtf_ctitle;
        $data['data_view']      = $this->m_obj_data_view;
        $data['menu_active']    = 'menu_mgr';
        $data['event']          = $this->m_event;

        $this->load->view('menu_view/index.php', $data);
    }

    private function destroy_data() {}

    private function get_where_string()
    {
        $str_result = ' WHERE nid is not null ';
        if ($this->m_txtf_ctitle != '') {
            $str_result .= ' AND ctitle like "%' . trim($this->m_txtf_ctitle) . '%" ';
        }
        return $str_result;
    }

    private function delete()
    {
        if (!empty($_POST['chk'])) {
            foreach ($_POST['chk'] as $nid) {
                $this->menu_model->delete_byid($nid);
            }
        }
    }
}