<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form name='form_main' method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Tiêu đề Menu <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>" required="required" class="form-control" placeholder="">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Đường dẫn Link</label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_clink" value="<?php echo $txt_clink; ?>" placeholder="" class="form-control">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align">Chỉ mục sắp xếp</label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_cindex" value="<?php echo $txt_cindex; ?>" placeholder="" class="form-control" style="width: 200px;">
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-primary" name="btn_submit" value="btn_submit" onclick="js_SetSubmitButtonClick(this.form, this.name);">Xác nhận lưu</button>
                                    <button class="btn btn-danger" type="button" onclick="location.href='<?php echo $link_cancel; ?>'">Quay về</button>
                                </div>
                            </div>

                            <input name="hidden_nid" type="hidden" value="<?php echo $nid; ?>" />
                            <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
                            <input type="hidden" name="hidden_button" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->