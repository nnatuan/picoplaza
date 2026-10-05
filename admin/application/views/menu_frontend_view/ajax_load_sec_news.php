<?php 
	$obj_data = Obj_get_sec_news_list();
?>
<div><?php echo $lbl_ajax_load_sec_news ?></div>
<div>
	<select name="txt_iditem" style="width:250px">
	<?php foreach($obj_data as $data): ?>
		<option <?php if($data['nid'] == $iditem){echo 'selected="selected"';} ?> value="<?php echo $data['nid'] ?>"><?php echo $data['csection_news'] ?></option>
	<?php endforeach; ?>
	</select>
</div>