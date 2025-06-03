<?php 

require_once '../Core/Conexion.php';
require_once '../Models/OrderModel.php';
require_once '../Core/MainModal.php';


class OrderController{
    public $model, $mainModal, $conexion;
 
    public function __construct(){
        $this->model = new OrderModel();
        $this->mainModal = new MainModal();
        $this->conexion = Conexion::conectar();
    }

    public function consultar($id=null){
        $response = $this->model->get($id);    
        return json_encode($response);
    }

    public function insertar(){
        session_start();
        header('Content-Type: application/json');

        $carrito = isset($_POST['carrito']) ? json_decode($_POST['carrito'], true) : null;
        $subtotal = $_POST['subtotal'] ?? 0;
        $iva_total = $_POST['iva_total'] ?? 0;
        $total = $_POST['total'] ?? 0;
        $code_order = $this->mainModal->generarCodigo('OR-',6);
        $city = $_POST['pais'];
        $direccion = $_POST['direccion'];
        $country = $_POST['ciudad'];
        $order_date = date("Y-m-d H:i:s");
        $user_id = $_SESSION['id'];

        $datosOrder = [
            'code_order'=>$code_order,
            'total'=>$total,
            'subtotal'=>$subtotal,
            'iva'=>$iva_total,
            'status'=>"Pagado",
            'destination_city'=>$city,
            'adress_destination'=>$direccion,
            'country_destination'=>$country,
            'order_date'=>$order_date,
            'user_id'=>$user_id
        ];

        $response = $this->model->post($datosOrder);

        if($response){

            foreach($carrito as $producto){
                $datosDetalles = [
                    'quantity'=>$producto['cantidad'],
                    'unit_price'=>$producto['price'],
                    'iva'=>$producto['iva'],
                    'product_id'=>$producto['id'],
                    'order_id'=>$response
                ];

                $result= $this->model->insertarDellate($datosDetalles);
            }
           echo json_encode(['success' => true, 'message' => 'Pedido registrado correctamente']);
            exit;
        }else{
            return json_encode(['success' => false]);
        }

    }
}

