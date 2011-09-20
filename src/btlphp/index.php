<?php session_start();
include_once('config.php');
include_once('library/database.php');
include_once('library/methods.php');
$methods = new Methods();
include_once('controller/controller.php');
$methods->close_connection();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bài tập lớn</title>

	<meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
	
    <link rel="stylesheet" type="text/css" media="all" href="css/style.css" />
	<link rel="Stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.1.custom.css"  />	
	<!--[if IE 7]><link rel="stylesheet" href="css/ie.css" type="text/css" media="screen, projection" /><![endif]-->
	<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen, projection" /><![endif]-->
	<link rel="stylesheet" type="text/css" href="editor/skins/markitup/style.css" />
	<link rel="stylesheet" type="text/css" href="editor/sets/default/style.css" />
	<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">
	<!--[if IE]>
		<style type="text/css">
		  .clearfix {
		    zoom: 1;     /* triggers hasLayout */
		    display: block;     /* resets display for IE/Win */
		    }  /* Only IE can see inside the conditional comment
		    and read this CSS rule. Don't ever use a normal HTML
		    comment inside the CC or it will close prematurely. */
		</style>
	<![endif]-->
	<!-- JavaScript -->
    <script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.7.1.custom.min.js"></script>
	<script type="text/javascript" src="js/hoverIntent.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript">
		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
$('.info_div').oneTime(1000, function() {$(this).fadeOut('slow')});
	</script>
	<script type="text/javascript" src="js/excanvas.pack.js"></script>
	<script type="text/javascript" src="js/jquery.flot.pack.js"></script>
    <script type="text/javascript" src="editor/jquery.markitup.pack.js"></script>
	<script type="text/javascript" src="editor/sets/default/set.js"></script>
  	<script type="text/javascript" src="js/custom.js"></script>

	 <!--[if IE]><script language="javascript" type="text/javascript" src="excanvas.pack.js"></script><![endif]-->
</head>
<body>
<div id="container">

	<?php
	new controller();
	?>

</div>
</body>
</html>
<?php 
$methods->close_connection();
?>
