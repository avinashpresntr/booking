<section class="dip-dash-sec">
  <h3><?=$page['desc'];?></h3>

  <?php echo form_open(current_full_url(), 'class="dip-form form-horizontal"');?>
    <?php echo get_msg();?>
    <div class="row dip-form-body">
      <div class="col-sm-6">
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipHotelName">Name *</label>
            <div class="col-sm-8">
              <?php echo form_input('name', set_value('name',$master['name']), 'class="form-control" id="dipName" placeholder="Name"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUserName">Username *</label>
            <div class="col-sm-8">
              <?php echo form_input('username', set_value('username',$master['username']), 'class="form-control" id="dipUsername" placeholder="Username"');?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="dipUserName">Password *</label>
            <div class="col-sm-8">
              <?php echo form_input('password', set_value('password',$master['password']), 'class="form-control" id="dipPassword" placeholder="Password"');?>
            </div>
          </div>
      </div>
    </div>

    <div class="dip-form-foot text-center">
      <?php echo form_submit('submit', 'Save','class="btn btn-success"'); ?>&nbsp;
      <?php echo form_reset('reset', 'Cancel','class="btn btn-default"'); ?>
    </div>
  <!-- </form> -->
  <?php echo form_close();?>
</section>