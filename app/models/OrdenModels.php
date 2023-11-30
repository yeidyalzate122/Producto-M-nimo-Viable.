<?php

require_once('../config/Conexion.php');

class OrdenModels extends Conexion
{

    public static function obtenerOrdenes()
    {

        $db = Conexion::getConexion();
        $query = "SELECT d.id_pedidos, o.id_orden, o.fecha_entrega,.o.fecha_despacho,es.estado_orden from orden o INNER JOIN detalle_linea_pedidos d on d.id_orden= o.id_orden inner JOIN estado_orden es on es.id_estado_orden=o.id_estado_orden";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function mostrarPedidos()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_pedidos FROM pedidos";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarLineaProductos()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_linea_pedidos,linea_pedidos FROM linea_pedidos";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarProducto()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_productos,nombre FROM productos";
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


    public static function mostrarEstadoOrden()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_estado_orden,estado_orden FROM estado_orden";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function mostrarTransportadora()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_transportadora,	nombre FROM transportadora";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerOrden($id)
    {
        $db = Conexion::getConexion();
        $query = "SELECT
        pp.id_pedidos,
        o.id_orden,
        o.codigo_fabricacion,
        o.fecha_entrega,
        o.fecha_despacho,
        o.cantidad,
        o.direccion_entrega,
        lp.id_linea_pedidos,
        p.id_productos,
        ep.id_estado_productos,
        eo.id_estado_orden,
        t.id_transportadora,
        pen.id_prueba_entrega,
        pen.foto_documento_entrega,
        pen.foto_firma_cliente,
        pen.observaciones
    FROM
        orden o
        INNER JOIN detalle_linea_pedidos dlp ON dlp.id_orden = o.id_orden
        INNER JOIN linea_pedidos lp ON lp.id_linea_pedidos = dlp.id_liena_pedidos
        INNER JOIN detalle_orden_productos dop ON dop.id_orden = o.id_orden
        INNER JOIN productos p ON p.id_productos = dop.id_productos
        INNER JOIN estado_productos ep ON ep.id_estado_productos = p.id_estado_productos
        INNER JOIN estado_orden eo ON eo.id_estado_orden = o.id_estado_orden
        INNER JOIN transportadora t ON t.id_transportadora = o.id_transportadora
        INNER JOIN pedidos pp ON pp.id_pedidos = dlp.id_pedidos
        LEFT JOIN prueba_entrega pen ON pen.id_prueba_entrega = o.id_prueba_entrega
    WHERE
        o.id_orden = $id";


        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function guardarOrden(
        $numeroPedido,
        $numeroOrden,
        $codigoFabricacion,
        $fechaEntrega,
        $fechaDespacho,
        $cantidad,
        $direccionEntrega,
        $lineaPedido,
        $producto,
        $estadoProducto,
        $estadoOrden,
        $transportadora
    ) {
        $db = Conexion::getConexion();
        $sentencia = $db->prepare("CALL GuardarOrden( ?,?,?,?,?,?,?,?,?,?,?,? ) ");


        return $sentencia->execute([
            $numeroPedido,
            $numeroOrden,
            $codigoFabricacion,
            $fechaEntrega,
            $fechaDespacho,
            $cantidad,
            $direccionEntrega,
            $lineaPedido,
            $producto,
            $estadoProducto,
            $estadoOrden,
            $transportadora
        ]);
    }


    public static function EditarOrden(
        $idPedido,
        $NumeroOrden,
        $CodigoFabricar,
        $FechaEntrega ,
        $FechaDespacho,
        $Cantidad ,
        $DireccionEntrega,
        $LineaPedido,
        $Producto ,
        $EstadolistProducto,
        $EstadoOrden,
        $Trasportadora ,
        $IdEvidencia ,
        $Descripcion,
        $PruebaEntrega,
        $FotoCliente
    ) {
        $db = Conexion::getConexion();
        $sentencia = $db->prepare("CALL GuardarDatosOrden(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


        return $sentencia->execute([
            $idPedido,
            $NumeroOrden,
            $CodigoFabricar,
            $FechaEntrega ,
            $FechaDespacho,
            $Cantidad ,
            $DireccionEntrega,
            $LineaPedido,
            $Producto ,
            $EstadolistProducto,
            $EstadoOrden,
            $Trasportadora ,
            $IdEvidencia ,
            $Descripcion,
            $PruebaEntrega,
            $FotoCliente
        ]);
    }

    
}
