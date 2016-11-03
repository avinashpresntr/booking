<?php
$today = date('Y-m-d');
if (!empty($client->city) && !empty($client->country)) {
    $today = get_timee($client->city, $client->country);
} else {
    echo '<script>alertify.alert("You need to first set your Country and City.");</script>';
}
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
<?php /*?><script src="<?php echo site_url('assets/vendors/jqGrid/js/i18n/grid.locale-en.js');?>" type="text/javascript"></script><?php */?>
<script src="<?php echo site_url('assets/vendors/jqGrid/js/jquery.jqGrid.min.js'); ?>" type="text/javascript"></script>

<script type="text/javascript">
    var PAGE_URL_START = "<?php echo site_url('golfclub/nexttee');?>";
    var PAGE_URL_END = "";
    <?php if($session['type'] <2):?>
    PAGE_URL_END = "?user=<?=$user['id'];?>";
    <?php endif;?>

    var $grid = $("#dipgrid");
    $(document).ready(function () {
        $grid.jqGrid({
            url: PAGE_URL_START + '/get_rewards' + PAGE_URL_END,
            datatype: "json",
            colNames: [
                '<?php echo $this->lang->line('RewardsEnglish'); ?>',
                '<?php echo $this->lang->line('Rewards French'); ?>',
                '<?php echo $this->lang->line('Rewards German'); ?>',
                '<?php echo $this->lang->line('ValidFrom'); ?>',
                '<?php echo $this->lang->line('ValidTo'); ?>',
                '<?php echo $this->lang->line('Status'); ?>',
                '<?php echo $this->lang->line('Action'); ?>'
            ],
            colModel: [
                {
                    name: 'title',
                    index: 'title',
                    align: "left",
                    sortable: false,
                    formatter: formatEnlish
                },
                {
                    name: 'title',
                    index: 'title',
                    align: "left",
                    sortable: false,
                    formatter: formatFrench
                },
                {
                    name: 'title',
                    index: 'title',
                    align: "left",
                    sortable: false,
                    formatter: formatGerman
                },
                // {
                //     name:'descr',
                //     index:'descr',
                //     formatter: formatJson
                // },
                {
                    name: 'startdate',
                    index: 'startdate',
                    width: '60',
                    formatter: formatDate
                },
                {
                    name: 'enddate',
                    index: 'enddate',
                    width: '60',
                    formatter: formatDate
                },
                {
                    name: 'enddate',
                    index: 'enddate',
                    width: '60',
                    formatter: formatExpire
                },
                {
                    name: 'id',
                    index: 'id',
                    sortable: false,
                    width: '50',
                    align: "center",
                    formatter: formatAction1
                }
            ],
            rowNum: 50,
            height: 400,
            rowList: [10, 20, 50, 100, 500],
            pager: '#pager',
            sortname: 'enddate',
            viewrecords: true,
            sortorder: "asc",
            altRows: true,
            autowidth: true,
            shrinkToFit: true,
            loadComplete: function (data) {
                if (data.rows.length == 0) {
                    var html = "<div id='jqNoData' style='color:red;font-weight:bold;text-align:center;padding:10px;background:ghostwhite;'><?php echo $this->lang->line('Sorry No Records Found'); ?></div>";
                    $grid.parent().append(html);
                }
            },
            beforeRequest: function () {
                $('#jqNoData').remove();
                responsive_jqgrid($("#gbox_dipgrid"));
            }
        });
        // $grid.jqGrid('sortableRows',{ update : function(e,ui) {
        //     var id = ui.item[0].id;
        //     var position = ui.item[0].rowIndex;
        //     position_item(id,position);
        // }});
    });
    function formatAction1(cellValue, options, rowObject) {
        // var up_btn = get_up_btn('onclick="position_item('+cellValue+','+(parseInt(rowObject.position)-1)+');"');
        // var down_btn = get_down_btn('onclick="position_item('+cellValue+','+(parseInt(rowObject.position)+1)+');"');
        var e_btn = get_edit_link(PAGE_URL_START + "/edit_rewards/" + cellValue + PAGE_URL_END);
        var d_btn = get_delete_btn('onclick="delete_item(' + cellValue + ');"');
        return e_btn + ' ' + d_btn;
    }
    function formatJson(cellValue, options, rowObject, dlang) {
        var obj = jQuery.parseJSON(rowObject.title);
        if (obj[dlang].length == 0) {
            return '--';
        } else if (obj[dlang].length > 45) {
            return obj[dlang].substr(0, 45) + '...';
        } else {
            return obj[dlang];
        }
    }
    function formatEnlish(cellValue, options, rowObject) {
        return formatJson(cellValue, options, rowObject, 1);
    }
    function formatFrench(cellValue, options, rowObject) {
        return formatJson(cellValue, options, rowObject, 2);
    }
    function formatGerman(cellValue, options, rowObject) {
        return formatJson(cellValue, options, rowObject, 3);
    }
    function formatSpanish(cellValue, options, rowObject) {
        return formatJson(cellValue, options, rowObject, 4);
    }
    function formatItalian(cellValue, options, rowObject) {
        return formatJson(cellValue, options, rowObject, 5);
    }
    function formatExpire(cellValue, options, rowObject) {
        var today = '<?php echo $today; ?>';
        if (today < rowObject.startdate) {
            return '<span class="dip-label label label-warning">Upcoming</span>';
        }
        if (today > cellValue) {
            return '<span class="dip-label label label-danger">Expired</span>';
        } else {
            return '<span class="dip-label label label-success">Live</span>';
        }
    }
    //delete
    function delete_item(id) {
        alertify.confirm("<?php echo $this->lang->line('delete_message'); ?>", function (e) {
            if (e) {
                var url = PAGE_URL_START + "/delete_rewards" + PAGE_URL_END;
                $.ajax({
                    type: "POST", data: {id: id}, async: false, url: url, success: function (data) {
                        if (data == 1) {
                            alertify.alert("<?php echo $this->lang->line('success_delete'); ?>", function () {
                                $grid.trigger('reloadGrid');
                            });
                        } else {
                            alertify.alert("<?php echo $this->lang->line('error_delete'); ?>");
                        }
                    }
                });
            }
        });
    }
    //position
    function position_item(id, position) {
        var url = PAGE_URL_START + "/position_rewards" + PAGE_URL_END;
        $.ajax({
            type: "POST", data: {id: id, position: position}, async: false, url: url, success: function (data) {
                if (data == 1) {
                    $grid.trigger('reloadGrid');
                } else {
                    alertify.alert("Sorry the action failed.");
                }
            }
        });
    }
</script>
<style>
    #jqgh_dipgrid_title {
        text-align: left;
    }
    #jqgh_dipgrid_title .s-ico {
        display: none !important;
    }
</style>
