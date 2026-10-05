<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Do_file extends CI_Controller
{
    var $m_nid_user_login    = '';
    var $m_nid               = ''; 
    var $m_event             = '';
    var $m_button_click      = '';
    var $m_link_page         = '';
    var $m_link_cancel       = '';
    var $m_form_title        = '';
    
    // Thuộc tính dữ liệu
    var $m_txt_ctitle        = '';
    var $m_txt_cdescription  = '';
    var $m_cbof_ctype        = 'document'; // document (mẫu biểu), rules (nội quy - quy định), internal (tài liệu nội bộ staff)
    var $m_cbof_caccess_type = 'public';   // public (công khai), member (cư dân)
    var $m_cbof_nstatus      = '1';
    var $m_txt_cfile_path    = '';
    var $m_txt_cfile_size    = '';
    
    var $m_error_msg         = '';

    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper(array('ap_db', 'ap_function', 'ap_html', 'ap_view', 'ap_object'));
        $this->config->check_system_login = '1';
        
        $this->m_link_page   = base_url() . 'index.php/do_file/do_process';
        $this->m_link_cancel = base_url() . 'index.php/do_file_listview';
		
		if (!check_staff_permission(array('admin'))) {
			echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
			exit();
		}
    }

    function index() {
        $this->f_add();
    }

    function f_add() {
        $this->m_event      = 'add';
        $this->m_form_title = 'Tải lên Tập tin / Mẫu biểu mới';
        $this->do_process();
    }

    function f_edit($nid) {
        $this->m_event      = 'edit';
        $this->m_nid        = $nid;
        $this->m_form_title = 'Chỉnh sửa thông tin Tập tin / Mẫu biểu';
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
            $this->m_txt_ctitle        = trim($_POST['txt_ctitle']);
            $this->m_txt_cdescription  = trim($_POST['txt_cdescription']);
            $this->m_cbof_ctype        = $_POST['cbof_ctype'];
            $this->m_cbof_caccess_type = $_POST['cbof_caccess_type'];
            $this->m_cbof_nstatus      = $_POST['cbof_nstatus'];
            $this->m_txt_cfile_path    = isset($_POST['txt_old_file_path']) ? $_POST['txt_old_file_path'] : '';
            $this->m_txt_cfile_size    = isset($_POST['txt_old_file_size']) ? $_POST['txt_old_file_size'] : '';
        }
    }

	private function check_data()
	{
		if ($this->m_txt_ctitle == '') {
			$this->m_error_msg = 'Vui lòng nhập tên/tiêu đề tập tin mẫu biểu.'; 
			return '0';
		}

		// Xử lý Upload file từ máy tính ra THƯ MỤC GỐC NGOÀI ADMIN
		if (isset($_FILES['file_upload']) && $_FILES['file_upload']['name'] != '') {
			
			// 1. Kiểm tra lỗi hệ thống khi upload
			if ($_FILES['file_upload']['error'] !== UPLOAD_ERR_OK) {
				if ($_FILES['file_upload']['error'] == UPLOAD_ERR_INI_SIZE || $_FILES['file_upload']['error'] == UPLOAD_ERR_FORM_SIZE) {
					$this->m_error_msg = 'Dung lượng file vượt quá giới hạn của hệ thống.';
				} else {
					$this->m_error_msg = 'Lỗi trong quá trình upload file (Mã lỗi: ' . $_FILES['file_upload']['error'] . ')';
				}
				return '0';
			}

			// 2. GIỚI HẠN DUNG LƯỢNG TỐI ĐA 20 MB
			$max_size_mb = 20;
			$max_size_bytes = $max_size_mb * 1024 * 1024; // 20 MB = 20,971,520 Bytes

			if ($_FILES['file_upload']['size'] > $max_size_bytes) {
				$this->m_error_msg = 'Dung lượng file vượt quá giới hạn cho phép (' . $max_size_mb . ' MB).';
				return '0';
			}

			// 3. Kiểm tra định dạng file (Tránh upload file thực thi nguy hiểm)
			$allowed_exts = array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'jpg', 'jpeg', 'png', 'zip', 'rar');
			$file_ext = strtolower(pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION));

			if (!in_array($file_ext, $allowed_exts)) {
				$this->m_error_msg = 'Định dạng file không được hỗ trợ (Chỉ chấp nhận: ' . implode(', ', $allowed_exts) . ').';
				return '0';
			}
			
			$rel_dir = 'upload/file/';                       // Đường dẫn tương đối lưu database
			$target_dir = FCPATH . '../' . $rel_dir;        // Trỏ thẳng ra thư mục gốc pico-saigon/upload/file/
			
			if (!is_dir($target_dir)) {
				mkdir($target_dir, 0777, true);
			}

			$file_name = time() . '_' . strtolower(preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['file_upload']['name']));
			$target_file = $target_dir . $file_name;

			// Dùng move_uploaded_file để đẩy thẳng ra thư mục gốc
			if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file)) {
				
				// Lưu vào DB dạng: "upload/file/1712345678_file.pdf"
				$this->m_txt_cfile_path = $rel_dir . $file_name;
				$this->m_txt_cfile_size = round($_FILES['file_upload']['size'] / (1024 * 1024), 2) . ' MB';
				
			} else {
				$this->m_error_msg = 'Không thể tải file lên thư mục server gốc.';
				return '0';
			}
		} else {
			if ($this->m_event == 'add') {
				$this->m_error_msg = 'Vui lòng đính kèm tập tin cần tải lên!'; 
				return '0';
			}
		}

		return '1';
	}

	/*
    private function check_data()
    {
        if ($this->m_txt_ctitle == '') {
            $this->m_error_msg = 'Vui lòng nhập tên/tiêu đề tập tin mẫu biểu.'; return '0';
        }

        // Xử lý Upload file từ máy tính ra THƯ MỤC GỐC NGOÀI ADMIN
        if (isset($_FILES['file_upload']) && $_FILES['file_upload']['name'] != '') {
            
            $rel_dir = 'upload/file/';                       // Đường dẫn tương đối lưu database
            $target_dir = FCPATH . '../' . $rel_dir;        // Trỏ thẳng ra thư mục gốc pico-saigon/upload/file/
            
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_name = time() . '_' . strtolower(preg_replace('/[^a-zA-Z0-9._-]/', '', $_FILES['file_upload']['name']));
            $target_file = $target_dir . $file_name;

            // Dùng move_uploaded_file để đẩy thẳng ra thư mục gốc
            if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file)) {
                
                // Lưu vào DB dạng: "upload/file/1712345678_file.pdf"
                $this->m_txt_cfile_path = $rel_dir . $file_name;
                $this->m_txt_cfile_size = round($_FILES['file_upload']['size'] / (1024 * 1024), 2) . ' MB';
                
            } else {
                $this->m_error_msg = 'Không thể tải file lên thư mục server gốc.';
                return '0';
            }
        } else {
            if ($this->m_event == 'add') {
                $this->m_error_msg = 'Vui lòng đính kèm tập tin cần tải lên!'; return '0';
            }
        }

        return '1';
    }
	*/

    private function load_data()
    {
        if ($this->m_event == 'edit' && $this->m_nid != '') {
            $row = Obj_get_file_row($this->m_nid);
            if (!empty($row)) {
                $this->m_txt_ctitle        = $row['ctitle'];
                $this->m_txt_cdescription  = $row['cdescription'];
                $this->m_cbof_ctype        = $row['ctype'];
                $this->m_cbof_caccess_type = $row['caccess_type'];
                $this->m_cbof_nstatus      = $row['nstatus'];
                $this->m_txt_cfile_path    = $row['cfile_path'];
                $this->m_txt_cfile_size    = $row['cfile_size'];
            }
        }
    }

    private function do_business()
    {
        $data_file = array(
            'ctitle'        => $this->m_txt_ctitle,
            'cdescription'  => $this->m_txt_cdescription,
            'cfile_path'    => $this->m_txt_cfile_path,
            'cfile_size'    => $this->m_txt_cfile_size,
            'ctype'         => $this->m_cbof_ctype,
            'caccess_type'  => $this->m_cbof_caccess_type,
            'nstatus'       => (int)$this->m_cbof_nstatus,
            'dupdated_at'   => date('Y-m-d H:i:s')
        );

        if ($this->m_event == 'add') {
            $data_file['cdel']          = '0';
            $data_file['nuser_created'] = $this->m_nid_user_login;
            $data_file['dcreated_at']   = date('Y-m-d H:i:s');
            
            $this->db->insert(Fget_ap_table('tfiles'), $data_file);
        } 
        elseif ($this->m_event == 'edit') {
            $this->db->where('nid', (int)$this->m_nid)->update(Fget_ap_table('tfiles'), $data_file);
        }

        redirect($this->m_link_cancel);
    }

    private function show_view()
    {
        $data['lbl_form_title']     = $this->m_form_title;
        $data['link_page']          = $this->m_link_page;
        $data['link_cancel']        = $this->m_link_cancel;
        $data['m_message']          = $this->m_error_msg;
        $data['nid']                = $this->m_nid;
        $data['event']              = $this->m_event;

        $data['txt_ctitle']         = $this->m_txt_ctitle;
        $data['txt_cdescription']   = $this->m_txt_cdescription;
        $data['cbof_ctype']         = $this->m_cbof_ctype;
        $data['cbof_caccess_type']  = $this->m_cbof_caccess_type;
        $data['cbof_nstatus']       = $this->m_cbof_nstatus;
        $data['txt_cfile_path']     = $this->m_txt_cfile_path;
        $data['txt_cfile_size']     = $this->m_txt_cfile_size;

        $data['menu_active']        = 'file';

        $this->load->view('file_view/index.php', $data);
    }
}