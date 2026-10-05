<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $lbl_error_msg; ?>
	</div>
</div>		
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	
	
	<div id="EditContent">
		<table class="EditStyle01" >
			<tbody>	
				<tr>
						<td class="key">
						<?php echo $lbl_ccode; ?><?php echo $get_icon_notnull; ?>					</td>
						<td>
							<input style="width:250px;" type="text" name="txt_ccode" value="<?php echo $txt_ccode; ?>">					</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_cimage; ?><?php echo $get_icon_notnull; ?>					</td>
					<td width="400">
						<div style="position:relative">
						<input name="txt_cimage" type="file" id="txt_cimage" size="25" style="width:300px;"/>
						<p style="color:#FF0000"><b>Chú ý</b>: Chỉ upload các hình có định dạng: gif, png, jpg<br/> và có kích thước chuẩn là rộng: 450px, cao: 338px </p>
						<?php if($txt_cimage != ''): ?>
							  <img  width="133" style="position:absolute; top:-10px; right:-50px;" src="<?php echo $fr_img.'upload/images_product/full_images/'.$txt_cimage; ?>"/>
						<?php endif; ?>
						</div>
					</td>
				</tr>							
				<tr>
						<td class="key">
						<?php echo $lbl_index; ?>					</td>
						<td>
							<input style="width:250px;" type="text" maxlength="4" name="txt_cindex" value="<?php echo $txt_cindex; ?>" maxlength="4"/>					
							</td>
				</tr>
                <tr>
						<td class="key">
						<?php echo $lbl_nstatus; ?>					</td>
						<td><?php echo $gen_cbo_status ?></td>
				</tr>
				<tr>
						<td class="key">
						<?php echo $lbl_cnote; ?></td>
						<td>
							<textarea name="txt_cnote" style="width:250px;" width=""><?php echo $txt_cnote; ?></textarea>					</td>
				</tr>
			
			
			<tbody>				
		</table>
		<div>
			<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);"/>
													   
						<input name="btn_cancel" style="width:80px;" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo $link_cancel; ?> '" />	
		</div>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_nid_product" type="hidden" value = "<?php echo $nid_product; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />
	<input name="hidden_image_old" type="hidden" value = "<?php echo $txt_cimage; ?>"  />
	<input name="hidden_image_old_resize" type="hidden" value = "<?php echo $txt_cimage_resize; ?>"  />	
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
function js_SetSubmitButtonClick(obj_form, btn_name) 
	{
		obj_form.hidden_button_click.value = btn_name;
		obj_form.submit();		
	}	

</script>