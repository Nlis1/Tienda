<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class CategoryModel{
    public $conexion;

    public function __construct(){
        $this->conexion=Conexion::conectar();
    }

    public function get(){
       $sql = "SELECT * FROM categories";
        $response =$this->conexion->query($sql);
        $category=[];

        if($response){
            $category = array();
            while($row= $response->fetch_assoc()){
                $category[]=$row;
            }
        }
        return $category;
    }
}