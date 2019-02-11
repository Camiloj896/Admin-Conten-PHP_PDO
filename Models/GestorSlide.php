<?php

require_once "./backend/models/Conexion.php";

class SlideModel{

    //---------------------------------
    //MOSTRAR LAS IMAGENES DE LA BD
    //---------------------------------
    public function MostrarImagesVistaModel($Tabla){

        $stmt = Conexion::Conectar() -> prepare("SELECT id, ruta, titulo, descripcion FROM $Tabla ORDER BY orden ASC");

        $stmt -> execute();
        
        return $stmt -> fetchAll(); 
    
        $stmt -> close();

    }

}