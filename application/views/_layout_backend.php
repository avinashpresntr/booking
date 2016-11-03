<style>
.dip-cover .dip-viewedas {
  padding: 8px 10px;
  margin-right: 0;
  height: 60px;
  margin-left: 10px;
}
.dip-cover .dip-upgrade {
    background: rgb(102, 169, 80);
    padding: 8px 20px;
    border-radius: 0 5px 5px 0;
    color: white;
    font-size: 1.1em;
    text-align: center;
    position: relative;
    height: 60px;
    border-radius:5px;
}
.dip-cover .dip-upgrade-btn:before{
  content: "";
  position: absolute;
  top: 0;left: 0;
  display: block;
  border-top: 30px solid transparent;
  border-bottom: 30px solid transparent;
  border-left: 30px solid rgb(23, 103, 224);
}
.dip-cover .dip-upgrade-btn{
  background: rgb(224, 60, 23);
  position: absolute;
  font-size: 1em;
  top: 0;right: 0;
  display: block;
  height: 100%;
  border: none;
  padding-left: 40px;
 border-radius: 0 5px 5px 0;
}

.dip-prices{
  padding-top: 20px;
  background: #0D111F;
  color: #FFF;
  border-top: 1px solid #444A42;
}
.dip-prices table{
    border-collapse: initial;
    border-spacing: 6px;
    color:white;
    font-size: 1em;
    margin-bottom: 0px;
}
.dip-prices table td{
  text-align: center;
  width: 12.5%;
  vertical-align: middle;
  font-size: 0.9em;
  -webkit-border-radius: 2px;
          border-radius: 2px;
}
.dip-prices table td a{
  color: #FFF;
  position: relative;
  text-decoration: none;
  font-weight: bold;
  display: block;
  height: 100%;
  width: 100%;
  padding: 10px 30px 10px 10px;
}
.dip-prices table td a i{
    position: absolute;
    top: 50%;
    margin-top: -7px;
    right: 10px;
}
table a:not(.btn), .table a:not(.btn){text-decoration: none;}
.dip-prices .table>tbody>tr>td{
  padding: 2px 8px;
  vertical-align: middle;
}
.dip-prices .table>tbody>tr>td.blink_me2{
  padding: 0;
}
.dip-prices table td.big{font-size: 1.2em;    font-weight: bold;}
.dip-prices table td.sbig{font-size: 1.05em;    font-weight: bold;}
.dip-prices table td.cap{text-transform: uppercase;font-family: verdana,arial,sans-serif;}
.price-aside{
  color: #aaa;
  padding:0 10px;
}
.dip-cover {
    background: url(<?php echo site_url('assets/img/top-strip.jpg');?>) 100% #531d12;
    background-size: cover;
}
.dip-cover:before {
  display: none;
}
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: rgba(238, 238, 238, 0.69);}
.ui-priority-secondary, .ui-widget-content .ui-priority-secondary, .ui-widget-header .ui-priority-secondary {
    background: rgba(228, 228, 228, 0.5);
    opacity: 1;
}
.dip-sidebar li a{
  position: relative;
}
.dip-sidebar li a.inactive,.dip-subnav .btn.disabled{
  color: #000;
  background: rgb(214, 220, 208);
  cursor: not-allowed;
}
.dip-icon{
  position: absolute;
  right: 0;
}
/*.dip-subnav .btn{
  margin-right: 5px;
  -webkit-border-radius: 5px 5px 0 0;
          border-radius: 5px 5px 0 0;
}*/
.dip-subnav .btn:hover{
  background: #4EA500;
  color: #fff;
}

#formUpgrade label.error {
float:left;
margin:0;
color:red;
}

</style>


<section class="dip-cover">
  <div class="container">
    <div class="dip-row">
      
      <div class="dip-col-12">
        
        <!-- logged in as -->
        <?php if($user['type'] != $session['type']):?>
          <div class="dip-viewedas fl-r"><small>logged as</small><br/><big><?= $user_types[$session['type']];?></big></div>
        <?php endif; ?>
        
        <!--upgrade -->
        <?php if($user['level'] < 3  && $user['type'] == 2):?>
          <?php  $clr=array('#28b62c','#75caeb','#ff4136','#ff851b'); ?>
          <div class="dip-upgrade fl-r " style="background-color:<?php echo $clr[$user['level']]; ?>">

        <?php echo $this->lang->line('Currentlyyouare'); ?>    <br/> <?=strtoupper($user_levels[$user['level']]);?>  <?php echo ' '.$this->lang->line('member'); ?>
          </div>
        <?php endif; ?>



        <h2><?php echo $user['name']; ?></h2>
        <p><?php 
        if($user['type']==2)
          echo 'Golf Club';
        else
          echo $user_types[$user['type']];
        ?> | <?php echo $this->lang->line('welcome'); ?></p>
      </div>
    </div>
  </div>
