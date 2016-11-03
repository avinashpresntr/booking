<?php
session_start();
$ajvc= $_SESSION["lang"].".js";
if($ajvc=".js")
{
	$ajvc_n="grid.locale-en.js";	
}
else
{
	$ajvc_n=$ajvc;
}

?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc_n);?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('golfclub/nexttee');?>";




var PAGE_URL_END = "";
<?php if($session['type'] < 2):?>
PAGE_URL_END = "?user=<?=$user['id'];?>";
<?php endif;?>

function gridReload(){
    var gsearch = $("#muSearch").val();
    var getLevel='';
    if($.isNumeric($("#muLevel").val())){
        getLevel = $("#muLevel").val();
    }
    $grid.jqGrid('setGridParam', {
        search:true,
        postData: { 
            globalSearch: function () { return gsearch; }, 
            getLevel: function () { return getLevel; }
        },
    }).trigger("reloadGrid");
}

var $grid = $("#dipgrid");
$(document).ready(function () {
    $grid.jqGrid({
        url:PAGE_URL_START+'/get_nt_events'+PAGE_URL_END,
	
        datatype: "json",
        colNames:['<?php echo $this->lang->line('EventDate'); ?>', "<?php echo $this->lang->line('EventName'); ?>", '<?php echo $this->lang->line('Action'); ?>'],
        colModel:[
            {
                name:'event_date',
                index:'event_date',
                width:'35',
                formatter: formatDate
            },
            {
                name:'name',
                index:'name',
                align:"left",
                formatter: formatTitle2
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
        rowNum:500,
        height:400,
        rowList:[10,20,50,100,500],
        pager: '#pager',
        sortname: 'event_date',
        viewrecords: true,
        sortorder: "asc",
        altRows:true,
        multiselect: true,
        loadComplete:function(data){
            if(data.rows.length == 0){
                var html = "<div id='jqNoData' style='color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;'><?php echo $this->lang->line('Sorry No Records Found'); ?></div>";
                $grid.parent().append(html);
            }
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_dipgrid"));
        }
    });
});
var dlang = <?=$client->default_language;?>;
function formatAction1(cellValue, options, rowObject) {
    var e_btn = get_edit_link(PAGE_URL_START+"/edit_nt_events/"+cellValue+PAGE_URL_END);
    var d_btn = get_delete_btn('onclick="delete_item('+cellValue+');"');
    return e_btn+' '+d_btn;
};
function formatJson(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue);
    if(typeof obj[dlang]!='undefined'){
        if(obj[dlang].length > 100){
            return obj[dlang].substr(0, 100)+'...';
        }else{
            return obj[dlang];
        }
    }else{
        return '';
    }
};
function formatTitle2(cellValue, options, rowObject) {
    if(cellValue.length > 75){
        return '<b>'+cellValue.substring(0, 75) + "...</b>";
    }else{
        return '<b>'+cellValue+ "</b>";
    }
    
};
function formatLang(cellValue, options, rowObject){
    var obj = jQuery.parseJSON(cellValue);
    var languages = <?=encode_data((array)$langs);?>;
    return languages[obj];
}
function formatState(cellValue, options, rowObject) {
    if(cellValue==0){
        return '<span class="dip-label label label-warning">Draft</span>';
    }else{
        return '<span class="dip-label label label-success">Published</span>';
    }
};
function changeLang(ev){
    dlang = $("#muLang").val();
    $grid.trigger("reloadGrid");
}

//delete
function delete_item(id) {
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete_nt_event"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("Record deleted successfully.", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("Sorry the action failed. You may not have permission.");}
            }});
        }
    });
}
function delet_selected_item(){
    var s = $grid.jqGrid('getGridParam','selarrrow');
	//alert(s);
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete_nt_event"+PAGE_URL_END;
            $.ajax({type: "POST", data: {multiID: s}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");}
            }});
        }
    });
}
function delet_all_item(){
    var s = $grid.jqGrid('getGridParam','selarrrow');
	//alert(s);
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete_nt_event"+PAGE_URL_END;
            $.ajax({type: "POST", data: {deleteAll: true}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function() {
                       $grid.trigger('reloadGrid');
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
});
</script>
