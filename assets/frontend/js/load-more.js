jQuery(document).ready(function(){
    $(document).on("click",".load-more", function(){
        $("#loader").show();
        $.ajax({
            url: $(this).attr("data-url"),
            success: function (data) {
                $("#loader").hide();
                $("#load-more").remove();
                $(".records-container").append(data);
            }
        });
    });
});