<?php
class ajax_game extends Controller
{
    function ajax_game()
    {
        parent::Controller();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');
        $this->load->helper('ap_object');
        $this->load->helper('ap_function');
        $this->load->helper('ap_view');
        $this->load->helper('ap_module');
        $this->load->helper('ap_cart');
        $this->load->helper('ap_mail');
    }
    function ajax_update_gift()
    {
       	$id_cart= '';$prize='';$_var01='';
       	if (isset($_POST['cart_id']))
			$id_cart = $_POST['cart_id'];
		if (isset($_POST['prize']))
			$prize = $_POST['prize'];
		//if (isset($_POST['_var01']))
		//	$_var01 = $_POST['_var01'];
		$_var01 = "end";
		//$_var01 = $_var01 -1;
		$_SESSION["_var01"]= $_var01; 
		
		$data = array(
						'nid_cart' => $id_cart,
						'cgift' => $prize,
						'cdate' => date("Ymd")
						
					);
					$this->db->insert('tgift', $data);
		$_SESSION["luot_quay"] = 0; 
		
		$this->db->set('nactive', 1);
		$this->db->where('ccode', $_SESSION["code_vqmm"]);
		$this->db->update('tcode_vqmm');
		$_SESSION["code_vqmm"] = NULL; 
		exit("ok");
    }

	function ajax_post_cart2()
	{
		$ds = []; 
        $qty_pro = '';
        if (isset($_POST['ds']))
			$ds = $_POST['ds'];
        if (isset($_POST['qty_pro']))
            $qty_pro = $_POST['qty_pro'];
		for ($i=0; $i<count($ds); $i++)
			add_cart($ds[$i], $qty_pro);
		exit("done");
	}
    
}
	