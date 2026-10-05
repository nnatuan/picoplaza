<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $error_ccode ?>
		<?php echo $error_cchange_password; ?>
	</div>
</div>		
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" >	
<div id="SiteContent_main">			
	
	
	<div id="EditContent">
		<table class="EditStyle01" >
			<tbody>	
				<tr>
					<td class="key">
						<?php echo $lbl_username; ?>					
					</td>
					<td >
						<label><?php echo $username_login; ?></label>					
					</td>			
				</tr>							
				<tr>
					<td class="key">
						<?php echo $lbl_old_password; ?><?php echo $get_icon_notnull; ?>					
					</td>
					<td >
						<input type="password" name="txt_old_password" value ="<?php echo $txt_old_password ?>" size="20" />					
					</td>			
				</tr>
				
				<tr>
					<td class="key">
						<?php echo $lbl_new_password; ?>
						<?php echo $get_icon_notnull; ?>					
					</td>
					<td >
						<input type="password" name="txt_new_password" value ="<?php echo $txt_new_password ?>" size="20" />					
					</td>				
				</tr>
				<tr>
				  	<td class="key">
						<?php echo $lbl_comfirm_password; ?>
						<?php echo $get_icon_notnull; ?>
					</td>
				  	<td >
				  	<input type="password" name="txt_comfirm_password" value ="<?php echo $txt_comfirm_password; ?>" size="20" />				  
					</td>
			  </tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type="button" name="btn_submit" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);"/>
													   
						<input name="btn_cancel" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo $link_cancel; ?> '" />					
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
	document.form_main.txt_old_password.focus();

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
* Tokaban Corp 2009
* Package : TKB PHP SYSTEM CODE
*--------------------------------------------------------------------------------------
* huanlv77 - 2009/06/28.
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