<?php

require_once('../controllers/TransportadoraControllers.php');
$datosTransportadoras = TransportadoraControllers::getTransportadoras();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/aplicacionCompleta.css">
  <title>Transportadora</title>
</head>

<body>

  <?php
  include_once('./menu.php');
  ?>

  <div class="container">

    <div>
      <h1 class="is-size-2">Gestion de transportadoras</h1>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaTransportadora">
        Nueva transportadora
      </button>
    </div>

  </div>



  <div class="modal fade" id="modalNuevaTransportadora" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registro del transportadora</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario -->

          <form class="form" action="" method="POST">


            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Nombre completo</label>
              <input type="text" class="form-control" id="txtNombre" name="txtNombre" aria-describedby="emailHelp">

            </div>


            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Número de identificación</label>
              <input type="text" class="form-control" id="txtIdentificación" name="txtIdentificación">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Telefono</label>
              <input type="text" class="form-control" id="txtTelefono" name="txtTelefono">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Direccion</label>
              <input type="text" class="form-control" id="txtDireccion" name="txtDireccion">
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Descripcion</label>
              <input type="text" class="form-control" id="txtDescripcion" name="txtDescripcion">
            </div>



            <button type="button" class="btn btn-primary" id="btnGuardar" name="btnGuardar">Guardar</button>
          </form>

        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form" action="" method="POST">

        <div class="mb-3">
          <label for="idTrasnportadoraM" class="form-label">ID</label>
          <input type="text" class="form-control" id="idTrasnportadoraM" name="idTrasnportadoraM" aria-describedby="emailHelp" readonly>
        </div>

        <div class="mb-3">
          <label for="txtNombreM" class="form-label">Nombre completo</label>
          <input type="text" class="form-control" id="txtNombreM" name="txtNombreM" aria-describedby="emailHelp">
        </div>

        <div class="mb-3">
          <label for="txtIdentificacionM" class="form-label">Número de identificación</label>
          <input type="text" class="form-control" id="txtIdentificacionM" name="txtIdentificacionM">
        </div>

        <div class="mb-3">
          <label for="txtTelefonoM" class="form-label">Telefono</label>
          <input type="text" class="form-control" id="txtTelefonoM" name="txtTelefonoM">
        </div>

        <div class="mb-3">
          <label for="txtDireccionM" class="form-label">Direccion</label>
          <input type="text" class="form-control" id="txtDireccionM" name="txtDireccionM">
        </div>

        <div class="mb-3">
          <label for="txtDescripcionM" class="form-label">Descripcion</label>
          <input type="text" class="form-control" id="txtDescripcionM" name="txtDescripcionM">
        </div>

        <button type="button" class="btn btn-primary" id="btnEditarM" name="btnEditarM">Editar</button>
      </form>
    </div>
  </div>
</div>


  <div class="columns">
    <div class="column">


      <table class="table">
        <thead>
          <tr>
            <th>Codigo</th>
            <th>Nombre</th>
            <th>identificación</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Botones</th>
          </tr>
        </thead>
        <tbody id="cuerpoTabla">

          <?php foreach ($datosTransportadoras as $datos) : ?>
            <tr>

              <td><?= $datos['id_transportadora'] ?></td>
              <td><?= $datos['nombre'] ?></td>
              <td><?= $datos['numero_identificacion'] ?></td>
              <td><?= $datos['telefono'] ?></td>
              <td><?= $datos['direccion'] ?></td>
              <td>
                <button type="button" class="btn btn-primary" id="btnEditar" data-id="<?= $datos['id_transportadora'] ?>" data-bs-toggle="modal" data-bs-target="#modalEditarCliente" onclick="editarTrasportadora(<?= $datos['id_transportadora'] ?>);">
                  Editar
                </button>

              </td>
              <!---td><button type="button" class="btn btn-primary" id="btnEliminar" data-id="<?= $datos['id_transportadora'] ?>" onclick="eliminarCliente(<?= $datos['id_transportadora'] ?>);">Eliminar</button></td--->


            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

  <script src="../assets/js/TransportadoraFuntion.js"></script>
</body>

</html>