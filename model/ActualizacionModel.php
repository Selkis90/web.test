<?php
require_once "../conexion.php";

class ActualizacionModel {
    private $conexion;

    public function __construct() {
        global $conexion;
        $this->conexion = $conexion;
    }

    /** 📌 Obtener datos de la activación */
    public function obtenerActivacionPorId($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM activaciones WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado;
    }

    /** 📌 Obtener datos actuales de actualización */
    public function obtenerActualizacionPorActivacion($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM actualizacion_activaciones WHERE activacion_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $resultado;
    }

    /** 📌 Crear registro vacío */
    public function crearRegistroVacio($id) {
        $stmt = $this->conexion->prepare("INSERT INTO actualizacion_activaciones (activacion_id) VALUES (?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    /** 🟦 Guardar seguimiento en historial */
    public function guardarSeguimientoHistorial($activacion_id, $texto) {
        if (trim($texto) == "") return;

        $stmt = $this->conexion->prepare("
            INSERT INTO seguimiento_historial (activacion_id, seguimiento) 
            VALUES (?, ?)
        ");

        $stmt->bind_param("is", $activacion_id, $texto);
        $stmt->execute();
        $stmt->close();
    }

    /** 🟦 Obtener historial */
    public function obtenerHistorial($activacion_id) {
        $stmt = $this->conexion->prepare("
            SELECT seguimiento, fecha_registro
            FROM seguimiento_historial
            WHERE activacion_id = ?
            ORDER BY fecha_registro DESC
        ");

        $stmt->bind_param("i", $activacion_id);
        $stmt->execute();
        $resultado = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $resultado;
    }

    /** 📌 Actualizar datos */
    public function actualizarDatos($data) {

        /** -------------------------
         * 🔍 Validar dx_cie10 (TU REGLA)
         * ------------------------- */
        $dx_cie10 = isset($data['dx_cie10']) ? trim($data['dx_cie10']) : "";

        if ($dx_cie10 === "") {
            $dx_cie10 = null;
        } else {
            // ✔ Solo letras y números, máximo 5 caracteres
            if (!preg_match('/^[A-Za-z0-9]{1,5}$/', $dx_cie10)) {
                throw new Exception("El campo dx_cie10 solo permite letras y números, máximo 5 caracteres.");
            }
        }

        /** 🔥 Guardar seguimiento histórico */
        if (!empty($data['seguimiento_nuevo'])) {
            $this->guardarSeguimientoHistorial($data['activacion_id'], $data['seguimiento_nuevo']);
        }

        /** ✔ Actualizar datos principales */
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
            $dx_cie10,
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
?>