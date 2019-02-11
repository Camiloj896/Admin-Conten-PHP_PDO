<?php

class Conexion{

    public function Conectar(){

        $server = "localhost";
        $dbName = "cms";
        $usuario = "root";
        $pass = "";

        $link = new PDO("mysql:host=".$server.";dbname=".$dbName."","".$usuario."","".$pass."");
        
        return $link;

    }
}