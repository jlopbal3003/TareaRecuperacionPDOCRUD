<?php

namespace Tarearecuperacion1;

use PDOException;
use PDO;

class Conexion
{
    protected static $conexion;

    public function __construct()
    {
        if (self::$conexion == null) {
            self::crearConexion();
        }
    }

    private static function crearConexion()
    {
        //leemos las parametros del archivo de configuracion
        $fichero = dirname(__DIR__, 1) . "/.config";
        $opciones = parse_ini_file($fichero);
        $host = $opciones['host'];
        $bbdd = $opciones['bbdd'];
        $usuario = $opciones['usuario'];
        $pass = $opciones['pass'];

        $dns = "mysql:host=$host;dbname=$bbdd;charset=utf8mb4";
        //iniciamos la conexion
        try {
            self::$conexion = new PDO($dns, $usuario, $pass);
            //si estamos en desarrollo
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            die("Error al conectar a crud tarearecuperacion: " . $ex->getMessage());
        }
    }
}
