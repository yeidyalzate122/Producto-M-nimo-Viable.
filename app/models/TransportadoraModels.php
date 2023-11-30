<?php

require_once('../config/Conexion.php');


class TransportadoraModels extends Conexion
{

 

  public static function obtenerTrasportadora($id)
  {
  
    $db = Conexion::getConexion();
    $query = "SELECT id_transportadora, nombre,numero_identificacion,telefono,direccion, observaciones FROM transportadora WHERE id_transportadora = $id";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);

  }



  public static function obtenerTrasportadoras()
  {

    $db = Conexion::getConexion();
    $query = "SELECT id_transportadora, nombre,numero_identificacion,telefono,direccion FROM transportadora";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }





  public static function guardarTrasportadora( $identificacion,$nombre, $telefono,$direccion, $descripcion)
  {
    $db = Conexion::getConexion();
    $sentencia = $db->prepare("INSERT INTO `transportadora` ( `numero_identificacion`, `nombre`, `telefono`, `direccion`, `observaciones`) VALUES 
    (?, ?, ?,?,?)");
    return $sentencia->execute([ $identificacion,$nombre, $telefono,$direccion, $descripcion]);
  }


  public static function EditarTrasportadora(  $id,$numero_identificacion, $nombre,$telefono, $direccion,  $observaciones)
  {
    $db = Conexion::getConexion();
    $sentencia = $db->prepare("UPDATE `transportadora` SET `numero_identificacion` = ?, `nombre` =?, 
    `telefono` = ?, `direccion` = ?, `observaciones` = ? WHERE `transportadora`.`id_transportadora` = ?");
    return $sentencia->execute([$numero_identificacion, $nombre,$telefono, $direccion,  $observaciones, $id]);
  }

  
}
