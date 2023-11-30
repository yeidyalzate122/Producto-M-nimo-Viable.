const $numeroPedido = document.querySelector("#listPedido");
const $numeroOrden = document.querySelector("#txtNumeroOrden");
const $codigoFabricacion = document.querySelector("#txtCodigoFabricar");
const $fechaEntrega = document.querySelector("#txtFechaEntrega");
const $fechaDespacho = document.querySelector("#txtFechaDespacho");
const $cantidad = document.querySelector("#txtCantidad");
const $direccionEntrega = document.querySelector("#txtDireccionEntrega");
const $lineaPedido = document.querySelector("#listLineaPedido");
const $producto = document.querySelector("#listProducto");
const $estadoProducto = document.querySelector("#listEstadolistProducto");
const $estadoOrden = document.querySelector("#listEstadoOrden");
const $transportadora = document.querySelector("#listTrasportadora");

//const $observaciones = document.querySelector("#txtObservaciones");

const $btnGuardar = document.querySelector("#btnGuardar");
const $btnEditarM = document.querySelector("#btnEditarM");

$btnGuardar.onclick = async () => {


  const numeroPedido = $numeroPedido.value;
  const numeroOrden = $numeroOrden.value;
  const codigoFabricacion = $codigoFabricacion.value;
  const fechaEntrega = $fechaEntrega.value;
  const fechaDespacho = $fechaDespacho.value;
  const cantidad = $cantidad.value;
  const direccionEntrega = $direccionEntrega.value;
  const lineaPedido = $lineaPedido.value;
  const producto = $producto.value;
  const estadoProducto = $estadoProducto.value;
  const estadoOrden = $estadoOrden.value;
  const transportadora = $transportadora.value;
  //const observaciones = $observaciones.value;
  // const btnGuardar = $btnGuardar;



  const cargaDatos = {
    numeroPedido,
    numeroOrden,
    codigoFabricacion,
    fechaEntrega,
    fechaDespacho,
    cantidad,
    direccionEntrega,
    lineaPedido,
    producto,
    estadoProducto,
    estadoOrden,
    transportadora,
  };

  const cargaUtilCodificada = JSON.stringify(cargaDatos);
  debugger;
  try {
    const respuestaRaw = await fetch(
      "../controllers/OrdenControllers.php?accion=insertarOrden",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: cargaUtilCodificada,
      }
    );

    // Verificar si la respuesta está OK
    if (respuestaRaw.ok) {
      try {
        const respuesta = await respuestaRaw.json();
        if (respuesta.success) {
          alert("Cliente guardado");
          location.reload();
          limpiar();
        } else {
          alert("El servidor no envió una respuesta exitosa");
        }
      } catch (e) {
        console.error("Error al analizar la respuesta como JSON:", e);
      }
    } else {
      console.error(
        "Error en la respuesta del servidor:",
        respuestaRaw.statusText
      );
    }
  } catch (e) {
    // En caso de que haya un error
    console.log(e);
  }
};

let $PedidoM,
  $idPedidoM,
  $NumeroOrdenM,
  $CodigoFabricarM,
  $FechaEntregaM,
  $FechaDespachoM,
  $CantidadM,
  $DireccionEntregaM,
  $LineaPedidoM,
  $ProductoM,
  $EstadolistProductoM,
  $EstadoOrdenM,
  $TrasportadoraM,
  $DescripcionM,
  $PruebaEntregaM,
  $FotoClienteM,
  $IdEvidencia;

