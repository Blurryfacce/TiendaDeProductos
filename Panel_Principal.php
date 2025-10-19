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
        $_SESSION['usuario'] = $_POST["usuario"];
        $_SESSION['clave'] = $_POST["clave"];
    }else{
        header("Location:Login.php");
    }
}

//Restricciones de punto de acceso
if(!isset($_SESSION['usuario']) || !isset($_SESSION['clave'])){
    header("Location:Login.php");
}
?>


<html>
    <head></head>
    <body>
        <h1>Panel Principal</h1>
        <h2>Bienvenido usuario: <?php echo $_SESSION['usuario']; ?></h2>
        <hr>
        <a href="Panel_Principal.php">Panel Principal</a>
        <br>
        <a href="Carro_compra.php">Carro de compras</a>
        <br>
        <a href="Login.php">Cerrar sesión</a>
    </body>
</html>
