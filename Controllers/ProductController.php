<?php

require_once '../Models/ProductModel.php';
require_once '../Core/Conexion.php';
require_once '../Core/MainModal.php';
class ProductController {
    public $model, $mainModal, $conexion;

    public function __construct(){
        $this->conexion=Conexion::conectar();
        $this->model= new ProductModel();
        $this->mainModal= new MainModal();
    }
    public function consultar($id=null){
        $response = $this->model->get($id);    
        return json_encode($response);
    }

    public function insertar(){
        $name=$_POST['name_product'];
        $description=$_POST['description_product'];
        $photo=$_POST['photo_product'];
        $stock=$_POST['stock_product'];
        $created_at= date("Y-m-d H:i:s");
        $price = $_POST['precio_product'];
        $iva = $_POST['iva_product'];
        $product_code= $this->mainModal->generarCodigo('P-',8);

        $datosProduct=[
            'name'=>$name,
            'description'=>$description,
            'photo'=>$photo,
            'stock'=>$stock,
            'created_at'=>$created_at,
            'product_code'=>$product_code,
            'price'=>$price,
            'iva'=>$iva,
        ];

        $response= $this->model->post($datosProduct);

        if ($response) {
            if (isset($_POST['categories']) && is_array($_POST['categories'])) {
            $categorias = $_POST['categories'];

            foreach ($categorias as $categoryId) {
            
                $sqlInsert = "INSERT INTO category_product (category_id, product_id) VALUES (?, ?)";
                $stmtInsert = $this->conexion->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $categoryId, $response);
                $stmtInsert->execute();
                $stmtInsert->close(); 
            }
        }
    }

    return json_encode($response);
}

      public function actualizar(){
        $id = $_POST['id_up']; // lo que enviaste con input hidden
        $name = $_POST['name_up'];
        $photo = $_POST['photo_up'];
        $description = $_POST['description_up'];
        $stock = $_POST['stock_up'];
        $price = $_POST['price_up'];
        $iva = $_POST['iva_up'];
        $updated_at = date("Y-m-d H:i:s");
        
        $datosProduct = [
            'id' => $id,
            'name' => $name,
            'photo' => $photo,
            'description' => $description,
            'stock' => $stock,
            'updated_at'=>$updated_at,
            'price'=>$price,
            'iva'=>$iva
        ];


        $response= $this->model->put($datosProduct);
        return json_encode($response);
    }

    public function eliminar($id){
        $response= $this->model->delete($id);
        return json_encode($response);
    }
}