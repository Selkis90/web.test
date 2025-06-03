<?php
require_once '../conexion.php'; // Asegúrate de que esta conexión esté funcionando

// Obtener los filtros desde la URL (GET)
$cedula = isset($_GET['cedula']) ? trim($_GET['cedula']) : '';
$afiliacion = isset($_GET['afiliacion']) ? trim($_GET['afiliacion']) : '';

// Construir la consulta base
$sql = "SELECT trabajador, identificacion, numero_afiliacion FROM activaciones WHERE 1=1";

// Agregar filtros si existen
if (!empty($cedula)) {
    $cedula = $conexion->real_escape_string($cedula);
    $sql .= " AND identificacion LIKE '%$cedula%'";
}

if (!empty($afiliacion)) {
    $afiliacion = $conexion->real_escape_string($afiliacion);
    $sql .= " AND numero_afiliacion LIKE '%$afiliacion%'";
}

// Ejecutar la consulta
$resultado = $conexion->query($sql);

$casos = [];

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $casos[] = [
            'nombre' => $fila['trabajador'],
            'cedula' => $fila['identificacion'],
            'afiliacion' => $fila['numero_afiliacion'],
        ];
    }
}

// Devolver el resultado como JSON
header('Content-Type: application/json');
echo json_encode($casos);
?>
