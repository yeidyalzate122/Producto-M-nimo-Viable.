<?php

require_once('../config/Conexion.php');


class PedidosModels extends Conexion
{



    public static function obtenerPedido($id)
    {
        $db = Conexion::getConexion();
        $query = "SELECT p.id_pedidos,p.id_clientes,p.id_estado_Entrega, f.id_factura, p.costo_total, f.observaciones FROM pedidos p INNER join factura f on f.id_factura = p.id_factura WHERE p.id_pedidos =$id";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarPedidos()
    {
        $db = Conexion::getConexion();
        $query = "SELECT p.id_pedidos, p.costo_total,p.id_factura ,c.nombre, e.estado_Entregas FROM pedidos p inner join clientes c on c.id_clientes = p.id_clientes inner join estado_entregas e on e.id_estado_Entregas = p.id_estado_Entrega";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function mostrarClientes()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_clientes, nombre FROM `clientes`";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function mostrarEstadoEntrega()
    {
        $db = Conexion::getConexion();
        $query = "SELECT id_estado_Entregas, estado_Entregas FROM `estado_entregas`";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function guardarPedido(
        $cliente,
        $costo,
        $codigoFactura,
        $estado,
        $observaciones
    ) {
        $db = Conexion::getConexion();
        $sentencia = $db->prepare("CALL guardarPedido(?,?,?,?,?)");
        return $sentencia->execute([
            $cliente,
            $costo,
            $codigoFactura,
            $estado,
            $observaciones
        ]);
    }

    public static function EditarPedido($idPedido, $cliente, $estado, $idFactura, $observaciones)
    {
      $db = Conexion::getConexion();
      $sentencia = $db->prepare("CALL ActualizarPedido(?,?,?,?,?)");
      return $sentencia->execute([$idPedido, $cliente, $estado, $idFactura, $observaciones]);
    }
}
