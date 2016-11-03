<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-5 form-inline">
            <input  class="form-control" type="text" id="muSearch" onkeydown="doSearch(arguments[0]||event)" placeholder="<?php echo $this->lang->line('Search'); ?> "/>
            <select class="form-control" id="muLevel" onchange="doSearch(arguments[0]||event)">
              <option><?php echo $this->lang->line('SelectCategory'); ?> </option>
              <?php foreach(array_slice($user_types,3,4,true) as $k => $v){ echo '<option value="'.$k.'">'.$v.'</option>';} ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <br/>
        <table id="manageusers"></table>
        <div id="pager"></div>
        <br/>
        <br/>
      </div>
    </div>
</section>
