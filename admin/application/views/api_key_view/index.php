<?php 
	$this->load->view('header');
	$this->load->view('banner');
	$this->load->view('content_style');
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('api_key_view/tkb_api_key_listview');
			break;			
		case 'add':
			$this->load->view('api_key_view/tkb_api_key');
			break;
		case 'edit': 
			$this->load->view('api_key_view/tkb_api_key');
			break;
		
		case 'update_add': 
			$this->load->view('api_key_view/tkb_api_key');
			break;		
		case 'update_edit': 
			$this->load->view('api_key_view/tkb_api_key');
			break;
		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php		
	$this->load->view('content_style_end');	
	$this->load->view('footer');
?>