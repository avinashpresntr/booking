$(function(){
    $("input[data-datepicker]").datepicker({ dateFormat: 'dd-mm-yy' });
	$('#dip-toggle-sidebar').click(function(event) {

		var dash = $('.dip-dashboard');
		if($(dash).hasClass('sidebar-on')){
			$(dash).addClass('sidebar-off');
			$(dash).removeClass('sidebar-on');
			$('#dip-toggle-sidebar').removeClass('active');
		}
		else if($(dash).hasClass('sidebar-off')){
			$(dash).addClass('sidebar-on');
			$(dash).removeClass('sidebar-off');
			$('#dip-toggle-sidebar').addClass('active');
		}
	});

})

/**
 * helper functions
 * buttons used in dataTable
 */
function get_norecord_msg(){
    return '<div id="jqNoData" style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;">Sorry No Records Found</div>';
}
function get_view_link(url, added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<a href="'+url+'" class="dip-ibtn dip-ibtn-edit btn btn-info" title="View" '+added+'><i class="fa fa-share"></i> View</a>';
}
function get_edit_link(url, added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<a href="'+url+'" class="dip-ibtn dip-ibtn-edit btn btn-warning" title="Edit" '+added+' ><i class="fa fa-pencil"></i> Edit</a>';
}
function get_edit_btn(added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<button type="button" class="dip-ibtn dip-ibtn-edit btn btn-warning" title="Edit" '+added+'><i class="fa fa-pencil"></i> Edit</button>';
}
function get_delete_btn(added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<button type="button" class="dip-ibtn dip-ibtn-edit btn btn-danger" title="Delete" '+added+'><i class="fa fa-trash"></i> Delete</button>';
}
function get_add_link(url, added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<a href="'+url+'" class="dip-ibtn dip-ibtn-edit btn btn-success" '+added+' title="Add Child" ><i class="fa fa-plus"></i> AddNew</a>';
}
function get_up_btn(added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<button type="button" class="dip-ibtn dip-ibtn-up btn btn-default" '+added+'><i class="fa fa-long-arrow-up"></i> Up</button>';
}
function get_down_btn(added){
    if( typeof added === 'undefined' ){
        added='';
    }
    return '<button type="button" class="dip-ibtn dip-ibtn-down btn btn-default" '+added+'><i class="fa fa-long-arrow-down"></i> Down</button>';
}




//make jsGrid Responsive
function responsive_jqgrid(jqgrid) {
    jqgrid.addClass('clear-margin span12').css('width', '');
    jqgrid.find('.ui-jqgrid-view').addClass('clear-margin span12').css('width', '');
    jqgrid.find('.ui-jqgrid-view > div').eq(1).addClass('clear-margin span12').css('width', '').css('min-height', '0');
    jqgrid.find('.ui-jqgrid-view > div').eq(2).addClass('clear-margin span12').css('width', '').css('min-height', '0');
    jqgrid.find('.ui-jqgrid-sdiv').addClass('clear-margin span12').css('width', '');
    jqgrid.find('.ui-jqgrid-pager').addClass('clear-margin span12').css('width', '');

    jqgrid.find('.ui-jqgrid-htable').css('width', '100%');//head
    jqgrid.find('.ui-jqgrid-btable').css('width', '100%');//body

    jqgrid.find('th.ui-th-column .s-ico').show();
    jqgrid.find('th.ui-th-column:last-child .s-ico').hide();
    
    jqgrid.find('.ui-jqgrid-bdiv').css('height', 'auto');

    // jqgrid.find('.ui-th-column').css('width', '');
    // jqgrid.find('.ui-th-column:first-child').css('width', '5');
    // jqgrid.find('.ui-sgcollapsed').css('width', '5');
    // jqgrid.find('.jqgfirstrow td').css('width', '');
    // jqgrid.find('*[style*="width: 555px"]').css('width', ''); 
    
    var parenttr = jqgrid.parents('.ui-subgrid');

    parenttr.find('.subgrid-cell').remove();
    var prevcs = parenttr.find('.subgrid-data').attr('colspan');
    prevcs++;
    parenttr.find('.subgrid-data').attr('colspan',prevcs).css('border-left','20px solid #eee');
}
function formatTitle(cellValue, options, rowObject) {
    return '<b>'+cellValue.substring(0, 40) + "</b>";
};
function formatType(cellValue, options, rowObject) {
    var labels = ["","success","warning","primary","danger","default","info"];
    return '<span class="dip-label label label-'+labels[cellValue]+'">'+USER_TYPES[cellValue]+ "</span>";
};
function formatLevel(cellValue, options, rowObject) {
    var labels = ["success","info","danger","warning","default","info"];
    return '<span class="dip-label label label-'+labels[cellValue]+'">'+USER_LEVELS[cellValue]+ "</span>";
};
function formatStatus(cellValue, options, rowObject){
    if(cellValue == 0){
        return '<span id="dip-switch-'+rowObject.id+'" class="dip-switch inactive" data-status="'+cellValue+'" onclick="active_user('+ rowObject.id +',0);"></span>';
    }else{
        return '<span id="dip-switch-'+rowObject.id+'" class="dip-switch active" data-status="'+cellValue+'" onclick="active_user('+ rowObject.id +',0);"></span>';
    }
}
function formatDate(cellValue, options, rowObject){
    if(cellValue != null)
    return cellValue.split("-").reverse().join("-");
    else
    return '-';
}

//for search
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
        page:1,
        search:true,
        postData: { 
            globalSearch: function () { return gsearch; }, 
            getLevel: function () { return getLevel; }
        },
    }).trigger("reloadGrid");
}
