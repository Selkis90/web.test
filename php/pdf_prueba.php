<?php
// Incluye la clase TCPDF
require_once '../librerias/tcpdf/tcpdf.php';

// 1. Crear una subclase para personalizar cabecera y pie de página
class MYPDF extends TCPDF {

    // Cabecera personalizada
    public function Header() {
        // Establece la fuente
        $this->SetFont('helvetica', 'B', 14);
        // Título centrado
        $this->Cell(0, 15, 'Reporte de Activaciones', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        // Línea inferior
        $this->Line(10, 25, 200, 25);
    }

    // Pie de página personalizado
    public function Footer() {
        // Posición desde abajo
        $this->SetY(-15);
        // Fuente en cursiva
        $this->SetFont('helvetica', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'C');
    }
}

// 2. Crear nuevo documento PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// 3. Configurar información del documento
$pdf->SetCreator('Sistema Healthcare');
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Reporte Activaciones');
$pdf->SetSubject('Reporte generado con TCPDF');
$pdf->SetKeywords('TCPDF, PDF, reporte, activaciones');

// 4. Configurar márgenes
$pdf->SetMargins(15, 30, 15);  // Izquierda, arriba (espacio para cabecera), derecha
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(15);

// 5. Activar salto automático de página
$pdf->SetAutoPageBreak(TRUE, 25);

// 6. Establecer fuente por defecto
$pdf->SetFont('helvetica', '', 10);

// 7. Agregar una nueva página
$pdf->AddPage();

// 8. Contenido de prueba - Tabla
$html = '
<h2 style="text-align:center;">Listado de Activaciones</h2>
<table border="1" cellpadding="5">
    <thead>
        <tr bgcolor="#CCCCCC">
            <th><strong>ID</strong></th>
            <th><strong>Fecha</strong></th>
            <th><strong>Trabajador</strong></th>
            <th><strong>Identificación</strong></th>
        </tr>
    </thead>
    <tbody>';

// Simulación de datos desde base de datos
$conexion = new mysqli("localhost", "root", "", "healthcare_db");
$consulta = "SELECT id, fecha_activacion, trabajador, identificacion FROM activaciones LIMIT 10";
$resultado = $conexion->query($consulta);

// 9. Recorrer resultados y agregar a la tabla
while ($fila = $resultado->fetch_assoc()) {
    $html .= '<tr>
                <td>'.$fila['id'].'</td>
                <td>'.$fila['fecha_activacion'].'</td>
                <td>'.$fila['trabajador'].'</td>
                <td>'.$fila['identificacion'].'</td>
              </tr>';
}

$html .= '</tbody></table>';

// 10. Escribir el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// 11. Salida del PDF al navegador
$pdf->Output('reporte_activaciones.pdf', 'I');  // 'I' = Inline (mostrar en navegador)
