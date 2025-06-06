<?php
require_once '../config/sesion.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <!-- site metas -->
    <title>Casos</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="/css/style.css" />
    <!-- Responsive-->
    <link rel="stylesheet" href="/css/responsive.css" />
    <!-- fevicon -->
    <link rel="icon" href="/images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="/css/jquery.mCustomScrollbar.min.css" />
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" />
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
        media="screen" />
</head>

<body>
    <!-- header section start -->
    <div class="header_section">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- <div class="logo"><a href="index.html"><img src="/images/logo.png" /></a></div> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout.php">Cerrar sesión</a>
                    </li>
                    <a class="nav-link" href="./menu.php">Inicio</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="./casos.php">Casos</a>
                    </li>

                    <!-- oculto por rol de pae  -->

                    <!-- <li class="nav-item">
            <a class="nav-link" href="./estadistica.php">Estadisticas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./news.php">Nuevo modulo 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./client.php">Nuevo modulo 2</a>
          </li> -->


                    <li class="nav-item">
                        <a class="nav-link" href="./contactanos.php">Contactanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="/images/search-icon.png" /></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- header section end -->
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
                <a href="#">Actualizar casos <span><img src="/images/right-arrow.png" /></span></a>
                <a href="#">Ver casos<span><img src="/images/right-arrow.png" /></span></a>
                <a href="#">Nuevo modulo<span><img src="/images/right-arrow.png" /></span></a>
            </div>
            <div class="health_section layout_padding">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="image_main">
                            <div class="main">
                                <img src="/images/img-2.png" alt="Avatar" class="image" style="width: 100%" />
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
                                <img src="/images/img-3.png" alt="Avatar" class="image" style="width: 100%" />
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