<?php
class Insumo {
    private $id_insumo;
    private $nombre;
    private $descripcion;
    private $id_categoria;
    private $unidad_medida;
    private $stock_minimo;
    private $precio_base;
    private $cantidad_actual;
    private $fecha_actualizacion;
    private $nombre_categoria;

   
    public function __construct($id_insumo = null, $nombre = null, $descripcion = null, $id_categoria = null, $unidad_medida = null, $stock_minimo = null, $precio_base = null, $cantidad_actual = null, $fecha_actualizacion = null, $nombre_categoria = null) {
        $this->id_insumo = $id_insumo;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_categoria = $id_categoria;
        $this->unidad_medida = $unidad_medida;
        $this->stock_minimo = $stock_minimo;
        $this->precio_base = $precio_base;
        $this->cantidad_actual = $cantidad_actual;
        $this->fecha_actualizacion = $fecha_actualizacion;
        $this->nombre_categoria = $nombre_categoria;
    }

    // Getters
    public function getIdInsumo() { return $this->id_insumo; }
    public function getNombre() { return $this->nombre; }
    public function getDescripcion() { return $this->descripcion; }
    public function getIdCategoria() { return $this->id_categoria; }
    public function getUnidadMedida() { return $this->unidad_medida; }
    public function getStockMinimo() { return $this->stock_minimo; }
    public function getPrecioBase() { return $this->precio_base; }
    public function getCantidadActual() { return $this->cantidad_actual; }
    public function getFechaActualizacion() { return $this->fecha_actualizacion; }
    public function getNombreCategoria() { return $this->nombre_categoria; }

     public function setIdInsumo($id_insumo) { $this->id_insumo = $id_insumo; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setDescripcion($descripcion) { $this->descripcion = $descripcion; }
    public function setIdCategoria($id_categoria) { $this->id_categoria = $id_categoria; }
    public function setUnidadMedida($unidad_medida) { $this->unidad_medida = $unidad_medida; }
    public function setStockMinimo($stock_minimo) { $this->stock_minimo = $stock_minimo; }
    public function setPrecioBase($precio_base) { $this->precio_base = $precio_base; }
    public function setCantidadActual($cantidad_actual) { $this->cantidad_actual = $cantidad_actual; }
    public function setFechaActualizacion($fecha_actualizacion) { $this->fecha_actualizacion = $fecha_actualizacion; }
    public function setNombreCategoria($nombre_categoria) { $this->nombre_categoria = $nombre_categoria; }


}

