<?php

require_once "Conexion.php";

class GestorSlideModels{

    #GUARDAR RUTA DE LA IMAGEN

    public function GuardarRutaImageModel($DatosModel,$Tabla){

        $stmt = Conexion::Conectar() -> prepare("INSERT INTO $Tabla (ruta) VALUES (:ruta)");

        $stmt -> bindParam(":ruta" , $DatosModel , PDO::PARAM_STR);

        if ($stmt -> execute()){
            return true;
        }else{
            return false;
        }

        $stmt -> close();

    }

    #SELECCIONAR RUTA DE LA IMAGEN

    public function MostrarImageModel($DatosModel, $Tabla){

        $stmt = Conexion::Conectar() -> prepare("SELECT ruta, titulo, descripcion FROM $Tabla WhERE ruta = :ruta");

        $stmt -> bindParam("ruta", $DatosModel , PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

    }

    #MOSTRAR LAS IMAGENES DE LA BD

    public function MostrarImagesVistaModel($Tabla){

        $stmt = Conexion::Conectar() -> prepare("SELECT ruta, titulo, descripcion FROM $Tabla ORDER BY orden ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

    }
}