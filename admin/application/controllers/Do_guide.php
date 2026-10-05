<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * =================================================================
 * PICO SAIGON Standard System - User Guide Controller.
 * CodeIgniter Framework for PHP.
 * =================================================================
 */   

class Do_guide extends CI_Controller
{    
    function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->database();

        $this->load->helper('ap_db');
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_object');
        
        $this->config->check_system_login = '1';  

        if (!check_staff_permission('admin')) {
            echo "<script>alert('Bạn không có quyền truy cập chức năng này!'); window.location.href='" . base_url() . "index.php/do_home';</script>";
            exit();
        }
    }

    function index()
    {
        $data['menu_active'] = 'guide';
        $data['fr_img']      = str_replace('admin/', '', base_url());

        // Đẩy thẳng dữ liệu ra view tổng layout của hệ thống
        $this->load->view('guide_view/index', $data);
    }
}