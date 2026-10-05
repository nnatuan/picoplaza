<div id="ContentMessage">
	<p> Click vào hình cần xem để phóng to.</p>	
    <span id="msg_del"></span>
</div>		
<style type="text/css">
	.img_con {float:left;padding:10px;border:1px solid #ccc;width:120px;height:150px;margin:10px;text-align:center;}
	.img_item{width:100px;height:130px;margin:0 auto;}
	.img_item img{max-width:100px;max-height:130px;}
	#msg_del{color:#F00;font-style:italic;}
</style>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/lightbox-2.6.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url()?>css/lightbox.css" />

<form  name='form_main' id="form_main" method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">	
<div id="SiteContent_main">			
	
	
	<div id="EditContent" style="padding-bottom:30px;">
		<?php 
			$obj_img = get_img_by_cat($nid_cat);
			foreach($obj_img as $img)
			{
		?>
        <div class="img_con" id="<?php echo $img['nid'];?>">
        	<div class="img_item">
            	<img src="<?php echo str_replace('admin','',base_url()).'upload/files/'.$img['cfile'];?>" />
                
            </div>
            <div>
                	<a href="<?php echo str_replace('admin','',base_url()).'upload/files/'.$img['cfile'];?>" class="btn_href" data-lightbox="<?php echo $img['cfile_orgin'];?>" >Xem</a> || <a href="javascript:del_img('<?php echo $img['cfile'];?>','<?php echo $img['nid'];?>')" class="btn_href">Xóa</a>
                </div>
         </div>
        <?php 
		
			}?>
	</div>
	<input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
	<input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
	<input type="hidden" name="hidden_button_click"  value = "" />	
	<div id="errr"></div>
</div>
</form>

<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->

<script type="text/javascript" >
	function del_img(_img,_id)
	{
			 c = confirm("Bạn muốn thực hiện lệnh xóa hình này ?");
  			if (c == true){
			$.post( "<?php echo base_url().'index.php/do_upload/del_img/'?>", { img: _img,id: _id})
			  .done(function( data ) {
				$("#"+_id).hide();
				$("#msg_del").html('Đã xóa hình');
		  });
			}
	}
</script>