<section class="dip-dash-sec">
    <h3><?= $page['desc']; ?></h3>
    <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"'); ?>
    <?php echo get_alerts('golfclub/courses', 'Course'); ?>
    <p class="error_msg"> <?php echo $this->lang->line('FormValidation_fieldrequired'); ?> </p>
    <div class="dip-form-body">

        <fieldset>
            <legend><?php echo $this->lang->line('Genaral'); ?></legend>
            <div class="row">
                <?php foreach ($client->languages as $key => $value): ?>
                    <div class="col-sm-4">
                        <?php
                        $default = '';
                        $required = '';
                        if ($value == $client->default_language) {
                            $default = 'default';
                            $required = 'required';
                        }
                        $r_name = '';
                        $r_descr = '';
                        if (isset($row->name[$value]))
                            $r_name = $row->name[$value];
                        if (isset($row->descr[$value]))
                            $r_descr = $row->descr[$value];
                        ?>
                        <div class="dip-langbox <?= $default; ?>">
                            <h5><?php echo $langs[$value]; ?> <i class="flag flag-<?php echo $langs[$value]; ?>"
                                                                 alt="<?php echo $langs[$value]; ?>"></i></h5>
                            <label class="control-label" for="dipName"><?php echo $this->lang->line('CourseName'); ?></label>
                            <?php echo form_input('name[' . $value . ']', set_value('name[' . $value . ']', $r_name), 'class="form-control" rel="'.$value.'" id="dipName' . $value . '" placeholder="'.$this->lang->line('CourseName').'" ' . $required); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>
        <div class="row">
            <div class="col-sm-7">
                <fieldset>
                    <legend><?php echo $this->lang->line('CourseDetails'); ?></legend>

                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipHoles"><?php echo $this->lang->line('Holes'); ?></label>

                        <div class="col-sm-3 nopd">
                            <?php echo form_input('holes', set_value('holes', $row->holes), 'class="form-control" required id="dipHoles" placeholder="'. $this->lang->line('NumberOfHoles').'"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipPar"><?php echo $this->lang->line('Par'); ?></label>

                        <div class="col-sm-3 nopd">
                            <?php echo form_input('par', set_value('par', $row->par), 'class="form-control" required id="dipPar" placeholder="'.$this->lang->line('Par').'"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipLength"><?php echo $this->lang->line('Length'); ?></label>

                        <div class="col-sm-3 nopd">
                            <?php echo form_input('length', set_value('length', $row->length), 'class="form-control" required id="dipLength" placeholder="'.$this->lang->line('Length').'"'); ?>
                        </div>
                        <div class="col-sm-3 nopd">
						<?php echo form_dropdown('length_unit', array('meter'=>$this->lang->line('Meter'),'yard'=>$this->lang->line('Yard')),$row->length_unit, 'id="dipLengthUnit" class="form-control"'); ?>
                        </div>
                    </div>
                    <!--added-->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipRange"><?php echo $this->lang->line('GreenFeeRange'); ?></label>

                        <div class="col-sm-8 form-inline dip-form-tab nopd" id="dip-grang">

                            <!-- price options -->
                            <label><?php echo form_radio('price_opt', '1', ((empty($row->range_to) && $row->range_from != 'On request') ? true : false), 'style="width:auto;" onclick="change_fee(1)"'); ?>
                               <?php echo $this->lang->line('Fixedprice'); ?></label>
                            <label><?php echo form_radio('price_opt', '2', (!empty($row->range_to) ? true : false), 'style="width:auto;" onclick="change_fee(2)"'); ?>
                              <?php echo $this->lang->line('PriceRange'); ?>  </label>
                            <label><?php echo form_radio('price_opt', '3', ($row->range_from == 'On request' ? true : false), 'style="width:auto;" onclick="change_fee(3)"'); ?>
                               <?php echo $this->lang->line('Onrequest'); ?> </label>

                            <div id="dipRang1" <?php echo((!empty($row->range_to) || $row->range_from == 'On request') ? 'style="display:none;width:350px !important;"' : 'width:350px !important;'); ?>>
                                <?php if ($row->range_from == 'On request') {
                                    $row->range_from = 0;
                                } ?>
                                <?php echo form_input('range_from', set_value('range_from', $row->range_from), 'id="dipRange" class="form-control" placeholder="0" style="display:inline-block;width:120px;" ' . (empty($row->range_to) ? '' : 'disabled')); ?>
                                <?php echo form_dropdown('range_currency', $currencies, $row->range_currency, 'id="dipRangeCurrency" class="form-control"'); ?>
                            </div>

                            <div id="dipRang2" <?php echo(empty($row->range_to) ? 'style="display:none;"' : 'width:120px;'); ?>>
                               <?php echo $this->lang->line('From_GF'); ?>  <?php echo form_input('range_from', set_value('range_from', $row->range_from), 'class="form-control" id="dipRange" placeholder="0" style="display:inline-block;width:75px;"' . (empty($row->range_to) ? 'disabled' : '')); ?>
                              <?php echo $this->lang->line('To_GF'); ?>   <?php echo form_input('range_to', set_value('range_to', $row->range_to), 'class="form-control" placeholder="0" style="display:inline-block;width:75px;"' . (empty($row->range_to) ? 'disabled' : '')); ?>
                                <?php //echo form_dropdown('range_currency', $currencies, $row->range_currency, 'id="dipRangeCurrency" class="form-control"'); ?>
                            </div>

                        </div>
                    </div>
                    <style>
                        #dip-grang button.ui-multiselect, #dip-grang select, #dip-grang input {
                            width: 200px;
                            display: inline-block;
                            overflow-x: hidden;
                            vertical-align: middle;
                        }

                        .dip-form-tab > div {
                            margin: 5px 0;
                            background: #eee;
                            padding: 5px;
							border-radius: 8px;
                        }

                        .dip-form-tab label {
                            margin-right: 10px;
                        }

                        .dip-form-tab label input {
                            margin: 0;
                        }
                    </style>
                    <script>
                        function change_fee(type) {
                            if (type == 1) {
                                $('#dipRang1').show();
                                $('#dipRang1 input').attr('disabled', false);
                                $('#dipRang2').hide();
                                $('#dipRang2 input').attr('disabled', true);
                            }
                            if (type == 2) {
                                $('#dipRang2').show();
                                $('#dipRang2 input').attr('disabled', false);
                                $('#dipRang1').hide();
                                $('#dipRang1 input').attr('disabled', true);
                            }
                            if (type == 3) {
                                $('#dipRang2').hide();
                                $('#dipRang2 input').attr('disabled', true);
                                $('#dipRang1').hide();
                                $('#dipRang1 input').attr('disabled', true);
                            }
                        }
                    </script>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipDifficulty"><?php echo $this->lang->line('CourseDifficulty'); ?></label>

                        <div class="col-sm-6 nopd">
                        <?php
                        //var_dump($row->difficulty);
                        //echo $this->lang->line();
                            $dificultiess = array($this->lang->line('Hard'),$this->lang->line('Moderate hard'),$this->lang->line('Moderate'),$this->lang->line('Easy-Moderate'),$this->lang->line('Easy'));
                                echo form_dropdown('difficulty', array_combine($dificulties, $dificultiess), $row->difficulty, 'id="dipDifficulty" class="form-control"'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipHandicap"><?php echo $this->lang->line('HandicapLimit'); ?></label>

                        <div class="col-sm-4 nopd">

                            <?php $type_options_n = array($this->lang->line('Enter Limit'),$this->lang->line('Proficiency Certificate'), $this->lang->line('Handicap Certificate'), $this->lang->line('No')); 
							?>
                            
                            
                          <?php echo $this->lang->line('Men'); ?><br/>
                          
                           <?php
						   		//echo form_dropdown('handicap_men', array_combine($newoptions, $type_options_n), $row->handicap_men, 'id="dip-men" class="form-control"');
						   
                                //echo form_dropdown('handicap_men', array_combine($type_options, $type_options_n), $row->handicap_men, 'id="dip-men" class="form-control" style="width:80%;display:inline-block;border: 1px solid #C5C5C5;"' . ((!is_numeric($row->handicap_men) && !empty($row->handicap_men)) ? 'readonly' : '')); ?>
                          
                            <?php
							//echo ":::::".$row->handicap_men; 
							  if($row->handicap_men=="No")
							  {
								 $selectVal = $this->lang->line('No'); 
							  }
							  else if($row->handicap_men=="Handicap Certificate")
							  {
								   $selectVal = $this->lang->line('Handicap Certificate'); 
							  }
							  else if($row->handicap_men=="Proficiency Certificate")
							  {
								   $selectVal = $this->lang->line('Proficiency Certificate'); 
							  }
							   else 
							  {
								 $selectVal =$row->handicap_men; 
							  }
							  //echo $selectVal; 
							 echo form_input('handicap_men_1', set_value('handicap_men', $selectVal), 'id="dip-men_1" class="form-control" style="width:85%; font-size:12px;display:inline-block;border: 1px solid #C5C5C5;"' . ((!is_numeric($row->handicap_men) && !empty($row->handicap_men)) ? 'readonly' : ''));
							
							echo form_input('handicap_men', set_value('handicap_men', $row->handicap_men), 'id="dip-men" class="form-control hiddenCustom" style="width:90%;display:inline-block;border: 1px solid #C5C5C5;"' . ((!is_numeric($row->handicap_men) && !empty($row->handicap_men)) ? '' : ''));
							
							 ?>
                            <div class="dropdown" style="width:6%;display:inline-block;vertical-align: top;">
                                <button id="dLabel" class="btn btn-default" style="padding: 9px 5px;" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                        class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dip-drpdwn" aria-labelledby="dLabel" id="menDr">
                                    <li><span data-en="Enter Limit"><?php echo $this->lang->line('Enter Limit'); ?></span></li>
                              		<li><span data-en="Proficiency Certificate"><?php echo $this->lang->line('Proficiency Certificate'); ?></span></li>
                                    <li><span data-en="Handicap Certificate"><?php echo $this->lang->line('Handicap Certificate'); ?></span></li>
                                    <li><span data-en="No"><?php echo $this->lang->line('No'); ?></span></li>
                                </ul>
                            </div>

                        </div>
                        <div class="col-sm-4 nopd">
                          <?php echo $this->lang->line('Women'); ?>  <br/>
                            <?php 
							if($row->handicap_women=="No")
							  {
								 $selectVal1 = $this->lang->line('No'); 
							  }
							  else if($row->handicap_women=="Handicap Certificate")
							  {
								   $selectVal1 = $this->lang->line('Handicap Certificate'); 
							  }
							  else if($row->handicap_women=="Proficiency Certificate")
							  {
								   $selectVal1 = $this->lang->line('Proficiency Certificate'); 
							  }
							   else 
							  {
								 $selectVal1 =$row->handicap_men; 
							  }
							
							//echo form_dropdown('handicap_women', array_combine($newoptions, $type_options_n), $row->handicap_women, 'id="dip-women" class="form-control"');
							
							echo form_input('handicap_women_1', set_value('handicap_women', $selectVal1), 'id="dip-women_1" class="form-control" style="width:85%; font-size:12px; display:inline-block;border: 1px solid #C5C5C5;"' . ((!is_numeric($row->handicap_women) && !empty($row->handicap_women)) ? 'readonly' : ''));
							echo form_input('handicap_women', set_value('handicap_women', $row->handicap_women), 'id="dip-women"class="form-control hiddenCustom" style="width:90%;display:inline-block;border: 1px solid #C5C5C5;"' . ((!is_numeric($row->handicap_women) && !empty($row->handicap_women)) ? '' : '')); ?>
                            <div class="dropdown" style="width:6%;display:inline-block;vertical-align: top;">
                                <button id="dLabel" class="btn btn-default" style="padding: 9px 5px;" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                        class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dip-drpdwn" aria-labelledby="dLabel" id="womenDr">
                                    <li><span data-en="Enter Limit" ><?php echo $this->lang->line('Enter Limit'); ?></span></li>
                                    <li><span data-en="Proficiency Certificate"><?php echo $this->lang->line('Proficiency Certificate'); ?></span></li>
                                    <li><span data-en="Handicap Certificat"><?php echo $this->lang->line('Handicap Certificate'); ?></span></li>
                                    <li><span data-en="No"><?php echo $this->lang->line('No'); ?></span></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <style>
					.form-control.hiddenCustom{position: absolute;
					visibility: hidden;
					}
					</style>
                    <script>
				$(document).ready(function(){


					/*$( "#dip-men, #dip-women" ).change(function() {
						var val_ue = $(this).val();
						var text = $('option:selected', $(this)).text();						  
						var id = $(this).attr("id");
						  
						if(id=="dip-men")
						{
							$('#dip-women option[value="'+val_ue+'"]').prop('selected', true);  
							$('#dip-women').next().find('span').last().text(text);
						}
						else
						{
							$('#dip-men option[value="'+val_ue+'"').prop('selected', true);  
							$('#dip-men').next().find('span').last().text(text);
						}
					});*/
					
					$('#womenDr li span,#menDr li span').click(function(e) {
                        e.preventDefault();
						var EnText = $(this).attr('data-en');
						var transText = $(this).text();
						$('#dip-women,#dip-men').val(EnText);
						$('#dip-women_1,#dip-men_1').val(transText);
						if(EnText == 'Enter Limit'){
							$('#dip-men,#dip-women').removeClass('hiddenCustom');
							$('#dip-men,#dip-women').val('');
							$('#dip-men,#dip-women').removeAttr( "readonly" );
							$('#dip-men_1,#dip-women_1').addClass('hiddenCustom');
						} else {
							$('#dip-men_1,#dip-women_1').prop('readonly',true);
							$('#dip-men,#dip-women').addClass('hiddenCustom');
							$('#dip-men_1,#dip-women_1').removeClass('hiddenCustom');
						}
					});
					
                   // $('#dip-men_1,#dip-women_1').removeAttr("readonly");

					var defaultTxt = $('#dip-men_1').val();
					var editValueMen = $('#dip-men').val();
					var editValueWomen = $('#dip-women').val();

                    if((editValueMen != "Proficiency Certificate")&&(editValueMen != "Handicap Certificate")&&(editValueMen != "No"))
                     {
                        $('#dip-men_1,#dip-women_1').removeAttr("readonly");
                     }
					/*$('#dip-men_1').val(editValueMen);
					$('#dip-women_1').val(editValueWomen);*/
					if(defaultTxt == 'Enter limit'){
						var liTxt  = $("#menDr li span").attr('data-en');
						if(liTxt == "Enter Limit"){
							var trLang = $("#menDr li span").text();
                            alert(trLang);
							$('#dip-men_1,#dip-women_1').val(trLang);
						}
					}
					
					$('#dip-women_1,#dip-men_1').keyup(function(e) {
						var $this = $(this).val();
						var id = $(this).attr('id');
						var nextInput = id.split('_');
						$('#'+nextInput[0]).val($this);
					});
					
                        /*function change_handicap(type, category) {
                            switch (type) {
                                case 1:
                                    $('#dip-men, #dip-women').each(function () {
                                        $(this).val('');
                                        $(this).attr('readonly', false);
                                    });
                                    if (category == undefined) {
                                        category = 'men';
                                    }
                                    $('#dip-' + category).focus();
                                    break;
                                case 2:
                                    $('#dip-men, #dip-women').each(function () {
                                        $(this).val('Proficiency Certificate');
                                        $(this).attr('readonly', true);
                                    });
                                    break;
                                case 3:
                                    $('#dip-men, #dip-women').each(function () {
                                        $(this).val('No');
                                        $(this).attr('readonly', true);
                                    });
                                    break;
                                case 4:
                                    $('#dip-men, #dip-women').each(function () {
                                        $(this).val('Handicap Certificate');
                                        $(this).attr('readonly', true);
                                    });
                                    break;
                            }
                        }*/
                        <?php if(!isset($row->handicap_men)){
                          //echo "change_handicap(3);";
                        } ?>
                        <?php if(!isset($row->handicap_women)){
                          //echo "change_handicap(3);";
                        } ?>

                     }); 
                    </script>
                    <style>
                        .dip-drpdwn {
                            left: auto;
                            right: 0;
                            width: 240px;
                            border: 1px solid #66afe9;
                            -webkit-border-radius: 0;
                            border-radius: 0;
                            padding: 2px;
                            webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
                            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(102, 175, 233, 0.6);
                        }

                        .dip-drpdwn span, .dip-drpdwn span:hover {
                            font-size: 0.9em;
                            background: none;
                            border: none;
                            color: #000;
                            text-align: left;
                            padding: 5px 10px;
                            width: 100%;
                            display: block;
                            cursor: pointer;
                        }

                        .dip-drpdwn span:hover {
                            background: #66AFE9;
                            padding: 5px 10px;
                        }
                    </style>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipWelcome"><?php echo $this->lang->line('VisitorWelcome'); ?></label>

                        <div class="col-sm-6 nopd">

                            <?php

                            $welcome_optionss = array($this->lang->line('Everyday'),$this->lang->line('On request'),$this->lang->line('By invitation only'),$this->lang->line('Members only'),$this->lang->line('Members & their guests only'),$this->lang->line('Hotel & members guest only'));

                                        
                             echo form_dropdown('welcome_option', array_combine($welcome_options, $welcome_optionss), $row->welcome_option, 'id="dipWelcome" class="form-control"'); ?>

                            <div id="dipWelcomeSubOption"
                                 style="background:#eee;padding:5px;border-radius:8px;<?php if (isset($row->welcome_option) && $row->welcome_option != 'Everyday') {
                                     echo 'display:none;';
                                 } ?>">

                                 <?php echo $this->lang->line('exceptthefollowingdays'); ?>


                                <?php

                                 $weekdayss = array($this->lang->line('Monday'),$this->lang->line('Tuesday'),$this->lang->line('Wednesday'),$this->lang->line('Thursday'),$this->lang->line('Friday'),$this->lang->line('Saturday'),$this->lang->line('Sunday'),$this->lang->line('Public Holidays'));

                                 echo form_multiselect('welcome_option2[]', array_combine($weekdays, $weekdayss), $row->welcome_option2, 'id="dipWelcome2" '); 
                                 

                                 ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="dipOpen"><?php echo $this->lang->line('OpeningSeason'); ?></label>

                        <div class="col-sm-8 form-inline dip-form-tab nopd" id="dip-grang">

                            <!--opening options-->
                            <label><?php echo form_radio('opening_opt', '1', ($row->open_from != 'Weather dependent' ? true : false), 'style="width:auto;" onclick="change_opening(1)"'); ?>
                              <?php echo $this->lang->line('Date'); ?>  </label>
                            <label><?php echo form_radio('opening_opt', '2', ($row->open_from == 'Weather dependent' ? true : false), 'style="width:auto;" onclick="change_opening(2)"'); ?>
                               <?php echo $this->lang->line('Weatherdependent'); ?>  </label>

                            <div id="dipOpen1" <?php echo($row->open_from == 'Weather dependent' ? 'style="display:none;width:350px !important;"' : 'width:350px !important;'); ?>>
							<?php echo $this->lang->line('From'); ?> <?php echo form_input('open_from', set_value('open_from', $row->open_from), 'class="form-control dipDate" placeholder="" style="display:inline-block;width:130px;" required ' . ($row->open_from == 'Weather dependent' ? 'disabled' : '')); ?>
                             <?php echo $this->lang->line('To'); ?>  <?php echo form_input('open_to', set_value('open_to', $row->open_to), 'class="form-control dipDate" required placeholder="" style="display:inline-block;width:130px;"' . ($row->open_from == 'Weather dependent' ? 'disabled' : '')); ?>
 			 </div>
                        </div>
                    </div>
                    <script>
                        function change_opening(type) {
                            if (type == 1) {
                                $('#dipOpen1').show();
                                $('#dipOpen1 input').val('').attr('disabled', false);
                            }
                            if (type == 2) {
                                $('#dipOpen1').hide();
                                $('#dipOpen1 input').attr('disabled', true);
                            }
                        }
                    </script>
                </fieldset>
            </div>
            <div class="col-sm-5">
                <fieldset>
                    <legend><?php echo $this->lang->line('CourseRatingandSlope'); ?></legend>
                    <?php foreach ($ratings as $key => $value): ?>
                        <div class="dip-rating">
                            <i class="fa fa-circle" style="color:<?= $value; ?>;"></i>

                            <div class="">
                                <label for="dipCR<?= $value; ?>"><?php echo $this->lang->line(' CourseRating'); ?></label>
                                <?php echo form_input('cr[' . $key . ']', set_value('cr[' . $key . ']', (isset($row->cr[$key]) ? $row->cr[$key] : '')), 'class="form-control" id="dipCR' . $value . '" placeholder="000"'); ?>
                            </div>
                            <div class="">
                                <label for="dipSlope<?= $value; ?>"><?php echo $this->lang->line('Slope'); ?></label>
                                <?php echo form_input('slope[' . $key . ']', set_value('slope[' . $key . ']', (isset($row->slope[$key]) ? $row->slope[$key] : '')), 'class="form-control" id="dipSlope' . $value . '" placeholder="000"'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </fieldset>
            </div>
        </div>
        <style>
            .dip-rating {
                padding: 5px;
                background: #F3F3F3;
                margin-bottom: 5px;
                -webkit-border-radius: 8px;
                border-radius: 8px;
            }

            .dip-rating i {
                font-size: 1.4em;
                vertical-align: sub;
                text-shadow: 0 0 1px black;
                width: 5%;
                display: inline-block;
                margin: 0 2.5%;
            }

            .dip-rating > div {
                width: 40%;
                display: inline-block;
            }
        </style>
        <br/>
    </div>
    <div class="dip-form-foot text-center">
        <?php echo form_submit('submit',$this->lang->line('save') , 'class="btn btn-success"'); ?>&nbsp;
        <a href="<?php echo site_full_url('golfclub/nexttee/courses'); ?>" class="btn btn-default"><?php echo $this->lang->line('Cancel'); ?></a>
    </div>
    <!-- </form> -->
    <?php echo form_close(); ?>
</section>
<style>
    @media (min-width: 768px) {
        .form-group div.nopd {
            padding: 0 2px;
        }
    }

    button.ui-multiselect {
        height: 35px;
        overflow-y: hidden;
        line-height: 1.5;
    }

    #ui-datepicker-div {
        z-index: 10000 !important;
    }

    #ui-datepicker-div .ui-datepicker-year {
        display: none;
    }

    .chk-fac img {
        width: 50%;
        float: right;
        max-width: 60px;
    }
