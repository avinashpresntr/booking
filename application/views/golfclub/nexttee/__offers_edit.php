<?php 
$today = date('Y-m-d');
if(!empty($client->city) && !empty($client->country)){
  $today = get_timee($client->city,$client->country);
}else{
  echo '<script>alertify.alert("You need to first set your Country and City.");</script>';
}?>
<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_alerts('golfclub/nexttee/offers', 'Offer'); ?>
    <div class="dip-form-body">
      

      <fieldset>
        <legend>Offer validity:</legend>
          <div class="form-inline">
            <div class="form-group" style="padding:0 15px;">
              <label class="control-label" for="dipStart">From</label>              
              <?php echo form_input('starting', set_value('starting',$row->startdate), 'class="form-control" id="dipStart" placeholder="00-00-0000" style="width:120px;" data-datepicker required');?>
            </div>
            <div class="form-group" style="padding:0 15px;">
              <label class="control-label" for="dipEnd">To</label>
              <?php echo form_input('ending', set_value('ending',$row->enddate), 'class="form-control" id="dipEnd" placeholder="00-00-0000" style="width:120px;" data-datepicker required');?>
            </div>
          </div>
      </fieldset>

      <fieldset>
      <legend>Offer description:</legend>
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
            $r_name = '';
            $r_descr = '';
            if(isset($row->title[$value]))
              $r_name = $row->title[$value];
            if(isset($row->descr[$value]))
              $r_descr = $row->descr[$value];
            ?>
            <div class="dip-langbox <?=$default;?>">
              <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
              <label class="control-label" for="dipName">Name</label>
              <?php echo form_input('title['.$value.']', set_value('title['.$value.']',$r_name), 'class="form-control" id="dipName'.$value.'" placeholder="Name" '.$required);?>
            
              <label class="control-label" for="dipDesc">Description</label>
              <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'5'), set_value('descr['.$value.']',$r_descr), 'class="form-control" id="dipDesc'.$value.'" placeholder="Description" '.$required);?>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
      </fieldset>


      <?php 
      if(isset($row->enddate) && !empty($row->enddate) && (encode_date($row->enddate) < $today || encode_date($row->startdate) > $today )){
        // show nothing
      }
      else{
        $this->load->view('common/push_notification',array('client' => $client)); 
      }
      ?>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save & Publish','class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/nexttee/offers');?>" class="btn btn-default" >Cancel</a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("input[type=button], input[type=submit]").attr("disabled", "disabled");
    };
</script>