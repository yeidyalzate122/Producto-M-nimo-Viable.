<?php
require_once('../config/Conexion.php');

class DocumentosModels extends Conexion
{





    public static function mostrarDatos()
    {
        $db = Conexion::getConexion();
        $query = "SELECT pp.id_pedidos,
         o.id_orden, o.fecha_despacho,
          o.direccion_entrega, c.nombre 
          AS nombre_cliente FROM orden o 
          INNER JOIN detalle_linea_pedidos dlp 
          ON dlp.id_orden = o.id_orden INNER JOIN 
          pedidos pp ON pp.id_pedidos = dlp.id_pedidos 
          INNER JOIN clientes c ON c.id_clientes = pp.id_clientes";
        $statement = $db->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
