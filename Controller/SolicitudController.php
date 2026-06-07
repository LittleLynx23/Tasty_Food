<?php
require_once 'Model/SolicitudModel.php';
require_once 'Model/InsumoModel.php'; 

class SolicitudController {
    private $modelo;
    private $modeloInsumo;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL . "login/inicio");
            exit;
        }
        $this->modelo = new SolicitudModel();
        $this->modeloInsumo = new InsumoModel();
    }

    public function inicio() {

        if ($_SESSION['id_rol'] == 1) {
            $solicitudes = $this->modelo->findAll();
        } else {
            $solicitudes = $this->modelo->findByUsuario($_SESSION['id_usuario']);
        }
        require_once 'View/Solicitudes/index.php';
    }

    public function nuevo() {
  
        $insumos = $this->modeloInsumo->findAll();
        require_once 'View/Solicitudes/nuevo.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_SESSION['id_usuario']; 
            $observacion = $_POST['observacion'];
            
         
            $detallesJSON = $_POST['detalles_ocultos']; 
            $detallesArray = json_decode($detallesJSON, true);

          
            $total_solicitud = 0;
            foreach ($detallesArray as $item) {
                $total_solicitud += $item['subtotal'];
            }

            // Guardamos
            if(count($detallesArray) > 0) {
                $this->modelo->crear($id_usuario, $total_solicitud, $observacion, $detallesArray);
            }

            header("Location: " . BASE_URL . "Solicitud/inicio");
            exit();
        }
    }

   
    public function procesar() {
        if ($_SESSION['id_rol'] == 1 && isset($_GET['id']) && isset($_GET['estado'])) {
            $id = $_GET['id'];
            $estado = $_GET['estado']; 
            $this->modelo->cambiarEstado($id, $estado);
        }
        header("Location: " . BASE_URL . "Solicitud/inicio");
        exit();
    }


    public function ver() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
           
            $solicitud = $this->modelo->findById($id);
            $detalles = $this->modelo->findDetalles($id);
            
        
            require_once 'View/Solicitudes/ver.php';
        } else {
            header("Location: " . BASE_URL . "Solicitud/inicio");
            exit();
        }
    }

}



?>