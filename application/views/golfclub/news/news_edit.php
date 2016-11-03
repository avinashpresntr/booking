<section class="dip-dash-sec">
  <h3>
    <?=$page['desc'];?>
  </h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
  <?php //echo get_alerts('partner/packages', 'Hotel Package'); ?>
  <p class="error_msg"> <?php echo $this->lang->line('FormValidation_fieldrequired'); ?> </p>
  <div class="dip-form-body">
  <fieldset>
    <legend><?php echo $this->lang->line('Genaral'); ?></legend>
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
            $r_subtitle = '';
            $r_descr = '';
            if(isset($row->title[$value]))
              $r_name = $row->title[$value];
            if(isset($row->subtitle[$value]))
              $r_subtitle = $row->subtitle[$value];
            if(isset($row->descr[$value]))
              $r_descr = $row->descr[$value];
            ?>
        <div class="dip-langbox <?=$default;?>">
          <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
          <label class="control-label" for="dipTitle"><?php echo $this->lang->line('Title'); ?></label>
          <?php echo form_input('title['.$value.']', set_value('title['.$value.']',$r_name), 'class="form-control" rel="'.$value.'" id="dipTitle'.$value.'" placeholder="'.$this->lang->line('Title').'" '.$required);?>
          <label class="control-label" for="dipSubtitle"><?php echo $this->lang->line('Subtitle'); ?> </label>
          <?php echo form_input('subtitle['.$value.']', set_value('subtitle['.$value.']',$r_subtitle), 'class="form-control" rel="'.$value.'" id="dipSubtitle'.$value.'" placeholder="'.$this->lang->line('Subtitle').'" ');?>
          <label class="control-label" for="dipDesc"><?php echo $this->lang->line('Description'); ?></label>
          <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'2'), set_value('descr['.$value.']',$r_descr), 'class="form-control" rel="'.$value.'" id="dipDesc'.$value.'" placeholder="'.$this->lang->line('Description').'" '.$required);?> </div>
      </div>
      <?php endforeach; ?>
    </div>
  </fieldset>
  <?php
      $fu_imgs['pics'] = $row->pics;
      $this->load->view('common/fileuploader',$fu_imgs); ?>
  <?php $this->load->view('common/push_notification',array('client' => $client)); ?>
  <div class="dip-form-foot text-center"> <?php echo form_submit('submit', $this->lang->line('SavePublish'),'class="btn btn-success"'); ?>&nbsp; <a href="<?php echo site_full_url('golfclub/news');?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?></a> </div>
  <!-- </form> --> 
  <?php echo form_close();?> </section>
<script type="text/javascript">
    window.onbeforeunload = function () {
        $("input[type=button], input[type=submit]").attr("disabled", "disabled");
    };
	
	
  $(document).ready(function(){  
	 //$(".error_msg").css("opacity", "0"); 
	 $('.error_msg').css('display','none')
 
 //***************Set Required Fields***********//	  
	  $(".dip-form input,.dip-form textarea").focusout(function(){
	   var rel = $(this).attr('rel');
	   var title = $('.dip-form #dipTitle'+rel).val();
	   var desc = $('.dip-form #dipDesc'+rel).val();
	   
	     
	   if(((desc != "")&&(title == ""))||((desc == "")&&(title != ""))){
		  if(title== ""){
			 $('.dip-form #dipTitle'+rel).attr('required',true); 
			 $('.dip-form #dipDesc'+rel).removeAttr('required');
		  } else if(desc== ""){
			 $('.dip-form #dipDesc'+rel).attr('required',true);
			 $('.dip-form #dipTitle'+rel).removeAttr('required');			 
		  }
	   } else {
		  $('.dip-form #dipTitle'+rel).removeAttr('required');
		  $('.dip-form #dipDesc'+rel).removeAttr('required'); 	
	   }    
	  });
	  
	  $(".dip-form input,.dip-form textarea").keyup(function(){
	   var rel = $(this).attr('rel');   
	   var title = $('.dip-form #dipTitle'+rel).val();
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
		  $(".dip-form input,.dip-form textarea").each( function(){			  
			  var rel = $(this).attr('rel');
			  var title = $('.dip-form #dipTitle'+rel).val();
			  var desc = $('.dip-form #dipDesc'+rel).val();
			  var val = $(this).val(); 
			  
			  if(($(this).prop('required'))&&(val== "")){
				  count++;		  
		     }
		   
		   if(((desc != "")&&(title == ""))||((desc == "")&&(title != ""))){
				  if(title== ""){
					 $('.dip-form #dipTitle'+rel).css('border-color','red'); 
					 $('.dip-form #dipDesc'+rel).css('border-color','inherit'); 
				  } else if(desc== ""){			 
					 $('.dip-form #dipDesc'+rel).css('border-color','red'); 
					 $('.dip-form #dipTitle'+rel).css('border-color','inherit'); 
				  }
			   } else {
				  $('.dip-form #dipTitle'+rel).css('border-color','inherit'); 
				  $('.dip-form #dipDesc'+rel).css('border-color','inherit'); 	
			   } 				   		   
	      });
		  if(count > 0){
                 // alert(count);
				 	$('.error_msg').css('display','block') //to show
							  
				 // $('.error_msg').css('opacity', '1'); 
			  } else {
				  
				  //$('.error_msg').css('opacity', '0'); 
				  $('.error_msg').css('display','none') //to hide		
			  }
	   }); 

//************Push Notification Counter**************//	   
	   $(".dip-form input,.dip-form textarea").each( function(){
		 var rl = "";
		// var val = $(this).val(); 
		 var rl = $(this).attr('rel');	
		 var tit = $('#dipTitle'+rl).val();
		 var des = $('#dipDesc'+rl).val(); 
		 if((tit.length>= 1)&&(des.length>= 1)){
			$('#dipPush'+rl).prop("disabled", false);  
		  } else {
			$('#dipPush'+rl).prop("disabled", true);    
		  }
	 }); 
	  
	 
 });
</script> 
