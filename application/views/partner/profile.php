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
if ( $_SESSION["cnt"]<=3  and $session['type'] !='MASTER' )
{

if ($_SESSION["cnt"]<=3 )
{
echo '<div id="loader"></div>';
//echo '<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>';
echo "<script> window.location.href='".base_url()."index.php/PageLanguage/switchLang/".$_SESSION["lang1"]."'</script>";

}

echo '<META http-equiv="refresh" content="0;">';

$_SESSION["cnt"] = ($_SESSION["cnt"] + 1);
}

else

{
//echo '<div class="loader"></div>';
}
?>


<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <p class="error_msg" style="color:red;"><?php echo $this->lang->line('FormValidation_fieldrequired'); ?></p>

  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <div class="row dip-form-body">
      <div class="col-sm-6">
        <fieldset>

          <legend><?php echo $this->lang->line('Genaral'); ?></legend>

          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipGroup"><?php echo $this->lang->line('GolfClubName'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('parent', set_value('parent',$partner->parent->name), 'class="form-control" id="dipGroup" placeholder="'.$this->lang->line('GolfClubName').'" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLevel"><?php echo $this->lang->line('ParentCategory'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('level', set_value('level',$user_types[$partner->type]), 'class="form-control" id="dipLevel" placeholder="'.$this->lang->line('ParentCategory').'" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipHotelName"> <?php echo $this->lang->line('Name'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('name', set_value('name',$partner->name), 'class="form-control" id="dipHotelName" placeholder="'.$this->lang->line('Name').'" '.($partner->edit_name==1?'':'readonly="readonly"'));?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUserName"><?php echo $this->lang->line('UserName'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('username', set_value('username',$partner->username), 'class="form-control" id="dipUserName" placeholder="'.$this->lang->line('UserName').'" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipCreation"><?php echo $this->lang->line('CreationDate'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('creation_date', set_value('creation_date',$partner->creation_date), 'class="form-control" id="dipCreation" placeholder="00-00-0000" readonly="readonly"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipRenewal"><?php echo $this->lang->line('RenewalDate'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('renewal_date', set_value('renewal_date',$partner->renewal_date), 'class="form-control" id="dipRenewal" placeholder="00-00-0000" readonly="readonly"');?>
            </div>
          </div>
        </fieldset>
        <!-- contact person -->
        <fieldset>
          <legend><?php echo $this->lang->line('Contact'); ?></legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('ContactPerson'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_person', set_value('contact_person',$partner->contact_person), 'class="form-control" id="dipContactPerson" placeholder="'.$this->lang->line('ContactPerson').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('ContactPhone'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_phone', set_value('contact_phone',$partner->contact_phone), 'class="form-control" id="dipContactPhone" placeholder="'.$this->lang->line('ContactPhone').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('ContactEmail'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('contact_email', set_value('contact_email',$partner->contact_email), 'class="form-control" id="dipContactEmail" placeholder="'.$this->lang->line('ContactEmail').'"');?>
            </div>
          </div>
        </fieldset>
        <fieldset disabled>
        <legend><?php echo $this->lang->line('MobileApplication'); ?></legend>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosStatus"><?php echo $this->lang->line('iosStatus'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('ios_status', set_value('ios_status',$partner->parent->ios_status), 'class="form-control" id="dipIosStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidStatus"><?php echo $this->lang->line('AndroidStatus'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('android_status', set_value('android_status',$partner->parent->android_status), 'class="form-control" id="dipAndroidStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosUrl"><?php echo $this->lang->line('AppStoreUrl'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('ios_url', set_value('ios_url',$partner->parent->ios_url), 'class="form-control" id="dipIosUrl" placeholder="'.$this->lang->line('AppStoreUrl').'"');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('GooglePlayUrl'); ?></label>
          <div class="col-sm-8">
            <?php echo form_input('android_url', set_value('android_url',$partner->parent->android_url), 'class="form-control" id="dipAndroidUrl" placeholder="'.$this->lang->line('GooglePlayUrl').'"');?>
          </div>
        </div>
        </fieldset>
        <?php 
        $alang = array();
        foreach ($partner->parent->languages as $key => $value) {
          $alang[$value] = $langs[$value];
        }?>
        <!-- language -->
        <fieldset disabled>
          <legend><?php echo $this->lang->line('MobileAppLanguage'); ?></legend>
          <div class="form-group">
            <div class="col-sm-4 control-label" for=""><?php echo $this->lang->line('AvailableLanguage'); ?></div>
            <div class="col-sm-8">
                <?php foreach ($alang as $value): ?>
                  <span class="label label-primary"><?php echo $value;?></span>
                <?php endforeach; ?>
            </div>
          </div>
        </fieldset>
        
        <fieldset disabled>
          <legend><?php echo $this->lang->line('Displaylanguage'); ?></legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="disabledSelect"><?php echo $this->lang->line('Displaylanguage'); ?></label>
            <div class="col-sm-8">
			  <?php
       // $_SESSION["lang1"] =  strtolower($alang[$golfclub->default_language]);


      $lfolder= "application/language/".strtolower($alang[$partner->parent->default_language]);

      
      if (!is_dir($lfolder)){
         $_SESSION["cnt"]=4;
      }
      else
      {

              $_SESSION["lang1"] =  strtolower($alang[$partner->parent->default_language]);

        }
		?>
              <?php echo form_input('default_lang', set_value('default_lang',$alang[$partner->parent->default_language]), 'id="dipDefaultLang" class="form-control"'); ?>
            </div>
          </div>
        </fieldset>

        <fieldset disabled>
          <legend><?php echo $this->lang->line('PushNotification'); ?></legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl"><?php echo $this->lang->line('PushNotification'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('push_note', set_value('push_note',$partner->push_notification), 'class="form-control" id="dipPushNote" placeholder="'.$this->lang->line('PushNotification').'" disabled');?>
            </div>
          </div>
        </fieldset>
      </div>

      <!-- EDITABLE CONTENTS -->

      <div class="col-sm-6">
        
        <fieldset>
          <legend><?php echo $this->lang->line('BookingDetails'); ?> </legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipPhone"><?php echo ' '.$this->lang->line('PhoneNo'); ?>  *</label>
            <div class="col-sm-8">
              <?php echo form_input('phone', set_value('phone',$partner->phone), 'class="form-control" id="dipPhone" placeholder="'.$this->lang->line('PhoneNo').'."');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipEmail"><?php echo ' '.$this->lang->line('Email'); ?>  *</label>
            <div class="col-sm-8">
              <?php echo form_input('email', set_value('email',$partner->email), 'class="form-control" id="dipEmail" placeholder="'.$this->lang->line('Email').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipWebsite"><?php echo $this->lang->line('Website'); ?>  </label>
            <div class="col-sm-8">
              <?php echo form_input('website', set_value('website',$partner->website), 'class="form-control" id="dipWebsite" placeholder="'.$this->lang->line('Website').'"');?>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend><?php echo $this->lang->line('PostalDetails'); ?> </legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="autocomplete"><?php echo $this->lang->line('FullAddress'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('address', set_value('address',$partner->address), 'class="form-control" id="autocomplete"  placeholder="'.$this->lang->line('FullAddress').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="street_number"><?php echo $this->lang->line('StreetNumber'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('streetNo', set_value('streetNo',$partner->streetno), 'class="form-control" id="street_number" placeholder="'.$this->lang->line('StreetNumber').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="route"><?php echo $this->lang->line('Street'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('route', set_value('route',$partner->route), 'class="form-control" id="route" placeholder="'.$this->lang->line('Street').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="administrative_area_level_1"><?php echo $this->lang->line('PostalCode'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('postalcode', set_value('postalcode',$partner->postalcode), 'class="form-control" id="postal_code"  placeholder="'.$this->lang->line('PostalCode').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="locality"><?php echo $this->lang->line('City'); ?> *</label>
            <div class="col-sm-8">
              <?php echo form_input('city', set_value('city',$partner->city), 'class="form-control" id="locality" placeholder="'.$this->lang->line('City').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="administrative_area_level_1"><?php echo $this->lang->line('State'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('state', set_value('state',$partner->state), 'class="form-control" id="administrative_area_level_1"  placeholder="'.$this->lang->line('State').'"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="country"><?php echo $this->lang->line('Country'); ?> *</label>
            <div class="col-sm-8">
              <?php echo form_dropdown('country', $countries, set_value('country',$partner->country), 'id="country" class="form-control"'); ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLat"><?php echo $this->lang->line('Latitude'); ?></label>
            <div class="col-sm-8">
              <?php echo form_input('latitude', set_value('latitude',$partner->latitude), 'class="form-control" id="dipLat" placeholder="00.0000"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipLong"><?php echo $this->lang->line('Longitude'); ?> </label>
            <div class="col-sm-8">
              <?php echo form_input('longitude', set_value('longitude',$partner->longitude), 'class="form-control" id="dipLong" placeholder="00.0000"');?>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', $this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <?php echo form_reset('reset',$this->lang->line('Cancel') ,'class="btn btn-default"'); ?>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>

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

  $('.error_msg').css('display','none'); 
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
		$('.error_msg').text('<?php echo $this->lang->line("FormValidation_fieldrequired")?>');
		
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
					$('.error_msg').append('<p><?php echo $this->lang->line("valid_email") ?></p>');					
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
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}
$(document).ready(function($) {
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['address'] });
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
