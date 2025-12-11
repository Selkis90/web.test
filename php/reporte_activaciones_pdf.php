<?php
require_once '../librerias/tcpdf/tcpdf.php';
require_once '../conexion.php';

// Crear nuevo PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuración
$pdf->SetCreator('Sistema Activaciones');
$pdf->SetAuthor('Healthcare');
$pdf->SetTitle('Reporte de Activaciones');
$pdf->SetMargins(10, 20, 10);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->AddPage();

// Título
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'REPORTE DE ACTIVACIONES CON HISTORIAL', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('helvetica', '', 9);

// CONSULTA PRINCIPAL (activaciones)
$sql = "SELECT * FROM activaciones ORDER BY id DESC LIMIT 50";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {

    $activacion_id = $row['id'];

    // 🔵 Datos de actualización (últimos datos)
    $sqlDetalle = "SELECT * FROM actualizacion_activaciones WHERE activacion_id = $activacion_id LIMIT 1";
    $detalle = $conn->query($sqlDetalle)->fetch_assoc();

    // 🔵 Historial de seguimientos
    $sqlHistorial = "SELECT * FROM historial_seguimientos WHERE activacion_id = $activacion_id ORDER BY fecha_registro ASC";
    $historial = $conn->query($sqlHistorial);

    // Título de cada bloque
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->Cell(0, 8, "ACTIVACIÓN ID: " . $activacion_id, 0, 1, 'L');

    $pdf->SetFont('helvetica', '', 9);

    // 🔶 DATOS DE ACTIVACIÓN
    $html = '
    <h4>Datos de Activación</h4>
    <table border="1" cellpadding="4">
    <tbody>
        <tr><td><b>Fecha Activación</b></td><td>' . $row['fecha_activacion'] . '</td></tr>
        <tr><td><b>Trabajador</b></td><td>' . $row['trabajador'] . '</td></tr>
        <tr><td><b>Documento</b></td><td>' . $row['tipo_documento'] . ' - ' . $row['identificacion'] . '</td></tr>
        <tr><td><b>Ciudad</b></td><td>' . $row['ciudad'] . '</td></tr>
        <tr><td><b>Departamento</b></td><td>' . $row['departamento'] . '</td></tr>
        <tr><td><b>IPS</b></td><td>' . $row['ips'] . '</td></tr>
        <tr><td><b>Servicio Inicial</b></td><td>' . $row['servicio_prestado_inicial'] . '</td></tr>
        <tr><td><b>RLP</b></td><td>' . $row['rlp'] . '</td></tr>
        <tr><td><b>Medicamentos</b></td><td>' . $row['medicamentos'] . '</td></tr>
        <tr><td><b>Tipo Medicamento</b></td><td>' . $row['tipo_medicamento'] . '</td></tr>
        <tr><td><b>Empresa</b></td><td>' . $row['empresa'] . '</td></tr>
        <tr><td><b>N° Afiliación</b></td><td>' . $row['numero_afiliacion'] . '</td></tr>
        <tr><td><b>PAE</b></td><td>' . $row['pae'] . ' - ' . $row['tipo_pae'] . '</td></tr>
        <tr><td><b>Ubicación PAE</b></td><td>' . $row['ubicacion_pae'] . '</td></tr>
        <tr><td><b>Jornada</b></td><td>' . $row['jornada_activacion'] . '</td></tr>
        <tr><td><b>Presencial</b></td><td>' . $row['activacion_presencial'] . '</td></tr>
        <tr><td><b>Hora Caso</b></td><td>' . $row['hora_activacion_caso'] . '</td></tr>
        <tr><td><b>Hora PAE</b></td><td>' . $row['hora_activacion_pae'] . '</td></tr>
        <tr><td><b>Respuesta SACS</b></td><td>' . $row['tiempo_respuesta_sacs'] . '</td></tr>
        <tr><td><b>Llegada IPS</b></td><td>' . $row['hora_llegada_pae_ips'] . '</td></tr>
    </tbody>
    </table><br>
    ';

    $pdf->writeHTML($html, true, false, true, false, '');

    // 🔶 DATOS ACTUALIZADOS
    if ($detalle) {
        $html = '
        <h4>Datos Actualizados</h4>
        <table border="1" cellpadding="4">
        <tbody>
            <tr><td><b>Días IT Inicial</b></td><td>' . $detalle['dias_it_inicial'] . '</td></tr>
            <tr><td><b>Días IT Acumulado</b></td><td>' . $detalle['dias_it_acumulado'] . '</td></tr>
            <tr><td><b>PQR Evento Adverso</b></td><td>' . $detalle['pqr_evento_adverso'] . '</td></tr>
            <tr><td><b>Razón RLP No Exitoso</b></td><td>' . $detalle['razon_rlp_no_exitoso'] . '</td></tr>
            <tr><td><b>Medios Diagnósticos</b></td><td>' . $detalle['medios_diagnosticos'] . '</td></tr>
            <tr><td><b>DX Inicial</b></td><td>' . $detalle['dx_inicial'] . '</td></tr>
            <tr><td><b>DX CIE10</b></td><td>' . $detalle['dx_cie10'] . '</td></tr>
            <tr><td><b>Descripción CIE10</b></td><td>' . $detalle['descripcion_cie10'] . '</td></tr>
            <tr><td><b>Hora Fin Caso</b></td><td>' . $detalle['hora_finalizacion_caso'] . '</td></tr>
            <tr><td><b>Fecha Fin Caso</b></td><td>' . $detalle['fecha_finalizacion_caso'] . '</td></tr>
            <tr><td><b>Seguimiento Actual</b></td><td>' . nl2br($detalle['seguimiento']) . '</td></tr>
        </tbody>
        </table><br>
        ';
        $pdf->writeHTML($html, true, false, true, false, '');
    }

    // 🔵 HISTORIAL COMPLETO
    $html = '<h4>Historial de Seguimientos</h4>';

    if ($historial->num_rows == 0) {
        $html .= '<p><i>No hay seguimientos registrados.</i></p><br>';
    } else {
        $html .= '<table border="1" cellpadding="4"><thead>
            <tr style="background-color:#f2f2f2;">
                <th><b>Fecha</b></th>
                <th><b>Seguimiento</b></th>
            </tr>
        </thead><tbody>';

        while ($h = $historial->fetch_assoc()) {
            $html .= '
                <tr>
                    <td width="120">' . $h['fecha_registro'] . '</td>
                    <td>' . nl2br($h['seguimiento']) . '</td>
                </tr>';
        }

        $html .= '</tbody></table><br><br>';
    }

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdf->Ln(5);
}

// Salida del PDF
$pdf->Output('reporte_activaciones.pdf', 'I');
