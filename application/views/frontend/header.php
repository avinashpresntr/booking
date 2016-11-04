<header>
  <!------------  BOX LOGIN MOBILE ------------>
  <div class="nav-lang disconnect mobile-connect mobile-connect-2" style="padding: 6px; border: 1px solid #f8cc06;">
    <form  action="" method="post">
      <span style="margin-right: 15px; margin-left: 10px; margin-top: 4px; color: #333; text-transform: uppercase; font-weight:bold;">login</span>
      <input type="text" name="_username" placeholder="Username" style="padding-left: 5px;">
      <input type="password" name="_password" placeholder="Password"  style="padding-left: 5px;">
      <input type="submit" value="ok">
    </form>
  </div>
  <!------------  END BOX LOGIN MOBILE ------------>

  <nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">
        <a href="" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/frontend/img/Golf-Crans-logo.png" /> </a>
        <a class="mobile title" href=""><h1><span>Golf-Club Crans-sur-Sierre</span></h1></a>

        <div class="nav-lang">
          <a class="language_link" data-lng="fr">Fr</a>
          <a class="language_link active" data-lng="en">En</a>
          <a class="language_link" data-lng="de">De</a>
          <a class="language_link" data-lng="it">It</a>
        </div>

        <!---- nav langues mobile --->
        <div class="nav-user-mobile">Vous n'êtes pas connecté</div>

        <div class="nav-lang-mobile">

          <div class="nav-lang-mobile-button">En</div>
						<div class="lang-mobile-dropdown">
							<a class="mobileLanguage_link" data-lng="fr">En</a>                                                
							<a class="mobileLanguage_link" data-lng="de">De</a>                        
							<a class="mobileLanguage_link" data-lng="it">It</a>                    
						</div>
          </div>
          <!---- end nav langues mobile --->

          <div class="nav-lang disconnect mobile-connect" style="padding: 6px; border: 1px solid #f8cc06;">
            <form  action="" method="post">
              <span style="margin-right: 15px; margin-left: 10px; margin-top: 4px; color: #333; text-transform: uppercase; font-weight:bold;">login</span>
              <input type="text" name="_username" placeholder="Username" style="padding-left: 5px;">
              <input type="password" name="_password" placeholder="Password"  style="padding-left: 5px;">
              <input type="submit" value="ok">
            </form>
          </div>

        </div>

      </div>
    </nav>
    <img src="<?php echo base_url(); ?>assets/frontend/img/img-entete.jpg" class="img-responsive"/>

    <!--- Onglets mobile ---->
    <div class="onglets-mobile">
      <a class="login_mobile" onClick="showMobileLogin()"><span>login</span></a>
      <a href="/en/" class="active"><span>Tee Time</span></a>
    </div>
    <!--- End Onglets mobile ---->

    <script>
      function showMobileLogin(){
        if( $(".mobile-connect").is(":visible")){
          $(".mobile-connect").slideUp("fast");
          $("#login_mobile").css("background", "#f8cc06");
        }
        else{
          $(".mobile-connect").slideDown("slow");
          $("#login_mobile").css("background", "white");
        }

      }
    </script>

  </header>