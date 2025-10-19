<?php
session_start();
//Poner en variables
$usuario = $_SESSION['usuario'];

//Restricciones de punto de acceso
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location:Login.php");
}

//Gestión de idioma desde cookie
if(!isset($_COOKIE['c_lang'])){
    setcookie("c_lang", 'es', 0);
}

//Conexion a la base de datos

//Datos de conexión
$host = 'localhost';
$user = 'root';
$clave = '';
$base_datos = 'tienda';
//Seleccionar tabla según idioma
if(isset($_COOKIE['c_lang']) && $_COOKIE['c_lang'] == 'en'){
    $table = 'productosen';
}else{
    $table = 'productoses';
}

$conexion = new mysqli($host, $user, $clave, $base_datos) or die($conexion->connection_error);
if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    die("No se ha proporcionado un ID de producto.");
}
$consulta = "SELECT * FROM $table WHERE id = $id";
$resulatodo = $conexion->query($consulta);

if($resulatodo && $resulatodo->num_rows > 0){
    $producto = $resulatodo->fetch_assoc();
}else{
    die("Producto no encontrado.");
}
$conexion->close();

//Agregar al carro de compras
if(isset($_POST['agregar_carro'])){
    if(!isset($_SESSION['carro'])){
        $_SESSION['carro'] = [];
    }
    // Agregar el producto al carro
    $_SESSION['carro'][] = $producto;
}
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

    <h2><?php echo ($producto['nombre']); ?></h2>
    <p><strong><?php echo ($_COOKIE['c_lang'] == 'es') ? 'ID' : 'ID'; ?>:</strong> <?php echo ($producto['id']); ?></p>
    <p><strong><?php echo ($_COOKIE['c_lang'] == 'es') ? 'Descripción' : 'Description'; ?>:</strong> <?php echo nl2br(htmlspecialchars($producto['descripcion'])); ?></p>
    <p><strong><?php echo ($_COOKIE['c_lang'] == 'es') ? 'Precio' : 'Price'; ?>:</strong> $<?php echo number_format($producto['precio'], 2); ?></p>

    <form method="post">
        <button type="submit" name="agregar_carro">Agregar al carro</button>
    </form>
    <hr>
    <a href="Panel_Principal.php">Panel Principal</a>
    <br>
    <a href="Carro_compra.php">Carro de compras</a>
    <br>
    <a href="Login.php?logout=true">Cerrar sesión</a>
</body>
</html>