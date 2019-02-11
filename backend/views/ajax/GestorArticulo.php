<?php

require_once "../../models/GestorArticulo.php";
require_once "../../controllers/GestorArticulo.php";

class GestorAticuloajax{

    //---------------------------------------
    // ALMACENANDO IMAGEN PARA EL ARTICULO
    //---------------------------------------

    public $nombreImage;
    public $nombreImageTmp;

    public function imageArticuloAjax(){

        $datos = array("nombreImage" => $this->nombreImage, "nombreImageTmp" => $this->nombreImageTmp);

        $res = GestorArticuloController::imageArticuloController($datos);

        echo $res;

    }

}


if(isset($_FILES["imagen"]["name"])){
    $imagen = new GestorAticuloajax();
    $imagen -> nombreImage = $_FILES["imagen"]["name"];
    $imagen -> nombreImageTmp = $_FILES["imagen"]["tmp_name"];
    $imagen -> imageArticuloAjax();
}