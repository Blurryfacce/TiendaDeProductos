<?php
//Poner en variables
$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
$recordarme = isset($_POST['chkRecordarme']); 

if($recordarme) {
    //Crear cookies
    setcookie("c_usuario", $usuario, 0); 
    setcookie("c_clave", $clave, 0); 
    setcookie("c_recordarme", $recordarme, 0); 
    var_dump($_COOKIE);
} else {
    //Borrar cualquier cookie que exista
    if(isset($_COOKIE)){
        foreach($_COOKIE as $name => $value){
            setcookie($name, "", 1); // va a morir el 1 de enero de 1970 00:00:01 
        }
    }
}

?>


<html>
    <head></head>
    <body>
        <h1>Panel Principal</h1>
        <h2>Bienvenido usuario: <?php echo $usuario; ?></h2>
        <hr>
        <a href="borrarcookies.php?borrar=1">Borrar cookies y regresar</a>
        <br>
        <a href="borrarcookies.php?borrar=0">Regresar</a>
    </body>
</html>
