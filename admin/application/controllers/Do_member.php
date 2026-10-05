<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Do_member extends CI_Controller
{
    var $m_nid_user_login    = '';
    var $m_nid               = ''; 
    var $m_event             = '';
    var $m_button_click      = '';
    var $m_link_page         = '';
    var $m_link_cancel       = '';
    var $m_form_title        = '';
    
    // Các trường dữ liệu tài khoản tmember
    var $m_txt_cusername     = '';
    var $m_txt_cpassword     = '';
    var $m_txt_cfullname     = '';
    var $m_txt_cemail        = '';
    var $m_txt_cphone        = '';
    var $m_cbof_nstatus      = '1';
    var $m_cbof_nis_staff    = '0';
    
    var $m_error_msg         = '';

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));
        $this->config->check_system_login = '1';
        
        $this->m_link_page   = base_url() . 'index.php/do_member/do_process';
        $this->m_link_cancel = base_url() . 'index.php/do_member_listview';
		
		if (!check_staff_permission('admin')) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function index() {
        $this->f_add();
    }

    function f_add() {
        $this->m_event      = 'add';
        $this->m_form_title = 'Tạo tài khoản Khách hàng mới';
        $this->do_process();
    }

    function f_edit($nid) {
        $this->m_event      = 'edit';
        $this->m_nid        = $nid;
        $this->m_form_title = 'Chỉnh sửa tài khoản Khách hàng';
        $this->do_process();
    }

    function do_process()
    {
        $this->get_data();
        if ($this->m_button_click == 'btn_submit') {
            if ($this->check_data() == '1') {
                $this->do_business();
                return;
            }
        } else {
            $this->load_data();
        }
        $this->show_view();
    }

    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->m_button_click   = isset($_POST['hidden_button']) ? $_POST['hidden_button'] : '';
        $this->m_event          = isset($_POST['hidden_event']) ? $_POST['hidden_event'] : $this->m_event;
        $this->m_nid            = isset($_POST['hidden_nid']) ? $_POST['hidden_nid'] : $this->m_nid;

        if ($this->m_button_click == 'btn_submit') {
            $this->m_txt_cusername   = trim($_POST['txt_cusername']);
            $this->m_txt_cpassword   = trim($_POST['txt_cpassword']);
            $this->m_txt_cfullname   = trim($_POST['txt_cfullname']);
            $this->m_txt_cemail      = trim($_POST['txt_cemail']);
            $this->m_txt_cphone      = trim($_POST['txt_cphone']);
            $this->m_cbof_nstatus    = $_POST['cbof_nstatus'];
            $this->m_cbof_nis_staff  = $_POST['cbof_nis_staff'];
        }
    }

    private function check_data()
    {
        if ($this->m_txt_cusername == '') {
            $this->m_error_msg = 'Tên đăng nhập tài khoản không được để trống.'; return '0';
        }
        if ($this->m_event == 'add' && $this->m_txt_cpassword == '') {
            $this->m_error_msg = 'Vui lòng nhập mật khẩu cấp cho khách hàng.'; return '0';
        }
        if ($this->m_txt_cemail == '') {
            $this->m_error_msg = 'Địa chỉ Email khách hàng không được để trống.'; return '0';
        }
        
        if ($this->m_event == 'add') {
            if (fbcheck_exists_key_addnew('tmember', 'cusername', $this->m_txt_cusername) == FALSE) {
                $this->m_error_msg = "Tên đăng nhập này đã tồn tại.";
                return '0';
            }
            if (fbcheck_exists_key_addnew('tmember', 'cemail', $this->m_txt_cemail) == FALSE) {
                $this->m_error_msg = "Email này đã được đăng ký cho tài khoản khác.";
                return '0';
            }
        }
        return '1';
    }

    private function load_data()
    {
        if ($this->m_event == 'edit' && $this->m_nid != '') {
            $row = Obj_get_member_row($this->m_nid);
            if (!empty($row)) {
                $this->m_txt_cusername   = $row['cusername'];
                $this->m_txt_cfullname   = $row['cfullname'];
                $this->m_txt_cemail      = $row['cemail'];
                $this->m_txt_cphone      = $row['cphone'];
                $this->m_cbof_nstatus    = $row['nstatus'];
                $this->m_cbof_nis_staff  = $row['nis_staff'];
            }
        }
    }

    private function do_business()
    {
        $data_member = array(
            'cusername'   => $this->m_txt_cusername,
            'cfullname'   => $this->m_txt_cfullname,
            'cemail'      => $this->m_txt_cemail,
            'cphone'      => $this->m_txt_cphone,
            'nstatus'     => (int)$this->m_cbof_nstatus,
            'nis_staff'   => (int)$this->m_cbof_nis_staff,
            'dupdated_at' => date('Y-m-d H:i:s')
        );

        if ($this->m_event == 'add') {
            $data_member['cpassword']   = md5($this->m_txt_cpassword);
            $data_member['cdel']        = '0';
            $data_member['dcreated_at'] = date('Y-m-d H:i:s');
            
            $this->db->insert(Fget_ap_table('tmember'), $data_member);
        } 
        elseif ($this->m_event == 'edit') {
            if ($this->m_txt_cpassword != '') {
                $data_member['cpassword'] = md5($this->m_txt_cpassword);
            }
            
            $this->db->where('nid', (int)$this->m_nid)->update(Fget_ap_table('tmember'), $data_member);
        }

        redirect($this->m_link_cancel);
    }

    private function show_view()
    {
        $data['lbl_form_title']  = $this->m_form_title;
        $data['link_page']       = $this->m_link_page;
        $data['link_cancel']     = $this->m_link_cancel;
        $data['m_message']       = $this->m_error_msg;
        $data['nid']             = $this->m_nid;
        $data['event']           = $this->m_event;

        $data['txt_cusername']   = $this->m_txt_cusername;
        $data['txt_cfullname']   = $this->m_txt_cfullname;
        $data['txt_cemail']      = $this->m_txt_cemail;
        $data['txt_cphone']      = $this->m_txt_cphone;
        $data['cbof_nstatus']    = $this->m_cbof_nstatus;
        $data['cbof_nis_staff']  = $this->m_cbof_nis_staff;

        $data['menu_active']     = 'member';

        $this->load->view('member_view/index.php', $data);
    }
}