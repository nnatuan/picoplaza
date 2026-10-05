<?php 
	$this->load->view('header');
	$this->load->view('banner');
	$this->load->view('content_style');
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			$this->load->view('news_gallery_view/news_detail_listview');
			break;			
		case 'add':
			$this->load->view('news_gallery_view/news_detail');
			break;
		case 'edit': 
			$this->load->view('news_gallery_view/crop_images');
			break;	
		case 'update_add': 
			$this->load->view('news_gallery_view/news_detail');
			break;		
		case 'update_edit': 
			$this->load->view('news_gallery_view/crop_images');
			break;
			

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php	
	$this->load->view('content_style_end');	
	$this->load->view('footer');
?>