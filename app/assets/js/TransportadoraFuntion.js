const $id = document.querySelector("#idTrasnportadora"),
  $nombre = document.querySelector("#txtNombre"),
  $identificacion = document.querySelector("#txtIdentificación"),
  $telefono = document.querySelector("#txtTelefono"),
  $direccion = document.querySelector("#txtDireccion"),
  $Descripcion = document.querySelector("#txtDescripcion"),
  $btnGuardar = document.querySelector("#btnGuardar");
$btnEditarM= document.querySelector("#btnEditarM");



$btnGuardar.onclick = async () => {
  const nombre = $nombre.value,
    identificacion = $identificacion.value,
    telefono = $telefono.value,
    direccion = $direccion.value,
    descripcion = $Descripcion.value;

  const cargaDatos = {
    nombre,
    identificacion,
    telefono,
    direccion,
    descripcion,
  };

  const cargaUtilCodificada = JSON.stringify(cargaDatos);
  debugger;
  try {
    const respuestaRaw = await fetch(
      "../controllers/TransportadoraControllers.php?accion=insertarTrasportadora",
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
          alert("Trasportadora guardado");
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
    debugger;
    // En caso de que haya un error
    console.log(e);
  }
};

let $idM, $nombreM, $identificacionM, $telefonoM, $direccionM, $descripcionM;

async function editarTrasportadora(idTtranportadora) {
  const opciones = {
    method: "POST",
    body: JSON.stringify({
      accion: "getTransportadora",
      id: idTtranportadora,
    }),
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  };
debugger;
  // Realizar la solicitud POST al servidor para obtener los datos del cliente
  const respuestaRaw = await fetch(
    "../controllers/TransportadoraControllers.php?accion=getTransportadora",
    opciones
  );

  if (!respuestaRaw.ok) {
    throw new Error(
      `Error al obtener datos del cliente. Código de estado: ${respuestaRaw.status}`
    );
  }

  debugger;

  // Analizar la respuesta JSON del servidor
  const { DatosOK } = await respuestaRaw.json(); // me llega en un arreglo y debo de colocarlo en posicion 0
console.log(DatosOK[0]);
 
$idM = document.getElementById("idTrasnportadoraM");
$nombreM = document.getElementById("txtNombreM");
$identificacionM = document.getElementById("txtIdentificacionM");
$telefonoM = document.getElementById("txtTelefonoM");
$direccionM = document.getElementById("txtDireccionM");
$descripcionM = document.getElementById("txtDescripcionM");

$idM.value = DatosOK[0].id_transportadora;
$nombreM.value = DatosOK[0].nombre;
$identificacionM.value = DatosOK[0].numero_identificacion;
$telefonoM.value = DatosOK[0].telefono;
$direccionM.value = DatosOK[0].direccion;
$descripcionM.value = DatosOK[0].observaciones;


const manejarEditarTrasportadora = async () => {
  const idtra = $idM.value;
  const nombreM = $nombreM.value;
  const identificacionM = $identificacionM.value;
  const telefonoM = $telefonoM.value;
  const direccionM = $direccionM.value;
  const descripcionM = $descripcionM.value;

  const cargaDatos = {
    idtra,
    nombreM,
    identificacionM,
    telefonoM,
    direccionM,
    descripcionM
  };

  try {
    const respuestaRaw = await fetch(
      "../controllers/TransportadoraControllers.php?accion=ModificarTrasportadora",
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
          alert("Transportadora Modificado");
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
$btnEditarM.onclick = manejarEditarTrasportadora;
}
