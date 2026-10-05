
<div>
	<table class="ViewStyle01" width="100%" cellspacing="1" border="0">
		<tr>
			<th style="width:40px;text-align:center">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort/nid/'.$orderby_sort_product.'/13/2' ?>','process_lightbox_ajax')" >							
				<?php echo '#' ?>		
				<?php
						if (trim($orderby_field_product) == 'nid')
							echo $sort_img_product;
					?>
				</a>
			</th>
			<th>
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort_product/cproducts/'.$orderby_sort_product.'/13/2' ?>','process_lightbox_ajax')" >						
				<?php echo $lbl_cproduct ?>		
				<?php
						if (trim($orderby_field_product) == 'cproducts')
							echo $sort_img_product;
					?>
				</a>
			</th>
			<th style="width:100px">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort_product/cmaterial_products/'.$orderby_sort_product.'/13/2' ?>','process_lightbox_ajax')" >								
				<?php echo $lbl_sec_product ?>		
				<?php
						if (trim($orderby_field_product) == 'cmaterial_products')
							echo $sort_img_product;
					?>
				</a>
			</th>
			<th style="width:100px">
				<a href="javascript:pb_display('<?php echo base_url().'index.php/ajax/do_load_menu_type/f_sort_product/ccat_products/'.$orderby_sort_product.'/13/2' ?>','process_lightbox_ajax')" >						
				<?php echo $lbl_cat_product ?>		
				<?php
						if (trim($orderby_field_product) == 'ccat_products')
							echo $sort_img_product;
					?>
				</a>
			</th>
		</tr>
		<tr>
			<td><input name="btn_filter_product" type="button" style="width:98%" value="<?php echo $btn_filter; ?>" onclick="process_post_method_product('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/13/2' ?>','process_lightbox_ajax',this.name);"/></td>
			<td>
				<input name="txtf_cproduct" id="txtf_cproduct" type="text" style="width:97%" 
							   value="<?php echo $txtf_cproduct; ?>" />
			</td>
			<td>
				<?php echo $gencbo_sec_product_list ?>
			</td>
			<td>
				<?php echo $gencbo_cat_product_list ?>
			</td>
		</tr>
	<?php   
		$row_count = 1;
		foreach($data_product_view as $data):
	?>
		<tr class="row<?php echo $row_count%2; ?>">
			<td style="text-align:center"><?php echo $txt_row_per_page_product * ($txt_current_page_product -1) + $row_count; ?></td>
			<td><a class="focus_item" href="javascript:get_id_product(this.form,'<?php echo $data['nid'] ?>');"><?php echo $data['cproducts'] ?></a></td>
			<td><?php echo $data['cmaterial_products'] ?></td>
			<td><?php echo $data['ccat_products'] ?></td>
		</tr>
	<?php 
		$row_count++;
		endforeach; 
	?>
	</table>
	<table width="100%" cellspacing="1" border="0">
		<tr>						
			<td style="text-align:center">						
					<label style="padding-left:5px;"><?php echo $lbl_rows_per_page_product; ?></label>
					
					<input name="txt_row_per_page_product" id="txt_row_per_page_product" type="text" size="5" value="<?php echo $txt_row_per_page_product; ?>"
						style="text-align:center" />
					
					<input name="btn_row_per_page_product" id="btn_row_per_page_product" type="button" value="<?php echo $btn_choose; ?>" onclick="process_post_method_product('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/13/2' ?>','process_lightbox_ajax',this.name);"/>									
			</td>
			
			<td style="text-align:right">							
					<?php if($txt_current_page_product > 1): ?>
					<input name="btn_previous_product" type="button" value="<<" 
						onclick="process_post_method_product('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/13/2' ?>','process_lightbox_ajax',this.name);"/>				
					<?php endif; ?>
					
					<label><?php echo $txt_current_page_product . ' / ' . $txt_total_page_product; ?></label>
					
					<?php if($txt_current_page_product < $txt_total_page_product): ?>
					<input name="btn_next_product" type="button" value=">>" 
						onclick="process_post_method_product('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/13/2' ?>','process_lightbox_ajax',this.name);"/>
					<?php endif ?>
							
					<input name="txt_current_page_product" id="txt_current_page_product" type="text" value="<?php echo $txt_current_page_product ; ?>"
						style="text-align:center" size="5" />
						   
					<input name="btn_page_number_product" type="button" value="<?php echo $btn_choose; ?>" onclick="process_post_method_product('<?php echo base_url().'index.php/ajax/do_load_menu_type/index/8/1' ?>','process_lightbox_ajax',this.name);">
			</td>
		</tr>					
	</table>
	<input type="hidden" name="txt_product" id="txt_product" value="" style="width:300px"/>
	
</div>

