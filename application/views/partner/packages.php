<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-7">
            <a type="button" class="btn btn-success" href="<?php echo site_full_url('partner/packages/edit');?>">
<?php if($user['type']==6) {
  echo $this->lang->line('AddSuggestion');
}else{
  echo  $this->lang->line('AddNewPackage') ;
}?>
            </a> 
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
