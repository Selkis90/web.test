<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();


require_once '../conexion.php';

/* controller para registrarse */

if (isset($_POST['registrarse'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    if ($contraseña === $confirmar_contraseña) {
        $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);
        $fecha_registro = date('Y-m-d H:i:s');

        $sql = "INSERT INTO usuarios (nombre, correo, telefono, contraseña, fecha_registro) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssss", $nombre, $correo, $telefono, $contraseña_hashed, $fecha_registro);

        if ($stmt->execute()) {
            echo "Registro exitoso";
        } else {
            echo "Error al registrar: " . $conexion->error;
        }
    } else {
        echo "Las contraseñas no coinciden";
    }
}

/* controller para login */

if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Proceso cuando el usuario y contraseña SI son correctos:
        if (password_verify($contraseña, $usuario['contraseña'])) {

            var_dump($_SESSION);

            // crear la variable de sesión que se podrá verififcar desde cualquier lugar
            $_SESSION['usuario'] = true;

            echo "Inicio de sesión exitoso";

            var_dump($_SESSION);

            // exit;

            // Redirigir al usuario o establecer sesión
            header("Location:../php/menu.php");
        } else {
            // Proceso cuando NO son correctos los datos

            // Anular la variable de sesion
            $_SESSION['usuario'] = false;

            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }


}
