 <?php
  session_start();
  $_SESSION["cnt"]=5;
  $_SESSION["lang1"]=NULL;

?>
<section class="dip-dash-sec">
          <h3><?php echo $page['desc']; ?></h3>
    <div class="row dip-form-body">
      <div class="col-sm-12">
        <?php echo form_open_multipart(current_full_url(), 'id="uploadExcel" class="dip-form form-horizontal"');?>
        <h4>Import From Spreadsheet</h4>
        <div>
          <div class="row">
            <div class="col-sm-6">
              <div class="btn btn-block btn-file">
                  <span>.xls, .xlsx or .csv</span>
                  <input id="uploadFile3" type="file" name="userfile" size="20" onchange="alertFilename(3)" />
              </div>
            </div>
            <div class="col-sm-6">
              <?php echo form_submit('submit', 'Upload','class="btn btn-success"'); ?>&nbsp;
              <a href="<?php echo site_url('samples/golfclubs_sample.xls');?>" class="btn btn-warning">Download Sample file</a>
            </div>
          </div>
        </div>
        <?php echo form_close();?>
        <div class="row">
          <div class="col-sm-7">

            <?php if($grid=='golfclubs'): ?>
              <a href="<?php echo site_url('master/manageusers/golfclub');?>" class="btn btn-success" >Add New Golf Club</a>&nbsp;
              <a type="button" class="btn btn-danger" href="javascript:void(0)" onclick="delet_selected_item()" id="m1">Delet Selected</a>
              <a type="button" class="btn btn-danger" href="javascript:void(0)" onclick="delet_all_item()" id="m1">Delet All</a>
              <button class="btn btn-warning" onclick="toggleUpload()">Import</button>
            <?php else: ?>
              <a href="<?php echo site_url('master/manageusers/golfgroup');?>" class="btn btn-success" >Add New Golf Group</a>
            <?php endif; ?>            
          </div>
          <div class="col-sm-5 form-inline text-right">
            <?php if($grid=='golfclubs'): ?>
              <select class="form-control" id="muLevel" onchange="doSearch(arguments[0]||event)">
                <option>Select Level</option>
                <?php foreach($user_levels as $k => $v){ echo '<option value="'.$k.'">'.$v.'</option>';} ?>
              </select>
            <?php endif; ?>
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
<style>
#uploadExcel{
  margin: 5px 0;
  display: none;
  box-shadow: 0 0 5px #D0D0D0;
  border: 1px solid #4EA500;
    background-color: rgba(78, 165, 0, 0.3);
}
#uploadExcel.shown{
  display: block;
}
#uploadExcel > h4{
padding: 5px 20px;
    margin: 0;
    color: #000000;
    border-bottom: 1px solid rgba(197, 184, 165, 0.15);
}
#uploadExcel >div{
padding: 20px;
}
.btn-file,.btn-file:hover {
    position: relative;
    overflow: hidden;
    border: 2px dashed #396BD6;
    color: #396BD6;
    padding: 6px 15px;
    background: #fff;
}
.btn-file:hover,.btn-file.selected{
  background: #EFF4FF;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<script>
function alertFilename(id){
    var $el = $('#uploadFile'+id);
    $el.parent().find('span').html($el.val().replace(/.*(\/|\\)/, ''));
    $el.parent().addClass('selected');
}
function toggleUpload(){
  $( "#uploadExcel" ).toggleClass( "shown" );
}
</script>
