<?php

require_once "controllers/template.php";
require_once "controllers/enlaces.php";
require_once "models/enlaces.php";

require_once "controllers/ingreso.php";
require_once "models/ingreso.php";

require_once "models/GestorSlide.php";
require_once "controllers/GestorSlide.php";

require_once "models/GestorArticulo.php";
require_once "controllers/GestorArticulo.php";

require_once "models/GestorGaleria.php";
require_once "controllers/GestorGaleria.php";

$template = new TemplateController();
$template -> template();