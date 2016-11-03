<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $meta['title'].' | '.$page['desc']; ?></title>
        <link rel="shortcut icon" href="<?php echo site_url('assets/img/logo.png');?>">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/jquery/jquery-ui.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/bootstrap/bootstrap.min.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/alertifyjs/css/alertify.min.css');?>" />
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/alertifyjs/css/themes/default.min.css');?>" />
        <link rel="stylesheet" href="<?php echo site_url('assets/css/style.css');?>">

        <?php if($page['slug'] != 'login'):?>
        <!-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css"> -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('assets/vendors/jqGrid/css/ui.jqgrid.css');?>" />
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo site_url('assets/css/jqgrid.css');?>" />
        
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/multiselect/jquery.multiselect.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/multiselect/jquery.multiselect.filter.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/vendors/dipcrop/html5imageupload.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/css/flags.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/css/icons.css');?>">
        <link rel="stylesheet" href="<?php echo site_url('assets/css/backend.css');?>">
        
        <script>
        var BASE_URL = "<?php echo site_url();?>";
        var USER_TYPES = <?php echo encode_data($user_types);?>;
        var USER_LEVELS = <?php echo encode_data($user_levels);?>;
        </script>
        <?php endif;?>

        <script src="<?php echo site_url('assets/vendors/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo site_url('assets/vendors/jquery/jquery-ui.min.js');?>"></script>

        <?php if(!empty($page['head'])){$this->load->view($page['head']);} ?>
	<style>
    .dip-title{width: auto;}
    .no-js #loader { display: none;  }
    .js #loader { display: block; position: absolute; left: 100px; top: 0; }
    .se-pre-con {
		position: fixed;
		left: 0px;
		top: 0px;
		width: 100%;
		height: 100%;
		z-index: 9999;
		background: url("../assets/img/Preloader_1.gif") center no-repeat #fff;
    }
    </style>
</head>
<body>
<?php if($this->uri->segment(2) =="profile"){?>
<div class="se-pre-con"></div> <?php } ?>
        <header class="dip-header">
                <nav class="navbar dip-navbar">
                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <i class="fa fa-bars"></i>
                      </button>
                      <h1 class="dip-title">
                      <a class="navbar-brand" href="<?php echo site_url();?>">
                              <img src="<?php echo site_url('assets/img/logo.png');?>" alt=""><?=$meta['title'];?>
                      </a>
                      </h1>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav navbar-right">
                        <li><i class="fa fa-envelope"></i> Email: <a href="mailto:info@golfapp.ch?subject=Website contact">info@golfapp.ch</a></li>
                        <li><i class="fa fa-hospital-o"></i> <a href="http://golfapp.ch/">golfapp.ch</a></li>
                      </ul>
                    </div>
                  </div>
                </nav>
        </header>

        <main>
                <?php if(!empty($page['main'])){$this->load->view($page['main']);} ?>
        </main>

        <footer class="dip-footer">
                <section class="dip-dev">
                        <div class="container">
                                <p>All contents here are properties of their respective owners. © 2016 - <a href="http://www.golfapp.ch"><?=$meta['title'];?></a>. All rights reserved.</p>
                        </div>
                </section>
        </footer>

        <!-- javascripts -->
        <script src="<?php echo site_url('assets/vendors/bootstrap/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo site_url('assets/vendors/alertifyjs/alertify.min.js');?>"></script>
        <?php if($page['slug'] != 'login'):?>
        <script src="<?php echo site_url('assets/vendors/multiselect/src/jquery.multiselect.min.js');?>"></script>
        <script src="<?php echo site_url('assets/vendors/multiselect/src/jquery.multiselect.filter.js');?>"></script>
        <?php endif;?>
        <script src="<?php echo site_url('assets/js/script.js');?>"></script>
        <?php if(!empty($page['foot'])){$this->load->view($page['foot']);} ?>
        <?php if($this->uri->segment(2) =="profile"){?>
        <script>
        $(window).load(function() 
		{
			$(".se-pre-con").fadeOut("slow");
		});
        </script>
         <?php } ?>
</body>
</html>
