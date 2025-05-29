<?php
// Configuración de la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "healthcare_db";

// Crear conexión
$conexion = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conexion->connect_errno) {
    // Registra el error en lugar de mostrarlo en producción
    error_log("Error de conexión a MySQL: " . $mysqli->connect_error);
    die("Error al conectar con la base de datos. Por favor, intenta más tarde.");
}

// Aquí puedes añadir tu lógica para interactuar con la base de datos

