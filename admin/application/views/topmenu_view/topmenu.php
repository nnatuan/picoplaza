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
						<?php echo $lbl_topmenu; ?><?php echo $get_icon_notnull; ?>					</td>
						<td width="400">
							<input style="width:300px;" type="text" width="" name="txt_ctopmenu" value="<?php echo $txt_ctopmenu; ?>">					</td>
				</tr>
				
				<tr>
					<td class="key" width="150" align="right">
					<?php echo $lbl_code; ?><?php echo $get_icon_notnull; ?>					</td>
					<td width="400">
						<input style="width:300px;" type="text" width="" name="txt_clink" value="<?php echo $txt_clink; ?>">					</td>
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
						<?php echo $lbl_note; ?>					</td>
					<td>						
                         <textarea style="width:200px; height:50px" name="txt_cnote"><?php echo $txt_cnote; ?></textarea>	
					</td>
				</tr>
				<tr>
					<td class="key" width="150" align="right">&nbsp;</td>
					<td>
						<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);" class="button"/>
													   
						<input name="btn_cancel" style="width:80px;" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo $link_cancel; ?> '" class="button" />	
					</td>
				</tr>			
				
			<tbody>				
		</table>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
	document.form_main.txt_nid.focus();

function js_VerifyBeforeSubmit (obj_form, btn_name) 
	{
		if (document.form_main.txt_user_name.value=='')
			{
				document.form_main.txt_clink.focus();
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

</script>