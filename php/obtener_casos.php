<?php
require_once '../conexion.php'; // Asegúrate de que esta conexión esté funcionando

$cedula = isset($_GET['cedula']) ? trim($_GET['cedula']) : '';
$afiliacion = isset($_GET['afiliacion']) ? trim($_GET['afiliacion']) : '';

$sql = "SELECT id, trabajador, identificacion, numero_afiliacion FROM activaciones WHERE 1=1";

if (!empty($cedula)) {
    $cedula = $conexion->real_escape_string($cedula);
    $sql .= " AND identificacion LIKE '%$cedula%'";
}

if (!empty($afiliacion)) {
    $afiliacion = $conexion->real_escape_string($afiliacion);
    $sql .= " AND numero_afiliacion LIKE '%$afiliacion%'";
}

$resultado = $conexion->query($sql);
$casos = [];

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $casos[] = [
            'id' => $fila['id'], // Se necesita en el JS
            'nombre' => $fila['trabajador'],
            'cedula' => $fila['identificacion'],
            'afiliacion' => $fila['numero_afiliacion'],
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($casos);
?>
