<?php
session_start();
$ajvc= $_SESSION["lang"].".js";
?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc);?>" type="text/javascript"></script>
<?php /*?><script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script><?php */?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script src="<?php echo site_url('assets/js/jquery.validate.js');?>" type="text/javascript"></script>


<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('partner/menu');?>";
var PAGE_URL_END = "";
<?php if($session['type'] <= 2):?>
PAGE_URL_END = "?user=<?=$user['id'];?>";
<?php endif;?>



var rateId = 0;
var ratesecId = 0;
var childGrid = '';

var $grid = $("#dipgrid");
$(document).ready(function () {
    var url = PAGE_URL_START+'/get_menu_sections'+PAGE_URL_END;
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:['<?php echo $this->lang->line('MenuSectionName'); ?>', '<?php echo $this->lang->line('Action'); ?>'],
        colModel:[
            {
                name:'name',
                index:'name',
                align:"left",
                sortable:false,
                formatter: formatJson
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'20',
                align:"center",
                formatter: formatAction1
            }
        ],
        rowNum:50,
        height:400,
        rowList:[10,20,50,100],
        pager: '#pager',
        sortname: 'position',
        viewrecords: true,
        autowidth: true,
        shrinkToFit: true,
        sortorder: "asc",
        subGrid: true,
        subGridRowExpanded: showChildGrid,
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_dipgrid"));
        }
    });
    $("#pager").before('<div class="dip-table-add" style="text-align:center;"><button type="button" class="btn btn-success btn-block" onclick="edit_parent_item(0)">+ <?php echo $this->lang->line('AddNewMenuSection'); ?></button> </div>' );
    $grid.jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        update_parent_position(id,position);
        // console.log(ui.item[0]);
    }});
});
function formatJson(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue);
    var dlang = <?=$client->default_language;?>;
    if(obj[dlang].length > 120){
        return obj[dlang].substr(0, 120)+'...';
    }else{
        return obj[dlang];
    }
};
function formatPrice(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue);
    var dlang = <?=$client->default_language;?>;
    var car = jQuery.parseJSON(rowObject.currency);
    if (car){
      return car[dlang]+' '+obj[dlang];
    }else{
      return obj[dlang];
    }
    
};
function formatAction1(cellValue, options, rowObject) {
    var up_btn = get_up_btn('onclick="update_parent_position('+cellValue+','+(parseInt(rowObject.position)-1)+');"');
    var down_btn = get_down_btn('onclick="update_parent_position('+cellValue+','+(parseInt(rowObject.position)+1)+');"');
    var e_btn = get_edit_btn('onclick="edit_parent_item('+cellValue+');"');
    var d_btn = get_delete_btn('onclick="delete_item('+cellValue+');"');
    return e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};

function showChildGrid(parentRowID, parentRowKey) {
    var childGridID = parentRowID + "_table";
    var childGridPagerID = parentRowID + "_pager";
    var template = '<div class="dip-table-add"><button type="button" class="btn btn-success btn-block" onclick="edit_child_item(\''+childGridID+'\','+parentRowKey+',0)">+ <?php echo $this->lang->line('AddNewMenuItem'); ?></button></div>';
    var childGridURL = PAGE_URL_START+'/get_menu_items/'+parentRowKey+PAGE_URL_END;
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>'+template);

    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:['Details','Price', 'Action'],
        colModel: [
            {
                name:'descr',
                index:'descr',
                align:"left",
                sortable:false,
                formatter: formatJson
            },
            {
                name:'price',
                index:'price',
                align:"center",
                width:'25',
                sortable:false,
                formatter: formatPrice
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'25',
                align:"right",
                formatter: formatAction2
            }
        ],
        // loadonce: true,
        height: '100%',
        rowNum: 500,
        sortname: 'position',
        sortorder: "asc",
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        autowidth: true,
        shrinkToFit: true,
        beforeRequest: function() {
          $("#gview_" + childGridID+' .ui-jqgrid-hdiv').hide();
        }
    });
    $("#" + childGridID).jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        var parent = parentRowKey;
        update_child_position(id,position,parent);
        // console.log(ui.item[0]);
    }});
}
function formatAction2(cellValue, options, rowObject) {
    var up_btn = get_up_btn('onclick="update_child_position('+cellValue+','+(parseInt(rowObject.position)-1)+','+rowObject.menu_section_id+');"');
    var down_btn = get_down_btn('onclick="update_child_position('+cellValue+','+(parseInt(rowObject.position)+1)+','+rowObject.menu_section_id+');"');
    var e_btn = get_edit_btn('onclick="edit_child_item(\'dipgrid_'+rowObject.menu_section_id+'_table\','+rowObject.menu_section_id+','+cellValue+');"');
    var d_btn = get_delete_btn('onclick="delete_child('+rowObject.menu_section_id+','+cellValue+');"');
    return e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};





