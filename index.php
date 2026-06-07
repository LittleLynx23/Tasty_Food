<?php
require_once 'Config/config.php';
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


$url = isset($_GET['url']) ? $_GET['url'] : 'inicio';
$accion = isset($_GET['accion']) ? $_GET['accion'] : 'inicio';
$id = isset($_GET['id']) ? $_GET['id'] : null;

$ruta = "Controller/" . ucfirst($url) . "Controller.php";

if (file_exists($ruta)) {
    require_once $ruta;
    $controlador = ucfirst($url) . "Controller";
    $controller = new $controlador();
    
    if (method_exists($controller, $accion)) {
        if ($id) {
            $controller->$accion($id);
        } else {
            $controller->$accion();
        }
    } else {
        echo "Acción no encontrada";
    }
} else {
    echo "Controlador no encontrado";
}
?>