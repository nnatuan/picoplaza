<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	switch ($event) 
	{
		case 'view':
			$this->load->view('file_view/file_listview');
			break;			
		case 'add':
		case 'edit': 
		case 'update_add': 
		case 'update_edit': 
			$this->load->view('file_view/file');
			break;

		default:
			echo $event . ' invalid event view site.';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>