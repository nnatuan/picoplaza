<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $m_error_msg; ?>		
	</div>
	
</div>		
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	
	
	<div id="EditContent">
		<table class="EditStyle01" >
			<tbody>								
				<tr>
					<td class="key" width="150" align="right">
					<?php echo $lbl_code; ?><?php echo $get_icon_notnull; ?>					</td>
					<td width="400">
						<input style="width:300px;" type="text" width="" id="txt_ccode" name="txt_ccode" value="<?php echo $txt_ccode; ?>">					
					</td>
				</tr>
				
				<tr>
					<td class="key" width="150" align="right">
					<?php echo $lbl_section_news; ?><?php echo $get_icon_notnull; ?>					</td>
					<td width="400">
						<input style="width:300px;" type="text" width="" name="txt_csection_news" value="<?php echo $txt_csection_news; ?>" onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">					
					</td>
				</tr>
			<!--<tr>
				  <td class="key" align="right"><?php // echo $lbl_lang; ?></td>				
				  <td ><div style="width:157px;"><?php // echo $gencbo_language_list; ?></div></td>
				  <td width="600" ></td>
			  </tr>-->
				<tr>
					<td align="right" class="key">
						<?php echo 'Banner'; ?>						</td>
					<td>
						<input name="txt_cthumb_img" type="file" id="txt_cthumb_img" value ="" size="33" /><br/>Width:944px; height:429px
						<div style="position:absolute; top:188px; left:650px;">
							<div id="images_div">
								<div style="border:1px #CCC solid;width:250px;height:145px">
									<?php 
										$url_banner = base_url().'index.php/do_section_news/delete_image/'.$nid; 
									?>
										
										<?php 
											if($txt_cthumb_img !='') echo '<img width="250" style=" border:solid 2px #999999;"  height="145" src="'.$fr_img.'upload/banner_section/'.$txt_cthumb_img.'  "/>';
											else echo 'No image';
										?>
										
										
										<?php if($txt_cthumb_img !=''): ?>
											<p style="text-align:center"><a href="#" onclick="javascript:ajax_delete_image();">Delete (Banner)</a></p>
										<?php else: ?>
											<p style="text-align:center">Banner</p>
										<?php endif; ?>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td align="right" class="key">
						<?php echo 'Icon'; ?>						</td>
					<td>
						<input name="txt_cthumb_img_icon" type="file" id="txt_cthumb_img_cion" value ="" size="33" /><br/>Width:250px; height:145px
						<div style="position:absolute; top:388px; left:650px;">
							<div id="images_div_icon">
								<div style="border:1px #CCC solid;width:150px;height:70px">
								<?php 
									$url_icon = base_url().'index.php/do_section_news/delete_image_icon/'.$nid; 
								?>
									<?php 
										if($txt_cthumb_img_icon !='') echo '<img width="150" style=" border:solid 2px #999999;"  height="70" src="'.$fr_img.'upload/banner_section/thumb/'.$txt_cthumb_img_icon.'  "/>';
										else echo 'No image';
									?>
									<?php if($txt_cthumb_img_icon !=''): ?>
										<p style="text-align:center"><a href="#" onclick="javascript:ajax_delete_image_icon();">Delete (Icon)</a></p>
									<?php else: ?>
										<p style="text-align:center">Icon</p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</td>
				</tr>
				
								<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_status; ?>					</td>
					<td width="400"><?php echo $gen_cbo_status;?></td>
				</tr>
								<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_index; ?>					</td>
					<td width="400">
						<input style="width:300px;" type="text" name="txt_cindex" value="<?php echo $txt_cindex; ?>" maxlength="4"/>					</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_tag; ?>					</td>
					<td width="400">
						<textarea style="width:300px; height:100px" name="txt_ctag"><?php echo $txt_ctag; ?></textarea></td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_note; ?>					</td>
					<td width="400">
						<textarea style="width:300px; height:100px" name="txt_cnote"><?php echo $txt_cnote; ?></textarea></td>
				</tr>
				<tr>
					<td></td>
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
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
	<input type="hidden" name="hidden_image_old"  value = "<?php echo $txt_cthumb_img; ?>" />
	<input type="hidden" name="hidden_image_old_icon"  value = "<?php echo $txt_cthumb_img_icon; ?>" />
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
	document.form_main.txt_nid.focus();

function ajax_delete_image()
	{
		document.form_main.hidden_image_old.value = '';
		pb_display('<?php echo $url_banner ?>','images_div');
	}

function ajax_delete_image_icon()
	{
		document.form_main.hidden_image_old_icon.value = '';
		pb_display('<?php echo $url_icon ?>','images_div_icon');
	}

/*-------------------------------------------------------------------------------------
* Tokaban Corp 1509
* Package : TKB PHP SYSTEM CODE
*--------------------------------------------------------------------------------------
* huanlv77 - 1509/06/28.
*--------------------------------------------------------------------------------------
* Ham submit form co su dung su kien hidden de truyen bien flag dieu khien.
* Nhiem vu gan gia tri cho bien hidden dieu khien nut nhan submit cua form.
* Dung de controller nhan biet nut submit nao duoc nhan tren giao dien de xu ly tren server script.
* Ham nay duoc dung chung cho toan bo ung dung.
* Nen xay dung thanh chuan de tai su dung cho nhung du an khac.
*--------------------------------------------------------------------------------------*/
function js_SetSubmitButtonClick(obj_form, btn_name) 
	{
		obj_form.hidden_button_click.value = btn_name;
		obj_form.submit();		
	}	

</script>