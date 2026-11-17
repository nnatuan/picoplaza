<?php 
	$this->load->view('header.php');
	$this->load->view('banner.php');
?>
<?php
	switch ($event) 
	{
		case 'view':
			$this->load->view('menu_permission_view/tkb_menu_permission');
			break;			
		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php		
	$this->load->view('footer');
?>