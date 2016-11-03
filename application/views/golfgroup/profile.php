<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>

  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <div class="row dip-form-body">
      <div class="col-sm-6">
        <fieldset disabled>
          <legend>General:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipName">Golf Group Name</label>
            <div class="col-sm-8">
              <?php echo form_input('name', set_value('name',$golfgroup->name), 'class="form-control" id="dipName" placeholder="Hotel Name"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUserName">User Name</label>
            <div class="col-sm-8">
              <?php echo form_input('username', set_value('username',$golfgroup->username), 'class="form-control" id="dipUserName" placeholder="User Name"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipCreation">Creation Date</label>
            <div class="col-sm-8">
              <?php echo form_input('creation_date', set_value('creation_date',$golfgroup->creation_date), 'class="form-control" id="dipCreation" placeholder="00-00-0000" data-datepicker');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipRenewal">Renewal Date</label>
            <div class="col-sm-8">
              <?php echo form_input('renewal_date', set_value('renewal_date',$golfgroup->renewal_date), 'class="form-control" id="dipRenewal" placeholder="00-00-0000" data-datepicker');?>
            </div>
          </div>
        </fieldset>
        <!-- contact person -->
        <fieldset disabled>
          <legend>Contact:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl">Contact Person</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_person', set_value('contact_person',$golfgroup->contact_person), 'class="form-control" id="dipContactPerson" placeholder="Contact Person"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl">Contact Phone</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_phone', set_value('contact_phone',$golfgroup->contact_phone), 'class="form-control" id="dipContactPhone" placeholder="Contact Phone"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipAndroidUrl">Contact Email</label>
            <div class="col-sm-8">
              <?php echo form_input('contact_email', set_value('contact_email',$golfgroup->contact_email), 'class="form-control" id="dipContactEmail" placeholder="Contact Email"');?>
            </div>
          </div>
        </fieldset>
      </div>

      <div class="col-sm-6">
        <fieldset disabled>
        <legend>Mobile Application:</legend>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosStatus">ios Status</label>
          <div class="col-sm-8">
            <?php echo form_input('ios_status', set_value('ios_status',$golfgroup->ios_status), 'class="form-control" id="dipIosStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidStatus">Android Status</label>
          <div class="col-sm-8">
            <?php echo form_input('android_status', set_value('android_status',$golfgroup->android_status), 'class="form-control" id="dipAndroidStatus" placeholder="00-00-0000" data-datepicker');?>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipIosUrl">App Store Url</label>
          <div class="col-sm-8">
            <?php echo form_input('ios_url', set_value('ios_url',$golfgroup->ios_url), 'class="form-control" id="dipIosUrl" placeholder="App Store Url"');?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-4 control-label" for="dipAndroidUrl">Google Play Url</label>
          <div class="col-sm-8">
            <?php echo form_input('android_url', set_value('android_url',$golfgroup->android_url), 'class="form-control" id="dipAndroidUrl" placeholder="Google Play Url"');?>
          </div>
        </div>
        </fieldset>
        <?php 
        $alang = array();
        foreach ($golfgroup->languages as $key => $value) {
          $alang[$value] = $langs[$value];
        }?>
        <!-- language -->
        <fieldset disabled>
          <legend>Mobile App Language:</legend>
          <div class="form-group">
            <div class="col-sm-4 control-label" for="">Available Language</div>
            <div class="col-sm-8">
                <?php foreach ($alang as $value): ?>
                  <span class="label label-primary"><?php echo $value;?></span>
                <?php endforeach; ?>
            </div>
          </div>
        </fieldset>
        
        <fieldset disabled>
          <legend>Display language:</legend>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="disabledSelect">Display Language</label>
            <div class="col-sm-8">
              <?php echo form_dropdown('default_lang', $alang, $golfgroup->default_language, 'id="dipDefaultLang" class="form-control"'); ?>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save','class="btn btn-success"'); ?>&nbsp;
      <?php echo form_reset('reset', 'Cancel','class="btn btn-default"'); ?>
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
});
var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'long_name',
  country: 'long_name',
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