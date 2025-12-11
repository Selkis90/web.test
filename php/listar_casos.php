<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php';

// Filtros opcionales
$cedula = $_GET['cedula'] ?? '';
$afiliacion = $_GET['afiliacion'] ?? '';

// Construcción dinámica de la consulta
$sql = "SELECT * FROM activaciones WHERE 1";
$paramTypes = '';
$params = [];

if (!empty($cedula)) {
    $sql .= " AND identificacion LIKE ?";
    $paramTypes .= 's';
    $params[] = "%$cedula%";
}

if (!empty($afiliacion)) {
    $sql .= " AND numero_afiliacion LIKE ?";
    $paramTypes .= 's';
    $params[] = "%$afiliacion%";
}

$stmt = $conexion->prepare($sql);

// Asociar parámetros si existen
if (!empty($params)) {
    $stmt->bind_param($paramTypes, ...$params);
}

$stmt->execute();
$resultado = $stmt->get_result();
?>

<div class="container py-5">
    <h2 class="mb-4">Listado de Casos</h2>

    <!-- 🔍 Formulario de Búsqueda -->
    <form method="get" class="mb-4">
        <div class="row g-2">
            <div class="col-md-5">
                <input type="text" name="cedula" class="form-control" placeholder="Buscar por cédula" value="<?= htmlspecialchars($cedula) ?>">
            </div>
            <div class="col-md-5">
                <input type="text" name="afiliacion" class="form-control" placeholder="Buscar por afiliación" value="<?= htmlspecialchars($afiliacion) ?>">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Buscar</button>
            </div>
        </div>
    </form>

    <?php if ($resultado->num_rows === 0): ?>
        <div class='alert alert-warning'>No se encontraron casos.</div>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Trabajador</th>
                    <th>Identificación</th>
                    <th>Afiliación</th>
                    <th>Ciudad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($caso = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= $caso['id'] ?></td>
                        <td><?= htmlspecialchars($caso['trabajador']) ?></td>
                        <td><?= htmlspecialchars($caso['identificacion']) ?></td>
                        <td><?= htmlspecialchars($caso['numero_afiliacion']) ?></td>
                        <td><?= htmlspecialchars($caso['ciudad']) ?></td>
                        <td>
                            <a href="actualizarCasos.php?id=<?= $caso['id'] ?>" class="btn btn-sm btn-success">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once '../footer.php'; ?>
