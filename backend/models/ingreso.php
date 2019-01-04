<?php

require_once "Conexion.php";

class IngresoModels{

    public function IngresoModel($DatosModel, $tabla){

        $stmt = Conexion::Conectar()->prepare("SELECT usuario, password, intentos FROM 
        $tabla WHERE usuario = :Usuario");

        $stmt -> bindParam(":Usuario", $DatosModel["usuario"], PDO::PARAM_STR);        
        
        $stmt -> execute();

        return $stmt -> fetch();    

        $stmt -> close();
        
    }

    public function NumIntentos($DatosModel, $tabla){

    	$stmt = Conexion::Conectar() -> prepare("UPDATE $tabla SET intentos = :intento WHERE usuario = :usuario");

    	$stmt -> bindParam(":intento", $DatosModel["ActualizarIntento"] , PDO::PARAM_STR);
    	$stmt -> bindParam(":usuario", $DatosModel["UsuarioActual"] , PDO::PARAM_STR);
    	
    	$stmt -> execute();

    	return $stmt -> fetch();

    	$stmt -> close();

    }

}