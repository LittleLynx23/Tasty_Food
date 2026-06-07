<?php
require_once 'Core/BaseDatos.php';
require_once 'Entities/Insumo.php';

class InsumoModel extends Conectar {

    public function __construct() {
        parent::__construct();
    }

    public function findAll() {
        try {
            
            $sql = "SELECT i.id_insumo, i.nombre, i.descripcion, i.id_categoria, c.nombre_categoria, i.unidad_medida, i.stock_minimo, i.precio_base, 
                           COALESCE(v.cantidad_actual, 0) as cantidad_actual, v.fecha_actualizacion 
                    FROM insumo i 
                    LEFT JOIN inventario v ON i.id_insumo = v.id_insumo
                    LEFT JOIN categoria c ON i.id_categoria = c.id_categoria"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->execute();   
            $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);                           
            
            $lista = [];
            foreach ($resultados as $fila) {
                $insumo = new Insumo(
                    $fila['id_insumo'], $fila['nombre'], $fila['descripcion'], 
                    $fila['id_categoria'], $fila['unidad_medida'], $fila['stock_minimo'], 
                    $fila['precio_base'], $fila['cantidad_actual'], $fila['fecha_actualizacion'],
                    $fila['nombre_categoria'] 
                );
                $lista[] = $insumo;
            }
            return $lista;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }


    public function create(Insumo $insumo) {
        try {
            $this->conexion->beginTransaction();

          
            $sql1 = "INSERT INTO insumo (nombre, descripcion, id_categoria, unidad_medida, stock_minimo, precio_base) 
                     VALUES (:nombre, :descripcion, :id_categoria, :unidad_medida, :stock_minimo, :precio_base)";
            $sentencia1 = $this->conexion->prepare($sql1);    
            
            $sentencia1->bindValue(':nombre', $insumo->getNombre());       
            $sentencia1->bindValue(':descripcion', $insumo->getDescripcion());  
            $sentencia1->bindValue(':id_categoria', $insumo->getIdCategoria()); 
            $sentencia1->bindValue(':unidad_medida', $insumo->getUnidadMedida()); 
            $sentencia1->bindValue(':stock_minimo', $insumo->getStockMinimo());
            $sentencia1->bindValue(':precio_base', $insumo->getPrecioBase());

            $sentencia1->execute();
            $id_creado = $this->conexion->lastInsertId();

      
            $sql2 = "INSERT INTO inventario (id_insumo, cantidad_actual, fecha_actualizacion) 
                     VALUES (:id_insumo, :cantidad, NOW())";
            $sentencia2 = $this->conexion->prepare($sql2);
            $sentencia2->bindValue(':id_insumo', $id_creado);
            $sentencia2->bindValue(':cantidad', $insumo->getCantidadActual()); 
            $this->conexion->commit();
            return $id_creado;
        } catch(Exception $e) {
            $this->conexion->rollBack();
            die($e->getMessage());
        }
    } 

    public function update(Insumo $insumo) {
        try {
            $this->conexion->beginTransaction();

   
            $sql1 = "UPDATE insumo SET nombre = :nombre, descripcion = :descripcion, id_categoria = :id_categoria, 
                    unidad_medida = :unidad_medida, stock_minimo = :stock_minimo, precio_base = :precio_base 
                    WHERE id_insumo = :id";
            $sentencia1 = $this->conexion->prepare($sql1);    
            
            $sentencia1->bindValue(':nombre', $insumo->getNombre()); 
            $sentencia1->bindValue(':descripcion', $insumo->getDescripcion());      
            $sentencia1->bindValue(':id_categoria', $insumo->getIdCategoria());  
            $sentencia1->bindValue(':unidad_medida', $insumo->getUnidadMedida()); 
            $sentencia1->bindValue(':stock_minimo', $insumo->getStockMinimo());
            $sentencia1->bindValue(':precio_base', $insumo->getPrecioBase());
            $sentencia1->bindValue(':id', $insumo->getIdInsumo());    
            $sentencia1->execute();

         
            $sql2 = "UPDATE inventario SET cantidad_actual = :cantidad, fecha_actualizacion = NOW() WHERE id_insumo = :id_insumo";
            $sentencia2 = $this->conexion->prepare($sql2);
            $sentencia2->bindValue(':cantidad', $insumo->getCantidadActual());
            $sentencia2->bindValue(':id_insumo', $insumo->getIdInsumo());
            $sentencia2->execute();

            $this->conexion->commit();
            return true;
        } catch(Exception $e) {
            $this->conexion->rollBack();
            die($e->getMessage());
        }
    }


    public function findById($id) {
        try {
            $sql = "SELECT i.id_insumo, i.nombre, i.descripcion, i.id_categoria, c.nombre_categoria, i.unidad_medida, i.stock_minimo, i.precio_base, 
                           COALESCE(v.cantidad_actual, 0) as cantidad_actual, v.fecha_actualizacion 
                    FROM insumo i 
                    LEFT JOIN inventario v ON i.id_insumo = v.id_insumo
                    LEFT JOIN categoria c ON i.id_categoria = c.id_categoria
                    WHERE i.id_insumo = :id"; 
            $consulta = $this->conexion->prepare($sql);
            $consulta->bindValue(':id', $id);
            $consulta->execute();   
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);                           
            
            if ($fila) {
                return new Insumo(
                    $fila['id_insumo'], $fila['nombre'], $fila['descripcion'], 
                    $fila['id_categoria'], $fila['unidad_medida'], $fila['stock_minimo'], 
                    $fila['precio_base'], $fila['cantidad_actual'], $fila['fecha_actualizacion'],
                    $fila['nombre_categoria']
                );
            }
            return null;
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarInsumo($id) {
        try {
        
            $sql1 = "DELETE FROM inventario WHERE id_insumo = :id";
            $consulta1 = $this->conexion->prepare($sql1);
            $consulta1->bindValue(':id', $id);
            $consulta1->execute();
            $sql2 = "DELETE FROM insumo WHERE id_insumo = :id";
            $consulta2 = $this->conexion->prepare($sql2);
            $consulta2->bindValue(':id', $id);
            $consulta2->execute();
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }
}    
?>