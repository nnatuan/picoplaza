<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<?php	
	
	switch ($event) 
	{
		case 'view':
			//if($view_type=='tmp')
			//	$this->load->view('order_view/order_listview_tmp');
			//else
				$this->load->view('order_view/order_listview');
			break;		
		case 'add':
			$this->load->view('order_view/order');
			break;
		case 'edit': 
			//if($obj_order_view['nstatus']==0)
			//	$this->load->view('order_view/order_tmp');
			//else
				$this->load->view('order_view/order');	
			break;
		
		case 'update_add': 
			$this->load->view('order_view/order');
			break;		
		case 'update_edit': 
			//if($obj_order_view['nstatus']==0)
			//	$this->load->view('order_view/order_tmp');
			//else
				$this->load->view('order_view/order');
			break;

		default:
			echo $event . 'invalid event view site. please cotact with admin site for more informations';
	}
?>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>