<?php
session_start();

// Evitar almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Si el usuario ya ha iniciado sesión, redirigir a la página principal
if (isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        <form action="../controller/inicioController.php" method="post">
            <input type="text" name="correo" placeholder="&#128273; Correo electrónico" required>
            <br>
            <input type="password" name="contraseña" placeholder="&#128274; Contraseña" required>
            <br>
            <input type="submit" id="inicio_sesion" name="iniciar_sesion" value="Iniciar Sesión" class="btn-Tertiary">
            <br>
            <a href="./register.php" class="btn-Quaternary">Registrarse</a>
        </form>
    </div>

</body>

</html>