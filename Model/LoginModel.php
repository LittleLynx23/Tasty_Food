<?php
require_once "Core/BaseDatos.php";

class LoginModel extends Conectar {
    
    public function __construct() {
        parent::__construct();
    }

  
    public function validarUsuario($correo, $contrasena, $id_rol) {
        try {
            $sql = "SELECT u.id_usuario, u.nombre, u.apellido, u.correo, r.nombre_rol 
                    FROM usuario u 
                    INNER JOIN rol r ON u.id_rol = r.id_rol 
                    WHERE u.correo = :correo 
                      AND u.contrasena = :contrasena 
                      AND u.id_rol = :id_rol";
            
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(':correo', $correo, PDO::PARAM_STR);
            $consulta->bindValue(':contrasena', $contrasena, PDO::PARAM_STR);
            $consulta->bindValue(':id_rol', $id_rol, PDO::PARAM_INT);
            $consulta->execute();
            
           
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die("Error en LoginModel: " . $e->getMessage());
        }
    }
}
?>