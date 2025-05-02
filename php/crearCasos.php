<?php
require_once '../config/sesion.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>News</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!-- estilo de formulario -->
    <link rel="stylesheet" href="formulario.css">
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <div class="logo"><a href="index.html"><img src="/images/logo.png"></a></div> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout.php">Cerrar sesión</a>
                    </li>
                    <a class="nav-link" href="./menu.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./casos.php">Casos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./estadistica.php">Estadisticas</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./news.php">Nuevo modulo 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./client.php">Nuevo modulo 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contactanos.php">Contactanos </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="/images/search-icon.png"></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- header section end -->
    <!-- news section start -->
    <div class="container py-5">
        <div class="card shadow rounded-4">
            <div class="card-body">
                <h2 class="text-center mb-4">Formulario de Activación</h2>
                <form action="/app.php?controller=activaciones&action=store" method="POST">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="fecha_activacion" class="form-label">Fecha de Activación</label>
                            <input type="date" class="form-control" id="fecha_activacion" name="fecha_activacion" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_activacion_caso" class="form-label">Hora de Activación de Caso</label>
                            <input type="time" class="form-control" id="hora_activacion_caso" name="hora_activacion_caso" required>
                        </div>

                        <div class="col-md-6">
                            <label for="trabajador" class="form-label">Trabajador</label>
                            <input type="text" class="form-control" id="trabajador" name="trabajador" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                            <br>
                            <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                                <option value="">Seleccione...</option>
                                <option value="ti">Tarjeta de Identidad</option>
                                <option value="cc">Cédula de Ciudadanía</option>
                                <option value="ppt">Permiso por Protección Temporal (PPT)</option>
                                <option value="pep">Permiso Especial de Permanencia (PEP)</option>
                                <option value="ce">Cédula de Extranjería</option>
                                <option value="visa">Visa</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="identificacion" class="form-label">Identificación</label>
                            <input type="text" class="form-control" id="identificacion" name="identificacion" required>
                        </div>

                        <div class="col-md-6">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" required>
                        </div>

                        <div class="col-md-6">
                            <label for="departamento" class="form-label">Departamento</label>
                            <input type="text" class="form-control" id="departamento" name="departamento" required>
                        </div>

                        <div class="col-md-6">
                            <label for="ips" class="form-label">IPS</label>
                            <input type="text" class="form-control" id="ips" name="ips" required>
                        </div>

                        <div class="col-md-6">
                            <label for="servicio_prestado_inicial" class="form-label">Servicio Prestado Inicial</label>
                            <input type="text" class="form-control" id="servicio_prestado_inicial" name="servicio_prestado_inicial" required>
                        </div>

                        <div class="col-md-6">
                            <label for="rlp" class="form-label">RLP</label>
                            <br>
                            <select class="form-select" id="rlp" name="rlp" required>
                                <option value="">Seleccione...</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="medicamentos" class="form-label">Medicamentos</label>
                            <input type="text" class="form-control" id="medicamentos" name="medicamentos" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_medicamento" class="form-label">Tipo de Medicamento</label>
                            <input type="text" class="form-control" id="tipo_medicamento" name="tipo_medicamento" required>
                        </div>

                        <div class="col-md-6">
                            <label for="empresa" class="form-label">Empresa</label>
                            <input type="text" class="form-control" id="empresa" name="empresa" required>
                        </div>

                        <div class="col-md-6">
                            <label for="numero_afiliacion" class="form-label">Número de Afiliación</label>
                            <input type="text" class="form-control" id="numero_afiliacion" name="numero_afiliacion" required>
                        </div>

                        <div class="col-md-6">
                            <label for="pae" class="form-label">PAE</label>
                            <input type="text" class="form-control" id="pae" name="pae" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_pae" class="form-label">Tipo de PAE</label>
                            <input type="text" class="form-control" id="tipo_pae" name="tipo_pae" required>
                        </div>

                        <div class="col-md-6">
                            <label for="ubicacion_pae" class="form-label">Ubicación del PAE</label>
                            <input type="text" class="form-control" id="ubicacion_pae" name="ubicacion_pae" required>
                        </div>

                        <div class="col-md-6">
                            <label for="jornada_activacion" class="form-label">Jornada de Activación</label>
                            <input type="text" class="form-control" id="jornada_activacion" name="jornada_activacion" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Activación Presencial</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="activacion_presencial" name="activacion_presencial">
                                <label class="form-check-label" for="activacion_presencial">Sí</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_activacion_pae" class="form-label">Hora de Activación del PAE</label>
                            <input type="time" class="form-control" id="hora_activacion_pae" name="hora_activacion_pae" required>
                        </div>

                        <div class="col-md-6">
                            <label for="tiempo_respuesta_sacs" class="form-label">Tiempo de Respuesta SACS</label>
                            <input type="text" class="form-control" id="tiempo_respuesta_sacs" name="tiempo_respuesta_sacs" required>
                        </div>

                        <div class="col-md-6">
                            <label for="hora_llegada_pae_ips" class="form-label">Hora de Llegada del PAE al Lugar (IPS)</label>
                            <input type="time" class="form-control" id="hora_llegada_pae_ips" name="hora_llegada_pae_ips" required>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Guardar Activación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    </div>
    <!-- news section end -->
    <!-- footer section start -->
    <div class="footer_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer_logo"><a href="index.html"><img src="/images/footer-logo.png"></a></div>
                    <h1 class="adderss_text">Contact Us</h1>
                    <div class="map_icon"><img src="/images/map-icon.png"><span class="paddlin_left_0">Page when looking at its</span></div>
                    <div class="map_icon"><img src="/images/call-icon.png"><span class="paddlin_left_0">+7586656566</span></div>
                    <div class="map_icon"><img src="/images/mail-icon.png"><span class="paddlin_left_0">volim@gmail.com</span></div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="adderss_text">Doctors</h1>
                    <div class="hiphop_text_1">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour,</div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="adderss_text">Useful Links</h1>
                    <div class="Useful_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered ,</div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <h1 class="adderss_text">Newsletter</h1>
                    <input type="text" class="Enter_text" placeholder="Enter your Emil" name="Enter your Emil">
                    <div class="subscribe_bt"><a href="#">Subscribe</a></div>
                    <div class="social_icon">
                        <ul>
                            <li><a href="#"><img src="/images/fb-icon.png"></a></li>
                            <li><a href="#"><img src="/images/twitter-icon.png"></a></li>
                            <li><a href="#"><img src="/images/linkedin-icon.png"></a></li>
                            <li><a href="#"><img src="/images/instagram-icon.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer section end -->
    <!-- copyright section start -->
    <div class="copyright_section">
        <div class="container">
            <p class="copyright_text">2019 All Rights Reserved. Design by <a href="https://html.design">Free html Templates</a></p>
        </div>
    </div>
    <!-- copyright section end -->
    <!-- Javascript files-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.0.0.min.js"></script>
    <script src="/js/plugin.js"></script>
    <!-- sidebar -->
    <script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/js/custom.js"></script>
    <!-- javascript -->
    <script src="/js/owl.carousel.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>

</html>