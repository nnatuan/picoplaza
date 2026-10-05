<?php 
	$this->load->view('header.php');
	$this->load->view('banner.php');
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('image_product_view/tkb_image_product_listview');
			break;		
		case 'add':
			$this->load->view('image_product_view/tkb_image_product');
			break;
		case 'edit': 
			$this->load->view('image_product_view/tkb_image_product');
			break;
		
		case 'update_add': 
			$this->load->view('image_product_view/tkb_image_product');
			break;		
		case 'update_edit': 
			$this->load->view('image_product_view/tkb_image_product');
			break;

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php		
	$this->load->view('footer');
?>