//form operations
$(function(){
    // menu section form save
    $( "#basicForm" ).submit(function( event ) {
      var data = $(this).serializeArray();
      if(ratesecId != 0){
        var url = PAGE_URL_START+"/save_menu_section/"+ratesecId+PAGE_URL_END;
      }else{
        var url = PAGE_URL_START+"/save_menu_section"+PAGE_URL_END;
      }
      $.ajax({type: "POST", url: url,data:data, success: function(data) {
        if(data==1){
          $('#first_model').modal('hide');
          $grid.trigger('reloadGrid');
        }
      }});
      event.preventDefault();
    });
    // menu item form save
    $( "#childForm" ).submit(function( event ) {
      var data = $(this).serializeArray();
      if(rateId != 0){
        var url = PAGE_URL_START+"/save_menu_item/"+ratesecId+"/"+rateId+PAGE_URL_END;
      }else{
        var url = PAGE_URL_START+"/save_menu_item/"+ratesecId+PAGE_URL_END;
      }
      $.ajax({type: "POST", url: url,data:data, success: function(data) {
        if(data==1){
          $('#child_model').modal('hide');
          $('#'+childGrid).trigger("reloadGrid");
        }
      }});
      event.preventDefault();
    });
});
function edit_parent_item(no){
  if(no != 0){
    var url = PAGE_URL_START+"/get_menu_section/"+no+PAGE_URL_END;
    ratesecId = no;
  }else{
    var url = PAGE_URL_START+"/get_menu_section"+PAGE_URL_END;
    ratesecId = 0;
  }
  $.ajax({type: "GET", url: url, success: function(data) {
      var data = jQuery.parseJSON(data);
      $('#first_model').modal('show');
      // put the values to right places
      if(data.id != null){
        $.each( data.name, function( key, value ) {
          // console.log( key + ": " + value );
          $('#dipName'+key).val(value);
        });
      }else{
        $( "#first_model input[name^='name']").val('');
      }
  }});
}
function update_parent_position(id,pos){
  var url = PAGE_URL_START+"/position_menu_section"+PAGE_URL_END;
  $.ajax({type: "POST", data: {id:id, position:pos}, async: false, url: url, success: function(data) {
    console.log(data);
    $grid.trigger('reloadGrid');
  }});
}
function delete_item(id){
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete_menu_section"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id}, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");}
            }});
        }
    });
}
//for child items
function edit_child_item(childGridID,parent,no){
  if(no != 0){
    var url = PAGE_URL_START+"/get_menu_item/"+parent+'/'+no+PAGE_URL_END;
    rateId = no;
    ratesecId = parent;
  }else{
    var url = PAGE_URL_START+"/get_menu_item/"+parent+PAGE_URL_END;
    rateId = 0;
    ratesecId = parent;
  }
  $.ajax({type: "GET", url: url, success: function(data) {
      var data = jQuery.parseJSON(data);
      // console.log(data);
      $('#child_model').modal('show');
      // put the values to right places
      if(data.id != null){
        $.each( data.descr, function( key, value ) {
          // console.log( key + ": " + value );
          $('#dipDescr'+key).val(value);
        });
        $.each( data.price, function( key, value ) {
          // console.log( key + ": " + value );
          $('#dipPrice'+key).val(value);
        });
        $.each( data.currency, function( key, value ) {
          // console.log( key + ": " + value );
          $('#dipCurrency'+key).val(value);
        });
      }else{
        $( "#child_model input[name^='descr']").val('');
        $( "#child_model input[name^='price']").val('');
        $( "#child_model input[name^='currency']").val('');
      }
      childGrid = childGridID;
      // console.log(childGrid);
  }});
}
function update_child_position(id,pos,parent){
  var url = PAGE_URL_START+"/position_menu_item"+PAGE_URL_END;
  $.ajax({type: "POST", data: {id:id, parent:parent, position:pos}, async: false,url:url, success: function(data) {
    $('#dipgrid_'+parent+'_table').trigger('reloadGrid');
  }});
}
function delete_child(parent,id){
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete_menu_item"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id,parent:parent}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function() {
                       $('#dipgrid_'+parent+'_table').trigger('reloadGrid');
                    });
                }else{alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");}
            }});
        }
    });
}
$(document).ready(function () {
  $('#jqgh_dipgrid_name').css({
    'text-align': 'left'
  });
  $('#jqgh_dipgrid_name .s-ico').hide();
});
</script>


<style>
  /* page specific css */
  .dip-table-add .btn-block{
    color:#28B62C;
    background: #E7FFEB;
    -webkit-border-radius: 0;
            border-radius: 0;
    border: 2px dashed rgba(179, 203, 255, 0.33);
    padding: 5px;
  }
  .dip-table-add .btn-block:hover{
    background: rgb(202, 236, 171);
    color: black;
  }
  .ui-jqgrid .ui-subgrid td.subgrid-cell {
      background: rgb(102, 130, 75);
  }
  .ui-jqgrid .ui-subgrid td.subgrid-data{
    padding: 10px 0;
    background: rgb(102, 130, 75);
  }
</style>
