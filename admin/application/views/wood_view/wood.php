<div id="ContentMessage">
	<div id="NoteContentMessage">
		
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $error_ctitle; ?>
		<?php echo $error_ccontent; ?>
		<?php echo $error_cshort_content; ?>
	</div>
</div>		
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	
	
	<div id="EditContent">
		<table class="EditStyle01" >
			<tbody>								

				<tr>
						<td class="key" width="150" align="right">
						<?php echo $lbl_title; ?><?php echo $get_icon_notnull; ?>					</td>
						<td width="">
							<input style="width:350px;" type="text" width="" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>">					</td>
				</tr>
				<tr style="display:none">
						<td class="key" width="150" align="right"><?php echo $lbl_author; ?></td>
						<td width="">
							<input style="width:350px;" type="text" width="" name="txt_cauthor" value="<?php echo $txt_cauthor; ?>">					</td>
				</tr>
                <tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_section_news; ?>					</td>
					<td >
						<?php echo $gencbo_section_news_list; ?>	</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">
						<?php echo 'Loại'; ?>					</td>
					<td >
						<?php echo $gencbo_cat_news_list; ?>	</td>
				</tr>
				
				<tr style="display:none">
					<td class="key" width="150" align="right">
						<?php echo $lbl_index; ?>					</td>
					<td >
						<input style="width:100px;" type="text" width="" name="txt_cindex" value="<?php echo $txt_cindex; ?>" maxlength="4" />	
					</td>
				</tr>
				<tr style="height:100px; ">
				
						<td align="right" class="key" style="vertical-align:middle">
					 		<?php echo 'Hình ảnh'; ?>						</td>
						<td style="vertical-align:middle"><input name="txt_cthumb_img" type="file" id="txt_cthumb_img" value ="" size="42" />
						 <div style="position:absolute; top:100px; left:600px; "> 
							<div id="images_div_thumb" style="border:1px #ccc solid; text-align:center;padding:2px;width:200px"> 
							 <?php 
								$url_thumb = base_url().'index.php/do_wood/delete_image_thumb/'.$nid; 
							 ?>
							 <?php 
								if($txt_cthumb_img !='') echo '<img style="width:120px; height:100px" src="'.$fr_img.'upload/image_article/'.$txt_cthumb_img.'  "/>';
								else echo 'no thumb image';
							?>
						 	<?php if($txt_cthumb_img !=''): ?>
								<p style="text-align:center"><a href="#" onclick="javascript:if(confirm('Are you sure to delete?')) ajax_delete_image_thumb_123();">Delete (thumb_img)</a></p>
							<?php endif; ?>
							</div>
						</div>
						</td>
				</tr>
				
				
								<tr style="display:none;">
					<td class="key" width="150" align="right">
						<?php echo $lbl_short_content; ?><?php //echo $get_icon_notnull; ?>					</td>
					 <td colspan="2" style="width:730px;height:250px;">
				  	<?php //echo $fck2;?>
					
					<?php echo $this->fckeditor->Create('txt_cshort_content',$txt_cshort_content,'Basic');?>
					</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">
						<?php echo $lbl_content; ?><?php echo $get_icon_notnull; ?>					</td>
					  <td colspan="2" style="width:730px;height:500px;">
				  	<?php // echo $this->fckeditor->Create('txt_ccontent',$txt_ccontent);?>				  
					<?php echo $this->fckeditor->Create('txt_ccontent',$txt_ccontent,'Basic');?>
					</td>
				</tr>
				<tr style="display:none">
					<td class="key" width="150" align="right">
						<?php echo $lbl_alwcmt; ?>
					</td>
					  <td colspan="2" style="width:730px;">  
					  	<input type="checkbox" name="chk_alwcmt" value="1" <?php if($chk_alwcmt == 1 || $nid == '') echo 'checked="checked"' ?>/>
					  </td>
					</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">&nbsp;
						
					</td>
					  <td colspan="2">  
					  	<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);" class="button"/>
													   
						<input name="btn_cancel" style="width:80px;" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo base_url().'index.php/do_home'; ?> '" class="button"/>	
					  </td>
					</td>
				</tr>
			<tbody>				
		</table>

	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
	<input type="hidden" name="hidden_image_old"  value = "<?php echo $txt_cthumb_img; ?>" />	
	<input type="hidden" name="hidden_image_old_fb"  value = "<?php echo $txt_cfb_img; ?>" />	
	<input type="hidden" name="hidden_image_old_iphone"  value = "<?php echo $txt_ciphone_img; ?>" />	
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >

function js_VerifyBeforeSubmit (obj_form, btn_name) 
	{
		if (document.form_main.txt_user_name.value=='')
			{
				document.form_main.txt_ccode.focus();
				return false;
			}
		if (document.form_main.txt_password.value=='')
			{
				document.form_main.txt_password.focus();
				return false;
			}
		return false;		
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



function ajax_delete_image_thumb_123()
	{
		document.form_main.hidden_image_old.value = '';
		pb_display('<?php echo $url_thumb ?>','images_div_thumb');
	}

</script>