<?php
class Conectar {
    protected $conexion;

    public function __construct() {
        try {
        
            $this->conexion = new PDO("mysql:host=" . DB_SERVIDOR . ";dbname=" . DB_NOMBRE . ";charset=utf8mb4", DB_USER, DB_CLAVE);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    protected function getConexion() {
        return $this->conexion;
    }
}
?>