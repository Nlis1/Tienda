<?php
var_dump('si');

session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
// exit();