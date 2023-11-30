const $id = document.querySelector("#txtIdCliente"),
  $nombre = document.querySelector("#txtNombreCompleto"),
  $tipoDocumento = document.querySelector("#listTipoDocumento"),
  $identificacion = document.querySelector("#txtnumeroIdentificacion"),
  $telefono = document.querySelector("#txtTelefono"),
  $direccion = document.querySelector("#txtDireccion"),
  $tipoCliente = document.querySelector("#listTipoCliente"),
  $btnGuardar = document.querySelector("#btnGuardar"),
  $btnEditarM = document.querySelector("#btnEditarM");

$btnGuardar.onclick = async () => {
  const nombre = $nombre.value,
    tipoDocumento = $tipoDocumento.value,
    identificacion = $identificacion.value,
    telefono = $telefono.value,
    direccion = $direccion.value,
    tipoCliente = $tipoCliente.value;

  const cargaDatos = {
    nombre,
    direccion,
    telefono,
    tipoDocumento,
    tipoCliente,
    identificacion,
  };

  const cargaUtilCodificada = JSON.stringify(cargaDatos);
  debugger;
  try {
    const respuestaRaw = await fetch(
      "../controllers/ClienteControllers.php?accion=insertarCliente",
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

async function eliminarCliente(idCliente) {
  try {
    const confirmacion = confirm(
      "¿Estás seguro de que deseas eliminar este cliente?"
    );
    if (!confirmacion) {
      return;
    }

    const respuestaRaw = await fetch(
      `../controllers/ClienteControllers.php?accion=eliminarCliente&id=${idCliente}`,
      {
        method: "DELETE", // Utilizamos el método DELETE para indicar que queremos eliminar el recurso
      }
    );

    const respuesta = await respuestaRaw.json();

    if (respuesta.success) {
      alert("Cliente eliminado correctamente");
      location.reload();
      // Puedes actualizar la tabla o hacer otras acciones después de la eliminación
    } else {
      alert("Error al eliminar el cliente");
    }
  } catch (error) {
    console.error("Error al eliminar el cliente:", error);
  }
}



let $idM,
  $nombreM,
  $tipoDocumetoM,
  $identificacionM,
  $telefonoM,
  $direccionM,
  $tipoClienteM;

async function editarCliente(idCliente) {
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
    "../controllers/ClienteControllers.php?accion=getCliente",
    opciones
  );

  if (!respuestaRaw.ok) {
    throw new Error(
      `Error al obtener datos del cliente. Código de estado: ${respuestaRaw.status}`
    );
  }

  // Analizar la respuesta JSON del servidor
  const { DatosOK } = await respuestaRaw.json(); // me llega en un arreglo y debo de colocarlo en posicion 0

  // Coloca los datos del cliente en el formulario
  /*$idM = document.getElementById("txtIdClienteM").value =
    DatosOK[0].id_clientes;
  $nombreM = document.getElementById("txtNombreCompletoM").value =
    DatosOK[0].nombre;
  $tipoDocumetoM = document.getElementById("listTipoDocumentoM").value =
    DatosOK[0].id_tipo_documentos;
  $identificacionM = document.getElementById("txtnumeroIdentificacionM").value =
    DatosOK[0].numero_identificacion;
  $telefonoM = document.getElementById("txtTelefonoM").value =
    DatosOK[0].telefono;
  $direccionM = document.getElementById("txtDireccionM").value =
    DatosOK[0].direccion;
  $tipoClienteM = document.getElementById("listTipoClienteM").value =
    DatosOK[0].id_tipo_clientes;
  //} catch (error) {
  //   console.error('Error:', error.message);
  // }*/

  $idM = document.getElementById("txtIdClienteM");
  $nombreM = document.getElementById("txtNombreCompletoM");
  $tipoDocumetoM = document.getElementById("listTipoDocumentoM");
  $identificacionM = document.getElementById("txtnumeroIdentificacionM");
  $telefonoM = document.getElementById("txtTelefonoM");
  $direccionM = document.getElementById("txtDireccionM");
  $tipoClienteM = document.getElementById("listTipoClienteM");

  // Colocar los datos del cliente en el formulario
  $idM.value = DatosOK[0].id_clientes;
  $nombreM.value = DatosOK[0].nombre;
  $tipoDocumetoM.value = DatosOK[0].id_tipo_documentos;
  $identificacionM.value = DatosOK[0].numero_identificacion;
  $telefonoM.value = DatosOK[0].telefono;
  $direccionM.value = DatosOK[0].direccion;
  $tipoClienteM.value = DatosOK[0].id_tipo_clientes;



  const manejarEditarCliente = async () => {
    const idclie = $idM.value;
    const nombreM = $nombreM.value;
    const tipoDocumentoM = $tipoDocumetoM.value;
    const identificacionM = $identificacionM.value;
    const telefonoM = $telefonoM.value;
    const direccionM = $direccionM.value;
    const tipoClienteM = $tipoClienteM.value;
  
    const cargaDatos = {
      idclie,
      nombreM,
      tipoDocumentoM,
      identificacionM,
      telefonoM,
      direccionM,
      tipoClienteM
    };
  
    try {
      const respuestaRaw = await fetch(
        "../controllers/ClienteControllers.php?accion=ModificarCliente",
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
        console.error("Error en la respuesta del servidor:", respuestaRaw.statusText);
      }
    } catch (e) {
      // En caso de que haya un error con la solicitud fetch
      console.error("Error al realizar la solicitud fetch:", e);
    }
  };
  

  // Asignar la función interna como manejador del evento clic
  $btnEditarM.onclick = manejarEditarCliente;
}


function limpiar() {
  let formulario = document.getElementById("formCliente");
  formulario.reset();
}
