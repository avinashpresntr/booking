		<?php 
		// this will count the number of images and add them a unique id
		$conut_dz = 0;
		?>
		<?php if(!empty($pics)): ?>
		<!-- load previous images -->
			<?php foreach ($pics as $key => $image):?>
				<div id="dz-<?php echo $conut_dz;?>" class="dropzone dropzone-old" 
				data-id="<?php echo $conut_dz;?>" data-canvas="true" 
				data-resize="true" data-originalsize="false" data-ajax="false" 
				data-removeurl="<?php echo site_url('api/upload');?>" 
				data-width="<?php echo $config['width'];?>" data-height="<?php echo $config['height'];?>" 
				style="width: 100%;"  data-image="<?php echo site_url($image['url']);?>">
				    <input id="dz-input-<?php echo $conut_dz;?>" class="drop" type="file" name="thumb[<?php echo $conut_dz; ?>]"/>
				</div>
			<?php echo form_checkbox('previmage['.$conut_dz.']', '1', false, 'id="dz-check-'.$conut_dz.'" style="display:none;"'); ?>
			
			<?php $conut_dz++; ?>
			<?php endforeach;?>
		
		<?php else:?>
			<!-- add new button -->
			<div id="dz-<?php echo $conut_dz;?>" class="dropzone dropzone-new" data-id="<?php echo $conut_dz;?>" 
			data-canvas="true" data-resize="true" data-originalsize="false" data-ajax="false" 
			data-width="<?php echo $config['width'];?>" data-height="<?php echo $config['height'];?>"  
			style="width: 100%;">
			    <input id="dz-input-<?php echo $conut_dz;?>" class="drop" type="file" name="thumb[<?php echo $conut_dz; ?>]" <?php if(!isset($config['notrequired'])){echo 'required';}?>/>
			</div>
		<?php endif;?>

<script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendors/dipcrop/html5imageupload.min.js');?>"></script>
<script>
var currentId = <?php echo $conut_dz;?>;
jQuery(document).ready(function($) {
	$('.dropzone-old').html5imageupload({
		onAfterRemoveImage: function() {
			var el = $(this).get(0).element;
			var id = $(el).attr("data-id");
			$('#dz-check-'+id).prop('checked', true);
			<?php if(!isset($config['notrequired'])):?>
			$('#dz-input-'+id).prop('required', 'required');
			<?php endif;?>
		}
	});
	$('#dz-'+currentId).html5imageupload();
});
</script>