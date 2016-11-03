<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>


<script type="text/javascript">
<?php if(isset($error)){
echo 'alertify.alert("'.$error.'");';
}?>
function position_partner(id,position,parent) {
    var url = "<?php echo site_url('master/manageusers/position_partner');?>";
    $.ajax({type: "POST", data: {id:id,position:position}, url: url, success: function(data) {
        // console.log(data);
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

function formatAction(cellValue, options, rowObject) {
    var v_btn = get_view_link(BASE_URL+'partner/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/partner/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    var up_btn = get_up_btn('onclick="position_partner('+cellValue+',-1,'+rowObject.parrent+');"');
    var down_btn = get_down_btn('onclick="position_partner('+cellValue+',1,'+rowObject.parrent+');"');
    return v_btn+' '+e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};
function formatAction2(cellValue, options, rowObject) {
    var a_btn = get_add_link(BASE_URL+'master/manageusers/partner?parent='+ cellValue);
    var v_btn = get_view_link(BASE_URL+'golfclub/profile?user='+ cellValue,'target="_blank"');
    var e_btn = get_edit_link(BASE_URL+"master/manageusers/golfclub/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_user('+cellValue+');"');
    return a_btn+' '+v_btn+' '+e_btn+' '+d_btn;
};


var $grid = $("#manageusers");
$(document).ready(function () {
    var url = "<?php echo site_url('master/manageusers/get_golfclubs');?>";
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:['GolfClub Name', 'Country','Level', 'Creation','Renewal','Logs','Status','Action'],
        colModel:[
            {
                name:'name',
                index:'name',
                align:"left",
                formatter: formatTitle
            },
            {
                name:'country_name',
                index:'country_name',
                width:'90'
            },
            {
                name:'level',
                index:'level',
                width:'60',
                formatter: formatLevel
            },
            {
                name:'creation_date',
                index:'creation_date',
                width:'75',
                formatter: formatDate
            },
            {
                name:'renewal_date',
                index:'renewal_date',
                width:'75',
                formatter: formatDate
            },
            {
                name:'logs',
                index:'logs',
                width:'40'
            },
            {
                name:'status',
                index:'status',
                width:'40',
                sortable:false,
                formatter: formatStatus
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'80',
                align:"center",
                formatter: formatAction2
            }
        ],
        multiselect:true,
        rowNum:50,
        height:400,
        altRows:true,
        rowList:[10,20,50,100,200,500,1000],
        pager: '#pager',
        sortname: "level desc, creation_date desc",
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
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');
    $("#" + childGridID).jqGrid({
        url: "<?php echo site_url('master/manageusers/get_partners');?>"+"/"+parentRowKey,
        mtype: "GET",
        datatype: "json",
        page: 1,
        colNames:['Partner Name', 'Country','Category','Creation','Renewal','Status','Action'],
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
                width:'80'
            },
            {
                name:'type',
                index:'type',
                width:'85',
                formatter: formatType
            },
            {
                name:'creation_date',
                index:'creation_date',
                width:'65',
                formatter: formatDate
            },
            {
                name:'renewal_date',
                index:'renewal_date',
                width:'70',
                formatter: formatDate
            },
            {
                name:'status',
                index:'status',
                width:'30',
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
        rowNum:5000,
        height: '100%',
        altRows:true,
        sortname: "type asc, position asc",
        sortorder:'',
        pager: "#" + childGridPagerID,
        pagerpos: 'right',
        autowidth: true,
        shrinkToFit: true,
        loadComplete:function(data){
            if(data.rows.length == 0){
                $("#gview_" + childGridID).html('<div style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>');
            }
        }
    });
    
    var activeDragElement;
    $("#" + childGridID).jqGrid('sortableRows',{ 
        start: function(e,ui){
            // console.log(ui.item[0].rowIndex);
            activeDragElement = ui.item[0].rowIndex;
        },
        update : function(e,ui) {
            var relpos = ui.item[0].rowIndex - activeDragElement;
            var id = ui.item[0].id;
            // var position = ui.item[0].rowIndex;
            var parent = parentRowKey;
            position_partner(id,relpos,parent);
            // console.log(relpos);
        }
    });
}



//delete
function delete_user(id) {
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = "<?php echo site_url('master/manageusers/delete');?>";
            $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $grid.trigger('reloadGrid');
                    });
                }
            }});
        }
    });
}
function delet_selected_item(){
    var s = $grid.jqGrid('getGridParam','selarrrow');
    alertify.confirm("Are you sure you want to delete records?", function(e) {
        if (e) {
            var url = "<?php echo site_url('master/manageusers/multi_delete/golfclub');?>";
            $.ajax({type: "POST", data: {deleteSelected: s}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("Sorry the action failed. Somethings went wrong.");}
            }});
        }
    });
}
function delet_all_item(){
    var s = $grid.jqGrid('getGridParam','selarrrow');
    alertify.confirm("Are you sure you want to delete records?", function(e) {
        if (e) {
            var url = "<?php echo site_url('master/manageusers/multi_delete/golfclub');?>";
            var gsearch = $("#muSearch").val();
            var getLevel='';
            if($.isNumeric($("#muLevel").val())){
                getLevel = $("#muLevel").val();
            }

            $.ajax({type: "POST", data: {
                deleteAll: true,
                globalSearch:gsearch,
                getLevel:getLevel
            }, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("Sorry the action failed. Somethings went wrong.");}
            }});
        }
    });
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