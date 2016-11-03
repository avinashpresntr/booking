<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <?php echo form_open_multipart(current_full_url(), 'id="advForm" class="dip-form form-horizontal"');?>
    <?php echo get_alerts('master/golfapp_advertising', 'Advertising'); ?>
    <div class="dip-form-body">
      
      <div class="row">
        <div class="col-sm-6">
          <fieldset>
            <legend>Genaral Details:</legend>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipName">Advertisment Name</label>
                  <div class="col-sm-7">
                    <?php echo form_input('name', set_value('name',$row->name), 'class="form-control" id="dipName" placeholder="Add a name"');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipUrl">Advertisment URL</label>
                  <div class="col-sm-7">
                    <?php echo form_input('url', set_value('url',$row->url), 'class="form-control" id="dipUrl" placeholder="http://example.com"');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipStart">Starting Date</label>
                  <div class="col-sm-7">
                    <?php echo form_input('startdate', set_value('startdate',$row->startdate), 'class="form-control" id="dipStart" placeholder="00-00-0000" data-datepicker required');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipEnd">Ending Date</label>
                  <div class="col-sm-7">
                    <?php echo form_input('enddate', set_value('enddate',$row->enddate), 'class="form-control" id="dipEnd" placeholder="00-00-0000" data-datepicker required');?>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-5 control-label" for="dipLanguages">Select Language</label>
                  <div class="col-sm-7">
                    <?php echo form_multiselect('languages[]', $langs,$row->languages, 'id="dipLanguages" class="mselect form-control"'); ?>
                  </div>
              </div>
          </fieldset>
        </div>
        <div class="col-sm-6">
          <fieldset>
            <legend>Upload Advertising Image:</legend>

            <!-- ajax upload-->
              <div id="dipPic" class="dip-upload-box">
                <!--prev if any -->
                <?php if(isset($row->pics) && !empty($row->pics)):?>
                <div class="prevold dip-upload-prev">
                  <button class="btn btn-default" onclick="deleteOldFile('dipPic')"><i class="fa fa-times"></i></button>
                  <a href="<?=site_url($row->pics[0]);?>" target="_blank" style="background-image:url(<?=site_url($row->pics[0]);?>);"></a>
                </div>
                <?php endif; ?>
                <!--upload-->
                <div class="fileupload btn btn-file" data-url="<?php echo site_url('api/uploadfiles');?>" <?php if(isset($row->pics) && !empty($row->pics)){echo 'style="display:none;"';}?>>
                  <span>Upload</span>
                  <input type="file" name="userfile">
                </div>
                <input class="dipHidden" type="hidden" name="pics[]">
              </div>
            <!--end of ajax upload-->

          </fieldset>
        </div>
        <div class="col-sm-12">
          <fieldset>
              <legend>Select Clients:</legend>
              <div class="row">
                <div class="col-sm-5">
                  <select id="sbTwo" multiple="multiple" class="dip-mselect">
                  </select>
                  <div class="form-group">
                      <div class="col-sm-6">
                        <label class="control-label" for="dipSearch">Search by name</label>
                        <?php echo form_input('','', 'class="form-control" id="dipSearch" onchange="get_clients(arguments[0]||event)" placeholder="Search by name"');?>
                      </div>
                      <div class="col-sm-6">
                        <label class="control-label" for="dipCountry">Filter by Country</label>
                        <?php echo form_multiselect('country[]', $countries,$row->countries, 'id="dipCountry" class="mselect form-control"'); ?>
                      </div>
                  </div>
                </div>
                <div class="col-sm-1 dip-mselect-tools">
                  <input type="button" class="btn" id="leftall" value=">>" />
                  <input type="button" class="btn" id="left" value=">" />
                  <input type="button" class="btn" id="right" value="<" />
                  <input type="button" class="btn " id="rightall" value="<<" />
                </div>
                <div class="col-sm-5">
                  <select name="clients" id="sbOne" multiple="multiple" class="dip-mselect">
                  <?php foreach ($row->clients as $key => $value) {
                    echo '<option value="'.$key.'">'.$value.'</option>';
                  }?>
                  </select>
                  <input type="button" class="btn" value="clear all" onclick="clearSelection()"/>
                </div>
                
              </div>
          </fieldset>

        </div>
      </div>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save','class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/courses');?>" class="btn btn-default" >Cancel</a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>

<!-- image upload -->
<script src="<?php echo site_url('assets/vendors/blueimp/js/vendor/jquery.ui.widget.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendors/blueimp/js/jquery.iframe-transport.js'); ?>"></script>
<script src="<?php echo site_url('assets/vendors/blueimp/js/jquery.fileupload.js'); ?>"></script>
<script>
$(function () {
    $('.fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
          createPreview(data,this);
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
      // header: "Select an option",
      noneSelectedText: "Select",
      beforeclose: function(){
        get_clients();
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