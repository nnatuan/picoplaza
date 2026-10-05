<?php 
	$this->load->view('header');
	$this->load->view('banner');
	$this->load->view('content_style');
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('upload_view/tkb_upload_listview');
			break;		
		case 'add':
			$this->load->view('upload_view/tkb_upload');
			break;
		case 'edit': 
			$this->load->view('upload_view/tkb_upload');
			break;
		
		case 'update_add': 
			$this->load->view('upload_view/tkb_upload');
			break;		
		case 'update_edit': 
			$this->load->view('upload_view/tkb_upload');
			break;

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php	
	$this->load->view('content_style_end');	
	$this->load->view('footer');
?>