<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <p class="error_msg"> <?php echo $this->lang->line('FormValidation_fieldrequired'); ?> </p>
    <div class="dip-form-body">
      
      <fieldset>
      <legend><?php echo $this->lang->line('Genaral'); ?> </legend>
      <div class="row">
        <?php foreach ($client->parent->languages as $key => $value):?>
          <div class="col-sm-4">
            <?php
            $default = '';
            $required = '';
            if($value==$client->parent->default_language){
              $default = 'default';
              $required = 'required';
            }
            $r_name = '';
            $r_descr = '';
            if(isset($client->title[$value]))
              $r_name = $client->title[$value];
            if(isset($client->descr[$value]))
              $r_descr = $client->descr[$value];
            ?>
            <div class="dip-langbox <?=$default;?>">
              <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
              
              <label class="control-label" for="dipDesc"><?php echo $this->lang->line('Presentation'); ?></label>
              <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'5'), set_value('descr['.$value.']',$r_descr), 'class="form-control" id="dipDesc'.$value.'" rel="'.$value.'" placeholder="'.$this->lang->line('Presentation').'" '.$required);?>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
      </fieldset>

      <?php
      $fu_imgs['pics'] = $client->pics;
      $this->load->view('common/fileuploader',$fu_imgs); ?>
      <br/>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', $this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/courses');?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?></a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>
<script>
$(document).ready(function(e) {
	$('.btn-success').click(function(){
	var count = 0;
	$(".dip-form textarea").each( function(){			  
		var rel = $(this).attr('rel');
		var desc = $('.dip-form #dipDesc'+rel).val();
		var val = $(this).val(); 
		
		if(($(this).prop('required'))&&(val== "")){
			count++;		  
		}
		
		if(desc == "" && rel == '<?php echo $client->default_language;?>'){
				$('.dip-form #dipDesc'+rel).css('border-color','red');
			} else {
				$('.dip-form #dipDesc'+rel).css('border-color',' '); 	
		 }		
	});
	if(count > 0){
		$('.alert-success').css('display', 'none');
		$('.error_msg').css('display','block') //to show
	} else {
		$('.error_msg').css('display','none') //to hide		
	}
	}); 
});
</script>
