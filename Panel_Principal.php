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