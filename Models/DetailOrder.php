<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class DetailOrder {
    public $conexion;

    public function __construct(){
        $this->conexion = Conexion::conectar();
    }

    public function getDetailsByOrderId($id = null){
        $sql = "SELECT detail_order.*, products.name FROM detail_order INNER JOIN products 
        ON detail_order.product_id = products.id WHERE order_id='$id'";

        $response = $this->conexion->query($sql);
    
        $data = [];
        if($response){
            while($row = $response->fetch_assoc()){
                $data[]= $row;
            }
        }
        return $data;
    }

     public function insertarDellate($datos){
        $sql="INSERT INTO detail_order(id, quantity, unit_price, iva, product_id, order_id)VALUES(?,?,?,?,?,?)";
        $response = $this->conexion->prepare($sql);
        $response->bind_param('ssssss', $datos['id'], $datos['quantity'], $datos['unit_price'], $datos['iva'], $datos['product_id'], $datos['order_id'] );

        if($response->execute()){
            return true;
        }
    }

}