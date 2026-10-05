<?php

	$news_title = '';
	if($iditem != '')
	{
		$obj_news	= Obj_get_news_byid($iditem);
		foreach($obj_news as $data_news):
			$news_title = $data_news['ctitle'];
		endforeach;
	}
?>
<div><?php echo $lbl_ajax_load_article ?></div>
<div>
	<input type="text" name="txt_news_title" value="<?php echo $news_title ?>" style="width:300px" disabled="disabled">
	<input type="button" name="txt_select_article" value="Chon" onclick="openbox_article('article','<?php echo $lbl_select_article ?>')"  class="button"/>
	<input type="hidden" name="txt_iditem" value="<?php echo $iditem ?>" style="width:300px">
</div>
<div id="div_article"></div>
<div id="article">
 	<span id="boxtitle_article" style="overflow:hidden">
		<span id="title_article" style="float:left;width:670px"></span>
		<span id="exit_box" style="float:left;width:20px"><a href="javascript:closebox_article('article')"><b style="color:#fff">X</b></a></span>
	</span>
    <div id="process_lightbox_ajax">
	  <?php $this->load->view('menu_frontend_view/ajax_load_article_list') ?>
     </div>
</div>