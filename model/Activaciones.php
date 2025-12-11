<?php
require_once 'conexion.php'; // ya contiene $conexion

class Activaciones
{
    public function insert($data)
    {
        global $conexion;

        $stmt = $conexion->prepare("
        INSERT INTO activaciones (
            fecha_activacion, trabajador, tipo_documento, identificacion,
            ciudad, departamento, ips, servicio_prestado_inicial, rlp,
            medicamentos, tipo_medicamento, empresa, numero_afiliacion,
            pae, tipo_pae, ubicacion_pae, jornada_activacion,
            activacion_presencial, hora_activacion_caso, hora_activacion_pae,
            tiempo_respuesta_sacs, hora_llegada_pae_ips
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

        if (!$stmt) {
            error_log("Error al preparar la consulta: " . $conexion->error);
            return false;
        }

        $stmt->bind_param(
            "ssssssssssssssssssssss",  // 22 "s"
            $data['fecha_activacion'],
            $data['trabajador'],
            $data['tipo_documento'],
            $data['identificacion'],
            $data['ciudad'],
            $data['departamento'],
            $data['ips'],
            $data['servicio_prestado_inicial'],
            $data['rlp'],
            $data['medicamentos'],
            $data['tipo_medicamento'],
            $data['empresa'],
            $data['numero_afiliacion'],
            $data['pae'],
            $data['tipo_pae'],
            $data['ubicacion_pae'],
            $data['jornada_activacion'],
            $data['activacion_presencial'],
            $data['hora_activacion_caso'],
            $data['hora_activacion_pae'],
            $data['tiempo_respuesta_sacs'],
            $data['hora_llegada_pae_ips']
        );

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }
}
