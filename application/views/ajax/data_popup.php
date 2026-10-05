<?php  
	$nid = $_POST['id'];
	$data = get_product_by_id($nid);

	exit(json_encode($data));
	//exit($data['ccontent']);
?>