<?php
class portal extends CI_Controller
{
    var $title = 'Portal';
    var $tags = '';
    var $description = '';

    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_function');
        $this->load->helper('ap_object');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_db');
        $this->load->helper('ap_module');
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
        
    }

    private function caculate_data()
    {
		if (!isset($_SESSION['session_nid_member'])) {
            redirect(base_url() . 'auth');
        }
    }
    private function do_business()
    {	
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
        
		if (isset($_SESSION['session_nid_member'])) {
            $member = get_member_by_id($_SESSION['session_nid_member']);
            
            $data['txt_name']  = $member['cfullname'];
            $data['txt_email'] = $member['cemail'];
			$data['readonly']  = 'readonly="readonly" style="background-color: var(--paper-3); cursor: not-allowed; color: var(--text-soft);"';
        } else {
			$data['txt_name']  = '';
            $data['txt_email'] = '';
		}
		
        $data['menu_top'] = 'portal';

        $this->load->view('portal', $data);
    }
    private function destroy_data()
    {
    }
}