<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
          <?php echo form_open_multipart(current_full_url(), 'class="dip-form form-horizontal"');?>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-7">
            <a href="<?php echo site_full_url('golfclub/courses/edit');?>" class="btn btn-success"><?php echo $this->lang->line('AddNewCourse'); ?></a>
          </div>
          <div class="col-sm-5 form-inline text-right">
            <input  class="form-control" type="text" id="muSearch" onkeydown="doSearch(arguments[0]||event)" placeholder="<?php echo $this->lang->line('Search'); ?>"/>
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
