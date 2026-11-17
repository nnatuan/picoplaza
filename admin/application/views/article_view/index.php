<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('article_view/tkb_article_listview');
			break;			
		case 'add':
			$this->load->view('article_view/tkb_article');
			break;
		case 'edit': 
			$this->load->view('article_view/tkb_article');
			break;
		
		case 'update_add': 
			$this->load->view('article_view/tkb_article');
			break;		
		case 'update_edit': 
			$this->load->view('article_view/tkb_article');
			break;
		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>