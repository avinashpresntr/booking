<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <?php echo form_open_multipart(current_full_url(), 'id="advForm" class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <div class="dip-form-body">
      
      <div class="row">
        <div class="col-sm-12">
          <fieldset>
            <legend>Client level Settings:</legend>
            <div class="row">
            <?php foreach ($user_levels as $key => $value):?>
              <div class="col-sm-3 col-xs-6">
                <h3 style="font-size:12px;"><?php echo $value; ?></h3>
                <div class="form-group">
                  <label class="col-sm-8 control-label" for="dipOffer<?php echo $value; ?>">Number of Offers</label>
                  <div class="col-sm-4 nopd">
                    <?php echo form_input('offer['.$key.']', set_value('offer['.$key.']',(isset($settings['nt_offers'][$key])?$settings['nt_offers'][$key]:'')), 'class="form-control" id="dipOffer"'.$value);?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-8 control-label" for="dipReward<?php echo $value; ?>">Number of Rewards</label>
                  <div class="col-sm-4 nopd">
                    <?php echo form_input('reward['.$key.']', set_value('reward['.$key.']',(isset($settings['nt_rewards'][$key])?$settings['nt_rewards'][$key]:'')), 'class="form-control" id="dipReward"'.$value);?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-8 control-label" for="dipPush<?php echo $value; ?>">Number of Push</label>
                  <div class="col-sm-4 nopd">
                    <?php echo form_input('push['.$key.']', set_value('push['.$key.']',(isset($settings['nt_push'][$key])?$settings['nt_push'][$key]:'')), 'class="form-control" id="dipPush"'.$value);?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-8 control-label" for="dipPush<?php echo $value; ?>">Show NT-Events</label>
                  <div class="col-sm-4 nopd">
                    <?php 
					$options = array(1 => 'Yes',0 => 'No'); 
					//echo form_dropdown('to', $options, -1, 'class="form-control"'); 
					
					echo form_dropdown('events['.$key.']', $options,set_value('events['.$key.']',(isset($settings['nt_events'][$key])?$settings['nt_events'][$key]:'')), 'class="form-control" style ="width:75px;" id="dipEvent"'.$value);
					
					//echo form_input('event['.$key.']', set_value('event['.$key.']',(isset($settings['nt_event'][$key])?$settings['nt_event'][$key]:'')), 'class="form-control" id="dipEvent"'.$value);?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
            </div>
          </fieldset>
        </div>

        <div class="col-sm-6">
          <fieldset>
            <legend>Language Settings:</legend>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipLanguages">Select Available Language</label>
                  <div class="col-sm-7">
                    <?php echo form_multiselect('languages[]', $langs,$settings['nt_languages'], 'id="dipLanguages" class="mselect form-control"'); ?>
                  </div>
              </div>
          </fieldset>
          <fieldset>
            <legend>Nexttee Application Urls:</legend>
              <div class="form-group">
                <label class="col-sm-5 control-label" for="dipIos">Nexttee Ios Url</label>
                <div class="col-sm-7 nopd">
                  <?php echo form_input('app_url[1]', set_value('app_url[1]',(isset($settings['nt_app_url'][1])?$settings['nt_app_url'][1]:'')), 'class="form-control" id="dipIos"');?>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-5 control-label" for="dipAndroid">Nexttee Android Url</label>
                <div class="col-sm-7 nopd">
                  <?php echo form_input('app_url[2]', set_value('app_url[2]',(isset($settings['nt_app_url'][2])?$settings['nt_app_url'][2]:'')), 'class="form-control" id="dipAndroid"');?>
                </div>
              </div>
          </fieldset>
        </div>
        <div class="col-sm-6">
          <fieldset>
            <legend>Set Radius:</legend>
              <div class="form-group">
                  <label class="col-sm-6 control-label" for="dipRadius">Radius for local push</label>
                  <div class="col-sm-6">
                    <?php echo form_input('radius[0]', set_value('radius[0]',(isset($settings['nt_radius'][0])?$settings['nt_radius'][0]:'')), 'class="form-control" id="dipRadius"');?>
                  </div>
              </div>
              
              <div class="form-group">
                  <label class="col-sm-6 control-label" for="dipRadius1">Radius for golfclub arround</label>
                  <div class="col-sm-6">
                    <?php echo form_input('radius[1]', set_value('radius[1]',(isset($settings['nt_radius'][1])?$settings['nt_radius'][1]:'')), 'class="form-control" id="dipRadius1"');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-6 control-label" for="dipRadius2">Radius for offers</label>
                  <div class="col-sm-6">
                    <?php echo form_input('radius[2]', set_value('radius[2]',(isset($settings['nt_radius'][2])?$settings['nt_radius'][2]:'')), 'class="form-control" id="dipRadius2"');?>
                  </div>
              </div>
                <legend>Next Tee events setting:</legend>
              
              <div class="form-group">
                  <label class="col-sm-6 control-label" for="dipTime">Radius Next Tee events </label>
                  <div class="col-sm-6">
                    <?php echo form_input('event_radius[0]', set_value('event_radius[0]',(isset($settings['nt_event_radius'][0])?$settings['nt_event_radius'][0]:'')), 'class="form-control" id="dipTime"');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-6 control-label" for="dipTime1">Next Tee time frame </label>
                  <div class="col-sm-6">
                    <?php echo form_input('event_time_frame[0]', set_value('event_time_frame[0]',(isset($settings['nt_event_time_frame'][0])?$settings['nt_event_time_frame'][0]:'')), 'class="form-control" id="dipTime1"');?>
                  </div>
              </div>
          </fieldset>
        </div>
        <div class="col-sm-12">
          <fieldset>
            <legend>Advertising Image:</legend>
            <div class="row">
            <?php foreach ($langs as $value => $valuev):?>
              <div class="col-sm-3" <?php if(!in_array($value, $settings['nt_languages'])){echo 'style="display:none;"';}?>>
                <fieldset id="dip-lb-<?=$value;?>" <?php if(!in_array($value, $settings['nt_languages'])){echo 'disabled';}?> style="border:none;">
                <div class="dip-langbox">
                  <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
                  
                  <label class="control-label" for="dipName">Advertising Name</label>
                  <?php echo form_input('name['.$value.']', set_value('name['.$value.']',(isset($settings['nt_adv_name'][$value])?$settings['nt_adv_name'][$value]:'')), 'class="form-control" id="dipName'.$value.'" placeholder="advertisement"');?>

                  <label class="control-label" for="dipUrl">Advertising Url</label>
                  <?php echo form_input('url['.$value.']', set_value('url['.$value.']',(isset($settings['nt_adv_url'][$value])?$settings['nt_adv_url'][$value]:'')), 'class="form-control" id="dipUrl'.$value.'" placeholder="http://example.com"');?>

                  <!-- ajax upload-->
                  <label class="control-label" for="dipImg">Advertising Image</label>
                  <div id="dipPic_<?=$value;?>" class="dip-upload-box" data-lang="<?=$value;?>">
                    <!--prev if any -->
                    <?php if(isset($settings['nt_adv_pics'][$value]) && !empty($settings['nt_adv_pics'][$value])):?>
                    <div class="prevold dip-upload-prev">
                      <button class="btn btn-default" onclick="deleteOldFile('dipPic_<?=$value;?>')"><i class="fa fa-times"></i></button>
                      <a href="<?=site_url($settings['nt_adv_pics'][$value]);?>" target="_blank" style="background-image:url(<?=site_url($settings['nt_adv_pics'][$value]);?>);"></a>
                    </div>
                    <?php endif; ?>
                    <!--upload-->
                    <div class="fileupload btn btn-file" data-url="<?php echo site_url('api/uploadfiles');?>" <?php if(isset($settings['nt_adv_pics'][$value]) && !empty($settings['nt_adv_pics'][$value])){echo 'style="display:none;"';}?>>
                      <span>Upload</span>
                      <input type="file" name="userfile">
                    </div>
                    <input class="dipHidden" type="hidden" name="pics[<?=$value;?>]">
                  </div>
                <!--end of ajax upload-->
                </div>
                </fieldset>
              </div>
            <?php endforeach; ?>
            </div>
          </fieldset>
        </div>

        <dip class="col-sm-12">
        <fieldset>
            <legend>Home Screen Images:</legend>
            <div class="row">
              <?php $hm_imgs=array('Search','Favorites','Special Offers','Rewards','Events'); ?>
              <?php foreach($hm_imgs as $k => $v):?>
                <div class="col-sm-3">
                  <div class="dip-langbox">
                    <h5><?php echo $v; ?></h5>
                        
                        <?php if(isset($settings['nt_hm_imgs'][$k]) && !empty($settings['nt_hm_imgs'][$k])): ?>
                            <div id="dz-<?php echo $k;?>" class="dropzone dropzone-old" 
                            data-id="<?php echo $k;?>" data-canvas="true" 
                            data-resize="true" data-originalsize="false" data-ajax="false" 
                            data-removeurl="<?php echo site_url('api/upload');?>" 
                            data-width="960" data-height="540" 
                            style="width: 100%;"  data-image="<?php echo site_url($settings['nt_hm_imgs'][$k]['url']);?>">
                                <input id="dz-input-<?php echo $k;?>" class="drop" type="file" name="thumb[<?php echo $k; ?>]"/>
                            </div>
                          <?php echo form_checkbox('previmage['.$k.']', '1', false, 'id="dz-check-'.$k.'" style="display:none;"'); ?>
                        
                        <?php else:?>
                          <!-- add new button -->
                          <div id="dz-<?php echo $k;?>" class="dropzone dropzone-new" data-id="<?php echo $k;?>" 
                          data-canvas="true" data-resize="true" data-originalsize="false" data-ajax="false" 
                          data-width="960" data-height="540"  
                          style="width: 100%;">
                              <input id="dz-input-<?php echo $k;?>" class="drop" type="file" name="thumb[<?php echo $k; ?>]"/>
                          </div>
                        <?php endif;?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
        </fieldset>
        </dip>
      </div>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save','class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('master/nexttee');?>" class="btn btn-default" >Cancel</a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>


<script type="text/javascript" language="javascript" src="<?php echo site_url('assets/vendors/dipcrop/html5imageupload.min.js');?>"></script>
<script>
jQuery(document).ready(function($) {
  
  $('.dropzone-new').html5imageupload();
  $('.dropzone-old').html5imageupload({
    onAfterRemoveImage: function() {
      var el = $(this).get(0).element;
      var id = $(el).attr("data-id");
      $('#dz-check-'+id).prop('checked', true);
    }
  });
});
</script>



<!-- image upload -->
<script src="<?php echo site_url('assets/vendors/blueimp/js/vendor/jquery.ui.widget.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendors/blueimp/js/jquery.iframe-transport.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendors/blueimp/js/jquery.fileupload.js'); ?>"></script>
<script>
$(function () {
    $('.fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
          var lid = $(this).parent().data( "lang" );
          createPreview(data,this,lid);
        },
        progressall: function (e, data) {
          var progress = parseInt(data.loaded / data.total * 100, 10);
          $(this).find('span').html(progress + '%');
        }
    });
});
function createPreview(data,uploader){
  html = '';
  html += '<div id="dipPrev_'+data.result.id+'" class="dip-upload-prev">';
  html += '<button class="btn btn-default" onclick="deleteFile('+data.result.id+')"><i class="fa fa-times"></i></button>';
  html += '<a href="'+data.result.url+'" target="_blank" style="background-image:url('+data.result.url+');"></a>';
  html += '</div>';
  $(uploader).parent().prepend(html);
  $(uploader).hide();
  $(uploader).parent().find('.dipHidden').val(data.result.id);
}
function removePreview(uploader){
  $(uploader).find('.dip-upload-prev').remove();
  $(uploader).find('.fileupload').show();
  $(uploader).find('.fileupload span').html('Upload');
  $(uploader).find('.dipHidden').val('');
}
function deleteFile(id){
  event.preventDefault();
  var url = "<?php echo site_url('api/uploadfiles/delete');?>";
  $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
       var uploadbox = $('#dipPrev_'+id).parent();
       removePreview(uploadbox);
  }});
}
function deleteOldFile(uploader){
  uploader = $('#'+uploader);
  $(uploader).find('.dip-upload-prev').remove();
  $(uploader).find('.fileupload').show();
  $(uploader).find('.fileupload span').html('Upload');
  $(uploader).find('.dipHidden').val(0);
  event.preventDefault();
}
</script>
<style>
  .dip-upload-prev{
    position: relative;
    width: 180px;
    height: 180px;
  }
  .dip-upload-prev a {
      display: block;
      text-align: center;
      border-radius: 4px;
      overflow: hidden;
      background-size: contain;
      width: 100%;
      height: 100%;
      background-repeat: no-repeat;
      background-color: #444;
      background-position: center;
  }
  .dip-upload-prev button,.dip-upload-prev button:hover{
    position: absolute;
    top: 0;
    right: 0;
    background: red;
    color: #FFF;
    padding: 5px;
    line-height: 1;
    margin: -5px;
  }
  .dip-upload-prev:hover button{
    opacity: 1;
  }
.radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
    margin-left: -20px;
}
  .btn-file,.btn-file:hover {
  position: relative;
  overflow: hidden;
  border: 2px dashed #396BD6;
  color: #396BD6;
  background: #F9F9F9;
    width: 180px;
    height: 180px;
  }

  .btn-file span{
    display: inline-block;
    vertical-align: middle;
    padding: 8px 20px;
    position: absolute;
    top: 50%;
    left: 0;
    width: 100%;
    margin-top: -15px;
  }
  .btn-file.selected span{
  background-color: #FBFBFB;
  box-shadow: 0 0 20px rgba(57, 107, 214, 0.47);
  border-radius: 5px;
  }
  .btn-file:hover,.btn-file.selected{
  background: #EFF4FF;
  }
  .btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
  }
  .child-box{
  padding: 10px;
  min-height: 220px;
  margin: 10px 0;
  }

  .nav-tabs>li>a:hover, .nav-tabs>li>a:focus, .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus, .nav-tabs .open>a, .nav-tabs .open>a:hover, .nav-tabs .open>a:focus {
    border-top: 2px solid #4EA500;
  }
</style>



<script>
$(function(){
  $(".mselect").multiselect({
      multiple: true,
      header: "Select an option",
      noneSelectedText: "Select",
      beforeclose: function(){
        get_clients();
      },
      click: function(event, ui){
          // var opt = "<option value='"+ui.value+"'>"+ ui.text + "</option>";
          if(ui.checked){
            $('#dip-lb-'+ui.value).parent().show();
            $('#dip-lb-'+ui.value).attr("disabled", false);
          }else{
            $('#dip-lb-'+ui.value).parent().hide();
            $('#dip-lb-'+ui.value).attr("disabled", true);
          }

          // $("#dipDefaultLang").multiselect('refresh');
      }
  });

  $('#advForm').submit(function(){ //listen for submit event
      var value = get_selected_clients();
      $('<input />').attr('type', 'hidden')
              .attr('name', 'clients')
              .attr('value', value)
              .appendTo('#advForm');
      return true;
  });

  get_clients();
  function moveItems(origin, dest) {
      $(origin).find(':selected').appendTo(dest);
  }
  function moveAllItems(origin, dest) {
      $(origin).children().appendTo(dest);
  }
  $('#left').click(function () {
      moveItems('#sbTwo', '#sbOne');
  });
   
  $('#right').on('click', function () {
      moveItems('#sbOne', '#sbTwo');
  });
   
  $('#leftall').on('click', function () {
      moveAllItems('#sbTwo', '#sbOne');
  });
   
  $('#rightall').on('click', function () {
      moveAllItems('#sbOne', '#sbTwo');
  });
});
function get_selected_clients(){
  var select_list_option = '';
  $('#sbOne option').each(function(){
    select_list_option += $(this).val() + ",";
  });
  return select_list_option.slice(0, -1);
}
function clearSelection(){
  $('#sbOne').html('');
  get_clients();
}
function get_clients(){
  // var select_list_option = '';
  // $('#sbOne option').each(function(){
  //   select_list_option += $(this).val() + ",";
  // });
  // select_list_option = select_list_option.slice(0, -1);
  var data = {
    page:1,
    search: $('#dipSearch').val(),
    country: $('#dipCountry').val(),
    langs: $('#dipLanguages').val(),
    exclude: get_selected_clients()
  };
  // console.log(data);
  $.ajax({
    type: "POST",
    data: data,
    url: "<?php echo site_url('master/golfapp_advertising/get_clients');?>",
    success: function(data) {
      // console.log(data);
      var data = jQuery.parseJSON(data);
      if(data.length > 0){ 
        $('#sbTwo').removeClass('no-record');
        var html = '';
        $(data).each(function(index, client) {
          html += '<option value="'+client.id+'">'+client.name+'</option>'
        });
        $('#sbTwo').html(html);
      }else{
        $('#sbTwo').html('');
        $('#sbTwo').addClass('no-record');
      }
    }
  });
}
</script>
<style>
  .dip-mselect{
    width: 100%;
    min-height: 300px;
  }
  .dip-mselect-tools{
    text-align: center;
    padding-top: 30px;
  }
  .dip-mselect-tools .btn{
    width: 40px;
   margin: 10px 0;
  }
</style>