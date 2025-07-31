<?php

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../conexion.php'; // Conexión a la base de datos

// Validar y procesar datos del formulario
$id = isset($_POST['id']) ? (int) $_POST['id'] : 0; // ID de la fila a actualizar
$activacion_id = isset($_POST['activacion_id']) ? (int) $_POST['activacion_id'] : 0;

// Validar campos enteros
$dias_it_inicial = isset($_POST['dias_it_inicial']) && $_POST['dias_it_inicial'] !== '' ? (int) $_POST['dias_it_inicial'] : null;
$dias_it_acumulado = isset($_POST['dias_it_acumulado']) && $_POST['dias_it_acumulado'] !== '' ? (int) $_POST['dias_it_acumulado'] : null;

// Validar campos de texto
$pqr_evento_adverso = !empty($_POST['pqr_evento_adverso']) ? trim($_POST['pqr_evento_adverso']) : null;
$razon_rlp_no_exitoso = !empty($_POST['razon_rlp_no_exitoso']) ? trim($_POST['razon_rlp_no_exitoso']) : null;
$medios_diagnosticos = !empty($_POST['medios_diagnosticos']) ? trim($_POST['medios_diagnosticos']) : null;
$dx_inicial = !empty($_POST['dx_inicial']) ? trim($_POST['dx_inicial']) : null;

// Validar campos enteros para posibles códigos
$dx_cie10 = isset($_POST['dx_cie10']) && $_POST['dx_cie10'] !== '' ? (int) $_POST['dx_cie10'] : null;

// Validar campos de texto largos
$descripcion_cie10 = !empty($_POST['descripcion_cie10']) ? trim($_POST['descripcion_cie10']) : null;

// Validar campos de tiempo y fecha
$hora_finalizacion_caso = !empty($_POST['hora_finalizacion_caso']) ? date('H:i:s', strtotime($_POST['hora_finalizacion_caso'])) : null;
$fecha_finalizacion_caso = !empty($_POST['fecha_finalizacion_caso']) ? date('Y-m-d', strtotime($_POST['fecha_finalizacion_caso'])) : null;

// Validar seguimiento como texto
$seguimientos = isset($_POST['seguimiento']) ? $_POST['seguimiento'] : [];
$seguimiento_completo = is_array($seguimientos) ? implode("\n\n--------------------\n\n", array_map('trim', $seguimientos)) : null;

// Depuración: Verificar los datos procesados antes de la consulta
echo "<pre>";
echo "Datos procesados para la consulta:\n";
print_r([
    'id' => $id,
    'activacion_id' => $activacion_id,
    'dias_it_inicial' => $dias_it_inicial,
    'dias_it_acumulado' => $dias_it_acumulado,
    'pqr_evento_adverso' => $pqr_evento_adverso,
    'razon_rlp_no_exitoso' => $razon_rlp_no_exitoso,
    'medios_diagnosticos' => $medios_diagnosticos,
    'dx_inicial' => $dx_inicial,
    'dx_cie10' => $dx_cie10,
    'descripcion_cie10' => $descripcion_cie10,
    'hora_finalizacion_caso' => $hora_finalizacion_caso,
    'fecha_finalizacion_caso' => $fecha_finalizacion_caso,
    'seguimiento' => $seguimiento_completo,
]);
echo "</pre>";
// Elimina el exit cuando estés seguro de que los datos son correctos
// exit;

// Preparar la consulta SQL
$sql = "UPDATE actualizacion_activaciones SET 
    dias_it_inicial = ?, 
    dias_it_acumulado = ?, 
    pqr_evento_adverso = ?, 
    razon_rlp_no_exitoso = ?, 
    medios_diagnosticos = ?, 
    dx_inicial = ?, 
    dx_cie10 = ?, 
    descripcion_cie10 = ?, 
    hora_finalizacion_caso = ?, 
    fecha_finalizacion_caso = ?, 
    seguimiento = ?
    WHERE id = ?";

// Preparar la consulta
$stmt = $conexion->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}

// Vincular los parámetros con los valores procesados
$stmt->bind_param(
    "iisssssisssi",
    $dias_it_inicial,
    $dias_it_acumulado,
    $pqr_evento_adverso,
    $razon_rlp_no_exitoso,
    $medios_diagnosticos,
    $dx_inicial,
    $dx_cie10,
    $descripcion_cie10,
    $hora_finalizacion_caso,
    $fecha_finalizacion_caso,
    $seguimiento_completo,
    $id
);

// Ejecutar la consulta y verificar errores
if ($stmt->execute()) {
    // Redirigir al listado con mensaje de éxito
    header("Location: listar_casos.php?id=$activacion_id&success=1");
    exit;
} else {
    // Mostrar error si la consulta falla
    die("Error al ejecutar la consulta: " . $stmt->error);
}
?>