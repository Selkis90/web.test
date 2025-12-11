<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../model/ActualizacionModel.php";
require_once "../conexion.php"; // NECESARIO para historial

class ActualizacionController
{
    private $model;
    private $db;

    public function __construct()
    {
        $this->model = new ActualizacionModel();
        global $conexion;
        $this->db = $conexion;
    }

    /** 📌 Mostrar formulario + historial */
    public function mostrarFormulario($id)
    {
        // Activación
        $activacion = $this->model->obtenerActivacionPorId($id);
        if (!$activacion) {
            die("Activación no encontrada.");
        }

        // Datos actuales
        $detalle = $this->model->obtenerActualizacionPorActivacion($id);
        if (!$detalle) {
            $this->model->crearRegistroVacio($id);
            $detalle = $this->model->obtenerActualizacionPorActivacion($id);
        }

        // 🔥 Obtener historial de seguimientos
        $sql = "SELECT * FROM seguimiento_historial 
                WHERE activacion_id = $id 
                ORDER BY fecha_registro ASC";

        $historial = [];
        $res = $this->db->query($sql);

        if ($res && $res->num_rows > 0) {
            while ($fila = $res->fetch_assoc()) {
                $historial[] = $fila;
            }
        }

        return [
            'activacion' => $activacion,
            'detalle'    => $detalle,
            'historial'  => $historial
        ];
    }

    /** 📌 Guardar actualización + historial */
    public function guardarActualizacion($data)
    {
        if (!isset($data['activacion_id'])) {
            die("Error: activacion_id no recibido.");
        }

        

        // Guardar actualización normal
        $this->model->actualizarDatos($data);

        // 📌 Guardar nuevo seguimiento en el historial
        if (!empty($data['seguimiento_nuevo'])) {

            $seguimiento = $this->db->real_escape_string($data['seguimiento_nuevo']);
            $activacion_id = intval($data['activacion_id']);

            $sql = "INSERT INTO seguimiento_historial (activacion_id, seguimiento)
                    VALUES ($activacion_id, '$seguimiento')";

            $this->db->query($sql);
        }

        // 📌 Redirigir correctamente
        header("Location: ../php/listar_casos.php?id=" . $data['activacion_id'] . "&success=1");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ActualizacionController();
    $controller->guardarActualizacion($_POST);
}