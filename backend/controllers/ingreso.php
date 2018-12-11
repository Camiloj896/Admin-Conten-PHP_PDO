<?php

class Ingreso{

    public function IngresoController(){

        if (isset($_POST["usuarioIngreso"])){
            
            $DatosArray = array("usuario" => $_POST["usuarioIngreso"], "password" => $_POST["passwordIngreso"]);        

            $Res = IngresoModels::IngresoModel($DatosArray);

            if ($Res["usuario"] == $_POST["usuarioIngreso"] && $Res["password"] == $_POST["passwordIngreso"]) {
                
                #$_SESSION["sesion"] = true;
                header("location: index.php?action=inicio");
                
            }else{

                echo "Error al ingresar";

            }

        }        

    }

}