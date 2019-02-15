<?php

require_once "../../models/GestorArticulo.php";
require_once "../../controllers/GestorArticulo.php";

class GestorAticuloajax{

    
    // IMAGEN TEMPORAL PARA EL ARTICULO
    //----------------------------------------------

    public $nombreImagenTemporal;    

    public function imagenTemporalArticuloAjax(){

        $datos = $this -> nombreImagenTemporal;
        
        $res = GestorArticuloController::imagenTemporalArticuloController($datos);        
             
        echo $res;
    }

    //ACTUALIZAR ORDEN ARTICULOS
    //----------------------------------------------

    public $idArticulo;
    public $ordenArticulo;

    public function actualizarOrdenArticulosAjax(){

        $datos = array("idItemOrden" => $this->idArticulo, "ordenItem" => $this->ordenItem);
        $res = GestorArticuloController::actualizarOrdenArticulosAjax($datos);
        echo $res;
        
    }
   
}


// OBJETOS
//---------------------------------------------------------------------

//IMAGEN TEMPORAL
if(isset($_FILES["imagen"]["tmp_name"])){
    $a = new GestorAticuloajax();
    $a -> nombreImagenTemporal = $_FILES["imagen"]["tmp_name"];    
    $a -> imagenTemporalArticuloAjax();
}

//ORDEN ARTICULOS

if(isset($_POST["idItemOrden"])){
    $b = new GestorAticuloajax();
    $b -> idArticulo = $_POST["idItemOrden"];
    $b -> ordenArticulo = $_POST["ordenItem"];
    $b -> actualizarOrdenArticulosAjax();
}







