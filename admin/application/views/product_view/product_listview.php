<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3><small></small></h3>
                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>QUẢN LÝ DANH SÁCH BĐS</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo base_url(); ?>index.php/do_product/f_add" class="btn btn-success" style="margin: 0;"><i class="fa fa-plus"></i> Thêm bài mới</a>
                                        </div>
                                        
                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px; text-align: center;">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span>#</span>&nbsp;
                                                            <?php /*<span><input name="chkItems" type="checkbox" class="checkbox" onclick="js_CheckAllClick(this,this.name);" /></span>*/ ?>
                                                        </div>	
                                                    </th>	
                                                    <th>Tiêu đề bài đăng</th>
                                                    <th>Mã Code</th>
                                                    <th style="width: 150px;">Danh mục</th>
                                                    <th style="width: 140px;">Tỉnh / Thành</th>
                                                    <th style="width: 130px;">Giao dịch</th>
                                                    <th style="width: 90px;">Hiển thị</th>
                                                    <th style="width: 110px;">Ngày đăng</th>
													<th style="width: 130px; text-align: center;">Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="filter">
                                                    <td style="text-align:center">
                                                        <input name="btn_filter" type="button" class="btn btn-info btn-sm" value="Tìm" onclick="js_SetSubmitButtonClick(this.form,this.name);"/>
                                                    </td>
                                                    <td>
                                                        <input name="txtf_ctitle" type="text" class="form-control" value="<?php echo $txtf_ctitle; ?>" />			
                                                    </td>
                                                    <td>
                                                        <input name="txtf_ccode" type="text" class="form-control" value="<?php echo $txtf_ccode; ?>" />			
                                                    </td>
                                                    <td><?php echo $gencbo_cat_product; ?></td>
                                                    <td><?php echo $gencbo_province; ?></td>
                                                    <td><?php echo $gen_cbo_product_status; ?></td>
                                                    <td><?php echo $gen_cbo_status; ?></td>	
                                                    <td></td>
													<td></td>
                                                </tr>
                                                
                                                <?php $i=1; 
                                                foreach($data_view as $data){
                                                ?>
                                                <tr>
                                                    <td style="text-align: center;">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <span><?php echo $i; ?></span>&nbsp;
                                                            <?php /*<span>	
                                                                <input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>" id="chkItems" class="checkbox" onclick="js_CheckItemClick(this, 'chkItems','chkItems');" />
                                                            </span>	*/ ?>
                                                        </div>
                                                    </td>
                                                    <td class="text-left">
                                                        <a href="<?php echo base_url() . 'index.php/do_product/f_edit/' . $data['nid']; ?>" class="font-weight-bold text-primary"><?php echo Fview_text($data['ctitle']); ?></a>
                                                    </td>
                                                    <td><?php echo Fview_text($data['ccode']); ?></td>
                                                    <td><?php echo Fview_text($data['ccat_product_title']); ?></td> 
													<td><?php echo Fview_text($data['cprovince_title']); ?></td>    
													<td style="text-align: center;">
                                                        <?php 
                                                            if($data['nproduct_status'] == 1) echo '<span class="badge badge-success">Đang bán</span>';
                                                            elseif($data['nproduct_status'] == 2) echo '<span class="badge badge-warning">Tạm ẩn</span>';
                                                            else echo '<span class="badge badge-secondary">Đã bán</span>';
                                                        ?>
                                                    </td>
                                                    <td style="text-align: center;">
                                                        <a href="javascript:void(0)" onclick="update_status('tproduct','<?php echo $data['nid']; ?>','nstatus')">
                                                            <i id="i-nstatus-<?php echo $data['nid']; ?>" class="i-status fa <?php if($data['nstatus']==1) echo "fa-check text-success"; else echo "fa-times text-danger"; ?>" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td><?php echo Fview_date($data['dcreated_at']); ?></td>
													<td style="text-align: center;">
                                                            <a href="<?php echo base_url() . 'index.php/do_product/f_edit/' . $data['nid']; ?>" 
															   class="btn btn-warning btn-xs btn-action" title="">
															   <i class="fa fa-edit"></i> Sửa đổi
															</a>
															<a href="<?php echo base_url() . 'index.php/do_product_listview/f_delete/' . $data['nid']; ?>" 
														   class="btn btn-danger btn-xs btn-action" title="Xóa" 
														   onclick="return confirm('Bạn có chắc muốn xóa (ẩn) bài này?');"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                </tr>
                                                <?php $i++;} ?>
                                            </tbody>
                                        </table>
                                        
                                        <table class="table table-filter" cellspacing="1">
                                            <tr>						
                                                <td></td>
                                                <td>
                                                    <div class="d-flex justify-content-end align-items-center">	
                                                        <label class="mg0"><?php echo $lbl_rows_per_page; ?>:</label>&nbsp;
                                                        <input class="form-control" name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>" style="text-align:center;height:31px;width:80px;" />&nbsp;
                                                        <input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info btn-sm"/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end align-items-center">		
                                                        <?php if($txt_current_page > 1): ?>
                                                            <input class="btn btn-secondary btn-sm" name="btn_previous" type="button" value="<<" onclick="js_SetSubmitButtonClick(this.form,'btn_previous');"/>&nbsp;	
                                                        <?php endif; ?>
                                                        
                                                        <label class="mg0"><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>&nbsp;
                                                        
                                                        <?php if($txt_current_page < $txt_total_page): ?>
                                                            <input class="btn btn-secondary btn-sm" name="btn_next" type="button" value=">>" onclick="js_SetSubmitButtonClick(this.form,'btn_next');"/>&nbsp;
                                                        <?php endif ?>
                                                                
                                                        <input class="form-control" name="txt_current_page" type="text" value="<?php echo $txt_current_page; ?>" style="text-align:center;height:31px;width:50px;" size="5" />&nbsp;
                                                               
                                                        <input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form,this.name);" class="btn btn-info btn-sm" />
                                                    </div>	
                                                </td>
                                            </tr>					
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
<script type="text/javascript">
function js_SetSubmitButtonClick(obj_form, btn_name) {
    obj_form.hidden_button.value = btn_name;
    obj_form.submit();		
}	
</script>