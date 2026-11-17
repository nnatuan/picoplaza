<!-- page content -->
<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small></small></h3>
              </div>

              <div class="title_right text-right">

              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>ĐĂNG KÝ KHÓA HỌC</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
							<table id="datatable" class="table table-striped table-bordered" style="width:100%">
							  <thead>
								<tr>
								  <th>#</th>
								  <th>Họ tên</th>
								  <th>Số điện thoại</th>
								  <th>Email</th>
								  <th>Khóa học</th>
								  <th>Ngày đăng ký</th>
								</tr>
							  </thead>
								<tbody>
								<?php $i=1; 
								foreach($data_view as $data){
								?>
								  <tr>
									 <td><?php echo $i; ?></td>
									 <td><?php echo $data['cname']; ?></td>					 
									 <td><?php echo $data['cphone']; ?></td>
									 <td><?php echo $data['cemail']; ?></td>
									 <td><?php echo $data['changxe']; ?></td>
									 <td><?php echo date("d/m/Y",$data['ctime']); ?></td>
								  </tr>
								<?php $i++;} ?>
							  </tbody>
							</table>
						  </div>
						  </div>
					  </div>
					</div>
                </div>
              </div>

			</div>
          </div>
        </div>
		</form>
        <!-- /page content -->