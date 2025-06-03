<?php

require_once(__DIR__ . '/../Core/Conexion.php');
require_once(__DIR__ . '/DetailOrder.php');
require_once(__DIR__ . '/UserModel.php');

class OrderModel {
    public $conexion;
    public $modal;
    public $user;

    public function __construct(){
        $this->conexion = Conexion::conectar();
        $this->modal = new DetailOrder();
        $this->user = new UserModel();
    }

    public function get($id=null){
        
        if(!empty($id)){
            $sql= "SELECT * FROM orders WHERE id='$id'";
          
        $response = $this->conexion->query($sql);
        $orderData = [];

        if ($response && $response->num_rows > 0) {
            $orderData = $response->fetch_assoc();
            
            $detail = $this->modal->getDetail($id);
            $user = $this->user->get($orderData['user_id']);
            
            $orderData = [...$orderData,
                        'user'=> $user,
                        'detail_order' => $detail];
        }

        return $orderData;

        } else {
            $sql = "SELECT orders.*, users.name, users.last_name 
                    FROM orders 
                    INNER JOIN users ON orders.user_id = users.id";

            $response = $this->conexion->query($sql);
            $orders = [];

            if($response){
                while($row = $response->fetch_assoc()){
                    $orders[]= $row;
                }
            }
            return $orders;
        }
    }

    public function post($datos){
        $sql = "INSERT INTO orders(id, code_order, total, subtotal, iva, `status`, destination_city, adress_destination, country_destination, order_date, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $response= $this->conexion->prepare($sql);
        $response->bind_param('sssssssssss', $datos['id'],$datos['code_order'],$datos['total'], $datos['subtotal'], $datos['iva'], $datos['status'], $datos['destination_city'], $datos['adress_destination'], $datos['country_destination'], $datos['order_date'], $datos['user_id']);

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
