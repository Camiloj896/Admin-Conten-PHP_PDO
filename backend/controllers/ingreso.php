<?php

class Ingreso{

    public function IngresoController(){

        if (isset($_POST["usuarioIngreso"])){

            if (preg_match('/^[a-zA-Z0-9]*$/', $_POST["usuarioIngreso"]) &&
                preg_match('/^[a-zA-Z0-9]*$/', $_POST["passwordIngreso"])){            
            
                #$encriptar = crypt($_POST["pass"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $DatosArray = array("usuario" => $_POST["usuarioIngreso"], "password" => $_POST["passwordIngreso"]);      

                $Res = IngresoModels::IngresoModel($DatosArray,"usuarios");

                $intento = $Res["intentos"];
                $UsuActual = $_POST["usuarioIngreso"];
                $maxintento = 2;

                if ($intento < $maxintento) {
                    
                    if ($Res["usuario"] == $_POST["usuarioIngreso"] && $Res["password"] == $_POST["passwordIngreso"]) { 

                        $intento = 0;              

                        $DatosArray = array('UsuarioActual' => $UsuActual, 'ActualizarIntento' => $intento);

                        $ResActuIntentos = IngresoModels::NumIntentos($DatosArray, "usuarios");

                        session_start();
                        
                        $_SESSION["validar"] = true;
                        $_SESSION["usuario"] = $Res["usuario"];

                        header("location:inicio");
                        
                    }else{

                        ++$intento;

                        $DatosArray = array('UsuarioActual' => $UsuActual, 'ActualizarIntento' => $intento);

                        $ResActuIntentos = IngresoModels::NumIntentos($DatosArray, "usuarios");

                        echo "<div class='alert alert-danger'>Error al ingresar</div>";
                    }

                }
            }

        }        

    }





}