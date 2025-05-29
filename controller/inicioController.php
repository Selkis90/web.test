<?php
session_start();
require_once '../conexion.php';

/* ✅ Controller para registrarse */
if (isset($_POST['registrarse'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];
    $rol = $_POST['rol']; // ✅ Se agregó el campo rol

    // Verificar si el correo ya está registrado
    $sql_verificar = "SELECT id FROM usuarios WHERE correo = ?";
    $stmt_verificar = $conexion->prepare($sql_verificar);
    $stmt_verificar->bind_param("s", $correo);
    $stmt_verificar->execute();
    $resultado_verificar = $stmt_verificar->get_result();

    if ($resultado_verificar->num_rows > 0) {
        // Si el correo ya existe, redirigir con mensaje de error
        header("Location: ../php/register.php?error=correo_existente");
        exit();
    }

    // Verificar si las contraseñas coinciden
    if ($contraseña !== $confirmar_contraseña) {
        header("Location: ../php/register.php?error=contrasenas_no_coinciden");
        exit();
    }

    // Si pasa todas las validaciones, registrar el usuario
    $contraseña_hashed = password_hash($contraseña, PASSWORD_DEFAULT);
    $fecha_registro = date('Y-m-d H:i:s');

    // ✅ Se corrigió el campo `rol_id` en el insert
    $sql_insert = "INSERT INTO usuarios (nombre, correo, telefono, contraseña, fecha_registro, rol_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bind_param("ssssss", $nombre, $correo, $telefono, $contraseña_hashed, $fecha_registro, $rol);

    if ($stmt_insert->execute()) {
        header("Location: ../php/register.php?success=registro_exitoso");
    } else {
        header("Location: ../php/register.php?error=registro_fallido");
    }

    exit();
}

/* ✅ Controller para iniciar sesión */
if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // ✅ Se corrigió el campo `rol_id` con alias para mantener la lógica actual
    $sql = "SELECT id, nombre, contraseña, rol_id AS rol FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();

        // Verificar la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // ✅ Establecer sesión correctamente
            $_SESSION['usuario'] = true;
            $_SESSION['nombre'] = $usuario['nombre']; // Almacenar nombre en sesión
            $_SESSION['id'] = $usuario['id'];         // Almacenar ID en sesión
            $_SESSION['rol'] = $usuario['rol'];       // ✅ Almacenar rol_id en sesión

            // ✅ Redirección según el rol_id
            if ($usuario['rol'] == 1) {
                header("Location: ../php/menu.php"); // ADMINISTRADOR
            } elseif ($usuario['rol'] == 2) {
                header("Location: ../php/menuPae.php"); // PAE
            } else {
                header("Location: ../php/login.php?error=rol_no_valido");
            }
            exit();
        } else {
            header("Location: ../php/login.php?error=contraseña_incorrecta");
            exit();
        }
    } else {
        header("Location: ../php/login.php?error=usuario_no_encontrado");
        exit();
    }
}
