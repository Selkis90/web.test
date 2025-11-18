<?php
require_once "../model/ActualizacionModel.php";

class ActualizacionController
{
    private $model;

    public function __construct()
    {
        $this->model = new ActualizacionModel();
    }

    public function mostrarFormulario($id)
    {
        $activacion = $this->model->obtenerActivacionPorId($id);
        if (!$activacion) {
            die("Activación no encontrada.");
        }

        $detalle = $this->model->obtenerActualizacionPorActivacion($id);
        if (!$detalle) {
            $this->model->crearRegistroVacio($id);
            $detalle = $this->model->obtenerActualizacionPorActivacion($id);
        }

        return ['activacion' => $activacion, 'detalle' => $detalle];
    }

    public function guardarActualizacion($data)
    {
        $this->model->actualizarDatos($data);
        header("Location: ../php/listar_casos.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new ActualizacionController();
    $controller->guardarActualizacion($_POST);
}
