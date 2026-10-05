<?php
	$product_title = '';
	if($iditem != '')
	{
		$obj_data	= Obj_get_product_byid($iditem);
		foreach($obj_data as $data):
			$product_title = $data['cproducts'];
		endforeach;
	}
?>
<div><?php echo $lbl_product_detail ?></div>
<div>
	<input type="text" name="txt_product_title" value="<?php echo $product_title ?>" style="width:300px" disabled="disabled">
	<input type="button" name="txt_select_article" value="<?php echo $btn_choose ?>" onclick="openbox_product('product','<?php echo $lbl_select_product ?>')">
	<input type="hidden" name="txt_iditem" value="<?php echo $iditem ?>" style="width:300px">
</div>
<div id="div_product"></div>
<div id="product">
 	<span id="boxtitle_product" style="overflow:hidden">
		<span id="title_product" style="float:left;width:670px"></span>
		<span id="exit_box" style="float:left;width:20px"><a href="javascript:closebox_product('product')"><b style="color:#fff">X</b></a></span>
	</span>
    <div id="process_lightbox_ajax">
	  <?php $this->load->view('menu_frontend_view/tkb_ajax_load_product_detail_list') ?>
     </div>
</div>