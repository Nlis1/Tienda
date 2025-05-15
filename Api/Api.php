<?php

require_once '../Controllers/ProductController.php';

header('Content-Type: application/json');

$metodo= $_SERVER['REQUEST_METHOD'];

if ($metodo === 'POST' && isset($_POST['_method'])) {
    $metodo = strtoupper($_POST['_method']);
}

$path=isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
$params = substr($path,1);

$explode = explode("/", $params);

$nameController = ucfirst($explode[0])."Controller";
$id= $explode[1] ?? null;

switch($metodo){
    case 'GET':
        $controller = new $nameController();
        echo $controller->consultar($id);
        break;
    case 'POST':
        $controller = new $nameController();
        echo $controller->insertar();
        break;
    case 'PUT':
        $controller = new $nameController();
        echo $controller->actualizar();
        break;
    case 'DELETE':
        $controller = new $nameController();
        echo $controller->eliminar($id);
        break;
    default:
        echo 'Metodo no permitido';
        break;   
}

