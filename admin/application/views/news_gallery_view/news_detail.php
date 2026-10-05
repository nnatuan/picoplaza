<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	<div id="ErrorContentMessage">
		<?php echo $m_error_msg; ?>		
	</div>
</div>

<style type="text/css">
.items{width:140px;float:left;height:155px;}
</style>
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	<div id="EditContent">
		<h3>Upload Photo</h3>
		Photo <input type="file" name="txt_cthumb_img" size="30" /> 
		<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo 'Upload'; ?>" 
							onclick ="js_SetSubmitButtonClick2(this.form, this.name);" class="button"/>
		
		<p>&nbsp;</p>
		<p style="color:#FF0000;">Using picture with size 740 x 400 px</p>
		<p>&nbsp;</p>
			
	<div>
	<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
	   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
			'<?php echo $msg_confirm_before_delete; ?>' ,
			'<?php echo $msg_invalid_before_delete;  ?>' )" class="button"/>
											   
	<input name="btn_cancel" type="button" 
		   value = "<?php echo 'Trở về'; ?>"
		   onclick="location.href='<?php echo base_url().'index.php/do_news_listview'; ?> '" class="button" />
	<span>Check all </span>
	<input name="chkItems" type="checkbox" class="checkbox" 
									   onclick="js_CheckAllClick(this,this.name);" />
	</div>
		<fieldset class="studio">
			<legend>List images</legend>
			<?php
				$obj_data	= Obj_get_news_img($nid_product);
			?>
			
			<?php  
				$count = 1;
				$num_colum = 7;	
				foreach($obj_data as $data): 
			?>
			<?php if($count > 1 && $count%$num_colum == 1): ?>
			</div>
			<?php endif; ?>
			<?php if($count == 1 OR $count%$num_colum == 1 ): ?>
			<div class="row_item">
			<?php endif; ?>
			
				<div class="items">
					<a href="<?php echo base_url().'index.php/do_news_img/f_edit/'.$data['nid'] ?>">
					<?php if($data['cimage_thumb'] != ''): ?>
						<img src="<?php echo $fr_img.'upload/images_news/thumb_images/'.$data['cimage_thumb']; ?>" alt="<?php echo $data['cgallery_detail'] ?>" />
					<?php else: ?>
						<img src="<?php echo base_url().'images/no_image.jpg'; ?>" alt="no_image" />
					<?php endif; ?>
					</a><br />
					<input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>"
								id="chkItems" class="checkbox" 								   
								onclick="js_CheckItemClick(this, 'chkItems','chkItems');" /> 
					<span class="title_name"><?php echo $data['cgallery_detail'] ?></span>
				</div>
				
			<?php if($count == count($obj_data)): ?>
			</div>
			<?php endif; ?>
			<?php
				$count++;  
				endforeach; 
			?>
		</fieldset>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input name="hidden_nid_product" type="hidden" value = "<?php echo $nid_product; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
	<input type="hidden" name="hidden_button"  id="hidden_button"/>
	<input type="hidden" name="hidden_image_old"  value = "<?php echo $txt_cthumb_img; ?>" />
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
function js_SetSubmitButtonClick2(obj_form, btn_name) 
	{
		obj_form.hidden_button_click.value = btn_name;
		obj_form.submit();		
	}	

</script>