<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<?php 
	if($m_message !='') 
	{
 ?>
 <div class="message"> <?php echo $m_message; ?></div>
 <?php
 	}
 ?>
<form name="frm_config" id="frm_config" method="post" action="<?php echo $link_page; ?>" >
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		<table width="100%" cellspacing="1" border="0" class="tbl_header_list">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="btn btn-info" />
								
					<input name="btn_header_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');" class="btn btn-info"/>
				</td>
				<td style="text-align:center">&nbsp;</td>
				<td style="text-align:right">							
					<?php if($txt_current_page > 1): ?>
						<input name="btn_header_previous" type="button" 
						 value="<<" onclick="js_SetSubmitButtonClick(this.form,'btn_previous');" class="btn btn-info"/>				
					<?php endif; ?>
					
					<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
					
					<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_header_next" type="button" 
							value=">>" onclick="js_SetSubmitButtonClick(this.form,'btn_next');" class="btn btn-info"/>
					<?php endif; ?>
							
					<input name="txt_header_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
						   style="text-align:center" size="5" />
						   
					<input name="btn_header_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info"/>
				</td>
			</tr>					
		</table>
	</div> 
	<!-- End of header function listview style -->
	
	<!-- Begin table of content listview -->			
	<div style="clear:both">	
		<table class="table  table-bordered table-hover" width="100%" cellspacing="1">
			<thead>
				<tr>
					<th style="width:80px">
						<span style="float:left; width:20px">#</span>
						<span style="float:right; width:25px">
								<input name="chkItems" type="checkbox" class="checkbox" 
									   onclick="js_CheckAllClick(this,this.name);" />
						</span>					</th>

					
					<th style="width:100px">
						<a href=" <?php echo $link_page; ?>f_sort/cname/<?php echo $orderby_sort; ?>" >							
						<?php echo "Tên site";?>			
						<?php
								if (trim($orderby_field) == 'cname')
									echo $sort_img;
							?>
						</a>					
					</th>
					
					<th style="width:100px">
						<a href=" <?php echo $link_page; ?>f_sort/curl/<?php echo $orderby_sort; ?>" >							
						<?php echo "Url";?>			
						<?php
								if (trim($orderby_field) == 'curl')
									echo $sort_img;
							?>
						</a>					
					</th>
					
					<th style="width:100px">
						<a href=" <?php echo $link_page; ?>f_sort/cphone/<?php echo $orderby_sort; ?>" >							
						<?php echo "Điện thoại";?>			
						<?php
								if (trim($orderby_field) == 'cphone')
									echo $sort_img;
							?>
						</a>					
					</th>
					<th style="width:100px">
						<a href=" <?php echo $link_page; ?>f_sort/cemail/<?php echo $orderby_sort; ?>" >							
						<?php echo "Email";?>			
						<?php
								if (trim($orderby_field) == 'ctype')
									echo $sort_imgcemail
							?>
						</a>					
					</th>
					<th style="width:200px">
						<a href=" <?php echo $link_page; ?>f_sort/caddress/<?php echo $orderby_sort; ?>" >							
						<?php echo "Địa chỉ";?>			
						<?php
								if (trim($orderby_field) == 'caddress')
									echo $sort_img;
							?>
						</a>					
					</th>	
				</tr>
			</thead>
						
			<tbody>
				<?php /*
				<tr>
					<td style="text-align:center">
						<input name="btn_filter" type="button" style="width:98%" value="<?php echo $btn_filter; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info"/>					</td>
					<td style="text-align:center">
						<input name="txtf_cname" type="text" style="width:97%" 
							   value="<?php echo $txtf_cname; ?>" />					</td>
					<td style="text-align:center">
						<input name="ccode" type="text" style="width:97%" 
							   value="<?php echo $ccode; ?>" />					</td>
					<td style="text-align:center">&nbsp;</td>		   
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center">&nbsp;</td>
					<td style="text-align:center"><?php echo $gen_cbo_status ?></td>
					
				</tr> */ ?>	

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
						<td><a href="<?php echo base_url().'index.php/do_subsite/f_edit/'.Fview_text($data['nid']); ?>"><?php echo Fview_text($data['cname']); ?></a></td>
						<td><?php echo Fview_text($data['curl']); ?></td>	
						<td><?php echo Fview_text($data['cphone']); ?></td>	
						<td><?php echo Fview_text($data['cemail']); ?></td>	
						<td><?php echo Fview_text($data['caddress']); ?></td>	
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
		<table width="100%" cellspacing="1" border="0" class="tbl_bottom_list">
			<tr>						
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="btn btn-info"/>
								
					<input name="btn_add" type="button" value="<?php echo $btn_add; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_add');" class="btn btn-info"/>
					<!--<input name="btn_export" type="button" class="btn btn-info"
						value="<?php// echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>
					<input name="btn_print_page" type="button" class="btn btn-info"
						value="<?php// echo $btn_print; ?> " 
						onclick="window.open('<?php// echo $link_page . 'f_print'; ?>','_blank')"/>				-->
				</td>
				
				<td style="text-align:center">						
						<label style="padding-left:5px;"><?php echo $lbl_rows_per_page; ?></label>
						
						<input name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>"
							style="text-align:center" />
						
						<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info"/>									
				</td>
				
				<td style="text-align:right">							
						<?php if($txt_current_page > 1): ?>
						<input name="btn_previous" type="button" value="<<" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_previous');" class="btn btn-info"/>				
						<?php endif; ?>
						
						<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
						
						<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_next" type="button" value=">>" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_next');" class="btn btn-info"/>
						<?php endif ?>
								
						<input name="txt_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
							style="text-align:center" size="5" />
							   
						<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info" />
				</td>
			</tr>					
		</table>
		<input type="hidden" name="hidden_button"  id="hidden_button"/>
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
