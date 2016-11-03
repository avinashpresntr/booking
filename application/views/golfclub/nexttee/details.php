<section class="dip-dash-sec">
  <h3><?=$this->lang->line('NextTeeDetails');?></h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg(); ?>
    <div class="dip-form-body">
      
      <fieldset>
      <legend><?php echo $this->lang->line('GolfClubdescription'); ?></legend>
      <div class="row">
        <?php foreach ($client->languages as $key => $value):?>
          <div class="col-sm-4">
            <?php
            $default = '';
            $required = '';
            if($value==$client->default_language){
              $default = 'default';
              $required = 'required';
            }
            $r_descr = '';
            if(isset($client->descr[$value]))
              $r_descr = $client->descr[$value];
            ?>
            <div class="dip-langbox <?=$default;?>">
              <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
              <label class="control-label" for="dipDesc"><?php echo $this->lang->line('Description'); ?></label>
              <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'5'), set_value('descr['.$value.']',$r_descr), 'class="form-control" id="dipDesc'.$value.'" placeholder="'.$this->lang->line('Description').'" ');?>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
      </fieldset>
      <div class="row">
        <div class="col-sm-3">
          <fieldset>
            <legend><?php echo $this->lang->line('GolfclubLogo'); ?></legend>
              <?php if(!empty($client->logo)): ?>
                  <div id="dz-logo" class="dropzone dropzone-logo-old" data-canvas="true" 
                  data-resize="true" data-originalsize="false" data-ajax="false" 
                  data-removeurl="<?php echo site_url('api/upload');?>" 
                  data-width="400" data-height="400" 
                  style="width: 100%;"  data-image="<?php echo site_url($client->logo[0]['url']);?>">
                      <input id="dz-input" class="drop" type="file" name="thumb2[0]"/>
                  </div>
                <?php echo form_checkbox('previmage2[0]', '1', false, 'id="dz-logo-check" style="display:none;"'); ?>
              <?php else:?>
                <!-- add new button -->
                <div id="dz-logo" class="dropzone dropzone-new"
                data-canvas="true" data-resize="true" data-originalsize="false" data-ajax="false" 
                data-width="400" data-height="400"  
                style="width: 100%;">
                    <input id="dz-input" class="drop" type="file" name="thumb2[0]"/>
                </div>
              <?php endif;?>
          </fieldset>
        </div>
        <div class="col-sm-9">
          <fieldset>
                <legend><?php echo $this->lang->line('Facilities'); ?></legend>
                <div class="dip-checkboxs row">
                  <?php foreach ($facilities as $key => $value):?>
                    <div class="col-xs-4 col-sm-3">
                    <label class="checkbox-inline  chk-fac clearfix">
                    <?php echo form_checkbox('facilities['.$key.']',$key, (in_array($key, $client->facilities)?true:false)); ?> <?=$value;?>
                    <img src="<?php echo site_url('assets/img/fcilities/'.$key.'.png');?>" alt="<?=$value;?>">
                    </label>
                    </div>
                  <?php endforeach;?>
                </div>
              <br/>
          </fieldset>
        </div>
      </div>



      <?php
      $fu_imgs['pics'] = $client->pics;
      $fu_imgs['title'] = $this->lang->line('GolfClubImages');
      $this->load->view('common/fileuploader',$fu_imgs); ?>
      <br/>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', $this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/nexttee');?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?> </a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>
<script>
jQuery(document).ready(function($) {
  $('.dropzone-logo-old').html5imageupload({
    onAfterRemoveImage: function() {
      $('#dz-logo-check').prop('checked', true);
    }
  });
  $('#dz-logo.dropzone-new').html5imageupload();
});
</script>
<style>
  .form-horizontal .checkbox-inline {
      margin-top: 0;
      margin-bottom: 0;
      padding-top: 8px;
      display: block;
      padding: 5px;
      width: 100%;
      padding-left: 25px;
      background: #DDECCF;
      margin-bottom: 5px;
      border-radius: 5px;
  }
  .chk-fac img {
    width: 50%;
    float: right;
    max-width: 50px;
}
</style>

