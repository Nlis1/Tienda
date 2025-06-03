<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class DetailOrder {
    public $conexion;

    public function __construct(){
        $this->conexion = Conexion::conectar();
    }

    public function getDetail($id = null){
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

}