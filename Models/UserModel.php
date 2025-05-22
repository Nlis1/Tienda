<?php

require_once(__DIR__ . '/../Core/Conexion.php');
require_once(__DIR__ . '/../Core/MainModal.php');

class UserModel extends MainModal{
    public $conexion;

    public function __construct(){
        $this->conexion= Conexion::conectar();
    }

    public function register_user($datos){
        $sql="INSERT INTO users (`name`,  last_name, email,`address`, phone, `password`, gender) VALUES (?,?,?,?,?,?,?)";
        $stmt=$this->conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param("sssssss", $datos['name'],$datos['last_name'],$datos['email'] ,$datos['address'], $datos['phone'],$datos['password'],$datos['gender']);
        if ($stmt->execute()) {

        return $this->conexion->insert_id; 
        
        } else {
            return false;
        }
    }

    public function validate_credentials($datos){
        $sql="SELECT * FROM users WHERE email=? AND `password`=?";
        $stmt=$this->conexion->prepare($sql);
        if (!$stmt) {
            die("Error al preparar la consulta: " . $this->conexion->error);
        }
        $stmt->bind_param("ss", $datos['email'], $datos['password']);
        $stmt->execute();
        $response= $stmt->get_result();
        return $response->fetch_assoc();
    }
}