<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class OrderModel {
    public $conexion;

    public function __construct(){
        $this->conexion = Conexion::conectar();
    }

    public function get($id=null){
        
        $sql = !empty($id) ? "SELECT * FROM orders WHERE id = '$id'" : "SELECT * FROM orders";
        $response = $this->conexion->query($sql);

        $data = [];
        if($response){
            while($row = $response->fetch_assoc()){
                $data[]= $row;
            }
        }
        return $data;
    }

    public function post($datos){
        $sql = "INSERT INTO orders(id, code_order, destination_city, adress_destination, country_destination, order_date, user_id) VALUES (?,?,?,?,?,?,?)";
        $response= $this->conexion->prepare($sql);
        $response->bind_param('sssssss', $datos['id'],$datos['code_order'], $datos['destination_city'], $datos['adress_destination'], $datos['country_destination'], $datos['order_date'], $datos['user_id']);

        if($response->execute()){
            return $this->conexion->insert_id; 
        } else {
            return false;
        }
    }

    public function insertarDellate($datos){
        $sql="INSERT INTO detail_order(id, quantity, unit_price, iva, product_id, order_id)VALUES(?,?,?,?,?,?)";
        $response = $this->conexion->prepare($sql);
        $response->bind_param('ssssss', $datos['id'], $datos['quantity'], $datos['unit_price'], $datos['iva'], $datos['product_id'], $datos['order_id'] );

        if($response->execute()){
            return true;
        }
    }

    public function getDetailOrder($id=null){
        
        $sql = "SELECT * FROM detail_order WHERE order_id='$id '";

        $response = $this->conexion->query($sql);

        $data = [];
        if($response){
            while($row = $response->fetch_assoc()){
                $data[]= $row;
            }
        }
        return $data;
    }
}
