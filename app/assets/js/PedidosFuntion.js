const $id = document.querySelector("#txtIdPedidoM"),

  $cliente = document.querySelector("#listCliente"),
  $costo = document.querySelector("#txtCosto"),
  $codigoFactura = document.querySelector("#txtCodigoFactura"),
  $estado = document.querySelector("#listEstado"),
  $observaciones = document.querySelector("#txtObservaciones")
  $btnGuardar = document.querySelector("#btnGuardar"),
  $btnEditarM = document.querySelector("#btnEditarM");

  $btnGuardar.onclick = async () => {
    const cliente =  $cliente.value,
    costo =  $costo.value,
    codigoFactura = $codigoFactura.value,
    estado = $estado.value,
    observaciones = $observaciones.value;
    const cargaDatos = {
        cliente,
        costo,
        codigoFactura,
        estado,
        observaciones
    };
  
    const cargaUtilCodificada = JSON.stringify(cargaDatos);
    debugger;
    try {
      const respuestaRaw = await fetch(
        "../controllers/PedidosControllers.php?accion=insertarPedido",
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
            alert("Pedido guardado");
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

let $clienteM,
$estadoM ,
$costoM,
$codigoFacturaM,
$observacionesM ;
  async function editarPedido(idCliente) {
    //try {
    // Configuración para una solicitud POST
  
    const opciones = {
      method: "POST",
      body: JSON.stringify({
        accion: "getCliente",
        id: idCliente,
      }),
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
    };
  
    // Realizar la solicitud POST al servidor para obtener los datos del cliente
    const respuestaRaw = await fetch(
      "../controllers/PedidosControllers.php?accion=getPedido",
      opciones
    );
  
    if (!respuestaRaw.ok) {
      throw new Error(
        `Error al obtener datos del cliente. Código de estado: ${respuestaRaw.status}`
      );
    }
  
    // Analizar la respuesta JSON del servidor
    const { DatosOK } = await respuestaRaw.json(); // me llega en un arreglo y debo de colocarlo en posicion 0
  
  
    $idM = document.getElementById("txtIdPedidoM");
    $clienteM = document.getElementById("listClienteM");
    $costoM = document.getElementById("txtCostoM");
    $codigoFacturaM = document.getElementById("txtCodigoFacturaM");
    $estadoM = document.getElementById("listEstadoM");
    $observacionesM = document.getElementById("txtObservacionesM");

  
    // Colocar los datos del cliente en el formulario
    $idM.value = DatosOK[0].id_pedidos;
    $clienteM.value = DatosOK[0].id_clientes;
    $costoM.value = DatosOK[0].costo_total;
    $codigoFacturaM.value = DatosOK[0].id_factura;
    $estadoM.value = DatosOK[0].id_estado_Entrega;
    $observacionesM.value = DatosOK[0].observaciones;
  
  
   const manejarEditarPedido = async () => {
      const id = $idM.value;
      const clienteM = $clienteM.value;
      const estadoM = $estadoM.value;
      const codigoFacturaM = $codigoFacturaM.value;
      const observacionesM = $observacionesM.value;
    
    
      const cargaDatos = {
        id,
        clienteM,
        estadoM,
        codigoFacturaM,
        observacionesM
      };
    
      try {
        const respuestaRaw = await fetch(
          "../controllers/PedidosControllers.php?accion=ModificarPedido",
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
              alert("Pedido Modificado");
              location.reload();
              limpiar();
            } else {
              alert("El servidor no envió una respuesta exitosa");
            }
          } catch (e) {
            console.error("Error al analizar la respuesta como JSON:", e);
          }
        } else {
          console.error("Error en la respuesta del servidor:", respuestaRaw.statusText);
        }
      } catch (e) {
        // En caso de que haya un error con la solicitud fetch
        console.error("Error al realizar la solicitud fetch:", e);
      }
    };
    
  
    // Asignar la función interna como manejador del evento clic
    $btnEditarM.onclick = manejarEditarPedido;
  }
  
  document.addEventListener("DOMContentLoaded", function() {
    // Obtén la referencia al campo de entrada
    const inputBuscarPedido = document.getElementById("txtBuscarPedido");

    // Agrega un evento de escucha para el evento "input" en el campo de entrada
    inputBuscarPedido.addEventListener("input", function() {
        // Obtiene el valor del campo de entrada y lo convierte a mayúsculas para una búsqueda insensible a mayúsculas y minúsculas
        const filtro = inputBuscarPedido.value.toUpperCase();

        // Obtiene todas las filas de la tabla
        const filas = document.querySelectorAll("#cuerpoTabla tr");

        // Itera sobre las filas y muestra o oculta según el filtro
        filas.forEach(function(fila) {
            const codigoPedido = fila.querySelector("td:first-child").textContent.toUpperCase();

            // Muestra u oculta la fila según si coincide con el filtro
            fila.style.display = codigoPedido.includes(filtro) ? '' : 'none';
        });
    });
});