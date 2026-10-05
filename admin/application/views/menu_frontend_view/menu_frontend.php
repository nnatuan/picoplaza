<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $lbl_error_msg; ?>
	</div>
</div>		
<form  name="form_main" id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	<div id="EditContent" style="overflow:hidden">
		<table style="width:100%">
			<tr>
				<td style="width:420px" valign="top">
					<table class="EditStyle01" >
						<tbody>		
							<tr>
								<td class="key" width="120" align="right">
								<?php echo $lbl_cmenu; ?>					</td>
								<td width="300">
									<input style="width:250px;" type="text" width="" name="txt_cmenu" value="<?php echo $txt_cmenu; ?>">					</td>
							</tr>
							<tr>
								<td class="key" align="right">
									<?php echo $lbl_nid_function_fronend; ?>					
								</td>
								<td>
									<?php 
										$url = base_url().'index.php/ajax/do_load_menu_type/option/'; 
									?>
									<select name="txt_nid_function_frontend" style="width:250px" onchange="pb_display('<?php echo $url ?>'+this.value,'load_iditem_menu');">
										<option value=""><?php echo '--Chon loai menu--' ?></option>
										<?php foreach($obj_function_frontend as $data): ?>	
										<option <?php if($data['nid'] == $txt_nid_function_frontend){echo 'selected="selected"';} ?> value="<?php echo $data['nid'] ?>"><?php echo $data['cfunction'] ?></option>
										<?php endforeach; ?>
									</select>
								
								</td>
							</tr>							
							<tr>
								<td class="key" align="right">
								<?php echo $lbl_nstatus; ?>					</td>
								<td><?php echo $gen_cbo_status ?></td>
							</tr>
							<tr>
								<td class="key" align="right">
								<?php echo $lbl_cwidth; ?>					</td>
								<td>
									<input style="width:250px;" type="text" width="" name="txt_cwidth" value="<?php echo $txt_cwidth; ?>">				
								</td>
							</tr>
							<tr>
								<td class="key" align="right">
								<?php echo $lbl_nid_parent; ?>					</td>
								<td>
									<?php echo $gencbo_menu_frontend; ?>			
								</td>
							</tr>
							<tr>
								<td class="key" align="right">
								<?php echo $lbl_nindex; ?>					</td>
								<td>
									<input style="width:250px;" type="text" width="" name="txt_nindex" value="<?php echo $txt_nindex; ?>" maxlength="4">				
								</td>
							</tr>
							<tr>
								<td class="key" align="right">
								<?php echo $lbl_cnote; ?>					</td>
								<td>				
									<textarea style="width:250px;" rows="3" name="txt_cnote"><?php echo $txt_cnote; ?></textarea>
								</td>
							</tr>
							<tr>
								<td class="key" align="right">&nbsp;</td>
								<td>				
									<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo $btn_update; ?>" 
										onclick ="js_SetSubmitButtonClick(this.form, this.name);" class="button"/>
																   
									<input name="btn_cancel" style="width:80px;" type="button" 
										   value = "<?php echo $btn_cancel; ?>"
										   onclick="location.href='<?php echo $link_cancel; ?> '" class="button"/>	
								</td>
							</tr>
						<tbody>				
					</table>
				</td>
				<td valign="top">
					<div id="load_iditem_menu">
                    	
                    </div>				
				</td>
			<tr>
		</table>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
	
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