<!-- page content -->
<form name="frm_main" method="post" action="<?php echo $link_page; ?>"> 
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>QUẢN LÝ MENU WEBSITE</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        
                                        <div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo base_url(); ?>index.php/do_menu/f_add" class="btn btn-success" style="margin: 0;"><i class="fa fa-plus"></i> Thêm mới Menu</a>
                                            
                                            <input name="btn_delete" type="button" class="btn btn-danger" value="Xóa các mục đã chọn"  
                                                   onclick="js_CheckValidBeforeDeleteListview(this.form,'chkItems','Bạn có chắc chắn muốn xóa không?','Vui lòng chọn ít nhất 1 mục để xóa!')" />
                                        </div>

                                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50px;" class="text-center">
                                                        <input name="chkItems" type="checkbox" class="checkbox" onclick="js_CheckAllClick(this,this.name);" />
                                                    </th>
                                                    <th>Tiêu đề Menu</th>
                                                    <th>Link</th>
                                                    <th style="width: 100px;" class="text-center">Chỉ mục</th>
                                                    <th style="width: 120px;" class="text-center">Trạng thái</th>
                                                    <th style="width: 150px;" class="text-center">Ngày tạo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($data_view)): $i=1; foreach($data_view as $data): ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <input name="chk[]" type="checkbox" value="<?php echo $data['nid']; ?>" id="chkItems" class="checkbox" onclick="js_CheckItemClick(this, 'chkItems','chkItems');" />
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'index.php/do_menu/f_edit/' . $data['nid']; ?>" style="font-weight: 700; color: #1d4ed8;">
                                                            <?php echo Fview_text($data['ctitle']); ?>
                                                        </a>
                                                    </td>
                                                    <td><code><?php echo Fview_text($data['clink']); ?></code></td>
                                                    <td class="text-center"><?php echo Fview_text($data['cindex']); ?></td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" onclick="update_status('tmenu','<?php echo $data['nid']; ?>','nstatus')">
                                                            <i id="i-nstatus-<?php echo $data['nid']; ?>" class="i-status fa <?php echo ($data['nstatus'] == 1) ? 'fa-check text-success' : 'fa-times text-danger'; ?>" aria-hidden="true"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center"><?php echo Fview_text($data['ddate01']); ?></td>
                                                </tr>
                                                <?php endforeach; else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center italic text-muted">Chưa có menu nào được khởi tạo.</td>
                                                </tr>
                                                <?php endif; ?>
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
    <input type="hidden" name="hidden_button" value="" />
</form>
<!-- /page content -->