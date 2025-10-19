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

// Procesar agregar al carrito
if(isset($_POST['agregar_carrito'])){
    $id_agregar = intval($_POST['id_producto']);
    
    // Si el producto ya está en el carrito, aumentar cantidad
    if(isset($_SESSION['carrito'][$id_agregar])){
        $_SESSION['carrito'][$id_agregar] += 1;
    } else {
        $_SESSION['carrito'][$id_agregar] = 1;
    }
    
    $mensaje = "Producto agregado al carrito exitosamente!";
}

// Conectar con la base de datos
require_once 'BDD/Conexion.php';

// Obtener el ID del producto
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Determinar idioma (de sesión, cookie o por defecto español)
$idioma = 'es';
if(isset($_SESSION['idioma'])){
    $idioma = $_SESSION['idioma'];
} elseif(isset($_COOKIE['c_idioma'])){
    $idioma = $_COOKIE['c_idioma'];
}

// Consultar los detalles del producto según idioma
if($idioma == 'en'){
    $sql = "SELECT id_producto, name as nombre, description as descripcion, price as precio, stock, code as codigo 
            FROM productosen WHERE id_producto = ? AND status = 'active'";
} else {
    $sql = "SELECT id_producto, nombre, descripcion, precio, stock, codigo 
            FROM productoses WHERE id_producto = ? AND estado = 'activo'";
}

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$resultado = $stmt->get_result();
$producto = $resultado->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
</head>
<body>
    <h2>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h2>
    <h1>Detalles del Producto</h1>
    
    <?php if(isset($mensaje)): ?>
        <p style="color: green;"><strong><?php echo $mensaje; ?></strong></p>
    <?php endif; ?>
    
    <?php if($producto): ?>
        <h2>ID: <?php echo $producto['id_producto']; ?></h2>
        <h2>Nombre: <?php echo htmlspecialchars($producto['nombre']); ?></h2>
        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['descripcion']); ?></p>
        <p><strong>Precio:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>
        <p><strong>Código:</strong> <?php echo htmlspecialchars($producto['codigo']); ?></p>
        <p><strong>Stock:</strong> <?php echo $producto['stock']; ?> unidades</p>
        
        <form method="POST" action="">
            <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
            <button type="submit" name="agregar_carrito">Agregar al carro</button>
        </form>
    <?php else: ?>
        <p style="color: red;">Producto no encontrado o no disponible.</p>
    <?php endif; ?>
    
    <?php 
    $stmt->close();
    $conexion->close(); 
    ?>

    <hr>
    <a href="Panel_Principal.php">Panel Principal</a>
    <br>
    <a href="Carro_compra.php">Carro de compras</a>
    <br>
    <a href="Login.php">Cerrar sesión</a>
</body>
</html>