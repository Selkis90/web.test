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
?>

<div class="container mt-4">
    <h2>Datos de Activación (No editables)</h2>

    <form method="POST" action="../controller/ActualizacionController.php">
        <input type="hidden" name="id" value="<?= $detalle['id'] ?>">
        <input type="hidden" name="activacion_id" value="<?= $activacion['id'] ?>">

        <?php foreach ($activacion as $campo => $valor): ?>
            <label><?= ucfirst(str_replace("_", " ", $campo)) ?>:</label><br>
            <input type="text" value="<?= htmlspecialchars($valor) ?>" readonly class="form-control mb-2">
        <?php endforeach; ?>

        <h2 class="mt-4">Actualizar Datos</h2>

        <div class="form-group mb-2">
            <label>Días IT Inicial:</label>
            <input type="number" name="dias_it_inicial" value="<?= $detalle['dias_it_inicial'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Días IT Acumulado:</label>
            <input type="number" name="dias_it_acumulado" value="<?= $detalle['dias_it_acumulado'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>PQR - Evento Adverso:</label>
            <input type="text" name="pqr_evento_adverso" value="<?= $detalle['pqr_evento_adverso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Razón RLP No Exitoso:</label>
            <br>
            <select name="razon_rlp_no_exitoso" class="form-select" required>
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
                    $sel = (isset($detalle['razon_rlp_no_exitoso']) && $detalle['razon_rlp_no_exitoso'] == $op) ? 'selected' : '';
                    echo "<option value='$op' $sel>$op</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group mb-2">
            <label>Medios Diagnósticos:</label>
            <input type="text" name="medios_diagnosticos" value="<?= $detalle['medios_diagnosticos'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>DX Inicial:</label>
            <input type="text" name="dx_inicial" value="<?= $detalle['dx_inicial'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>DX CIE-10:</label>
            <input
                type="text"
                name="dx_cie10"
                id="dx_cie10"
                value="<?= $detalle['dx_cie10'] ?? '' ?>"
                class="form-control"
                maxlength="5">
            <small id="cie10_error" class="text-danger" style="display:none;">
                Solo se permiten letras y números (máx. 5 caracteres).
            </small>
        </div>



        <div class="form-group mb-2">
            <label>Descripción CIE-10:</label>
            <textarea name="descripcion_cie10" class="form-control"><?= $detalle['descripcion_cie10'] ?? '' ?></textarea>
        </div>

        <div class="form-group mb-2">
            <label>Hora de Finalización del Caso:</label>
            <input type="time" name="hora_finalizacion_caso" value="<?= $detalle['hora_finalizacion_caso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Fecha de Finalización del Caso:</label>
            <input type="date" name="fecha_finalizacion_caso" value="<?= $detalle['fecha_finalizacion_caso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Seguimiento:</label>
            <textarea name="seguimiento" required class="form-control"><?= $detalle['seguimiento'] ?? '' ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
    </form>
</div>

<?php require_once '../footer.php'; ?>