<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php'; // Asegúrate que la ruta sea correcta

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID no proporcionado.");
}

// Obtener datos de activación (solo lectura)
$stmt = $conexion->prepare("SELECT * FROM activaciones WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$activacion = $result->fetch_assoc();
$stmt->close();

if (!$activacion) {
    die("Activación no encontrada.");
}

// Obtener detalle de actualizacion_activaciones
$stmt = $conexion->prepare("SELECT * FROM actualizacion_activaciones WHERE activacion_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$detalle = $result->fetch_assoc();
$stmt->close();

// Si no existe detalle, lo creamos
if (!$detalle) {
    $stmt = $conexion->prepare("INSERT INTO actualizacion_activaciones (activacion_id) VALUES (?)");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Lo volvemos a buscar
    $stmt = $conexion->prepare("SELECT * FROM actualizacion_activaciones WHERE activacion_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $detalle = $result->fetch_assoc();
    $stmt->close();
}
?>

<div class="container">
    <h2>Datos de Activación (No editables)</h2>
    <form method="POST" action="./guardar_actualizacion.php">
        <input type="hidden" name="id" value="<?= $detalle['id'] ?>">
        <input type="hidden" name="activacion_id" value="<?= $activacion['id'] ?>">

        <?php foreach ($activacion as $campo => $valor): ?>
            <label><?= ucfirst(str_replace("_", " ", $campo)) ?>:</label><br>
            <input type="text" name="<?= $campo ?>" value="<?= htmlspecialchars($valor) ?>" readonly class="form-control"><br>
        <?php endforeach; ?>

        <h2>Actualizar Datos</h2>
        <div class="form-group">
            <label>Días IT Inicial:</label>
            <input type="number" name="dias_it_inicial" value="<?= $detalle['dias_it_inicial'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Días IT Acumulado:</label>
            <input type="number" name="dias_it_acumulado" value="<?= $detalle['dias_it_acumulado'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>PQR - Evento Adverso:</label>
            <input type="text" name="pqr_evento_adverso" value="<?= $detalle['pqr_evento_adverso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Razón RLP No Exitoso:</label>
            <input type="text" name="razon_rlp_no_exitoso" value="<?= $detalle['razon_rlp_no_exitoso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Medios Diagnósticos:</label>
            <input type="text" name="medios_diagnosticos" value="<?= $detalle['medios_diagnosticos'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>DX Inicial:</label>
            <input type="text" name="dx_inicial" value="<?= $detalle['dx_inicial'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>DX CIE-10:</label>
            <input type="number" name="dx_cie10" value="<?= $detalle['dx_cie10'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Descripción CIE-10:</label>
            <textarea name="descripcion_cie10" class="form-control"><?= $detalle['descripcion_cie10'] ?? '' ?></textarea>
        </div>

        <div class="form-group">
            <label>Hora de Finalización del Caso:</label>
            <input type="time" name="hora_finalizacion_caso" value="<?= $detalle['hora_finalizacion_caso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Fecha de Finalización del Caso:</label>
            <input type="date" name="fecha_finalizacion_caso" value="<?= $detalle['fecha_finalizacion_caso'] ?? '' ?>" class="form-control">
        </div>

        <div class="form-group">
            <label>Seguimiento:</label>
            <textarea name="seguimiento[]" required class="form-control"><?= $detalle['seguimiento'] ?? '' ?></textarea>
        </div>

        <div id="seguimientosExtras"></div>

        <button type="button" onclick="agregarSeguimiento()" class="btn btn-secondary">+ Agregar Seguimiento</button>
        <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
    </form>
</div>

<script>
    function agregarSeguimiento() {
        const contenedor = document.getElementById('seguimientosExtras');
        const textarea = document.createElement('textarea');
        textarea.name = 'seguimiento[]';
        textarea.className = 'form-control seguimiento-extra mt-2';
        textarea.placeholder = 'Nuevo seguimiento...';
        contenedor.appendChild(textarea);
    }
</script>

<?php require_once '../footer.php'; ?>