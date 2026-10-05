<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<form name="frm_materia" id="frm_materia" method="post" action="<?php echo $link_page; ?>" >
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		<table width="100%" cellspacing="1" border="0">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" />
								
					<input name="btn_header_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');"/>
					<input name="btn_product" type="button" value="<?php echo $btn_product; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_product');"/>
				</td>
				<td style="text-align:center">&nbsp;</td>
				<td style="text-align:right">							
					<?php if($txt_current_page > 1): ?>
						<input name="btn_header_previous" type="button" 
						 value="<<" onclick="js_SetSubmitButtonClick(this.form,'btn_previous');"/>				
					<?php endif; ?>
					
					<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
					
					<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_header_next" type="button" 
							value=">>" onclick="js_SetSubmitButtonClick(this.form,'btn_next');"/>
					<?php endif; ?>
							
					<input name="txt_header_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
						   style="text-align:center" size="5" />
						   
					<input name="btn_header_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);"/>
				</td>
			</tr>					
		</table>
	</div> 
	<!-- End of header function listview style -->
	
	<!-- Begin table of content listview -->			
	<div style="clear:both">	
		<table class="ViewStyle01" width="100%" cellspacing="1">
			<thead>
				<tr>
					<th style="width:45px">
						<span style="float:left; width:20px">#</span>
						<span style="float:right; width:25px">
								<input name="chkItems" type="checkbox" class="checkbox" 
									   onclick="js_CheckAllClick(this,this.name);" />
						</span>					</th>

					
						<th style="width:150px">
						<a href=" <?php echo $link_page; ?>f_sort/ccode/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_ccode;?>			
						<?php
								if (trim($orderby_field) == 'ccode')
									echo $sort_img;
							?>
			</a>					</th>
					<th style="width:200px">
						<a href="#" >							
						<?php echo $lbl_cproduct;?>			
						<?php
								if (trim($orderby_field) == 'cproduct')
									echo $sort_img;
							?>
			</a>					</th>
															
					 <th style="width:80px">
						<a href=" <?php echo $link_page; ?>f_sort/nstatus/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_nstatus;?>			
						<?php
								if (trim($orderby_field) == 'nstatus')
									echo $sort_img;
							?>
			</a>					</th>
					<th style="width:90px">
						<a href=" <?php echo $link_page; ?>f_sort/cindex/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_index;?>			
						<?php
								if (trim($orderby_field) == 'cindex')
									echo $sort_img;
							?>
			</a>					</th>
					<th >
						<a href=" <?php echo $link_page; ?>f_sort/cnote/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_cnote;?>			
						<?php
								if (trim($orderby_field) == 'cnote')
									echo $sort_img;
							?>
			</a>					</th>
					<th style="width:130px"> 
						<a href=" <?php echo $link_page; ?>f_sort/niduser01/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_niduser01 ?>					
						<?php
								if (trim($orderby_field) == 'niduser01')
									echo $sort_img;
							?>
	</a>					</th>
					<th style="width:100px"> 
						<a href=" <?php echo $link_page; ?>f_sort/ddate01/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_date01 ?>				
						<?php
								if (trim($orderby_field) == 'ddate01')
									echo $sort_img;
							?>
		</a>					</th>			
				</tr>
			</thead>
						
			<tbody>
				<tr>
					<td style="text-align:center">
						<input name="btn_filter" type="button" style="width:98%" value="<?php echo $btn_filter; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);"/>					</td>
					<td style="text-align:center">
						<input name="txtf_ccode" type="text" style="width:97%" 
							   value="<?php echo $txtf_ccode; ?>" />					</td>
					<td style="text-align:center">
						<input name="txtf_nid_products" type="hidden" style="width:97%" 
							   value="<?php echo $txtf_nid_products; ?>" />					</td>
					<td style="text-align:center"><?php echo $gen_cbo_status ?>			</td>		   
                    <td style="text-align:center">
						<input name="txtf_cindex" type="text" style="width:97%" 
							   value="<?php echo $txtf_cindex; ?>" />					</td>
					<td style="text-align:center">
						<input name="txtf_cnote" type="text" style="width:97%" 
							   value="<?php echo $txtf_cnote; ?>" />					</td>
					<td style="text-align:center">
						<input name="txtf_user01" type="text" style="width:97%" 
							   value="<?php echo $txtf_user01; ?>" />					</td>
					<td style="text-align:center">
					  <input name="txtf_ddate01" id="d_from" type="text" style="width:97%" 
							   value="<?php echo $txtf_ddate01; ?>" />					</td>
				</tr>  			

					<?php
						$row_count = 1;
						foreach($data_view as $data):
					?>								
					<tr class="row<?php echo $row_count%2; ?>">
						
						<td style="text-align:center;; width:45px"> 
							<span style="float:left; width:20px">
								<?php echo $txt_row_per_page * ($txt_current_page -1) + $row_count; ?>							</span>
							<span style="float:right; width:25px">	
							<input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>"
								id="chkItems" class="checkbox" 								   
								onclick="js_CheckItemClick(this, 'chkItems','chkItems');" />
							</span>						</td>
						<td>
							<a href="<?php echo base_url().'index.php/do_image_product/f_edit/'.$txtf_nid_products.'/'.$data['nid']; ?>">
								<?php echo Fview_text($data['ccode']); ?>
							</a>
						</td>
                    	<td><?php echo Fview_text($data['cproducts']); ?></td>
						<td style="text-align:center">
						<?php  if(Fview_text($data['nstatus'])==1)
						{
							echo '<a href="'.base_url().'index.php/do_image_product_listview/f_active/'.$data['nid'].'/'.$data['nstatus'].'"><img src="'.base_url() .'tkb_images/tkb_icons/tick.png"></a>';
						
						}
						else 
							echo '<a href="'.base_url().'index.php/do_image_product_listview/f_active/'.$data['nid'].'/'.$data['nstatus'].'"><img src="'.base_url() .'tkb_images/tkb_icons/publish_x.png"></a>';

						 ?>
						</td>	
                        <td align="center"><?php echo Fview_text($data['cindex']); ?></td>				
						<td><?php if(strlen($data['cnote'])>35) echo Fview_text(substr($data['cnote'],0,35)).'...';else  echo Fview_text($data['cnote']); ?></td>			
						<td><?php echo Fview_text($data['cfullname']); ?></td>						
						<td style="text-align:center"><?php echo Fview_date($data['ddate01']); ?></td>						
					</tr>
					<?php
						$row_count++;
						endforeach;
					?>					
			</tbody>		
		</table>
		<!-- End of content listview style -->		
	</div>
	
	<div>
		<!-- Begin of footer function listview style -->
		<table width="100%" cellspacing="1" border="0">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" />
								
					<input name="btn_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');"/>
					<input name="btn_product_footer" type="button" value="<?php echo $btn_product; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_product');"/>
				</td>
				
				<td style="text-align:center">						
						<label style="padding-left:5px;"><?php echo $lbl_rows_per_page; ?></label>
						<input name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>"
							style="text-align:center" />
						
						<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);"/>									
				</td>
				
				<td style="text-align:right">							
						<?php if($txt_current_page > 1): ?>
						<input name="btn_previous" type="button" value="<<" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_previous');"/>				
						<?php endif; ?>
						
						<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
						
						<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_next" type="button" value=">>" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_next');"/>
						<?php endif ?>
								
						<input name="txt_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
							style="text-align:center" size="5" />
							   
						<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);">
				</td>
			</tr>					
		</table>
		<input type="hidden" name="hidden_button"  id="hidden_button"/>
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
