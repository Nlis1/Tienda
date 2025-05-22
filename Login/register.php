<?php

if(isset($_POST["email"]) && isset($_POST["password"])){
    require_once(__DIR__ . '/../Controllers/LoginController.php');
    $insLogin = new LoginController();
    echo $insLogin->register(); // Esto debe retornar HTML o JSON
    exit();

} else {
    echo "error";
}