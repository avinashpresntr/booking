<?php
session_start();
$ajvc= $_SESSION["lang"].".js";
?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc);?>" type="text/javascript"></script>

<?php /*?><script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script><?php */?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>

<script type="text/javascript">
var PAGE_URL_START = "<?php echo site_url('partner/packages');?>";
var PAGE_URL_END = "";
<?php if($session['type'] <=2):?>
PAGE_URL_END = "?user=<?=$user['id'];?>";
<?php endif;?>

var $grid = $("#dipgrid");
$(document).ready(function () {
    $grid.jqGrid({
        url:PAGE_URL_START+'/get_packages'+PAGE_URL_END,
        datatype: "json",
        colNames:[/*'<?php echo $this->lang->line('Position'); ?>',*/'<?php echo $this->lang->line('Title'); ?>', '<?php echo $this->lang->line('PublicationDate'); ?>','<?php echo $this->lang->line('Status'); ?>','<?php echo $this->lang->line('Action'); ?>'],
        colModel:[
            /*{
                name:'position',
               index:'position',
                width:'30'
            },*/
            {
                name:'title',
                index:'title',
                align:"left",
                formatter: formatJson
            },
            // {
            //     name:'subtitle',
            //     index:'subtitle',
            //     formatter: formatJson
            // },
            // {
            //     name:'descr',
            //     index:'descr',
            //     formatter: formatJson
            // },
            {
                name:'pubdate',
                index:'pubdate',
                width:'50',
                formatter: formatDate
            },
            {
                name:'status',
                index:'status',
                width:'30',
                formatter: formatState
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'35',
                align:"center",
                formatter: formatAction1
            }
        ],
        rowNum:500,
        height:400,
        rowList:[10,20,50,100,500],
        pager: '#pager',
        sortname: 'position',
        viewrecords: true,
        sortorder: "asc",
        altRows:true,
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
    $grid.jqGrid('sortableRows',{ update : function(e,ui) {
        var id = ui.item[0].id;
        var position = ui.item[0].rowIndex;
        update_position(id,position);
    }});
});
function formatAction1(cellValue, options, rowObject) {
    var up_btn = get_up_btn('onclick="update_position('+cellValue+','+(parseInt(rowObject.position)-1)+');"');
    var down_btn = get_down_btn('onclick="update_position('+cellValue+','+(parseInt(rowObject.position)+1)+');"');
    var e_btn = get_edit_link(PAGE_URL_START+"/edit/"+cellValue+PAGE_URL_END);
    var d_btn = get_delete_btn('onclick="delete_item('+cellValue+');"');
    return e_btn+' '+d_btn+' '+up_btn+' '+down_btn;
};
function formatJson(cellValue, options, rowObject) {
    var obj = jQuery.parseJSON(cellValue);
    var dlang = <?=$client->parent->default_language;?>;
    if(obj[dlang].length > 60){
        return obj[dlang].substr(0, 60)+'...';
    }else{
        return obj[dlang];
    }
};
function formatState(cellValue, options, rowObject) {
    if(cellValue==0){
        return '<span class="dip-label label label-warning">Draft</span>';
    }else{
        return '<span class="dip-label label label-success">Published</span>';
    }
};
//delete
function delete_item(id) {
	//alert("Hi");
    alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function(e) {
        if (e) {
            var url = PAGE_URL_START+"/delete"+PAGE_URL_END;
            $.ajax({type: "POST", data: {id: id}, async: false, url: url, success: function(data) {
                if(data == 1){
                    alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function() {
                       $grid.trigger('reloadGrid');
                    });
                }else{alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");}
            }});
        }
    });
}
function update_position(id,pos){
    var url = PAGE_URL_START+"/position"+PAGE_URL_END;
    $.ajax({type: "POST", data: {id:id, position:pos}, async: false, url: url, success: function(data) {
        if(data == 1){
            $grid.trigger('reloadGrid');
        }else{alertify.alert("Sorry the action failed.");}
    }});
}
$(document).ready(function () {
  $('#jqgh_dipgrid_title').css({
    'text-align': 'left'
  });
});
</script>
<style>
.ui-jqgrid .ui-subgrid td.subgrid-cell {
    background: transparent;
}
</style>
