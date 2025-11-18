<?php
require_once "../conexion.php";

class ActualizacionModel {
    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    public function obtenerActivacionPorId($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM activaciones WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado;
    }

    public function obtenerActualizacionPorActivacion($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM actualizacion_activaciones WHERE activacion_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado;
    }

    public function crearRegistroVacio($id) {
        $stmt = $this->conexion->prepare("INSERT INTO actualizacion_activaciones (activacion_id) VALUES (?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function actualizarDatos($data) {

        /** 🔍 VALIDACIÓN DEL CAMPO dx_cie10  
         * Solo permite letras y números  
         * Máximo 5 caracteres  
         */
        if (!preg_match('/^[A-Za-z0-9]{1,5}$/', $data['dx_cie10'])) {
            throw new Exception("El campo dx_cie10 solo permite hasta 5 caracteres alfanuméricos (A-Z, 0-9).");
        }

        $stmt = $this->conexion->prepare("
            UPDATE actualizacion_activaciones SET 
                dias_it_inicial = ?, 
                dias_it_acumulado = ?, 
                pqr_evento_adverso = ?, 
                razon_rlp_no_exitoso = ?, 
                medios_diagnosticos = ?, 
                dx_inicial = ?, 
                dx_cie10 = ?, 
                descripcion_cie10 = ?, 
                hora_finalizacion_caso = ?, 
                fecha_finalizacion_caso = ?, 
                seguimiento = ?
            WHERE id = ?
        ");

        $stmt->bind_param(
            "iisssssssssi",
            $data['dias_it_inicial'],
            $data['dias_it_acumulado'],
            $data['pqr_evento_adverso'],
            $data['razon_rlp_no_exitoso'],
            $data['medios_diagnosticos'],
            $data['dx_inicial'],
            $data['dx_cie10'],
            $data['descripcion_cie10'],
            $data['hora_finalizacion_caso'],
            $data['fecha_finalizacion_caso'],
            $data['seguimiento'],
            $data['id']
        );

        $stmt->execute();
        $stmt->close();
    }
}
