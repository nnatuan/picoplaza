		<div class="app-title">
            <div>
               <h1><i class="ico-artist"></i>Quản lý Bài viết</h1>
            </div>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="#"><i class="ico-home-1"></i></a></li>
               <li class="breadcrumb-item">Bài viết</li>
            </ul>
         </div>
         <div class="card card-flat">
            <div class="card-header">
               <div class="card-title">Add / Update <strong><?php echo $ctitle; ?></strong></div>
            </div>
            <div class="card-body">
               <form class="mui-form" name='form_main' method="post" action="<?php echo $link_page; ?>" enctype="multipart/form-data">
                  <div class="form-input form-has-error">
                     <input class="form-element-field" name="ctitle" placeholder=" " type="text" value="<?php echo $ctitle; ?>" required onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);" />
                     <div class="form-element-bar"></div>
                     <label class="form-element-label">Tên</label>
                  </div>
				  <div class="form-input">
                     <input class="form-element-field" name="cindex" placeholder=" " type="text" value="<?php echo $cindex; ?>" required />
                     <div class="form-element-bar"></div>
                     <label class="form-element-label">Chỉ mục</label>
                  </div>
                  <div class="form-input">
                     <input name="cimg" type="file" id="cimg" value ="" size="25" />
						<div>
							<?php 
								$url_icon = base_url().'do_gallery/delete_image_icon/'.$nid; 
							?>
								<div id="images_div_icon">
							<?php 
								if($cimg !='') echo '<img width="150" style=" border:none;margin-top:10px;"  src="'.$fr_img.'upload/gallery/'.$cimg.'  "/>';
								else echo 'No image ';
							?>
								
								</div>
								
							
						</div>
                  </div>
				  
				  <div class="text-danger-800"><?php //echo $error_message; ?></div>
				  
				  <input name="hidden_nid" type="hidden" value = "<?php echo $nid; ?>"  />
				  <input name="hidden_event" type="hidden" value = "<?php echo $event; ?>"  />
				  <input type="hidden" name="hidden_button"  value = "" />
				  <input name="hidden_image_old" type="hidden" value = "<?php echo $cimg; ?>"  />
				  
                  <button class="btn mui-btn mui-btn--accent mt20" type="button" name="btn_submit" value ="<?php echo $btn_update; ?>" 
							onclick ="js_SetSubmitButtonClick(this.form, this.name);">Submit</button>
					<button class="btn mui-btn mui-btn--accent mt20" type="button" name="btn_cancel" value ="<?php echo $btn_cancel; ?>" 
							onclick ="location.href='<?php echo $link_cancel; ?> '">Cancel</button>
               </form>
            </div>
         </div>