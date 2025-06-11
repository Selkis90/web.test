<?php
require_once '../config/sesion.php';
require_once '../header.php';
require_once '../conexion.php';

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
while ($row = $resPAE->fetch_assoc()) {
   $paeLabels[] = $row['tipo_pae'];
   $paeValores[] = (int)$row['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <title>Gráficas Activaciones</title>
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <style>
      canvas {
         margin: 30px auto;
         max-width: 800px;
         width: 100%;
         display: block;
      }

      h3 {
         text-align: center;
      }
   </style>
</head>

<body>
   <form method="GET" style="text-align:center; margin:20px;">
      <label for="empresa">Empresa:</label>
      <input type="text" name="empresa" value="<?= isset($_GET['empresa']) ? htmlspecialchars($_GET['empresa']) : '' ?>">

      <label for="desde">Desde:</label>
      <input type="date" name="desde" value="<?= $_GET['desde'] ?? '' ?>">

      <label for="hasta">Hasta:</label>
      <input type="date" name="hasta" value="<?= $_GET['hasta'] ?? '' ?>">

      <button type="submit">Filtrar</button>
   </form>


   <h2 style="text-align:center;">Gráficas de Activaciones</h2>

   <!-- 1. RLP por mes -->
   <h3>Distribución RLP por Mes</h3>
   <canvas id="rlpChart"></canvas>

   <!-- 2. Activación presencial -->
   <h3>Tipo de Activación (Presencial o NO)</h3>
   <canvas id="presencialChart"></canvas>

   <!-- 3. Tipos de PAE -->
   <h3>Tipos de PAE más Usados</h3>
   <canvas id="paeChart"></canvas>

   <script>
      // RLP por mes
      new Chart(document.getElementById('rlpChart').getContext('2d'), {
         type: 'bar',
         data: {
            labels: <?= json_encode($rlpLabels) ?>,
            datasets: [{
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
               title: {
                  display: true,
                  text: 'Distribución RLP por Mes'
               }
            }
         }
      });

      // Activación presencial (dona)
      new Chart(document.getElementById('presencialChart').getContext('2d'), {
         type: 'doughnut',
         data: {
            labels: <?= json_encode($presencialLabels) ?>,
            datasets: [{
               data: <?= json_encode($presencialValores) ?>,
               backgroundColor: ['#36A2EB', '#FF6384']
            }]
         },
         options: {
            plugins: {
               title: {
                  display: true,
                  text: 'Activaciones Presenciales vs No Presenciales'
               }
            }
         }
      });

      // Tipo de PAE (barras horizontales si quieres cambiar: `type: 'bar'` y agregar `indexAxis: 'y'`)
      new Chart(document.getElementById('paeChart').getContext('2d'), {
         type: 'bar',
         data: {
            labels: <?= json_encode($paeLabels) ?>,
            datasets: [{
               label: 'Cantidad',
               data: <?= json_encode($paeValores) ?>,
               backgroundColor: 'rgba(153, 102, 255, 0.7)'
            }]
         },
         options: {
            responsive: true,
            plugins: {
               title: {
                  display: true,
                  text: 'Tipos de PAE más utilizados'
               }
            }
         }
      });
   </script>

</body>

</html>

<?php require_once '../footer.php'; ?>