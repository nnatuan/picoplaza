<?php				
	header("Content-Type: text/html; charset=UTF-8");
?>
<h1 style="text-align:center;font-size:16px;">DANH SÁCH ĐƠN HÀNG</h1>
<table width="100%" border="1" >

		<tr style="background:#ccc;font-weight:bold;text-align:center;">
								  <th class="text-center">#</th>	
								  <th>Mã đơn hàng</th>
								  <th>Loại đơn</th>
								  <th>Khách hàng</th>
								  <th>Điện thoại</th>
								  <th>Địa chỉ</th>
								  <th>Ngày tạo</th>
								  <th>Trạng thái</th>
								  <th>Ghi chú</th>
		</tr>
		<?php $i=1; 
								foreach($data_view as $data){
								?>
		<tr>
									 <td style="text-align:center;"><?php echo $i; ?></span></td> 
									 <td><?php echo $data['ccode']; ?></td>
									 <td><?php if($data['ctype']==3) echo '<span style="color: #ed1c32;line-height: 0;">Viettelpost</span>'; else echo 'Đơn thường'; ?></td>
									 <td><?php echo $data['cfullname']; ?></td>
									 <td><?php echo $data['cphone']; ?></td>
									 <td><?php echo $data['caddress']; ?></td>
									 <td><?php echo Fview_date($data['ddate01']); ?></td>
									 <td><?php echo get_order_status_name($data['nid_order_status']); ?></td>
									 <td><?php echo $data['cnote']; ?></td>
								  </tr>
		<?php $i++; } ?>

</table>
