<?php


require_once('../config/Conexion.php');

class ProductosModels extends Conexion
{


    public static function obtenerProducto($id)
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_productos,nombre,costo,color,descripcion, id_tipo_productos,id_bodegas,id_estado_productos FROM `productos` WHERE id_productos =$id";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function mostrarBodegas()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_bodegas, bodegas FROM bodegas";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarEstadoProducto()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_estado_productos,estado_productos FROM estado_productos";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarTipoProducto()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_tipo_productos,tipo_productos FROM tipo_productos";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerProductos()
    {

        $db = Conexion::getConexion();
        $query = "SELECT p.id_productos, p.nombre, p.color,p.costo, p.descripcion,tp.tipo_productos, b.bodegas,ep.estado_productos FROM productos p INNER JOIN tipo_productos tp on tp.id_tipo_productos=p.id_tipo_productos INNER JOIN bodegas b ON b.id_bodegas = p.id_bodegas INNER JOIN estado_productos ep on ep.id_estado_productos = p.id_estado_productos";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function guardarProducto($nombre, $costo, $color, $descripcion, $id_tipo_productos, $id_bodegas, $id_estado_productos)
    {
        $db = Conexion::getConexion();
        $sentencia = $db->prepare("INSERT INTO `productos` ( `nombre`, `costo`, `color`, `descripcion`, `id_tipo_productos`, `id_bodegas`, `id_estado_productos`)
       VALUES ( ?, ?, ?, ?, ?, ?, ?)");
        return $sentencia->execute([$nombre, $costo, $color, $descripcion, $id_tipo_productos, $id_bodegas, $id_estado_productos]);
    }

    public static function EditarProducto($id, $nombre, $costo, $color, $descripcion, $id_tipo_productos, $id_bodegas, $id_estado_productos)
    {
        $db = Conexion::getConexion();
        $sentencia = $db->prepare("UPDATE `productos` SET `nombre` = ?, `costo` = ?, `color` = ?,
       `descripcion` = ?, `id_tipo_productos` = ?, `id_bodegas` = ?, `id_estado_productos` = ? WHERE `id_productos` = ?");
        return $sentencia->execute([$nombre, $costo, $color, $descripcion, $id_tipo_productos, $id_bodegas, $id_estado_productos, $id]);
    }
}
