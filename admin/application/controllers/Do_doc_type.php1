<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO PLAZA Admin CMS - Thêm / Sửa / Xóa Loại Hồ Sơ & Biểu Mẫu
 * =================================================================
 */

class Do_doc_type extends CI_Controller
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
        $data['title_action'] = 'Thêm Loại Hồ Sơ & Biểu Mẫu Mới';
        $data['event']        = 'add';
        $data['doc_type']     = array(
            'nid'             => 0,
            'ccode'           => '',
            'cname'           => '',
            'cdescription'    => '',
            'cfile_template'  => '',
            'cdepts_required' => '',
            'cdepts_view'     => '',
            'nstatus'         => 1,
            'cindex'          => 1
        );
        $data['departments']            = get_all_departments();
        $data['selected_depts_approve'] = array();
        $data['selected_depts_view']    = array();
        $data['menu_active']            = 'doc_type';

        $this->load->view('doc_type_view/edit', $data);
    }

    function f_save_add()
    {
        $cname         = trim($this->input->post('cname'));
        $ccode         = trim($this->input->post('ccode'));
        $cdescription  = trim($this->input->post('cdescription'));
        $nstatus       = (int)$this->input->post('nstatus');
        $cindex        = (int)$this->input->post('cindex');
        $depts_approve = $this->input->post('depts_approve'); // Mảng ID phòng ban có quyền DUYỆT
        $depts_view    = $this->input->post('depts_view');    // Mảng ID phòng ban CHỈ XEM

        if (empty($depts_approve) && !empty($this->input->post('depts'))) {
            $depts_approve = $this->input->post('depts');
        }

        if (empty($cname)) {
            $_SESSION['flash_error'] = 'Vui lòng nhập tên loại hồ sơ / đề xuất!';
            redirect(base_url() . 'index.php/do_doc_type/f_add');
            return;
        }

        if (empty($ccode)) {
            // Tự sinh mã code nếu để trống
            $ccode = 'HS_' . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));
        }

        $cdepts_required = (!empty($depts_approve) && is_array($depts_approve)) ? implode(',', array_map('intval', $depts_approve)) : '';
        $cdepts_view     = (!empty($depts_view) && is_array($depts_view)) ? implode(',', array_map('intval', $depts_view)) : '';

        // Xử lý upload file biểu mẫu PDF
        $file_template_path = '';
        if (isset($_FILES['file_template']) && $_FILES['file_template']['name'] != '') {
            $upload_dir = FCPATH . '../upload/doc_type/';
            if (!is_dir($upload_dir)) {
                @mkdir($upload_dir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['file_template']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array('pdf', 'doc', 'docx', 'xls', 'xlsx'))) {
                $_SESSION['flash_error'] = 'Chỉ chấp nhận tệp biểu mẫu PDF, DOC, DOCX, XLS!';
                redirect(base_url() . 'index.php/do_doc_type/f_add');
                return;
            }

            $filename = 'mau_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $target_file = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['file_template']['tmp_name'], $target_file)) {
                $file_template_path = 'upload/doc_type/' . $filename;
            }
        }

        $insert_data = array(
            'ccode'           => $ccode,
            'cname'           => $cname,
            'cdescription'    => $cdescription,
            'cfile_template'  => $file_template_path,
            'cdepts_required' => $cdepts_required,
            'cdepts_view'     => $cdepts_view,
            'nstatus'         => $nstatus,
            'cindex'          => $cindex,
            'ddate_created'   => date('Y-m-d H:i:s')
        );

        if (!$this->db->field_exists('cdepts_view', Fget_ap_table('tdoc_type'))) {
            $this->db->query("ALTER TABLE " . Fget_ap_table('tdoc_type') . " ADD COLUMN `cdepts_view` varchar(255) DEFAULT '' AFTER `cdepts_required`");
        }

        $this->db->insert(Fget_ap_table('tdoc_type'), $insert_data);
        $_SESSION['flash_msg'] = 'Thêm mới loại hồ sơ "' . htmlspecialchars($cname) . '" thành công!';
        redirect(base_url() . 'index.php/do_doc_type_listview');
    }

    function f_edit($nid = 0)
    {
        $nid = (int)$nid;
        $doc_type = get_doc_type_by_id($nid);

        if (empty($doc_type)) {
            $_SESSION['flash_error'] = 'Không tìm thấy loại hồ sơ cần sửa!';
            redirect(base_url() . 'index.php/do_doc_type_listview');
            return;
        }

        $data['title_action']           = 'Chỉnh Sửa Loại Hồ Sơ: ' . $doc_type['cname'];
        $data['event']                  = 'edit';
        $data['doc_type']               = $doc_type;
        $data['departments']            = get_all_departments();
        $data['selected_depts_approve'] = !empty($doc_type['cdepts_required']) ? explode(',', $doc_type['cdepts_required']) : array();
        $data['selected_depts_view']    = !empty($doc_type['cdepts_view']) ? explode(',', $doc_type['cdepts_view']) : array();
        $data['menu_active']            = 'doc_type';

        $this->load->view('doc_type_view/edit', $data);
    }

    function f_save_edit()
    {
        $nid           = (int)$this->input->post('nid');
        $cname         = trim($this->input->post('cname'));
        $ccode         = trim($this->input->post('ccode'));
        $cdescription  = trim($this->input->post('cdescription'));
        $nstatus       = (int)$this->input->post('nstatus');
        $cindex        = (int)$this->input->post('cindex');
        $depts_approve = $this->input->post('depts_approve'); // Mảng ID phòng ban có quyền DUYỆT
        $depts_view    = $this->input->post('depts_view');    // Mảng ID phòng ban CHỈ XEM

        if (empty($depts_approve) && !empty($this->input->post('depts'))) {
            $depts_approve = $this->input->post('depts');
        }

        $old_data = get_doc_type_by_id($nid);
        if (empty($old_data)) {
            $_SESSION['flash_error'] = 'Không tìm thấy dữ liệu loại hồ sơ!';
            redirect(base_url() . 'index.php/do_doc_type_listview');
            return;
        }

        if (empty($cname)) {
            $_SESSION['flash_error'] = 'Vui lòng nhập tên loại hồ sơ / đề xuất!';
            redirect(base_url() . 'index.php/do_doc_type/f_edit/' . $nid);
            return;
        }

        $cdepts_required = (!empty($depts_approve) && is_array($depts_approve)) ? implode(',', array_map('intval', $depts_approve)) : '';
        $cdepts_view     = (!empty($depts_view) && is_array($depts_view)) ? implode(',', array_map('intval', $depts_view)) : '';

        // Xử lý upload file mới nếu có
        $file_template_path = $old_data['cfile_template'];
        if (isset($_FILES['file_template']) && $_FILES['file_template']['name'] != '') {
            $upload_dir = FCPATH . '../upload/doc_type/';
            if (!is_dir($upload_dir)) {
                @mkdir($upload_dir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['file_template']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array('pdf', 'doc', 'docx', 'xls', 'xlsx'))) {
                $_SESSION['flash_error'] = 'Chỉ chấp nhận tệp biểu mẫu PDF, DOC, DOCX, XLS!';
                redirect(base_url() . 'index.php/do_doc_type/f_edit/' . $nid);
                return;
            }

            $filename = 'mau_' . time() . '_' . rand(100, 999) . '.' . $ext;
            $target_file = $upload_dir . $filename;

            if (move_uploaded_file($_FILES['file_template']['tmp_name'], $target_file)) {
                $file_template_path = 'upload/doc_type/' . $filename;
            }
        }

        $update_data = array(
            'ccode'           => !empty($ccode) ? $ccode : $old_data['ccode'],
            'cname'           => $cname,
            'cdescription'    => $cdescription,
            'cfile_template'  => $file_template_path,
            'cdepts_required' => $cdepts_required,
            'cdepts_view'     => $cdepts_view,
            'nstatus'         => $nstatus,
            'cindex'          => $cindex
        );

        if (!$this->db->field_exists('cdepts_view', Fget_ap_table('tdoc_type'))) {
            $this->db->query("ALTER TABLE " . Fget_ap_table('tdoc_type') . " ADD COLUMN `cdepts_view` varchar(255) DEFAULT '' AFTER `cdepts_required`");
        }

        $this->db->where('nid', $nid)->update(Fget_ap_table('tdoc_type'), $update_data);
        $_SESSION['flash_msg'] = 'Cập nhật loại hồ sơ "' . htmlspecialchars($cname) . '" thành công!';
        redirect(base_url() . 'index.php/do_doc_type_listview');
    }

    function f_delete($nid = 0)
    {
        $nid = (int)$nid;
        $this->db->where('nid', $nid)->delete(Fget_ap_table('tdoc_type'));
        $_SESSION['flash_msg'] = 'Đã xóa loại hồ sơ thành công!';
        redirect(base_url() . 'index.php/do_doc_type_listview');
    }

    function f_status($nid = 0)
    {
        $nid = (int)$nid;
        $doc_type = get_doc_type_by_id($nid);
        if (!empty($doc_type)) {
            $new_status = ($doc_type['nstatus'] == 1) ? 0 : 1;
            $this->db->where('nid', $nid)->update(Fget_ap_table('tdoc_type'), array('nstatus' => $new_status));
            $_SESSION['flash_msg'] = 'Đã cập nhật trạng thái hiển thị!';
        }
        redirect(base_url() . 'index.php/do_doc_type_listview');
    }
}
