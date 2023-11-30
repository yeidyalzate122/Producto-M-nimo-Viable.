<?php

require_once('../models/OrdenModels.php');

class OrdenControllers
{

    public static  function getOrdenes()
    {
        $datos = OrdenModels::obtenerOrdenes();
        return $datos;
    }

    public static  function getPedidos()
    {
        $datos = OrdenModels::mostrarPedidos();
        return $datos;
    }

    public static  function getLineaProductos()
    {
        $datos = OrdenModels::mostrarLineaProductos();
        return $datos;
    }

    public static  function getProductos()
    {
        $datos = OrdenModels::mostrarProducto();
        return $datos;
    }
    public static  function getEstadoProducto()
    {
        $datos = OrdenModels::mostrarEstadoProducto();
        return $datos;
    }
    public static  function getEstadoOrden()
    {
        $datos = OrdenModels::mostrarEstadoOrden();
        return $datos;
    }

    public static  function getTransportadora()
    {
        $datos = OrdenModels::mostrarTransportadora();
        return $datos;
    }

    public static function insertarOrden()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }

            $numeroPedido = $cargaUtil->numeroPedido;
            $numeroOrden = $cargaUtil->numeroOrden;
            $codigoFabricacion = $cargaUtil->codigoFabricacion;
            $fechaEntrega = $cargaUtil->fechaEntrega;
            $fechaDespacho = $cargaUtil->fechaDespacho;
            $cantidad = $cargaUtil->cantidad;

            $direccionEntrega = $cargaUtil->direccionEntrega;
            $lineaPedido = $cargaUtil->lineaPedido;

             $producto = $cargaUtil->producto;
              $estadoProducto = $cargaUtil->estadoProducto;
              $estadoOrden = $cargaUtil->estadoOrden;
              $transportadora = $cargaUtil->transportadora;

            
            $datos = OrdenModels::guardarOrden(
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
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }

    public static function getOrden($id)
    {
        $datos = OrdenModels::obtenerOrden($id);

        if ($datos) {
            // Si los datos se obtienen correctamente, devuélvelos como JSON
            echo json_encode(['DatosOK' => $datos]);//lo que recibe el fronk es lo que se manda 
        } else {
            // Si hay un error al obtener los datos, devuelve un mensaje de error
            echo json_encode(['error' => 'No se pudieron obtener los datos del cliente']);
        }

    
    }


    public static function ModificarOrden()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }

            $idPedido=$cargaUtil->idPedidoM;
            $NumeroOrden=$cargaUtil->NumeroOrdenM;
            $CodigoFabricar =$cargaUtil->CodigoFabricarM;
            $FechaEntrega =$cargaUtil->FechaEntregaM;
            $FechaDespacho =$cargaUtil-> FechaDespachoM;
            $Cantidad =$cargaUtil-> CantidadM;
            $DireccionEntrega =$cargaUtil->DireccionEntregaM;
            $LineaPedido =$cargaUtil-> LineaPedidoM;
            $Producto =$cargaUtil-> ProductoM;
            $EstadolistProducto =$cargaUtil-> EstadolistProductoM;
            $EstadoOrden =$cargaUtil->EstadoOrdenM;
            $Trasportadora =$cargaUtil-> TrasportadoraM;
            $IdEvidencia =$cargaUtil-> IdEvidencia;
            $PruebaEntrega =$cargaUtil-> PruebaEntregaM;
            $FotoCliente =$cargaUtil-> FotoClienteM;
            $Descripcion =$cargaUtil-> DescripcionM;
            

            $datos = OrdenModels::EditarOrden(
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
          
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'getOrden') {
    // $idCliente = $_POST['id'];
      $cargaUtil = json_decode(file_get_contents("php://input"));
      OrdenControllers::getOrden( $cargaUtil ->id);
  }
  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'insertarOrden') {
    OrdenControllers::insertarOrden();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'ModificarOrden') {
    OrdenControllers::ModificarOrden();
}

