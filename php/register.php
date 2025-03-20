<?php
session_start();

// Evitar caché para mayor seguridad
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Si el usuario ya ha iniciado sesión, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

// Incluir archivos necesarios
require_once '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>

    <div class="login-container">
        <h1>Registrarse</h1>

        <!-- Mensajes de error y éxito -->
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "correo_existente") {
                echo "<p style='color: red; font-weight: bold;'>❌ El correo ya está registrado. Intente con otro.</p>";
            } elseif ($_GET['error'] == "contrasenas_no_coinciden") {
                echo "<p style='color: red; font-weight: bold;'>❌ Las contraseñas no coinciden.</p>";
            } elseif ($_GET['error'] == "registro_fallido") {
                echo "<p style='color: red; font-weight: bold;'>❌ Error al registrar. Inténtelo de nuevo.</p>";
            }
        }

        if (isset($_GET['success'])) {
            if ($_GET['success'] == "registro_exitoso") {
                echo "<p style='color: green; font-weight: bold;'>✅ Registro exitoso. ¡Ahora puede iniciar sesión!</p>";
            }
        }
        ?>

        <form action="../controller/inicioController.php" method="post">
            <div class="input-group">
                <input type="text" name="nombre" placeholder="Nombre" class="input-field" required>
            </div>

            <div class="input-group">
                <input type="email" name="correo" placeholder="Correo electrónico" class="input-field" required>
            </div>

            <div class="input-group">
                <input type="number" name="telefono" placeholder="Teléfono" class="input-field" required>
            </div>

            <div class="input-group">
                <input type="password" name="contraseña" placeholder="Contraseña" class="input-field" required>
            </div>

            <div class="input-group">
                <input type="password" name="confirmar_contraseña" placeholder="Confirmar contraseña" class="input-field" required>
            </div>

            <button type="submit" name="registrarse" class="btn-Tertiary">Registrarse</button>
            <a href="./login.php" class="btn-Quaternary">Inicio</a>
        </form>
    </div>

</body>

</html>