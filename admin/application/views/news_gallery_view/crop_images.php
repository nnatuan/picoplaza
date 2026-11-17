<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="aspoon.com" />
	<title>Crop images</title>
	<script type="text/javascript" src="<?php echo base_url().'js/jquery-1.4.3.min.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'js/jquery.imgareaselect.min.js' ?>"></script>
</head>
<body>
<?php

	$thumb_width = 118;
	$thumb_height = 118;
	
	$path_image_full	= '.././upload/images_news/full_images/'.$txt_cthumb_img;
	$current_large_image_width = getWidth($path_image_full);
	$current_large_image_height = getHeight($path_image_full);
	
?>
<script type="text/javascript">

function preview(img, selection) { 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("You must make a selection first");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
});

</script>
<h2>Create Thumbnail</h2>
	<div align="center">
		<img src="<?php echo $fr_img.'upload/images_news/full_images/'.$txt_cthumb_img; ?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
		<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
			<img src="<?php echo $fr_img.'upload/images_news/full_images/'.$txt_cthumb_img; ?>" style="position: relative;" alt="Thumbnail Preview" />
		</div>
		<br style="clear:both;"/>
		<br style="clear:both;"/>
		<br style="clear:both;"/>
		<form name="form_main" action="<?php echo $link_page; ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
			<input type="hidden" name="hidden_button_click"  value = "" />
			<input type="hidden" name="hidden_image_old"  value = "<?php echo $txt_cthumb_img; ?>" />	
			<input type="button" name="btn_submit" value ="<?php echo 'Save Thumbnail'; ?>"  id="save_thumb"
							onclick ="js_SetSubmitButtonClick(this.form, this.name);" class="button"/>
			<input name="btn_cancel" type="button" 
			   value = "<?php echo 'Back to product list'; ?>"
			   onclick="location.href='<?php echo base_url().'index.php/do_news_img/get_gallery/'.$nid_product; ?> '" class="button" />
		</form>
		<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

		<script type="text/javascript" >
		function js_SetSubmitButtonClick(obj_form, btn_name) 
			{
				obj_form.hidden_button_click.value = btn_name;
				obj_form.submit();		
			}	
		
		</script>
	</div>
<hr />
<!-- Copyright (c) 2008 http://www.webmotionuk.com -->
</body>
</html>