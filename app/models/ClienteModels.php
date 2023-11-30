<?php

require_once('../config/Conexion.php');


class ClienteModels extends Conexion
{

  public static function mostrarTiposDocumento()
  {
    $db = Conexion::getConexion();
    $query = "SELECT id_tipo_documentos, tipo_documentos FROM tipos_documentos";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function mostrarTiposClientes()
  {
    $db = Conexion::getConexion();
    $query = "SELECT id_tipo_clientes,tipo_clientes FROM tipo_clientes";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }


  public static function obtenerCliente($id)
  {
    $db = Conexion::getConexion();
    $query = "SELECT id_clientes,nombre,direccion,telefono,id_tipo_documentos,
    id_tipo_clientes,numero_identificacion FROM clientes WHERE id_clientes =$id";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }



  public static function obtenerClientes()
  {

    $db = Conexion::getConexion();
    $query = "SELECT c.id_clientes,c.nombre, c.numero_identificacion,c.telefono,c.direccion, td.tipo_documentos,tc.tipo_clientes FROM clientes c INNER JOIN tipo_clientes tc on tc.id_tipo_clientes= c.id_tipo_clientes INNER JOIN tipos_documentos td on td.id_tipo_documentos = c.id_tipo_documentos";
    $statement = $db->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }


  public static function eliminarProducto($id)
  {
    $db = Conexion::getConexion();
    $sentencia = $db->prepare("DELETE FROM clientes WHERE id_clientes = ?");
    return $sentencia->execute([$id]);
  }


  public static function guardarClientes($nombre, $direccion, $telefono, $id_tipo_documentos, $id_tipo_clientes, $numero_identificacion)
  {
    $db = Conexion::getConexion();
    $sentencia = $db->prepare("INSERT INTO `clientes` (`nombre`, `direccion`, `telefono`, `id_tipo_documentos`, `id_tipo_clientes`, `numero_identificacion`)
       VALUES (?, ?, ?, ?, ?, ?)");
    return $sentencia->execute([$nombre, $direccion, $telefono, $id_tipo_documentos, $id_tipo_clientes, $numero_identificacion]);
  }


  public static function EditarClientes($id, $nombre, $direccion, $telefono, $id_tipo_documentos, $id_tipo_clientes, $numero_identificacion)
  {
    $db = Conexion::getConexion();
    $sentencia = $db->prepare("UPDATE clientes SET nombre = ?, direccion = ?,
     telefono = ?, id_tipo_documentos = ?, id_tipo_clientes = ?, numero_identificacion = ?
      WHERE id_clientes = ?");
    return $sentencia->execute([$nombre, $direccion, $telefono, $id_tipo_documentos, $id_tipo_clientes, $numero_identificacion, $id]);
  }
}
