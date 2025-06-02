<?php
require_once '../config/sesion.php';
require_once '../header.php';

?>
<div class="container mt-5">
  <div class="card shadow rounded-4 p-4 border-0">
    <div class="mb-4 row g-3">
      <div class="col-md-6">
        <input type="text" class="form-control form-control-lg shadow-sm" id="inputCedula" placeholder="Buscar por Cédula" />
      </div>
      <div class="col-md-6">
        <input type="text" class="form-control form-control-lg shadow-sm" id="inputAfiliaciones" placeholder="Buscar por Afiliaciones" />
      </div>
    </div>

    <div id="casos-list" class="d-flex flex-column gap-4">
      <!-- Casos generados dinámicamente -->
    </div>

    <div id="pagination" class="mt-5 d-flex justify-content-center flex-wrap gap-2">
      <!-- Botones de paginación -->
    </div>
  </div>
</div>


<script src="../js/actualizarCasos.js"></script>
<?php
require_once '../footer.php';
?>