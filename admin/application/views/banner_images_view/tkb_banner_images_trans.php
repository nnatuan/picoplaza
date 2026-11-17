<div id="ContentMessage">
	<div id="NoteContentMessage">
		<?php echo $get_message_notnull ?>
	</div>
	
	<div id="ErrorContentMessage">
		<?php echo $error_cbanner_images; ?>

	</div>
</div>		
<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	
	
	<div id="EditContent">
		<table class="EditStyle01" width="100%" >
			<tbody>								
				<tr>
				  <td class="key" align="right"><?php echo $lbl_lang;?></td>
				  <td>
							<div style="width:150px;"><?php echo $gencbo_language_list;?></div>
				  </td>
		          <td class="key" style="text-align:left"><?php echo $lbl_lang.$lbl_first.':  '; ?><div style="display:inline; font-style:italic; color:#003366"><?php echo $lang['clanguage']; ?> </div></td>
			  </tr>
				<tr>
						<td class="key" width="90" align="right">
						<?php echo $lbl_banner_images; ?><?php echo $get_icon_notnull; ?>					</td>
						<td width="200">
							<input style="width:145px;" type="text" width="" name="txt_cbanner_images_trans" value="<?php echo $txt_cbanner_images; ?>">					</td>
		                <td class="key" style="text-align:left"><?php echo $lbl_banner_images.$lbl_first.':  ';  ?><div style="display:inline; font-style:italic; color:#003366"><?php echo Fview_text($data['cbanner_images']); ?></div></td>
				</tr>
								<tr>
						<td class="key" width="95" align="right">
						<?php echo $lbl_status; ?>					</td>
						<td width="200">
							<input type="text" name="txt_nstatus" style="width:145px;" value="<?php echo $txt_nstatus; ?>" />			</td>
		                <td width="700" class="key" style="text-align:left"><?php echo $lbl_status.$lbl_first.':  ';  ?><div style="display:inline; font-style:italic; color:#003366"><?php echo Fview_text($data['nstatus']); ?></div></td>
				</tr>

		
			<tbody>				
		</table>
		<div>
			<input type="button" name="btn_submit" style="width:80px;" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);"/>
													   
						<input name="btn_cancel" style="width:80px;" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo $link_cancel_trans; ?> '" />	
		</div>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input name="hidden_nid_news_org" type="hidden" value = "<?php echo $hidden_nid_news_org; ?>"  />
	
	<input type="hidden" name="hidden_button_click"  value = "" />	

</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
<!--	document.form_main.txt_nid.focus();-->

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

</script>