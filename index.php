<?php
require_once './parametros.php'; // Incluye la configuración global
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Inicio</title>
</head>

<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Bienvenido a la aplicación</h1>
        <div class="d-flex justify-content-center">
            <!-- Enlaces usando la constante _URL para mantener rutas dinámicas -->
            <a href="<?php echo _URL; ?>php/login.php" class="btn btn-secondary">Iniciar Sesión</a>
            <hr>
            <a href="<?php echo _URL; ?>php/register.php" class="btn btn-primary me-2">Registrarse</a>

        </div>
    </div>

</body>

</html>