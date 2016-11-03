<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  
  <?php echo form_open(current_full_url(), 'class="dip-form form-horizontal" id="frmedituser"');?>
    <?php
    if($page['type']==1)
      echo get_alerts('master/manageusers/index/golfgroups','Golf Group');
    elseif($page['type']==2)
      echo get_alerts('master/manageusers/index/golfclubs','Golf Club');
    else
      echo get_alerts('master/manageusers/index/golfclubs','Partner');
    ?>
    <div class="row dip-form-body">
      <div class="col-sm-6">
        <?php if($page['type'] >= 2): ?>
        <fieldset>
          <legend>Category:</legend>

          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipParent">
             <?php 
             if($page['type']==2)
                echo 'Golf Group Name';
              else
                echo 'Golf Club Name';
              ?>
            </label>
            <div class="col-sm-8">
              <!-- ajax based multi selection-->
              <select name="parent" id="dipParent" class="form-control">
                <?php if($page['type']==2){
                  echo '<option value="0">Individual</option>';
                  } ?>
                <?php if($client->parrent){
                  echo '<option value="'.$client->parrent.'" selected>'.$client->parent_name.'</option>';
                  } ?>
              </select>

            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLevel">
              <?php 
              if($page['type']==2)
                echo 'GolfClub Level';
              else
                echo 'Partner Category';
              ?>
            </label>
            <div class="col-sm-8">
              <?php 
              if($page['type']==2){
                if(empty($client->level)) $client->level = 0;
                echo form_dropdown('level', $user_levels, set_value('level',$client->level), 'id="dipLevel" class="form-control"'); 
              }else{
                $partnerTypes = array();
                for ($i=3; $i <= 6 ; $i++) { 
                  $partnerTypes[$i] = $user_types[$i];
                }
                if(empty($client->type)) $client->type = 0;
                echo form_dropdown('type', $partnerTypes, set_value('type',$client->type), 'id="dipLevel" class="form-control"'); 
              }?>
            </div>
          </div>
        </fieldset>
        <?php endif; ?>

        <fieldset>
          <legend>General:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipName">Full Name *</label>
            <div class="col-sm-8">
              <?php echo form_input('name', set_value('name',$client->name), 'class="form-control" id="dipName" placeholder="Full Name"');?>
              <?php /*if($page['type']>2){*/
				  //echo $client->edit_name;
				$data = array(
								'name'          => 'edit_name',
								'id'            => 'edit_name',
								'value'         => '',
								'checked'       => TRUE
							);

				/*echo form_checkbox($data).' editable by user';*/
				//echo $client->edit_name."ssdsd";
				  
				if($client->edit_name=="")
				{
					echo form_checkbox('edit_name',1, 1).' editable by user';
					//echo form_checkbox($data);	
				}
				else if( $client->edit_name==1)
				{
					echo form_checkbox('edit_name',1, (bool) $client->edit_name).' editable by user';
				}
				else
				{
					echo form_checkbox('edit_name',0, (bool) $client->edit_name).' editable by user';
				}
               
              /* }*/?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUsername">User Name *</label>
            <div class="col-sm-8">
              <?php echo form_input('username', set_value('username',$client->username), 'class="form-control" id="dipUsername" placeholder="Username"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPassword">Password *</label>
            <div class="col-sm-8">
              <?php echo form_input('password', set_value('password',$client->password), 'class="form-control" id="dipPassword" placeholder="Password"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipCreation">Creation Date</label>
            <div class="col-sm-8">
              <?php echo form_input('creation_date', set_value('creation_date',$client->creation_date), 'class="form-control" id="dipCreation" placeholder="00-00-0000" data-datepicker');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipRenewal">Renewal Date</label>
            <div class="col-sm-8">
              <?php echo form_input('renewal_date', set_value('renewal_date',$client->renewal_date), 'class="form-control" id="dipRenewal" placeholder="00-00-0000" data-datepicker');?>
            </div>
          </div>
        </fieldset>

        
        
        <fieldset>
          <legend>Contact:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipContactPerson">Contact Person</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_person', set_value('contact_person',$client->contact_person), 'class="form-control" id="dipContactPerson" placeholder="Contact Person"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipContactPhone">Contact Phone</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_phone', set_value('contact_phone',$client->contact_phone), 'class="form-control" id="dipContactPhone" placeholder="Contact Phone"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipContactEmail">Contact Email</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_email', set_value('contact_email',$client->contact_email), 'class="form-control" id="dipContactEmail" placeholder="Contact Email"');?>
            </div>
          </div>
        </fieldset>
      
        <?php if($page['type'] > 2) {echo '</div><div class="col-sm-6">';} ?>


        <!-- address -->
        <fieldset>
          <legend>Postal Details</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="locality">City *</label>
            <div class="col-sm-8">
              <?php echo form_input('city', set_value('city',$client->city), 'class="form-control" id="locality"  placeholder="Search City"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="country">Country *</label>
            <div class="col-sm-8">

              <!--country dropdown -->
              <?php echo form_dropdown('country', $countries, $client->country, 'id="dipCountry" class="form-control"'); ?>
              <?php // echo form_input('country', set_value('country',$client->country), 'class="form-control" id="country"   placeholder="Country"');?>
            </div>
          </div>
        </fieldset>
        <?php if($page['type'] <= 2) {echo '</div><div class="col-sm-6">';} ?>


        <?php if($page['type'] <= 2): ?>
        <?php 
        $alang = array();
        foreach ($client->languages as $key => $value) {
          $alang[$value] = $langs[$value];
        }?>
        <fieldset>
        <legend>Mobile Application:</legend>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosStatus">ios Status</label>
          <div class="col-sm-8">
            <?php echo form_input('ios_status', set_value('ios_status',$client->ios_status), 'class="form-control" id="dipIosStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidStatus">android Status</label>
          <div class="col-sm-8">
            <?php echo form_input('android_status', set_value('android_status',$client->android_status), 'class="form-control" id="dipAndroidStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosUrl">App Store Url</label>
          <div class="col-sm-8">
            <?php echo form_input('ios_url', set_value('ios_url',$client->ios_url), 'class="form-control" id="dipIosUrl" placeholder="App Store Url"');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidUrl">Google Play Url</label>
          <div class="col-sm-8">
            <?php echo form_input('android_url', set_value('android_url',$client->android_url), 'class="form-control" id="dipAndroidUrl" placeholder="Google Play Url"');?>
          </div>
        </div>
        </fieldset>
        <fieldset>
          <legend>Mobile app language:</legend>
          <div class="form-group">
            <div class="col-sm-4 control-label" for="">Select Language</div>
            <div class="col-sm-8">
            <?php if(!empty($client->parrent)){
                $mlangs = array();
                foreach ($client->parent_languages as $i) {
                  $mlangs[$i] = $langs[$i];
                }
              }else{
                $mlangs = $langs;
              }
             ?>
              <?php echo form_multiselect('languages[]', $mlangs, $client->languages, 'id="dipAllLang" class="form-control"'); ?>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend>Display language:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="disabledSelect">Display Language</label>
            <div class="col-sm-8">
              <?php 
			  //echo $client->default_language;
			  
                $alangs = array();
                foreach ($client->languages as $i) {
                  $alangs[$i] = $langs[$i];
                }?>
              <?php
			  //$client->default_language = 2;
			  echo form_dropdown('default_lang', $alangs, $client->default_language, 'id="dipDefaultLang" class="form-control"'); ?>
            </div>
          </div>
        </fieldset>
      <?php endif; ?>

      <?php if($page['type']>=2): ?>
        <fieldset>
          <legend>Push Notification:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPushNote">Push Notification (Golfapp)</label>
            <div class="col-sm-8">
              <?php echo form_input('push_note', set_value('push_note',$client->push_notification), 'class="form-control" id="dipPushNote" placeholder="Push Notification"');?>
            </div>
          </div>
          <?php if($page['type']==2): ?>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPushNote2">Push Notification (NextTee)</label>
            <div class="col-sm-8">
              <?php echo form_input('nt_push_note', set_value('nt_push_note',$client->nt_push_notification), 'class="form-control" id="dipPushNote2" placeholder="Push Notification"');?>
            </div>
          </div>
          <?php endif; ?>
        </fieldset>
        <?php endif; ?>


      <?php if($page['type']>2): ?>
        <fieldset>
          <legend>Parent Visibility:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipVisibility">Visible By GolfClub</label>
            <div class="col-sm-8">
           
            
            <?php if ($client->visibility=="")
			{
				//echo 1;
				echo form_dropdown('visibility', array(0=>"No",1=>"Yes"), 1, 'id="dipVisibility" class="form-control"');
			}
			else
			{
				//echo 2;
				echo form_dropdown('visibility', array(0=>"No",1=>"Yes"), set_value('1',$client->visibility), 'id="dipVisibility" class="form-control"');
			}
			  ?>
			<?php //echo form_dropdown('visibility', array(0=>"No",1=>"Yes"), 1, 'id="dipVisibility" class="form-control"'); ?>
            </div>
          </div>
        </fieldset>
      <?php endif; ?>

      </div>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save','class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_url('master/manageusers');?>" class="btn btn-default" >Cancel</a>
    </div>
  <?php echo form_close();?>
</section>
<script type="text/javascript">
var countload = 0;
var options = [];
$(function(){
    // groups dropdown
    $("#dipParent").multiselect({
       multiple: false,
       header: "Select an option",
       noneSelectedText: "Select",
       selectedList: 1,
       click: function(event, ui){
            get_languages(ui.value);
        },
       beforeopen: function(event, ui){
          if(countload==0){
            loadmore();
          }
       }
    });
    $("select:not([multiple])").multiselect({
       multiple: false,
       header: "Select an option",
       noneSelectedText: "Select",
       selectedList: 1
    });
    // language dropdown
    $("#dipAllLang").multiselect({
        click: function(event, ui){
            var opt = "<option value='"+ui.value+"'>"+ ui.text + "</option>";
            if(ui.checked){
              $("#dipDefaultLang").append(opt);
            }else{
              $("#dipDefaultLang option[value='"+ui.value+"']").remove();
            }

            $("#dipDefaultLang").multiselect('refresh');
        },
        checkAll: function(){
          var opt = $("#dipAllLang").html();
          $("#dipDefaultLang").html(opt);
        },
        uncheckAll: function(){
          $("#dipDefaultLang").html('');
        },
    });
    $('#dipAllLang buutton.ui-multiselect').attr('style','width:100% !important;');
});

function loadmore(){
  var page = countload + 1;
  var url = "<?php echo site_url('master/manageusers/get_all_parents');?>"+"?type=2&page="+page;
  <?php if($page['type']==2):?>
    url = "<?php echo site_url('master/manageusers/get_all_parents');?>"+"?type=1&page="+page;
  <?php endif;?>
  $.ajax({url: url, success: function(data){
    var newdata = jQuery.parseJSON(data);
    var text = '';
    for (var i = newdata.length - 1; i >= 0; i--) {
      text += '<option value="'+newdata[i].id+'">'+newdata[i].name+'</option>';
    };
    //if loadmore then append
    $("#dipParent").append(text);

    $("#dipParent").multiselect('refresh');
    if(countload==0){
      var foot = '<div class="dip-ajax-select" style="text-align:center;">';
      foot += '<button onclick="loadmore()">load more</button> or ';
      foot += '<input type="text" id="muSearch" onkeydown="mdoSearch(arguments[0]||event)" placeholder="Search"/>';
      foot += '</div>';
      $('.ui-multiselect-menu:first-of-type').append(foot);
    }
    countload++;

  }});
}
var prevopt;
var searched = false;
function searchdata(){
  var gsearch = $("#muSearch").val();
  if(gsearch != ''){
    var url = "<?php echo site_url('master/manageusers/get_all_parents');?>"+"?type=2&page=1&search="+gsearch;
    <?php if($page['type']==2):?>
    url = "<?php echo site_url('master/manageusers/get_all_parents');?>"+"?type=1&page=1&search="+gsearch;
    <?php endif;?>

    $.ajax({url: url, success: function(data){
      var newdata = jQuery.parseJSON(data);
      var text = '';
      for (var i = newdata.length - 1; i >= 0; i--) {
        text += '<option value="'+newdata[i].id+'">'+newdata[i].name+'</option>';
      };
      if(searched==false){
        //store the previous options
        prevopt = $("#dipParent").html();
        searched=true;
      }
      //if loadmore then append
      $("#dipParent").html(text);
      $("#dipParent").multiselect('refresh');
    }});
  }else{
    //restore the previous data
    $("#dipParent").html(prevopt);
    $("#dipParent").multiselect('refresh');
    searched=false;
  }
}
var timeoutHnd;
function mdoSearch(ev){
    if(timeoutHnd)
        clearTimeout(timeoutHnd)
    timeoutHnd = setTimeout(searchdata,500)
}

/**
 * change the languages
 */
function get_languages(id){
  var langs = jQuery.parseJSON('<?php echo encode_data($langs);?>');
  if(id != 0){
    var url = "<?php echo site_url('master/manageusers/get_languages');?>"+'/'+id+'/1';
    $.ajax({url: url, success: function(data){
      var group = jQuery.parseJSON(data);
      var text = '';
      for (var i = 0; i <= group.laguages.length - 1; i++) {
        text += '<option value="'+group.laguages[i]+'" selected>'+langs[group.laguages[i]]+'</option>';
      };
      $("#dipAllLang").html(text);
      $("#dipAllLang").multiselect('refresh');

      var text2 = '';
      for (var i = 0; i <= group.laguages.length - 1; i++) {
        var selected = '';
        if(group.default_language == group.laguages[i]){
          selected = 'selected';
        }
        text2 += '<option value="'+group.laguages[i]+'" '+selected+'>'+langs[group.laguages[i]]+'</option>';
      };
      $("#dipDefaultLang").html(text2);
      $("#dipDefaultLang").multiselect('refresh');
    }});
  }else{
    console.log(langs);
      var text = '';
      var count = 0;
      $.each(langs, function( index, value ) {
        if(count==0){
          text += '<option value="'+index+'" selected>'+value+'</option>';
        }else{
          text += '<option value="'+index+'">'+value+'</option>';
        }
        count = 1;
      });
      $("#dipAllLang").html(text);
      $("#dipDefaultLang").html('<option value="1">'+langs[1]+'</option>');
      $("#dipAllLang").multiselect('refresh');
      $("#dipDefaultLang").multiselect('refresh');
  }
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.
$(document).ready(function() {
   $("form").bind("keypress", function(e) {
      if (e.keyCode == 13) {
         return false;
      }
   });
   
	$('#frmedituser').on('change', 'input[type=checkbox]', function() {
		this.checked ? this.value = 1 : this.value = 0;
	});
});
var placeSearch, autocomplete;
var componentForm = {
  locality: 'long_name',
  country: 'long_name'
};
$(document).ready(function($) {
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('locality')),
      { types: ['(cities)'] });
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
});

// [START region_fillform]
function fillInAddress() {
  var place = autocomplete.getPlace();
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    //get the city full name
    if(addressType=='locality'){
      var city_name = place.address_components[i]['long_name'];
      $('#locality').val(city_name);
    }
    //get the country short name
    if(addressType=='country'){
      var country_code = place.address_components[i]['short_name'];
      $('#dipCountry').val(country_code);
      $("#dipCountry").multiselect('refresh');
    }
  }
}
</script>