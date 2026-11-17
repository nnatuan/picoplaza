<style>
.text-center {text-align:center;}
.upload-box {display: flex;    
			justify-content: center;
            background: #fff;

            max-width: 310px;
			margin: 0 auto;
            text-align: center;
            width: 100%;

        }

        .upload-box h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .file-input {
            position: relative;
            margin-bottom: 20px;
        }

        .file-input input[type="file"] {
            opacity: 0;
			left:0;
            position: absolute;
            z-index: 1;
            width: 200px;
            height: 100%;
            cursor: pointer;
        }

        .file-input label {
			width: 200px;		
            display: block;
            background: #007bff;
            color: white;
            padding: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
			margin:0;
        }

        .file-input label:hover {
            background: #0064ce;
        }

		.file-input label:hover {
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
		}
        .upload-box button {
            background: #f66b15;
            color: white;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
		.upload-box button:hover {
			background: #e35803;
		}
</style>
<!-- Chi thiet ke view trong phan nay, cac phan khac khong can thay doi;-->
<form action="" method="post" enctype="multipart/form-data">
<!-- Begin of main form list view (khi copy phai dat dung ten)-->
<div id="SiteContent_main">	
	<!-- Begin of header function listview style-->
	<div>
		<div class="file-input upload-box">
						<label for="excel_file">Chọn file Excel (.xlsx)</label>
						<input type="file" name="excel_file" id="excel_file" accept=".xlsx,.xls" required>
						<button type="submit" name="btn_import_excel" value="submit" class="">Nạp dữ liệu</button>
					</div>
	</div> 
	<!-- End of header function listview style -->
	

	<div>
		<!-- Begin of footer function listview style -->
		<table width="100%" cellspacing="1" border="0" class="tbl_bottom_list">
			<tr>						
				<td style="text-align:left">			

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
		<input name="hidden_event" id="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
		<!-- End of footer function listview style -->
	</div>
</div>
</form>	
