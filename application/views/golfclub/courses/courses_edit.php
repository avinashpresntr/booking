<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>
  <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_alerts('golfclub/courses', 'Course'); ?>
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
            if($value == $client->default_language){
              $default = 'default';
              $required = 'required';
            }			
            $r_name = '';
            $r_descr = '';
            if(isset($row->name[$value]))
              $r_name = $row->name[$value];
            if(isset($row->descr[$value]))
              $r_descr = $row->descr[$value];
            ?>
            <div class="dip-langbox <?=$default;?>">
              <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>
              <label class="control-label" for="dipName"><?php echo $this->lang->line('CourseName'); ?> </label>
              <?php echo form_input('name['.$value.']', set_value('name['.$value.']',$r_name), 'class="form-control" rel="'.$value.'" id="dipName'.$value.'" placeholder="'.$this->lang->line('CourseName') .'" '.$required) ;?>
            
              <label class="control-label" for="dipDesc"><?php echo $this->lang->line('CourseDescription'); ?> </label>
              <?php echo form_textarea(array('name'=>'descr['.$value.']','rows'=>'5'), set_value('descr['.$value.']',$r_descr), 'class="form-control" id="dipDesc'.$value.'" rel="'.$value.'" placeholder="'.$this->lang->line('CourseDescription') .'" '.$required);?>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
      </fieldset>
      <fieldset>
            <legend><?php echo $this->lang->line('Facilities'); ?> </legend>
            
            <div class="dip-checkboxs row">
              <?php foreach ($facilities as $key => $value):?>
                <div class="col-xs-4 col-sm-3">
                <label class="checkbox-inline chk-fac clearfix">
                <?php echo form_checkbox('facilities['.$key.']',$key, (in_array($key, $row->facilities)?true:false)); ?> <?=$value;?> 
                <img src="<?php echo site_url('assets/img/fcilities/'.$key.'.png');?>" alt="<?=$value;?>">
                </label>
                </div>
              <?php endforeach;?>
            </div>

      </fieldset>
      <fieldset>
        <legend><?php echo $this->lang->line('Details_course_edit_page'); ?></legend>
        <div class="form-group">
          <label class="col-xs-3 col-sm-1 control-label" for="dipHoles"><?php echo $this->lang->line('Holes'); ?></label>
          <div class="col-xs-9 col-sm-2">
            <?php echo form_input('holes', set_value('holes',$row->holes), 'class="form-control" required id="dipHoles" placeholder="'.$this->lang->line('Holes').'" '.$required);?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 col-sm-1 control-label" for="dipPar"><?php echo $this->lang->line('Par'); ?></label>
          <div class="col-xs-9 col-sm-2">
            <?php echo form_input('par', set_value('par',$row->par), 'class="form-control" id="dipPar" required placeholder="'.$this->lang->line('Par').'" '.$required);?>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 col-sm-1 control-label" for="dipLength"><?php echo $this->lang->line('Length'); ?></label>
          <div class="col-xs-5 col-sm-2">
            <?php echo form_input('length', set_value('length',$row->length), 'class="form-control" required id="dipLength" placeholder="'.$this->lang->line('Length').'" '.$required);?>
          </div>
          <div class="col-xs-4 col-sm-2">
            <?php echo form_dropdown('length_unit', array('meter'=>$this->lang->line('Meter'),'yard'=>$this->lang->line('Yard')),$row->length_unit, 'id="dipLengthUnit" class="form-control"'); ?>
          </div>
        </div>
      </fieldset>

      <?php
      $fu_imgs['pics'] = $row->pics;
      $this->load->view('common/fileuploader',$fu_imgs); ?>
      <br/>
    </div>
    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', $this->lang->line('save'),'class="btn btn-success"'); ?>&nbsp;
      <a href="<?php echo site_full_url('golfclub/courses');?>" class="btn btn-default" ><?php echo $this->lang->line('Cancel'); ?></a>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>

<style>
  .form-horizontal .checkbox-inline {
    margin-top: 0;
    margin-bottom: 0;
    padding-top: 8px;
    display: block;
    padding: 5px;
    width: 100%;
    padding-left: 25px;
    background: #DDECCF;
    margin-bottom: 5px;
    border-radius: 5px;
}
.chk-fac img {
    width: 50%;
    float: right;
    max-width: 60px;
}
</style>
<script type="text/javascript">    
  $(document).ready(function(){  
	 //$(".error_msg").css("opacity", "0"); 
	 $('.error_msg').css('display','none')
 
 //***************Set Required Fields***********//	  
	 /* $(".dip-form input,.dip-form textarea").focusout(function(){
	   var rel = $(this).attr('rel');
	   var title = $('.dip-form #dipName'+rel).val();
	   var desc = $('.dip-form #dipDesc'+rel).val();
	   
	     
	   if(((desc != "")&&(title == ""))||((desc == "")&&(title != ""))){
		  if(title== ""){
			 $('.dip-form #dipName'+rel).attr('required',true); 
			 $('.dip-form #dipDesc'+rel).removeAttr('required');
		  } else if(desc== ""){
			 $('.dip-form #dipDesc'+rel).attr('required',true);
			 $('.dip-form #dipName'+rel).removeAttr('required');			 
		  }
	   } else {
		  $('.dip-form #dipName'+rel).removeAttr('required');
		  $('.dip-form #dipDesc'+rel).removeAttr('required'); 	
	   }    
	  });*/
	  
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
		   var dipHoles = $('#dipHoles').val();
		   var dipPar = $('#dipPar').val();
		   var dipLength = $('#dipLength').val();
		  $(".dip-form input,.dip-form textarea").each( function(){			  
			  var rel = $(this).attr('rel');
			  var title = $('.dip-form #dipName'+rel).val();
			  var desc = $('.dip-form #dipDesc'+rel).val();
			  var val = $(this).val(); 
			  
			  if(($(this).prop('required'))&&(val== "")){
				  count++;		  
		     }
		   
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
					  	$('.dip-form #dipName'+rel).css('border-color','red');
						$('.dip-form #dipDesc'+rel).css('border-color','red');
				  } else {
					  $('.dip-form #dipName'+rel).css('border-color','inherit'); 
					  $('.dip-form #dipDesc'+rel).css('border-color','inherit'); 	
				  }
			   } 	
			   
			   if(dipHoles==""){
			   	  $('.dip-form-body #dipHoles').css('border-color','red'); 
			   } else {
				   $('.dip-form-body #dipHoles').css('border-color','#bbb'); 
				  }
			   if(dipPar==""){
			   	  $('.dip-form-body #dipPar').css('border-color','red'); 
			   } else {
				$('.dip-form-body #dipPar').css('border-color','#bbb'); 
				}
			   if(dipLength==""){
			   	  $('.dip-form-body #dipLength').css('border-color','red'); 
			   } else {
				$('.dip-form-body #dipLength').css('border-color','#bbb'); 
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