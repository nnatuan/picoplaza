<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>	
		<?php	header("Content-Type: text/html; charset=UTF-8"); ?>			
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />					
		<meta name="author" content="huan_lv77@tokaban.com - http://www.tokaban.com" />
		<meta name="description" content="Tokaban Solutions" />
		<meta name="keywords" content="Tokaban  Solutions" />
		<meta name="robots" content="all" />
		<meta name="rating" content="general" />
		<meta name="copyright" content="Copyright (c) Tokaban " />
				
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>tkb_css/tkb_icon.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>tkb_css/tkb_style_normal.css" />
				
		<link href="<?php echo base_url()?>tkb_images/tkb_title_icon.gif" rel="shortcut icon" type="image/x-icon" />
		
		<title><?php echo $this->lang->line('lbl.Application.Name') ?></title>
		
	</head> 
<body> <!-- BEGIN BODY TAG. End tag must define at footer file. -->	


<div id="SiteContent" style="border:0 none;margin-top:0;padding-top:10px;">
	<div id="login_form">
		<div id="login_left">
			<embed src="<?php echo base_url();?>tkb_flash/viettel05.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="401" height="482"></embed>
		</div>
		<div id="login_right">
			<div style="text-align:center;color:#CCCCCC;padding-top:270px;">
				<h1> <?php echo $lbl_form_title ?> </h1>
				<div style="margin:5px 0 10px 0;"> <?php echo $lbl_form_slogan ?> </div>
				<div style="color:#FF6600;">
					<?php
						if(trim($error_message)!='')
							echo $error_message;
					?>
				</div>		
				<form action=<?php echo $link_page; ?> method="post" name="form_main" 
				onsubmit="return js_VerifyBeforeSubmit(this.form, 'btn_login');">
				<fieldset >
					<div style="overflow:hidden">
						<div style="float:left;width:230px;text-align:right">
							<label for="user_name"><?php echo $lbl_user_name ?>: </label>
						</div>
						<div style="float:left;width:150px;padding-left:5px;">
							<input type="text" name="txt_user_name" 
							value="<?php echo $txt_user_name; ?>" 
							id="user_name" style="width:150px;" 
							alt="User login" />
						</div>
					</div>
					<div style="overflow:hidden;margin-top:5px;">
						<div style="float:left;width:230px;text-align:right">
							<label for="password"><?php echo $lbl_password ?>: </label>
						</div>
						<div style="float:left;width:150px;padding-left:5px;">
							<input type="password" name="txt_password" value="<?php echo $txt_password?>" id="password" style="width:150px;" />
						</div>
					</div>
				</fieldset>
				<div style="padding:0 0 0 70px;">
						<input type="button" name="btn_login" value = "<?php echo $btn_login ?>" 
						onclick ="js_SetSubmitButtonClick(this.form, this.name);"/>	
				</div>
					<input type="hidden" name="hidden_event_index"  value = "" />
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" >
	document.form_main.txt_user_name.focus();

function js_VerifyBeforeSubmit (obj_form, btn_name) 
	{
		if (document.form_main.txt_user_name.value=='')
			{
				document.form_main.txt_user_name.focus();
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
		obj_form.hidden_event_index.value=btn_name;
		obj_form.submit();		
	}		
</script>
