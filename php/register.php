<?php
require_once '../conexion.php';
require_once '../controller/inicioController.php';

?>

<!---------------  Formulario para realizar el registro de personas a la base de datos  ---------------->

<!-- <h3>Ingrese los datos del formulario para registrarse como usuario.</h3> -->

<form action="../controller/inicioController.php" method="post">
    <h2>Registrarse</h2>
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" placeholder="&#129706; Nombre" required>
    <br>
    <label for="correo">Correo electrónico</label>
    <input type="email" name="correo" placeholder="&#128273; Correo electrónico" required>
    <br>
    <label for="telefono">Teléfono</label>
    <input type="number" name="telefono" placeholder="&#128273; Teléfono" required>
    <br>
    <label for="contraseña">Contraseña</label>
    <input type="password" name="contraseña" placeholder="&#128274; Contraseña" required>
    <br>
    <label for="confirmar_contraseña">Confirmar contraseña</label>
    <input type="password" name="confirmar_contraseña" placeholder="&#128274; Confirmar contraseña" required>
    <br>
    <input type="submit" name="registrarse" value="Registrarse">
    <br>
    <a href="./login.php" style="float: right;">Inicio</a>
</form>


<?php
/* include("../footer.php"); */
?>