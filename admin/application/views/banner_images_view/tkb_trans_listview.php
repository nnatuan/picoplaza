<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<form name="frm_ward" id="frm_ward" method="post" action="<?php echo $link_page; ?>" >
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<?php if($guard == 'full_trans'){?> <div> <?php echo $error_full_trans; ?></div><?php }?>
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		
		<table width="100%" cellspacing="1" border="0">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(frm_ward,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" />
					<input name="btn_header_add_trans" type="button" value="<?php echo $btn_add; ?>" 
						onclick="location.href='<?php echo base_url() . 'index.php/do_banner_images/f_add_trans/' . $nid; ?>'"/>
				<!--	<input name="btn_header_export" type="button" class="button"
						value="<?php// echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>	
					<input name="btn_header_print" type="button" class="button"
						value="<?php// echo $btn_print; ?> " 
					onclick="window.open('<?php// echo $link_page . 'f_print'; ?>','_blank')"/> -->
					<input name="back" type="button" class="button"
						value="<?php echo $lbl_back; ?> " 
					onclick="location.href='<?php echo base_url().'index.php/do_banner_images_listview';?>'"/>
					
				</td>
				
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
						<?php $link_page = base_url() . 'index.php/do_banner_images_listview'; ?>
					<th style="width:80px;">
						<a href="<?php echo $link_page; ?>/f_sort_trans/ccode/<?php echo $orderby_sort; ?>/<?php echo $hidden_id_org; ?>" >							
						<?php echo $lbl_code ?>				
						<?php
								if (trim($orderby_field) == 'ccode')
									echo $sort_img;
							?>
		</a>					</th>

					<th>
						<a href="<?php echo $link_page; ?>/f_sort_trans/cbanner_images/<?php echo $orderby_sort; ?>/<?php echo $hidden_id_org; ?>" >							
						<?php echo $lbl_banner_images ?>				
						<?php
								if (trim($orderby_field) == 'cbanner_images')
									echo $sort_img;
							?>
		</a>					</th>
						<th>
						<a href="#" >							
						<?php echo $lbl_lang ?>						</a>					</th>
					<th style="width:100px">
						<a href="#" >							
						<?php echo $lbl_index ?>						</a>					</th>			

					<th style="width:100px">
						<a href="<?php echo $link_page; ?>/f_sort_trans/nstatus/<?php echo $orderby_sort; ?>/<?php echo $hidden_id_org; ?>" >							
						<?php echo $lbl_status ?>					
						<?php
								if (trim($orderby_field) == 'nstatus')
									echo $sort_img;
							?>
	</a>					</th>			
					<th style="width:100px"> 
						<a href="<?php echo $link_page; ?>/f_sort_trans/cfullname/<?php echo $orderby_sort; ?>/<?php echo $hidden_id_org; ?>" >							
						<?php echo $lbl_user01 ?>					
						<?php
								if (trim($orderby_field) == 'cfullname')
									echo $sort_img;
							?>
	</a>					</th>
					<th style="width:100px"> 
						<a href="<?php echo $link_page; ?>/f_sort_trans/ddate01/<?php echo $orderby_sort; ?>/<?php echo $hidden_id_org; ?>" >							
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
						<input name="txtf_cbanner_images" type="text" style="width:97%" 
							   value="<?php echo $txtf_cbanner_images; ?>" />					</td>
					<td style="text-align:center"> 
							<?php echo $gencbo_language_list; ?>
					</td>
					<td style="text-align:center"> 
						</td>

					<td style="text-align:center">
						<input name="txtf_nstatus" type="text" style="width:97%" 
							   value="<?php echo $txtf_nstatus; ?>" />					</td>
							   
				<td style="text-align:center">
						<input name="txtf_nid_user01" type="text" style="width:97%" 
							   value="<?php echo $txtf_nid_user01; ?>" />					</td>
					<td style="text-align:center">
					  <input name="txtf_ddate01" id="d_from" type="text" 
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

						<td><?php echo Fview_text($data['ccode']); ?></td>

						<td><a  href="<?php echo base_url() . 'index.php/do_banner_images/f_edit_trans/' . $data['nid']; ?>"  ><?php echo Fview_text($data['cbanner_images']); ?></a></td>
									
						<td style="text-align:center"><?php echo Fview_text($data['clanguage']); ?></td>						<td style="text-align:center"><?php echo Fview_text($data['cindex']); ?></td>						
						<td style="text-align:center"><?php  if(Fview_text($data['nstatus'])==1)
						echo '<img src="'.base_url() .'tkb_images/tkb_icons/tick.png">'; ?></td>												
						<td style="text-align:center"><?php echo Fview_text($data['cfullname']); ?></td>						
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
						   onclick="js_CheckValidBeforeDeleteListview(frm_ward,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" />
								
					<input name="btn_add_trans" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add_trans');"/>
				<!--	<input name="btn_export" type="button" class="button"
						value="<?php// echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>
					<input name="btn_print_page" type="button" class="button"
						value="<?php// echo $btn_print; ?> " 
						onclick="window.open('<?php echo $link_page . 'f_print'; ?>','_blank')"/>				-->
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
		<input type="hidden" name="hidden_id_org"  id="hidden_id_org" value="<?php //echo $hidden_id_org;?>"/>
		<input name="hidden_event" id="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
