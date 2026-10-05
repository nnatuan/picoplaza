<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Frontend - Building Files & Documents Management.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Files extends CI_Controller
{
    var $title       = 'Mẫu biểu & Tập tin Tòa nhà — PICO SAIGON';
    var $tags        = 'mẫu biểu tòa nhà, tài liệu thành viên, tập tin pico saigon';
    var $description = 'Tổng hợp các mẫu đơn, quy trình và tài liệu hướng dẫn dành cho Thành viên và Khách hàng tại PICO Saigon.';
	
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_function', 'ap_object', 'ap_html', 'ap_view_helper', 'ap_db', 'ap_module', 'download'));
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

    private function get_data() {}

    private function caculate_data() {}

    private function do_business()
    {
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;

        // 1. Lấy danh sách Mẫu biểu Public
        $data['docs_public'] = get_building_files('public');
        
        // 2. Kiểm tra trạng thái đăng nhập tài khoản Thành viên
        $data['is_logged_in'] = isset($_SESSION['session_nid_member']) ? true : false;
        
        if ($data['is_logged_in']) {
            $data['docs_member'] = get_building_files('member');
        } else {
            $data['docs_member'] = array();
        }

        $this->load->view('files', $data);
    }

    private function destroy_data() {}

    // Hàm hỗ trợ tải file an toàn cho Thành viên/Khách hàng
    public function download($nid)
    {
        $nid = (int)$nid;
        $this->db->where('nid', $nid);
        $this->db->where('cdel', '0');
        $this->db->where('nstatus', 1);
        $file = $this->db->get(Fget_ap_table('tfiles'))->row_array();

        if (!empty($file)) {
            // Kiểm tra phân quyền đối với file dành riêng cho Thành viên/Member
            if ($file['caccess_type'] == 'member' && !isset($_SESSION['session_nid_member'])) {
                echo "<script>alert('Vui lòng đăng nhập tài khoản Thành viên để tải mẫu biểu này!'); window.location.href='" . base_url() . "index.php/auth';</script>";
                return;
            }

            // Đường dẫn file nằm ở thư mục gốc /upload/file/
            $real_path = FCPATH . $file['cfile_path'];
            if (file_exists($real_path)) {
                force_download($real_path, NULL);
                return;
            }
        }

        echo "<script>alert('Tập tin không tồn tại hoặc đã bị gỡ bỏ!'); window.history.back();</script>";
    }
}