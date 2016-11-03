<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>


<script type="text/javascript">
function formatAction(cellValue, options, rowObject) {
    if(rowObject.type > 2){
        var type = 'partner';
    }else{
        var type = USER_TYPES[rowObject.type].toLowerCase();
    }
    var v_btn = get_view_link(BASE_URL+ type +'/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/"+type+"/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return v_btn+' '+e_btn+' '+d_btn;
};
function formatAction1(cellValue, options, rowObject) {
    var type = 'golfgroup';
    var a_btn = get_add_link(BASE_URL+'master/manageusers/golfclub?parent='+ cellValue);
    var v_btn = get_view_link(BASE_URL+ type +'/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/"+type+"/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return a_btn+' '+v_btn+' '+e_btn+' '+d_btn;
};
function formatAction2(cellValue, options, rowObject) {
    var type = 'golfclub';
    var a_btn = get_add_link(BASE_URL+'master/manageusers/partner?parent='+ cellValue);
    var v_btn = get_view_link(BASE_URL+ type +'/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/"+type+"/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return a_btn+' '+v_btn+' '+e_btn+' '+d_btn;
};

/**
 * For Golf Group
 */
var grid_colnames = ['GolfGroup Name', 'Country', ' ','Category','Creation','Status','Action'];
var grid_columns = [
    {
        name:'name',
        index:'name',
        formatter: formatTitle
    },
    {
        name:'country_name',
        index:'country_name',
        width:'80'
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
        width:'50',
        formatter: formatStatus
    },
    {
        name:'id',
        index:'id',
        sortable:false,
        width:'80',
        align:"right",
        formatter: formatAction1
    }
];
/**
 * For Golf Club
 */
var grid_colnames2 = ['GolfClub Name', 'Country','Level', 'Category','Creation','Status','Action'];
var grid_columns2 = [
    {
        name:'name',
        index:'name',
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
];
/**
 * For Partner
 */
var grid_colnames3 = ['Partner Name', 'Country',' ','Category','Creation','Status','Action'];
var grid_columns3 = [
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
        width:'80',
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
        width:'65',
        align:"right",
        formatter: formatAction
    }
];


var $grid = $("#manageusers");
$(document).ready(function () {
    var url = "<?php echo site_url('master/manageusers/get_'.$grid);?>";
    
    var cols = grid_columns;
    var colname = grid_colnames;
    <?php if($grid=='golfclubs'){echo 'cols = grid_columns2;colname = grid_colnames2;';}?>
    
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:colname,
        colModel:cols,
        rowNum:50,
        height:400,
        rowList:[10,20,50,100,200,500,1000],
        pager: '#pager',
        sortname: "<?php echo ($grid=='golfgroups'?'creation_date asc':'level desc, creation_date desc');?>",
        sortorder:'',
        viewrecords: true,
        subGrid: true,
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
    <?php if($grid=='golfclubs'):?>
    childGridURL = "<?php echo site_url('master/manageusers/get_partners');?>"+"/"+parentRowKey;
    <?php endif; ?>


    // add a table and pager HTML elements to the parent grid row - we will render the child grid here
    // $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id="'+childGridPagerID+'"></div>');
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');
    
    var cols = grid_columns2;
    var colname = grid_colnames2;
    <?php if($grid=='golfclubs'){echo 'cols = grid_columns3;colname = grid_colnames3;';}?>

    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:colname,
        colModel: cols,
        rowNum:500,
        loadonce: true,
        height: '100%',
        sortname: "<?php echo ($grid=='golfclubs'?'type asc, position asc':'level asc, id desc');?>",
        sortorder:'',
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        <?php if($grid=='golfgroups'):?>
        subGrid: true,
        subGridRowExpanded: showChildGrid2,
        beforeRequest: function() {responsive_jqgrid($("#gbox_"+childGridID));},
        <?php else: ?>
        autowidth: true,
        shrinkToFit: true,
        <?php endif;?>
        
        loadComplete:function(data){
            if(data.rows.length == 0){
                $("#gview_" + childGridID).html('<div style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>');
            }
        }
    });
}

<?php if($grid=='golfgroups'):?>
function showChildGrid2(parentRowID, parentRowKey) {
    var childGridID = parentRowID + "_table";
    var childGridPagerID = parentRowID + "_pager";

    // send the parent row primary key to the server so that we know which grid to show
    var childGridURL = "<?php echo site_url('master/manageusers/get_partners');?>"+"/"+parentRowKey;

    // add a table and pager HTML elements to the parent grid row - we will render the child grid here
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');
    
    var cols = grid_columns3;
    var colname = grid_colnames3;
    
    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:colname,
        colModel: cols,
        loadonce: true,
        autowidth: true,
        shrinkToFit: true,
        height: '100%',
        sortname: "type asc, position asc",
        sortorder:'',
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        loadComplete:function(data){
            console.log(childGridID);
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
<?php endif;?>


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
function position_item(id,position) {
    var url = "<?php echo site_url('master/manageusers/position_partner');?>";
    $.ajax({type: "POST", data: {id:id,position:position}, async: false, url: url, success: function(data) {
        if(data == 1){
            $grid.trigger('reloadGrid');
        }else{alertify.alert("Sorry the action failed.");}
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
</script>