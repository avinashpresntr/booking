<?php
$today = date('Y-m-d');
if (!empty($client->city) && !empty($client->country)) {
    $today = get_timee($client->city, $client->country);
} else {
    echo '<script>alertify.alert("You need to first set your Country and City.");</script>';
}
?>
<section class="dip-dash-sec">
    <h3><?= $page['desc']; ?></h3>
    <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"'); ?>
    
    <?php echo get_alerts('golfclub/nexttee/offers', 'Offer'); ?>
    <p class="error_msg"> <?php echo $this->lang->line('FormValidation_fieldrequired'); ?> </p>
    <div role="alert" class="alert alert-warning alert-dismissible fade in validity-alert" style="display: none"> 
        <button aria-label="Close" data-dismiss="alert" class="close" type="button">
            <span aria-hidden="true">×</span></button> 
        <strong>You must enter at least one language</strong>. 
    </div>
    <div class="dip-form-body">


        <fieldset>
            <legend><?php echo $this->lang->line('Offervalidity'); ?></legend>
			<!-- <p class="error_msg" style="color:red;">(Fields With Red Colour are Required*)</p>-->
            <div class="form-inline">
                <div class="form-group" style="padding:0 15px;">
                    <label class="control-label" for="dipStart"><?php echo $this->lang->line('From'); ?></label>
                    <?php echo form_input('starting', set_value('starting', $row->startdate), 'class="form-control" id="dipStart" placeholder="00-00-0000" style="width:120px;" required'); ?>
                </div>
                <div class="form-group" style="padding:0 15px;">
                    <label class="control-label" for="dipEnd"><?php echo $this->lang->line('To'); ?></label>
                    <?php echo form_input('ending', set_value('ending', $row->enddate), 'class="form-control" id="dipEnd" placeholder="00-00-0000" style="width:120px;" required'); ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend><?php echo $this->lang->line('Offerdescription'); ?></legend>
            <div class="row">
                <?php foreach ($client->languages as $key => $value): ?>
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
                        if (isset($row->title[$value]))
                            $r_name = $row->title[$value];
                        if (isset($row->descr[$value]))
                            $r_descr = $row->descr[$value];
                        ?>
                        <div class="dip-langbox <?= $default; ?>">
                            <h5><?php echo $langs[$value]; ?> <i class="flag flag-<?php echo $langs[$value]; ?>" alt="<?php echo $langs[$value]; ?>"></i></h5>
                            <label class="control-label" for="dipName"><?php echo $this->lang->line('Title'); ?></label>
                            <?php echo form_input('title[' . $value . ']', set_value('title[' . $value . ']', $r_name), 'class="form-control validity-title" rel="'.$value.'" id="dipName' . $value . '" data-lg="' . $value . '" placeholder="'.$this->lang->line('Title').'" ' . $required); ?>


                            <label class="control-label" for="dipDesc"><?php echo $this->lang->line('Description'); ?></label>
                            <?php echo form_textarea(array('name' => 'descr[' . $value . ']', 'rows' => '5'), set_value('descr[' . $value . ']', $r_descr), 'class="form-control validity-desc" rel="'.$value.'" id="dipDesc' . $value . '" data-lg="' . $value . '" placeholder="'.$this->lang->line('Description').'" ' . $required); ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>


        <?php
        if (isset($row->enddate) && !empty($row->enddate) && (encode_date($row->enddate) < $today  )) {
            // dont show push notification part if you want to show push part change above condition endate < today and remove startdate condition  this has been removed|| encode_date($row->startdate) > $today
        } else {
            $this->load->view('common/push_notification', array('client' => $client));
        }
        ?>
    </div>
    <div class="dip-form-foot text-center">
        <?php echo form_submit('submit', $this->lang->line('SavePublish'), 'class="btn btn-success"'); ?>&nbsp;
        <a href="<?php echo site_full_url('golfclub/nexttee/offers'); ?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?></a>
    </div>
    <!-- </form> -->
    <?php echo form_close(); ?>
