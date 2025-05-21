<?php

require_once '../Models/ProductModel.php';
class ProductController extends ProductModel{
    public function consultar($id=null, $data){
        $page = $data['page'] ?? false;
        
        if($page)  return $this->paginador($page);

        $response = self::get($id);
        return json_encode($response);
    }
    
    public function paginador($page){
        $registros = 3;
        $page = intval($page);

        $inicio = ($page > 0) ? (($page*$registros)-$registros): 0;
        $prev = $page-1;
        $next = $page+1;
        
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM products LIMIT $inicio, $registros";
        $datos=$this->conexion->query($sql);

        $total = $this->conexion->query("SELECT FOUND_ROWS()");
        $total=$total->fetch_column();

        $Npaginas=ceil($total/$registros);

        $products=[];

         while($row = $datos->fetch_assoc()){
            $categories=[];

            $sql2 = "SELECT c.id , c.name FROM category_product as cp inner join categories as c on c.id = cp.category_id WHERE product_id=".$row['id'];
            $response= $this->conexion->query($sql2);

            while($fila = $response->fetch_assoc()){
                $categories[]=$fila;
            }

            $row['categories'] = $categories;
            $products[]=$row;
        }

        $response=[
            "products"=>$products,
            "page"=>$page,
            "per_page"=>$registros,
            "prev"=>$prev,
            "next"=>$next,
            "total"=>$total,
            "num_pages"=>$Npaginas,
        ];

        return json_encode($response);
    }

    public function insertar(){
        $name=$_POST['name_product'];
        $description=$_POST['description_product'];
        $photo=$_POST['photo_product'];
        $stock=$_POST['stock_product'];
        $created_at= date("Y-m-d H:i:s");
        $product_code=$_POST['product_code'];
        $price = $_POST['precio_product'];
 
        $datosProduct=[
            'name'=>$name,
            'description'=>$description,
            'photo'=>$photo,
            'stock'=>$stock,
            'created_at'=>$created_at,
            'product_code'=>$product_code,
            'price'=>$price,
        ];

        $response= self::post($datosProduct);

        if ($response) {
            if (isset($_POST['categories']) && is_array($_POST['categories'])) {
            $categorias = $_POST['categories'];
            $product_id = $this->conexion->insert_id;

            foreach ($categorias as $categoryId) {
                $categoryProduct = $categoryId;
            
                $sqlInsert = "INSERT INTO category_product (category_id, product_id) VALUES (?, ?)";
                $stmtInsert = $this->conexion->prepare($sqlInsert);
                $stmtInsert->bind_param("ii", $categoryProduct, $product_id);
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
        $code = $_POST['code_up'];
        $price = $_POST['price_up'];
        $updated_at = date("Y-m-d H:i:s");

        $datosProduct = [
            'id' => $id,
            'name' => $name,
            'photo' => $photo,
            'description' => $description,
            'stock' => $stock,
            'product_code' => $code,
            'updated_at'=>$updated_at,
            'price'=>$price
        ];


        $response= self::put($datosProduct);
        return json_encode($response);
    }

    public function eliminar($id){
        $response= self::delete($id);
        return json_encode($response);
    }
}