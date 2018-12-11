<?php

require_once "Conexion.php";

class IngresoModels{

    public function IngresoModel($DatosModel){

        $stmt = Conexion::Conectar()->prepare("SELECT usuario, password FROM 
        usuarios WHERE usuario = :Usuario AND password = :Password");

        $stmt -> bindParam(":Usuario", $DatosModel["usuario"]);
        $stmt -> bindParam(":Password", $DatosModel["password"]);
        
        $stmt -> execute();

        return $stmt -> fetch();    

        $stmt -> close();
        
    }

}