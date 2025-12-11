<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

$caso = null;
$actualizacion = null;
$historial = null; // <-- evitar Warning

if ($id) {

    // Consulta de la activación
    $sql = "SELECT * FROM activaciones WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $caso = $resultado->fetch_assoc();
    }

    // Consulta de la actualización
    $sql2 = "SELECT * FROM actualizacion_activaciones WHERE activacion_id = $id";
    $resultado2 = $conexion->query($sql2);

    if ($resultado2 && $resultado2->num_rows > 0) {
        $actualizacion = $resultado2->fetch_assoc();
    }

    // Consulta del HISTORIAL — AHORA SÍ EJECUTADA
    $sql3 = "SELECT * FROM seguimiento_historial WHERE activacion_id = $id ORDER BY fecha_registro ASC";
    $historial = $conexion->query($sql3);
}
?>


<!-- Vincular el CSS -->
<link rel="stylesheet" href="../css/detalle_caso.css">

<div class="container py-5">

    <?php if (!$caso): ?>
        <div class='alert alert-warning'>Caso no encontrado.</div>

    <?php else: ?>

        <a href="pdf_reporte_detallado_caso.php?id=<?= $id ?>"
            class="btn btn-danger mb-3"
            target="_blank">
            Descargar PDF del Caso
        </a>

        <div class="card-custom">

            <h2 class="section-title">Detalle del Caso</h2>

            <div class="row">

                <div class="col-md-4 row-data"><span class="data-label">Fecha Activación:</span> <span class="data-value"><?= $caso['fecha_activacion'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Trabajador:</span> <span class="data-value"><?= $caso['trabajador'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Identificación:</span> <span class="data-value"><?= $caso['identificacion'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">Tipo Doc:</span> <span class="data-value"><?= $caso['tipo_documento'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Ciudad:</span> <span class="data-value"><?= $caso['ciudad'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Departamento:</span> <span class="data-value"><?= $caso['departamento'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">IPS:</span> <span class="data-value"><?= $caso['ips'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Servicio Inicial:</span> <span class="data-value"><?= $caso['servicio_prestado_inicial'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Afilicación:</span> <span class="data-value"><?= $caso['numero_afiliacion'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">RLP:</span> <span class="data-value"><?= $caso['rlp'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Tipo Medicamento:</span> <span class="data-value"><?= $caso['tipo_medicamento'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Medicamentos:</span> <span class="data-value"><?= $caso['medicamentos'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">PAE:</span> <span class="data-value"><?= $caso['pae'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Tipo PAE:</span> <span class="data-value"><?= $caso['tipo_pae'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Ubicación PAE:</span> <span class="data-value"><?= $caso['ubicacion_pae'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">Presencial:</span> <span class="data-value"><?= $caso['activacion_presencial'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Hora Activación Caso:</span> <span class="data-value"><?= $caso['hora_activacion_caso'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Hora Activación PAE:</span> <span class="data-value"><?= $caso['hora_activacion_pae'] ?></span></div>

                <div class="col-md-4 row-data"><span class="data-label">Hora Llegada PAE:</span> <span class="data-value"><?= $caso['hora_llegada_pae_ips'] ?></span></div>
                <div class="col-md-4 row-data"><span class="data-label">Jornada:</span> <span class="data-value"><?= $caso['jornada_activacion'] ?></span></div>
            </div>

            <div class="divider"></div>

            <h2 class="section-title">Actualización de la Activación</h2>

            <?php if ($actualizacion): ?>
                <div class="row">

                    <div class="col-md-4 row-data"><span class="data-label">Días IT Inicial:</span> <span class="data-value"><?= $actualizacion['dias_it_inicial'] ?></span></div>
                    <div class="col-md-4 row-data"><span class="data-label">Días IT Acumulado:</span> <span class="data-value"><?= $actualizacion['dias_it_acumulado'] ?></span></div>
                    <div class="col-md-4 row-data"><span class="data-label">PQR / Evento Adverso:</span> <span class="data-value"><?= $actualizacion['pqr_evento_adverso'] ?></span></div>

                    <div class="col-md-4 row-data"><span class="data-label">Razón RLP No Exitoso:</span> <span class="data-value"><?= $actualizacion['razon_rlp_no_exitoso'] ?></span></div>
                    <div class="col-md-4 row-data"><span class="data-label">Medios Diagnósticos:</span> <span class="data-value"><?= $actualizacion['medios_diagnosticos'] ?></span></div>

                    <div class="col-md-4 row-data"><span class="data-label">DX Inicial:</span> <span class="data-value"><?= $actualizacion['dx_inicial'] ?></span></div>
                    <div class="col-md-4 row-data"><span class="data-label">CIE10:</span> <span class="data-value"><?= $actualizacion['dx_cie10'] ?></span></div>

                    <div class="col-12 row-data"><span class="data-label">Descripción CIE10:</span> <span class="data-value"><?= $actualizacion['descripcion_cie10'] ?></span></div>

                    <div class="col-md-4 row-data"><span class="data-label">Hora Finalización Caso:</span> <span class="data-value"><?= $actualizacion['hora_finalizacion_caso'] ?></span></div>
                    <div class="col-md-4 row-data"><span class="data-label">Fecha Finalización Caso:</span> <span class="data-value"><?= $actualizacion['fecha_finalizacion_caso'] ?></span></div>

                    <div class="col-12 row-data"><span class="data-label">Seguimiento:</span> <span class="data-value"><?= nl2br($actualizacion['seguimiento']) ?></span></div>

                </div>
                <div class="divider"></div>

                <h2 class="section-title">Historial de Seguimientos</h2>

                <?php if ($historial && $historial->num_rows > 0): ?>

                    <div class="card p-3" style="background:#ffffff;border-radius:8px;">

                        <?php while ($h = $historial->fetch_assoc()): ?>
                            <div class="seguimiento-item" style="padding:10px 0;border-bottom:1px solid #ddd;">
                                <p><strong>Fecha:</strong> <?= $h['fecha_registro'] ?></p>
                                <p><strong>Seguimiento:</strong><br><?= nl2br($h['seguimiento']) ?></p>
                            </div>
                        <?php endwhile; ?>

                    </div>

                <?php else: ?>
                    <div class="alert alert-info">No hay seguimientos registrados.</div>
                <?php endif; ?>

            <?php else: ?>
                <div class="alert alert-info">No hay actualizaciones registradas para este caso.</div>
            <?php endif; ?>

        </div>

        <a href="../php/menu.php" class="btn btn-secondary btn-back">← Volver</a>

    <?php endif; ?>

</div>

<?php require_once '../footer.php'; ?>