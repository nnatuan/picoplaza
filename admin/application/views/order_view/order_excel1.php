<?php
	$this->load->view('excel_header1');
?>
<style>
.xlText {
    mso-number-format: "\@";
}
</style>
<h1 style="text-align:center;font-size:16px;">DANH SÁCH PHIẾU HÀNG HÓA <?php if($cdate_from!='') echo 'TỪ NGÀY '.$cdate_from.' ĐẾN NGÀY '.$cdate_to; ?></h1>
<table width="100%" border="1" >
	<thead>  
		<tr>
			<th width="50px">#</th>
			<th>MSP</th>
			<th>Trạng thái</th>
			<th>Phiếu LK</th>
			<th>NơiG</th>
			<th>NơiN</th>	
			<th>Người gửi</th>
			<th>SĐT NG</th>
			<th>Người nhận</th>
			<th>SĐT NN</th>
			<th>Người nhận mới</th>
			<th>SĐT NN mới</th>
			<th>Tên LH</th>
			<th>SLH</th>
			<th>Ghi chú</th>
			<th>Phí MC</th>
			<th>STPC</th>
			<th>Đã thu</th>
			<th>Chưa thu</th>
			<th>THBH</th>
			<th>TiềnTTN</th>
			<th>TiềnGTN</th>
			<th>PhíQN</th>
			<th>Giảm giá</th>
			<th>Thu DCNN</th>
			<th>Thu THNG</th>
			<th>Phí LK</th>
			<th>ĐịaChỉGTN</th>
			<th>NgàyG</th>
			<th>NgàyHT</th>
			<th>Loại phiếu</th>
			<th>Tên NVTH</th>
			<th>NV Lập</th>
		</tr>
	</thead>
	<tbody>
		<?php
                  $i = 1; 
				  /*
				  $cqty_product=0;$cphi_mc=0;$cso_tien_pc=0;$cdathu=0;$cchuathu=0;$cthuho_bh=0;$ctien_ttn=0;$ctien_gtn=0;$cthukhac=0;$cphi_quy_nhon=0;$cgiamgia=0;$cthu_dcnn=0;$cthu_thng=0;$cphi_luu_kho=0;
				  foreach($data_view2 as $data) {
					  if($data['nid_order_status']!=3) {
						$cqty_product += $data['cqty_product'];
						$cphi_mc += $data['cphi_mc'];
						$cso_tien_pc += $data['cso_tien_pc'];
						$cdathu += $data['cdathu'];
						$cchuathu += $data['cchuathu'];
						$cthuho_bh += $data['cthuho_bh'];
						$ctien_ttn += $data['ctien_ttn'];
						$ctien_gtn += $data['ctien_gtn'];
						$cthukhac += $data['cthukhac'];
						$cphi_quy_nhon += $data['cphi_quy_nhon'];
						$cgiamgia += $data['cgiamgia'];
						$cthu_dcnn += $data['cthu_dcnn'];
						$cthu_thng += $data['cthu_thng'];
						$cphi_luu_kho += $data['cphi_luu_kho'];
					  }
				  }*/
                  foreach($data_view2 as $data):
					$nguoi_gui = get_customer_by_id($data['nid_nguoi_gui']); 
					$nguoi_nhan = get_customer_by_id($data['nid_nguoi_nhan']); 
					$cn_gui = get_chi_nhanh_by_id($data['nid_chi_nhanh_gui']);
					$cn_nhan = get_chi_nhanh_by_id($data['nid_chi_nhanh_nhan']);
					$status = get_order_status_by_id($data['nid_order_status']);
					$user_create = get_user_by_id($data['nid_user_create']);
					$user_update = get_user_by_id($data['nid_member_update']);	
					$user_login = get_user_by_id(Fget_userdata('session_nid_user'));
					//if($user_login['nid_department'] == $cn_nhan['nid'] || $user_login['cisadmin'] == 3) {
                  ?>	
		<tr>
				<td style="text-align:right;"> 
                     <?php echo $i ?>
                  </td>
				<td><?php echo $data['ccode']; ?></td>
				  <td><?php echo Fview_text($status['corder_status']); ?></td>
				  <td><?php echo Fview_text($data['ccode_order_thu_ho_cho_phieu']); ?></td>
                  <td><?php echo Fview_text($cn_gui['ccode']); ?></td>
                  <td><?php echo Fview_text($cn_nhan['ccode']); ?></td>
				  <td><?php echo Fview_text($nguoi_gui['cname']); ?></td>
				  <td class="xlText"><?php echo Fview_text($data['sdt_ng']); ?></td>
                  <td><?php echo get_customer_name_by_id($data['nid_nguoi_nhan']); ?></td>
				  <td class="xlText"><?php echo $data['sdt_nn']; ?></td>
				  <td><?php echo $data['cten_nguoi_nhan_moi']; ?></td>
				  <td class="xlText"><?php echo $data['csdt_nguoi_nhan_moi']; ?></td>
				  <td><?php echo Fview_text($data['cname_product']); ?></td>
				  <td><?php echo Fview_text($data['cqty_product']); ?></td>
				  <td><?php echo Fview_text($data['cnote']); ?></td>
				  <td><?php if($data['cphi_mc']!="") echo Fview_price2($data['cphi_mc']); ?></td>
				  <td><?php if($data['cso_tien_pc']!="") echo Fview_price2($data['cso_tien_pc']); ?></td>
				  <td><?php if($data['cdathu']!="") echo Fview_price2($data['cdathu']); ?></td>
				  <td><?php if($data['cchuathu']!="") echo Fview_price2($data['cchuathu']); ?></td>
				  <td><?php if($data['cthuho_bh']!="") echo Fview_price2($data['cthuho_bh']); ?></td>
				  <td><?php if($data['ctien_ttn']!="")  echo Fview_price2($data['ctien_ttn']); ?></td>
				  <td><?php if($data['ctien_gtn']!="") echo Fview_price2($data['ctien_gtn']); ?></td>
				  <td><?php if($data['cphi_quy_nhon']!="") echo Fview_price2($data['cphi_quy_nhon']); ?></td>
				  <td><?php if($data['cgiamgia']!="") echo Fview_price2($data['cgiamgia']); ?></td>
				  <td><?php if($data['cthu_dcnn']!="") echo Fview_price2($data['cthu_dcnn']); ?></td>
				  <td><?php if($data['cthu_thng']!="") echo Fview_price2($data['cthu_thng']); ?></td>
				  <td><?php if($data['cphi_luu_kho']!="") echo Fview_price2($data['cphi_luu_kho']); ?></td>
				  <td><?php echo Fview_text($data['cdiachi_gtn']); ?></td>
				  <td><?php echo Fview_text($data['cngay_gui']); ?></td>
				  <td><?php echo Fview_text($data['cngay_thu_ho']); ?></td>
				  <td><?php if($data['ctype']==1) echo "Thường"; else if($data['ctype']==2) echo "STC EXPRESS"; else if($data['ctype']==3) echo "Phí gửi xe máy"; else echo "Phí tiền PC"; ?></td>
				  <td><?php if($data['nid_order_status']==4 || $data['nid_order_status']==10) echo Fview_text($user_update['cname']); ?></td>
				  <td><?php echo Fview_text($user_create['cname']); ?></td>
		</tr>
		<?php $i++; endforeach; ?>
	</tbody>
	<?php /*
	<tfoot style="font-weight: bold;">
				<tr>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                  <td></td>
                  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td><strong>Tổng</strong></td>
				  <td><strong><?php echo Fview_price2($cqty_product); ?></strong></td>
				  <td></td>
				  <td><strong><?php echo Fview_price2($cphi_mc); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cso_tien_pc); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cdathu); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cchuathu); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cthuho_bh); ?></strong></td>
				  <td><strong><?php echo Fview_price2($ctien_ttn); ?></strong></td>
				  <td><strong><?php echo Fview_price2($ctien_gtn); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cthukhac); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cphi_quy_nhon); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cgiamgia); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cthu_dcnn); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cthu_thng); ?></strong></td>
				  <td><strong><?php echo Fview_price2($cphi_luu_kho); ?></strong></td>
				  <td></td>
				  <td></td>
				  <td></td>
				  <td></td>
                  <td></td>
				</tr>
			</tfoot>*/ ?>
</table>
