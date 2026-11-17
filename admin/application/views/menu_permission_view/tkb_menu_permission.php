<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<form name="frm_department_permission" id="frm_department_permission" method="post" action="<?php echo $link_page; ?>" >
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		<table width="100%" cellspacing="1" border="0">
			<tr>						
				<td style="text-align:left">
					<input name="btn_header_save" type="button" value="<?php echo $btn_save; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_save');"/>
					<input name="btn_header_cancel" type="button" class="button"
						value="<?php echo $btn_cancel; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_cancel');"/>
						
				</td>
				<td>
					<div style=" color:#FF0000">
					<?php echo $lbl_basic_title ?>
					</div>
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
					<th style="width:150px">
						<label><?php echo $lbl_account_information; ?></label>					
					</th>
					<th>
						<label><?php echo $lbl_menu  ?></label>					
					</th>
					<th style="width:300px"> 
						<label><?php echo $lbl_menu_permission_result; ?></label>					
					</th>
				</tr>
			</thead>			
			<tbody>		
				<tr>
					<td valign="top"> 
						<div style="border-bottom:1px #CCC solid;padding-bottom:5px;margin-bottom:5px;">
							<input type="text" name="txtf_user" value="<?php echo $txtf_user_name?>" style="width:100px;"/>
							<input name="btn_filter" type="button" 
								value="<?php echo $btn_choose; ?>" style="width:40px" 
								onclick="js_SetSubmitButtonClick(this.form,'btn_filter');"/>
						</div>
						<div>
							<!-- Tai day co the dung vong lap cac the div cho list account -->
							<?php foreach($data_user_view as $data): ?>
							<div>
								<input type="checkbox" name="chk_user_items[]"  
									value="<?php echo $data['nid'] ?>" id="chkUserItems" class="checkbox" />
																		
								<?php echo $data['cfullname'] ?>
							</div>
							<?php endforeach;?>
							<!-- ket thuc vong lap cac the div cho list account -->
							<!-- du lieu them demo-->
							
							<!-- ket thuc du lieu them demo -->
						</div>
					</td>
		
					<td valign="top">
						<div style="border-bottom:1px #CCC solid;padding-bottom:5px;margin-bottom:5px;">
							<?php echo $gencbo_menu ?>
							<input name="btn_filter" type="button" value="<?php echo $btn_choose; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_filter');"/>
						</div>
						<div>
							<!-- Tai day co the dung vong lap cac the div cho list account -->
							<?php foreach($data_menu_view as $data): ?>
							<div>
								<?php if(trim($data['isbasic']==1)): ?>
								<div style="font-weight:bold; color:#FF0000">
								<input type="checkbox" name="<?php echo $data['cindex'] ?>"  
									value="<?php echo $data['cindex'] ?>" class="checkbox" 
									onclick ="js_CheckClickDepartment(this.form, this, 'chkDepartmentItems');"/>								
						
								<?php echo Fview_textindex($data['cindex']); ?>	
								<input type="checkbox" name="chk_menu_items[]"  
									value="<?php echo $data['cindex'] ?>" id="chkDepartmentItems" class="checkbox" />								
								&nbsp;&nbsp;&nbsp;																	
								
									<?php echo $this->lang->line($data['cmenu']) ?>
								</div>
								<?php else: ?>	
								<div style="font-weight:bold; color:#0099FF">
								<input type="checkbox" name="<?php echo $data['cindex'] ?>"  
									value="<?php echo $data['cindex'] ?>" class="checkbox" 
									onclick ="js_CheckClickDepartment(this.form, this, 'chkDepartmentItems');"/>								
						
								<?php echo Fview_textindex($data['cindex']); ?>	
								<input type="checkbox" name="chk_menu_items[]"  
									value="<?php echo $data['cindex'] ?>" id="chkDepartmentItems" class="checkbox" />								
								&nbsp;&nbsp;&nbsp;																	

								
									<?php echo $this->lang->line($data['cmenu']) ?>
								</div>
								<?php endif;?>
							</div>
							<?php endforeach;?>
							<!-- ket thuc vong lap cac the div cho list account -->
							<!-- du lieu them demo-->
							
							<!--ket thuc du lieu them demo-->
						</div>					
					</td>
					
					<td valign="top">
						<div style="border-bottom:1px #CCC solid;padding-bottom:5px;margin-bottom:5px;">
							<?php echo $gencbo_user ?>
							<input name="btn_filter" type="button" value="<?php echo $btn_choose; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_filter');"/>
						</div>
						<div>
							
							<?php foreach($data_result_view as $data): ?>														
							<?php if($data['isuser']==0): ?>
								<?php if(trim($data['isbasic']==1)): ?>
								<div style="font-weight:bold; color:#FF0000">
									<?php echo Fview_textindex($data['cindex']) ?>								
									<?php echo $this->lang->line($data['cfullname']) ?>
								</div>
								<?php else: ?>	
								<div style="font-weight:bold; color:#0099FF">
									<?php echo Fview_textindex($data['cindex']) ?>								
									<?php echo $this->lang->line($data['cfullname']) ?>
								</div>
								<?php endif; ?>	
							<?php else: ?>							
							<div style="font-style:italic">
								
								<?php echo Fview_textindex($data['cindex']) ?>
								<?php echo '*' ?>
								<?php echo $data['cfullname'] ?>
							</div>
							<?php endif; ?>
							<?php endforeach;?>
						</div>
					</td>						
				</tr>				
			</tbody>		
		</table>
		<!-- End of content listview style -->		
	</div>
	
	<div>
		<!-- Begin of footer function listview style -->
		<table width="100%" cellspacing="1" border="0">
			<tr>						
				<td style="text-align:left">
					<input name="btn_save" type="button" value="<?php echo $btn_save; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_save');"/>
					<input name="btn_cancel" type="button" class="button"
						value="<?php echo $btn_cancel; ?>" 
						onclick="js_SetSubmitButtonClick(this.form,'btn_cancel');"/>				
				</td>
			</tr>					
		</table>
		<input type="hidden" name="hidden_button" />
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
