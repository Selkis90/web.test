<?php
require_once '../librerias/tcpdf/tcpdf.php';
require_once '../conexion.php';

if (!isset($_GET['id'])) {
    die("ID no proporcionado.");
}

$id = intval($_GET['id']);

// =========================
// OBTENER DATOS PRINCIPALES
// =========================
$sql = "SELECT * FROM activaciones WHERE id = $id";
$caso = $conexion->query($sql)->fetch_assoc();

if (!$caso) {
    die("Caso no encontrado.");
}

// =========================
// OBTENER ACTUALIZACIÓN
// =========================
$sql2 = "SELECT * FROM actualizacion_activaciones WHERE activacion_id = $id LIMIT 1";
$actualizacion = $conexion->query($sql2)->fetch_assoc();

// =========================
// OBTENER HISTORIAL COMPLETO
// =========================
$sql3 = "SELECT * FROM seguimiento_historial WHERE activacion_id = $id ORDER BY fecha_registro ASC";

$historial = $conexion->query($sql3);

// =========================
// CREAR PDF
// =========================
$pdf = new TCPDF();
$pdf->SetCreator('Sistema Healthcare');
$pdf->SetAuthor('Healthcare');
$pdf->SetTitle('Reporte Detallado del Caso');
$pdf->SetMargins(10, 20, 10);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->AddPage();
$pdf->SetFont("helvetica", "", 9);

// =========================
// ESTILOS
// =========================
$estilos = '
<style>
th {
    background-color:#f2f2f2;
    font-weight:bold;
    padding:5px;
    font-size:10px;
}
td {
    padding:5px;
    font-size:9px;
}
.section-title {
    font-size:12px;
    font-weight:bold;
    margin-top:8px;
    margin-bottom:4px;
}
</style>
';

// =========================
// SECCIÓN: DATOS DEL CASO
// =========================
$html = $estilos . '
<h2 class="section-title">Datos del Caso</h2>
<table border="1" cellpadding="4">
<tr><th>ID</th><td>' . $caso["id"] . '</td></tr>
<tr><th>Fecha Activación</th><td>' . $caso["fecha_activacion"] . '</td></tr>
<tr><th>Trabajador</th><td>' . $caso["trabajador"] . '</td></tr>
<tr><th>Identificación</th><td>' . $caso["tipo_documento"] . ' - ' . $caso["identificacion"] . '</td></tr>
<tr><th>Ciudad</th><td>' . $caso["ciudad"] . '</td></tr>
<tr><th>Departamento</th><td>' . $caso["departamento"] . '</td></tr>
<tr><th>IPS</th><td>' . $caso["ips"] . '</td></tr>
<tr><th>Servicio Inicial</th><td>' . $caso["servicio_prestado_inicial"] . '</td></tr>
<tr><th>Empresa</th><td>' . $caso["empresa"] . '</td></tr>
<tr><th>Afiliación</th><td>' . $caso["numero_afiliacion"] . '</td></tr>
<tr><th>PAE</th><td>' . $caso["pae"] . ' - ' . $caso["tipo_pae"] . '</td></tr>
<tr><th>Ubicación PAE</th><td>' . $caso["ubicacion_pae"] . '</td></tr>
<tr><th>Jornada</th><td>' . $caso["jornada_activacion"] . '</td></tr>
<tr><th>Presencial</th><td>' . $caso["activacion_presencial"] . '</td></tr>
</table>
';

$pdf->writeHTML($html, true, false, true, false, "");

// =========================
// SECCIÓN: DATOS ACTUALIZADOS
// =========================
if ($actualizacion) {

    $html = $estilos . '
<h2 class="section-title">Datos Actualizados</h2>
<table border="1" cellpadding="4">
<tr><th>Días IT Inicial</th><td>' . $actualizacion["dias_it_inicial"] . '</td></tr>
<tr><th>Días IT Acumulado</th><td>' . $actualizacion["dias_it_acumulado"] . '</td></tr>
<tr><th>PQR Evento Adverso</th><td>' . $actualizacion["pqr_evento_adverso"] . '</td></tr>
<tr><th>Razón RLP No Exitoso</th><td>' . $actualizacion["razon_rlp_no_exitoso"] . '</td></tr>
<tr><th>Medios Diagnósticos</th><td>' . $actualizacion["medios_diagnosticos"] . '</td></tr>
<tr><th>DX Inicial</th><td>' . $actualizacion["dx_inicial"] . '</td></tr>
<tr><th>CIE10</th><td>' . $actualizacion["dx_cie10"] . '</td></tr>
<tr><th>Descripción CIE10</th><td>' . nl2br($actualizacion["descripcion_cie10"]) . '</td></tr>
<tr><th>Hora Fin Caso</th><td>' . $actualizacion["hora_finalizacion_caso"] . '</td></tr>
<tr><th>Fecha Fin Caso</th><td>' . $actualizacion["fecha_finalizacion_caso"] . '</td></tr>
<tr><th>Seguimiento Actual</th><td>' . nl2br($actualizacion["seguimiento"]) . '</td></tr>
</table>
';

    $pdf->writeHTML($html, true, false, true, false, "");
}

// =========================
// SECCIÓN: HISTORIAL COMPLETO
// =========================
$html = $estilos . '<h2 class="section-title">Historial de Seguimientos</h2>';

if ($historial->num_rows == 0) {
    $html .= "<p><i>No hay seguimientos registrados.</i></p>";
} else {
    $html .= '<table border="1" cellpadding="4">
                <tr>
                    <th width="120">Fecha Registro</th>
                    <th>Seguimiento</th>
                </tr>';
    while ($h = $historial->fetch_assoc()) {
        $html .= '
        <tr>
            <td>' . $h["fecha_registro"] . '</td>
            <td>' . nl2br($h["seguimiento"]) . '</td>
        </tr>';
    }
    $html .= '</table>';
}

$pdf->writeHTML($html, true, false, true, false, "");


// =========================
// SALIDA
// =========================
$pdf->Output("reporte_detallado_caso_$id.pdf", "I");
