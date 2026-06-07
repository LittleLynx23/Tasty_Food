<?php
class Usuario {

    private $id_usuario;
    private $nombre;
    private $apellido;
    private $cedula;
    private $correo;
    private $area;
    private $contrasena;
    private $id_rol;


    public function __construct($id_usuario, $nombre, $apellido, $cedula, $correo, $area, $contrasena, $id_rol) {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->cedula = $cedula;
        $this->correo = $correo;
        $this->area = $area;
        $this->contrasena = $contrasena;
        $this->id_rol = $id_rol;

    }


    public function getIdUsuario() { return $this->id_usuario; }
    public function getNombre() { return $this->nombre; }
    public function getApellido() { return $this->apellido; }
    public function getCedula() { return $this->cedula; }
    public function getCorreo() { return $this->correo; }
    public function getArea() { return $this->area; }
    public function getIdRol() { return $this->id_rol; }
    public function getContrasena() { return $this->contrasena;}
}
?>