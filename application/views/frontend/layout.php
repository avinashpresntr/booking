<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?php echo $title_for_layout; ?></title>

    <link rel="icon" type="image/x-icon" href="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keywords" content="" />

    <meta name="keywords" content="">
    <meta name="description" content="">
    <!-- POUR FACEBOOK -->
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <meta property="og:url" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- For Chrome for Android: -->
    <link rel="icon" sizes="192x192" href="touch-icon-192x192.png">
    <!-- For iPhone 6 Plus with @3× display: -->
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-180x180-precomposed.png">
    <!-- For iPad with @2× display running iOS ≥ 7: -->
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-152x152-precomposed.png">
    <!-- For iPad with @2× display running iOS ≤ 6: -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-144x144-precomposed.png">
    <!-- For iPhone with @2× display running iOS ≥ 7: -->
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-120x120-precomposed.png">
    <!-- For iPhone with @2× display running iOS ≤ 6: -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-114x114-precomposed.png">
    <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≥ 7: -->
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-76x76-precomposed.png">
    <!-- For the iPad mini and the first- and second-generation iPad (@1× display) on iOS ≤ 6: -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-72x72-precomposed.png">
    <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>assets/frontend/img/apple-touch-icon-precomposed.png">
    <!-- 57×57px -->
    <link href="<?php echo base_url(); ?>assets/frontend/css/royalslider.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/frontend/css/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/frontend/css/style_front_custom.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/frontend/css/jquery.dialogbox.css">

    <link href="<?php echo base_url(); ?>assets/frontend/css/styles_adjustement.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries --><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js" async></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js" async></script><![endif]-->

    <!-- Google Tag Manager -->
    <!--<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-WQZ7G2"
    height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>-->
    <!--
    <script>(function (w, d, s, l, i) {
    w[l] = w[l] || [];
    w[l].push({
    'gtm.start': new Date().getTime(), event: 'gtm.js'
    });
    var f = d.getElementsByTagName(s)[0],
    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
    j.async = true;
    j.src =
    '//www.googletagmanager.com/gtm.js?id=' + i + dl;
    f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-WQZ7G2');</script>-->
    <!-- End Google Tag Manager -->

    <script>
      // DEFINE CONSTANTS used in index.js
      // update id's here if necessary !

      // modal form ------------------------------------------------------------------------------------------------------
      const mb1_total_lbl_id       = "#booking_form_member_1_total_label"; // label for member 1 total
      const mb2_total_lbl_id       = "#booking_form_member_2_total_label"; // label for member 2 total
      const mb3_total_lbl_id       = "#booking_form_member_3_total_label"; // label for member 3 total
      const mb4_total_lbl_id       = "#booking_form_member_4_total_label"; // label for member 4 total
      const small_car_total_lbl_id = "#booking_form_small_car_total"; // label for small car total
      const electric_car_total_lbl_id = "#booking_form_electric_car_total"; // label for electric car total
      const caddy_total_lbl_id     = "#booking_form_caddy_total"; // label caddy total
      const total_lbl_id           = "#booking_form_total"; // modal form total
      const form_error_box         = "#form_modal_error_box"; // error box in modal form
      const form_success_box       = "#form_modal_success_box"; // error box in modal form
      const mb1_type_select_id     = "#booking_form_member_1_type_select"; // select for member 1 type
      const mb2_type_select_id     = "#booking_form_member_2_type_select"; // select for member 2 type
      const mb3_type_select_id     = "#booking_form_member_3_type_select"; // select for member 3 type
      const mb4_type_select_id     = "#booking_form_member_4_type_select"; // select for member 4 type
      const nb_p1_btn              = "#nb_players_1";
      const nb_p2_btn              = "#nb_players_2";
      const nb_p3_btn              = "#nb_players_3";
      const nb_p4_btn              = "#nb_players_4";
      const date_picker            = "#dp1";
      const nb_players_class       = ".nb_players_btn";
      const member_1_firstname     = "#booking_form_member_1_firstname_field";
      const member_1_lastname      = "#booking_form_member_1_lastname_field";
      const member_1_type          = "#booking_form_member_1_type_select";
      const member_1_country       = "#booking_form_member_1_type_country";
      const member_1_hcp           = "#booking_form_member_1_handicap_field";
      const member_2_firstname     = "#booking_form_member_2_firstname_field";
      const member_2_lastname      = "#booking_form_member_2_lastname_field";
      const member_2_type          = "#booking_form_member_2_type_select";
      const member_2_country       = "#booking_form_member_2_type_country";
      const member_2_hcp           = "#booking_form_member_2_handicap_field";
      const member_3_firstname     = "#booking_form_member_3_firstname_field";
      const member_3_lastname      = "#booking_form_member_3_lastname_field";
      const member_3_type          = "#booking_form_member_3_type_select";
      const member_3_country       = "#booking_form_member_3_type_country";
      const member_3_hcp           = "#booking_form_member_3_handicap_field";
      const member_4_firstname     = "#booking_form_member_4_firstname_field";
      const member_4_lastname      = "#booking_form_member_4_lastname_field";
      const member_4_type          = "#booking_form_member_4_type_select";
      const member_4_country       = "#booking_form_member_4_type_country";
      const member_4_hcp           = "#booking_form_member_4_handicap_field";
      const form_line_1            = "#booking_form_member_4_handicap_field";
      const form_line_2            = "#booking_form_member_4_handicap_field";
      const form_line_3            = "#booking_form_member_4_handicap_field";
      const form_line_4            = "#booking_form_member_4_handicap_field";
      const booking_form_date_label = "#booking_form_date_label";
      const booking_form_start_label = "#booking_form_start_label";
      const booking_form_caddy_chk = "#booking_form_caddy_chk";
      const booking_form_small_car_chk = "#booking_form_small_car_chk";
      const booking_form_electric_car_chk = "#booking_form_electric_car_chk";
      const booking_form_caddy_nb_select = "#booking_form_caddy_nb_select";
      const booking_form_small_car_nb_select = "#booking_form_small_car_nb_select";
      const booking_form_electric_car_nb_select = "#booking_form_electric_car_nb_select";
      const booking_form_start_position = "#booking_form_start_position";
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        var booking_form_nb_select = "#booking_form_nb_select_mobile";
      }
      else{
        var booking_form_nb_select = "#booking_form_nb_select";
      }

      //767px
      if(window.screen.availWidth>767)
      {
        var booking_form_nb_select = "#booking_form_nb_select";
      }

      const booking_form_start_date = "#booking_form_start_date";
      const booking_form_parcours = "#booking_form_parcours";
      const booking_form_parcours_label = "#booking_form_parcours_label";
      const booking_form_holes_img = "#booking_form_holes_img";
      const save_btn              = "#saveBtn";
      const end_btn               = "#endBtn";
      const cancel_btn            = "#cancelBtn";
      const modal_form_line_1     = "#modal_form_line_1";
      const modal_form_line_2     = "#modal_form_line_2";
      const modal_form_line_3     = "#modal_form_line_3";
      const modal_form_line_4     = "#modal_form_line_4";
      const today_low_price_id       = "#today_low_price";
      const btnBookingClass       = ".bookingBtn";
      const linkLanguageClass     = ".language_link";
      const mobileLinkLanguageClass     = ".mobileLanguage_link";
      const filterParcours        = "#parcours";
      const filterDisplay         = "#btnDisplay";
      const filterDayClass        = ".gc-col-day a";
      const filterPrevWeekClass   = ".defil-left";
      const filterNextWeekClass   = ".defil-right";
      const nb_players_filter     = 1;
      const date_field            = "#date_field";
      const parcours_field        = "#parcours_field";
      const display_field         = "#display_field";
      const nb_players_field      = "#nb_players_field";
      const locale_field          = "#locale_field";
      const searchForm            = "#searchForm";
      const parcours_filter       = "#parcours";
      const form_modal_msg_box    = "#form_modal_msg_box";
      const full_date             = "Full";
      const sease_user             = "Please fill user datas before selecting this type of member";
      const sease_user_jn             = "Veuillez saisir des données de l'utilisateur avant de sélectionner un membre Abo Jack Nicklaus";

      // texts
      const txt_confirm = "End";
      const txt_cancel = "Go on";
      const txt_past_date_title = "Past date";
      const txt_past_date_content = "Impossible to book a date in past";
      const success_save_booking  = "Your order has been saved in the meantime of your confirmation (validity: 10 minutes)";
      const error_save_booking  = "A problem arose during the saving of your order";
      const txt_from_cost = "From";

      const please_fill_fields = "Please fill up the missing fields";

      // stock
      const small_car_unity_price = 50;
      const electric_car_unity_price = 25;
      const caddy_unity_price = 5;

      const user_type = "visitor";
      const member_id_connected = null;
      const user_defined = "anonymous";
      const user_firstname = "";
      const user_lastname = "";
      const user_member = 4;
      const user_handicap = "";

      //console.log(user_type);
      const home_index = "/en/";
      const home_checkout = "/en/checkout";
      const drapeau_img = "img/drapeau.png";
      const drapeau9_img = "img/drapeau_9.png";
      const path_logout = "/logout";
      const path_home_save_book = "/en/saveBooking";
      const path_get_real_cost = "/getRealCost";
      const is_booking_url = "/isBookingPossible";
      const free_booking_url = "/freeBooking";

      const txt_confirm_booking_cancel = "Would you care for really cancel the reservation";
      const path_cancel_order ="/en/checkout";
      const path_conditions ="/en/conditions";
      const hcp_unsuff = "Handicap unsufficient";
      const no_user_corr = "No user corresponding to datas";
      const no_user_jn_corr = "No user corresponding to datas";

      const path_user_json = "/json/users";

      const isAdmin = false;

      // error cases
      error_bookings = {
        "unknown_1": "Une erreur inconnue s'est produite",
        "error_booking_1":  "Malheureusement, un autre utilisateur vient d'effectuer une commande similaire ... ",
      };

      const loading_img_html = '<img src="img/loading_spinner.gif" class="small_loading"/>';
      const display = "row";
      var json = '{&quot;31-10-2016&quot;:&quot;30&quot;,&quot;01-11-2016&quot;:&quot;30&quot;,&quot;02-11-2016&quot;:&quot;30&quot;,&quot;03-11-2016&quot;:&quot;30&quot;,&quot;04-11-2016&quot;:&quot;30&quot;,&quot;05-11-2016&quot;:&quot;30&quot;,&quot;06-11-2016&quot;:&quot;30&quot;}';
      const bpfwd = JSON.parse(json.replace(/&quot;/g,'"'));

      const since_price = "From";
      const adminValue = 0;

      const msg_error_b1 = "An error occured";
      const msg_error_b2 = "Another user is ordering the same start. Please wait 10 min or choose another start.";
      const msg_error_b3 = "Datas from booking has changed. Page will reload.";

      const already_booked_today = "You cannot order twice in a day";

      const wish_subscribe = "Do you wish to subscribe";
      const wish_hcp = "HCP";
      const wish_confirm = "Confirm";


      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-51392687-1', 'golfcrans.ch');
    ga('send', 'pageview');
  </script>
</head>
<body>

  <div class="main-container home">

    <style>
      .disconnect{
        background-color: #f8cc06;
        margin-right: 5px;
        color: black;
        cursor:pointer;
      }
      .disconnectBtn{}
      .disconnectBtn:hover{
        color: white !important;
      }
      .profileMobile{
        display:none;
      }
      .profile{
        background-color: #f8cc06;
        margin-right: 5px;
        color: black;
        cursor:pointer;
        padding: 5px;
        height: 42px;
        line-height: 28px;
        color:white;
      }
      .profile:hover{
        color:black;
      }
    </style>

    <?php $this->load->view('frontend/header');?>

    <div class="container-content">
      <div class="container">
        <main>
          <?php echo $content_for_layout; ?>

          <!-- Modal -->
          <div class="cg-modal-reservation modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <form action="/en/checkout" id="booking_form">

              <!-- essential datas -->
              <input type="hidden" name="start_position" id="booking_form_start_position" value="">
              <input type="hidden" name="start_date" id="booking_form_start_date" value="">
              <input type="hidden" name="parcours" id="booking_form_parcours" value="">
              <input type="hidden" name="nb_players" id="booking_form_nb_players" value="">

              <input type="hidden" name="p1_userid" id="p1_userid" value="">
              <input type="hidden" name="p2_userid" id="p2_userid" value="">
              <input type="hidden" name="p3_userid" id="p3_userid" value="">
              <input type="hidden" name="p4_userid" id="p4_userid" value="">

              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="myModalLabel">Your booking</h2>
                  </div>
                  <div id="form_modal_msg_box" class="form_modal_msg_box"></div>
                  <div id="form_modal_error_box" class="form_modal_msg_box"></div>
                  <div class="form_modal_msg_box" id="form_modal_success_box" ></div>
                  <div class="modal-body">

                    <table class="gc-detail-resa hidden-xs">
                      <tr>
                        <th class="col-date">Date</th>
                        <th>Hour</th>
                        <th>Course</th>
                        <th class="hidden-xs">Options</th>
                        <th>Number of players</th>
                      </tr>
                      <tr class="gc-resa">
                        <td id="booking_form_date_label"></td>
                        <td id="booking_form_start_label"></td>
                        <td id="booking_form_parcours_label"></td>
                        <td class="hidden-xs"><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"  id="booking_form_holes_img" /></td>
                        <td>
                          <select class="form-control" id="booking_form_nb_select">
                            <option value="1"selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option  value="4">4</option>
                          </select>
                          <div class="admin" id="admin_nb_players"></div>
                        </td>
                      </tr>

                    </table>

                    <div class="visible-xs">
                      <table class="table gc-detail-resa gc-detail-resa-mobile">
                        <tr>
                          <th style="width: 35%">Date / Hour</th>
                          <th>Course</th>
                          <th>Number of players</th>
                        </tr>
                        <tr class="gc-resa">
                          <td id="mobile_date_label">Jeudi 26 juin 2015 <br/> 07h00</td>
                          <td id="mobile_parcours_label">Severiano <br/>Ballesteros</td>
                          <td>
                            <select class="form-control" id="booking_form_nb_select_mobile">
                              <option value="1"selected>1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option  value="4">4</option>
                            </select>
                            <div class="admin" id="admin_nb_players"></div>
                          </td>
                        </tr>
                      </table>
                    </div>

                    <br/>

                    <table class="gc-detail-joueurs" style="margin-bottom: 25px;">
                      <tr class="hidden-xs hidden-sm">
                        <th colspan="3" class="gc-col-joueur">Player</th>
                        <th class="gc-col-hcp">HCP</th>
                        <th>Member</th>
                        <th class="gc-col-prix" style="text-align:right;">Price</th>
                      </tr>

                      <!-- options-->
                      <tr class="admin line" id="admin_line_options_pay" style="display:table-row;">
                        <td style="width:100%; text-align:right"  colspan="7" data-cost="0"><input type="checkbox" id="chk_admin_pay_all" style="cursor:pointer;" checked> All</td><!-- status -->
                      </tr>

                      <!-- member 1 admin -->
                      <tr class="admin line" id="admin_line_1">
                        <td id="admin_player_1_no">1</td><!-- no player -->
                        <td id="admin_player_1_firstname"></td><!-- firstname -->
                        <td id="admin_player_1_lastname"></td><!-- lastname -->
                        <td id="admin_player_1_handicap"></td><!-- handicap -->
                        <td id="admin_player_1_type"></td><!-- type -->
                        <td class="text-align-right" id="admin_player_1_cost" data-cost="0"></td><!-- cost -->
                        <td class="text-align-right" id="admin_player_1_status" data-cost="0"></td><!-- status -->
                      </tr>
                      <!-- member 2 admin -->
                      <tr class="admin line" id="admin_line_2">
                        <td id="admin_player_2_no">2</td><!-- no player -->
                        <td id="admin_player_2_firstname"></td><!-- firstname -->
                        <td id="admin_player_2_lastname"></td><!-- lastname -->
                        <td id="admin_player_2_handicap"></td><!-- handicap -->
                        <td id="admin_player_2_type"></td><!-- type -->
                        <td class="text-align-right" id="admin_player_2_cost" data-cost="0"></td><!-- cost -->
                        <td class="text-align-right" id="admin_player_2_status" data-cost="0"></td><!-- status -->
                      </tr>
                      <!-- member 3 admin -->
                      <tr class="admin line" id="admin_line_3">
                        <td id="admin_player_3_no">3</td><!-- no player -->
                        <td id="admin_player_3_firstname"></td><!-- firstname -->
                        <td id="admin_player_3_lastname"></td><!-- lastname -->
                        <td id="admin_player_3_handicap"></td><!-- handicap -->
                        <td id="admin_player_3_type"></td><!-- type -->
                        <td class="text-align-right" id="admin_player_3_cost" data-cost="0"></td><!-- cost -->
                        <td class="text-align-right" id="admin_player_3_status" data-cost="0"></td><!-- status -->
                      </tr>
                      <!-- member 4 admin -->
                      <tr class="admin line" id="admin_line_4">
                        <td id="admin_player_4_no">4</td><!-- no player -->
                        <td id="admin_player_4_firstname"></td><!-- firstname -->
                        <td id="admin_player_4_lastname"></td><!-- lastname -->
                        <td id="admin_player_4_handicap"></td><!-- handicap -->
                        <td id="admin_player_4_type"></td><!-- type -->
                        <td class="text-align-right" id="admin_player_4_cost" data-cost="0"></td><!-- cost -->
                        <td class="text-align-right" id="admin_player_4_status" data-cost="0"></td><!-- status -->
                      </tr>

                      <!-- member 1 -->
                      <tr id="modal_form_line_1">
                        <td><strong>1</strong></td>
                        <td><input type="text" class="form-control booking_form_member" value="" placeholder="First name" data-player="1" disabled id="booking_form_member_1_firstname_field"></td>
                        <td><input type="text" class="form-control" value="" placeholder="Last name" disabled id="booking_form_member_1_lastname_field"></td>
                        <td><input type="text" class="form-control" value="" placeholder="HCP" disabled id="booking_form_member_1_handicap_field"></td>
                        <td>
                          <div class="form-inline" style="width:80%;float:left;">
                            <select class="form-control select-club"  id="booking_form_member_1_type_select">
                              <optgroup label="Visiteurs" class="grp_visitors">
                                <option value="4" data-cost="0" data-basebookingcost="0" data-normal="">Visiteurs</option>
                                <option value="17" data-cost="0" data-basebookingcost="0" data-normal="">Juniors (visiteurs -21)</option>
                              </optgroup>
                              <optgroup label="Crans" class="grp_crans">
                                <option value="2" data-cost="0" data-basebookingcost="0" data-normal="">Crans</option>
                                <option value="9" data-cost="0" data-basebookingcost="0" data-normal="">Crans sans abo</option>
                                <option value="18" data-cost="0" data-basebookingcost="0" data-normal="">Crans juniors sans abo ( -21 )</option>
                                <option value="15" data-cost="0" data-basebookingcost="0" data-normal="">Abo 3 clubs</option>
                              </optgroup>
                              <optgroup label="Autres clubs" class="grp_others">
                                <option value="16" data-cost="0" data-basebookingcost="0" data-normal="">Abo Jack Nicklaus</option>
                                <option value="7" data-cost="0" data-basebookingcost="0" data-normal="">Montreux</option>
                                <option value="8" data-cost="0" data-basebookingcost="0" data-normal="">ASGI</option>
                                <option value="11" data-cost="0" data-basebookingcost="0" data-normal="">AVG</option>
                              </optgroup>

                              <!--<option>GC Crans - Abonnement</option>
                              <option>GC Crans</option>
                              <option>GC Sion</option>
                              <option>GC Loèche</option>
                              <option>GC Montreux</option>
                              <option>GC Zermatt</option>
                              <option>ASGI</option>
                              <option value="ASG">ASG</option>
                              <option value="junior">GC Crans - Junior (-18)</option>
                              <option value="etranger">Etranger</option>-->
                            </select>

                            <select class="form-control select-club-asg" id="booking_form_member_1_canton_select">
                              <option>Sion</option>
                              <option>Zurich</option>
                              <option>Bern</option>
                              <option>Geneve</option>
                              <option>Gstaad</option>
                              <option>Lausanne</option>
                              <option>Lucerne</option>
                              <option>Montreux</option>
                              <option>Neuchatel</option>
                            </select>
                            <input type="text" class="form-control select-club-junior" placeholder="Year of birth" id="booking_form_member_1_birthdate" />
                            <input type="text" class="form-control select-club-etranger" placeholder="Country" id="booking_form_member_1_country" />
                          </div>
                          <a style="cursor:pointer; float:left;  margin-left: 1%;width: 18%; display:none;" class="btnBackMember" data-target="1" id="btnBackMember_1">Modify</a>
                        </td>
                        <td class="text-align-right" id="booking_form_member_1_total_label" data-cost="0" data-normal="0" style="min-width: 250px !important">0.-</td>
                      </tr>
                      <tr id="modal_form_line_proposals_1" style="display:none"></tr>
                      <!-- member 2 -->
                      <tr id="modal_form_line_2">
                        <td><strong>2</strong></td>
                        <td><input type="text" class="form-control booking_form_member" value="" placeholder="First name" data-player="2" id="booking_form_member_2_firstname_field"> </td>
                        <td><input type="text" class="form-control" value="" placeholder="Last name"  id="booking_form_member_2_lastname_field"> </td>
                        <td><input type="text" class="form-control" value="26" placeholder="HCP"  id="booking_form_member_2_handicap_field"></td>
                        <td>
                          <div class="form-inline" style="width:80%;float:left;">
                            <select class="form-control select-club"  id="booking_form_member_2_type_select">
															<optgroup label="Visiteurs" class="grp_visitors">
                                <option value="4" data-cost="0" data-basebookingcost="0" data-normal="">Visiteurs</option>
                                <option value="17" data-cost="0" data-basebookingcost="0" data-normal="">Juniors (visiteurs -21)</option>
                              </optgroup>
                              <optgroup label="Crans" class="grp_crans">
                                <option value="2" data-cost="0" data-basebookingcost="0" data-normal="">Crans</option>
                                <option value="9" data-cost="0" data-basebookingcost="0" data-normal="">Crans sans abo</option>
                                <option value="18" data-cost="0" data-basebookingcost="0" data-normal="">Crans juniors sans abo ( -21 )</option>
                                <option value="15" data-cost="0" data-basebookingcost="0" data-normal="">Abo 3 clubs</option>
                              </optgroup>
                              <optgroup label="Autres clubs" class="grp_others">
                                <option value="16" data-cost="0" data-basebookingcost="0" data-normal="">Abo Jack Nicklaus</option>
                                <option value="7" data-cost="0" data-basebookingcost="0" data-normal="">Montreux</option>
                                <option value="8" data-cost="0" data-basebookingcost="0" data-normal="">ASGI</option>
                                <option value="11" data-cost="0" data-basebookingcost="0" data-normal="">AVG</option>
                              </optgroup>
                              <!--<option>GC Crans - Abonnement</option>
                              <option>GC Crans</option>
                              <option>GC Sion</option>
                              <option>GC Loèche</option>
                              <option>GC Montreux</option>
                              <option>GC Zermatt</option>
                              <option>ASGI</option>
                              <option value="ASG">ASG</option>
                              <option value="junior">GC Crans - Junior (-18)</option>
                              <option value="etranger">Etranger</option>-->
                            </select>
                            <select class="form-control select-club-asg" id="booking_form_member_2_canton_select">
                              <option>Sion</option>
                              <option>Zurich</option>
                              <option>Bern</option>
                              <option>Geneve</option>
                              <option>Gstaad</option>
                              <option>Lausanne</option>
                              <option>Lucerne</option>
                              <option>Montreux</option>
                              <option>Neuchatel</option>
                            </select>
                            <input type="text" class="form-control select-club-junior" placeholder="Country" id="booking_form_member_2_birthdate" />
                            <input type="text" class="form-control select-club-etranger" placeholder="Year of birth" id="booking_form_member_2_country" />
                          </div>
                          <a style="cursor:pointer; float:left;  margin-left: 1%; width: 18%; display:none;" class="btnBackMember" data-target="2" id="btnBackMember_2">Modify</a>
                        </td>
                        <td class="text-align-right" id="booking_form_member_2_total_label"  data-cost="0"  data-normal="0" style="min-width: 250px !important">0.-</td>
                      </tr>
                      <tr id="modal_form_line_proposals_2" style="display:none"></tr>
                      <!-- member 3 -->
                      <tr id="modal_form_line_3">
                        <td><strong>3</strong></td>
                        <td><input type="text" class="form-control booking_form_member" data-player="3" value="" placeholder="First name" id="booking_form_member_3_firstname_field"> </td>
                        <td><input type="text" class="form-control" value="" placeholder="Last name" id="booking_form_member_3_lastname_field"> </td>
                        <td><input type="text" class="form-control" value="" placeholder="HCP"  id="booking_form_member_3_handicap_field"></td>
                        <td>
                          <div class="form-inline" style="width:80%;float:left;">
                            <select class="form-control select-club"  id="booking_form_member_3_type_select">
                              <optgroup label="Visiteurs" class="grp_visitors">
                                <option value="4" data-cost="0" data-basebookingcost="0" data-normal="">Visiteurs</option>
                                <option value="17" data-cost="0" data-basebookingcost="0" data-normal="">Juniors (visiteurs -21)</option>
                              </optgroup>
                              <optgroup label="Crans" class="grp_crans">
                                <option value="2" data-cost="0" data-basebookingcost="0" data-normal="">Crans</option>
                                <option value="9" data-cost="0" data-basebookingcost="0" data-normal="">Crans sans abo</option>
                                <option value="18" data-cost="0" data-basebookingcost="0" data-normal="">Crans juniors sans abo ( -21 )</option>
                                <option value="15" data-cost="0" data-basebookingcost="0" data-normal="">Abo 3 clubs</option>
                              </optgroup>
                              <optgroup label="Autres clubs" class="grp_others">
                                <option value="16" data-cost="0" data-basebookingcost="0" data-normal="">Abo Jack Nicklaus</option>
                                <option value="7" data-cost="0" data-basebookingcost="0" data-normal="">Montreux</option>
                                <option value="8" data-cost="0" data-basebookingcost="0" data-normal="">ASGI</option>
                                <option value="11" data-cost="0" data-basebookingcost="0" data-normal="">AVG</option>
                              </optgroup>
                              <!--<option>GC Crans - Abonnement</option>
                              <option>GC Crans</option>
                              <option>GC Sion</option>
                              <option>GC Loèche</option>
                              <option>GC Montreux</option>
                              <option>GC Zermatt</option>
                              <option>ASGI</option>
                              <option value="ASG">ASG</option>
                              <option value="junior">GC Crans - Junior (-18)</option>
                              <option value="etranger">Etranger</option>-->
                            </select>
                            <select class="form-control select-club-asg" id="booking_form_member_3_canton_select">
                              <option>Sion</option>
                              <option>Zurich</option>
                              <option>Bern</option>
                              <option>Geneve</option>
                              <option>Gstaad</option>
                              <option>Lausanne</option>
                              <option>Lucerne</option>
                              <option>Montreux</option>
                              <option>Neuchatel</option>
                            </select>
                            <input type="text" class="form-control select-club-junior" placeholder="Year of birth" id="booking_form_member_3_birthdate" />
                            <input type="text" class="form-control select-club-etranger" placeholder="Country" id="booking_form_member_3_country" />
                          </div>
                          <a style="cursor:pointer; float:left; width: 18%;  margin-left: 1%; display:none;" class="btnBackMember" data-target="3" id="btnBackMember_3">Modify</a>
                        </td>
                        <td class="text-align-right" id="booking_form_member_3_total_label" data-cost="0"  data-normal="0" style="min-width: 250px !important">0.-</td>
                      </tr>
                      <tr id="modal_form_line_proposals_3" style="display:none"></tr>
                      <!-- member 4 -->
                      <tr id="modal_form_line_4">
                        <td><strong>4</strong></td>
                        <td><input type="text" class="form-control booking_form_member" value="" placeholder="First name" data-player="4" id="booking_form_member_4_firstname_field"> </td>
                        <td><input type="text" class="form-control " value="" placeholder="Last name"  id="booking_form_member_4_lastname_field"> </td>
                        <td><input type="text" class="form-control" value="" placeholder="HCP"  id="booking_form_member_4_handicap_field"></td>
                        <td>
                          <div class="form-inline" style="width:80%;float:left;">
                            <select class="form-control select-club"  id="booking_form_member_4_type_select">
                              <optgroup label="Visiteurs" class="grp_visitors">
                                <option value="4" data-cost="0" data-basebookingcost="0" data-normal="">Visiteurs</option>
                                <option value="17" data-cost="0" data-basebookingcost="0" data-normal="">Juniors (visiteurs -21)</option>
                              </optgroup>
                              <optgroup label="Crans" class="grp_crans">
                                <option value="2" data-cost="0" data-basebookingcost="0" data-normal="">Crans</option>
                                <option value="9" data-cost="0" data-basebookingcost="0" data-normal="">Crans sans abo</option>
                                <option value="18" data-cost="0" data-basebookingcost="0" data-normal="">Crans juniors sans abo ( -21 )</option>
                                <option value="15" data-cost="0" data-basebookingcost="0" data-normal="">Abo 3 clubs</option>
                              </optgroup>
                              <optgroup label="Autres clubs" class="grp_others">
                                <option value="16" data-cost="0" data-basebookingcost="0" data-normal="">Abo Jack Nicklaus</option>
                                <option value="7" data-cost="0" data-basebookingcost="0" data-normal="">Montreux</option>
                                <option value="8" data-cost="0" data-basebookingcost="0" data-normal="">ASGI</option>
                                <option value="11" data-cost="0" data-basebookingcost="0" data-normal="">AVG</option>
                              </optgroup>
                              <!--
                              <option>GC Crans - Abonnement</option>
                              <option>GC Crans</option>
                              <option>GC Sion</option>
                              <option>GC Loèche</option>
                              <option>GC Montreux</option>
                              <option>GC Zermatt</option>
                              <option>ASGI</option>
                              <option value="ASG">ASG</option>
                              <option value="junior">GC Crans - Junior (-18)</option>
                              <option value="etranger">Etranger</option>-->
                            </select>
                            <select class="form-control select-club-asg" id="booking_form_member_4_canton_select">
                              <option>Sion</option>
                              <option>Zurich</option>
                              <option>Bern</option>
                              <option>Geneve</option>
                              <option>Gstaad</option>
                              <option>Lausanne</option>
                              <option>Lucerne</option>
                              <option>Montreux</option>
                              <option>Neuchatel</option>
                            </select>
                            <input type="text" class="form-control select-club-junior" placeholder="Year of birth" id="booking_form_member_4_birthdate" />
                            <input type="text" class="form-control select-club-etranger" placeholder="Country" id="booking_form_member_4_country" />
                          </div>
                          <a style="cursor:pointer; float:left; width: 18%; margin-left: 1%; display:none;" class="btnBackMember" data-target="4" id="btnBackMember_4">Modify</a>
                        </td>
                        <td class="text-align-right" id="booking_form_member_4_total_label" data-cost="0" data-normal="0" style="min-width: 250px !important">0.-</td>
                      </tr>
                      <tr id="modal_form_line_proposals_4" style="display:none"></tr>


                    </table>

                    <table id="admin_options_lines" style="margin-bottom: 15px">
                      <tr class="hidden-xs hidden-sm">
                        <th class="gc-col-joueur" style="width:68%">OPTIONS</th>
                        <th class="gc-col-hcp"></th>
                        <th class="gc-col-prix"></th>
                        <th class="gc-col-prix"></th>
                      </tr>
                      <tr id="admin_line_caddy" style="display:none;">
                        <td class="small-col" style="color:black; font-weight:normal;">Trolley</td>
                        <td class="small-col" style="color:black;"></td>
                        <td class="small-col admin_line_caddy infos" style="color:black;">
                          <span class="cost" style="color:black"></span>
                        </td>
                        <td class="small-col admin_line_caddy infos" style="color:black;">
                          <span class="status" style="color:black; float:right"></span>
                        </td>
                      </tr>
                      <tr id="admin_line_smallcar" style="display:none;">
                        <td class="small-col" style="color:black; font-weight:normal;">Golf cart</td>
                        <td class="small-col" style="color:black;"></td>
                        <td class="small-col admin_line_smallcar infos" style="color:black;">
                          <span class="cost" style="color:black"></span>
                        </td>
                        <td class="small-col admin_line_smallcar infos" style="color:black;">
                          <span class="status" style="color:black; float:right"></span>
                        </td>
                      </tr>
                      <tr id="admin_line_electriccar" style="display:none;">
                        <td class="small-col" style="color:black; font-weight:normal;">Electric caddy</td>
                        <td class="small-col" style="color:black;"></td>
                        <td class="small-col admin_line_electriccar infos" style="color:black;">
                          <span class="cost" style="color:black"></span>
                        </td>
                        <td class="small-col admin_line_electriccar infos" style="color:black;">
                          <span class="status" style="color:black;float:right"></span>
                        </td>
                      </tr>
                    </table>

                    <table id="admin_total" style="margin-bottom: 15px; border-top: 2px solid #ccc;">
                      <tr>
                        <td style="width: 83%;"><strong>Total</strong></td>
                        <td class="" id="booking_form_admin_total"  data-cost=""><strong></strong></td>
                      </tr>
                    </table>


                    <table id="options_lines">
                      <tr>
                        <th colspan="3">OPTIONS</th>
                        <th class="gc-col-prix"></th>
                      </tr>
                      <tr>
                        <td class="small-col"><input type="checkbox" id="booking_form_small_car_chk"></td>
                        <td colspan="">Golf cart  <small id="small_car_price_lbl">(50.-)</small>  </td>
                        <td class="small-col">
                          <select class="form-control" id="booking_form_small_car_nb_select">
                            <option value="0">-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                          </select>
                        </td>
                        <td class="text-align-right" id="booking_form_small_car_total"  data-cost="0">0.-</td>
                      </tr>

                      <tr>
                        <td class="small-col"><input type="checkbox" id="booking_form_electric_car_chk"></td>
                        <td colspan="">Electric caddy  <small id="electric_car_price_lbl">(25.-)</small>  </td>
                        <td class="small-col">
                          <select class="form-control" id="booking_form_electric_car_nb_select">
                            <option value="0">-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </td>
                        <td class="text-align-right" id="booking_form_electric_car_total"  data-cost="0">0.-</td>
                      </tr>

                      <tr>
                        <td class="small-col"><input type="checkbox" id="booking_form_caddy_chk"></td>
                        <td>Trolleys <small id="caddy_price_lbl">(5.-/Trolleys)</small></td>
                        <td class="small-col">
                          <select class="form-control" id="booking_form_caddy_nb_select">
                            <option value="0">-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                          </select>
                        </td>
                        <td class="text-align-right" id="booking_form_caddy_total"  data-cost="0"></td>
                      </tr>

                      <tr class="gc-resa-total">
                        <td colspan="2"></td>
                        <td class="text-align-right"><strong>Total</strong></td>
                        <td class="text-align-right" id="booking_form_total"  data-cost=""><strong></strong></td>
                      </tr>

                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" id="cancelBtn" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <!--<button type="button" id="saveBtn" class="btn btn-default">Save</button>-->
                    <button type="button" id="endBtn" class="btn btn-default">Continue booking</button>
                    <button type="button" id="payBtn" class="btn btn-default" style="display:none;">Pay</button>
                  </div>
                </div>

              </div>
            </form>

          </div>


          <?php $this->load->view('frontend/footer');?>

        </main>
      </div>
    </div>
  </div>

  <!-- custom form for filters -->
  <form action="" method="post" id="searchForm">
    <input type="hidden" name="date" id="date_field" value="">
    <input type="hidden" name="nb_players" id="nb_players_field" value="">
    <input type="hidden" name="parcours" id="parcours_field" value="">
    <input type="hidden" name="as_user_target" id="as_user_target" value="">
    <input type="hidden" name="as_member_target" id="as_member_target" value="">
    <input type="hidden" name="display" id="display_field" value="row">
    <input type="hidden" name="locale" id="locale_field" value="en">
  </form>

  <!-- custom div for styled alert/confirm -->
  <div id="dialog"></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script>
		if (!window.jQuery) {
			document.write('<script src="js/jquery.min.js"><\/script>');
		}
	</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script>
		if (typeof($.fn.modal) === 'undefined') {
			document.write('<script src="js/bootstrap.min.js"><\/script>')
		}
	</script>

  <script src="<?php echo base_url(); ?>assets/frontend/js/bootstrap-datepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/js/production.min.js" async></script>
  <script src="<?php echo base_url(); ?>assets/frontend/js/load-more.js"></script>
  <script src="<?php echo base_url(); ?>assets/frontend/js/jquery.dialogBox.js"></script>

  <script>
    $( document ).ready(function() {
      $( ".nav-lang-mobile-button" ).click(function() {
        $( ".lang-mobile-dropdown" ).toggle(0,function() {
        });
      });
    });

  </script>

  <!-- Flèche pour scroller vers le top du site --><a href="#0" class="cd-top">Top</a><!-- End flèche pour scroller vers le top du site --><!-- Augmenter la réactivité au click sur mobile -->
  <script type="text/javascript">
    if ('addEventListener' in document) {
      document.addEventListener('DOMContentLoaded', function () {
        if (typeof FastClick != "undefined") {
          FastClick.attach(document.body);
        }
      }, false);
    }
  </script>
  <script src="<?php echo base_url(); ?>assets/frontend/js/index.js"></script>
  <style>
    .ui-widget-content {
      z-index:250000;
    }

    .ui-autocomplete {
      max-height: 250px;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
    }

    .ui-autocomplete-loading {
      background: white url("img/loading_spinner.gif") right center no-repeat;
      background-size: 35px;
    }
  </style>
</body>
</html>
