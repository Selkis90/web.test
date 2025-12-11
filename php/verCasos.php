<?php
require_once '../config/sesion.php';
require_once '../header.php';
?>

<div class="container mt-5">
  <div class="card shadow rounded-4 p-4 border-0">

    <!-- FORMULARIO DE FILTROS -->
    <form id="formFiltros" class="mb-4 row g-3">
      <div class="col-md-4">
        <input type="text" class="form-control form-control-lg shadow-sm" id="inputCedula" name="cedula" placeholder="Buscar por Cédula" />
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control form-control-lg shadow-sm" id="inputAfiliaciones" name="afiliacion" placeholder="Buscar por Afiliaciones" />
      </div>
    </form>

    <!-- LISTADO DE CASOS -->
    <div id="casos-list" class="d-flex flex-column gap-4">
      <!-- Casos generados dinámicamente -->
    </div>

    <!-- Paginación -->
    <div id="pagination" class="mt-5 d-flex justify-content-center flex-wrap gap-2">
      <!-- Botones de paginación -->
    </div>

  </div>
</div>

<script src="../js/actualizarCasos.js"></script>
<?php
require_once '../footer.php';
?>