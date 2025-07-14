<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../conexion.php';

$id = $_POST['id'];
$activacion_id = $_POST['activacion_id'];
$dias_it_inicial = $_POST['dias_it_inicial'];
$dias_it_acumulado = $_POST['dias_it_acumulado'];
$pqr_evento_adverso = $_POST['pqr_evento_adverso'];
$razon_rlp_no_exitoso = $_POST['razon_rlp_no_exitoso'];
$medios_diagnosticos = $_POST['medios_diagnosticos'];
$dx_inicial = $_POST['dx_inicial'];
$dx_cie10 = $_POST['dx_cie10'];
$descripcion_cie10 = $_POST['descripcion_cie10'];
$hora_finalizacion_caso = $_POST['hora_finalizacion_caso'];
$fecha_finalizacion_caso = $_POST['fecha_finalizacion_caso'];

$seguimientos = $_POST['seguimiento'];
$seguimiento_completo = implode("\n\n--------------------\n\n", array_map('trim', $seguimientos));

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

$stmt = $conexion->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conexion->error);
}

$stmt->bind_param(
    "iisssssssssi",
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


if ($stmt->execute()) {
    header("Location: editar_actualizacion.php?id=$activacion_id&success=1");
    exit;
} else {
    die("Error al ejecutar la consulta: " . $stmt->error);
}
?>
