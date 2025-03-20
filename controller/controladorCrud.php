<?php
// ActivacionesController.php

require_once 'models/activacionesModel.php';

class ActivacionesController
{
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Recolectar datos del formulario
            $data = [
                'fecha_activacion' => $_POST['fecha_activacion'],
                'trabajador' => $_POST['trabajador'],
                'identificacion' => $_POST['identificacion'],
                'ciudad' => $_POST['ciudad'],
                'departamento' => $_POST['departamento'],
                'ips' => $_POST['ips'],
                'servicio_prestado_inicial' => $_POST['servicio_prestado_inicial'],
                'dias_it_inicial' => $_POST['dias_it_inicial'],
                'dias_it_acumulado' => $_POST['dias_it_acumulado'],
                'rlp' => $_POST['rlp'],
                'pqr_evento_adverso' => $_POST['pqr_evento_adverso'],
                'rlp_exitoso' => isset($_POST['rlp_exitoso']) ? 1 : 0,
                'razon_rlp_no_exitoso' => $_POST['razon_rlp_no_exitoso'],
                'medicamentos' => $_POST['medicamentos'],
                'tipo_medicamento' => $_POST['tipo_medicamento'],
                'medios_diagnosticos' => $_POST['medios_diagnosticos'],
                'empresa' => $_POST['empresa'],
                'afiliacion' => $_POST['afiliacion'],
                'tipo_pae' => $_POST['tipo_pae'],
                'ubicacion_pae' => $_POST['ubicacion_pae'],
                'dx_inicial' => $_POST['dx_inicial'],
                'dx_cie10' => $_POST['dx_cie10'],
                'descripcion_cie10' => $_POST['descripcion_cie10'],
                'jornada_activacion' => $_POST['jornada_activacion'],
                'activacion_presencial' => isset($_POST['activacion_presencial']) ? 1 : 0,
                'hora_activacion_caso' => $_POST['hora_activacion_caso'],
                'hora_activacion_pae' => $_POST['hora_activacion_pae'],
                'tiempo_respuesta_sacs' => $_POST['tiempo_respuesta_sacs'],
                'hora_llegada_pae' => $_POST['hora_llegada_pae']
            ];

            // Llamar al modelo para insertar los datos
            $activacionesModel = new ActivacionesModel();
            $result = $activacionesModel->insert($data);

            if ($result) {
                echo "Datos guardados correctamente.";
            } else {
                echo "Error al guardar los datos.";
            }
        } else {
            // Mostrar la vista del formulario de creación
            require_once 'views/createActivacion.php';
        }
    }
}
