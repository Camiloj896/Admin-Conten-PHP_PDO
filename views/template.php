<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>FrontEnd</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" href="views/images/icono.jpg">

	<link rel="stylesheet" href="views/css/bootstrap.min.css">
	<link rel="stylesheet" href="views/css/font-awesome.min.css">
	<link rel="stylesheet" href="views/css/style.css">
	<link rel="stylesheet" href="views/css/fonts.css">
	<link rel="stylesheet" href="views/css/cssFancybox/jquery.fancybox.css">

	<script src="views/js/jquery-2.2.0.min.js"></script>
	<script src="views/js/bootstrap.min.js"></script>
	<script src="views/js/jquery.fancybox.js"></script>
	<script src="views/js/animatescroll.js"></script>
	<script src="views/js/jquery.scrollUp.js"></script>

</head>

<body>

	<div class="container-fluid">
	
	<?php
		#<!--=====================================
		#CABEZOTE
		#======================================-->
		
		include "modules/cabezote.php";		

		#<!--=====================================
		#SLIDE
		#======================================-->

		include "modules/slide.php";		

		#<!--=====================================
		#TOP
		#======================================-->

		include "modules/top.php";

		#<!--=====================================
		#GALERIA
		#======================================-->

		include "modules/galeria.php";

		#<!--=====================================
		#ARTÍCULOS
		#======================================-->

		include "modules/articulos.php";

		#<!--=====================================
		#VIDEOS
		#======================================-->

		include "modules/videos.php";

		#<!--=====================================
		#	CONTÁCTENOS         
		#======================================-->

		include "modules/contacto.php";

		#<!--=====================================
		#	ARTÍCULO MODAL         
		#======================================-->

		include "modules/articulomodal.php";

	?>

<script src="js/script.js"></script>

</body>
</html>


