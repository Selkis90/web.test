<?php
require_once 'model/Activaciones.php'; // Cargar el modelo

class ActivacionesController
{
    public function create()
    {
        require_once 'views/crearActivacion.php';
    }

    public function store()
    {
        // Verificar si la solicitud es POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recopilar los datos del formulario
            $data = [
                'fecha_activacion' => $_POST['fecha_activacion'],
                'trabajador' => $_POST['trabajador'],
                'tipo_documento' => $_POST['tipo_documento'],
                'identificacion' => $_POST['identificacion'],
                'ciudad' => $_POST['ciudad'],
                'departamento' => $_POST['departamento'],
                'ips' => $_POST['ips'],
                'servicio_prestado_inicial' => $_POST['servicio_prestado_inicial'],
                'rlp' => $_POST['rlp'],
                'medicamentos' => $_POST['medicamentos'],
                'tipo_medicamento' => $_POST['tipo_medicamento'],
                'empresa' => $_POST['empresa'],
                'numero_afiliacion' => $_POST['numero_afiliacion'],
                'pae' => $_POST['pae'],
                'tipo_pae' => $_POST['tipo_pae'],
                'ubicacion_pae' => $_POST['ubicacion_pae'],
                'jornada_activacion' => $_POST['jornada_activacion'],
                'activacion_presencial' => isset($_POST['activacion_presencial']) ? 'SI' : 'NO',
                'hora_activacion_caso' => $_POST['hora_activacion_caso'],
                'hora_activacion_pae' => $_POST['hora_activacion_pae'],
                'tiempo_respuesta_sacs' => $_POST['tiempo_respuesta_sacs'],
                'hora_llegada_pae_ips' => $_POST['hora_llegada_pae_ips']
            ];


            // Instanciar el modelo y guardar los datos
            $model = new Activaciones();
            $resultado = $model->insert($data);

            // Manejar el resultado de la inserción
            if ($resultado) {
                echo "✅ Datos guardados correctamente. Redirigiendo...";
                echo "<script>
        setTimeout(function() {
            window.location.href = '../php/casos.php';
        }, 2000); // Espera 2 segundos antes de redirigir
    </script>";
            } else {
                echo "❌ Error al guardar los datos.";
            }
        } else {
            echo "❌ Solicitud inválida.";
        }
    }
}