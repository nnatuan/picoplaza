<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	switch ($event) 
	{
		case 'view':
			$this->load->view('menu_view/menu_listview');
			break;			
		case 'add':
		case 'edit': 
		case 'update_add': 
		case 'update_edit': 
			$this->load->view('menu_view/menu');
			break;

		default:
			echo $event . ' invalid event view site.';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>