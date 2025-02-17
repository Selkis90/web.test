<?php
// Activar la visualización de errores (solo en desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configurar parámetros de seguridad para la sesión antes de iniciarla
session_set_cookie_params([
    'lifetime' => 0, // La sesión expira cuando el navegador se cierra
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on', // Solo en HTTPS
    'httponly' => true, // Evita acceso de JavaScript a las cookies
    'samesite' => 'Strict' // Evita envío de cookies en solicitudes de terceros
]);

// Iniciar sesión solo si no ha sido iniciada previamente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}