</section>

<?php if($user['level'] < 3  && $user['type'] == 2):?>
<section class="dip-prices">
  <div class="container">
    <div class="dip-row">
      <table class="table">
        <?php if($user['level'] < 1): ?>
        <tr>
            <td class="big cap <?php echo($user['level']==0 ?'blink_me':''); ?>" bgcolor="<?=$clr[0];?>"><?php echo $this->lang->line('Bronze'); ?></td>
            <td bgcolor="<?=$clr[0];?>"><?php echo $this->lang->line('GolfClubPresentation'); ?></td>
            <td bgcolor="<?=$clr[0];?>"><?php echo $this->lang->line('1specialoffer'); ?></td>
            <td class="big cap" bgcolor="<?=$clr[0];?>"><?php echo $this->lang->line('Free'); ?></td>
        </tr>
        <?php endif; ?>
        <?php if($user['level'] < 2): ?>
        <tr>
            <td class="big cap <?php echo($user['level']==1 ?'blink_me':''); ?>" bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('Silver'); ?></td>
            <td bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('GolfClubPresentation'); ?></td>
            <td bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('nt_events_option'); ?></td>
            <td bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('1specialoffer'); ?></td>            
            <td bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('1Loyaltyprogram'); ?> </td>
            <td class="big cap" bgcolor="<?=$clr[1];?>"><?php echo $this->lang->line('e250'); ?><sup>€</sup>/<?php echo $this->lang->line('Year'); ?></td>
			<?php if($user['level'] < 1): ?>
            	<td class="sbig blink_me2" bgcolor="<?=$clr[1];?>"><a href="#" data-subject="Upgrade Request to Silver Membership" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('RequestUpgrade'); ?> <i class="fa fa-chevron-right"></i></a></td>
            <?php endif; ?>
        </tr>
        <?php endif; ?>
        <?php if($user['level'] < 3): ?>
        <tr>
          <td class="big cap <?php echo($user['level']==2 ?'blink_me':''); ?>" bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('Gold'); ?></td>
          <td bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('GolfClubPresentation'); ?></td>
          <td bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('nt_events_option'); ?></td>
          <td bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('2Specialoffers'); ?></td>          
          <td bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('2Loyaltyprograms'); ?></td>
          <td bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('4PushNotificationspermonth'); ?></td>
          <td class="big cap" bgcolor="<?=$clr[2];?>"><?php echo $this->lang->line('e500'); ?><sup>€</sup>/<?php echo $this->lang->line('Year'); ?></td>
          <?php if($user['level'] < 2): ?>
          <td class="sbig blink_me2" bgcolor="<?=$clr[2];?>"><a href="#" data-subject="Upgrade Request to Gold Membership" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('RequestUpgrade'); ?> <i class="fa fa-chevron-right"></i></a></td>
          <?php endif; ?>
        </tr>
        <?php endif; ?>
        <tr>
          <td class="big cap <?php echo($user['level']==3 ?'blink_me':''); ?>" bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('Platinium'); ?></td>
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('GolfClubPresentation'); ?></td>
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('nt_events_option'); ?></td>
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('UnlimitedSpecialoffers'); ?></td>
        
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('UnlimitedLoyaltyprograms'); ?></td>
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('UnlimtedPushnotifications'); ?> </td>
          <td bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('YourGolfClubMobileAppAndroidandiOS'); ?>*</td>
          <td class="big cap" bgcolor="<?=$clr[3];?>"><?php echo $this->lang->line('e1400'); ?><sup>€</sup>/<?php echo $this->lang->line('Year'); ?></td>
          <td class="sbig blink_me2" bgcolor="<?=$clr[3];?>"><a href="#" data-subject="Upgrade Request to Platinium Membership" data-toggle="modal" data-target="#myModal"><?php echo $this->lang->line('RequestUpgrade'); ?> <i class="fa fa-chevron-right"></i></a></td>
        </tr>
      </table>
      <p class="price-aside">* <?php echo $this->lang->line('GolfClubMobileAppforAndroidsmartphones'); ?> </p>
    </div>
  </div>
</section>
<?php endif; ?>
<section class="dip-breacumb">
  <div class="container">
    <div class="dip-row">
      
      <div class="dip-col-12 clearfix" style="padding: 5px 0;">
        <div class="dip-tools fl-r">
          <?php if($user['type'] == $session['type']): ?>
          <a href="<?php echo site_url('logout'); ?>" Class="dip-logout btn btn-info" type="button"><i class="fa fa-power-off"></i> <span><?php echo $this->lang->line('LogOut'); ?></span></a>
          <?php endif; ?>
        </div>
        <a  type="button" class="btn btn-link" id="dip-toggle-sidebar">
        <i class="fa fa-arrow-circle-o-right"></i>
        </a> 
        <big><?=$page['title']; ?></big> > <small><?=$page['desc']; ?></small>
      </div>
    </div>
  </div>
