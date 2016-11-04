
var check_id = null;

// GENERAL functions ///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){

    // WHEN language is changed
    $(linkLanguageClass).click(function(e){
        e.preventDefault();
        $("#locale_field").val($(this).data('lng'));
        sendPostQuery();
    });

    // WHEN language is changed
    $(mobileLinkLanguageClass).click(function(e){
        e.preventDefault();
        $("#locale_field").val($(this).data('lng'));
        sendPostQuery();
    });

});

// - replace all in a js string
function replaceAll(str, find, replace) {
    return str.replace(new RegExp(find, 'g'), replace);
}

// - redirect to logout
function logout(){
    document.location = path_logout;
}

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// FILTERS functions ///////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function() {


    // display low price for today (what about the other days :: TODO)
    if (parseFloat(today_low_price) < 200){
        $(today_low_price_id).html(" <small>" + txt_from_cost + "</small> " + today_low_price + ".-");
        //$(".prix").html(" <small>" + txt_from_cost + "</small> " + today_low_price + ".-");
    }
    else{
        $(today_low_price_id).html(" <small>"+today_low_price+"</small>");
    }


    /*$(".gc-col-day a").each(function(){
        var dateS = $(this).data("day");
        dateS = dateS.replace("/","-"); dateS = dateS.replace("/","-"); dateS = dateS.replace("/","-");
        var price = 0;
        $.ajax("../lowestprice/3/"+dateS, function(data){
            price = data;
        }).done(function(){
            //console.log(price);
        });

    });*/



    // init date picker
    $(date_picker).datepicker({
        format: 'dd/mm/yyyy',
        language: 'fr-FR',
        startDate: '-1d'
    });



    // WHEN date picker is changed : if in past ==> dateInPast(), else ==> sendPostQuery()
    $(date_picker).on('changeDate', function (ev) {

        var date = $(date_picker).val();
        dates = date.split("/");
        var date = new Date(dates[2] + "-" + dates[1] + "-" + dates[0]),
            presentDate = new Date();
        presentDate.setHours(0, 0, 0);
        if (date < presentDate.getTime()) {
            dateInPast();
        }
        else {
            sendPostQuery();
        }

    });

    // WHEN nb players is selected
    $(nb_players_class).click(function (e) {
        e.preventDefault();
        if ($(this).hasClass("active")) {
            $(nb_players_class).removeClass("active");
        }
        else {
            $(nb_players_class).removeClass("active");
            $(this).addClass("active");
        }
        sendPostQuery();
    });

    // WHEN parcours is selected
    $(filterParcours).on('change', function(e){
        e.preventDefault();
        sendPostQuery();
    });

    // WHEN display is changed
    $(filterDisplay).click(function(e){
        e.preventDefault();
        $(display_field).val($(this).data('target'));
        sendPostQuery();
    });

    // WHEN user select a day in the search bar
    $(filterDayClass).click(function(){
        $("#dp1").val($(this).data('day'));
        var date = $("#dp1").val();
        dates = date.split("/");
        var date = new Date(dates[2]+"-"+dates[1]+"-"+dates[0]),
            presentDate = new Date();
        presentDate.setHours(0,0,0);
        if(date<presentDate.getTime()) {
            dateInPast();
        }
        else{
            sendPostQuery();
        }
    });

    // WHEN user click on left/right arrow in the search bar
    $(filterPrevWeekClass).click(function(){
        $(date_picker).val($(this).data('target'));
        if($(this).hasClass("is_past")){
            dateInPast();
        }else{

            sendPostQuery();
        }

    });
    $(filterNextWeekClass).click(function(){
        $(date_picker).val($(this).data('target'));
        sendPostQuery();
    });

});

// - send post query amongst filters selected
function sendPostQuery(){

    var date_val = $('#dp1').val();
    if(typeof date_val!='undefined'){
        var new_date = replaceAll(date_val,'/','-');
        $(date_field).val(new_date);
        $(nb_players_field).val(getNbPlayers());
        $(parcours_field).val(getParcours());
        var path = document.location.href;
        path = path.replace("/fr/", "/"+$(locale_field).val()+"/");
        path = path.replace("/en/", "/"+$(locale_field).val()+"/");
        path = path.replace("/de/", "/"+$(locale_field).val()+"/");
        path = path.replace("/it/", "/"+$(locale_field).val()+"/");
        // submit form
        $(searchForm).attr("action",path).submit();
    }
    else{
        var path = path_conditions;
        path = path.replace("/fr/", "/"+$(locale_field).val()+"/");
        path = path.replace("/en/", "/"+$(locale_field).val()+"/");
        path = path.replace("/de/", "/"+$(locale_field).val()+"/");
        path = path.replace("/it/", "/"+$(locale_field).val()+"/");
        // submit form
        $(searchForm).attr("action",path).submit();
    }
}



// - return 1-4 according to nb players filter clicked
function getNbPlayers(){
    if($(nb_p1_btn).hasClass("active")){return 1;}
    else if($(nb_p2_btn).hasClass("active")){return 2;}
    else if($(nb_p3_btn).hasClass("active")){return 3;}
    else if($(nb_p4_btn).hasClass("active")){return 4;}
}

// - return id of parcours selected
function getParcours(){
    return $(parcours_filter+" option:selected").val();
}

// - return label of parcours selected
function getParcoursLabel(){
    return $(parcours_filter+" option:selected").html();
}

// - display msg indicating that the date selected is in past
function dateInPast(){
    $('#dialog').dialogBox({
        autoSize: true,
        autoHide: false,
        // timeout for auto close
        time: 0,
        // z-index
        zIndex: 99999,
        // display a fullscreen mask layer
        hasMask: true,
        // display a close button
        hasClose: true,
        // display confirm/cancel buttons
        hasBtn: false,
        // confirm button text
        confirmValue: txt_confirm,
        cancelValue: txt_cancel,
        cancel: null,
        // confirm callback
        confirm: function(){},
        effect: 'fade',
        // the type of your dialog box
        // normal, error, correct (confirm dialog)
        type: 'normal',
        // custom dialog title
        title: txt_past_date_title,
        // custom dialog content
        // strings or an exteral URL
        content: txt_past_date_content,
        // Callback functions
        callback: function(){},
        close: function(){}
    });
}

// - change datepicker value (deprecated ?)
function changeDay(){
    $(date_picker).val($(this).data('day'));
}

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

// SHCEDULE functions ///////////////////////////////////////////////////////////////////////////////////////////////////

function freeBooking(){
    var params = "?check_id="+check_id;
    var url = free_booking_url + params;
    var valid = true;
    var reason = null;
    $.ajax({
        url: url,
        async: false,
        dataType: 'json',
    }).done(function(response) {

    });
}

window.onunload = unloadPage;
function unloadPage()
{
    if(form_open==true){
        freeBooking();
    }
}


var form_open = false;

