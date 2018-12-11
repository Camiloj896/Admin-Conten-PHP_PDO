<?php

class EnlacesModels{

    public function Enlacesmodel($Enlaces){

        if ($Enlaces == "inicio" ||
            $Enlaces == "ingreso" ||
            $Enlaces == "slide" ||
            $Enlaces == "articulos" ||
            $Enlaces == "galeria" ||
            $Enlaces == "videos" ||
            $Enlaces == "suscriptores" ||
            $Enlaces == "mensajes" ||
            $Enlaces == "perfil"){
                
                $module = "views/modules/" . $Enlaces . ".php";

        }else if ($Enlaces == "index"){

                $module = "views/modules/ingreso.php";

        }else{

            $module = "views/modules/ingreso.php";

        }

        return $module;

    }

}