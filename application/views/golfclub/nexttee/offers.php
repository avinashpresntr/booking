<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <?php echo get_msg(); ?>
        <div class="row">
          <div class="col-sm-7">
            <a href="<?php echo site_full_url('golfclub/nexttee/edit_offers');?>" class="btn btn-success"><?php echo $this->lang->line('AddNewOffer'); ?></a>
          </div>
          <div class="col-sm-5 form-inline text-right">
            <input  class="form-control" type="text" id="muSearch" onkeydown="doSearch(arguments[0]||event)" placeholder="Search"/>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <br/>
        <table id="dipgrid"></table>
        <div id="pager"></div>
        <br/>
        <br/>
      </div>
    </div>
</section>
