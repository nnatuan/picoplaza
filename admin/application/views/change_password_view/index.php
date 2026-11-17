<?php 
	$this->load->view('header.php');
	$this->load->view('banner.php');
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('change_password_view/tkb_change_password_listview');
			break;			
		case 'add':
			$this->load->view('change_password_view/tkb_change_password');
			break;
		case 'edit': 
			$this->load->view('change_password_view/tkb_change_password');
			break;
		case 'update_add': 
			$this->load->view('change_password_view/tkb_change_password');
			break;		
		case 'update_edit': 
			$this->load->view('change_password_view/tkb_change_password');
			break;
		case 'print': 
			$this->load->view('change_password_view/tkb_change_password_print');
			break;
			
		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php		
	$this->load->view('footer');
?>