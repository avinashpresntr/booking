<div class="row">
        <div class="col-sm-12">
          
          <?php 
          $total_push = $client->push_notification;
          $used_push = $client->push_counter;
          if($total_push<$used_push)
            $client->push_counter = $total_push;

          if($client->push_notification - 1 == $client->push_counter){
            $state = 'warning';
            $msg = 'You have just 1 Push Notification left.';
          }elseif($client->push_notification > $client->push_counter){
            $push_left = $client->push_notification - $client->push_counter;
            $state = 'success';
            $msg = 'You have '.$push_left.' Push Notification left';
          }else{
            $state = 'danger';
            $msg = 'You have no Push Notification left.';
          }
          ?>
          <fieldset <?php if($state=='danger'){echo 'disabled';} ?>>
          <legend>Send Push Notifications:</legend>
          <div class="alert push-alert alert-<?=$state;?> text-center" role="alert">
              <h4>Push Notification Counter</h4>
              <!--<p>(<?=$client->push_counter;?> / <?=$client->push_notification;?>) : <?=$msg;?></p>-->
              <p>Total push per month <?=$client->push_notification;?> - used push <?=$client->push_counter;?> - remaining push <?=($client->push_notification - $client->push_counter);?></p>
          </div>
          <div class="row">
            <?php foreach ($client->languages as $key => $value):?>
              <div class="col-sm-4">
                <?php
                $default = '';
                if($value==$client->default_language){
                  $default = 'default';
                }?>
                <div class="dip-langbox <?=$default;?>">
                  <h5><?php echo $langs[$value];?> <i class="flag flag-<?php echo $langs[$value];?>" alt="<?php echo $langs[$value];?>"></i></h5>

                  <label class="control-label" for="dipPush<?=$value;?>">Push Notification Title</label>
                  <?php echo form_input('push['.$value.']', set_value('push['.$value.']'), 'class="form-control" id="dipPush'.$value.'" placeholder="Push Notification Title"');?>

                </div>
              </div>
            <?php endforeach; ?>
          </div>
          </fieldset>
        </div>
      </div>
<br/>