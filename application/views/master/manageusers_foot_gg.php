<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>


<script type="text/javascript">
function formatAction(cellValue, options, rowObject) {
    var v_btn = get_view_link(BASE_URL+'partner/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/partner/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    var up_btn = get_up_btn('onclick="position_partner('+cellValue+',-1,'+rowObject.parrent+');"');
    var down_btn = get_down_btn('onclick="position_partner('+cellValue+',1,'+rowObject.parrent+');"');
    return v_btn+' '+e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};
function formatAction1(cellValue, options, rowObject) {
    var a_btn = get_add_link(BASE_URL+'master/manageusers/golfclub?parent='+ cellValue);
    var v_btn = get_view_link(BASE_URL+'golfgroup/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/golfgroup/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return a_btn+' '+v_btn+' '+e_btn+' '+d_btn;
};
function formatAction2(cellValue, options, rowObject) {
    var a_btn = get_add_link(BASE_URL+'master/manageusers/partner?parent='+ cellValue);
    var v_btn = get_view_link(BASE_URL+ 'golfclub/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/golfclub/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return a_btn+' '+v_btn+' '+e_btn+' '+d_btn;
};
var $grid = $("#manageusers");
$(document).ready(function () {
    $grid.jqGrid({
        url:"<?php echo site_url('master/manageusers/get_golfgroups');?>",
        datatype: "json",
        colNames:['GolfGroup Name', 'Category','Creation','Status','Action'],
        colModel:[
            {
                name:'name',
                index:'name',
                align:"left",
                formatter: formatTitle
            },
            {
                name:'type',
                index:'type',
                width:'60',
                formatter: formatType
            },
            {
                name:'creation_date',
                index:'creation_date',
                width:'80',
                formatter: formatDate
            },
            {
                name:'status',
                index:'status',
                width:'50',
                sortable:false,
                formatter: formatStatus
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'60',
                align:"center",
                formatter: formatAction1
            }
        ],
        rowNum:50,
        height:400,
        rowList:[10,20,50,100,200,500,1000],
        pager: '#pager',
        sortname: 'creation_date asc',
        sortorder:'',
        viewrecords: true,
        subGrid: true,
        altRows:true,
        subGridRowExpanded: showChildGrid,
        loadComplete:function(data){
            if(data.rows.length == 0){
                $grid.parent().append('<div id="jqNoData" style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>');
            }
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_manageusers"));
        }
    });
});
function showChildGrid(parentRowID, parentRowKey) {
    var childGridID = parentRowID + "_table";
    var childGridPagerID = parentRowID + "_pager";
    // send the parent row primary key to the server so that we know which grid to show
    var childGridURL = "<?php echo site_url('master/manageusers/get_golfclubs');?>"+"/"+parentRowKey;
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');

    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:['GolfClub Name', 'Country','Level', 'Category','Creation','Status','Action'],
        colModel: [
            {
                name:'name',
                index:'name',
                align:"left",
                formatter: formatTitle
            },
            {
                name:'country_name',
                index:'country_name',
                width:'120'
            },
            {
                name:'level',
                index:'level',
                width:'60',
                formatter: formatLevel
            },
            {
                name:'type',
                index:'type',
                width:'60',
                formatter: formatType
            },
            {
                name:'creation_date',
                index:'creation_date',
                width:'80',
                formatter: formatDate
            },
            {
                name:'status',
                index:'status',
                width:'40',
                formatter: formatStatus
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'80',
                align:"right",
                formatter: formatAction2
            }
        ],
        rowNum:500,
        loadonce: true,
        height: '100%',
        sortname: 'type asc, creation_date desc',
        sortorder:'',
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        subGrid: true,
        altRows:true,
        subGridRowExpanded: showChildGrid2,
        beforeRequest: function() {responsive_jqgrid($("#gbox_"+childGridID));},
        loadComplete:function(data){
            if(data.rows.length == 0){
                $("#gview_" + childGridID).html('<div style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>');
            }
        }
    });
}
function showChildGrid2(parentRowID, parentRowKey) {
    var childGridID = parentRowID + "_table";
    var childGridPagerID = parentRowID + "_pager";
    // send the parent row primary key to the server so that we know which grid to show
    var childGridURL = "<?php echo site_url('master/manageusers/get_partners');?>"+"/"+parentRowKey;
    // add a table and pager HTML elements to the parent grid row - we will render the child grid here
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');
    
    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:['Partner Name', 'Country',' ','Category','Creation','Status','Action'],
        colModel: [
            {
                name:'name',
                index:'name',
                formatter: formatTitle
            },
            {
                name:'country_name',
                index:'country_name'
            },
            {
                name:'level',
                index:'level',
                width:'60',
                formatter: formatLevel
            },
            {
                name:'type',
                index:'type',
                width:'60',
                formatter: formatType
            },
            {
                name:'creation_date',
                index:'creation_date',
                width:'80',
                formatter: formatDate
            },
            {
                name:'status',
                index:'status',
                width:'45',
                formatter: formatStatus
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'85',
                align:"right",
                formatter: formatAction
            }
        ],
        loadonce: true,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        sortname: "type asc, position asc",
        sortorder:'',
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        altRows:true,
        loadComplete:function(data){
            if(data.rows.length == 0){
                $("#gview_" + childGridID).html('<div style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>');
            }
        }
    });
    $("#" + childGridID).jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        position_item(id,position);
    }});
}


/**
 * Actions in The Grid
 */
function delete_user(id) {
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = "<?php echo site_url('master/manageusers/delete');?>";
            $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       window.location.reload();
                    });
                }
            }});
        }
    });
}
function position_item(id,position,parent) {
    var url = "<?php echo site_url('master/manageusers/position_partner');?>";
    $.ajax({type: "POST", data: {id:id,position:position}, url: url, success: function(data) {
            $('#manageusers_'+parent+'_table').trigger('reloadGrid');
    }});
}
function active_user(id,type){
    var dswitch = $('#dip-switch-'+id);
    var cstatus = $('#dip-switch-'+id).attr("data-status");
    var sstatus = 1;
    if(cstatus==1){
        var sstatus = 0;
    }
    $.ajax({type: "POST", data: {id: id,status:sstatus}, async: false, url: "<?php echo site_url('master/manageusers/status') ?>", success: function(data) {
        if(data == 1){
            var text = '';
            if(sstatus == 1){
                text = "User is Enabled successfully.";
            }
            if(sstatus == 0){
                text = "User is Disabled successfully.";
            }
            alertify.alert(text, function() {
                if(sstatus == 1){
                    $(dswitch).removeClass('inactive');
                    $(dswitch).addClass('active');
                    $(dswitch).attr("data-status",1);
                }
                if(sstatus == 0){
                    $(dswitch).removeClass('active');
                    $(dswitch).addClass('inactive');
                    $(dswitch).attr("data-status",0);
                }
                if(type==1){
                     window.location.reload();
                }
            }); 
        }
    }});
}
$(document).ready(function () {
  $('#manageusers_name').css({
    'text-align': 'left'
  });
});
</script>
<style>
.ui-jqgrid .ui-subgrid td.subgrid-cell {
    background: transparent;
}
.ui-jqgrid .ui-subgrid .ui-jqgrid-btable tr.ui-priority-secondary td {
    background:rgb(242, 242, 242);
}
</style>