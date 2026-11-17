<?php 
	$obj_data = Obj_get_cat_product_list_for_menu();
?>
<div>
	<?php echo $lbl_ajax_load_cat_product ?>
</div>
<div>
	<select name="txt_iditem" style="width:250px">
	<?php 
		foreach($obj_data as $data): 
		$m_iditem	= $data['nid_material_products'].'/'.$data['nid'];
		echo $iditem;
	?>
		<option <?php if($m_iditem == $iditem){echo 'selected="selected"';} ?> value="<?php echo $m_iditem ?>"><?php echo $data['cmaterial_products'].' / '.$data['ccat_products'] ?></option>
	<?php endforeach; ?>
	</select>
</div>