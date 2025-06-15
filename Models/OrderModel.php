<?php

require_once(__DIR__ . '/../Core/Conexion.php');
require_once(__DIR__ . '/DetailOrder.php');
require_once(__DIR__ . '/UserModel.php');

class OrderModel {
    public $conexion;
    public $orderDetail;
    public $user;

    public function __construct(){
        $this->conexion = Conexion::conectar();
        $this->orderDetail = new DetailOrder();
        $this->user = new UserModel();
    }

    public function get($id=null)
    {
        if(!empty($id)){
            $sql= "SELECT * FROM orders WHERE id='$id'";
            
            $response = $this->conexion->query($sql);
            $orderData = [];

            if ($response && $response->num_rows > 0) {
                $orderData = $response->fetch_assoc();
                
                $detail = $this->orderDetail->getDetailsByOrderId($id);
                $user = $this->user->get($orderData['user_id']);
                
                $orderData =[
                                ...$orderData,
                                'user'=> $user,
                                'detail_order' => $detail
                            ];
            }

            return $orderData;
        } else {
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $orders = [];

            if(isset($_SESSION['id']) && isset($_SESSION['rol'])) {
                $userid = $_SESSION['id'];
                $roluser = $_SESSION['rol'];

                    if($userid && $roluser === "1"){
                        $sql="SELECT orders.*,users.name, users.last_name FROM orders INNER JOIN users ON orders.user_id = users.id WHERE user_id='$userid'";
                    }
            }

            if(!isset($sql)){
            $sql = "SELECT orders.*, users.name, users.last_name 
                    FROM orders 
                    INNER JOIN users ON orders.user_id = users.id";
            }

            $response = $this->conexion->query($sql);

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

}
