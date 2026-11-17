<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>js/simpleUpload.js" type="text/javascript"></script>
<style type="text/css">
	
	
.box2 {
	display: inline-block;
	width: 90px;
	height: 90px;
	background-color: white;
	border: 4px dashed #B5B5B5;
	color: #B5B5B5;
	font-size: 50px;
	text-align: center;
	
}
#progressBar {
	background-color: #3E6FAD;
	width: 0px;
	height: 30px;
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
	<script type="text/javascript">
		<?php $timestamp = time();?>
		
		$(document).ready(function(){

	$('input[type=file]').change(function(){

		$(this).simpleUpload("<?php echo base_url()?>index.php/do_gallery_img/insert_img/<?php echo $nid_product?>", {

			allowedExts: ["jpg", "jpeg", "jpe", "jif", "jfif", "jfi", "png", "gif"],
			allowedTypes: ["image/pjpeg", "image/jpeg", "image/png", "image/x-png", "image/gif", "image/x-gif"],
			maxFileSize: 5000000, //5MB in bytes

			start: function(file){
				//upload started

				this.block = $('<div class="block"></div>');
				this.progressBar = $('<div class="progressBar"></div>');
				this.cancelButton = $('<div class="cancelButton">x</div>');

				/*
				 * Since "this" differs depending on the function in which it is called,
				 * we need to assign "this" to a local variable to be able to access
				 * this.upload.cancel() inside another function call.
				 */

				var that = this;

				this.cancelButton.click(function(){
					that.upload.cancel();
					//now, the cancel callback will be called
				});

				this.block.append(this.progressBar).append(this.cancelButton);
				$('#uploads').append(this.block);

			},

			progress: function(progress){
				//received progress
				this.progressBar.width(progress + "%");
			},

			success: function(data){
				//upload successful
//alert(data);
console.log(data);
				this.progressBar.remove();
				this.cancelButton.remove();
				location.reload();

				if (data.success) {
					//now fill the block with the format of the uploaded file
					var format = data.format;
					var formatDiv = $('<div class="format"></div>').text(format);
					this.block.append(formatDiv);
				} else {
					//our application returned an error
					var error = data.error.message;
					var errorDiv = $('<div class="error"></div>').text(error);
					this.block.append(errorDiv);
					console.log(error);
				}

			},

			error: function(error){
				//upload failed
				this.progressBar.remove();
				this.cancelButton.remove();
				var error = error.message;
				var errorDiv = $('<div class="error"></div>').text(error);
				this.block.append(errorDiv);
			},

			cancel: function(){
				//upload cancelled
				this.block.fadeOut(400, function(){
					$(this).remove();
				});
			}

		});

	});

});

		function delete_img(id){
			var cfm = confirm(" Bạn muốn xóa hình này ?");
			if (cfm == true) {
			$.post( "<?php echo base_url().'index.php/do_gallery_img/delete_img'?>", { nid: id })
  				.done(function( data ) {
   					 setInterval('window.location.reload()', 500);
 				 });
 			}
		}
	</script>

<div class="app-title">
            <div>
               <h1><i class="ico-low-price"></i>Quản lý Thư viện ảnh</h1>
            </div>
            <ul class="breadcrumb">
               <li class="breadcrumb-item"><a href="#"><i class="ico-home-1"></i></a></li>
               <li class="breadcrumb-item">Hình ảnh sản phẩm</li>
            </ul>
         </div>
		<div class="card card-flat table-responsive">
			<div class="card-header">
               <div class="card-title">Hình ảnh <strong><?php $gal = get_gallery_by_id($nid_product); echo $gal['ctitle']; ?></strong></div>
            </div>
            <div class="card-body">
				<div id="uploads"></div>
				<div id="filename"></div>
				<div id="progress"></div>
				<div id="progressBar"></div>

				<label for="file"><div class="box2">+</div></label><br><br>
				
				<input type="file" id="file" name="Filedata" style="display: none;" multiple>

				<?php 
					//$obj_img = get_img_by_product($nid_product);
					foreach ($data_view as $data) {
				?>
					<div style="float:left;margin-right:10px;margin-bottom:10px;">
						<div style="width:80px;height:80px;">
						<img src="<?php echo $fr_img.'upload/gallery/'.$data['cimg']; ?>" style="width:100%;height:100%;" alt="No Image"/>
						</div>
						<p style="text-align:center;margin-top:5px;">
							<a href="javascript:delete_img('<?php echo $data["nid"]?>')">Xóa</a>
						</p>
					</div>
				<?php } ?>
				<div style="clear:both;"></div>

				<button class="btn mui-btn mui-btn--accent" type="button" name="btn_cancel" 
							onclick ="location.href='<?php echo base_url().'index.php/do_gallery_listview'; ?> '" style="margin-top:30px;">Cancel</button>
			</div>	
         </div>