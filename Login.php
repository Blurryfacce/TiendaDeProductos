<?php
$usuario = $clave = "";
$preferencias = false;

session_start();
if(isset($_COOKIE['c_recordarme'])){
    $preferencias = true;
    $usuario = $_COOKIE['c_usuario'];
    $clave = $_COOKIE['c_clave'];
}

if(isset($_GET['logout'])){
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <form action="Panel_Principal.php" method="post">
        <fieldset>
            Usuario:<br>
            <input type="text" name="usuario" value="<?php echo $usuario; ?>" id=""><br>
            Clave:<br>
            <input type="password" name="clave" value="<?php echo $clave; ?>" id=""><br>
            <input type="checkbox" name="chkRecordarme" <?php echo $preferencias ? 'checked' : ''; ?>>Recuerdame<br>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</body>
</html>