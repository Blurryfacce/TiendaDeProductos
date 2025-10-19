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
        setcookie("c_usuario", $usuario, 0); 
        setcookie("c_clave", $clave, 0); 
        setcookie("c_recordarme", $recordarme, 0); 
        //var_dump($_COOKIE);
    }else {
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
    <ul>
        <li><a href="Producto.php?id=1">Producto 1</a></li>
        <li><a href="Producto.php?id=2">Producto 2</a></li>
        <li><a href="Producto.php?id=3">Producto 3</a></li>
        <li><a href="Producto.php?id=4">Producto 4</a></li>
        <li><a href="Producto.php?id=5">Producto 5</a></li>
        <li><a href="Producto.php?id=6">Producto 6</a></li>
        <li><a href="Producto.php?id=7">Producto 7</a></li>
        <li><a href="Producto.php?id=8">Producto 8</a></li>
        <li><a href="Producto.php?id=9">Producto 9</a></li>
    </ul>
    <hr>
    <a href="Panel_Principal.php">Panel Principal</a>
    <br>
    <a href="Carro_compra.php">Carro de compras</a>
    <br>
    <a href="Login.php">Cerrar sesión</a>
</body>
</html>