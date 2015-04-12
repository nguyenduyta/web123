<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
 
<!-- Website Title --> 
<title>Admin</title>

<!-- Meta data for SEO -->
<meta name="description" content="">
<meta name="keywords" content="">

<!-- Template stylesheet -->
<link href="<?php echo base_url() ?>public/admin/css/blue/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/css/blue/custom.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/css/blue/screen.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/css/blue/datepicker.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/css/tipsy.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/js/visualize/visualize.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/js/jwysiwyg/jquery.wysiwyg.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/admin/js/fancybox/jquery.fancybox-1.3.0.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>public/jpage/css/jPages.css" rel="stylesheet"  type="text/css" />
<!--[if IE]>
	<link href="css/ie.css" rel="stylesheet" type="text/css" media="all">
	<script type="text/javascript" src="js/excanvas.js"></script>
<![endif]-->
<!-- Jquery and plugins -->
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery.img.preload.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/hint.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/visualize/jquery.visualize.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jwysiwyg/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/fancybox/jquery.fancybox-1.3.0.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/jquery.tipsy.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/custom_blue.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/mycustom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/admin/js/izzyColor.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/jpage/js/jPages.js" ></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('body').append('<div id="back_to_top" title="Back to Top">Back to Top</div>');
    $(window).scroll(function() {
    if($(window).scrollTop() != 0) {
    $('#back_to_top').fadeIn('fast');
    } else {
    $('#back_to_top').fadeOut('fast');
    }
    });
    $('#back_to_top').click(function() {
    $('html, body').animate({scrollTop:0},800);
    });
    });
</script>
<script type="text/javascript">
  $(function(){

    /* initiate the plugin */
    $("div.holder").jPages({
      containerID  : "content",
      perPage      : 20,
      startPage    : 1,
      startRange   : 1,
      midRange     : 5,
      endRange     : 1
    });

  });
</script>  
</head>
<body>
    <div class="content_wrapper">
	<!-- Begin header -->
    <?php $this->load->view('header') ?>
	<!-- End header -->
	
	<!-- Begin left panel -->
    <?php $this->load->view('sidebar') ?>
    <!-- End left panel calendar -->
	</div>
	<!-- End left panel -->
	
	<!-- Begin content -->
	<div id="content">
		<div class="inner">
			<?php $this->load->view('shortcut') ?>
			<br class="clear"/>
			<!-- Begin one column window -->
            <?php $this->load->view($template) ?>
			<!-- End one column window -->
		</div>
    <br class="clear"/>
	</div>
	<!-- End content -->
</div>
</body>
</html>