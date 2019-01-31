<?php

	require_once "../../models/GestorSlide.php";
	require_once "../../controllers/GestorSlide.php";
	
	class Ajax{
		//----------------------------
		//CARGAR IMAGEN BD AJAX
		//----------------------------

		public $nombreImagen;
		public $imagenTemporal;

		public function gestorSlideAjax(){

			$datos = array("nombreImagen" => $this->nombreImagen, "imagenTemporal" => $this->imagenTemporal);

			$res = GestorSlideController::MostrarImagenController($datos);

			echo $res;
		}

		//------------------------------
		//ELIMINAR IMAGEN BD AJAX
		//------------------------------

		 public $IdSlide;
		 public $RutaSlide;

		 public function EliminarImageSlideAjax(){

		 	$datos = array("IdSlide" => $this->IdSlide, "rutaSlide" => $this->RutaSlide);

		 	$res = GestorSlideController::EliminarImagesSlideController($datos);

		 	echo $res;
		}
		// -------------------------
		// EDITAR DATOS DEL SLIDE
		// -------------------------
		public $IdEditarSlide;
		public $tituloItemSlide;
		public $infoItemSlide;

		public function editarDatosSlideAjax(){
		
			$datos = array("IdEditarSlide" => $this->IdEditarSlide, "tituloItemSlide" => $this->tituloItemSlide, "infoItemSlide" => $this->infoItemSlide);
			
						
		}


	}

	//OBTENIENDO DATOS DEL JS(AJAX)

	if(isset($_FILES["imagen"]["name"])){
		$imagen = new Ajax();
		$imagen -> nombreImagen = $_FILES["imagen"]["name"];
		$imagen -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
		$imagen -> gestorSlideAjax();
	}

	if(isset($_POST["idslide"])){
		$eliminar = new Ajax(); 		
		$eliminar -> IdSlide = $_POST["idslide"];
		$eliminar -> RutaSlide = $_POST["rutaSlide"];
		$eliminar -> EliminarImageSlideAjax();
	}

	if(isset($_POST["editarIdSlide"])){
		$cargar = new Ajax();
		$cargar -> IdEditarSlide = $_POST["IdEditarSlide"];
		$cargar -> tituloItemSlide = $_POST["tituloItemSlide"];
		$cargar -> infoItemSlide = $_POST["infoItemSlide"];
		$cargar -> editarDatosSlideAjax();
	}


