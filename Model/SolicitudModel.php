<?php
require_once 'Core/BaseDatos.php';

class SolicitudModel extends Conectar {

    public function __construct() {
        parent::__construct();
    }

  
    public function findAll() {
        try {
            $sql = "SELECT s.*, u.nombre, u.apellido, u.area 
                    FROM solicitud_reposicion s 
                    INNER JOIN usuario u ON s.id_usuario = u.id_usuario 
                    ORDER BY s.fecha_solicitud DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) { die($e->getMessage()); }
    }


    public function findByUsuario($id_usuario) {
        try {
            $sql = "SELECT s.*, u.nombre, u.apellido, u.area 
                    FROM solicitud_reposicion s 
                    INNER JOIN usuario u ON s.id_usuario = u.id_usuario 
                    WHERE s.id_usuario = :id 
                    ORDER BY s.fecha_solicitud DESC";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id_usuario);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) { die($e->getMessage()); }
    }


    public function crear($id_usuario, $total_solicitud, $observacion, $detalles) {
        try {
            $this->conexion->beginTransaction();

    
            $sqlMaestro = "INSERT INTO solicitud_reposicion (fecha_solicitud, estado, total_solicitud, observacion, id_usuario) 
                           VALUES (NOW(), 'Pendiente', :total, :obs, :id_usu)";
            $stmt1 = $this->conexion->prepare($sqlMaestro);
            $stmt1->execute([
                ':total' => $total_solicitud,
                ':obs' => $observacion,
                ':id_usu' => $id_usuario
            ]);
            
            $id_solicitud = $this->conexion->lastInsertId();


            $sqlDetalle = "INSERT INTO detalle_solicitud (cantidad_solicitada, precio_unitario, subtotal, id_solicitud, id_insumo) 
                           VALUES (:cant, :precio, :sub, :id_sol, :id_ins)";
            $stmt2 = $this->conexion->prepare($sqlDetalle);

            foreach ($detalles as $item) {
                $stmt2->execute([
                    ':cant' => $item['cantidad'],
                    ':precio' => $item['precio'],
                    ':sub' => $item['subtotal'],
                    ':id_sol' => $id_solicitud,
                    ':id_ins' => $item['id_insumo']
                ]);
            }

            $this->conexion->commit();
            return true;
        } catch(Exception $e) {
            $this->conexion->rollBack();
            die($e->getMessage());
        }
    }

    public function cambiarEstado($id_solicitud, $nuevo_estado) {
        try {
            $this->conexion->beginTransaction();

      
            $sql = "UPDATE solicitud_reposicion SET estado = :estado WHERE id_solicitud = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute([':estado' => $nuevo_estado, ':id' => $id_solicitud]);


            if ($nuevo_estado == 'Aprobada') {
                $sqlDetalles = "SELECT id_insumo, cantidad_solicitada FROM detalle_solicitud WHERE id_solicitud = :id";
                $stmtDet = $this->conexion->prepare($sqlDetalles);
                $stmtDet->execute([':id' => $id_solicitud]);
                $items = $stmtDet->fetchAll(PDO::FETCH_ASSOC);

                $sqlUpdateInv = "UPDATE inventario SET cantidad_actual = cantidad_actual + :cant, fecha_actualizacion = NOW() WHERE id_insumo = :id_ins";
                $stmtInv = $this->conexion->prepare($sqlUpdateInv);

                foreach ($items as $item) {
                    $stmtInv->execute([
                        ':cant' => $item['cantidad_solicitada'],
                        ':id_ins' => $item['id_insumo']
                    ]);
                }
            }

            $this->conexion->commit();
            return true;
        } catch(Exception $e) {
            $this->conexion->rollBack();
            die($e->getMessage());
        }
    }


    
    public function findById($id_solicitud) {
        try {
            $sql = "SELECT s.*, u.nombre, u.apellido, u.area 
                    FROM solicitud_reposicion s 
                    INNER JOIN usuario u ON s.id_usuario = u.id_usuario 
                    WHERE s.id_solicitud = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id_solicitud);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) { die($e->getMessage()); }
    }

   
    public function findDetalles($id_solicitud) {
        try {
            $sql = "SELECT d.*, i.nombre as nombre_insumo, i.unidad_medida 
                    FROM detalle_solicitud d 
                    INNER JOIN insumo i ON d.id_insumo = i.id_insumo 
                    WHERE d.id_solicitud = :id";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id', $id_solicitud);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) { die($e->getMessage()); }
    }
    
}
?>