<?php
session_start();
$ajvc= $_SESSION["lang"].".js";
?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc);?>" type="text/javascript"></script>
<?php /*?><script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script><?php */?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('master/golfapp_advertising');?>";
var $grid = $("#dipgrid");
$(document).ready(function () {
    $grid.jqGrid({
        url:PAGE_URL_START+'/get_all',
        datatype: "json",
        colNames:['Image','Name', 'URL', 'Starting Date','Ending Date','Action'],
        colModel:[
            {
                name:'pics',
                index:'pics',
                width:'40',
                formatter: formatImg
            },
            {
                name:'name',
                index:'name'
            },
            {
                name:'url',
                index:'url',
                formatter: formatTitle
            },
            {
                name:'startdate',
                index:'startdate',
                width:'80',
                formatter: formatDate
            },
            {
                name:'enddate',
                index:'enddate',
                width:'80',
                formatter: formatDate
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'40',
                align:"center",
                formatter: formatAction1
            }
        ],
        rowNum:50,
        height:400,
        rowList:[10,20,50,100,500],
        pager: '#pager',
        sortname: 'startdate',
        viewrecords: true,
        sortorder: "desc",
        altRows:true,
        loadComplete:function(data){
            if(data.rows.length == 0){
                var html = '<div id="jqNoData" style="color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;"><?php echo $this->lang->line('Sorry No Records Found'); ?></div>';
                $grid.parent().append(html);
            }
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_dipgrid"));
        }
    });
});
function formatAction1(cellValue, options, rowObject) {
    var e_btn = get_edit_link(PAGE_URL_START+"/edit/"+cellValue);
    var d_btn = get_delete_btn('onclick="delete_item('+cellValue+');"');
    return e_btn+' '+d_btn;
}
function formatImg(cellValue, options, rowObject) {
    cellValue = jQuery.parseJSON(cellValue);
    return '<img style="height:30px;" src="<?php echo site_url();?>'+cellValue[0]+'"/>';
}
function delete_item(id) {
    alertify.confirm("Are you sure you want to delete record?", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete";
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
</script>