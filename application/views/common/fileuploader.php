
<fieldset>
	<legend><?php echo (isset($title)?$title:$this->lang->line('UploadImages')); ?></legend>
	<div class="row" id="dip-fm-pics">

		<?php 
		// this will count the number of images and add them a unique id
		$conut_dz = 0;
		?>

		<?php if(!empty($pics)): ?>
		<!-- load previous images -->
			<?php foreach ($pics as $key => $image):?>
			<div id="dz-container-<?php echo $conut_dz;?>" class="col-sm-4 dip-dropbox drop-old">
				<button type="button" class="btn dz-close" onclick="removediv(<?php echo $conut_dz;?>)"><i class="fa fa-times"></i></button>
				<div id="dz-<?php echo $conut_dz;?>" class="dropzone dropzone-old" data-id="<?php echo $conut_dz;?>" data-canvas="true" 
				data-resize="true" data-originalsize="false" data-ajax="false" data-removeurl="<?php echo site_url('api/upload');?>" data-width="960" 
				data-height="540" style="width: 100%;"  data-image="<?php echo site_url($image['url']);?>">
				    <input id="dz-input-<?php echo $conut_dz;?>" class="drop" type="file" name="thumb[<?php echo $conut_dz; ?>]"/>
				</div>
			</div>
			<?php echo form_checkbox('previmage['.$conut_dz.']', '1', false, 'id="dz-check-'.$conut_dz.'" style="display:none;"'); ?>
			
			<?php $conut_dz++; ?>
			<?php endforeach;?>
		<?php endif;?>

		<!-- add new button -->
		<div id="dz-container-<?php echo $conut_dz;?>" class="col-sm-4 dip-dropbox drop-new">
			<div id="dz-<?php echo $conut_dz;?>" class="dropzone dropzone-new" data-id="<?php echo $conut_dz;?>" data-canvas="true" 
			data-resize="true" data-originalsize="false" data-ajax="false" data-width="960" 
			data-height="540" style="width: 100%;">
			    <input id="dz-input-<?php echo $conut_dz;?>" class="drop" type="file" name="thumb[<?php echo $conut_dz; ?>]" />
			</div>
		</div>
	</div>
</fieldset>
<?php if(!isset($nojs)): ?>
<script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendors/dipcrop/html5imageupload.min.js');?>"></script>
<?php endif; ?>







<script>
var currentId = <?php echo $conut_dz;?>;
var clickdiv;
jQuery(document).ready(function($) {
	$('.dropzone-old').html5imageupload({
		onAfterRemoveImage: function() {
			var el = $(this).get(0).element;
			var id = $(el).attr("data-id");
			$('#dz-check-'+id).prop('checked', true);
		}
	});
	$('#dz-'+currentId).html5imageupload({
		onAfterRemoveImage: removediv
	});
	$('#dz-input-'+currentId).change(addnewdiv);

	//$('.dropzone').html5imageupload({
		// onAfterProcessImage: function() {
		// // 	$('.dropzone .tools.final .btn-edit').on('click', function(event) {
		// // 		//event.preventDefault();
		// // 		$('.dropzone .tools .saving').remove();
		// // 		$('.dropzone .tools div').attr({
		// // 			style :"display: inline-block;"
		// // 		});
		// // 	});
		// 	var filesd = $('#drop1')[0].files;

		// 	var formData = new FormData();
		// 	formData.append('action', 'ajax_handler_import' );
		// 	formData.append('thum_values', $('input[name="thumb_values"]').val());
		// 	$.each(filesd,function(i, file) {
	 //            formData.append('uploadFile-'+i, file);
	 //        });
		// 	$.ajax({
		//         url: "<?php echo site_url('api/upload');?>",
		//         data: formData,
		//         processData: false,
		//         contentType: false,
		//         type: 'POST',
		//         success: function(data){


		//         	// $('.dropzone').attr({
		//         	// 	'data-canvas': 'true'
		//         	// });


		//             console.log(data);
		//         }
		//     });
		//  }
	//});

});


function removediv(id) {
	$('#dz-check-'+id).prop('checked', true);
	$('#dz-container-'+id).remove();
}
function addnewdiv() {
	//console.log(currentId);
	var btncls = '<button type="button" class="btn dz-close" onclick="removediv('+currentId+')"><i class="fa fa-times"></i></button>';
	$('#dz-container-'+currentId).prepend(btncls);

	currentId++;
	var html = '<div id="dz-container-'+currentId+'" class="col-sm-4 dip-dropbox drop-new">';
	html +=	'<div id="dz-'+currentId+'" class="dropzone drop-nw" data-id="'+currentId+'" data-canvas="true" data-resize="true" data-save-original="fasle" data-ajax="false" data-width="960" data-height="540" style="width: 100%;">';
	html +=	'<input id="dz-input-'+currentId+'" class="drop" type="file" name="thumb['+currentId+']"/>';
	html += '</div></div>';
	$('#dip-fm-pics').append(html);
	$('#dz-'+currentId).html5imageupload({
		onAfterRemoveImage: removediv
	});
	$('#dz-input-'+currentId).change(addnewdiv);
}
</script>