async function EditarOrden(idOrden) {
  //try {
  // Configuración para una solicitud POST

  const opciones = {
    method: "POST",
    body: JSON.stringify({
      accion: "getOrden",
      id: idOrden,
    }),
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  };

  // Realizar la solicitud POST al servidor para obtener los datos del cliente
  const respuestaRaw = await fetch(
    "../controllers/OrdenControllers.php?accion=getOrden",
    opciones
  );

  if (!respuestaRaw.ok) {
    throw new Error(
      `Error al obtener datos del cliente. Código de estado: ${respuestaRaw.status}`
    );
  }

  // Analizar la respuesta JSON del servidor
  const { DatosOK, error } = await respuestaRaw.json(); // me llega en un arreglo y debo de colocarlo en posicion 0

  //console.log(variable);


    let  $idPedidoM = document.querySelector("#listPedidoM"),
      $NumeroOrdenM = document.querySelector("#txtNumeroOrdenM"),
      $CodigoFabricarM = document.querySelector("#txtCodigoFabricarM"),
      $FechaEntregaM = document.querySelector("#txtFechaEntregaM"),
      $FechaDespachoM = document.querySelector("#txtFechaDespachoM"),
      $CantidadM = document.querySelector("#txtCantidadM"),
      $DireccionEntregaM = document.querySelector("#txtDireccionEntregaM"),
      $LineaPedidoM = document.querySelector("#listLineaPedidoM"),
      $ProductoM = document.querySelector("#listProductoM"),
      $EstadolistProductoM = document.querySelector("#listEstadolistProductoM"),
      $EstadoOrdenM = document.querySelector("#listEstadoOrdenM"),
      $TrasportadoraM = document.querySelector("#listTrasportadoraM"),
      
      $IdEvidencia= document.querySelector("#txtEvidenciaM"),
      $DescripcionM = document.querySelector("#txtDescripcionM"),
      $PruebaEntregaM = document.querySelector("#txtPruebaEntregaM"),
      $FotoClienteM = document.querySelector("#txtFotoClienteM");


    // Colocar los datos del cliente en el formulario
    $idPedidoM.value = DatosOK[0].id_pedidos;
    $NumeroOrdenM.value = DatosOK[0].id_orden;
    $CodigoFabricarM.value = DatosOK[0].codigo_fabricacion;
    $FechaEntregaM.value = DatosOK[0].fecha_entrega;
    $FechaDespachoM.value = DatosOK[0].fecha_despacho;
    $CantidadM.value = DatosOK[0].cantidad;
    $DireccionEntregaM.value = DatosOK[0].direccion_entrega;
    $LineaPedidoM.value = DatosOK[0].id_linea_pedidos;
    $ProductoM.value = DatosOK[0].id_productos;
    $EstadolistProductoM.value = DatosOK[0].id_estado_productos;
    $EstadoOrdenM.value = DatosOK[0].id_estado_orden;
    $TrasportadoraM.value = DatosOK[0].id_transportadora;

    $IdEvidencia.value= DatosOK[0].id_prueba_entrega;
    $DescripcionM.value = DatosOK[0].observaciones;
    $PruebaEntregaM.value = DatosOK[0].foto_documento_entrega;
    $FotoClienteM.value = DatosOK[0].foto_firma_cliente;
  

  const manejarEditaOrden = async () => {
   
   debugger
   
    const idPedidoM = $idPedidoM.value;
    const NumeroOrdenM = $NumeroOrdenM.value;
    const CodigoFabricarM = $CodigoFabricarM.value;
    const FechaEntregaM = $FechaEntregaM.value;
    const FechaDespachoM = $FechaDespachoM.value;
    const CantidadM = $CantidadM.value;
    const DireccionEntregaM = $DireccionEntregaM.value;
    const LineaPedidoM = $LineaPedidoM.value;
    const ProductoM = $ProductoM.value;
    const EstadolistProductoM = $EstadolistProductoM.value;
    const EstadoOrdenM = $EstadoOrdenM.value;
    const TrasportadoraM = $TrasportadoraM.value;
   
    const IdEvidencia =$IdEvidencia.value;
    const DescripcionM = $DescripcionM.value;
    const PruebaEntregaM = $PruebaEntregaM.value;
    const FotoClienteM = $FotoClienteM.value;

    const cargaDatos = {
      idPedidoM,
      NumeroOrdenM,
      CodigoFabricarM,
      FechaEntregaM,
      FechaDespachoM,
      CantidadM,
      DireccionEntregaM,
      LineaPedidoM,
      ProductoM,
      EstadolistProductoM,
      EstadoOrdenM,
      TrasportadoraM,
      IdEvidencia,
      PruebaEntregaM,
      FotoClienteM,
      DescripcionM
    };

    try {
      const respuestaRaw = await fetch(
        "../controllers/OrdenControllers.php?accion=ModificarOrden",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(cargaDatos),
        }
      );

      // Verificar si la respuesta está OK
      if (respuestaRaw.ok) {
        try {
          const respuesta = await respuestaRaw.json();

          if (respuesta.success) {
            alert("Cliente Modificado");
            location.reload();
            limpiar();
          } else {
            alert("El servidor no envió una respuesta exitosa");
          }
        } catch (e) {
          console.error("Error al analizar la respuesta como JSON:", e);
        }
      } else {
        console.error(
          "Error en la respuesta del servidor:",
          respuestaRaw.statusText
        );
      }
    } catch (e) {
      // En caso de que haya un error con la solicitud fetch
      console.error("Error al realizar la solicitud fetch:", e);
    }
  };

  // Asignar la función interna como manejador del evento clic
  $btnEditarM.onclick = manejarEditaOrden;
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip();
});


function buscar() {
  var inputIdOrden = document.getElementById('inputIdOrden').value;
  var inputIdPedido = document.getElementById('inputIdPedido').value;

  // Filtra las filas de la tabla según el ID de la orden y el ID del pedido
  var filas = document.getElementById('cuerpoTabla').getElementsByTagName('tr');
  for (var i = 0; i < filas.length; i++) {
    var celdas = filas[i].getElementsByTagName('td');
    var idOrden = celdas[1].textContent; // Índice 1 es la columna del código de la orden
    var idPedido = celdas[0].textContent; // Índice 0 es la columna del código del pedido

    // Oculta la fila si no coincide con la búsqueda
    if (idOrden.includes(inputIdOrden) && idPedido.includes(inputIdPedido)) {
      filas[i].style.display = '';
    } else {
      filas[i].style.display = 'none';
    }
  }
}

function limpiarTabla() {
  // Muestra todas las filas de la tabla
  var filas = document.getElementById('cuerpoTabla').getElementsByTagName('tr');
  for (var i = 0; i < filas.length; i++) {
    filas[i].style.display = '';
  }
}