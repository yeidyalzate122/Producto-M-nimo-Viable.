<?php

require_once('../models/TransportadoraModels.php');
class TransportadoraControllers
{


    public static  function getTransportadoras()
    {
        $datos = TransportadoraModels::obtenerTrasportadoras();

        return $datos;
    }


    public static function getTransportadora($id)
    {
        $datos = TransportadoraModels::obtenerTrasportadora($id);

        if ($datos) {
            // Si los datos se obtienen correctamente, devuélvelos como JSON
            echo json_encode(['DatosOK' => $datos]); //lo que recibe el fronk es lo que se manda 
        } else {
            // Si hay un error al obtener los datos, devuelve un mensaje de error
            echo json_encode(['error' => 'No se pudieron obtener los datos del cliente']);
        }
    }

    public static function insertarTrasportadora()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $nombre = $cargaUtil->nombre;
            $identificacion = $cargaUtil->identificacion;
            $telefono = $cargaUtil->telefono;
            $direccion = $cargaUtil->direccion;
            $descripcion = $cargaUtil->descripcion;

            $datos = TransportadoraModels::guardarTrasportadora($identificacion, $nombre, $telefono, $direccion, $descripcion);

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }

    public static function ModificarTrasportadora()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $id = $cargaUtil->idtra;
            $nombre = $cargaUtil->nombreM;
            $identificacion = $cargaUtil->identificacionM;
            $telefono = $cargaUtil->telefonoM;
            $direccion = $cargaUtil->direccionM;
            $descripcion = $cargaUtil->descripcionM;
            
            $datos = TransportadoraModels::EditarTrasportadora($id, $identificacion, $nombre, $telefono,$direccion, $descripcion);

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }


}

// ClienteControllers::getCliente($idCliente);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'getTransportadora') {
    // $idCliente = $_POST['id'];
    $cargaUtil = json_decode(file_get_contents("php://input"));
    TransportadoraControllers::getTransportadora($cargaUtil->id);

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'insertarTrasportadora') {
    TransportadoraControllers::insertarTrasportadora();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'ModificarTrasportadora') {
    TransportadoraControllers::ModificarTrasportadora();
}