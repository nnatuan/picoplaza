<?php
class gallery extends CI_Controller
{
    var $title = '';
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

    }
    private function do_business()
    {	
		$this->title = "Gallery";
        $data['title']       = $this->title;
        $data['tags']        = $this->tags;
        $data['description'] = $this->description;
        $data['menu_cat']    = '';
        $data['menu_news']   = '';
        $data['menu_top'] = 'gallery';
		
		$gallery_list = get_gallery();
		foreach ($gallery_list as $k => $item) {
			$sub_imgs = get_gallery_img($item['nid']);
			$img_arr = array();
			
			// Nếu có danh sách ảnh con thì lấy danh sách ảnh con
			if (!empty($sub_imgs)) {
				foreach ($sub_imgs as $sub) {
					$img_arr[] = base_url() . 'upload/gallery/' . $sub['cimg'];
				}
			} else {
				// Nếu không có ảnh con thì lấy ảnh đại diện chính của Album
				$img_arr[] = base_url() . 'upload/gallery/' . $item['cimage'];
			}
			
			$gallery_list[$k]['sub_images'] = $img_arr;
		}

		$data['list'] = $gallery_list;

        $this->load->view('gallery', $data);
    }
    private function destroy_data()
    {
    }
}