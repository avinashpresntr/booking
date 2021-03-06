<?php
session_start();

$ajvc= $_SESSION["lang"].".js";

?>

<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc);?>" type="text/javascript"></script>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('golfclub/courses');?>";
var PAGE_URL_END = "";
<?php if($session['type'] <2):?>
PAGE_URL_END = "?user=<?=$user['id'];?>";
<?php endif;?>

var $grid = $("#dipgrid");
$(document).ready(function () {
    $grid.jqGrid({
        url:PAGE_URL_START+'/get_courses'+PAGE_URL_END,
        datatype: "json",
        colNames:['<?php echo $this->lang->line('CourseName'); ?>', '<?php echo $this->lang->line('Action'); ?> '],
        colModel:[
            {
                name:'name',
                index:'name',
                align:"left",
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
        rowList:[10,20,50,100,500],
        pager: '#pager',
        sortname: 'position',
        viewrecords: true,
        sortorder: "asc",
        altRows:true,
        autowidth: true,
        shrinkToFit: true,
        loadComplete:function(data){
            if(data.rows.length == 0){
                //var html = get_norecord_msg();
				<?php /*?>alert("<?php echo $this->lang->line('Sorry No Records Found'); ?>");<?php */?>
				var html = "<div id='jqNoData' style='color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;'><?php echo $this->lang->line('Sorry No Records Found'); ?></div>";
                $grid.parent().append(html);
            }
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_dipgrid"));
        }
    });
    $grid.jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        position_item(id,position);
    }});
});
function formatAction1(cellValue, options, rowObject) {
    var up_btn = get_up_btn('onclick="position_item('+cellValue+','+(parseInt(rowObject.position)-1)+');"');
    var down_btn = get_down_btn('onclick="position_item('+cellValue+','+(parseInt(rowObject.position)+1)+');"');
    var e_btn = get_edit_link(BASE_URL+"golfclub/courses/edit/"+cellValue+PAGE_URL_END);
    var d_btn = get_delete_btn('onclick="delete_item('+cellValue+');"');
    return e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};
function formatJson(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue.replace("'", "\'"));
    var dlang = <?=$client->default_language;?>;
    if(obj[dlang].length > 80){
        return obj[dlang].substr(0, 80)+'...';
    }else{
        return obj[dlang];
    }
};

//delete
function delete_item(id) {
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = "<?php echo site_url('golfclub/courses/delete');?>"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('delete_message'); ?>", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");}
            }});
        }
    });
}
//position
function position_item(id,position) {
    var url = "<?php echo site_url('golfclub/courses/position');?>"+PAGE_URL_END;
    $.ajax({type: "POST", data: {id:id,position:position}, async: false, url: url, success: function(data) {
        if(data == 1){
            $grid.trigger('reloadGrid');
        }else{alertify.alert("Sorry the action failed.");}
    }});
}

$(document).ready(function () {
  $('#jqgh_dipgrid_name').css({
    'text-align': 'left'
  });
});
</script>
