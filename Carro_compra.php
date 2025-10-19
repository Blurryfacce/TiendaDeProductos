<?php
session_start();

//Restricciones de punto de acceso
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location:Login.php");
    exit;
}

// Inicializar el carrito si no existe
if(!isset($_SESSION['carrito'])){
    $_SESSION['carrito'] = array();
}

// Conectar con la base de datos
require_once 'BDD/Conexion.php';

// Determinar idioma (de sesión, cookie o por defecto español)
$idioma = 'es';
if(isset($_SESSION['idioma'])){
    $idioma = $_SESSION['idioma'];
} elseif(isset($_COOKIE['c_idioma'])){
    $idioma = $_COOKIE['c_idioma'];
}

// Obtener detalles de los productos en el carrito según idioma
$productos_carrito = array();

if(!empty($_SESSION['carrito'])){
    $ids = array_keys($_SESSION['carrito']);
    $ids_string = implode(',', array_map('intval', $ids));
    
    // Seleccionar tabla según idioma
    if($idioma == 'en'){
        $sql = "SELECT id_producto, name as nombre, description as descripcion, price as precio, stock, code as codigo 
                FROM productosen WHERE id_producto IN ($ids_string) AND status = 'active'";
    } else {
        $sql = "SELECT id_producto, nombre, descripcion, precio, stock, codigo 
                FROM productoses WHERE id_producto IN ($ids_string) AND estado = 'activo'";
    }
    
    $resultado = $conexion->query($sql);
    
    while($producto = $resultado->fetch_assoc()){
        $producto['cantidad'] = $_SESSION['carrito'][$producto['id_producto']];
        $productos_carrito[] = $producto;
    }
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
    
    <?php if(!empty($productos_carrito)): ?>
        <ul>
            <?php foreach($productos_carrito as $producto): ?>
                <li>
                    <strong><?php echo htmlspecialchars($producto['nombre']); ?></strong> - 
                    Precio: $<?php echo number_format($producto['precio'], 2); ?> - 
                    Cantidad: <?php echo $producto['cantidad']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tu carrito está vacío</p>
    <?php endif; ?>
    
    <?php $conexion->close(); ?>
    
    <hr>
    <a href="Panel_Principal.php">Panel Principal</a>
    <br>
    <a href="Carro_compra.php">Carro de compras</a>
    <br>
    <a href="Login.php">Cerrar sesión</a>
</body>
</html>