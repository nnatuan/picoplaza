<!-- page content -->
<?php $link_cancel=base_url().'index.php/do_product_listview'; ?>
<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>QUẢN LÝ BÀI VIẾT</small></h3>
              </div>

              <div class="title_right text-right">
					
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>MÀU SẮC SẢN PHẨM <small class="text-danger"> <?php echo get_product_name($nid_product); ?> </small></h2>
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
							<div class="top-filter" style="">
								  <button class="btn btn-primary" onclick="js_SetSubmitButtonClick(this.form,'btn_add');">Thêm mới</button>
									<button type="button" class="btn btn-danger" onclick="location.href='<?php echo $link_cancel; ?> '">Quay về</button>
									<input type="hidden" name="hidden_button"  id="hidden_button"/>	
							</div>
							<table id="datatable" class="table table-striped table-bordered" style="width:100%">
							  <thead>
								<tr>
								  <th class="text-center">#</th>	
								  <th>Tên</th>
								  <th>Chỉ mục</th>
								  <th>Trạng thái</th>
								</tr>
							  </thead>
								<tbody>
								<?php $i=1; 
								foreach($data_view as $data){
								?>
								  <tr>
									 <td class="text-center"><?php echo $i; ?></span></td>
									 <td><a href="<?php echo base_url() . 'index.php/do_color_lv2/f_edit/' . $data['nid']; ?>"  ><?php echo Fview_text($data['cname']); ?></a></td>   
									 <td><?php echo Fview_text($data['cindex']); ?></td>					 
									 <td style="text-align:center"><a href="<?php echo base_url().'index.php/do_color_lv2_listview/f_active/'.$data['nid'].'/'.$data['nstatus'] ?>"><?php  echo show_img_pulish($data['nstatus']); ?></a></td>
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