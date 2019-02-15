<?php 

require_once "Conexion.php";

class GestorArticuloModel{

     // ALMACENANDO DATOS DEL ARTICULO
    //-------------------------------------------

    public function cargarDatosArticuloController($tabla, $datosModel){

        $stmt = Conexion::Conectar() -> prepare("INSERT INTO $tabla (titulo, introduccion, contenido, ruta) VALUES (:titulo, :introduccion, :contenido, :ruta)");
        
        $stmt -> bindParam("titulo", $datosModel["tituloArticulo"], PDO::PARAM_STR);
        $stmt -> bindParam("introduccion", $datosModel["introduccionArticulo"], PDO::PARAM_STR);
        $stmt -> bindParam("contenido", $datosModel["contenidoArticulo"], PDO::PARAM_STR);
        $stmt -> bindParam("ruta", $datosModel["ruta"], PDO::PARAM_STR);
        
        if($stmt -> execute()){
            return true;
        }else{
            return false;
        }

        $stmt -> close();

    }

    // MOSTRAR ARTICULOS ALMACENADOS
    //------------------------------------

    public function mostrarDatosArticulosModel($tabla){

        $stmt = Conexion::Conectar() -> prepare("SELECT id, titulo, introduccion, contenido, ruta FROM $tabla ORDER BY orden ASC");

        $stmt -> execute();

        return $stmt -> fetchAll();

        $stmt -> close();    

    }

    // BORRAR ARTICULO
    // ---------------------

    public function borrarArticuloModel($tabla, $datosModel){

        $stmt = Conexion::Conectar() -> prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt -> bindParam("id", $datosModel, PDO::PARAM_STR);
        
        if($stmt -> execute()){
            return true;
        }else{
            return false;
        }

        $stmt -> close();
    }

    //ACTUALIZAR DATOS ARTICULO
    //-----------------------------------------------------------

    public function actualizarDatosArticuloModel($tabla, $datosModel){
        
        if($datosModel["ruta"] == ""){
            $stmt = Conexion::Conectar() -> prepare("UPDATE $tabla SET id = :id, titulo = :titulo, introduccion = :introduccion , contenido = :contenido WHERE id = :id");            
        }else{
            $stmt = Conexion::Conectar() -> prepare("UPDATE $tabla SET id = :id, titulo = :titulo, introduccion = :introduccion , contenido = :contenido, ruta = :ruta WHERE id = :id");
            $stmt -> bindParam("ruta", $datosModel["ruta"], PDO::PARAM_STR);
        }

        $stmt -> bindParam("id", $datosModel["id"], PDO::PARAM_STR);
        $stmt -> bindParam("titulo", $datosModel["titulo"], PDO::PARAM_STR);
        $stmt -> bindParam("introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
        $stmt -> bindParam("contenido", $datosModel["contenido"], PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        }else{
            return false;
        }

        $stmt -> close();        

    }

}