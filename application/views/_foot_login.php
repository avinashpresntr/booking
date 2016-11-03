<?php if($this->session->flashdata('timeout_msg')): ?>
<script>
$(document).ready(function ($) {
    alertify.alert("<?php echo $this->session->flashdata('timeout_msg');?>");
});
</script>
<?php endif;?>
<script>
$(document).ready(function($) {
    $("#dip-loginform").submit(function( event ) {
    	event.preventDefault();
        var username =  $("#dip-username").val();
        var password = $("#dip-password").val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('index.php/login/auth');?>",
            data: {
                username: username,
                password : password
            },
            success: function(data)
            {
            	var res = jQuery.parseJSON(data);
            	//console.log(res);

                if(res.status=="success"){
                	window.location.href = res.url;
                }else{
                	alertify.alert(res.msg);
                }
            }
        });
    });
});
</script>