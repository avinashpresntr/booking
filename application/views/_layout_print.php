<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $meta['title']; ?></title>
	<link rel="shortcut icon" href="<?php echo site_url('assets/img/logo.png');?>">
	<!-- Latest compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo site_url('assets/vendors/bootstrap/bootstrap.min.css');?>">
	<style>
		html,body{
			background: #FFF;
			min-height: 500px;
		}
		@page { margin: 0px; }
		body { margin: 0;padding:0;}

		main{
			padding: 0;
		}
		@media print {
		    header {
		        display:none;
		    }
		}

		main > div {
		  border-right:1px dashed #ddd;
		  border-bottom:1px dashed #ddd;
		  height: 186px;
		  width: 184px;
		  display: inline-block;
		  padding: 0 10px;
		}
		main img{
			width: 73%;
			margin-top: -5px;
    		margin-bottom: -5px;
		}
		main div{
			margin: 0;
			font-size: 9px;
			line-height: 10px;
			padding: 0 5px;
			text-align: center;
			clear:both;
		}
		.qr-img{
			overflow: hidden;
		}
		.qr-gnm{
			padding-top: 8px;
			height: 20px;
			margin-bottom: -5px;
		}
		.qr-rwd{
			padding-top: 2px;
		}
		.qr-vld{
			padding-top:2px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<main>
		<?php $count=1; ?>
		<?php foreach ($qrcUrls as $key => $value):?>
			<div class="qrdiv">
				<div class="qr-gnm"><?=$user['name'];?></div>
				<div class="qr-img"><img src="<?=$value;?>" alt="QRCode"></div>
				<div class="qr-rwd"><?=$reward;?></div>
				<div class="qr-vld">Validity: <?=$validity;?></div>
				<div style="display:none;"></div>
			</div>
			<?php
			$chk = $count / 4;
			if(is_integer($chk)){ echo '<br/>';}
$chk2 = $count / 24;
			if(is_integer($chk2)){ echo '</main><main>';}

			$count++;
			 ?>
		<?php endforeach;?>
	</main>
	<!-- javascripts -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script>function print_window() {window.print();}</script>
</body>
</html>