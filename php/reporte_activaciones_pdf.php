<?php
require_once '../librerias/tcpdf/tcpdf.php';
require_once '../conexion.php'; // Ajusta si tu ruta de conexión es distinta

// Crear nuevo PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configuraciones
$pdf->SetCreator('Sistema Activaciones');
$pdf->SetAuthor('Healthcare');
$pdf->SetTitle('Reporte de Activaciones');
$pdf->SetSubject('Activaciones');
$pdf->SetKeywords('PDF, reporte, activaciones');

// Márgenes y fuente
$pdf->SetMargins(10, 20, 10);
$pdf->SetAutoPageBreak(TRUE, 15);
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage();

// Título
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 10, 'REPORTE DE ACTIVACIONES', 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 8);

// Cabecera de tabla
$html = '
<table border="1" cellpadding="4">
<thead style="background-color:#f2f2f2;">
<tr>
    <th><b>ID</b></th>
    <th><b>Fecha</b></th>
    <th><b>Trabajador</b></th>
    <th><b>Documento</b></th>
    <th><b>Identificación</b></th>
    <th><b>Ciudad</b></th>
    <th><b>Departamento</b></th>
    <th><b>IPS</b></th>
    <th><b>Servicio</b></th>
    <th><b>RLP</b></th>
    <th><b>Medicamentos</b></th>
    <th><b>Tipo Med.</b></th>
    <th><b>Empresa</b></th>
    <th><b>Afiliación</b></th>
    <th><b>PAE</b></th>
    <th><b>Tipo PAE</b></th>
    <th><b>Ubicación PAE</b></th>
    <th><b>Jornada</b></th>
    <th><b>Presencial</b></th>
    <th><b>Hora Caso</b></th>
    <th><b>Hora PAE</b></th>
    <th><b>Respuesta SACS</b></th>
    <th><b>Llegada IPS</b></th>
</tr>
</thead>
<tbody>
';

// Consulta de datos
$sql = "SELECT * FROM activaciones LIMIT 50"; // Limita para evitar sobrecargar
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['fecha_activacion'] . '</td>
        <td>' . $row['trabajador'] . '</td>
        <td>' . $row['tipo_documento'] . '</td>
        <td>' . $row['identificacion'] . '</td>
        <td>' . $row['ciudad'] . '</td>
        <td>' . $row['departamento'] . '</td>
        <td>' . $row['ips'] . '</td>
        <td>' . $row['servicio_prestado_inicial'] . '</td>
        <td>' . $row['rlp'] . '</td>
        <td>' . $row['medicamentos'] . '</td>
        <td>' . $row['tipo_medicamento'] . '</td>
        <td>' . $row['empresa'] . '</td>
        <td>' . $row['numero_afiliacion'] . '</td>
        <td>' . $row['pae'] . '</td>
        <td>' . $row['tipo_pae'] . '</td>
        <td>' . $row['ubicacion_pae'] . '</td>
        <td>' . $row['jornada_activacion'] . '</td>
        <td>' . $row['activacion_presencial'] . '</td>
        <td>' . $row['hora_activacion_caso'] . '</td>
        <td>' . $row['hora_activacion_pae'] . '</td>
        <td>' . $row['tiempo_respuesta_sacs'] . '</td>
        <td>' . $row['hora_llegada_pae_ips'] . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Imprimir contenido
$pdf->writeHTML($html, true, false, true, false, '');

// Salida
$pdf->Output('reporte_activaciones.pdf', 'I');
