<?php 
$today = date('Y-m-d');
if(!empty($client->city) && !empty($client->country)){
  $today = decode_date(get_timee($client->city,$client->country));
}else{
  echo '<script>alertify.alert("To Create an event you need to first set your Country and City.");</script>';
}?>
<section class="dip-dash-sec">
  <h3><?=$page['desc'];?> <span style="float:right;color:#bbb;"><?php echo $this->lang->line('Today'); ?> <?=$today;?></span></h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_alerts('golfclub/events', 'Event'); ?>
    <p class="error_msg"> <?php echo $this->lang->line('FormValidation_fieldrequired'); ?> </p>
    <div class="dip-form-body">
      <div class="row ">
        <div class="col-sm-12 form-inline">
            <div class="form-group">
              <label class="control-label" for="dipName"><?php echo $this->lang->line('EventName'); ?></label>
              <?php echo form_input('name', set_value('name',$row->name), 'style="width:350px;" class="form-control" id="dipName" placeholder="'.$this->lang->line('EventName').'" required');?>
            </div>
            &nbsp;
            &nbsp;
            &nbsp;
            <div class="form-group">
              <label class="control-label" for="dipDate"><?php echo $this->lang->line('EventDate'); ?></label>
              <?php echo form_input('event_date', set_value('event_date',$row->event_date), 'class="form-control" id="dipDate" placeholder="00-00-0000" data-datepicker required');?>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="col-sm-12">
          <ul class="nav nav-tabs">
            <?php 
            $alang = array();
            foreach ($client->languages as $key => $value) {
              $active='';
              if($client->default_language == $value){
                $active='class="active"';
              }
              echo '<li '.$active.'><a class="btn btn-default" data-toggle="tab" href="#'.$langs[$value].'"><i class="flag flag-'.$langs[$value].'" alt="'.$langs[$value].'"></i> '.$langs[$value].'</a></li>';
            }?>
          </ul>


          <!-- Tab panes -->
          <div class="tab-content">

            <?php foreach ($client->languages as $key => $value):
              $active='';
              if($client->default_language == $value){
                $active='active';
              }
              ?>
              <div role="tabpanel" class="tab-pane row <?=$active;?>" id="<?=$langs[$value];?>">

                    <div class="col-sm-6">
                      <div class="child-box">
                      <fieldset>
                      <legend><?php echo $this->lang->line('DetailsIn'); ?> <?=$langs[$value];?> </legend>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="dipFormat"><?php echo $this->lang->line('PlayingFormat'); ?></label>
                          <div class="col-sm-8">
                            <?php echo form_input('format['.$value.']', set_value('format['.$value.']',(isset($row->format[$value])?$row->format[$value]:'')), 'class="form-control" id="dipFormat" placeholder="'.$this->lang->line('PlayingFormatin').' '.$langs[$value].'"');?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="dipRemark1"><?php echo $this->lang->line('Remark1'); ?></label>
                          <div class="col-sm-8">
                            <?php echo form_input('remark1['.$value.']', set_value('remark1['.$value.']',(isset($row->remark1[$value])?$row->remark1[$value]:'')), 'class="form-control" id="dipRemark1" placeholder="'.$this->lang->line('Remark1in').' '.$langs[$value].'"');?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-4 control-label" for="dipRemark2"><?php echo $this->lang->line('Remark2'); ?></label>
                          <div class="col-sm-8">
                            <?php echo form_input('remark2['.$value.']', set_value('remark2['.$value.']',(isset($row->remark2[$value])?$row->remark2[$value]:'')), 'class="form-control" id="dipRemark2" placeholder="'.$this->lang->line('Remark2in').' '.$langs[$value].'"');?>
                          </div>
                        </div>
                         </fieldset>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <!--uplading start-->
                        <div class="row child-box child-box-files">
                          <?php if(empty($row->event_date) || strtotime($row->event_date) >= strtotime($today)):?>
                          <div class="col-sm-4">
                            <fieldset>
                            <legend><?php echo $this->lang->line('ProgramDetails'); ?> </legend>
                              
                              <!-- ajax upload-->
                              <div id="dipDetail_<?=$value;?>" class="dip-upload-box" data-lang="<?=$value;?>">
                                <!--prev if any-->
                                <?php if(isset($row->file_detail[$value]) && !empty($row->file_detail[$value])):?>
                                <div class="prevold dip-upload-prev">
                                  <button class="btn btn-default" onclick="deleteOldFile('dipDetail_<?=$value;?>')"><i class="fa fa-times"></i></button>
                                  <a href="<?=site_url($row->file_detail[$value]);?>" target="_blank"><i class="fa fa-file-text"></i></a>
                                </div>
                                <?php endif; ?>
                                <!--upload-->
                                <div class="fileupload btn btn-file" data-url="<?php echo site_url('api/uploadfiles');?>" <?php if(isset($row->file_detail[$value]) && !empty($row->file_detail[$value])){echo 'style="display:none;"';}?>>
                                  <span>Upload</span>
                                  <input type="file" name="userfile">
                                </div>
                                <input class="dipHidden" type="hidden" name="detail_post[<?=$value;?>]">
                              </div>

                            </fieldset>
                          </div>
                          <div class="col-sm-4" style="display:none;">
                            <fieldset>
                            <legend><?php echo $this->lang->line('ProgramTeeTime'); ?> </legend>
                              
                              <!-- ajax upload-->
                              <div id="dipTeeTime_<?=$value;?>" class="dip-upload-box" data-lang="<?=$value;?>">
                                <!--prev if any-->
                                <?php if(isset($row->file_teetime[$value]) && !empty($row->file_teetime[$value])):?>
                                <div class="prevold dip-upload-prev">
                                  <button class="btn btn-default" onclick="deleteOldFile('dipTeeTime_<?=$value;?>')"><i class="fa fa-times"></i></button>
                                  <a href="<?=site_url($row->file_teetime[$value]);?>" target="_blank"><i class="fa fa-file-text"></i></a>
                                </div>
                                <?php endif; ?>
                                <!--upload-->
                                <div class="fileupload btn btn-file" data-url="<?php echo site_url('api/uploadfiles');?>" <?php if(isset($row->file_teetime[$value]) && !empty($row->file_teetime[$value])){echo 'style="display:none;"';}?>>
                                  <span>Upload</span>
                                  <input type="file" name="userfile">
                                </div>
                                <input class="dipHidden" type="hidden" name="teetime_post[<?=$value;?>]">
                              </div>

                            </fieldset>
                          </div>
                          <?php endif; ?>
                          <?php if(!empty($row->event_date) && strtotime($row->event_date) <= strtotime($today)):?>
                          <div class="col-sm-4" style="display:none;">
                            <fieldset>
                            <legend><?php echo $this->lang->line('ProgramResult'); ?></legend>
                              
                              <!-- ajax upload-->
                              <div id="dipResult_<?=$value;?>" class="dip-upload-box" data-lang="<?=$value;?>">
                                <!--prev if any-->
                                <?php if(isset($row->file_result[$value]) && !empty($row->file_result[$value])):?>
                                <div class="prevold dip-upload-prev">
                                  <button class="btn btn-default" onclick="deleteOldFile('dipResult_<?=$value;?>')"><i class="fa fa-times"></i></button>
                                  <a href="<?=site_url($row->file_result[$value]);?>" target="_blank"><i class="fa fa-file-text"></i></a>
                                </div>
                                <?php endif; ?>
                                <!--upload-->
                                <div class="fileupload btn btn-file" data-url="<?php echo site_url('api/uploadfiles');?>" <?php if(isset($row->file_result[$value]) && !empty($row->file_result[$value])){echo 'style="display:none;"';}?>>
                                  <span>Upload</span>
                                  <input type="file" name="userfile">
                                </div>
                                <input class="dipHidden" type="hidden" name="result_post[<?=$value;?>]">
                              </div>
                            </fieldset>
                          </div>
                          <?php endif; ?>
                          
                          <!--
                          <div class="col-sm-12 radio">
                            <label><?php //echo form_radio('file_default', $value, ($value==$row->file_default?true:false),'class="default_upload"'); ?> Make it same for other languages</label>
                          </div>
                          <script>
                          var allRadios = document.getElementsByName('file_default');
                          var booRadio;
                          var x = 0;
                          for(x = 0; x < allRadios.length; x++){
                            allRadios[x].onclick = function(){
                               console.log(x);
                                if(booRadio == this){
                                    this.checked = false;
                                    booRadio = null;
                                }else{
                                    booRadio = this;
                                }
                            };
                          }
                          </script>-->
                        </div>
                        <!--uplading ends-->
                    </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', $this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/nexttee/nt_events');?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?></a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>

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
  html += '<a href="'+data.result.url+'" target="_blank"><i class="fa fa-file-text"></i></a>';
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
  console.log($(uploader).find('.dip-upload-prev'));
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
  }
  .dip-upload-prev a {
      display: block;
      background: white;
      padding: 40px 10px;
      text-align: center;
      box-shadow: 0 0 10px rgba(4, 4, 4, 0.14);
      border-radius: 4px;
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
  .dip-upload-prev button{
    opacity: .5;
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
  padding: 40px 15px;
  background: #F9F9F9;
  }

  .btn-file span{padding: 8px 20px;}
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
  .form-inline .form-group {
       margin-left: 0; 
       margin-right: 0; 
  }
</style>
<script>
function alertFilename(id){
  var $el = $('#uploadFile'+id);
  $el.parent().find('span').html($el.val().replace(/.*(\/|\\)/, ''));
  $el.parent().addClass('selected');
}

$(document).ready(function(e) {
    //************On Button Click**************//	  
	   $('.btn-success').click(function(){
		   var count = 0;
		   var dipName = $('#dipName').val();
		   var dipDate = $('#dipDate').val();
		   
		  if(dipName==""){
			$('.dip-form-body #dipName').css('border-color','red'); 
			$('.error_msg').css('display','block'); //to show
		  } else {
			$('.dip-form-body #dipName').css('border-color','#bbb'); 
			$('.error_msg').css('display','none'); //to show	
		  }
		  if(dipDate==""){
			$('.dip-form-body #dipDate').css('border-color','red'); 
			$('.error_msg').css('display','block'); //to show
		  }else {
			$('.dip-form-body #dipDate').css('border-color','#bbb'); 	
			$('.error_msg').css('display','none'); //to show
		  }
	   }); 	 
});


</script>
