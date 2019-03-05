<?php

	require_once "./controllers/template.php";

	include_once "./controllers/GestorSlide.php";
	include_once "./models/GestorSlide.php";	

	include_once "./controllers/GestorArticulo.php";
	include_once "./models/GestorArticulo.php";

	include_once "./controllers/GestorGaleria.php";
	include_once "./models/GestorGaleria.php";

	include_once "./controllers/GestorVideos.php";
	include_once "./models/GestorVideos.php";	

	include_once "./controllers/GestorMensajes.php";
	include_once "./models/GestorMensajes.php";		

	$template = new TemplateController();
	$template -> template();