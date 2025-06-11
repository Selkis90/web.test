<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php';


$id = isset($_GET['id']) ? intval($_GET['id']) : null;
$caso = null;

if ($id) {
    $sql = "SELECT * FROM activaciones WHERE id = $id";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $caso = $resultado->fetch_assoc();
    }
}
?>

 <div class="container py-5">

    <!-- 🔍 Formulario de Búsqueda -->
    <form action="../index.html" method="get" class="mb-4">
      <div class="row g-2">
        <div class="col-md-5">
          <input type="text" name="cedula" class="form-control" placeholder="Buscar por cédula">
        </div>
        <div class="col-md-5">
          <input type="text" name="afiliacion" class="form-control" placeholder="Buscar por afiliación">
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">Buscar</button>
        </div>
      </div>
    </form>

    <?php if (!$caso): ?>
      <div class='alert alert-warning'>Caso no encontrado.</div>
    <?php else: ?>
      <div class="card shadow border-0 rounded-4 p-4 bg-white">
        <h2 class="mb-4 text-primary">Detalle del Caso</h2>

        <div class="mb-3"><strong>Trabajador:</strong> <?= htmlspecialchars($caso['trabajador']) ?></div>
        <div class="mb-3"><strong>Cédula:</strong> <?= htmlspecialchars($caso['identificacion']) ?></div>
        <div class="mb-3"><strong>Número de Afiliación:</strong> <?= htmlspecialchars($caso['numero_afiliacion']) ?></div>

        <a href="../index.html" class="btn btn-secondary mt-3">← Volver</a>
      </div>
    <?php endif; ?>
  </div>

    <?php
    require_once '../footer.php'; ?>