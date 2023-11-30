<?php

class Conexion
{

    public $conexion;
    private $host = "localhost";
    private $dbName = "logistica";
    private $port = "3306";
    private $user = "root";
    private $pass = "";

    public static function getConexion()
    {

        try {
            $con = new Conexion();


            $con->conexion = new PDO("mysql:host={$con->host};dbname={$con->dbName}", $con->user, $con->pass);

            $con->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $con->conexion->exec("SET NAMES utf8");
            //echo "funciona";
            return  $con->conexion;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}


Conexion::getConexion();
