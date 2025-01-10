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
// require_once '../controller/inicioController.php';


?>

<!------------------ Formulario para iniciar sesión -------------------------------->


<form action="../controller/inicioController.php" method="post">
    <h2>Iniciar Sesión</h2>
    <label for="correo_login"></label>
    <input type="text" name="correo" placeholder="&#128273; Correo electronico">
    <br>
    <label for="contraseña"></label>
    <input type="password" name="contraseña" placeholder="&#128274; contraseña" required>
    <br>
    <input type="submit" id="inicio_sesion" name="iniciar_sesion" value="Iniciar Sesión">

    <br>
    <a href="./register.php" style="float: right;">Registrarse</a>
</form>


<?php
/* require_once '../footer.php'; */
?>