
<div>
	<table class="ViewStyle01" width="100%" cellspacing="1" border="0">
		<tr>
			<th style="width:40px;text-align:center">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort/nid/'.$orderby_sort.'/8/1' ?>','process_lightbox_ajax')" >							
				<?php echo '#' ?>		
				<?php
						if (trim($orderby_field) == 'nid')
							echo $sort_img;
					?>
				</a>
			</th>
			<th>
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort/ctitle/'.$orderby_sort.'/8/1' ?>','process_lightbox_ajax')" >						
				<?php echo $lbl_carticle ?>		
				<?php
						if (trim($orderby_field) == 'ctitle')
							echo $sort_img;
					?>
				</a>
			</th>
			<th style="width:130px">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort/csection_news/'.$orderby_sort.'/8/1' ?>','process_lightbox_ajax')" >					
				<?php echo $lbl_sec_article ?>		
				<?php
						if (trim($orderby_field) == 'csection_news')
							echo $sort_img;
					?>
				</a>
			</th>
			<th style="width:130px">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort/ccat_news/'.$orderby_sort.'/8/1' ?>','process_lightbox_ajax')" >						
				<?php echo $lbl_cat_article ?>		
				<?php
						if (trim($orderby_field) == 'ccat_news')
							echo $sort_img;
					?>
				</a>
			</th>
		</tr>
		<tr>
			<td><input name="btn_filter" type="button" style="width:98%" value="<?php echo $btn_filter; ?>" onclick="process_post_method('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);" class="button"/></td>
			<td>
				<input name="txtf_ctitle" id="txtf_ctitle" type="text" style="width:97%" 
							   value="<?php echo $txtf_ctitle; ?>" />
			</td>
			<td>
				<?php echo $gencbo_sec_news_list ?>
			</td>
			<td>
				<?php echo $gencbo_cat_news_list ?>
			</td>
		</tr>
	<?php   
		$row_count = 1;
		foreach($data_view as $data):
	?>
		<tr class="row<?php echo $row_count%2; ?>">
			<td style="text-align:center"><?php echo $txt_row_per_page * ($txt_current_page -1) + $row_count; ?></td>
			<td><a class="focus_item" href="javascript:get_id_article(this.form,'<?php echo $data['nid'] ?>');"><?php echo $data['ctitle'] ?></a></td>
			<td><?php echo $data['csection_news'] ?></td>
			<td><?php echo $data['ccat_news'] ?></td>
		</tr>
	<?php 
		$row_count++;
		endforeach; 
	?>
	</table>
	<table width="100%" cellspacing="1" border="0" class="tbl_header_list">
		<tr>						
			<td style="text-align:center">						
					<label style="padding-left:5px;"><?php echo $lbl_rows_per_page; ?></label>
					
					<input name="txt_row_per_page" id="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>"
						style="text-align:center" />
					
					<input name="btn_row_per_page" id="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="process_post_method('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);"/>									
			</td>
			
			<td style="text-align:right">							
					<?php if($txt_current_page > 1): ?>
					<input name="btn_previous" type="button" value="<<" 
						onclick="process_post_method('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);"/>				
					<?php endif; ?>
					
					<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
					
					<?php if($txt_current_page < $txt_total_page): ?>
					<input name="btn_next" type="button" value=">>" 
						onclick="process_post_method('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);"/>
					<?php endif ?>
							
					<input name="txt_current_page" id="txt_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
						style="text-align:center" size="5" />
						   
					<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="process_post_method('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);" class="button"/>
			</td>
		</tr>					
	</table>
	<input type="hidden" name="txt_article" id="txt_article" value="" style="width:300px"/>
	
</div>

