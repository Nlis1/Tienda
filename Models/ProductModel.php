<?php

require_once(__DIR__ . '/../Core/Conexion.php');

class ProductModel{
    public $conexion;

    public function __construct(){
        $this->conexion=Conexion::conectar();
    }

    public function applyFilters($id = null, $count = false){
            $categoryId = $_GET['category_id'] ?? null;
            $search = $_GET['search'] ?? null;

            // FROM + JOIN
            $from = "FROM products";
            if ($categoryId) {
                $from .= " INNER JOIN category_product as cp ON cp.product_id = products.id";
            }

            // WHERE conditions
            $conditions = [];

            if ($categoryId) {
                $conditions[] = "cp.category_id = '$categoryId'";
            }

            if ($id) {
                $conditions[] = "products.id = '$id'";
            }

            if ($search) {
                $escapedSearch = $this->conexion->real_escape_string($search); // evitar inyección SQL
                $conditions[] = "(products.name LIKE '%$escapedSearch%' OR products.price LIKE '%$escapedSearch%')";
            }

            // Convertimos condiciones a string
            $where = '';
            if (count($conditions) > 0) {
                $where = " WHERE " . implode(" AND ", $conditions);
            }

            // SELECT
            if ($count) {
                $sql = "SELECT COUNT(*) $from $where";
            } else {
                $sql = "SELECT products.*, ROUND(products.price*(1 + products.iva/100), 2) as price_with_iva $from $where ORDER BY products.created_at DESC";
            }

            return $sql;    
    }

    public function returnData($data, $total = 0){
        $page = $_GET['page'] ?? false;
        if(!$page) return $data;

        $limit = $_GET['limit'] ?? 10;
        $prev = $page-1;
        $next = $page+1;

        return [
            "products"=>$data,
            "page"=>$page,
            "per_page"=>$limit,
            "prev"=>$prev,
            "next"=>$next,
            "total"=> $total,
            "num_pages"=> ceil($total/$limit),
        ];
    }

    public function get($id=null){
        $page = $_GET['page'] ?? false;
        $limit = $_GET['limit'] ?? 10;
        $total = 0;

        if($page){
            $sql= $this->applyFilters($id, true);
        
            $total_products = $this->conexion->query($sql);
            $total=$total_products->fetch_column();
        }

        $sql= $this->applyFilters($id);
        if($page){
            $offset = $page > 1 ? $limit*($page - 1) : 0;
            $sql .= " LIMIT $limit OFFSET $offset";
        }

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

        if($id) return $data[0];

        return $this->returnData($data, $total);
    }

    public function post($datos){
        $data= json_decode(file_get_contents('php://input'), true);
        $product_code = 
        // $name_product=$data['name'];
        // $description_product=$data['description'];
        // $photo_product=$data['photo'];
        // $stock_product=$data['stock'];
        // $created_at=$data['created_at'];
        // $product_code=$data['product_code'];

        $sql="INSERT INTO products(`name`, `description`, photo, stock, created_at, product_code, price, iva) VALUES(?,?,?,?,?,?,?,?)";
        $response= $this->conexion->prepare($sql);
        $response->bind_param("ssssssss", $datos['name'], $datos['description'], $datos['photo'], $datos['stock'],$datos['created_at'], $datos['product_code'], $datos['price'], $datos['iva']);

       if ($response->execute()) {
        $lastId = $this->conexion->insert_id;
        $response->close();
        return $lastId; // 👈 DEVUELVE EL ID DEL PRODUCTO
        } else {
            return false;
        }
    }

    public function put($datos){
        $data= json_decode(file_get_contents('php://input'), true);
        // $name_product=$data['name'];
        // $description_product=$data['descripstion'];
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
                `price` = '{$datos['price']}',
                `iva` = '{$datos['iva']}'
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
