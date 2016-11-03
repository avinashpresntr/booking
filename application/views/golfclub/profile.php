<style>
#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 15px;
  height: 15px;
  margin: -40px 50 0 -75px;
  border: 10px solid white;
  border-radius: 50%;
  border-top: 10px solid Green;
  width: 75px;
  height: 75px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 }
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom {
  from{ bottom:-100px; opacity:0 }
  to{ bottom:0; opacity:1 }
}

#myDiv {
  display: none;
  text-align: center;
}
</style>

<?php

session_start();
if ( $_SESSION["cnt"]<=3  and $session['type'] !='MASTER' ){	
	if ($_SESSION["cnt"]<=3 ){	
	
	//echo $language_1;
	//die($_SESSION["cnt"]);
	//echo '<div id="loader"></div>';
	//echo '<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>';
	echo "<script> window.location.href='".base_url()."index.php/PageLanguage/switchLang/".$language_1."'</script>";
	}
	echo '<META http-equiv="refresh" content="0;">';
	$_SESSION["cnt"] = ($_SESSION["cnt"] + 4);
}

else
{
		//echo $language_1;
		
		//print_r($_SESSION);
		
		//$this->config->set_item('language', $language_1);
		//$this->lang->load('message',$language_1);	
		
}


?>



<section class="dip-dash-sec">
  <h3><?php  echo $this->lang->line('Yourprofiledetails');?></h3>
   <p class="error_msg" style="color:red;"><?php echo $this->lang->line('FormValidation_fieldrequired'); ?></p>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <div class="row dip-form-body">
      <div class="col-sm-6">
        <fieldset>
          <legend><?php echo $this->lang->line('Yourprofiledetails'); ?></legend>

          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipGroup"><?php echo $this->lang->line('dipGroup'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('parent', set_value('parent',$golfclub->parent['name']), 'class="form-control dip-ro" id="dipGroup" placeholder="'.$this->lang->line('dipGroup').'" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLevel"><?php echo $this->lang->line('dipLevel'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('level', set_value('level',$user_levels[$golfclub->level]), 'class="form-control dip-ro" id="dipLevel" placeholder="Golf Group Name" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipHotelName"><?php echo $this->lang->line('dipHotelName'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('name', set_value('name',$golfclub->name), 'class="form-control dip-ro" id="dipHotelName" placeholder="Hotel Name" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUserName"><?php echo $this->lang->line('dipUserName'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('username', set_value('username',$golfclub->username), 'class="form-control dip-ro" id="dipUserName" placeholder="User Name" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipCreation"><?php echo $this->lang->line('dipCreation'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('creation_date', set_value('creation_date',$golfclub->creation_date), 'class="form-control dip-ro" id="dipCreation" placeholder="00-00-0000" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipRenewal"><?php echo $this->lang->line('dipRenewal'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('renewal_date', set_value('renewal_date',$golfclub->renewal_date), 'class="form-control dip-ro" id="dipRenewal" placeholder="00-00-0000" readonly="readonly"');?>
            </div>
          </div>
        </fieldset>
        <!-- contact person -->
        <fieldset>
          <legend><?php echo $this->lang->line('leg2'); ?></legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('dipAndroidUrl'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_person', set_value('contact_person',$golfclub->contact_person), 'class="form-control dip-ro" id="dipContactPerson" placeholder="'. $this->lang->line('dipAndroidUrl').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('conphone'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_phone', set_value('contact_phone',$golfclub->contact_phone), 'class="form-control dip-ro id="dipContactPhone" placeholder="'.$this->lang->line('conphone').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('conemail'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_email', set_value('contact_email',$golfclub->contact_email), 'class="form-control dip-ro" id="dipContactEmail" placeholder="'.$this->lang->line('conemail').'"');?>
            </div>
          </div>
        </fieldset>
        
<?php if($golfclub->level == 3):?>
        <fieldset>
        <legend><?php echo $this->lang->line('leg3'); ?></legend>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosStatus"><?php echo $this->lang->line('iostatus'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('ios_status', set_value('ios_status',$golfclub->ios_status), 'class="form-control dip-ro" id="dipIosStatus" placeholder="00-00-0000" readonly="readonly"');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidStatus"><?php echo $this->lang->line('androidst'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('android_status', set_value('android_status',$golfclub->android_status), 'class="form-control dip-ro" id="dipAndroidStatus" placeholder="00-00-0000" readonly="readonly"');?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosUrl"><?php echo $this->lang->line('appurl'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('ios_url', set_value('ios_url',$golfclub->ios_url), 'class="form-control" id="dipIosUrl dip-ro" placeholder="'.$this->lang->line('appurl').'" readonly="readonly"');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('googleplay'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('android_url', set_value('android_url',$golfclub->android_url), 'class="form-control dip-ro" id="dipAndroidUrl" placeholder="'.$this->lang->line('googleplay').'" readonly="readonly"');?>
          </div>
        </div>
        </fieldset>
        <?php 
        $alang = array();
        foreach ($golfclub->languages as $key => $value) {
          $alang[$value] = $langs[$value];
        }?>
        <!-- language -->
        
        <fieldset>
          <legend><?php echo $this->lang->line('leg4'); ?> </legend>
          <div class="form-group">
            <div class="col-sm-4 control-label" for=""><?php echo $this->lang->line('avlag'); ?> </div>
            <div class="col-sm-8">
                <?php foreach ($alang as $value): ?>
                  <span class="label label-primary"><?php echo $value;?></span>
                <?php endforeach; ?>
            </div>
          </div>
        </fieldset>
        <fieldset>
          <legend><?php echo $this->lang->line('leg5'); ?> </legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="disabledSelect"><?php echo $this->lang->line('leg5'); ?> </label>
            <div class="col-sm-8">
         <?php
       // $_SESSION["lang1"] =  strtolower($alang[$golfclub->default_language]);

     $lfolder= "application/language/".strtolower($alang[$golfclub->default_language]);

      
      if (!is_dir($lfolder)){
         $_SESSION["cnt"]=4;
      }
      else
      {

              $_SESSION["lang1"] =  strtolower($alang[$golfclub->default_language]);
			  //echo  $_SESSION["lang1"];

        }


              echo form_input('default_lang', set_value('default_lang',(isset($alang[$golfclub->default_language])?$alang[$golfclub->default_language]:'')), 'id="dipDefaultLang" class="form-control" readonly="readonly"'); ?>
            </div>
          </div>
        </fieldset>
<?php endif; ?>
        <fieldset>
          <legend><?php echo $this->lang->line('leg6'); ?> </legend>

          <?php if($golfclub->level == 3):?>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPushNote"><?php echo $this->lang->line('pnotig'); ?>  </label>
            <div class="col-sm-8">
              <?php echo form_input('push_note', set_value('push_note',$golfclub->push_notification), 'class="form-control dip-ro" id="dipPushNote" placeholder="Push Notification for Golfapp" disabled ');?>
            </div>
          </div>
          <?php endif;?>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPushNote2"> <?php echo $this->lang->line('pnotin'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('push_note', set_value('nt_push_note',$golfclub->nt_push_notification), 'class="form-control dip-ro" id="dipPushNote2" placeholder="Push Notification for NextTee" disabled');?>
            </div>
          </div>
        </fieldset>
      </div>

      <!-- EDITABLE CONTENTS -->

      <div class="col-sm-6">
        
        <fieldset>
          <legend><?php echo $this->lang->line('leg7'); ?> </legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPhone"><?php echo $this->lang->line('bphone'); ?>  *</label>
            <div class="col-sm-8">
              <?php echo form_input('phone', set_value('phone',$golfclub->phone), 'class="form-control" id="dipPhone" placeholder="'.$this->lang->line('Phonenumberinternationalformat').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipEmail"><?php echo $this->lang->line('bemail'); ?>  *</label>
            <div class="col-sm-8">
              <?php echo form_input(array('name'=>'email', 'type'=>'email'), set_value('email',$golfclub->email), 'class="form-control" id="dipEmail" placeholder="'.$this->lang->line('bemail').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipWebsite"><?php echo $this->lang->line('website'); ?>   </label>
            <div class="col-sm-8">
              <?php echo form_input('website', set_value('website',$golfclub->website), 'class="form-control" id="dipWebsite" placeholder="'.$this->lang->line('website').'"');?>
            </div>
          </div>
		  <div class="form-group">
            <label class="col-sm-4 control-label" for="dipWebsite"><?php echo $this->lang->line('book_online'); ?>   </label>
            <div class="col-sm-8">
              <?php echo form_input('book_online', set_value('book_online',$golfclub->book_online), 'class="form-control" id="dipWebsite" placeholder="'.$this->lang->line('book_online').'"');?>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend><?php echo $this->lang->line('leg8'); ?> </legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="autocomplete"><?php echo $this->lang->line('fulladd'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('address', set_value('address',$golfclub->address), 'class="form-control" id="autocomplete"  placeholder="'. $this->lang->line('fulladd').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="street_number"><?php echo $this->lang->line('StreetNumber'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('streetNo', set_value('streetNo',$golfclub->streetno), 'class="form-control" id="street_number" placeholder="'.$this->lang->line('StreetNumber').'" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="route"><?php echo $this->lang->line('Street'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('route', set_value('route',$golfclub->route), 'class="form-control" id="route" placeholder="'.$this->lang->line('Street').'" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="administrative_area_level_1"><?php echo $this->lang->line('PostalCode'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('postalcode', set_value('postalcode',$golfclub->postalcode), 'class="form-control" id="postal_code"  placeholder="'.$this->lang->line('PostalCode').'" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="locality"><?php echo $this->lang->line('City'); ?> *</label>
            <div class="col-sm-8">
              <?php echo form_input('city', set_value('city',$golfclub->city), 'class="form-control" id="locality" placeholder="'.$this->lang->line('City').'" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="administrative_area_level_1"><?php echo $this->lang->line('State'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('state', set_value('state',$golfclub->state), 'class="form-control" id="administrative_area_level_1"  placeholder="'.$this->lang->line('State').'" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="country"><?php echo $this->lang->line('Country'); ?> *</label>
            <div class="col-sm-8">
              <?php echo form_dropdown('country', $countries, set_value('country',$golfclub->country), 'id="country" class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLat"><?php echo $this->lang->line('Latitude'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('latitude', set_value('latitude',$golfclub->latitude), 'class="form-control" id="dipLat" placeholder="00.0000" ');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLong"><?php echo $this->lang->line('Longitude'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('longitude', set_value('longitude',$golfclub->longitude), 'class="form-control" id="dipLong" placeholder="00.0000" ');?>
            </div>
          </div>
        </fieldset>
      </div>

    </div>

    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit',$this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <?php echo form_reset('reset', $this->lang->line('Cancel'),'class="btn btn-default"'); ?>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>

<style>
.form-control[disabled], fieldset[disabled] .form-control, .dip-ro {
    cursor: text;
}
</style>


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
  $("#country").multiselect({
     multiple: false,
     header: "Select an option",
     noneSelectedText: "Select",
     selectedList: 1
  });
  
  $('.error_msg').css('display','none') 
  $("#dipPhone").attr("required", true);
  $("#dipEmail").attr("required", true);
  $("#locality").attr("required", true);
  $("#country").attr("required", true);
  $("#dipLat").attr("required", true);
  $("#dipLong").attr("required", true);
  
  $('.btn-success').click(function(){
		var count = 0;
		var umail = $("#dipEmail").val();
		var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
		$('.error_msg').text('<?php echo $this->lang->line("FormValidation_fieldrequired"); ?>');
	
		$(".dip-form input").each( function(){
			 var val = $(this).val();
			if(($(this).prop('required'))&&(val== "")){
				 $(this).css('border-color','red'); 				 
				 count++;
		   } 
		    else if ($(this).attr('id') == 'dipEmail')
		   {
			   if (testEmail.test($(this).val()))
				{
					$(this).css('border-color',''); 
					$(this).get(0).setCustomValidity('');
				} else {
					$(this).css('border-color','red'); 
					$('.error_msg').append("<p><?php echo $this->lang->line('valid_email'); ?></p>");				
					count++;
					$(this).get(0).setCustomValidity('<?php echo $this->lang->line("valid_email"); ?>');
				}
		   } else {
			   $(this).css('border-color',''); 
		   }				   		   
		});
		
		if(count > 0){               
			$('.error_msg').css('display','block') //to show   
			$('.alert-success').css('display','none');
			$('.alert-danger').css('display','none');
			$("#"+firstFocus).focus();		
		} else {			  
		  $('.error_msg').css('display','none'); //to hide		
		}
					
	 });
	 
		
});
var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'long_name',
  country: 'short_name',
  postal_code: 'short_name'
};
function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}
$(document).ready(function($) {

  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['address'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
});

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  for (var component in componentForm) {
    document.getElementById(component).value = '';
    // document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
      if(addressType=='country'){
        $("#"+addressType).multiselect('refresh');
      }
    }
  }

  var lat = place.geometry.location.lat();
  var lng = place.geometry.location.lng();
  // get lant an long 
  if (lat) {
    document.getElementById('dipLat').value = lat.toFixed(5);
    document.getElementById('dipLat').disabled = false;
  }
  if (lng) {
    document.getElementById('dipLong').value = lng.toFixed(5);
    document.getElementById('dipLong').disabled = false;
  }
}
</script>
