<?php
require_once 'Model/UsuarioModel.php';

class UsuarioController {

    private $modelo;

    public function __construct() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL . "login/inicio");
            exit;
        }
        // 
        if ($_SESSION['id_rol'] != 1) {
            header("Location: " . BASE_URL);
            exit;
        }
        $this->modelo = new UsuarioModel();
    }

    public function inicio() {
           
            $usuarios = $this->modelo->findAll();
            require_once 'View/Usuarios/index.php';
    }

  
    public function nuevo() {
    
        require_once 'View/Usuarios/nuevo.php';
    }


    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            require_once 'Entities/Usuario.php';
            
         
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $correo = $_POST['correo'];
            $area = $_POST['area'];
            $id_rol = $_POST['id_rol']; 
            
           
            $contrasenaSegura = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

            $nuevoUsuario = new Usuario(null, $nombre, $apellido, $cedula, $correo, $area, $contrasenaSegura, $id_rol);

            $this->modelo->create($nuevoUsuario);

            header("Location: " . BASE_URL . "Usuario/inicio");
            exit();
        }
    }

  
    public function editar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $usuario = $this->modelo->findById($id);
            require_once 'View/Usuarios/editar.php';
        }
    }


    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'Entities/Usuario.php';
            
   
            $id_usuario = $_POST['id_usuario']; 
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $correo = $_POST['correo'];
            $area = $_POST['area'];
            $id_rol = $_POST['id_rol']; 

            $usuarioExistente = $this->modelo->findById($id_usuario);
            $contrasenaActual = $usuarioExistente->getContrasena();

     
            if (!empty($_POST['contrasena'])) {
      
                $contrasenaFinal = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
            } else {
     
                $contrasenaFinal = $contrasenaActual;
            }

            $usuarioEditado = new Usuario(
                $id_usuario, 
                $nombre, 
                $apellido, 
                $cedula, 
                $correo, 
                $area, 
                $contrasenaFinal, 
                $id_rol
            );

      
            $this->modelo->update($usuarioEditado);

        
            header("Location: " . BASE_URL . "Usuario/inicio");
            exit();
        }
    }


 
    public function eliminar() {
     
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
         
            $this->modelo->eliminarUsuario($id);
        }
        
        header("Location: " . BASE_URL . "Usuario/inicio");
        exit();
    }
}
?>