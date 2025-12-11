<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../controller/ActualizacionController.php';

$id = $_GET['id'] ?? null;
if (!$id) die("ID no proporcionado.");

$controller = new ActualizacionController();
$data = $controller->mostrarFormulario($id);

$activacion = $data['activacion'];
$detalle = $data['detalle'];
$historial = $data['historial'];

/** 🔍 Determinar si es la primera actualización */
$esPrimeraActualizacion =
    empty($detalle['dias_it_inicial']) &&
    empty($detalle['dias_it_acumulado']) &&
    empty($detalle['pqr_evento_adverso']) &&
    empty($detalle['seguimiento']);
?>

<div class="container mt-4">

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success text-center">
            ¡Datos actualizados correctamente!
        </div>
    <?php endif; ?>

    <h2>Datos de Activación (No editables)</h2>

    <form method="POST" action="../controller/ActualizacionController.php">
        <input type="hidden" name="id" value="<?= $detalle['id'] ?>">
        <input type="hidden" name="activacion_id" value="<?= $activacion['id'] ?>">

        <?php foreach ($activacion as $campo => $valor): ?>
            <label><b><?= ucfirst(str_replace("_", " ", $campo)) ?>:</b></label>
            <input type="text" value="<?= htmlspecialchars($valor) ?>" readonly class="form-control mb-2">
        <?php endforeach; ?>

        <h2 class="mt-4">Actualizar Datos</h2>

        <?php if ($esPrimeraActualizacion): ?>

            <!-- 🔵 CAMPOS EDITABLES SOLO LA PRIMERA VEZ -->

            <div class="form-group mb-2">
                <label>Días IT Inicial:</label>
                <input type="number" name="dias_it_inicial" value="<?= $detalle['dias_it_inicial'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>Días IT Acumulado:</label>
                <input type="number" name="dias_it_acumulado" value="<?= $detalle['dias_it_acumulado'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>PQR - Evento Adverso:</label>
                <input type="text" name="pqr_evento_adverso" value="<?= $detalle['pqr_evento_adverso'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>Razón RLP No Exitoso:</label>
                <select name="razon_rlp_no_exitoso" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php
                    $opciones = [
                        "ACTIVACION TARDIA",
                        "CLASIFICACION ERRADAS DE LA EMPRESA",
                        "CRITERIO MEDICO",
                        "IPS NO FIDELIZADA",
                        "NA",
                        "AT GRAVE RES 1401",
                        "ASEGURADO NO ACEPTA RLP"
                    ];
                    foreach ($opciones as $op) {
                        $sel = ($detalle['razon_rlp_no_exitoso'] == $op) ? "selected" : "";
                        echo "<option value='$op' $sel>$op</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group mb-2">
                <label>Medios Diagnósticos:</label>
                <input type="text" name="medios_diagnosticos" value="<?= $detalle['medios_diagnosticos'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>DX Inicial:</label>
                <input type="text" name="dx_inicial" value="<?= $detalle['dx_inicial'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label for="dx_cie10">DX CIE-10:</label>
                <input
                    type="text"
                    id="dx_cie10"
                    name="dx_cie10"
                    class="form-control"
                    value="<?= htmlspecialchars($detalle['dx_cie10'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    maxlength="5"
                    pattern="[A-Za-z0-9]{1,5}"
                    title="Solo se permiten letras y números. Máximo 5 caracteres."
                    required>
            </div>




            <div class="form-group mb-2">
                <label>Descripción CIE-10:</label>
                <textarea name="descripcion_cie10" class="form-control"><?= $detalle['descripcion_cie10'] ?></textarea>
            </div>

            <div class="form-group mb-2">
                <label>Hora de Finalización:</label>
                <input type="time" name="hora_finalizacion_caso" value="<?= $detalle['hora_finalizacion_caso'] ?>" class="form-control">
            </div>

            <div class="form-group mb-2">
                <label>Fecha de Finalización:</label>
                <input type="date" name="fecha_finalizacion_caso" value="<?= $detalle['fecha_finalizacion_caso'] ?>" class="form-control">
            </div>

            <!-- 🔵 SEGUIMIENTO ACTUAL EDITABLE LA PRIMERA VEZ -->
            <div class="form-group mb-3">
                <label><b>Seguimiento Actual:</b></label>
                <textarea name="seguimiento" class="form-control" required><?= $detalle['seguimiento'] ?></textarea>
            </div>

        <?php else: ?>

            <!-- 🔒 SEGUNDA VEZ O MÁS — CAMPOS SOLO LECTURA PERO SE ENVÍAN -->

            <?php
            $camposSoloLectura = [
                "dias_it_inicial" => "Días IT Inicial",
                "dias_it_acumulado" => "Días IT Acumulado",
                "pqr_evento_adverso" => "PQR / Evento Adverso",
                "razon_rlp_no_exitoso" => "Razón RLP No Exitoso",
                "medios_diagnosticos" => "Medios Diagnósticos",
                "dx_inicial" => "DX Inicial",
                "dx_cie10" => "DX CIE10",
                "descripcion_cie10" => "Descripción CIE10",
                "hora_finalizacion_caso" => "Hora Fin Caso",
                "fecha_finalizacion_caso" => "Fecha Fin Caso",
                "seguimiento" => "Seguimiento Actual"
            ];

            foreach ($camposSoloLectura as $campo => $label): ?>
                <div class="form-group mb-2">
                    <label><?= $label ?>:</label>
                    <textarea class="form-control" readonly><?= htmlspecialchars($detalle[$campo]) ?></textarea>

                    <!-- 🔥 EL VALOR SE ENVÍA AL CONTROLADOR -->
                    <input type="hidden" name="<?= $campo ?>" value="<?= htmlspecialchars($detalle[$campo]) ?>">
                </div>
            <?php endforeach; ?>

        <?php endif; ?>

        <!-- 🟣 NUEVO SEGUIMIENTO – SIEMPRE DISPONIBLE -->
        <hr>
        <div class="form-group mb-3">
            <label><b>Nuevo Seguimiento (Historial):</b></label>
            <textarea name="seguimiento_nuevo" class="form-control" placeholder="Escribe un nuevo seguimiento..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
    </form>

    <!-- 🟣 HISTORIAL DE SEGUIMIENTOS -->
    <div class="mt-5">
        <h3>Historial de Seguimientos</h3>

        <?php if (empty($historial)): ?>
            <p class="text-muted">Aún no hay seguimientos almacenados.</p>
        <?php else: ?>
            <ul class="list-group">
                <?php foreach ($historial as $h): ?>
                    <li class="list-group-item">
                        <b><?= date("d/m/Y H:i", strtotime($h['fecha_registro'])) ?>:</b><br>
                        <?= nl2br(htmlspecialchars($h['seguimiento'])) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>

</div>

<?php require_once '../footer.php'; ?>