<?php 
	$obj_data = Obj_get_cat_news_list_for_menu();
?>
<div>
	<?php echo $lbl_ajax_load_cat_news ?>
</div>
<div>
	<select name="txt_iditem" style="width:250px">
	<?php foreach($obj_data as $data): ?>
		<option <?php if($data['nid'] == $iditem){echo 'selected="selected"';} ?> value="<?php echo $data['nid'] ?>"><?php echo $data['csection_news'].' / '.$data['ccat_news'] ?></option>
	<?php endforeach; ?>
	</select>
</div>