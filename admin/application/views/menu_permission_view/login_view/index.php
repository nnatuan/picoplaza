<?php
switch ($event) 
	{
		case 'change_password':
		{
			$this->load->view('city_view/tkb_city_listview');
			break;
		}	
		default:
		{
			// your content at here
			$this->load->view('login_view/tkb_login.php');
			$this->load->view('footer');	
			$this->load->view('header_end');			
		}				
	}			
?>
