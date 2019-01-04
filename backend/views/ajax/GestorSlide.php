<?php

	require_once "../../models/GestorSlide.php";
	require_once "../../controllers/GestorSlide.php";

	
	class Ajax{

		public $nombreImagen;
		public $imagenTemporal;

		public function gestorSlideAjax(){

			$datos = array("nombreImagen" => $this->nombreImagen, "imagenTemporal" => $this->imagenTemporal);

			$res = GestorSlideController::MostrarImagenController($datos);

			echo $res;
		}

	}

	$imagen = new ajax();
	$imagen -> nombreImagen = $_FILES["imagen"]["name"];
	$imagen -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$imagen -> gestorSlideAjax();
