<?php

$server = "localhost"; 
$user = "root";
$pass = "";
$db = "tienda";

$conexion = new mysqli($server, $user, $pass, $db); 

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Configurar charset para evitar problemas con caracteres especiales
$conexion->set_charset("utf8mb4");
?>