// booking BTN in here !
$(document).ready(function(){

    $(".close").click(function(){
        if(check_id!=null){
            form_open = false;
            freeBooking();
        }
    });



    // - WHEN user click on booking for a date in the schedule calendar
    $(btnBookingClass).click(function(e){

        form_open = true;

        // 1. prevent disavailability click
        if($(this).data("availability")=="0"){
            e.preventDefault();
        }

        // 2. check that no one else is booking right now
        var params = "?date="+$(this).data("date")+"&start="+$(this).data("start")+"&parcours="+getParcours()+"&availability="+$(this).data("availability")+"&member_id="+member_id_connected;
        var url = is_booking_url + params;
        var valid = true;
        var reason = null;
//console.log(url);


        $.ajax({
            url: url,
            async: false,
            dataType: 'json',
        }).done(function(response) {
            //console.log("Réponse : ");

            //console.log(response);

            if(response.error == true){
                valid = false;
                reason = 1;
            }
            else{
                if(response.bookable==false){
                    valid = false;

                    if(typeof response.reason !='undefined'){
                        reason = response.reason;
                    }
                    else
                        reason = 2;
                }else{

                    if(response.refresh==true){
                        reason=3;
                        valid = false;
                    }

                    check_id = response.checkid;
                }
            }
        });

        if(typeof user_connected != 'undefined' && user_connected=='admin'){
            valid = true;
        }
        if(typeof user_member != 'undefined' && user_member==20)
        {
            valid = true;
        }

        //valid = true;

        if(valid==false){
            switch(reason){
                case 1: alert(msg_error_b1); break;
                case 2: alert(msg_error_b2); break;
                case 3: alert(msg_error_b3); document.location.reload(); break;
                case "already_booked_today": alert(already_booked_today); break;
            }
            e.preventDefault();
            return false;
        }


        // admin case :
        $(".admin").hide();
        $("#options_lines").show();
        $(booking_form_nb_select).show();
        $("#admin_options_lines").hide();
        $("#admin_total").hide();
        $("#payBtn").hide();
        $("#saveBtn").show();
        $(".btnBackMember").hide();
        $("#endBtn").show();

        // 2.a set hidden field indicatiing the first position of availability
        $(booking_form_start_position).val($(this).data("availability"));
        // 2.b set hidden field indicating the date of the start
        $(booking_form_start_date).val($(this).data("dateoriginal"));
        // 2.c set hidden field indicating the parcours concerned
        $(booking_form_parcours).val(getParcours());




        // 3. Hide form messages
        $(form_success_box).hide();
        $(form_error_box).hide();
        $("#form_modal_msg_box").hide();

        //console.log($(this).data("date"));
        // 4. set general labels
        $(booking_form_date_label).html($(this).data('date'));
        $("#mobile_date_label").html($(this).data('date')+" <br /> "+$(this).data('start'));
        $(booking_form_start_label).html($(this).data('start'));
        $(booking_form_parcours_label).html(getParcoursLabel());
        $("#mobile_parcours_label").html(getParcoursLabel());
        $("#mobile_start_label").html($(this).data('start'));

        // 5. set holes img
        if(getParcours()==0){
            // serveriano = 18 trous
            $("#booking_form_holes_img").attr('src',drapeau_img );
        }
        else if(getParcours()==1){
            // jack nicklaus = 9 trous
            $(booking_form_holes_img).attr('src',drapeau9_img );
        }


        // 6. select nb players according to filter selected by user
        var nb_players_selected = getNbPlayers();
        switch(nb_players_selected){
            case 1: $(booking_form_nb_select+' option[value="1"]').prop('selected', 'selected');break;
            case 2: $(booking_form_nb_select+' option[value="2"]').prop('selected', 'selected');break;
            case 3: $(booking_form_nb_select+' option[value="3"]').prop('selected', 'selected');break;
            case 4: $(booking_form_nb_select+' option[value="4"]').prop('selected', 'selected');break;
        }

        // 7. get members who have already booked
        var dm = {
            "member1": {
                "firstname": $(this).data("member1firstname"), "lastname": $(this).data("member1lastname"),
                "handicap": $(this).data("member1handicap"), "asg": $(this).data("member1asg"), "country": $(this).data("member1country"),
            },
            "member2": {
                "firstname": $(this).data("member2firstname"), "lastname": $(this).data("member2lastname"),
                "handicap": $(this).data("member2handicap"), "asg": $(this).data("member2asg"), "country": $(this).data("member2country"),
            },
            "member3": {
                "firstname": $(this).data("member3firstname"), "lastname": $(this).data("member3lastname"),
                "handicap": $(this).data("member3handicap"), "asg": $(this).data("member3asg"), "country": $(this).data("member3country"),
            },
            "member4": {
                "firstname": $(this).data("member4firstname"), "lastname": $(this).data("member4lastname"),
                "handicap": $(this).data("member4handicap"), "asg": $(this).data("member4asg"), "country": $(this).data("member4country"),
            }
        };

        // 8. set form elements in default shape

        $("#p1_userid").val("");
        $("#p2_userid").val("");
        $("#p3_userid").val("");
        $("#p4_userid").val("");

        // 8.1 small cars
        $(booking_form_small_car_chk).attr('checked', false);
        $(booking_form_small_car_chk).show();
        $(booking_form_small_car_nb_select+" option:first").prop('selected','selected'); // prefill member 2 type
        $(booking_form_small_car_nb_select).hide();
        $(small_car_total_lbl_id).html("0.-");

        // 8.2 electric cars
        $(booking_form_electric_car_chk).attr('checked', false);
        $(booking_form_electric_car_chk).show();
        $(booking_form_electric_car_nb_select+" option:first").prop('selected','selected'); // prefill member 2 type
        $(booking_form_electric_car_nb_select).hide();
        $(electric_car_total_lbl_id).html("0.-");

        // 8.3 caddies
        $(booking_form_caddy_chk).attr('checked', false);
        $(booking_form_caddy_chk).show();
        $(booking_form_caddy_nb_select+" option:first").prop('selected','selected'); // prefill member 2 type
        $(booking_form_caddy_nb_select).hide();
        $(caddy_total_lbl_id).html("0.-");
        // 8.4 msg box
        $(form_modal_msg_box).hide();

        // 9. show fiels according to nb players and availability
        var nb_players = nb_players_filter; // seems odd...TODO !!!
        var availability = $(this).data("availability");
        showFieldsAccordingToNbPlayers(nb_players, availability, dm);

        // 10. remove error css olasss on the four lines
        for(member=1; member<5; member++){
            $("#booking_form_member_"+member+"_firstname_field").removeClass("errorField");
            $("#booking_form_member_"+member+"_lastname_field").removeClass("errorField");
            $("#booking_form_member_"+member+"_handicap_field").removeClass("errorField");
            $("#booking_form_member_"+member+"_type_select").removeClass("errorSelect");
            $("#booking_form_member_"+member+"_country").removeClass("errorField");
            $("#modal_form_line_proposals_"+member).hide(); // correction ouverture popup commande  2x => cacher propositions

        }
        $("#form_modal_error_box").hide();

        // 11. display the right prices
        estimateAndDisplayCost();

        //12. ?
        $(booking_form_nb_select+" option:first-child").attr("selected", "selected");
        $(booking_form_nb_select).change();

        //13. ?

        if(user_type == "visitor" || user_type == "member_no_login"){
            //$(".grp_crans").remove();
        }


    });

});

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// BOOKING FORM functions //////////////////////////////////////////////////////////////////////////////////////////////

// disable modal form's buttons
function disableOrderBtns(){
    $(end_btn).prop('disabled', true);
    $(save_btn).prop('disabled', true);
    $(cancel_btn).prop('disabled', true);
}
// disable modal form's buttons
function hideOrderBtns(){
    $(end_btn).css("visibility", "hidden");
    $(save_btn).css("visibility", "hidden");
    $(cancel_btn).css("visibility", "hidden");
}
// enable modal form's buttons
function enableOrderBtns(){
    $(end_btn).prop('disabled', false);
    $(save_btn).prop('disabled', false);
    $(cancel_btn).prop('disabled', false);
}
// move to url

function move(url){
    if(url=="reload")
        document.location.reload();
    else
        document.location.href=url;
}
// display line according to nb passed in param
function displayLine(nb){

    $("#booking_form_member_"+nb+"_total_label").html("").show();
    $("#booking_form_member_"+nb+"_firstname_field").show();
    $("#booking_form_member_"+nb+"_lastname_field").show();
    $("#booking_form_member_"+nb+"_handicap_field").show();
    $("#booking_form_member_"+nb+"_type_select").show().change();
    $("#modal_form_line_"+nb).show();

}

