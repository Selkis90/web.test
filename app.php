<?php
require_once 'config/database.php';
require_once 'config/sesion.php';

$controller = $_GET['controller'] ?? 'activaciones';
$action = $_GET['action'] ?? 'create';

$controllerFile = "controller/" . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . "Controller";

    if (class_exists($controllerClass)) {
        $objController = new $controllerClass();

        if (method_exists($objController, $action)) {
            $objController->$action();
        } else {
            die("❌ La acción '$action' no existe.");
        }
    } else {
        die("❌ El controlador '$controllerClass' no está definido.");
    }
} else {
    die("❌ El archivo '$controllerFile' no existe.");
}
