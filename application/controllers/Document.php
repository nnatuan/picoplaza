<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Secure Document Download Management.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */

class Document extends CI_Controller {

    function __construct() {
        parent::__construct();
        if(!isset($_SESSION)) { session_start(); }
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_module');
    }

    function index() {
        redirect(base_url());
    }

    function download_file($nid_doc = 0)
    {
        // Thiết lập header trả về JSON dữ liệu sạch
        header('Content-Type: application/json; charset=utf-8');

        $user_level = check_current_user_level();
        $nid_doc    = (int)$nid_doc;

        $str_query = ' SELECT * FROM ' . Fget_ap_table('tdocument') . ' WHERE nid = ' . $nid_doc . ' AND nstatus = 1 LIMIT 0,1 ';
        $doc = $this->db->query($str_query)->row_array();

        if (empty($doc)) {
            echo json_encode(array('status' => 'error', 'message' => 'Tài liệu không tồn tại hoặc đã bị gỡ bỏ khỏi hệ thống!'));
            exit;
        }

        // Kiểm tra quyền hạn truy cập file khi gọi qua AJAX
        if ($doc['naccess_level'] > $user_level) {
            if ($doc['naccess_level'] == 2) {
                echo json_encode(array('status' => 'error', 'message' => 'Vui lòng đăng nhập tài khoản thành viên để tải tài liệu này!'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Quyền truy cập bị từ chối! Đây là tài liệu bảo mật chỉ dành cho nhân viên nội bộ PICO Saigon.'));
            }
            exit;
        }

        // Đường dẫn kiểm tra file vật lý
        $full_file_path = FCPATH . 'upload/document/' . $doc['cfile_path'];
        
        if (!file_exists($full_file_path)) {
            echo json_encode(array('status' => 'error', 'message' => 'File gốc không tồn tại trên hệ thống máy chủ!'));
            exit;
        }

        // Nếu vượt qua toàn bộ chốt chặn -> Trả về mã Token / Link tải trực tiếp an toàn
        $download_url = base_url() . 'document/force_stream_download/' . $nid_doc;
        echo json_encode(array('status' => 'success', 'download_url' => $download_url));
        exit;
    }

    /**
     * Hàm phụ chốt chặn cuối: Ép luồng stream file tải về sau khi AJAX đã check quyền thành công
     */
    function force_stream_download($nid_doc = 0)
    {
        $user_level = check_current_user_level();
        $nid_doc    = (int)$nid_doc;

        $str_query = ' SELECT * FROM ' . Fget_ap_table('tdocument') . ' WHERE nid = ' . $nid_doc . ' AND nstatus = 1 LIMIT 0,1 ';
        $doc = $this->db->query($str_query)->row_array();

        // Chặn link trực tiếp nếu cố tình pass qua AJAX
        if (empty($doc) || $doc['naccess_level'] > $user_level) {
            redirect(base_url());
        }

        $full_file_path = FCPATH . 'upload/document/' . $doc['cfile_path'];
        
        if (file_exists($full_file_path)) {
            $file_extension = pathinfo($full_file_path, PATHINFO_EXTENSION);
            $download_name  = $doc['ctitle'] . '.' . $file_extension;

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $download_name . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($full_file_path));
            
            flush();
            readfile($full_file_path);
            exit;
        }
    }
}