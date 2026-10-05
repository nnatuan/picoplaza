<style type="text/css">
   .box_content{padding-bottom:20px;}
   textarea{height: 100px;
   width: 392px;margin-bottom:0;}
   .table-bordered>tbody>tr>td {vertical-align: middle;}
</style>
<div id="ContentMessage">
   <div id="NoteContentMessage">
      <?php echo $get_message_notnull ?>
   </div>
   <div id="ErrorContentMessage">
      <?php echo $lbl_error_msg; ?>
   </div>
</div>
<?php
if($event=="update_add") {
	$cookie = get_cookie_byid(76);
	$calamviec = get_calamviec_byid($cookie['cvalue']);
	$cdoanh_thu = 0;
	$cdoanh_thu_chuyen_khoan = 0;
	$cdoanh_thu_tien_mat = 0;
	$cdoanh_thu_cod = 0;
	if(isset($calamviec['nid'])) {
		$list = get_order_doanhthu_theoca($calamviec['ctime_start'],time());
		foreach($list as $data) {
			$cdoanh_thu += $data['ntotal'];
			if($data['cpayment_method']=="0")
				$cdoanh_thu_chuyen_khoan += $data['ntotal'];
			else if($data['cpayment_method']=="1")
				$cdoanh_thu_tien_mat += $data['ntotal'];
			else if($data['cpayment_method']=="2")
				$cdoanh_thu_cod += $data['ntotal'];
		}
	}
}
?>
<form  name='form_main' id="form_main" method="post" action="" enctype="multipart/form-data">
   <div id="SiteContent_main">
   <div id="EditContent">

         <table class="table  table-bordered" >
            <tbody>
				<tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Làm việc ngày'; ?>				
                  </td>
                  <td style="width:210px">
                     <?php if($ctime!="") echo date('d/m/Y',$ctime); else echo date("d/m/Y",time()); ?>	
                  </td>
               </tr>
               <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Tồn đầu'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" name="cton_dau" value="500000" readonly>					
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Doanh thu bán hàng'; ?>				
                  </td>
                  <td style="width:210px">
                     	<input style="width:400px;" type="text" width="" id="cdoanh_thu" name="cdoanh_thu" value="<?php echo $cdoanh_thu; ?>" readonly>
						<input style="width:400px;" type="hidden" width="" id="cdoanh_thu_hidden" value="<?php echo $cdoanh_thu; ?>" readonly>		
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Doanh thu (Chuyển khoản)'; ?>				
                  </td>
                  <td style="width:210px">
                     	<input style="width:400px;" type="text" width="" name="cdoanh_thu_chuyen_khoan" value="<?php echo $cdoanh_thu_chuyen_khoan; ?>" readonly>				
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Doanh thu (Tiền mặt)'; ?>				
                  </td>
                  <td style="width:210px">
                     	<input style="width:400px;" type="text" width="" id="cdoanh_thu_tien_mat" name="cdoanh_thu_tien_mat" value="<?php echo $cdoanh_thu_tien_mat; ?>" readonly>				
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Doanh thu (COD)'; ?>				
                  </td>
                  <td style="width:210px">
                     	<input style="width:400px;" type="text" width="" name="cdoanh_thu_cod" value="<?php echo $cdoanh_thu_cod; ?>" readonly>				
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Trả hàng'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" id="ctra_hang" name="ctra_hang" value="<?php echo $ctra_hang; ?>" onkeyup="change_ton_cuoi();" onchange="change_ton_cuoi();">					
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Chi phí dán màn hình'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" id="cchi_phi_dan_man_hinh" name="cchi_phi_dan_man_hinh" value="<?php echo $cchi_phi_dan_man_hinh; ?>" onkeyup="change_ton_cuoi();" onchange="change_ton_cuoi();">				
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Chi phí khác'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" id="cchi_phi_khac" name="cchi_phi_khac" value="<?php echo $cchi_phi_khac; ?>" onkeyup="change_ton_cuoi();" onchange="change_ton_cuoi();">				
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Tồn cuối'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" id="cton_cuoi" name="cton_cuoi" value="<?php echo $cton_cuoi; ?>" readonly onkeyup="change_chenh_lech();" onchange="change_chenh_lech();">					
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Thực tế'; ?>				
                  </td>
                  <td style="width:210px">
                     <input style="width:400px;" type="text" width="" id="cthuc_te" name="cthuc_te" value="<?php echo $cthuc_te; ?>" onkeyup="change_chenh_lech();" onchange="change_chenh_lech();">					
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Chênh lệch'; ?>				
                  </td>
                  <td style="width:210px">
                     	<input style="width:400px;" type="text" width="" id="cchenh_lech" name="cchenh_lech" value="<?php echo $cchenh_lech; ?>" readonly>			
                  </td>
               </tr>
			   <tr>
                  <td class="key" style="width:150px" align="right">
                     <?php echo 'Ghi chú'; ?>				
                  </td>
                  <td style="width:210px">
                     <textarea style="width:400px;" type="text" width="" name="cnote"><?php echo $cnote; ?></textarea>				
                  </td>
               </tr>

			   <tr>
				   <td class="key" style="width:150px"></td>
				   <td>
						<?php if($event=="update_add") { ?>
					  <input type="submit" name="btn_submit" style="width:80px;" value ="<?php echo "Xác nhận"; ?>" 
							class="btn btn-info" />
						<?php } else if($event=="update_edit") { ?>
					  <input type="submit" name="btn_submit_update" style="width:80px;" value ="<?php echo "Cập nhật"; ?>" 
							class="btn btn-info" />
						<input name="btn_cancel" style="width:80px;" type="button" 
							   value = "<?php echo $btn_cancel; ?>"
							   onclick="location.href='<?php echo base_url().'index.php/do_giaoca_listview'; ?> '" class="btn btn-info" />
						<?php } ?>
				   </td>
				</tr>
            <tbody>				
         </table>

      </div>

   </div>

</form>
<!-- BAT BUOC CAC FORM NHAP LIEU DEU PHAI DUNG SCRIPT NAY. -->
<script type="text/javascript" >
   function js_SetSubmitButtonClick(obj_form, btn_name) 
   	{
   		obj_form.hidden_button_click.value = btn_name;
   		obj_form.submit();		
   	}	
$(document).ready(function() {	
	$("#ctra_hang,#cchi_phi_dan_man_hinh,#cchi_phi_khac").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();		
        }
    });
});

function change_ton_cuoi(){
	$('#cton_cuoi').val(parseInt($('#cdoanh_thu_tien_mat').val())-(parseInt($('#ctra_hang').val())+parseInt($('#cchi_phi_dan_man_hinh').val())+parseInt($('#cchi_phi_khac').val())));
	$('#cton_cuoi').trigger("change");
}
function change_chenh_lech(){
	$('#cchenh_lech').val(parseInt($('#cton_cuoi').val())-parseInt($('#cthuc_te').val()));
}

window.onload = function() {
	$('#ctra_hang').trigger("keyup");
	$('#cton_cuoi').trigger("keyup");
};
</script>