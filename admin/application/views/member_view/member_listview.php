<form name="frm_member_list" id="frm_member_list" method="post" action="<?php echo $link_page; ?>">
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><?php echo $lbl_form_title; ?></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            
                            <div class="top-filter" style="margin-bottom: 15px; display: flex; gap: 10px; align-items: center;">
                                            <a href="<?php echo base_url(); ?>index.php/do_member/f_add" class="btn btn-success" style="margin: 0;"><i class="fa fa-plus"></i> Thêm tài khoản mới</a>

                                        </div>
										
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                  <thead>
										<tr>
											 <th class="qcare-th-center qcare-th-stt">STT</th>
											 <th>Tên tài khoản</th>
											 <th>Họ tên Khách hàng</th>
											 <th>Email liên hệ</th>
											 <th class="qcare-th-center">Số điện thoại</th>
											 <th class="qcare-th-center" style="width: 110px;">Trạng thái</th>
											 <th class="qcare-th-center qcare-th-action" style="width: 130px;">Thao tác</th>
										</tr>
									</thead>
                                  <tbody>
                                    <tr class="filter qcare-filter-row">
                                        <td class="text-center">
											<input name="btn_filter" type="button" class="btn btn-info btn-sm" value="Lọc" 
												onclick="js_SetSubmitButtonClick(this.form, this.name);" />
										</td>
                                        <td>
                                            <input name="txtf_cusername" type="text" class="form-control input-sm" value="<?php echo isset($txtf_cusername) ? $txtf_cusername : ''; ?>" placeholder="Tìm username..." />
                                        </td>
                                        <td>
                                            <input name="txtf_cfullname" type="text" class="form-control input-sm" value="<?php echo isset($txtf_cfullname) ? $txtf_cfullname : ''; ?>" placeholder="Tìm họ tên..." />
                                        </td>
                                        <td>
                                            <input name="txtf_cemail" type="text" class="form-control input-sm" value="<?php echo isset($txtf_cemail) ? $txtf_cemail : ''; ?>" placeholder="Tìm email..." />
                                        </td>
                                        <td>
                                            <input name="txtf_cphone" type="text" class="form-control input-sm" value="<?php echo isset($txtf_cphone) ? $txtf_cphone : ''; ?>" placeholder="Tìm SĐT..." />
                                        </td>
                                        <td>&nbsp;</td>
                                        <td></td>
                                    </tr>
                                    
                                    <?php 
                                        if (isset($data_view) && is_array($data_view) && !empty($data_view)):
                                            $i = ($txt_current_page - 1) * $txt_row_per_page + 1; 
                                            foreach($data_view as $data):
                                    ?>
                                      <tr class="even pointer">
                                         <td class="text-center"><?php echo $i; ?></td>
                                         <td><strong><?php echo $data['cusername']; ?></strong></td>
                                         <td class="text-left" style="color:#2a3f54; font-weight:bold;"><i class="fa fa-user"></i> <?php echo Fview_text($data['cfullname']); ?></td>
                                         <td><?php echo $data['cemail']; ?></td>
                                         <td class="text-center"><?php echo $data['cphone']; ?></td>
                                         <td class="text-center">
                                            <?php 
                                                if ($data['nstatus'] == 1) echo '<span class="badge bg-green">Hoạt động</span>';
                                                else echo '<span class="badge bg-red">Khóa</span>';
                                            ?>
                                         </td>
                                         <td class="text-center">
											<a href="<?php echo base_url() . 'index.php/do_member/f_edit/' . $data['nid']; ?>" class="btn btn-warning btn-xs btn-action"><i class="fa fa-edit"></i> Sửa</a>
											<a href="<?php echo base_url() . 'index.php/do_member_listview/f_delete/' . $data['nid']; ?>" class="btn btn-danger btn-xs btn-action" onclick="return confirm('Bạn có chắc muốn xóa tài khoản khách hàng này?');"><i class="fa fa-trash"></i></a>
										</td>
                                      </tr>
                                    <?php $i++; endforeach; else: ?>
                                      <tr><td colspan="7" class="text-center" style="font-style:italic; padding:20px;">Không có tài khoản khách hàng nào.</td></tr>
                                    <?php endif; ?>
                                  </tbody>
                                </table>
                            </div>
                            
                            <table class="table qcare-table-pagination" cellspacing="1">
								<tr><td></td><td class="qcare-pagination-block"><div class="form-inline pull-right"><label><?php echo $lbl_rows_per_page; ?>:</label>&nbsp;<input class="form-control text-center input-sm" name="txt_row_per_page" type="text" size="5" value="<?php echo $txt_row_per_page; ?>" />&nbsp;<input name="btn_row_per_page" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" /></div></td><td class="qcare-pagination-block"><div class="form-inline pull-right"><?php if($txt_current_page > 1): ?><input class="btn btn-default btn-sm" name="btn_previous" type="button" value="<<" onclick="js_SetSubmitButtonClick(this.form, 'btn_previous');"/>&nbsp;<?php endif; ?><label><?php echo $txt_current_page . ' / ' . $txt_total_page; ?></label>&nbsp;<?php if($txt_current_page < $txt_total_page): ?><input class="btn btn-default btn-sm" name="btn_next" type="button" value=">>" onclick="js_SetSubmitButtonClick(this.form, 'btn_next');"/>&nbsp;<?php endif ?><input class="form-control text-center input-sm" name="txt_current_page" type="text" value="<?php echo $txt_current_page; ?>" size="5" />&nbsp;<input name="btn_page_number" type="button" value="<?php echo $btn_choose; ?>" onclick="js_SetSubmitButtonClick(this.form, this.name);" class="btn btn-default btn-sm" /></div></td></tr>					
							</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input name="hidden_nid" type="hidden" value="0" />
    <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
</form>