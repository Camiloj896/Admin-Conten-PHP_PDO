<?php

class GestorSlideController{

	#MOSTRAR IMAGEN SLIDE CON AJAX

	public function MostrarImagenController($datos){

		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);	

		if ($ancho < 1600 || $alto < 600) {

			echo 0;

		}else{

			$numAleatorio = mt_rand(100, 999);

			$ruta = "../../views/images/slide/slide" . $numAleatorio . ".jpg";

			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);

			$destino = imagecrop($origen, ["x" => 0, "y" => 0, "width" => 1600, "height" => 600]); #funcion usada para recortar una imagen

			imagejpeg($destino, $ruta); #funcion usada para cargar la imagen al servidor

			GestorSlideModels::GuardarRutaImageModel($ruta,"slide");

			$res = GestorSlideModels::MostrarImageModel($ruta, "slide");

			$EnviarDatos = array ("ruta" => $res["ruta"], "titulo" => $res["titulo"], "descripcion" => $res["descripcion"]);
			
			echo json_encode($EnviarDatos);
			
		}	
	}

	#MOSTRAR LAS IMAGENES DEL SLICE ALMACENADAS

	public function MostrarImagesVistaSlideController(){

		$res = GestorSlideModels::MostrarImagesVistaModel("slide");

		foreach ($res as $row => $item){

			echo '<li id = "' . $item["id"] . '" class="bloqueSlide"><span class="fa fa-times EliminarSlide" ruta="' . $item["ruta"] . '"></span> 
				  	<img src="' . substr($item["ruta"], 6) . '" class="handleImg">
				  </li>';
		}		

	}

	#MOSTRAR LAS IMAGENES ALMACENADAS Y SU INFORMACION

	public function MostrarInfoImagesVistaController(){

		$res = GestorSlideModels::MostrarImagesVistaModel("slide");

		foreach ($res as $row => $item){
			echo '<li id="item"'. $item["id"] .'>
					<span class="fa fa-pencil editarSlide" style="background:blue"></span>
					<img src="' . substr($item["ruta"], 6) . '" style="float:left; margin-bottom:10px" width="80%">
					<h1>' . $item["titulo"] . '</h1>
					<p> ' . $item["descripcion"] . '</p>
				</li>';
		}		

	}

	#ELIMINAR IMAGENES ALMACENADAS

	public function EliminarImagesSlideController($datos){		

		$res = GestorSlideModels::EliminarImagesSlideModel("slide", $datos);

		unlink($datos["rutaSlide"]);

		echo $res;		

	}

}