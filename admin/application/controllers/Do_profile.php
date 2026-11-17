<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Do_profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));

        $this->config->check_system_login = '1';
    }

    // 1. Hiển thị trang hồ sơ cá nhân
    function index()
    {
        $nid_user = Fget_userdata('session_nid_user');
        if (empty($nid_user)) {
            redirect(base_url() . 'index.php/do_login');
        }

        $user_row = $this->get_user_info($nid_user);
        if (empty($user_row)) {
            redirect(base_url() . 'index.php/do_home');
        }

        // Đọc thông báo Flash Message từ PHP Native Session
        $m_msg   = isset($_SESSION['profile_msg']) ? $_SESSION['profile_msg'] : '';
        $m_error = isset($_SESSION['profile_error']) ? $_SESSION['profile_error'] : '';
        unset($_SESSION['profile_msg'], $_SESSION['profile_error']); // Xóa sau khi đã lấy

        $data['user_info']   = $user_row;
        $data['lbl_form_title'] = "Thông tin hồ sơ cá nhân";
        $data['menu_active'] = "do_profile";
        $data['m_message']   = $m_msg;
        $data['m_error']     = $m_error;

        $this->load->view('profile_view/index.php', $data);
    }

    // 2. Xử lý cập nhật thông tin cá nhân
    function update_profile()
    {
        $nid_user = Fget_userdata('session_nid_user');
        if (empty($nid_user)) {
            redirect(base_url() . 'index.php/do_login');
        }

        $user_row = $this->get_user_info($nid_user);

        $cfullname         = trim($this->input->post('txt_cfullname'));
        $cemail            = trim($this->input->post('txt_cemail'));
        $chandphone        = trim($this->input->post('txt_chandphone'));
        $ctelegram_chat_id = trim($this->input->post('txt_ctelegram_chat_id'));
        $cgender           = trim($this->input->post('cbo_cgender'));
        $dbirthday         = trim($this->input->post('txt_dbirthday'));

        if ($cfullname == '') {
            $_SESSION['profile_error'] = 'Họ và tên không được để trống!';
            redirect(base_url() . 'index.php/do_profile');
        }

        // Xử lý Upload Ảnh đại diện (cavatar)
        $cavatar = isset($user_row['cavatar']) ? $user_row['cavatar'] : '';
        if (isset($_FILES['txt_cavatar']) && !empty($_FILES['txt_cavatar']['name'])) {
            $path_upload = './upload/avatar/';
            if (!is_dir($path_upload)) {
                @mkdir($path_upload, 0777, true);
            }

            $uploaded_file = Fupload_resize_img($_FILES['txt_cavatar'], '../' . $path_upload, 1000, 1000);
            if ($uploaded_file != '') {
                // Xóa avatar cũ nếu có
                if ($cavatar != '' && file_exists($path_upload . $cavatar)) {
                    @unlink($path_upload . $cavatar);
                }
                $cavatar = $uploaded_file;
            }
        }

        $data_update = array(
            'cfullname'         => $cfullname,
            'cemail'            => $cemail,
            'chandphone'        => $chandphone,
            'ctelegram_chat_id'  => $ctelegram_chat_id,
            'cgender'           => $cgender,
            'dbirthday'         => (!empty($dbirthday)) ? $dbirthday : NULL,
            'cavatar'           => $cavatar,
            'ddate_updated'     => dbget_current_date()
        );

        $this->db->where('nid', (int)$nid_user);
        $this->db->update(Fget_ap_table('tuser'), $data_update);

        // Cập nhật lại Fullname trong Session hệ thống
        Fset_userdata('session_user_full_name', $cfullname);

        $_SESSION['profile_msg'] = 'Cập nhật hồ sơ cá nhân thành công!';
        redirect(base_url() . 'index.php/do_profile');
    }

    // 3. Xử lý đổi mật khẩu
    function change_password()
    {
        $nid_user = Fget_userdata('session_nid_user');
        if (empty($nid_user)) {
            redirect(base_url() . 'index.php/do_login');
        }

        $user_row = $this->get_user_info($nid_user);

        $old_pass   = trim($this->input->post('txt_old_password'));
        $new_pass   = trim($this->input->post('txt_new_password'));
        $renew_pass = trim($this->input->post('txt_renew_password'));

        if (md5($old_pass) !== $user_row['cpassword']) {
            $_SESSION['profile_error'] = 'Mật khẩu hiện tại không chính xác!';
            redirect(base_url() . 'index.php/do_profile');
        }

        if (strlen($new_pass) < 6) {
            $_SESSION['profile_error'] = 'Mật khẩu mới phải chứa ít nhất 6 ký tự!';
            redirect(base_url() . 'index.php/do_profile');
        }

        if ($new_pass !== $renew_pass) {
            $_SESSION['profile_error'] = 'Xác nhận mật khẩu mới không khớp!';
            redirect(base_url() . 'index.php/do_profile');
        }

        $this->db->where('nid', (int)$nid_user);
        $this->db->update(Fget_ap_table('tuser'), array(
            'cpassword'     => md5($new_pass),
            'ddate_updated' => dbget_current_date()
        ));

        $_SESSION['profile_msg'] = 'Đổi mật khẩu thành công!';
        redirect(base_url() . 'index.php/do_profile');
    }

    private function get_user_info($nid)
    {
        $str_query = "SELECT * FROM " . Fget_ap_table('tuser') . " WHERE nid = " . (int)$nid . " AND cdel = '0' LIMIT 0,1";
        return $this->db->query($str_query)->row_array();
    }
}