</section>
<section class="dip-dashboard sidebar-off">
  <div class="container">
    <div class="dip-row">
      <div class="dip-col-l">
        <?php echo get_sidebar($nav,$page['nav'],$user['type'],$session['type']);?>
      </div>
      <div class="dip-col-r">
        <?php if (isset($page['subnav'])) {echo get_subnav($page['subnav']);}?>
        <div class="dip-dash">
          <?php if(!empty($page['subview'])){$this->load->view($page['subview']);} ?>
        </div>
      </div>
    </div>
  </div>
</section>


<?php if($user['level'] < 3  && $user['type'] == 2):?>
<!-- Default bootstrap modal example -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="formUpgrade" class="dip-form form-horizontal" method="post" action="">
      <div class="modal-header" style="border-radius: 3px 3px 0 0;background:rgb(40, 182, 44);">
        <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center" id="myModalLabel" style="color:white;"><?php echo $this->lang->line('UpgradeRequestForm'); ?></h4>
      </div>
      <div class="modal-body">
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpName"><?php echo $this->lang->line('GolfClub'); ?></label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_input('up_name', set_value('up_name',$user['name']), 'class="form-control" id="dipUpName" placeholder="'.$this->lang->line('Nameofyourgolfclub').'" readonly');?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpSubject"><?php echo $this->lang->line('Subject'); ?></label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_input('up_subject', set_value('up_subject'), 'class="form-control" id="dipUpSubject" placeholder="'.$this->lang->line('Subject').'" readonly');?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpSender"><?php echo $this->lang->line('Name'); ?>*</label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_input('up_sender', set_value('up_sender'), 'class="form-control" id="dipUpSender" placeholder="'.$this->lang->line('YourName').'" data-validation="required" data-validation-error-msg="'.$this->lang->line('PleaseenteryourName').'"');?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpEmail"><?php echo $this->lang->line('Email'); ?>*</label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_input('up_email', set_value('up_email'), 'class="form-control" id="dipUpEmail" placeholder="'.$this->lang->line('Youremail').'" data-validation="required email" data-validation-error-msg="'.$this->lang->line('PleaseenteryourEmail').'"');?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpPhone"><?php echo $this->lang->line('Phone'); ?></label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_input('up_phone', set_value('up_phone'), 'class="form-control" id="dipUpPhone" placeholder="'.$this->lang->line('Phone').'" ');?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-xs-5 col-sm-3 control-label" for="dipUpMessage"><?php echo $this->lang->line('Message'); ?>*</label>
            <div class="col-xs-7 col-sm-9">
              <?php echo form_textarea(array('name'=>'up_msg','rows'=>'3'), set_value('up_msg'), 'class="form-control" id="dipUpMessage" placeholder="" ');?>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div id="sending_img" style="float:left;display:none;"><img height="10" src="<?php echo site_url('assets/img/loading.gif');?>" alt="sending.."/></div>
        <div id="error_msg" style="float:left;"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('Cancel'); ?></button>
        <input type="submit" id="dipUpSubmit" class="btn btn-success"  value="<?php echo $this->lang->line('Send'); ?>">
        <!-- <button id="dipUpSubmit" type="button" class="btn btn-success" onclick="return sendRequest(this.form)">Send</button> -->
      </div>
    </div>
    </form>
  </div>
</div>


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>

<script>
$.validate({
    form : '#formUpgrade',
    onSuccess : function($form) {
      $('#sending_img').show();
      $("#error_msg").find('p').hide();
      var formData = $('#formUpgrade').serialize();
      $.post("<?php echo site_full_url('golfclub/mailer');?>", formData).done(function(data){
          var html;
          var data = jQuery.parseJSON(data);
          if (data.error) {
            html = '<p style="color:red;">'+ data.error.message + '</p>';
            $('#sending_img').hide();
            $('#error_msg').html(html);
            setTimeout(function() { $("#error_msg").find('p').fadeOut(1500); }, 5000);
          }else{
            html = '<p style="color:green;">A request has been made successfuly</p>';
            $('#sending_img').hide();
            $('#error_msg').html(html);
            setTimeout(function() { 
              $("#error_msg").find('p').fadeOut(1500);
              $('#myModal').modal('hide');
            }, 500);
          };
      });
      return false; // Will stop the submission of the form
    }
});


// Fill modal with content from link href
$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find("#dipUpSubject").val(link.data("subject"));
});
$(document).ready(function(){
  // form validation
  
});
</script>
<?php endif; ?>

<?php if($user['level'] < 3  && $user['type'] == 2):?>
<script>
function blinker() {
    $('.blink_me').fadeOut(500);
    $('.blink_me').fadeIn(500);
}
$('.blink_me').on('hover', function(event) {
  $('.blink_me').removeClass('blink_me');
});
setInterval(blinker, 2000);
</script>
<?php endif; ?>

