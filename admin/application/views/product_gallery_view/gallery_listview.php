
<style type="text/css">
	
	
.box2 {
	display: inline-block;
	width: 100px;
	height: 100px;
	line-height: 98px;
	background-color: white;
	border: 4px dashed #B5B5B5;
	color: #B5B5B5;
	font-size: 50px;
	text-align: center;
}
#progressBar {
	background-color: #3E6FAD;
	width: 0px;
	height: 5px;
	margin-top: 10px;
	margin-bottom: 10px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-o-border-radius: 5px;
	border-radius: 5px;
	-moz-transition: .25s ease-out;
	-webkit-transition: .25s ease-out;
	-o-transition: .25s ease-out;
	transition: .25s ease-out;
}
#uploads .block {
	display: inline-block;
	vertical-align: top;
	width: 100px;
	height: 100px;
	margin-right: 20px;
	margin-bottom: 20px;
	padding: 10px;
	background-color: white;
	border: 1px solid #CCCCCC;
}

#uploads .block .progressBar {
	background-color: #3E6FAD;
	width: 0px;
	height: 5px;
	margin-top: 47px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-o-border-radius: 5px;
	border-radius: 5px;
	-moz-transition: .25s ease-out;
	-webkit-transition: .25s ease-out;
	-o-transition: .25s ease-out;
	transition: .25s ease-out;
}

#uploads .block .format {
	text-align: center;
	font-size: 20px;
	font-weight: bold;
	margin-top: 34px;
}

#uploads .block .error {
	text-align: left;
	font-size: 14px;
	color: red;
}

</style>



<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
			


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Hình ảnh sản phẩm <small class="text-danger"> <?php echo get_product_name($nid_product); ?> </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>

                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					<p class="text-danger"><em>Lưu ý: chỉ up ảnh < 2MB, kích chuẩn 1000x1000, tên hình ko gồm ký tự đặc biệt.</em></p>
					<div id="uploads"></div>
<div id="filename"></div>
<div id="progress"></div>
<div id="progressBar"></div>

<label for="file"><div class="box2">+</div></label>

<input type="file" id="file" name="Filedata" style="display: none;" multiple>
<div style="clear: both;"></div>
                    <div class="container">
						<?php $fr_img = Fstr_replace('admin/', '', base_url());
							$obj_img = get_img_by_product($nid_product);
							foreach ($obj_img as $data) {
						?>
                      <div style="width:100px;float:left;margin-right:10px;margin-top:20px;">
                        <img style="width:100px;height:100px;object-fit:cover" src="<?php echo $fr_img.'upload/images_product/sub_images/'.$data['cimage'];?>" alt="image" />
						<div class="caption text-center">
                           <a href="javascript:delete_img('<?php echo $data["nid"]?>')">Xóa</a>
                          </div>
                      </div>
					  <?php } ?>
                      <div class="clearfix"></div>

											<div style="margin-top:30px;">
												<input name="btn_cancel"  type="button" 
											   value = "<?php echo $btn_cancel; ?>"
											   onclick="location.href='<?php echo base_url().'index.php/do_product_listview'?>'" class="btn btn-danger"/>
											</div>

					</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
