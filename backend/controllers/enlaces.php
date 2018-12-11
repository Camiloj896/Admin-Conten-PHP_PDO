<?php

class Enlaces{

    public function EnlacesController(){
        
        if (isset($_GET["action"])){

            $Enlaces = $_GET["action"];

        }else{

            $Enlaces = "index";

        }

        $res = EnlacesModels::Enlacesmodel($Enlaces);

        include $res;	
    }

}