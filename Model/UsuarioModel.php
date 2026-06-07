<?php
require_once 'Core/BaseDatos.php';
require_once 'Entities/Usuario.php';

class UsuarioModel extends Conectar {

    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        try {
            $sql = "SELECT * FROM usuario"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();   
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            
            $lista = [];
            foreach ($resultados as $fila) {
            
                $usuario = new Usuario(
                    $fila['id_usuario'], 
                    $fila['nombre'], 
                    $fila['apellido'], 
                    $fila['cedula'], 
                    $fila['correo'], 
                    $fila['area'], 
                    $fila['contrasena'], 
                    $fila['id_rol']
                );
                $lista[] = $usuario;
            }
            return $lista;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function findById($id) {
        try {
            $sql = "SELECT * FROM usuario WHERE id_usuario = :id";                
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);                      
            $sentencia->execute();          
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);   
            
            if($resultado) { 
                $usuario = new Usuario(
                    $resultado['id_usuario'], $resultado['nombre'], $resultado['apellido'], 
                    $resultado['cedula'], $resultado['correo'], $resultado['area'], $resultado['contrasena'], $resultado['id_rol']
                );
                return $usuario;
            } else {
                return null;
            }
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }    

    public function create(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuario (nombre, apellido, cedula, correo, area, contrasena, id_rol) 
                    VALUES (:nombre, :apellido, :cedula, :correo, :area, :contrasena, :id_rol)";
            $sentencia = $this->conexion->prepare($sql);    
            $sentencia->bindValue(':nombre', $usuario->getNombre());       
            $sentencia->bindValue(':apellido', $usuario->getApellido());  
            $sentencia->bindValue(':cedula', $usuario->getCedula());
            $sentencia->bindValue(':correo', $usuario->getCorreo());
            $sentencia->bindValue(':area', $usuario->getArea());
            $sentencia->bindValue(':contrasena', $usuario->getContrasena());
            $sentencia->bindValue(':id_rol', $usuario->getIdRol());  

            $sentencia->execute();
            $result = $this->conexion->lastInsertId();
            return $result;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    } 


    public function update(Usuario $usuario) {
        try {
            $sql = "UPDATE usuario SET nombre = :nombre, apellido = :apellido, cedula = :cedula, 
                    correo = :correo, area = :area, contrasena = :contrasena, id_rol = :id_rol WHERE id_usuario = :id";
            $sentencia = $this->conexion->prepare($sql);    
            
            $sentencia->bindValue(':nombre', $usuario->getNombre());       
            $sentencia->bindValue(':apellido', $usuario->getApellido());  
            $sentencia->bindValue(':cedula', $usuario->getCedula());
            $sentencia->bindValue(':correo', $usuario->getCorreo());
            $sentencia->bindValue(':area', $usuario->getArea());
            $sentencia->bindValue(':contrasena', $usuario->getContrasena());
            $sentencia->bindValue(':id_rol', $usuario->getIdRol());
            $sentencia->bindValue(':id', $usuario->getIdUsuario());    

            $sentencia->execute();
            return ($sentencia->rowCount() > 0) ? true : false;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }    

  
    public function eliminarUsuario($id) {
        try {
            $sql = "DELETE FROM usuario WHERE id_usuario = :id";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            return ($sentencia->rowCount() > 0) ? true : false;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}    
?>