<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('banner_images_view/tkb_banner_images_listview');
			break;			
		case 'add':
			$this->load->view('banner_images_view/tkb_banner_images');
			break;
		case 'edit': 
			$this->load->view('banner_images_view/tkb_banner_images');
			break;
		case 'update_add_trans':
			$this->load->view('banner_images_view/tkb_banner_images_trans');
			break;
		case 'edit_trans': 
			$this->load->view('banner_images_view/tkb_banner_images_trans');
			break;			
		case 'update_add': 
			$this->load->view('banner_images_view/tkb_banner_images');
			break;		
		case 'update_edit': 
			$this->load->view('banner_images_view/tkb_banner_images');
			break;
		case 'update_edit_trans': 
			$this->load->view('banner_images_view/tkb_banner_images_trans');
			break;
		case 'list_trans': 
			$this->load->view('banner_images_view/tkb_trans_listview');
			break;
			

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>