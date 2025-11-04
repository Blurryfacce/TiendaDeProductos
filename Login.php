<?php
$usuario = $clave = "";
$preferencias = false;
$idioma = "es"; // Por defecto español

session_start();
if(isset($_COOKIE['c_recordarme'])){
    $preferencias = true;
    $usuario = $_COOKIE['c_usuario'];
    $clave = $_COOKIE['c_clave'];
}

if(isset($_GET['logout'])){
    session_destroy();
    if(!isset($_COOKIE['c_recordarme'])){
        if(isset($_COOKIE)){
            foreach($_COOKIE as $name => $value){
                setcookie($name, "", 1);  
            }
        }
    }
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
            Idioma / Language:<br>
            <select name="idioma" id="idioma">
                <option value="es" <?php echo ($idioma == 'es') ? 'selected' : ''; ?>>Español</option>
                <option value="en" <?php echo ($idioma == 'en') ? 'selected' : ''; ?>>English</option>
            </select><br>
            <input type="checkbox" name="chkRecordarme" <?php echo $preferencias ? 'checked' : ''; ?>>Recuerdame<br>
            <input type="submit" value="Enviar">
        </fieldset>
    </form>
</body>
</html>