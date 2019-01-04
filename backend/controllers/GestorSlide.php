<?php

class GestorSlideController{

	public function MostrarImagenController($datos){

		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);	

		if ($ancho < 1600 || $alto < 600) {
				return 0;
			}	
	}

}