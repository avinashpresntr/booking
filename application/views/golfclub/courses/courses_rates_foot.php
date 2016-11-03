<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script src="<?php echo site_url('assets/js/jquery.validate.js');?>" type="text/javascript"></script>


<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('golfclub/courses');?>";
var PAGE_URL_END = "";
<?php if($session['type'] < 2):?>
PAGE_URL_END = "?user=<?=$user['id'];?>";
<?php endif;?>



var rateId = 0;
var ratesecId = 0;
var childGrid = '';
$(function(){
    // language dropdown
    $("#dipFacilities").multiselect();

    $( "#basicForm" ).submit(function( event ) {
      var data = $(this).serializeArray();
      if(ratesecId != 0){
        var url = PAGE_URL_START+"/save_rate_section/<?=$row->id;?>/"+ratesecId+PAGE_URL_END;
      }else{
        var url = PAGE_URL_START+"/save_rate_section/<?=$row->id;?>"+PAGE_URL_END;
      }
      $.ajax({type: "POST", url: url,data:data, success: function(data) {
        if(data==1){
          $('#first_model').modal('hide');
          $('#manageusers').trigger('reloadGrid');
        }
      }});
      event.preventDefault();
    });

    $( "#childForm" ).submit(function( event ) {
      var data = $(this).serializeArray();
      if(rateId != 0){
        var url = PAGE_URL_START+"/save_rate/"+ratesecId+"/"+rateId+PAGE_URL_END;
      }else{
        var url = PAGE_URL_START+"/save_rate/"+ratesecId+PAGE_URL_END;
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
    var url = PAGE_URL_START+"/get_rate_section/<?=$row->id;?>/"+no+PAGE_URL_END;
    ratesecId = no;
  }else{
    var url = PAGE_URL_START+"/get_rate_section/<?=$row->id;?>"+PAGE_URL_END;
    ratesecId = 0;
  }
  $.ajax({type: "GET", url: url, success: function(data) {
      var data = jQuery.parseJSON(data);
      console.log(data);
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

function edit_child_item(childGridID,parent,no){

  if(no != 0){
    var url = PAGE_URL_START+"/get_rate/"+parent+'/'+no+PAGE_URL_END;
    rateId = no;
    ratesecId = parent;
  }else{
    var url = PAGE_URL_START+"/get_rate/"+parent+PAGE_URL_END;
    rateId = 0;
    ratesecId = parent;
  }
  $.ajax({type: "GET", url: url, success: function(data) {
    console.log(data);
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
      console.log(childGrid);
  }});
} 
function update_child_position(id,pos,parent){

  var url = PAGE_URL_START+"/save_rate_position/"+parent+"/"+id+"/"+pos+PAGE_URL_END;

  $.ajax({type: "GET", url: url, success: function(data) {
    $('#manageusers_'+parent+'_table').trigger('reloadGrid');
  }});
}
function update_parent_position(id,pos){

  var url = PAGE_URL_START+"/save_rate_sec_position/<?=$row->id;?>/"+id+"/"+pos+PAGE_URL_END;

  $.ajax({type: "GET", url: url, success: function(data) {
    $grid.trigger('reloadGrid');
  }});
}


function delete_item(id){
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = "<?php echo site_url('golfclub/courses/delete_rate_section');?>"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id,parent:<?=$row->id;?>}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("Sorry the action failed. You may not have permission.");}
            }});
        }
    });
}

function delete_child(parent,id){
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = "<?php echo site_url('golfclub/courses/delete_rate');?>"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id,parent:parent}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $('#manageusers_'+parent+'_table').trigger('reloadGrid');
                    });
                }else{alertify.alert("Sorry the action failed. You may not have permission.");}
            }});
        }
    });
}




function formatJson(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue.replace("'", "\'"));
    var dlang = <?=$client->default_language;?>;
    if(obj[dlang].length > 200){
        return obj[dlang].substr(0, 200)+'...';
    }else{
        return obj[dlang];
    }
};
function formatPrice(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue.replace("'", "\'"));
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





var $grid = $("#manageusers");
$(document).ready(function () {
    var url = PAGE_URL_START+'/get_rate_sections/<?=$row->id;?>'+PAGE_URL_END;
    
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:['<?php echo $this->lang->line('RatesSectionName_course'); ?>', '<?php echo $this->lang->line('Action'); ?>'],
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
                width:'25',
                align:"center",
                sortable:false,
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
        loadComplete:function(data){
            
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_manageusers"));
        }
    });
    $("#pager").before('<div class="dip-table-add" style="text-align:center;"><button type="button" class="btn btn-success btn-block" onclick="edit_parent_item(0)">+ <?php echo $this->lang->line('AddNewRateSection_course'); ?></button> </div>' );
    $grid.jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        update_parent_position(id,position);
        // console.log(ui.item[0]);
    }});
});
function showChildGrid(parentRowID, parentRowKey) {
    var childGridID = parentRowID + "_table";
    var childGridPagerID = parentRowID + "_pager";
    var template = '<div class="dip-table-add"><button type="button" class="btn btn-success btn-block" onclick="edit_child_item(\''+childGridID+'\','+parentRowKey+',0)">+<?php echo $this->lang->line('AddNewRate_course'); ?> </button></div>';
    var childGridURL = PAGE_URL_START+'/get_rates/'+parentRowKey+PAGE_URL_END;
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>'+template);

    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:['Rate Details','Price', 'Action'],
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
                align:"center",
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
    var up_btn = get_up_btn('onclick="update_child_position('+cellValue+','+(parseInt(rowObject.position)-1)+','+rowObject.course_rate_section_id+');"');
    var down_btn = get_down_btn('onclick="update_child_position('+cellValue+','+(parseInt(rowObject.position)+1)+','+rowObject.course_rate_section_id+');"');
    var e_btn = get_edit_btn('onclick="edit_child_item(\'manageusers_'+rowObject.course_rate_section_id+'_table\','+rowObject.course_rate_section_id+','+cellValue+');"');
    var d_btn = get_delete_btn('onclick="delete_child('+rowObject.course_rate_section_id+','+cellValue+');"');
    return e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};


$(document).ready(function () {
  $('#jqgh_manageusers_name').css({
    'text-align': 'left'
  });
  $('#jqgh_manageusers_name .s-ico').hide();

  $('#jqgh_manageusers_id').css({
    'text-align': 'center'
  });
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
