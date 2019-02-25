<?php

	require_once "./controllers/template.php";

	include_once "./controllers/GestorSlide.php";
	include_once "./models/GestorSlide.php";	

	include_once "./controllers/GestorArticulo.php";
	include_once "./models/GestorArticulo.php";

	include_once "./controllers/GestorGaleria.php";
	include_once "./models/GestorGaleria.php";

	$template = new TemplateController();
	$template -> template();