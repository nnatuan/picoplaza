<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('sell_view/sell');
			break;			
		case 'add':
			$this->load->view('sell_view/sell');
			break;
		case 'edit': 
			$this->load->view('sell_view/sell');
			break;
		case 'ghn': 
			$this->load->view('sell_view/ghn');
			break;	
		case 'viettelpost': 
			$this->load->view('sell_view/viettelpost');
			break;	
		case 'viettelpost_login': 
			$this->load->view('sell_view/viettelpost_login');
			break;		
		case 'layout_2': 
			$this->load->view('sell_view/sell_layout_2');
			break;		
		
		case 'update_add': 
			$this->load->view('sell_view/sell');
			break;		
		case 'update_edit': 
			$this->load->view('sell_view/sell');
			break;
		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>