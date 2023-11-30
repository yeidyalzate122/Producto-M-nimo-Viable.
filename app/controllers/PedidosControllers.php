<?php

require_once('../models/PedidosModels.php');
class PedidosControllers
{


    public static function getPedido($id)
    {
        $datos = PedidosModels::obtenerPedido($id);

        if ($datos) {
            // Si los datos se obtienen correctamente, devuélvelos como JSON
            echo json_encode(['DatosOK' => $datos]);//lo que recibe el fronk es lo que se manda 
        } else {
            // Si hay un error al obtener los datos, devuelve un mensaje de error
            echo json_encode(['error' => 'No se pudieron obtener los datos del cliente']);
        }

    
    }

    public static function getPedidos()
    {
        $datos = PedidosModels::mostrarPedidos();

        return $datos;
    
    }


    public static  function getClientes()
    {
        $datos = PedidosModels::mostrarClientes();
        return $datos;
    }

    public static  function getEstadoEntrega()
    {
        $datos = PedidosModels::mostrarEstadoEntrega();
        return $datos;
    }
    


    public static function insertarPedido()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $cliente = $cargaUtil->cliente;
            $costo = $cargaUtil->costo;
            $codigoFactura = $cargaUtil->codigoFactura;
            $estado = $cargaUtil->estado;
            $observaciones = $cargaUtil->observaciones;


            $datos = PedidosModels::guardarPedido(
            $cliente,
            $costo ,
            $codigoFactura,
            $estado ,
            $observaciones
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }

    public static function ModificarPedido()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $id = $cargaUtil->id;
            $cliente = $cargaUtil->clienteM;
            $estado = $cargaUtil->estadoM;
            $factura = $cargaUtil->codigoFacturaM;
            $observacion = $cargaUtil->observacionesM;
          
         
           $datos = PedidosModels::EditarPedido($id,
           $cliente,
           $estado,
           $factura,
           $observacion);
          
            // Responder con un JSON indicando el resultado de la operación
           echo json_encode(['success' => $datos]);
        }
    }

}




// ClienteControllers::getCliente($idCliente);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'getPedido') {
  // $idCliente = $_POST['id'];
    $cargaUtil = json_decode(file_get_contents("php://input"));
    PedidosControllers::getPedido( $cargaUtil ->id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'insertarPedido') {
    PedidosControllers::insertarPedido();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'ModificarPedido') {
    PedidosControllers::ModificarPedido();
}

?>