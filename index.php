<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once './parametros.php'; // Incluye la configuración global
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login.css">
    <title>Inicio</title>
</head>

<body>
    <div class="login-container">
        <h1>Bienvenido a Healthcare</h1>
        <p>Gestiona tu cuenta de forma sencilla</p>
        <div class="d-flex justify-content-center mt-4">
            <a href="<?php echo _URL; ?>php/login.php" class="btn btn-primary">Iniciar Sesión</a>
            <a href="<?php echo _URL; ?>php/register.php" class="btn btn-secondary">Registrarse</a>
        </div>
    </div>
</body>

</html>