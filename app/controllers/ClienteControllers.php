<?php

require_once('../models/ClienteModels.php');

class ClienteControllers
{

    public static function getCliente($id)
    {
        $datos = clienteModels::obtenerCliente($id);

        if ($datos) {
            // Si los datos se obtienen correctamente, devuélvelos como JSON
            echo json_encode(['DatosOK' => $datos]);//lo que recibe el fronk es lo que se manda 
        } else {
            // Si hay un error al obtener los datos, devuelve un mensaje de error
            echo json_encode(['error' => 'No se pudieron obtener los datos del cliente']);
        }

    
    }


    public static  function getTipoDocumentos()
    {
        $datos = clienteModels::mostrarTiposDocumento();
        return $datos;
    }

    public static function getDatosCliente()
    {
        $datos = clienteModels::obtenerClientes();
        return $datos;
    }

    public static  function getTipoClientes()
    {
        $datos = clienteModels::mostrarTiposClientes();
        return $datos;
    }

    public static function eliminarCliente($id)
    {
        $datos = clienteModels::eliminarProducto($id);

        echo json_encode(['success' => $datos]);
        return $datos;
    }
    public static function insertarCliente()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $nombre = $cargaUtil->nombre;
            $direccion = $cargaUtil->direccion;
            $telefono = $cargaUtil->telefono;
            $tipoDocumento = $cargaUtil->tipoDocumento;
            $tipoCliente = $cargaUtil->tipoCliente;
            $identificacion = $cargaUtil->identificacion;

            $datos = clienteModels::guardarClientes(
                $nombre,
                $direccion,
                $telefono,
                $tipoDocumento,
                $tipoCliente,
                $identificacion
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }


    public static function ModificarCliente()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $id = $cargaUtil->idclie;
            $nombre = $cargaUtil->nombreM;
            $direccion = $cargaUtil->direccionM;
            $telefono = $cargaUtil->telefonoM;
            $tipoDocumento = $cargaUtil->tipoDocumentoM;
            $tipoCliente = $cargaUtil->tipoClienteM;
            $identificacion = $cargaUtil->identificacionM;

            $datos = clienteModels::EditarClientes(
                $id,
                $nombre,
                $direccion,
                $telefono,
                $tipoDocumento,
                $tipoCliente,
                $identificacion
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }

}

if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['accion']) && $_GET['accion'] === 'eliminarCliente') {
    $idCliente = $_GET['id'];
    ClienteControllers::eliminarCliente($idCliente);
}


// ClienteControllers::getCliente($idCliente);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'getCliente') {
  // $idCliente = $_POST['id'];
    $cargaUtil = json_decode(file_get_contents("php://input"));
    ClienteControllers::getCliente( $cargaUtil ->id);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'insertarCliente') {
    ClienteControllers::insertarCliente();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'ModificarCliente') {
    ClienteControllers::ModificarCliente();
}

