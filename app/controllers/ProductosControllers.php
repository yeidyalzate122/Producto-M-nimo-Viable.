<?php


require_once('../models/ProductosModels.php');

class ProductosControllers
{


    public static function getProducto($id)
    {
        $datos = ProductosModels::obtenerProducto($id);

        if ($datos) {
            // Si los datos se obtienen correctamente, devuélvelos como JSON
            echo json_encode(['DatosOK' => $datos]);//lo que recibe el fronk es lo que se manda 
        } else {
            // Si hay un error al obtener los datos, devuelve un mensaje de error
            echo json_encode(['error' => 'No se pudieron obtener los datos del cliente']);
        }

    
    }


    public static  function getBodegas()
    {
        $datos = ProductosModels::mostrarBodegas();
        return $datos;
    }

    public static  function getEstadoProductos()
    {
        $datos = ProductosModels::mostrarEstadoProducto();
        return $datos;
    }
    public static  function getTipoProducto()
    {
        $datos = ProductosModels::mostrarTipoProducto();
        return $datos;
    }

    public static function getDatosProductos()
    {
        $datos = ProductosModels::obtenerProductos();
        return $datos;
    }

    public static function insertarProducto()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $nombre = $cargaUtil->nombre;
            $costo = $cargaUtil->costo;
            $color = $cargaUtil->color;
            $descripcion = $cargaUtil->descripcion;
            $tipoProducto = $cargaUtil->tipoProducto;
            $bodega = $cargaUtil->bodega;
            $estadoProducto = $cargaUtil->estadoProducto;



            $datos = ProductosModels::guardarProducto(
                $nombre,
                $costo,
                $color,
                $descripcion,
                $tipoProducto,
                $bodega,
                $estadoProducto
            );

            // Responder con un JSON indicando el resultado de la operación
            echo json_encode(['success' => $datos]);
        }
    }

    public static function ModificarProducto()
    {
        $cargaUtil = json_decode(file_get_contents("php://input"));

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Si no hay datos, salir inmediatamente indicando un error 500
            if (!$cargaUtil) {
                http_response_code(500);
                exit;
            }
            $id = $cargaUtil->idPro;
            $nombre = $cargaUtil->nombreM;
            $costo = $cargaUtil->costoM;
            $color = $cargaUtil->colorM;
            $descripcion = $cargaUtil->descripcionM;
            $tipoProducto = $cargaUtil->tipoProductoM;
            $bodega = $cargaUtil->bodegaM;
            $estadoProducto = $cargaUtil->estadoProductoM;


         
           $datos = ProductosModels::EditarProducto(

            $id ,
            $nombre,
            $costo,
            $color ,
            $descripcion,
            $tipoProducto ,
            $bodega,
            $estadoProducto
           );
          


        

            // Responder con un JSON indicando el resultado de la operación
           echo json_encode(['success' => $datos]);
        }
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'getProducto') {
    // $idCliente = $_POST['id'];
      $cargaUtil = json_decode(file_get_contents("php://input"));
      ProductosControllers::getProducto( $cargaUtil ->id);
  }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'insertarProducto') {
    ProductosControllers::insertarProducto();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['accion']) && $_GET['accion'] === 'ModificarProducto') {
    ProductosControllers::ModificarProducto();
}