<?php
// Iniciar la sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay una sesión activa antes de destruirla
if (!empty($_SESSION)) {
    session_unset();             // Eliminar todas las variables de sesión
    session_destroy();           // Destruir la sesión

    // Eliminar la cookie de sesión
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
    }
}

// Evitar almacenamiento en caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirigir al usuario forzando la recarga de la página
echo '<script>
    sessionStorage.clear();  // Limpiar datos de la sesión en el navegador
    localStorage.clear();    // (Opcional) Limpiar almacenamiento local
    window.location.replace("../index.php"); // Reemplaza en el historial
</script>';
exit();
