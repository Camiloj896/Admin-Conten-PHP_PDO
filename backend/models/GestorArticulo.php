<?php 

require_once "Conexion.php";

class GestorArticuloModel{

    //-------------------------------------------
    // ALMACENANDO RUTA IMAGEN PARA EL ARTICULO
    //-------------------------------------------

    public function imageArticuloModel($tabla, $datosModel){

        $stmt = Conexion::Conectar() -> prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");
        $stmt -> bindParam("ruta", $datosModel, PDO::PARAM_STR);
        $stmt -> execute();
        $stmt -> close();

    }

    public function mostrarImageModel($tabla, $datosModel){

        $stmt = Conexion::Conectar() -> prepare("SELECT * FROM $tabla WHERE ruta = :ruta");
        $stmt -> bindParam("ruta", $datosModel, PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetch();
        $stmt -> close();

    }

}