<?php

require_once '../Models/CategoryModel.php';
require_once '../Core/Conexion.php';
class CategoryController {
    public $conexion;
    public $model;

    public function __construct(){
        $this->conexion=Conexion::conectar();
        $this->model = new CategoryModel();
    }
    public function consultar($id=null){
        $response = $this->model->get($id);
        return json_encode($response);
    }
}