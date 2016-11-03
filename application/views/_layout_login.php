<?php
  session_start();
  $_SESSION["cnt"]=2;
  $_SESSION["lang1"]=NULL;
  $_SESSION["mas"]=NULL;
?>
<style>
main{
        position: absolute;
    width: 100%;
    top: 60px;
    bottom: 40px;
}
.dip-header{
        z-index: 100;
}
.dip-main{
        height: 100%;
}.dip-banner {
    margin-top: 10%;
}
.dip-footer{
        position: absolute;
        bottom: 0;
        width: 100%;
}
@media (max-width: 480px){
        .dip-banner {
            margin-top: 4em;
        }
        .dip-banner h2 {
            font-size: 2.5em;
        }
        .dip-banner p {
            font-size: 1em;
         }

}
</style>
<section class="dip-main">
                <div class="container">


                        <div class="dip-banner text-center">

                                <h2><?php echo $this->lang->line('log_h'); ?></h2>
                                <p><?php echo $this->lang->line('log_p'); ?></p>
                        </div>
                        
                        <form id="dip-loginform" class="dip-loginform" method="post">
                          <div class="form-group">
                            <label for="dip-username"><?php echo $this->lang->line('username'); ?></label>
                            <input type="text" name="dip_username" class="form-control" id="dip-username" placeholder="<?php echo $this->lang->line('username'); ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="dip-password"><?php echo $this->lang->line('password'); ?></label>
                            <input type="password" name="dip_password" class="form-control" id="dip-password" placeholder="<?php echo $this->lang->line('password'); ?>" required>
                          </div>
                          <div class="form-group">
                                  <button type="submit" class="btn btn-primary btn-block dip-btn-login"  id="dip-submit"> <?php echo $this->lang->line('login'); ?></button>
                          </div>
                        </form>
                </div>
</section>
