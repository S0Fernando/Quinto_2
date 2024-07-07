<?php
// File: config/conexion.php

class Clase_Conectar {
    public $conexion;
    protected $db;
    private $server = "localhost";
    private $usu = "root";
    private $clave = ""; // Coloca tu contraseña aquí si es necesario
    private $base = "quinto_1";

    public function Procedimiento_Conectar() {
        $this->conexion = mysqli_connect($this->server, $this->usu, $this->clave, $this->base);
        mysqli_query($this->conexion, "SET NAMES 'utf8'");
        if (!$this->conexion) {
            die("Error al conectarse con MySQL: " . mysqli_connect_error());
        }
        $this->db = mysqli_select_db($this->conexion, $this->base);
        if (!$this->db) {
            die("Error al seleccionar la base de datos: " . mysqli_error($this->conexion));
        }
        return $this->conexion;
    }
}
?>