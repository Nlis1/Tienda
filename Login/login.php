<?php

if(isset($_POST["email"]) && isset($_POST["password"])){
    require_once(__DIR__ . '/../Controllers/LoginController.php');
    $login = new LoginController();

    echo $login->iniciar_sesion();
    exit();
}