<?php

class Conexion{

    public function Conectar(){

        $link = new PDO("mysql:host=localhost;dbname=cms","root","");
        return $link;

    }
}