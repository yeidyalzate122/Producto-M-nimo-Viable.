const $idM = document.querySelector("#txtIdProductoM"),
  $nombre = document.querySelector("#txtNombre"),
  $costo = document.querySelector("#txtCosto"),
  $color = document.querySelector("#txtColor"),
  $descripcion = document.querySelector("#txtDescripcion"),
  $tipoProducto = document.querySelector("#txtTipoProducto"),
  $bodega = document.querySelector("#txtBodega"),
  $estadoProducto = document.querySelector("#txtEstadoProducto"),
  $btnGuardar = document.querySelector("#btnGuardar"),
  $btnEditarM = document.querySelector("#btnEditarM");

$btnGuardar.onclick = async () => {
  const nombre = $nombre.value,
    costo = $costo.value,
    color = $color.value,
    descripcion = $descripcion.value,
    tipoProducto = $tipoProducto.value,
    bodega = $bodega.value,
    estadoProducto = $bodega.value;

  const cargaDatos = {
    nombre,
    costo,
    color,
    descripcion,
    tipoProducto,
    bodega,
    estadoProducto,
  };

  const cargaUtilCodificada = JSON.stringify(cargaDatos);
  debugger;
  try {
    const respuestaRaw = await fetch(
      "../controllers/ProductosControllers.php?accion=insertarProducto",
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
          alert("Producto guardado");
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

let $nombreM,
  $costoM,
  $colorM,
  $descripcionM,
  $tipoProductoM,
  $bodegaM,
  $estadoProductoM;

async function editarCliente(idCliente) {
  //try {
  // Configuración para una solicitud POST

  const opciones = {
    method: "POST",
    body: JSON.stringify({
      accion: "getProducto",
      id: idCliente,
    }),
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  };

  // Realizar la solicitud POST al servidor para obtener los datos del cliente
  const respuestaRaw = await fetch(
    "../controllers/ProductosControllers.php?accion=getProducto",
    opciones
  );

  if (!respuestaRaw.ok) {
    throw new Error(
      `Error al obtener datos del cliente. Código de estado: ${respuestaRaw.status}`
    );
  }

  // Analizar la respuesta JSON del servidor
  const { DatosOK } = await respuestaRaw.json(); // me llega en un arreglo y debo de colocarlo en posicion 0

  ($nombreM = document.querySelector("#txtNombreM")),
    ($costoM = document.querySelector("#txtCostoM")),
    ($colorM = document.querySelector("#txtColorM")),
    ($descripcionM = document.querySelector("#txtDescripcionM")),
    ($tipoProductoM = document.querySelector("#txtTipoProductoM")),
    ($bodegaM = document.querySelector("#txtBodegaM")),
    ($estadoProductoM = document.querySelector("#txtEstadoProductoM")),
    // Colocar los datos del cliente en el formulario
    ($idM.value = DatosOK[0].id_productos);
  $nombreM.value = DatosOK[0].nombre;
  $costoM.value = DatosOK[0].costo;
  $colorM.value = DatosOK[0].color;
  $descripcionM.value = DatosOK[0].descripcion;
  $tipoProductoM.value = DatosOK[0].id_tipo_productos;
  $bodegaM.value = DatosOK[0].id_bodegas;
  $estadoProductoM.value = DatosOK[0].id_estado_productos;

  const manejarEditarProducto = async () => {
    const idPro = $idM.value;
    const nombreM = $nombreM.value;
    const costoM = $costoM.value;
    const colorM = $colorM.value;
    const descripcionM = $descripcionM.value;
    const tipoProductoM = $tipoProductoM.value;
    const bodegaM = $bodegaM.value;
    const estadoProductoM = $estadoProductoM.value;

    const cargaDatos = {
      idPro,
      nombreM,
      costoM,
      colorM,
      descripcionM,
      tipoProductoM,
      bodegaM,
      estadoProductoM
    };

    try {
      const respuestaRaw = await fetch(
        "../controllers/ProductosControllers.php?accion=ModificarProducto",
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
            alert("Producto Modificado");
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
  $btnEditarM.onclick = manejarEditarProducto;
}



  function configurarBusqueda() {
    // Obtener referencia al campo de búsqueda
    const inputBusqueda = document.getElementById('inputBusqueda');

    // Obtener referencia a las filas de la tabla
    const filas = document.querySelectorAll('#cuerpoTabla tr');

    // Agregar un evento de entrada al campo de búsqueda
    inputBusqueda.addEventListener('input', function() {
      const busqueda = inputBusqueda.value.toLowerCase();

      // Iterar sobre las filas y mostrar/ocultar según la búsqueda
      filas.forEach(function(fila) {
        const nombre = fila.querySelector('td:nth-child(2)').textContent.toLowerCase();

        // Mostrar la fila si la búsqueda coincide con el nombre
        // o si la búsqueda está vacía
        //if ternario
        fila.style.display = nombre.includes(busqueda) ? '' : 'none';
      });
    });
  }

  // Llamar a la función de configuración al cargar la página
  document.addEventListener('DOMContentLoaded', configurarBusqueda);



  