</section>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("input[type=button], input[type=submit]").attr("disabled", "disabled");
    };

    $(document).ready(function () {

        $('form').on('submit', function (e) {
            var validityName = '';
            $(".validity-title").each(function () {
                validityName += $(this).val();
            });

            if (validityName == '') {
				$('.dip-dash-sec .alert-warning').remove();
                $('.dip-dash-sec').prepend('<div role="alert" class="alert alert-warning alert-dismissible fade in"> <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button> <strong>You must enter at least one offer in one language</strong></div>')
                $('html, body').animate({scrollTop: 0}, 'slow');
                return false;
            }

        });

        //add the required property to the description of the selected language
        $('.validity-title').on('input', function () {
            var lengthValue = $(this).val().length;
            var lg = $(this).data('lg');
            if (lengthValue > 0) {
                $('#dipDesc' + lg).prop('required', true);
            } else {
                $('#dipDesc' + lg).prop('required', false);
            }
        });

        //add the required property to the title of the selected language
        $('.validity-desc').on('input', function () {
            var lengthValue = $(this).val().length;
            var lg = $(this).data('lg');
            if (lengthValue > 0) {
                $('#dipName' + lg).prop('required', true);
            } else {
                $('#dipName' + lg).prop('required', false);
            }
        });

        //add the required property to the title of the selected language
        $('.validity-push').on('input', function () {
            var lengthValue = $(this).val().length;
            var lg = $(this).data('lg');
            if (lengthValue > 0) {
                $('#dipName' + lg).prop('required', true);
                $('#dipDesc' + lg).prop('required', true);
            } else {
                $('#dipName' + lg).prop('required', false);
                $('#dipDesc' + lg).prop('required', false);
            }
        });

        $('#dipStart').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: new Date(),
            onSelect: function () {
                var current = $(this).datepicker('getDate');
                $('#dipEnd').datepicker("option", "minDate", current);
            }
        });
        $('#dipEnd').datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: new Date()
        });
		
	 
 //***************Push Notification Counter On Keyup***********//	
	  $(".error_msg").css("display", "none");	
	   
	  $(".dip-form input,.dip-form textarea").keyup(function(){
	   var rel = $(this).attr('rel');   
	   var title = $('.dip-form #dipName'+rel).val();
	   var desc = $('.dip-form #dipDesc'+rel).val();
	    if((title.length>= 1)&&(desc.length>= 1)){
		  $('#dipPush'+rel).prop("disabled", false); 
	   } else {
		  $('#dipPush'+rel).prop("disabled", true); 
	   }
	   
	  });

//************On Button Click**************//	  
	   $('.btn-success').click(function(){
		   var count = 0;
		  $(".dip-form .validity-title,.dip-form .validity-desc,.dip-form .validity-desc").each( function(){			  
			  var rel = $(this).attr('rel');
			  var title = $('.dip-form #dipName'+rel).val();
			  var desc = $('.dip-form #dipDesc'+rel).val();
			  var val = $(this).val(); 
			 
		    if(((desc != "")&&(title == ""))||((desc == "")&&(title != ""))){
				  if(title== ""){
					 $('.dip-form #dipName'+rel).css('border-color','red'); 
					 $('.dip-form #dipName'+rel).attr('required', true); 
					 $('.dip-form #dipDesc'+rel).css('border-color','inherit');
				  } else if(desc== ""){			 
					 $('.dip-form #dipDesc'+rel).css('border-color','red'); 
					 $('.dip-form #dipDesc'+rel).attr('required', true); 
					 $('.dip-form #dipName'+rel).css('border-color','inherit');
				  }
			   } else {
				  if((desc == "") && (title == "") && rel == '<?php echo $client->default_language;?>'){
					    $('.dip-form #dipName'+rel).attr('required', true); 
						$('.dip-form #dipDesc'+rel).attr('required', true); 
					  	$('.dip-form #dipName'+rel).css('border-color','red');
						$('.dip-form #dipDesc'+rel).css('border-color','red');
				  } else {
					  $('.dip-form #dipName'+rel).css('border-color','inherit'); 
					  $('.dip-form #dipDesc'+rel).css('border-color','inherit'); 	
				  }
			   }
			   
			if(($(this).prop('required'))&&(val== "")){
				  count++;		  
		     }
		   
	      });
		  
		  if(count > 0){			  
			  $('.error_msg').css('display', 'block'); 
		  } else {
			  var dipStart = $('#dipStart').val();
			  var dipEnd = $('#dipEnd').val();
			  if((dipStart == "" && dipEnd == "") || (dipStart != "" && dipEnd == "") || (dipStart == "" && dipEnd != "")){
				 $('.error_msg').css('display', 'block'); 
			  } else {
			  	  $('.error_msg').css('display', 'none'); 
			  }
		  }
		  var dipStart = $('#dipStart').val();
		  var dipEnd = $('#dipEnd').val();
		  if(dipStart.length == 0){
			 $('#dipStart').css('border-color','red'); 
		   } else {
			  $('#dipStart').css('border-color','#bbb'); 
		   }
		   if(dipEnd.length == 0){
			 $('#dipEnd').css('border-color','red');  
		   } else{
			   $('#dipEnd').css('border-color','#bbb');
		   }
	   }); 
//************Push Notification Counter**************//		   
	   $(".dip-form .validity-title, .dip-form .validity-desc").each( function(){
		 var rl = "";
		// var val = $(this).val(); 
		//alert(rl);
		 var rl = $(this).attr('rel');
		 var tit = $('#dipName'+rl).val();
		 var des = $('#dipDesc'+rl).val(); 
		 if((tit.length>= 1)&&(des.length>= 1)){
			$('#dipPush'+rl).prop("disabled", false);  
		  } else {
			$('#dipPush'+rl).prop("disabled", true);    
		  }
	 });
  });
</script>
