<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class ProductModel{
    public $conexion;

    public function __construct(){
        $this->conexion=Conexion::conectar();
    }

    public function get($id=null){
        $sql= $id ? "SELECT * FROM products WHERE id='$id'" : "SELECT * FROM products";
        $response = $this->conexion->query($sql);

        $data=[];
        if($response){
            $data = array();
            while($row= $response->fetch_assoc()){
                $categories=[];

                $sql2 = "SELECT c.id , c.name FROM category_product as cp inner join categories as c on c.id = cp.category_id WHERE product_id=".$row['id'];
                $stmt = $this->conexion->query($sql2);

                while($fila = $stmt->fetch_assoc()){
                    $categories[]=$fila;
                }

                $row['categories'] = $categories;

                $data[]=$row;
            }
        }

        if(count($data) > 0){
            return $id ? $data[0] : $data;
        }

        return $id ? null : [];
    }

    public function post($datos){
        $data= json_decode(file_get_contents('php://input'), true);
        // $name_product=$data['name'];
        // $description_product=$data['description'];
        // $photo_product=$data['photo'];
        // $stock_product=$data['stock'];
        // $created_at=$data['created_at'];
        // $product_code=$data['product_code'];

        $sql="INSERT INTO products(`name`, `description`, photo, stock, created_at, product_code, price) VALUES(?,?,?,?,?,?,?)";
        $response= $this->conexion->prepare($sql);
        $response->bind_param("sssssss", $datos['name'], $datos['description'], $datos['photo'], $datos['stock'],$datos['created_at'], $datos['product_code'], $datos['price']);

        $response->execute();
        return true;
    }

    public function put($datos){
        $data= json_decode(file_get_contents('php://input'), true);
        // $name_product=$data['name'];
        // $description_product=$data['description'];
        // $photo_product=$data['photo'];
        // $stock_product=$data['stock'];
        // $created_at=$data['created_at'];
        // $update_at=$data['updated_at'];
        // $product_code=$data['product_code'];
        
       $sql = "UPDATE products SET 
                `name` = '{$datos['name']}', 
                `description` = '{$datos['description']}', 
                `photo` = '{$datos['photo']}', 
                `stock` = '{$datos['stock']}', 
                `updated_at` = ' {$datos['updated_at']}', 
                `product_code` = '{$datos['product_code']}', 
                `price` = '{$datos['price']}' 
            WHERE id = '{$datos['id']}'";
        $response=$this->conexion->query($sql);
        return $response;
    }


    public function delete($id){
        $sql="DELETE FROM products WHERE id='$id'";
        $response=$this->conexion->query($sql);

        return $response;
    }

}
