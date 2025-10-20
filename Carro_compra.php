<?php
session_start();
//Poner en variables
$usuario = $_SESSION['usuario'];

//Restricciones de punto de acceso
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location:Login.php");
}

//verificar si el carro de compras existe
if(isset($_SESSION['carro']) && !empty($_SESSION['carro'])){
    $carro = $_SESSION['carro'];
} else {
    $mensaje = "El carro de compras está vacío.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carro de Commpras</title>
</head>
<body>
    <h2>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h2>
    <h1>Carro de Compras</h1>
    <ul>
    <?php
        if(!empty($carro)){
            foreach($carro as $item){
                echo "<li>" . htmlspecialchars($item['id']) . " - " . htmlspecialchars($item['nombre']) . " - " . htmlspecialchars($item['descripcion']) . " - " . htmlspecialchars($item['precio']) . "</li>";
            }
        }else{
            echo "<li>" . htmlspecialchars($mensaje) . "</li>";
        }
    ?>
    </ul>
    <hr>
    <a href="Panel_Principal.php">Panel Principal</a>
    <br>
    <a href="Carro_compra.php">Carro de compras</a>
    <br>
    <a href="Login.php?logout=true">Cerrar sesión</a>
</body>
</html>