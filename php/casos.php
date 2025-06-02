<?php
require_once '../config/sesion.php';
require_once '../header.php';

?>

<!-- health section start -->
<div class="health_section layout_padding">
  <div class="container">
    <h1 class="health_taital">Lo mejor en atención médica para ti.</h1>
    <p class="health_text">
      Nos dedicamos a brindarte una atención médica de calidad, personalizada y oportuna.
      Nuestro compromiso es cuidar de tu salud y bienestar con profesionales altamente capacitados,
      tecnología de vanguardia y un enfoque humano que prioriza tus necesidades.
      Confía en nosotros para acompañarte en cada etapa de tu cuidado, porque tu salud es nuestra prioridad.
      Aquí encontrarás lo mejor en servicios de salud para ti y tu familia.
    </p>
    <div class="getquote_bt_1">
      <a href="../php/crearCasos.php">Crear Casos<span><img src="/images/right-arrow.png" /></span></a>
      <a href="../php/actualizarCasos.php">Actualizar casos <span><img src="/images/right-arrow.png" /></span></a>
      <a href="../php/verCasos.php">Ver casos<span><img src="/images/right-arrow.png" /></span></a>
      <a href="#">Nuevo modulo<span><img src="/images/right-arrow.png" /></span></a>
    </div>
    <div class="health_section layout_padding">
      <div class="row">
        <div class="col-sm-7">
          <div class="image_main">
            <div class="main">
              <img
                src="/images/img-2.png"
                alt="Avatar"
                class="image"
                style="width: 100%" />
            </div>
            <div class="middle">
              <div class="text">
                <img src="/images/icon-1.png" style="width: 40px" />
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="image_main_1">
            <div class="main">
              <img
                src="/images/img-3.png"
                alt="Avatar"
                class="image"
                style="width: 100%" />
            </div>
            <div class="middle">
              <div class="text">
                <img src="/images/icon-1.png" style="width: 40px" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- health section end -->
<?php
require_once '../footer.php';
?>