<?php 
   $this->load->view($view_folder.'/header');
   $this->load->view($view_folder.'/header_end');	
   $this->load->view($view_folder.'/modules/mod_header');
   $member = get_member_by_id($_SESSION['nid_member']);
   ?>
<style>
.main {
	min-height:650px;
}
.menu-item {
	display: block;
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 10px;
	color: #000;
}
.menu-item.active {
	border-bottom: 1px solid #000;
	font-weight: bold;
}
.right-info p {
	position:relative;
	margin-bottom: 10px;
    padding-bottom: 10px;
}
.right-info p:after {
	content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 1px;
    background: #eee;
}
.right-info p .fa {
    width: 20px;
    color: #ef8121;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    border-top: 0;
}
</style> 
<div class="main container">
	<div class="title_box"><h4 class="title">PROFILE</h4></div>
	<div class="row">
	<div class="col-sm-3">
									  <a class="menu-item" href="<?php echo base_url(); ?>profile"><i class="fa fa-caret-right" aria-hidden="true"></i> Thông tin cơ bản</a>
									  <a class="menu-item active" href="<?php echo base_url(); ?>lich-su-mua-hang"><i class="fa fa-caret-right" aria-hidden="true"></i> Lịch sử mua hàng</a>
									  <a class="menu-item" href="<?php echo base_url(); ?>doi-mat-khau"><i class="fa fa-caret-right" aria-hidden="true"></i> Đổi mật khẩu</a>
									  <a class="menu-item" href="<?php echo base_url(); ?>thao-tac/dang-xuat"><i class="fa fa-caret-right" aria-hidden="true"></i> Đăng xuất &nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></a>
								  </div>
								<div class="col-sm-9 right-info">
									<table class="table">
										<tr style="background:#eee;font-weight:bold;">
											<td>STT</td>
											<td>Mã đơn hàng</td>
											<td>Thời gian mua hàng</td>
											<td>Trạng thái</td>
										</tr>
									<?php $i=1; $list = get_order_by_member($_SESSION['nid_member']);
									foreach($list as $data) { 
										$status = get_order_status_by_id($data['nid_order_status']);
									?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $data['ccode']; ?></td>
											<td><?php echo date("d/m/Y H:i:s", $data['ctime']); ?></td>
											<td><?php echo $status['corder_status']; ?></td>
										</tr>
									<?php $i++;} ?>
									</table>
								</div>
					</div>				  
								</div>
</div>
		
<?php 
	$this->load->view($view_folder.'/modules/mod_footer');
	$this->load->view($view_folder.'/footer');
?>