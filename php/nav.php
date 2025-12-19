<?php

// Generar menu dinamicamente dependiendo del rol en sesión


// Arreglo que contiene todas las páginas del sistema
$arr_paginas = [
    'cerrar_sesion' => [
        'nombre' => 'Cerrar sesión',
        'url' => '../logout.php',
        'mostrar' => 1,
    ],
    'inicio' => [
        'nombre' => 'Inicio',
        'url' => 'inicio.php',
        'mostrar' => 1,
    ],
    'casos' => [
        'nombre' => 'Casos',
        'url' => 'casos.php',
        'mostrar' => 1,
    ],
    'estadisticas' => [
        'nombre' => 'Estadisticas',
        'url' => 'estadistica.php',
        'mostrar' => 1,
    ],
    'modulo_1' => [
        'nombre' => 'Módulo 1',
        'url' => 'ver_detalle_caso.php',
        'mostrar' => 1,
    ],
    'modulo_2' => [
        'nombre' => 'Módulo 2',
        'url' => 'client.php',
        'mostrar' => 1,
    ],
    'contactanos' => [
        'nombre' => 'Contáctanos',
        'url' => 'contactanos.php',
        'mostrar' => 1,
    ],
    'crearCasos' => [
        'url' => 'crearCasos.php',
        'mostrar' => 0,
    ],
     'listar_casos' => [
        'url' => 'listar_casos.php',
        'mostrar' => 0,
    ],
    'verCasos' => [
        'url' => 'verCasos.php',
        'mostrar' => 0,
    ],
    'pdf_prueba' => [
        'url' => 'pdf_prueba.php',
        'mostrar' => 0,
    ],
     'actualizarCasos' => [
        'url' => 'actualizarCasos.php',
        'mostrar' => 0,
    ],
       'ver_detalle_caso' => [
        'url' => 'ver_detalle_caso.php',
        'mostrar' => 0,
    ],
    
];

// Proceso de asignación de páginas dependiendo del rol del usuario

// Rol que tiene todos los permisos
$rol_1 = [
    'cerrar_sesion',
    'inicio',
    'casos',
    'estadisticas',
    'modulo_1',
    'modulo_2',
    'contactanos',
    'crearCasos',
    'listar_casos',    
    'verCasos',
    'pdf_prueba',
    'actualizarCasos',
    'ver_detalle_caso',
];

$rol_2 = [
    'cerrar_sesion',
    'inicio',
    'casos',
    'crearCasos',
    'listar_casos',
    'verCasos',
    'pdf_prueba',
    'actualizarCasos',
    'ver_detalle_caso',    
];

// Validar que el usuario tenga permisos en la página actual:
$arr_pagina_actual = explode('/', $_SERVER['REQUEST_URI']);
$pagina = end($arr_pagina_actual);

// limpiar la pagina de los parametros get
$pagina = substr($pagina, 0, strpos($pagina, '.php') + 4);

/* var_dump($pagina, $str);
exit; */

$permisos_usuario = $_SESSION['rol'] == 1 ? $rol_1 : $rol_2;

// Verificar si estan intentando ingresar a una página que esté dentro de sus permisos
$autorizado = 0;
foreach($permisos_usuario as $llave){
    // $limpiar_url = explode('/', $arr_paginas[$llave]['url']);
    if($arr_paginas[$llave]['url'] == $pagina){
        $autorizado = 1;
        break;
    }
}

// Validar si entró a una página autorizada
if($autorizado == 0){
    echo "No está autorizado. añadir pag";
/*     session_destroy();
    unset($_SESSION); */
    exit;
}

?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- LOGO SACS -->
    <!-- <div class="logo"><a href="index.html"><img src="/images/logoSACS.png"></a></div> -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#n7avbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            
        <?php

        foreach($permisos_usuario as $key => $item){ 
            if($arr_paginas[$item]['mostrar']){
            ?>

            <li class="nav-item">
                <a class="nav-link" href="./<?= $arr_paginas[$item]['url']; ?>">
                    <?= $arr_paginas[$item]['nombre']; ?>
                </a>
            </li>

        <?php }} ?>
            
            
            <li class="nav-item">
                <!-- BUSCADOR -->
                <a class="nav-link" href="#"><img src="/images/search-icon.png"></a>
            </li>
        </ul>
    </div>
</nav>