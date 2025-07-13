<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php';
$conexion->query("SET lc_time_names = 'es_ES'");

// 1. RLP por mes
$queryRLP = "
    SELECT MONTH(fecha_activacion) AS mes_num,
           MONTHNAME(fecha_activacion) AS mes,
           SUM(CASE WHEN rlp = 'ESPECIAL' THEN 1 ELSE 0 END) AS rlp_especial,
           SUM(CASE WHEN rlp = 'NO' THEN 1 ELSE 0 END) AS rlp_no,
           SUM(CASE WHEN rlp = 'SI' THEN 1 ELSE 0 END) AS rlp_si
    FROM activaciones
    GROUP BY mes_num, mes
    ORDER BY mes_num
";
$resRLP = $conexion->query($queryRLP);
$rlpLabels = $rlpEspecial = $rlpNo = $rlpSi = [];
while ($row = $resRLP->fetch_assoc()) {
   $rlpLabels[] = $row['mes'];
   $rlpEspecial[] = (int)$row['rlp_especial'];
   $rlpNo[] = (int)$row['rlp_no'];
   $rlpSi[] = (int)$row['rlp_si'];
}

// 2. Activación presencial (tipo de activación)
$queryPresencial = "
    SELECT activacion_presencial, COUNT(*) AS cantidad
    FROM activaciones
    GROUP BY activacion_presencial
";
$resPresencial = $conexion->query($queryPresencial);
$presencialLabels = $presencialValores = [];
while ($row = $resPresencial->fetch_assoc()) {
   $presencialLabels[] = $row['activacion_presencial'];
   $presencialValores[] = (int)$row['cantidad'];
}

// 3. Tipo de PAE
$queryPAE = "
    SELECT tipo_pae, COUNT(*) AS cantidad
    FROM activaciones
    WHERE tipo_pae IS NOT NULL AND tipo_pae != ''
    GROUP BY tipo_pae
    ORDER BY cantidad DESC
";
$resPAE = $conexion->query($queryPAE);
$paeLabels = $paeValores = [];

$mapaPAE = [
   '0' => 'AUXILIAR ADMINISTRATIVO',
   '1' => 'PAE 1',
   '2' => 'PAE 2',
   '3' => 'PAE 3'
];

while ($row = $resPAE->fetch_assoc()) {
   $codigo = $row['tipo_pae'];
   if (array_key_exists($codigo, $mapaPAE)) {
      $paeLabels[] = $mapaPAE[$codigo];
      $paeValores[] = (int)$row['cantidad'];
   }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Gráficas Activaciones</title>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
      .grafica-container {
         max-width: 1000px;
         margin: 0 auto;
         padding: 20px;
         box-sizing: border-box;
      }

      .grafica-container canvas {
         width: 100% !important;
         height: auto !important;
      }

      .grafica-container h3 {
         text-align: center;
         margin-top: 30px;
      }

      @media (max-width: 768px) {
         .grafica-container {
            padding: 10px;
         }
      }
   </style>
</head>
<body>

<!-- ❗ Tu menú no se ve afectado, no tocamos estilos globales -->

<form method="GET" style="text-align:center; margin:20px;">
   <label for="empresa">Empresa:</label>
   <input type="text" name="empresa" value="<?= isset($_GET['empresa']) ? htmlspecialchars($_GET['empresa']) : '' ?>">

   <label for="desde">Desde:</label>
   <input type="date" name="desde" value="<?= $_GET['desde'] ?? '' ?>">

   <label for="hasta">Hasta:</label>
   <input type="date" name="hasta" value="<?= $_GET['hasta'] ?? '' ?>">

   <button type="submit">Filtrar</button>
</form>

<div class="grafica-container">
   <h2 class="text-center">Gráficas de Activaciones</h2>

   <h3>Distribución RLP por Mes</h3>
   <canvas id="rlpChart"></canvas>

   <h3>Tipo de Activación (Presencial o NO)</h3>
   <canvas id="presencialChart"></canvas>

   <h3>Tipos de PAE más Usados</h3>
   <canvas id="paeChart"></canvas>
</div>

<script>
   function generateColors(count) {
      const colors = [];
      for (let i = 0; i < count; i++) {
         const r = Math.floor(Math.random() * 255);
         const g = Math.floor(Math.random() * 255);
         const b = Math.floor(Math.random() * 255);
         colors.push(`rgba(${r}, ${g}, ${b}, 0.7)`);
      }
      return colors;
   }

   // Gráfico RLP
   new Chart(document.getElementById('rlpChart'), {
      type: 'bar',
      data: {
         labels: <?= json_encode($rlpLabels) ?>,
         datasets: [
            {
               label: 'RLP ESPECIAL',
               data: <?= json_encode($rlpEspecial) ?>,
               backgroundColor: 'rgba(255, 99, 132, 0.7)'
            },
            {
               label: 'RLP NO',
               data: <?= json_encode($rlpNo) ?>,
               backgroundColor: 'rgba(255, 205, 86, 0.7)'
            },
            {
               label: 'RLP SI',
               data: <?= json_encode($rlpSi) ?>,
               backgroundColor: 'rgba(75, 192, 192, 0.7)'
            }
         ]
      },
      options: {
         responsive: true,
         plugins: {
            title: { display: true, text: 'Distribución RLP por Mes' }
         },
         scales: {
            y: {
               beginAtZero: true,
               ticks: {
                  stepSize: 1,
                  callback: value => Number.isInteger(value) ? value : null
               }
            }
         }
      }
   });

   // Gráfico Presencial
   const presencialColors = generateColors(<?= count($presencialValores) ?>);
   new Chart(document.getElementById('presencialChart'), {
      type: 'doughnut',
      data: {
         labels: <?= json_encode($presencialLabels) ?>,
         datasets: [{
            data: <?= json_encode($presencialValores) ?>,
            backgroundColor: presencialColors
         }]
      },
      options: {
         responsive: true,
         plugins: {
            title: { display: true, text: 'Activaciones Presenciales vs No Presenciales' }
         }
      }
   });

   // Gráfico PAE
   const paeColors = generateColors(<?= count($paeValores) ?>);
   new Chart(document.getElementById('paeChart'), {
      type: 'bar',
      data: {
         labels: <?= json_encode($paeLabels) ?>,
         datasets: [{
            label: 'Cantidad',
            data: <?= json_encode($paeValores) ?>,
            backgroundColor: paeColors
         }]
      },
      options: {
         responsive: true,
         plugins: {
            title: { display: true, text: 'Tipos de PAE más utilizados' }
         },
         scales: {
            y: {
               beginAtZero: true,
               ticks: {
                  stepSize: 1,
                  callback: value => Number.isInteger(value) ? value : null
               }
            }
         }
      }
   });
</script>

</body>
</html>

<?php require_once '../footer.php'; ?>