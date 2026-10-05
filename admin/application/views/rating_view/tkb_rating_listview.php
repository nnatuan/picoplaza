<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<?php 
	if($err_delete !='') 
	{
 ?>
 <div> <?php echo $err_delete; ?></div>
 <?php
 	}
 ?>
<form name="frm_comment" id="frm_comment" method="post" action="<?php echo $link_page; ?>" >
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
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="button" />

					
				</td>
				<td style="text-align:center">&nbsp;</td>
				<td style="text-align:right">							
					<?php if($txt_current_page > 1): ?>
						<input name="btn_header_previous" type="button" 
						 value="<<" onclick="js_SetSubmitButtonClick(this.form,'btn_previous');" class="button"/>				
					<?php endif; ?>
					
					<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
					
					<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_header_next" type="button" 
							value=">>" onclick="js_SetSubmitButtonClick(this.form,'btn_next');" class="button"/>
					<?php endif; ?>
							
					<input name="txt_header_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
						   style="text-align:center" size="5" class="button" />
						   
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
					<th style="width:70px">
						<span style="float:left; width:20px">
						<a href="<?php echo $link_page; ?>f_sort/nid/<?php echo $orderby_sort; ?>" >							
						<?php echo '#' ?>			
						<?php
								if (trim($orderby_field) == 'nid')
									echo $sort_img;
							?>
						</a>
						</span>
						<span style="float:right; width:25px">
								<input name="chkItems" type="checkbox" class="checkbox" 
									   onclick="js_CheckAllClick(this,this.name);" />
						</span>					</th>					
					<?php $link_page = base_url() . 'index.php/do_comment_listview'; ?>

					<th style="width:150px">
						<a href="<?php echo $link_page; ?>/f_sort/cname/<?php echo $orderby_sort; ?>" >							
						<?php echo "Họ tên" ?>		
						<?php
								if (trim($orderby_field) == 'cname')
									echo $sort_img;
							?>
				</a>		
				</th>
				
				<th style="width:80px;text-align:center;">
						<a href="<?php echo $link_page; ?>/f_sort/cphone/<?php echo $orderby_sort; ?>" >							
						<?php echo "SĐT" ?>		
						<?php
								if (trim($orderby_field) == 'cphone')
									echo $sort_img;
							?>
				</a>	</th>
				<th style="width:150px;text-align:center;">
						<a href="<?php echo $link_page; ?>/f_sort/nid_product/<?php echo $orderby_sort; ?>" >							
						<?php echo "Sản phẩm đánh giá" ?>		
						<?php
								if (trim($orderby_field) == 'nid_product')
									echo $sort_img;
							?>
				</a>	</th>
				<th style="width:80px;text-align:center;">
						<a href="<?php echo $link_page; ?>/f_sort/ccontent/<?php echo $orderby_sort; ?>" >							
						<?php echo "Đánh giá" ?>		
						<?php
								if (trim($orderby_field) == 'crating')
									echo $sort_img;
							?>
				</a>					</th>
				<th style="width:400px;text-align:center;">
						<a href="<?php echo $link_page; ?>/f_sort/ccontent/<?php echo $orderby_sort; ?>" >							
						<?php echo "Nội dung" ?>		
						<?php
								if (trim($orderby_field) == 'ccontent')
									echo $sort_img;
							?>
				</a>					</th>
				<th style="width:80px;text-align:center;">
						<a href="<?php echo $link_page; ?>/f_sort/nstatus/<?php echo $orderby_sort; ?>" >							
						<?php echo "Status" ?>		
						<?php
								if (trim($orderby_field) == 'nstatus')
									echo $sort_img;
							?>
				</a>	</th>		
							
			    </tr>
			</thead>
						
			<tbody>
				<tr>
					<td style="text-align:center">
						<input name="btn_filter" type="button" style="width:98%" value="<?php echo $btn_filter; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" />					</td>
					
					<td style="text-align:center"> 
						<input name="cname" type="text" style="width:97%" 
							   value="<?php echo $cname; ?>" />					</td>
					<td style="text-align:center"> 
						<input name="cphone" type="text" style="width:97%" 
							   value="<?php echo $cphone; ?>" />					</td>
							   
					<td style="text-align:center"> 
						<input name="cproducts" type="text" style="width:97%" 
							   value="<?php echo $cproducts; ?>" />					</td>
					
					<td style="text-align:center"> 
						<input name="crating" type="text" style="width:97%" 
							   value="<?php echo $crating; ?>" />					</td>
					<td style="text-align:center"> 
						<input name="ccontent" type="text" style="width:97%" 
							   value="<?php echo $ccontent; ?>" />					</td>
					<td style="text-align:center"> <?php echo $gen_cbo_status; ?></td>		   
			    </tr>	

					<?php
						$row_count = 1;
						foreach($data_view as $data):
						$product = get_product_byid($data['nid_product']);
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
						<td><a href="<?php echo base_url() . 'index.php/do_rating/f_edit/' . $data['nid']; ?>"><?php echo $data['cname']; ?></a></td>
						<td><?php echo $data['cphone']; ?></td>
						<td><?php echo $product['cproducts']; ?></td>
						<td style="text-align:center"><?php echo $data['crating']. ' sao'; ?></td>
						<td><?php echo $data['ccontent']; ?></td>
						<td style="text-align:center">
						<?php 
							$link = $link_page.'/f_active/'.$data['nid'].'/'.$data['nstatus'];
							echo show_img_pulish_active($link,$data['nstatus']); 
						?>
						</td>
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
		<table width="100%" cellspacing="1" border="0" class="tbl_header_list">
			<tr>		
				<td style="text-align:left">			
					<input name="btn_delete" type="button" value="<?php echo $btn_delete; ?>"  
						   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
								'<?php echo $msg_confirm_before_delete; ?>' ,
								'<?php echo $msg_invalid_before_delete;  ?>' )" class="button" />
								

					<!--<input name="btn_export" type="button" class="button"
						value="<?php //echo $btn_export; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_export');"/>
					<input name="btn_print_page" type="button" class="button"
						value="<?php //echo $btn_print; ?> " 
						onclick="window.open('<?php //echo $link_page . 'f_print'; ?>','_blank')"/>	-->			
				</td>

				<td style="text-align:center">						
						<label style="padding-left:5px;"><?php echo $lbl_rows_per_page; ?></label>
						
						<input name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>"
							style="text-align:center" />
						
						<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="button" />									
				</td>
				
				<td style="text-align:right">							
						<?php if($txt_current_page > 1): ?>
						<input name="btn_previous" type="button" value="<<" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_previous');" class="button"/>				
						<?php endif; ?>
						
						<label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>
						
						<?php if($txt_current_page < $txt_total_page): ?>
						<input name="btn_next" type="button" value=">>" 
							onclick="js_SetSubmitButtonClick(this.form,'btn_next');" class="button"/>
						<?php endif ?>
								
						<input name="txt_current_page" type="text" value="<?php echo $txt_current_page ; ?>"
							style="text-align:center" size="5" class="button" />
							   
						<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="button">
				</td>
			</tr>					
		</table>
		<input type="hidden" name="hidden_button"  id="hidden_button"/>
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