</style>
<script>
    $(document).ready(function () {
        $("select:not([multiple])").multiselect({
            multiple: false,
            header: "<?php echo $this->lang->line('Select an option'); ?>",
            noneSelectedText: "Select",
            selectedList: 1,
        });
        $('#dipWelcome').multiselect({
            click: function (event, ui) {
                if (ui.value == 'Everyday') {
                    $('#dipWelcomeSubOption').show();
                } else {
                    $('#dipWelcomeSubOption').hide();
                }
            },
        });
        $("#dipWelcome2").multiselect({
				checkAllText: "<?php echo $this->lang->line('Check all'); ?>",
				uncheckAllText: "<?php echo $this->lang->line('Uncheck all'); ?>",
				noneSelectedText: "<?php echo $this->lang->line('Select options'); ?>",
				selectedText: "<?php echo $this->lang->line('# selected'); ?>"	
		});
        $('.dipDate').datepicker({
            dateFormat: 'dd MM'
        });
		

		//************On Button Click**************//	  
	   $('.btn-success').click(function(){
		   var count = 0;
		   var dipHoles = $('#dipHoles').val();
		   var dipPar = $('#dipPar').val();
		   var dipLength = $('#dipLength').val();
		   var open_from = $('input[name="open_from"]').val();
		   var open_to = $('input[name="open_to"]').val();
		   
		  $(".dip-form input").each( function(){			  
			  var rel = $(this).attr('rel');
			  var title = $('.dip-form #dipName'+rel).val();
			  var val = $(this).val(); 
			  
			  if(($(this).prop('required'))&&(val== "")){
				  count++;		  
		     }
		   
		   	   // if(title == ""){
					// $('.dip-form #dipName'+rel).css('border-color','red'); 
				//	 $('.dip-form #dipName'+rel).attr('required', true);
			  // } else {
				  if(title == "" && rel == '<?php echo $client->default_language;?>'){
					  	$('.dip-form #dipName'+rel).css('border-color','red');
				  } else {
					  $('.dip-form #dipName'+rel).css('border-color','#bbb'); 	
				  }
			  // } 	
			   
			   if(dipHoles==""){
			   	  $('.dip-form-body #dipHoles').css('border-color','red'); 
			   } else {
			      $('.dip-form-body #dipHoles').css('border-color','#bbb'); 	
			   }
			   if(dipPar==""){
			   	  $('.dip-form-body #dipPar').css('border-color','red'); 
			   }else {
			      $('.dip-form-body #dipPar').css('border-color','#bbb'); 	
			   }
			   if(dipLength==""){
			   	  $('.dip-form-body #dipLength').css('border-color','red'); 
			   }else {
			      $('.dip-form-body #dipLength').css('border-color','#bbb'); 	
			   }
			   if(open_to == ""){
				  $('#dipOpen1 input[name="open_to"]').css('border-color','red'); 	
				  $('.error_msg').css('display','block');
			   }else {
			      $('#dipOpen1 input[name="open_to"]').css('border-color','#bbb'); 	
			   }
			   if(open_from == ""){
				  $('#dipOpen1 input[name="open_from"]').css('border-color','red'); 
				  $('.error_msg').css('display','block');
			   }else {
			      $('#dipOpen1 input[name="open_from"]').css('border-color','#bbb'); 	
			   }
			   			   		   
	      });
			if(count > 0){
				$('.error_msg').css('display','block') //to show
			} else {
			  	$('.error_msg').css('display','none') //to hide		
			}
	   }); 	 
 });	
</script>
