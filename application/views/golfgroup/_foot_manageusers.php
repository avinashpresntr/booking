<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>




<script type="text/javascript">
function formatTitle(cellValue, options, rowObject) {
    return '<b>'+cellValue.substring(0, 50) + "</b>";
};
function formatType(cellValue, options, rowObject) {
    var labels = ["","success","warning","primary","danger","default","info"];
    return '<span class="dip-label label label-'+labels[cellValue]+'">'+USER_TYPES[cellValue]+ "</span>";
};
function formatLevel(cellValue, options, rowObject) {
    var labels = ["success","warning","primary","danger","default","info"];
    return '<span class="dip-label label label-'+labels[cellValue]+'">'+USER_LEVELS[cellValue]+ "</span>";
};
function formatAction1(cellValue, options, rowObject) {
    var v_btn = get_view_link(BASE_URL+'golfclub/profile?user='+ cellValue,'target="_blank"');
    return v_btn;
};
function formatAction2(cellValue, options, rowObject) {
    var v_btn = get_view_link(BASE_URL+'partner/profile?user='+ cellValue,'target="_blank"');
    return v_btn;
};
function formatStatus(cellValue, options, rowObject){
    if(cellValue == 0){
        return '<span id="dip-switch-'+rowObject.id+'" class="dip-switch inactive" data-status="'+cellValue+'" onclick="active_user('+ rowObject.id +',0);"></span>';
    }else{
        return '<span id="dip-switch-'+rowObject.id+'" class="dip-switch active" data-status="'+cellValue+'" onclick="active_user('+ rowObject.id +',0);"></span>';
    }
}
var timeoutHnd;
function doSearch(ev){
    if(timeoutHnd)
        clearTimeout(timeoutHnd)
    timeoutHnd = setTimeout(gridReload,500)
}
function gridReload(){
    var gsearch = $("#muSearch").val();
    var getLevel='';
    if($.isNumeric($("#muLevel").val())){
        getLevel = $("#muLevel").val();
    }
    // console.log(getLevel);
    $grid.jqGrid('setGridParam', {
        page:12,
        search:true,
        postData: { 
            globalSearch: function () { return gsearch; }, 
            getLevel: function () { return getLevel; }
        },
    }).trigger("reloadGrid");
}

/**
 * For Golf Club
 */
var grid_colnames2 = ['GolfClub Name', 'Country','Level', 'Category','Creation','IOs','Android','Status','Action'];
var grid_columns2 = [
    {
        name:'name',
        index:'name',
        formatter: formatTitle
    },
    {
        name:'country',
        index:'country'
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
        width:'80',
        formatter: formatType
    },
    {
        name:'creation_date',
        index:'creation_date',
        width:'80',
        formatter: formatDate
    },
    {
        name:'ios_status',
        index:'ios_status',
        width:'80',
        formatter: formatDate
    },
    {
        name:'android_status',
        index:'android_status',
        width:'80',
        formatter: formatDate
    },
    {
        name:'status',
        index:'status',
        width:'60',
        formatter: formatStatus
    },
    {
        name:'id',
        index:'id',
        sortable:false,
        width:'110',
        align:"right",
        formatter: formatAction1
    }
];
/**
 * For Partner
 */
var grid_colnames3 = ['Partner Name', 'Country','Category','Creation','Status','Action'];
var grid_columns3 = [
    {
        name:'name',
        index:'name',
        formatter: formatTitle
    },
    {
        name:'country',
        index:'country'
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
        formatter: formatAction2
    }
];


var $grid = $("#manageusers");

$(document).ready(function () {
    var url = BASE_URL+"golfgroup/manageusers/get_golfclubs?user=<?=$user['id'];?>";
    
    var cols = grid_columns2;
    var colname = grid_colnames2;
    
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:colname,
        colModel:cols,
        rowNum:50,
        height:400,
        rowList:[10,20,50,100,200,500,1000],
        pager: '#pager',
        sortname: 'id',
        viewrecords: true,
        sortorder: "desc",
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
    var childGridURL = BASE_URL+'golfgroup/manageusers/get_partners/'+parentRowKey+"?user=<?=$user['id'];?>";

    // add a table and pager HTML elements to the parent grid row - we will render the child grid here
    // $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id="'+childGridPagerID+'"></div>');
    $('#' + parentRowID).append('<table id=' + childGridID + '></table>');
    
    var cols = grid_columns3;
    var colname = grid_colnames3;

    $("#" + childGridID).jqGrid({
        url: childGridURL,
        mtype: "GET",
        datatype: "json",
        page: 1,
        rowNum:500,
        colNames:colname,
        colModel: cols,
        loadonce: true,
        height: '100%',
        sortname: 'id',
        sortorder: "desc",
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
}
</script>