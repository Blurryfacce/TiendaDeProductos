<?php
//Iniciar sesión
session_start();
//Procesar si estoy llegando del formulario
if(isset($_POST['usuario']) && isset($_POST['clave'])){
    //Poner en variables
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $recordarme = isset($_POST['chkRecordarme']);

    if($recordarme) {
        //Crear cookies
        setcookie("c_usuario", $usuario, time() + (86400 * 30), "/");
        setcookie("c_clave", $clave, time() + (86400 * 30), "/");
        setcookie("c_recordarme", $recordarme, time() + (86400 * 30), "/");
        if(!isset($_COOKIE['c_lang'])){
            setcookie("c_lang", 'es', 0);
        }
    }else {
        //Borrar cookies de usuario y contraseña (mantener idioma)
        setcookie("c_usuario", "", 1, "/");
        setcookie("c_clave", "", 1, "/");
        setcookie("c_recordarme", "", 1, "/");
    }

    if($_POST["usuario"] =="test" && $_POST["clave"]=="test123"){
        //Almacenar usuario en sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['clave'] = $clave;
        $_SESSION['idioma'] = $idioma;
    }else{
        //Borrar cualquier cookie que exista
        if(isset($_COOKIE)){
            foreach($_COOKIE as $name => $value){
                setcookie($name, "", 1);  
            }
        }
    }

     if($_POST["usuario"] =="test" && $_POST["clave"]=="test123"){
        //Almacenar usuario en sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['clave'] = $clave;
        //Inicializar carro de compras
        if(!isset($_SESSION['carro'])){
            $_SESSION['carro'] = [];
        }
    }else{
        header("Location:Login.php");
    }
}
//Restricciones de punto de acceso
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location:Login.php");
}
//Gestión de idioma
if(isset($_GET['lang'])){
    setcookie("c_lang", $_GET['lang'], 0); 
    $_COOKIE['c_lang'] = $_GET['lang']; // Para que la cookie esté disponible de inmediato
}elseif(!isset($_COOKIE['c_lang'])){
    setcookie("c_lang", 'es', 0); 
    $_COOKIE['c_lang'] = 'es'; // Para que la cookie esté disponible de inmediato
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
$productos = [];

$conexion = new mysqli($host, $user, $clave, $base_datos) or die($conexion->connection_error);
$consulta = "SELECT id, nombre FROM $table";
$resulatodo = $conexion->query($consulta);
if($resulatodo && $resulatodo->num_rows > 0){
    while($fila = $resulatodo->fetch_assoc()){
        $productos[] = [
            'id' => $fila['id'],
            'nombre' => $fila['nombre']
        ];
    }
}else{
    echo "No hay productos disponibles.";
}
$conexion->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Principal</title>
</head>
<body>
    <h1>Panel Principal</h1>
    <h2>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h2>
    <hr>
    
    <h2>Lista de Productos:</h2>
    <?php if($resultado && $resultado->num_rows > 0): ?>
        <ul>
            <?php while($producto = $resultado->fetch_assoc()): ?>
                <li class="producto-item">
                    <a href="Producto.php?id=<?php echo $producto['id_producto']; ?>">
                        <?php echo htmlspecialchars($producto['nombre']); ?>
                    </a>
                    <span class="precio">- $<?php echo number_format($producto['precio'], 2); ?></span>
                    <span class="stock">(Stock: <?php echo $producto['stock']; ?>)</span>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
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