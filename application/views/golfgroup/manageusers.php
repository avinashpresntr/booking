<section class="dip-dash-sec">
  	<h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-5 form-inline">
              <select class="form-control" id="muLevel" onchange="doSearch(arguments[0]||event)">
                <option>Select Level</option>
                <?php foreach($user_levels as $k => $v){ echo '<option value="'.$k.'">'.$v.'</option>';} ?>
              </select>
            <input  class="form-control" type="text" id="muSearch" onkeydown="doSearch(arguments[0]||event)" placeholder="Search"/>
            <!-- <button  class="btn btn-default" onclick="gridReload()" id="submitButton">Search</button> -->
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