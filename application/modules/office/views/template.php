<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title><?php echo (!empty($title)) ? $title : 'Selamat Data di Indeks Kepuasan Masyarakat Pelayanan STNK'; ?></title>

	<!---<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,800italic,400,600,800" type="text/css">-->

	<!-- Bootstrap -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.css">
	<link href="<?php echo base_url(); ?>assets/css/ui/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/css/theme-admin.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/plugin/waitMe/waitMe.css">

    <link href="<?php echo base_url(); ?>assets/plugin/select2/css/select2.min.css" rel="stylesheet" />
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

    <script src="<?php echo base_url(); ?>assets/plugin/chartjs/Chart.bundle.js"></script>
</head>
<body>
	<!--
	<div class="loader"></div>
	-->
	<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
    	<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	    			<span class="sr-only">Toggle navigation</span>
	    			<span class="icon-bar"></span>
	    			<span class="icon-bar"></span>
	    			<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><?php echo anchor('office/dashboard', '<i class="fa fa-dashboard"></i> Dashboard'); ?></li>
					<li><?php echo anchor('office/faktor', '<i class="fa fa-book"></i> Faktor'); ?></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-line-chart"></i> Laporan <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><?php echo anchor('office/laporan', '<i class="fa fa-file-text"></i> Semua Penilaian'); ?></li>
                            <li><?php echo anchor('office/laporan/perperiode', '<i class="fa fa-calendar"></i> Penilaian Per-Periode + Grafik'); ?></li>
                            <li><?php echo anchor('office/laporan/grapik', '<i class="fa fa-pie-chart"></i> Grafik Semua Penilaian'); ?></li>
                            <li><?php echo anchor('office/laporan/grapikfaktor', '<i class="fa fa-bar-chart"></i> Grafik Semua Penilaian Per-Faktor'); ?></li>
	          			</ul>
	        		</li>
					
	      		</ul>

	      		<ul class="nav navbar-nav navbar-right">
                    <?php if($this->session->userdata('level') == 1) : ?>
		    		    <li><?php echo anchor('office/saran', '<i class="fa fa-envelope-open"></i> Saran Masuk'); ?></li>
                    <?php endif; ?>
		    		<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"></i> <?php echo $this->session->userdata('usernm'); ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
                            <li><?php echo anchor(base_url(), '<i class="fa fa-globe"></i> Lihat Halaman Depan', array('target' => '_blank')); ?></li>
	            			<li><?php echo anchor('office/admin', '<i class="fa fa-group"></i> Data User'); ?></li>
	            			<li role="separator" class="divider"></li>
			                <li><?php echo anchor('auth/logout', '<i class="fa fa-sign-out"></i> Logout'); ?></li>
	          			</ul>
	        		</li>
		    	</ul>
	    	</div><!--/.nav-collapse -->
      	</div>
    </nav>
	
	<!-- content -->
	<div class="container" id="content">
		<div style="height:20px;"></div>
		<?php $this->load->view('message'); ?>
		<!-- breadcrumb -->
		<?php echo $this->breadcrumbs->show(); ?>

		<?php $this->load->view($view); ?>
			
		

    </div>

    <div class="container">
    	<p>{elapsed_time} Copyright &copy; IT Center STIKOM Dinamika Bangsa Jambi<br>
    	STIKOM DB Jambi - Jl. Jend. Sudirman Thehok Jambi | Telp. (0741) 35093</p>
    </div>


    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.tablesorter.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/theme.js"></script> 
    <script src="<?php echo base_url(); ?>assets/plugin/imageLens/jquery.imageLens.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/plugin/waitMe/waitMe.js"></script>

	<script type="text/javascript" language="javascript">
		$(function () {
			$("#img").imageLens({ lensSize: 200 });
		});	
		$(window).load(function() {
			$(".loader").fadeOut("slow");
		});

	</script>

	<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/tinymce.dev.js"></script>
	<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/table/plugin.dev.js"></script>
	<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/paste/plugin.dev.js"></script>
	<script src="<?php echo base_url(); ?>assets/tinymce/js/tinymce/plugins/spellchecker/plugin.dev.js"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: ".mceEditor",
            theme: 'modern',
            plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                 "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                 "save table contextmenu directionality emoticons template paste textcolor",
                 "image imagetools"
           ],
           content_css: "<?php echo base_url(); ?>assets/tinymce/js/tinymce/skins/lightgray/content.min.css",
           toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
           file_browser_callback : function (field_name, url, type, win) {
                    tinyMCE.activeEditor.windowManager.open({
                        file: '<?php echo base_url(); ?>assets/kcfinder/browse.php?opener=tinymce4&field=' + field_name + '&type=' + type,
                        title: 'Upload Foto',
                        width: 700,
                        height: 500,
                        resizable: "yes",
                        inline: true,
                        close_previous: false,
                        popup_css: false
                    }, {
                        window: win,
                        input: field_name
                    });
                    return false;
                },
            image_advtab: true, 
            relative_urls : false,
            remove_script_host : false,
            document_base_url : "http://localhost/epmb/assets/gambar/",
            convert_urls : true,
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]

        });
    </script>
    <script src="<?php echo base_url(); ?>assets/plugin/select2/js/select2.min.js"></script>

    <script type="text/javascript">
        $('.s2').select2();
    </script>
</body>
</html>