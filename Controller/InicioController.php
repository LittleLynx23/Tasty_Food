<?php
class InicioController {
    
    public function inicio() {
        if (!isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL . "login/inicio");
            exit;
        }

        require_once "View/Templates/header.php";
        require_once "View/inicio/index.php";
        require_once "View/Templates/footer.php";
    }
}
?>