<?php

require_once '../Models/UserModel.php';
require_once '../Core/Conexion.php';
require_once '../Core/MainModal.php';
class UserController {
    public $model, $mainModal, $conexion;

    public function __construct(){
        $this->conexion=Conexion::conectar();
        $this->model= new UserModel();
        $this->mainModal= new MainModal();
    }
    public function consultar($id=null){
        $response = $this->model->get($id);    
        return json_encode($response);
    }

    public function actualizar(){
        $id = $_POST['id']; 
        $name = $_POST['name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $clave = $this->mainModal->encryption($password);
        
        $datosUser = [
            'id' => $id,
            'name' => $name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address'=>$address,
            'password'=>$clave,
        ];


        $response= $this->model->put($datosUser);
        return json_encode($response);

    }


}