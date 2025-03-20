<?php
// activacionesModel.php

class ActivacionesModel
{
    private $db;

    public function __construct()
    {
        // Conexión a la base de datos (ajustar parámetros según sea necesario)
        $this->db = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

        if ($this->db->connect_error) {
            die("Conexión fallida: " . $this->db->connect_error);
        }
    }

    public function insert($data)
    {
        // Preparar la consulta SQL para insertar los datos
        $query = "INSERT INTO activaciones (fecha_activacion, trabajador, identificacion, ciudad, departamento, ips, servicio_prestado_inicial, dias_it_inicial, dias_it_acumulado, rlp, pqr_evento_adverso, rlp_exitoso, razon_rlp_no_exitoso, medicamentos, tipo_medicamento, medios_diagnosticos, empresa, afiliacion, tipo_pae, ubicacion_pae, dx_inicial, dx_cie10, descripcion_cie10, jornada_activacion, activacion_presencial, hora_activacion_caso, hora_activacion_pae, tiempo_respuesta_sacs, hora_llegada_pae) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'ssssssssssssssssssssssssssssss',
            $data['fecha_activacion'],
            $data['trabajador'],
            $data['identificacion'],
            $data['ciudad'],
            $data['departamento'],
            $data['ips'],
            $data['servicio_prestado_inicial'],
            $data['dias_it_inicial'],
            $data['dias_it_acumulado'],
            $data['rlp'],
            $data['pqr_evento_adverso'],
            $data['rlp_exitoso'],
            $data['razon_rlp_no_exitoso'],
            $data['medicamentos'],
            $data['tipo_medicamento'],
            $data['medios_diagnosticos'],
            $data['empresa'],
            $data['afiliacion'],
            $data['tipo_pae'],
            $data['ubicacion_pae'],
            $data['dx_inicial'],
            $data['dx_cie10'],
            $data['descripcion_cie10'],
            $data['jornada_activacion'],
            $data['activacion_presencial'],
            $data['hora_activacion_caso'],
            $data['hora_activacion_pae'],
            $data['tiempo_respuesta_sacs'],
            $data['hora_llegada_pae']
        );

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
