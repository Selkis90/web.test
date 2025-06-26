<?php
// Incluye la clase TCPDF
require_once '../librerias/tcpdf/tcpdf.php';

// Subclase para personalizar cabecera, pie de página y fondo
class MYPDF extends TCPDF {
    public function Header() {
    // Ruta de la imagen (usa la ruta temporal del archivo subido)
    $image_file = '/var/www/web.test/images/fondopdf.jpeg';

    // Ajustar imagen al tamaño completo de la página (A4: 210mm x 297mm)
    $this->Image($image_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0); // Ajuste solo por ancho


    // Superponer un fondo blanco semitransparente
    $this->SetAlpha(0.3);
    $this->Rect(0, 0, $this->getPageWidth(), $this->getPageHeight(), 'F', '', [255, 255, 255]);
    $this->SetAlpha(1);

    // Título del encabezado
        $this->SetY(10);
    $this->SetFont('helvetica', 'B', 14);
    $this->SetTextColor(0, 0, 0);
    $this->Cell(0, 15, 'Reporte de Activaciones - Detalle por Persona', 0, false, 'C', 0, '', 0, false, 'M', 'M');

}

}

// Crear el documento PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator('Sistema Healthcare');
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Reporte Activaciones');
$pdf->SetSubject('Reporte generado con TCPDF');
$pdf->SetKeywords('TCPDF, PDF, reporte, activaciones');

// Márgenes y configuración
$pdf->SetMargins(10, 30, 10);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(15);
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetFont('helvetica', '', 8);

// Dividir datos en secciones
$sections = [
    "Información General" => ['id', 'fecha_activacion', 'trabajador', 'tipo_documento', 'identificacion'],
    "Ubicación" => ['ciudad', 'departamento', 'ips'],
    "Detalles del Servicio" => ['servicio_prestado_inicial', 'rlp', 'medicamentos', 'tipo_medicamento'],
    "Datos de Afiliación" => ['empresa', 'numero_afiliacion', 'pae', 'tipo_pae', 'ubicacion_pae'],
    "Tiempos y Activación" => ['jornada_activacion', 'activacion_presencial', 'hora_activacion_caso', 'hora_activacion_pae', 'tiempo_respuesta_sacs', 'hora_llegada_pae_ips']
];

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "healthcare_db");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query = "SELECT id, fecha_activacion, trabajador, tipo_documento, identificacion, ciudad, departamento,
          ips, servicio_prestado_inicial, rlp, medicamentos, tipo_medicamento, empresa, numero_afiliacion,
          pae, tipo_pae, ubicacion_pae, jornada_activacion, activacion_presencial, hora_activacion_caso,
          hora_activacion_pae, tiempo_respuesta_sacs, hora_llegada_pae_ips FROM activaciones";
$result = $conexion->query($query);

// Generar una página por registro
while ($row = $result->fetch_assoc()) {
    $pdf->AddPage();
    $html = '<style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th {
                    background-color: #f4f4f4;
                    font-weight: bold;
                    text-align: left;
                    padding: 5px;
                    font-size: 9px;
                }
                td {
                    text-align: left;
                    padding: 5px;
                    font-size: 8px;
                    word-wrap: break-word;
                }
                .section-title {
                    font-size: 10px;
                    font-weight: bold;
                    padding: 10px 0;
                    text-align: left;
                    border-bottom: 1px solid #000;
                }
            </style>';
    
    foreach ($sections as $sectionTitle => $columns) {
        $html .= '<div class="section-title">' . $sectionTitle . '</div>';
        $html .= '<table border="1" cellpadding="4">';
        $html .= '<thead><tr>';
        
        // Encabezados de sección
        foreach ($columns as $column) {
            $html .= '<th>' . ucfirst(str_replace('_', ' ', $column)) . '</th>';
        }
        $html .= '</tr></thead><tbody>';
        
        // Filas de datos
        $html .= '<tr>';
        foreach ($columns as $column) {
            $html .= '<td>' . $row[$column] . '</td>';
        }
        $html .= '</tr>';
        
        $html .= '</tbody></table><br>';
    }
    
    $pdf->writeHTML($html, true, false, true, false, '');
}

// Salida del PDF
$pdf->Output('reporte_activaciones.pdf', 'I');
?>