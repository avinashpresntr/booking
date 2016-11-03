<?php
session_start();
$ajvc= $_SESSION["lang"].".js";
?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/'.$ajvc);?>" type="text/javascript"></script>
<?php /*?><script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script><?php */?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js');?>" type="text/javascript"></script>


<script type="text/javascript">
function formatAction1(cellValue, options, rowObject) {
    var v_btn = get_view_link(BASE_URL+'partner/profile?user='+ cellValue,'target="_blank"');
    return v_btn;
};
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
        }
    }).trigger("reloadGrid");
}

var $grid = $("#manageusers");
$(document).ready(function () {
    var url = BASE_URL+"golfclub/partners/get_partners?user=<?=$user['id'];?>";
    $grid.jqGrid({
        url:url,
        datatype: "json",
        colNames:['<?php echo $this->lang->line('PartnerName'); ?>', '<?php echo $this->lang->line('Country'); ?>','<?php echo $this->lang->line('Category'); ?>','<?php echo $this->lang->line('Action'); ?>'],
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
                width:'70'
            },
            {
                name:'type',
                index:'type',
                width:'50',
                formatter: formatType
            },
            {
                name:'id',
                index:'id',
                sortable:false,
                width:'30',
                align:"center",
                formatter: formatAction1
            }
        ],
        rowNum:50,
        height:400,
        rowList:[10,20,50,100,200,500,1000],
        pager: '#pager',
        sortname: 'type asc, position asc',
        sortorder: "",
        viewrecords: true,
        altRows:true,
        loadComplete:function(data){
            if(data.rows.length == 0){
				var html = "<div id='jqNoData' style='color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;'><?php echo $this->lang->line('Sorry No Records Found'); ?></div>";
                $grid.parent().append(html);
            }
        },
        beforeRequest: function() {
            $('#jqNoData').remove();
            responsive_jqgrid($("#gbox_manageusers"));
        }
    });
});
$(document).ready(function () {
  $('#jqgh_manageusers_name').css({
    'text-align': 'left'
  });
});
</script>
