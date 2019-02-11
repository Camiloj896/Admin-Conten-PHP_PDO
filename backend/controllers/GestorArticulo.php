<?php

class GestorArticuloController{

    //---------------------------------------
    // ALMACENANDO IMAGEN PARA EL ARTICULO
    //---------------------------------------

    public function imageArticuloController($datos){
        
        list($ancho, $alto) = getimagesize($datos["nombreImageTmp"]);

        if($ancho > 800 || $alto > 400){
            echo 0;
        }else{

            $numAleatorio = mt_rand(100, 999);

            $ruta = "../../views/images/articulos/articulo" . $numAleatorio . ".jpg";

            $origen = imagecreatefromjpeg($datos["nombreImageTmp"]);			

            imagejpeg($origen, $ruta);

            GestorArticuloModel::imageArticuloModel("articulos", $ruta);

            $res = GestorArticuloModel::imageArticuloModel("articulos", $ruta);
            
            $EnviarDatos = array("id" => $res["id"], "ruta" => $res["ruta"]);

            echo json_encode($EnviarDatos);
            
        }

    }
}