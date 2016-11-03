
<link href="<?php echo site_url('assets/vendors/fine-uploader/fine-uploader.css');?>" rel="stylesheet" type="text/css"/>
<fieldset>
	<legend>Upload Images</legend>
	<div class="row" id="dip-fm-pics">
      <!-- The element where Fine Uploader will exist. -->
	    <div id="fine-uploader" class="col-sm-4">
	    	<div id="uploadbtn" class="col-sm-4 dip-dropbox drop-new">
	    		upload button 
	    	</div>
	    </div>
	</div>
</fieldset>

<!-- Fine Uploader -->
<script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendors/dipcrop/html5imageupload.min.js');?>"></script>
<script src="<?php echo site_url('assets/vendors/fine-uploader/jquery.fine-uploader.min.js');?>" type="text/javascript"></script>
<script>
var currentId = 0;
var uploader = new qq.FineUploaderBasic({
    button:document.getElementById('uploadbtn'),
    request: {
        endpoint: "<?php echo site_url('api/uploadfiles');?>"
    },
    deleteFile: {
        enabled: true,
        method: 'POST',
        endpoint: "<?php echo site_url('api/uploadfiles');?>"
    },
    retry: {
       enableAuto: true
    },
    callbacks: {
    	onComplete: function(id, name, response) {
	        console.log(response);
	        create_new_croper(response);
	    }
    }
});

function create_new_croper(response){
	var html = '<div id="dz-'+currentId+'" class="dropzone" data-id="'+currentId+'" data-canvas="true" data-resize="true" data-originalsize="false" data-ajax="false"  data-width="960" data-height="540" style="width: 100%;"  data-image="'+response.file+'">';
	html += '<input id="dz-input-'+currentId+'" class="drop" type="file" name="thumb['+currentId+']" />';
	html += '<input id="dz-input-original-'+currentId+'" type="text" name="original['+currentId+']" />';
	html += '</div>';
	
	$('#fine-uploader').prepend(html);
	$('#dz-input-original-'+currentId).val(response.file);
	$('#dz-'+currentId).html5imageupload();
}
</script>