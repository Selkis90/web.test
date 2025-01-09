<?php
// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si la sesión tiene datos antes de destruirla
if (!empty($_SESSION)) {
    // Destruir todas las variables de sesión
    session_unset();

    // Regenerar el ID de sesión para mayor seguridad
    session_regenerate_id(true);

    // Destruir la sesión
    session_destroy();
}

// Evitar el almacenamiento en caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirigir al archivo de inicio de sesión
header("Location: ../index.php");
exit();
