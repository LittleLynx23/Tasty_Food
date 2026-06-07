<?php
require_once 'Model/InsumoModel.php';

class InsumoController {

    private $modelo;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL . "login/inicio");
            exit;
        }
        $this->modelo = new InsumoModel();
    }


    public function inicio() {
        $insumos = $this->modelo->findAll();
        require_once 'View/Insumos/index.php';
    }

  
    public function nuevo() {
        if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) { header("Location: " . BASE_URL . "Insumo/inicio"); exit(); }
        require_once 'View/Insumos/nuevo.php';
    }

   
   public function registrar() {
    if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) { header("Location: " . BASE_URL . "Insumo/inicio"); exit(); }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'Entities/Insumo.php';
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id_categoria = $_POST['id_categoria'];
            $unidad_medida = $_POST['unidad_medida']; 
            $stock_minimo = $_POST['stock_minimo'];
            $precio_base = $_POST['precio_base'];
            $cantidad_actual = $_POST['cantidad_actual']; 
            
         
            $nuevoInsumo = new Insumo(null, $nombre, $descripcion, $id_categoria, $unidad_medida, $stock_minimo, $precio_base, $cantidad_actual);

            $this->modelo->create($nuevoInsumo);

            header("Location: " . BASE_URL . "Insumo/inicio");
            exit();
        }
    }


    public function editar() {
        if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) { header("Location: " . BASE_URL . "Insumo/inicio"); exit(); }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $insumo = $this->modelo->findById($id);
            require_once 'View/Insumos/editar.php';
        }
    }


    public function actualizar() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                require_once 'Entities/Insumo.php';
                
                $id_insumo = $_POST['id_insumo']; 
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $id_categoria = $_POST['id_categoria'];
                $unidad_medida = $_POST['unidad_medida']; 
                $stock_minimo = $_POST['stock_minimo'];
                $precio_base = $_POST['precio_base'];
                
                
                $cantidad_actual = $_POST['cantidad_actual'];
              
                $insumoEditado = new Insumo($id_insumo, $nombre, $descripcion, $id_categoria, $unidad_medida, $stock_minimo, $precio_base, $cantidad_actual);
           
                $this->modelo->update($insumoEditado);
                header("Location: " . BASE_URL . "Insumo/inicio");
                exit();
            }
        }

   
    public function eliminar() {
        if (!isset($_SESSION['id_rol']) || $_SESSION['id_rol'] != 1) { header("Location: " . BASE_URL . "Insumo/inicio"); exit(); }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->modelo->eliminarInsumo($id);
        }
        header("Location: " . BASE_URL . "Insumo/inicio");
        exit();
    }
}
?>