<?php

class Conexion{
    public static $host ="localhost";
    public static $user="root";
    public static $password ="";
    public static $database="tienda";

    public static function conectar(){
        $conexion= new mysqli(self::$host, self::$user, self::$password, self::$database);
        if($conexion->connect_error){
            die("Conexion no establecida". $conexion->connect_error);
        }

        return $conexion;
    }
}