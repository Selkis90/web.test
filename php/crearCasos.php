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
                        <a class="nav-link" href="./news.php">Nuevo modulo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./client.php">Nuevo modulo</a>
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
    <div class="news_section layout_padding">
        <div class="container">

            <h1>Formulario de Activación</h1>
            <form action="index.php?controller=activaciones&action=create" method="POST">
                <label for="fecha_activacion">Fecha Activación:</label>
                <input type="date" name="fecha_activacion" required><br><br>

                <label for="trabajador">Trabajador:</label>
                <input type="text" name="trabajador" required><br><br>

                <label for="identificacion">Identificación:</label>
                <input type="text" name="identificacion" required><br><br>

                <label for="ciudad">Ciudad:</label>
                <input type="text" name="ciudad" required><br><br>

                <label for="departamento">Departamento:</label>
                <input type="text" name="departamento" required><br><br>

                <label for="ips">IPS:</label>
                <input type="text" name="ips" required><br><br>

                <label for="servicio_prestado_inicial">Servicio Prestado Inicial:</label>
                <input type="text" name="servicio_prestado_inicial" required><br><br>

                <label for="dias_it_inicial">Días IT Inicial:</label>
                <input type="text" name="dias_it_inicial" required><br><br>

                <label for="dias_it_acumulado">Días IT Acumulado:</label>
                <input type="text" name="dias_it_acumulado" required><br><br>

                <label for="rlp">RLP:</label>
                <input type="text" name="rlp" required><br><br>

                <label for="pqr_evento_adverso">PQR Evento Adverso:</label>
                <input type="text" name="pqr_evento_adverso" required><br><br>

                <label for="rlp_exitoso">RLP Exitoso:</label>
                <input type="checkbox" name="rlp_exitoso"><br><br>

                <label for="razon_rlp_no_exitoso">Razón RLP No Exitoso:</label>
                <input type="text" name="razon_rlp_no_exitoso" required><br><br>

                <label for="medicamentos">Medicamentos:</label>
                <input type="text" name="medicamentos" required><br><br>

                <label for="tipo_medicamento">Tipo de Medicamento:</label>
                <input type="text" name="tipo_medicamento" required><br><br>

                <label for="medios_diagnosticos">Medios Diagnósticos:</label>
                <input type="text" name="medios_diagnosticos" required><br><br>

                <label for="empresa">Empresa:</label>
                <input type="text" name="empresa" required><br><br>

                <label for="afiliacion">Afiliación:</label>
                <input type="text" name="afiliacion" required><br><br>

                <label for="tipo_pae">Tipo PAE:</label>
                <input type="text" name="tipo_pae" required><br><br>

                <label for="ubicacion_pae">Ubicación PAE:</label>
                <input type="text" name="ubicacion_pae" required><br><br>

                <label for="dx_inicial">DX Inicial:</label>
                <input type="text" name="dx_inicial" required><br><br>

                <label for="dx_cie10">DX CIE10:</label>
                <input type="text" name="dx_cie10" required><br><br>

                <label for="descripcion_cie10">Descripción CIE10:</label>
                <input type="text" name="descripcion_cie10" required><br><br>

                <label for="jornada_activacion">Jornada Activación:</label>
                <input type="text" name="jornada_activacion" required><br><br>

                <label for="activacion_presencial">Activación Presencial:</label>
                <input type="checkbox" name="activacion_presencial"><br><br>

                <label for="hora_activacion_caso">Hora Activación Caso:</label>
                <input type="time" name="hora_activacion_caso" required><br><br>

                <label for="hora_activacion_pae">Hora Activación PAE:</label>
                <input type="time" name="hora_activacion_pae" required><br><br>

                <label for="tiempo_respuesta_sacs">Tiempo Respuesta SACS:</label>
                <input type="text" name="tiempo_respuesta_sacs" required><br><br>

                <label for="hora_llegada_pae">Hora Llegada PAE:</label>
                <input type="time" name="hora_llegada_pae" required><br><br>

                <div class="getquote_bt">
                    <button type="submit" class="btn-submit">
                        Guardar Activación
                        <span><img src="/images/right-arrow.png" alt="arrow"></span>
                    </button>
                </div>

            </form>
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