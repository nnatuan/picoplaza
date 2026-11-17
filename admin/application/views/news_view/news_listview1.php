<div>
<?php echo $error_delete_active; ?>
</div>
<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<form name="frm_ward" id="frm_ward" method="post" action="<?php echo $link_page; ?>" >
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		<table width="100%" cellspacing="1" border="0" class="tbl_header_list">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(frm_ward,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="button" />
					<input name="btn_header_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');" class="button"/>
				<!--	<input name="btn_header_export" type="button" class="button"
						value="<?php// echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>	
					<input name="btn_header_print" type="button" class="button"
						value="<?php// echo $btn_print; ?> " 
					onclick="window.open('<?php// echo $link_page . 'f_print'; ?>','_blank')"/>
								-->
					<!--<input <?php //if($chkf_ctag == 1) echo 'checked = "checked"' ?> type="checkbox" value="1" name="chkf_ctag" /><label><?php //echo $lbl_not_tag ?></label>-->	
				</td>
				<td>
				
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
							
					<input name="txt_header_current_page" type="text" value="<?php echo $txt_current_page ; ?>" style="text-align:center" size="5" />
											   
					<input name="btn_header_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="button"/>
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
					<th style="width:50px">
						<span style="float:left; width:20px">
							<a href="<?php echo $link_page; ?>f_sort/nid/<?php echo $orderby_sort; ?>" >							
							<?php echo '#' ?>		
							<?php
									if (trim($orderby_field) == 'nid')
										echo $sort_img;
								?>
							</a>
						</span>
						<span style="float:right; width:25px; padding-top:4px">
								<input name="chkItems" type="checkbox" class="checkbox" 
									   onclick="js_CheckAllClick(this,this.name);" />
						</span>					
					</th>
					<th width="335">
						<a href="<?php echo $link_page; ?>f_sort/ctitle/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_title ?>		
						<?php
								if (trim($orderby_field) == 'ctitle')
									echo $sort_img;
							?>
				</a>					</th>
					<th width="209" style="width:100px">
						<a href="<?php echo $link_page; ?>f_sort/ccat_news/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_cat ?>						</a>					</th>
					<th style="width:50px">
                     <a href="<?php echo $link_page; ?>f_sort/chome/<?php echo $orderby_sort; ?>" >							
                     <?php echo 'Home'; ?>			
                     <?php
                        if (trim($orderby_field) == 'chome')
                        	echo $sort_img;
                        ?>
                     </a>					
                  </th>
				  <th style="width:50px">
                     <a href="<?php echo $link_page; ?>f_sort/cmphq/<?php echo $orderby_sort; ?>" >							
                     <?php echo 'Status mphq'; ?>			
                     <?php
                        if (trim($orderby_field) == 'cmphq')
                        	echo $sort_img;
                        ?>
                     </a>					
                  </th>
				  <th style="width:50px">
                     <a href="<?php echo $link_page; ?>f_sort/cmp365/<?php echo $orderby_sort; ?>" >							
                     <?php echo 'Status 365'; ?>			
                     <?php
                        if (trim($orderby_field) == 'cmp365')
                        	echo $sort_img;
                        ?>
                     </a>					
                  </th>
					<th style="width:50px"><a>Status</a></th>
					<th style="width:80px"> 
						<a href="<?php echo $link_page; ?>f_sort/cindex/<?php echo $orderby_sort; ?>" >							
						<?php echo $lbl_index ?>						
						<?php
								if (trim($orderby_field) == 'cindex')
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
						<input name="txtf_ctitle" type="text" style="width:97%" 
							   value="<?php echo $txtf_ctitle; ?>" />					</td>
							   <td style="text-align:center"> 
							<?php echo $gencbo_cat_news_list; ?>					</td>	
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">
					  <input name="txtf_cindex" type="text" style="width:100%"
							   value="<?php echo $txtf_cindex; ?>" />					</td>
					
			    </tr>  			

					<?php
						$row_count = 1;
						foreach($data_view as $data):
					?>								
					<tr class="row<?php echo $row_count%2; ?>">
						
						<td style="text-align:center;"> 
							<span style="float:left; width:20px">
								<?php echo $txt_row_per_page * ($txt_current_page -1) + $row_count; ?>							</span>
							<span style="float:right; width:25px; padding-top:4px">	
							<input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>"
								id="chkItems" class="checkbox" 								   
								onclick="js_CheckItemClick(this, 'chkItems','chkItems');" />
							</span>						
						</td>
						<td><a  href="<?php echo base_url() . 'index.php/do_news/f_edit/' . $data['nid']; ?>"  ><?php echo Fview_text($data['ctitle']); ?></a></td>
						<td><?php echo Fview_text($data['ccat_news']); ?></td>	
						<td style="text-align:center">
							 <?php  if(Fview_text($data['chome']) == "1")
								{
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_home/'.$data['nid'].'/'.$data['chome'].'"><img src="'.base_url() .'images/publish.png"></a>';
								
								}
								else 
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_home/'.$data['nid'].'/'.$data['chome'].'"><img src="'.base_url() .'images/unpublish.png"></a>';
								
								 ?>
						</td>	
						<td style="text-align:center">
							 <?php  if(Fview_text($data['cmphq']) == "1")
								{
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_mphq/'.$data['nid'].'/'.$data['cmphq'].'"><img src="'.base_url() .'images/publish.png"></a>';
								
								}
								else 
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_mphq/'.$data['nid'].'/'.$data['cmphq'].'"><img src="'.base_url() .'images/unpublish.png"></a>';
								
								 ?>
						</td>
						<td style="text-align:center">
							 <?php  if(Fview_text($data['cmp365']) == "1")
								{
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_mp365/'.$data['nid'].'/'.$data['cmphq'].'"><img src="'.base_url() .'images/publish.png"></a>';
								
								}
								else 
									echo '<a href="'.base_url().'index.php/do_news_listview/f_active_mp365/'.$data['nid'].'/'.$data['cmphq'].'"><img src="'.base_url() .'images/unpublish.png"></a>';
								
								 ?>
						</td>
						<td>
						<?php if($data['nstatus'] == '1'){ ?>
						<a href="<?php echo base_url().'index.php/do_news_listview/f_unactive/'.$data['nid'] ?>">
						<?php }else{?>
						<a href="<?php echo base_url().'index.php/do_news_listview/f_active/'.$data['nid'] ?>">
						<?php }?>
						<?php  echo show_img_pulish($data['nstatus']); ?></a>
						</td>				
						<td style="text-align:right"><?php echo $data['cindex']; ?></td>						
						
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
		<table width="100%" cellspacing="1" border="0" class="tbl_bottom_list">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(frm_ward,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="button" />
								
					<input name="btn_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');" class="button"/>
					<!--<input name="btn_export" type="button" class="button"
						value="<?php// echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>
					<input name="btn_print_page" type="button" class="button"
						value="<?php// echo $btn_print; ?> " 
						onclick="window.open('<?php// echo $link_page . 'f_print'; ?>','_blank')"/>				-->
				</td>
				
				<td style="text-align:center">						
						<label style="padding-left:5px;"><?php echo $lbl_rows_per_page; ?></label>
						
						<input name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>"
							style="text-align:center" />
						
						<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="button"/>									
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
							   
						<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="button" />
				</td>
			</tr>					
		</table>
		<input type="hidden" name="hidden_button"  id="hidden_button"/>
		<input name="hidden_event" id="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