$(document).ready(function(){

    // check best prices for every week's days
    if(display == "row"){
        checkBestPricesForTheWeek();
    }



    // WHEN user select nb players
    $(booking_form_nb_select).on("change", function(){

        var nb_players = parseInt($(booking_form_nb_select+" option:selected").val());

        var availability = parseInt($(booking_form_start_position).val());
        var next = 4-availability+2;

        ////console.log(availability+"-"+nb_players);
        $(modal_form_line_1).hide();
        $(modal_form_line_2).hide();
        $(modal_form_line_3).hide();
        $(modal_form_line_4).hide();
        if(availability!=4){
            for(var i = 1; i<=(4-availability)+nb_players; i++){
                displayLine(i);
                if(i<=(4-availability)){
                    $("#booking_form_member_"+i+"_total_label").hide();
                }
            }

        }
        else{
            for(var i = 1; i<=nb_players; i++){
                displayLine(i);
            }
        }

        /*{#{% if app.user is defined and app.user.username is defined and app.user.username is not empty %}
         {% if  app.user.username=="pascal.schmalen" or app.user.username=="test" %}
         var next_place_possible = (4-availability) + 1;
         $("#booking_form_member_"+next_place_possible+"_firstname_field").val(user_firstname).prop("disabled", true).show();
         $("#booking_form_member_"+next_place_possible+"_lastname_field").val(user_lastname).prop("disabled", true).show();
         $("#booking_form_member_"+next_place_possible+"_handicap_field").val(user_handicap).prop("disabled", true).show();
         $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", true).show();  // disable member 4 type
         $("#booking_form_member_"+next_place_possible+"_type_select option[value=\""+user_member+"\"").prop('selected','selected');
         var cost =  $("#booking_form_member_"+next_place_possible+"_type_select option:selected").data("cost");
         $("#booking_form_member_"+next_place_possible+"_total_label").html(cost+".-").data("cost", cost).show();
         {% endif %}
         {% endif %}#}*/

        estimateAndDisplayCost();
    });

    // CHANGES on options -----------------------------------------------

    // WHEN user check caddy
    $(booking_form_caddy_chk).on("change", function(){

        if($(this).is(":checked")){
            $("#booking_form_caddy_nb_select").show();
            $("#booking_form_caddy_nb_select option[value='1']").prop('selected','selected'); // prefill caddy nb select
            $(booking_form_caddy_nb_select).change();
            estimateAndDisplayCost();

        }else{
            $("#booking_form_caddy_nb_select").hide();
            $("#booking_form_caddy_total").html("0.-").data("cost", "0");
            $("#booking_form_caddy_nb_select option:first").prop('selected','selected'); // prefill caddy nb select

            estimateAndDisplayCost();
        }

        estimateAndDisplayCost();
    });

    // WHEN user check small car
    $(booking_form_small_car_chk).on("change", function(){

        if($(this).is(":checked")){
            $("#booking_form_small_car_nb_select").show();
            $("#booking_form_small_car_nb_select option[value='1']").prop('selected','selected'); // prefill caddy nb select
            $(booking_form_small_car_nb_select).change();
            estimateAndDisplayCost();

        }else{
            $("#booking_form_small_car_nb_select").hide();
            $("#booking_form_small_car_total").html("0.-").data("cost", "0");
            $("#booking_form_small_car_nb_select option:first").prop('selected','selected'); // prefill caddy nb select

            estimateAndDisplayCost();
        }

        estimateAndDisplayCost();
    });

    // WHEN user check electric car
    $(booking_form_electric_car_chk).on("change", function(){

        if($(this).is(":checked")){
            $("#booking_form_electric_car_nb_select").show();
            $("#booking_form_electric_car_nb_select option[value='1']").prop('selected','selected'); // prefill caddy nb select
            $(booking_form_electric_car_nb_select).change();
            estimateAndDisplayCost();

        }else{
            $("#booking_form_electric_car_nb_select").hide();
            $("#booking_form_electric_car_total").html("0.-").data("cost", "0");
            $("#booking_form_electric_car_nb_select option:first").prop('selected','selected'); // prefill caddy nb select

            estimateAndDisplayCost();
        }

        estimateAndDisplayCost();
    });

    // WHEN user select nb caddy
    $(booking_form_caddy_nb_select).on("change", function() {

        var nb = $("#booking_form_caddy_nb_select option:selected").val();

        var total = nb * caddy_unity_price ;
        $("#booking_form_caddy_total").html(total.toFixed(2)).data("cost", total);

        estimateAndDisplayCost();
    });

    // WHEN user select nb small_car
    $(booking_form_small_car_nb_select).on("change", function() {

        var nb = $("#booking_form_small_car_nb_select option:selected").val();

        var total = nb * small_car_unity_price;
        $("#booking_form_small_car_total").html(total.toFixed(2)).data("cost", total);

        estimateAndDisplayCost();
    });

    // WHEN user select nb electric_car
    $(booking_form_electric_car_nb_select).on("change", function() {

        var nb = $("#booking_form_electric_car_nb_select option:selected").val();

        var total = nb * electric_car_unity_price ;
        $("#booking_form_electric_car_total").html(total.toFixed(2)).data("cost", total);

        estimateAndDisplayCost();
    });

    // CHANGES on member's type select ----------------------------------

    // WHEN change member type 1
    $(mb1_type_select_id).on("change", function(){

        var group=$(mb1_type_select_id+' :selected').parent().attr('label');
        //console.log("test "+group);
        if(group=="Crans" ){
            // check that the user is known
            checkCrans(1);
        }

        if(group=="Autres clubs" && $(mb1_type_select_id+' option:selected').val()==16){
            checkNicklaus(1);
        }

        var optionValue = $("#booking_form_member_1_type_select option:selected").val();
        var target = "#booking_form_member_1_type_select option:selected";
        ////console.log(optionValue);
        getRealCost(optionValue, target, mb1_total_lbl_id);
    });

    // WHEN change member type 2
    $(mb2_type_select_id).on("change", function(){
        var group=$(mb2_type_select_id+' :selected').parent().attr('label');
        //console.log("test "+group);
        if(group=="Crans"){
            // check that the user is known
            checkCrans(2);
        }

        if(group=="Autres clubs" && $(mb1_type_select_id+' option:selected').val()==16){
            checkNicklaus(2);
        }

        var optionValue = $("#booking_form_member_2_type_select option:selected").val();
        var target = "#booking_form_member_2_type_select option:selected";
        ////console.log(optionValue);
        getRealCost(optionValue, target, mb2_total_lbl_id);
    });

    // WHEN change member type 3
    $(mb3_type_select_id).on("change", function(){
        var group=$(mb3_type_select_id+' :selected').parent().attr('label');
        //console.log("test "+group);
        if(group=="Crans"){
            // check that the user is known
            checkCrans(3);
        }

        if(group=="Autres clubs" && $(mb1_type_select_id+' option:selected').val()==16){
            checkNicklaus(3);
        }

        var optionValue = $("#booking_form_member_3_type_select option:selected").val();
        var target = "#booking_form_member_3_type_select option:selected";
        getRealCost(optionValue, target, mb3_total_lbl_id);
    });

    // WHEN change member type 4
    $(mb4_type_select_id).on("change", function(){
        var group=$(mb4_type_select_id+' :selected').parent().attr('label');
        //console.log("test "+group);
        if(group=="Crans"){
            // check that the user is known
            checkCrans(4);
        }

        if(group=="Autres clubs" && $(mb1_type_select_id+' option:selected').val()==16){
            checkNicklaus(4);
        }

        var optionValue = $("#booking_form_member_4_type_select option:selected").val();
        var target = "#booking_form_member_4_type_select option:selected";
        getRealCost(optionValue, target, mb4_total_lbl_id);
    });



    $(member_1_lastname).on("change", function(){
        checkUserDb(1);
    });
    $(member_1_firstname).on("change", function(){
        checkUserDb(1);
    });
    $(member_2_lastname).on("change", function(){
        checkUserDb(2);
    });
    $(member_2_firstname).on("change", function(){
        checkUserDb(2);
    });
    $(member_3_lastname).on("change", function(){
        checkUserDb(3);
    });
    $(member_3_firstname).on("change", function(){
        checkUserDb(3);
    });
    $(member_4_lastname).on("change", function(){
        checkUserDb(4);
    });
    $(member_4_firstname).on("change", function(){
        checkUserDb(4);
    });
    $(member_1_hcp).on("keyup", function(){
        checkUserDb(1);
    });
    $(member_2_hcp).on("keyup", function(){
        checkUserDb(2);
    });
    $(member_3_hcp).on("keyup", function(){
        checkUserDb(3);
    });
    $(member_4_hcp).on("keyup", function(){
        checkUserDb(4);
    });
    /*$(member_1_hcp).on("change", function(){
        checkUserDb(1);
    });
    $(member_2_hcp).on("change", function(){
        checkUserDb(2);
    });
    $(member_3_hcp).on("change", function(){
        checkUserDb(3);
    });
    $(member_4_hcp).on("change", function(){
        checkUserDb(4);
    });*/

    $(member_1_type).on("change", function(){
        checkUserDb2(1);
    });
    $(member_2_type).on("change", function(){
        checkUserDb2(2);
    });
    $(member_3_type).on("change", function(){
        checkUserDb2(3);
    });
    $(member_4_type).on("change", function(){
        checkUserDb2(4);
    });

    // -------------------------------------------------------------------

    // SAVE / END BUTTONS ------------------------------------------------

    // WHEN save order
    $(save_btn).click( function(event){
        disableOrderBtns();

        // check fields validity
        if(!checkFieldsValidty())
            event.preventDefault();
        else{
            hideOrderBtns();
            saveOrder("reload");
        }

    });

    // WHEN end order
    $(end_btn).click( function(event){
        disableOrderBtns();

        // check fields validity
        if(!checkFieldsValidty())
            event.preventDefault();
        else{
            hideOrderBtns();
            saveOrder(home_checkout);
        }
    });

    // BOOKINGS FUNCTIONS

    $("#closeMyBookingsBtn").click(function(){
        $("#myBookingsContainer").hide();
        $(".gc-search").show();
        $(".gc-planning-journ").show();
    });

    $(".bookingEditBtn").click(function(){
        var target = "#detail_booking_"+$(this).data("id");
        $(target).show();
        $("#myBookingsTable").hide();
        $("#closeMyBookingsBtn").hide();
    });

    $(".closeMyBookingDetailBtn").click(function(){
        $(".myBookingsTableDetail").hide();
        $("#myBookingsTable").show();
        $("#closeMyBookingsBtn").show();
    });

    $(".bookingCancelBtn").click(function(){
        cancelBooking($(this).data("id"));
    });

    $(".bookingCancelPlayerBtn").click(function(){
        var id_booking = $(this).data("id");
        var player = $(this).data("player");
        cancelBookingPlayer(id_booking, player);
    });

    $("#cancelBtn").on("click", function(){
        freeBooking();
    })

});

var on_check=false;


