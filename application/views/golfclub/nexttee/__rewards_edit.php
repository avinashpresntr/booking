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
    <?php echo get_msg(); ?>
    <div class="dip-form-body">

      <fieldset>
      <legend>Genaral:</legend>
      <div class="row">
        <?php foreach ($client->languages as $key => $value):?>
          <div class="col-sm-4">
            <?php
            $default = '';

            if($value==$client->default_language){
              $default = 'default';

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
              <?php echo form_input('title['.$value.']', set_value('title['.$value.']',$r_name), 'class="form-control" id="dipName'.$value.'" placeholder="Name" maxlength="70" '.$required);?>
            
              <label class="control-label" for="dipDesc">Description</label>
              <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'5'), set_value('descr['.$value.']',$r_descr), 'class="form-control" id="dipDesc'.$value.'" placeholder="Description" '.$required);?>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
      </fieldset>
      <div class="row">
        <div class="col-sm-4">
          <fieldset>
            <legend>Reward Card:</legend>
            <div class="form-group">
                <label class="col-sm-6 control-label" for="dipPoints">No of Reward Points</label>
                <div class="col-sm-6">
                  <?php echo form_input('points', set_value('points',$row->points), 'type="number" class="form-control" id="dipPoints" placeholder="No of Points"');?>
                </div>
            </div>
            <?php 
            $no = '';
            if (!isset($row->points) || $row->points == 0) {
              $no = 'empty-cart';
            } ?>
            <div id="dip-reward-cart" class="<?php echo $no;?>">
              <?php 
              if(isset($row->points) && $row->points != 0){
                for ($i=0; $i < $row->points; $i++) { 
                echo '<span class="dip-cart"><i class="fa fa-gift"></i></span>';
                } 
              }?>
            </div>
        </div>
        <div class="col-sm-8">
          <fieldset>
            <legend>Reward Validity Details:</legend>
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
        </div>
        
      </div>
      
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
      <a href="<?php echo site_full_url('golfclub/nexttee/rewards');?>" class="btn btn-default" >Quit</a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("input[type=button], input[type=submit]").attr("disabled", "disabled");
    };
</script>


<?php 
      if(isset($row->enddate) && !empty($row->enddate) && (encode_date($row->enddate) < $today || encode_date($row->startdate) > $today )){
        // show nothing
      }
      else{?>
<section>
<br/>
            <?php if(empty($row->id)): ?>
              <div class="alert push-alert alert-warning text-center" role="alert">
                  <h4>Genarate QR Code</h4>
                  <p>To genarate QR Codes You need to save the Reward First.</p>
              </div>
            <?php else: ?>
              <div class="alert push-alert alert-success text-center" role="alert">
                  <h4>Generate QR codes for your rewards program</h4>
                  
                  <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <?php 
                        $alang = array();
                        foreach ($client->languages as $key => $value) {
                          $alang[$value] = $langs[$value];
                        }?>
                        <div class="form-group row">
                            <label class="col-sm-6 control-label" for="dipQRLang" style="color:white;">Select the language</label>
                            <div class="col-sm-6">
                              <?php echo form_dropdown('qr_lang', $alang, $client->default_language, 'id="dipQRLang" class="form-control"'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-6 control-label" for="qr_no" style="color:white;">Number of pages to print<br>(1 page contains 24 QR codes)</label>
                            <div class="col-sm-6">
                              <?php echo form_input('qrcodeno', set_value('qrcodeno'), 'id="dipQR" class="form-control" style="width:100px;text-align:center;color:black;"');?>
                            </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-sm-6"></div>
                          <div class="col-sm-6 text-left"><button type="button" onclick="genarate_qrcode()" class="btn btn-warning">GENERATE QR CODES</button></div>
                        </div>
                    </div>
                  </div>
              </div>

            <?php endif; ?>

</section>
<?php } ?>





<script>
<?php $url_v = site_url();?>
<?php $url_q = site_query();?>

function genarate_qrcode(){
  var langId = $('#dipQRLang').val();
  var qrcodeNo = $('#dipQR').val() * 24;
  var rewardId = "<?php echo $row->id;?>";
  var url = "<?=$url_v;?>golfclub/nexttee/genarate_qrcode";
  url = url+'/'+rewardId+'/'+qrcodeNo+'/'+langId+'<?=$url_q?>';

  if(qrcodeNo==''){
    alertify.alert("Please Put Some No To Genarate QR Codes", function() {});
  }
  else if(isPositiveInteger(qrcodeNo) == true){
    window.open(url, '_blank');
  }
  else{
    alertify.alert("The No of Genarate QR Codes is either too large or invalid");
  }
}
function isPositiveInteger(s)
{
    var i = +s; // convert to a number
    if (i < 0) return false; // make sure it's positive
    if (i > 600) return false; // make sure it's positive
    if (i != ~~i) return false; // make sure there's no decimal part
    return true;
}

jQuery(document).ready(function($) {
  $('#dipPoints').change(function() {
    var no = $(this).val();
    if(!no){
      $('#dip-reward-cart').addClass('empty-cart');
    }else{
      $('#dip-reward-cart').removeClass('empty-cart');
    }

    var html = '';
    for (var i = 0; i < no; i++) {
      html += '<span class="dip-cart"><i class="fa fa-gift"></i></span>';
          console.log(i);
    };


    $('#dip-reward-cart').html(html);

  });
});
</script>



<style>
  #dip-reward-cart{
    text-align: center;
    background: #70B072;
    -webkit-border-radius:5px;
            border-radius: 5px;
        padding: 5px;
        border: 2px solid rgb(72, 103, 74);
    -webkit-box-shadow: 0 0 40px rgba(0, 0, 0, 0.21) inset;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.21) inset;
  }
  #dip-reward-cart span{
    display: inline-block;
    margin: 0;
    height: 40px;
    width: 20%;
    position: relative;
  }
  #dip-reward-cart span:before{
    content: "";
    display: block;
    height: 30px;
    width: 30px;
    margin: 5px auto;
    background:rgb(140, 91, 58);
    -webkit-border-radius: 50%;
            border-radius: 50%;
  }
  .empty-cart{
    display: none;
  }
  #dip-reward-cart span.dip-cart i{
    position: absolute;
    top: 50%;
    left: 50%;
    z-index: 100;
    color: rgba(255, 255, 255, 0.82);
    font-size: 20px;
    margin-top: -10px;
    margin-left: -9px;
  }
</style>
