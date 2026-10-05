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
                    <h2>Quản lý Thư viện ảnh</h2>
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
							<div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo base_url(); ?>index.php/do_gallery/f_add" class="btn btn-success" style="margin: 0;"><i class="fa fa-plus"></i> Thêm mới</a>
											<?php /*
											<input name="btn_delete" type="button" class="btn btn-danger" value="Xóa các mục đã chọn"  
										   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems',
												'<?php echo $msg_confirm_before_delete; ?>' ,
												'<?php echo $msg_invalid_before_delete;  ?>' )" class="button" />
												*/ ?>
                                        </div>
							<table id="datatable" class="table table-striped table-bordered" style="width:100%">
							  <thead>
								<tr>
								  <th>
									<div class="d-flex align-items-center justify-content-center">
									 <span>#</span>
									 <?php /*
									 <span>	
										<input name="chkItems" type="checkbox" class="checkbox" 
										   onclick="js_CheckAllClick(this,this.name);" />
										</span>
										*/ ?>
									</div>	
								  </th>	
								  <th>Tiêu đề</th>
					 <th>Trạng thái</th>
					 <th>Index</th>
                     <th style="width:150px;"></th>
								</tr>
							  </thead>
								<tbody>
								<?php $i=1; 
								foreach($data_view as $data){
								?>
								  <tr>
                     <td><div class="d-flex align-items-center justify-content-center">
									 <span><?php echo $i; ?></span>
									<?php /*	
									 <span>	
										<input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>"
											id="chkItems" class="checkbox" 								   
											onclick="js_CheckItemClick(this, 'chkItems','chkItems');" />
										</span>	
										*/ ?>
									</div>	
					 </td>
                     <td><a href="<?php echo base_url().'index.php/do_gallery/f_edit/'.Fview_text($data['nid']); ?>"><?php echo Fview_text($data['ctitle']); ?></a></td>   
					 <td>
						<a href="javascript:void(0)" onclick="update_status('tgallery','<?php echo $data['nid']; ?>','nstatus')">
											<i id="i-nstatus-<?php echo $data['nid']; ?>" class="i-status fa <?php if($data['nstatus']==1) echo "fa-check text-success"; else echo "fa-times text-danger"; ?>" aria-hidden="true"></i>
										</a>
					 </td>					 
					 <td><?php echo Fview_text($data['cindex']); ?></td>

					 <td>
						<a href="<?php echo base_url() . 'index.php/do_gallery_img_listview/get/' . $data['nid']; ?>" 
															   class="btn btn-warning btn-xs btn-action" title="">
															   <i class="fa fa-image"></i> Hình ảnh
															</a>
						<a href="<?php echo base_url() . 'index.php/do_gallery_listview/f_delete/' . $data['nid']; ?>" 
														   class="btn btn-danger btn-xs btn-action" title="Xóa" 
														   onclick="return confirm('Bạn có chắc chắn xóa vĩnh viễn mục này và toàn bộ ảnh con?');"><i class="fa fa-trash"></i></a>									
					 </td>
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