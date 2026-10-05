<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	
	switch ($event) 
	{
		case 'update_list':
			$this->load->view('product_gallery_view/gallery_listview');
			break;			
		case 'add':
			$this->load->view('product_gallery_view/gallery_detail');
			break;
		case 'edit': 
			$this->load->view('product_gallery_view/crop_images');
			break;	
		case 'update_add': 
			$this->load->view('product_gallery_view/gallery_detail');
			break;		
		case 'update_edit': 
			$this->load->view('product_gallery_view/crop_images');
			break;
			

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>