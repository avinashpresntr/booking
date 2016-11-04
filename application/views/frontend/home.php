<div class="content-main">

  <style>
    .gc-onglets a{
      margin-right: 5px;
    }
  </style>

  <div class="gc-onglets clearfix" style=" padding-left: 2px; cursor:pointer; z-index: 100;" >
    <a href="/en/" id="home_link" class="gc-onglet clearfix" style="cursor:pointer;padding-top: 15px; float:left; text-align:left; margin-left: 5px;visibility:hidden; ">
      <div style="float:left; margin-left: 25px; font-weight:normal">
        TEE TIME<br />
        <span>Booking</span>
      </div>
    </a>
    <a style="display:none" href="/admin?locale=en">Entry <span>Members</span> and <br/><span>Partners clubs</span></a>
  </div>

  <section class="gc-search clearfix">

    <div class="gc-titre-coin col-md-5 col-lg-4" style=" ">
      <strong>Tee time</strong> <br class="hidden-xs hidden-sm"/>Booking
			<img src="<?php echo base_url(); ?>assets/frontend/img/after-titre.png" class="after-titre" style=""/>
    </div>

    <form class="form-inline form-search col-md-16 col-lg-18">
      <div class="form-group col-sm-12  col-md-10 col-lg-7 clearfix" style="">
        <div class="col-xs-8 col-md-5"><label>Date</label></div>
        <div class="col-xs-16 col-md-19">
          <input class="btn btn-default datepicker" style="" id="dp1" type="text" value="03/11/2016">
        </div>
      </div>

      <div class="form-group col-sm-12  col-md-14 col-lg-9 clearfix search-hide-mobile" style="visibility:hidden">
        <div class="col-xs-8 col-md-7"><label>Players</label></div>
        <div class="col-xs-16 col-md-17">
          <button class="btn btn-default  nb_players_btn" id="nb_players_1">1</button>
          <button class="btn btn-default  nb_players_btn" id="nb_players_2">2</button>
          <button class="btn btn-default  nb_players_btn" id="nb_players_3">3</button>
          <button class="btn btn-default  nb_players_btn" id="nb_players_4">4</button>
        </div>
      </div>
      <div class="form-group col-sm-12 col-md-12 col-lg-8 clearfix">
        <div class="col-xs-8 col-md-10"><label>Course</label></div>
        <div class="col-xs-16 col-md-14">
          <select class="form-control" id="parcours" style="min-width: 185px">
            <option value="0" selected>Severiano Ballesteros</option>
            <option value="1" >Jack Nicklaus</option>
          </select>
        </div>
      </div>
    </form>
    <div class="display hidden-xs col-md-3 col-lg-2" style="float:right; ">
      <a style="cursor:pointer; display:none;" class="btnDisplay" data-target="row"><img src="<?php echo base_url(); ?>assets/frontend/img/icon-list-active.png"/></a>
      <a style="cursor:pointer; display:none;" class="btnDisplay" data-target="grid"><img src="<?php echo base_url(); ?>assets/frontend/img/icon-grid.png"/></a>
    </div>
  </section>


  <div class="gc-planning-journ">

    <table class="gc-table-planning hidden-xs">

      <tr>
        <th class="gc-col-defil "><a style="cursor:pointer;" class="defil-left is_past" data-target="27-10-2016"> <span class="icon icon-chevron-left"></span> </a></th>
        <th class="gc-col-day" style="background-color: #ddd;">
          <a  data-day="31/10/2016" style="cursor:pointer;">
            <time>Oct 31</time>
            <span class="day">Mon</span>
            <div class="meteo" style="visibility:hidden">
              <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg" style="visibility:hidden"/>
            </div>
            <div class="prix"  style="visibility:hidden;">Date in past </div>
          </a>
        </th>
        <th class="gc-col-day" style="background-color: #ddd;">
          <a  data-day="01/11/2016" style="cursor:pointer;">
            <time>Nov 01</time>
            <span class="day">Tue</span>
            <div class="meteo" style="visibility:hidden">
              <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg" style="visibility:hidden"/>
            </div>
            <div class="prix"  style="visibility:hidden;">Date in past </div>
          </a>
        </th>
        <th class="gc-col-day" style="background-color: #ddd;">
          <a  data-day="02/11/2016" style="cursor:pointer;">
            <time>Nov 02</time>
            <span class="day">Wed</span>
            <div class="meteo" style="visibility:hidden">
              <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg" style="visibility:hidden"/>
            </div>
            <div class="prix"  style="visibility:hidden;">Date in past </div>
          </a>
        </th>
        <th class="gc-col-day" style="">
          <a class="active" data-day="03/11/2016" style="cursor:pointer;">
            <time>Nov 03</time>
            <span class="day">Thi</span>
            <div class="meteo" style="visibility:hidden">
              22° <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg"/>
            </div>
            <div class="prix" id="today_low_price" style="visibility:hidden;">
              <small>From</small>
              88
            </div>
          </a>
        </th>
        <th class="gc-col-day" style="">
          <a  data-day="04/11/2016" style="cursor:pointer;">
            <time>Nov 04</time>
            <span class="day">Fri</span>
            <div class="meteo" style="visibility:hidden">
              22° <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg"/>
            </div>
            <div class="prix"  style="visibility:hidden;">
              <small>From</small>
              86
            </div>
          </a>
        </th>
        <th class="gc-col-day" style="">
          <a  data-day="05/11/2016" style="cursor:pointer;">
            <time>Nov 05</time>
            <span class="day">Sat</span>
            <div class="meteo" style="visibility:hidden">
              22° <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg"/>
            </div>
            <div class="prix"  style="visibility:hidden;">
              <small>From</small>
              83
            </div>
          </a>
        </th>
        <th class="gc-col-day" style="">
          <a  data-day="06/11/2016" style="cursor:pointer;">
            <time>Nov 06</time>
            <span class="day">Sun</span>
            <div class="meteo" style="visibility:hidden">
              22° <img src="<?php echo base_url(); ?>assets/frontend/img/meteo/soleil.svg"/>
            </div>
            <div class="prix"  style="visibility:hidden;">
              <small>From</small>
              97
            </div>
          </a>
        </th>
        <th class="gc-col-defil"><a style="cursor:pointer" class="defil-right" data-target="10-11-2016"> <span class="icon icon-chevron-right"></span> </a></th>
      </tr>
    </table>

    <style>
      .occupe{
        visibility: hidden;
      }
    </style>

    <div class="gc-creaneau-horaire" id="creneau_1">
      <div class="gc-titre-heure">BEFORE 8h</div>
      <div class="clearfix">

        <div class="col-xs-12 col-md-8 col-lg-4" >
          <div class="gc-creaneau-heure complet " style="">
            <time>07h00</time><br/>
            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>
        <div class="col-xs-12 col-md-8 col-lg-4" >
          <div class="gc-creaneau-heure complet " style="">
            <time>07h10</time><br/>
            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>07h20</time><br/>

            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>07h30</time><br/>

            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>07h40</time><br/>

            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>07h50</time><br/>

            Evénement<br />
            Fermé
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>

        <script>

          document.getElementById("creneau_1").style.display="none";
        </script>

        <script>today_low_price = 1000;</script>

      </div>
    </div>


    <div class="gc-creaneau-horaire" id="creneau_2">
      <div class="gc-titre-heure">8h00 - 9h00</div>
      <div class="clearfix">






        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h00</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h10</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h20</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h30</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h40</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>08h50</time><br/>

            Event
            <div class="gc-players">
              <strong></strong><span class="ico-player occupe" style="visibility:hidden"></span>
            </div>

            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>
            <button class="btn btn-default bookingBtn" style="display:none !important; z-index:1;"></button>

          </div>
        </div>

        <script>

          document.getElementById("creneau_2").style.display="none";
        </script>

        <script>today_low_price = 1000;</script>

      </div>
    </div>


    <div class="gc-creaneau-horaire" id="creneau_3">
      <div class="gc-titre-heure">9h00 - 10h00</div>
      <div class="clearfix">






        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet " style="">
            <time>09h00</time><br/>


            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
            <div class="gc-players">
              <span class="ico-player occupe" style=""></span><span class="ico-player occupe" style=""></span>
              <span class="ico-player occupe" style=""></span><span class="ico-player occupe" style=""></span>

            </div>
            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>

            <span class="titre-complet">Full</span>


          </div>
        </div>





        <div class="col-xs-12 col-md-8 col-lg-4" >


          <div class="gc-creaneau-heure complet" style="">
            <time>09h10</time><br/>


            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
            <div class="gc-players">

              <span class="ico-player " id="ico_player_1"></span>
              <span class="ico-player " id="ico_player_2"></span>
              <span class="ico-player " id="ico_player_3"></span>
              <span class="ico-player " id="ico_player_4"></span>
            </div>
            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



            <button class="btn btn-default bookingBtn"

              data-member1firstname =""
              data-member1lastname =""
              data-member1handicap =""
              data-member1country =""
              data-member1asg=""

              data-member2firstname=""
              data-member2lastname=""
              data-member2handicap=""
              data-member2country=""
              data-member2asg=""

              data-member3firstname=""
              data-member3lastname=""
              data-member3handicap=""
              data-member3country=""
              data-member3asg=""

              data-member4firstname=""
              data-member4lastname=""
              data-member4handicap=""
              data-member4country=""
              data-member4asg=""

              data-availability="4"
              data-costs=""
              data-realcost="60"
              data-date="03-11-2016"
              data-start="09h10"
              data-dateoriginal="2016-11-03 09:10:00"
              data-toggle="modal" data-target="#modal-form"
              data-already=""

              style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
              </span> Book</button>


            </div>
          </div>





          <div class="col-xs-12 col-md-8 col-lg-4" >


            <div class="gc-creaneau-heure complet" style="">
              <time>09h20</time><br/>


              <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
              <div class="gc-players">

                <span class="ico-player " id="ico_player_1"></span>
                <span class="ico-player " id="ico_player_2"></span>
                <span class="ico-player " id="ico_player_3"></span>
                <span class="ico-player " id="ico_player_4"></span>
              </div>
              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



              <button class="btn btn-default bookingBtn"

                data-member1firstname =""
                data-member1lastname =""
                data-member1handicap =""
                data-member1country =""
                data-member1asg=""

                data-member2firstname=""
                data-member2lastname=""
                data-member2handicap=""
                data-member2country=""
                data-member2asg=""

                data-member3firstname=""
                data-member3lastname=""
                data-member3handicap=""
                data-member3country=""
                data-member3asg=""

                data-member4firstname=""
                data-member4lastname=""
                data-member4handicap=""
                data-member4country=""
                data-member4asg=""

                data-availability="4"
                data-costs=""
                data-realcost="60"
                data-date="03-11-2016"
                data-start="09h20"
                data-dateoriginal="2016-11-03 09:20:00"
                data-toggle="modal" data-target="#modal-form"
                data-already=""

                style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                </span> Book</button>


              </div>
            </div>





            <div class="col-xs-12 col-md-8 col-lg-4" >


              <div class="gc-creaneau-heure complet" style="">
                <time>09h30</time><br/>


                <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                <div class="gc-players">

                  <span class="ico-player occupe " id="ico_player_1"></span>
                  <span class="ico-player occupe " id="ico_player_2"></span>
                  <span class="ico-player " id="ico_player_3"></span>
                  <span class="ico-player " id="ico_player_4"></span>
                </div>
                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                <button class="btn btn-default bookingBtn"

                  data-member1firstname ="Jacqueline T."
                  data-member1lastname ="B."
                  data-member1handicap ="28.8"
                  data-member1country =""
                  data-member1asg=""

                  data-member2firstname="Claire-Lise"
                  data-member2lastname="E."
                  data-member2handicap="36"
                  data-member2country=""
                  data-member2asg=""

                  data-member3firstname=""
                  data-member3lastname=""
                  data-member3handicap=""
                  data-member3country=""
                  data-member3asg=""

                  data-member4firstname=""
                  data-member4lastname=""
                  data-member4handicap=""
                  data-member4country=""
                  data-member4asg=""

                  data-availability="2"
                  data-costs=""
                  data-realcost="60"
                  data-date="03-11-2016"
                  data-start="09h30"
                  data-dateoriginal="2016-11-03 09:30:00"
                  data-toggle="modal" data-target="#modal-form"
                  data-already=""

                  style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                  </span> Book</button>


                </div>
              </div>





              <div class="col-xs-12 col-md-8 col-lg-4" >


                <div class="gc-creaneau-heure complet" style="">
                  <time>09h40</time><br/>


                  <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                  <div class="gc-players">

                    <span class="ico-player " id="ico_player_1"></span>
                    <span class="ico-player " id="ico_player_2"></span>
                    <span class="ico-player " id="ico_player_3"></span>
                    <span class="ico-player " id="ico_player_4"></span>
                  </div>
                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                  <button class="btn btn-default bookingBtn"

                    data-member1firstname =""
                    data-member1lastname =""
                    data-member1handicap =""
                    data-member1country =""
                    data-member1asg=""

                    data-member2firstname=""
                    data-member2lastname=""
                    data-member2handicap=""
                    data-member2country=""
                    data-member2asg=""

                    data-member3firstname=""
                    data-member3lastname=""
                    data-member3handicap=""
                    data-member3country=""
                    data-member3asg=""

                    data-member4firstname=""
                    data-member4lastname=""
                    data-member4handicap=""
                    data-member4country=""
                    data-member4asg=""

                    data-availability="4"
                    data-costs=""
                    data-realcost="60"
                    data-date="03-11-2016"
                    data-start="09h40"
                    data-dateoriginal="2016-11-03 09:40:00"
                    data-toggle="modal" data-target="#modal-form"
                    data-already=""

                    style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                    </span> Book</button>


                  </div>
                </div>





                <div class="col-xs-12 col-md-8 col-lg-4" >


                  <div class="gc-creaneau-heure complet" style="">
                    <time>09h50</time><br/>


                    <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                    <div class="gc-players">

                      <span class="ico-player occupe " id="ico_player_1"></span>
                      <span class="ico-player " id="ico_player_2"></span>
                      <span class="ico-player " id="ico_player_3"></span>
                      <span class="ico-player " id="ico_player_4"></span>
                    </div>
                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                    <button class="btn btn-default bookingBtn"

                      data-member1firstname ="Irmgard"
                      data-member1lastname ="S."
                      data-member1handicap ="17.5"
                      data-member1country =""
                      data-member1asg=""

                      data-member2firstname=""
                      data-member2lastname=""
                      data-member2handicap=""
                      data-member2country=""
                      data-member2asg=""

                      data-member3firstname=""
                      data-member3lastname=""
                      data-member3handicap=""
                      data-member3country=""
                      data-member3asg=""

                      data-member4firstname=""
                      data-member4lastname=""
                      data-member4handicap=""
                      data-member4country=""
                      data-member4asg=""

                      data-availability="3"
                      data-costs=""
                      data-realcost="60"
                      data-date="03-11-2016"
                      data-start="09h50"
                      data-dateoriginal="2016-11-03 09:50:00"
                      data-toggle="modal" data-target="#modal-form"
                      data-already=""

                      style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                      </span> Book</button>


                    </div>
                  </div>

                  <script>

                    document.getElementById("creneau_3").style.display="none";
                  </script>

                  <script>today_low_price = 60;</script>

                </div>
              </div>


              <div class="gc-creaneau-horaire" id="creneau_4">
                <div class="gc-titre-heure">10h00 - 11h00</div>
                <div class="clearfix">






                  <div class="col-xs-12 col-md-8 col-lg-4" >


                    <div class="gc-creaneau-heure complet" style="">
                      <time>10h00</time><br/>


                      <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                      <div class="gc-players">

                        <span class="ico-player occupe " id="ico_player_1"></span>
                        <span class="ico-player occupe " id="ico_player_2"></span>
                        <span class="ico-player occupe " id="ico_player_3"></span>
                        <span class="ico-player " id="ico_player_4"></span>
                      </div>
                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                      <button class="btn btn-default bookingBtn"

                        data-member1firstname ="Marcel"
                        data-member1lastname ="E."
                        data-member1handicap ="17.1"
                        data-member1country =""
                        data-member1asg=""

                        data-member2firstname="Raymonde"
                        data-member2lastname="E."
                        data-member2handicap="23.2"
                        data-member2country=""
                        data-member2asg=""

                        data-member3firstname="Jacques-Yvan"
                        data-member3lastname="E."
                        data-member3handicap="14.2"
                        data-member3country=""
                        data-member3asg=""

                        data-member4firstname=""
                        data-member4lastname=""
                        data-member4handicap=""
                        data-member4country=""
                        data-member4asg=""

                        data-availability="1"
                        data-costs=""
                        data-realcost="60"
                        data-date="03-11-2016"
                        data-start="10h00"
                        data-dateoriginal="2016-11-03 10:00:00"
                        data-toggle="modal" data-target="#modal-form"
                        data-already=""

                        style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                        </span> Book</button>


                      </div>
                    </div>





                    <div class="col-xs-12 col-md-8 col-lg-4" >


                      <div class="gc-creaneau-heure complet" style="">
                        <time>10h10</time><br/>


                        <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                        <div class="gc-players">

                          <span class="ico-player occupe " id="ico_player_1"></span>
                          <span class="ico-player occupe " id="ico_player_2"></span>
                          <span class="ico-player " id="ico_player_3"></span>
                          <span class="ico-player " id="ico_player_4"></span>
                        </div>
                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                        <button class="btn btn-default bookingBtn"

                          data-member1firstname ="Bernard"
                          data-member1lastname ="S."
                          data-member1handicap ="9.1"
                          data-member1country =""
                          data-member1asg=""

                          data-member2firstname="Marie-Hélène"
                          data-member2lastname="S."
                          data-member2handicap="5.6"
                          data-member2country=""
                          data-member2asg=""

                          data-member3firstname=""
                          data-member3lastname=""
                          data-member3handicap=""
                          data-member3country=""
                          data-member3asg=""

                          data-member4firstname=""
                          data-member4lastname=""
                          data-member4handicap=""
                          data-member4country=""
                          data-member4asg=""

                          data-availability="2"
                          data-costs=""
                          data-realcost="60"
                          data-date="03-11-2016"
                          data-start="10h10"
                          data-dateoriginal="2016-11-03 10:10:00"
                          data-toggle="modal" data-target="#modal-form"
                          data-already=""

                          style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                          </span> Book</button>


                        </div>
                      </div>





                      <div class="col-xs-12 col-md-8 col-lg-4" >


                        <div class="gc-creaneau-heure complet" style="">
                          <time>10h20</time><br/>


                          <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                          <div class="gc-players">

                            <span class="ico-player " id="ico_player_1"></span>
                            <span class="ico-player " id="ico_player_2"></span>
                            <span class="ico-player " id="ico_player_3"></span>
                            <span class="ico-player " id="ico_player_4"></span>
                          </div>
                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                          <button class="btn btn-default bookingBtn"

                            data-member1firstname =""
                            data-member1lastname =""
                            data-member1handicap =""
                            data-member1country =""
                            data-member1asg=""

                            data-member2firstname=""
                            data-member2lastname=""
                            data-member2handicap=""
                            data-member2country=""
                            data-member2asg=""

                            data-member3firstname=""
                            data-member3lastname=""
                            data-member3handicap=""
                            data-member3country=""
                            data-member3asg=""

                            data-member4firstname=""
                            data-member4lastname=""
                            data-member4handicap=""
                            data-member4country=""
                            data-member4asg=""

                            data-availability="4"
                            data-costs=""
                            data-realcost="60"
                            data-date="03-11-2016"
                            data-start="10h20"
                            data-dateoriginal="2016-11-03 10:20:00"
                            data-toggle="modal" data-target="#modal-form"
                            data-already=""

                            style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                            </span> Book</button>


                          </div>
                        </div>





                        <div class="col-xs-12 col-md-8 col-lg-4" >


                          <div class="gc-creaneau-heure complet " style="">
                            <time>10h30</time><br/>


                            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                            <div class="gc-players">
                              <span class="ico-player occupe" style=""></span><span class="ico-player occupe" style=""></span>
                              <span class="ico-player occupe" style=""></span><span class="ico-player occupe" style=""></span>

                            </div>
                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>

                            <span class="titre-complet">Full</span>


                          </div>
                        </div>





                        <div class="col-xs-12 col-md-8 col-lg-4" >


                          <div class="gc-creaneau-heure complet" style="">
                            <time>10h40</time><br/>


                            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                            <div class="gc-players">

                              <span class="ico-player occupe " id="ico_player_1"></span>
                              <span class="ico-player occupe " id="ico_player_2"></span>
                              <span class="ico-player " id="ico_player_3"></span>
                              <span class="ico-player " id="ico_player_4"></span>
                            </div>
                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                            <button class="btn btn-default bookingBtn"

                              data-member1firstname ="hilde"
                              data-member1lastname ="V."
                              data-member1handicap ="15,5"
                              data-member1country =""
                              data-member1asg=""

                              data-member2firstname="alain"
                              data-member2lastname="B."
                              data-member2handicap="11,8"
                              data-member2country=""
                              data-member2asg=""

                              data-member3firstname=""
                              data-member3lastname=""
                              data-member3handicap=""
                              data-member3country=""
                              data-member3asg=""

                              data-member4firstname=""
                              data-member4lastname=""
                              data-member4handicap=""
                              data-member4country=""
                              data-member4asg=""

                              data-availability="2"
                              data-costs=""
                              data-realcost="60"
                              data-date="03-11-2016"
                              data-start="10h40"
                              data-dateoriginal="2016-11-03 10:40:00"
                              data-toggle="modal" data-target="#modal-form"
                              data-already=""

                              style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                              </span> Book</button>


                            </div>
                          </div>





                          <div class="col-xs-12 col-md-8 col-lg-4" >


                            <div class="gc-creaneau-heure complet" style="">
                              <time>10h50</time><br/>


                              <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                              <div class="gc-players">

                                <span class="ico-player occupe " id="ico_player_1"></span>
                                <span class="ico-player " id="ico_player_2"></span>
                                <span class="ico-player " id="ico_player_3"></span>
                                <span class="ico-player " id="ico_player_4"></span>
                              </div>
                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                              <button class="btn btn-default bookingBtn"

                                data-member1firstname ="Roland"
                                data-member1lastname ="M."
                                data-member1handicap ="25.6"
                                data-member1country =""
                                data-member1asg=""

                                data-member2firstname=""
                                data-member2lastname=""
                                data-member2handicap=""
                                data-member2country=""
                                data-member2asg=""

                                data-member3firstname=""
                                data-member3lastname=""
                                data-member3handicap=""
                                data-member3country=""
                                data-member3asg=""

                                data-member4firstname=""
                                data-member4lastname=""
                                data-member4handicap=""
                                data-member4country=""
                                data-member4asg=""

                                data-availability="3"
                                data-costs=""
                                data-realcost="60"
                                data-date="03-11-2016"
                                data-start="10h50"
                                data-dateoriginal="2016-11-03 10:50:00"
                                data-toggle="modal" data-target="#modal-form"
                                data-already=""

                                style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                                </span> Book</button>


                              </div>
                            </div>

                            <script>

                              document.getElementById("creneau_4").style.display="none";
                            </script>

                            <script>today_low_price = 60;</script>

                          </div>
                        </div>


                        <div class="gc-creaneau-horaire" id="creneau_5">
                          <div class="gc-titre-heure">11h00 - 12h00</div>
                          <div class="clearfix">






                            <div class="col-xs-12 col-md-8 col-lg-4" >


                              <div class="gc-creaneau-heure complet" style="">
                                <time>11h00</time><br/>


                                <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                <div class="gc-players">

                                  <span class="ico-player occupe " id="ico_player_1"></span>
                                  <span class="ico-player " id="ico_player_2"></span>
                                  <span class="ico-player " id="ico_player_3"></span>
                                  <span class="ico-player " id="ico_player_4"></span>
                                </div>
                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                <button class="btn btn-default bookingBtn"

                                  data-member1firstname ="William"
                                  data-member1lastname ="K."
                                  data-member1handicap ="12.4"
                                  data-member1country =""
                                  data-member1asg=""

                                  data-member2firstname=""
                                  data-member2lastname=""
                                  data-member2handicap=""
                                  data-member2country=""
                                  data-member2asg=""

                                  data-member3firstname=""
                                  data-member3lastname=""
                                  data-member3handicap=""
                                  data-member3country=""
                                  data-member3asg=""

                                  data-member4firstname=""
                                  data-member4lastname=""
                                  data-member4handicap=""
                                  data-member4country=""
                                  data-member4asg=""

                                  data-availability="3"
                                  data-costs=""
                                  data-realcost="60"
                                  data-date="03-11-2016"
                                  data-start="11h00"
                                  data-dateoriginal="2016-11-03 11:00:00"
                                  data-toggle="modal" data-target="#modal-form"
                                  data-already=""

                                  style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                                  </span> Book</button>


                                </div>
                              </div>





                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                <div class="gc-creaneau-heure complet" style="">
                                  <time>11h10</time><br/>


                                  <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                  <div class="gc-players">

                                    <span class="ico-player " id="ico_player_1"></span>
                                    <span class="ico-player " id="ico_player_2"></span>
                                    <span class="ico-player " id="ico_player_3"></span>
                                    <span class="ico-player " id="ico_player_4"></span>
                                  </div>
                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                  <button class="btn btn-default bookingBtn"

                                    data-member1firstname =""
                                    data-member1lastname =""
                                    data-member1handicap =""
                                    data-member1country =""
                                    data-member1asg=""

                                    data-member2firstname=""
                                    data-member2lastname=""
                                    data-member2handicap=""
                                    data-member2country=""
                                    data-member2asg=""

                                    data-member3firstname=""
                                    data-member3lastname=""
                                    data-member3handicap=""
                                    data-member3country=""
                                    data-member3asg=""

                                    data-member4firstname=""
                                    data-member4lastname=""
                                    data-member4handicap=""
                                    data-member4country=""
                                    data-member4asg=""

                                    data-availability="4"
                                    data-costs=""
                                    data-realcost="60"
                                    data-date="03-11-2016"
                                    data-start="11h10"
                                    data-dateoriginal="2016-11-03 11:10:00"
                                    data-toggle="modal" data-target="#modal-form"
                                    data-already=""

                                    style="visibility:hidden;"                                                ><span class="icon icon-checkmark">
                                    </span> Book</button>


                                  </div>
                                </div>






                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                  <div class="gc-creaneau-heure offre" style="">
                                    <time>11h20</time><br/>


                                    <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                    <div class="gc-players">

                                      <span class="ico-player " id="ico_player_1"></span>
                                      <span class="ico-player " id="ico_player_2"></span>
                                      <span class="ico-player " id="ico_player_3"></span>
                                      <span class="ico-player " id="ico_player_4"></span>
                                    </div>
                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                    <button class="btn btn-default bookingBtn"

                                      data-member1firstname =""
                                      data-member1lastname =""
                                      data-member1handicap =""
                                      data-member1country =""
                                      data-member1asg=""

                                      data-member2firstname=""
                                      data-member2lastname=""
                                      data-member2handicap=""
                                      data-member2country=""
                                      data-member2asg=""

                                      data-member3firstname=""
                                      data-member3lastname=""
                                      data-member3handicap=""
                                      data-member3country=""
                                      data-member3asg=""

                                      data-member4firstname=""
                                      data-member4lastname=""
                                      data-member4handicap=""
                                      data-member4country=""
                                      data-member4asg=""

                                      data-availability="4"
                                      data-costs=""
                                      data-realcost="60"
                                      data-date="03-11-2016"
                                      data-start="11h20"
                                      data-dateoriginal="2016-11-03 11:20:00"
                                      data-toggle="modal" data-target="#modal-form"
                                      data-already=""

                                      ><span class="icon icon-checkmark">
                                      </span> Book</button>


                                    </div>
                                  </div>






                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                    <div class="gc-creaneau-heure offre" style="">
                                      <time>11h30</time><br/>


                                      <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                      <div class="gc-players">

                                        <span class="ico-player " id="ico_player_1"></span>
                                        <span class="ico-player " id="ico_player_2"></span>
                                        <span class="ico-player " id="ico_player_3"></span>
                                        <span class="ico-player " id="ico_player_4"></span>
                                      </div>
                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                      <button class="btn btn-default bookingBtn"

                                        data-member1firstname =""
                                        data-member1lastname =""
                                        data-member1handicap =""
                                        data-member1country =""
                                        data-member1asg=""

                                        data-member2firstname=""
                                        data-member2lastname=""
                                        data-member2handicap=""
                                        data-member2country=""
                                        data-member2asg=""

                                        data-member3firstname=""
                                        data-member3lastname=""
                                        data-member3handicap=""
                                        data-member3country=""
                                        data-member3asg=""

                                        data-member4firstname=""
                                        data-member4lastname=""
                                        data-member4handicap=""
                                        data-member4country=""
                                        data-member4asg=""

                                        data-availability="4"
                                        data-costs=""
                                        data-realcost="60"
                                        data-date="03-11-2016"
                                        data-start="11h30"
                                        data-dateoriginal="2016-11-03 11:30:00"
                                        data-toggle="modal" data-target="#modal-form"
                                        data-already=""

                                        ><span class="icon icon-checkmark">
                                        </span> Book</button>


                                      </div>
                                    </div>






                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                      <div class="gc-creaneau-heure offre" style="">
                                        <time>11h40</time><br/>


                                        <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                        <div class="gc-players">

                                          <span class="ico-player " id="ico_player_1"></span>
                                          <span class="ico-player " id="ico_player_2"></span>
                                          <span class="ico-player " id="ico_player_3"></span>
                                          <span class="ico-player " id="ico_player_4"></span>
                                        </div>
                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                        <button class="btn btn-default bookingBtn"

                                          data-member1firstname =""
                                          data-member1lastname =""
                                          data-member1handicap =""
                                          data-member1country =""
                                          data-member1asg=""

                                          data-member2firstname=""
                                          data-member2lastname=""
                                          data-member2handicap=""
                                          data-member2country=""
                                          data-member2asg=""

                                          data-member3firstname=""
                                          data-member3lastname=""
                                          data-member3handicap=""
                                          data-member3country=""
                                          data-member3asg=""

                                          data-member4firstname=""
                                          data-member4lastname=""
                                          data-member4handicap=""
                                          data-member4country=""
                                          data-member4asg=""

                                          data-availability="4"
                                          data-costs=""
                                          data-realcost="60"
                                          data-date="03-11-2016"
                                          data-start="11h40"
                                          data-dateoriginal="2016-11-03 11:40:00"
                                          data-toggle="modal" data-target="#modal-form"
                                          data-already=""

                                          ><span class="icon icon-checkmark">
                                          </span> Book</button>


                                        </div>
                                      </div>






                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                        <div class="gc-creaneau-heure offre" style="">
                                          <time>11h50</time><br/>


                                          <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                          <div class="gc-players">

                                            <span class="ico-player " id="ico_player_1"></span>
                                            <span class="ico-player " id="ico_player_2"></span>
                                            <span class="ico-player " id="ico_player_3"></span>
                                            <span class="ico-player " id="ico_player_4"></span>
                                          </div>
                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                          <button class="btn btn-default bookingBtn"

                                            data-member1firstname =""
                                            data-member1lastname =""
                                            data-member1handicap =""
                                            data-member1country =""
                                            data-member1asg=""

                                            data-member2firstname=""
                                            data-member2lastname=""
                                            data-member2handicap=""
                                            data-member2country=""
                                            data-member2asg=""

                                            data-member3firstname=""
                                            data-member3lastname=""
                                            data-member3handicap=""
                                            data-member3country=""
                                            data-member3asg=""

                                            data-member4firstname=""
                                            data-member4lastname=""
                                            data-member4handicap=""
                                            data-member4country=""
                                            data-member4asg=""

                                            data-availability="4"
                                            data-costs=""
                                            data-realcost="60"
                                            data-date="03-11-2016"
                                            data-start="11h50"
                                            data-dateoriginal="2016-11-03 11:50:00"
                                            data-toggle="modal" data-target="#modal-form"
                                            data-already=""

                                            ><span class="icon icon-checkmark">
                                            </span> Book</button>


                                          </div>
                                        </div>


                                        <script>today_low_price = 60;</script>

                                      </div>
                                    </div>


                                    <div class="gc-creaneau-horaire" id="creneau_6">
                                      <div class="gc-titre-heure">12h00 - 13h00</div>
                                      <div class="clearfix">







                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                          <div class="gc-creaneau-heure offre" style="">
                                            <time>12h00</time><br/>


                                            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                            <div class="gc-players">

                                              <span class="ico-player occupe " id="ico_player_1"></span>
                                              <span class="ico-player occupe " id="ico_player_2"></span>
                                              <span class="ico-player " id="ico_player_3"></span>
                                              <span class="ico-player " id="ico_player_4"></span>
                                            </div>
                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                            <button class="btn btn-default bookingBtn"

                                              data-member1firstname ="Fritz"
                                              data-member1lastname ="A."
                                              data-member1handicap ="13.4"
                                              data-member1country =""
                                              data-member1asg=""

                                              data-member2firstname="Jacqueline"
                                              data-member2lastname="E."
                                              data-member2handicap="18.5"
                                              data-member2country=""
                                              data-member2asg=""

                                              data-member3firstname=""
                                              data-member3lastname=""
                                              data-member3handicap=""
                                              data-member3country=""
                                              data-member3asg=""

                                              data-member4firstname=""
                                              data-member4lastname=""
                                              data-member4handicap=""
                                              data-member4country=""
                                              data-member4asg=""

                                              data-availability="2"
                                              data-costs=""
                                              data-realcost="60"
                                              data-date="03-11-2016"
                                              data-start="12h00"
                                              data-dateoriginal="2016-11-03 12:00:00"
                                              data-toggle="modal" data-target="#modal-form"
                                              data-already=""

                                              ><span class="icon icon-checkmark">
                                              </span> Book</button>


                                            </div>
                                          </div>






                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                            <div class="gc-creaneau-heure offre" style="">
                                              <time>12h10</time><br/>


                                              <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                              <div class="gc-players">

                                                <span class="ico-player " id="ico_player_1"></span>
                                                <span class="ico-player " id="ico_player_2"></span>
                                                <span class="ico-player " id="ico_player_3"></span>
                                                <span class="ico-player " id="ico_player_4"></span>
                                              </div>
                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                              <button class="btn btn-default bookingBtn"

                                                data-member1firstname =""
                                                data-member1lastname =""
                                                data-member1handicap =""
                                                data-member1country =""
                                                data-member1asg=""

                                                data-member2firstname=""
                                                data-member2lastname=""
                                                data-member2handicap=""
                                                data-member2country=""
                                                data-member2asg=""

                                                data-member3firstname=""
                                                data-member3lastname=""
                                                data-member3handicap=""
                                                data-member3country=""
                                                data-member3asg=""

                                                data-member4firstname=""
                                                data-member4lastname=""
                                                data-member4handicap=""
                                                data-member4country=""
                                                data-member4asg=""

                                                data-availability="4"
                                                data-costs=""
                                                data-realcost="60"
                                                data-date="03-11-2016"
                                                data-start="12h10"
                                                data-dateoriginal="2016-11-03 12:10:00"
                                                data-toggle="modal" data-target="#modal-form"
                                                data-already=""

                                                ><span class="icon icon-checkmark">
                                                </span> Book</button>


                                              </div>
                                            </div>






                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                              <div class="gc-creaneau-heure offre" style="">
                                                <time>12h20</time><br/>


                                                <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                <div class="gc-players">

                                                  <span class="ico-player " id="ico_player_1"></span>
                                                  <span class="ico-player " id="ico_player_2"></span>
                                                  <span class="ico-player " id="ico_player_3"></span>
                                                  <span class="ico-player " id="ico_player_4"></span>
                                                </div>
                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                <button class="btn btn-default bookingBtn"

                                                  data-member1firstname =""
                                                  data-member1lastname =""
                                                  data-member1handicap =""
                                                  data-member1country =""
                                                  data-member1asg=""

                                                  data-member2firstname=""
                                                  data-member2lastname=""
                                                  data-member2handicap=""
                                                  data-member2country=""
                                                  data-member2asg=""

                                                  data-member3firstname=""
                                                  data-member3lastname=""
                                                  data-member3handicap=""
                                                  data-member3country=""
                                                  data-member3asg=""

                                                  data-member4firstname=""
                                                  data-member4lastname=""
                                                  data-member4handicap=""
                                                  data-member4country=""
                                                  data-member4asg=""

                                                  data-availability="4"
                                                  data-costs=""
                                                  data-realcost="60"
                                                  data-date="03-11-2016"
                                                  data-start="12h20"
                                                  data-dateoriginal="2016-11-03 12:20:00"
                                                  data-toggle="modal" data-target="#modal-form"
                                                  data-already=""

                                                  ><span class="icon icon-checkmark">
                                                  </span> Book</button>


                                                </div>
                                              </div>






                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                <div class="gc-creaneau-heure offre" style="">
                                                  <time>12h30</time><br/>


                                                  <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                  <div class="gc-players">

                                                    <span class="ico-player occupe " id="ico_player_1"></span>
                                                    <span class="ico-player occupe " id="ico_player_2"></span>
                                                    <span class="ico-player " id="ico_player_3"></span>
                                                    <span class="ico-player " id="ico_player_4"></span>
                                                  </div>
                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                  <button class="btn btn-default bookingBtn"

                                                    data-member1firstname ="markus"
                                                    data-member1lastname ="Z."
                                                    data-member1handicap ="15"
                                                    data-member1country =""
                                                    data-member1asg=""

                                                    data-member2firstname="Roswita"
                                                    data-member2lastname="Z."
                                                    data-member2handicap="15"
                                                    data-member2country=""
                                                    data-member2asg=""

                                                    data-member3firstname=""
                                                    data-member3lastname=""
                                                    data-member3handicap=""
                                                    data-member3country=""
                                                    data-member3asg=""

                                                    data-member4firstname=""
                                                    data-member4lastname=""
                                                    data-member4handicap=""
                                                    data-member4country=""
                                                    data-member4asg=""

                                                    data-availability="2"
                                                    data-costs=""
                                                    data-realcost="60"
                                                    data-date="03-11-2016"
                                                    data-start="12h30"
                                                    data-dateoriginal="2016-11-03 12:30:00"
                                                    data-toggle="modal" data-target="#modal-form"
                                                    data-already=""

                                                    ><span class="icon icon-checkmark">
                                                    </span> Book</button>


                                                  </div>
                                                </div>






                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                  <div class="gc-creaneau-heure offre" style="">
                                                    <time>12h40</time><br/>


                                                    <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                    <div class="gc-players">

                                                      <span class="ico-player " id="ico_player_1"></span>
                                                      <span class="ico-player " id="ico_player_2"></span>
                                                      <span class="ico-player " id="ico_player_3"></span>
                                                      <span class="ico-player " id="ico_player_4"></span>
                                                    </div>
                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                    <button class="btn btn-default bookingBtn"

                                                      data-member1firstname =""
                                                      data-member1lastname =""
                                                      data-member1handicap =""
                                                      data-member1country =""
                                                      data-member1asg=""

                                                      data-member2firstname=""
                                                      data-member2lastname=""
                                                      data-member2handicap=""
                                                      data-member2country=""
                                                      data-member2asg=""

                                                      data-member3firstname=""
                                                      data-member3lastname=""
                                                      data-member3handicap=""
                                                      data-member3country=""
                                                      data-member3asg=""

                                                      data-member4firstname=""
                                                      data-member4lastname=""
                                                      data-member4handicap=""
                                                      data-member4country=""
                                                      data-member4asg=""

                                                      data-availability="4"
                                                      data-costs=""
                                                      data-realcost="60"
                                                      data-date="03-11-2016"
                                                      data-start="12h40"
                                                      data-dateoriginal="2016-11-03 12:40:00"
                                                      data-toggle="modal" data-target="#modal-form"
                                                      data-already=""

                                                      ><span class="icon icon-checkmark">
                                                      </span> Book</button>


                                                    </div>
                                                  </div>






                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                    <div class="gc-creaneau-heure offre" style="">
                                                      <time>12h50</time><br/>


                                                      <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                      <div class="gc-players">

                                                        <span class="ico-player occupe " id="ico_player_1"></span>
                                                        <span class="ico-player " id="ico_player_2"></span>
                                                        <span class="ico-player " id="ico_player_3"></span>
                                                        <span class="ico-player " id="ico_player_4"></span>
                                                      </div>
                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                      <button class="btn btn-default bookingBtn"

                                                        data-member1firstname ="Orietta"
                                                        data-member1lastname ="D."
                                                        data-member1handicap ="23.6"
                                                        data-member1country =""
                                                        data-member1asg=""

                                                        data-member2firstname=""
                                                        data-member2lastname=""
                                                        data-member2handicap=""
                                                        data-member2country=""
                                                        data-member2asg=""

                                                        data-member3firstname=""
                                                        data-member3lastname=""
                                                        data-member3handicap=""
                                                        data-member3country=""
                                                        data-member3asg=""

                                                        data-member4firstname=""
                                                        data-member4lastname=""
                                                        data-member4handicap=""
                                                        data-member4country=""
                                                        data-member4asg=""

                                                        data-availability="3"
                                                        data-costs=""
                                                        data-realcost="60"
                                                        data-date="03-11-2016"
                                                        data-start="12h50"
                                                        data-dateoriginal="2016-11-03 12:50:00"
                                                        data-toggle="modal" data-target="#modal-form"
                                                        data-already=""

                                                        ><span class="icon icon-checkmark">
                                                        </span> Book</button>


                                                      </div>
                                                    </div>


                                                    <script>today_low_price = 60;</script>

                                                  </div>
                                                </div>


                                                <div class="gc-creaneau-horaire" id="creneau_7">
                                                  <div class="gc-titre-heure">13h00 - 14h00</div>
                                                  <div class="clearfix">







                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                      <div class="gc-creaneau-heure offre" style="">
                                                        <time>13h00</time><br/>


                                                        <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                        <div class="gc-players">

                                                          <span class="ico-player occupe " id="ico_player_1"></span>
                                                          <span class="ico-player occupe " id="ico_player_2"></span>
                                                          <span class="ico-player " id="ico_player_3"></span>
                                                          <span class="ico-player " id="ico_player_4"></span>
                                                        </div>
                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                        <button class="btn btn-default bookingBtn"

                                                          data-member1firstname ="Alain"
                                                          data-member1lastname ="V."
                                                          data-member1handicap ="3.9"
                                                          data-member1country =""
                                                          data-member1asg=""

                                                          data-member2firstname="Stéphanie"
                                                          data-member2lastname="V."
                                                          data-member2handicap="19"
                                                          data-member2country=""
                                                          data-member2asg=""

                                                          data-member3firstname=""
                                                          data-member3lastname=""
                                                          data-member3handicap=""
                                                          data-member3country=""
                                                          data-member3asg=""

                                                          data-member4firstname=""
                                                          data-member4lastname=""
                                                          data-member4handicap=""
                                                          data-member4country=""
                                                          data-member4asg=""

                                                          data-availability="2"
                                                          data-costs=""
                                                          data-realcost="60"
                                                          data-date="03-11-2016"
                                                          data-start="13h00"
                                                          data-dateoriginal="2016-11-03 13:00:00"
                                                          data-toggle="modal" data-target="#modal-form"
                                                          data-already=""

                                                          ><span class="icon icon-checkmark">
                                                          </span> Book</button>


                                                        </div>
                                                      </div>






                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                        <div class="gc-creaneau-heure offre" style="">
                                                          <time>13h10</time><br/>


                                                          <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                          <div class="gc-players">

                                                            <span class="ico-player occupe " id="ico_player_1"></span>
                                                            <span class="ico-player occupe " id="ico_player_2"></span>
                                                            <span class="ico-player " id="ico_player_3"></span>
                                                            <span class="ico-player " id="ico_player_4"></span>
                                                          </div>
                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                          <button class="btn btn-default bookingBtn"

                                                            data-member1firstname ="Daniel"
                                                            data-member1lastname ="D."
                                                            data-member1handicap ="22.1"
                                                            data-member1country =""
                                                            data-member1asg=""

                                                            data-member2firstname="Patrick-Olivier"
                                                            data-member2lastname="P."
                                                            data-member2handicap="26.2"
                                                            data-member2country=""
                                                            data-member2asg=""

                                                            data-member3firstname=""
                                                            data-member3lastname=""
                                                            data-member3handicap=""
                                                            data-member3country=""
                                                            data-member3asg=""

                                                            data-member4firstname=""
                                                            data-member4lastname=""
                                                            data-member4handicap=""
                                                            data-member4country=""
                                                            data-member4asg=""

                                                            data-availability="2"
                                                            data-costs=""
                                                            data-realcost="60"
                                                            data-date="03-11-2016"
                                                            data-start="13h10"
                                                            data-dateoriginal="2016-11-03 13:10:00"
                                                            data-toggle="modal" data-target="#modal-form"
                                                            data-already=""

                                                            ><span class="icon icon-checkmark">
                                                            </span> Book</button>


                                                          </div>
                                                        </div>






                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                          <div class="gc-creaneau-heure offre" style="">
                                                            <time>13h20</time><br/>


                                                            <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                            <div class="gc-players">

                                                              <span class="ico-player " id="ico_player_1"></span>
                                                              <span class="ico-player " id="ico_player_2"></span>
                                                              <span class="ico-player " id="ico_player_3"></span>
                                                              <span class="ico-player " id="ico_player_4"></span>
                                                            </div>
                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                            <button class="btn btn-default bookingBtn"

                                                              data-member1firstname =""
                                                              data-member1lastname =""
                                                              data-member1handicap =""
                                                              data-member1country =""
                                                              data-member1asg=""

                                                              data-member2firstname=""
                                                              data-member2lastname=""
                                                              data-member2handicap=""
                                                              data-member2country=""
                                                              data-member2asg=""

                                                              data-member3firstname=""
                                                              data-member3lastname=""
                                                              data-member3handicap=""
                                                              data-member3country=""
                                                              data-member3asg=""

                                                              data-member4firstname=""
                                                              data-member4lastname=""
                                                              data-member4handicap=""
                                                              data-member4country=""
                                                              data-member4asg=""

                                                              data-availability="4"
                                                              data-costs=""
                                                              data-realcost="60"
                                                              data-date="03-11-2016"
                                                              data-start="13h20"
                                                              data-dateoriginal="2016-11-03 13:20:00"
                                                              data-toggle="modal" data-target="#modal-form"
                                                              data-already=""

                                                              ><span class="icon icon-checkmark">
                                                              </span> Book</button>


                                                            </div>
                                                          </div>






                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                            <div class="gc-creaneau-heure offre" style="">
                                                              <time>13h30</time><br/>


                                                              <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                              <div class="gc-players">

                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                <span class="ico-player " id="ico_player_4"></span>
                                                              </div>
                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                              <button class="btn btn-default bookingBtn"

                                                                data-member1firstname =""
                                                                data-member1lastname =""
                                                                data-member1handicap =""
                                                                data-member1country =""
                                                                data-member1asg=""

                                                                data-member2firstname=""
                                                                data-member2lastname=""
                                                                data-member2handicap=""
                                                                data-member2country=""
                                                                data-member2asg=""

                                                                data-member3firstname=""
                                                                data-member3lastname=""
                                                                data-member3handicap=""
                                                                data-member3country=""
                                                                data-member3asg=""

                                                                data-member4firstname=""
                                                                data-member4lastname=""
                                                                data-member4handicap=""
                                                                data-member4country=""
                                                                data-member4asg=""

                                                                data-availability="4"
                                                                data-costs=""
                                                                data-realcost="60"
                                                                data-date="03-11-2016"
                                                                data-start="13h30"
                                                                data-dateoriginal="2016-11-03 13:30:00"
                                                                data-toggle="modal" data-target="#modal-form"
                                                                data-already=""

                                                                ><span class="icon icon-checkmark">
                                                                </span> Book</button>


                                                              </div>
                                                            </div>






                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                              <div class="gc-creaneau-heure offre" style="">
                                                                <time>13h40</time><br/>


                                                                <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                                <div class="gc-players">

                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                </div>
                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                <button class="btn btn-default bookingBtn"

                                                                  data-member1firstname =""
                                                                  data-member1lastname =""
                                                                  data-member1handicap =""
                                                                  data-member1country =""
                                                                  data-member1asg=""

                                                                  data-member2firstname=""
                                                                  data-member2lastname=""
                                                                  data-member2handicap=""
                                                                  data-member2country=""
                                                                  data-member2asg=""

                                                                  data-member3firstname=""
                                                                  data-member3lastname=""
                                                                  data-member3handicap=""
                                                                  data-member3country=""
                                                                  data-member3asg=""

                                                                  data-member4firstname=""
                                                                  data-member4lastname=""
                                                                  data-member4handicap=""
                                                                  data-member4country=""
                                                                  data-member4asg=""

                                                                  data-availability="4"
                                                                  data-costs=""
                                                                  data-realcost="60"
                                                                  data-date="03-11-2016"
                                                                  data-start="13h40"
                                                                  data-dateoriginal="2016-11-03 13:40:00"
                                                                  data-toggle="modal" data-target="#modal-form"
                                                                  data-already=""

                                                                  ><span class="icon icon-checkmark">
                                                                  </span> Book</button>


                                                                </div>
                                                              </div>






                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                <div class="gc-creaneau-heure offre" style="">
                                                                  <time>13h50</time><br/>


                                                                  <del> 90.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                                  <div class="gc-players">

                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                  </div>
                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                  <button class="btn btn-default bookingBtn"

                                                                    data-member1firstname =""
                                                                    data-member1lastname =""
                                                                    data-member1handicap =""
                                                                    data-member1country =""
                                                                    data-member1asg=""

                                                                    data-member2firstname=""
                                                                    data-member2lastname=""
                                                                    data-member2handicap=""
                                                                    data-member2country=""
                                                                    data-member2asg=""

                                                                    data-member3firstname=""
                                                                    data-member3lastname=""
                                                                    data-member3handicap=""
                                                                    data-member3country=""
                                                                    data-member3asg=""

                                                                    data-member4firstname=""
                                                                    data-member4lastname=""
                                                                    data-member4handicap=""
                                                                    data-member4country=""
                                                                    data-member4asg=""

                                                                    data-availability="4"
                                                                    data-costs=""
                                                                    data-realcost="60"
                                                                    data-date="03-11-2016"
                                                                    data-start="13h50"
                                                                    data-dateoriginal="2016-11-03 13:50:00"
                                                                    data-toggle="modal" data-target="#modal-form"
                                                                    data-already=""

                                                                    ><span class="icon icon-checkmark">
                                                                    </span> Book</button>


                                                                  </div>
                                                                </div>


                                                                <script>today_low_price = 60;</script>

                                                              </div>
                                                            </div>


                                                            <div class="gc-creaneau-horaire" id="creneau_8">
                                                              <div class="gc-titre-heure">14h00 - 15h00</div>
                                                              <div class="clearfix">







                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                  <div class="gc-creaneau-heure offre" style="">
                                                                    <time>14h00</time><br/>


                                                                    <del> 70.-</del> / Player                                        <span class="prix-offre" >60.- </span>
                                                                    <div class="gc-players">

                                                                      <span class="ico-player occupe " id="ico_player_1"></span>
                                                                      <span class="ico-player occupe " id="ico_player_2"></span>
                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                    </div>
                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                    <button class="btn btn-default bookingBtn"

                                                                      data-member1firstname ="Yves"
                                                                      data-member1lastname ="M."
                                                                      data-member1handicap ="9.6"
                                                                      data-member1country =""
                                                                      data-member1asg=""

                                                                      data-member2firstname="Samuel "
                                                                      data-member2lastname="M."
                                                                      data-member2handicap="224"
                                                                      data-member2country=""
                                                                      data-member2asg=""

                                                                      data-member3firstname=""
                                                                      data-member3lastname=""
                                                                      data-member3handicap=""
                                                                      data-member3country=""
                                                                      data-member3asg=""

                                                                      data-member4firstname=""
                                                                      data-member4lastname=""
                                                                      data-member4handicap=""
                                                                      data-member4country=""
                                                                      data-member4asg=""

                                                                      data-availability="2"
                                                                      data-costs=""
                                                                      data-realcost="60"
                                                                      data-date="03-11-2016"
                                                                      data-start="14h00"
                                                                      data-dateoriginal="2016-11-03 14:00:00"
                                                                      data-toggle="modal" data-target="#modal-form"
                                                                      data-already=""

                                                                      ><span class="icon icon-checkmark">
                                                                      </span> Book</button>


                                                                    </div>
                                                                  </div>






                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                    <div class="gc-creaneau-heure offre" style="">
                                                                      <time>14h10</time><br/>


                                                                      <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                      <div class="gc-players">

                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                      </div>
                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                      <button class="btn btn-default bookingBtn"

                                                                        data-member1firstname =""
                                                                        data-member1lastname =""
                                                                        data-member1handicap =""
                                                                        data-member1country =""
                                                                        data-member1asg=""

                                                                        data-member2firstname=""
                                                                        data-member2lastname=""
                                                                        data-member2handicap=""
                                                                        data-member2country=""
                                                                        data-member2asg=""

                                                                        data-member3firstname=""
                                                                        data-member3lastname=""
                                                                        data-member3handicap=""
                                                                        data-member3country=""
                                                                        data-member3asg=""

                                                                        data-member4firstname=""
                                                                        data-member4lastname=""
                                                                        data-member4handicap=""
                                                                        data-member4country=""
                                                                        data-member4asg=""

                                                                        data-availability="4"
                                                                        data-costs=""
                                                                        data-realcost="50"
                                                                        data-date="03-11-2016"
                                                                        data-start="14h10"
                                                                        data-dateoriginal="2016-11-03 14:10:00"
                                                                        data-toggle="modal" data-target="#modal-form"
                                                                        data-already=""

                                                                        ><span class="icon icon-checkmark">
                                                                        </span> Book</button>


                                                                      </div>
                                                                    </div>






                                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                      <div class="gc-creaneau-heure offre" style="">
                                                                        <time>14h20</time><br/>


                                                                        <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                        <div class="gc-players">

                                                                          <span class="ico-player " id="ico_player_1"></span>
                                                                          <span class="ico-player " id="ico_player_2"></span>
                                                                          <span class="ico-player " id="ico_player_3"></span>
                                                                          <span class="ico-player " id="ico_player_4"></span>
                                                                        </div>
                                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                        <button class="btn btn-default bookingBtn"

                                                                          data-member1firstname =""
                                                                          data-member1lastname =""
                                                                          data-member1handicap =""
                                                                          data-member1country =""
                                                                          data-member1asg=""

                                                                          data-member2firstname=""
                                                                          data-member2lastname=""
                                                                          data-member2handicap=""
                                                                          data-member2country=""
                                                                          data-member2asg=""

                                                                          data-member3firstname=""
                                                                          data-member3lastname=""
                                                                          data-member3handicap=""
                                                                          data-member3country=""
                                                                          data-member3asg=""

                                                                          data-member4firstname=""
                                                                          data-member4lastname=""
                                                                          data-member4handicap=""
                                                                          data-member4country=""
                                                                          data-member4asg=""

                                                                          data-availability="4"
                                                                          data-costs=""
                                                                          data-realcost="50"
                                                                          data-date="03-11-2016"
                                                                          data-start="14h20"
                                                                          data-dateoriginal="2016-11-03 14:20:00"
                                                                          data-toggle="modal" data-target="#modal-form"
                                                                          data-already=""

                                                                          ><span class="icon icon-checkmark">
                                                                          </span> Book</button>


                                                                        </div>
                                                                      </div>






                                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                        <div class="gc-creaneau-heure offre" style="">
                                                                          <time>14h30</time><br/>


                                                                          <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                          <div class="gc-players">

                                                                            <span class="ico-player " id="ico_player_1"></span>
                                                                            <span class="ico-player " id="ico_player_2"></span>
                                                                            <span class="ico-player " id="ico_player_3"></span>
                                                                            <span class="ico-player " id="ico_player_4"></span>
                                                                          </div>
                                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                          <button class="btn btn-default bookingBtn"

                                                                            data-member1firstname =""
                                                                            data-member1lastname =""
                                                                            data-member1handicap =""
                                                                            data-member1country =""
                                                                            data-member1asg=""

                                                                            data-member2firstname=""
                                                                            data-member2lastname=""
                                                                            data-member2handicap=""
                                                                            data-member2country=""
                                                                            data-member2asg=""

                                                                            data-member3firstname=""
                                                                            data-member3lastname=""
                                                                            data-member3handicap=""
                                                                            data-member3country=""
                                                                            data-member3asg=""

                                                                            data-member4firstname=""
                                                                            data-member4lastname=""
                                                                            data-member4handicap=""
                                                                            data-member4country=""
                                                                            data-member4asg=""

                                                                            data-availability="4"
                                                                            data-costs=""
                                                                            data-realcost="50"
                                                                            data-date="03-11-2016"
                                                                            data-start="14h30"
                                                                            data-dateoriginal="2016-11-03 14:30:00"
                                                                            data-toggle="modal" data-target="#modal-form"
                                                                            data-already=""

                                                                            ><span class="icon icon-checkmark">
                                                                            </span> Book</button>


                                                                          </div>
                                                                        </div>






                                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                          <div class="gc-creaneau-heure offre" style="">
                                                                            <time>14h40</time><br/>


                                                                            <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                            <div class="gc-players">

                                                                              <span class="ico-player " id="ico_player_1"></span>
                                                                              <span class="ico-player " id="ico_player_2"></span>
                                                                              <span class="ico-player " id="ico_player_3"></span>
                                                                              <span class="ico-player " id="ico_player_4"></span>
                                                                            </div>
                                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                            <button class="btn btn-default bookingBtn"

                                                                              data-member1firstname =""
                                                                              data-member1lastname =""
                                                                              data-member1handicap =""
                                                                              data-member1country =""
                                                                              data-member1asg=""

                                                                              data-member2firstname=""
                                                                              data-member2lastname=""
                                                                              data-member2handicap=""
                                                                              data-member2country=""
                                                                              data-member2asg=""

                                                                              data-member3firstname=""
                                                                              data-member3lastname=""
                                                                              data-member3handicap=""
                                                                              data-member3country=""
                                                                              data-member3asg=""

                                                                              data-member4firstname=""
                                                                              data-member4lastname=""
                                                                              data-member4handicap=""
                                                                              data-member4country=""
                                                                              data-member4asg=""

                                                                              data-availability="4"
                                                                              data-costs=""
                                                                              data-realcost="50"
                                                                              data-date="03-11-2016"
                                                                              data-start="14h40"
                                                                              data-dateoriginal="2016-11-03 14:40:00"
                                                                              data-toggle="modal" data-target="#modal-form"
                                                                              data-already=""

                                                                              ><span class="icon icon-checkmark">
                                                                              </span> Book</button>


                                                                            </div>
                                                                          </div>






                                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                            <div class="gc-creaneau-heure offre" style="">
                                                                              <time>14h50</time><br/>


                                                                              <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                              <div class="gc-players">

                                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                                <span class="ico-player " id="ico_player_4"></span>
                                                                              </div>
                                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                              <button class="btn btn-default bookingBtn"

                                                                                data-member1firstname =""
                                                                                data-member1lastname =""
                                                                                data-member1handicap =""
                                                                                data-member1country =""
                                                                                data-member1asg=""

                                                                                data-member2firstname=""
                                                                                data-member2lastname=""
                                                                                data-member2handicap=""
                                                                                data-member2country=""
                                                                                data-member2asg=""

                                                                                data-member3firstname=""
                                                                                data-member3lastname=""
                                                                                data-member3handicap=""
                                                                                data-member3country=""
                                                                                data-member3asg=""

                                                                                data-member4firstname=""
                                                                                data-member4lastname=""
                                                                                data-member4handicap=""
                                                                                data-member4country=""
                                                                                data-member4asg=""

                                                                                data-availability="4"
                                                                                data-costs=""
                                                                                data-realcost="50"
                                                                                data-date="03-11-2016"
                                                                                data-start="14h50"
                                                                                data-dateoriginal="2016-11-03 14:50:00"
                                                                                data-toggle="modal" data-target="#modal-form"
                                                                                data-already=""

                                                                                ><span class="icon icon-checkmark">
                                                                                </span> Book</button>


                                                                              </div>
                                                                            </div>


                                                                            <script>today_low_price = 50;</script>

                                                                          </div>
                                                                        </div>


                                                                        <div class="gc-creaneau-horaire" id="creneau_9">
                                                                          <div class="gc-titre-heure">15h00 - 16h00</div>
                                                                          <div class="clearfix">







                                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                              <div class="gc-creaneau-heure offre" style="">
                                                                                <time>15h00</time><br/>


                                                                                <del> 70.-</del> / Player                                        <span class="prix-offre" >50.- </span>
                                                                                <div class="gc-players">

                                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                                </div>
                                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                <button class="btn btn-default bookingBtn"

                                                                                  data-member1firstname =""
                                                                                  data-member1lastname =""
                                                                                  data-member1handicap =""
                                                                                  data-member1country =""
                                                                                  data-member1asg=""

                                                                                  data-member2firstname=""
                                                                                  data-member2lastname=""
                                                                                  data-member2handicap=""
                                                                                  data-member2country=""
                                                                                  data-member2asg=""

                                                                                  data-member3firstname=""
                                                                                  data-member3lastname=""
                                                                                  data-member3handicap=""
                                                                                  data-member3country=""
                                                                                  data-member3asg=""

                                                                                  data-member4firstname=""
                                                                                  data-member4lastname=""
                                                                                  data-member4handicap=""
                                                                                  data-member4country=""
                                                                                  data-member4asg=""

                                                                                  data-availability="4"
                                                                                  data-costs=""
                                                                                  data-realcost="50"
                                                                                  data-date="03-11-2016"
                                                                                  data-start="15h00"
                                                                                  data-dateoriginal="2016-11-03 15:00:00"
                                                                                  data-toggle="modal" data-target="#modal-form"
                                                                                  data-already=""

                                                                                  ><span class="icon icon-checkmark">
                                                                                  </span> Book</button>


                                                                                </div>
                                                                              </div>






                                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                <div class="gc-creaneau-heure offre" style="">
                                                                                  <time>15h10</time><br/>


                                                                                  <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                  <div class="gc-players">

                                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                                  </div>
                                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                  <button class="btn btn-default bookingBtn"

                                                                                    data-member1firstname =""
                                                                                    data-member1lastname =""
                                                                                    data-member1handicap =""
                                                                                    data-member1country =""
                                                                                    data-member1asg=""

                                                                                    data-member2firstname=""
                                                                                    data-member2lastname=""
                                                                                    data-member2handicap=""
                                                                                    data-member2country=""
                                                                                    data-member2asg=""

                                                                                    data-member3firstname=""
                                                                                    data-member3lastname=""
                                                                                    data-member3handicap=""
                                                                                    data-member3country=""
                                                                                    data-member3asg=""

                                                                                    data-member4firstname=""
                                                                                    data-member4lastname=""
                                                                                    data-member4handicap=""
                                                                                    data-member4country=""
                                                                                    data-member4asg=""

                                                                                    data-availability="4"
                                                                                    data-costs=""
                                                                                    data-realcost="40"
                                                                                    data-date="03-11-2016"
                                                                                    data-start="15h10"
                                                                                    data-dateoriginal="2016-11-03 15:10:00"
                                                                                    data-toggle="modal" data-target="#modal-form"
                                                                                    data-already=""

                                                                                    ><span class="icon icon-checkmark">
                                                                                    </span> Book</button>


                                                                                  </div>
                                                                                </div>






                                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                  <div class="gc-creaneau-heure offre" style="">
                                                                                    <time>15h20</time><br/>


                                                                                    <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                    <div class="gc-players">

                                                                                      <span class="ico-player " id="ico_player_1"></span>
                                                                                      <span class="ico-player " id="ico_player_2"></span>
                                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                                    </div>
                                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                    <button class="btn btn-default bookingBtn"

                                                                                      data-member1firstname =""
                                                                                      data-member1lastname =""
                                                                                      data-member1handicap =""
                                                                                      data-member1country =""
                                                                                      data-member1asg=""

                                                                                      data-member2firstname=""
                                                                                      data-member2lastname=""
                                                                                      data-member2handicap=""
                                                                                      data-member2country=""
                                                                                      data-member2asg=""

                                                                                      data-member3firstname=""
                                                                                      data-member3lastname=""
                                                                                      data-member3handicap=""
                                                                                      data-member3country=""
                                                                                      data-member3asg=""

                                                                                      data-member4firstname=""
                                                                                      data-member4lastname=""
                                                                                      data-member4handicap=""
                                                                                      data-member4country=""
                                                                                      data-member4asg=""

                                                                                      data-availability="4"
                                                                                      data-costs=""
                                                                                      data-realcost="40"
                                                                                      data-date="03-11-2016"
                                                                                      data-start="15h20"
                                                                                      data-dateoriginal="2016-11-03 15:20:00"
                                                                                      data-toggle="modal" data-target="#modal-form"
                                                                                      data-already=""

                                                                                      ><span class="icon icon-checkmark">
                                                                                      </span> Book</button>


                                                                                    </div>
                                                                                  </div>






                                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                    <div class="gc-creaneau-heure offre" style="">
                                                                                      <time>15h30</time><br/>


                                                                                      <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                      <div class="gc-players">

                                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                                      </div>
                                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                      <button class="btn btn-default bookingBtn"

                                                                                        data-member1firstname =""
                                                                                        data-member1lastname =""
                                                                                        data-member1handicap =""
                                                                                        data-member1country =""
                                                                                        data-member1asg=""

                                                                                        data-member2firstname=""
                                                                                        data-member2lastname=""
                                                                                        data-member2handicap=""
                                                                                        data-member2country=""
                                                                                        data-member2asg=""

                                                                                        data-member3firstname=""
                                                                                        data-member3lastname=""
                                                                                        data-member3handicap=""
                                                                                        data-member3country=""
                                                                                        data-member3asg=""

                                                                                        data-member4firstname=""
                                                                                        data-member4lastname=""
                                                                                        data-member4handicap=""
                                                                                        data-member4country=""
                                                                                        data-member4asg=""

                                                                                        data-availability="4"
                                                                                        data-costs=""
                                                                                        data-realcost="40"
                                                                                        data-date="03-11-2016"
                                                                                        data-start="15h30"
                                                                                        data-dateoriginal="2016-11-03 15:30:00"
                                                                                        data-toggle="modal" data-target="#modal-form"
                                                                                        data-already=""

                                                                                        ><span class="icon icon-checkmark">
                                                                                        </span> Book</button>


                                                                                      </div>
                                                                                    </div>






                                                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                      <div class="gc-creaneau-heure offre" style="">
                                                                                        <time>15h40</time><br/>


                                                                                        <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                        <div class="gc-players">

                                                                                          <span class="ico-player " id="ico_player_1"></span>
                                                                                          <span class="ico-player " id="ico_player_2"></span>
                                                                                          <span class="ico-player " id="ico_player_3"></span>
                                                                                          <span class="ico-player " id="ico_player_4"></span>
                                                                                        </div>
                                                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                        <button class="btn btn-default bookingBtn"

                                                                                          data-member1firstname =""
                                                                                          data-member1lastname =""
                                                                                          data-member1handicap =""
                                                                                          data-member1country =""
                                                                                          data-member1asg=""

                                                                                          data-member2firstname=""
                                                                                          data-member2lastname=""
                                                                                          data-member2handicap=""
                                                                                          data-member2country=""
                                                                                          data-member2asg=""

                                                                                          data-member3firstname=""
                                                                                          data-member3lastname=""
                                                                                          data-member3handicap=""
                                                                                          data-member3country=""
                                                                                          data-member3asg=""

                                                                                          data-member4firstname=""
                                                                                          data-member4lastname=""
                                                                                          data-member4handicap=""
                                                                                          data-member4country=""
                                                                                          data-member4asg=""

                                                                                          data-availability="4"
                                                                                          data-costs=""
                                                                                          data-realcost="40"
                                                                                          data-date="03-11-2016"
                                                                                          data-start="15h40"
                                                                                          data-dateoriginal="2016-11-03 15:40:00"
                                                                                          data-toggle="modal" data-target="#modal-form"
                                                                                          data-already=""

                                                                                          ><span class="icon icon-checkmark">
                                                                                          </span> Book</button>


                                                                                        </div>
                                                                                      </div>






                                                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                        <div class="gc-creaneau-heure offre" style="">
                                                                                          <time>15h50</time><br/>


                                                                                          <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                          <div class="gc-players">

                                                                                            <span class="ico-player " id="ico_player_1"></span>
                                                                                            <span class="ico-player " id="ico_player_2"></span>
                                                                                            <span class="ico-player " id="ico_player_3"></span>
                                                                                            <span class="ico-player " id="ico_player_4"></span>
                                                                                          </div>
                                                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                          <button class="btn btn-default bookingBtn"

                                                                                            data-member1firstname =""
                                                                                            data-member1lastname =""
                                                                                            data-member1handicap =""
                                                                                            data-member1country =""
                                                                                            data-member1asg=""

                                                                                            data-member2firstname=""
                                                                                            data-member2lastname=""
                                                                                            data-member2handicap=""
                                                                                            data-member2country=""
                                                                                            data-member2asg=""

                                                                                            data-member3firstname=""
                                                                                            data-member3lastname=""
                                                                                            data-member3handicap=""
                                                                                            data-member3country=""
                                                                                            data-member3asg=""

                                                                                            data-member4firstname=""
                                                                                            data-member4lastname=""
                                                                                            data-member4handicap=""
                                                                                            data-member4country=""
                                                                                            data-member4asg=""

                                                                                            data-availability="4"
                                                                                            data-costs=""
                                                                                            data-realcost="40"
                                                                                            data-date="03-11-2016"
                                                                                            data-start="15h50"
                                                                                            data-dateoriginal="2016-11-03 15:50:00"
                                                                                            data-toggle="modal" data-target="#modal-form"
                                                                                            data-already=""

                                                                                            ><span class="icon icon-checkmark">
                                                                                            </span> Book</button>


                                                                                          </div>
                                                                                        </div>


                                                                                        <script>today_low_price = 40;</script>

                                                                                      </div>
                                                                                    </div>


                                                                                    <div class="gc-creaneau-horaire" id="creneau_10">
                                                                                      <div class="gc-titre-heure">16h00 - 17h00</div>
                                                                                      <div class="clearfix">







                                                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                          <div class="gc-creaneau-heure offre" style="">
                                                                                            <time>16h00</time><br/>


                                                                                            <del> 70.-</del> / Player                                        <span class="prix-offre" >40.- </span>
                                                                                            <div class="gc-players">

                                                                                              <span class="ico-player " id="ico_player_1"></span>
                                                                                              <span class="ico-player " id="ico_player_2"></span>
                                                                                              <span class="ico-player " id="ico_player_3"></span>
                                                                                              <span class="ico-player " id="ico_player_4"></span>
                                                                                            </div>
                                                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                            <button class="btn btn-default bookingBtn"

                                                                                              data-member1firstname =""
                                                                                              data-member1lastname =""
                                                                                              data-member1handicap =""
                                                                                              data-member1country =""
                                                                                              data-member1asg=""

                                                                                              data-member2firstname=""
                                                                                              data-member2lastname=""
                                                                                              data-member2handicap=""
                                                                                              data-member2country=""
                                                                                              data-member2asg=""

                                                                                              data-member3firstname=""
                                                                                              data-member3lastname=""
                                                                                              data-member3handicap=""
                                                                                              data-member3country=""
                                                                                              data-member3asg=""

                                                                                              data-member4firstname=""
                                                                                              data-member4lastname=""
                                                                                              data-member4handicap=""
                                                                                              data-member4country=""
                                                                                              data-member4asg=""

                                                                                              data-availability="4"
                                                                                              data-costs=""
                                                                                              data-realcost="40"
                                                                                              data-date="03-11-2016"
                                                                                              data-start="16h00"
                                                                                              data-dateoriginal="2016-11-03 16:00:00"
                                                                                              data-toggle="modal" data-target="#modal-form"
                                                                                              data-already=""

                                                                                              ><span class="icon icon-checkmark">
                                                                                              </span> Book</button>


                                                                                            </div>
                                                                                          </div>






                                                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                            <div class="gc-creaneau-heure offre" style="">
                                                                                              <time>16h10</time><br/>


                                                                                              <del> 70.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                              <div class="gc-players">

                                                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                                                <span class="ico-player " id="ico_player_4"></span>
                                                                                              </div>
                                                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                              <button class="btn btn-default bookingBtn"

                                                                                                data-member1firstname =""
                                                                                                data-member1lastname =""
                                                                                                data-member1handicap =""
                                                                                                data-member1country =""
                                                                                                data-member1asg=""

                                                                                                data-member2firstname=""
                                                                                                data-member2lastname=""
                                                                                                data-member2handicap=""
                                                                                                data-member2country=""
                                                                                                data-member2asg=""

                                                                                                data-member3firstname=""
                                                                                                data-member3lastname=""
                                                                                                data-member3handicap=""
                                                                                                data-member3country=""
                                                                                                data-member3asg=""

                                                                                                data-member4firstname=""
                                                                                                data-member4lastname=""
                                                                                                data-member4handicap=""
                                                                                                data-member4country=""
                                                                                                data-member4asg=""

                                                                                                data-availability="4"
                                                                                                data-costs=""
                                                                                                data-realcost="30"
                                                                                                data-date="03-11-2016"
                                                                                                data-start="16h10"
                                                                                                data-dateoriginal="2016-11-03 16:10:00"
                                                                                                data-toggle="modal" data-target="#modal-form"
                                                                                                data-already=""

                                                                                                ><span class="icon icon-checkmark">
                                                                                                </span> Book</button>


                                                                                              </div>
                                                                                            </div>






                                                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                              <div class="gc-creaneau-heure offre" style="">
                                                                                                <time>16h20</time><br/>


                                                                                                <del> 70.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                <div class="gc-players">

                                                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                                                </div>
                                                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                <button class="btn btn-default bookingBtn"

                                                                                                  data-member1firstname =""
                                                                                                  data-member1lastname =""
                                                                                                  data-member1handicap =""
                                                                                                  data-member1country =""
                                                                                                  data-member1asg=""

                                                                                                  data-member2firstname=""
                                                                                                  data-member2lastname=""
                                                                                                  data-member2handicap=""
                                                                                                  data-member2country=""
                                                                                                  data-member2asg=""

                                                                                                  data-member3firstname=""
                                                                                                  data-member3lastname=""
                                                                                                  data-member3handicap=""
                                                                                                  data-member3country=""
                                                                                                  data-member3asg=""

                                                                                                  data-member4firstname=""
                                                                                                  data-member4lastname=""
                                                                                                  data-member4handicap=""
                                                                                                  data-member4country=""
                                                                                                  data-member4asg=""

                                                                                                  data-availability="4"
                                                                                                  data-costs=""
                                                                                                  data-realcost="30"
                                                                                                  data-date="03-11-2016"
                                                                                                  data-start="16h20"
                                                                                                  data-dateoriginal="2016-11-03 16:20:00"
                                                                                                  data-toggle="modal" data-target="#modal-form"
                                                                                                  data-already=""

                                                                                                  ><span class="icon icon-checkmark">
                                                                                                  </span> Book</button>


                                                                                                </div>
                                                                                              </div>






                                                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                <div class="gc-creaneau-heure offre" style="">
                                                                                                  <time>16h30</time><br/>


                                                                                                  <del> 70.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                  <div class="gc-players">

                                                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                                                  </div>
                                                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                  <button class="btn btn-default bookingBtn"

                                                                                                    data-member1firstname =""
                                                                                                    data-member1lastname =""
                                                                                                    data-member1handicap =""
                                                                                                    data-member1country =""
                                                                                                    data-member1asg=""

                                                                                                    data-member2firstname=""
                                                                                                    data-member2lastname=""
                                                                                                    data-member2handicap=""
                                                                                                    data-member2country=""
                                                                                                    data-member2asg=""

                                                                                                    data-member3firstname=""
                                                                                                    data-member3lastname=""
                                                                                                    data-member3handicap=""
                                                                                                    data-member3country=""
                                                                                                    data-member3asg=""

                                                                                                    data-member4firstname=""
                                                                                                    data-member4lastname=""
                                                                                                    data-member4handicap=""
                                                                                                    data-member4country=""
                                                                                                    data-member4asg=""

                                                                                                    data-availability="4"
                                                                                                    data-costs=""
                                                                                                    data-realcost="30"
                                                                                                    data-date="03-11-2016"
                                                                                                    data-start="16h30"
                                                                                                    data-dateoriginal="2016-11-03 16:30:00"
                                                                                                    data-toggle="modal" data-target="#modal-form"
                                                                                                    data-already=""

                                                                                                    ><span class="icon icon-checkmark">
                                                                                                    </span> Book</button>


                                                                                                  </div>
                                                                                                </div>






                                                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                  <div class="gc-creaneau-heure offre" style="">
                                                                                                    <time>16h40</time><br/>


                                                                                                    <del> 70.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                    <div class="gc-players">

                                                                                                      <span class="ico-player " id="ico_player_1"></span>
                                                                                                      <span class="ico-player " id="ico_player_2"></span>
                                                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                                                    </div>
                                                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                    <button class="btn btn-default bookingBtn"

                                                                                                      data-member1firstname =""
                                                                                                      data-member1lastname =""
                                                                                                      data-member1handicap =""
                                                                                                      data-member1country =""
                                                                                                      data-member1asg=""

                                                                                                      data-member2firstname=""
                                                                                                      data-member2lastname=""
                                                                                                      data-member2handicap=""
                                                                                                      data-member2country=""
                                                                                                      data-member2asg=""

                                                                                                      data-member3firstname=""
                                                                                                      data-member3lastname=""
                                                                                                      data-member3handicap=""
                                                                                                      data-member3country=""
                                                                                                      data-member3asg=""

                                                                                                      data-member4firstname=""
                                                                                                      data-member4lastname=""
                                                                                                      data-member4handicap=""
                                                                                                      data-member4country=""
                                                                                                      data-member4asg=""

                                                                                                      data-availability="4"
                                                                                                      data-costs=""
                                                                                                      data-realcost="30"
                                                                                                      data-date="03-11-2016"
                                                                                                      data-start="16h40"
                                                                                                      data-dateoriginal="2016-11-03 16:40:00"
                                                                                                      data-toggle="modal" data-target="#modal-form"
                                                                                                      data-already=""

                                                                                                      ><span class="icon icon-checkmark">
                                                                                                      </span> Book</button>


                                                                                                    </div>
                                                                                                  </div>






                                                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                    <div class="gc-creaneau-heure offre" style="">
                                                                                                      <time>16h50</time><br/>


                                                                                                      <del> 70.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                      <div class="gc-players">

                                                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                                                      </div>
                                                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                      <button class="btn btn-default bookingBtn"

                                                                                                        data-member1firstname =""
                                                                                                        data-member1lastname =""
                                                                                                        data-member1handicap =""
                                                                                                        data-member1country =""
                                                                                                        data-member1asg=""

                                                                                                        data-member2firstname=""
                                                                                                        data-member2lastname=""
                                                                                                        data-member2handicap=""
                                                                                                        data-member2country=""
                                                                                                        data-member2asg=""

                                                                                                        data-member3firstname=""
                                                                                                        data-member3lastname=""
                                                                                                        data-member3handicap=""
                                                                                                        data-member3country=""
                                                                                                        data-member3asg=""

                                                                                                        data-member4firstname=""
                                                                                                        data-member4lastname=""
                                                                                                        data-member4handicap=""
                                                                                                        data-member4country=""
                                                                                                        data-member4asg=""

                                                                                                        data-availability="4"
                                                                                                        data-costs=""
                                                                                                        data-realcost="30"
                                                                                                        data-date="03-11-2016"
                                                                                                        data-start="16h50"
                                                                                                        data-dateoriginal="2016-11-03 16:50:00"
                                                                                                        data-toggle="modal" data-target="#modal-form"
                                                                                                        data-already=""

                                                                                                        ><span class="icon icon-checkmark">
                                                                                                        </span> Book</button>


                                                                                                      </div>
                                                                                                    </div>


                                                                                                    <script>today_low_price = 30;</script>

                                                                                                  </div>
                                                                                                </div>


                                                                                                <div class="gc-creaneau-horaire" id="creneau_11">
                                                                                                  <div class="gc-titre-heure">17h00 - 18h00</div>
                                                                                                  <div class="clearfix">







                                                                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                      <div class="gc-creaneau-heure offre" style="">
                                                                                                        <time>17h00</time><br/>


                                                                                                        <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                        <div class="gc-players">

                                                                                                          <span class="ico-player " id="ico_player_1"></span>
                                                                                                          <span class="ico-player " id="ico_player_2"></span>
                                                                                                          <span class="ico-player " id="ico_player_3"></span>
                                                                                                          <span class="ico-player " id="ico_player_4"></span>
                                                                                                        </div>
                                                                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                        <button class="btn btn-default bookingBtn"

                                                                                                          data-member1firstname =""
                                                                                                          data-member1lastname =""
                                                                                                          data-member1handicap =""
                                                                                                          data-member1country =""
                                                                                                          data-member1asg=""

                                                                                                          data-member2firstname=""
                                                                                                          data-member2lastname=""
                                                                                                          data-member2handicap=""
                                                                                                          data-member2country=""
                                                                                                          data-member2asg=""

                                                                                                          data-member3firstname=""
                                                                                                          data-member3lastname=""
                                                                                                          data-member3handicap=""
                                                                                                          data-member3country=""
                                                                                                          data-member3asg=""

                                                                                                          data-member4firstname=""
                                                                                                          data-member4lastname=""
                                                                                                          data-member4handicap=""
                                                                                                          data-member4country=""
                                                                                                          data-member4asg=""

                                                                                                          data-availability="4"
                                                                                                          data-costs=""
                                                                                                          data-realcost="30"
                                                                                                          data-date="03-11-2016"
                                                                                                          data-start="17h00"
                                                                                                          data-dateoriginal="2016-11-03 17:00:00"
                                                                                                          data-toggle="modal" data-target="#modal-form"
                                                                                                          data-already=""

                                                                                                          ><span class="icon icon-checkmark">
                                                                                                          </span> Book</button>


                                                                                                        </div>
                                                                                                      </div>






                                                                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                        <div class="gc-creaneau-heure offre" style="">
                                                                                                          <time>17h10</time><br/>


                                                                                                          <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                          <div class="gc-players">

                                                                                                            <span class="ico-player " id="ico_player_1"></span>
                                                                                                            <span class="ico-player " id="ico_player_2"></span>
                                                                                                            <span class="ico-player " id="ico_player_3"></span>
                                                                                                            <span class="ico-player " id="ico_player_4"></span>
                                                                                                          </div>
                                                                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                          <button class="btn btn-default bookingBtn"

                                                                                                            data-member1firstname =""
                                                                                                            data-member1lastname =""
                                                                                                            data-member1handicap =""
                                                                                                            data-member1country =""
                                                                                                            data-member1asg=""

                                                                                                            data-member2firstname=""
                                                                                                            data-member2lastname=""
                                                                                                            data-member2handicap=""
                                                                                                            data-member2country=""
                                                                                                            data-member2asg=""

                                                                                                            data-member3firstname=""
                                                                                                            data-member3lastname=""
                                                                                                            data-member3handicap=""
                                                                                                            data-member3country=""
                                                                                                            data-member3asg=""

                                                                                                            data-member4firstname=""
                                                                                                            data-member4lastname=""
                                                                                                            data-member4handicap=""
                                                                                                            data-member4country=""
                                                                                                            data-member4asg=""

                                                                                                            data-availability="4"
                                                                                                            data-costs=""
                                                                                                            data-realcost="30"
                                                                                                            data-date="03-11-2016"
                                                                                                            data-start="17h10"
                                                                                                            data-dateoriginal="2016-11-03 17:10:00"
                                                                                                            data-toggle="modal" data-target="#modal-form"
                                                                                                            data-already=""

                                                                                                            ><span class="icon icon-checkmark">
                                                                                                            </span> Book</button>


                                                                                                          </div>
                                                                                                        </div>






                                                                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                          <div class="gc-creaneau-heure offre" style="">
                                                                                                            <time>17h20</time><br/>


                                                                                                            <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                            <div class="gc-players">

                                                                                                              <span class="ico-player " id="ico_player_1"></span>
                                                                                                              <span class="ico-player " id="ico_player_2"></span>
                                                                                                              <span class="ico-player " id="ico_player_3"></span>
                                                                                                              <span class="ico-player " id="ico_player_4"></span>
                                                                                                            </div>
                                                                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                            <button class="btn btn-default bookingBtn"

                                                                                                              data-member1firstname =""
                                                                                                              data-member1lastname =""
                                                                                                              data-member1handicap =""
                                                                                                              data-member1country =""
                                                                                                              data-member1asg=""

                                                                                                              data-member2firstname=""
                                                                                                              data-member2lastname=""
                                                                                                              data-member2handicap=""
                                                                                                              data-member2country=""
                                                                                                              data-member2asg=""

                                                                                                              data-member3firstname=""
                                                                                                              data-member3lastname=""
                                                                                                              data-member3handicap=""
                                                                                                              data-member3country=""
                                                                                                              data-member3asg=""

                                                                                                              data-member4firstname=""
                                                                                                              data-member4lastname=""
                                                                                                              data-member4handicap=""
                                                                                                              data-member4country=""
                                                                                                              data-member4asg=""

                                                                                                              data-availability="4"
                                                                                                              data-costs=""
                                                                                                              data-realcost="30"
                                                                                                              data-date="03-11-2016"
                                                                                                              data-start="17h20"
                                                                                                              data-dateoriginal="2016-11-03 17:20:00"
                                                                                                              data-toggle="modal" data-target="#modal-form"
                                                                                                              data-already=""

                                                                                                              ><span class="icon icon-checkmark">
                                                                                                              </span> Book</button>


                                                                                                            </div>
                                                                                                          </div>






                                                                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                            <div class="gc-creaneau-heure offre" style="">
                                                                                                              <time>17h30</time><br/>


                                                                                                              <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                              <div class="gc-players">

                                                                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                                                                <span class="ico-player " id="ico_player_4"></span>
                                                                                                              </div>
                                                                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                              <button class="btn btn-default bookingBtn"

                                                                                                                data-member1firstname =""
                                                                                                                data-member1lastname =""
                                                                                                                data-member1handicap =""
                                                                                                                data-member1country =""
                                                                                                                data-member1asg=""

                                                                                                                data-member2firstname=""
                                                                                                                data-member2lastname=""
                                                                                                                data-member2handicap=""
                                                                                                                data-member2country=""
                                                                                                                data-member2asg=""

                                                                                                                data-member3firstname=""
                                                                                                                data-member3lastname=""
                                                                                                                data-member3handicap=""
                                                                                                                data-member3country=""
                                                                                                                data-member3asg=""

                                                                                                                data-member4firstname=""
                                                                                                                data-member4lastname=""
                                                                                                                data-member4handicap=""
                                                                                                                data-member4country=""
                                                                                                                data-member4asg=""

                                                                                                                data-availability="4"
                                                                                                                data-costs=""
                                                                                                                data-realcost="30"
                                                                                                                data-date="03-11-2016"
                                                                                                                data-start="17h30"
                                                                                                                data-dateoriginal="2016-11-03 17:30:00"
                                                                                                                data-toggle="modal" data-target="#modal-form"
                                                                                                                data-already=""

                                                                                                                ><span class="icon icon-checkmark">
                                                                                                                </span> Book</button>


                                                                                                              </div>
                                                                                                            </div>






                                                                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                              <div class="gc-creaneau-heure offre" style="">
                                                                                                                <time>17h40</time><br/>


                                                                                                                <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                <div class="gc-players">

                                                                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                                                                </div>
                                                                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                <button class="btn btn-default bookingBtn"

                                                                                                                  data-member1firstname =""
                                                                                                                  data-member1lastname =""
                                                                                                                  data-member1handicap =""
                                                                                                                  data-member1country =""
                                                                                                                  data-member1asg=""

                                                                                                                  data-member2firstname=""
                                                                                                                  data-member2lastname=""
                                                                                                                  data-member2handicap=""
                                                                                                                  data-member2country=""
                                                                                                                  data-member2asg=""

                                                                                                                  data-member3firstname=""
                                                                                                                  data-member3lastname=""
                                                                                                                  data-member3handicap=""
                                                                                                                  data-member3country=""
                                                                                                                  data-member3asg=""

                                                                                                                  data-member4firstname=""
                                                                                                                  data-member4lastname=""
                                                                                                                  data-member4handicap=""
                                                                                                                  data-member4country=""
                                                                                                                  data-member4asg=""

                                                                                                                  data-availability="4"
                                                                                                                  data-costs=""
                                                                                                                  data-realcost="30"
                                                                                                                  data-date="03-11-2016"
                                                                                                                  data-start="17h40"
                                                                                                                  data-dateoriginal="2016-11-03 17:40:00"
                                                                                                                  data-toggle="modal" data-target="#modal-form"
                                                                                                                  data-already=""

                                                                                                                  ><span class="icon icon-checkmark">
                                                                                                                  </span> Book</button>


                                                                                                                </div>
                                                                                                              </div>






                                                                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                <div class="gc-creaneau-heure offre" style="">
                                                                                                                  <time>17h50</time><br/>


                                                                                                                  <del> 60.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                  <div class="gc-players">

                                                                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                                                                  </div>
                                                                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                  <button class="btn btn-default bookingBtn"

                                                                                                                    data-member1firstname =""
                                                                                                                    data-member1lastname =""
                                                                                                                    data-member1handicap =""
                                                                                                                    data-member1country =""
                                                                                                                    data-member1asg=""

                                                                                                                    data-member2firstname=""
                                                                                                                    data-member2lastname=""
                                                                                                                    data-member2handicap=""
                                                                                                                    data-member2country=""
                                                                                                                    data-member2asg=""

                                                                                                                    data-member3firstname=""
                                                                                                                    data-member3lastname=""
                                                                                                                    data-member3handicap=""
                                                                                                                    data-member3country=""
                                                                                                                    data-member3asg=""

                                                                                                                    data-member4firstname=""
                                                                                                                    data-member4lastname=""
                                                                                                                    data-member4handicap=""
                                                                                                                    data-member4country=""
                                                                                                                    data-member4asg=""

                                                                                                                    data-availability="4"
                                                                                                                    data-costs=""
                                                                                                                    data-realcost="30"
                                                                                                                    data-date="03-11-2016"
                                                                                                                    data-start="17h50"
                                                                                                                    data-dateoriginal="2016-11-03 17:50:00"
                                                                                                                    data-toggle="modal" data-target="#modal-form"
                                                                                                                    data-already=""

                                                                                                                    ><span class="icon icon-checkmark">
                                                                                                                    </span> Book</button>


                                                                                                                  </div>
                                                                                                                </div>


                                                                                                                <script>today_low_price = 30;</script>

                                                                                                              </div>
                                                                                                            </div>


                                                                                                            <div class="gc-creaneau-horaire" id="creneau_12">
                                                                                                              <div class="gc-titre-heure">18h00 - 19h00</div>
                                                                                                              <div class="clearfix">







                                                                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                  <div class="gc-creaneau-heure offre" style="">
                                                                                                                    <time>18h00</time><br/>


                                                                                                                    <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                    <div class="gc-players">

                                                                                                                      <span class="ico-player " id="ico_player_1"></span>
                                                                                                                      <span class="ico-player " id="ico_player_2"></span>
                                                                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                                                                    </div>
                                                                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                    <button class="btn btn-default bookingBtn"

                                                                                                                      data-member1firstname =""
                                                                                                                      data-member1lastname =""
                                                                                                                      data-member1handicap =""
                                                                                                                      data-member1country =""
                                                                                                                      data-member1asg=""

                                                                                                                      data-member2firstname=""
                                                                                                                      data-member2lastname=""
                                                                                                                      data-member2handicap=""
                                                                                                                      data-member2country=""
                                                                                                                      data-member2asg=""

                                                                                                                      data-member3firstname=""
                                                                                                                      data-member3lastname=""
                                                                                                                      data-member3handicap=""
                                                                                                                      data-member3country=""
                                                                                                                      data-member3asg=""

                                                                                                                      data-member4firstname=""
                                                                                                                      data-member4lastname=""
                                                                                                                      data-member4handicap=""
                                                                                                                      data-member4country=""
                                                                                                                      data-member4asg=""

                                                                                                                      data-availability="4"
                                                                                                                      data-costs=""
                                                                                                                      data-realcost="30"
                                                                                                                      data-date="03-11-2016"
                                                                                                                      data-start="18h00"
                                                                                                                      data-dateoriginal="2016-11-03 18:00:00"
                                                                                                                      data-toggle="modal" data-target="#modal-form"
                                                                                                                      data-already=""

                                                                                                                      ><span class="icon icon-checkmark">
                                                                                                                      </span> Book</button>


                                                                                                                    </div>
                                                                                                                  </div>






                                                                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                    <div class="gc-creaneau-heure offre" style="">
                                                                                                                      <time>18h10</time><br/>


                                                                                                                      <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                      <div class="gc-players">

                                                                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                                                                      </div>
                                                                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                      <button class="btn btn-default bookingBtn"

                                                                                                                        data-member1firstname =""
                                                                                                                        data-member1lastname =""
                                                                                                                        data-member1handicap =""
                                                                                                                        data-member1country =""
                                                                                                                        data-member1asg=""

                                                                                                                        data-member2firstname=""
                                                                                                                        data-member2lastname=""
                                                                                                                        data-member2handicap=""
                                                                                                                        data-member2country=""
                                                                                                                        data-member2asg=""

                                                                                                                        data-member3firstname=""
                                                                                                                        data-member3lastname=""
                                                                                                                        data-member3handicap=""
                                                                                                                        data-member3country=""
                                                                                                                        data-member3asg=""

                                                                                                                        data-member4firstname=""
                                                                                                                        data-member4lastname=""
                                                                                                                        data-member4handicap=""
                                                                                                                        data-member4country=""
                                                                                                                        data-member4asg=""

                                                                                                                        data-availability="4"
                                                                                                                        data-costs=""
                                                                                                                        data-realcost="30"
                                                                                                                        data-date="03-11-2016"
                                                                                                                        data-start="18h10"
                                                                                                                        data-dateoriginal="2016-11-03 18:10:00"
                                                                                                                        data-toggle="modal" data-target="#modal-form"
                                                                                                                        data-already=""

                                                                                                                        ><span class="icon icon-checkmark">
                                                                                                                        </span> Book</button>


                                                                                                                      </div>
                                                                                                                    </div>






                                                                                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                      <div class="gc-creaneau-heure offre" style="">
                                                                                                                        <time>18h20</time><br/>


                                                                                                                        <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                        <div class="gc-players">

                                                                                                                          <span class="ico-player " id="ico_player_1"></span>
                                                                                                                          <span class="ico-player " id="ico_player_2"></span>
                                                                                                                          <span class="ico-player " id="ico_player_3"></span>
                                                                                                                          <span class="ico-player " id="ico_player_4"></span>
                                                                                                                        </div>
                                                                                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                        <button class="btn btn-default bookingBtn"

                                                                                                                          data-member1firstname =""
                                                                                                                          data-member1lastname =""
                                                                                                                          data-member1handicap =""
                                                                                                                          data-member1country =""
                                                                                                                          data-member1asg=""

                                                                                                                          data-member2firstname=""
                                                                                                                          data-member2lastname=""
                                                                                                                          data-member2handicap=""
                                                                                                                          data-member2country=""
                                                                                                                          data-member2asg=""

                                                                                                                          data-member3firstname=""
                                                                                                                          data-member3lastname=""
                                                                                                                          data-member3handicap=""
                                                                                                                          data-member3country=""
                                                                                                                          data-member3asg=""

                                                                                                                          data-member4firstname=""
                                                                                                                          data-member4lastname=""
                                                                                                                          data-member4handicap=""
                                                                                                                          data-member4country=""
                                                                                                                          data-member4asg=""

                                                                                                                          data-availability="4"
                                                                                                                          data-costs=""
                                                                                                                          data-realcost="30"
                                                                                                                          data-date="03-11-2016"
                                                                                                                          data-start="18h20"
                                                                                                                          data-dateoriginal="2016-11-03 18:20:00"
                                                                                                                          data-toggle="modal" data-target="#modal-form"
                                                                                                                          data-already=""

                                                                                                                          ><span class="icon icon-checkmark">
                                                                                                                          </span> Book</button>


                                                                                                                        </div>
                                                                                                                      </div>






                                                                                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                        <div class="gc-creaneau-heure offre" style="">
                                                                                                                          <time>18h30</time><br/>


                                                                                                                          <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                          <div class="gc-players">

                                                                                                                            <span class="ico-player " id="ico_player_1"></span>
                                                                                                                            <span class="ico-player " id="ico_player_2"></span>
                                                                                                                            <span class="ico-player " id="ico_player_3"></span>
                                                                                                                            <span class="ico-player " id="ico_player_4"></span>
                                                                                                                          </div>
                                                                                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                          <button class="btn btn-default bookingBtn"

                                                                                                                            data-member1firstname =""
                                                                                                                            data-member1lastname =""
                                                                                                                            data-member1handicap =""
                                                                                                                            data-member1country =""
                                                                                                                            data-member1asg=""

                                                                                                                            data-member2firstname=""
                                                                                                                            data-member2lastname=""
                                                                                                                            data-member2handicap=""
                                                                                                                            data-member2country=""
                                                                                                                            data-member2asg=""

                                                                                                                            data-member3firstname=""
                                                                                                                            data-member3lastname=""
                                                                                                                            data-member3handicap=""
                                                                                                                            data-member3country=""
                                                                                                                            data-member3asg=""

                                                                                                                            data-member4firstname=""
                                                                                                                            data-member4lastname=""
                                                                                                                            data-member4handicap=""
                                                                                                                            data-member4country=""
                                                                                                                            data-member4asg=""

                                                                                                                            data-availability="4"
                                                                                                                            data-costs=""
                                                                                                                            data-realcost="30"
                                                                                                                            data-date="03-11-2016"
                                                                                                                            data-start="18h30"
                                                                                                                            data-dateoriginal="2016-11-03 18:30:00"
                                                                                                                            data-toggle="modal" data-target="#modal-form"
                                                                                                                            data-already=""

                                                                                                                            ><span class="icon icon-checkmark">
                                                                                                                            </span> Book</button>


                                                                                                                          </div>
                                                                                                                        </div>






                                                                                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                          <div class="gc-creaneau-heure offre" style="">
                                                                                                                            <time>18h40</time><br/>


                                                                                                                            <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                            <div class="gc-players">

                                                                                                                              <span class="ico-player " id="ico_player_1"></span>
                                                                                                                              <span class="ico-player " id="ico_player_2"></span>
                                                                                                                              <span class="ico-player " id="ico_player_3"></span>
                                                                                                                              <span class="ico-player " id="ico_player_4"></span>
                                                                                                                            </div>
                                                                                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                            <button class="btn btn-default bookingBtn"

                                                                                                                              data-member1firstname =""
                                                                                                                              data-member1lastname =""
                                                                                                                              data-member1handicap =""
                                                                                                                              data-member1country =""
                                                                                                                              data-member1asg=""

                                                                                                                              data-member2firstname=""
                                                                                                                              data-member2lastname=""
                                                                                                                              data-member2handicap=""
                                                                                                                              data-member2country=""
                                                                                                                              data-member2asg=""

                                                                                                                              data-member3firstname=""
                                                                                                                              data-member3lastname=""
                                                                                                                              data-member3handicap=""
                                                                                                                              data-member3country=""
                                                                                                                              data-member3asg=""

                                                                                                                              data-member4firstname=""
                                                                                                                              data-member4lastname=""
                                                                                                                              data-member4handicap=""
                                                                                                                              data-member4country=""
                                                                                                                              data-member4asg=""

                                                                                                                              data-availability="4"
                                                                                                                              data-costs=""
                                                                                                                              data-realcost="30"
                                                                                                                              data-date="03-11-2016"
                                                                                                                              data-start="18h40"
                                                                                                                              data-dateoriginal="2016-11-03 18:40:00"
                                                                                                                              data-toggle="modal" data-target="#modal-form"
                                                                                                                              data-already=""

                                                                                                                              ><span class="icon icon-checkmark">
                                                                                                                              </span> Book</button>


                                                                                                                            </div>
                                                                                                                          </div>






                                                                                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                            <div class="gc-creaneau-heure offre" style="">
                                                                                                                              <time>18h50</time><br/>


                                                                                                                              <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                              <div class="gc-players">

                                                                                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                <span class="ico-player " id="ico_player_4"></span>
                                                                                                                              </div>
                                                                                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                              <button class="btn btn-default bookingBtn"

                                                                                                                                data-member1firstname =""
                                                                                                                                data-member1lastname =""
                                                                                                                                data-member1handicap =""
                                                                                                                                data-member1country =""
                                                                                                                                data-member1asg=""

                                                                                                                                data-member2firstname=""
                                                                                                                                data-member2lastname=""
                                                                                                                                data-member2handicap=""
                                                                                                                                data-member2country=""
                                                                                                                                data-member2asg=""

                                                                                                                                data-member3firstname=""
                                                                                                                                data-member3lastname=""
                                                                                                                                data-member3handicap=""
                                                                                                                                data-member3country=""
                                                                                                                                data-member3asg=""

                                                                                                                                data-member4firstname=""
                                                                                                                                data-member4lastname=""
                                                                                                                                data-member4handicap=""
                                                                                                                                data-member4country=""
                                                                                                                                data-member4asg=""

                                                                                                                                data-availability="4"
                                                                                                                                data-costs=""
                                                                                                                                data-realcost="30"
                                                                                                                                data-date="03-11-2016"
                                                                                                                                data-start="18h50"
                                                                                                                                data-dateoriginal="2016-11-03 18:50:00"
                                                                                                                                data-toggle="modal" data-target="#modal-form"
                                                                                                                                data-already=""

                                                                                                                                ><span class="icon icon-checkmark">
                                                                                                                                </span> Book</button>


                                                                                                                              </div>
                                                                                                                            </div>


                                                                                                                            <script>today_low_price = 30;</script>

                                                                                                                          </div>
                                                                                                                        </div>


                                                                                                                        <div class="gc-creaneau-horaire" id="creneau_13">
                                                                                                                          <div class="gc-titre-heure">19h00 - 20h00</div>
                                                                                                                          <div class="clearfix">







                                                                                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                              <div class="gc-creaneau-heure offre" style="">
                                                                                                                                <time>19h00</time><br/>


                                                                                                                                <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                <div class="gc-players">

                                                                                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                </div>
                                                                                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                <button class="btn btn-default bookingBtn"

                                                                                                                                  data-member1firstname =""
                                                                                                                                  data-member1lastname =""
                                                                                                                                  data-member1handicap =""
                                                                                                                                  data-member1country =""
                                                                                                                                  data-member1asg=""

                                                                                                                                  data-member2firstname=""
                                                                                                                                  data-member2lastname=""
                                                                                                                                  data-member2handicap=""
                                                                                                                                  data-member2country=""
                                                                                                                                  data-member2asg=""

                                                                                                                                  data-member3firstname=""
                                                                                                                                  data-member3lastname=""
                                                                                                                                  data-member3handicap=""
                                                                                                                                  data-member3country=""
                                                                                                                                  data-member3asg=""

                                                                                                                                  data-member4firstname=""
                                                                                                                                  data-member4lastname=""
                                                                                                                                  data-member4handicap=""
                                                                                                                                  data-member4country=""
                                                                                                                                  data-member4asg=""

                                                                                                                                  data-availability="4"
                                                                                                                                  data-costs=""
                                                                                                                                  data-realcost="30"
                                                                                                                                  data-date="03-11-2016"
                                                                                                                                  data-start="19h00"
                                                                                                                                  data-dateoriginal="2016-11-03 19:00:00"
                                                                                                                                  data-toggle="modal" data-target="#modal-form"
                                                                                                                                  data-already=""

                                                                                                                                  ><span class="icon icon-checkmark">
                                                                                                                                  </span> Book</button>


                                                                                                                                </div>
                                                                                                                              </div>






                                                                                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                <div class="gc-creaneau-heure offre" style="">
                                                                                                                                  <time>19h10</time><br/>


                                                                                                                                  <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                  <div class="gc-players">

                                                                                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                  </div>
                                                                                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                  <button class="btn btn-default bookingBtn"

                                                                                                                                    data-member1firstname =""
                                                                                                                                    data-member1lastname =""
                                                                                                                                    data-member1handicap =""
                                                                                                                                    data-member1country =""
                                                                                                                                    data-member1asg=""

                                                                                                                                    data-member2firstname=""
                                                                                                                                    data-member2lastname=""
                                                                                                                                    data-member2handicap=""
                                                                                                                                    data-member2country=""
                                                                                                                                    data-member2asg=""

                                                                                                                                    data-member3firstname=""
                                                                                                                                    data-member3lastname=""
                                                                                                                                    data-member3handicap=""
                                                                                                                                    data-member3country=""
                                                                                                                                    data-member3asg=""

                                                                                                                                    data-member4firstname=""
                                                                                                                                    data-member4lastname=""
                                                                                                                                    data-member4handicap=""
                                                                                                                                    data-member4country=""
                                                                                                                                    data-member4asg=""

                                                                                                                                    data-availability="4"
                                                                                                                                    data-costs=""
                                                                                                                                    data-realcost="30"
                                                                                                                                    data-date="03-11-2016"
                                                                                                                                    data-start="19h10"
                                                                                                                                    data-dateoriginal="2016-11-03 19:10:00"
                                                                                                                                    data-toggle="modal" data-target="#modal-form"
                                                                                                                                    data-already=""

                                                                                                                                    ><span class="icon icon-checkmark">
                                                                                                                                    </span> Book</button>


                                                                                                                                  </div>
                                                                                                                                </div>






                                                                                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                  <div class="gc-creaneau-heure offre" style="">
                                                                                                                                    <time>19h20</time><br/>


                                                                                                                                    <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                    <div class="gc-players">

                                                                                                                                      <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                      <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                    </div>
                                                                                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                    <button class="btn btn-default bookingBtn"

                                                                                                                                      data-member1firstname =""
                                                                                                                                      data-member1lastname =""
                                                                                                                                      data-member1handicap =""
                                                                                                                                      data-member1country =""
                                                                                                                                      data-member1asg=""

                                                                                                                                      data-member2firstname=""
                                                                                                                                      data-member2lastname=""
                                                                                                                                      data-member2handicap=""
                                                                                                                                      data-member2country=""
                                                                                                                                      data-member2asg=""

                                                                                                                                      data-member3firstname=""
                                                                                                                                      data-member3lastname=""
                                                                                                                                      data-member3handicap=""
                                                                                                                                      data-member3country=""
                                                                                                                                      data-member3asg=""

                                                                                                                                      data-member4firstname=""
                                                                                                                                      data-member4lastname=""
                                                                                                                                      data-member4handicap=""
                                                                                                                                      data-member4country=""
                                                                                                                                      data-member4asg=""

                                                                                                                                      data-availability="4"
                                                                                                                                      data-costs=""
                                                                                                                                      data-realcost="30"
                                                                                                                                      data-date="03-11-2016"
                                                                                                                                      data-start="19h20"
                                                                                                                                      data-dateoriginal="2016-11-03 19:20:00"
                                                                                                                                      data-toggle="modal" data-target="#modal-form"
                                                                                                                                      data-already=""

                                                                                                                                      ><span class="icon icon-checkmark">
                                                                                                                                      </span> Book</button>


                                                                                                                                    </div>
                                                                                                                                  </div>






                                                                                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                    <div class="gc-creaneau-heure offre" style="">
                                                                                                                                      <time>19h30</time><br/>


                                                                                                                                      <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                      <div class="gc-players">

                                                                                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                      </div>
                                                                                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                      <button class="btn btn-default bookingBtn"

                                                                                                                                        data-member1firstname =""
                                                                                                                                        data-member1lastname =""
                                                                                                                                        data-member1handicap =""
                                                                                                                                        data-member1country =""
                                                                                                                                        data-member1asg=""

                                                                                                                                        data-member2firstname=""
                                                                                                                                        data-member2lastname=""
                                                                                                                                        data-member2handicap=""
                                                                                                                                        data-member2country=""
                                                                                                                                        data-member2asg=""

                                                                                                                                        data-member3firstname=""
                                                                                                                                        data-member3lastname=""
                                                                                                                                        data-member3handicap=""
                                                                                                                                        data-member3country=""
                                                                                                                                        data-member3asg=""

                                                                                                                                        data-member4firstname=""
                                                                                                                                        data-member4lastname=""
                                                                                                                                        data-member4handicap=""
                                                                                                                                        data-member4country=""
                                                                                                                                        data-member4asg=""

                                                                                                                                        data-availability="4"
                                                                                                                                        data-costs=""
                                                                                                                                        data-realcost="30"
                                                                                                                                        data-date="03-11-2016"
                                                                                                                                        data-start="19h30"
                                                                                                                                        data-dateoriginal="2016-11-03 19:30:00"
                                                                                                                                        data-toggle="modal" data-target="#modal-form"
                                                                                                                                        data-already=""

                                                                                                                                        ><span class="icon icon-checkmark">
                                                                                                                                        </span> Book</button>


                                                                                                                                      </div>
                                                                                                                                    </div>






                                                                                                                                    <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                      <div class="gc-creaneau-heure offre" style="">
                                                                                                                                        <time>19h40</time><br/>


                                                                                                                                        <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                        <div class="gc-players">

                                                                                                                                          <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                          <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                          <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                          <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                        </div>
                                                                                                                                        <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                        <button class="btn btn-default bookingBtn"

                                                                                                                                          data-member1firstname =""
                                                                                                                                          data-member1lastname =""
                                                                                                                                          data-member1handicap =""
                                                                                                                                          data-member1country =""
                                                                                                                                          data-member1asg=""

                                                                                                                                          data-member2firstname=""
                                                                                                                                          data-member2lastname=""
                                                                                                                                          data-member2handicap=""
                                                                                                                                          data-member2country=""
                                                                                                                                          data-member2asg=""

                                                                                                                                          data-member3firstname=""
                                                                                                                                          data-member3lastname=""
                                                                                                                                          data-member3handicap=""
                                                                                                                                          data-member3country=""
                                                                                                                                          data-member3asg=""

                                                                                                                                          data-member4firstname=""
                                                                                                                                          data-member4lastname=""
                                                                                                                                          data-member4handicap=""
                                                                                                                                          data-member4country=""
                                                                                                                                          data-member4asg=""

                                                                                                                                          data-availability="4"
                                                                                                                                          data-costs=""
                                                                                                                                          data-realcost="30"
                                                                                                                                          data-date="03-11-2016"
                                                                                                                                          data-start="19h40"
                                                                                                                                          data-dateoriginal="2016-11-03 19:40:00"
                                                                                                                                          data-toggle="modal" data-target="#modal-form"
                                                                                                                                          data-already=""

                                                                                                                                          ><span class="icon icon-checkmark">
                                                                                                                                          </span> Book</button>


                                                                                                                                        </div>
                                                                                                                                      </div>






                                                                                                                                      <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                        <div class="gc-creaneau-heure offre" style="">
                                                                                                                                          <time>19h50</time><br/>


                                                                                                                                          <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                          <div class="gc-players">

                                                                                                                                            <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                            <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                            <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                            <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                          </div>
                                                                                                                                          <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                          <button class="btn btn-default bookingBtn"

                                                                                                                                            data-member1firstname =""
                                                                                                                                            data-member1lastname =""
                                                                                                                                            data-member1handicap =""
                                                                                                                                            data-member1country =""
                                                                                                                                            data-member1asg=""

                                                                                                                                            data-member2firstname=""
                                                                                                                                            data-member2lastname=""
                                                                                                                                            data-member2handicap=""
                                                                                                                                            data-member2country=""
                                                                                                                                            data-member2asg=""

                                                                                                                                            data-member3firstname=""
                                                                                                                                            data-member3lastname=""
                                                                                                                                            data-member3handicap=""
                                                                                                                                            data-member3country=""
                                                                                                                                            data-member3asg=""

                                                                                                                                            data-member4firstname=""
                                                                                                                                            data-member4lastname=""
                                                                                                                                            data-member4handicap=""
                                                                                                                                            data-member4country=""
                                                                                                                                            data-member4asg=""

                                                                                                                                            data-availability="4"
                                                                                                                                            data-costs=""
                                                                                                                                            data-realcost="30"
                                                                                                                                            data-date="03-11-2016"
                                                                                                                                            data-start="19h50"
                                                                                                                                            data-dateoriginal="2016-11-03 19:50:00"
                                                                                                                                            data-toggle="modal" data-target="#modal-form"
                                                                                                                                            data-already=""

                                                                                                                                            ><span class="icon icon-checkmark">
                                                                                                                                            </span> Book</button>


                                                                                                                                          </div>
                                                                                                                                        </div>


                                                                                                                                        <script>today_low_price = 30;</script>

                                                                                                                                      </div>
                                                                                                                                    </div>


                                                                                                                                    <div class="gc-creaneau-horaire" id="creneau_14">
                                                                                                                                      <div class="gc-titre-heure">20h00 - 21h00</div>
                                                                                                                                      <div class="clearfix">







                                                                                                                                        <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                          <div class="gc-creaneau-heure offre" style="">
                                                                                                                                            <time>20h00</time><br/>


                                                                                                                                            <del> 48.-</del> / Player                                        <span class="prix-offre" >30.- </span>
                                                                                                                                            <div class="gc-players">

                                                                                                                                              <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                              <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                              <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                              <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                            </div>
                                                                                                                                            <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                            <button class="btn btn-default bookingBtn"

                                                                                                                                              data-member1firstname =""
                                                                                                                                              data-member1lastname =""
                                                                                                                                              data-member1handicap =""
                                                                                                                                              data-member1country =""
                                                                                                                                              data-member1asg=""

                                                                                                                                              data-member2firstname=""
                                                                                                                                              data-member2lastname=""
                                                                                                                                              data-member2handicap=""
                                                                                                                                              data-member2country=""
                                                                                                                                              data-member2asg=""

                                                                                                                                              data-member3firstname=""
                                                                                                                                              data-member3lastname=""
                                                                                                                                              data-member3handicap=""
                                                                                                                                              data-member3country=""
                                                                                                                                              data-member3asg=""

                                                                                                                                              data-member4firstname=""
                                                                                                                                              data-member4lastname=""
                                                                                                                                              data-member4handicap=""
                                                                                                                                              data-member4country=""
                                                                                                                                              data-member4asg=""

                                                                                                                                              data-availability="4"
                                                                                                                                              data-costs=""
                                                                                                                                              data-realcost="30"
                                                                                                                                              data-date="03-11-2016"
                                                                                                                                              data-start="20h00"
                                                                                                                                              data-dateoriginal="2016-11-03 20:00:00"
                                                                                                                                              data-toggle="modal" data-target="#modal-form"
                                                                                                                                              data-already=""

                                                                                                                                              ><span class="icon icon-checkmark">
                                                                                                                                              </span> Book</button>


                                                                                                                                            </div>
                                                                                                                                          </div>






                                                                                                                                          <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                            <div class="gc-creaneau-heure " style="visibility: hidden;">
                                                                                                                                              <time>20h10</time><br/>


                                                                                                                                              0.- / Player                                                                        <div class="gc-players">

                                                                                                                                                <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                                <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                                <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                                <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                              </div>
                                                                                                                                              <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                              <button class="btn btn-default bookingBtn"

                                                                                                                                                data-member1firstname =""
                                                                                                                                                data-member1lastname =""
                                                                                                                                                data-member1handicap =""
                                                                                                                                                data-member1country =""
                                                                                                                                                data-member1asg=""

                                                                                                                                                data-member2firstname=""
                                                                                                                                                data-member2lastname=""
                                                                                                                                                data-member2handicap=""
                                                                                                                                                data-member2country=""
                                                                                                                                                data-member2asg=""

                                                                                                                                                data-member3firstname=""
                                                                                                                                                data-member3lastname=""
                                                                                                                                                data-member3handicap=""
                                                                                                                                                data-member3country=""
                                                                                                                                                data-member3asg=""

                                                                                                                                                data-member4firstname=""
                                                                                                                                                data-member4lastname=""
                                                                                                                                                data-member4handicap=""
                                                                                                                                                data-member4country=""
                                                                                                                                                data-member4asg=""

                                                                                                                                                data-availability="4"
                                                                                                                                                data-costs=""
                                                                                                                                                data-realcost="0"
                                                                                                                                                data-date="03-11-2016"
                                                                                                                                                data-start="20h10"
                                                                                                                                                data-dateoriginal="2016-11-03 20:10:00"
                                                                                                                                                data-toggle="modal" data-target="#modal-form"
                                                                                                                                                data-already=""

                                                                                                                                                ><span class="icon icon-checkmark">
                                                                                                                                                </span> Book</button>


                                                                                                                                              </div>
                                                                                                                                            </div>






                                                                                                                                            <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                              <div class="gc-creaneau-heure " style="visibility: hidden;">
                                                                                                                                                <time>20h20</time><br/>


                                                                                                                                                0.- / Player                                                                        <div class="gc-players">

                                                                                                                                                  <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                                  <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                                  <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                                  <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                                </div>
                                                                                                                                                <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                                <button class="btn btn-default bookingBtn"

                                                                                                                                                  data-member1firstname =""
                                                                                                                                                  data-member1lastname =""
                                                                                                                                                  data-member1handicap =""
                                                                                                                                                  data-member1country =""
                                                                                                                                                  data-member1asg=""

                                                                                                                                                  data-member2firstname=""
                                                                                                                                                  data-member2lastname=""
                                                                                                                                                  data-member2handicap=""
                                                                                                                                                  data-member2country=""
                                                                                                                                                  data-member2asg=""

                                                                                                                                                  data-member3firstname=""
                                                                                                                                                  data-member3lastname=""
                                                                                                                                                  data-member3handicap=""
                                                                                                                                                  data-member3country=""
                                                                                                                                                  data-member3asg=""

                                                                                                                                                  data-member4firstname=""
                                                                                                                                                  data-member4lastname=""
                                                                                                                                                  data-member4handicap=""
                                                                                                                                                  data-member4country=""
                                                                                                                                                  data-member4asg=""

                                                                                                                                                  data-availability="4"
                                                                                                                                                  data-costs=""
                                                                                                                                                  data-realcost="0"
                                                                                                                                                  data-date="03-11-2016"
                                                                                                                                                  data-start="20h20"
                                                                                                                                                  data-dateoriginal="2016-11-03 20:20:00"
                                                                                                                                                  data-toggle="modal" data-target="#modal-form"
                                                                                                                                                  data-already=""

                                                                                                                                                  ><span class="icon icon-checkmark">
                                                                                                                                                  </span> Book</button>


                                                                                                                                                </div>
                                                                                                                                              </div>






                                                                                                                                              <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                                <div class="gc-creaneau-heure " style="visibility: hidden;">
                                                                                                                                                  <time>20h30</time><br/>


                                                                                                                                                  0.- / Player                                                                        <div class="gc-players">

                                                                                                                                                    <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                                    <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                                    <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                                    <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                                  </div>
                                                                                                                                                  <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                                  <button class="btn btn-default bookingBtn"

                                                                                                                                                    data-member1firstname =""
                                                                                                                                                    data-member1lastname =""
                                                                                                                                                    data-member1handicap =""
                                                                                                                                                    data-member1country =""
                                                                                                                                                    data-member1asg=""

                                                                                                                                                    data-member2firstname=""
                                                                                                                                                    data-member2lastname=""
                                                                                                                                                    data-member2handicap=""
                                                                                                                                                    data-member2country=""
                                                                                                                                                    data-member2asg=""

                                                                                                                                                    data-member3firstname=""
                                                                                                                                                    data-member3lastname=""
                                                                                                                                                    data-member3handicap=""
                                                                                                                                                    data-member3country=""
                                                                                                                                                    data-member3asg=""

                                                                                                                                                    data-member4firstname=""
                                                                                                                                                    data-member4lastname=""
                                                                                                                                                    data-member4handicap=""
                                                                                                                                                    data-member4country=""
                                                                                                                                                    data-member4asg=""

                                                                                                                                                    data-availability="4"
                                                                                                                                                    data-costs=""
                                                                                                                                                    data-realcost="0"
                                                                                                                                                    data-date="03-11-2016"
                                                                                                                                                    data-start="20h30"
                                                                                                                                                    data-dateoriginal="2016-11-03 20:30:00"
                                                                                                                                                    data-toggle="modal" data-target="#modal-form"
                                                                                                                                                    data-already=""

                                                                                                                                                    ><span class="icon icon-checkmark">
                                                                                                                                                    </span> Book</button>


                                                                                                                                                  </div>
                                                                                                                                                </div>






                                                                                                                                                <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                                  <div class="gc-creaneau-heure " style="visibility: hidden;">
                                                                                                                                                    <time>20h40</time><br/>


                                                                                                                                                    0.- / Player                                                                        <div class="gc-players">

                                                                                                                                                      <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                                      <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                                      <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                                      <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                                    </div>
                                                                                                                                                    <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                                    <button class="btn btn-default bookingBtn"

                                                                                                                                                      data-member1firstname =""
                                                                                                                                                      data-member1lastname =""
                                                                                                                                                      data-member1handicap =""
                                                                                                                                                      data-member1country =""
                                                                                                                                                      data-member1asg=""

                                                                                                                                                      data-member2firstname=""
                                                                                                                                                      data-member2lastname=""
                                                                                                                                                      data-member2handicap=""
                                                                                                                                                      data-member2country=""
                                                                                                                                                      data-member2asg=""

                                                                                                                                                      data-member3firstname=""
                                                                                                                                                      data-member3lastname=""
                                                                                                                                                      data-member3handicap=""
                                                                                                                                                      data-member3country=""
                                                                                                                                                      data-member3asg=""

                                                                                                                                                      data-member4firstname=""
                                                                                                                                                      data-member4lastname=""
                                                                                                                                                      data-member4handicap=""
                                                                                                                                                      data-member4country=""
                                                                                                                                                      data-member4asg=""

                                                                                                                                                      data-availability="4"
                                                                                                                                                      data-costs=""
                                                                                                                                                      data-realcost="0"
                                                                                                                                                      data-date="03-11-2016"
                                                                                                                                                      data-start="20h40"
                                                                                                                                                      data-dateoriginal="2016-11-03 20:40:00"
                                                                                                                                                      data-toggle="modal" data-target="#modal-form"
                                                                                                                                                      data-already=""

                                                                                                                                                      ><span class="icon icon-checkmark">
                                                                                                                                                      </span> Book</button>


                                                                                                                                                    </div>
                                                                                                                                                  </div>






                                                                                                                                                  <div class="col-xs-12 col-md-8 col-lg-4" >


                                                                                                                                                    <div class="gc-creaneau-heure " style="visibility: hidden;">
                                                                                                                                                      <time>20h50</time><br/>


                                                                                                                                                      0.- / Player                                                                        <div class="gc-players">

                                                                                                                                                        <span class="ico-player " id="ico_player_1"></span>
                                                                                                                                                        <span class="ico-player " id="ico_player_2"></span>
                                                                                                                                                        <span class="ico-player " id="ico_player_3"></span>
                                                                                                                                                        <span class="ico-player " id="ico_player_4"></span>
                                                                                                                                                      </div>
                                                                                                                                                      <div class=""><img src="<?php echo base_url(); ?>assets/frontend/img/drapeau.png"/></div>



                                                                                                                                                      <button class="btn btn-default bookingBtn"

                                                                                                                                                        data-member1firstname =""
                                                                                                                                                        data-member1lastname =""
                                                                                                                                                        data-member1handicap =""
                                                                                                                                                        data-member1country =""
                                                                                                                                                        data-member1asg=""

                                                                                                                                                        data-member2firstname=""
                                                                                                                                                        data-member2lastname=""
                                                                                                                                                        data-member2handicap=""
                                                                                                                                                        data-member2country=""
                                                                                                                                                        data-member2asg=""

                                                                                                                                                        data-member3firstname=""
                                                                                                                                                        data-member3lastname=""
                                                                                                                                                        data-member3handicap=""
                                                                                                                                                        data-member3country=""
                                                                                                                                                        data-member3asg=""

                                                                                                                                                        data-member4firstname=""
                                                                                                                                                        data-member4lastname=""
                                                                                                                                                        data-member4handicap=""
                                                                                                                                                        data-member4country=""
                                                                                                                                                        data-member4asg=""

                                                                                                                                                        data-availability="4"
                                                                                                                                                        data-costs=""
                                                                                                                                                        data-realcost="0"
                                                                                                                                                        data-date="03-11-2016"
                                                                                                                                                        data-start="20h50"
                                                                                                                                                        data-dateoriginal="2016-11-03 20:50:00"
                                                                                                                                                        data-toggle="modal" data-target="#modal-form"
                                                                                                                                                        data-already=""

                                                                                                                                                        ><span class="icon icon-checkmark">
                                                                                                                                                        </span> Book</button>


                                                                                                                                                      </div>
                                                                                                                                                    </div>


                                                                                                                                                    <script>today_low_price = 0;</script>

                                                                                                                                                  </div>
                                                                                                                                                </div>




                                                                                                                                                <select class="gc-select-jour-planning form-control visible-xs">
                                                                                                                                                  <option>JUN 25 - JEU - à partir de 89.-</option>
                                                                                                                                                  <option>JUN 26 - VE - à partir de 89.-</option>
                                                                                                                                                  <option>JUN 27 - SA - à partir de 95.-</option>
                                                                                                                                                  <option>JUN 28 - DI - à partir de 98.-</option>
                                                                                                                                                  <option>JUN 29 - LUN - à partir de 90.-</option>
                                                                                                                                                  <option>JUN 30 - MA - à partir de 89.-</option>
                                                                                                                                                  <option>JUL 01 - ME - à partir de 89.-</option>
                                                                                                                                                </select>

                                                                                                                                              </div>
                                                                                                                                            </div>

