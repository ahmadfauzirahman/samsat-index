<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><?php echo (!empty($title)) ? $title : 'DIREKTORAT LALU LINTAS POLDA JAMBI'; ?></title>

	<!---<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">-->

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.css">
	<link href="<?php echo base_url(); ?>assets/css/ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/theme-global.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/waitMe/waitMe.css">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>assets/js/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>
</head>
<body>
	
    <div class="loader"></div>
    
	<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-custom">
    	<div class="footer-media top-head">
    		<div class="container">
    			<marquee><span class="text-success">DIREKTORAT LALU LINTAS POLDA JAMBI - SUBDIT REGIDENT SEKSIE STNK</span></marquee>
    		</div>
    	</div>
    	<div class="container">
			<div class="navbar-header">
				
				<?php echo anchor('home', 'SAMSAT KOTA JAMBI', array('class' => 'navbar-brand')); ?>
			</div>
			
      	</div>
    </nav>

    <?php if(!empty($header)) : ?>
    <!--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">-->
    	<!-- Indicators -->
    	<!--<ol class="carousel-indicators">
    		<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    	</ol>
    	<div class="carousel-inner" role="listbox">
    		<div class="item active">
    			<img src="<?php echo base_url(); ?>assets/img/slider-new.jpg">		
    		</div>
    	</div>
    </div>-->
    <?php endif; ?>
    	
  	
	<!-- content -->
	<div style="height: 35px;"></div>
	<?php $this->load->view('message'); ?>
	<!-- breadcrumb -->
	<?php echo $this->breadcrumbs->show(); ?>

	<?php $this->load->view($view); ?>

    <div class="footer navbar-fixed-bottom">
	    <div class="container">
	    	<pn class="text-warning">Copyright &copy; IT POLDA JAMBI<br>
            Indeks Kepuasan Masyarakat Pelayanan STNK - SAMSAT Kota Jambi</p>
	    </div>
    </div>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tablesorter.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/theme.js"></script> 
    <script src="<?php echo base_url(); ?>assets/plugin/imageLens/jquery.imageLens.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/waitMe/waitMe.js"></script>

	<script type="text/javascript" language="javascript">
		$(function () {
			$("#img").imageLens({ lensSize: 200 });

            $("html").niceScroll({
                styler: "fb",
                cursorcolor: "#e74c3c",
            });
		});	
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});

	</script>
</body>
</html>