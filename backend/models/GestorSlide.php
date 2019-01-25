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

        $stmt = Conexion::Conectar() -> prepare("SELECT id, ruta, titulo, descripcion FROM $Tabla WhERE ruta = :ruta");

        $stmt -> bindParam("ruta", $DatosModel , PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

    }

    #MOSTRAR LAS IMAGENES DE LA BD

    public function MostrarImagesVistaModel($Tabla){

        $stmt = Conexion::Conectar() -> prepare("SELECT id, ruta, titulo, descripcion FROM $Tabla ORDER BY orden ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();

    }

    #ELIMINAR IMAGENES BD SLIDE

    public function EliminarImagesSlideModel($tabla, $id){

        $stmt = Conexion::Conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt-> bindParam("id", $id["IdSlide"], PDO::PARAM_INT);

        if ($stmt -> execute()){
            return true;
        }else{
            return false;
        }

        $stmt -> close();         
    }
}