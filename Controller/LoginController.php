<?php
require_once "Model/LoginModel.php";

class LoginController {
    private $modelo_login;

    public function __construct() {
        $this->modelo_login = new LoginModel();
    }


    public function inicio() {
  
        if (isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL);
            exit;
        }
        require_once "View/login/index.php";
    }

   
    public function ingresar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $correo = trim($_POST['correo']);
            $contrasena = trim($_POST['contrasena']);
            $id_rol = intval($_POST['id_rol']);

            if (!empty($correo) && !empty($contrasena) && !empty($id_rol)) {
                $usuario = $this->modelo_login->validarUsuario($correo, $contrasena, $id_rol);

                if ($usuario) {
                
                    $_SESSION['id_usuario']  = $usuario['id_usuario'];
                    $_SESSION['nombre']      = $usuario['nombre'] . " " . $usuario['apellido'];
                    $_SESSION['rol']         = $usuario['nombre_rol'];
                    $_SESSION['id_rol']      = $id_rol;
                    
                    header("Location: " . BASE_URL);
                    exit;
                } else {
                    header("Location: " . BASE_URL . "login/inicio?error=datos_incorrectos");
                    exit;
                }
            } else {
                header("Location: " . BASE_URL . "login/inicio?error=campos_vacios");
                exit;
            }
        }
    }


    public function salir() {
        session_destroy();
        header("Location: " . BASE_URL . "login/inicio");
        exit;
    }
}
?>