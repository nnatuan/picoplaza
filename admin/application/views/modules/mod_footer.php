	<!-- footer content -->
        <footer>
          <div class="pull-right">
            HỆ THỐNG QUẢN TRỊ NỘI DUNG - CMS
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url(); ?>vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url(); ?>vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url(); ?>vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url(); ?>vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url(); ?>vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url(); ?>vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url(); ?>vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url(); ?>vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url(); ?>vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url(); ?>vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url(); ?>vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url(); ?>vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url(); ?>vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url(); ?>js/custom.min.js"></script>
		
	<script src="<?php echo base_url(); ?>js/js.js"></script>
	<script src="<?php echo base_url()?>js/simpleUpload.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
	<?php if(isset($nid_product)) { ?>
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
//console.log(data);
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


		<script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'      : {'nid_product' : '<?php echo $nid_product?>'},
				'swf'      : '<?php echo base_url()?>uploadify/uploadify.swf',
				'uploader' : '<?php echo base_url()?>index.php/do_gallery_img/insert_img/',
				'onQueueComplete' : function() {
            		setInterval('window.location.reload()', 1500);
       			 }
			});
		});
		</script>
		<?php } ?>
		
<?php 
	$fr_img = Fstr_replace(Fget_admin_folder(), '', base_url());
?>

<link rel="stylesheet" type="text/css" href="<?php echo $fr_img; ?>rgn_editor/editor_custom.css" />
<script src="<?php echo $fr_img; ?>rgn_editor/source_editor/ckeditor.js"></script>
<script>
var roxyFileman = '<?php echo $fr_img?>fileman/index.html'; 

$(function(){
    // 1. CẤU HÌNH BỔ SUNG FILE ABOUT.CSS CHO EDITOR1
    CKEDITOR.replace('editor1', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload',
        contentsCss: [
            CKEDITOR.basePath + 'contents.css',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
            '<?php echo $fr_img; ?>css/style.css',
            '<?php echo $fr_img; ?>css/about.css',
			'<?php echo $fr_img; ?>css/product_detail.css'
        ]
    });						
	CKEDITOR.on('instanceReady', function(ev) {
        // Set padding 20px cho body inside iFrame của CKEditor
        ev.editor.document.getBody().setStyle('padding', '15px');
    });
	
    // Các Editor còn lại giữ nguyên cấu hình gốc
    CKEDITOR.replace('editor2', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 						

    CKEDITOR.replace('editor3', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 					

    CKEDITOR.replace('editor4', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    });			

    CKEDITOR.replace('editor5', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 									

    CKEDITOR.replace('editor6', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 

    CKEDITOR.replace('editor7', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 

    CKEDITOR.replace('editor8', {
        filebrowserBrowseUrl: roxyFileman,
        toolbar: 'Full',
        height: '400px',
        filebrowserImageBrowseUrl: roxyFileman + '?type=image',
        removeDialogTabs: 'link:upload;image:upload'
    }); 							
});
</script>

<script>CKEDITOR.dtd.$removeEmpty['span'] = false;</script>
<script>CKEDITOR.dtd.$removeEmpty['i'] = false;</script>
	
	<?php if(isset($m_message) && $m_message!="") { ?>
	<style>
	#alarmmsg {
		position:fixed;top:56px;right:0;font-size: 16px;background:#f7f7f7;padding:10px 15px;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
		background-color: #f44336;
		color: white;
		opacity: 0.83;
		transition: opacity 0.6s;
	}
	.closebtn:hover {
		color: black;
	}
	.closebtn {
		padding-left: 15px;
		color: white;
		font-weight: bold;
		float: right;
		font-size: 20px;
		line-height: 20px;
		cursor: pointer;
		transition: 0.3s;
	}
	</style>
	<div id="alarmmsg" class="">
		<i class="fa fa-exclamation-triangle text-warning" aria-hidden="true"></i> <?php echo $m_message; ?>
		<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
	</div>
	<script type="text/javascript">
			setTimeout(function(){ $("#alarmmsg").fadeOut(); }, 5000);
	</script>
	<?php } ?>
	
	<script>
	function update_status(_table,_id,_field) {
		$.ajax({
			type: "POST",
			url: "<?php echo base_url()?>index.php/ajax_actions/update_status",
			data: { table: _table, id: _id, field: _field },
			success: function(result) {
				//alert(result);
				tag = "#i-"+_field+"-"+_id;
				if(result==1) {
					$(tag).addClass("fa-check text-success");
					$(tag).removeClass("fa-times text-danger");
				} else {
					$(tag).addClass("fa-times text-danger");
					$(tag).removeClass("fa-check text-success");
				}
			}
		});
	}
	</script>
	
	<?php if(isset($menu_active) && $menu_active=="color_lv2") { ?>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>

	<script>
		$(function () {
			$('.demo-colorpicker').colorpicker();
		});
	</script>
	<?php } ?>