function checkCrans(player){

    var date_ref = $("#dp1").val();
    var date_from = date_ref.substr(6,4)+"/"+date_ref.substr(3,2)+"/"+date_ref.substr(0,2);
    var test_days = false;

    if(date_from.length==10){
        test_days = true;
    }

    if(on_check==false){
        ////console.log("checkuserdb2 : not on check");
        on_check=true;
        var firstname = "";
        var lastname = "";
        var handicap = "";
        switch(player){
            case 1:
                firstname = $(member_1_firstname).val();
                lastname = $(member_1_lastname).val();
                handicap = $(member_1_hcp).val();
                break;
            case 2:
                firstname = $(member_2_firstname).val();
                lastname = $(member_2_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 3:
                firstname = $(member_3_firstname).val();
                lastname = $(member_3_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 4:
                firstname = $(member_4_firstname).val();
                lastname = $(member_4_lastname).val();
                handicap = $(member_4_hcp).val();
                break;
        }


        if(firstname != "" && lastname!=""){
            var target_type = "#booking_form_member_"+player+"_type_select";
            //$(target_type).hide();

            var member = $("#booking_form_member_"+player+"_type_select option:selected").val();
            var url = "../checkuser/"+firstname+"/"+lastname+"/"+member;
            //console.log(url);

            $.getJSON( url, null )
                .done(function( json ) {
                    if(json.result=="none"){
                        alert(no_user_corr);
                        $("#booking_form_member_"+player+"_type_select option:first").prop('selected', true);

                        var optionValue = $("#booking_form_member_"+player+"_type_select option:selected").val();
                        var target = "#booking_form_member_"+player+"_type_select option:selected";
                        ////console.log(optionValue);
                        getRealCost(optionValue, target, "#booking_form_member_"+player+"_total_label");
                    }

                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                })
                .fail(function( jqxhr, textStatus, error ) {
                    var err = textStatus + ", " + error;
                    ////console.log( "Request Failed: " + err );
                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                });
        }
        else{
            alert(sease_user);
            on_check = false;
            ////console.log("checkuserdb : not on check anymore");
        }
    }
    else{
        ////console.log("on_check");
    }

}


function checkNicklaus(player){

    var date_ref = $("#dp1").val();
    var date_from = date_ref.substr(6,4)+"/"+date_ref.substr(3,2)+"/"+date_ref.substr(0,2);
    var test_days = false;

    if(date_from.length==10){
        test_days = true;
    }

    if(on_check==false){
        ////console.log("checkuserdb2 : not on check");
        on_check=true;
        var firstname = "";
        var lastname = "";
        var handicap = "";
        switch(player){
            case 1:
                firstname = $(member_1_firstname).val();
                lastname = $(member_1_lastname).val();
                handicap = $(member_1_hcp).val();
                break;
            case 2:
                firstname = $(member_2_firstname).val();
                lastname = $(member_2_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 3:
                firstname = $(member_3_firstname).val();
                lastname = $(member_3_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 4:
                firstname = $(member_4_firstname).val();
                lastname = $(member_4_lastname).val();
                handicap = $(member_4_hcp).val();
                break;
        }


        if(firstname != "" && lastname!=""){
            var target_type = "#booking_form_member_"+player+"_type_select";
            //$(target_type).hide();

            var member = $("#booking_form_member_"+player+"_type_select option:selected").val();
            var url = "../checkuser/"+firstname+"/"+lastname+"/"+member;
            //console.log(url);

            $.getJSON( url, null )
                .done(function( json ) {
                    if(json.result=="none"){
                        alert(no_user_jn_corr);
                        $("#booking_form_member_"+player+"_type_select option:first").prop('selected', true);

                        var optionValue = $("#booking_form_member_"+player+"_type_select option:selected").val();
                        var target = "#booking_form_member_"+player+"_type_select option:selected";
                        ////console.log(optionValue);
                        getRealCost(optionValue, target, "#booking_form_member_"+player+"_total_label");
                    }

                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                })
                .fail(function( jqxhr, textStatus, error ) {
                    var err = textStatus + ", " + error;
                    ////console.log( "Request Failed: " + err );
                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                });
        }
        else{
            $("#booking_form_member_"+player+"_type_select option:first").prop('selected', true);
            alert(sease_user_jn);
            on_check = false;
            ////console.log("checkuserdb : not on check anymore");
        }
    }
    else{
        ////console.log("on_check");
    }

}

function checkUserDb2(player){


    if(on_check==false){
        ////console.log("checkuserdb2 : not on check");
        on_check=true;
        var firstname = "";
        var lastname = "";
        var handicap = "";
        switch(player){
            case 1:
                firstname = $(member_1_firstname).val();
                lastname = $(member_1_lastname).val();
                handicap = $(member_1_hcp).val();
                break;
            case 2:
                firstname = $(member_2_firstname).val();
                lastname = $(member_2_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 3:
                firstname = $(member_3_firstname).val();
                lastname = $(member_3_lastname).val();
                handicap = $(member_3_hcp).val();
                break;
            case 4:
                firstname = $(member_4_firstname).val();
                lastname = $(member_4_lastname).val();
                handicap = $(member_4_hcp).val();
                break;
        }

        if(firstname != "" && lastname!="" && handicap=="" ){
            var target_type = "#booking_form_member_"+player+"_type_select";
            //$(target_type).hide();


            var url = "../checkuser/"+encodeURI(firstname)+"/"+encodeURI(lastname);
            $.getJSON( url, null )
                .done(function( json ) {
                    validType(json, player);
                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                })
                .fail(function( jqxhr, textStatus, error ) {
                    var err = textStatus + ", " + error;
                    ////console.log( "Request Failed: " + err );
                    on_check = false;
                    ////console.log("checkuserdb2 : not on check anymore");
                });
        }
        else{
            on_check = false;
            ////console.log("checkuserdb : not on check anymore");
        }
    }
    else{
        ////console.log("on_check");
    }

}

function checkUserDb(player){
    var target = parseInt(document.getElementById("booking_form_start_position").value); // ex : 4
    // player = 1
    var valid = true;

    if(target == 4 && player == 1 && user_defined=="member_no_login"){var valid =false;}
    else if(target == 3 && player == 2 && user_defined=="member_no_login"){var valid =false;}
    else if(target == 2 && player == 3 && user_defined=="member_no_login"){var valid =false;}
    else if(target == 1 && player == 4 && user_defined=="member_no_login"){var valid =false;}
    else if(user_defined=="anonymous"){var valid =false;}

    if(on_check==false && valid== true ) {
        ////console.log("checkuserdb : not on check");
        on_check = true;
        var firstname = "";
        var lastname = "";
        switch (player) {
            case 1:
                firstname = $(member_1_firstname).val();
                lastname = $(member_1_lastname).val();
                break;
            case 2:
                firstname = $(member_2_firstname).val();
                lastname = $(member_2_lastname).val();
                break;
            case 3:
                firstname = $(member_3_firstname).val();
                lastname = $(member_3_lastname).val();
                break;
            case 4:
                firstname = $(member_4_firstname).val();
                lastname = $(member_4_lastname).val();
                break;
        }

        if (firstname != "" && lastname != "") {
            var target_type = "#booking_form_member_" + player + "_type_select";
            //$(target_type).hide();
            var url = "../checkuser/" + rfc3986EncodeURIComponent(firstname) + "/" + rfc3986EncodeURIComponent(lastname);
            $.getJSON(url, null)
                .done(function (json) {
                    proposeUsers(json, player);
                    on_check = false;
                    //console.log("checkuserdb : not on check anymore");
                })
                .fail(function (jqxhr, textStatus, error) {
                    var err = textStatus + ", " + error;
                    ////console.log("Request Failed: " + err);
                    on_check = false;
                    //console.log("checkuserdb : not on check anymore");
                });
        }
        else{
            on_check = false;
            //console.log("checkuserdb : not on check anymore");
        }
    }
    else{
       //console.log("on_check");
    }
}

function rfc3986EncodeURIComponent (str) {
    return encodeURIComponent(str).replace(/[!'()*]/g, escape);
}

function validType(datas, player){
    //console.log(datas);
    //var datas = JSON.parse(data);
    if(datas.result=="none"){

    }
    else if(datas.result=="single"){
        //console.log("single");
        var target_type = "#booking_form_member_"+player+"_type_select";
        $(target_type + ' option').removeAttr("selected");
        $(target_type + " option[value="+datas.member+"]").prop('selected', 'selected');
        var optionValue = datas.member;
        var target = target_type+" option:selected";
        getRealCost(optionValue, target, "#booking_form_member_"+player+"_total_label"); // to check HERE WATCH OUT !!!!
        //alert("Le type de membre du joueur "+player+" ne correspond pas");
        //var html = '<td colspan="5">Voulez-vous inscrire <strong>'+datas.firstname+' '+datas.lastname+' - membre '+datas.memberLabel+'</strong> - Handicap : <strong>'+datas.handicap+'</strong></td><td><a href="">Confirmer</a>';
        //$("#modal_form_line_proposals_1").html(html).show();
    }
    else if(datas.result=="multiple"){
        $("#modal_form_line_proposals_"+player).hide();
        /*//console.log("multiple case 2");
        for(result in datas.results){
            var html = '<td colspan="5">Voulez-vous inscrire <strong>'+datas.firstname+' '+datas.lastname+' - membre '+datas.memberLabel+'</strong> - Handicap : <strong>'+datas.handicap+'</strong></td><td><a href="">Confirmer</a>';
        }
        $("#modal_form_line_proposals_1").html(html).show();*/

    }
    //$(target_type).show();
}

function proposeUsers(datas, player){

    //console.log(datas);
    //var datas = JSON.parse(data);
    if(datas.result=="none"){
        var target_type = "#booking_form_member_"+player+"_type_select";
        $(target_type + ' option[value="4"]').prop('selected', 'selected');
        var optionValue = 4;

        if(user_member == 20){
            optionValue = 20;
        }

        var target = target_type+" option:selected";
        getRealCost(optionValue, target,  "#booking_form_member_"+player+"_total_label"); // to check HERE WATCH OUT !!!!
        $("#modal_form_line_proposals_"+player).html('').hide();
    }
    // Désactivée
    else if(datas.result=="single-disable"){
        //console.log("single");
        var target_type = "#booking_form_member_"+player+"_type_select";
        //console.log(target_type + ' option[value="'+datas.member+'"]');
        $("#booking_form_member_"+player+"_handicap_field").val(datas.handicap);
        $(target_type + ' option').removeAttr("selected");
        $(target_type + ' option[value="'+datas.member+'"]').prop('selected', 'selected');
        var optionValue = datas.member;

        var target = target_type+" option:selected";
        getRealCost(optionValue, target,  "#booking_form_member_"+player+"_total_label"); // to check HERE WATCH OUT !!!!
        //var html = '<td colspan="5">Voulez-vous inscrire <strong>'+datas.firstname+' '+datas.lastname+' - membre '+datas.memberLabel+'</strong> - Handicap : <strong>'+datas.handicap+'</strong></td><td><a href="">Confirmer</a>';
        //$("#modal_form_line_proposals_1").html(html).show();
        $("#modal_form_line_proposals_"+player).html('').hide();

        // disable user's field
        $("#booking_form_member_"+player+"_firstname_field").prop('disabled', true);
        $("#booking_form_member_"+player+"_lastname_field").prop('disabled', true);
        $("#booking_form_member_"+player+"_handicap_field").prop('disabled', true);
        $("#booking_form_member_"+player+"_type_select").prop('disabled', true);
        $("#btnBackMember_"+player).show();
    }
    else if(datas.result=="multiple" || datas.result=="single"){
        //console.log("multiple case 1");
        var html= "";
        //console.log(datas.results.length);
        for(var i=0; i<datas.results.length; i++){
            var result = datas.results[i];
            html += wish_subscribe + ' <strong>'+result.firstname+' '+result.lastname+' - membre '+result.memberLabel+'</strong> - '+wish_hcp+' : <strong>'+result.handicap+', '+result.birthdate+'</strong>&nbsp; <a class="proposalBtn" ' + 'data-player="'+player+'" data-handicap="'+result.handicap+'" data-firstname="'+result.firstname+'" data-lastname="'+result.lastname+'" data-member="'+result.member+'" data-userid="'+result.userid+'">'+wish_confirm+'</a><br />';

        }

        //console.log(html);

        $("#modal_form_line_proposals_"+player).html('<td colspan="7">'+html+"</td>").show();

        $(".proposalBtn").click(function(){
            var player = $(this).data("player");
            var member = $(this).data("member");
            var handicap = $(this).data("handicap");
            var firstname = $(this).data("firstname");
            var lastname = $(this).data("lastname");
            var userid = $(this).data("userid");

            $("#booking_form_member_"+player+"_lastname_field").val(lastname);
            $("#booking_form_member_"+player+"_firstname_field").val(firstname);
            $("#booking_form_member_"+player+"_handicap_field").val(handicap);
            $("#booking_form_member_"+player+'_type_select option[value="'+member+'"]').prop('selected', 'selected');

            var target_type = "#booking_form_member_"+player+"_type_select";
            var optionValue = member;
            var target = target_type+" option:selected";
            getRealCost(optionValue, target,  "#booking_form_member_"+player+"_total_label"); // to check HERE WATCH OUT !!!!

            // disable user's field
            $("#booking_form_member_"+player+"_firstname_field").prop('disabled', true);
            $("#booking_form_member_"+player+"_lastname_field").prop('disabled', true);
            $("#booking_form_member_"+player+"_handicap_field").prop('disabled', true);
            $("#booking_form_member_"+player+"_type_select").prop('disabled', true);
            $("#btnBackMember_"+player).show();

            $("#p"+player+"_userid").val(userid);

            $("#modal_form_line_proposals_"+player).html('').hide();

        });


    }
    //$(target_type).show();
}


$(".btnBackMember").click(function(){
   var player = $(this).data("target");
    if(typeof user_connected != 'undefined' && user_connected=="admin"){
        $("#booking_form_member_"+player+"_firstname_field").prop('disabled', false)
        $("#booking_form_member_"+player+"_lastname_field").prop('disabled', false)
        $("#booking_form_member_"+player+"_handicap_field").prop('disabled', false)
        $("#booking_form_member_"+player+"_type_select").prop('disabled', false);
    }
    else{
        $("#booking_form_member_"+player+"_firstname_field").prop('disabled', false).val("");
        $("#booking_form_member_"+player+"_lastname_field").prop('disabled', false).val("");
        $("#booking_form_member_"+player+"_handicap_field").prop('disabled', false).val("");
        $("#booking_form_member_"+player+"_type_select").prop('disabled', false);
        $("#booking_form_member_"+player+"_type_select option:first").prop('selected', true);
    }

    $(this).hide();
});

// cancel booking
function cancelBooking(booking_id){
    if(confirm(txt_confirm_booking_cancel +" "+booking_id+ " ?")){
        $.post(path_cancel_order + "?action=del&id="+ booking_id,  function(data) {

        })
        .done(function() {
            $(".myBookingsTableDetail").hide();
            $("#booking_edit_line_"+booking_id).remove();
            $("#myBookingsTable").show();
            $("#closeMyBookingsBtn").show();
            document.location.reload();
        })
        .fail(function() {
            ////console.log( "error during operation" );

        })
        .always(function() {
            ////console.log( "operation finished" );
        });
    }
}

// cancel booking
function cancelBookingPlayer(booking_id, player){
    if(confirm(txt_confirm_booking_cancel +" "+booking_id+ " du jouer"+player+" ?")){
        $.post("../order/remove/player/"+booking_id+"/"+player,  function(data) {
            ////console.log(data);
        })
        .done(function() {
            document.location.reload();
        })
        .fail(function() {
            ////console.log( "error during operation" );

        })
        .always(function() {
            ////console.log( "operation finished" );
        });
    }
}

// show/hide fields according to nb players
function showFieldsAccordingToNbPlayers(nb_players, availability, dm){


    if(nb_players>availability && availability!=null){
        //var msg = "Attention : Il n'y a pas assez de place disponible ("+availability+") par rapport au nombre de participants que vous souhaitez inscrire ("+nb_players+")!";
        //$("#form_modal_msg_box").html(msg).show();
        $(booking_form_nb_select+' option[value="' + availability + '"]').prop('selected', 'selected');
        nb_players = availability;
    }

    if(availability!=null){
        var counter = 0;
        $(booking_form_nb_select+" option").each(function(){
            counter++;
            if(counter<=(availability)){
                $(this).css('display','block');
            }
            else if(counter>(availability)){
                $(this).css('display','none');
            }
        });
    }

    // init form fields
    for(var i = 1; i<= 4; i++){

        $("#booking_form_member_"+i+"_firstname_field").val("").prop("disabled", false).hide();
        $("#booking_form_member_"+i+"_lastname_field").val("").prop("disabled", false).hide();
        $("#booking_form_member_"+i+"_handicap_field").val("").prop("disabled", false).hide();
        $("#booking_form_member_"+i+"_type_select").attr("disabled", false).hide();  // disable member 4 type
        $("#booking_form_member_"+i+"_type_select option:first").prop('selected', 'selected');
        $("#booking_form_member_"+i+"_total_label").html("").data("cost", 0).hide();
        $("#modal_form_line_"+i).show();
    }

    // display example members

    for(var i = 1; i<= (4-availability); i++){
        if(i==1){
            var firstname = dm["member1"].firstname; var lastname = dm["member1"].lastname; var handicap = dm["member1"].handicap; var type = dm["member1"].type;
        }
        else if(i==2){
            var firstname = dm["member2"].firstname; var lastname = dm["member2"].lastname; var handicap = dm["member2"].handicap; var type = dm["member2"].type;
        }
        else if(i==3){
            var firstname = dm["member3"].firstname; var lastname = dm["member3"].lastname; var handicap = dm["member3"].handicap; var type = dm["member3"].type;
        }

        $("#booking_form_member_"+i+"_firstname_field").val(firstname).prop("disabled", true).show();
        $("#booking_form_member_"+i+"_lastname_field").val(lastname).prop("disabled", true).show();
        $("#booking_form_member_"+i+"_handicap_field").val(handicap).prop("disabled", true).show();
        $("#booking_form_member_"+i+"_type_select").attr("disabled", true).hide();// disable member 4 type
        //$("#booking_form_member_"+i+'_type_select option[value="'+type+'"]').prop('selected','selected');
        $("#booking_form_member_"+i+"_total_label").html("").data("cost", 0).hide();
    }

    // prefill next field possible with
    if(user_defined=="member" && typeof user_connected != "undefined"){

        var next_place_possible = (4-availability) + 1;
        $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", false).show();  // disable member 4 type

        var cost =  $("#booking_form_member_"+next_place_possible+"_type_select option:selected").data("cost");

        $("#booking_form_member_"+next_place_possible+"_total_label").html(cost+".-").data("cost", cost).show();
        $("#booking_form_member_"+next_place_possible+"_type_select option[value='"+user_member+"']").prop('selected','selected');
        var optionValue = $("#booking_form_member_"+next_place_possible+"_type_select option:selected").val();

        var target = "#booking_form_member_"+next_place_possible+"_type_select option:selected";
        getRealCost(optionValue, target, "#booking_form_member_"+next_place_possible+"_total_label");
    }

    if(user_defined=="member" && typeof user_connected == "undefined"){

        var next_place_possible = (4-availability) + 1;

        var disabledField = true;
        // Si membre hôtel
        if(user_member == 20){
            disabledField = false;
        }

        $("#booking_form_member_"+next_place_possible+"_firstname_field").val(user_firstname).prop("disabled", disabledField).show();
        $("#booking_form_member_"+next_place_possible+"_lastname_field").val(user_lastname).prop("disabled", disabledField).show();
        $("#booking_form_member_"+next_place_possible+"_handicap_field").val(user_handicap).prop("disabled", disabledField).show();
        $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", true).show();  // disable member 4 type
        $("#booking_form_member_"+next_place_possible+"_type_select option[value='"+user_member+"']").prop('selected','selected');

        var cost =  $("#booking_form_member_"+next_place_possible+"_type_select option:selected").data("cost");

        $("#booking_form_member_"+next_place_possible+"_total_label").html(cost+".-").data("cost", cost).show();
        var optionValue = $("#booking_form_member_"+next_place_possible+"_type_select option:selected").val();

        var target = "#booking_form_member_"+next_place_possible+"_type_select option:selected";
        getRealCost(optionValue, target, "#booking_form_member_"+next_place_possible+"_total_label");

        $("#p"+next_place_possible+"_userid").val(member_id_connected);

        for(var i=1; i<=(nb_players-1);i++){
            next_place_possible += 1;
            $("#booking_form_member_"+next_place_possible+"_firstname_field").val("").prop("disabled", false).show();
            $("#booking_form_member_"+next_place_possible+"_lastname_field").val("").prop("disabled", false).show();
            $("#booking_form_member_"+next_place_possible+"_handicap_field").val("").prop("disabled", false).show();
            $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", false).show();
            $("#booking_form_member_"+next_place_possible+"_type_select option:first").prop('selected','selected');

            var optionValue = $("#booking_form_member_"+next_place_possible+"_type_select option:selected").val();
            var target = "#booking_form_member_"+next_place_possible+"_type_select option:selected";
            ////console.log(optionValue);
            getRealCost(optionValue, target, "#booking_form_member_"+next_place_possible+"_total_label");

            $("#booking_form_member_"+next_place_possible+"_total_label").html("0").data("cost", 0).show();
        }

        if(user_member == 20){
            disabledField = false;
            $("#booking_form_member_1_type_select").prop("disabled", false);
        }

        next_place_possible = next_place_possible +1;
        ////console.log(next_place_possible);
        if(next_place_possible<5){
            for(var i=4; i>=next_place_possible;i--){
                $("#modal_form_line_"+i).hide();
            }
        }


    }
    else if(user_defined=="member_no_login"){

        var next_place_possible = (4-availability) + 1;
        $("#booking_form_member_"+next_place_possible+"_firstname_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_lastname_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_handicap_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", false).show();// disable member 4 type
        $("#booking_form_member_"+next_place_possible+"_type_select option:contains(\""+user_member+"\")").prop('selected','selected');

        var optionValue = $("#booking_form_member_"+next_place_possible+"_type_select option:selected").val();
        var target = "#booking_form_member_"+next_place_possible+"_type_select option:selected";
        ////console.log(optionValue);
        getRealCost(optionValue, target, "#booking_form_member_"+next_place_possible+"_total_label");

        $("#booking_form_member_"+next_place_possible+"_total_label").html("").data("cost", 0).hide();
    }
    else if( typeof user_connected == "undefined" ){
        var next_place_possible = (4-availability) + 1;
        $("#booking_form_member_"+next_place_possible+"_firstname_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_lastname_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_handicap_field").val("").prop("disabled", false).show();
        $("#booking_form_member_"+next_place_possible+"_type_select").attr("disabled", false).show();// disable member 4 type
        $("#booking_form_member_"+next_place_possible+"_type_select option[value=\"4\"]").prop('selected','selected');

        var optionValue = $("#booking_form_member_"+next_place_possible+"_type_select option:selected").val();
        var target = "#booking_form_member_"+next_place_possible+"_type_select option:selected";
        ////console.log(optionValue);
        ////console.log("recherche prix...");
        getRealCost(optionValue, target, "#booking_form_member_"+next_place_possible+"_total_label");

        $("#booking_form_member_"+next_place_possible+"_total_label").html("").data("cost", 0).hide();
    }

}

// save order : return boolean indicating if operation is a success or a fail
function saveOrder(target){

    //caddy
    if($("#booking_form_caddy_nb_select").is(":visible") && $("#booking_form_caddy_nb_select option:selected").val()!="0"){
        var caddy = $("#booking_form_caddy_nb_select option:selected").val();
    }
    else
        var caddy = null;

    if($("#booking_form_small_car_nb_select").is(":visible") && $("#booking_form_small_car_nb_select option:selected").val()!="0"){
        var small_car = $("#booking_form_small_car_nb_select option:selected").val();
    }
    else
        var small_car = null;

    if($("#booking_form_electric_car_nb_select").is(":visible") && $("#booking_form_electric_car_nb_select option:selected").val()!="0"){
        var electric_car = $("#booking_form_electric_car_nb_select option:selected").val();
    }
    else
        var electric_car = null;

    if($(member_1_firstname).is(":visible")){
        var m1_firstname = $(member_1_firstname).val();
        var m1_lastname = $(member_1_lastname).val();
        var m1_country = $(member_1_country).val();
        var m1_type = $(member_1_type+" option:selected").val();
        var m1_cost =  $(mb1_type_select_id + " option:selected").data("cost");
        var m1_hcp = $(member_1_hcp).val();
        var m1_userid = $('#p1_userid').val();
    }
    else{
        var m1_firstname = null;
        var m1_lastname = null;
        var m1_country = null;
        var m1_type = null;
        var m1_cost =  null;
        var m1_hcp = null;
        var m1_userid = null;
    }
    if($(member_2_firstname).is(":visible")){
        var m2_firstname = $(member_2_firstname).val();
        var m2_lastname = $(member_2_lastname).val();
        var m2_country = $(member_2_country).val();
        var m2_type = $(member_2_type+" option:selected").val();
        var m2_cost =  $(mb2_type_select_id + " option:selected").data("cost");
        var m2_hcp = $(member_2_hcp).val();
        var m2_userid = $('#p2_userid').val();
    }
    else{
        var m2_firstname = null;
        var m2_lastname = null;
        var m2_country = null;
        var m2_type = null;
        var m2_cost =  null;
        var m2_hcp = null;
        var m2_userid = null;
    }
    if($(member_3_firstname).is(":visible")){
        var m3_firstname = $(member_3_firstname).val();
        var m3_lastname = $(member_3_lastname).val();
        var m3_country = $(member_3_country).val();
        var m3_type = $(member_3_type+" option:selected").val();
        var m3_cost =  $(mb3_type_select_id + " option:selected").data("cost");
        var m3_hcp = $(member_3_hcp).val();
        var m3_userid = $('#p3_userid').val();
    }
    else{
        var m3_firstname = null;
        var m3_lastname = null;
        var m3_country = null;
        var m3_type = null;
        var m3_cost =  null;
        var m3_hcp = null;
        var m3_userid = $('#p3_userid').val();
    }
    if($(member_4_firstname).is(":visible")){
        var m4_firstname = $(member_4_firstname).val();
        var m4_lastname = $(member_4_lastname).val();
        var m4_country = $(member_4_country).val();
        var m4_type = $(member_4_type+" option:selected").val();
        var m4_cost =  $(mb4_type_select_id + " option:selected").data("cost");
        var m4_hcp = $(member_4_hcp).val();
        var m4_userid = $('#p4_userid').val();
    }
    else{
        var m4_cost = null;
        var m4_firstname = null;
        var m4_lastname = null;
        var m4_country = null;
        var m4_type = null;
        var m4_cost =  null;
        var m4_hcp = null;
        var m4_userid = null;
    }

    if(user_member==20){
        var m1_userid = null;
        var m2_userid = null;
        var m3_userid = null;
        var m4_userid = null;
    }

    var datas = {

        admin: adminValue,

        availability: $("#booking_form_start_position").val(),
        start_date: $("#booking_form_start_date").val(),
        parcours: $("#booking_form_parcours").val(),
        nb_players: $(booking_form_nb_select+" option:selected").val(),

        member_booking_id: member_id_connected, // the one that book !

        /* member 1 */
        member_1_firstname: m1_firstname,
        member_1_lastname: m1_lastname,
        member_1_hcp: m1_hcp,
        member_1_country: m1_country,
        member_1_type: m1_type,
        member_1_cost: m1_cost,
        member_1_userid: m1_userid,

        /*member_1_firstname: $(member_1_firstname).val(),
        member_1_lastname: $(member_1_lastname).val(),
        member_1_hcp: $(member_1_hcp).val(),
        member_1_country: $(member_1_country).val(),
        member_1_type: $(member_1_type+" option:selected").val(),
        member_1_cost: $(mb1_type_select_id + " option:selected").data("cost"),*/

        /* member 2 */

        member_2_firstname: m2_firstname,
        member_2_lastname: m2_lastname,
        member_2_hcp: m2_hcp,
        member_2_country: m2_country,
        member_2_type: m2_type,
        member_2_cost: m2_cost,
        member_2_userid: m2_userid,

        /*member_2_firstname: $(member_2_firstname).val(),
        member_2_lastname: $(member_2_lastname).val(),
        member_2_hcp: $(member_2_hcp).val(),
        member_2_country: $(member_2_country).val(),
        member_2_type: $(member_2_type+" option:selected").val(),
        member_2_cost: $(mb2_type_select_id + " option:selected").data("cost"),*/

        /* member 3 */

        member_3_firstname: m3_firstname,
        member_3_lastname: m3_lastname,
        member_3_hcp: m3_hcp,
        member_3_country: m3_country,
        member_3_type: m3_type,
        member_3_cost: m3_cost,
        member_3_userid: m3_userid,

        /*member_3_firstname: $(member_3_firstname).val(),
        member_3_lastname: $(member_3_lastname).val(),
        member_3_hcp: $(member_3_hcp).val(),
        member_3_country: $(member_3_country).val(),
        member_3_type: $(member_3_type+" option:selected").val(),
        member_3_cost: $(mb3_type_select_id + " option:selected").data("cost"),*/

        /* member 4 */

        member_4_firstname: m4_firstname,
        member_4_lastname: m4_lastname,
        member_4_hcp: m4_hcp,
        member_4_country: m4_country,
        member_4_type: m4_type,
        member_4_cost: m4_cost,
        member_4_userid: m4_userid,

        /*member_4_firstname: $(member_4_firstname).val(),
        member_4_lastname: $(member_4_lastname).val(),
        member_4_hcp: $(member_4_hcp).val(),
        member_4_country: $(member_4_country).val(),
        member_4_type: $(member_4_type+" option:selected").val(),
        member_4_cost: $(mb4_type_select_id + " option:selected").data("cost"),*/

        /* options */
        small_car: small_car,
        electric_car: electric_car,
        caddy: caddy,

        small_car_cost: small_car * small_car_unity_price,
        electric_car_cost: electric_car * electric_car_unity_price,
        caddy_cost: caddy * caddy_unity_price,

        is_admin: isAdmin,
    };

    //console.log(datas); return false; // help to debug when user clicks to save order (stop sending) !!!

    var error_booking = true;
    var error_booking_msg = "";
    var postOrder = $.post( path_home_save_book, datas,  function(data) {
        ////console.log("Retour: "+data.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase()); // to erase
        if(data.replace(/^\s*/,'').replace(/\s*$/,'').toLowerCase()==""){
            error_booking = false;
            $(form_success_box).show().html(success_save_booking);
            freeBooking();
            //$(".close").click();
        }
        else{
            error_booking = true;
            ////console.log(error_bookings);
            ////console.log(data);
            ////console.log(error_bookings[data]);
            $(end_btn).css("visibility", "visible");
            $(save_btn).css("visibility", "visible");
            $(cancel_btn).css("visibility", "visible");
            $(form_error_box).show().html(error_bookings[data]);
        }
    })
    .done(function() {
        if(!error_booking){
            freeBooking();
            move(target); // to uncomment
        }
    })
    .fail(function() {
        ////console.log( "error during operation" );
        $(form_error_box).show().html(error_bookings["unknown"]);
    })
    .always(function() {
        ////console.log( "operation finished" );
    });

    return true;
}

// estimate cost of the order according to options
function estimateAndDisplayCost(){

    // ESTIMATE
    var total = 0;

    // check member 1 cost
    var member_1_cost = $(mb1_type_select_id + " option:selected").data("cost");
    var member_2_cost = $(mb2_type_select_id + " option:selected").data("cost");
    var member_3_cost = $(mb3_type_select_id + " option:selected").data("cost");
    var member_4_cost = $(mb4_type_select_id + " option:selected").data("cost");

    var member_1_percent = $(mb1_type_select_id + " option:selected").data("percent");
    var member_2_percent = $(mb2_type_select_id + " option:selected").data("percent");
    var member_3_percent = $(mb3_type_select_id + " option:selected").data("percent");
    var member_4_percent = $(mb4_type_select_id + " option:selected").data("percent");

    if(typeof member_1_cost === "undefined" || $(mb1_total_lbl_id).is(":hidden")){member_1_cost=0;}
    if(typeof member_2_cost === "undefined" || $(mb2_total_lbl_id).is(":hidden")){member_2_cost=0;}
    if(typeof member_3_cost === "undefined" || $(mb3_total_lbl_id).is(":hidden")){member_3_cost=0;}
    if(typeof member_4_cost === "undefined" || $(mb4_total_lbl_id).is(":hidden")){member_4_cost=0;}
    if(typeof member_1_cost === "NaN"){member_1_cost=0;}
    if(typeof member_2_cost === "NaN"){member_2_cost=0;}
    if(typeof member_3_cost === "NaN"){member_3_cost=0;}
    if(typeof member_4_cost === "NaN"){member_4_cost=0;}

    var small_car_cost = parseFloat($(small_car_total_lbl_id).data("cost"));
    var electric_car_cost = parseFloat($(electric_car_total_lbl_id).data("cost"));
    var caddy_cost = parseFloat($(caddy_total_lbl_id).data("cost"));
    // DEBUG :
    ////console.log("calcul : mb1:" + member_1_cost+" , mb2: " + member_2_cost + " , mb3: " + member_3_cost+" , mb4: " + member_4_cost + "caddy: "+ caddy_cost + " , small_car : " + small_car_cost);

    total = parseFloat(member_1_cost)+parseFloat(member_2_cost)+parseFloat(member_3_cost)+parseFloat(member_4_cost)+caddy_cost+small_car_cost+electric_car_cost;

    // DISPLAY

    if(member_1_percent == null || member_1_percent == 0 || typeof member_1_percent === undefined){
        $(mb1_total_lbl_id).html(parseFloat(member_1_cost).toFixed(2));
    }
    else{
        var old_value = parseFloat(member_1_cost)/((100-member_1_percent)/100);
        if(member_1_percent==100){
            var html =  "<del style='color: darkred;'>" +$(mb1_type_select_id + " option:selected").data("normal") + "</del> &nbsp;" + parseFloat(member_1_cost).toFixed(2);
        }
        else{
            var html = "<del style='color: darkred;'>"+parseFloat(old_value).toFixed(2)+"</del> &nbsp;"+ parseFloat(member_1_cost).toFixed(2);
        }

        $(mb1_total_lbl_id).html(html);
    }

    if(member_2_percent == null || member_2_percent == 0 || typeof member_2_percent === undefined){
        $(mb2_total_lbl_id).html(parseFloat(member_2_cost).toFixed(2));
    }
    else{
        var old_value = parseFloat(member_2_cost)/((100-member_2_percent)/100);
        if(member_2_percent==100){
            var html = "<del style='color: darkred;'>" + $(mb2_type_select_id + " option:selected").data("normal") + "</del> &nbsp;" + parseFloat(member_2_cost).toFixed(2);
        }
        else {
            var html = "<del style='color: darkred;'>" + parseFloat(old_value).toFixed(2) + "</del> &nbsp;" + parseFloat(member_2_cost).toFixed(2);
        }
        $(mb2_total_lbl_id).html(html);
    }

    if(member_3_percent == null || member_3_percent == 0 || typeof member_3_percent === undefined){
        $(mb3_total_lbl_id).html(parseFloat(member_3_cost).toFixed(2));
    }
    else{
        var old_value = parseFloat(member_3_cost)/((100-member_3_percent)/100);
        if(member_3_percent==100){
            var html =  "<del style='color: darkred;'>" + $(mb3_type_select_id + " option:selected").data("normal") + "</del> &nbsp;" + parseFloat(member_3_cost).toFixed(2);
        }
        else {
            var html = "<del style='color: darkred;'>"+parseFloat(old_value).toFixed(2)+"</del> &nbsp;"+ parseFloat(member_3_cost).toFixed(2);
        }
        $(mb3_total_lbl_id).html(html);
    }

    if(member_4_percent == null || member_4_percent == 0 || typeof member_4_percent === undefined){
        $(mb4_total_lbl_id).html(parseFloat(member_4_cost).toFixed(2));
    }
    else{
        var old_value = parseFloat(member_4_cost)/((100-member_4_percent)/100);
        if(member_4_percent==100){
            var html =  "<del style='color: darkred;'>" + $(mb4_type_select_id + " option:selected").data("normal") + "</del> &nbsp;" + parseFloat(member_4_cost).toFixed(2);
        }
        else {
            var html = "<del style='color: darkred;'>" + parseFloat(old_value).toFixed(2) + "</del> &nbsp;" + parseFloat(member_4_cost).toFixed(2);
        }
        $(mb4_total_lbl_id).html(html);
    }

    /*$(mb2_total_lbl_id).html(parseFloat(member_2_cost).toFixed(2));
    $(mb3_total_lbl_id).html(parseFloat(member_3_cost).toFixed(2));
    $(mb4_total_lbl_id).html(parseFloat(member_4_cost).toFixed(2));*/

    $(total_lbl_id).html(total.toFixed(2)).data("cost", total);  // enable member 2 type
}

// check fields validity : return boolean indicating if operation is a success or a fail
function checkFieldsValidty(){
    var nb_players_selected = $(booking_form_nb_select+" option:selected").val();
    var return_bool = true;
    var availability = $("#booking_form_start_position").val();
    var position_start = 4 - parseInt(availability) + 1;

    if($("#modal_form_line_1").is(":visible") && position_start<2){
        if(!checkMemberInfos(1)){
            //error with member 2 infos
            return_bool = false;
        }
    }
    if($("#modal_form_line_2").is(":visible") && position_start<3){
        if(!checkMemberInfos(2)){
            //error with member 2 infos
            return_bool = false;
        }
    }
    if($("#modal_form_line_3").is(":visible") && position_start<4){
        if(!checkMemberInfos(3)){
            //error with member 3 infos
            return_bool = false;
        }
    }
    if($("#modal_form_line_4").is(":visible")){
        if(!checkMemberInfos(4)){
            //error with member 4 infos
            return_bool = false;
        }
    }

    // if all is ok : hide error msg
    if(return_bool == true){
        $(form_error_box).hide().html("");
    }

    return return_bool;
}

// check line corresponding to member passed in parameter
function checkMemberInfos(member) {

    var return_bool = true;
    var parcours = $("#parcours option:selected").val();

    // member <member> firstname is not filled
    if ($("#booking_form_member_"+member+"_firstname_field").val() == "" && $("#booking_form_member_"+member+"_firstname_field").is(":visible")) {
        ////console.log("erreur firstname member" + member);
        $("#booking_form_member_"+member+"_firstname_field").addClass("errorField");
        $(form_error_box).show().html(please_fill_fields);
        var return_bool = false;
    }
    else{
        $("#booking_form_member_"+member+"_firstname_field").removeClass("errorField");
    }
    if ($("#booking_form_member_"+member+"_lastname_field").val() == "" && $("#booking_form_member_"+member+"_lastname_field").is(":visible")) {
        ////console.log("erreur lastname member" + member);
        $("#booking_form_member_"+member+"_lastname_field").addClass("errorField");
        $(form_error_box).show().html(please_fill_fields);
        var return_bool = false;
    }
    else{
        $("#booking_form_member_"+member+"_lastname_field").removeClass("errorField");
    }
    if ($("#booking_form_member_"+member+"_handicap_field").val() == "" && $("#booking_form_member_"+member+"_handicap_field").is(":visible")) {
        ////console.log("erreur hcp member" + member);
        $("#booking_form_member_"+member+"_handicap_field").addClass("errorField");
        $(form_error_box).show().html(please_fill_fields);
        var return_bool = false;
    }
    else{
        $("#booking_form_member_"+member+"_handicap_field").removeClass("errorField");
    }
    if ($("#booking_form_member_"+member+"_type_select option:selected").val() == "-" && $("#booking_form_member_"+member+"_type_select").is(":visible")) {
        ////console.log("erreur type member" + member);
        $("#booking_form_member_"+member+"_type_select").addClass("errorSelect");
        $(form_error_box).show().html(please_fill_fields);
        var return_bool = false;
    }
    else{
        $("#booking_form_member_"+member+"_type_select").removeClass("errorSelect");
    }
    /*if($("#booking_form_member_1_country").is(":visible") && $("#booking_form_member_"+member+"_country").val()=="" ){
        //console.log("erreur country member" + member);
        $("#booking_form_member_"+member+"_country").addClass("errorField");
        $(form_error_box).show().html("Veuillez saisir les champs indiqués, svp.");
        var return_bool = false;
    }
    else{
        $("#booking_form_member_"+member+"_type_select").removeClass("errorField");
    }*/


    if(parcours==0 && parseInt($("#booking_form_member_"+member+"_handicap_field").val())>36){
        //console.log("erreur handicap" + member);
        $("#booking_form_member_"+member+"_handicap_field").addClass("errorField");
        $(form_error_box).show().html(hcp_unsuff);
        var return_bool = false;
    }
    else{
        //$("#booking_form_member_"+member+"_handicap_field").removeClass("errorField");
    }


    return return_bool;
}

// get real cost
function getRealCost(optionValue, target, target_lbl){


    $("#endBtn").attr("disabled", true);
    $("#saveBtn").attr("disabled", true);

    $(target_lbl).html(loading_img_html);
    ////console.log(target);

    if(user_member == 20){
        optionValue = 20;
    }

    var datas = {"member": optionValue, "date": $("#booking_form_start_date").val(), "parcours": getParcours()};
    //console.log(datas);
    //console.log(datas);
    if(optionValue!="-"){
        var postOrder = $.post( path_get_real_cost, datas,  function(data) {


            var myarr = data.split("_");
            //console.log(myarr);
            var tarif = myarr[0];
            ////console.log("real cost : "+tarif);
            var sign = myarr[1];
            var percent = myarr[2];

            var normal_price = 0;

            if(typeof myarr[3] != 'undefined'){
                normal_price = myarr[3];
                normal_price = parseFloat(normal_price);
            }

            if(typeof myarr[3]!==undefined){
                var bbc = myarr[3];
            }
            else{
                bbc = tarif;
            }
            //console.log(data);

            if(tarif=="event"){
                $(".close").click();
                return false;
            }

            //var normal_tarif = myarr[3];
            if(sign!="" && sign!="+"){
                //console.log("bbv: "+bbc);
                $(target).data("cost", tarif).data("percent", percent).data("normal", normal_price.toFixed(2));
            }
            else{
                $(target).data("cost", tarif).data("percent", 0).data("normal", normal_price.toFixed(2));
            }
        })
        .done(function(data) {
            enableOrderBtns();
            estimateAndDisplayCost();
        })
        .fail(function() {
            //console.log( "error during operation" );
        })
        .always(function() {
            //console.log( "operation finished" );
        });
    }

    var datas = {
        "member": optionValue,
        "date": $("#booking_form_start_date").val(),
    };
}

// get best prices for the current week
function checkBestPricesForTheWeek(){
    var dates = "";
    $(".gc-col-day a").each(function(){
        dates+=$(this).data("day")+"_";
    });
    dates = replaceAll(dates, "/","-");
    dates = dates.substring(0, dates.length-1);

    var count = 0;
    if(typeof bpfwd != 'undefined'){
        for(var i in bpfwd){
            var key = replaceAll(i, "-","/");

            count++;
            var count2 = 0;
            $(".prix").each(function(){
                count2++;
                if(count==count2){
                    var val = bpfwd[i].toString();
                    if(val.substr(0,6)=="event-"){
                        $(this).html(val.substr(6,val.length-6)).css("visibility","visible");
                    }
                    else{
                        var value = parseFloat(bpfwd[i]);
                        if(bpfwd[i].toString().indexOf('.') != -1)
                            $(this).html("<small>"+since_price+"</small> "+value.toFixed(2)+"").css("visibility","visible");
                        else if(bpfwd[i].toString().indexOf('event') != -1)
                            $(this).html("<small>&nbsp;</small>");
                        else{
                            if(bpfwd[i]=="fermé"){
                                $(this).html("<small>parcours</small> "+bpfwd[i]+"").css("visibility","visible");
                            }
                            else{
                                $(this).html("<small>"+since_price+"</small> "+bpfwd[i]+".-").css("visibility","visible");
                            }
                        }
                    }

                }
            });
        }
    }


    var parcours = getParcours();
    var member_id = user_member;
    //$(target_type).hide();
    /*var url = "../getBPFWD/"+dates+"/"+member_id+"/"+parcours;
    //console.log(url);

    $.getJSON( url, null )
        .done(function( json ) {
            //console.log(json);
            var count = 0;
            for(var i in json){
                var key = replaceAll(i, "-","/");
                count++;
                var count2 = 0;
                $(".prix").each(function(){
                    count2++;
                    if(count==count2){
                        $(this).html("<small>A partir de</small> "+json[i]+".-").css("visibility","visible");
                    }
                });


                //console.log(key);
            }
        })
        .fail(function( jqxhr, textStatus, error ) {
            var err = textStatus + ", " + error;
            //console.log( "Request Failed: " + err );
        });*/
}

// \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\