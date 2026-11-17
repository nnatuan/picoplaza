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
                        <h2><?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php if(!empty($m_message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $m_message; ?>
                            </div>
                        <?php endif; ?>

                        <form name='form_main' method="post" action="<?php echo $link_page; ?>">
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_ccat_product; ?> <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_ctitle" value="<?php echo $txt_ctitle; ?>" required="required" class="form-control" onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_ccode; ?> <span class="required">*</span></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" id="txt_ccode" name="txt_ccode" value="<?php echo $txt_ccode; ?>" required="required" class="form-control ">
                                </div>
                            </div>
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_index; ?> </label>
                                <div class="col-md-8 col-sm-8 ">
                                    <input type="text" name="txt_cindex" value="<?php echo $txt_cindex; ?>" class="form-control ">
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><?php echo $lbl_nstatus; ?></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <?php echo $gen_cbo_status; ?>
                                </div>	
                            </div>

                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-primary" name="btn_submit" value="<?php echo $btn_update; ?>" 
                                        onclick="js_SetSubmitButtonClick(this.form, this.name);">Xác nhận</button>
                                    <button class="btn btn-danger" type="button" name="btn_cancel" value="<?php echo $btn_cancel; ?>" 
                                        onclick="location.href='<?php echo $link_cancel; ?>'">Quay về</button>
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